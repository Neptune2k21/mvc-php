-- Ce fichier sert à initialiser la base de données
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
--Creation de la base de données blog
CREATE DATABASE IF NOT EXISTS `blog` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `blog`;
-- Création de la table billets
CREATE TABLE IF NOT EXISTS `billets` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `contenu` text NOT NULL,
  `date_creation` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Insertion de données initiales dans la table billets
INSERT INTO `billets` (`id`, `titre`, `contenu`, `date_creation`) VALUES
(1, 'Bienvenue sur le blog de l\'AVBN !', 'Je vous souhaite à toutes et à tous la bienvenue sur le blog qui parlera de... l\'Association de VolleyBall de Nuelly !', '2022-02-17 16:28:41'),
(2, 'L\'AVBN à la conquête du monde !', 'C\'est officiel, le club a annoncé à la radio hier soir \"J\'ai l\'intention de conquérir le monde !\".\r\nIl a en outre précisé que le monde serait à sa botte en moins de temps qu\'il n\'en fallait pour dire \"Association de VolleyBall de Nuelly\". Pas dur, ceci dit entre nous...', '2022-02-17 16:28:42');

-- Ajout de la clé primaire sur la colonne id
ALTER TABLE `billets`
  ADD PRIMARY KEY (`id`);

-- Modification de la colonne id pour qu'elle soit auto-incrémentée
ALTER TABLE `billets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

-- Fin du script
