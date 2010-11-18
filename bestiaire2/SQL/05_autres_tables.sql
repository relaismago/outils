
-- --------------------------------------------------------

-- 
-- Structure de la table `best_cdms`
-- 

DROP TABLE IF EXISTS `best_cdms`;
CREATE TABLE IF NOT EXISTS `best_cdms` (
  `id_cdm` int(11) NOT NULL auto_increment,
  `id_mh` int(11) NOT NULL default '0',
  `id_race_cdm` int(11) NOT NULL default '0',
  `id_template_cdm` int(11) NOT NULL default '0',
  `id_age_cdm` int(11) NOT NULL default '0',
  `id_monstre_cdm` int(11) NOT NULL default '0',
  `nivmin_cdm` tinyint(3) NOT NULL default '0',
  `nivmax_cdm` tinyint(3) NOT NULL default '0',
  `pvmin_cdm` tinyint(3) NOT NULL default '0',
  `pvmax_cdm` tinyint(3) NOT NULL default '0',
  `attmin_cdm` tinyint(3) NOT NULL default '0',
  `attmax_cdm` tinyint(3) NOT NULL default '0',
  `esqmin_cdm` tinyint(3) NOT NULL default '0',
  `esqmax_cdm` tinyint(3) NOT NULL default '0',
  `degmin_cdm` tinyint(3) NOT NULL default '0',
  `degmax_cdm` tinyint(3) NOT NULL default '0',
  `regmin_cdm` tinyint(3) NOT NULL default '0',
  `regmax_cdm` tinyint(3) NOT NULL default '0',
  `armmin_cdm` tinyint(3) NOT NULL default '0',
  `armmax_cdm` tinyint(3) NOT NULL default '0',
  `vuemin_cdm` tinyint(3) NOT NULL default '0',
  `vuemax_cdm` tinyint(3) NOT NULL default '0',
  `capacite_speciale_cdm` varchar(64) NOT NULL default '',
  `affecte_cdm` varchar(128) NOT NULL default '',
  `date_cdm` timestamp(14) NOT NULL,
  `source_cdm` varchar(30) NOT NULL default 'Relais & Mago',
  PRIMARY KEY  (`id_cdm`),
  UNIQUE KEY `id_mh` (`id_mh`),
  KEY `Nom` (`id_monstre_cdm`),
  KEY `Race` (`id_race_cdm`),
  KEY `Template` (`id_template_cdm`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Structure de la table `best_derniersouffles`
-- 

DROP TABLE IF EXISTS `best_derniersouffles`;
CREATE TABLE IF NOT EXISTS `best_derniersouffles` (
  `id_dernierouffle` int(11) NOT NULL auto_increment,
  `id_monstre_dernierouffle` int(11) NOT NULL default '0',
  `id_race_derniersouffle` int(11) NOT NULL default '0',
  `id_template_derniersouffle` int(11) NOT NULL default '0',
  `nom_dernierouffle` varchar(64) NOT NULL default '?',
  `description_dernierouffle` varchar(128) NOT NULL default '?',
  `dégats_derniersouffle` varchar(20) NOT NULL default '',
  `duree_dernierouffle` enum('?','0','1','2','3','4','5','6','7','8','9') NOT NULL default '?',
  `zone_dernierouffle` enum('?','Aucun','Oui','Non') NOT NULL default '?',
  `date_dernierouffle` timestamp(14) NOT NULL,
  `source_dernierouffle` varchar(30) NOT NULL default 'Relais & Mago',
  PRIMARY KEY  (`id_dernierouffle`),
  UNIQUE KEY `Nom` (`id_monstre_dernierouffle`),
  KEY `Template` (`id_template_derniersouffle`),
  KEY `Race` (`id_race_derniersouffle`)
) TYPE=MyISAM COMMENT='pouvoirs se déclenchant à la mort' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Structure de la table `best_monstres`
-- 

DROP TABLE IF EXISTS `best_monstres`;
CREATE TABLE IF NOT EXISTS `best_monstres` (
  `id_monstre` int(11) NOT NULL auto_increment,
  `id_race_monstre` int(11) NOT NULL default '0',
  `id_template_monstre` int(11) NOT NULL default '0',
  `id_age_monstre` int(11) NOT NULL default '0',
  `nom_monstre` varchar(60) NOT NULL default '',
  `nivsom_monstre` int(11) NOT NULL default '0',
  `nivnbr_monstre` int(11) NOT NULL default '0',
  `pvsom_monstre` int(11) NOT NULL default '0',
  `pvnbr_monstre` int(11) NOT NULL default '0',
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
  `capspe_monstre` varchar(64) NOT NULL default '',
  `affecte_monstre` varchar(128) NOT NULL default '',
  `date_monstre` timestamp(14) NOT NULL,
  PRIMARY KEY  (`id_monstre`),
  UNIQUE KEY `Nom` (`nom_monstre`),
  KEY `Race` (`id_race_monstre`),
  KEY `Template` (`id_template_monstre`),
  KEY `Age` (`id_age_monstre`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Structure de la table `best_pouvoirs`
-- 

DROP TABLE IF EXISTS `best_pouvoirs`;
CREATE TABLE IF NOT EXISTS `best_pouvoirs` (
  `id_pouvoir` int(11) NOT NULL auto_increment,
  `id_monstre_pouvoir` int(11) NOT NULL default '0',
  `id_race_pouvoir` int(11) NOT NULL default '0',
  `id_template_pouvoir` int(11) NOT NULL default '0',
  `MMmin_pouvoir` tinyint(4) NOT NULL default '0',
  `MMmax_pouvoir` tinyint(4) NOT NULL default '0',
  `RMmin_pouvoir` tinyint(4) NOT NULL default '0',
  `RMmax_pouvoir` tinyint(4) NOT NULL default '0',
  `degats_pouvoir` varchar(20) NOT NULL default '',
  `Portee_pouvoir` tinyint(2) NOT NULL default '0',
  `duree_pouvoir` enum('?','0','1','2','3','4','5','6','7','8','9') NOT NULL default '?',
  `sepatt_pouvoir` enum('?','Oui','Non') NOT NULL default '?',
  `zone_pouvoir` enum('?','Oui','Non') NOT NULL default '?',
  `date_pouvoir` timestamp(14) NOT NULL,
  `source_pouvoir` varchar(30) NOT NULL default 'Relais & Mago',
  PRIMARY KEY  (`id_pouvoir`),
  UNIQUE KEY `Monstre` (`id_monstre_pouvoir`),
  KEY `Race` (`id_race_pouvoir`),
  KEY `Template` (`id_template_pouvoir`)
) TYPE=MyISAM COMMENT='pouvoirs magiques' AUTO_INCREMENT=1 ;
