-- phpMyAdmin SQL Dump
-- version 2.6.1
-- http://www.phpmyadmin.net
-- 
-- Serveur: localhost
-- G�n�r� le : Samedi 23 Avril 2005 � 17:39
-- Version du serveur: 4.0.21
-- Version de PHP: 4.3.10
-- 
-- Base de donn�es: `vue2drm`
-- 

-- --------------------------------------------------------

-- 
-- Structure de la table `best_familles`
-- 

DROP TABLE IF EXISTS `best_familles`;
CREATE TABLE `best_familles` (
  `id_famille` int(11) NOT NULL auto_increment,
  `nom_famille` varchar(60) NOT NULL default '',
  PRIMARY KEY  (`id_famille`)
) TYPE=MyISAM AUTO_INCREMENT=8 ;

-- 
-- Contenu de la table `best_familles`
-- 

INSERT INTO `best_familles` (`id_famille`, `nom_famille`) VALUES (1, 'Animal');
INSERT INTO `best_familles` (`id_famille`, `nom_famille`) VALUES (2, 'D�mon');
INSERT INTO `best_familles` (`id_famille`, `nom_famille`) VALUES (3, 'Humanoide');
INSERT INTO `best_familles` (`id_famille`, `nom_famille`) VALUES (4, 'Insecte');
INSERT INTO `best_familles` (`id_famille`, `nom_famille`) VALUES (5, 'Monstre');
INSERT INTO `best_familles` (`id_famille`, `nom_famille`) VALUES (6, 'Mort-Vivant');
INSERT INTO `best_familles` (`id_famille`, `nom_famille`) VALUES (7, 'Sp�cial');
