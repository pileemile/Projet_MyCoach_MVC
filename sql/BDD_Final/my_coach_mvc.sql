-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  sam. 04 mai 2024 à 16:15
-- Version du serveur :  5.7.17
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `my_coach_mvc`
--

-- --------------------------------------------------------

--
-- Structure de la table `inscriptionseance`
--

CREATE TABLE `inscriptionseance` (
  `id` int(11) NOT NULL,
  `id_seance` int(3) NOT NULL,
  `id_utilisateur` int(3) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Prenom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `inscriptionseance`
--

INSERT INTO `inscriptionseance` (`id`, `id_seance`, `id_utilisateur`, `Nom`, `Prenom`) VALUES
(5, 1, 15, 'PICARD', 'Emile'),
(6, 7, 15, 'PICARD', 'Emile'),
(7, 3, 16, 'Dupont', 'Antoine'),
(8, 7, 16, 'Dupont', 'Antoine'),
(9, 1, 16, 'Dupont', 'Antoine'),
(10, 15, 16, 'Dupont', 'Antoine'),
(11, 8, 16, 'Dupont', 'Antoine'),
(12, 11, 16, 'Dupont', 'Antoine'),
(13, 2, 15, 'PICARD', 'Emile');

-- --------------------------------------------------------

--
-- Structure de la table `niveau`
--

CREATE TABLE `niveau` (
  `id` int(3) NOT NULL,
  `niveau` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `niveau`
--

INSERT INTO `niveau` (`id`, `niveau`) VALUES
(1, 'Debutant'),
(2, 'Moyen '),
(3, 'Expert');

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE `salle` (
  `ID` int(3) NOT NULL,
  `nom` varchar(50) CHARACTER SET latin1 NOT NULL,
  `Adresse` varchar(50) CHARACTER SET latin1 NOT NULL,
  `CP` int(5) NOT NULL,
  `Ville` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=COMPACT;

--
-- Déchargement des données de la table `salle`
--

INSERT INTO `salle` (`ID`, `nom`, `Adresse`, `CP`, `Ville`) VALUES
(1, 'salle mermoz ', '5 avenue des cretes', 31000, 'Toulouse'),
(2, 'salle jean moulin ', '2 boulevard saint-martin ', 31400, 'Toulouse'),
(3, 'salle francois verdier ', '3 rue de metz ', 31000, 'Toulouse'),
(4, 'Basic-fit Jean-Jaures', '58 aller jean-jaures', 31000, 'Toulouse');

-- --------------------------------------------------------

--
-- Structure de la table `seance`
--

CREATE TABLE `seance` (
  `id` int(3) NOT NULL,
  `id_sport` int(3) NOT NULL,
  `id_niveau` int(3) NOT NULL,
  `horraire` varchar(50) NOT NULL,
  `jour` varchar(50) NOT NULL,
  `id_salle` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `seance`
--

INSERT INTO `seance` (`id`, `id_sport`, `id_niveau`, `horraire`, `jour`, `id_salle`) VALUES
(1, 1, 1, '12h-14h', 'Lundi', 1),
(2, 1, 2, '12h-14h', 'Mercredi', 1),
(3, 2, 1, '18H-19H30', 'Mardi', 2),
(4, 3, 3, '20H-22H', 'Vendredi', 3),
(5, 4, 2, '15H-16h30', 'Samedi', 4),
(6, 1, 3, '9h-10h', 'Dimanche', 4),
(7, 2, 1, '8h-10h', 'Vendredi', 2),
(8, 3, 1, '14h-15h', 'Vendredi', 2),
(9, 2, 2, '11h-12h', 'Lundi', 2),
(10, 3, 3, '7h-10h', 'Lundi', 3),
(11, 4, 3, '12h-13h', 'Mardi', 3),
(12, 4, 2, '16h-17h', 'Mardi', 3),
(13, 1, 2, '10h-11h', 'Lundi', 1),
(14, 1, 2, '10h-11h', 'Jeudi', 1),
(15, 3, 1, '14h-15h', 'Jeudi', 3),
(16, 2, 3, '16h-17h', 'Jeudi', 2);

-- --------------------------------------------------------

--
-- Structure de la table `sport`
--

CREATE TABLE `sport` (
  `ID` int(3) NOT NULL,
  `Nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `sport`
--

INSERT INTO `sport` (`ID`, `Nom`) VALUES
(1, 'Boxe'),
(2, 'Renforcement musculaire '),
(3, 'Zumba '),
(4, 'Musculation ');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(3) NOT NULL,
  `nom` varchar(50) COLLATE utf8_bin NOT NULL,
  `prenom` varchar(50) COLLATE utf8_bin NOT NULL,
  `mail` varchar(50) COLLATE utf8_bin NOT NULL,
  `mdp` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `mail`, `mdp`) VALUES
(15, 'PICARD', 'Emile', 'emilepicard323@gmail.com', '$2y$10$YngXadNmF6/dg7Egr5WijedEE8uZbM/hX.Rwmg/RBZxjJk7eF5AQC'),
(16, 'Dupont', 'Antoine', 'dupont.antoine@gmail.com', '$2y$10$X3TnssqzgxK3EBf4HDJVFOfaz4ZeEOfNitAIcboDDoPduiVx1gDOi');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `inscriptionseance`
--
ALTER TABLE `inscriptionseance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_seance` (`id_seance`),
  ADD KEY `inscriptionseance_ibfk_2` (`id_utilisateur`);

--
-- Index pour la table `niveau`
--
ALTER TABLE `niveau`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `salle`
--
ALTER TABLE `salle`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Nom` (`nom`),
  ADD KEY `Nom_2` (`nom`);

--
-- Index pour la table `seance`
--
ALTER TABLE `seance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_sport` (`id_sport`),
  ADD KEY `id_niveau` (`id_niveau`),
  ADD KEY `id_salle` (`id_salle`);

--
-- Index pour la table `sport`
--
ALTER TABLE `sport`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `inscriptionseance`
--
ALTER TABLE `inscriptionseance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `inscriptionseance`
--
ALTER TABLE `inscriptionseance`
  ADD CONSTRAINT `inscriptionseance_ibfk_1` FOREIGN KEY (`id_seance`) REFERENCES `seance` (`id`),
  ADD CONSTRAINT `inscriptionseance_ibfk_2` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `niveau`
--
ALTER TABLE `niveau`
  ADD CONSTRAINT `niveau_seance` FOREIGN KEY (`id`) REFERENCES `seance` (`id_niveau`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `salle`
--
ALTER TABLE `salle`
  ADD CONSTRAINT `salle_seance` FOREIGN KEY (`ID`) REFERENCES `seance` (`id_salle`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `sport`
--
ALTER TABLE `sport`
  ADD CONSTRAINT `sport_seance` FOREIGN KEY (`ID`) REFERENCES `seance` (`id_sport`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
