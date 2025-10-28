<?= $this->extend('layout/layout'); ?>
<?= $this->section('content'); ?>

<div class="w-full min-h-screen bg-[#FDEBD0] p-4 md:p-8 text-gray-800">
    <div class="container mx-auto max-w-7xl">

        <!-- Header Section -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-4xl font-bold mb-2 text-[#DC143C]">
                    📜 Riwayat Prediksi
                </h1>
                <p class="text-gray-600">
                    Semua data prediksi yang telah Anda simpan.
                </p>
            </div>
            <a href="<?= base_url('prediksi') ?>" class="text-sm bg-[#F75270] hover:bg-[#DC143C] text-white py-2 px-4 rounded-lg shadow-lg transition duration-300">
                ← Kembali ke Prediksi
            </a>
        </div>

        <!-- Tabel Riwayat -->
        <div class="bg-white rounded-xl shadow-2xl border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pendapatan</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Inflasi</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Suku Bunga</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Penduduk (Jt)</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usia Produktif (%)</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Urbanisasi (%)</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[#DC143C] uppercase tracking-wider">Hasil Prediksi</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php if (empty($history)): ?>
                            <tr>
                                <td colspan="10" class="px-6 py-4 text-center text-gray-500">
                                    Belum ada riwayat prediksi yang disimpan.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($history as $item): ?>
                                <tr class="hover:bg-gray-50 transition duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?= esc($item['id']) ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <?= number_format($item['pendapatan_per_kapita'], 0, ',', '.') ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <?= esc($item['tingkat_inflasi']) ?>%
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <?= esc($item['suku_bunga_kredit']) ?>%
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <?= esc($item['jumlah_penduduk']) ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <?= esc($item['usia_produktif']) ?>%
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <?= esc($item['tingkat_urbanisasi']) ?>%
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?= date('d M Y, H:i', strtotime($item['created_at'])) ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-[#DC143C]">
                                        <?= number_format($item['hasil_prediksi'], 0, ',', '.') ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                        <a href="<?= base_url('history/delete/' . $item['id']) ?>"
                                            class="inline-block text-sm bg-red-100 text-[#DC143C] hover:bg-[#DC143C] hover:text-white font-medium py-2 px-4 rounded-lg transition duration-300"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data riwayat ini (ID: <?= esc($item['id']) ?>)?')">
                                            Hapus
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Informasi Total Data -->
        <?php if (!empty($history)): ?>
            <div class="mt-6 text-center text-gray-600">
                <p class="text-sm">
                    Total: <span class="font-bold text-[#DC143C]"><?= count($history) ?></span> data riwayat prediksi
                </p>
            </div>
        <?php endif; ?>

    </div>
</div>

<?= $this->endSection(); ?>