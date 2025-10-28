<?= $this->extend('layout/layout'); ?>
<?= $this->section('content'); ?>

<!-- 
    CSS Kustom untuk animasi
-->
<style>
    /* Animasi gambar naik-turun */
    @keyframes float {
        0% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-20px);
        }

        100% {
            transform: translateY(0px);
        }
    }

    .animate-float {
        animation: float 6s ease-in-out infinite;
    }

    /* [DIHAPUS] CSS animasi mengetik lama sudah tidak diperlukan */

    /* Style tambahan untuk kursor TypewriterJS (opsional) */
    .Typewriter__cursor {
        color: #DC143C;
        /* Sesuaikan warna kursor */
        font-weight: bold;
        animation: blink 0.7s infinite;
    }

    @keyframes blink {
        0% {
            opacity: 1;
        }

        50% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }
</style>

<!-- Container utama menggunakan latar belakang dari layout (krem) -->
<div class="container mx-auto px-4 lg:px-8 py-8 text-gray-800 overflow-x-hidden">

    <!-- ======================= -->
    <!-- Hero Section -->
    <!-- ======================= -->
    <section class="py-16 md:py-24">
        <div class="grid lg:grid-cols-2 gap-6 items-center">

            <!-- Kolom Teks -->
            <div>
                <div>
                    <!-- [PERUBAHAN] H1 diberi ID untuk target JS, wrapper dihapus, warna teks solid -->
                    <h1 id="typewriter-h1" class="text-4xl md:text-5xl font-extrabold text-[#DC143C] leading-tight min-h-[100px] md:min-h-[150px]">
                        <!-- Teks akan diisi oleh JavaScript -->
                    </h1>
                    <p class=" text-lg md:text-xl text-gray-600 max-w-2xl">
                        Sebuah alat bantu berbasis <span class="font-bold text-gray-800">Random Forest</span> untuk membantu strategi bisnis dan pengambilan keputusan yang lebih cerdas.
                    </p>
                    <a href="<?= base_url('/prediksi') ?>" class="mt-8 inline-block bg-[#DC143C] hover:bg-[#F75270] text-white font-bold py-3 px-8 rounded-full transition duration-300 shadow-lg text-lg transform hover:scale-105">
                        Mulai Prediksi
                    </a>
                </div>
            </div>

            <!-- Kolom Gambar dengan Animasi -->
            <div>
                <div class="flex justify-center items-center">
                    <img src="public/mobil.png" alt="Ilustrasi Prediksi Mobil" class="w-full max-w-sm md:max-w-md animate-float">
                </div>
            </div>
        </div>
    </section>

    <!-- Tentang Proyek Section -->
    <section class="py-16">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div class="flex justify-center items-center">
                <div class="rounded-lg">
                    <img src="public/keputusan.png" alt="Strategi Bisnis" class="rounded-lg object-cover w-[300px] h-[300px]">
                </div>
            </div>
            <div>
                <h2 class="text-3xl font-bold text-[#DC143C] mb-4">Mengapa Prediksi Ini Penting?</h2>
                <p class="text-gray-700 mb-4 leading-relaxed">
                    Aplikasi ini bukan sekadar angka. Tujuannya adalah untuk menjadi alat bantu strategis. Memahami estimasi permintaan mobil di masa depan sangat krusial untuk:
                </p>
                <ul class="list-disc list-inside text-gray-700 leading-relaxed space-y-2">
                    <li>Mengoptimalkan <span class="font-semibold">strategi inventaris</span> (stok barang).</li>
                    <li>Menentukan <span class="font-semibold">alokasi budget iklan</span> yang lebih efektif.</li>
                    <li>Mengurangi risiko kelebihan stok (overstock) atau kekurangan (understock).</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Metode Random Forest Section -->
    <section class="py-16 text-center">
        <div>
            <h2 class="text-3xl font-bold text-[#DC143C] mb-4">Bagaimana Cara Kerjanya?</h2>
            <p class="text-gray-700 max-w-3xl mx-auto mb-12">
                Aplikasi ini menggunakan metode Random Forest, sebuah algoritma yang menggabungkan ratusan "Pohon Keputusan" kecil untuk mendapatkan satu prediksi yang kuat dan akurat.
            </p>
        </div>
        <div class="grid sm:grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Step 1 -->
            <div class="bg-white p-8 rounded-lg shadow-xl hover:shadow-pink-100 hover:-translate-y-2 transition-all duration-300 border-t-4 border-[#F75270]">
                <div class="text-[#DC143C] mb-4">
                    <!-- SVG Ikon Pohon -->
                    <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m0-8.5v1.5m-6.364-.364l-1.06-1.06m13.456 1.06l-1.06-1.06M6.343 17.657l-1.06 1.06m13.456-1.06l-1.06 1.06M9 21H3v-6M15 21h6v-6M12 9a3 3 0 100-6 3 3 0 000 6zM15 12a3 3 0 100-6 3 3 0 000 6zM9 12a3 3 0 100-6 3 3 0 000 6z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2">1. Bangun 'Hutan'</h3>
                <p class="text-gray-600">Model dilatih dengan membuat ratusan pohon keputusan, masing-masing melihat data dari sudut pandang acak.</p>
            </div>
            <!-- Step 2 -->
            <div class="bg-white p-8 rounded-lg shadow-xl hover:shadow-pink-100 hover:-translate-y-2 transition-all duration-300 border-t-4 border-[#F75270]">
                <div class="text-[#DC143C] mb-4">
                    <!-- SVG Ikon Ceklis -->
                    <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2">2. Dapatkan Prediksi</h3>
                <p class="text-gray-600">Setiap pohon di dalam 'hutan' memberikan prediksinya sendiri untuk data yang Anda masukkan.</p>
            </div>
            <!-- Step 3 -->
            <div class="bg-white p-8 rounded-lg shadow-xl hover:shadow-pink-100 hover:-translate-y-2 transition-all duration-300 border-t-4 border-[#F75270]">
                <div class="text-[#DC143C] mb-4">
                    <!-- SVG Ikon Kalkulator -->
                    <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 0l-3-3m3 3l-3 3m-6 3h6m0 0l-3 3m3-3l-3-3M6 10h.01M6 14h.01M10 6h.01M14 6h.01M10 18h.01M14 18h.01M4 4h16v16H4V4z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2">3. Ambil Rata-rata</h3>
                <p class="text-gray-600">Hasil akhir adalah rata-rata dari semua prediksi pohon, memberikan estimasi yang lebih stabil dan akurat.</p>
            </div>
        </div>
    </section>

    <!-- Disclaimer Section -->
    <section class="py-16">
        <div>
            <div class="bg-red-50 border border-red-200 rounded-lg shadow-2xl text-center p-8 md:p-12">
                <div class="text-[#DC143C] mb-4">
                    <!-- SVG Ikon Peringatan -->
                    <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.343 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-[#DC143C] mb-4">Penting Untuk Diingat</h2>
                <p class="text-gray-700 max-w-3xl mx-auto">
                    Hasil dari aplikasi ini bersifat prediktif dan edukatif, bukan merupakan jaminan finansial atau bisnis. Model ini didasarkan pada data historis dan tidak dapat memperhitungkan semua faktor eksternal yang tidak terduga. Gunakan hasil ini sebagai salah satu pertimbangan dalam strategi Anda, bukan sebagai satu-satunya penentu keputusan.
                </p>
            </div>
        </div>
    </section>

</div>

<!-- [BARU] Tambahkan script library TypewriterJS -->
<script src="https://unpkg.com/typewriter-effect@latest/dist/core.js"></script>

<!-- [BARU] Script untuk inisialisasi TypewriterJS -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const typewriterElement = document.getElementById('typewriter-h1');

        if (typewriterElement) {
            const typewriter = new Typewriter(typewriterElement, {
                loop: true, // Agar animasi berulang
                delay: 75, // Kecepatan mengetik (ms)
                deleteSpeed: 50 // Kecepatan menghapus (ms)
            });

            typewriter
                .typeString('Memprediksi Masa Depan') // Teks pertama
                .pauseFor(300)
                .typeString(' Permintaan Mobil') // Lanjutkan teks pertama
                .pauseFor(2500) // Jeda sebelum menghapus
                .deleteAll() // Hapus semua teks
                .typeString('Analisis Tren Pasar Otomotif') // Teks alternatif
                .pauseFor(2500)
                .deleteAll()
                .typeString('Strategi Bisnis Berbasis Data') // Teks alternatif lain
                .pauseFor(2500)
                .start();
        }
    });
</script>

<?= $this->endSection(); ?>