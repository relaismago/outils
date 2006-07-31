-- phpMyAdmin SQL Dump
-- version 2.6.1
-- http://www.phpmyadmin.net
-- 
-- Serveur: localhost
-- Généré le : Samedi 23 Avril 2005 à 17:47
-- Version du serveur: 4.0.21
-- Version de PHP: 4.3.10
-- 
-- Base de données: `vue2drm`
-- 

-- --------------------------------------------------------

-- 
-- Structure de la table `best_templates`
-- 

DROP TABLE IF EXISTS `best_templates`;
CREATE TABLE `best_templates` (
  `id_template` int(11) NOT NULL auto_increment,
  `nom_template` varchar(30) NOT NULL default '',
  `racem_template` varchar(30) NOT NULL default '',
  `racef_template` varchar(30) NOT NULL default '',
  `regexp_masc_template` varchar(30) NOT NULL default '',
  `regexp_fem_template` varchar(30) NOT NULL default '',
  `modif_niveau_template` tinyint(3) NOT NULL default '0',
  PRIMARY KEY  (`id_template`)
) TYPE=MyISAM PACK_KEYS=0 AUTO_INCREMENT=48 ;

-- 
-- Contenu de la table `best_templates`
-- 

INSERT INTO `best_templates` (`id_template`, `nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES (1, '-', '(.+)', '(.+)', '\\1', '\\1', 0);
INSERT INTO `best_templates` (`id_template`, `nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES (2, '(^Géant)', '(.+) Géant', '(.+) Géante', '\\1', '\\1', 0);
INSERT INTO `best_templates` (`id_template`, `nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES (3, 'Agressif', '(.+)', '(.+)', '\\1 Agressif', '\\1 Agressive', 0);
INSERT INTO `best_templates` (`id_template`, `nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES (4, 'Alpha', '(.+)', '(.+)', 'Alpha \\1', 'Alpha \\1', 0);
INSERT INTO `best_templates` (`id_template`, `nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES (5, 'Archaïque', '(.+)', '(.+)', '\\1 Archaïque', '\\1 Archaïque', 0);
INSERT INTO `best_templates` (`id_template`, `nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES (6, 'Barbare', '(.+)', '(.+)', 'Barbare \\1', 'Barbare \\1', 0);
INSERT INTO `best_templates` (`id_template`, `nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES (7, 'Berserker', '(.+)', '(.+)', '\\1 Berserker', '\\1 Berserkere', 0);
INSERT INTO `best_templates` (`id_template`, `nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES (8, 'Champion', '(.+)', '(.+)', 'Champion \\1', 'Championne \\1', 0);
INSERT INTO `best_templates` (`id_template`, `nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES (9, 'Colossal', '(.+)', '(.+)', '\\1 Colossal', '\\1 Colossale', 0);
INSERT INTO `best_templates` (`id_template`, `nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES (10, 'Coriace', '(.+)', '(.+)', '\\1 Coriace', '\\1 Coriace', 0);
INSERT INTO `best_templates` (`id_template`, `nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES (11, 'Corrompu', '(.+)', '(.+)', '\\1 Corrompu', '\\1 Corrompue', 0);
INSERT INTO `best_templates` (`id_template`, `nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES (12, 'Cracheur', '(.+)', '(.+)', '\\1 Cracheur', '\\1 Cracheuse', 0);
INSERT INTO `best_templates` (`id_template`, `nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES (13, 'Effrayé', '(.+)', '(.+)', '\\1 Effrayé', '\\1 Effrayée', 0);
INSERT INTO `best_templates` (`id_template`, `nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES (14, 'Enragé', '(.+)', '(.+)', '\\1 Enragé', '\\1 Enragée', 0);
INSERT INTO `best_templates` (`id_template`, `nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES (15, 'Fanatique', '(.+)', '(.+)', '\\1 Fanatique', '\\1 Fanatique', 0);
INSERT INTO `best_templates` (`id_template`, `nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES (16, 'Fou', '(.+)', '(.+)', '\\1 Fou', '\\1 Folle', 0);
INSERT INTO `best_templates` (`id_template`, `nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES (17, 'Frondeur', '(.+)', '(.+)', 'Frondeur \\1', 'Frondeuse \\1', 0);
INSERT INTO `best_templates` (`id_template`, `nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES (18, 'Gargantuesque', '(.+) Géant', '(.+) Géante', '\\1 Gargantuesque', '\\1 Gargantuesque', 0);
INSERT INTO `best_templates` (`id_template`, `nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES (19, 'Gargantuesque', '(.+)', '(.+)', '\\1 Gargantuesque', '\\1 Gargantuesque', 0);
INSERT INTO `best_templates` (`id_template`, `nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES (20, 'Gigantesque', '(.+) Géant', '(.+) Géante', '\\1 Gigantesque', '\\1 Gigantesque', 0);
INSERT INTO `best_templates` (`id_template`, `nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES (21, 'Grand Frondeur', '(.+)', '(.+)', 'Grand Frondeur \\1', 'Grande Frondeuse \\1', 0);
INSERT INTO `best_templates` (`id_template`, `nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES (22, 'Gros', '(.+)', '(.+)', 'Gros \\1', 'Grosse \\1', 0);
INSERT INTO `best_templates` (`id_template`, `nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES (23, 'Guerrier', '(.+)', '(.+)', 'Guerrier \\1', 'Guerrière \\1', 0);
INSERT INTO `best_templates` (`id_template`, `nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES (24, 'Héros', '(.+)', '(.+)', 'Héros \\1', 'Héros \\1', 0);
INSERT INTO `best_templates` (`id_template`, `nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES (25, 'Implacable', '(.+)', '(.+)', '\\1 Implacable', '\\1 Implacable', 0);
INSERT INTO `best_templates` (`id_template`, `nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES (26, 'Malade', '(.+)', '(.+)', '\\1 Malade', '\\1 Malade', 0);
INSERT INTO `best_templates` (`id_template`, `nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES (27, 'Mentat', '(.+)', '(.+)', '\\1 Mentat', '\\1 Mentat', 0);
INSERT INTO `best_templates` (`id_template`, `nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES (28, 'Mutant', '(.+)', '(.+)', '\\1 Mutant', '\\1 Mutante', 0);
INSERT INTO `best_templates` (`id_template`, `nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES (29, 'Ouvrier', '(.+)', '(.+)', '\\1 Ouvrier', '\\1 Ouvrière', 0);
INSERT INTO `best_templates` (`id_template`, `nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES (30, 'Paysan', '(.+)', '(.+)', 'Paysan \\1', 'Paysanne \\1', 0);
INSERT INTO `best_templates` (`id_template`, `nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES (31, 'Petit', '(.+)', '(.+)', 'Petit \\1', 'Petite \\1', 0);
INSERT INTO `best_templates` (`id_template`, `nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES (32, 'Prince', '(.+)', '(.+)', 'Prince \\1', 'Princesse \\1', 0);
INSERT INTO `best_templates` (`id_template`, `nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES (33, 'Roi', '(.+)', '(.+)', 'Roi \\1', 'Reine \\1', 0);
INSERT INTO `best_templates` (`id_template`, `nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES (34, 'Scout', '(.+)', '(.+)', 'Scout \\1', 'Scout \\1', 0);
INSERT INTO `best_templates` (`id_template`, `nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES (35, 'Shaman', '(.+)', '(.+)', 'Shaman \\1', 'Shaman \\1', 0);
INSERT INTO `best_templates` (`id_template`, `nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES (36, 'Soldat', '(.+)', '(.+)', '\\1 Soldat', '\\1 Soldat', 0);
INSERT INTO `best_templates` (`id_template`, `nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES (37, 'Sombre Prophète', '(.+)', '(.+)', 'Sombre Prophète \\1', 'Sombre Prophète \\1', 0);
INSERT INTO `best_templates` (`id_template`, `nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES (38, 'Sorcier', '(.+)', '(.+)', 'Sorcier \\1', 'Sorcière \\1', 0);
INSERT INTO `best_templates` (`id_template`, `nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES (39, 'Traqueur', '(.+)', '(.+)', '\\1 Traqueur', '\\1 Traqueuse', 0);
INSERT INTO `best_templates` (`id_template`, `nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES (40, 'Voleur', '(.+)', '(.+)', 'Voleur \\1', 'Voleuse \\1', 0);
INSERT INTO `best_templates` (`id_template`, `nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES (41, 'Vorace', '(.+)', '(.+)', '\\1 Vorace', '\\1 Vorace', 0);
INSERT INTO `best_templates` (`id_template`, `nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES (42, 'de Cinquième Cercle', '(.+)', '(.+)', '\\1 de Cinquième Cercle', '\\1 de Cinquième Cercle', 0);
INSERT INTO `best_templates` (`id_template`, `nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES (43, 'de Premier Cercle', '(.+)', '(.+)', '\\1 de Premier Cercle', '\\1 de Premier Cercle', 0);
INSERT INTO `best_templates` (`id_template`, `nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES (44, 'de Quatrième Cercle', '(.+)', '(.+)', '\\1 de Quatrième Cercle', '\\1 de Quatrième Cercle', 0);
INSERT INTO `best_templates` (`id_template`, `nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES (45, 'de Second Cercle', '(.+)', '(.+)', '\\1 de Second Cercle', '\\1 de Second Cercle', 0);
INSERT INTO `best_templates` (`id_template`, `nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES (46, 'de Troisième Cercle', '(.+)', '(.+)', '\\1 de Troisième Cercle', '\\1 de Troisième Cercle', 0);
INSERT INTO `best_templates` (`id_template`, `nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES (47, 'des Abysses', '(.+)', '(.+)', '\\1 des Abysses', '\\1 des Abysses', 0);
