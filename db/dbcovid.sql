-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 17, 2020 at 02:38 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

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
  `slug` varchar(255) NOT NULL,
  `odp` int(11) NOT NULL,
  `pdp` int(11) NOT NULL,
  `positif` int(11) NOT NULL,
  `sembuh` int(11) NOT NULL,
  `meninggal` int(11) NOT NULL,
  `tgl_publish` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_district` int(11) NOT NULL,
  `id_subdistrict` int(11) NOT NULL,
  `id_users` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `covid`
--

INSERT INTO `covid` (`id_covid`, `slug`, `odp`, `pdp`, `positif`, `sembuh`, `meninggal`, `tgl_publish`, `id_district`, `id_subdistrict`, `id_users`) VALUES
(1, 'kabupaten-lebak.html', 23, 32, 32, 32, 331, '2020-04-15 18:54:45', 2, 1, 2),
(2, 'kabupaten-pandeglang.html', 23, 23, 12, 112, 32, '2020-04-16 18:55:02', 1, 2, 2),
(3, 'kabupaten-pandeglang.html', 32, 32, 12, 33, 32, '2020-04-16 19:09:45', 1, 2, 2),
(4, 'kabupaten-pandeglang.html', 1233, 3213, 3233, 3233, 32333, '2020-04-15 19:22:13', 1, 2, 2);

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
  `tgl_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
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
(4, 'Ciruas', 4);

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
  `desc` text DEFAULT NULL,
  `status` int(1) NOT NULL COMMENT '1 = Administrator, 2 = Relawan',
  `active` int(1) NOT NULL COMMENT '0 = Tidak Aktif, 1 = Aktif, 2 = Blokir',
  `date_created` int(11) NOT NULL,
  `date_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `email`, `password`, `name`, `phone`, `photo`, `desc`, `status`, `active`, `date_created`, `date_update`) VALUES
(1, 'imamagustiannugraha@ymail.com', '$2y$10$UoH0.7GTDJD55fJpX.7Um.sOrXUwzN0KUuFxJDubfJ9n22mO7uoru', 'Imam Agustian Nugraha', '+62089671843158', 'default.jpg', NULL, 1, 1, 1580968149, '2020-04-02 15:38:01'),
(2, 'tbfajri@gmail.com', '$2y$10$UoH0.7GTDJD55fJpX.7Um.sOrXUwzN0KUuFxJDubfJ9n22mO7uoru', 'Tb. Fajri Mulyana', '+6289671843158', 'default.jpg', NULL, 2, 1, 1580968149, '2020-04-10 08:25:11');

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
  MODIFY `id_covid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `id_district` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id_news` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subdistrict`
--
ALTER TABLE `subdistrict`
  MODIFY `id_subdistrict` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
