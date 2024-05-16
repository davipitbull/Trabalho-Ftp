-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema template
--

CREATE DATABASE IF NOT EXISTS template;
USE template;

--
-- Definition of table `adm`
--

DROP TABLE IF EXISTS `adm`;
CREATE TABLE `adm` (
  `idadm` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `cadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `alteracao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ativo` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`idadm`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adm`
--

/*!40000 ALTER TABLE `adm` DISABLE KEYS */;
INSERT INTO `adm` (`idadm`,`nome`,`senha`,`email`,`foto`,`cadastro`,`alteracao`,`ativo`) VALUES 
 (1,'David','$2y$10$gPT3zMoqm5bjT.Ny9zesUOkrCVr47m7J.22NcfMj/uxtSLHzOiDjO','davidestudosdev@gmail.com','foto.png','2024-03-12 18:41:44','2024-05-13 14:35:40',1);
/*!40000 ALTER TABLE `adm` ENABLE KEYS */;


--
-- Definition of table `banner`
--

DROP TABLE IF EXISTS `banner`;
CREATE TABLE `banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `banner`
--

/*!40000 ALTER TABLE `banner` DISABLE KEYS */;
INSERT INTO `banner` (`id`,`nome`,`imagem`) VALUES 
 (5,'Banner11','aaaa.webp');
/*!40000 ALTER TABLE `banner` ENABLE KEYS */;


--
-- Definition of table `contato`
--

DROP TABLE IF EXISTS `contato`;
CREATE TABLE `contato` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `numero` varchar(20) NOT NULL,
  `mensagem` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contato`
--

/*!40000 ALTER TABLE `contato` DISABLE KEYS */;
INSERT INTO `contato` (`id`,`nome`,`numero`,`mensagem`) VALUES 
 (7,'dawda','(33)33333-3333','dawwdaawdawd'),
 (8,'cu','(33)33333-3333','adwojndawjdauwijdauiwjduawddwawdawdawdawdawdawdawdawdaiwjduaiw aowjdoiawjdoiawjd awdjoaiwdjaiowjdoaw doawjdoijawodjawoidj oawdoiawjdojwad'),
 (9,'Luiz','(23)08383-2893','Oi');
/*!40000 ALTER TABLE `contato` ENABLE KEYS */;


--
-- Definition of table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(255) NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `forma_pagamento` varchar(20) NOT NULL,
  `nome_cliente` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pedidos`
--

/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
INSERT INTO `pedidos` (`id`,`usuario`,`data_inicio`,`data_fim`,`valor`,`forma_pagamento`,`nome_cliente`) VALUES 
 (3,'Lucas','2024-02-01','2024-03-02','100.00','vista','David'),
 (4,'Lucas','2024-01-01','2024-02-01','400.00','vista','Gabriel'),
 (5,'Lucas','2024-02-01','2024-03-01','1.23','vista','Lucian');
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;


--
-- Definition of table `produto`
--

DROP TABLE IF EXISTS `produto`;
CREATE TABLE `produto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `descricao` text DEFAULT NULL,
  `preco` decimal(10,2) NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produto`
--

/*!40000 ALTER TABLE `produto` DISABLE KEYS */;
INSERT INTO `produto` (`id`,`nome`,`descricao`,`preco`,`imagem`) VALUES 
 (2,'Bermuda Feminina','Aiai','33.00','short.webp'),
 (4,'Calça','Calça','50.54','calcaMasculina.webp'),
 (5,'Regata','Regata','11.12','regata2.webp'),
 (6,'Camisa','Camisa','32.99','camisa.webp');
/*!40000 ALTER TABLE `produto` ENABLE KEYS */;


--
-- Definition of table `teste1`
--

DROP TABLE IF EXISTS `teste1`;
CREATE TABLE `teste1` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `cadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `alteracao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ativo` tinyint(1) DEFAULT 1,
  `cpf` varchar(45) NOT NULL DEFAULT '',
  `trabalho` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teste1`
--

/*!40000 ALTER TABLE `teste1` DISABLE KEYS */;
/*!40000 ALTER TABLE `teste1` ENABLE KEYS */;


--
-- Definition of table `teste2`
--

DROP TABLE IF EXISTS `teste2`;
CREATE TABLE `teste2` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `cadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `alteracao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ativo` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teste2`
--

/*!40000 ALTER TABLE `teste2` DISABLE KEYS */;
INSERT INTO `teste2` (`id`,`nome`,`cadastro`,`alteracao`,`ativo`) VALUES 
 (14,'Pedreiro','2024-04-08 14:05:33','2024-04-08 14:05:33',1),
 (15,'Mercereiro ','2024-04-08 14:05:19','2024-04-08 14:05:19',1),
 (16,'Pintor','2024-04-08 14:05:25','2024-04-08 14:05:25',1),
 (17,'Desenvolvedor','2024-04-08 16:33:37','2024-04-08 16:33:37',1);
/*!40000 ALTER TABLE `teste2` ENABLE KEYS */;


--
-- Definition of table `teste3`
--

DROP TABLE IF EXISTS `teste3`;
CREATE TABLE `teste3` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `cadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `alteracao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ativo` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teste3`
--

/*!40000 ALTER TABLE `teste3` DISABLE KEYS */;
INSERT INTO `teste3` (`id`,`nome`,`cadastro`,`alteracao`,`ativo`) VALUES 
 (2,'Jairzinhooo','2024-03-12 19:39:44','2024-03-12 19:39:44',1),
 (3,'Beckenbauer','2024-03-12 19:39:44','2024-03-12 19:39:44',1),
 (4,'Eder Jofree','2024-03-12 19:39:44','2024-03-12 19:39:44',1),
 (5,'Sócrates','2024-03-12 19:39:44','2024-03-12 19:39:44',1),
 (6,'Júnior','2024-03-12 19:39:44','2024-03-12 19:39:44',1),
 (11,'Jesus Cristo','2024-03-12 23:48:06','2024-03-12 23:48:06',1),
 (12,'Jesus','2024-03-12 23:48:24','2024-03-12 23:48:24',1);
/*!40000 ALTER TABLE `teste3` ENABLE KEYS */;


--
-- Definition of table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuario`
--

/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id`,`nome`,`email`,`senha`) VALUES 
 (1,'David','david@gmail.com','$2y$10$/ydR8LezPywahKUZZcjZZOpRSIk9UuB1MmN060xo8f./STJmNqQtK');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
