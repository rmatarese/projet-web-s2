-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 24, 2023 at 05:02 PM
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
  `Note` int(11) NOT NULL,
  `Commentaires` varchar(64) NOT NULL,
  `Status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bar`
--

INSERT INTO `bar` (`IdBar`, `NomBar`, `AdresseBar`, `VilleBar`, `Note`, `Commentaires`, `Status`) VALUES
(1, 'Le Zytho', '41 Bd Vauban', 'Lille', 0, '', 0),
(2, 'Le Point de Départ', '48 Rue Solférino', 'Lille', 0, '', 0);

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
  `Password` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`Id`, `Nom`, `Prenom`, `Email`, `DateNaissance`, `Password`) VALUES
(1, 'Broucqsault', 'Simon', 'simon.broucqsault@student.junia.com', '2004-07-09', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bar`
--
ALTER TABLE `bar`
  ADD PRIMARY KEY (`IdBar`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bar`
--
ALTER TABLE `bar`
  MODIFY `IdBar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
