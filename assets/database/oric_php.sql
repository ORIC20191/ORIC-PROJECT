-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 06-Maio-2019 às 22:37
-- Versão do servidor: 5.7.19
-- PHP Version: 7.1.9

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
-- Estrutura da tabela `devs`
--

DROP TABLE IF EXISTS `devs`;
CREATE TABLE IF NOT EXISTS `devs` (
  `id_dev` int(11) NOT NULL AUTO_INCREMENT,
  `id_use` int(11) NOT NULL,
  `type_dev` varchar(1) NOT NULL,
  PRIMARY KEY (`id_dev`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `devs`
--

INSERT INTO `devs` (`id_dev`, `id_use`, `type_dev`) VALUES
(1, 1, 'A'),
(2, 2, 'W'),
(3, 3, 'W'),
(4, 4, 'W');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_use` int(11) NOT NULL AUTO_INCREMENT,
  `type_use` int(1) NOT NULL DEFAULT '1',
  `status_use` int(1) NOT NULL DEFAULT '1',
  `signup_date` datetime NOT NULL,
  `name_use` varchar(50) NOT NULL,
  `login` varchar(25) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(100) NOT NULL,
  `photo` varchar(50) DEFAULT NULL,
  `cep` varchar(9) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `neighborhood` varchar(200) DEFAULT NULL,
  `city` varchar(300) DEFAULT NULL,
  `state` varchar(2) DEFAULT NULL,
  `rg` varchar(12) DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `birthday_date` date DEFAULT NULL,
  PRIMARY KEY (`id_use`),
  UNIQUE KEY `login` (`login`),
  KEY `nivel` (`type_use`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id_use`, `type_use`, `status_use`, `signup_date`, `name_use`, `login`, `password`, `email`, `photo`, `cep`, `address`, `number`, `neighborhood`, `city`, `state`, `rg`, `cpf`, `phone`, `birthday_date`) VALUES
(1, 6, 1, '2019-05-06 19:25:14', 'Marcelo Junior', 'msjr', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'kronussigma@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 6, 1, '2019-05-06 19:25:14', 'Camila Oliveira', 'clcmo', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'millaloliveira@myself.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 6, 1, '2019-05-06 19:25:14', 'Carla Martins', 'ccom', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'carla@mail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 6, 1, '2019-05-06 19:25:14', 'Lucas Salazar', 'lsala', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'lucas_sala@mail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
-- --------------------------------------------------------

--
-- Estrutura da tabela `uploads`
--

DROP TABLE IF EXISTS `uploads`;
CREATE TABLE IF NOT EXISTS `uploads` (
  `id_upl` int(11) NOT NULL,
  `id_use` int(11) NOT NULL,
  `photo` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Constraints for dumped tables
--

--
-- Constraints for table `devs`
--
ALTER TABLE `devs`
  ADD CONSTRAINT `devs_ibfk_1` FOREIGN KEY (`id_use`) REFERENCES `users` (`id_use`);


--
-- Constraints for table `uploads`
--
ALTER TABLE `uploads`
  ADD CONSTRAINT `uploads_ibfk_1` FOREIGN KEY (`id_use`) REFERENCES `users` (`id_use`);


COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
