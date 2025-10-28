-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 28, 2025 at 10:06 AM
-- Server version: 5.7.44
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ppmobil_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `dataset_mobil`
--

CREATE TABLE `dataset_mobil` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bulan_tahun` varchar(10) NOT NULL,
  `pendapatan_per_kapita` decimal(18,2) NOT NULL,
  `tingkat_inflasi` decimal(5,2) NOT NULL,
  `suku_bunga_kredit` decimal(5,2) NOT NULL,
  `jumlah_penduduk` decimal(10,2) NOT NULL,
  `usia_produktif` decimal(10,2) NOT NULL,
  `tingkat_urbanisasi` decimal(5,2) NOT NULL,
  `permintaan_mobil` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `history_prediksi`
--

CREATE TABLE `history_prediksi` (
  `id` int(11) NOT NULL,
  `pendapatan_per_kapita` decimal(15,2) DEFAULT NULL,
  `tingkat_inflasi` decimal(5,2) DEFAULT NULL,
  `suku_bunga_kredit` decimal(5,2) DEFAULT NULL,
  `jumlah_penduduk` decimal(10,2) DEFAULT NULL,
  `usia_produktif` decimal(5,2) DEFAULT NULL,
  `tingkat_urbanisasi` decimal(5,2) DEFAULT NULL,
  `hasil_prediksi` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(12) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`, `nama_lengkap`, `email`, `foto`) VALUES
(5, 'badri', '$2y$10$ufHMCOpxBb4qWPM/DNxFp.iWNGrDq6ACJ.X3zJ1VB32M5vj8cZY1O', 'cek cekkk', 'khbadri22@gmail.com', '1753267234_9fe1376f34640f12d145.png'),
(8, 'alwi', '$2y$10$.5reV2X6wsjO9qBJQZp0bOP9YgZ7ieSvPltgMONhZK8TVL//v3Kci', 'alwi', 'alwi@gmail.com', '1758871250_c08f82ff61370606e844.png'),
(9, 'admin', '$2y$10$XsbW/03O5RH2ku1KU2Pscu377BMAVlBdt.Slcm6zSxXloRahTTqjS', 'sayadmin', 'admin225@gmail.com', '1761645445_818f865943734f813699.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dataset_mobil`
--
ALTER TABLE `dataset_mobil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_prediksi`
--
ALTER TABLE `history_prediksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dataset_mobil`
--
ALTER TABLE `dataset_mobil`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history_prediksi`
--
ALTER TABLE `history_prediksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
