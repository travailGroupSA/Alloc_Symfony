-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 13 juil. 2020 à 09:29
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `allocation_chambre_symf_dev`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_880E0D76F85E0677` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `username`, `roles`, `password`) VALUES
(1, 'admin', '[]', '$argon2id$v=19$m=65536,t=4,p=1$SVFwUk5DS0pZYjBLZ0ROaw$EreT8izdUeEZ/e/6IKHno3W/IBwCJpAYclUa+nIYZyU');

-- --------------------------------------------------------

--
-- Structure de la table `chambre`
--

DROP TABLE IF EXISTS `chambre`;
CREATE TABLE IF NOT EXISTS `chambre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num_chambre` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_batiment` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `chambre`
--

INSERT INTO `chambre` (`id`, `num_chambre`, `num_batiment`, `type`) VALUES
(1, '0025172', '2', 'a deux'),
(2, '0331154', '33', 'individuel'),
(3, '0061566', '6', 'individuel'),
(4, '0091240', '9', 'a deux'),
(5, '9991057', '999', 'individuel'),
(6, '9981516', '998', 'individuel');

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
('DoctrineMigrations\\Version20200706140600', '2020-07-06 14:06:11', 1522),
('DoctrineMigrations\\Version20200706141143', '2020-07-06 14:11:51', 999);

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

DROP TABLE IF EXISTS `etudiant`;
CREATE TABLE IF NOT EXISTS `etudiant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chambre_id` int(11) DEFAULT NULL,
  `matricule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `boursier` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_inscription` datetime NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `montant_bourse` int(11) DEFAULT NULL,
  `telephone` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_717E22E39B177F54` (`chambre_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`id`, `chambre_id`, `matricule`, `prenom`, `nom`, `birthday`, `boursier`, `date_inscription`, `adresse`, `montant_bourse`, `telephone`, `email`) VALUES
(1, 1, '2020TEST1296', 'test', 'test', '2015-01-01', 'demi', '2020-07-06 14:17:04', 'dakar', 20000, 772446746, 'test@gmail.com'),
(2, 2, '2020DILY5825', 'saly', 'dione', '2015-01-01', 'entiere', '2020-07-06 14:17:43', NULL, 40000, 776698855, 'saly@dione.sa'),
(3, 6, '2020FANE1598', 'Assane', 'Faye', '2015-01-01', NULL, '2020-07-06 14:18:29', 'dakar', NULL, 772436746, 'Assane@sa.sn');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD CONSTRAINT `FK_717E22E39B177F54` FOREIGN KEY (`chambre_id`) REFERENCES `chambre` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
