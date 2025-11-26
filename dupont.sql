-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 26 nov. 2025 à 13:40
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
-- Base de données : `dupont`
--

-- --------------------------------------------------------

--
-- Structure de la table `appointments`
--

CREATE TABLE `appointments` (
  `id` bigint(20) NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `id_slot` bigint(20) NOT NULL,
  `id_service` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `appointments`
--

INSERT INTO `appointments` (`id`, `id_user`, `id_slot`, `id_service`) VALUES
(2, 5, 4, 1),
(3, 5, 5, 3),
(4, 2, 6, 2),
(6, 2, 8, 3),
(7, 2, 9, 2),
(8, 2, 10, 1),
(9, 2, 11, 2),
(11, 5, 13, 1),
(12, 2, 14, 4);

-- --------------------------------------------------------

--
-- Structure de la table `days`
--

CREATE TABLE `days` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `days`
--

INSERT INTO `days` (`id`, `name`, `start`, `end`) VALUES
(1, 'Lundi', '09:00:00', '17:00:00'),
(2, 'Mardi', '09:00:00', '17:00:00'),
(3, 'Mercredi', '09:00:00', '13:00:00'),
(4, 'Jeudi', '09:00:00', '17:00:00'),
(5, 'Vendredi', '09:00:00', '17:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `author` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `author`, `url`, `image`) VALUES
(2, 'Vaccination au collège : un accès simple et gratuit à la vaccination contre les HPV et les méningocoques ACWY dès 11 ans', 'Pour la 3e année consécutive, le ministère de la Santé, des Familles, de l’Autonomie et des Personnes handicapées et le ministère de l’Éducation nationale poursuivent la campagne vaccinale dans les collèges. En 2025, outre la vaccination contre les papillomavirus humains (HPV), les parents pourront également faire vacciner leurs enfants contre les méningocoques ACWY.\r\n\r\nCette campagne vaccinale est proposée dans tous les collèges publics et privés sous contrat volontaires, et dans les établissements médico-sociaux accueillant des jeunes de 11 à 14 ans en situation de handicap. Elle vise à poursuivre l’augmentation de la couverture vaccinale déjà engagée contre les HPV et à renforcer la protection contre les infections invasives à méningocoque (méningites) ACWY qui augmentent significativement depuis plusieurs années.', 'Ministère de la santé', 'https://sante.gouv.fr/actualites-presse/presse/communiques-de-presse/article/vaccination-au-college-un-acces-simple-et-gratuit-a-la-vaccination-contre-les', 'img_691656779e0008.57400148.png'),
(3, 'L’appli carte Vitale est désormais disponible pour tous les patients', 'Le 18 novembre 2025 marque la généralisation du déploiement de l’appli carte Vitale qui s’est déroulé par étape tout au long de l’année. Désormais, l’ensemble des patients dans toute la France pourront bénéficier de ce nouveau format dématérialisé de la carte Vitale. Jusque-là, l’appli était disponible dans 56 départements et accessible aux seuls détenteurs de la carte d’identité au format carte bancaire (CNIe).\r\n\r\nL’appli carte Vitale est une alternative à la version physique.\r\n\r\nElle est disponible gratuitement sous Android (Google Play) et IOS (App Store) et peut être activée par toutes les personnes affiliées à la Sécurité sociale (régime général de l’Assurance Maladie, régime agricole de la Mutualité sociale agricole (MSA),MGEN ou autres régimes spéciaux). \r\n\r\nPratique pour les assurés, qui ont toujours leur smartphone sur eux, et dotée d’un très haut niveau de sécurité, elle présente de nouveaux avantages pour les professionnels de santé.', 'l\'Assurance Maladie', 'https://www.ameli.fr/vienne/chirurgien-dentiste/actualites/l-appli-carte-vitale-est-desormais-disponible-pour-tous-les-patients', NULL),
(4, 'Un nouveau gel à base de protéines prometteur pour la régénération naturelle de l’émail dentaire', 'Le domaine en plein essor des biomatériaux en dentisterie a déjà fait l’objet de plusieurs articles dans Dental Tribune International, notamment sur le développement d’un dentifrice dérivé de la kératine issue de cheveux humains, et sur l’utilisation de composés d’origine végétale pour lutter contre les affections parodontales. Dans ce contexte, une équipe de recherche de l’université de Nottingham, en collaboration avec des partenaires internationaux, a mis au point un gel à base de protéines, conçu pour restaurer l’émail dentaire endommagé, représentant une avancée notable dans le domaine. Cette innovation s’inscrit dans un domaine de recherche en plein essor des biomatériaux, visant à améliorer la santé bucco-dentaire à long terme, en s’appuyant sur les processus naturels de l’organisme plutôt qu’en se limitant à obturer ou recouvrir les zones lésées.\r\n\r\nLe gel récemment développé agit en imitant les protéines naturelles responsables de la formation de l’émail aux premiers stades du développement. Appliqué sur une dent, il forme une couche protectrice et de soutien structurel, qui s’intègre à la surface amélaire existante. Cette couche capte les ions calcium et phosphate présents dans la salive et les guide vers la formation de nouveaux cristaux d’hydroxyapatite, selon une organisation structurée. Il en résulte une reconstruction progressive de l’émail, qui reproduit le tissu d’origine tant sur le plan de l’aspect que de la résistance fonctionnelle.\r\n\r\nÀ la différence des traitements fluorés classiques, qui visent principalement à renforcer l’émail résiduel ou à ralentir l’évolution de la carie dentaire, ce gel favorise une repousse contrôlée de l’émail à l’échelle microscopique. Les premiers tests ont montré que les zones restaurées se comportent de manière similaire à l’émail naturel dans des conditions quotidiennes telles que la mastication, le brossage et l’exposition aux aliments acides.\r\n\r\nLe gel présente également un potentiel intéressant pour la dentine exposée. En formant une couche de type amélaire à sa surface, il pourrait réduire l’inconfort et améliorer la longévité des restaurations.\r\n\r\nDans un communiqué de presse de l’université, le Dr Alvaro Mata, professeur de génie biomédical et de biomatériaux à l’université de Nottingham, a déclaré : « Nous sommes très enthousiastes, car cette technologie a été conçue en pensant au clinicien et au patient. Elle est sûre, peut être appliquée facilement et rapidement, et elle est évolutive. De plus, cette technologie est polyvalente, ce qui ouvre la possibilité de la décliner en plusieurs types de produits, pour aider des patients de tous âges souffrant de divers problèmes dentaires liés à la perte d’émail et à la dentine exposée. »\r\n\r\nPour faire progresser cette technologie vers une application clinique, l’équipe de recherche a fondé une start-up dont l’objectif est de développer une gamme de produits dentaires faciles à utiliser. L’espoir est que les premières versions puissent être commercialisées dans un avenir proche. Si elle se confirme, cette approche fondée sur les biomatériaux pourrait réduire significativement le recours aux préparations dentaires invasives, aux matériaux restaurateurs synthétiques et aux restaurations itératives, marquant une avancée importante pour la dentisterie régénérative.\r\n\r\nL’étude intitulée, « Biomimetic supramolecular protein matrix restores structure and properties of human dental enamel » a été publiée en ligne le 4 novembre 2025 dans Nature Communications.', 'Dental Tribune International', 'https://fr.dental-tribune.com/news/un-nouveau-gel-a-base-de-proteines-prometteur-pour-la-regeneration-naturelle-de-lemail-dentaire/', 'img_6921d8e56e59c0.17651248.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`id`, `name`, `description`) VALUES
(1, 'Détartrage', 'Le détartrage permet d\'éliminer le tartre qui peut causer la gingivite ou la parodontite.'),
(2, 'Orthodontie', 'L\'orthodontie vise à corriger les malpositions dentaires et les déformations maxillaires.'),
(3, 'Implantologie', 'L’implantologie permet le traitement de l’édentement par l’implantation chirurgicale d’un implant au sein de l’os. '),
(4, 'Esthétique', 'La dentisterie esthétique regroupe l\'ensemble des techniques dentaires visant à améliorer et restaurer la beauté naturelle de vos dents.'),
(5, 'Endodontie', 'L\'endodontie consiste à soigner la partie interne de la dent, la pulpe, lorsque celle-ci est atteinte.'),
(6, 'Radiologie', 'La radiologie dentaire est un type d\'examen par imagerie qui permet au dentiste de veiller sur la santé bucco-dentaire des patients. Elle fournit une image de haute précision des arcades dentaires et des mâchoires.');

-- --------------------------------------------------------

--
-- Structure de la table `slots`
--

CREATE TABLE `slots` (
  `id` bigint(20) NOT NULL,
  `date` date NOT NULL,
  `hour` time NOT NULL,
  `id_day` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `slots`
--

INSERT INTO `slots` (`id`, `date`, `hour`, `id_day`) VALUES
(4, '2025-11-25', '16:00:00', 2),
(5, '2025-11-19', '11:00:00', 3),
(6, '2025-11-17', '15:00:00', 1),
(8, '2025-11-24', '10:00:00', 1),
(9, '2025-11-19', '10:30:00', 3),
(10, '2025-11-20', '10:00:00', 4),
(11, '2025-11-19', '16:30:00', 3),
(13, '2025-11-19', '17:00:00', 3),
(14, '2025-11-25', '15:30:00', 2);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `phone` varchar(255) NOT NULL,
  `SSN` varchar(255) NOT NULL,
  `role` enum('patient','pro') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `dateOfBirth`, `phone`, `SSN`, `role`) VALUES
(2, 'Simon', 'simon@test.fr', '$2y$10$NYV92K/.VNSNePtppBpdGOdzQqrb6TouRDh1juPpjoF1d3vGYqVYe', '1992-06-05', '0606060606', '192066789012345', 'patient'),
(3, 'Dupont', 'dupont@test.fr', '$2y$10$xqGpX/ewfoYcBDQ0uVLV2exy8kQUl5pb8DVENTNLi2aj/I3oNYW66', '0000-00-00', '', '', 'pro'),
(5, 'Jessica Ries', 'jessicaries@test.fr', '$2y$10$DfYOzPbz7BktgMSEKO7heeC6lAxo1xtLyjzWNhpU3OSJQqeLNr.9a', '1968-04-06', '0654321037', '268048647153985', 'patient');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`) USING BTREE,
  ADD KEY `appointments_ibfk_3` (`id_service`),
  ADD KEY `appointments_ibfk_4` (`id_slot`);

--
-- Index pour la table `days`
--
ALTER TABLE `days`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `slots`
--
ALTER TABLE `slots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_day` (`id_day`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `days`
--
ALTER TABLE `days`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `slots`
--
ALTER TABLE `slots`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_3` FOREIGN KEY (`id_service`) REFERENCES `services` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_4` FOREIGN KEY (`id_slot`) REFERENCES `slots` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `slots`
--
ALTER TABLE `slots`
  ADD CONSTRAINT `slots_ibfk_1` FOREIGN KEY (`id_day`) REFERENCES `days` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
