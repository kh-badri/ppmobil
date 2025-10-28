<?php

namespace App\Models;

use CodeIgniter\Model;

class HistoryModel extends Model
{
    protected $table            = 'history_prediksi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = [
        'pendapatan_per_kapita',
        'tingkat_inflasi',
        'suku_bunga_kredit',
        'jumlah_penduduk',
        'usia_produktif',
        'tingkat_urbanisasi',
        'hasil_prediksi'
    ];

    // Menggunakan created_at secara otomatis
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = ''; // Kita tidak perlu updated_at
}
