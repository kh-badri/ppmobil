<?= $this->extend('layout/layout'); ?>
<?= $this->section('content'); ?>

<!-- [PERUBAHAN] Container utama menggunakan latar belakang dari layout (krem) -->
<div class="container mx-auto p-4 lg:p-8 text-gray-800">

    <!-- [PERUBAHAN] Judul disesuaikan dengan palet warna -->
    <h1 class="text-4xl font-bold mb-6 text-[#DC143C] border-b border-gray-200 pb-4">Akun Saya</h1>

    <!-- [PERUBAHAN] Notifikasi disesuaikan dengan palet warna -->
    <?php if (session()->getFlashdata('errors')) : ?>
        <div class="bg-red-100 border-l-4 border-[#DC143C] text-[#DC143C] p-4 mb-6 rounded-md shadow-lg" role="alert">
            <p class="font-bold">Gagal Memperbarui</p>
            <ul class="mt-2 list-disc list-inside text-sm">
                <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- [PERUBAHAN LAYOUT] Diubah ke grid 2 kolom (50/50) -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        <!-- Kolom Informasi Profil -->
        <!-- [PERUBAHAN LAYOUT] 'lg:col-span-2' dihapus -->
        <div>
            <!-- [PERUBAHAN] Kartu diubah ke bg-white -->
            <div class="bg-white p-6 rounded-xl shadow-2xl border border-gray-200 h-full">
                <h2 class="text-xl font-semibold mb-6 text-gray-800">Informasi Profil</h2>
                <form action="<?= site_url('akun/update_profil') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-6 mb-6">
                        <!-- [PERUBAHAN] Border foto diubah ke pink -->
                        <img class="h-24 w-24 rounded-full object-cover border-4 border-[#F75270]" src="<?= base_url('uploads/foto_profil/' . esc($user['foto'])) ?>" alt="Foto Profil">
                        <div>
                            <label for="foto" class="block text-sm font-medium text-gray-600">Ganti Foto</label>
                            <!-- [PERUBAHAN] Tombol file disesuaikan dengan palet warna -->
                            <input type="file" name="foto" id="foto" class="mt-1 block w-full text-sm text-gray-600
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-lg file:border-0 file:text-sm file:font-semibold
                                file:bg-[#FDEBD0] file:text-[#DC143C]
                                hover:file:bg-[#F75270] hover:file:text-white transition cursor-pointer">
                            <p class="text-xs text-gray-500 mt-1">PNG, JPG, JPEG (MAX. 1MB)</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label for="username" class="block text-sm font-medium text-gray-600">Username</label>
                            <!-- [PERUBAHAN] Input disabled diubah ke tema terang -->
                            <input type="text" id="username" value="<?= esc($user['username']) ?>" class="w-full px-4 py-3 mt-1 border border-gray-300 rounded-lg bg-gray-100 text-gray-500 cursor-not-allowed" disabled>
                        </div>
                        <div>
                            <label for="nama_lengkap" class="block text-sm font-medium text-gray-600">Nama Lengkap</label>
                            <!-- [PERUBAHAN] Input diubah ke tema terang -->
                            <input type="text" name="nama_lengkap" id="nama_lengkap" value="<?= esc($user['nama_lengkap']) ?>" class="w-full px-4 py-3 mt-1 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#F75270] focus:border-[#DC143C] transition">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
                            <input type="email" name="email" id="email" value="<?= esc($user['email']) ?>" class="w-full px-4 py-3 mt-1 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#F75270] focus:border-[#DC143C] transition">
                        </div>
                    </div>

                    <!-- [PERUBAHAN] Tombol diubah ke palet warna -->
                    <button type="submit" class="w-full mt-6 py-3 bg-[#DC143C] text-white font-semibold rounded-lg hover:bg-[#F75270] transition duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">Simpan Perubahan Profil</button>
                </form>
            </div>
        </div>

        <!-- Kolom Ganti Password -->
        <div>
            <!-- [PERUBAHAN] Kartu diubah ke bg-white -->
            <div class="bg-white p-6 rounded-xl shadow-2xl border border-gray-200 h-full">
                <h2 class="text-xl font-semibold mb-6 text-gray-800">Ganti Password</h2>
                <form action="<?= site_url('akun/update_sandi') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="space-y-4">
                        <div>
                            <label for="password_lama" class="block text-sm font-medium text-gray-600">Password Lama</label>
                            <input type="password" name="password_lama" id="password_lama" class="w-full px-4 py-3 mt-1 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#F75270] focus:border-[#DC143C] transition" required>
                        </div>
                        <div>
                            <label for="password_baru" class="block text-sm font-medium text-gray-600">Password Baru</label>
                            <input type="password" name="password_baru" id="password_baru" class="w-full px-4 py-3 mt-1 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#F75270] focus:border-[#DC143C] transition" required>
                        </div>
                        <div>
                            <label for="konfirmasi_password" class="block text-sm font-medium text-gray-600">Konfirmasi Password Baru</label>
                            <input type="password" name="konfirmasi_password" id="konfirmasi_password" class="w-full px-4 py-3 mt-1 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#F75270] focus:border-[#DC143C] transition" required>
                        </div>
                    </div>
                    <!-- [PERUBAHAN] Tombol diubah ke palet warna -->
                    <button type="submit" class="w-full mt-6 py-3 bg-[#DC143C] text-white font-semibold rounded-lg hover:bg-[#F75270] transition duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">Ubah Password</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>