-- --------------------------------------------------------

-- 
-- Structure de la table `best_familles`
-- 

DROP TABLE IF EXISTS `best_familles`;
CREATE TABLE IF NOT EXISTS `best_familles` (
  `id_famille` int(11) NOT NULL auto_increment,
  `nom_famille` varchar(60) NOT NULL default '',
  PRIMARY KEY  (`id_famille`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;
        

-- 
-- Contenu de la table `famille`
-- 

INSERT INTO `best_familles` (`nom_famille`) VALUES ('Animal');
INSERT INTO `best_familles` (`nom_famille`) VALUES ('Démon');
INSERT INTO `best_familles` (`nom_famille`) VALUES ('Humanoîde');
INSERT INTO `best_familles` (`nom_famille`) VALUES ('Insecte');
INSERT INTO `best_familles` (`nom_famille`) VALUES ('Monstre');
INSERT INTO `best_familles` (`nom_famille`) VALUES ('Mort-Vivant');
INSERT INTO `best_familles` (`nom_famille`) VALUES ('Spécial');
        
