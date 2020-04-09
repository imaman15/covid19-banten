-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 09, 2020 at 08:42 PM
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

INSERT INTO `covid` (`id_covid`, `odp`, `pdp`, `positif`, `sembuh`, `meninggal`, `tgl_publish`, `id_district`, `id_subdistrict`, `id_users`) VALUES
(1, 3, 40, 3, 32, 4, '2020-04-05 05:00:17', 1, 1, 2),
(2, 34, 43, 32, 44, 43, '2020-04-05 12:42:28', 2, 1, 2),
(3, 34, 44, 43, 43, 43, '2020-04-05 10:51:14', 1, 1, 2),
(4, 45, 45, 44, 33, 34, '2020-04-09 15:09:02', 1, 2, 2),
(5, 33, 23, 55, 43, 34, '2020-04-05 11:43:36', 1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `id_district` int(11) NOT NULL,
  `nama_district` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`id_district`, `nama_district`) VALUES
(1, 'Serang'),
(2, 'Lebak'),
(3, 'Pandeglang');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id_news` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `content` text NOT NULL,
  `kategori` int(1) NOT NULL,
  `img` varchar(256) NOT NULL,
  `tgl_publish` datetime NOT NULL,
  `tgl_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_users` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id_news`, `title`, `content`, `kategori`, `img`, `tgl_publish`, `tgl_update`, `id_users`) VALUES
(1, 'Cegah corona', 'Data base Lorem ipsum dolor sit amet consectetur adipisicing elit. Non odit ab nam nobis perferendis, officiis magnam alias blanditiis distinctio iure, harum nostrum repudiandae voluptates labore, modi inventore magni nulla corporis! This card uses Bootstrap\'s default styling with no utility classes added. Global styles are the only things modifying the look and feel of this default card example. Lorem ipsum dolor sit amet consectetur adipisicing elit. Non odit ab nam nobis perferendis, officiis magnam alias blanditiis distinctio iure, harum nostrum repudiandae voluptates labore, modi inventore magni nulla corporis! This card uses Bootstrap\'s default styling with no utility classes added. Global styles are the only things modifying the look and feel of this default card example. Lorem ipsum dolor sit amet consectetur adipisicing elit. Non odit ab nam nobis perferendis, officiis magnam alias blanditiis distinctio iure, harum nostrum repudiandae voluptates labore, modi inventore magni nulla corporis! This card uses Bootstrap\'s default styling with no utility classes added. Global styles are the only things modifying the look and feel of this default card example. Lorem ipsum dolor sit amet consectetur adipisicing elit. Non odit ab nam nobis perferendis, officiis magnam alias blanditiis distinctio iure, harum nostrum repudiandae voluptates labore, modi inventore magni nulla corporis! This card uses Bootstrap\'s default styling with no utility classes added. Global styles are the only things modifying the look and feel of this default card example. Lorem ipsum dolor sit amet consectetur adipisicing elit. Non odit ab nam nobis perferendis, officiis magnam alias blanditiis distinctio iure, harum nostrum repudiandae voluptates labore, modi inventore magni nulla corporis! This card uses Bootstrap\'s default styling with no utility classes added. Global styles are the only things modifying the look and feel of this default card example. Lorem ipsum dolor sit amet consectetur adipisicing elit. Non odit ab nam nobis perferendis, officiis magnam alias blanditiis distinctio iure, harum nostrum repudiandae voluptates labore, modi inventore magni nulla corporis! This card uses Bootstrap\'s default styling with no utility classes added. Global styles are the only things modifying the look and feel of this default card example.', 2, 'http://localhost/covid_web/assets/img/berita.jpeg', '2020-04-09 00:00:00', '2020-04-09 16:55:25', 2);

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
(1, 'Taktakan', 1),
(2, 'Cipocok', 1);

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
(2, 'tbfajri@gmail.com', '$2y$10$UoH0.7GTDJD55fJpX.7Um.sOrXUwzN0KUuFxJDubfJ9n22mO7uoru', 'Tb. Fajri Mulyana', '+6289671843158', 'default.jpg', NULL, 2, 1, 1580968149, '2020-04-02 15:01:41');

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
  MODIFY `id_covid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `id_district` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id_news` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subdistrict`
--
ALTER TABLE `subdistrict`
  MODIFY `id_subdistrict` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
