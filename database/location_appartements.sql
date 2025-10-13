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
  `id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `slug` varchar(170) NOT NULL,
  `description` text DEFAULT NULL,
  `capacity` tinyint(3) UNSIGNED DEFAULT 1,
  `base_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `city` varchar(80) DEFAULT NULL,
  `country` varchar(80) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `surface` decimal(6,2) DEFAULT NULL COMMENT 'Surface in m??',
  `bedrooms` tinyint(3) UNSIGNED DEFAULT 1,
  `bathrooms` tinyint(3) UNSIGNED DEFAULT 1,
  `floor_number` tinyint(4) DEFAULT NULL COMMENT 'Floor number (NULL for house)',
  `has_elevator` tinyint(1) DEFAULT 0,
  `has_parking` tinyint(1) DEFAULT 0,
  `has_balcony` tinyint(1) DEFAULT 0,
  `has_garden` tinyint(1) DEFAULT 0,
  `property_type` enum('apartment','house','studio','loft','other') DEFAULT 'apartment',
  `published` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `cancel_policy` varchar(20) NOT NULL DEFAULT 'moderate'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `apartments`
--

INSERT INTO `apartments` (`id`, `owner_id`, `title`, `slug`, `description`, `capacity`, `base_price`, `city`, `country`, `address`, `surface`, `bedrooms`, `bathrooms`, `floor_number`, `has_elevator`, `has_parking`, `has_balcony`, `has_garden`, `property_type`, `published`, `created_at`, `updated_at`, `cancel_policy`) VALUES
(1, 2, 'Nouvelle villa', 'annonce', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"\r\n\r\nSection 1.10.32 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC\r\n\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\"', 5, 632.00, 'Lyon', 'France', NULL, NULL, 1, 1, NULL, 0, 0, 0, 0, 'apartment', 1, '2025-09-09 14:56:05', '2025-09-09 14:56:05', 'moderate'),
(3, 2, 'Villa avec Plage et Golf', 'villa-avec-plage-et-golf', 'Situation de la villa\r\nQue pensez-vous de l\'idée de pouvoir pratiquer votre sport préféré, le golf, tout en profitant d\'une vue exceptionnelle sur Marie-Galante, l\'un des trésors de l\'archipel guadeloupéen? C\'est exactement ce que vous offre cette superbe villat, située à Saint-François dans une petite résidence privée et sécurisée.\r\n\r\nEnfin, rejoindre le centre de Saint-François avec ses restaurants et ses commerces ne vous prendra que 2 minutes en voiture.\r\n\r\nSi vous le souhaitez, vous pourrez également profiter du boulodrome pour des parties de pétanque entre amis ou en famille, ou vous essayer au mini-golf. Pour ceux qui préfèrent se détendre au bord de l\'eau, il suffit de passer par le portillon du jardin pour accéder à la jolie plage du Manganao.\r\n\r\nLogement\r\nImaginez le luxe de pouvoir pratiquer le golf sans même sortir de votre jardin. C\'est exactement ce que vous offre cette villa.\r\n\r\nCette villa « pied dans l’eau » avec accès direct à la plage, de 250m² répartie sur trois niveaux, est à la fois pratique et agréable. Les espaces de vie, comme le salon et la salle à manger, s\'ouvrent sur des terrasses, offrant une sensation d\'infini avec la mer. De plus, avec un ascenseur intérieur, la maison est accessible en toute sécurité aux personnes à mobilité réduite.\r\n\r\nAu niveau principal, la villa s\'ouvre sur une grande pièce à vivre avec :\r\n\r\nun salon TV\r\nun coin repas trés lumineux face à la mer\r\nune grande cuisine ouverte entièrement équipée\r\nAu premier étage, vous trouverez :\r\n\r\n3 chambres doubles spacieuses et climatisées, chacune avec sa salle d\'eau, toilettes, un grand dressing, une TV, une ouverture sur un balcon et une vue mer imprenable sur Marie-Galante !\r\nAu rez-de-chaussée, vous trouverez :\r\n\r\nla 4ème chambre, tout aussi grande et équipée que les autres, avec accès direct à la cour,\r\nune salle de sport avec tapis roulant, vélo elliptique et petit appareil de fitness\r\nun espace de service nécessaire au bon fonctionnement de cette luxueuse résidence.\r\nL\'extérieur de la villa offre autant de confort que l\'intérieur !\r\n\r\nSur la terrasse bioclimatique un espace repas et salon de jardin vous attend face à la piscine et la mer\r\nVous pourrez profiter d\'une grande piscine à débordement offrant une vue imprenable sur votre propre terrain de golf privé \r\nDe plus, un boulodrome est mis à votre disposition pour des parties de pétanque lors de l\'apéritif et au coucher du soleil\r\nEnfin, un petit portail situé au fond du jardin vous permettra d\'accéder à pied à la charmante plage de Manganao.\r\nChic, élégante et résolument moderne, cette villa d\'architecte a été conçue pour vous offrir, ainsi qu\'à vos proches, un séjour inoubliable.\r\n\r\nLa villa, moderne, élégante et spacieuse, se distingue par son mobilier sobre et de qualité ainsi que par ses équipements haut de gamme.\r\n\r\nServices\r\nAfin de rendre votre séjour plus confortable, les services suivants sont mis à votre disposition :\r\n\r\nKit 1er petit-déjeuner offert\r\nLinge de maison fourni (draps, serviettes de toilette, torchons, serviettes de plage et de piscine)\r\nChangement de linge tous les 7 jours\r\nPanier de bienvenue\r\nApéritif dînatoire de bienvenue\r\nSéjour et chambres climatisées\r\nEnceinte Bluetooth BOSE, TV 4K 50′ dans les 4 chambres et 55′ dans séjour\r\nLes chaînes de la TNT / Netflix\r\nProduits d’accueil marque CLARINS\r\nSystème d\'alarme domestique\r\nÉquipement bébé : 2 lits parapluie, une chaise haute sur demande à la réservation\r\nBarbecue à gaz\r\nDouche extérieure\r\nPlancha\r\nBorne de recharge électrique\r\nService de ménage en option avec supplément\r\nCuve tampon pour pallier aux éventuelles coupures d\'eau\r\nParking sécurisé 2 places\r\nMénage de fin de séjour inclus.\r\nLoisirs proches de la villa\r\nSur place :\r\n\r\nLa piscine vous promet d\'agréables moments de farniente et de jeux\r\nSalle de sport avec tapis roulant, vélo elliptique et petit appareil de fitness\r\nUn parcours de Golf 3 trous\r\nBoulodrome\r\nPetit portail situé au fond du jardin vous permettra d\'accéder à pied à la charmante plage de Manganao\r\nA proximité :\r\n\r\nLa commune de Saint-François offre de très nombreuses possibilités de loisirs diurnes :\r\n\r\nGolf 18 trous\r\nAérodrome (parachute, survol de la Guadeloupe…)\r\nPlanche à voile\r\nSurf\r\nKite surf\r\nPlongée sous-marine\r\nPêche au gros…\r\net nocturnes :\r\n\r\nCasino\r\nDiscothèques\r\nRestaurants\r\nBars…\r\nCaractéristiques détaillées\r\nNom du Quartier : Bord de Mer\r\nDistance commerce : 750m\r\nDistance aéroport : 34km\r\nPlage la plus proche : Plage du Manganao à environ 200m\r\nClimatisation dans toutes les pièces\r\nPiscine privative\r\nAnimaux Refusés\r\nSurface habitable : 250m2\r\n\r\nChambre 1\r\nEtage : 1er étage\r\nNb lit(s) double(s) en 160cm : 1\r\nDressing\r\nClimatisation\r\nSalle d\'eau exclusive\r\n\r\nChambre 2\r\nEtage : 1er étage\r\nNb lit(s) double(s) en 160cm : 1\r\nDressing\r\nClimatisation\r\nSalle d\'eau exclusive\r\n\r\nChambre 3\r\nEtage : 1er étage\r\nNb lit(s) double(s) en 160cm : 1\r\nDressing\r\nClimatisation\r\nSalle d\'eau exclusive\r\n\r\nChambre 4\r\nEtage : Rez de jardin\r\nNb lit(s) double(s) en 160cm : 1\r\nDressing\r\nClimatisation\r\nSalle d\'eau exclusive\r\n\r\nCuisine\r\n\r\nPlaques de cuisson\r\nFour\r\nFour micro-ondes\r\nRéfrigérateur américain (congélateur séparé et distributeur de glaçons)\r\nLave-vaisselle\r\nCafetière\r\nNespresso\r\nGrille pain\r\nSéjour\r\nNb canapé(s) 3 places : 2\r\nCapacité de la table : 8 à 10\r\nClimatisation\r\n\r\nTerrasse Bioclimatique\r\nCouverture : Partiellement couverte\r\nCapacité de la table : 6 à 8\r\nCapacité du salon : 6 à 8\r\n\r\nPiscine\r\nSurface : 44m2\r\nPlus grande longueur : 4m\r\nPlus grande largeur : 11m\r\n\r\nAlarme immergée\r\nFilet amovible\r\nA débordement\r\nPiscine au sel\r\nPrestations\r\nLinge de maison fournis : draps, serviettes, torchons, serviettes de plage, serviettes de piscine\r\nPrêt de lit Bébé (sur demande lors de la réservation)\r\nPrêt de chaise haute (sur demande à la réservation)\r\nKit pour le 1er petit-déjeuner offert\r\n\r\nJardin\r\nSurface : 1800m2\r\n\r\nParking', 8, 374.00, 'Saint François', 'Guadeloupe', NULL, NULL, 1, 1, NULL, 0, 0, 0, 0, 'apartment', 1, '2025-09-10 08:44:51', '2025-09-20 18:31:10', 'moderate'),
(4, 2, 'Les Pieds dans l\'eau', 'les-pieds-dans-l-eau', 'Situation de la villa\r\nSituée dans la résidence Le Lagon, entre le golf (entrée à 200 m) et les eaux turquoises du lagon, la villa est directement devant la mer.\r\nLa résidence ne comprend que des villas de grand standing et un environnement sécurisé et calme, en bordure du lagon de Saint-François.\r\n\r\nDe nombreux commerces et la Marina sont accessibles à pied à moins de 650 m (restaurants, cafés, boulangeries, supermarchés…).\r\n\r\nCertaines des plus belles plages de Guadeloupe sont également très proches, notamment La Coulée (accessible à pied) ou l\'anse à la Gourde sur la Pointe de Châteaux.\r\n\r\nLogement\r\nD\'une superficie de 270 m²  (+ 70 m² de terrasse), cette villa au charme antillais, répartie sur 2 niveaux, peut accueillir jusqu\'à 10 personnes.\r\n\r\nAu rez-de-chaussée de la villa se trouve : \r\n\r\nune grande véranda couverte face au lagon\r\nune pièce à vivre\r\nun bureau\r\nune cuisine équipée \r\n1 Suite climatisée et équipée d\'un grand lit double Queen Size (160/200), avec sa salle de douche privative, toilette privatif - Accés direct à la terrasse face au lagon\r\n1 Suite climatisée et équipée de 2 lits simples (90/200), pouvant être rapprochés et former un lit double King Size (180/200), avec sa salle de douche privative, toilette privatif - côté golf\r\n1 Suite climatisée et équipée d\'un grand lit double Queen Size (160/200), avec sa salle de douche privative, toilette privatif - Accés direct à la terrasse face au lagon\r\nA l’étage :\r\n\r\n1 Suite climatisée et équipée d\'un grand lit double Queen Size (160/200), avec sa salle de douche privative, toilette privatif - un grande terrasse privative avec vue mer et vue sur le golf\r\n1 Suite climatisée et équipée d\'un grand lit double Queen Size (160/200), avec sa salle de douche privative, toilette privatif - une grande terrasse avec petit salon extérieur, hamac et une vue mer incomparable …\r\nDepuis la plage, le jardin ou la grande véranda, vous bénéficierez d’une vue imprenable sur le lagon, ainsi que sur les îles de Marie-Galante et de la Dominique. Les eaux cristallines du lagon sont parfaites pour la natation et les sports nautiques.\r\n\r\nLe jardin et la plage sont très privés, et isolés du voisinage !\r\n\r\nAccès privé à la plage… Le paradis tropical !\r\n\r\nA savoir : 2 chats discrets vivent dans le jardin et sont soignés par le jardinier.\r\n\r\nServices\r\nAfin de rendre votre séjour plus confortable, les services suivants vous sont proposés :\r\n\r\nKit 1er petit-déjeuner offert\r\nLinge de maison fourni (draps, serviettes de toilette, torchons et serviettes de plage et piscine) avec 1 change tous les 7 jours\r\nBarbecue et plancha à gaz\r\nLave-vaisselle\r\nRéfrigérateur américain, 2ème réfrigérateur, extracteur de jus, blender, cuiseur à riz\r\nMachine à laver le linge et sèche-linge\r\nSur demande à la réservation, prêt d\'une chaise haute, d\'un lit bébé\r\nWifi\r\n3h de ménage 2 fois par semaine  \r\nCuve tampon permettant de pallier aux éventuelles coupures d\'eau\r\nPrêt de 2 canoës avec gilets et 2 paddles avec gilets de sauvetage\r\nA savoir : 2 chats discrets vivent dans le jardin et sont soignés par le jardinier.\r\n\r\nMénage de fin de séjour inclus.\r\nLoisirs proches de la villa\r\nSur place :\r\n\r\nLa plage vous promet d\'agréables moments de farniente et de jeux\r\n2 Canoës avec gilets et 2 planches pour stand up paddle mis à votre disposition pour partir à la découverte du lagon\r\nA proximité :\r\n\r\nLa commune de Saint-François offre de très nombreuses possibilités de loisirs diurnes :\r\n\r\nGolf 18 trous\r\nAérodrome (parachute, survol de la Guadeloupe…)\r\nPlanche à voile\r\nSurf\r\nKite surf\r\nPlongée sous-marine\r\nPêche au gros…\r\net nocturnes :\r\n\r\nCasino\r\nDiscothèques\r\nRestaurants\r\nBars…\r\nCaractéristiques détaillées\r\nNom du Quartier : Le Lagon\r\nDistance commerce : 650m\r\nDistance aéroport : 50km\r\nPlage la plus proche : Anse Champagne à environ 0m\r\nClimatisation dans toutes les chambres\r\nPas de piscine\r\nAnimaux Refusés\r\nSurface habitable : 270m2\r\nNb total de WC : 5\r\n\r\nChambre 1\r\nEtage : Rez de chaussée\r\nNb lit(s) double(s) en 160cm : 1\r\nClimatisation\r\nMoustiquaire\r\nSalle d\'eau exclusive\r\n\r\nChambre 2\r\nEtage : Rez de chaussée\r\nNb lit(s) simple(s) : 2\r\nClimatisation\r\nMoustiquaire\r\nSalle d\'eau exclusive\r\n\r\nChambre 3\r\nEtage : Rez de chaussée\r\nNb lit(s) double(s) en 160cm : 1\r\nClimatisation\r\nMoustiquaire\r\nSalle d\'eau exclusive\r\n\r\nCuisine\r\n\r\nFeux au gaz\r\nFour\r\nFour micro-ondes\r\nGrand réfrigérateur avec compartiment congélation séparé\r\nLave-vaisselle\r\nCafetière\r\nNespresso\r\nGrille pain\r\nSéjour\r\nNb canapé(s) 2 places : 1\r\nCapacité de la table : 2 à 4\r\nBrasseur d\'air\r\n\r\nTerrasse\r\nCouverture : Couverte\r\nCapacité de la table : 10 à 12\r\nCapacité du salon : 8 à 10\r\n\r\nPrestations\r\nLinge de maison fournis : draps, serviettes, torchons, serviettes de plage, serviettes de piscine\r\nPrêt de lit Bébé (sur demande lors de la réservation)\r\nPrêt de chaise haute (sur demande à la réservation)\r\nKit pour le 1er petit-déjeuner offert\r\n\r\nJardin\r\nSurface : 600m2\r\n\r\nParking', 10, 714.00, 'Saint François', 'Guadeloupe', NULL, NULL, 1, 1, NULL, 0, 0, 0, 0, 'apartment', 1, '2025-09-18 08:46:55', '2025-09-18 08:46:55', 'moderate'),
(5, 2, 'Villa de prestige avec vue mer', 'villa-de-prestige-avec-vue-mer', '', 12, 512.00, 'Sainte Anne', 'Guadeloupe', NULL, NULL, 1, 1, NULL, 0, 0, 0, 0, 'apartment', 1, '2025-09-18 08:52:10', '2025-09-18 08:52:10', 'moderate'),
(6, 2, 'Splendide villa vue mer et Ilets Pigeon', 'splendide-villa-vue-mer-et-ilets-pigeon', 'Situation de la villa\r\nA Bouillante, en Côte-Sous-le-Vent, entre mer et montagne, face à la réserve naturelle des îlets Pigeon, cette splendide villa n’attend plus que vous pour profiter des merveilles de la Basse-Terre authentique.\r\n\r\nLa villa se situe à Morne Tarare, qui est un quartier très calme et en hauteur permettant de surplomber la Mer des Caraïbes et d\'admirer de magnifiques couchers de soleil.\r\n\r\nLa villa est à 700 mètres d\'un petit centre commercial comprenant commerces, boulangerie, traiteur de poissons sauvages, pharmacie, station service ainsi que médecins.\r\nAux alentours, vous trouverez de nombreux restaurants qui vous permettrons de découvrir les multiples facettes de la cuisine Créole.\r\n\r\nLogement\r\nLa villa a été pensée avec le plus grand soin et construite avec des matériaux de qualité afin d\'offrir un séjour 100 % détente et confort dans un cadre extraordinaire ! \r\n\r\nLa villa de 285 m² (+100 m² de terrasse), avec ses 4 chambres, peut accueillir jusqu\'à 8 personnes.\r\n\r\n3 chambres climatisées et équipées chacune d\'un lit double Queen Size (160/200) pour deux d\'entre elles et deux lits simples (90/180) pouvant être rapprochés pour l\'autre - chacune avec sa salle de douche privative et toilettes - vue mer et piscine garantie\r\n1 chambre mansardée climatisée et équipée d\'un lit double Queen Size (160/200)\r\n1 toilette invité\r\n1 cuisine entièrement équipée ouverte sur le salon et la terrasse\r\n1 espace salon, avec billard, et une vue magnifique sur la Mer des Caraïbes\r\n1 immense terrasse avec espace repas, coin apéro et détente avec transats et table de ping-pong\r\n1 Jacuzzi à partir du 01 mars 2023\r\nCette magnifique villa est l\'endroit de détente idéal : salons privatifs, table de billard, table de ping-pong, grande piscine miroir à débordement, tout est pensé pour votre confort et dans le plus grand raffinement. \r\n\r\nPlus au large, se déroule chaque année le passage des cétacés, un moment inoubliable pour tous !\r\n\r\nDécouvrez nos offres de location de villa de luxe en Guadeloupe.\r\n\r\nServices\r\nAfin de vous garantir un séjour tout confort, la villa met à votre disposition les services suivants :\r\n\r\nKit 1er petit-déjeuner offert\r\nDraps de lits, serviettes de toilettes et torchons fournis, avec change pour les séjours de + de 7 nuits\r\nMoustiquaires\r\nAccès internet Wifi\r\nLave-linge\r\nTélévision écran plat\r\nCoffre-fort\r\nSèche-cheveux\r\nTéléviseur, avec lecteur DVD et câble/satellite\r\nLit bébé et chaise haute\r\nFer et planche à repasser\r\nPlancha\r\nTable de ping-pong \r\nBillard\r\nCuve tampon\r\nGroupe électrogène\r\nMénage de fin de séjour inclus.\r\nLoisirs proches de la villa\r\nSur place :\r\n\r\nFarniente au bord de la piscine\r\nParties de billard ou ping-pong\r\nA proximité de très nombreuses :\r\n\r\nPlongée libre et bouteille (nombreux clubs), notamment à la réserve Cousteau\r\nVisite du Jardin Botanique de Deshaies\r\nVisite du Saut d\'Acomat, l\'une des plus belles piscines naturelles de Guadeloupe\r\nSki nautique\r\nPêche au gros\r\nRandonnées dans la forêt tropicale.\r\nVous n\'aurez que l\'embarras du choix !\r\n\r\nCaractéristiques détaillées\r\nNom du Quartier : Malendure\r\nDistance commerce : 700m\r\nDistance aéroport : 37km\r\nPlage la plus proche : Plage de Malendure à environ 2000m\r\nClimatisation dans toutes les chambres\r\nPiscine privative\r\nAnimaux Refusés\r\nEtoiles meublé de tourisme : 1 étoile\r\nSurface habitable : 285m2\r\nNb total de WC : 4\r\n\r\nChambre 1\r\nNb lit(s) double(s) en 160cm : 1\r\nClimatisation\r\nMoustiquaire\r\nSalle d\'eau exclusive\r\n\r\nChambre 2\r\nNb lit(s) double(s) : 1\r\nClimatisation\r\nMoustiquaire\r\nSalle d\'eau exclusive\r\n\r\nChambre 3\r\nNb lit(s) simple(s) : 2\r\nClimatisation\r\nMoustiquaire\r\nSalle d\'eau exclusive\r\n\r\nChambre 4\r\nEtage : 1er étage\r\nNb lit(s) double(s) en 160cm : 1\r\nClimatisation\r\nMoustiquaire\r\n\r\nCuisine\r\n\r\nPlaques induction\r\nFour\r\nFour micro-ondes\r\nGrand réfrigérateur\r\nLave-vaisselle\r\nCafetière\r\nNespresso\r\nGrille pain\r\nSalon\r\nNb canapé(s) 3 places : 2\r\n\r\nTerrasse\r\nSurface : 100m2\r\nCouverture : Couverte\r\nCapacité de la table : 6 à 8\r\nCapacité du salon : 6 à 8\r\n\r\nPiscine\r\nSurface : 40m2\r\nPlus grande longueur : 10m\r\nPlus grande largeur : 4m\r\nProfondeur minimum : 1.2m\r\nProfondeur maximum : 1.5m\r\n\r\nAlarme immergée\r\nA débordement\r\nA l\'abri des regards\r\nPrestations\r\nLinge de maison fournis : draps, serviettes, torchons, serviettes de piscine\r\nPrêt de lit Bébé (sur demande lors de la réservation)\r\nPrêt de chaise haute (sur demande à la réservation)\r\nKit pour le 1er petit-déjeuner offert\r\n\r\nJardin\r\nSurface : 1600m2\r\nA l\'abri des regards\r\n\r\nParking', 8, 807.00, 'Bouillante', 'Guadeloupe', NULL, NULL, 1, 1, NULL, 0, 0, 0, 0, 'apartment', 1, '2025-09-18 09:10:34', '2025-09-18 09:10:34', 'moderate'),
(7, 2, 'Villa de luxe avec vue exceptionnelle', 'villa-de-luxe-avec-vue-exceptionnelle', 'Situation de la villa\r\nSituée sur les hauteurs de la commune du Diamant, la villa jouit d\'une vue époustouflante sur tout le sud de la Martinique ! Plus de 180°, du rocher du Diamant jusqu\'à la baie du Vauclin avec au loin l\'île de Sainte Lucie. Très probablement l\'une des plus belles vues en Martinique !\r\n\r\nCette vue se mérite, il faut monter un peu haut par une petite route pour y accéder. L\'environnement est calme, seules quelques maisons voisinent la villa.\r\n\r\nLa plage du Diamant, le bourg du Diamant, les commerces et restaurants sont à environ 3km.\r\n\r\nLogement\r\nConstruite en 2022, cette villa de luxe de 240m² bénéficie d\'un design moderne et d\'un mobilier de qualité.\r\n\r\nRéparties sur 2 niveaux, toutes les pièces de la villa bénéficient d\'une large vue mer. La villa comprend :\r\n\r\nAu rez de chaussée :\r\n\r\n2 studios indépendants et climatisés de 30m² avec lit Queen size (160X200), salle de douche privative, petite cuisine équipée, table et chaise. L\'un des studios communique avec le séjour, l\'autre est accessible par la terrasse.\r\n1 vaste séjour de 70m² meublé d\'un espace salon avec télévision et d\'un espace repas pour 10 personnes avec une large vue sur la mer\r\n1 cuisine très bien équipée, dans le séjour avec ilot central\r\n1 toilette invités\r\nLe niveau supérieur comprend :\r\n\r\n1 chambre climatisée avec lit Queen size et salle de douche accessible depuis la mezzanine\r\n1 chambre climatisée avec lit King size (200X200), salle de douche privative et petite terrasse\r\n1 Mezzanine meublée d\'un canapé lit confortable et adapté à de grands enfants ou des ados. Originale, la mezzanine comprend un filet suspendu surplombant le séjour !\r\nDevant le séjour, vous apprécierez la grande terrasse avec salon extérieur de même que la piscine au sel bordée de 6 bains de soleil et d\'un lit de piscine.\r\n\r\nC\'est garanti, vous ne vous lasserez pas de la vue !\r\n\r\nA savoir : Les tarifs différent en fonction du nombre d\'occupants et de chambres louées : 1 tarif 2 chambres 4 personnes, 1 tarif 2 chambres + 1 studio pour 6 personnes, 1 tarif pour toute la villa.\r\n\r\nServices\r\nLinge de maison fourni (draps, serviettes de toilette, serviette de piscine, torchons)\r\nMise à disposition du 1er petit déjeuner\r\nBarbecue au bois\r\nMachine à laver le linge\r\nLave vaisselle\r\nLit bébé et chaise haute sur demande à la réservation\r\nGrande télévision  \r\nInternet et Wifi\r\nTable et fer à repasser\r\nSèche cheveux\r\nMénage de fin de séjour obligatoire, de 190 € à 270 € (selon le nombre d\'occupants et/ou le nombre de pièces louées) à régler directement sur place.\r\nLoisirs proches de la villa\r\nActivités nautiques, notamment plongée au rocher du Diamant et surf à la plage du Diamant\r\nRandonnées sur le Morne Larcher\r\nVisite du Mémorial des esclaves et du musée du coquillage\r\nMarché au Diamant,\r\nNombreux petits restaurants au bourg du Diamant\r\nCaractéristiques détaillées\r\nDistance commerce : 3km\r\nDistance aéroport : 25km\r\nPlage la plus proche : Le Diamant à environ 3000m\r\nClimatisation dans toutes les chambres\r\nPiscine privative\r\nAnimaux Refusés\r\nSurface habitable : 240m2\r\nNb maximum d\'adultes conseillé : 8\r\nNb total de WC : 5\r\n\r\nChambre 1\r\nEtage : 1er étage\r\nNb lit(s) double(s) en 200cm (ou plus) : 1\r\nClimatisation\r\nSalle d\'eau exclusive\r\n\r\nChambre 2\r\nEtage : 1er étage\r\nNb lit(s) double(s) en 160cm : 1\r\nClimatisation\r\n\r\nChambre 3\r\nNb lit(s) double(s) en 160cm : 1\r\nClimatisation\r\nSalle d\'eau exclusive\r\n\r\nChambre 4\r\nNb lit(s) double(s) en 160cm : 1\r\nClimatisation\r\nSalle d\'eau exclusive\r\n\r\nCuisine\r\n\r\nPlaques de cuisson\r\nFour\r\nFour micro-ondes\r\nRéfrigérateur américain (congélateur séparé et distributeur de glaçons)\r\nLave-vaisselle\r\nCafetière\r\nNespresso\r\nGrille pain\r\nJardin\r\nSurface : 200m2\r\n\r\nParking\r\nSéjour\r\nSurface : 70m2\r\nNb canapé(s) 3 places : 1\r\nCapacité de la table : 8 à 10\r\n\r\nPiscine\r\nPlus grande longueur : 6m\r\nPlus grande largeur : 4m\r\nProfondeur minimum : 1.2m\r\nProfondeur maximum : 1.5m\r\n\r\nAlarme immergée\r\nPiscine au sel\r\nPrestations\r\nLinge de maison fournis : draps, serviettes, torchons, serviettes de piscine\r\nPrêt de lit Bébé (sur demande lors de la réservation)\r\nPrêt de chaise haute (sur demande à la réservation)\r\nKit pour le 1er petit-déjeuner offert\r\n\r\nTerrasse\r\nSurface : 130m2\r\nCouverture : Découverte\r\nCapacité du salon : 6 à 8', 10, 645.00, 'Saint François', 'Guadeloupe', NULL, NULL, 1, 1, NULL, 0, 0, 0, 0, 'apartment', 1, '2025-09-22 20:22:14', '2025-09-22 20:22:14', 'moderate');

-- --------------------------------------------------------

--
-- Structure de la table `apartment_equipments`
--

CREATE TABLE `apartment_equipments` (
  `apartment_id` int(11) NOT NULL,
  `equipment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `apartment_equipments`
--

INSERT INTO `apartment_equipments` (`apartment_id`, `equipment_id`) VALUES
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(3, 5),
(4, 1),
(4, 2),
(4, 3),
(4, 4),
(4, 5),
(5, 1),
(5, 2),
(5, 3),
(5, 4),
(5, 5),
(5, 6),
(5, 7),
(5, 8),
(5, 9),
(5, 10),
(5, 11),
(5, 13),
(5, 14),
(5, 15),
(5, 16),
(5, 17),
(5, 18),
(6, 1),
(6, 2),
(6, 3),
(6, 4),
(6, 5),
(7, 1),
(7, 2),
(7, 4),
(7, 5),
(7, 9),
(7, 11),
(7, 14),
(7, 15),
(7, 16),
(7, 17),
(7, 18);

-- --------------------------------------------------------

--
-- Structure de la table `apartment_photos`
--

CREATE TABLE `apartment_photos` (
  `apartment_id` int(11) NOT NULL,
  `photo_id` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_cover` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `apartment_photos`
--

INSERT INTO `apartment_photos` (`apartment_id`, `photo_id`, `sort_order`, `is_cover`) VALUES
(1, 1, 0, 0),
(1, 2, 1, 0),
(1, 3, 2, 0),
(1, 4, 3, 0),
(1, 5, 4, 0),
(1, 6, 5, 0),
(1, 7, 6, 0),
(1, 8, 7, 0),
(1, 9, 8, 0),
(1, 10, 9, 0),
(1, 11, 10, 0),
(1, 12, 11, 0),
(1, 13, 12, 0),
(1, 14, 13, 0),
(1, 15, 14, 0),
(1, 16, 15, 1),
(1, 17, 16, 0),
(1, 18, 17, 0),
(1, 19, 18, 0),
(1, 20, 19, 0),
(1, 21, 20, 0),
(3, 22, 0, 0),
(3, 23, 1, 0),
(3, 24, 2, 0),
(3, 25, 3, 0),
(3, 26, 4, 0),
(3, 27, 5, 0),
(3, 28, 6, 0),
(3, 29, 7, 0),
(3, 30, 8, 0),
(3, 31, 9, 0),
(3, 32, 10, 0),
(3, 33, 11, 0),
(3, 34, 12, 0),
(3, 35, 13, 0),
(3, 36, 14, 0),
(3, 37, 15, 0),
(3, 38, 16, 0),
(3, 39, 17, 0),
(3, 40, 18, 1),
(3, 41, 19, 0),
(4, 42, 0, 1),
(4, 43, 1, 0),
(4, 44, 2, 0),
(4, 45, 3, 0),
(4, 46, 4, 0),
(4, 47, 5, 0),
(4, 48, 6, 0),
(4, 49, 7, 0),
(4, 50, 8, 0),
(4, 51, 9, 0),
(4, 52, 10, 0),
(4, 53, 11, 0),
(4, 54, 12, 0),
(4, 55, 13, 0),
(4, 56, 14, 0),
(4, 57, 15, 0),
(4, 58, 16, 0),
(4, 59, 17, 0),
(4, 60, 18, 0),
(5, 61, 0, 0),
(5, 62, 1, 1),
(5, 63, 2, 0),
(5, 64, 3, 0),
(5, 65, 4, 0),
(5, 66, 5, 0),
(5, 67, 6, 0),
(5, 68, 7, 0),
(5, 69, 8, 0),
(5, 70, 9, 0),
(5, 71, 10, 0),
(5, 72, 11, 0),
(5, 73, 12, 0),
(5, 74, 13, 0),
(5, 75, 14, 0),
(5, 76, 15, 0),
(5, 77, 16, 0),
(5, 78, 17, 0),
(5, 79, 18, 0),
(5, 80, 19, 0),
(6, 81, 0, 0),
(6, 82, 1, 1),
(6, 83, 2, 0),
(6, 84, 3, 0),
(6, 85, 4, 0),
(6, 86, 5, 0),
(6, 87, 6, 0),
(6, 88, 7, 0),
(6, 89, 8, 0),
(6, 90, 9, 0),
(6, 91, 10, 0),
(6, 92, 11, 0),
(6, 93, 12, 0),
(6, 94, 13, 0),
(6, 95, 14, 0),
(6, 96, 15, 0),
(6, 97, 16, 0),
(6, 102, 17, 0),
(6, 103, 18, 0),
(6, 104, 19, 0),
(6, 105, 20, 0),
(6, 106, 21, 0),
(6, 107, 22, 0),
(6, 108, 23, 0),
(6, 109, 24, 0),
(6, 110, 25, 0),
(6, 111, 26, 0),
(6, 112, 27, 0),
(6, 113, 28, 0),
(6, 114, 29, 0),
(6, 115, 30, 0),
(6, 116, 31, 0),
(6, 117, 32, 0),
(6, 118, 33, 0),
(6, 119, 34, 0),
(6, 120, 35, 0),
(6, 121, 36, 0),
(6, 122, 37, 0),
(6, 123, 38, 0),
(6, 124, 39, 0),
(6, 125, 40, 0),
(6, 126, 41, 0),
(6, 127, 42, 0),
(6, 128, 43, 0),
(6, 129, 44, 0),
(6, 130, 45, 0),
(6, 131, 46, 0),
(7, 132, 1, 0),
(7, 133, 2, 0),
(7, 134, 3, 0),
(7, 135, 4, 1),
(7, 136, 5, 0),
(7, 137, 6, 0),
(7, 138, 7, 0),
(7, 139, 8, 0),
(7, 140, 9, 0),
(7, 141, 10, 0),
(7, 142, 11, 0),
(7, 143, 12, 0),
(7, 144, 13, 0),
(7, 145, 14, 0),
(7, 146, 15, 0),
(7, 147, 16, 0),
(7, 148, 17, 0),
(7, 149, 18, 0),
(7, 150, 19, 0),
(7, 151, 20, 0);

-- --------------------------------------------------------

--
-- Structure de la table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(180) NOT NULL,
  `subject` varchar(180) DEFAULT NULL,
  `message` text NOT NULL,
  `apartment_id` int(11) DEFAULT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `equipments`
--

CREATE TABLE `equipments` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `equipments`
--

INSERT INTO `equipments` (`id`, `name`, `category`) VALUES
(1, 'Wifi', 'Connectivité'),
(2, 'Climatisation', 'Confort'),
(3, 'Parking', 'Pratique'),
(4, 'Télévision', 'Confort'),
(5, 'Piscine', 'Loisirs'),
(6, 'Barbecue', 'Extérieur'),
(7, 'Plancha', 'Extérieur'),
(8, 'Coffre-fort', 'Sécurité'),
(9, 'Cuve tampon', 'Technique'),
(10, 'Alarme', 'Sécurité'),
(11, 'Internet', 'Connectivité'),
(13, 'Hifi', 'Divertissement'),
(14, 'Lave-linge', 'Électroménager'),
(15, 'Matériel de repassage', 'Électroménager'),
(16, 'Sèche-cheveux', 'Salle de bain'),
(17, 'Serviettes de piscine', 'Linge'),
(18, 'Linge de maison', 'Linge');

-- --------------------------------------------------------

--
-- Structure de la table `favorites`
--

CREATE TABLE `favorites` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `apartment_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `favorites`
--

INSERT INTO `favorites` (`id`, `user_id`, `apartment_id`, `created_at`) VALUES
(7, 4, 5, '2025-09-22 22:42:10');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` varchar(100) NOT NULL,
  `migrated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migrated_at`) VALUES
('202509110001_create_core_tables', '2025-09-11 12:21:20'),
('202509110002_seed_initial_reference_data', '2025-09-11 12:21:45');

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` char(64) NOT NULL,
  `expires_at` datetime NOT NULL,
  `used` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `reservation_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `currency` varchar(3) NOT NULL DEFAULT 'EUR',
  `status` varchar(20) NOT NULL,
  `mode` varchar(20) NOT NULL,
  `message` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `mime_type` varchar(100) DEFAULT NULL,
  `size` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `photos`
--

INSERT INTO `photos` (`id`, `file_name`, `mime_type`, `size`, `created_at`) VALUES
(1, 'ph_68c0407361ad5.jpg', 'image/jpeg', 126815, '2025-09-09 14:57:55'),
(2, 'ph_68c0407364ae7.jpg', 'image/jpeg', 201827, '2025-09-09 14:57:55'),
(3, 'ph_68c0407366481.jpg', 'image/jpeg', 176265, '2025-09-09 14:57:55'),
(4, 'ph_68c0407368211.jpg', 'image/jpeg', 119134, '2025-09-09 14:57:55'),
(5, 'ph_68c0407369302.jpg', 'image/jpeg', 102573, '2025-09-09 14:57:55'),
(6, 'ph_68c040736a46a.jpg', 'image/jpeg', 97339, '2025-09-09 14:57:55'),
(7, 'ph_68c040736baae.jpg', 'image/jpeg', 123375, '2025-09-09 14:57:55'),
(8, 'ph_68c040736cde6.jpg', 'image/jpeg', 119085, '2025-09-09 14:57:55'),
(9, 'ph_68c040736de6b.jpg', 'image/jpeg', 51732, '2025-09-09 14:57:55'),
(10, 'ph_68c040736f139.jpg', 'image/jpeg', 125441, '2025-09-09 14:57:55'),
(11, 'ph_68c04073701cf.jpg', 'image/jpeg', 99203, '2025-09-09 14:57:55'),
(12, 'ph_68c0407371413.jpg', 'image/jpeg', 109053, '2025-09-09 14:57:55'),
(13, 'ph_68c04073724e7.jpg', 'image/jpeg', 116479, '2025-09-09 14:57:55'),
(14, 'ph_68c0407373bc3.jpg', 'image/jpeg', 116524, '2025-09-09 14:57:55'),
(15, 'ph_68c0407374e59.jpg', 'image/jpeg', 149460, '2025-09-09 14:57:55'),
(16, 'ph_68c0407375eec.jpg', 'image/jpeg', 518625, '2025-09-09 14:57:55'),
(17, 'ph_68c0407377938.jpg', 'image/jpeg', 165079, '2025-09-09 14:57:55'),
(18, 'ph_68c0407378c2e.jpg', 'image/jpeg', 105412, '2025-09-09 14:57:55'),
(19, 'ph_68c0407379b26.jpg', 'image/jpeg', 137968, '2025-09-09 14:57:55'),
(20, 'ph_68c040737a9d3.jpg', 'image/jpeg', 131543, '2025-09-09 14:57:55'),
(21, 'ph_68c0408fa329d.jpg', 'image/jpeg', 141016, '2025-09-09 14:58:23'),
(22, 'ph_68c13ac787440.jpg', 'image/jpeg', 84810, '2025-09-10 08:45:59'),
(23, 'ph_68c13ac78a74a.jpg', 'image/jpeg', 97348, '2025-09-10 08:45:59'),
(24, 'ph_68c13ac78b86a.jpg', 'image/jpeg', 100780, '2025-09-10 08:45:59'),
(25, 'ph_68c13ac78d1a3.jpg', 'image/jpeg', 91522, '2025-09-10 08:45:59'),
(26, 'ph_68c13ac78eb63.jpg', 'image/jpeg', 90178, '2025-09-10 08:45:59'),
(27, 'ph_68c13ac7906b6.jpg', 'image/jpeg', 87219, '2025-09-10 08:45:59'),
(28, 'ph_68c13ac791de8.jpg', 'image/jpeg', 69237, '2025-09-10 08:45:59'),
(29, 'ph_68c13ac7931c3.jpg', 'image/jpeg', 96605, '2025-09-10 08:45:59'),
(30, 'ph_68c13ac794c33.jpg', 'image/jpeg', 87627, '2025-09-10 08:45:59'),
(31, 'ph_68c13ac795d9a.jpg', 'image/jpeg', 98202, '2025-09-10 08:45:59'),
(32, 'ph_68c13ac796f34.jpg', 'image/jpeg', 112626, '2025-09-10 08:45:59'),
(33, 'ph_68c13ac79879e.jpg', 'image/jpeg', 97711, '2025-09-10 08:45:59'),
(34, 'ph_68c13ac799aac.jpg', 'image/jpeg', 102417, '2025-09-10 08:45:59'),
(35, 'ph_68c13ac79ac5e.jpg', 'image/jpeg', 143165, '2025-09-10 08:45:59'),
(36, 'ph_68c13ac79c530.jpg', 'image/jpeg', 174826, '2025-09-10 08:45:59'),
(37, 'ph_68c13ac79db65.jpg', 'image/jpeg', 186440, '2025-09-10 08:45:59'),
(38, 'ph_68c13ac79ece5.jpg', 'image/jpeg', 186607, '2025-09-10 08:45:59'),
(39, 'ph_68c13ac79ff7a.jpg', 'image/jpeg', 170862, '2025-09-10 08:45:59'),
(40, 'ph_68c13ac7a1e2f.jpg', 'image/jpeg', 305448, '2025-09-10 08:45:59'),
(41, 'ph_68c13ac7a3125.jpg', 'image/jpeg', 249635, '2025-09-10 08:45:59'),
(42, 'ph_68cbc71a1bbb8.jpg', 'image/jpeg', 426287, '2025-09-18 08:47:22'),
(43, 'ph_68cbc71a1efa3.jpg', 'image/jpeg', 127921, '2025-09-18 08:47:22'),
(44, 'ph_68cbc71a207a8.jpg', 'image/jpeg', 105713, '2025-09-18 08:47:22'),
(45, 'ph_68cbc71a21b9c.jpg', 'image/jpeg', 119904, '2025-09-18 08:47:22'),
(46, 'ph_68cbc71a2306b.jpg', 'image/jpeg', 124502, '2025-09-18 08:47:22'),
(47, 'ph_68cbc71a24b19.jpg', 'image/jpeg', 132408, '2025-09-18 08:47:22'),
(48, 'ph_68cbc71a268c0.jpg', 'image/jpeg', 143988, '2025-09-18 08:47:22'),
(49, 'ph_68cbc71a2a713.jpg', 'image/jpeg', 125746, '2025-09-18 08:47:22'),
(50, 'ph_68cbc71a2b8e2.jpg', 'image/jpeg', 111251, '2025-09-18 08:47:22'),
(51, 'ph_68cbc71a2d11d.jpg', 'image/jpeg', 176477, '2025-09-18 08:47:22'),
(52, 'ph_68cbc71a2e57b.jpg', 'image/jpeg', 187827, '2025-09-18 08:47:22'),
(53, 'ph_68cbc71a2f74b.jpg', 'image/jpeg', 118807, '2025-09-18 08:47:22'),
(54, 'ph_68cbc71a31947.jpg', 'image/jpeg', 87027, '2025-09-18 08:47:22'),
(55, 'ph_68cbc71a32ac7.jpg', 'image/jpeg', 104590, '2025-09-18 08:47:22'),
(56, 'ph_68cbc71a33b6e.jpg', 'image/jpeg', 151788, '2025-09-18 08:47:22'),
(57, 'ph_68cbc71a355e9.jpg', 'image/jpeg', 164427, '2025-09-18 08:47:22'),
(58, 'ph_68cbc71a36800.jpg', 'image/jpeg', 188518, '2025-09-18 08:47:22'),
(59, 'ph_68cbc71a37b4f.jpg', 'image/jpeg', 128722, '2025-09-18 08:47:22'),
(60, 'ph_68cbc71a39648.jpg', 'image/jpeg', 264992, '2025-09-18 08:47:22'),
(61, 'ph_68cbc8ac87e4e.jpg', 'image/jpeg', 239916, '2025-09-18 08:54:04'),
(62, 'ph_68cbc8ac8ac8c.jpg', 'image/jpeg', 150367, '2025-09-18 08:54:04'),
(63, 'ph_68cbc8ac8c2c8.jpg', 'image/jpeg', 192580, '2025-09-18 08:54:04'),
(64, 'ph_68cbc8ac8e989.jpg', 'image/jpeg', 184377, '2025-09-18 08:54:04'),
(65, 'ph_68cbc8acbcea2.jpg', 'image/jpeg', 109949, '2025-09-18 08:54:04'),
(66, 'ph_68cbc8acc06c6.jpg', 'image/jpeg', 197819, '2025-09-18 08:54:04'),
(67, 'ph_68cbc8acc4f3f.jpg', 'image/jpeg', 182826, '2025-09-18 08:54:04'),
(68, 'ph_68cbc8acc7b56.jpg', 'image/jpeg', 146279, '2025-09-18 08:54:04'),
(69, 'ph_68cbc8acca6f7.jpg', 'image/jpeg', 138897, '2025-09-18 08:54:04'),
(70, 'ph_68cbc8accc0dd.jpg', 'image/jpeg', 117411, '2025-09-18 08:54:04'),
(71, 'ph_68cbc8accd149.jpg', 'image/jpeg', 149874, '2025-09-18 08:54:04'),
(72, 'ph_68cbc8accf9a7.jpg', 'image/jpeg', 133416, '2025-09-18 08:54:04'),
(73, 'ph_68cbc8acd0b99.jpg', 'image/jpeg', 140529, '2025-09-18 08:54:04'),
(74, 'ph_68cbc8acd3eec.jpg', 'image/jpeg', 101565, '2025-09-18 08:54:04'),
(75, 'ph_68cbc8acd530f.jpg', 'image/jpeg', 138499, '2025-09-18 08:54:04'),
(76, 'ph_68cbc8acd815e.jpg', 'image/jpeg', 145349, '2025-09-18 08:54:04'),
(77, 'ph_68cbc8acd9209.jpg', 'image/jpeg', 133818, '2025-09-18 08:54:04'),
(78, 'ph_68cbc8acdc67f.jpg', 'image/jpeg', 91967, '2025-09-18 08:54:04'),
(79, 'ph_68cbc8acdd6f3.jpg', 'image/jpeg', 203499, '2025-09-18 08:54:04'),
(80, 'ph_68cbc8ace08d3.jpg', 'image/jpeg', 225210, '2025-09-18 08:54:04'),
(81, 'ph_68cbccb1c86b9.jpg', 'image/jpeg', 120963, '2025-09-18 09:11:13'),
(82, 'ph_68cbccb1e2fc7.jpg', 'image/jpeg', 124745, '2025-09-18 09:11:13'),
(83, 'ph_68cbccb1ef1ba.jpg', 'image/jpeg', 116352, '2025-09-18 09:11:14'),
(84, 'ph_68cbccb20e7df.jpg', 'image/jpeg', 105279, '2025-09-18 09:11:14'),
(85, 'ph_68cbccb217371.jpg', 'image/jpeg', 80417, '2025-09-18 09:11:14'),
(86, 'ph_68cbccb223750.jpg', 'image/jpeg', 80802, '2025-09-18 09:11:14'),
(87, 'ph_68cbccb298dd7.jpg', 'image/jpeg', 110944, '2025-09-18 09:11:14'),
(88, 'ph_68cbccb2a5dcf.jpg', 'image/jpeg', 95098, '2025-09-18 09:11:14'),
(89, 'ph_68cbccb2c6494.jpg', 'image/jpeg', 41997, '2025-09-18 09:11:14'),
(90, 'ph_68cbccb2dad7b.jpg', 'image/jpeg', 41062, '2025-09-18 09:11:14'),
(91, 'ph_68cbccb2eab26.jpg', 'image/jpeg', 77974, '2025-09-18 09:11:14'),
(92, 'ph_68cbccb5684e5.jpg', 'image/jpeg', 79459, '2025-09-18 09:11:17'),
(93, 'ph_68cbccb58ef68.jpg', 'image/jpeg', 101611, '2025-09-18 09:11:17'),
(94, 'ph_68cbccb5c75ce.jpg', 'image/jpeg', 46430, '2025-09-18 09:11:17'),
(95, 'ph_68cbccb5e4b6f.jpg', 'image/jpeg', 112053, '2025-09-18 09:11:17'),
(96, 'ph_68cbccb60644b.jpg', 'image/jpeg', 123294, '2025-09-18 09:11:18'),
(97, 'ph_68cbccb61b038.jpg', 'image/jpeg', 183812, '2025-09-18 09:11:18'),
(102, 'ph_68cbccd368de2.jpg', 'image/jpeg', 80417, '2025-09-18 09:11:47'),
(103, 'ph_68cbccd36b555.jpg', 'image/jpeg', 80802, '2025-09-18 09:11:47'),
(104, 'ph_68cbccd36f8c4.jpg', 'image/jpeg', 110944, '2025-09-18 09:11:47'),
(105, 'ph_68cbccd37079d.jpg', 'image/jpeg', 95098, '2025-09-18 09:11:47'),
(106, 'ph_68cbccd3743bf.jpg', 'image/jpeg', 41997, '2025-09-18 09:11:47'),
(107, 'ph_68cbccd377cae.jpg', 'image/jpeg', 41062, '2025-09-18 09:11:47'),
(108, 'ph_68cbccd37ad08.jpg', 'image/jpeg', 77974, '2025-09-18 09:11:47'),
(109, 'ph_68cbccd387290.jpg', 'image/jpeg', 79459, '2025-09-18 09:11:47'),
(110, 'ph_68cbccd38ae68.jpg', 'image/jpeg', 101611, '2025-09-18 09:11:47'),
(111, 'ph_68cbccd38c2b9.jpg', 'image/jpeg', 46430, '2025-09-18 09:11:47'),
(112, 'ph_68cbccd38e9d8.jpg', 'image/jpeg', 112053, '2025-09-18 09:11:47'),
(113, 'ph_68cbccd3916e8.jpg', 'image/jpeg', 123294, '2025-09-18 09:11:47'),
(114, 'ph_68cbccd3944e2.jpg', 'image/jpeg', 183812, '2025-09-18 09:11:47'),
(115, 'ph_68cbcce18ef82.jpg', 'image/jpeg', 120963, '2025-09-18 09:12:01'),
(116, 'ph_68cbcce19072b.jpg', 'image/jpeg', 124745, '2025-09-18 09:12:01'),
(117, 'ph_68cbcce192142.jpg', 'image/jpeg', 116352, '2025-09-18 09:12:01'),
(118, 'ph_68cbcce19505b.jpg', 'image/jpeg', 105279, '2025-09-18 09:12:01'),
(119, 'ph_68cbcce19ad0b.jpg', 'image/jpeg', 80417, '2025-09-18 09:12:01'),
(120, 'ph_68cbcce7c9e64.jpg', 'image/jpeg', 80802, '2025-09-18 09:12:07'),
(121, 'ph_68cbcce7ccfae.jpg', 'image/jpeg', 110944, '2025-09-18 09:12:07'),
(122, 'ph_68cbcce7ce2a4.jpg', 'image/jpeg', 95098, '2025-09-18 09:12:07'),
(123, 'ph_68cbcce7d0c16.jpg', 'image/jpeg', 41997, '2025-09-18 09:12:08'),
(124, 'ph_68cbcce832a2c.jpg', 'image/jpeg', 41062, '2025-09-18 09:12:08'),
(125, 'ph_68cbcce867bc8.jpg', 'image/jpeg', 77974, '2025-09-18 09:12:08'),
(126, 'ph_68cbcce8c1c14.jpg', 'image/jpeg', 79459, '2025-09-18 09:12:08'),
(127, 'ph_68cbcce8ee611.jpg', 'image/jpeg', 101611, '2025-09-18 09:12:08'),
(128, 'ph_68cbcce91a73a.jpg', 'image/jpeg', 46430, '2025-09-18 09:12:09'),
(129, 'ph_68cbcce937b1a.jpg', 'image/jpeg', 112053, '2025-09-18 09:12:09'),
(130, 'ph_68cbcceb33574.jpg', 'image/jpeg', 123294, '2025-09-18 09:12:11'),
(131, 'ph_68cbcceb5e64e.jpg', 'image/jpeg', 183812, '2025-09-18 09:12:11'),
(132, 'ph_68d1b02266cd9.jpg', 'image/jpeg', 311697, '2025-09-22 20:22:58'),
(133, 'ph_68d1b02268a64.jpg', 'image/jpeg', 114073, '2025-09-22 20:22:58'),
(134, 'ph_68d1b02269d3f.jpg', 'image/jpeg', 138513, '2025-09-22 20:22:58'),
(135, 'ph_68d1b0226af47.jpg', 'image/jpeg', 199550, '2025-09-22 20:22:58'),
(136, 'ph_68d1b0226c356.jpg', 'image/jpeg', 101196, '2025-09-22 20:22:58'),
(137, 'ph_68d1b0226d5e5.jpg', 'image/jpeg', 121711, '2025-09-22 20:22:58'),
(138, 'ph_68d1b0226e76a.jpg', 'image/jpeg', 173913, '2025-09-22 20:22:58'),
(139, 'ph_68d1b0226fa02.jpg', 'image/jpeg', 132174, '2025-09-22 20:22:58'),
(140, 'ph_68d1b02270c26.jpg', 'image/jpeg', 92075, '2025-09-22 20:22:58'),
(141, 'ph_68d1b02271f35.jpg', 'image/jpeg', 86648, '2025-09-22 20:22:58'),
(142, 'ph_68d1b02273052.jpg', 'image/jpeg', 82669, '2025-09-22 20:22:58'),
(143, 'ph_68d1b02274117.jpg', 'image/jpeg', 82488, '2025-09-22 20:22:58'),
(144, 'ph_68d1b02275247.jpg', 'image/jpeg', 96954, '2025-09-22 20:22:58'),
(145, 'ph_68d1b0227633c.jpg', 'image/jpeg', 71446, '2025-09-22 20:22:58'),
(146, 'ph_68d1b0227773f.jpg', 'image/jpeg', 98888, '2025-09-22 20:22:58'),
(147, 'ph_68d1b022787ee.jpg', 'image/jpeg', 92447, '2025-09-22 20:22:58'),
(148, 'ph_68d1b0227a659.jpg', 'image/jpeg', 64255, '2025-09-22 20:22:58'),
(149, 'ph_68d1b0227be83.jpg', 'image/jpeg', 92458, '2025-09-22 20:22:58'),
(150, 'ph_68d1b0227cfd0.jpg', 'image/jpeg', 111868, '2025-09-22 20:22:58'),
(151, 'ph_68d1b0227e11a.jpg', 'image/jpeg', 99439, '2025-09-22 20:22:58');

-- --------------------------------------------------------

--
-- Structure de la table `promo_codes`
--

CREATE TABLE `promo_codes` (
  `id` int(11) NOT NULL,
  `apartment_id` int(11) DEFAULT NULL,
  `code` varchar(60) NOT NULL,
  `type` enum('percent','fixed') NOT NULL DEFAULT 'percent',
  `value` decimal(10,2) NOT NULL,
  `starts_at` date DEFAULT NULL,
  `ends_at` date DEFAULT NULL,
  `usage_limit` int(11) DEFAULT NULL,
  `used_count` int(11) NOT NULL DEFAULT 0,
  `min_nights` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `apartment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `stay_type_id` int(11) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `guests` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `total_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `customer_name` varchar(150) DEFAULT NULL,
  `customer_email` varchar(180) DEFAULT NULL,
  `customer_phone` varchar(50) DEFAULT NULL,
  `customer_note` text DEFAULT NULL,
  `status` enum('pending','confirmed','cancelled') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `payment_mode` varchar(20) DEFAULT NULL,
  `payment_status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id`, `apartment_id`, `user_id`, `stay_type_id`, `start_date`, `end_date`, `guests`, `total_price`, `customer_name`, `customer_email`, `customer_phone`, `customer_note`, `status`, `created_at`, `updated_at`, `payment_mode`, `payment_status`) VALUES
(1, 1, 3, 1, '2025-09-11', '2025-09-18', 1, 4424.00, 'Esteban lucia', 'evan.luce971@gmail.com', '0626123847', 'note', 'cancelled', '2025-09-10 11:45:08', '2025-09-10 12:23:08', NULL, NULL),
(2, 1, 3, 1, '2026-01-14', '2026-03-20', 1, 41080.00, 'Esteban lucia', 'evan.luce971@gmail.com', '0626123847', 'note', 'cancelled', '2025-09-10 11:52:59', '2025-09-10 12:23:04', NULL, NULL),
(3, 3, 3, 2, '2025-09-11', '2025-09-30', 8, 5668.00, 'Esteban lucia', 'evan.luce971@gmail.com', '0626123847', 'note', 'pending', '2025-09-10 12:24:00', '2025-09-10 12:24:00', NULL, NULL),
(4, 3, 4, 1, '2025-10-11', '2025-12-05', 8, 13090.00, 'reservelog', 'reservelog@gmail.com', '0626123847', 'note', 'pending', '2025-09-10 13:52:02', '2025-09-10 13:52:02', 'on_site', 'to_collect'),
(5, 6, 4, 2, '2025-12-08', '2025-12-30', 8, 17754.00, 'reservelog', 'reservelog@gmail.com', '0456859623', '', 'pending', '2025-09-22 22:42:38', '2025-09-22 22:42:38', 'online', 'unpaid');

-- --------------------------------------------------------

--
-- Structure de la table `reservation_holds`
--

CREATE TABLE `reservation_holds` (
  `id` int(11) NOT NULL,
  `apartment_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `session_id` varchar(128) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `expires_at` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `seasons`
--

CREATE TABLE `seasons` (
  `id` int(11) NOT NULL,
  `apartment_id` int(11) DEFAULT NULL,
  `name` varchar(120) NOT NULL,
  `level` enum('basse','moyenne','haute') DEFAULT NULL,
  `stay_type_id` int(11) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `seasons`
--

INSERT INTO `seasons` (`id`, `apartment_id`, `name`, `level`, `stay_type_id`, `start_date`, `end_date`, `created_at`) VALUES
(1, 3, 'haute saison', 'haute', 2, '2025-06-25', '2025-09-07', '2025-09-10 09:58:36'),
(2, 6, 'haute saison', 'haute', 2, '2025-07-16', '2025-09-01', '2025-09-22 20:18:53');

-- --------------------------------------------------------

--
-- Structure de la table `stay_types`
--

CREATE TABLE `stay_types` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `stay_types`
--

INSERT INTO `stay_types` (`id`, `code`, `name`) VALUES
(1, 'cure', 'Cure'),
(2, 'tourisme', 'Tourisme');

-- --------------------------------------------------------

--
-- Structure de la table `tariffs`
--

CREATE TABLE `tariffs` (
  `id` int(11) NOT NULL,
  `apartment_id` int(11) NOT NULL,
  `season_id` int(11) DEFAULT NULL,
  `stay_type_id` int(11) DEFAULT NULL,
  `nightly_price` decimal(10,2) NOT NULL,
  `weekly_price` decimal(10,2) DEFAULT NULL,
  `monthly_price` decimal(10,2) DEFAULT NULL,
  `min_nights` tinyint(3) UNSIGNED DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tariffs`
--

INSERT INTO `tariffs` (`id`, `apartment_id`, `season_id`, `stay_type_id`, `nightly_price`, `weekly_price`, `monthly_price`, `min_nights`, `created_at`) VALUES
(1, 3, NULL, NULL, 374.00, 1899.00, 5897.00, 1, '2025-09-10 08:44:51'),
(2, 3, 1, 2, 654.00, 3541.00, 7652.00, 1, '2025-09-10 09:59:50'),
(4, 3, 1, NULL, 654.00, 575.00, 4545.00, 1, '2025-09-17 12:20:21'),
(5, 6, 2, 2, 1000.00, 4500.00, 500.00, 1, '2025-09-22 20:19:55');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `email` varchar(180) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` enum('client','owner','admin') NOT NULL DEFAULT 'client',
  `phone` varchar(30) DEFAULT NULL,
  `city` varchar(80) DEFAULT NULL,
  `country` varchar(80) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `address_line1` varchar(150) DEFAULT NULL,
  `address_line2` varchar(150) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password_hash`, `role`, `phone`, `city`, `country`, `created_at`, `updated_at`, `address_line1`, `address_line2`, `postal_code`, `birthdate`, `verified`) VALUES
(1, 'Admin', 'admin@example.com', '$2y$10$d290cb0400a12f00a68899abcdefghijklmnopqrstuv', 'admin', NULL, NULL, NULL, '2025-09-09 14:42:11', '2025-09-09 14:42:11', NULL, NULL, NULL, NULL, 0),
(2, 'Raguelluce', 'lucergl999@gmail.com', '$2y$10$TXAIs.t3PvQTDDXxyI8Y8e9jBYUwmfimzdUh3VC6L03ZX.i1CPu3y', 'owner', '0626123847', 'Lyon', 'France', '2025-09-09 14:42:54', '2025-09-09 14:45:31', NULL, NULL, NULL, NULL, 0),
(3, 'Esteban lucia', 'evan.luce971@gmail.com', '$2y$10$iJncettgw22/XLmTKEcVje7pSN8ULlJ1HYkK7hjXsPAgfzcAa4xdG', 'owner', '0626123847', 'Dijon', 'France', '2025-09-10 07:21:03', '2025-09-11 09:41:32', NULL, NULL, NULL, NULL, 0),
(4, 'reservelog', 'reservelog@gmail.com', '$2y$10$2tR.pBahLG3KqegavqPnhexXpJmZ2rr5Wjda09uKAGH7NDdxPTBn.', 'owner', '0456859623', 'Dijon', 'France', '2025-09-10 13:46:52', '2025-09-10 14:39:29', '13 Rue des Perrières', NULL, '21000', '2000-06-25', 0);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vw_apartment_upcoming`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `vw_apartment_upcoming` (
`apartment_id` int(11)
,`title` varchar(150)
,`start_date` date
,`end_date` date
,`status` enum('pending','confirmed','cancelled')
);

-- --------------------------------------------------------

--
-- Structure de la vue `vw_apartment_upcoming`
--
DROP TABLE IF EXISTS `vw_apartment_upcoming`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_apartment_upcoming`  AS SELECT `a`.`id` AS `apartment_id`, `a`.`title` AS `title`, `r`.`start_date` AS `start_date`, `r`.`end_date` AS `end_date`, `r`.`status` AS `status` FROM (`apartments` `a` join `reservations` `r` on(`r`.`apartment_id` = `a`.`id`)) WHERE `r`.`status` in ('pending','confirmed') AND `r`.`end_date` >= curdate() ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `apartments`
--
ALTER TABLE `apartments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `owner_id` (`owner_id`),
  ADD KEY `city` (`city`);

--
-- Index pour la table `apartment_equipments`
--
ALTER TABLE `apartment_equipments`
  ADD PRIMARY KEY (`apartment_id`,`equipment_id`),
  ADD KEY `fk_eq_eq` (`equipment_id`);

--
-- Index pour la table `apartment_photos`
--
ALTER TABLE `apartment_photos`
  ADD PRIMARY KEY (`apartment_id`,`photo_id`),
  ADD KEY `photo_id` (`photo_id`);

--
-- Index pour la table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `apartment_id` (`apartment_id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Index pour la table `equipments`
--
ALTER TABLE `equipments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Index pour la table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_favorite` (`user_id`,`apartment_id`),
  ADD KEY `apartment_id` (`apartment_id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservation_id` (`reservation_id`);

--
-- Index pour la table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `promo_codes`
--
ALTER TABLE `promo_codes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_code_apartment` (`code`,`apartment_id`),
  ADD KEY `apartment_id` (`apartment_id`);

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `apartment_id` (`apartment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `status` (`status`),
  ADD KEY `stay_type_id` (`stay_type_id`),
  ADD KEY `stay_type_id_2` (`stay_type_id`);

--
-- Index pour la table `reservation_holds`
--
ALTER TABLE `reservation_holds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `apartment_id` (`apartment_id`),
  ADD KEY `expires_at` (`expires_at`);

--
-- Index pour la table `seasons`
--
ALTER TABLE `seasons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_season_range` (`start_date`,`end_date`),
  ADD KEY `apartment_id` (`apartment_id`),
  ADD KEY `stay_type_id` (`stay_type_id`),
  ADD KEY `idx_season_apartment_id` (`apartment_id`),
  ADD KEY `idx_season_stay_type_id` (`stay_type_id`),
  ADD KEY `apartment_id_2` (`apartment_id`),
  ADD KEY `stay_type_id_2` (`stay_type_id`),
  ADD KEY `apartment_id_3` (`apartment_id`),
  ADD KEY `stay_type_id_3` (`stay_type_id`);

--
-- Index pour la table `stay_types`
--
ALTER TABLE `stay_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Index pour la table `tariffs`
--
ALTER TABLE `tariffs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `apartment_id` (`apartment_id`),
  ADD KEY `season_id` (`season_id`),
  ADD KEY `stay_type_id` (`stay_type_id`),
  ADD KEY `idx_tariff_stay_type_id` (`stay_type_id`),
  ADD KEY `stay_type_id_2` (`stay_type_id`),
  ADD KEY `stay_type_id_3` (`stay_type_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role` (`role`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `apartments`
--
ALTER TABLE `apartments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `equipments`
--
ALTER TABLE `equipments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT pour la table `promo_codes`
--
ALTER TABLE `promo_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `reservation_holds`
--
ALTER TABLE `reservation_holds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `seasons`
--
ALTER TABLE `seasons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `stay_types`
--
ALTER TABLE `stay_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `tariffs`
--
ALTER TABLE `tariffs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `apartments`
--
ALTER TABLE `apartments`
  ADD CONSTRAINT `fk_apartment_owner` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `apartment_equipments`
--
ALTER TABLE `apartment_equipments`
  ADD CONSTRAINT `fk_eq_ap` FOREIGN KEY (`apartment_id`) REFERENCES `apartments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_eq_eq` FOREIGN KEY (`equipment_id`) REFERENCES `equipments` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `apartment_photos`
--
ALTER TABLE `apartment_photos`
  ADD CONSTRAINT `fk_ap_photo_ap` FOREIGN KEY (`apartment_id`) REFERENCES `apartments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_ap_photo_ph` FOREIGN KEY (`photo_id`) REFERENCES `photos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_app_ph_ap` FOREIGN KEY (`apartment_id`) REFERENCES `apartments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_app_ph_ph` FOREIGN KEY (`photo_id`) REFERENCES `photos` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`apartment_id`) REFERENCES `apartments` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD CONSTRAINT `fk_pw_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `fk_payment_res` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `promo_codes`
--
ALTER TABLE `promo_codes`
  ADD CONSTRAINT `fk_promo_ap` FOREIGN KEY (`apartment_id`) REFERENCES `apartments` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `fk_res_ap` FOREIGN KEY (`apartment_id`) REFERENCES `apartments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_res_st` FOREIGN KEY (`stay_type_id`) REFERENCES `stay_types` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_res_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `seasons`
--
ALTER TABLE `seasons`
  ADD CONSTRAINT `fk_season_ap` FOREIGN KEY (`apartment_id`) REFERENCES `apartments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_season_st` FOREIGN KEY (`stay_type_id`) REFERENCES `stay_types` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `tariffs`
--
ALTER TABLE `tariffs`
  ADD CONSTRAINT `fk_tar_ap` FOREIGN KEY (`apartment_id`) REFERENCES `apartments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_tar_se` FOREIGN KEY (`season_id`) REFERENCES `seasons` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_tar_st` FOREIGN KEY (`stay_type_id`) REFERENCES `stay_types` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
