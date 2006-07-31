-- phpMyAdmin SQL Dump
-- version 2.6.1
-- http://www.phpmyadmin.net
-- 
-- Serveur: localhost
-- Généré le : Samedi 23 Avril 2005 à 17:48
-- Version du serveur: 4.0.21
-- Version de PHP: 4.3.10
-- 
-- Base de données: `vue2drm`
-- 

-- --------------------------------------------------------

-- 
-- Structure de la table `best_races`
-- 

DROP TABLE IF EXISTS `best_races`;
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
) TYPE=MyISAM AUTO_INCREMENT=143 ;

-- 
-- Contenu de la table `best_races`
-- 

INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (1, 2, 'Abishaii Bleu', 'Images/Abishaii Bleu.gif', 'M', 0, 0, 15);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (2, 2, 'Abishaii Noir', 'Images/Abishaii Noir.gif', 'M', 0, 0, 9);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (3, 2, 'Abishaii Rouge', 'Images/Abishaii Rouge.gif', 'M', 0, 0, 17);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (4, 2, 'Abishaii Vert', 'Images/Abishaii Vert.gif', 'M', 0, 0, 7);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (5, 6, 'Ame-en-peine', 'Images/Ame-en-Peine.gif', 'F', 0, 0, 6);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (6, 5, 'Amibe Géante', 'Images/Amibe Geante.gif', 'F', 0, 0, 6);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (7, 5, 'Anaconda des Catacombes', 'Images/Anaconda des Catacombes.gif', 'M', 0, 0, 6);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (8, 4, 'Ankheg', 'Images/Ankheg.gif', 'M', 0, 0, 10);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (9, 4, 'Araignée Géante', 'Images/Araignee Geante.gif', 'F', 0, 0, 2);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (10, 2, 'Archi-Balrog', 'Images/Archi-Balrog.gif', 'M', 0, 0, 7);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (11, 2, 'Balrog', 'Images/Balrog.gif', 'M', 0, 0, 25);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (12, 6, 'Banshee', 'Images/Banshee.gif', 'F', 0, 0, 15);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (13, 2, 'Barghest', 'Images/Barghest.gif', 'M', 0, 0, 24);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (14, 5, 'Basilisk', 'Images/Basilisk.gif', 'M', 0, 0, 10);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (15, 2, 'Behemoth', 'Images/Behemoth.gif', 'M', 0, 0, 25);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (16, 5, 'Behir', 'Images/Behir.gif', 'M', 0, 0, 13);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (17, 5, 'Beholder', 'Images/Beholder.gif', 'M', 0, 0, 25);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (18, 3, 'Boggart', 'Images/Boggart.gif', 'M', 0, 0, 3);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (19, 5, 'Bondin', 'Images/Bondin.gif', 'M', 0, 0, 8);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (20, 5, 'Bulette', 'Images/Bulette.gif', 'F', 0, 0, 14);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (21, 3, 'Caillouteux', 'Images/Caillouteux.gif', 'M', 0, 0, 2);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (22, 5, 'Carnosaure', 'Images/Carnosaure.gif', 'M', 0, 0, 16);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (23, 3, 'Champi-Glouton', 'Images/Champi-Glouton.gif', 'M', 0, 0, 4);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (24, 1, 'Chauve-Souris Géante', 'Images/Chauve-Souris Geante.gif', 'F', 0, 0, 2);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (25, 5, 'Chimère', 'Images/Chimere.gif', 'F', 0, 0, 11);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (26, 5, 'Cockatrice', 'Images/Cockatrice.gif', 'M', 0, 0, 5);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (27, 6, 'Croquemitaine', 'Images/Croquemitaine.gif', 'M', 0, 0, 6);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (28, 5, 'Cube Gélatineux', 'Images/Cube Gelatineux.gif', 'M', 0, 0, 21);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (29, 2, 'Diablotin', 'Images/Diablotin.gif', 'M', 0, 0, 1);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (30, 1, 'Dindon Effray', 'Images/Dindon.gif', 'M', 0, 0, 1);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (31, 1, 'Dindon Du Feu', 'Images/Dindon.gif', 'M', 0, 0, 1);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (32, 1, 'Dindon Du Glacier', 'Images/Dindon.gif', 'M', 0, 0, 1);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (33, 1, 'Dindon du Glouglou', 'Images/Dindon du Glouglou.gif', 'M', 0, 0, 0);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (34, 1, 'Dindon Du Hum', 'Images/Dindon.gif', 'M', 0, 0, 1);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (35, 1, 'Dindon Du Manger', 'Images/Dindon.gif', 'M', 0, 0, 1);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (36, 1, 'Dindon', 'Images/Dindon.gif', 'M', 0, 0, 1);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (37, 5, 'Djinn', 'Images/Effrit.gif', 'M', 0, 0, 21);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (38, 2, 'Démon Mineur', 'Images/Demon Mineur.gif', 'M', 0, 0, 30);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (39, 6, 'Ectoplasme', 'Images/Ectoplasme.gif', 'M', 0, 0, 15);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (40, 5, 'Effrit', 'Images/Effrit.gif', 'M', 0, 0, 22);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (41, 2, 'Elémentaire d''Air', 'Images/Elementaire d''Air.gif', 'M', 0, 0, 18);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (42, 2, 'Elémentaire d''Eau', 'Images/Elementaire d''Eau.gif', 'M', 0, 0, 14);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (43, 2, 'Elémentaire de Feu', 'Images/Elementaire de Feu.gif', 'M', 0, 0, 17);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (44, 2, 'Elémentaire de Terre', 'Images/Elementaire de Terre.gif', 'M', 0, 0, 19);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (45, 2, 'Elémentaire du Chaos', 'Images/Elementaire du Chaos.gif', 'M', 0, 0, 17);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (46, 2, 'Erinyes', 'Images/Erinyes.gif', 'F', 0, 0, 8);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (47, 5, 'Esprit-Follet', 'Images/Esprit Follet.gif', 'M', 0, 0, 15);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (48, 3, 'Ettin', 'Images/Ettin.gif', 'M', 0, 0, 10);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (49, 6, 'Fantôme', 'Images/Fantome.gif', 'M', 0, 0, 19);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (50, 5, 'Feu Follet', 'Images/Feu Follet.gif', 'M', 0, 0, 16);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (51, 5, 'Fungus Géant', 'Images/Fungus Geant.gif', 'M', 0, 0, 6);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (52, 5, 'Fungus Violet', 'Images/Fungus Violet.gif', 'M', 0, 0, 3);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (53, 5, 'Gargouille', 'Images/Gargouille.gif', 'F', 0, 0, 5);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (54, 3, 'Gnoll', 'Images/Gnoll.gif', 'M', 0, 0, 3);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (55, 1, 'Gnu Sauvage', 'Images/Gnu Sauvage.gif', 'M', 0, 0, 2);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (56, 3, 'Goblin', 'Images/Goblin.gif', 'M', 0, 0, 1);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (57, 3, 'Goblours', 'Images/Goblours.gif', 'M', 0, 0, 4);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (58, 3, 'Golem d''Argile', 'Images/Golem d''Argile.gif', 'M', 0, 0, 14);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (59, 3, 'Golem de Bois', 'Images/Golem de bois.gif', 'M', 0, 0, 0);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (60, 3, 'Golem de Chair', 'Images/Golem de Chair.gif', 'M', 0, 0, 9);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (61, 3, 'Golem de Fer', 'Images/Golem de Fer.gif', 'M', 0, 0, 24);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (62, 3, 'Golem de Pierre', 'Images/Golem de Pierre.gif', 'M', 0, 0, 19);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (63, 5, 'Gorgone', 'Images/Gorgone.gif', 'F', 0, 0, 11);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (64, 6, 'Goule', 'Images/Goule.gif', 'F', 0, 0, 4);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (65, 1, 'Gowap Apprivoisé', 'Images/Gowap.gif', 'M', 0, 0, 0);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (66, 1, 'Gowap Sauvage', 'Images/Gowap.gif', 'M', 0, 0, 0);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (67, 3, 'Gremlins', 'Images/Gremlins.gif', 'M', 0, 0, 3);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (68, 2, 'Gritche', 'Images/Gritche.gif', 'M', 0, 0, 25);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (69, 5, 'Grouilleux', 'Images/Grouilleux.gif', 'M', 0, 0, 2);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (70, 5, 'Grylle', 'Images/Grylle.gif', 'M', 0, 0, 20);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (71, 3, 'Géant de Pierre', 'Images/Geant de Pierre.gif', 'M', 0, 0, 14);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (72, 3, 'Géant des Gouffres', 'Images/Geant des Gouffres.gif', 'M', 0, 0, 18);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (73, 3, 'Géant des Tempêtes', 'Images/Geant des Tempetes.gif', 'M', 0, 0, 18);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (74, 5, 'Harpie', 'Images/Harpie.gif', 'F', 0, 0, 4);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (75, 2, 'Hellrot', 'Images/Hellrot.gif', 'M', 0, 0, 15);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (76, 3, 'Homme-Lézard', 'Images/Homme-Lezard.gif', 'M', 0, 0, 4);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (77, 3, 'Hurleur', 'Images/Hurleur.gif', 'M', 0, 0, 8);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (78, 5, 'Hydre', 'Images/Hydre.gif', 'F', 0, 0, 22);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (79, 3, 'Kobold', 'Images/Kobold.gif', 'M', 0, 0, 1);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (80, 7, 'Lapin Blanc', 'Images/Lapin Blanc.gif', 'M', 0, 0, 21);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (81, 7, 'Les Yeux', 'Images/Les Yeux.gif', 'M', 0, 0, 0);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (82, 6, 'Liche', 'Images/Liche.gif', 'M', 0, 0, 0);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (83, 4, 'Limace Géante', 'Images/Limace Geante.gif', 'F', 0, 0, 9);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (84, 3, 'Loup-Garou', 'Images/Loup-Garou.gif', 'M', 0, 0, 8);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (85, 3, 'Lutin', 'Images/Lutin.gif', 'M', 0, 0, 2);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (86, 5, 'Lézard Géant', 'Images/Lezard Geant.gif', 'M', 0, 0, 5);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (87, 4, 'Mante Fulcreuse', 'Images/Mante Fulcreuse.gif', 'F', 0, 0, 22);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (88, 5, 'Manticore', 'Images/Manticore.gif', 'F', 0, 0, 7);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (89, 2, 'Marilith', 'Images/Marilith.gif', 'F', 0, 0, 22);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (90, 4, 'Mille-Pattes Géant', 'Images/Mille-Pattes Geant.gif', 'M', 0, 0, 12);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (91, 5, 'Mimique', 'Images/Mimique.gif', 'F', 0, 0, 7);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (92, 3, 'Minotaure', 'Images/Minotaure.gif', 'M', 0, 0, 6);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (93, 2, 'Molosse Satanique', 'Images/Molosse Satanique.gif', 'M', 0, 0, 7);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (94, 6, 'Momie', 'Images/Momie.gif', 'F', 0, 0, 4);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (95, 5, 'Monstre Rouilleur', 'Images/Monstre Rouilleur.gif', 'M', 0, 0, 3);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (96, 1, 'Mule', 'Images/Mule.gif', 'F', 0, 0, 1);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (97, 3, 'Méduse', 'Images/Meduse.gif', 'F', 0, 0, 6);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (98, 5, 'Naga', 'Images/Naga.gif', 'M', 0, 0, 9);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (99, 4, 'Nuage d''Insectes', 'Images/Nuage d''Insectes.gif', 'M', 0, 0, 5);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (100, 4, 'Nuée de Vermine', 'Images/Nuee de Vermine.gif', 'F', 0, 0, 10);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (101, 6, 'Nécrochore', 'Images/Necrochore.gif', 'M', 0, 0, 25);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (102, 6, 'Nécrophage', 'Images/Necrophage.gif', 'M', 0, 0, 7);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (103, 3, 'Ogre', 'Images/Ogre.gif', 'M', 0, 0, 6);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (104, 5, 'Ombre de Roches', 'Images/Ombre de Roches.gif', 'F', 0, 0, 12);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (105, 6, 'Ombre', 'Images/Ombre.gif', 'F', 0, 0, 2);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (106, 3, 'Orque', 'Images/Orque.gif', 'M', 0, 0, 3);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (107, 3, 'Ours-Garou', 'Images/Ours-Garou.gif', 'M', 0, 0, 13);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (108, 2, 'Palefroi Infernal', 'Images/Palefroi Infernal.gif', 'M', 0, 0, 20);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (109, 5, 'Phoenix', 'Images/Phoenix.gif', 'M', 0, 0, 23);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (110, 5, 'Plante Carnivore', 'Images/Plante Carnivore.gif', 'F', 0, 0, 4);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (111, 2, 'Pseudo-Dragon', 'Images/Pseudo-Dragon.gif', 'M', 0, 0, 1);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (112, 1, 'Rat Géant', 'Images/Rat Geant.gif', 'M', 0, 0, 1);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (113, 3, 'Rat-Garou', 'Images/Rat-Garou.gif', 'M', 0, 0, 3);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (114, 3, 'Rocketeux', 'Images/Rocketeux.gif', 'M', 0, 0, 5);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (115, 1, 'Sagouin', 'Images/Sagouin.gif', 'M', 0, 0, 3);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (116, 4, 'Scarabée Géant', 'Images/Scarabee Geant.gif', 'M', 0, 0, 5);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (117, 4, 'Scorpion Géant', 'Images/Scorpion Geant.gif', 'M', 0, 0, 10);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (118, 2, 'Shai', 'Images/Shai.gif', 'M', 0, 0, 16);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (119, 3, 'Sirène', 'Images/Sirene.gif', 'F', 0, 0, 8);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (120, 5, 'Slaad', 'Images/Slaad.gif', 'M', 0, 0, 5);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (121, 3, 'Sorcière', 'Images/Sorciere.gif', 'F', 0, 0, 15);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (122, 6, 'Spectre', 'Images/Spectre.gif', 'M', 0, 0, 13);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (123, 6, 'Squelette', 'Images/Squelette.gif', 'M', 0, 0, 1);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (124, 4, 'Strige', 'Images/Strige.gif', 'F', 0, 0, 1);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (125, 2, 'Succube', 'Images/Succube.gif', 'F', 0, 0, 10);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (126, 3, 'Super Bouffon, Gardien des Arcanes', 'Images/SuperBouffon.gif', 'M', 0, 0, 0);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (127, 5, 'T-Rex', 'Images/T-Rex.gif', 'M', 0, 0, 16);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (128, 5, 'Tertre Errant', 'Images/Tertre Errant.gif', 'M', 0, 0, 18);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (129, 4, 'Thri-kreen', 'Images/Thri-Kreen.gif', 'M', 0, 0, 8);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (130, 3, 'Tigre-Garou', 'Images/Tigre-Garou.gif', 'M', 0, 0, 9);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (131, 3, 'Titan', 'Images/Titan.gif', 'M', 0, 0, 20);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (132, 5, 'Trancheur', 'Images/Trancheur.gif', 'M', 0, 0, 21);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (133, 3, 'Troll Noir', 'Images/Troll Noir.gif', 'M', 0, 0, 11);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (134, 5, 'Tutoki', 'Images/Tutoki.gif', 'M', 0, 0, 2);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (135, 6, 'Vampire', 'Images/Vampire.gif', 'M', 0, 0, 22);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (136, 5, 'Ver Carnivore Géant', 'Images/Ver Carnivore Geant.gif', 'M', 0, 0, 13);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (137, 5, 'Vouivre', 'Images/Vouivre.gif', 'F', 0, 0, 23);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (138, 5, 'Worg', 'Images/Worg.gif', 'M', 0, 0, 5);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (139, 2, 'Xorn', 'Images/Xorn.gif', 'M', 0, 0, 11);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (140, 3, 'Yuan-ti', 'Images/Yuan-Ti.gif', 'M', 0, 0, 12);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (141, 3, 'Yéti', 'Images/Yeti.gif', 'M', 0, 0, 7);
INSERT INTO `best_races` (`id_race`, `id_famille_race`, `nom_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES (142, 6, 'Zombie', 'Images/Zombie.gif', 'M', 0, 0, 2);
