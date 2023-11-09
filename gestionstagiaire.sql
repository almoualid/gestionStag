-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 09 nov. 2023 à 14:53
-- Version du serveur : 8.0.31
-- Version de PHP : 8.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestionstagiaire`
--

-- --------------------------------------------------------

--
-- Structure de la table `compteu`
--

DROP TABLE IF EXISTS `compteu`;
CREATE TABLE IF NOT EXISTS `compteu` (
  `loginAdmin` varchar(25) NOT NULL,
  `prenom` varchar(25) DEFAULT NULL,
  `motDePasse` varchar(25) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`loginAdmin`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `compteu`
--

INSERT INTO `compteu` (`loginAdmin`, `prenom`, `motDePasse`, `nom`) VALUES
('admin1', 'Oualid', 'oualid1234', 'Almou'),
('admin2', 'Red', 'red1234', 'Reddington');

-- --------------------------------------------------------

--
-- Structure de la table `filiere`
--

DROP TABLE IF EXISTS `filiere`;
CREATE TABLE IF NOT EXISTS `filiere` (
  `IdF` varchar(25) NOT NULL,
  `intitule` varchar(25) DEFAULT NULL,
  `nombreDeGroupe` int DEFAULT NULL,
  PRIMARY KEY (`IdF`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `filiere`
--

INSERT INTO `filiere` (`IdF`, `intitule`, `nombreDeGroupe`) VALUES
('DEV', 'Developpement Digital', 1),
('GES', 'Gestion', 2),
('GC', 'Genie Civil', 2);

-- --------------------------------------------------------

--
-- Structure de la table `stagiaire`
--

DROP TABLE IF EXISTS `stagiaire`;
CREATE TABLE IF NOT EXISTS `stagiaire` (
  `IdStagiaire` int NOT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `dateDeNaissance` date DEFAULT NULL,
  `photo` text,
  `IdF` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`IdStagiaire`),
  KEY `IdF` (`IdF`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `stagiaire`
--

INSERT INTO `stagiaire` (`IdStagiaire`, `prenom`, `nom`, `dateDeNaissance`, `photo`, `IdF`) VALUES
(1, 'Oualid', 'Almou', '2002-12-01', 'image/person-icon.webp', 'GES'),
(2, 'Redd', 'Reddington', '2004-09-04', 'image/person-icon.webp', 'DEV'),
(3, 'leo', 'Messi', '2003-02-12', 'image/lionel-messi-of-argentina-reacts-in-the-second-half-against-jamaica-at-red-bull-arena-on.webp', 'GES');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
