-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 08-Jan-2021 às 16:45
-- Versão do servidor: 8.0.18
-- versão do PHP: 7.2.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `yii2advanced`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `anuncio`
--

DROP TABLE IF EXISTS `anuncio`;
CREATE TABLE IF NOT EXISTS `anuncio` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_proprietario` int(11) DEFAULT NULL,
  `id_casa` int(10) UNSIGNED DEFAULT NULL,
  `titulo` varchar(45) NOT NULL,
  `preco` int(11) NOT NULL,
  `data_criacao` date NOT NULL,
  `data_disponibilidade` date NOT NULL,
  `despesas_inc` tinyint(1) NOT NULL,
  `descricao` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_proprietario` (`id_proprietario`),
  KEY `id_casa` (`id_casa`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `anuncio`
--

INSERT INTO `anuncio` (`id`, `id_proprietario`, `id_casa`, `titulo`, `preco`, `data_criacao`, `data_disponibilidade`, `despesas_inc`, `descricao`) VALUES
(10, 10, 6, 'Quarto imperdivel', 190, '2021-01-04', '2021-01-05', 1, 'Com boa luz solar, ambiente calmo e sereno'),
(11, 10, 7, 'Quarto para não perder', 200, '2021-01-04', '2021-01-05', 0, 'Boa luz solar, com terraços');

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `idx-auth_assignment-user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('addAnuncio', 2, 'Publicar Anuncio', NULL, NULL, 1605644566, 1605644566),
('admin', 1, NULL, NULL, NULL, 1605644566, 1605644566),
('blockAnuncio', 2, 'Bloquear um anuncio', NULL, NULL, 1605644566, 1605644566),
('blockUser', 2, 'Bloquear um utilizador', NULL, NULL, 1605644565, 1605644565),
('delAnuncio', 2, 'Eliminar anuncio', NULL, NULL, 1605644566, 1605644566),
('editAnuncio', 2, 'Editar Anuncio', NULL, NULL, 1605644566, 1605644566),
('senhorio', 1, NULL, NULL, NULL, 1605644566, 1605644566),
('unblockAnuncio', 2, 'Desbloquear um anuncio', NULL, NULL, 1605644566, 1605644566),
('unblockUser', 2, 'Desbloquear um utilizador', NULL, NULL, 1605644566, 1605644566);

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_item_child`--

DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('senhorio', 'addAnuncio'),
('admin', 'blockAnuncio'),
('admin', 'blockUser'),
('senhorio', 'delAnuncio'),
('senhorio', 'editAnuncio'),
('admin', 'unblockAnuncio'),
('admin', 'unblockUser');

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `casa`
--

DROP TABLE IF EXISTS `casa`;
CREATE TABLE IF NOT EXISTS `casa` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_proprietario` int(11) DEFAULT NULL,
  `nome_rua` varchar(45) NOT NULL,
  `localizacao` point DEFAULT NULL,
  `tipo_alojamento` enum('apartamento','moradia') NOT NULL,
  `wifi` tinyint(1) NOT NULL,
  `limpeza` enum('quinzenal','mensal','nao') NOT NULL,
  `capacidade` int(11) NOT NULL,
  `num_quartos` int(11) NOT NULL,
  `num_wcs` int(11) NOT NULL,
  `aquecimento_agua` enum('termoacumulador','esquentador') NOT NULL,
  `area_exterior` tinyint(1) NOT NULL,
  `animais` tinyint(1) NOT NULL,
  `fumar` tinyint(1) NOT NULL,
  `visitantes_pernoitar` tinyint(1) NOT NULL,
  `foto` longblob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_proprietario` (`id_proprietario`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `casa`
--

INSERT INTO `casa` (`id`, `id_proprietario`, `nome_rua`, `localizacao`, `tipo_alojamento`, `wifi`, `limpeza`, `capacidade`, `num_quartos`, `num_wcs`, `aquecimento_agua`, `area_exterior`, `animais`, `fumar`, `visitantes_pernoitar`, `foto`) VALUES
(6, 10, 'Rua das Flores', 0x000000000101000000000000000000444000000000000059c0, 'apartamento', 0, 'mensal', 4, 4, 2, 'esquentador', 0, 0, 0, 1, ''),
(7, 10, 'Rua Padre Américo', 0x000000000101000000000000000000444000000000000059c0, 'apartamento', 0, 'mensal', 4, 4, 2, 'esquentador', 0, 0, 0, 1, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cozinha`
--

DROP TABLE IF EXISTS `cozinha`;
CREATE TABLE IF NOT EXISTS `cozinha` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_casa` int(10) UNSIGNED NOT NULL,
  `lava_loica` tinyint(1) NOT NULL,
  `maquina_roupa` tinyint(1) NOT NULL,
  `maquina_loica` tinyint(1) NOT NULL,
  `tostadeira` tinyint(1) NOT NULL,
  `torradeira` tinyint(1) NOT NULL,
  `mircro_ondas` tinyint(1) NOT NULL,
  `frigorifico` enum('sem congelador','com congelador') NOT NULL,
  `arca` tinyint(1) NOT NULL,
  `fogao` enum('gas','eletrico') NOT NULL,
  `forno` tinyint(1) NOT NULL,
  `foto` varbinary(1024) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_casa` (`id_casa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `cozinha`
--

INSERT INTO `cozinha` (`id`, `id_casa`, `lava_loica`, `maquina_roupa`, `maquina_loica`, `tostadeira`, `torradeira`, `mircro_ondas`, `frigorifico`, `arca`, `fogao`, `forno`, `foto`) VALUES
(0, 6, 1, 1, 0, 1, 1, 1, 'com congelador', 0, 'eletrico', 1, ''),
(10, 7, 1, 0, 1, 1, 1, 1, 'com congelador', 1, 'eletrico', 0, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estatistica`
--

DROP TABLE IF EXISTS `estatistica`;
CREATE TABLE IF NOT EXISTS `estatistica` (
  `num_users` int(11) NOT NULL,
  `num_genero_mas` int(11) NOT NULL,
  `num_genero_fem` int(11) NOT NULL,
  `idade_media` int(11) NOT NULL,
  `preco_medio` int(11) NOT NULL,
  `anuncios_pub_mes` int(11) NOT NULL,
  `anuncios_pub_ano` int(11) NOT NULL,
  `reservas_mes` int(11) NOT NULL,
  `reservas_ano` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `horario`
--

DROP TABLE IF EXISTS `horario`;
CREATE TABLE IF NOT EXISTS `horario` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_perfil` int(11) DEFAULT NULL,
  `hora_comeco` time NOT NULL,
  `hora_fim` time NOT NULL,
  `dia_semana` enum('segunda','terca','quarta','quinta','sexta') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_perfil` (`id_perfil`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `migration`
--

DROP TABLE IF EXISTS `migration`;
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1605629666),
('m130524_201442_init', 1605629670),
('m190124_110200_add_verification_token_column_to_user_table', 1605629670),
('m140506_102106_rbac_init', 1605629957),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1605629958),
('m180523_151638_rbac_updates_indexes_without_prefix', 1605629959),
('m200409_110543_rbac_update_mssql_trigger', 1605629959),
('m201117_180028_init_rbac', 1605644566);

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfil`
--

DROP TABLE IF EXISTS `perfil`;
CREATE TABLE IF NOT EXISTS `perfil` (
  `id_user` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  `data_nascimento` date NOT NULL,
  `numero_telemovel` int(11) NOT NULL,
  `primeiro_nome` varchar(45) NOT NULL,
  `ultimo_nome` varchar(45) NOT NULL,
  `genero` enum('masculino','feminino') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `numero_telemovel` (`numero_telemovel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `perfil`
--

INSERT INTO `perfil` (`id_user`, `tipo`, `data_nascimento`, `numero_telemovel`, `primeiro_nome`, `ultimo_nome`, `genero`) VALUES
(10, 2, '1960-06-15', 987654321, 'António', 'Augusto', 'masculino'),
(11, 1, '1998-08-21', 900899766, 'Filipa', 'Gomes', 'feminino');

-- --------------------------------------------------------

--
-- Estrutura da tabela `quarto`
--

DROP TABLE IF EXISTS `quarto`;
CREATE TABLE IF NOT EXISTS `quarto` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_casa` int(10) UNSIGNED DEFAULT NULL,
  `disponibilidade` tinyint(1) NOT NULL,
  `tamanho` enum('pequeno','medio','grande') NOT NULL,
  `tipo_cama` enum('solteiro','casal') NOT NULL,
  `varanda` tinyint(1) NOT NULL,
  `secretaria` tinyint(1) NOT NULL,
  `armario` tinyint(1) NOT NULL,
  `ac` tinyint(1) NOT NULL,
  `foto` varbinary(1024) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_casa` (`id_casa`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `quarto`
--

INSERT INTO `quarto` (`id`, `id_casa`, `disponibilidade`, `tamanho`, `tipo_cama`, `varanda`, `secretaria`, `armario`, `ac`, `foto`) VALUES
(2, 6, 1, 'medio', 'solteiro', 1, 1, 1, 1, ''),
(3, 7, 1, 'grande', 'casal', 1, 1, 1, 1, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `reserva`
--

DROP TABLE IF EXISTS `reserva`;
CREATE TABLE IF NOT EXISTS `reserva` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_estudante` int(11) DEFAULT NULL,
  `id_anuncio` int(10) UNSIGNED DEFAULT NULL,
  `data_reserva` date NOT NULL,
  `data_entrada` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_estudante` (`id_estudante`),
  KEY `id_anuncio` (`id_anuncio`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `reserva`
--

INSERT INTO `reserva` (`id`, `id_estudante`, `id_anuncio`, `data_reserva`, `data_entrada`) VALUES
(2, 11, 10, '2021-01-06', '2021-01-21');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sala`
--

DROP TABLE IF EXISTS `sala`;
CREATE TABLE IF NOT EXISTS `sala` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_casa` int(10) UNSIGNED DEFAULT NULL,
  `televisao` tinyint(1) NOT NULL,
  `sofa` tinyint(1) NOT NULL,
  `moveis` tinyint(1) NOT NULL,
  `mesa` tinyint(1) NOT NULL,
  `aquecimento` enum('lareira','salamandras','nao') NOT NULL,
  `ac` tinyint(1) NOT NULL,
  `foto` varbinary(1024) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_casa` (`id_casa`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `sala`
--

INSERT INTO `sala` (`id`, `id_casa`, `televisao`, `sofa`, `moveis`, `mesa`, `aquecimento`, `ac`, `foto`) VALUES
(2, 6, 1, 1, 0, 1, 'nao', 1, ''),
(3, 7, 1, 1, 1, 1, 'salamandras', 1, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(10, 'antonio_augusto', '', '$2y$13$SYY296.rwoH7ijn0u5D3muQ1xHxugFU5QTGal0P95LumXYHv3gubK', NULL, 'antonio_augusto@gmail.com', 10, 1609784936, 1609784936, NULL),
(11, 'filipa_gomes', '', '$2y$13$cToWj1AbQtqulCGHdjOsouB27Fuz7hR79tO6hIxJu6.tiST0pels.', NULL, 'filipa_gomes@gmail.com', 10, 1609784988, 1609784988, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `visita`
--

DROP TABLE IF EXISTS `visita`;
CREATE TABLE IF NOT EXISTS `visita` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_estudante` int(11) DEFAULT NULL,
  `id_anuncio` int(10) UNSIGNED DEFAULT NULL,
  `hora_visita` time NOT NULL,
  `data_visita` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_estudante` (`id_estudante`),
  KEY `id_anuncio` (`id_anuncio`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `visita`
--

INSERT INTO `visita` (`id`, `id_estudante`, `id_anuncio`, `hora_visita`, `data_visita`) VALUES
(3, 11, 11, '07:00:00', '2021-01-13');

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `anuncio`
--
ALTER TABLE `anuncio`
  ADD CONSTRAINT `anuncio_ibfk_1` FOREIGN KEY (`id_proprietario`) REFERENCES `perfil` (`id_user`),
  ADD CONSTRAINT `anuncio_ibfk_2` FOREIGN KEY (`id_casa`) REFERENCES `casa` (`id`);

--
-- Limitadores para a tabela `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Limitadores para a tabela `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `casa`
--
ALTER TABLE `casa`
  ADD CONSTRAINT `casa_ibfk_1` FOREIGN KEY (`id_proprietario`) REFERENCES `perfil` (`id_user`);

--
-- Limitadores para a tabela `cozinha`
--
ALTER TABLE `cozinha`
  ADD CONSTRAINT `cozinha_ibfk_1` FOREIGN KEY (`id_casa`) REFERENCES `casa` (`id`);

--
-- Limitadores para a tabela `horario`
--
ALTER TABLE `horario`
  ADD CONSTRAINT `horario_ibfk_1` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id_user`);

--
-- Limitadores para a tabela `perfil`
--
ALTER TABLE `perfil`
  ADD CONSTRAINT `perfil_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Limitadores para a tabela `quarto`
--
ALTER TABLE `quarto`
  ADD CONSTRAINT `quarto_ibfk_1` FOREIGN KEY (`id_casa`) REFERENCES `casa` (`id`);

--
-- Limitadores para a tabela `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `reserva_ibfk_1` FOREIGN KEY (`id_estudante`) REFERENCES `perfil` (`id_user`),
  ADD CONSTRAINT `reserva_ibfk_2` FOREIGN KEY (`id_anuncio`) REFERENCES `anuncio` (`id`);

--
-- Limitadores para a tabela `sala`
--
ALTER TABLE `sala`
  ADD CONSTRAINT `sala_ibfk_1` FOREIGN KEY (`id_casa`) REFERENCES `casa` (`id`);

--
-- Limitadores para a tabela `visita`
--
ALTER TABLE `visita`
  ADD CONSTRAINT `visita_ibfk_1` FOREIGN KEY (`id_estudante`) REFERENCES `perfil` (`id_user`),
  ADD CONSTRAINT `visita_ibfk_2` FOREIGN KEY (`id_anuncio`) REFERENCES `anuncio` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
