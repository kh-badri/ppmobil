<?= $this->extend('layout/layout'); ?>
<?= $this->section('content'); ?>

<!-- Latar belakang utama diubah menjadi krem #FDEBD0 -->
<div class="w-full min-h-screen bg-[#FDEBD0] p-4 lg:p-8 text-gray-800">
    <div class="container mx-auto">

        <!-- Judul Halaman -->
        <h1 class="text-4xl font-bold mb-6 text-[#DC143C]">
            Manajemen Dataset_csv 📊
        </h1>


        <!-- Layout 2 Kolom untuk Form dan Aksi -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">

            <!-- Kolom Kiri: Form Tambah Data Manual -->
            <div class="lg:col-span-1">
                <!-- Style kartu disamakan dengan halaman history -->
                <div class="bg-white p-6 rounded-xl shadow-2xl border border-gray-200 h-full">
                    <h2 class="text-2xl font-semibold mb-4 border-b border-gray-200 pb-2 text-gray-800">Tambah Data Manual</h2>
                    <form action="<?= base_url('dataset/save') ?>" method="post">
                        <?= csrf_field() ?>
                        <!-- Layout responsif 2 kolom untuk form input -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            <div class="md:col-span-2">
                                <label for="bulan_tahun" class="block mb-2 text-sm font-medium text-gray-600">Bulan-Tahun (Contoh: Jan-24)</label>
                                <!-- Input style disamakan dengan halaman prediksi -->
                                <input type="text" name="bulan_tahun" placeholder="Contoh: Jan-24" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#F75270] focus:border-[#DC143C] block w-full p-2.5" required>
                            </div>
                            <div>
                                <label for="pendapatan_per_kapita" class="block mb-2 text-sm font-medium text-gray-600">Pendapatan/Kapita</label>
                                <input type="number" step="any" name="pendapatan_per_kapita" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#F75270] focus:border-[#DC143C] block w-full p-2.5" required>
                            </div>
                            <div>
                                <label for="tingkat_inflasi" class="block mb-2 text-sm font-medium text-gray-600">Inflasi (%)</label>
                                <input type="number" step="any" name="tingkat_inflasi" placeholder="3.5" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#F75270] focus:border-[#DC143C] block w-full p-2.5" required>
                            </div>
                            <div>
                                <label for="suku_bunga_kredit" class="block mb-2 text-sm font-medium text-gray-600">Suku Bunga (%)</label>
                                <input type="number" step="any" name="suku_bunga_kredit" placeholder="6.0" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#F75270] focus:border-[#DC143C] block w-full p-2.5" required>
                            </div>
                            <div>
                                <label for="jumlah_penduduk" class="block mb-2 text-sm font-medium text-gray-600">Jml Penduduk (Jt)</label>
                                <input type="number" step="any" name="jumlah_penduduk" placeholder="14.5" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#F75270] focus:border-[#DC143C] block w-full p-2.5" required>
                            </div>
                            <div>
                                <label for="usia_produktif" class="block mb-2 text-sm font-medium text-gray-600">Usia Produktif (%)</label>
                                <input type="number" step="any" name="usia_produktif" placeholder="60.0" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#F75270] focus:border-[#DC143C] block w-full p-2.5" required>
                            </div>
                            <div>
                                <label for="tingkat_urbanisasi" class="block mb-2 text-sm font-medium text-gray-600">Urbanisasi (%)</label>
                                <input type="number" step="any" name="tingkat_urbanisasi" placeholder="58.0" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#F75270] focus:border-[#DC143C] block w-full p-2.5" required>
                            </div>

                            <!-- Target (y) Dibuat Menonjol -->
                            <div class="md:col-span-2">
                                <!-- Warna disamakan dengan warna utama #DC143C -->
                                <label for="permintaan_mobil" class="block mb-2 text-sm font-bold text-[#DC143C]">TARGET: Permintaan (Unit)</label>
                                <input type="number" name="permintaan_mobil" placeholder="12500" class="bg-white border-2 border-[#DC143C] text-gray-900 text-sm rounded-lg focus:ring-[#F75270] focus:border-[#DC143C] block w-full p-2.5" required>
                            </div>

                            <!-- Tombol Submit -->
                            <div class="md:col-span-2 flex items-end">
                                <!-- Tombol utama diubah jadi #DC143C -->
                                <button type="submit" class="w-full bg-[#DC143C] hover:bg-[#F75270] text-white font-bold py-2.5 px-6 rounded-lg transition duration-300 shadow-lg transform hover:scale-105">
                                    Simpan Data
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Kolom Kanan: Aksi Cepat -->
            <div class="lg:col-span-2">
                <div class="bg-white p-6 rounded-xl shadow-2xl border border-gray-200 h-full">
                    <h2 class="text-2xl font-semibold mb-4 border-b border-gray-200 pb-2 text-gray-800">Aksi Cepat</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                        <!-- Form Impor CSV -->
                        <form action="<?= base_url('dataset/upload') ?>" method="post" enctype="multipart/form-data" class="flex flex-col space-y-3 p-4 border border-gray-200 rounded-lg">
                            <?= csrf_field() ?>
                            <label for="dataset_csv" class="font-medium text-gray-700">Impor dari CSV:</label>
                            <input type="file" name="dataset_csv" id="dataset_csv" required class="block w-full text-sm text-gray-700
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-sm file:font-semibold
                                file:bg-[#FDEBD0] file:text-[#DC143C]
                                hover:file:bg-[#F75270] hover:file:text-white transition duration-300 cursor-pointer">
                            <!-- Tombol utama diubah jadi #DC143C -->
                            <button type="submit" class="w-full bg-[#DC143C] hover:bg-[#F75270] text-white font-bold py-2 px-4 rounded-lg transition duration-300 shadow-lg transform hover:scale-105">
                                Upload & Simpan
                            </button>
                        </form>

                        <!-- Tombol Ekspor -->
                        <div class="flex flex-col space-y-3 justify-between p-4 border border-gray-200 rounded-lg">
                            <label class="font-medium text-gray-700">Ekspor ke CSV:</label>
                            <p class="text-sm text-gray-500">Unduh semua data dalam tabel sebagai satu file CSV.</p>
                            <!-- Tombol Ekspor diganti dengan style palet warna -->
                            <a href="<?= base_url('dataset/export') ?>" class="w-full text-center bg-transparent border border-[#F75270] text-[#F75270] hover:bg-[#F75270] hover:text-white font-bold py-2 px-4 rounded-lg transition duration-300 shadow-lg transform hover:scale-105">
                                Download Dataset
                            </a>
                        </div>

                        <!-- Form Hapus Semua Data -->
                        <div class="flex flex-col space-y-3 justify-between p-4 border border-gray-200 rounded-lg bg-red-50">
                            <label class="font-medium text-gray-700">Hapus Semua Data:</label>
                            <p class="text-sm text-red-700">Aksi ini akan menghapus permanen semua data latih.</p>
                            <form action="<?= base_url('dataset/hapusSemua') ?>" method="post" onsubmit="return confirm('PERINGATAN! Anda yakin ingin menghapus semua data? Aksi ini tidak dapat dibatalkan.');">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <!-- Tombol Hapus sudah benar menggunakan #DC143C -->
                                <button type="submit" class="w-full bg-[#DC143C] hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300 shadow-lg transform hover:scale-105">
                                    Hapus Semua
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <!-- Tabel Data (Kartu Putih) - Tampilan Baru -->
        <div class="bg-white rounded-xl shadow-2xl border border-gray-200 overflow-hidden">
            <div class="p-6">
                <h2 class="text-2xl font-semibold text-gray-800">Isi Tabel Dataset</h2>
            </div>
            <!-- Wrapper untuk scroll horizontal di layar kecil -->
            <div class="relative overflow-x-auto">
                <!-- Header tabel sudah benar menggunakan #DC143C -->
                <table class="w-full text-sm text-left text-gray-700">
                    <thead class="text-xs text-white uppercase bg-[#DC143C]">
                        <tr>
                            <th scope="col" class="px-4 py-3">ID</th>
                            <th scope="col" class="px-4 py-3">Bulan-Tahun</th>
                            <th scope="col" class="px-4 py-3">Pendapatan/Kapita</th>
                            <th scope="col" class="px-4 py-3">Inflasi</th>
                            <th scope="col" class="px-4 py-3">Suku Bunga</th>
                            <th scope="col" class="px-4 py-3">Jml Penduduk</th>
                            <th scope="col" class="px-4 py-3">Usia Produktif</th>
                            <th scope="col" class="px-4 py-3">Urbanisasi</th>
                            <th scope="col" class="px-4 py-3">Permintaan (Unit)</th>
                            <th scope="col" class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($dataset)) : ?>
                            <tr class="bg-white border-b border-gray-200">
                                <td colspan="10" class="px-6 py-4 text-center text-gray-500">
                                    Data masih kosong. Silakan tambah data manual atau upload CSV.
                                </td>
                            </tr>
                        <?php else : ?>
                            <?php $i = 0;
                            foreach ($dataset as $row) : $i++; ?>
                                <!-- Zebra-striping dan hover disamakan dengan history -->
                                <tr class="<?= ($i % 2 == 0) ? 'bg-gray-50' : 'bg-white' ?> border-b border-gray-200 hover:bg-pink-50 transition duration-150">
                                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap"><?= $row['id'] ?></th>
                                    <td class="px-4 py-3 whitespace-nowrap"><?= esc($row['bulan_tahun']) ?></td>
                                    <td class="px-4 py-3 whitespace-nowrap"><?= number_format($row['pendapatan_per_kapita'], 0, ',', '.') ?></td>
                                    <td class="px-4 py-3 whitespace-nowrap"><?= esc($row['tingkat_inflasi']) ?>%</td>
                                    <td class="px-4 py-3 whitespace-nowrap"><?= esc($row['suku_bunga_kredit']) ?>%</td>
                                    <td class="px-4 py-3 whitespace-nowrap"><?= number_format($row['jumlah_penduduk'], 0, ',', '.') ?></td>
                                    <td class="px-4 py-3 whitespace-nowrap"><?= number_format($row['usia_produktif'], 0, ',', '.') ?></td>
                                    <td class="px-4 py-3 whitespace-nowrap"><?= esc($row['tingkat_urbanisasi']) ?>%</td>
                                    <!-- Target diubah ke #DC143C agar konsisten -->
                                    <td class="px-4 py-3 whitespace-nowrap font-bold text-[#DC143C]">
                                        <?= number_format($row['permintaan_mobil'], 0, ',', '.') ?>
                                    </td>
                                    <td class="px-4 py-3 text-center whitespace-nowrap">
                                        <form action="<?= base_url('dataset/delete/' . $row['id']) ?>" method="post" onsubmit="return confirm('Anda yakin ingin menghapus data ini?');">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="bg-[#DC143C] text-white text-xs font-medium py-1 px-3 rounded-full hover:bg-red-700 transition duration-300">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<?= $this->endSection(); ?>