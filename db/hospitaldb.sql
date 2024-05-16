-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 16 mai 2024 à 00:21
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `hospitaldb`
--

-- --------------------------------------------------------

--
-- Structure de la table `consultation`
--

DROP TABLE IF EXISTS `consultation`;
CREATE TABLE IF NOT EXISTS `consultation` (
  `IDCONSULTATION` int(11) NOT NULL,
  `NUMERODOSSIER` int(11) NOT NULL,
  `DIAGNOSTIC` text,
  `PRESCRIPTION` text,
  `ACTEMEDICAL` text,
  `DATECONSULTATION` date DEFAULT NULL,
  `DATECONTROLE` date DEFAULT NULL,
  `OBSERVATION` text,
  `TENSION` varchar(25) NOT NULL,
  `POIDS` int(11) NOT NULL,
  `TAILLE` int(11) NOT NULL,
  `TEMPERATURE` int(11) NOT NULL,
  PRIMARY KEY (`IDCONSULTATION`),
  KEY `FK_CONCERNER` (`NUMERODOSSIER`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `dossier`
--

DROP TABLE IF EXISTS `dossier`;
CREATE TABLE IF NOT EXISTS `dossier` (
  `NUMERODOSSIER` int(11) NOT NULL,
  `NOM` text,
  `PRENOM` text,
  `DATENAISSANCE` date DEFAULT NULL,
  `LIEUNAISSANCE` text,
  `SEXE` text,
  `PROFESSION` text,
  `CONTACT` text,
  `EMAIL` text,
  `GROUPESANGUIN` text,
  `ANTECEDANTS` text,
  `HABITATION` text,
  PRIMARY KEY (`NUMERODOSSIER`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `examencomplementaire`
--

DROP TABLE IF EXISTS `examencomplementaire`;
CREATE TABLE IF NOT EXISTS `examencomplementaire` (
  `IDEXAMENCOMPL` char(10) NOT NULL,
  `LIBELLEEXAMCOMPL` char(10) DEFAULT NULL,
  PRIMARY KEY (`IDEXAMENCOMPL`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `necessiter`
--

DROP TABLE IF EXISTS `necessiter`;
CREATE TABLE IF NOT EXISTS `necessiter` (
  `IDCONSULTATION` int(11) NOT NULL,
  `IDEXAMENCOMPL` char(10) NOT NULL,
  `DATEEXAMEN` date DEFAULT NULL,
  `CAUSEEXAMEN` text,
  `RESULTATS` text,
  PRIMARY KEY (`IDCONSULTATION`,`IDEXAMENCOMPL`),
  KEY `FK_NECESSITER` (`IDEXAMENCOMPL`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `participer`
--

DROP TABLE IF EXISTS `participer`;
CREATE TABLE IF NOT EXISTS `participer` (
  `IDCONSULTATION` int(11) NOT NULL,
  `IDSPECIALISTE` int(11) NOT NULL,
  `TACHE` text,
  PRIMARY KEY (`IDCONSULTATION`,`IDSPECIALISTE`),
  KEY `FK_PARTICIPER` (`IDSPECIALISTE`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `specialiste`
--

DROP TABLE IF EXISTS `specialiste`;
CREATE TABLE IF NOT EXISTS `specialiste` (
  `IDSPECIALISTE` int(11) NOT NULL,
  `NOMSPECIALISTE` text,
  `PRENOMSPECIALISTE` text,
  `SPECIALITEDUSPECIALISTE` text,
  `GRADESPECIALISTE` text,
  `EMAIL` varchar(100) NOT NULL,
  `PASSWORD` varchar(100) NOT NULL,
  PRIMARY KEY (`IDSPECIALISTE`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
