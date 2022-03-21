-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 21 mars 2022 à 23:19
-- Version du serveur : 5.7.36
-- Version de PHP : 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `pegase_market_test`
--

-- --------------------------------------------------------

--
-- Structure de la table `callback_request`
--

DROP TABLE IF EXISTS `callback_request`;
CREATE TABLE IF NOT EXISTS `callback_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `call_slot_id` int(11) DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `callback_date` date NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_AEBE3B648C4088A9` (`call_slot_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `callback_request`
--

INSERT INTO `callback_request` (`id`, `call_slot_id`, `lastname`, `firstname`, `email`, `phone`, `callback_date`, `message`) VALUES
(1, 1, 'LE BEAU', 'Morgan', 'morganlebeau53@gmail.com', '0601645406', '2022-02-25', 'Bienvenue'),
(2, 2, 'DOE', 'John', 'john.doe@gmail.com', '+33102030405', '2022-03-21', 'test'),
(3, 1, 'RABIENKO', 'Danil', 'danil.rabienko@pegase-market.com', '0201030405', '2023-12-19', ''),
(4, 2, 'DOE', 'Jane', 'jane.doe@gmail.com', '+33658596235', '2022-03-21', 'test'),
(5, 1, 'PARKER', 'Peter', 'spiderman@wanadoo.fr', '0808080808', '2022-03-21', 'Spiderman'),
(6, 1, 'WAYNE', 'Bruce', 'batman@gotham.com', '0101010101', '2022-03-25', 'I\'m Batman !'),
(7, 2, 'BANNER', 'Bruce', 'hulk@labs.com', '0202020202', '2022-03-29', 'HULK SMASH !!'),
(8, 2, 'KENT', 'Clark', 'superman@metrocity.com', '0303030303', '2022-03-28', '');

-- --------------------------------------------------------

--
-- Structure de la table `call_slot`
--

DROP TABLE IF EXISTS `call_slot`;
CREATE TABLE IF NOT EXISTS `call_slot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `call_slot`
--

INSERT INTO `call_slot` (`id`, `label`, `start_time`, `end_time`) VALUES
(1, 'Matin', '09:00:00', '11:00:00'),
(2, 'Après-midi', '14:00:00', '16:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220319164301', '2022-03-19 16:43:29', 1865),
('DoctrineMigrations\\Version20220321221052', '2022-03-21 22:11:17', 300),
('DoctrineMigrations\\Version20220321231350', '2022-03-21 23:14:02', 491);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`) VALUES
(1, 'admin', '[\"ROLE_ADMIN\"]', '$2y$13$xegdUk72nUiahxoY8uVBNOk7zF.pi0KR4D1wmrHfn.PHYjpYFRm0.');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `callback_request`
--
ALTER TABLE `callback_request`
  ADD CONSTRAINT `FK_AEBE3B648C4088A9` FOREIGN KEY (`call_slot_id`) REFERENCES `call_slot` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
