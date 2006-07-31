-- phpMyAdmin SQL Dump
-- version 2.6.1
-- http://www.phpmyadmin.net
-- 
-- Serveur: localhost
-- Généré le : Samedi 23 Avril 2005 à 17:44
-- Version du serveur: 4.0.21
-- Version de PHP: 4.3.10
-- 
-- Base de données: `vue2drm`
-- 

-- --------------------------------------------------------

-- 
-- Structure de la table `best_ages`
-- 

DROP TABLE IF EXISTS `best_ages`;
CREATE TABLE `best_ages` (
  `id_age` int(11) NOT NULL auto_increment,
  `id_famille_age` int(11) NOT NULL default '0',
  `M_age` varchar(60) NOT NULL default '',
  `F_age` varchar(60) NOT NULL default '',
  `ordre_age` tinyint(3) NOT NULL default '0',
  PRIMARY KEY  (`id_age`),
  KEY `Famille` (`id_famille_age`)
) TYPE=MyISAM COMMENT='Différents ages pour chaque famille' AUTO_INCREMENT=52 ;

-- 
-- Contenu de la table `best_ages`
-- 

INSERT INTO `best_ages` (`id_age`, `id_famille_age`, `M_age`, `F_age`, `ordre_age`) VALUES (1, 1, 'Bébé', 'Bébé', 0);
INSERT INTO `best_ages` (`id_age`, `id_famille_age`, `M_age`, `F_age`, `ordre_age`) VALUES (2, 1, 'Enfançon', 'Enfançon', 1);
INSERT INTO `best_ages` (`id_age`, `id_famille_age`, `M_age`, `F_age`, `ordre_age`) VALUES (3, 1, 'Jeune', 'Jeune', 2);
INSERT INTO `best_ages` (`id_age`, `id_famille_age`, `M_age`, `F_age`, `ordre_age`) VALUES (4, 1, 'Adulte', 'Adulte', 3);
INSERT INTO `best_ages` (`id_age`, `id_famille_age`, `M_age`, `F_age`, `ordre_age`) VALUES (5, 1, 'Mature', 'Mature', 4);
INSERT INTO `best_ages` (`id_age`, `id_famille_age`, `M_age`, `F_age`, `ordre_age`) VALUES (6, 1, 'Chef de harde', 'Chef de harde', 5);
INSERT INTO `best_ages` (`id_age`, `id_famille_age`, `M_age`, `F_age`, `ordre_age`) VALUES (7, 1, 'Ancêtre', 'Ancêtre', 6);
INSERT INTO `best_ages` (`id_age`, `id_famille_age`, `M_age`, `F_age`, `ordre_age`) VALUES (8, 1, 'Ancien', 'Ancien', 7);
INSERT INTO `best_ages` (`id_age`, `id_famille_age`, `M_age`, `F_age`, `ordre_age`) VALUES (9, 2, 'Initial', 'Initiale', 0);
INSERT INTO `best_ages` (`id_age`, `id_famille_age`, `M_age`, `F_age`, `ordre_age`) VALUES (10, 2, 'Novice', 'Novice', 1);
INSERT INTO `best_ages` (`id_age`, `id_famille_age`, `M_age`, `F_age`, `ordre_age`) VALUES (11, 2, 'Mineur', 'Mineure', 2);
INSERT INTO `best_ages` (`id_age`, `id_famille_age`, `M_age`, `F_age`, `ordre_age`) VALUES (12, 2, 'Favori', 'Favorie', 3);
INSERT INTO `best_ages` (`id_age`, `id_famille_age`, `M_age`, `F_age`, `ordre_age`) VALUES (13, 2, 'Majeur', 'Majeure', 4);
INSERT INTO `best_ages` (`id_age`, `id_famille_age`, `M_age`, `F_age`, `ordre_age`) VALUES (14, 2, 'Supérieur', 'Supérieure', 5);
INSERT INTO `best_ages` (`id_age`, `id_famille_age`, `M_age`, `F_age`, `ordre_age`) VALUES (15, 2, 'Suprême', 'Suprême', 6);
INSERT INTO `best_ages` (`id_age`, `id_famille_age`, `M_age`, `F_age`, `ordre_age`) VALUES (16, 2, 'Ultime', 'Ultime', 7);
INSERT INTO `best_ages` (`id_age`, `id_famille_age`, `M_age`, `F_age`, `ordre_age`) VALUES (17, 3, 'Nouveau', 'Nouvelle', 0);
INSERT INTO `best_ages` (`id_age`, `id_famille_age`, `M_age`, `F_age`, `ordre_age`) VALUES (18, 3, 'Jeune', 'Jeune', 1);
INSERT INTO `best_ages` (`id_age`, `id_famille_age`, `M_age`, `F_age`, `ordre_age`) VALUES (19, 3, 'Adulte', 'Adulte', 2);
INSERT INTO `best_ages` (`id_age`, `id_famille_age`, `M_age`, `F_age`, `ordre_age`) VALUES (20, 3, 'Vétéran', 'Vétéran', 3);
INSERT INTO `best_ages` (`id_age`, `id_famille_age`, `M_age`, `F_age`, `ordre_age`) VALUES (21, 3, 'Briscard', 'Briscarde', 4);
INSERT INTO `best_ages` (`id_age`, `id_famille_age`, `M_age`, `F_age`, `ordre_age`) VALUES (22, 3, 'Doyen', 'Doyenne', 5);
INSERT INTO `best_ages` (`id_age`, `id_famille_age`, `M_age`, `F_age`, `ordre_age`) VALUES (23, 3, 'Légendaire', 'Légendaire', 6);
INSERT INTO `best_ages` (`id_age`, `id_famille_age`, `M_age`, `F_age`, `ordre_age`) VALUES (24, 3, 'Mythique', 'Mythique', 7);
INSERT INTO `best_ages` (`id_age`, `id_famille_age`, `M_age`, `F_age`, `ordre_age`) VALUES (25, 4, 'Larve', 'Larve', 0);
INSERT INTO `best_ages` (`id_age`, `id_famille_age`, `M_age`, `F_age`, `ordre_age`) VALUES (26, 4, 'Immature', 'Immature', 1);
INSERT INTO `best_ages` (`id_age`, `id_famille_age`, `M_age`, `F_age`, `ordre_age`) VALUES (27, 4, 'Juvénile', 'Juvénile', 2);
INSERT INTO `best_ages` (`id_age`, `id_famille_age`, `M_age`, `F_age`, `ordre_age`) VALUES (28, 4, 'Imago', 'Imago', 3);
INSERT INTO `best_ages` (`id_age`, `id_famille_age`, `M_age`, `F_age`, `ordre_age`) VALUES (29, 4, 'Développé', 'Développée', 4);
INSERT INTO `best_ages` (`id_age`, `id_famille_age`, `M_age`, `F_age`, `ordre_age`) VALUES (30, 4, 'Mûr', 'Mûre', 5);
INSERT INTO `best_ages` (`id_age`, `id_famille_age`, `M_age`, `F_age`, `ordre_age`) VALUES (31, 4, 'Accompli', 'Accomplie', 6);
INSERT INTO `best_ages` (`id_age`, `id_famille_age`, `M_age`, `F_age`, `ordre_age`) VALUES (32, 4, 'Achevé', 'Achevée', 7);
INSERT INTO `best_ages` (`id_age`, `id_famille_age`, `M_age`, `F_age`, `ordre_age`) VALUES (33, 5, 'Nouveau', 'Nouvelle', 0);
INSERT INTO `best_ages` (`id_age`, `id_famille_age`, `M_age`, `F_age`, `ordre_age`) VALUES (34, 5, 'Jeune', 'Jeune', 1);
INSERT INTO `best_ages` (`id_age`, `id_famille_age`, `M_age`, `F_age`, `ordre_age`) VALUES (35, 5, 'Adulte', 'Adulte', 2);
INSERT INTO `best_ages` (`id_age`, `id_famille_age`, `M_age`, `F_age`, `ordre_age`) VALUES (36, 5, 'Vétéran', 'Vétéran', 3);
INSERT INTO `best_ages` (`id_age`, `id_famille_age`, `M_age`, `F_age`, `ordre_age`) VALUES (37, 5, 'Briscard', 'Briscarde', 4);
INSERT INTO `best_ages` (`id_age`, `id_famille_age`, `M_age`, `F_age`, `ordre_age`) VALUES (38, 5, 'Doyen', 'Doyenne', 5);
INSERT INTO `best_ages` (`id_age`, `id_famille_age`, `M_age`, `F_age`, `ordre_age`) VALUES (39, 5, 'Légendaire', 'Légendaire', 6);
INSERT INTO `best_ages` (`id_age`, `id_famille_age`, `M_age`, `F_age`, `ordre_age`) VALUES (40, 5, 'Mythique', 'Mythique', 7);
INSERT INTO `best_ages` (`id_age`, `id_famille_age`, `M_age`, `F_age`, `ordre_age`) VALUES (41, 6, 'Naissant', 'Naissante', 0);
INSERT INTO `best_ages` (`id_age`, `id_famille_age`, `M_age`, `F_age`, `ordre_age`) VALUES (42, 6, 'Récent', 'Récente', 1);
INSERT INTO `best_ages` (`id_age`, `id_famille_age`, `M_age`, `F_age`, `ordre_age`) VALUES (43, 6, 'Ancien', 'Ancienne', 2);
INSERT INTO `best_ages` (`id_age`, `id_famille_age`, `M_age`, `F_age`, `ordre_age`) VALUES (44, 6, 'Vénérable', 'Vénérable', 3);
INSERT INTO `best_ages` (`id_age`, `id_famille_age`, `M_age`, `F_age`, `ordre_age`) VALUES (45, 6, 'Séculaire', 'Séculaire', 4);
INSERT INTO `best_ages` (`id_age`, `id_famille_age`, `M_age`, `F_age`, `ordre_age`) VALUES (46, 6, 'Antique', 'Antique', 5);
INSERT INTO `best_ages` (`id_age`, `id_famille_age`, `M_age`, `F_age`, `ordre_age`) VALUES (47, 6, 'Ancestral', 'Ancestrale', 6);
INSERT INTO `best_ages` (`id_age`, `id_famille_age`, `M_age`, `F_age`, `ordre_age`) VALUES (48, 6, 'Antédiluvien', 'Antédiluvienne', 7);
INSERT INTO `best_ages` (`id_age`, `id_famille_age`, `M_age`, `F_age`, `ordre_age`) VALUES (49, 7, 'Mature', 'Mature', 0);
INSERT INTO `best_ages` (`id_age`, `id_famille_age`, `M_age`, `F_age`, `ordre_age`) VALUES (50, 7, 'Chef de harde', 'Chef de Harde', 5);
INSERT INTO `best_ages` (`id_age`, `id_famille_age`, `M_age`, `F_age`, `ordre_age`) VALUES (51, 7, 'Ancien', 'Ancienne', 1);
