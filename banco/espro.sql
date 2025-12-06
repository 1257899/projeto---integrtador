-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.24-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para espro
CREATE DATABASE IF NOT EXISTS `espro` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `espro`;

-- Copiando estrutura para tabela espro.edicao
CREATE TABLE IF NOT EXISTS `edicao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ano_edicao` int(4) DEFAULT NULL,
  `data_cadastro` datetime DEFAULT NULL,
  `cpf_cadastro` varchar(11) DEFAULT NULL,
  `exclusao` bit(1) DEFAULT bit_count(0),
  `data_exclusao` datetime DEFAULT NULL,
  `cpf_exclusao` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela espro.edicao: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `edicao` DISABLE KEYS */;
/*!40000 ALTER TABLE `edicao` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `tema` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tema` varchar(50) NOT NULL,
  `descritivo` varchar(20000) DEFAULT NULL,
  `data_cadastro` datetime DEFAULT NULL,
  `cpf_cadastro` varchar(11) DEFAULT NULL,
  `excluido` bit(1) DEFAULT bit_count(0),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Copiando estrutura para tabela espro.projeto
CREATE TABLE IF NOT EXISTS `projeto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `edicao_id` int(11) DEFAULT NULL,
  `tema_id` int(11) DEFAULT NULL,
  `nome_equipe` varchar(100) DEFAULT NULL,
  `data_cadastro` datetime DEFAULT NULL,
  `cpf_cadastro` varchar(11) DEFAULT NULL,
  `exclusao` bit(1) DEFAULT bit_count(0),
  `data_exclusao` datetime DEFAULT NULL,
  `cpf_exclusao` varchar(11) DEFAULT NULL,
  `documento` varchar(100) DEFAULT NULL,
  `apresentacao` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_edicao` (`edicao_id`),
  KEY `FK_tema` (`tema_id`),
  CONSTRAINT `FK_edicao` FOREIGN KEY (`edicao_id`) REFERENCES `edicao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_tema` FOREIGN KEY (`tema_id`) REFERENCES `tema` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela espro.projeto: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `projeto` DISABLE KEYS */;
/*!40000 ALTER TABLE `projeto` ENABLE KEYS */;

-- Copiando estrutura para tabela espro.projeto_participante
CREATE TABLE IF NOT EXISTS `projeto_participante` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `projeto_id` int(11) DEFAULT NULL,
  `cpf_participante` varchar(11) DEFAULT NULL,
  `nome_participante` varchar(150) DEFAULT NULL,
  `data_cadastro` datetime DEFAULT NULL,
  `cpf_cadastro` varchar(11) DEFAULT NULL,
  `exclusao` bit(1) DEFAULT bit_count(0),
  `data_exclusao` datetime DEFAULT NULL,
  `cpf_exclusao` varchar(11) DEFAULT NULL,
  `motivo_exclusao` varchar(20000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_projeto` (`projeto_id`),
  CONSTRAINT `FK_projeto` FOREIGN KEY (`projeto_id`) REFERENCES `projeto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela espro.projeto_participante: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `projeto_participante` DISABLE KEYS */;
/*!40000 ALTER TABLE `projeto_participante` ENABLE KEYS */;

-- Copiando estrutura para tabela espro.tema


-- Copiando dados para a tabela espro.tema: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `tema` DISABLE KEYS */;
/*!40000 ALTER TABLE `tema` ENABLE KEYS */;

-- Copiando estrutura para tabela espro.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `usuario` varchar(50) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `email` (`usuario`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela espro.usuarios: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `nome`, `usuario`, `senha`) VALUES
	(1, 'Julio', 'JulioFerro17', '$2y$10$u5.dV7XfaIYd5U6Ll5lgoO1FnOne7onbOoUhsZnDuPoQcORy4ioie'),
	(2, 'Joao', 'JoaoVitor', '$2y$10$u5.dV7XfaIYd5U6Ll5lgoO1FnOne7onbOoUhsZnDuPoQcORy4ioie'),
	(3, 'Lucas', 'Lucas', '$2y$10$u5.dV7XfaIYd5U6Ll5lgoO1FnOne7onbOoUhsZnDuPoQcORy4ioie'),
	(4, 'Bruno', 'Bruno', '$2y$10$u5.dV7XfaIYd5U6Ll5lgoO1FnOne7onbOoUhsZnDuPoQcORy4ioie');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
