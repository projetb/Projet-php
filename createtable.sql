-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 02 Juin 2016 à 11:54
-- Version du serveur :  5.5.36-MariaDB-log
-- Version de PHP :  5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `decastro`
--

-- --------------------------------------------------------

--
-- Structure de la table `Administrateur`
--

CREATE TABLE IF NOT EXISTS `Administrateur` (
  `idAdmin` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(40) NOT NULL,
  PRIMARY KEY (`idAdmin`),
  UNIQUE KEY `pseudo` (`pseudo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `Album`
--

CREATE TABLE IF NOT EXISTS `Album` (
  `idAlbum` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(40) NOT NULL,
  `dateSortie` date NOT NULL,
  `genre` varchar(20) DEFAULT NULL,
  `noteGeneral` int(11) DEFAULT '0',
  `idArtiste` int(11) DEFAULT NULL,
  PRIMARY KEY (`idAlbum`),
  UNIQUE KEY `idArtiste` (`idArtiste`),
  UNIQUE KEY `idArtiste_2` (`idArtiste`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `Album`
--

INSERT INTO `Album` (`idAlbum`, `titre`, `dateSortie`, `genre`, `noteGeneral`, `idArtiste`) VALUES
(1, 'Views', '2016-04-29', 'Rap', 0, NULL),
(2, 'Feu', '2015-12-04', 'Rap', 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `Artiste`
--

CREATE TABLE IF NOT EXISTS `Artiste` (
  `idArtiste` int(11) NOT NULL AUTO_INCREMENT,
  `pseudoArtiste` varchar(40) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `ajouterPar` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`idArtiste`),
  UNIQUE KEY `pseudoArtiste` (`pseudoArtiste`),
  UNIQUE KEY `ajouterPar` (`ajouterPar`),
  UNIQUE KEY `ajouterPar_2` (`ajouterPar`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `Artiste`
--

INSERT INTO `Artiste` (`idArtiste`, `pseudoArtiste`, `description`, `ajouterPar`) VALUES
(1, 'Nekfeu', 'Rappeur', 'Maxime');

-- --------------------------------------------------------

--
-- Structure de la table `Commentaire`
--

CREATE TABLE IF NOT EXISTS `Commentaire` (
  `idCommentaire` int(11) NOT NULL AUTO_INCREMENT,
  `texte` varchar(500) NOT NULL,
  `dateCom` date NOT NULL,
  `album` int(11) NOT NULL,
  `pseudo` varchar(40) NOT NULL,
  PRIMARY KEY (`idCommentaire`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom` (`nom`,`prenom`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `contacts`
--

INSERT INTO `contacts` (`id`, `nom`, `prenom`, `email`) VALUES
(1, 'Monnerat', 'Denis', 'monnerat@u-pec.fr'),
(2, 'Valarcher', 'Pierre', 'valarcher@u-pec.fr'),
(3, 'Faivre', 'Maxime', 'maxime.faivre@etu.u-pec.fr'),
(4, 'Decastro', 'Benjamin', 'benjamin.de-castro@etu.u-pec.fr'),
(10, 'Carlu', 'Ludovic', 'ludoviccarlu@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `Note`
--

CREATE TABLE IF NOT EXISTS `Note` (
  `valeur` int(11) NOT NULL,
  `dateNote` date NOT NULL,
  `album` int(11) NOT NULL,
  `pseudo` varchar(40) NOT NULL,
  PRIMARY KEY (`album`,`pseudo`),
  UNIQUE KEY `album` (`album`),
  UNIQUE KEY `pseudo` (`pseudo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateur`
--

CREATE TABLE IF NOT EXISTS `Utilisateur` (
  `pseudo` varchar(40) NOT NULL,
  `mdp` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `nom` varchar(20) NOT NULL,
  PRIMARY KEY (`pseudo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `Administrateur`
--
ALTER TABLE `Administrateur`
  ADD CONSTRAINT `Administrateur_ibfk_1` FOREIGN KEY (`pseudo`) REFERENCES `Utilisateur` (`pseudo`);

--
-- Contraintes pour la table `Album`
--
ALTER TABLE `Album`
  ADD CONSTRAINT `Album_ibfk_1` FOREIGN KEY (`idArtiste`) REFERENCES `Artiste` (`idArtiste`);

--
-- Contraintes pour la table `Commentaire`
--
ALTER TABLE `Commentaire`
  ADD CONSTRAINT `Commentaire_ibfk_2` FOREIGN KEY (`pseudo`) REFERENCES `Utilisateur` (`pseudo`),
  ADD CONSTRAINT `Commentaire_ibfk_1` FOREIGN KEY (`album`) REFERENCES `Album` (`idAlbum`);

--
-- Contraintes pour la table `Note`
--
ALTER TABLE `Note`
  ADD CONSTRAINT `Note_ibfk_2` FOREIGN KEY (`pseudo`) REFERENCES `Utilisateur` (`pseudo`),
  ADD CONSTRAINT `Note_ibfk_1` FOREIGN KEY (`album`) REFERENCES `Album` (`idAlbum`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
