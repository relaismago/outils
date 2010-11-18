-- phpMyAdmin SQL Dump
-- version 2.6.1
-- http://www.phpmyadmin.net
-- 
-- Serveur: localhost
-- G�n�r� le : Mercredi 20 Avril 2005 � 15:02
-- Version du serveur: 4.0.21
-- Version de PHP: 4.3.10
-- 
-- Base de donn�es: `vue2drm`
-- 

-- --------------------------------------------------------

-- 
-- Structure de la table `best_templates`
-- 

DROP TABLE IF EXISTS `best_templates`;
CREATE TABLE IF NOT EXISTS `best_templates` (
  `id_template` int(11) NOT NULL auto_increment,
  `nom_template` varchar(30) NOT NULL default '',
  `racem_template` varchar(30) NOT NULL default '',
  `racef_template` varchar(30) NOT NULL default '',
  `regexp_masc_template` varchar(30) NOT NULL default '',
  `regexp_fem_template` varchar(30) NOT NULL default '',
  `modif_niveau_template` tinyint(3) NOT NULL default '0',
  PRIMARY KEY  (`id_template`)
) TYPE=MyISAM ;

-- 
-- Contenu de la table `best_templates`
-- 

INSERT INTO `best_templates` (`nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES ('(^G�ant)', '(.*) G�ant', '(.*) G�ante', '\\1', '\\1', 0);
INSERT INTO `best_templates` (`nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES ('-', '(.*)', '(.*)', '\\1', '\\1', 0);
INSERT INTO `best_templates` (`nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES ('Agressif', '(.*)', '(.*)', '\\1 Agressif', '\\1 Agressive', 0);
INSERT INTO `best_templates` (`nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES ('Alpha', '(.*)', '(.*)', 'Alpha \\1', 'Alpha \\1', 0);
INSERT INTO `best_templates` (`nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES ('Archa�que', '(.*)', '(.*)', '\\1 Archa�que', '\\1 Archa�que', 0);
INSERT INTO `best_templates` (`nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES ('Barbare', '(.*)', '(.*)', 'Barbare \\1', 'Barbare \\1', 0);
INSERT INTO `best_templates` (`nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES ('Berserker', '(.*)', '(.*)', '\\1 Berserker', '\\1 Berserkere', 0);
INSERT INTO `best_templates` (`nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES ('Champion', '(.*)', '(.*)', 'Champion \\1', 'Championne \\1', 0);
INSERT INTO `best_templates` (`nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES ('Colossal', '(.*)', '(.*)', '\\1 Colossal', '\\1 Colossale', 0);
INSERT INTO `best_templates` (`nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES ('Coriace', '(.*)', '(.*)', '\\1 Coriace', '\\1 Coriace', 0);
INSERT INTO `best_templates` (`nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES ('Corrompu', '(.*)', '(.*)', '\\1 Corrompu', '\\1 Corrompue', 0);
INSERT INTO `best_templates` (`nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES ('Cracheur', '(.*)', '(.*)', '\\1 Cracheur', '\\1 Cracheuse', 0);
INSERT INTO `best_templates` (`nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES ('Effray�', '(.*)', '(.*)', '\\1 Effray�', '\\1 Effray�e', 0);
INSERT INTO `best_templates` (`nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES ('Enrag�', '(.*)', '(.*)', '\\1 Enrag�', '\\1 Enrag�e', 0);
INSERT INTO `best_templates` (`nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES ('Fanatique', '(.*)', '(.*)', '\\1 Fanatique', '\\1 Fanatique', 0);
INSERT INTO `best_templates` (`nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES ('Fou', '(.*)', '(.*)', '\\1 Fou', '\\1 Folle', 0);
INSERT INTO `best_templates` (`nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES ('Frondeur', '(.*)', '(.*)', 'Frondeur \\1', 'Frondeuse \\1', 0);
INSERT INTO `best_templates` (`nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES ('Gargantuesque', '(.*) G�ant', '(.*) G�ante', '\\1 Gargantuesque', '\\1 Gargantuesque', 0);
INSERT INTO `best_templates` (`nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES ('Gargantuesque', '(.*)', '(.*)', '\\1 Gargantuesque', '\\1 Gargantuesque', 0);
INSERT INTO `best_templates` (`nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES ('Gigantesque', '(.*) G�ant', '(.*) G�ante', '\\1 Gigantesque', '\\1 Gigantesque', 0);
INSERT INTO `best_templates` (`nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES ('Grand Frondeur', '(.*)', '(.*)', 'Grand Frondeur \\1', 'Grande Frondeuse \\1', 0);
INSERT INTO `best_templates` (`nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES ('Gros', '(.*)', '(.*)', 'Gros \\1', 'Grosse \\1', 0);
INSERT INTO `best_templates` (`nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES ('Guerrier', '(.*)', '(.*)', 'Guerrier \\1', 'Guerri�re \\1', 0);
INSERT INTO `best_templates` (`nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES ('H�ros', '(.*)', '(.*)', 'H�ros \\1', 'H�ros \\1', 0);
INSERT INTO `best_templates` (`nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES ('Implacable', '(.*)', '(.*)', '\\1 Implacable', '\\1 Implacable', 0);
INSERT INTO `best_templates` (`nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES ('Malade', '(.*)', '(.*)', '\\1 Malade', '\\1 Malade', 0);
INSERT INTO `best_templates` (`nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES ('Mentat', '(.*)', '(.*)', '\\1 Mentat', '\\1 Mentat', 0);
INSERT INTO `best_templates` (`nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES ('Mutant', '(.*)', '(.*)', '\\1 Mutant', '\\1 Mutante', 0);
INSERT INTO `best_templates` (`nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES ('Ouvrier', '(.*)', '(.*)', '\\1 Ouvrier', '\\1 Ouvri�re', 0);
INSERT INTO `best_templates` (`nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES ('Paysan', '(.*)', '(.*)', 'Paysan \\1', 'Paysanne \\1', 0);
INSERT INTO `best_templates` (`nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES ('Petit', '(.*)', '(.*)', 'Petit \\1', 'Petite \\1', 0);
INSERT INTO `best_templates` (`nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES ('Prince', '(.*)', '(.*)', 'Prince \\1', 'Princesse \\1', 0);
INSERT INTO `best_templates` (`nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES ('Roi', '(.*)', '(.*)', 'Roi \\1', 'Reine \\1', 0);
INSERT INTO `best_templates` (`nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES ('Scout', '(.*)', '(.*)', 'Scout \\1', 'Scout \\1', 0);
INSERT INTO `best_templates` (`nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES ('Shaman', '(.*)', '(.*)', 'Shaman \\1', 'Shaman \\1', 0);
INSERT INTO `best_templates` (`nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES ('Soldat', '(.*)', '(.*)', '\\1 Soldat', '\\1 Soldat', 0);
INSERT INTO `best_templates` (`nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES ('Sombre Proph�te', '(.*)', '(.*)', 'Sombre Proph�te \\1', 'Sombre Proph�te \\1', 0);
INSERT INTO `best_templates` (`nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES ('Sorcier', '(.*)', '(.*)', 'Sorcier \\1', 'Sorci�re \\1', 0);
INSERT INTO `best_templates` (`nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES ('Traqueur', '(.*)', '(.*)', '\\1 Traqueur', '\\1 Traqueuse', 0);
INSERT INTO `best_templates` (`nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES ('Voleur', '(.*)', '(.*)', 'Voleur \\1', 'Voleuse \\1', 0);
INSERT INTO `best_templates` (`nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES ('Vorace', '(.*)', '(.*)', '\\1 Vorace', '\\1 Vorace', 0);
INSERT INTO `best_templates` (`nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES ('de Cinqui�me Cercle', '(.*)', '(.*)', '\\1 de Cinqui�me Cercle', '\\1 de Cinqui�me Cercle', 0);
INSERT INTO `best_templates` (`nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES ('de Premier Cercle', '(.*)', '(.*)', '\\1 de Premier Cercle', '\\1 de Premier Cercle', 0);
INSERT INTO `best_templates` (`nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES ('de Quatri�me Cercle', '(.*)', '(.*)', '\\1 de Quatri�me Cercle', '\\1 de Quatri�me Cercle', 0);
INSERT INTO `best_templates` (`nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES ('de Second Cercle', '(.*)', '(.*)', '\\1 de Second Cercle', '\\1 de Second Cercle', 0);
INSERT INTO `best_templates` (`nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES ('de Troisi�me Cercle', '(.*)', '(.*)', '\\1 de Troisi�me Cercle', '\\1 de Troisi�me Cercle', 0);
INSERT INTO `best_templates` (`nom_template`, `racem_template`, `racef_template`, `regexp_masc_template`, `regexp_fem_template`, `modif_niveau_template`) VALUES ('des Abysses', '(.*)', '(.*)', '\\1 des Abysses', '\\1 des Abysses', 0);
