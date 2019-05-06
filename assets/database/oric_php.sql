-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 29, 2019 at 05:16 PM
-- Server version: 5.7.21
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oric_php`
--

-- --------------------------------------------------------

--
-- Table structure for table `devs`
--

DROP TABLE IF EXISTS `devs`;
CREATE TABLE IF NOT EXISTS `devs` (
  `id_dev` int(11) NOT NULL,
  `nome_dev` varchar(200) NOT NULL,
  `email_dev` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `devs`
--

INSERT INTO `devs` (`id_dev`, `nome_dev`, `email_dev`) VALUES
(1, 'Marcelo Junior', 'kronussigma@gmail.com'),
(2, 'Camila Oliveira', 'millaloliveira@myself.com'),
(3, 'Carla Martins', 'carla@mail.com'),
(4, 'Lucas Salazar', 'lucas_sala@mail.com');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
