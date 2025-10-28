<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\HistoryModel;

class History extends BaseController
{
    protected $historyModel;

    public function __construct()
    {
        $this->historyModel = new HistoryModel();
        helper(['form', 'url']); // Tambahkan helper url untuk redirect
    }

    /**
     * Menampilkan halaman utama riwayat
     */
    public function index()
    {
        $data = [
            'title'       => 'Riwayat Prediksi',
            'history'     => $this->historyModel->orderBy('id', 'DESC')->findAll(),
            'active_menu' => 'history'
        ];

        return view('history/index', $data);
    }

    /**
     * Menghapus satu data riwayat berdasarkan ID.
     */
    public function delete($id = null)
    {
        // Validasi ID
        if ($id === null || !is_numeric($id)) {
            session()->setFlashdata('error', 'ID tidak valid.');
            return redirect()->to(base_url('history'));
        }

        // Cek apakah data ada
        $data = $this->historyModel->find($id);

        if ($data) {
            // Hapus data
            if ($this->historyModel->delete($id)) {
                session()->setFlashdata('success', 'Data riwayat berhasil dihapus.');
            } else {
                session()->setFlashdata('error', 'Gagal menghapus data riwayat.');
            }
        } else {
            session()->setFlashdata('error', 'Data riwayat tidak ditemukan.');
        }

        return redirect()->to(base_url('history'));
    }

    /**
     * Menghapus semua data riwayat (opsional)
     */
    public function deleteAll()
    {
        if ($this->historyModel->truncate()) {
            session()->setFlashdata('success', 'Semua data riwayat berhasil dihapus.');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus semua data riwayat.');
        }

        return redirect()->to(base_url('history'));
    }
}
