-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           5.7.33 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour cinema_v2
CREATE DATABASE IF NOT EXISTS `cinema_v2` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `cinema_v2`;

-- Listage de la structure de la table cinema_v2. acteur
CREATE TABLE IF NOT EXISTS `acteur` (
  `id_acteur` int(11) NOT NULL AUTO_INCREMENT,
  `id_personne` int(11) NOT NULL,
  PRIMARY KEY (`id_acteur`),
  KEY `FK_acteur_personne` (`id_personne`),
  CONSTRAINT `FK_acteur_personne` FOREIGN KEY (`id_personne`) REFERENCES `personne` (`id_personne`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema_v2.acteur : ~8 rows (environ)
/*!40000 ALTER TABLE `acteur` DISABLE KEYS */;
INSERT INTO `acteur` (`id_acteur`, `id_personne`) VALUES
	(1, 1),
	(2, 3),
	(3, 4),
	(4, 6),
	(5, 7),
	(6, 8),
	(7, 9),
	(8, 10);
/*!40000 ALTER TABLE `acteur` ENABLE KEYS */;

-- Listage de la structure de la table cinema_v2. associer_genre
CREATE TABLE IF NOT EXISTS `associer_genre` (
  `id_genre` int(11) NOT NULL,
  `id_film` int(11) NOT NULL,
  KEY `FK_associer_genre_film` (`id_film`),
  KEY `FK_associer_genre_genre` (`id_genre`),
  CONSTRAINT `FK_associer_genre_film` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`),
  CONSTRAINT `FK_associer_genre_genre` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id_genre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema_v2.associer_genre : ~15 rows (environ)
/*!40000 ALTER TABLE `associer_genre` DISABLE KEYS */;
INSERT INTO `associer_genre` (`id_genre`, `id_film`) VALUES
	(1, 1),
	(1, 5),
	(2, 1),
	(2, 2),
	(3, 2),
	(4, 3),
	(4, 4),
	(5, 3),
	(5, 4),
	(5, 6),
	(5, 7),
	(6, 5),
	(7, 6),
	(7, 7),
	(8, 7);
/*!40000 ALTER TABLE `associer_genre` ENABLE KEYS */;

-- Listage de la structure de la table cinema_v2. film
CREATE TABLE IF NOT EXISTS `film` (
  `id_film` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) NOT NULL,
  `annee_sortie_france` smallint(6) NOT NULL,
  `duree_minutes` smallint(6) NOT NULL,
  `synopsis` longtext,
  `note` float DEFAULT NULL,
  `affiche` text,
  `id_realisateur` int(11) NOT NULL,
  PRIMARY KEY (`id_film`),
  KEY `FK_film_realisateur` (`id_realisateur`),
  CONSTRAINT `FK_film_realisateur` FOREIGN KEY (`id_realisateur`) REFERENCES `realisateur` (`id_realisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema_v2.film : ~7 rows (environ)
/*!40000 ALTER TABLE `film` DISABLE KEYS */;
INSERT INTO `film` (`id_film`, `titre`, `annee_sortie_france`, `duree_minutes`, `synopsis`, `note`, `affiche`, `id_realisateur`) VALUES
	(1, 'Once Upon a Time... in Hollywood', 2019, 201, 'Rick Dalton, un acteur de télévision qui a déjà vécu de meilleures années, et son cascadeur de longue date Cliff Booth s\'efforcent d\'atteindre la gloire et le succès dans l\'industrie cinématographique au cours de l\'âge d\'or d\'Hollywood en 1969. Ils viennent à la réalisation que l\'industrie du spectacle n\'est plus ce qu\'elle était.', 5, 'https://fr.web.img6.acsta.net/c_310_420/pictures/19/07/22/08/51/0719990.jpg', 2),
	(2, 'Pulp Fiction', 1994, 154, 'L\'odyssée sanglante et burlesque de petits malfrats dans la jungle de Hollywood à travers trois histoires qui s\'entremêlent. Dans un restaurant, un couple de jeunes braqueurs, Pumpkin et Yolanda, discutent des risques que comporte leur activité. Deux truands, Jules Winnfield et son ami Vincent Vega, qui revient d\'Amsterdam, ont pour mission de récupérer une mallette au contenu mystérieux et de la rapporter à Marsellus Wallace.', 4, 'https://fr.web.img2.acsta.net/c_310_420/medias/nmedia/18/36/02/52/18846059.jpg', 2),
	(3, 'Kill Bill - Volume 1', 2003, 111, 'u cours d\'une cérémonie de mariage en plein désert, un commando fait irruption dans la chapelle et tire sur les convives. Laissée pour morte, la mariée enceinte retrouve ses esprits après un coma de quatre ans. Celle qui a auparavant exercé les fonctions de tueuse à gages au sein du Détachement international des Vipères assassines n\'a alors plus qu\'une seule idée en tête: venger la mort de ses proches en éliminant tous les membres de cette organisation criminelle.', 3, 'https://fr.web.img6.acsta.net/c_310_420/medias/nmedia/18/35/13/44/18364816.jpg', 2),
	(4, 'Kill Bill - Volume 2', 2004, 137, 'Après sa sanglante escapade japonaise, La Mariée revient aux États-Unis afin de se venger une fois pour toutes de Bill. Pourtant, la quête est loin d\'être terminée et les deux derniers lieutenants de son ennemi, Budd et Elle Driver, se dressent sur son chemin. La route de la vengeance est longue pour La Mariée qui devra se souvenir des apprentissages de Paï-Meï, son maître de kung fu.', 3, 'https://fr.web.img6.acsta.net/c_310_420/medias/nmedia/18/35/13/45/18377926.jpg', 2),
	(5, 'Arrête-moi si tu peux', 2002, 141, 'En 1969, dans une prison de Marseille, l\'agent du FBI Carl Hanratty est chargé de l\'extradition de Frank Abagnale, Jr. Ce dernier, recherché par la justice américaine pour avoir escroqué plusieurs millions de dollars en usurpant plusieurs identités, est malade et tente de s\'évader de prison.', 3, 'https://fr.web.img6.acsta.net/c_310_420/medias/nmedia/00/02/54/32/aff2.jpg', 1),
	(6, 'Indiana Jones et la Dernière Croisade', 1989, 127, 'En 1912 dans l\'Utah, Indiana Jones, adolescent, surprend des pilleurs de trésors archéologiques avant d\'être poursuivi par les trafiquants. 26 ans plus tard, Jones apprend que son père, le professeur Henry Jones, parti à la recherche du Saint Graal, a disparu et il se rend alors à Venise où son père a été vu pour la dernière fois.', 3, 'https://fr.web.img5.acsta.net/c_310_420/medias/nmedia/18/65/88/40/18895516.jpg', 1),
	(7, 'La Guerre des étoiles', 1977, 121, 'La guerre civile fait rage entre l\'Empire galactique et l\'Alliance rebelle. Capturée par les troupes de choc de l\'Empereur menées par le sombre et impitoyable Dark Vador, la princesse Leia Organa dissimule les plans de l\'Etoile Noire.', 3, 'https://fr.web.img5.acsta.net/c_310_420/medias/nmedia/18/35/41/59/18422600.jpg', 3);
/*!40000 ALTER TABLE `film` ENABLE KEYS */;

-- Listage de la structure de la table cinema_v2. genre
CREATE TABLE IF NOT EXISTS `genre` (
  `id_genre` int(11) NOT NULL AUTO_INCREMENT,
  `nom_genre` varchar(50) NOT NULL,
  PRIMARY KEY (`id_genre`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema_v2.genre : ~8 rows (environ)
/*!40000 ALTER TABLE `genre` DISABLE KEYS */;
INSERT INTO `genre` (`id_genre`, `nom_genre`) VALUES
	(1, 'Drame'),
	(2, 'Comédie'),
	(3, 'Gangster'),
	(4, 'Arts martiaux'),
	(5, 'Action'),
	(6, 'Thriller'),
	(7, 'Aventure'),
	(8, 'Science-fiction');
/*!40000 ALTER TABLE `genre` ENABLE KEYS */;

-- Listage de la structure de la table cinema_v2. jouer
CREATE TABLE IF NOT EXISTS `jouer` (
  `id_film` int(11) NOT NULL,
  `id_acteur` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  KEY `FK_jouer_film` (`id_film`),
  KEY `FK_jouer_acteur` (`id_acteur`),
  KEY `FK_jouer_role` (`id_role`),
  CONSTRAINT `FK_jouer_acteur` FOREIGN KEY (`id_acteur`) REFERENCES `acteur` (`id_acteur`),
  CONSTRAINT `FK_jouer_film` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`),
  CONSTRAINT `FK_jouer_role` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema_v2.jouer : ~10 rows (environ)
/*!40000 ALTER TABLE `jouer` DISABLE KEYS */;
INSERT INTO `jouer` (`id_film`, `id_acteur`, `id_role`) VALUES
	(1, 4, 1),
	(1, 6, 2),
	(2, 2, 4),
	(2, 7, 3),
	(3, 2, 5),
	(4, 2, 5),
	(5, 4, 6),
	(5, 5, 7),
	(6, 3, 8),
	(7, 3, 9),
	(7, 1, 9);
/*!40000 ALTER TABLE `jouer` ENABLE KEYS */;

-- Listage de la structure de la table cinema_v2. personne
CREATE TABLE IF NOT EXISTS `personne` (
  `id_personne` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `sexe` varchar(10) NOT NULL,
  `date_naissance` date NOT NULL,
  PRIMARY KEY (`id_personne`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema_v2.personne : ~11 rows (environ)
/*!40000 ALTER TABLE `personne` DISABLE KEYS */;
INSERT INTO `personne` (`id_personne`, `nom`, `prenom`, `sexe`, `date_naissance`) VALUES
	(1, 'Spielberg', 'Steven', 'masculin', '1946-12-18'),
	(2, 'Tarantino', 'Quentin', 'masculin', '1963-03-27'),
	(3, 'Thurman', 'Uma', 'feminin', '1970-04-29'),
	(4, 'Ford', 'Harrison', 'masculin', '1942-07-13'),
	(5, 'Lucas', 'George', 'masculin', '1944-05-14'),
	(6, 'DiCaprio', 'Leonardo', 'masculin', '1974-11-11'),
	(7, 'Hanks', 'Tom', 'masculin', '1956-07-09'),
	(8, 'Pitt', 'Brad', 'masculin', '1963-12-18'),
	(9, 'Travolta', 'John', 'masculin', '1954-02-18'),
	(10, 'Willis', 'Bruce', 'masculin', '1955-03-19'),
	(11, 'CAMERON', 'James', 'Masculin', '1971-01-01');
/*!40000 ALTER TABLE `personne` ENABLE KEYS */;

-- Listage de la structure de la table cinema_v2. realisateur
CREATE TABLE IF NOT EXISTS `realisateur` (
  `id_realisateur` int(11) NOT NULL AUTO_INCREMENT,
  `id_personne` int(11) NOT NULL,
  PRIMARY KEY (`id_realisateur`),
  KEY `FK__personne` (`id_personne`),
  CONSTRAINT `FK__personne` FOREIGN KEY (`id_personne`) REFERENCES `personne` (`id_personne`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema_v2.realisateur : ~5 rows (environ)
/*!40000 ALTER TABLE `realisateur` DISABLE KEYS */;
INSERT INTO `realisateur` (`id_realisateur`, `id_personne`) VALUES
	(1, 1),
	(2, 2),
	(3, 5),
	(4, 7),
	(5, 11);
/*!40000 ALTER TABLE `realisateur` ENABLE KEYS */;

-- Listage de la structure de la table cinema_v2. role
CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int(11) NOT NULL AUTO_INCREMENT,
  `nom_role` varchar(50) NOT NULL,
  `descrip_role` text,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Listage des données de la table cinema_v2.role : ~10 rows (environ)
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` (`id_role`, `nom_role`, `descrip_role`) VALUES
	(1, 'Rick Dalton', 'Rick Dalton refuse, craignant d\'être humilié dans des séries B fauchées. Alcoolique, fumant cigarette sur cigarette, capricieux et narcissique, il trouve du réconfort auprès de son ami chauffeur et doublure Cliff Booth (Brad Pitt), un cascadeur suspecté d\'avoir tué sa femme Billie (Rebecca Gayheart).'),
	(2, 'Cliff Booth', 'Cliff Booth is one of the two main protagonists in Quentin Tarantino\'s ninth film, Once Upon a Time In Hollywood. He is a Hollywood stuntman whose career suffered because of rumors that he killed his wife. Cliff is also Rick Dalton\'s stunt double, personal assistant and best friend. His father is Aldo Raine, who served a role as one of the protagonists in Tarantino\'s previous film Inglourious Basterds.'),
	(3, 'Vincent Vega', 'Vincent Vega is one of the two main protagonists (alongside Butch Coolidge) of Pulp Fiction.\r\n\r\nHe is a hitman and associate of Marsellus Wallace. He had a brother named Vic Vega who was shot and killed by an undercover cop while doing a heist. He worked in Amsterdam for over three years and recently returned to Los Angeles, where he has been partnered with Jules Winnfield. In deleted scenes of Pulp Fiction Vincent claims he is the cousin of Suzanne Vega. This was later edited out as a conflict of interests for Suzanne Vega’s career.'),
	(4, 'Mia Wallace', 'Mia Wallace is a fictional character portrayed by Uma Thurman in the 1994 Quentin Tarantino film Pulp Fiction. It was Thurman\'s breakthrough role and earned her a nomination for the Academy Award for Best Supporting Actress. The character became a cultural icon.'),
	(5, 'Beatrix Kiddo', 'De son véritable nom Beatrix Kiddo, Black Mamba est tueuse à gages au sein de l\'organisation DIVA (Détachement International des Vipères Assassines) dirigée par Bill (David Carradine) avec lequel elle entretient une liaison.'),
	(6, 'Frank Abagnale Jr.', 'Dans les années soixante, le jeune Frank Abagnale Jr. est passé maître dans l\'art de l\'escroquerie, allant jusqu\'à détourner 2,5 millions de dollars et à figurer sur les listes du FBI comme l\'un des dix individus les plus recherchés des Etats-Unis.'),
	(7, 'Carl Hanratty', 'So, it’s Carl Hanratty (introduced in scene 2 and played by Tom Hanks) in the movie, and Sean O’Riley in the book. (The kid who gets paid to impersonate Abagnale as a diversion at the Miami Airport in scene 17 misunderstands his name to be Handratty — another humiliation for the F.B.I. agent!)'),
	(8, 'Indiana Jones', 'Lucasfilm Ltd. Henry Walton Jones Jr., alias Indiana Jones est un personnage de fiction, aventurier et professeur d\'archéologie, créé par George Lucas. Incarné par l\'acteur Harrison Ford, il apparaît pour la première fois dans le film Les Aventuriers de l\'arche perdue (1981) réalisé par Steven Spielberg.'),
	(9, 'Han Solo', 'Han Solo (Yan Solo dans la version française des épisodes IV, V et VI) est un personnage de Star Wars, interprété par Harrison Ford et Alden Ehrenreich. Originaire de la planète Corellia, Han Solo est un contrebandier, pilote et ancien élève officier impérial.'),
	(11, 'Batman', 'Bruce Wayne, alias Batman, est un super-héros de fiction appartenant à l\'univers de DC Comics. Créé par le dessinateur Bob Kane et le scénariste Bill Finger, il apparaît pour la première fois dans le comic book Detective Comics no 27 en 1939 - mai 1939 comme date sur la couverture mais la date réelle de parution est le 30 mars 1939 - sous le nom de The Bat-Man. Bien que ce soit le succès de Superman qui ait amené sa création, il se détache de ce modèle puisqu\'il n\'a aucun pouvoir surhumain.');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
