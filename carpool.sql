-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 30 juin 2024 à 18:42
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `carpool`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(255) NOT NULL,
  `admin_login` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_login`, `admin_password`) VALUES
(1, 'sylvio', 'admin', '$2y$10$HCZiXywbpSJEVGWIwyNPSeNELDPZTwNIJpewJncX5.9ZeXuqtEHHS');

-- --------------------------------------------------------

--
-- Structure de la table `annonce`
--

DROP TABLE IF EXISTS `annonce`;
CREATE TABLE IF NOT EXISTS `annonce` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Date_depart` datetime DEFAULT NULL,
  `Nombre_places` int DEFAULT NULL,
  `Destination` int NOT NULL,
  `utilisateur` int NOT NULL,
  `Depart` varchar(255) DEFAULT NULL,
  `info_sup` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `Id_1` (`Destination`),
  KEY `Id_2` (`utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

DROP TABLE IF EXISTS `avis`;
CREATE TABLE IF NOT EXISTS `avis` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Message` varchar(250) DEFAULT NULL,
  `Nombre_etoiles` int DEFAULT NULL,
  `Date_avis` datetime DEFAULT NULL,
  `Id_utilisateur1` int NOT NULL,
  `Id_utilisateur2` int NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Id_1` (`Id_utilisateur1`),
  KEY `Id_2` (`Id_utilisateur2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `destination`
--

DROP TABLE IF EXISTS `destination`;
CREATE TABLE IF NOT EXISTS `destination` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Nom` varchar(250) DEFAULT NULL,
  `Adresse` varchar(250) DEFAULT NULL,
  `Coordonnees` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `destination`
--

INSERT INTO `destination` (`Id`, `Nom`, `Adresse`, `Coordonnees`) VALUES
(1, 'MNS', '86 rue aux Arènes', '49.1094016,6.1702144'),
(2, 'IFA', '4 Rue Saint-Charles', '49.11488723754883,6.1810784339904785');

-- --------------------------------------------------------

--
-- Structure de la table `promo`
--

DROP TABLE IF EXISTS `promo`;
CREATE TABLE IF NOT EXISTS `promo` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Nom` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `promo`
--

INSERT INTO `promo` (`Id`, `Nom`) VALUES
(1, 'BSD'),
(2, 'BSRC'),
(3, 'DEVWEB'),
(4, 'TSSR');

-- --------------------------------------------------------

--
-- Structure de la table `reserver`
--

DROP TABLE IF EXISTS `reserver`;
CREATE TABLE IF NOT EXISTS `reserver` (
  `Id_utilisateur` int NOT NULL,
  `Id_annonce` int NOT NULL,
  `Date_depart` datetime DEFAULT NULL,
  PRIMARY KEY (`Id_utilisateur`,`Id_annonce`),
  KEY `Id_1` (`Id_annonce`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `Id_utilisateur` int NOT NULL AUTO_INCREMENT,
  `Nom_utilisateur` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Prenom_utilisateur` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Mot_de_passe_utilisateur` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Mail_utilisateur` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Adresse_utilisateur` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `tel_utilisateur` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Photo_profil_utilisateur` json DEFAULT NULL,
  `Id_promo_utilisateur` int NOT NULL,
  PRIMARY KEY (`Id_utilisateur`),
  KEY `Id_1` (`Id_promo_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `annonce`
--
ALTER TABLE `annonce`
  ADD CONSTRAINT `annonce_ibfk_1` FOREIGN KEY (`Destination`) REFERENCES `destination` (`Id`),
  ADD CONSTRAINT `annonce_ibfk_2` FOREIGN KEY (`utilisateur`) REFERENCES `utilisateurs` (`Id_utilisateur`);

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `avis_ibfk_1` FOREIGN KEY (`Id_utilisateur1`) REFERENCES `utilisateurs` (`Id_utilisateur`),
  ADD CONSTRAINT `avis_ibfk_2` FOREIGN KEY (`Id_utilisateur2`) REFERENCES `utilisateurs` (`Id_utilisateur`);

--
-- Contraintes pour la table `reserver`
--
ALTER TABLE `reserver`
  ADD CONSTRAINT `reserver_ibfk_1` FOREIGN KEY (`Id_utilisateur`) REFERENCES `utilisateurs` (`Id_utilisateur`),
  ADD CONSTRAINT `reserver_ibfk_2` FOREIGN KEY (`Id_annonce`) REFERENCES `annonce` (`Id`);

--
-- Contraintes pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD CONSTRAINT `utilisateurs_ibfk_1` FOREIGN KEY (`Id_promo_utilisateur`) REFERENCES `promo` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
