-- phpMyAdmin SQL Dump
-- version 2.6.2
-- http://www.phpmyadmin.net
-- 
-- Serveur: localhost
-- Généré le : Jeudi 21 Avril 2005 à 07:40
-- Version du serveur: 4.0.20
-- Version de PHP: 4.3.6
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
) TYPE=MyISAM ;

-- 
-- Contenu de la table `best_races`
-- 

INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Abishaii Bleu', 2, 'Images/Abishaii Bleu.gif', 'M', 0, 0, 15);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Abishaii Noir', 2, 'Images/Abishaii Noir.gif', 'M', 0, 0, 9);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Abishaii Rouge', 2, 'Images/Abishaii Rouge.gif', 'M', 0, 0, 17);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Abishaii Vert', 2, 'Images/Abishaii Vert.gif', 'M', 0, 0, 7);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Ame-en-peine', 6, 'Images/Ame-en-Peine.gif', 'F', 0, 0, 6);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Amibe Géante', 5, 'Images/Amibe Geante.gif', 'F', 0, 0, 6);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Anaconda des Catacombes', 5, 'Images/Anaconda des Catacombes.gif', 'M', 0, 0, 6);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Ankheg', 4, 'Images/Ankheg.gif', 'M', 0, 0, 10);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Araignée Géante', 4, 'Images/Araignee Geante.gif', 'F', 0, 0, 2);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Archi-Balrog', 2, 'Images/Archi-Balrog.gif', 'M', 0, 0, 7);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Balrog', 2, 'Images/Balrog.gif', 'M', 0, 0, 25);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Banshee', 6, 'Images/Banshee.gif', 'F', 0, 0, 15);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Barghest', 2, 'Images/Barghest.gif', 'M', 0, 0, 24);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Basilisk', 5, 'Images/Basilisk.gif', 'M', 0, 0, 10);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Behemoth', 2, 'Images/Behemoth.gif', 'M', 0, 0, 25);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Behir', 5, 'Images/Behir.gif', 'M', 0, 0, 13);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Beholder', 5, 'Images/Beholder.gif', 'M', 0, 0, 25);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Boggart', 3, 'Images/Boggart.gif', 'M', 0, 0, 3);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Bondin', 5, 'Images/Bondin.gif', 'M', 0, 0, 8);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Bulette', 5, 'Images/Bulette.gif', 'F', 0, 0, 14);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Caillouteux', 3, 'Images/Caillouteux.gif', 'M', 0, 0, 2);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Carnosaure', 5, 'Images/Carnosaure.gif', 'M', 0, 0, 16);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Champi-Glouton', 3, 'Images/Champi-Glouton.gif', 'M', 0, 0, 4);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Chauve-Souris Géante', 1, 'Images/Chauve-Souris Geante.gif', 'F', 0, 0, 2);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Chimère', 5, 'Images/Chimere.gif', 'F', 0, 0, 11);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Cockatrice', 5, 'Images/Cockatrice.gif', 'M', 0, 0, 5);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Croquemitaine', 6, 'Images/Croquemitaine.gif', 'M', 0, 0, 6);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Cube Gélatineux', 5, 'Images/Cube Gelatineux.gif', 'M', 0, 0, 21);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Diablotin', 2, 'Images/Diablotin.gif', 'M', 0, 0, 1);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Dindon Effray', 1, 'Images/Dindon.gif', 'M', 0, 0, 1);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Dindon Du Feu', 1, 'Images/Dindon.gif', 'M', 0, 0, 1);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Dindon Du Glacier', 1, 'Images/Dindon.gif', 'M', 0, 0, 1);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Dindon du Glouglou', 1, 'Images/Dindon du Glouglou.gif', 'M', 0, 0, 0);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Dindon Du Hum', 1, 'Images/Dindon.gif', 'M', 0, 0, 1);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Dindon Du Manger', 1, 'Images/Dindon.gif', 'M', 0, 0, 1);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Dindon', 1, 'Images/Dindon.gif', 'M', 0, 0, 1);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Djinn', 5, 'Images/Effrit.gif', 'M', 0, 0, 21);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Démon Mineur', 2, 'Images/Demon Mineur.gif', 'M', 0, 0,30);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Ectoplasme', 6, 'Images/Ectoplasme.gif', 'M', 0, 0, 15);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Effrit', 5, 'Images/Effrit.gif', 'M', 0, 0, 22);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Elémentaire d''Air', 2, 'Images/Elementaire d''Air.gif', 'M', 0, 0, 18);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Elémentaire d''Eau', 2, 'Images/Elementaire d''Eau.gif', 'M', 0, 0, 14);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Elémentaire de Feu', 2, 'Images/Elementaire de Feu.gif', 'M', 0, 0, 17);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Elémentaire de Terre', 2, 'Images/Elementaire de Terre.gif', 'M', 0, 0, 19);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Elémentaire du Chaos', 2, 'Images/Elementaire du Chaos.gif', 'M', 0, 0, 17);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Erinyes', 2, 'Images/Erinyes.gif', 'F', 0, 0, 8);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Esprit-Follet', 5, 'Images/Esprit Follet.gif', 'M', 0, 0, 15);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Ettin', 3, 'Images/Ettin.gif', 'M', 0, 0, 10);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Fantôme', 6, 'Images/Fantome.gif', 'M', 0, 0, 19);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Feu Follet', 5, 'Images/Feu Follet.gif', 'M', 0, 0, 16);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Fungus Géant', 5, 'Images/Fungus Geant.gif', 'M', 0, 0, 6);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Fungus Violet', 5, 'Images/Fungus Violet.gif', 'M', 0, 0, 3);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Gargouille', 5, 'Images/Gargouille.gif', 'F', 0, 0, 5);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Gnoll', 3, 'Images/Gnoll.gif', 'M', 0, 0, 3);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Gnu Sauvage', 1, 'Images/Gnu Sauvage.gif', 'M', 0, 0, 2);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Goblin', 3, 'Images/Goblin.gif', 'M', 0, 0, 1);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Goblours', 3, 'Images/Goblours.gif', 'M', 0, 0, 4);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Golem d''Argile', 3, 'Images/Golem d''Argile.gif', 'M', 0, 0, 14);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Golem de Bois', 3, 'Images/Golem de bois.gif', 'M', 0, 0, 0);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Golem de Chair', 3, 'Images/Golem de Chair.gif', 'M', 0, 0, 9);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Golem de Fer', 3, 'Images/Golem de Fer.gif', 'M', 0, 0, 24);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Golem de Pierre', 3, 'Images/Golem de Pierre.gif', 'M', 0, 0, 19);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Gorgone', 5, 'Images/Gorgone.gif', 'F', 0, 0, 11);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Goule', 6, 'Images/Goule.gif', 'F', 0, 0, 4);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Gowap Apprivoisé', 1, 'Images/Gowap.gif', 'M', 0, 0, 0);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Gowap Sauvage', 1, 'Images/Gowap.gif', 'M', 0, 0, 0);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Gremlins', 3, 'Images/Gremlins.gif', 'M', 0, 0, 3);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Gritche', 2, 'Images/Gritche.gif', 'M', 0, 0, 25);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Grouilleux', 5, 'Images/Grouilleux.gif', 'M', 0, 0, 2);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Grylle', 5, 'Images/Grylle.gif', 'M', 0, 0, 20);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Géant de Pierre', 3, 'Images/Geant de Pierre.gif', 'M', 0, 0, 14);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Géant des Gouffres', 3, 'Images/Geant des Gouffres.gif', 'M', 0, 0, 18);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Géant des Tempêtes', 3, 'Images/Geant des Tempetes.gif', 'M', 0, 0, 18);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Harpie', 5, 'Images/Harpie.gif', 'F', 0, 0, 4);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Hellrot', 2, 'Images/Hellrot.gif', 'M', 0, 0, 15);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Homme-Lézard', 3, 'Images/Homme-Lezard.gif', 'M', 0, 0, 4);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Hurleur', 3, 'Images/Hurleur.gif', 'M', 0, 0, 8);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Hydre', 5, 'Images/Hydre.gif', 'F', 0, 0, 22);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Kobold', 3, 'Images/Kobold.gif', 'M', 0, 0, 1);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Lapin Blanc', 7, 'Images/Lapin Blanc.gif', 'M', 0, 0, 21);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Les Yeux', 7, 'Images/Les Yeux.gif', 'M', 0, 0, 0);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Liche', 6, 'Images/Liche.gif', 'M', 0, 0, 0);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Limace Géante', 4, 'Images/Limace Geante.gif', 'F', 0, 0, 9);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Loup-Garou', 3, 'Images/Loup-Garou.gif', 'M', 0, 0, 8);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Lutin', 3, 'Images/Lutin.gif', 'M', 0, 0, 2);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Lézard Géant', 5, 'Images/Lezard Geant.gif', 'M', 0, 0, 5);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Mante Fulcreuse', 4, 'Images/Mante Fulcreuse.gif', 'F', 0, 0, 22);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Manticore', 5, 'Images/Manticore.gif', 'F', 0, 0, 7);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Marilith', 2, 'Images/Marilith.gif', 'F', 0, 0, 22);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Mille-Pattes Géant', 4, 'Images/Mille-Pattes Geant.gif', 'M', 0, 0, 12);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Mimique', 5, 'Images/Mimique.gif', 'F', 0, 0, 7);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Minotaure', 3, 'Images/Minotaure.gif', 'M', 0, 0, 6);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Molosse Satanique', 2, 'Images/Molosse Satanique.gif', 'M', 0, 0, 7);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Momie', 6, 'Images/Momie.gif', 'F', 0, 0, 4);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Monstre Rouilleur', 5, 'Images/Monstre Rouilleur.gif', 'M', 0, 0, 3);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Mule', 1, 'Images/Mule.gif', 'F', 0, 0, 1);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Méduse', 3, 'Images/Meduse.gif', 'F', 0, 0, 6);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Naga', 5, 'Images/Naga.gif', 'M', 0, 0, 9);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Nuage d''Insectes', 4, 'Images/Nuage d''Insectes.gif', 'M', 0, 0, 5);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Nuée de Vermine', 4, 'Images/Nuee de Vermine.gif', 'F', 0, 0, 10);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Nécrochore', 6, 'Images/Necrochore.gif', 'M', 0, 0, 25);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Nécrophage', 6, 'Images/Necrophage.gif', 'M', 0, 0, 7);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Ogre', 3, 'Images/Ogre.gif', 'M', 0, 0, 6);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Ombre de Roches', 5, 'Images/Ombre de Roches.gif', 'F', 0, 0, 12);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Ombre', 6, 'Images/Ombre.gif', 'F', 0, 0, 2);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Orque', 3, 'Images/Orque.gif', 'M', 0, 0, 3);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Ours-Garou', 3, 'Images/Ours-Garou.gif', 'M', 0, 0, 13);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Palefroi Infernal', 2, 'Images/Palefroi Infernal.gif', 'M', 0, 0, 20);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Phoenix', 5, 'Images/Phoenix.gif', 'M', 0, 0, 23);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Plante Carnivore', 5, 'Images/Plante Carnivore.gif', 'F', 0, 0, 4);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Pseudo-Dragon', 2, 'Images/Pseudo-Dragon.gif', 'M', 0, 0, 1);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Rat Géant', 1, 'Images/Rat Geant.gif', 'M', 0, 0, 1);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Rat-Garou', 3, 'Images/Rat-Garou.gif', 'M', 0, 0, 3);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Rocketeux', 3, 'Images/Rocketeux.gif', 'M', 0, 0, 5);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Sagouin', 1, 'Images/Sagouin.gif', 'M', 0, 0, 3);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Scarabée Géant', 4, 'Images/Scarabee Geant.gif', 'M', 0, 0, 5);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Scorpion Géant', 4, 'Images/Scorpion Geant.gif', 'M', 0, 0, 10);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Shai', 2, 'Images/Shai.gif', 'M', 0, 0, 16);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Sirène', 3, 'Images/Sirene.gif', 'F', 0, 0, 8);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Slaad', 5, 'Images/Slaad.gif', 'M', 0, 0, 5);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Sorcière', 3, 'Images/Sorciere.gif', 'F', 0, 0, 15);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Spectre', 6, 'Images/Spectre.gif', 'M', 0, 0, 13);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Squelette', 6, 'Images/Squelette.gif', 'M', 0, 0, 1);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Strige', 4, 'Images/Strige.gif', 'F', 0, 0, 1);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Succube', 2, 'Images/Succube.gif', 'F', 0, 0, 10);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Super Bouffon, Gardien des Arcanes', 3, 'Images/SuperBouffon.gif', 'M', 0, 0, 0);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('T-Rex', 5, 'Images/T-Rex.gif', 'M', 0, 0, 16);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Tertre Errant', 5, 'Images/Tertre Errant.gif', 'M', 0, 0, 18);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Thri-kreen', 4, 'Images/Thri-Kreen.gif', 'M', 0, 0, 8);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Tigre-Garou', 3, 'Images/Tigre-Garou.gif', 'M', 0, 0, 9);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Titan', 3, 'Images/Titan.gif', 'M', 0, 0, 20);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Trancheur', 5, 'Images/Trancheur.gif', 'M', 0, 0, 21);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Troll Noir', 3, 'Images/Troll Noir.gif', 'M', 0, 0, 11);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Tutoki', 5, 'Images/Tutoki.gif', 'M', 0, 0, 2);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Vampire', 6, 'Images/Vampire.gif', 'M', 0, 0, 22);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Ver Carnivore Géant', 5, 'Images/Ver Carnivore Geant.gif', 'M', 0, 0, 13);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Vouivre', 5, 'Images/Vouivre.gif', 'F', 0, 0, 23);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Worg', 5, 'Images/Worg.gif', 'M', 0, 0, 5);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Xorn', 2, 'Images/Xorn.gif', 'M', 0, 0, 11);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Yuan-ti', 3, 'Images/Yuan-Ti.gif', 'M', 0, 0, 12);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Yéti', 3, 'Images/Yeti.gif', 'M', 0, 0, 7);
INSERT INTO `best_races` (`nom_race`, `id_famille_race`, `image_race`, `genre_race`, `nivsom_race`, `nivnbr_race`, `niv_base`) VALUES ('Zombie', 6, 'Images/Zombie.gif', 'M', 0, 0, 2);
