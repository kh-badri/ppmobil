<?php

namespace App\Models;

use CodeIgniter\Model;

class DatasetModel extends Model
{
    /**
     * Nama tabel di database
     */
    protected $table            = 'dataset_mobil';

    /**
     * Primary key tabel
     */
    protected $primaryKey       = 'id';

    /**
     * Menggunakan auto-increment
     */
    protected $useAutoIncrement = true;

    /**
     * Tipe data yang dikembalikan
     */
    protected $returnType       = 'array';

    /**
     * Menggunakan soft deletes (opsional, tapi bagus)
     */
    protected $useSoftDeletes   = false;

    /**
     * Field yang diizinkan untuk diisi (MASS ASSIGNMENT)
     * Ini adalah 7 FITUR (X) dan 1 TARGET (y) Anda.
     */
    protected $allowedFields    = [
        'bulan_tahun',
        'pendapatan_per_kapita',
        'tingkat_inflasi',
        'suku_bunga_kredit',
        'jumlah_penduduk',
        'usia_produktif', // Saya asumsikan ini persentase/angka
        'tingkat_urbanisasi',
        'permintaan_mobil' // Ini adalah target (y)
    ];

    // Mengaktifkan timestamps (created_at, updated_at)
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
