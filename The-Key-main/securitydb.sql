-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 24, 2024 at 02:39 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `securitydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `adresse`
--

CREATE TABLE `adresse` (
  `id_adresse` int(11) NOT NULL,
  `province` varchar(100) NOT NULL,
  `commune` varchar(100) NOT NULL,
  `id_client` int(11) DEFAULT NULL,
  `id_agent` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `agent`
--

CREATE TABLE `agent` (
  `id_agent` int(11) NOT NULL,
  `nom_agent` varchar(10) NOT NULL,
  `prenom_agent` varchar(100) NOT NULL,
  `tel` varchar(10) NOT NULL,
  `adr` varchar(100) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `fonction_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `agent`
--

INSERT INTO `agent` (`id_agent`, `nom_agent`, `prenom_agent`, `tel`, `adr`, `image`, `fonction_id`) VALUES
(2, 'irumva', '', '123456', 'bwiza', NULL, NULL),
(3, 'irumva', '', '1234', 'bwiza', NULL, NULL),
(11, 'Irumva', '', '777', 'bwiza', NULL, NULL),
(12, 'Audi', 'Ishimwe', '72334455', 'Gihosha', 'wallpaper.jpg', 2),
(13, 'K', 'Ishimwe', '55555', 'jjjjjjjjjjjuguguug', 'bg.jpg', 4),
(14, 'Audidi', 'Ishimwe', '72334455', 'Gihosha', 'Milo.png', 2),
(15, 'Ggggg', 'Ishimwe', '55555', 'K', 'Les membres du groupe -1-1-1_1.jpg', 3);

-- --------------------------------------------------------

--
-- Table structure for table `authentification`
--

CREATE TABLE `authentification` (
  `id_auth` int(11) NOT NULL,
  `nom` varchar(10) NOT NULL,
  `password` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL,
  `nom_client` varchar(100) NOT NULL,
  `nombre_agent` int(8) NOT NULL,
  `adresse` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id_client`, `nom_client`, `nombre_agent`, `adresse`) VALUES
(6, 'ornella', 5, 'rohero'),
(7, 'Irumva Arsen', 2, 'bwiza'),
(8, 'isabwe beni ', 24, 'ruguru'),
(10, 'ishimwe', 5, 'gasnyi'),
(11, 'Ggggg', 2, 'gggggg'),
(12, 'moi', 3, 'Gihosha'),
(16, 'Irumva', 1, 'Gihosha'),
(17, 'Audi ishimwe', 2, 'Gihosha'),
(18, 'Test', 3, 'Gihosha'),
(19, 'Test User THis', 3, 'Kanyoni 1ere Avenue');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id_contact` int(11) NOT NULL,
  `nom` varchar(12) NOT NULL,
  `email` varchar(15) NOT NULL,
  `telephone` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id_contact`, `nom`, `email`, `telephone`) VALUES
(1, '67833026', 'arsene@gmail.co', '67833026');

-- --------------------------------------------------------

--
-- Table structure for table `contrat`
--

CREATE TABLE `contrat` (
  `id_contrat` int(11) NOT NULL,
  `date_signature` date NOT NULL,
  `date_expiration` date NOT NULL,
  `client_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `contrat`
--

INSERT INTO `contrat` (`id_contrat`, `date_signature`, `date_expiration`, `client_id`) VALUES
(2, '2024-10-16', '2027-11-25', NULL),
(3, '2028-09-18', '2028-09-20', NULL),
(4, '2024-10-16', '2028-09-18', NULL),
(5, '2024-10-24', '2028-10-24', NULL),
(6, '2024-10-24', '2028-10-24', 8),
(7, '2024-10-24', '2024-10-08', 6);

-- --------------------------------------------------------

--
-- Table structure for table `fonction`
--

CREATE TABLE `fonction` (
  `id_fonction` int(11) NOT NULL,
  `fonction` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `fonction`
--

INSERT INTO `fonction` (`id_fonction`, `fonction`) VALUES
(1, 'f'),
(2, 'Agent'),
(3, 'DG'),
(4, 'Comptable'),
(5, 'Agent simple'),
(6, 'Concierge');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id_post` int(11) NOT NULL,
  `nom_agent` varchar(10) NOT NULL,
  `numero_matricule` varchar(10) NOT NULL,
  `adresse_mission` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id_post`, `nom_agent`, `numero_matricule`, `adresse_mission`) VALUES
(1, 'ikirura', '123', 'rohero');

-- --------------------------------------------------------

--
-- Table structure for table `publication`
--

CREATE TABLE `publication` (
  `id_pub` int(11) NOT NULL,
  `date_pub` date NOT NULL,
  `titre` varchar(100) NOT NULL,
  `article` text NOT NULL,
  `auteur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `publication`
--

INSERT INTO `publication` (`id_pub`, `date_pub`, `titre`, `article`, `auteur`) VALUES
(1, '2024-10-23', 'Nouveaux Agents', 'De nouvelles agents ont été acceuillis avec honneur dans notre société et ils seont à votre service pour toute vos services de securites.\r\nRestez avec nous pour de nouvelles actus en matieres de securité et de bien etre.', NULL),
(2, '2024-10-23', 'La nouvelle vague de bonheur.', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem enim aperiam impedit possimus maiores minima totam reprehenderit nemo, doloribus temporibus quisquam doloremque culpa officiis quam corrupti earum. Asperiores, atque natus!', NULL),
(3, '2024-10-24', 'La Sécurité : Un Enjeu Crucial de Notre Temps', 'Dans un monde en constante évolution, la sécurité occupe une place prépondérante dans nos vies quotidiennes. Que ce soit à la maison, au travail ou dans les espaces publics, la nécessité de se sentir en sécurité n’a jamais été aussi primordiale. La sécurité ne se limite pas simplement à la protection physique contre les intrusions; elle englobe également des aspects comme la sécurité numérique, la sécurité au travail, et même la sécurité émotionnelle.\r\n\r\nLa Sécurité Physique\r\nLa sécurité physique reste une priorité pour de nombreuses personnes. Que ce soit à travers l\'installation de systèmes de surveillance, d\'alarmes ou de serrures de haute sécurité, il est essentiel de se protéger contre les menaces extérieures. Les entreprises spécialisées comme KeySec offrent des solutions sur mesure pour répondre à ces besoins, en proposant des services de surveillance 24/7 et de gardiennage.\r\n\r\nLa Sécurité Numérique\r\nAvec l\'essor de l\'ère numérique, la sécurité informatique est devenue un enjeu majeur. Les cyberattaques se multiplient et peuvent avoir des conséquences dévastatrices pour les individus et les entreprises. Il est crucial de protéger ses données personnelles et professionnelles à travers des mots de passe robustes, des logiciels antivirus, et des systèmes de sauvegarde réguliers.\r\n\r\nLa Sécurité au Travail\r\nLa sécurité au travail est un aspect souvent négligé, mais tout aussi important. Un environnement de travail sécurisé est essentiel pour garantir le bien-être des employés et la productivité. Cela inclut la mise en place de protocoles de sécurité, la formation des employés aux risques potentiels, et la fourniture d\'équipements de protection individuelle.\r\n\r\nLa Sécurité Emotionnelle\r\nEnfin, la sécurité émotionnelle joue un rôle crucial dans notre bien-être général. Se sentir en sécurité dans ses relations personnelles et professionnelles est fondamental pour une vie épanouie. Cela passe par la création d\'un environnement où chacun se sent respecté et valorisé.\r\n\r\nEn résumé, la sécurité est un concept multidimensionnel qui va bien au-delà de la simple protection physique. C\'est un enjeu vital dans notre société moderne, et il est essentiel de rester vigilant et proactif pour garantir notre bien-être et celui de nos proches. Des entreprises comme KeySec se tiennent prêtes à offrir des solutions complètes et personnalisées pour répondre à tous vos besoins en matière de sécurité.\r\n\r\n', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `created_at`) VALUES
(1, 'ishimwe', '$2y$10$Spsy38V9bR5dNKOBqcfG4ePEMoA0NmcprXjI40Woa470XsS8OIB5W', 'ayesishimwe@gmail.com', '2024-10-23 23:20:41'),
(2, 'irumva', '$2y$10$mHo4cT8pRAXVxeVW1dz7D.EO7lciPuZOcftvXvtjh6MA1dsfPe5UW', 'this@this.com', '2024-10-24 12:13:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adresse`
--
ALTER TABLE `adresse`
  ADD PRIMARY KEY (`id_adresse`),
  ADD KEY `id_client` (`id_client`),
  ADD KEY `id_agent` (`id_agent`);

--
-- Indexes for table `agent`
--
ALTER TABLE `agent`
  ADD PRIMARY KEY (`id_agent`),
  ADD KEY `fk_fonction` (`fonction_id`);

--
-- Indexes for table `authentification`
--
ALTER TABLE `authentification`
  ADD PRIMARY KEY (`id_auth`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id_contact`);

--
-- Indexes for table `contrat`
--
ALTER TABLE `contrat`
  ADD PRIMARY KEY (`id_contrat`),
  ADD KEY `fk_client` (`client_id`);

--
-- Indexes for table `fonction`
--
ALTER TABLE `fonction`
  ADD PRIMARY KEY (`id_fonction`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id_post`);

--
-- Indexes for table `publication`
--
ALTER TABLE `publication`
  ADD PRIMARY KEY (`id_pub`),
  ADD KEY `fk_auteur` (`auteur`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adresse`
--
ALTER TABLE `adresse`
  MODIFY `id_adresse` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `agent`
--
ALTER TABLE `agent`
  MODIFY `id_agent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `authentification`
--
ALTER TABLE `authentification`
  MODIFY `id_auth` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id_contact` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contrat`
--
ALTER TABLE `contrat`
  MODIFY `id_contrat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `fonction`
--
ALTER TABLE `fonction`
  MODIFY `id_fonction` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `publication`
--
ALTER TABLE `publication`
  MODIFY `id_pub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adresse`
--
ALTER TABLE `adresse`
  ADD CONSTRAINT `adresse_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`),
  ADD CONSTRAINT `adresse_ibfk_2` FOREIGN KEY (`id_agent`) REFERENCES `agent` (`id_agent`);

--
-- Constraints for table `agent`
--
ALTER TABLE `agent`
  ADD CONSTRAINT `fk_fonction` FOREIGN KEY (`fonction_id`) REFERENCES `fonction` (`id_fonction`);

--
-- Constraints for table `contrat`
--
ALTER TABLE `contrat`
  ADD CONSTRAINT `fk_client` FOREIGN KEY (`client_id`) REFERENCES `client` (`id_client`);

--
-- Constraints for table `publication`
--
ALTER TABLE `publication`
  ADD CONSTRAINT `fk_auteur` FOREIGN KEY (`auteur`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
