<?php

namespace App\Controllers;

use App\Models\HistoryModel;

class Prediksi extends BaseController
{
    protected $historyModel;

    public function __construct()
    {
        $this->historyModel = new HistoryModel();
        helper(['session', 'form']);
    }

    /**
     * Menampilkan halaman utama form prediksi
     */
    public function index()
    {
        // [TAMBAHAN] Menyiapkan data untuk view
        $data = [
            'hasil_prediksi' => session()->getFlashdata('hasil_prediksi'),
            'input_data'     => session()->getFlashdata('input_data'),
            'errors'         => session()->getFlashdata('errors'),
            'error_message'  => session()->getFlashdata('error_message'),
            'active_menu'    => 'prediksi' // <-- BARIS INI DITAMBAHKAN
        ];

        // [PERUBAHAN] Mengirim $data yang sudah lengkap ke view
        return view('prediksi/index', $data);
    }

    /**
     * Menjalankan proses prediksi
     */
    public function run()
    {
        // 1. Validasi
        $validation = \Config\Services::validation();
        $validation->setRules([
            'pendapatan_per_kapita' => 'required|numeric',
            'tingkat_inflasi'       => 'required|numeric',
            'suku_bunga_kredit'     => 'required|numeric',
            'jumlah_penduduk'       => 'required|numeric',
            'usia_produktif'        => 'required|numeric',
            'tingkat_urbanisasi'    => 'required|numeric',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()
                ->with('errors', $validation->getErrors());
        }

        // 2. Ambil data form
        $pendapatan_per_kapita = $this->request->getPost('pendapatan_per_kapita');
        $tingkat_inflasi       = $this->request->getPost('tingkat_inflasi');
        $suku_bunga_kredit     = $this->request->getPost('suku_bunga_kredit');
        $jumlah_penduduk       = $this->request->getPost('jumlah_penduduk');
        $usia_produktif        = $this->request->getPost('usia_produktif');
        $tingkat_urbanisasi    = $this->request->getPost('tingkat_urbanisasi');

        // 3. Konfigurasi DB
        $db      = db_connect();
        $db_host = $db->hostname;
        $db_user = $db->username;
        $db_pass = $db->password;
        $db_name = $db->database;

        // 4. Path Python
        $scriptPath = WRITEPATH . 'python/predict_rf.py';

        // 5. Bangun Perintah
        $command = sprintf(
            "python %s %s %s %s %s %s %s %s %s %s %s",
            escapeshellarg($scriptPath),
            escapeshellarg($db_host),
            escapeshellarg($db_user),
            escapeshellarg($db_pass),
            escapeshellarg($db_name),
            escapeshellarg($pendapatan_per_kapita),
            escapeshellarg($tingkat_inflasi),
            escapeshellarg($suku_bunga_kredit),
            escapeshellarg($jumlah_penduduk),
            escapeshellarg($usia_produktif),
            escapeshellarg($tingkat_urbanisasi)
        );

        // 6. Jalankan Perintah
        $output = shell_exec($command);

        // 7. Proses Output
        $hasil = json_decode($output, true);

        // 8. Kembalikan ke View
        if (isset($hasil['prediksi'])) {
            return redirect()->back()
                ->with('hasil_prediksi', $hasil['prediksi'])
                ->with('input_data', $this->request->getPost());
        } elseif (isset($hasil['error'])) {
            return redirect()->back()
                ->with('error_message', "Python Error: " . $hasil['error'])
                ->with('input_data', $this->request->getPost());
        } else {
            return redirect()->back()
                ->with('error_message', "Error: Gagal menjalankan skrip. Output: " . $output)
                ->with('input_data', $this->request->getPost());
        }
    }

    /**
     * Menyimpan hasil prediksi ke DB
     */
    public function simpan()
    {
        $data = [
            'pendapatan_per_kapita' => $this->request->getPost('pendapatan_per_kapita'),
            'tingkat_inflasi'       => $this->request->getPost('tingkat_inflasi'),
            'suku_bunga_kredit'     => $this->request->getPost('suku_bunga_kredit'),
            'jumlah_penduduk'       => $this->request->getPost('jumlah_penduduk'),
            'usia_produktif'        => $this->request->getPost('usia_produktif'),
            'tingkat_urbanisasi'    => $this->request->getPost('tingkat_urbanisasi'),
            'hasil_prediksi'        => $this->request->getPost('hasil_prediksi'),
        ];

        $this->historyModel->save($data);

        return redirect()->to('/history')->with('success', 'Data prediksi berhasil disimpan ke riwayat.');
    }

    /**
     * Menampilkan halaman riwayat prediksi
     */
    public function history()
    {
        $data = [
            'history' => $this->historyModel->orderBy('id', 'DESC')->findAll()
        ];

        // --- PERUBAHAN DI SINI ---
        // Mengarahkan ke folder 'history' dan file 'index.php'
        return view('history/index', $data);
    }
}
