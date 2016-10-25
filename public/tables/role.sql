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
-- Structure de la table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(31) NOT NULL,
  `label` varchar(63) NOT NULL,
  `description` varchar(511) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `capability_access_admin` tinyint(1) NOT NULL DEFAULT '0',
  `capability_admin` tinyint(1) NOT NULL DEFAULT '0',
  `capability_editor` tinyint(1) NOT NULL DEFAULT '0',
  `capability_author` tinyint(1) NOT NULL DEFAULT '0',
  `capability_member` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `role`
--

INSERT INTO `role` (`id`, `name`, `label`, `description`, `capability_access_admin`, `capability_admin`, `capability_editor`, `capability_author`, `capability_member`) VALUES
(1, 'admin', 'Admin', 'A tous les droits.', 1, 1, 1, 1, 1),
(2, 'editor', 'Editeur', 'GÃ¨re toutes les feuilles et tous les articles.', 1, 0, 1, 1, 1),
(3, 'author', 'Auteur', 'GÃ¨re que ses feuilles et ses les articles.', 1, 0, 0, 1, 1),
(4, 'member', 'Membre', 'Ne peux que consulter les rapports (cÃ´tÃ© utilisateur)', 0, 0, 0, 0, 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
