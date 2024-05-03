-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 03 mai 2024 à 23:53
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet_rattr`
--

-- --------------------------------------------------------

--
-- Structure de la table `critique`
--

CREATE TABLE `critique` (
  `ID_CRITIQUE` int(11) NOT NULL,
  `NOTE` smallint(6) DEFAULT NULL,
  `COMMENTAIRE` text DEFAULT NULL,
  `ID_USER` int(11) DEFAULT NULL,
  `ID_FILM` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `critique`
--

INSERT INTO `critique` (`ID_CRITIQUE`, `NOTE`, `COMMENTAIRE`, `ID_USER`, `ID_FILM`) VALUES
(3, 3, 'NUL', 1, 4),
(4, 2, 'J\'aime pas', 2, 4),
(6, 5, 'Incroyable film !', 1, 3),
(7, 3, 'Trop peur', 1, 10),
(8, 4, 'J\'ai vraiment eu peur mais bon film !', 1, 11),
(9, 4, 'Trop drôle', 1, 12),
(12, 5, 'J\'ai adoré !', 2, 7),
(13, 5, 'Super film !', 2, 15),
(17, 5, 'Super film d\'action !', 3, 5),
(18, 5, 'Incroyable', 2, 16),
(19, 4, 'Super', 3, 2),
(20, 2, 'Pas aimé', 1, 4),
(21, 4, 'Incroyable ce film', 1, 4),
(22, 2, 'Un peu classique', 1, 4),
(23, 5, 'J\'ai adoré', 1, 4),
(24, 5, 'OUF !', 2, 5),
(25, 3, 'Super', 1, 13),
(26, 3, 'Bof', 1, 3),
(27, 4, 'Yes', 1, 5),
(28, 2, 'Moyen', 1, 5);

-- --------------------------------------------------------

--
-- Structure de la table `favori_list`
--

CREATE TABLE `favori_list` (
  `ID_FAV` int(11) NOT NULL,
  `ID_USER` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `favori_list`
--

INSERT INTO `favori_list` (`ID_FAV`, `ID_USER`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4);

-- --------------------------------------------------------

--
-- Structure de la table `film`
--

CREATE TABLE `film` (
  `ID_FILM` int(11) NOT NULL,
  `NOM` text DEFAULT NULL,
  `GENRE` varchar(50) DEFAULT NULL,
  `AFFICHE` text DEFAULT NULL,
  `DATE_SORTIE` date DEFAULT NULL,
  `CREATEUR` varchar(50) DEFAULT NULL,
  `RESUME` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `film`
--

INSERT INTO `film` (`ID_FILM`, `NOM`, `GENRE`, `AFFICHE`, `DATE_SORTIE`, `CREATEUR`, `RESUME`) VALUES
(1, 'Dune, Première Partie', 'Action', 'https://fr.web.img6.acsta.net/pictures/21/08/10/12/20/4633954.jpg', '2021-09-15', 'Denis Villeneuve', 'Un jeune noble, Paul Atreides, se retrouve en conflit sur la planète désertique d\'Arrakis, le seul endroit où se trouve la ressource la plus précieuse de l\'univers, l\'épice.'),
(2, 'Dune, Deuxième Partie', 'Action', 'https://fr.web.img4.acsta.net/pictures/24/01/26/10/18/5392835.jpg', '2024-02-28', 'Denis Villeneuve', 'La suite des aventures de Paul Atreides alors qu\'il lutte pour protéger son peuple et ses intérêts sur la planète Arrakis, tout en confrontant des forces politiques et mystiques plus grandes.'),
(3, 'Spider-Man : No Way Home', 'Action', 'https://fr.web.img4.acsta.net/pictures/21/11/16/10/01/4860598.jpg', '2021-12-15', 'Jon Watts', 'Spider-Man fait face à des défis sans précédent alors qu\'il lutte pour maintenir son identité secrète tout en jonglant avec les conséquences de l\'utilisation de la magie pour altérer la réalité.'),
(4, 'Avengers : Endgame', 'Action', 'https://fr.web.img2.acsta.net/pictures/19/04/04/09/04/0472053.jpg', '2019-04-24', 'Anthony Russo', 'Les Avengers se réunissent pour un dernier affrontement contre Thanos dans une tentative désespérée de ramener à la vie la moitié de l\'univers qui a été anéantie par le claquement de doigts de ce dernier.'),
(5, 'Fast & Furious 9', 'Action', 'https://fr.web.img5.acsta.net/pictures/21/05/18/10/40/2487837.jpg', '2021-06-03', 'Justin Lin', 'Dominic Toretto et son équipe affrontent leur plus grand adversaire à ce jour, tandis que des secrets du passé de Dom menacent de détruire tout ce qu\'ils ont construit.'),
(6, 'Le Règne animal', 'Aventure', 'https://fr.web.img6.acsta.net/pictures/23/08/28/10/29/4138047.jpg', '2023-10-04', 'Thomas Cailley', 'Un jeune homme se trouve pris dans les affaires criminelles de sa famille en Australie, où il doit naviguer dans un monde de violence et de loyauté pour protéger ceux qu\'il aime.'),
(7, 'Jurassic World : Le Monde d\'après', 'Aventure', 'https://fr.web.img2.acsta.net/pictures/22/04/14/18/30/0040092.jpg', '2022-06-10', 'Colin Trevorrow', 'L\'île des dinosaures est menacée par une éruption volcanique, obligeant les protagonistes à retourner sur place pour sauver les créatures préhistoriques.'),
(8, 'Pirates des Caraïbes : La Vengeance de Salazar', 'Aventure', 'https://fr.web.img2.acsta.net/pictures/17/03/02/10/13/106609.jpg', '2017-05-26', 'Joachim Rønning', 'Le capitaine Jack Sparrow doit faire face à un nouvel ennemi redoutable, le capitaine Salazar, tandis qu\'il cherche le trident de Poséidon pour contrôler les mers.'),
(9, 'Ça', 'Horreur', 'https://fr.web.img6.acsta.net/pictures/17/03/29/14/40/513263.jpg', '2017-09-08', 'Andrés Muschietti', 'Un groupe d\'enfants se bat contre un être maléfique qui prend la forme de leurs pires peurs, dans la petite ville de Derry, Maine.'),
(10, 'Saw X', 'Horreur', 'https://fr.web.img6.acsta.net/c_310_420/pictures/23/07/27/18/03/4072864.jpg', '2023-09-29', 'Kevin Greutert', 'Une nouvelle série de meurtres macabres commence, mettant en lumière un nouveau chapitre dans le jeu sadique orchestré par Jigsaw.'),
(11, 'La Nonne : La Malédiction de Sainte-Lucie', 'Horreur', 'https://fr.web.img3.acsta.net/pictures/23/07/12/15/32/1131759.jpg', '2023-09-08', 'Michael Chaves', 'Une jeune nonne enquête sur le suicide mystérieux d\'une religieuse dans un couvent en Roumanie et découvre un secret terrifiant.'),
(12, 'Bienvenue chez les Ch\'tis', 'Comédie', 'https://fr.web.img5.acsta.net/medias/nmedia/18/64/74/53/18889951.jpg', '2008-02-20', 'Dany Boon', 'Un directeur de bureau du Sud de la France est muté dans le nord, où il doit faire face à la culture et au dialecte des habitants.'),
(13, 'Les Visiteurs', 'Comédie', 'https://fr.web.img6.acsta.net/medias/nmedia/18/36/07/69/18659413.jpg', '1993-02-27', 'Jean-Marie Poiré', 'Un magicien médiéval et son écuyer sont transportés dans le futur, où ils doivent s\'adapter à la vie moderne pour trouver un moyen de rentrer chez eux.'),
(14, 'Le Dîner de cons', 'Comédie', 'https://fr.web.img5.acsta.net/c_310_420/medias/nmedia/18/36/10/96/19649758.jpg', '1998-04-15', 'Francis Veber', 'Un groupe d\'hommes d\'affaires organise un dîner auquel chaque participant doit inviter un \"con\" qu\'ils peuvent ridiculiser.'),
(15, 'Avatar 2 : La voie de l\'eau', 'Fantastique', 'https://fr.web.img4.acsta.net/pictures/22/11/02/14/49/4565071.jpg', '2022-12-16', 'James Cameron', 'La suite des aventures sur la planète Pandora, où les Na\'vi luttent contre les humains pour préserver leur mode de vie et leur environnement.'),
(16, 'Le Monde de Narnia : Chapitre 1 - Le lion, la sorcière blanche et l\'armoire magique', 'Fantastique', 'https://fr.web.img2.acsta.net/medias/nmedia/18/35/53/32/18463695.jpg', '2005-12-21', 'Andrew Adamson', 'Quatre enfants découvrent un monde fantastique de magie et de créatures mythiques en passant à travers une armoire magique.'),
(17, 'Les Gardiens de la Galaxie Vol. 3', 'Fantastique', 'https://fr.web.img5.acsta.net/pictures/23/02/13/11/43/2783447.jpg', '2023-05-03', 'James Gunn', 'La suite des aventures de l\'équipe de super-héros intergalactique alors qu\'ils tentent de sauver la galaxie une fois de plus.'),
(18, 'Dragons 1', 'Enfant', 'https://fr.web.img4.acsta.net/medias/nmedia/18/73/01/74/19343191.jpg', '2010-03-31', 'Dean DeBlois', 'Un jeune Viking tente de prouver sa valeur en apprivoisant un dragon et en l\'utilisant pour sauver son village des attaques des autres dragons.'),
(19, 'La Reine des neiges 2', 'Enfant', 'https://fr.web.img6.acsta.net/pictures/19/10/25/15/08/5952325.jpg', '2019-11-20', 'Jennifer Lee', 'La princesse Elsa découvre les origines de ses pouvoirs magiques alors qu\'elle se lance dans un voyage pour sauver son royaume.'),
(20, 'La Planète au trésor : Un nouvel univers', 'Enfant', 'https://fr.web.img6.acsta.net/medias/nmedia/00/02/53/09/affiche2.jpg', '2002-11-05', 'John Musker', 'Un jeune garçon découvre une carte au trésor menant à une planète lointaine où il espère trouver des richesses inimaginables.');

-- --------------------------------------------------------

--
-- Structure de la table `film_fav`
--

CREATE TABLE `film_fav` (
  `ID_FILM` int(11) NOT NULL,
  `ID_FAV` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `film_fav`
--

INSERT INTO `film_fav` (`ID_FILM`, `ID_FAV`) VALUES
(1, 1),
(1, 2),
(2, 2),
(2, 3),
(3, 1),
(4, 1),
(5, 2),
(6, 1),
(6, 3),
(10, 3),
(12, 1),
(13, 3),
(14, 3),
(15, 1),
(15, 2),
(19, 1),
(19, 3);

-- --------------------------------------------------------

--
-- Structure de la table `_user`
--

CREATE TABLE `_user` (
  `ID_USER` int(11) NOT NULL,
  `NOM` varchar(50) DEFAULT NULL,
  `PRENOM` varchar(50) DEFAULT NULL,
  `USERNAME` varchar(50) DEFAULT NULL,
  `MDP` text DEFAULT NULL,
  `ID_FAV` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `_user`
--

INSERT INTO `_user` (`ID_USER`, `NOM`, `PRENOM`, `USERNAME`, `MDP`, `ID_FAV`) VALUES
(1, 'Wyart', 'Nathan', 'nathan.wyart@gmail.com', '$2y$10$ezyiOAzkzDi2Xd1DaVRNju6r25fI05jzd5k9iMIg2e1Hcy7NdRN22', 1),
(2, 'Olivin', 'Benoit', 'benoit.olivin@gmail.com', '$2y$10$POt5ng.OzVfUo3R6Rb7jW.nqq.w8fhT/5de93KKN/O2.nmngL6CU.', 2),
(3, 'Decool', 'Louis', 'louis.decool@gmail.com', '$2y$10$JUoQYu7mB22uRK1zIMpIzOeYVZs6iV7v8RSYYXt6CaAo1rSGx4TqS', 3),
(4, 'TestNom', 'TestPrenom', 'test.test@gmail.com', '$2y$10$si.tadus7.ybMiaLSgeXmusTZ3jvCkLwfI.QPPMN8w6HvCjavQG0O', 4);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `critique`
--
ALTER TABLE `critique`
  ADD PRIMARY KEY (`ID_CRITIQUE`),
  ADD KEY `ID_USER` (`ID_USER`),
  ADD KEY `ID_FILM` (`ID_FILM`);

--
-- Index pour la table `favori_list`
--
ALTER TABLE `favori_list`
  ADD PRIMARY KEY (`ID_FAV`),
  ADD KEY `fk_user_favori` (`ID_USER`);

--
-- Index pour la table `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`ID_FILM`);

--
-- Index pour la table `film_fav`
--
ALTER TABLE `film_fav`
  ADD PRIMARY KEY (`ID_FILM`,`ID_FAV`),
  ADD KEY `ID_FAV` (`ID_FAV`);

--
-- Index pour la table `_user`
--
ALTER TABLE `_user`
  ADD PRIMARY KEY (`ID_USER`),
  ADD KEY `ID_FAV` (`ID_FAV`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `critique`
--
ALTER TABLE `critique`
  MODIFY `ID_CRITIQUE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `favori_list`
--
ALTER TABLE `favori_list`
  MODIFY `ID_FAV` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `film`
--
ALTER TABLE `film`
  MODIFY `ID_FILM` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `_user`
--
ALTER TABLE `_user`
  MODIFY `ID_USER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `critique`
--
ALTER TABLE `critique`
  ADD CONSTRAINT `critique_ibfk_1` FOREIGN KEY (`ID_USER`) REFERENCES `_user` (`ID_USER`),
  ADD CONSTRAINT `critique_ibfk_2` FOREIGN KEY (`ID_FILM`) REFERENCES `film` (`ID_FILM`);

--
-- Contraintes pour la table `favori_list`
--
ALTER TABLE `favori_list`
  ADD CONSTRAINT `fk_user_favori` FOREIGN KEY (`ID_USER`) REFERENCES `_user` (`ID_USER`);

--
-- Contraintes pour la table `film_fav`
--
ALTER TABLE `film_fav`
  ADD CONSTRAINT `film_fav_ibfk_1` FOREIGN KEY (`ID_FILM`) REFERENCES `film` (`ID_FILM`),
  ADD CONSTRAINT `film_fav_ibfk_2` FOREIGN KEY (`ID_FAV`) REFERENCES `favori_list` (`ID_FAV`);

--
-- Contraintes pour la table `_user`
--
ALTER TABLE `_user`
  ADD CONSTRAINT `_user_ibfk_1` FOREIGN KEY (`ID_FAV`) REFERENCES `favori_list` (`ID_FAV`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
