<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- [PERUBAHAN] Judul disesuaikan -->
    <title>Login | RF Prediksi Permintaan Mobil</title>
    <!-- [PERUBAHAN] Hapus SweetAlert, tambahkan Alpine.js -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>

    <!-- [BARU] Style untuk notifikasi toast (minimalis) -->
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<!-- [PERUBAHAN] Body diubah ke bg-[#FDEBD0] dan setup Alpine -->

<body class="bg-[#FDEBD0] min-h-screen flex items-center justify-center p-4" x-data="loginPageData()">

    <!-- [BARU] Container Notifikasi Toast (mirip layout.php) -->
    <div x-show="toast.show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform -translate-y-full"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform -translate-y-full"
        class="fixed top-0 left-0 right-0 z-[100] flex justify-center pt-5 px-4"
        x-cloak>
        <!-- Warna disesuaikan untuk error (merah tua), bisa diubah jika perlu -->
        <div class="w-full max-w-sm bg-[#DC143C] text-white text-sm font-medium px-4 py-3 rounded-lg shadow-lg flex items-center justify-between">
            <span x-text="toast.message"></span>
            <button @click="toast.show = false" class="ml-4 text-white hover:text-gray-200">
                &times;
            </button>
        </div>
    </div>

    <!-- [PERUBAHAN] Layout diubah ke satu kartu putih terpusat -->
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md overflow-hidden border border-gray-200">
        <div class="p-8 lg:p-12">

            <!-- Header Form -->
            <div class="text-center mb-8">
                <!-- Ikon disesuaikan -->
                <svg class="h-12 w-12 text-[#DC143C] mx-auto mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v16.5h16.5M3.75 19.5h16.5M5.625 9.75h12.75M6 13.125h12M18.375 3l-3.75 3.75-3-3-3.75 3.75-3-3.75" />
                </svg>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-800 mb-2">Selamat Datang</h1>
                <!-- Teks disesuaikan -->
                <p class="text-gray-500 text-sm">Masuk ke akun Prediksi Permintaan Mobil Anda.</p>
            </div>

            <!-- Form Login -->
            <form action="<?= base_url('/login') ?>" method="post" class="space-y-5">
                <?= csrf_field() ?>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">Username</label>
                    <!-- Input disesuaikan ke tema terang -->
                    <input type="text" name="username" required
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#F75270] focus:border-[#DC143C] transition"
                        placeholder="Masukkan username Anda">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">Password</label>
                    <input type="password" name="password" required
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#F75270] focus:border-[#DC143C] transition"
                        placeholder="Masukkan password Anda">
                </div>

                <!-- Tombol disesuaikan -->
                <button type="submit"
                    class="w-full bg-[#DC143C] text-white py-3 rounded-lg hover:bg-[#F75270] transition-colors duration-300 font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    Masuk
                </button>

                <!-- Link Register -->
                <div class="text-center pt-3">
                    <p class="text-gray-500 text-sm">
                        Belum punya akun?
                        <!-- Link disesuaikan warnanya -->
                        <a href="<?= site_url('register') ?>" class="text-[#DC143C] hover:text-[#F75270] font-medium">
                            Daftar di sini
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <!-- [BARU] Script Alpine.js untuk Notifikasi -->
    <script>
        function loginPageData() {
            return {
                toast: {
                    show: false,
                    message: '',
                    timeout: null
                },
                showToast(message, duration = 3500) { // Durasi diperpanjang sedikit untuk error
                    clearTimeout(this.toast.timeout);
                    this.toast.message = message;
                    this.toast.show = true;
                    this.toast.timeout = setTimeout(() => {
                        this.toast.show = false;
                    }, duration);
                }
                // Tidak perlu init() karena kita panggil langsung dari PHP
            }
        }

        // Panggil showToast jika ada flashdata error
        <?php if ($errorMessage = session()->getFlashdata('error')) : ?>
            // Sedikit jeda agar Alpine siap
            setTimeout(() => {
                // Akses data Alpine dari body dan panggil showToast
                document.querySelector('body').__x.$data.showToast('<?= esc($errorMessage, 'js') ?>');
            }, 100);
        <?php endif; ?>

        // Redirect jika ada flashdata success (setelah register/logout)
        <?php if ($successMessage = session()->getFlashdata('success')) : ?>
            // Tampilkan notifikasi sukses sebentar lalu redirect
            setTimeout(() => {
                document.querySelector('body').__x.$data.showToast('<?= esc($successMessage, 'js') ?>', 2000); // Tampilkan 2 detik
                setTimeout(() => {
                    // Redirect ke home setelah notifikasi sukses
                    window.location.href = "<?= base_url('/') ?>"; // Arahkan ke home setelah sukses
                }, 2100); // Redirect setelah toast hilang
            }, 100);
        <?php endif; ?>
    </script>

</body>

</html>