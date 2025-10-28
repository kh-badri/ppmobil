<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DatasetModel;
use CodeIgniter\Exceptions\PageNotFoundException;

/**
 * Controller ini diadaptasi dari kode Anda untuk mengelola
 * dataset prediksi permintaan mobil.
 */
class Dataset extends BaseController
{
    protected $datasetModel;

    public function __construct()
    {
        // Inisialisasi Model
        $this->datasetModel = new DatasetModel();
    }

    /**
     * Menampilkan halaman utama dataset dengan semua data.
     */
    public function index()
    {
        $data = [
            'title'   => 'Manajemen Data Latih (Dataset) Mobil',
            'dataset' => $this->datasetModel->findAll(), // Ambil semua data
            'active_menu' => 'dataset'
        ];

        return view('dataset/index', $data); // Pastikan view ada di 'app/Views/dataset/index.php'
    }

    /**
     * Menyimpan data baru dari form manual.
     */
    public function save()
    {
        // Validasi input disesuaikan dengan 7 fitur + 1 target
        $rules = [
            'bulan_tahun'           => 'required|string|max_length[7]', // Format YYYY-MM
            'pendapatan_per_kapita' => 'required|numeric',
            'tingkat_inflasi'       => 'required|numeric',
            'suku_bunga_kredit'   => 'required|numeric',
            'jumlah_penduduk'     => 'required|numeric',
            'usia_produktif'      => 'required|numeric',
            'tingkat_urbanisasi'  => 'required|numeric',
            'permintaan_mobil'    => 'required|numeric|integer', // Target (y)
        ];

        if (!$this->validate($rules)) {
            // Jika validasi gagal, kembalikan dengan pesan error
            return redirect()->to('/dataset')->withInput()->with('error', 'Validasi gagal, mohon periksa kembali input Anda.');
        }

        // Simpan data ke database menggunakan model
        $this->datasetModel->save([
            'bulan_tahun'           => $this->request->getPost('bulan_tahun'),
            'pendapatan_per_kapita' => $this->request->getPost('pendapatan_per_kapita'),
            'tingkat_inflasi'       => $this->request->getPost('tingkat_inflasi'),
            'suku_bunga_kredit'   => $this->request->getPost('suku_bunga_kredit'),
            'jumlah_penduduk'     => $this->request->getPost('jumlah_penduduk'),
            'usia_produktif'      => $this->request->getPost('usia_produktif'),
            'tingkat_urbanisasi'  => $this->request->getPost('tingkat_urbanisasi'),
            'permintaan_mobil'    => $this->request->getPost('permintaan_mobil'),
        ]);

        return redirect()->to('/dataset')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Memproses file CSV yang di-upload dan menyimpannya ke database.
     */
    public function upload()
    {
        $file = $this->request->getFile('dataset_csv');

        if ($file === null || !$file->isValid() || !in_array($file->getMimeType(), ['text/csv', 'application/csv'])) {
            return redirect()->to('/dataset')->with('error', 'Upload gagal. Pastikan Anda memilih file CSV yang valid.');
        }

        $filePath = $file->getRealPath();
        $fileContent = file($filePath);
        if ($fileContent === false) {
            return redirect()->to('/dataset')->with('error', 'Gagal membaca isi file CSV.');
        }

        $csvData = array_map('str_getcsv', $fileContent);

        array_shift($csvData); // Hapus header

        $dataToInsert = [];
        $insertedCount = 0;

        foreach ($csvData as $row) {
            if (empty($row) || empty($row[0])) {
                continue;
            }

            // Fungsi pembersihan data
            $cleanPendapatan = (float) str_replace([',', ' '], '', $row[1] ?? 0);

            // ==== PERBAIKAN PENTING DI SINI ====
            // Simpan 'jumlah_penduduk' dan 'usia_produktif' sebagai FLOAT
            $dataToInsert[] = [
                'bulan_tahun'           => trim($row[0] ?? ''),
                'pendapatan_per_kapita' => $cleanPendapatan,
                'tingkat_inflasi'       => (float) ($row[2] ?? 0),
                'suku_bunga_kredit'     => (float) ($row[3] ?? 0),
                'jumlah_penduduk'       => (float) ($row[4] ?? 0), // <-- UBAH KE FLOAT
                'usia_produktif'        => (float) ($row[5] ?? 0), // <-- UBAH KE FLOAT
                'tingkat_urbanisasi'    => (float) ($row[6] ?? 0),
                'permintaan_mobil'      => (int) ($row[7] ?? 0),
            ];
            // ===================================
        }

        if (!empty($dataToInsert)) {
            try {
                // Hapus data lama sebelum insert baru agar konsisten
                $this->datasetModel->emptyTable();
                $this->datasetModel->db->query("ALTER TABLE dataset_mobil AUTO_INCREMENT = 1");

                $insertedCount = $this->datasetModel->insertBatch($dataToInsert);
            } catch (\Exception $e) {
                return redirect()->to('/dataset')->with('error', 'Terjadi error saat menyimpan ke database: ' . $e->getMessage());
            }
        }

        return redirect()->to('/dataset')->with('success', "Upload selesai! {$insertedCount} baris data baru berhasil diimpor.");
    }

    /**
     * Menghapus semua data dari tabel dataset.
     */
    public function hapusSemua()
    {
        $method = strtolower($this->request->getMethod());
        $spoofedMethod = strtolower($this->request->getPost('_method') ?? '');

        if (!in_array($method, ['post', 'delete']) && !in_array($spoofedMethod, ['post', 'delete'])) {
            return redirect()->to('/dataset')->with('error', 'Akses tidak diizinkan.');
        }

        try {
            $tableName = $this->datasetModel->table;
            $countBefore = $this->datasetModel->countAllResults(false);

            if ($countBefore == 0) {
                return redirect()->to('/dataset')->with('info', 'Tidak ada data untuk dihapus.');
            }

            $this->datasetModel->emptyTable();
            $this->datasetModel->db->query("ALTER TABLE {$tableName} AUTO_INCREMENT = 1");

            return redirect()->to('/dataset')->with('success', "Semua data berhasil dihapus ({$countBefore} baris).");
        } catch (\Exception $e) {
            log_message('error', 'Error hapusSemua: ' . $e->getMessage());
            return redirect()->to('/dataset')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    /**
     * Menghapus satu baris data berdasarkan ID.
     */
    public function delete($id = null)
    {
        // Anda bisa menggunakan link GET biasa atau form POST/DELETE
        $dataset = $this->datasetModel->find($id);
        if ($dataset) {
            $this->datasetModel->delete($id);
            return redirect()->to('/dataset')->with('success', 'Data berhasil dihapus.');
        }

        return redirect()->to('/dataset')->with('error', 'Data tidak ditemukan.');
    }

    /**
     * Mengunduh semua data dari tabel sebagai file CSV.
     */
    public function export()
    {
        $data = $this->datasetModel->findAll();
        $filename = 'export_dataset_mobil_' . date('Y-m-d') . '.csv';

        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");

        $file = fopen('php://output', 'w');

        // Tulis baris header (sesuai dengan field model)
        $header = [
            'id',
            'bulan_tahun',
            'pendapatan_per_kapita',
            'tingkat_inflasi',
            'suku_bunga_kredit',
            'jumlah_penduduk',
            'usia_produktif',
            'tingkat_urbanisasi',
            'permintaan_mobil',
            'created_at',
            'updated_at'
        ];
        fputcsv($file, $header);

        // Tulis data baris per baris
        foreach ($data as $row) {
            fputcsv($file, $row);
        }

        fclose($file);
        exit;
    }
}
