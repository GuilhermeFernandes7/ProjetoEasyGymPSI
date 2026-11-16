-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 15, 2026 at 11:42 PM
-- Server version: 9.1.0
-- PHP Version: 8.4.0

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
CREATE TABLE `aula` (
  `aula_id` int NOT NULL,
  `modalidade` varchar(100) NOT NULL,
  `capacidade` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '1', 1794423523),
('cliente', '4', 1794771535),
('cliente', '7', 1794785493),
('funcionario', '6', 1794785499);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `type` smallint NOT NULL,
  `description` text COLLATE utf8mb3_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, NULL, NULL, NULL, 1794422878, 1794422878),
('cliente', 1, NULL, NULL, NULL, 1794422878, 1794422878),
('funcionario', 1, NULL, NULL, NULL, 1794422878, 1794422878),
('gerirSistema', 2, 'Gestão global (utilizadores, ginásios)', NULL, NULL, 1794422878, 1794422878),
('gerirSocios', 2, 'Gerir inscrições, sócios e pagamentos', NULL, NULL, 1794422878, 1794422878),
('gerirTreinos', 2, 'Criar e editar planos de treino e aulas', NULL, NULL, 1794422878, 1794422878),
('loginBackend', 2, 'Aceder ao Back-office', NULL, NULL, 1794422878, 1794422878);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL
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
CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fatura`
--

DROP TABLE IF EXISTS `fatura`;
CREATE TABLE `fatura` (
  `fatura_id` int NOT NULL,
  `inscricao_id` int NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `data_emissao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inscricao`
--

DROP TABLE IF EXISTS `inscricao`;
CREATE TABLE `inscricao` (
  `inscricao_id` int NOT NULL,
  `perfil_id` int NOT NULL,
  `estado` varchar(30) NOT NULL,
  `data_fim` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `marcacao_avaliacao`
--

DROP TABLE IF EXISTS `marcacao_avaliacao`;
CREATE TABLE `marcacao_avaliacao` (
  `marcacao_id` int NOT NULL,
  `cliente_id` int NOT NULL,
  `pt_id` int NOT NULL,
  `data_hora` datetime NOT NULL,
  `estado` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1794251588),
('m130524_201442_init', 1794251592),
('m190124_110200_add_verification_token_column_to_user_table', 1794251592),
('m140506_102106_rbac_init', 1794251609),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1794251609),
('m180523_151638_rbac_updates_indexes_without_prefix', 1794251609),
('m200409_110543_rbac_update_mssql_trigger', 1794251609),
('m261111_155018_init_rbac', 1794422878),
('m261115_181209_add_nome_to_perfil_utilizador', 1794766569);

-- --------------------------------------------------------

--
-- Table structure for table `notificacao`
--

DROP TABLE IF EXISTS `notificacao`;
CREATE TABLE `notificacao` (
  `notificacao_id` int NOT NULL,
  `perfil_id` int NOT NULL,
  `mensagem` varchar(255) NOT NULL,
  `data_envio` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `perfil_utilizador`
--

DROP TABLE IF EXISTS `perfil_utilizador`;
CREATE TABLE `perfil_utilizador` (
  `perfil_id` int NOT NULL,
  `user_id` int NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `nif` varchar(9) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `morada` varchar(200) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `perfil_utilizador`
--

INSERT INTO `perfil_utilizador` (`perfil_id`, `user_id`, `nome`, `nif`, `telefone`, `morada`, `data_nascimento`) VALUES
(1, 1, NULL, '999999999', '910000000', 'Sede Easy Gym Leiria', '1990-01-01'),
(4, 4, 'Gabriel Silvestre', NULL, NULL, NULL, NULL),
(6, 6, 'Afonso Henriques', NULL, '123456789', NULL, NULL),
(7, 7, 'D.dinis', NULL, '123456789', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `plano_treino`
--

DROP TABLE IF EXISTS `plano_treino`;
CREATE TABLE `plano_treino` (
  `plano_id` int NOT NULL,
  `cliente_id` int NOT NULL,
  `pt_id` int NOT NULL,
  `exercicios` text NOT NULL,
  `data_criacao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reserva_aula`
--

DROP TABLE IF EXISTS `reserva_aula`;
CREATE TABLE `reserva_aula` (
  `reserva_id` int NOT NULL,
  `aula_id` int NOT NULL,
  `perfil_id` int NOT NULL,
  `data_reserva` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessao_aula`
--

DROP TABLE IF EXISTS `sessao_aula`;
CREATE TABLE `sessao_aula` (
  `sessao_id` int NOT NULL,
  `aula_id` int NOT NULL,
  `data_hora` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8mb3_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` smallint NOT NULL DEFAULT '10',
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  `verification_token` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'admin', 'admin_auth_key_123', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, 'admin@easygym.pt', 10, 1794423523, 1794423523, NULL),
(4, 'cliente2', 'RCq6iqYG7FFe_OE20Fv_IcK8o1JBc585', '$2y$13$HKFWynjlFuzM8nyB2VVJ9e76m9Nc8NFLcfLnUYdWGtCHjnQxp/Cxe', NULL, 'cliente2@email.pt', 10, 1794769334, 1794771535, NULL),
(6, 'rei1', 'NQJcv7DVZYCwj2iZBxRO36DUeC2X1Piu', '$2y$13$HqMzhOzW9qnbBcOBsYAJe.PEUU11sgYIhSRbWEnsTAsphjZEJ.2zK', NULL, 'rei@email.pt', 10, 1794770591, 1794785499, NULL),
(7, 'Ddinis', 'K0Vt4ri7oaxG8skLieLfgY_nvZSP6uny', '$2y$13$z9lksVcNICBXYevnt/YHBex3x1EZ/O8p2XzYk2tmffSf7AzSKpluC', NULL, 'D.dinis@email.pt', 8, 1794771445, 1794785493, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aula`
--
ALTER TABLE `aula`
  ADD PRIMARY KEY (`aula_id`);

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `idx-auth_assignment-user_id` (`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `fatura`
--
ALTER TABLE `fatura`
  ADD PRIMARY KEY (`fatura_id`),
  ADD KEY `idx_fatura_inscricao` (`inscricao_id`);

--
-- Indexes for table `inscricao`
--
ALTER TABLE `inscricao`
  ADD PRIMARY KEY (`inscricao_id`),
  ADD KEY `idx_inscricao_perfil` (`perfil_id`);

--
-- Indexes for table `marcacao_avaliacao`
--
ALTER TABLE `marcacao_avaliacao`
  ADD PRIMARY KEY (`marcacao_id`),
  ADD KEY `idx_marcacao_cliente` (`cliente_id`),
  ADD KEY `idx_marcacao_pt` (`pt_id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `notificacao`
--
ALTER TABLE `notificacao`
  ADD PRIMARY KEY (`notificacao_id`),
  ADD KEY `idx_notificacao_perfil` (`perfil_id`);

--
-- Indexes for table `perfil_utilizador`
--
ALTER TABLE `perfil_utilizador`
  ADD PRIMARY KEY (`perfil_id`),
  ADD UNIQUE KEY `uk_perfil_utilizador` (`user_id`);

--
-- Indexes for table `plano_treino`
--
ALTER TABLE `plano_treino`
  ADD PRIMARY KEY (`plano_id`),
  ADD KEY `idx_plano_cliente` (`cliente_id`),
  ADD KEY `idx_plano_pt` (`pt_id`);

--
-- Indexes for table `reserva_aula`
--
ALTER TABLE `reserva_aula`
  ADD PRIMARY KEY (`reserva_id`),
  ADD KEY `idx_reserva_aula` (`aula_id`),
  ADD KEY `idx_reserva_perfil` (`perfil_id`);

--
-- Indexes for table `sessao_aula`
--
ALTER TABLE `sessao_aula`
  ADD PRIMARY KEY (`sessao_id`),
  ADD KEY `idx_sessao_aula` (`aula_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aula`
--
ALTER TABLE `aula`
  MODIFY `aula_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fatura`
--
ALTER TABLE `fatura`
  MODIFY `fatura_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inscricao`
--
ALTER TABLE `inscricao`
  MODIFY `inscricao_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `marcacao_avaliacao`
--
ALTER TABLE `marcacao_avaliacao`
  MODIFY `marcacao_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notificacao`
--
ALTER TABLE `notificacao`
  MODIFY `notificacao_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `perfil_utilizador`
--
ALTER TABLE `perfil_utilizador`
  MODIFY `perfil_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `plano_treino`
--
ALTER TABLE `plano_treino`
  MODIFY `plano_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reserva_aula`
--
ALTER TABLE `reserva_aula`
  MODIFY `reserva_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sessao_aula`
--
ALTER TABLE `sessao_aula`
  MODIFY `sessao_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

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
