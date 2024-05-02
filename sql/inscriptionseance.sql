-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  jeu. 02 mai 2024 à 09:51
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
  `id` int(3) NOT NULL,
  `id_seance` int(3) NOT NULL,
  `id_utilisateur` int(3) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Prenom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `inscriptionseance`
--
ALTER TABLE `inscriptionseance`
  ADD CONSTRAINT `inscriptionseance_ibfk_1` FOREIGN KEY (`id_seance`) REFERENCES `seance` (`id`),
  ADD CONSTRAINT `inscriptionseance_ibfk_2` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
