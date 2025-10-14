-- filepath: /Applications/XAMPP/xamppfiles/htdocs/MyLogement/database/location_appartements.sql
-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 23 sep. 2025 à 00:50
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
-- Base de données : `location_appartements`
--

-- Créer la base de données si elle n'existe pas
CREATE DATABASE IF NOT EXISTS `location_appartements` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- Sélectionner la base de données
USE `location_appartements`;

-- --------------------------------------------------------

--
-- Structure de la table `apartments`
--

CREATE TABLE `apartments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `capacity` int(11) NOT NULL,
  `base_price` decimal(10,2) NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `address` varchar(255),
  `surface` int(11),
  `bedrooms` int(11),
  `bathrooms` int(11),
  `floor_number` int(11),
  `has_elevator` tinyint(1) NOT NULL DEFAULT 0,
  `has_parking` tinyint(1) NOT NULL DEFAULT 0,
  `has_balcony` tinyint(1) NOT NULL DEFAULT 0,
  `has_garden` tinyint(1) NOT NULL DEFAULT 0,
  `property_type` varchar(50) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `cancel_policy` varchar(20) NOT NULL DEFAULT 'moderate',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `apartments`
--

INSERT INTO `apartments` (`id`, `owner_id`, `title`, `slug`, `description`, `capacity`, `base_price`, `city`, `country`, `address`, `surface`, `bedrooms`, `bathrooms`, `floor_number`, `has_elevator`, `has_parking`, `has_balcony`, `has_garden`, `property_type`, `published`, `created_at`, `updated_at`, `cancel_policy`) VALUES
(1, 2, 'Nouvelle villa', 'annonce', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"\r\n\r\nSection 1.10.32 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC\r\n\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\"', 5, 632.00, 'Lyon', 'France', NULL, NULL, 1, 1, NULL, 0, 0, 0, 0, 'apartment', 1, '2025-09-09 14:56:05', '2025-09-09 14:56:05', 'moderate'),
(3, 2, 'Villa avec Plage et Golf', 'villa-avec-plage-et-golf', 'Situation de la villa\r\nQue pensez-vous de l\'idée de pouvoir pratiquer votre sport préféré, le golf, tout en profitant d\'une vue exceptionnelle sur Marie-Galante, l\'un des trésors de l\'archipel guadeloupéen? C\'est exactement ce que vous offre cette superbe villat, située à Saint-François dans une petite résidence privée et sécurisée.\r\n\r\nEnfin, rejoindre le centre de Saint-François avec ses restaurants et ses commerces ne vous prendra que 2 minutes en voiture.\r\n\r\nSi vous le souhaitez, vous pourrez également profiter du boulodrome pour des parties de pétanque entre amis ou en famille, ou vous essayer au mini-golf. Pour ceux qui préfèrent se détendre au bord de l\'eau, il suffit de passer par le portillon du jardin pour accéder à la jolie plage du Manganao.\r\n\r\nLogement\r\nImaginez le luxe de pouvoir pratiquer le golf sans même sortir de votre jardin. C\'est exactement ce que vous offre cette villa.\r\n\r\nCette villa « pied dans l’eau » avec accès direct à la plage, de 250m² répartie sur trois niveaux, est à la fois pratique et agréable. Les espaces de vie, comme le salon et la salle à manger, s\'ouvrent sur des terrasses, offrant une sensation d\'infini avec la mer. De plus, avec un ascenseur intérieur, la maison est accessible en toute sécurité aux personnes à mobilité réduite.\r\n\r\nAu niveau principal, la villa s\'ouvre sur une grande pièce à vivre avec :\r\n\r\nun salon TV\r\nun coin repas trés lumineux face à la mer\r\nune grande cuisine ouverte entièrement équipée\r\nAu premier étage, vous trouverez :\r\n\r\n3 chambres doubles spacieuses et climatisées, chacune avec sa salle d\'eau, toilettes, un grand dressing, une TV, une ouverture sur un balcon et une vue mer imprenable sur Marie-Galante !\r\nAu rez-de-chaussée, vous trouverez :\r\n\r\nla 4ème chambre, tout aussi grande et équipée que les autres, avec accès direct à la cour,\r\nune salle de sport avec tapis roulant, vélo elliptique et petit appareil de fitness\r\nun espace de service nécessaire au bon fonctionnement de cette luxueuse résidence.\r\nL\'extérieur de la villa offre autant de confort que l\'intérieur !\r\n\r\nSur la terrasse bioclimatique un espace repas et salon de jardin vous attend face à la piscine et la mer\r\nVous pourrez profiter d\'une grande piscine à débordement offrant une vue imprenable sur votre propre terrain de golf privé \r\nDe plus, un boulodrome est mis à votre disposition pour des parties de pétanque lors de l\'apéritif et au coucher du soleil\r\nEnfin, un petit portail situé au fond du jardin vous permettra d\'accéder à pied à la charmante plage de Manganao.\r\nChic, élégante et résolument moderne, cette villa d\'architecte a été conçue pour vous offrir, ainsi qu\'à vos proches, un séjour inoubliable.\r\n\r\nLa villa, moderne, élégante et spacieuse, se distingue par son mobilier sobre et de qualité ainsi que par ses équipements haut de gamme.\r\n\r\nServices\r\nAfin de rendre votre séjour plus confortable, les services suivants sont mis à votre disposition :\r\n\r\nKit 1er petit-déjeuner offert\r\nLinge de maison fourni (draps, serviettes de toilette, torchons, serviettes de plage et de piscine)\r\nChangement de linge tous les 7 jours\r\nPanier de bienvenue\r\nApéritif dînatoire de bienvenue\r\nSéjour et chambres climatisées\r\nEnceinte Bluetooth BOSE, TV 4K 50′ dans les 4 chambres et 55′ dans séjour\r\nLes chaînes de la TNT / Netflix\r\nProduits d’accueil marque CLARINS\r\nSystème d\'alarme domestique\r\nÉquipement bébé : 2 lits parapluie, une chaise haute sur demande à la réservation\r\nBarbecue à gaz\r\nDouche extérieure\r\nPlancha\r\nBorne de recharge électrique\r\nService de ménage en option avec supplément\r\nCuve tampon pour pallier aux éventuelles coupures d\'eau\r\nParking sécurisé 2 places\r\nMénage de fin de séjour inclus.\r\nLoisirs proches de la villa\r\nSur place :\r\n\r\nLa piscine vous promet d\'agréables moments de farniente et de jeux\r\nSalle de sport avec tapis roulant, vélo elliptique et petit appareil de fitness\r\nUn parcours de Golf 3 trous\r\nBoulodrome\r\nPetit portail situé au fond du jardin vous permettra d\'accéder à pied à la charmante plage de Manganao\r\nA proximité :\r\n\r\nLa commune de Saint-François offre de très nombreuses possibilités de loisirs diurnes :\r\n\r\nGolf 18 trous\r\nAérodrome (parachute, survol de la Guadeloupe…)\r\nPlanche à voile\r\nSurf\r\nKite surf\r\nPlongée sous-marine\r\nPêche au gros…\r\net nocturnes :\r\n\r\nCasino\r\nDiscothèques\r\nRestaurants\r\nBars…\r\nCaractéristiques détaillées\r\nNom du Quartier : Bord de Mer\r\nDistance commerce : 750m\r\nDistance aéroport : 34km\r\nPlage la plus proche : Plage du Manganao à environ 200m\r\nClimatisation dans toutes les pièces\r\nPiscine privative\r\nAnimaux Refusés\r\nSurface habitable : 250m2\r\n\r\nChambre 1\r\nEtage : 1er étage\r\nNb lit(s) double(s) en 160cm : 1\r\nDressing\r\nClimatisation\r\nSalle d\'eau exclusive\r\n\r\nChambre 2\r\nEtage : 1er étage\r\nNb lit(s) double(s) en 160cm : 1\r\nDressing\r\nClimatisation\r\nSalle d\'eau exclusive\r\n\r\nChambre 3\r\nEtage : 1er étage\r\nNb lit(s) double(s) en 160cm : 1\r\nDressing\r\nClimatisation\r\nSalle d\'eau exclusive\r\n\r\nChambre 4\r\nEtage : Rez de jardin\r\nNb lit(s) double(s) en 160cm : 1\r\nDressing\r\nClimatisation\r\nSalle d\'eau exclusive\r\n\r\nCuisine\r\n\r\nPlaques de cuisson\r\nFour\r\nFour micro-ondes\r\nRéfrigérateur américain (congélateur séparé et distributeur de glaçons)\r\nLave-vaisselle\r\nCafetière\r\nNespresso\r\nGrille pain\r\nSéjour\r\nNb canapé(s) 3 places : 2\r\nCapacité de la table : 8 à 10\r\nClimatisation\r\n\r\nTerrasse Bioclimatique\r\nCouverture : Partiellement couverte\r\nCapacité de la table : 6 à 8\r\nCapacité du salon : 6 à 8\r\n\r\nPiscine\r\nSurface : 44m2\r\nPlus grande longueur : 4m\r\nPlus grande largeur : 11m\r\n\r\nAlarme immergée\r\nFilet amovible\r\nA débordement\r\nPiscine au sel\r\nPrestations\r\nLinge de maison fournis : draps, serviettes, torchons, serviettes de plage, serviettes de piscine\r\nPrêt de lit Bébé (sur demande lors de la réservation)\r\nPrêt de chaise haute (sur demande à la réservation)\r\nKit pour le 1er petit-déjeuner offert\r\n\r\nJardin\r\nSurface : 1800m2\r\n\r\nParking', 8, 374.00, 'Saint François', 'Guadeloupe', NULL, NULL, 1, 1, NULL, 0, 0, 0, 0, 'apartment', 1, '2025-09-10 08:44:51', '2025-09-20 18:31:10', 'moderate');

COMMIT;