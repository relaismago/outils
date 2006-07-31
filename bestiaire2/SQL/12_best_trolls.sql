-- phpMyAdmin SQL Dump
-- version 2.6.1
-- http://www.phpmyadmin.net
-- 
-- Serveur: localhost
-- Généré le : Mardi 26 Avril 2005 à 21:44
-- Version du serveur: 4.0.21
-- Version de PHP: 4.3.10
-- 
-- Base de données: `vue2drm`
-- 

-- --------------------------------------------------------

-- 
-- Structure de la table `best_trolls`
-- 

DROP TABLE IF EXISTS `best_trolls`;
CREATE TABLE `best_trolls` (
  `id_troll` int(11) NOT NULL default '0',
  `nom_troll` varchar(40) NOT NULL default '',
  PRIMARY KEY  (`id_troll`)
) TYPE=MyISAM;

-- 
-- Contenu de la table `best_trolls`
-- 

INSERT INTO `best_trolls` (`id_troll`, `nom_troll`) VALUES (0, 'anonyme');
