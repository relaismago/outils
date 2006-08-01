# phpMyAdmin SQL Dump
# version 2.5.4
# http://www.phpmyadmin.net
#
# Serveur: localhost
# Généré le : Vendredi 28 Janvier 2005 à 16:33
# Version du serveur: 4.0.16
# Version de PHP: 4.3.3
# 
# Base de données: `ggc`
# 
#03/04/2005 ajout de la colonne pa
# --------------------------------------------------------

#
# Structure de la table `ggc_comp`
#

DROP TABLE IF EXISTS `ggc_comp`;
CREATE TABLE `ggc_comp` (
  `id_troll` int(5) NOT NULL default '0',
  `id_comp_sort` int(11) NOT NULL default '0',
  `nom_comp_sort` varchar(30) default NULL,
  `pct_comp_sort` int(11) default NULL,
  `date_maj` int(11) default NULL,
  PRIMARY KEY  (`id_troll`,`id_comp_sort`)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Structure de la table `ggc_evt`
#

DROP TABLE IF EXISTS `ggc_evt`;
CREATE TABLE `ggc_evt` (
  `id_groupe` int(3) NOT NULL default '0',
  `id_troll` int(5) NOT NULL default '0',
  `date_maj` int(11) NOT NULL default '0',
  `type_evt` varchar(30) default NULL,
  `texte_evt` varchar(255) default NULL,
  `pv` int(3) default NULL,
  `id_monstre` int(11) default NULL,
  PRIMARY KEY  (`id_groupe`,`id_troll`,`date_maj`)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Structure de la table `ggc_groupe`
#

DROP TABLE IF EXISTS `ggc_groupe`;
CREATE TABLE `ggc_groupe` (
  `id_groupe` int(11) NOT NULL default '0',
  `nom_groupe` varchar(100) default NULL,
  `nb_trolls` int(3) default NULL,
  `nb_monstres` int(3) default NULL,
  `nb_px` int(4) default NULL,
  `nb_gg` int(6) default NULL,
  `date_maj` int(11) default NULL,
  PRIMARY KEY  (`id_groupe`)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Structure de la table `ggc_membre`
#

DROP TABLE IF EXISTS `ggc_membre`;
CREATE TABLE `ggc_membre` (
  `id_membre` int(10) NOT NULL default '0',
  `id` varchar(20) default NULL,
  `id_troll` int(5) default NULL,
  `passe` varchar(20) default NULL,
  PRIMARY KEY  (`id_membre`)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Structure de la table `ggc_monstre`
#

DROP TABLE IF EXISTS `ggc_monstre`;
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
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Structure de la table `ggc_troll`


DROP TABLE IF EXISTS `ggc_troll`;
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
) TYPE=MyISAM;