-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 08 Juin 2016 à 18:20
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `Administrateur`
--

INSERT INTO `Administrateur` (`idAdmin`, `pseudo`) VALUES
(2, 'admin'),
(1, 'burnning');

-- --------------------------------------------------------

--
-- Structure de la table `Album`
--

CREATE TABLE IF NOT EXISTS `Album` (
  `idAlbum` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(40) NOT NULL,
  `dateSortie` date NOT NULL,
  `genre` varchar(20) DEFAULT NULL,
  `noteGeneral` float DEFAULT '0',
  `idArtiste` int(11) DEFAULT NULL,
  `pochette` varchar(500) DEFAULT 'http://static.openruby.com/assets/pages/d9/41/d9412a06dcc425bcc72a91c523749725_330.jpg',
  PRIMARY KEY (`idAlbum`),
  KEY `Album_ibfk_1` (`idArtiste`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- Contenu de la table `Album`
--

INSERT INTO `Album` (`idAlbum`, `titre`, `dateSortie`, `genre`, `noteGeneral`, `idArtiste`, `pochette`) VALUES
(1, 'Views', '2016-04-29', 'Rap', 4, 2, 'http://www.lesinrocks.com/wp-content/thumbnails/uploads/2016/04/drake-2-tt-width-604-height-403-crop-0-bgcolor-000000-nozoom_default-1-lazyload-0.jpg'),
(2, 'Feu', '2015-12-04', 'Rap', 4, 1, 'http://www.raprnb.com/wp-content/uploads/2015/04/NekfeuCoverFeu.jpg'),
(36, 'Feu_Reedition', '2015-12-04', 'Rap', 4, 1, 'http://www.mouv.fr/sites/default/files/2015/10/31/220211/neklefennec.jpg'),
(37, 'Thank_Me_Later', '2010-06-15', 'Rap', 0, 2, 'http://img7.hostingpics.net/pics/47986200_Drake_Thank_Me_Later_2010.jpg'),
(38, 'Take_Care', '2011-04-20', 'Rap', 0, 2, 'http://www.surlmag.fr/wp-content/uploads/2011/11/Untitled-129.jpg'),
(39, 'Nothing_Was_The_Same', '2013-09-20', 'Rap', 0, 2, 'https://upload.wikimedia.org/wikipedia/en/b/b9/Nothing_Was_the_Same_cover_2.png'),
(40, 'Cloud_Nine', '2016-05-13', 'Chill', 0, 16, 'http://media.virginradio.fr/pmedia-3173920-ajust_640-f1458567240/la-pochette-de-l-album-cloud-nine-de-kygo.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `Artiste`
--

CREATE TABLE IF NOT EXISTS `Artiste` (
  `idArtiste` int(11) NOT NULL AUTO_INCREMENT,
  `pseudoArtiste` varchar(40) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `ajouterPar` varchar(40) DEFAULT NULL,
  `profil` varchar(500) DEFAULT 'http://png.clipart.me/graphics/thumbs/149/male-avatar-profile-picture-vector_149083895.jpg',
  PRIMARY KEY (`idArtiste`),
  UNIQUE KEY `pseudoArtiste` (`pseudoArtiste`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Contenu de la table `Artiste`
--

INSERT INTO `Artiste` (`idArtiste`, `pseudoArtiste`, `description`, `ajouterPar`, `profil`) VALUES
(1, 'Nekfeu', 'Rappeur', 'Maxime', 'http://anything-ispossible.com/wp-content/uploads/2015/07/tumblr_nmas9a2YnD1rqd7uco1_1280-1024x1024.jpg'),
(2, 'Drake', 'Rappeur', 'Maxime', 'http://www.clique.tv/wp-content/uploads/2016/04/drake1.jpg'),
(16, 'Kygo', 'DJ', 'burnning', 'http://www.billboard.com/files/styles/article_main_image/public/media/kygo-portrait-jan-2016-billboard-650.jpg'),
(17, 'JCole', 'US', 'burnning', 'http://generations.fr/media/articles/j-cole-jpg1.jpg'),
(18, 'PNL', '-', 'burnning', 'http://www.lesinrocks.com/wp-content/thumbnails/uploads/2015/10/ap-300x380-pnl-showcase-paris-20151-tt-width-300-height-380-lazyload-0-fill-0-crop-0-bgcolor-FFFFFF.gif'),
(19, 'KendrickLammar', 'US', 'burnning', 'http://cache.umusic.com/_sites/kendricklamar.com/images/og.jpg'),
(20, 'MikePosner', 'Singer', 'burnning', 'http://meetattitude.com/wp-content/uploads/2016/04/Mike-Posner.jpg');

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
  PRIMARY KEY (`idCommentaire`),
  KEY `Commentaire_ibfk_2` (`pseudo`),
  KEY `Commentaire_ibfk_1` (`album`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

--
-- Contenu de la table `Commentaire`
--

INSERT INTO `Commentaire` (`idCommentaire`, `texte`, `dateCom`, `album`, `pseudo`) VALUES
(38, 'aaa', '2016-06-08', 2, 'admin'),
(42, '', '2016-06-08', 1, 'admin');

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
-- Structure de la table `enseignant`
--

CREATE TABLE IF NOT EXISTS `enseignant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `bureau` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Contenu de la table `enseignant`
--

INSERT INTO `enseignant` (`id`, `nom`, `prenom`, `email`, `bureau`) VALUES
(1, 'Monnerat ', 'Denis', 'monnerat@u-pec.fr', 114),
(2, 'Loukianov ', 'Oleg', 'oleg.loukianov@u-pec.fr', 114),
(3, 'Cegielski', 'Patrick', 'cegielski@u-pec.fr', 112),
(4, 'Renaud', 'Marie-HÃ©lÃ¨ne', 'marie-helene.renaud@u-pec.fr', 113),
(5, 'Hernandez', 'Luc', 'luc.hernandez@u-pec.fr', 111),
(6, 'Crouan-Veron', 'Patricia', 'crouan@u-pec.fr', 113),
(7, 'Valarcher', 'Pierre', 'valarcher@u-pec.fr', 114),
(8, 'Gervais', 'FrÃ©deric', 'frederic.gervais@u-pec.fr', 113);

-- --------------------------------------------------------

--
-- Structure de la table `Note`
--

CREATE TABLE IF NOT EXISTS `Note` (
  `valeur` int(11) NOT NULL,
  `dateNote` date NOT NULL,
  `album` int(11) NOT NULL,
  `pseudo` varchar(40) NOT NULL,
  PRIMARY KEY (`album`,`pseudo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Note`
--

INSERT INTO `Note` (`valeur`, `dateNote`, `album`, `pseudo`) VALUES
(3, '2016-06-08', 2, 'admin');

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
  `valide` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pseudo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Utilisateur`
--

INSERT INTO `Utilisateur` (`pseudo`, `mdp`, `email`, `prenom`, `nom`, `valide`) VALUES
('admin', 'a', 'admin@free.fr', 'a', 'a', 1),
('burnning', 'mama', 'mama@free.fr', 'max', 'faiv', 1),
('BXB77', 'a', 'benjamindecastro@hotmail.fr', 'Benjamin', 'Benjamin dc', 1);

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
  ADD CONSTRAINT `Commentaire_ibfk_1` FOREIGN KEY (`album`) REFERENCES `Album` (`idAlbum`),
  ADD CONSTRAINT `Commentaire_ibfk_2` FOREIGN KEY (`pseudo`) REFERENCES `Utilisateur` (`pseudo`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
