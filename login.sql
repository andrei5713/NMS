-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2025 at 09:37 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login`
--

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `nameofuser` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `desig` varchar(100) NOT NULL,
  `employmentstatus` varchar(100) NOT NULL,
  `accountable` varchar(255) NOT NULL,
  `ipaddress` varchar(255) NOT NULL,
  `macaddress` varchar(255) NOT NULL,
  `typeofdevice` varchar(255) NOT NULL,
  `computername` varchar(250) NOT NULL,
  `operatingsystem` varchar(50) NOT NULL,
  `ssid` varchar(50) NOT NULL,
  `ppsk` varchar(50) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `domain` varchar(100) NOT NULL,
  `property` varchar(100) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `serial` varchar(100) NOT NULL,
  `endpoint` varchar(100) NOT NULL,
  `microsoftoffice` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `nameofuser`, `department`, `desig`, `employmentstatus`, `accountable`, `ipaddress`, `macaddress`, `typeofdevice`, `computername`, `operatingsystem`, `ssid`, `ppsk`, `pass`, `domain`, `property`, `brand`, `model`, `serial`, `endpoint`, `microsoftoffice`) VALUES
(18, 'Jewell Mayrena', 'AO', 'Computer Maintenance Technologist I', 'permanent', 'Jewell Mayrena', '192.168.104.45', 'blippi', 'desktop', 'CPMSD-MAYRENA', 'win10', 'nfacowlnet', 'sfois45sdf', 'SFAFASFAF', 'CPMSD-JEW', 'AWERADS', 'acer', 'Veriton X26656', '', '', ''),
(19, 'Rainier Dela Cruz', 'CPMSD-ICTSD', 'Information System Analyst III', 'Permanent', 'Rainier Dela Cruz', '192.168.105.126', 'unknown', 'Desktop', 'CPMSD-DelaCruz', 'Windows 11', 'NFACOWLNET', 'wsa3sdf', 'sara3wad', '23asdfsdf2', '23rsfdasdf', 'ACER', 'Veriton X26656', '', '', ''),
(21, 'Eric Aguirre', 'CPMSD-ICTSD', 'Information Technology Officer II', 'Permanent', 'Eric Aguirre', '192.168.105.101', 'unknown', 'Desktop', 'CPMSD-AGUIRRE', 'Windows 11', 'NFACOWLNET', 'CPMSD_AGUIRRE', 'podi2ds3', 'Eric Aguirre', 'blahblah', 'ACER', 'Veriton X26656', '5s89dasx5c4w98d', 'Kaspersky Anti-Virus (Managed by Server)', ''),
(22, 'Armin Jazmines', 'CPMSD-ICTSD', 'Computer Maintenance Technologist III', 'Permanent', 'Armin Jazmines', '192.168.105.124', 'isodfwerdsfaiu', 'Desktop', 'CPMSD-JAZMINES', 'Windows 11', 'NFACOWLNET', 'CPMSD_JAZMINES_PC', 'sdf34swdf', 'NFADOM\\avjazmines', '2014-NFA-MSD-DP-B-2023', 'ACER', 'Veriton X26656', 'EFSDFWERW23DFS', 'Kaspersky Anti-Virus (Managed by Server)', ''),
(23, 'Paulo Jacinto', 'CPMSD-ICTSD', 'Computer Programmer II', 'Permanent', 'Paulo Jacinto', '192.168.105.146', 'sdfadfweef', 'Desktop', 'CPMSD-JACINTO', 'Windows 10', 'NFACOWLNET', 'CPMSD_JACINTO_PC', 'sdfiso34gdf', 'NFADOM\\pjacinto', 'safioh23', 'ACER', 'Veriton X26656', 'saf34gfvd', 'Kaspersky Anti-Virus (Managed by Server)', ''),
(24, 'Armin Jazmines', 'AO', 'Computer Maintenance Technologist III', 'Permanent', 'Armin Jazmines', '192.168.105.124', 'isodfwerdsfaiu', 'Desktop', 'CPMSD-JAZMINES', 'Windows XP', 'NFACOWLNET', 'CPMSD_JAZMINES_PC', 'erwergg', 'NFADOM\\avjazmines', 'blahblah', 'ACER', 'Veriton X26656', 'dgfsdfg', 'Kaspersky Anti-Virus (Managed by Server)', ''),
(25, 'boots', 'OCD', 'sfafdsa', 'Permanent', 'sfsada', '192.168.105.124', 'ssfsadfa', 'Desktop', 'sfsadfsafa', 'Macintosh', 'NFACOWLNET', 'sdfafafa', 'asdfsfa', 'asfdsafa', 'safasfda', 'ACER', 'Veriton X26656', 'sdffada', 'Kaspersky Anti-Virus (Unmanaged by Server)', ''),
(26, 'yami', 'AGSD-GSD', 'sdfaw', 'Permanent', 'werq', '192.168.105.124', 'cvb', 'Desktop', 'sfsadfsafa', 'Windows XP', 'NFACOWLNET', 'CPMSD_JAZMINES_PC', 'sdf34swdf', 'NFADOM\\avjazmines', 'blahblah', 'ACER', 'Veriton X26656', 'EFSDFWERW23DFS', 'Kaspersky Anti-Virus (Managed by Server)', ''),
(27, 'juan', 'CPMSD-ICTSD', 'admin', 'Permanent', 'Armin Jazmines', '192.168.105.124', 'isodfwerdsfaiu', 'laptop', 'CPMSD-JAZMINES', 'Macintosh', 'NFABYOD', 'CPMSD_JAZMINES_PC', 'sdf34swdf', 'NFADOM\\avjazmines', 'blahblah', 'ACER', 'Veriton X26656', 'EFSDFWERW23DFS', 'Kaspersky Anti-Virus (Managed by Server)', ''),
(28, 'Juan Tamad', 'AO', 'admin', 'Permanent', '342342342', 'werwerwer', 'sdfsfs', 'Desktop', 'fhfghfhf', 'Windows 11', 'NFACOWLNET', 'CPMSD_JAZMINES_PC', 'fghfghfg', 'fghfghf', 'vbnvnv', 'ACER', 'Veriton X26656', 'vbnv', 'Kaspersky Anti-Virus (Unmanaged by Server)', ''),
(47, 'collet', 'AO', 'hehehe', 'Permanent', 'sdfdsfs', 'sdfsfsfs', 'sdfsdfds', 'Desktop', 'sfsdfssd', 'Macintosh', 'NFACOWLNET', 'sfads', 'asfasfsa', 'sdfsdfsdfsd', 'sfafsfas', 'ACER', 'Veriton X26656', 'sfasdfa', 'Kaspersky Anti-Virus (Managed by Server)', 'Microsoft Office 2010'),
(49, 'Paulo Jacinto', 'CPMSD-ICTSD', 'Computer Programmer II', 'Permanent', 'Paulo Jacinto', '192.168.105.146', 'sdfadfweef', 'Desktop', 'CPMSD-JACINTO', 'Windows 10', 'NFACOWLNET', 'CPMSD_JACINTO_PC', 'sdfiso34gdf', 'NFADOM\\pjacinto', 'safioh23', 'ACER', 'Veriton X26656', 'saf34gfvd', 'Kaspersky Anti-Virus (Managed by Server)', 'Microsoft Office 2010'),
(52, 'yolam', 'AO-PAD', 'hehehe', 'Permanent', 'sdfdsfs', 'jkhjkjhkhj', 'hjkhjkhjkhj', 'laptop', 'sfsdfssd', 'Windows XP', 'NFACOWLNET', 'hkhkhjk', 'asfasfsa', 'hkhjkhj', 'sfafsfas', 'ACER', 'Veriton X26656', 'hjkhjkh', 'Kaspersky Anti-Virus (Managed by Server)', 'Microsoft Office 2010'),
(56, 'maloy', 'AO-PAD', 'hehehe', 'Permanent', 'sdfdsfs', 'f', 's', 'Desktop', 's', 'Windows 11', 'NFABYOD', 'sfads', 'sdfiso34gdf', 'sdfsdfsdfsd', 'sfafsfas', 'HP', 'Veriton X26656', 'saf34gfvd', 'Kaspersky Anti-Virus (Managed by Server)', 'Microsoft Office 2010'),
(57, 'macolette', 'AO-PAD', 's', 'Permanent', 'sdfdsfs', 'sdfsfsfs', 'sdfadfweef', 'Desktop', 'CPMSD-JAZMINES', 'Windows 11', 'NFABYOD', 'sfads', 'sdfiso34gdf', 'NFADOM\\pjacinto', 'safioh23', 'ACER', 'Veriton X26656', 'sfasdfa', 'Kaspersky Anti-Virus (Unmanaged by Server)', 'Microsoft Office 2010'),
(62, 'maloyakin', 'AO', 'hehehe', 'Permanent', 'sdfdsfs', 'sdfsfsfs', 'sdfsdfds', 'Desktop', 'CPMSD-JAZMINES', 'Windows 11', 'NFACOWLNET', 'sfads', 'asfasfsa', 'sdfsdfsdfsd', 'sfafsfas', 'ACER', 'Veriton X26656', 'sfasdfa', 'Kaspersky Anti-Virus (Managed by Server)', 'Microsoft Office 2010'),
(67, 'boots', 'OCD', 'sfafdsa', 'Allied', 'sfsada', '192.168.105.124', 'ssfsadfa', 'Desktop', 'sfsadfsafa', 'Macintosh', 'NFACOWLNET', 'sdfafafa', 'asdfsfa', 'asfdsafa', 'safasfda', 'ACER', 'Veriton M2640G', 'sdffada', 'Kaspersky Anti-Virus (Unmanaged by Server)', 'Microsoft Office 2010'),
(70, 'sfsfsfs', 'AO', 'hehehe', 'Permanent', 'dfsfsd', 'sfsdfs', '34', 'Desktop', 'CPMSD-JAZMINES', 'Windows 11', 'NFACOWLNET', 'hkhkhjk', 'sdfsd', 'dfsfs', 'xcvxvxcx', 'ACER', 'Veriton X26656', 'sdfsdf', 'Kaspersky Anti-Virus (Managed by Server)', 'Microsoft Office 2010'),
(72, 'fsfsdfsffsd', 'CPMSD-ICTSD', 'Computer Programmer II', 'Permanent', 'Paulo Jacinto', '192.168.105.146', 'sdfadfweef', 'Desktop', 'CPMSD-JACINTO', 'Windows 10', 'NFACOWLNET', 'CPMSD_JACINTO_PC', 'sdfiso34gdf', 'NFADOM\\pjacinto', 'safioh23', 'ACER', 'Veriton X26656', 'saf34gfvd', 'Kaspersky Anti-Virus (Managed by Server)', 'Microsoft Office 2010');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `email`, `password`) VALUES
(1, 'Emmanuel', 'Gormise', 'emmangormise@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e'),
(2, 'ice cream', 'yami', 'icecreamyami@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e'),
(3, 'Don', 'Facundo', 'batasmilitar@yahoo.com', 'd41d8cd98f00b204e9800998ecf8427e'),
(4, 'mark', 'abayan', 'markabayan@gmail', 'd41d8cd98f00b204e9800998ecf8427e'),
(6, 'api', 'training', 'apitraining@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e'),
(7, 'api', 'training', 'api@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
