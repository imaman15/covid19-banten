-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2020 at 06:44 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbcovid`
--

-- --------------------------------------------------------

--
-- Table structure for table `covid`
--

CREATE TABLE `covid` (
  `id_covid` int(11) NOT NULL,
  `odp` int(11) NOT NULL,
  `pdp` int(11) NOT NULL,
  `positif` int(11) NOT NULL,
  `sembuh` int(11) NOT NULL,
  `meninggal` int(11) NOT NULL,
  `tgl_publish` datetime NOT NULL,
  `tgl_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_district` int(11) NOT NULL,
  `id_subdistrict` int(11) NOT NULL,
  `id_users` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `covid`
--

INSERT INTO `covid` (`id_covid`, `odp`, `pdp`, `positif`, `sembuh`, `meninggal`, `tgl_publish`, `tgl_update`, `id_district`, `id_subdistrict`, `id_users`) VALUES
(1, 2300, 3200, 3200, 3250, 3310, '2020-04-18 21:05:51', '2020-04-18 15:11:09', 1, 2, 2),
(2, 1000, 1000, 1000, 1000, 1000, '2020-04-18 21:02:59', '2020-04-18 15:11:09', 1, 2, 2),
(3, 320, 320, 120, 330, 320, '2020-04-09 00:00:00', '2020-04-18 15:11:09', 4, 4, 2),
(4, 2000, 2000, 2000, 3000, 4000, '2020-04-18 21:04:25', '2020-04-18 15:11:09', 1, 2, 2),
(5, 2333, 3232, 3232, 3233, 3232, '2020-04-17 00:00:00', '2020-04-18 15:11:09', 1, 2, 2),
(6, 2343, 3234, 3434, 4323, 4344, '2020-04-16 00:00:00', '2020-04-18 15:11:09', 4, 4, 2),
(7, 4343, 4444, 4324, 4343, 4343, '2020-04-05 00:00:00', '2020-04-18 15:14:56', 1, 2, 2),
(8, 4300, 4300, 4300, 4300, 4300, '2020-04-17 00:00:00', '2020-04-18 15:19:16', 1, 2, 2),
(9, 1000, 320, 320, 320, 320, '2020-04-14 00:00:00', '2020-04-18 16:16:43', 2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `id_district` int(11) NOT NULL,
  `nama_district` varchar(128) NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`id_district`, `nama_district`, `slug`) VALUES
(1, 'Kabupaten Pandeglang', 'kabupaten-pandeglang.html'),
(2, 'Kabupaten Lebak', 'kabupaten-lebak.html'),
(3, 'Kota Serang', 'kota-serang.html'),
(4, 'Kabupaten Serang', 'kabupaten-serang.html'),
(5, 'Kabupaten Tangerang Selatan', 'kabupaten-tangerang-selatan.html');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id_news` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `content` text NOT NULL,
  `slug` varchar(255) NOT NULL,
  `kategori` int(1) NOT NULL,
  `img` varchar(256) NOT NULL,
  `tgl_publish` datetime NOT NULL,
  `tgl_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_users` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subdistrict`
--

CREATE TABLE `subdistrict` (
  `id_subdistrict` int(11) NOT NULL,
  `nama_subdistrict` varchar(128) NOT NULL,
  `id_district` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subdistrict`
--

INSERT INTO `subdistrict` (`id_subdistrict`, `nama_subdistrict`, `id_district`) VALUES
(1, 'Rangkasbitung', 2),
(2, 'Pandeglang', 1),
(3, 'Taktakan', 3),
(4, 'Ciruas', 4),
(5, 'Cibadak', 2),
(6, 'Maja', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `name` varchar(128) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `photo` varchar(128) NOT NULL,
  `desc` text,
  `status` int(1) NOT NULL COMMENT '1 = Administrator, 2 = Relawan',
  `active` int(1) NOT NULL COMMENT '0 = Tidak Aktif, 1 = Aktif, 2 = Blokir',
  `date_created` int(11) NOT NULL,
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `email`, `password`, `name`, `phone`, `photo`, `desc`, `status`, `active`, `date_created`, `date_update`) VALUES
(1, 'imamagustiannugraha@ymail.com', '$2y$10$UoH0.7GTDJD55fJpX.7Um.sOrXUwzN0KUuFxJDubfJ9n22mO7uoru', 'Imam Agustian Nugraha', '+62089671843158', 'default.jpg', NULL, 1, 1, 1580968149, '2020-04-02 15:38:01'),
(2, 'tbfajri@gmail.com', '$2y$10$UoH0.7GTDJD55fJpX.7Um.sOrXUwzN0KUuFxJDubfJ9n22mO7uoru', 'Tb. Fajri Mulyana', '+6289671843158', 'default.jpg', NULL, 2, 1, 1580968149, '2020-04-10 08:25:11'),
(3, 'admin@gmail.com', '$2y$10$0w9ZZBr.33DC0O8OjL5my.ETcEFphE5SoBT7cBV9WD2MygMZYQ4Ou', 'Administrator', '+6287724100331', 'default.jpg', NULL, 1, 1, 1587215210, '2020-04-19 16:42:39'),
(4, 'tbaimunandar@gmail.com', '$2y$10$o8E6bLkVPM.fINZm8xNpV.W/IKMK4kTyU3vajZEVOTBIwwsJg91ZS', 'TB Ai Munandar', '+628123456789', 'default.jpg', NULL, 1, 1, 1587215561, '2020-04-19 16:43:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `covid`
--
ALTER TABLE `covid`
  ADD PRIMARY KEY (`id_covid`),
  ADD KEY `id_district` (`id_district`),
  ADD KEY `id_subdistrict` (`id_subdistrict`),
  ADD KEY `id_users` (`id_users`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`id_district`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id_news`),
  ADD KEY `id_users` (`id_users`);

--
-- Indexes for table `subdistrict`
--
ALTER TABLE `subdistrict`
  ADD PRIMARY KEY (`id_subdistrict`),
  ADD KEY `id_district` (`id_district`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `covid`
--
ALTER TABLE `covid`
  MODIFY `id_covid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `id_district` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id_news` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `subdistrict`
--
ALTER TABLE `subdistrict`
  MODIFY `id_subdistrict` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
