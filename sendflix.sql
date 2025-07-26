-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 01 août 2024 à 13:54
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sendflix`
--

-- --------------------------------------------------------

--
-- Structure de la table `brouillon`
--

CREATE TABLE `brouillon` (
  `id` int(11) NOT NULL,
  `type` enum('solo','saga') NOT NULL DEFAULT 'solo',
  `link` varchar(255) NOT NULL,
  `user` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `type` enum('film','anime') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `titre`, `type`) VALUES
(1, 'Action', 'film'),
(2, 'Adventure', 'film'),
(3, 'Comedy', 'film'),
(4, 'Drama', 'film'),
(5, 'Horror', 'film'),
(6, 'Fantasy', 'film'),
(7, 'Science Fiction', 'film'),
(8, 'Romance', 'film'),
(9, 'Thriller', 'film'),
(10, 'Animation', 'film'),
(11, 'Documentary', 'film'),
(12, 'Crime', 'film'),
(13, 'Historical', 'film'),
(14, 'Musical', 'film'),
(15, 'Mystery', 'film'),
(16, 'War', 'film'),
(17, 'Western', 'film'),
(18, 'Biography', 'film'),
(19, 'Sports', 'film'),
(20, 'Family', 'film'),
(21, 'Fantasy', 'film'),
(22, 'Film Noir', 'film'),
(23, 'Short Film', 'film'),
(24, 'Parody', 'film'),
(25, 'Superhero', 'film'),
(26, 'Fantasy Adventure', 'film'),
(27, 'Melodrama', 'film'),
(28, 'Erotic', 'film'),
(29, 'Shonen (for young boys)', 'anime'),
(30, 'Shojo (for young girls)', 'anime'),
(31, 'Seinen (for adult men)', 'anime'),
(32, 'Josei (for adult women)', 'anime'),
(33, 'Kodomo (for children)', 'anime'),
(34, 'Mecha (giant robots)', 'anime'),
(35, 'Isekai (parallel world)', 'anime'),
(36, 'Fantasy', 'anime'),
(37, 'Science Fiction', 'anime'),
(38, 'Romance', 'anime'),
(39, 'Comedy', 'anime'),
(40, 'Drama', 'anime'),
(41, 'Horror', 'anime'),
(42, 'Mystery', 'anime'),
(43, 'Action', 'anime'),
(44, 'Adventure', 'anime'),
(45, 'Supernatural', 'anime'),
(46, 'Sports', 'anime'),
(47, 'Slice of Life (tranche de vie)', 'anime'),
(48, 'Historical', 'anime'),
(49, 'Psychological', 'anime'),
(50, 'Martial Arts', 'anime'),
(51, 'Yaoi (male-male relationships)', 'anime'),
(52, 'Yuri (female-female relationships)', 'anime'),
(53, 'Ecchi (suggestive content)', 'anime'),
(54, 'Harem (one male surrounded by multiple females)', 'anime'),
(55, 'Reverse Harem (one female surrounded by multiple males)', 'anime'),
(56, 'Magical Girl (filles avec des pouvoirs magiques)', 'anime'),
(57, 'Post-apocalyptic', 'anime'),
(58, 'Cyberpunk', 'anime'),
(59, 'Steampunk', 'anime');

-- --------------------------------------------------------

--
-- Structure de la table `episodes`
--

CREATE TABLE `episodes` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `saga_id` int(11) NOT NULL,
  `lien` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `saga`
--

CREATE TABLE `saga` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `solo`
--

CREATE TABLE `solo` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `categories` varchar(255) NOT NULL,
  `full` varchar(255) NOT NULL,
  `short` varchar(255) NOT NULL,
  `couv` varchar(255) NOT NULL,
  `type` enum('film','anime') NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `solo`
--

INSERT INTO `solo` (`id`, `titre`, `description`, `user_id`, `categories`, `full`, `short`, `couv`, `type`, `date`) VALUES
(1, 'Naruto shippuden 453.mp4', '', 2, 'Action,Adventure,Historical', 'brouillon/Naruto shippuden 453.mp4', 'shorts/output_66a7c99519df7.mp4', 'couvertures/66a7c9974486d.jpg', 'anime', '2024-07-29 17:55:51'),
(2, 'Alchemy of Souls saison 2 épisode 8 VF et VOSTFR Zone-Streaming.mp4', '', 2, 'Drama', 'brouillon/Alchemy of Souls saison 2 épisode 8 VF et VOSTFR Zone-Streaming.mp4', 'shorts/output_66a8cc10c8af4.mp4', 'couvertures/66a8cc1a228aa.jpg', 'film', '2024-07-30 12:18:51'),
(3, '@Watch_AnimesUndeadUnluck-05VOSTFR (1).mp4', 'essai gfdhgdggdgdg', 2, 'Fantasy', 'brouillon/@Watch_AnimesUndeadUnluck-05VOSTFR (1).mp4', 'shorts/output_66a94087c21fc.mp4', 'couvertures/66a94092ef82f.jpg', 'anime', '2024-07-30 20:35:47'),
(4, 'Blue_Beetle_»_French_Stream_Films_et_Séries_en_Streaming_Complet.mp4', '', 2, 'Action,Adventure,Comedy', 'brouillon/Blue_Beetle_»_French_Stream_Films_et_Séries_en_Streaming_Complet.mp4', 'shorts/output_66aa7a6cd5a4c.mp4', 'couvertures/66aa7a7628dbf.jpg', 'film', '2024-07-31 18:55:03'),
(5, 'World War Z.mp4', 'b b', 2, 'Sports', 'brouillon/World War Z.mp4', 'shorts/output_66aa7bd6e8924.mp4', 'couvertures/66aa7be28fb56.jpg', 'film', '2024-07-31 19:01:07'),
(6, 'Slam dunk film.mp4', '', 2, 'Fantasy,Action', 'brouillon/Slam dunk film.mp4', 'shorts/output_66aa7cb9013fb.mp4', 'couvertures/66aa7cbf92571.jpg', 'anime', '2024-07-31 19:04:48'),
(7, '[ @UK_SERIE_FR ] FALLOUT S01 EP07 VF.MP4', '', 2, 'Comedy,Animation', 'brouillon/[ @UK_SERIE_FR ] FALLOUT S01 EP07 VF.MP4', 'shorts/output_66aa7d4acbfef.MP4', 'couvertures/66aa7d4d62563.jpg', 'film', '2024-07-31 19:07:10');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `nom_complet` varchar(255) NOT NULL DEFAULT 'John Doe',
  `interets` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `adresse` varchar(225) NOT NULL,
  `birth` date DEFAULT NULL,
  `pin` int(4) NOT NULL,
  `age` int(11) NOT NULL,
  `genre` enum('M','F') NOT NULL,
  `cover` varchar(255) NOT NULL DEFAULT 'moon.jpg',
  `profil` varchar(255) NOT NULL DEFAULT 'profil.png',
  `confirm_email` enum('no','yes') NOT NULL DEFAULT 'no',
  `statut` varchar(255) NOT NULL DEFAULT 'inactif',
  `follower` int(11) NOT NULL,
  `following` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `pass`, `nom_complet`, `interets`, `phone`, `adresse`, `birth`, `pin`, `age`, `genre`, `cover`, `profil`, `confirm_email`, `statut`, `follower`, `following`, `date`) VALUES
(1, 'Hermes6', 'agapethounk1@gmail.com', '$2y$10$sg36cHRL2VmPQWe6/yzUmOyj0luDxkqT0gMmIRkDKbD3pvQ7dxt9S', 'Hermès Hounkonnou', '[\"Entertainment\",\"Gaming\",\"Music\",\"Food & Drink\",\"Sports\",\"Science & Education\",\"Anime & Movie\",\"Technology\"]', '51 86 29 17', '', '2003-10-29', 2003, 0, 'M', 'moon.jpg', 'profil.png', 'no', 'actif', 0, 0, '2024-07-14 01:49:03'),
(2, 'Hermes', 'agapethounk@gmail.com', '$2y$10$l4Y8Ewxz9wn1928tlFs10Oasv4pJofJu9gxokyyqUTHQbBVkHtcYy', 'Hermès Hounkonnou', '[\"Entertainment\",\"Gaming\",\"Music\",\"Food & Drink\",\"DIY\",\"Family\",\"Anime & Movie\",\"Technology\"]', '51862917', '', '2003-10-29', 2003, 0, 'M', 'moon.jpg', 'profils/(10).jpg', 'no', 'actif', 0, 0, '2024-07-26 10:35:33');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `brouillon`
--
ALTER TABLE `brouillon`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ggb` (`user`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `episodes`
--
ALTER TABLE `episodes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `saga_id` (`saga_id`);

--
-- Index pour la table `saga`
--
ALTER TABLE `saga`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `solo`
--
ALTER TABLE `solo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ijhb` (`user_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `brouillon`
--
ALTER TABLE `brouillon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT pour la table `episodes`
--
ALTER TABLE `episodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `saga`
--
ALTER TABLE `saga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `solo`
--
ALTER TABLE `solo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `brouillon`
--
ALTER TABLE `brouillon`
  ADD CONSTRAINT `ggb` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `episodes`
--
ALTER TABLE `episodes`
  ADD CONSTRAINT `episodes_ibfk_1` FOREIGN KEY (`saga_id`) REFERENCES `saga` (`id`);

--
-- Contraintes pour la table `saga`
--
ALTER TABLE `saga`
  ADD CONSTRAINT `saga_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `solo`
--
ALTER TABLE `solo`
  ADD CONSTRAINT `ijhb` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
