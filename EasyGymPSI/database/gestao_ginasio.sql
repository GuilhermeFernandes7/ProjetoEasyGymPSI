-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 14, 2026 at 11:11 PM
-- Server version: 9.1.0
-- PHP Version: 8.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gestao_ginasio`
--

-- --------------------------------------------------------

--
-- Table structure for table `aula`
--

DROP TABLE IF EXISTS `aula`;
CREATE TABLE IF NOT EXISTS `aula` (
  `aula_id` int NOT NULL AUTO_INCREMENT,
  `modalidade` varchar(100) NOT NULL,
  `capacidade` int NOT NULL,
  PRIMARY KEY (`aula_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` int DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `idx-auth_assignment-user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '1', 1794690164);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `type` smallint NOT NULL,
  `description` text COLLATE utf8mb3_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, NULL, NULL, NULL, 1794663159, 1794663159),
('cliente', 1, NULL, NULL, NULL, 1794663159, 1794663159),
('funcionario', 1, NULL, NULL, NULL, 1794663159, 1794663159),
('gerirSistema', 2, 'Gestão global (utilizadores, ginásios)', NULL, NULL, 1794663159, 1794663159),
('gerirSocios', 2, 'Gerir inscrições, sócios e pagamentos', NULL, NULL, 1794663159, 1794663159),
('gerirTreinos', 2, 'Criar e editar planos de treino e aulas', NULL, NULL, 1794663159, 1794663159),
('loginBackend', 2, 'Aceder ao Back-office', NULL, NULL, 1794663159, 1794663159);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('admin', 'funcionario'),
('admin', 'gerirSistema'),
('funcionario', 'gerirSocios'),
('funcionario', 'gerirTreinos'),
('cliente', 'loginBackend'),
('funcionario', 'loginBackend');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fatura`
--

DROP TABLE IF EXISTS `fatura`;
CREATE TABLE IF NOT EXISTS `fatura` (
  `fatura_id` int NOT NULL AUTO_INCREMENT,
  `inscricao_id` int NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `data_emissao` date NOT NULL,
  PRIMARY KEY (`fatura_id`),
  KEY `idx_fatura_inscricao` (`inscricao_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inscricao`
--

DROP TABLE IF EXISTS `inscricao`;
CREATE TABLE IF NOT EXISTS `inscricao` (
  `inscricao_id` int NOT NULL AUTO_INCREMENT,
  `perfil_id` int NOT NULL,
  `estado` varchar(30) NOT NULL,
  `data_fim` date DEFAULT NULL,
  PRIMARY KEY (`inscricao_id`),
  KEY `idx_inscricao_perfil` (`perfil_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `marcacao_avaliacao`
--

DROP TABLE IF EXISTS `marcacao_avaliacao`;
CREATE TABLE IF NOT EXISTS `marcacao_avaliacao` (
  `marcacao_id` int NOT NULL AUTO_INCREMENT,
  `cliente_id` int NOT NULL,
  `pt_id` int NOT NULL,
  `data_hora` datetime NOT NULL,
  `estado` varchar(30) NOT NULL,
  PRIMARY KEY (`marcacao_id`),
  KEY `idx_marcacao_cliente` (`cliente_id`),
  KEY `idx_marcacao_pt` (`pt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1794241205),
('m130524_201442_init', 1794241209),
('m190124_110200_add_verification_token_column_to_user_table', 1794241209),
('m140506_102106_rbac_init', 1794241801),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1794241801),
('m180523_151638_rbac_updates_indexes_without_prefix', 1794241801),
('m200409_110543_rbac_update_mssql_trigger', 1794241801),
('m261111_155018_init_rbac', 1794663159);

-- --------------------------------------------------------

--
-- Table structure for table `notificacao`
--

DROP TABLE IF EXISTS `notificacao`;
CREATE TABLE IF NOT EXISTS `notificacao` (
  `notificacao_id` int NOT NULL AUTO_INCREMENT,
  `perfil_id` int NOT NULL,
  `mensagem` varchar(255) NOT NULL,
  `data_envio` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`notificacao_id`),
  KEY `idx_notificacao_perfil` (`perfil_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `perfil_utilizador`
--

DROP TABLE IF EXISTS `perfil_utilizador`;
CREATE TABLE IF NOT EXISTS `perfil_utilizador` (
  `perfil_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `nif` varchar(9) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `morada` varchar(200) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  PRIMARY KEY (`perfil_id`),
  UNIQUE KEY `uk_perfil_utilizador` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plano_treino`
--

DROP TABLE IF EXISTS `plano_treino`;
CREATE TABLE IF NOT EXISTS `plano_treino` (
  `plano_id` int NOT NULL AUTO_INCREMENT,
  `cliente_id` int NOT NULL,
  `pt_id` int NOT NULL,
  `exercicios` text NOT NULL,
  `data_criacao` date NOT NULL,
  PRIMARY KEY (`plano_id`),
  KEY `idx_plano_cliente` (`cliente_id`),
  KEY `idx_plano_pt` (`pt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reserva_aula`
--

DROP TABLE IF EXISTS `reserva_aula`;
CREATE TABLE IF NOT EXISTS `reserva_aula` (
  `reserva_id` int NOT NULL AUTO_INCREMENT,
  `aula_id` int NOT NULL,
  `perfil_id` int NOT NULL,
  `data_reserva` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`reserva_id`),
  KEY `idx_reserva_aula` (`aula_id`),
  KEY `idx_reserva_perfil` (`perfil_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessao_aula`
--

DROP TABLE IF EXISTS `sessao_aula`;
CREATE TABLE IF NOT EXISTS `sessao_aula` (
  `sessao_id` int NOT NULL AUTO_INCREMENT,
  `aula_id` int NOT NULL,
  `data_hora` datetime NOT NULL,
  PRIMARY KEY (`sessao_id`),
  KEY `idx_sessao_aula` (`aula_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8mb3_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` smallint NOT NULL DEFAULT '10',
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  `verification_token` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'admin', 'chave_seguranca_123', '$2y$10$RnDwpen5c8.gtZLaxHEHDOKWY77t/20A4RRkWBsjlPuu7Wmy0HyBu', NULL, 'admin@easygym.pt', 10, 1794321057, 1794321057, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fatura`
--
ALTER TABLE `fatura`
  ADD CONSTRAINT `fk_fatura_inscricao` FOREIGN KEY (`inscricao_id`) REFERENCES `inscricao` (`inscricao_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inscricao`
--
ALTER TABLE `inscricao`
  ADD CONSTRAINT `fk_inscricao_perfil` FOREIGN KEY (`perfil_id`) REFERENCES `perfil_utilizador` (`perfil_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `marcacao_avaliacao`
--
ALTER TABLE `marcacao_avaliacao`
  ADD CONSTRAINT `fk_marcacao_cliente` FOREIGN KEY (`cliente_id`) REFERENCES `perfil_utilizador` (`perfil_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_marcacao_pt` FOREIGN KEY (`pt_id`) REFERENCES `perfil_utilizador` (`perfil_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notificacao`
--
ALTER TABLE `notificacao`
  ADD CONSTRAINT `fk_notificacao_perfil` FOREIGN KEY (`perfil_id`) REFERENCES `perfil_utilizador` (`perfil_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `perfil_utilizador`
--
ALTER TABLE `perfil_utilizador`
  ADD CONSTRAINT `fk_perfil_utilizador` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `plano_treino`
--
ALTER TABLE `plano_treino`
  ADD CONSTRAINT `fk_plano_cliente` FOREIGN KEY (`cliente_id`) REFERENCES `perfil_utilizador` (`perfil_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_plano_pt` FOREIGN KEY (`pt_id`) REFERENCES `perfil_utilizador` (`perfil_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reserva_aula`
--
ALTER TABLE `reserva_aula`
  ADD CONSTRAINT `fk_reserva_aula` FOREIGN KEY (`aula_id`) REFERENCES `aula` (`aula_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reserva_perfil` FOREIGN KEY (`perfil_id`) REFERENCES `perfil_utilizador` (`perfil_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sessao_aula`
--
ALTER TABLE `sessao_aula`
  ADD CONSTRAINT `fk_sessao_aula` FOREIGN KEY (`aula_id`) REFERENCES `aula` (`aula_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
