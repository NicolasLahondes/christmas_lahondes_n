-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 23 nov. 2021 à 15:03
-- Version du serveur :  5.7.31
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `toys`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ean` varchar(13) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teaser` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `price` double NOT NULL,
  `stock` int(11) DEFAULT NULL,
  `picturemain` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picturefront` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pictureback` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manual` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fk_category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_23A0E667BB031D6` (`fk_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `ean`, `name`, `teaser`, `description`, `price`, `stock`, `picturemain`, `picturefront`, `pictureback`, `manual`, `fk_category_id`) VALUES
(1, 'EAN63202101', 'Playmobil Novelmore - Aérostat de Dario', 'Avec Playmobil Novelmore, l\'Aérostat de Dario, votre enfant imagine de nouvelles histoires médiévales pour ses figurines Playmobil. Bienvenue à Novelmore, chevaliers !', 'Bienvenue à Novelmore, chevaliers ! La ville médiévale de Novelmore est devenue célèbre suite à la création de l\'armure \"Invicibus\". Son pouvoir mythique rend invincible celui qui la porte !', 4854, 200, 'GU855215-6-619cd07455f36.jpg', 'GU855215-6-1-619cd074569dd.jpg', 'GU855215-6-2-619cd074575d0.jpg', 'pdf-exemple-619cd36c33472.pdf', 2),
(9, 'EAN63202102', 'Playmobil Novelmore - Char du trésor des Chevalier', 'Avec Playmobil Novelmore et le Char du trésor des Chevaliers, votre enfant imagine de nouvelles histoires médiévales pour ses figurines Playmobil', 'Votre enfant découvre la ville médiévale de Novelmore qui brille d’une nouvelle splendeur grâce aux trois héros Arwynn, Dario Da Vanci et Gwynn. Dario a inventé l’armure « Invincibus », dont le pouvoir mythique rend invincible quiconque la porte. Votre enfant découvrira également les Burnham Raiders, une bande de hors-la-loi et de bandits de grands chemins avec un penchant pour le feu. Ils ont eux aussi entendu parler de cette invention grandiose et des batailles féroces se préparent pour s’emparer de la puissante armure… Bienvenue à Novelmore cher aventurier ! \r\n\r\nAujourd\'hui les Chevaliers reviennent au Royaume de Novelmore avec un trésor. Ce dernier se trouve sur le char tiré par un groupe de loups. Pour se protéger d\'une attaque des Burnham Raiders, le char dispose d\'une baliste prête à tirer des projectiles. Les chevaliers possèdent également un canon pour les batailles féroces.', 5000, 4000, 'GU819290-6-619d017e03ab9.jpg', 'GU819290-6-1-619d017e044d6.jpg', 'GU819290-6-2-619d017e04bc0.jpg', 'pdf-exemple-619d01996dee7.pdf', 2),
(10, 'EAN63202103', 'Calendrier de l\'Avent Playmobil - Animaux de la fe', 'Avec le Calendrier de l\'Avent Playmobil, les animaux de la ferme, votre enfant décompte les jours jusqu\'à Noël.', 'En attendant le passage du Père Noël, votre enfant ouvre, chaque jour, l\'une des 24 fenêtres pour découvrir une surprise. Au fil des jours, votre enfant va pouvoir construire une mise en scène complète afin d\'inventer de nouvelles histoires pour ses figurines Playmobil pendant des heures de jeu.\r\n\r\nTout le monde participe à la vie de la ferme et s\'occupe des animaux. Toutes les tâches doivent être réalisées avant le réveillon de Noël. Les enfants adorent s’occuper des animaux avec le fermier et leur amènent du foin frais avec le tracteur à remorque et pelle inclinable.\r\n\r\nAvec ce calendrier de l\'avent, votre enfant suscite son imagination et créé de nombreuses scènes débordantes de réalisme pour ces personnages, ces animaux de la ferme et leurs petits : poule, cochons, vaches, lapins, chats...', 3599, 16, 'GU742441-6-619d0273ae0ba.jpg', 'GU742441-6-1-619d0273aea0b.jpg', 'GU742441-6-2-619d0273af1ae.jpg', 'pdf-exemple-619d0273af9c9.pdf', 2);

-- --------------------------------------------------------

--
-- Structure de la table `article_tag`
--

DROP TABLE IF EXISTS `article_tag`;
CREATE TABLE IF NOT EXISTS `article_tag` (
  `article_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`article_id`,`tag_id`),
  KEY `IDX_919694F97294869C` (`article_id`),
  KEY `IDX_919694F9BAD26311` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `article_tag`
--

INSERT INTO `article_tag` (`article_id`, `tag_id`) VALUES
(1, 3),
(1, 4),
(1, 6),
(9, 3),
(9, 4),
(9, 6),
(10, 2),
(10, 3),
(10, 5);

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teaser` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`, `teaser`, `picture`) VALUES
(1, 'Jouet moins de 3 ans', 'Tout pour s\'éveiller', NULL),
(2, 'Playmobile', 'En avant les histoires!', NULL);

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
('DoctrineMigrations\\Version20211123083100', '2021-11-23 08:33:42', 170),
('DoctrineMigrations\\Version20211123092202', '2021-11-23 09:22:07', 630),
('DoctrineMigrations\\Version20211123131234', '2021-11-23 13:13:11', 89);

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

DROP TABLE IF EXISTS `tag`;
CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tag`
--

INSERT INTO `tag` (`id`, `name`) VALUES
(1, 'bas-age'),
(2, 'éveil'),
(3, 'playmobile'),
(4, 'chevalier'),
(5, 'animaux'),
(6, '11 - 15 ans');

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
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `name`, `firstname`) VALUES
(2, 'cindy@kyu-solution.fr', '[\"ROLE_USER\", \"ROLE_ADMIN\"]', '$2y$13$lLU.gBemQuBuutNO5i1NMul.ZbhbyYdXx7uR9eVY8iw8S9YwsysHC', 'Poncin', 'Cindy');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `FK_23A0E667BB031D6` FOREIGN KEY (`fk_category_id`) REFERENCES `category` (`id`);

--
-- Contraintes pour la table `article_tag`
--
ALTER TABLE `article_tag`
  ADD CONSTRAINT `FK_919694F97294869C` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_919694F9BAD26311` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
