-- phpMyAdmin SQL Dump
-- version 2.6.3-pl1
-- http://www.phpmyadmin.net
-- 
-- Serveur: localhost
-- Généré le : Dimanche 21 Août 2005 à 16:57
-- Version du serveur: 4.1.13
-- Version de PHP: 4.3.11
-- 
-- Base de données: `outilsrm`
-- 

-- --------------------------------------------------------

-- 
-- Structure de la table `administration`
-- 

CREATE TABLE `administration` (
  `id_admin` int(1) NOT NULL default '0',
  `pass_admin` varchar(255) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Structure de la table `anatomiques`
-- 

CREATE TABLE `anatomiques` (
  `id_troll_anatomique` int(11) NOT NULL default '0',
  `pv_anatomique` varchar(255) default NULL,
  `esq_anatomique` varchar(255) default NULL,
  `att_anatomique` varchar(255) default NULL,
  `deg_anatomique` varchar(255) default NULL,
  `reg_anatomique` varchar(255) default NULL,
  `vue_anatomique` varchar(255) default NULL,
  `arm_anatomique` varchar(255) default NULL,
  `date_anatomique` date NOT NULL default '0000-00-00',
  `source_anatomique` varchar(255) default NULL,
  PRIMARY KEY  (`id_troll_anatomique`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Structure de la table `baronnies`
-- 

CREATE TABLE `baronnies` (
  `id_baronnie` int(11) NOT NULL auto_increment,
  `id_baron_baronnie` int(11) NOT NULL default '0',
  `nom_baronnie` varchar(100) NOT NULL default '',
  `blason_baronnie` varchar(250) NOT NULL default '',
  `img_blason_baronnie` varchar(255) NOT NULL default '',
  `img_mini_blason_baronnie` varchar(255) default NULL,
  `img_drapeau_baronnie` varchar(255) default NULL,
  `couleur1_baronnie` varchar(250) NOT NULL default '',
  `couleur2_baronnie` varchar(250) NOT NULL default '',
  `devise_baronnie` varchar(250) NOT NULL default '',
  `x_deb_baronnie` int(5) default NULL,
  `y_deb_baronnie` int(5) default NULL,
  `z_deb_baronnie` int(5) default NULL,
  `x_fin_baronnie` int(5) default NULL,
  `y_fin_baronnie` int(5) default NULL,
  `z_fin_baronnie` int(5) default NULL,
  `x_trone_baronnie` int(5) default NULL,
  `y_trone_baronnie` int(5) default NULL,
  `z_trone_baronnie` int(5) default NULL,
  `type_baronnie` enum('baronnie','garde') NOT NULL default 'baronnie',
  PRIMARY KEY  (`id_baronnie`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

-- 
-- Structure de la table `best_ages`
-- 

CREATE TABLE `best_ages` (
  `id_age` int(11) NOT NULL auto_increment,
  `id_famille_age` int(11) NOT NULL default '0',
  `M_age` varchar(60) NOT NULL default '',
  `F_age` varchar(60) NOT NULL default '',
  `ordre_age` tinyint(3) NOT NULL default '0',
  PRIMARY KEY  (`id_age`),
  KEY `Famille` (`id_famille_age`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Différents ages pour chaque famille' AUTO_INCREMENT=49 ;

-- --------------------------------------------------------

-- 
-- Structure de la table `best_capspe`
-- 

CREATE TABLE `best_capspe` (
  `id_monstre_capspe` int(11) NOT NULL default '0',
  `id_race_capspe` int(11) NOT NULL default '0',
  `id_template_capspe` int(11) NOT NULL default '0',
  `id_age_capspe` int(11) NOT NULL default '0',
  `nom_capspe` varchar(64) NOT NULL default '',
  `affecte_capspe` varchar(128) NOT NULL default '',
  `MMsom_capspe` int(11) NOT NULL default '0',
  `MMnbr_capspe` int(11) NOT NULL default '0',
  `degatssom_capspe` int(11) NOT NULL default '0',
  `degatsnbr_capspe` int(11) NOT NULL default '0',
  `portee_capspe` tinyint(3) NOT NULL default '0',
  `duree_capspe` enum('?','0','1','2','3','4','5','6','7','8','9') NOT NULL default '?',
  `sepatt_capspe` enum('?','Oui','Non') NOT NULL default '?',
  `zone_capspe` enum('?','Oui','Non') NOT NULL default '?',
  `portee_zone_capspe` tinyint(3) NOT NULL default '0',
  `date_capspe` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `source_capspe` varchar(30) NOT NULL default 'Relais & Mago',
  PRIMARY KEY  (`id_monstre_capspe`),
  KEY `Race` (`id_race_capspe`),
  KEY `Template` (`id_template_capspe`),
  KEY `Age` (`id_age_capspe`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='capacité spéciale des monstres';

-- --------------------------------------------------------

-- 
-- Structure de la table `best_caracs`
-- 

CREATE TABLE `best_caracs` (
  `id_monstre_caracs` int(11) NOT NULL default '0',
  `id_race_caracs` int(11) NOT NULL default '0',
  `id_template_caracs` int(11) NOT NULL default '0',
  `id_age_caracs` int(11) NOT NULL default '0',
  `RMsom_caracs` int(11) NOT NULL default '0',
  `RMnbr_caracs` int(11) NOT NULL default '0',
  `source_caracs` varchar(30) NOT NULL default '',
  `date_caracs` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id_monstre_caracs`),
  KEY `id_race_caracs` (`id_race_caracs`,`id_template_caracs`,`id_age_caracs`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='autres caracs des monstres (RM)';

-- --------------------------------------------------------

-- 
-- Structure de la table `best_cdms`
-- 

CREATE TABLE `best_cdms` (
  `id_cdm` int(11) NOT NULL auto_increment,
  `id_mh` int(11) NOT NULL default '0',
  `id_race_cdm` int(11) NOT NULL default '0',
  `id_template_cdm` int(11) NOT NULL default '0',
  `id_age_cdm` int(11) NOT NULL default '0',
  `id_monstre_cdm` int(11) NOT NULL default '0',
  `nivmin_cdm` smallint(3) NOT NULL default '0',
  `nivmax_cdm` smallint(3) NOT NULL default '0',
  `pdvmin_cdm` smallint(3) NOT NULL default '0',
  `pdvmax_cdm` smallint(3) NOT NULL default '0',
  `attmin_cdm` smallint(3) NOT NULL default '0',
  `attmax_cdm` smallint(3) NOT NULL default '0',
  `esqmin_cdm` smallint(3) NOT NULL default '0',
  `esqmax_cdm` smallint(3) NOT NULL default '0',
  `degmin_cdm` smallint(3) NOT NULL default '0',
  `degmax_cdm` smallint(3) NOT NULL default '0',
  `regmin_cdm` smallint(3) NOT NULL default '0',
  `regmax_cdm` smallint(3) NOT NULL default '0',
  `armmin_cdm` smallint(3) NOT NULL default '0',
  `armmax_cdm` smallint(3) NOT NULL default '0',
  `vuemin_cdm` smallint(3) NOT NULL default '0',
  `vuemax_cdm` smallint(3) NOT NULL default '0',
  `capspe_cdm` varchar(64) NOT NULL default '',
  `affecte_cdm` varchar(128) NOT NULL default '',
  `date_cdm` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `source_cdm` varchar(30) NOT NULL default 'Relais & Mago',
  PRIMARY KEY  (`id_cdm`),
  KEY `Nom` (`id_monstre_cdm`),
  KEY `Race` (`id_race_cdm`),
  KEY `Template` (`id_template_cdm`),
  KEY `Age` (`id_age_cdm`),
  KEY `id_mh` (`id_mh`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=2062 ;

-- --------------------------------------------------------

-- 
-- Structure de la table `best_familles`
-- 

CREATE TABLE `best_familles` (
  `id_famille` int(11) NOT NULL auto_increment,
  `nom_famille` varchar(60) NOT NULL default '',
  PRIMARY KEY  (`id_famille`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

-- 
-- Structure de la table `best_monstres`
-- 

CREATE TABLE `best_monstres` (
  `id_monstre` int(11) NOT NULL auto_increment,
  `id_race_monstre` int(11) NOT NULL default '0',
  `id_template_monstre` int(11) NOT NULL default '0',
  `id_age_monstre` int(11) NOT NULL default '0',
  `nom_monstre` varchar(60) NOT NULL default '',
  `nivsom_monstre` int(11) NOT NULL default '0',
  `nivnbr_monstre` int(11) NOT NULL default '0',
  `pdvsom_monstre` int(11) NOT NULL default '0',
  `pdvnbr_monstre` int(11) NOT NULL default '0',
  `attsom_monstre` int(11) NOT NULL default '0',
  `attnbr_monstre` int(11) NOT NULL default '0',
  `esqsom_monstre` int(11) NOT NULL default '0',
  `esqnbr_monstre` int(11) NOT NULL default '0',
  `degsom_monstre` int(11) NOT NULL default '0',
  `degnbr_monstre` int(11) NOT NULL default '0',
  `regsom_monstre` int(11) NOT NULL default '0',
  `regnbr_monstre` int(11) NOT NULL default '0',
  `armsom_monstre` int(11) NOT NULL default '0',
  `armnbr_monstre` int(11) NOT NULL default '0',
  `vuesom_monstre` int(11) NOT NULL default '0',
  `vuenbr_monstre` int(11) NOT NULL default '0',
  `date_monstre` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id_monstre`),
  UNIQUE KEY `Nom` (`nom_monstre`),
  KEY `Race` (`id_race_monstre`),
  KEY `Template` (`id_template_monstre`),
  KEY `Age` (`id_age_monstre`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1178 ;

-- --------------------------------------------------------

-- 
-- Structure de la table `best_niv_race_template`
-- 

CREATE TABLE `best_niv_race_template` (
  `id_race_niv` int(11) NOT NULL default '0',
  `id_template_niv` int(11) NOT NULL default '0',
  `niv_race_niv` tinyint(3) NOT NULL default '0',
  `niv_template_niv` tinyint(3) NOT NULL default '0',
  KEY `id_race_niv` (`id_race_niv`),
  KEY `id_template_niv` (`id_template_niv`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='incohérences de niveau entre race et template';

-- --------------------------------------------------------

-- 
-- Structure de la table `best_races`
-- 

CREATE TABLE `best_races` (
  `id_race` int(11) NOT NULL auto_increment,
  `id_famille_race` int(11) NOT NULL default '0',
  `nom_race` varchar(60) NOT NULL default '',
  `image_race` varchar(60) NOT NULL default '',
  `genre_race` enum('M','F') NOT NULL default 'M',
  `nivsom_race` bigint(20) NOT NULL default '0',
  `nivnbr_race` int(11) NOT NULL default '0',
  `niv_base` tinyint(3) NOT NULL default '0',
  PRIMARY KEY  (`id_race`),
  UNIQUE KEY `Race` (`nom_race`),
  KEY `Famille` (`id_famille_race`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=146 ;

-- --------------------------------------------------------

-- 
-- Structure de la table `best_racetemplate`
-- 

CREATE TABLE `best_racetemplate` (
  `id_race_racetemplate` int(11) NOT NULL default '0',
  `id_template_racetemplate` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id_race_racetemplate`,`id_template_racetemplate`),
  KEY `id_race_racetemplate` (`id_race_racetemplate`),
  KEY `id_template_racetemplate` (`id_template_racetemplate`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Structure de la table `best_sources`
-- 

CREATE TABLE `best_sources` (
  `id_troll_source` int(11) NOT NULL default '0',
  `id_mh_source` int(11) NOT NULL default '0',
  `nbr_cdms_source` int(11) NOT NULL default '1',
  KEY `id_troll_source` (`id_troll_source`),
  KEY `id_mh_source` (`id_mh_source`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='liste des trolls ayant entré une cdm';

-- --------------------------------------------------------

-- 
-- Structure de la table `best_templates`
-- 

CREATE TABLE `best_templates` (
  `id_template` int(11) NOT NULL auto_increment,
  `nom_template` varchar(30) NOT NULL default '',
  `racem_template` varchar(30) NOT NULL default '',
  `racef_template` varchar(30) NOT NULL default '',
  `regexp_masc_template` varchar(30) NOT NULL default '',
  `regexp_fem_template` varchar(30) NOT NULL default '',
  `modif_niveau_template` tinyint(3) NOT NULL default '0',
  PRIMARY KEY  (`id_template`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 PACK_KEYS=0 AUTO_INCREMENT=48 ;

-- --------------------------------------------------------

-- 
-- Structure de la table `best_trolls`
-- 

CREATE TABLE `best_trolls` (
  `id_troll` int(11) NOT NULL default '0',
  `nom_troll` varchar(40) NOT NULL default '',
  PRIMARY KEY  (`id_troll`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Structure de la table `bugs`
-- 

CREATE TABLE `bugs` (
  `id_bug` int(11) NOT NULL auto_increment,
  `id_troll_emetteur_bug` int(11) NOT NULL default '0',
  `id_troll_responsable_bug` int(11) NOT NULL default '0',
  `date_ouverture_bug` datetime NOT NULL default '0000-00-00 00:00:00',
  `date_cloture_bug` datetime NOT NULL default '0000-00-00 00:00:00',
  `description_bug` blob NOT NULL,
  `criticite_bug` enum('basse','moyenne','prioritaire') NOT NULL default 'basse',
  `type_bug` enum('souhait','bug') NOT NULL default 'bug',
  `etat_bug` enum('ouvert','en-cours','clos') NOT NULL default 'ouvert',
  `outil_touche_bug` enum('bestiaire','bugs','gps','ggc','recherchator','rg','stats','vue2d','vtt','autre') NOT NULL default 'bestiaire',
  PRIMARY KEY  (`id_bug`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=184 ;

-- --------------------------------------------------------

-- 
-- Structure de la table `champignons`
-- 

CREATE TABLE `champignons` (
  `id_champi` int(11) NOT NULL default '0',
  `nom_champi` varchar(50) default NULL,
  `is_seen_champi` enum('oui','non') NOT NULL default 'oui',
  `x_champi` int(11) default NULL,
  `y_champi` int(11) default NULL,
  `z_champi` int(11) default NULL,
  `date_champi` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id_champi`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Structure de la table `composants`
-- 

CREATE TABLE `composants` (
  `id_composant` int(11) NOT NULL auto_increment,
  `nom_composant` varchar(100) default NULL,
  `id_race_composant` varchar(60) NOT NULL default '0',
  `date_fin_composant` datetime NOT NULL default '0000-00-00 00:00:00',
  `commentaire_composant` blob NOT NULL,
  `priorite_composant` enum('aucune','tresbasse','basse','moyenne','haute','superhaute') NOT NULL default 'moyenne',
  PRIMARY KEY  (`id_composant`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

-- --------------------------------------------------------

-- 
-- Structure de la table `distinctions`
-- 

CREATE TABLE `distinctions` (
  `id_distinction` int(11) NOT NULL auto_increment,
  `nom_distinction` varchar(255) NOT NULL default '',
  `nom_image_distinction` varchar(255) NOT NULL default '',
  `nom_image_titre_distinction` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id_distinction`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

-- --------------------------------------------------------

-- 
-- Structure de la table `ggc_comp`
-- 

CREATE TABLE `ggc_comp` (
  `id_troll` int(5) NOT NULL default '0',
  `id_comp_sort` int(11) NOT NULL default '0',
  `nom_comp_sort` varchar(30) default NULL,
  `pct_comp_sort` int(11) default NULL,
  `date_maj` int(11) default NULL,
  PRIMARY KEY  (`id_troll`,`id_comp_sort`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Structure de la table `ggc_evt`
-- 

CREATE TABLE `ggc_evt` (
  `id_groupe` int(3) NOT NULL default '0',
  `id_troll` int(5) NOT NULL default '0',
  `date_maj` int(11) NOT NULL default '0',
  `type_evt` varchar(30) default NULL,
  `texte_evt` varchar(255) default NULL,
  `pv` int(3) default NULL,
  `id_monstre` int(11) default NULL,
  PRIMARY KEY  (`id_groupe`,`id_troll`,`date_maj`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Structure de la table `ggc_groupe`
-- 

CREATE TABLE `ggc_groupe` (
  `id_groupe` int(11) NOT NULL default '0',
  `nom_groupe` varchar(100) default NULL,
  `nb_trolls` int(3) default NULL,
  `nb_monstres` int(3) default NULL,
  `nb_px` int(4) default NULL,
  `nb_gg` int(6) default NULL,
  `date_maj` int(11) default NULL,
  PRIMARY KEY  (`id_groupe`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Structure de la table `ggc_membre`
-- 

CREATE TABLE `ggc_membre` (
  `id_membre` int(10) NOT NULL default '0',
  `id` varchar(20) default NULL,
  `id_troll` int(5) default NULL,
  `passe` varchar(20) default NULL,
  PRIMARY KEY  (`id_membre`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Structure de la table `ggc_monstre`
-- 

CREATE TABLE `ggc_monstre` (
  `id_monstre` int(11) NOT NULL default '0',
  `nom_monstre` varchar(100) NOT NULL default '',
  `pv_min` int(11) default NULL,
  `pv_max` int(11) default NULL,
  `race` varchar(100) default NULL,
  `monstre` varchar(100) default NULL,
  `template` varchar(100) default NULL,
  `date_maj` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id_monstre`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Structure de la table `ggc_troll`
-- 

CREATE TABLE `ggc_troll` (
  `id_troll` int(5) NOT NULL default '0',
  `nom_troll` varchar(30) default NULL,
  `niveau_troll` int(2) default NULL,
  `race` varchar(20) default NULL,
  `dla_en_cours` int(11) default NULL,
  `dla_suivante` int(11) default NULL,
  `dla_prevue` int(11) default NULL,
  `position_x` int(5) default NULL,
  `position_y` int(5) default NULL,
  `position_z` int(5) default NULL,
  `pv_actuel` int(3) default NULL,
  `pv_max` int(3) default NULL,
  `fatigue_kastar` int(2) default NULL,
  `pa` int(1) default NULL,
  `date_maj` int(11) default NULL,
  `id_groupe` int(11) default NULL,
  `duree_dla` int(11) default NULL,
  PRIMARY KEY  (`id_troll`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Structure de la table `gowaps`
-- 

CREATE TABLE `gowaps` (
  `id_gowap` int(11) NOT NULL default '0',
  `id_troll_gowap` int(11) NOT NULL default '0',
  `profil_gowap` blob,
  `description_gowap` blob,
  `chargement_gowap` longblob,
  `date_chargement_gowap` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id_gowap`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Structure de la table `gtanieres`
-- 

CREATE TABLE `gtanieres` (
  `id_gtaniere` mediumint(9) NOT NULL auto_increment,
  `id_lieu_gtaniere` mediumint(9) NOT NULL default '0',
  `id_guilde_gtaniere` smallint(6) NOT NULL default '0',
  `nom_gtaniere` varchar(100) NOT NULL default '',
  `x_gtaniere` smallint(6) NOT NULL default '0',
  `y_gtaniere` smallint(6) NOT NULL default '0',
  `z_gtaniere` smallint(6) NOT NULL default '0',
  `is_tgv_gtaniere` enum('oui','non') NOT NULL default 'non',
  `prix_tgv_guilde_gtaniere` varchar(255) default '-',
  `prix_tgv_amis_gtaniere` varchar(255) default '-',
  `prix_tgv_neutres_gtaniere` varchar(255) default '-',
  `prix_tgv_ennemis_gtaniere` varchar(255) default '-',
  `connexions_gtaniere` text,
  `is_soins_gtaniere` enum('oui','non') NOT NULL default 'non',
  `prix_soins_guilde_gtaniere` varchar(255) NOT NULL default '-',
  `prix_soins_amis_gtaniere` varchar(255) NOT NULL default '-',
  `prix_soins_neutres_gtaniere` varchar(255) NOT NULL default '-',
  `prix_soins_ennemis_gtaniere` varchar(255) NOT NULL default '-',
  `is_resurection_gtaniere` enum('oui','non') NOT NULL default 'non',
  `prix_resurection_guilde_gtaniere` varchar(255) NOT NULL default '-',
  `prix_resurection_amis_gtaniere` varchar(255) NOT NULL default '-',
  `prix_resurection_neutres_gtaniere` varchar(255) NOT NULL default '-',
  `prix_resurection_ennemis_gtaniere` varchar(255) NOT NULL default '-',
  `is_forgeron_gtaniere` enum('oui','non') NOT NULL default 'non',
  `prix_forgeron_guilde_gtaniere` varchar(255) NOT NULL default '-',
  `prix_forgeron_amis_gtaniere` varchar(255) NOT NULL default '-',
  `prix_forgeron_neutres_gtaniere` varchar(255) NOT NULL default '-',
  `prix_forgeron_ennemis_gtaniere` varchar(255) NOT NULL default '-',
  `is_commerce_gtaniere` enum('oui','non') NOT NULL default 'non',
  `date_gtaniere` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id_gtaniere`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=96 ;

-- --------------------------------------------------------

-- 
-- Structure de la table `guildes`
-- 

CREATE TABLE `guildes` (
  `id_guilde` int(11) NOT NULL default '0',
  `nom_guilde` varchar(100) default NULL,
  `statut_guilde` enum('neutre','tk','ennemie','amie','alliee') NOT NULL default 'neutre',
  `gestionnaire_id_troll_guilde` int(11) NOT NULL default '0',
  `contact_id_troll_guilde` int(11) NOT NULL default '0',
  `info_1_guilde` blob,
  `diplomate_id_troll_guilde` int(11) NOT NULL default '0',
  `web_guilde` varchar(255) NOT NULL default 'http://',
  `historique_guilde` blob,
  PRIMARY KEY  (`id_guilde`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Structure de la table `lieux`
-- 

CREATE TABLE `lieux` (
  `id_lieu` int(11) NOT NULL default '0',
  `nom_lieu` varchar(50) default NULL,
  `description_lieu` varchar(255) default NULL,
  `x_lieu` int(11) NOT NULL default '0',
  `y_lieu` int(11) NOT NULL default '0',
  `z_lieu` int(11) NOT NULL default '0',
  `date_lieu` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id_lieu`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Structure de la table `miss`
-- 

CREATE TABLE `miss` (
  `id_troll_miss` int(11) NOT NULL default '0',
  `description_miss` blob,
  `annee_miss` enum('2005','2006','2007','2008','2009','2010') NOT NULL default '2005',
  `genre_miss` enum('f','g') NOT NULL default 'f',
  `type_miss` enum('rm','mh') NOT NULL default 'rm',
  `image_1_miss` varchar(255) default NULL,
  `image_2_miss` varchar(255) default NULL,
  `reponse_miss` blob,
  `question_miss` blob,
  PRIMARY KEY  (`id_troll_miss`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Structure de la table `monstres`
-- 

CREATE TABLE `monstres` (
  `id_monstre` int(11) NOT NULL default '0',
  `nom_monstre` varchar(50) NOT NULL default '',
  `age_monstre` varchar(50) default NULL,
  `x_monstre` int(11) NOT NULL default '0',
  `y_monstre` int(11) NOT NULL default '0',
  `z_monstre` int(11) NOT NULL default '0',
  `date_monstre` datetime NOT NULL default '0000-00-00 00:00:00',
  `is_seen_monstre` enum('oui','non') NOT NULL default 'oui',
  PRIMARY KEY  (`id_monstre`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Structure de la table `mouches`
-- 

CREATE TABLE `mouches` (
  `id_mouche` int(11) NOT NULL default '0',
  `id_troll_mouche` int(11) NOT NULL default '0',
  `nom_mouche` varchar(100) NOT NULL default '',
  `type_mouche` varchar(100) NOT NULL default '',
  `age_mouche` int(11) NOT NULL default '0',
  `presence_mouche` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`id_mouche`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Structure de la table `objets_troll`
-- 

CREATE TABLE `objets_troll` (
  `id_objet_troll` int(11) NOT NULL default '0',
  `nom_objet_troll` varchar(50) default NULL,
  `type_objet_troll` varchar(50) default NULL,
  PRIMARY KEY  (`id_objet_troll`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Cette table n''est pas utilisÃ©e pour le moment';

-- --------------------------------------------------------

-- 
-- Structure de la table `options`
-- 

CREATE TABLE `options` (
  `id_troll_option` int(11) NOT NULL default '0',
  `date_option` datetime default NULL,
  `display_mouches_option` enum('oui','non') NOT NULL default 'non',
  `display_noms_mouches_option` enum('oui','non') NOT NULL default 'non',
  `refresh_dla_option` enum('oui','non') NOT NULL default 'non',
  PRIMARY KEY  (`id_troll_option`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Structure de la table `quadrillage`
-- 

CREATE TABLE `quadrillage` (
  `id_troll_quad` int(11) NOT NULL default '0',
  `x_min_quad` int(11) NOT NULL default '0',
  `x_max_quad` int(11) NOT NULL default '0',
  `y_min_quad` int(11) NOT NULL default '0',
  `y_max_quad` int(11) NOT NULL default '0',
  `z_min_quad` int(11) NOT NULL default '0',
  `z_max_quad` int(11) NOT NULL default '0',
  `last_seen_quad` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id_troll_quad`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Structure de la table `refresh_count`
-- 

CREATE TABLE `refresh_count` (
  `id_troll_refresh` int(11) NOT NULL default '0',
  `date_refresh` datetime NOT NULL default '0000-00-00 00:00:00',
  `by_me_refresh` enum('oui','non') NOT NULL default 'oui',
  `categorie_refresh` enum('classiques','equipement','messages','compteurs_appels') NOT NULL default 'classiques',
  `script_name_refresh` enum('SP_Profil','SP_Vue','SP_Profil2','SP_Vue2','SP_Evenement','SP_EvenementPage','SP_ProfilPublic','SP_Equipement','SP_Mouche','SP_Gigots','SPXML_Equipement','SPXML_Objets','SP_Tanieres','SP_Gowaps','SP_Listesdevente','SP_DernierMessage','SP_New','SP_Appels') NOT NULL default 'SP_Vue2',
  PRIMARY KEY  (`id_troll_refresh`,`date_refresh`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Structure de la table `special`
-- 

CREATE TABLE `special` (
  `id_special` int(11) NOT NULL default '0',
  `nom_special` varchar(50) default NULL,
  PRIMARY KEY  (`id_special`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Cette table n''est pas utilisÃ©e pour le moment';

-- --------------------------------------------------------

-- 
-- Structure de la table `stock_tresors`
-- 

CREATE TABLE `stock_tresors` (
  `id_tresor` int(10) unsigned NOT NULL auto_increment,
  `nom_type` varchar(30) NOT NULL default '',
  `compo` tinyint(3) unsigned NOT NULL default '0',
  `id_taniere` int(10) unsigned NOT NULL default '0',
  `date_arrivee` date NOT NULL default '0000-00-00',
  `invisible` tinyint(3) unsigned NOT NULL default '0',
  `bloque` tinyint(3) unsigned NOT NULL default '0',
  `absent` tinyint(3) unsigned NOT NULL default '0',
  `date_maj` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `reserve` tinyint(4) NOT NULL default '0',
  `confirme` tinyint(4) NOT NULL default '0',
  `reserve_troll` int(10) unsigned default NULL,
  `reserve_troll_nom` varchar(30) default NULL,
  `reserve_date` date default NULL,
  `en_vente` tinyint(4) NOT NULL default '0',
  `en_vente_prix` smallint(6) default NULL,
  `en_vente_troll` int(10) unsigned default NULL,
  `en_vente_troll_nom` varchar(30) default NULL,
  `description` varchar(150) NOT NULL default '',
  PRIMARY KEY  (`id_tresor`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1785690 ;

-- --------------------------------------------------------

-- 
-- Structure de la table `tanieres`
-- 

CREATE TABLE `tanieres` (
  `id_taniere` int(11) NOT NULL default '0',
  `id_troll_taniere` int(11) NOT NULL default '0',
  `description_taniere` blob,
  `contenu_taniere` blob,
  `vente_taniere` blob,
  `date_maj_taniere` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id_taniere`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Structure de la table `tk_griefs`
-- 

CREATE TABLE `tk_griefs` (
  `tk_id` bigint(8) NOT NULL default '0',
  `date_grief` date NOT NULL default '0000-00-00',
  `troll_impacte` bigint(8) default NULL,
  `type` enum('vol','meurtre','asso malfrats','coups','traitrise','fourberie','insulte','employe microsoft') default NULL,
  `description` text,
  `grief_id` int(8) NOT NULL auto_increment,
  PRIMARY KEY  (`grief_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=258 ;

-- --------------------------------------------------------

-- 
-- Structure de la table `tk_vengeances`
-- 

CREATE TABLE `tk_vengeances` (
  `tk_id` bigint(8) NOT NULL default '0',
  `troll_vengeur` bigint(8) NOT NULL default '0',
  `date_vengeance` date NOT NULL default '0000-00-00',
  `vengeance_id` int(8) NOT NULL auto_increment,
  `description` text,
  PRIMARY KEY  (`vengeance_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=97 ;

-- --------------------------------------------------------

-- 
-- Structure de la table `tresors`
-- 

CREATE TABLE `tresors` (
  `id_tresor` int(11) NOT NULL default '0',
  `nom_tresor` varchar(50) NOT NULL default '',
  `x_tresor` int(11) NOT NULL default '0',
  `y_tresor` int(11) NOT NULL default '0',
  `z_tresor` int(11) NOT NULL default '0',
  `date_tresor` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id_tresor`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Structure de la table `troll_equipement`
-- 

CREATE TABLE `troll_equipement` (
  `id_troll_equip` int(11) NOT NULL default '0',
  `num_equip` int(11) NOT NULL default '0',
  `nom_equip` varchar(50) NOT NULL default '',
  `type_equip` varchar(50) NOT NULL default '',
  `utilisation_equip` char(2) NOT NULL default '',
  `template_equip` varchar(50) NOT NULL default '',
  `effet_equip` varchar(50) NOT NULL default '',
  `identifie_equip` char(1) NOT NULL default '',
  `poids_equip` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`num_equip`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Structure de la table `trolls`
-- 

CREATE TABLE `trolls` (
  `id_troll` int(11) NOT NULL default '0',
  `nom_troll` varchar(50) NOT NULL default '',
  `nom_image_troll` varchar(255) default NULL,
  `pass_troll` varchar(100) NOT NULL default '',
  `vue_troll` int(5) NOT NULL default '1',
  `niveau_troll` int(5) default NULL,
  `race_troll` varchar(15) default NULL,
  `malade_troll` varchar(50) default NULL,
  `guilde_troll` int(5) default NULL,
  `statut_troll` enum('neutre','tk','ennemie','amie','alliee') NOT NULL default 'neutre',
  `nbdead_troll` int(5) default NULL,
  `nbkills_troll` int(5) default NULL,
  `nbmouches_troll` int(3) default NULL,
  `equipement_troll` longblob,
  `is_tk_troll` enum('oui','non') NOT NULL default 'non',
  `is_wanted_troll` enum('oui','non') NOT NULL default 'non',
  `is_venge_troll` enum('oui','non') NOT NULL default 'non',
  `is_admin_troll` enum('oui','non') NOT NULL default 'non',
  `id_diplomate_troll` int(11) default NULL,
  `historique_troll` blob,
  `x_troll` int(5) default NULL,
  `y_troll` int(5) default NULL,
  `z_troll` int(5) default NULL,
  `date_troll` datetime NOT NULL default '0000-00-00 00:00:00',
  `date_last_refresh_himself_troll` datetime NOT NULL default '0000-00-00 00:00:00',
  `date_last_refresh_manual_troll` datetime NOT NULL default '0000-00-00 00:00:00',
  `date_last_visit_troll` datetime NOT NULL default '0000-00-00 00:00:00',
  `lock_refresh_troll` enum('oui','non') NOT NULL default 'non',
  `is_seen_troll` enum('oui','non') NOT NULL default 'oui',
  `is_pnj_troll` varchar(10) NOT NULL default '',
  `id_baronnie_troll` int(11) default NULL,
  `groupe_rm_troll` enum('conseil','diplomate') default NULL,
  `id_distinction_troll` int(11) NOT NULL default '1',
  `date_inscription_troll` datetime default NULL,
  `email_troll` varchar(250) default NULL,
  `blason_troll` varchar(250) default NULL,
  `intangible_troll` varchar(10) default NULL,
  `nb_mouches_troll` int(11) default NULL,
  `nb_kills_troll` int(11) default NULL,
  `nb_morts_troll` int(11) default NULL,
  `num_rang_troll` int(11) default NULL,
  `nom_rang_troll` varchar(250) default NULL,
  `distinction_troll` text,
  `equipement2_troll` text,
  PRIMARY KEY  (`id_troll`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Structure de la table `votes`
-- 

CREATE TABLE `votes` (
  `id_vote` int(11) NOT NULL auto_increment,
  `id_troll_vote` int(11) NOT NULL default '0',
  `id_miss_vote` int(11) NOT NULL default '0',
  `genre_vote` enum('f','g') NOT NULL default 'f',
  `annee_vote` enum('2005','2006','2007','2008','2009','2010') NOT NULL default '2005',
  `type_vote` enum('rm','mh') NOT NULL default 'rm',
  `date_vote` datetime NOT NULL default '0000-00-00 00:00:00',
  `ip_vote` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id_vote`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1398 ;

-- --------------------------------------------------------

-- 
-- Structure de la table `vtt`
-- 

CREATE TABLE `vtt` (
  `No` int(11) NOT NULL default '0',
  `CacherData` tinyint(4) NOT NULL default '0',
  `DateTrash` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `DateMaj` timestamp NOT NULL default '2004-03-31 00:00:00',
  `Race` enum('Kastar','Skrim','Durakuir','Tomawak') default NULL,
  `VUE` tinyint(3) unsigned default NULL,
  `VUEB` tinyint(4) default NULL,
  `Niveau` tinyint(3) unsigned default NULL,
  `PVs` smallint(5) unsigned default NULL,
  `REG` tinyint(3) unsigned default NULL,
  `REGB` tinyint(4) default NULL,
  `ATT` tinyint(3) unsigned default NULL,
  `ATTB` smallint(6) default NULL,
  `ESQ` tinyint(3) unsigned default NULL,
  `ESQB` smallint(6) default NULL,
  `DEG` tinyint(3) unsigned default NULL,
  `DEGB` smallint(6) default NULL,
  `ARM` tinyint(3) unsigned default NULL,
  `ARMB` smallint(6) default NULL,
  `KILLs` smallint(5) unsigned default NULL,
  `DEADs` smallint(5) unsigned default NULL,
  `RM` smallint(5) unsigned default NULL,
  `RMB` smallint(6) default NULL,
  `MM` smallint(5) unsigned default NULL,
  `MMB` smallint(6) default NULL,
  `NomTroll` varchar(30) default NULL,
  `Joueur` varchar(50) default NULL,
  `AgeJoueur` tinyint(4) default NULL,
  `VilleJoueur` varchar(50) default NULL,
  `MSN` varchar(255) default NULL,
  `ICQ` varchar(20) default NULL,
  `EMail` varchar(255) default NULL,
  `Divers` tinytext,
  `DLAH` tinyint(3) unsigned default NULL,
  `DLAM` tinyint(3) unsigned default NULL,
  `Comps` tinytext,
  `Sorts` tinytext,
  `NbSorts` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`No`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Structure de la table `wanted`
-- 

CREATE TABLE `wanted` (
  `id_wanted` int(11) NOT NULL auto_increment,
  `id_troll_wanted` varchar(11) NOT NULL default '',
  `description_wanted` text,
  `is_again_wanted` enum('oui','non') NOT NULL default 'oui',
  `start_date_wanted` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id_wanted`),
  UNIQUE KEY `id_troll_wanted` (`id_troll_wanted`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
