<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'RF Permintaan Mobil App') ?></title>

    <!-- Scripts (Tailwind & Alpine.js) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@alpinejs/intersect@3.x.x/dist/cdn.min.js" defer></script>
    <script src="//unpkg.com/alpinejs" defer></script>

    <!-- Style untuk Page Loader -->
    <style>
        #page-loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #FDEBD0;
            /* Krem */
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: opacity 0.5s, visibility 0.5s;
        }

        #page-loader.hidden {
            opacity: 0;
            visibility: hidden;
        }

        .spinner {
            border: 8px solid #FADBD8;
            /* Light Pink/Krem */
            border-top: 8px solid #DC143C;
            /* Merah Tua */
            border-radius: 50%;
            width: 80px;
            height: 80px;
            animation: spin 1.5s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<!-- [PERUBAHAN] Tambahkan x-init="init()" untuk setup listener event -->

<body class="bg-[#FDEBD0] text-gray-800 antialiased" x-data="layoutData()" x-init="init()">

    <!-- Page Loader -->
    <div id="page-loader">
        <div class="spinner"></div>
    </div>

    <!-- Container Notifikasi Toast (HTML tidak berubah) -->
    <div x-show="toast.show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform -translate-y-full"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform -translate-y-full"
        class="fixed top-0 left-0 right-0 z-[100] flex justify-center pt-5 px-4"
        x-cloak>
        <div class="w-full max-w-sm bg-[#F75270] text-white text-sm font-medium px-4 py-3 rounded-lg shadow-lg flex items-center justify-between">
            <span x-text="toast.message"></span>
            <button @click="toast.show = false" class="ml-4 text-white hover:text-gray-200">
                &times;
            </button>
        </div>
    </div>


    <div class="min-h-screen flex flex-col">

        <!-- NAVBAR (Tidak berubah) -->
        <nav x-data="{ mobileMenuOpen: false, profileMenuOpen: false }" class="bg-white shadow-lg sticky top-0 z-50">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <div class="flex items-center">
                        <a href="<?= base_url('/') ?>" class="flex-shrink-0 flex items-center gap-3">
                            <svg class="h-8 w-8 text-[#DC143C]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v16.5h16.5M3.75 19.5h16.5M5.625 9.75h12.75M6 13.125h12M18.375 3l-3.75 3.75-3-3-3.75 3.75-3-3.75" />
                            </svg>
                            <span class="text-[#DC143C] text-xl font-bold tracking-wider hidden sm:block">RF Prediksi Permintaan Mobil</span>
                        </a>
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-4">
                            <a href="<?= base_url('/') ?>" class="transition duration-300 px-3 py-2 rounded-md text-sm font-medium <?= ($active_menu ?? '') === 'home' ? 'bg-[#FDEBD0] text-[#DC143C]' : 'text-gray-600 hover:bg-[#FDEBD0] hover:text-[#DC143C]' ?>">Home</a>
                            <a href="<?= base_url('/dataset') ?>" class="transition duration-300 px-3 py-2 rounded-md text-sm font-medium <?= ($active_menu ?? '') === 'dataset' ? 'bg-[#FDEBD0] text-[#DC143C]' : 'text-gray-600 hover:bg-[#FDEBD0] hover:text-[#DC143C]' ?>">Dataset</a>
                            <a href="<?= base_url('/prediksi') ?>" class="transition duration-300 px-3 py-2 rounded-md text-sm font-medium <?= ($active_menu ?? '') === 'prediksi' ? 'bg-[#FDEBD0] text-[#DC143C]' : 'text-gray-600 hover:bg-[#FDEBD0] hover:text-[#DC143C]' ?>">Prediksi</a>
                            <a href="<?= base_url('/history') ?>" class="transition duration-300 px-3 py-2 rounded-md text-sm font-medium <?= ($active_menu ?? '') === 'history' ? 'bg-[#FDEBD0] text-[#DC143C]' : 'text-gray-600 hover:bg-[#FDEBD0] hover:text-[#DC143C]' ?>">History</a>
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-4 flex items-center md:ml-6">
                            <div class="relative">
                                <button @click="profileMenuOpen = !profileMenuOpen" type="button" class="max-w-xs bg-gray-100 rounded-full flex items-center text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-[#DC143C]"><span class="sr-only">Buka menu pengguna</span><img class="h-8 w-8 rounded-full object-cover" src="<?= base_url('uploads/foto_profil/' . esc(session()->get('foto'))) ?>" alt="Foto Profil"></button>
                                <div x-show="profileMenuOpen" @click.away="profileMenuOpen = false" x-transition class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" x-cloak>
                                    <div class="px-4 py-2 border-b border-gray-200">
                                        <p class="text-sm font-semibold text-gray-800"><?= esc(session()->get('username')) ?></p>
                                        <p class="text-xs text-gray-500">User</p>
                                    </div>
                                    <a href="<?= base_url('/akun') ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Pengaturan Akun</a>
                                    <a href="<?= site_url('logout') ?>" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="-mr-2 flex md:hidden">
                        <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="bg-gray-100 inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:text-[#DC143C] hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-[#DC143C]"><span class="sr-only">Buka menu utama</span><svg class="h-6 w-6" :class="{'hidden': mobileMenuOpen, 'block': !mobileMenuOpen }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg><svg class="h-6 w-6" :class="{'block': mobileMenuOpen, 'hidden': !mobileMenuOpen }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg></button>
                    </div>
                </div>
            </div>
            <div x-show="mobileMenuOpen" class="md:hidden bg-white" x-cloak>
                <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                    <a href="<?= base_url('/') ?>" class="transition duration-300 block px-3 py-2 rounded-md text-base font-medium <?= ($active_menu ?? '') === 'home' ? 'bg-[#FDEBD0] text-[#DC143C]' : 'text-gray-600 hover:bg-[#FDEBD0] hover:text-[#DC143C]' ?>">Home</a>
                    <a href="<?= base_url('/dataset') ?>" class="transition duration-300 block px-3 py-2 rounded-md text-base font-medium <?= ($active_menu ?? '') === 'dataset' ? 'bg-[#FDEBD0] text-[#DC143C]' : 'text-gray-600 hover:bg-[#FDEBD0] hover:text-[#DC143C]' ?>">Dataset</a>
                    <a href="<?= base_url('/prediksi') ?>" class="transition duration-300 block px-3 py-2 rounded-md text-base font-medium <?= ($active_menu ?? '') === 'prediksi' ? 'bg-[#FDEBD0] text-[#DC143C]' : 'text-gray-600 hover:bg-[#FDEBD0] hover:text-[#DC143C]' ?>">Prediksi</a>
                    <a href="<?= base_url('/history') ?>" class="transition duration-300 block px-3 py-2 rounded-md text-base font-medium <?= ($active_menu ?? '') === 'history' ? 'bg-[#FDEBD0] text-[#DC143C]' : 'text-gray-600 hover:bg-[#FDEBD0] hover:text-[#DC143C]' ?>">History</a>
                </div>
                <div class="pt-4 pb-3 border-t border-gray-200">
                    <div class="flex items-center px-5">
                        <div class="flex-shrink-0"><img class="h-10 w-10 rounded-full object-cover" src="<?= base_url('uploads/foto_profil/' . esc(session()->get('foto'))) ?>" alt="Foto Profil"></div>
                        <div class="ml-3">
                            <div class="text-base font-medium leading-none text-gray-800"><?= esc(session()->get('username')) ?></div>
                            <div class="text-sm font-medium leading-none text-gray-500">User</div>
                        </div>
                    </div>
                    <div class="mt-3 px-2 space-y-1">
                        <a href="<?= base_url('/akun') ?>" class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-[#DC143C] hover:bg-[#FDEBD0]">Pengaturan Akun</a>
                        <a href="<?= site_url('logout') ?>" class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-[#DC143C] hover:bg-[#FDEBD0]">Logout</a>
                    </div>
                </div>
            </div>
        </nav>
        <!-- END: NAVBAR -->

        <!-- Konten Utama Aplikasi -->
        <main class="flex-1 w-full">
            <?= $this->renderSection('content') ?>
        </main>

    </div>

    <!-- Script Alpine.js untuk Notifikasi -->
    <script>
        function layoutData() {
            return {
                toast: {
                    show: false,
                    message: '',
                    timeout: null
                },
                // Fungsi showToast tetap sama
                showToast(message, duration = 3000) {
                    clearTimeout(this.toast.timeout);
                    this.toast.message = message;
                    this.toast.show = true;
                    this.toast.timeout = setTimeout(() => {
                        this.toast.show = false;
                    }, duration);
                },
                // [BARU] Fungsi init untuk setup listener
                init() {
                    // Mendengarkan event 'show-toast' dari window
                    window.addEventListener('show-toast', event => {
                        // Memanggil showToast dengan data dari event
                        this.showToast(event.detail.message);
                    });
                }
            }
        }

        window.addEventListener('load', function() {
            document.getElementById('page-loader').classList.add('hidden');
        });

        // [PERUBAHAN] Menggunakan Custom Event untuk memicu notifikasi
        <?php if ($success = session()->getFlashdata('success')) : ?>
            // Sedikit jeda agar Alpine siap
            setTimeout(() => {
                // Dispatch event 'show-toast' dengan pesan dari flashdata
                window.dispatchEvent(new CustomEvent('show-toast', {
                    detail: {
                        message: '<?= esc($success, 'js') ?>'
                    }
                }));
            }, 100);
        <?php endif; ?>
    </script>

</body>

</html>