-- phpMyAdmin SQL Dump
-- version 4.4.9
-- http://www.phpmyadmin.net
--
-- Client :  localhost:8889
-- Généré le :  Jeu 20 Octobre 2016 à 09:37
-- Version du serveur :  5.5.42
-- Version de PHP :  5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `oee`
--

-- --------------------------------------------------------

--
-- Structure de la table `setting`
--

CREATE TABLE IF NOT EXISTS `setting` (
  `id` int(11) unsigned NOT NULL,
  `label` varchar(63) COLLATE utf8_bin NOT NULL,
  `description` varchar(511) COLLATE utf8_bin NOT NULL,
  `name` varchar(31) COLLATE utf8_bin NOT NULL,
  `value` varchar(63) COLLATE utf8_bin NOT NULL,
  `type` varchar(15) COLLATE utf8_bin NOT NULL,
  `other` varchar(254) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `setting`
--

INSERT INTO `setting` (`id`, `label`, `description`, `name`, `value`, `type`, `other`) VALUES
(1, 'Nom court', 'Nom court affichÃ© sur le site.', 'short-name', 'oee', 'text', ''),
(2, 'Nom long', 'Nom long affichÃ© sur le site.', 'long-name', 'Oeuvre Enfance Espoir', 'text', ''),
(3, 'Limite menu affichÃ©', 'Nombre de menu affichÃ© en haut de page', 'menu-limit', '7', 'text', ''),
(4, 'Limite de sÃ©lection', 'Nombre d''Ã©lÃ©ment sÃ©lectionnÃ© dans une liste.', 'select-limit', '5', 'text', ''),
(5, 'Contact email', 'Adresse email pour la page de contact', 'email-contact', 'eric.chauvel@neuf.fr', 'text', ''),
(6, 'Maintenance', 'Afficher la page de maintenace', 'maintenance', '0', 'radio', 'a:2:{i:0;a:2:{s:5:"label";s:3:"oui";s:5:"value";i:1;}i:1;a:2:{s:5:"label";s:3:"non";s:5:"value";i:0;}}');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
