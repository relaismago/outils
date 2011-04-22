
Base de données ggc sur le serveur localhost

# phpMyAdmin SQL Dump
# version 2.5.4
# http://www.phpmyadmin.net
#
# Serveur: localhost
# Généré le : Vendredi 14 Janvier 2005 à 18:00
# Version du serveur: 4.0.16
# Version de PHP: 4.3.3
# 
# Base de données: `ggc`
# 

# --------------------------------------------------------

#
# Structure de la table `ggc_comp`
#

CREATE TABLE ggc_comp (
  ID_TROLL int(5) NOT NULL default '0',
  ID_COMP_SORT int(11) NOT NULL default '0',
  NOM_COMP_SORT varchar(30) default NULL,
  PCT_COMP_SORT int(11) default NULL,
  DATE_MAJ int(11) default NULL,
  PRIMARY KEY  (ID_TROLL,ID_COMP_SORT)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Structure de la table `ggc_evt`
#

CREATE TABLE ggc_evt (
  ID_GROUPE int(3) NOT NULL default '0',
  ID_TROLL int(5) NOT NULL default '0',
  HEURE int(11) NOT NULL default '0',
  TYPE_EVT varchar(30) default NULL,
  TEXTE_EVT varchar(255) default NULL,
  PV int(3) default NULL,
  ID_MONSTRE int(11) default NULL,
  PRIMARY KEY  (ID_GROUPE,ID_TROLL,HEURE)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Structure de la table `ggc_groupe`
#

CREATE TABLE ggc_groupe (
  ID_GROUPE int(11) NOT NULL default '0',
  NOM_GROUPE varchar(100) default NULL,
  NB_TROLLS int(3) default NULL,
  NB_MONSTRES int(3) default NULL,
  NB_PX int(4) default NULL,
  NB_GG int(6) default NULL,
  DATE_MAJ int(11) default NULL,
  PRIMARY KEY  (ID_GROUPE)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Structure de la table `ggc_membre`
#

CREATE TABLE ggc_membre (
  ID_MEMBRE int(10) NOT NULL default '0',
  ID varchar(20) default NULL,
  ID_TROLL int(5) default NULL,
  PASSE varchar(20) default NULL,
  PRIMARY KEY  (ID_MEMBRE)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Structure de la table `ggc_troll`
#

CREATE TABLE ggc_troll (
  ID_TROLL int(5) NOT NULL default '0',
  NOM_TROLL varchar(30) default NULL,
  NIVEAU_TROLL int(2) default NULL,
  RACE varchar(20) default NULL,
  DLA_EN_COURS int(11) default NULL,
  DLA_SUIVANTE int(11) default NULL,
  DLA_PREVUE int(11) default NULL,
  POSITION_X int(5) default NULL,
  POSITION_Y int(5) default NULL,
  POSITION_Z int(5) default NULL,
  PV_ACTUEL int(3) default NULL,
  PV_MAX int(3) default NULL,
  FATIGUE_KASTAR int(2) default NULL,
  DATE_MAJ int(11) default NULL,
  ID_GROUPE int(11) default NULL,
  PRIMARY KEY  (ID_TROLL)
) TYPE=MyISAM;

