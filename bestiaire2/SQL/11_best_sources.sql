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
-- Structure de la table `best_sources`
-- 

DROP TABLE IF EXISTS `best_sources`;
CREATE TABLE `best_sources` (
  `id_troll_source` int(11) NOT NULL default '0',
  `id_mh_source` int(11) NOT NULL default '0',
  `nbr_cdms_source` int(11) NOT NULL default '1',
  KEY `id_troll_source` (`id_troll_source`),
  KEY `id_mh_source` (`id_mh_source`)
) TYPE=MyISAM COMMENT='liste des trolls ayant entré une cdm';
