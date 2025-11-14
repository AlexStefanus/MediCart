-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2025 at 02:35 AM
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
-- Database: `toko_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', '$2y$10$MIaZgPli6vp9LaK09LAhyOL8AQDyuHeiQOPhL3frq1afTiDtV2y66');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `namaLengkap` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `kota` varchar(255) NOT NULL,
  `contact` varchar(15) NOT NULL
  'paypalID' VARCHAR(100) NULL;
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`username`, `password`, `namaLengkap`, `email`, `dob`, `gender`, `alamat`, `kota`, `contact`) VALUES
('alek', '$2y$10$FJ70WHcjaB5PpR3PyuE3gu3zhTZGpv5JTofj/GwTyGwk/VU/Tz.oG', 'Alexander Stefanus Pakpahan', 'alexstefanuspakpahan23@gmail.com', '2004-11-23', 'male', 'Jl. Medokan Asri Tim. IX No.22, Blok RL V J-21, Medokan Ayu, Kec. Rungkut, Surabaya, Jawa Timur 60293', 'Kota Surabaya', '089524093713'),
('noala', '$2y$10$EMM4bU3sFv/yfClMA8N6feL09Hwq0wU0P4EVZsvOvqagguBDdhOvK', 'Noala Kumar', 'noalak@gmail.com', '2003-06-06', 'female', 'medokan gg 1', 'surabaya', '08123456789'),
('syafiqghiffari', '$2y$10$wMTsUwUHO0lKmJgBIuRijuGj5M4ucwWmAg.Wj89j.c3/DV2jQJdPS', 'syafiq', 'syafiqalghiffari03@gmail.com', '2003-12-15', 'male', 'jl. soekarno hatta 7', 'ponorogo', '0895421871034');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `idKeranjang` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `idProduk` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `status` enum('Belum Dibayar','Dibayar','Dibatalkan') NOT NULL,
  `idTransaksi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`idKeranjang`, `username`, `idProduk`, `jumlah`, `harga`, `status`, `idTransaksi`) VALUES
(118, 'noala', 'PRD-1696681976', 1, 40000, 'Dibayar', 'TRS-1727921087'),
(121, 'noala', 'PRD-1696503432', 1, 23000, 'Dibayar', 'TRS-1728011581'),
(122, 'noala', 'PRD-1696569821', 1, 7000, 'Belum Dibayar', ''),
(123, 'noala', 'PRD-1696585133', 1, 325000, 'Belum Dibayar', ''),
(124, 'syafiqghiffari', 'PRD-1696569821', 2, 14000, 'Dibatalkan', 'TRS-1745164702'),
(125, 'syafiqghiffari', 'PRD-1696503432', 1, 23000, 'Dibatalkan', 'TRS-1745164702'),
(126, 'syafiqghiffari', 'PRD-1696585133', 1, 325000, 'Dibatalkan', 'TRS-1745164702'),
(127, 'syafiqghiffari', 'PRD-1728001955', 1, 600000, 'Dibatalkan', 'TRS-1745164702'),
(132, 'syafiqghiffari', 'PRD-1696503432', 1, 23000, 'Dibatalkan', 'TRS-1745190304'),
(133, 'syafiqghiffari', 'PRD-1696569821', 1, 7000, 'Dibatalkan', 'TRS-1745190304'),
(134, 'syafiqghiffari', 'PRD-1696585133', 1, 325000, 'Dibatalkan', 'TRS-1745190304'),
(135, 'syafiqghiffari', 'PRD-1696585133', 1, 325000, 'Dibayar', 'TRS-1745190715'),
(136, 'syafiqghiffari', 'PRD-1696681976', 1, 40000, 'Dibayar', 'TRS-1745190715'),
(137, 'syafiqghiffari', 'PRD-1696569821', 1, 7000, 'Belum Dibayar', ''),
(138, 'syafiqghiffari', 'PRD-1696751145', 1, 425000, 'Belum Dibayar', ''),
(141, 'alek', 'PRD-1696503432', 1, 23000, 'Dibayar', 'TRS-1763083474'),
(142, 'alek', 'PRD-1696585133', 1, 325000, 'Dibayar', 'TRS-1763083474'),
(143, 'alek', 'PRD-1744997405', 1, 10000, 'Dibayar', 'TRS-1763083474');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `idProduk` varchar(255) NOT NULL,
  `namaProduk` varchar(255) NOT NULL,
  `kategoriProduk` varchar(255) NOT NULL,
  `hargaProduk` int(11) NOT NULL,
  `stokProduk` int(11) NOT NULL,
  `gambarProduk` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`idProduk`, `namaProduk`, `kategoriProduk`, `hargaProduk`, `stokProduk`, `gambarProduk`) VALUES
('PRD-1696503432', 'Ponstan 5000', 'Obat dan Suplemen', 23000, 9, '65215147d427f.jpg'),
('PRD-1696569821', 'Ibuprofen', 'Obat dan Suplemen', 7000, 37, '65225dc07e1e9.jpg'),
('PRD-1696585133', 'Oximeter', 'Alat Pemantau Kesehatan', 325000, 2, '65215243b441e.jpg'),
('PRD-1696681878', 'Weifeng Tekken', 'Alat Bantu Jalan', 200000, 10, '65214f964da7b.jpg'),
('PRD-1696681976', 'Stetoskop', 'Peralatan Medis', 40000, 75, '65214ff8837ba.jpg'),
('PRD-1696751145', 'Beurer MG15', 'Alat Terapi dan Rehabilitasi', 425000, 13, '65225e290296f.jpg'),
('PRD-1727930043', 'Paracetamol 500 mg', 'Obat dan Suplemen', 3000, 100, '66fe1ebb65eba.jpg'),
('PRD-1728001955', 'Tensimeter', 'Alat Pemantau Kesehatan', 600000, 5, '66ff37a3116bc.jpg'),
('PRD-1744997405', 'Antasida Doen', 'Obat dan Suplemen', 10000, 36, '68028c1dc1ee0.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `idTransaksi` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `tanggalTransaksi` date NOT NULL,
  `caraBayar` enum('Prepaid','Postpaid') NOT NULL,
  `bank` varchar(255) NOT NULL,
  `statusTransaksi` enum('Pending','Accepted','Rejected','Cancelled') NOT NULL,
  `totalHarga` int(11) NOT NULL,
  `statusPengiriman` enum('Pending','Dalam Perjalanan','Terkirim','Dibatalkan') NOT NULL,
  `feedBack` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`idTransaksi`, `username`, `tanggalTransaksi`, `caraBayar`, `bank`, `statusTransaksi`, `totalHarga`, `statusPengiriman`, `feedBack`) VALUES
('TRS-1727921087', 'noala', '2024-10-03', 'Prepaid', 'Bayar Ditempat', 'Accepted', 40000, 'Terkirim', ''),
('TRS-1728011581', 'noala', '2024-10-04', 'Prepaid', 'Bayar Ditempat', 'Accepted', 23000, 'Dalam Perjalanan', ''),
('TRS-1745164702', 'syafiqghiffari', '2025-04-20', 'Postpaid', '', 'Cancelled', 962000, 'Dibatalkan', ''),
('TRS-1745190304', 'syafiqghiffari', '2025-04-20', 'Prepaid', '', 'Cancelled', 355000, 'Dibatalkan', ''),
('TRS-1745190715', 'syafiqghiffari', '2025-04-20', 'Prepaid', 'BCA', 'Accepted', 365000, 'Terkirim', 'baik sekali'),
('TRS-1763083474', 'alek', '2025-11-14', 'Prepaid', 'BCA', 'Accepted', 358000, 'Terkirim', 'Pengiriman cepat'),
('TRS-19872436', 'syafiqghiffari', '2024-10-14', 'Prepaid', 'Bayar Ditempat', 'Accepted', 45000, 'Pending', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `guestbook`
--
ALTER TABLE `guestbook`
  ADD PRIMARY KEY (`idGuest`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`idKeranjang`),
  ADD KEY `username` (`username`,`idProduk`),
  ADD KEY `idProduk` (`idProduk`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`idProduk`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`idTransaksi`),
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `idKeranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`username`) REFERENCES `customer` (`username`),
  ADD CONSTRAINT `keranjang_ibfk_2` FOREIGN KEY (`idProduk`) REFERENCES `produk` (`idProduk`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`username`) REFERENCES `customer` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
