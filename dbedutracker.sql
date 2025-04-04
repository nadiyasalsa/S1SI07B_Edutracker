-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2025 at 04:36 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbedutracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `daftartugas`
--

CREATE TABLE `daftartugas` (
  `id_tugas` int(15) NOT NULL,
  `mata_kuliah` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `deadline` date NOT NULL,
  `jenis` enum('Tugas Harian','Quis','Ujian','Proyek') NOT NULL,
  `status` enum('Selesai','Belum Selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daftartugas`
--

INSERT INTO `daftartugas` (`id_tugas`, `mata_kuliah`, `deskripsi`, `deadline`, `jenis`, `status`) VALUES
(1, 'Pengembagan web', 'Membuat CRUD', '2025-03-11', 'Proyek', 'Belum Selesai'),
(4, 'Rekayasa Bisnis', 'Membuat BPMN', '2025-03-12', 'Proyek', 'Belum Selesai'),
(5, 'Stastistika Industri', 'Distribusi Sampel', '2025-03-14', 'Quis', 'Belum Selesai'),
(6, 'Manajemen SDM', 'Assigment 1', '2025-03-05', 'Tugas Harian', 'Selesai'),
(7, 'Pengujian Sistem', 'Blackbox Testing', '2025-03-06', 'Tugas Harian', 'Selesai');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daftartugas`
--
ALTER TABLE `daftartugas`
  ADD PRIMARY KEY (`id_tugas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daftartugas`
--
ALTER TABLE `daftartugas`
  MODIFY `id_tugas` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
