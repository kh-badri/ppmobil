<?= $this->extend('layout/layout'); ?>
<?= $this->section('content'); ?>

<div class="w-full min-h-screen bg-[#FDEBD0] p-4 md:p-8 text-gray-800">
    <div class="container mx-auto max-w-5xl">

        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-4xl font-bold mb-2 text-[#DC143C]">
                    🤖 Prediksi Permintaan Mobil
                </h1>
                <p class="text-gray-600">
                    Didukung oleh Algoritma Random Forest & Python
                </p>
            </div>
            <a href="<?= site_url('history') ?>" class="text-sm bg-[#F75270] hover:bg-[#DC143C] text-white py-2 px-4 rounded-lg shadow-lg transition duration-300">
                Lihat Riwayat
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            <div class="bg-white p-6 md:p-8 rounded-xl shadow-2xl border border-gray-200">
                <h2 class="text-2xl font-semibold mb-6 border-b border-gray-200 pb-3 text-gray-800">
                    Parameter Prediksi
                </h2>

                <form action="<?= site_url('prediksi/run') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <label for="pendapatan_per_kapita" class="flex items-center text-sm font-medium text-gray-600 mb-2">💰 Pendapatan/Kapita (Rp)</label>
                            <input type="number" step="any" name="pendapatan_per_kapita" placeholder="5000000"
                                value="<?= old('pendapatan_per_kapita', $input_data['pendapatan_per_kapita'] ?? '') ?>"
                                class="w-full bg-gray-50 border border-gray-300 text-gray-900 rounded-lg shadow-sm focus:ring-[#F75270] focus:border-[#DC143C] p-2.5" required>
                        </div>

                        <div>
                            <label for="tingkat_inflasi" class="flex items-center text-sm font-medium text-gray-600 mb-2">📈 Tingkat Inflasi (%)</label>
                            <input type="number" step="any" name="tingkat_inflasi" placeholder="6.0"
                                value="<?= old('tingkat_inflasi', $input_data['tingkat_inflasi'] ?? '') ?>"
                                class="w-full bg-gray-50 border border-gray-300 text-gray-900 rounded-lg shadow-sm focus:ring-[#F75270] focus:border-[#DC143C] p-2.5" required>
                        </div>

                        <div>
                            <label for="suku_bunga_kredit" class="flex items-center text-sm font-medium text-gray-600 mb-2">🏦 Suku Bunga Kredit (%)</label>
                            <input type="number" step="any" name="suku_bunga_kredit" placeholder="10.0"
                                value="<?= old('suku_bunga_kredit', $input_data['suku_bunga_kredit'] ?? '') ?>"
                                class="w-full bg-gray-50 border border-gray-300 text-gray-900 rounded-lg shadow-sm focus:ring-[#F75270] focus:border-[#DC143C] p-2.5" required>
                        </div>

                        <div>
                            <label for="jumlah_penduduk" class="flex items-center text-sm font-medium text-gray-600 mb-2">👥 Jumlah Penduduk (Juta)</label>
                            <input type="number" step="any" name="jumlah_penduduk" placeholder="14.5"
                                value="<?= old('jumlah_penduduk', $input_data['jumlah_penduduk'] ?? '') ?>"
                                class="w-full bg-gray-50 border border-gray-300 text-gray-900 rounded-lg shadow-sm focus:ring-[#F75270] focus:border-[#DC143C] p-2.5" required>
                        </div>

                        <div>
                            <label for="usia_produktif" class="flex items-center text-sm font-medium text-gray-600 mb-2">💪 Usia Produktif (%)</label>
                            <input type="number" step="any" name="usia_produktif" placeholder="60.0"
                                value="<?= old('usia_produktif', $input_data['usia_produktif'] ?? '') ?>"
                                class="w-full bg-gray-50 border border-gray-300 text-gray-900 rounded-lg shadow-sm focus:ring-[#F75270] focus:border-[#DC143C] p-2.5" required>
                        </div>

                        <div>
                            <label for="tingkat_urbanisasi" class="flex items-center text-sm font-medium text-gray-600 mb-2">🏙️ Tingkat Urbanisasi (%)</label>
                            <input type="number" step="any" name="tingkat_urbanisasi" placeholder="55.0"
                                value="<?= old('tingkat_urbanisasi', $input_data['tingkat_urbanisasi'] ?? '') ?>"
                                class="w-full bg-gray-50 border border-gray-300 text-gray-900 rounded-lg shadow-sm focus:ring-[#F75270] focus:border-[#DC143C] p-2.5" required>
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <button type="submit"
                            class="w-full text-white bg-[#DC143C] hover:bg-[#F75270] focus:ring-4 focus:ring-red-200 font-medium rounded-lg text-lg px-5 py-3 transition duration-300 transform hover:scale-105 shadow-lg">
                            🚀 Jalankan Prediksi
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-white p-6 md:p-8 rounded-xl shadow-2xl border border-gray-200">
                <h2 class="text-2xl font-semibold mb-6 border-b border-gray-200 pb-3 text-gray-800">
                    Hasil Prediksi
                </h2>

                <?php
                $hasil_prediksi = session()->getFlashdata('hasil_prediksi');
                $error_message  = session()->getFlashdata('error_message');
                ?>

                <?php if (isset($hasil_prediksi)): ?>
                    <div class="text-center">
                        <p class="text-gray-600 text-lg">Estimasi Permintaan Mobil:</p>
                        <p class="text-7xl font-bold my-4 text-[#DC143C]">
                            <?= number_format($hasil_prediksi, 0, ',', '.') ?>
                        </p>
                        <p class="text-gray-600">unit</p>

                        <form action="<?= site_url('prediksi/simpan') ?>" method="post" class="mt-8">
                            <?= csrf_field() ?>

                            <input type="hidden" name="pendapatan_per_kapita" value="<?= $input_data['pendapatan_per_kapita'] ?>">
                            <input type="hidden" name="tingkat_inflasi" value="<?= $input_data['tingkat_inflasi'] ?>">
                            <input type="hidden" name="suku_bunga_kredit" value="<?= $input_data['suku_bunga_kredit'] ?>">
                            <input type="hidden" name="jumlah_penduduk" value="<?= $input_data['jumlah_penduduk'] ?>">
                            <input type="hidden" name="usia_produktif" value="<?= $input_data['usia_produktif'] ?>">
                            <input type="hidden" name="tingkat_urbanisasi" value="<?= $input_data['tingkat_urbanisasi'] ?>">
                            <input type="hidden" name="hasil_prediksi" value="<?= $hasil_prediksi ?>">

                            <button type="submit"
                                class="w-full text-[#DC143C] bg-transparent border border-[#DC143C] hover:bg-[#DC143C] hover:text-white font-medium rounded-lg text-md px-5 py-2.5 transition duration-300 shadow-sm">
                                💾 Simpan Hasil Ini
                            </button>
                        </form>

                    </div>

                <?php elseif (isset($error_message)): ?>
                    <div class="bg-red-50 border border-[#DC143C] text-[#DC143C] px-4 py-3 rounded-lg relative" role="alert">
                        <strong class="font-bold">Gagal Melakukan Prediksi</strong>
                        <p class="block sm:inline mt-2"><?= esc($error_message) ?></p>
                    </div>

                <?php else: ?>
                    <div class="text-center text-gray-400">
                        <svg class="mx-auto h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="mt-4 text-lg">Hasil prediksi akan muncul di sini setelah Anda menjalankan Prediksi RF.</p>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>