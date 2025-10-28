<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- [PERUBAHAN] Judul disesuaikan -->
    <title>Register | RF Prediksi Permintaan Mobil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- [BARU] Style minimalis -->
    <style>
        [x-cloak] {
            display: none !important;
        }

        /* Jika Anda memakai Alpine nanti */
    </style>
</head>

<!-- [PERUBAHAN] Body diubah ke bg-[#FDEBD0] -->

<body class="bg-[#FDEBD0] min-h-screen flex items-center justify-center p-4">

    <!-- [PERUBAHAN] Layout diubah ke satu kartu putih terpusat -->
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md overflow-hidden border border-gray-200">
        <div class="p-8 lg:p-12">

            <!-- Header Form -->
            <div class="text-center mb-6">
                <!-- Ikon disesuaikan -->
                <svg class="h-12 w-12 text-[#DC143C] mx-auto mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                </svg>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-800 mb-2">Buat Akun Baru</h1>
                <p class="text-gray-500 text-sm">Isi data di bawah untuk mendaftar.</p>
            </div>

            <!-- [PERUBAHAN] Notifikasi Error Validasi disesuaikan warnanya -->
            <?php $validation = \Config\Services::validation(); ?>
            <?php if (session()->getFlashdata('error') || $validation->getErrors()) : ?>
                <div class="bg-red-100 border-l-4 border-[#DC143C] text-[#DC143C] px-4 py-3 rounded-lg relative mb-4 text-sm" role="alert">
                    <strong class="font-bold">Terjadi Kesalahan:</strong>
                    <ul class="list-disc list-inside mt-1">
                        <?php if ($errorMsg = session()->getFlashdata('error')) : ?>
                            <li><?= esc($errorMsg) ?></li>
                        <?php else : ?>
                            <?php foreach ($validation->getErrors() as $error) : ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach ?>
                        <?php endif; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- Form Register -->
            <form action="<?= site_url('register') ?>" method="post" class="space-y-4">
                <?= csrf_field() ?>
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-600 mb-2">Username</label>
                    <!-- Input disesuaikan -->
                    <input type="text" name="username" id="username" required value="<?= old('username') ?>"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#F75270] focus:border-[#DC143C] transition">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-600 mb-2">Password</label>
                    <input type="password" name="password" id="password" required
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#F75270] focus:border-[#DC143C] transition">
                </div>

                <div>
                    <label for="password_confirm" class="block text-sm font-medium text-gray-600 mb-2">Konfirmasi Password</label>
                    <input type="password" name="password_confirm" id="password_confirm" required
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#F75270] focus:border-[#DC143C] transition">
                </div>

                <!-- Tombol Register disesuaikan -->
                <button type="submit"
                    class="w-full bg-[#DC143C] text-white py-3 mt-2 rounded-lg hover:bg-[#F75270] transition-colors duration-300 font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    Daftar
                </button>

                <!-- Link Login disesuaikan -->
                <div class="text-center pt-3">
                    <p class="text-gray-500 text-sm">
                        Sudah punya akun?
                        <a href="<?= site_url('login') ?>" class="text-[#DC143C] hover:text-[#F75270] font-medium">
                            Login di sini
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <!-- Script notifikasi tidak diperlukan di sini karena redirect ke login setelah sukses -->

</body>

</html>