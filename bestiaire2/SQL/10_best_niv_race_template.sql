-- phpMyAdmin SQL Dump
-- version 2.6.1
-- http://www.phpmyadmin.net
-- 
-- Serveur: localhost
-- Généré le : Lundi 25 Avril 2005 à 15:42
-- Version du serveur: 4.0.21
-- Version de PHP: 4.3.10
-- 
-- Base de données: `vue2drm`
-- 

-- --------------------------------------------------------

-- 
-- Structure de la table `best_niv_race_template`
-- 

DROP TABLE IF EXISTS `best_niv_race_template`;
CREATE TABLE `best_niv_race_template` (
  `id_race_niv` int(11) NOT NULL default '0',
  `id_template_niv` int(11) NOT NULL default '0',
  `niv_race_niv` tinyint(3) NOT NULL default '0',
  `niv_template_niv` tinyint(3) NOT NULL default '0',
  KEY `id_race_niv` (`id_race_niv`),
  KEY `id_template_niv` (`id_template_niv`)
) TYPE=MyISAM COMMENT='incohérences de niveau entre race et template';
