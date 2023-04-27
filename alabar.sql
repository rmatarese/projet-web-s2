-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 27, 2023 at 03:11 PM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alabar`
--

-- --------------------------------------------------------

--
-- Table structure for table `bar`
--

CREATE TABLE `bar` (
  `IdBar` int(11) NOT NULL,
  `NomBar` varchar(64) NOT NULL,
  `AdresseBar` varchar(64) NOT NULL,
  `VilleBar` varchar(64) NOT NULL,
  `Note` decimal(65,0) NOT NULL,
  `Status` enum('admin-only','public') NOT NULL DEFAULT 'admin-only',
  `nb_note` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bar`
--

INSERT INTO `bar` (`IdBar`, `NomBar`, `AdresseBar`, `VilleBar`, `Note`, `Status`, `nb_note`) VALUES
(6, 'Le Point De Départ', '48 rue Solférino', 'Lille', '8', 'public', 1),
(7, 'Le Spotlight', '100 Rue Léon Gambetta', 'Lille', '9', 'public', 1),
(8, 'KaraFun Lille', '8 rue Ratisbonne', 'Lille', '7', 'public', 1),
(9, 'La pépite', '12 Pl Sébastopol', 'Lille', '10', 'public', 1),
(10, 'La Canopée', '288 Rue Solférino', 'Lille', '5', 'public', 1),
(11, 'Le Sling', '32 rue Jean Jaurès', 'Lille', '7', 'public', 1),
(12, 'Le Bouquet', '182 BD Victor Hugo', 'Lille', '8', 'public', 1),
(13, 'RIDDIM', '117 Rue des Postes', 'Lille', '10', 'public', 1),
(14, 'Les Sarrazins', '52 rue des Sarrazins', 'Lille', '4', 'public', 1),
(15, 'Le Gallia', '138 Rue des Marquillies', 'Lille', '6', 'public', 1),
(16, 'Rush Bar', '32 Rue Saint Sébastien', 'Paris', '8', 'public', 1),
(17, 'Little Red Door', '60 Rue Charlot', 'Paris', '7', 'public', 1),
(18, 'Candelaria', '52 Rue de Saintonge', 'Paris', '2', 'public', 1);

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `Id` int(11) NOT NULL,
  `Nom` varchar(64) NOT NULL,
  `Prenom` varchar(64) NOT NULL,
  `Email` varchar(64) NOT NULL,
  `DateNaissance` date NOT NULL,
  `Password` varchar(64) NOT NULL,
  `perm` enum('client','admin') NOT NULL DEFAULT 'client'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`Id`, `Nom`, `Prenom`, `Email`, `DateNaissance`, `Password`, `perm`) VALUES
(2, 'Admin', 'Admin', 'admin@gmail.com', '2023-04-14', '$2y$10$BdVOodXPwA8pW4SSI/4ob.x7u0zyFd7GfqXgJEVBu/x7MTTOqiMTO', 'admin'),
(3, 'Client', 'Client', 'client@gmail.com', '1010-10-10', '$2y$10$WdlO1.BiSgGShwLYXXODKOFVz9eKt4RkagC2TMt9Md0G7khqZqTqW', 'client'),
(8, 'Sash', 'Sasha', 'Sasha.le-roux-zielinski@student.junia.com', '2828-02-28', '$2y$10$qOWbhF2v1vROKhEDMybhFOcC5x1WoxgoAjsH/HDbY285FI0uaoYZ6', 'admin'),
(9, 'Robin', 'Robin', 'robin.matarese@student.junia.com', '2723-05-25', '$2y$10$t9navSvQ4MYM2p8mkvSNX.nMdocTHcQWEm3wPuD6vCX2zpTrNJclu', 'admin'),
(10, 'Shalom', 'Shalom', 'Shalom.jsp@student.junia.com', '2023-03-16', '$2y$10$p/kDHom1GmuaMiDodH5nx.c4ty6i9iGzL9DWRxh0FA0kruXYdDNVa', 'admin'),
(11, 'Broucqsault', 'Simon', 'simon.broucqsault@student.junia.com', '2004-09-07', '$2y$10$ywRFp32RFL8JfRVU0rY6UOOrq6qxwOS.aA.KhkVk3L/j4LD5Oo9Ka', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bar`
--
ALTER TABLE `bar`
  ADD PRIMARY KEY (`IdBar`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bar`
--
ALTER TABLE `bar`
  MODIFY `IdBar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
