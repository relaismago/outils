
-- --------------------------------------------------------

-- 
-- Structure de la table `best_ages`
-- 

DROP TABLE IF EXISTS `best_ages`;
CREATE TABLE IF NOT EXISTS `best_ages` (
  `id_age` int(11) NOT NULL auto_increment,
  `id_famille_age` int(11) NOT NULL default '0',
  `nom_masculin_age` varchar(60) NOT NULL default '',
  `nom_feminin_age` varchar(60) NOT NULL default '',
  `ordre_age` tinyint(3) NOT NULL default '0',
  PRIMARY KEY  (`id_age`),
  KEY `Famille` (`id_famille_age`)
) TYPE=MyISAM COMMENT='Diff�rents ages pour chaque famille' AUTO_INCREMENT=1 ;
        


-- 
-- Contenu de la table `ages`
-- 

INSERT IGNORE INTO `best_ages` (`id_famille_age`, `nom_masculin_age`, `nom_feminin_age`, `ordre_age`) VALUES (1, 'B�b�', 'B�b�', 0);
INSERT IGNORE INTO `best_ages` (`id_famille_age`, `nom_masculin_age`, `nom_feminin_age`, `ordre_age`) VALUES (1, 'Enfan�on', 'Enfan�on', 1);
INSERT IGNORE INTO `best_ages` (`id_famille_age`, `nom_masculin_age`, `nom_feminin_age`, `ordre_age`) VALUES (1, 'Jeune', 'Jeune', 2);
INSERT IGNORE INTO `best_ages` (`id_famille_age`, `nom_masculin_age`, `nom_feminin_age`, `ordre_age`) VALUES (1, 'Adulte', 'Adulte', 3);
INSERT IGNORE INTO `best_ages` (`id_famille_age`, `nom_masculin_age`, `nom_feminin_age`, `ordre_age`) VALUES (1, 'Mature', 'Mature', 4);
INSERT IGNORE INTO `best_ages` (`id_famille_age`, `nom_masculin_age`, `nom_feminin_age`, `ordre_age`) VALUES (1, 'Chef de harde', 'Chef de harde', 5);
INSERT IGNORE INTO `best_ages` (`id_famille_age`, `nom_masculin_age`, `nom_feminin_age`, `ordre_age`) VALUES (1, 'Anc�tre', 'Anc�tre', 6);
INSERT IGNORE INTO `best_ages` (`id_famille_age`, `nom_masculin_age`, `nom_feminin_age`, `ordre_age`) VALUES (1, 'Ancien', 'Ancien', 7);
INSERT IGNORE INTO `best_ages` (`id_famille_age`, `nom_masculin_age`, `nom_feminin_age`, `ordre_age`) VALUES (2, 'Initial', 'Initiale', 0);
INSERT IGNORE INTO `best_ages` (`id_famille_age`, `nom_masculin_age`, `nom_feminin_age`, `ordre_age`) VALUES (2, 'Novice', 'Novice', 1);
INSERT IGNORE INTO `best_ages` (`id_famille_age`, `nom_masculin_age`, `nom_feminin_age`, `ordre_age`) VALUES (2, 'Mineur', 'Mineure', 2);
INSERT IGNORE INTO `best_ages` (`id_famille_age`, `nom_masculin_age`, `nom_feminin_age`, `ordre_age`) VALUES (2, 'Favori', 'Favorite', 3);
INSERT IGNORE INTO `best_ages` (`id_famille_age`, `nom_masculin_age`, `nom_feminin_age`, `ordre_age`) VALUES (2, 'Majeur', 'Majeure', 4);
INSERT IGNORE INTO `best_ages` (`id_famille_age`, `nom_masculin_age`, `nom_feminin_age`, `ordre_age`) VALUES (2, 'Sup�rieur', 'Sup�rieure', 5);
INSERT IGNORE INTO `best_ages` (`id_famille_age`, `nom_masculin_age`, `nom_feminin_age`, `ordre_age`) VALUES (2, 'Supr�me', 'Supr�me', 6);
INSERT IGNORE INTO `best_ages` (`id_famille_age`, `nom_masculin_age`, `nom_feminin_age`, `ordre_age`) VALUES (2, 'Ultime', 'Ultime', 7);
INSERT IGNORE INTO `best_ages` (`id_famille_age`, `nom_masculin_age`, `nom_feminin_age`, `ordre_age`) VALUES (3, 'Nouveau', 'Nouvelle', 0);
INSERT IGNORE INTO `best_ages` (`id_famille_age`, `nom_masculin_age`, `nom_feminin_age`, `ordre_age`) VALUES (3, 'Jeune', 'Jeune', 1);
INSERT IGNORE INTO `best_ages` (`id_famille_age`, `nom_masculin_age`, `nom_feminin_age`, `ordre_age`) VALUES (3, 'Adulte', 'Adulte', 2);
INSERT IGNORE INTO `best_ages` (`id_famille_age`, `nom_masculin_age`, `nom_feminin_age`, `ordre_age`) VALUES (3, 'V�t�ran', 'V�t�ran', 3);
INSERT IGNORE INTO `best_ages` (`id_famille_age`, `nom_masculin_age`, `nom_feminin_age`, `ordre_age`) VALUES (3, 'Briscard', 'Briscarde', 4);
INSERT IGNORE INTO `best_ages` (`id_famille_age`, `nom_masculin_age`, `nom_feminin_age`, `ordre_age`) VALUES (3, 'Doyen', 'Doyenne', 5);
INSERT IGNORE INTO `best_ages` (`id_famille_age`, `nom_masculin_age`, `nom_feminin_age`, `ordre_age`) VALUES (3, 'L�gendaire', 'L�gendaire', 6);
INSERT IGNORE INTO `best_ages` (`id_famille_age`, `nom_masculin_age`, `nom_feminin_age`, `ordre_age`) VALUES (3, 'Mythique', 'Mythique', 7);
INSERT IGNORE INTO `best_ages` (`id_famille_age`, `nom_masculin_age`, `nom_feminin_age`, `ordre_age`) VALUES (4, 'Larve', 'Larve', 0);
INSERT IGNORE INTO `best_ages` (`id_famille_age`, `nom_masculin_age`, `nom_feminin_age`, `ordre_age`) VALUES (4, 'Immature', 'Immature', 1);
INSERT IGNORE INTO `best_ages` (`id_famille_age`, `nom_masculin_age`, `nom_feminin_age`, `ordre_age`) VALUES (4, 'Juv�nile', 'Juv�nile', 2);
INSERT IGNORE INTO `best_ages` (`id_famille_age`, `nom_masculin_age`, `nom_feminin_age`, `ordre_age`) VALUES (4, 'Imago', 'Imago', 3);
INSERT IGNORE INTO `best_ages` (`id_famille_age`, `nom_masculin_age`, `nom_feminin_age`, `ordre_age`) VALUES (4, 'D�velopp�', 'D�velopp�e', 4);
INSERT IGNORE INTO `best_ages` (`id_famille_age`, `nom_masculin_age`, `nom_feminin_age`, `ordre_age`) VALUES (4, 'M�r', 'M�re', 5);
INSERT IGNORE INTO `best_ages` (`id_famille_age`, `nom_masculin_age`, `nom_feminin_age`, `ordre_age`) VALUES (4, 'Accompli', 'Accomplie', 6);
INSERT IGNORE INTO `best_ages` (`id_famille_age`, `nom_masculin_age`, `nom_feminin_age`, `ordre_age`) VALUES (4, 'Achev�', 'Achev�e', 7);
INSERT IGNORE INTO `best_ages` (`id_famille_age`, `nom_masculin_age`, `nom_feminin_age`, `ordre_age`) VALUES (5, 'Nouveau', 'Nouvelle', 0);
INSERT IGNORE INTO `best_ages` (`id_famille_age`, `nom_masculin_age`, `nom_feminin_age`, `ordre_age`) VALUES (5, 'Jeune', 'Jeune', 1);
INSERT IGNORE INTO `best_ages` (`id_famille_age`, `nom_masculin_age`, `nom_feminin_age`, `ordre_age`) VALUES (5, 'Adulte', 'Adulte', 2);
INSERT IGNORE INTO `best_ages` (`id_famille_age`, `nom_masculin_age`, `nom_feminin_age`, `ordre_age`) VALUES (5, 'V�t�ran', 'V�t�ran', 3);
INSERT IGNORE INTO `best_ages` (`id_famille_age`, `nom_masculin_age`, `nom_feminin_age`, `ordre_age`) VALUES (5, 'Briscard', 'Briscarde', 4);
INSERT IGNORE INTO `best_ages` (`id_famille_age`, `nom_masculin_age`, `nom_feminin_age`, `ordre_age`) VALUES (5, 'Doyen', 'Doyenne', 5);
INSERT IGNORE INTO `best_ages` (`id_famille_age`, `nom_masculin_age`, `nom_feminin_age`, `ordre_age`) VALUES (5, 'L�gendaire', 'L�gendaire', 6);
INSERT IGNORE INTO `best_ages` (`id_famille_age`, `nom_masculin_age`, `nom_feminin_age`, `ordre_age`) VALUES (5, 'Mythique', 'Mythique', 7);
INSERT IGNORE INTO `best_ages` (`id_famille_age`, `nom_masculin_age`, `nom_feminin_age`, `ordre_age`) VALUES (6, 'Naissant', 'Naissante', 0);
INSERT IGNORE INTO `best_ages` (`id_famille_age`, `nom_masculin_age`, `nom_feminin_age`, `ordre_age`) VALUES (6, 'R�cent', 'R�cente', 1);
INSERT IGNORE INTO `best_ages` (`id_famille_age`, `nom_masculin_age`, `nom_feminin_age`, `ordre_age`) VALUES (6, 'Ancien', 'Ancienne', 2);
INSERT IGNORE INTO `best_ages` (`id_famille_age`, `nom_masculin_age`, `nom_feminin_age`, `ordre_age`) VALUES (6, 'V�n�rable', 'V�n�rable', 3);
INSERT IGNORE INTO `best_ages` (`id_famille_age`, `nom_masculin_age`, `nom_feminin_age`, `ordre_age`) VALUES (6, 'S�culaire', 'S�culaire', 4);
INSERT IGNORE INTO `best_ages` (`id_famille_age`, `nom_masculin_age`, `nom_feminin_age`, `ordre_age`) VALUES (6, 'Antique', 'Antique', 5);
INSERT IGNORE INTO `best_ages` (`id_famille_age`, `nom_masculin_age`, `nom_feminin_age`, `ordre_age`) VALUES (6, 'Ancestral', 'Ancestrale', 6);
INSERT IGNORE INTO `best_ages` (`id_famille_age`, `nom_masculin_age`, `nom_feminin_age`, `ordre_age`) VALUES (6, 'Ant�diluvien', 'Ant�diluvienne', 7);
INSERT IGNORE INTO `best_ages` (`id_famille_age`, `nom_masculin_age`, `nom_feminin_age`, `ordre_age`) VALUES (7, 'Mature', 'Mature', 0);
INSERT IGNORE INTO `best_ages` (`id_famille_age`, `nom_masculin_age`, `nom_feminin_age`, `ordre_age`) VALUES (7, 'Chef de harde', 'Chef de Harde', 5);
INSERT IGNORE INTO `best_ages` (`id_famille_age`, `nom_masculin_age`, `nom_feminin_age`, `ordre_age`) VALUES (7, 'Ancien', 'Ancienne', 1);
