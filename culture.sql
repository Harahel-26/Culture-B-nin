-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 12 jan. 2026 à 21:03
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
-- Base de données : `culture`
--

-- --------------------------------------------------------

--
-- Structure de la table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-064b59a65fe7b3366232374e7daf9e6bc73905e9', 'i:1;', 1767628958),
('laravel-cache-064b59a65fe7b3366232374e7daf9e6bc73905e9:timer', 'i:1767628958;', 1767628958),
('laravel-cache-228be07bafe749cd8b6ce056adae1e72cbe4d548', 'i:1;', 1765527435),
('laravel-cache-228be07bafe749cd8b6ce056adae1e72cbe4d548:timer', 'i:1765527435;', 1765527435),
('laravel-cache-2766115da17fe4dce4c909f301041501306570f4', 'i:1;', 1766438780),
('laravel-cache-2766115da17fe4dce4c909f301041501306570f4:timer', 'i:1766438779;', 1766438779),
('laravel-cache-356a192b7913b04c54574d18c28d46e6395428ab', 'i:1;', 1767552068),
('laravel-cache-356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1767552068;', 1767552068),
('laravel-cache-4f2b877a4abce84574aeb37e70b1fdbc0a3e97a8', 'i:1;', 1765347156),
('laravel-cache-4f2b877a4abce84574aeb37e70b1fdbc0a3e97a8:timer', 'i:1765347156;', 1765347156),
('laravel-cache-52d4b6f571e8ad661961fca483ca624bed1bf9dc', 'i:1;', 1766838783),
('laravel-cache-52d4b6f571e8ad661961fca483ca624bed1bf9dc:timer', 'i:1766838783;', 1766838783),
('laravel-cache-5380d6dccac8272576647da08e7844938a431f36', 'i:1;', 1766786877),
('laravel-cache-5380d6dccac8272576647da08e7844938a431f36:timer', 'i:1766786877;', 1766786877),
('laravel-cache-5c785c036466adea360111aa28563bfd556b5fba', 'i:1;', 1768246881),
('laravel-cache-5c785c036466adea360111aa28563bfd556b5fba:timer', 'i:1768246881;', 1768246881),
('laravel-cache-625bc5243cfdb312bcfbf3b557b313d0f1ac2d5b', 'i:1;', 1767551329),
('laravel-cache-625bc5243cfdb312bcfbf3b557b313d0f1ac2d5b:timer', 'i:1767551329;', 1767551329),
('laravel-cache-6fa7890aade12bdcc711f1933eab1a4348d50cc5', 'i:1;', 1767109064),
('laravel-cache-6fa7890aade12bdcc711f1933eab1a4348d50cc5:timer', 'i:1767109064;', 1767109064),
('laravel-cache-9236324f65ca7fa8444409e1e00db46173b5fba2', 'i:1;', 1765275576),
('laravel-cache-9236324f65ca7fa8444409e1e00db46173b5fba2:timer', 'i:1765275576;', 1765275576),
('laravel-cache-98c00ebf195e33e320735ed46bab84d27239a4c4', 'i:1;', 1766323467),
('laravel-cache-98c00ebf195e33e320735ed46bab84d27239a4c4:timer', 'i:1766323467;', 1766323467),
('laravel-cache-eb6b4244d6ec5a4c0182b54c5da96f11a53a3d87', 'i:1;', 1765326494),
('laravel-cache-eb6b4244d6ec5a4c0182b54c5da96f11a53a3d87:timer', 'i:1765326494;', 1765326494),
('laravel-cache-f0797b9e3202476a1c79d7015f63df1f0524a0aa', 'i:1;', 1765827223),
('laravel-cache-f0797b9e3202476a1c79d7015f63df1f0524a0aa:timer', 'i:1765827223;', 1765827223),
('laravel-cache-irisgrace905@gmail.com|41.85.162.229', 'i:1;', 1765275424),
('laravel-cache-irisgrace905@gmail.com|41.85.162.229:timer', 'i:1765275424;', 1765275424),
('laravel-cache-koutchikaharahel@gmail.com|127.0.0.1', 'i:1;', 1765186124),
('laravel-cache-koutchikaharahel@gmail.com|127.0.0.1:timer', 'i:1765186123;', 1765186124),
('laravel-cache-spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:24:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:13:\"voir-contenus\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:9:\"commenter\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:3;i:2;i:4;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:5:\"noter\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:3;i:2;i:4;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:7:\"favoris\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:3;i:2;i:4;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:13:\"creer-contenu\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:16:\"modifier-contenu\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:17:\"supprimer-contenu\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:14:\"uploader-media\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:15:\"supprimer-media\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:19:\"proposer-traduction\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:15:\"valider-contenu\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:15:\"rejeter-contenu\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:13:\"valider-media\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:13:\"rejeter-media\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:19:\"valider-commentaire\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:19:\"rejeter-commentaire\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:18:\"valider-traduction\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:18:\"rejeter-traduction\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:13:\"gerer-langues\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:13:\"gerer-regions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:17:\"gerer-typecontenu\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:15:\"gerer-typemedia\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:22;a:4:{s:1:\"a\";i:23;s:1:\"b\";s:11:\"gerer-users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:23;a:4:{s:1:\"a\";i:24;s:1:\"b\";s:15:\"gerer-paiements\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}}s:5:\"roles\";a:4:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:5:\"admin\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:10:\"moderateur\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:3;s:1:\"b\";s:12:\"contributeur\";s:1:\"c\";s:3:\"web\";}i:3;a:3:{s:1:\"a\";i:4;s:1:\"b\";s:7:\"lecteur\";s:1:\"c\";s:3:\"web\";}}}', 1767902502);

-- --------------------------------------------------------

--
-- Structure de la table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contenu_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `note` tinyint(3) UNSIGNED NOT NULL,
  `commentaire` text NOT NULL,
  `statut` enum('pending','validated','rejected') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `contenu_id`, `user_id`, `note`, `commentaire`, `statut`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 4, 'bien', 'validated', '2025-12-08 00:01:39', '2025-12-08 01:14:02');

-- --------------------------------------------------------

--
-- Structure de la table `contenus`
--

CREATE TABLE `contenus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titre` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `contenu_texte` longtext DEFAULT NULL,
  `image_couverture` varchar(255) DEFAULT NULL,
  `langue_id` bigint(20) UNSIGNED NOT NULL,
  `region_id` bigint(20) UNSIGNED DEFAULT NULL,
  `typecontenu_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `validated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('draft','pending','validated','rejected') NOT NULL DEFAULT 'pending',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_premium` tinyint(1) NOT NULL DEFAULT 0,
  `prix` decimal(10,2) DEFAULT NULL,
  `extrait_gratuit` text DEFAULT NULL,
  `max_vues_gratuites` int(11) NOT NULL DEFAULT 3,
  `vues_gratuites` int(11) NOT NULL DEFAULT 0,
  `vues_total` int(11) NOT NULL DEFAULT 0,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contenus`
--

INSERT INTO `contenus` (`id`, `titre`, `slug`, `description`, `contenu_texte`, `image_couverture`, `langue_id`, `region_id`, `typecontenu_id`, `user_id`, `validated_by`, `status`, `is_active`, `is_premium`, `prix`, `extrait_gratuit`, `max_vues_gratuites`, `vues_gratuites`, `vues_total`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 'Les cultures du Bénin : Un patrimoine exceptionnel', 'les-cultures-du-benin-un-patrimoine-exceptionnel-6935e42bf3dfb', NULL, '<p>Le <strong>Bénin</strong>, pays situé en Afrique de l\'Ouest, est une terre riche en culture. Des traditions ancestrales aux influences modernes, la <strong>culture du Bénin</strong> représente une mosaïque d\'arts, de croyances et de coutumes qui enrichissent la vie quotidienne de ses habitants. L\'histoire de ce pays est marquée par un mélange d\'influences ethniques, religieuses et artistiques qui se reflètent dans ses fêtes, sa cuisine, sa musique, et bien plus encore. Dans cet article, nous vous invitons à explorer les multiples facettes de la<strong> culture béninoise </strong>et à découvrir son patrimoine fascinant.</p>', 'contenus/couvertures/Eszjz4otgHVZpb1mWLce1DuhLZ7RL0BoTdzeuWoN.png', 6, NULL, 6, 1, 1, 'validated', 1, 0, 100.00, NULL, 3, 0, 6, '2025-12-07 20:36:12', '2025-12-07 19:31:40', '2026-01-05 02:20:47'),
(2, 'La richesse culturelle du Bénin', 'la-richesse-culturelle-du-benin-693680251fa09', NULL, '<h3><strong>Un pays aux multiples influences culturelles</strong></h3><p>Le <strong>Bénin</strong> est un véritable carrefour de cultures et de traditions. Ce pays d\'Afrique de l\'Ouest est habité par plusieurs <strong>ethnies béninoises</strong>, chacune avec ses propres coutumes et traditions. Les groupes ethniques majeurs du Bénin comprennent les <strong>Fon</strong>, <strong>Yoruba</strong>, <strong>Bariba</strong>, <strong>Dendi</strong>, et <strong>Aja</strong>. Ces différentes ethnies ont joué un rôle essentiel dans la construction de la <strong>culture béninoise</strong>, apportant chacune leur propre richesse à la société.</p><h3><strong>Un héritage entre tradition et modernité</strong></h3><p>Bien que la culture béninoise soit fortement ancrée dans ses traditions, le pays connaît également une modernisation qui se reflète dans ses arts, sa mode et son mode de vie. C’est cette combinaison d\'anciennes pratiques et de nouvelles influences qui fait du Bénin une destination unique et fascinante.</p><p><br>&nbsp;</p>', 'contenus/couvertures/NiSS13pnyvSDlSA48Ty82ASOfh2gg15EpyPcaNT4.webp', 6, NULL, 2, 1, 1, 'validated', 1, 1, 100.00, NULL, 3, 0, 13, '2025-12-08 06:38:12', '2025-12-08 06:37:09', '2025-12-30 23:17:06'),
(3, 'La gastronomie Béninoise : Un mélange de saveurs et de traditions', 'la-gastronomie-beninoise-un-melange-de-saveurs-et-de-traditions-69374516172c9', NULL, '<h3><strong>Les plats typiques du Bénin</strong></h3><p>La <strong>culture béninoise</strong> se reflète également dans sa <strong>gastronomie</strong>. Les <strong>plats typiques du Bénin</strong> sont souvent savoureux, épicés, et pleins de couleurs. Parmi les mets incontournables, on trouve le <strong>pâte</strong>, une bouillie faite de farine de maïs ou de manioc, souvent accompagnée de sauce tomate et de légumes. L’<strong>attiéké</strong>, un plat à base de semoule de manioc, et le <strong>poisson braisé</strong> sont également très appréciés. Ces plats sont non seulement des délices pour les papilles, mais ils sont aussi le reflet des traditions culinaires transmises de génération en génération.</p><h3><strong>L\'influence des différentes régions sur la cuisine</strong></h3><p>Les régions du <strong>Bénin</strong> influencent grandement la cuisine du pays. Le <strong>Sud</strong> est réputé pour ses plats de fruits de mer, tandis que le <strong>Nord</strong> privilégie des recettes plus épicées et à base de viandes. Cette diversité régionale contribue à l\'influence des cultures dans chaque coin du pays, créant une cuisine variée qui est le cœur de la <strong>culture béninoise</strong>.</p>', 'contenus/couvertures/TGqtVHWhmnCcj4KZ12mxufd087PV16FnoWO48Ei1.jpg', 6, 4, 1, 1, 1, 'validated', 1, 1, 200.00, NULL, 3, 0, 4, '2025-12-08 20:37:56', '2025-12-08 20:37:26', '2026-01-05 02:22:52'),
(4, 'Les Adja-Fon', 'les-adja-fon-69374622484c3', NULL, '<p>La <strong>cité de Tado</strong>, au Togo actuel, est le berceau des peuples du sud du Bénin d’<strong>origine adja</strong>.</p><p>La migration de ces peuples est associée à une légende selon laquelle la <strong>fille du roi Tado</strong> rencontra un jour une panthère inoffensive (emblème du Bénin), qui lui donna, quelques mois plus tard, <strong>un fils du nom d’Agasu</strong>. Élevé à la cour du royaume, il devint ensuite père de nombreux enfants. L’un d’entre eux, <strong>Adjahuto</strong>, tua le prince héritier et s’enfuit avec le crâne et la lance d’Agasu vers Allada, où il fonda son royaume. Ses fils devinrent aussi rois : Meidji régna sur Allada, Zozérigbé sur Porto-Novo et Do-Aklin sur la région de Bohicon. Le neveu de ce dernier, Houégbadja, créa le royaume d’Abomey. Leurs descendants sont les <strong>Adja, Xwla, Huéda, Ayizo, Mahi et Gun</strong>.</p><p>Mais la branche la plus importante, apparentée aux Adja est celle des Fon, à l’origine du puissant royaume d’Abomey. Les <strong>Fon représentent 39,2% de la population béninoise</strong>. L’importance de ce groupe ethnique est telle que la langue fon est comprise jusqu’au nord du pays.</p>', 'contenus/couvertures/bQMHkpTGzHazBRrwrJU3OFvFV5nYunE7yKN1RbxE.webp', 1, 4, 3, 1, 1, 'validated', 1, 0, NULL, NULL, 3, 0, 4, '2025-12-08 20:42:24', '2025-12-08 20:41:54', '2026-01-07 19:28:06'),
(5, 'Ganvié, l’odyssée de l’eau au cœur du Bénin', 'ganvie-lodyssee-de-leau-au-coeur-du-benin-6949af38b012c', 'Au sud du Bénin, sur les eaux calmes du lac Nokoué, se dresse un spectacle hors du temps : Ganvié. Surnommée la « Venise de l’Afrique », cette cité lacustre est bien plus qu\'une curiosité touristique. C’est un chef-d’œuvre de résilience, d’architecture vernaculaire et une immersion dans une culture où l’homme et l’eau ne font qu\'un', '<p>Au sud du Bénin, sur les eaux calmes du lac Nokoué, se dresse un spectacle hors du temps : Ganvié. Surnommée la « Venise de l’Afrique », cette cité lacustre est bien plus qu\'une curiosité touristique. C’est un chef-d’œuvre de résilience, d’architecture vernaculaire et une immersion dans une culture où l’homme et l’eau ne font qu\'un. 1. Une histoire de liberté : \"Nous sommes sauvés\" L\'origine de Ganvié remonte au XVIIIe siècle. À cette époque, les populations Tofinu fuyaient les razzias esclavagistes du royaume du Dahomey. Les croyances religieuses interdisant aux guerriers Dahoméens de s\'aventurer sur l\'eau, le lac Nokoué devint un refuge sacré. En s\'installant au milieu du lac, les fondateurs baptisèrent leur cité \"Ganvié\", ce qui signifie en langue Fon : \"Nous sommes sauvés\" (ou \"La collectivité est sauvée\"). C’est donc une ville née de la quête de liberté. 2. Une architecture unique au monde Tout à Ganvié repose sur des pilotis. Les maisons, construites en bois de palétuvier ou d\'ébène, sont surmontées de toits de paille ou de tôle. Chaque bâtiment est une prouesse d\'ingénierie artisanale, conçue pour résister à l\'humidité et aux courants. Ici, pas de routes, pas de voitures. La pirogue (la \"vô\") est le prolongement naturel du corps humain. Dès leur plus jeune âge, les enfants apprennent à manier la pagaie avec une dextérité fascinante. 3. Le Marché Flottant : Le cœur battant du lac L\'une des expériences les plus vibrantes à Ganvié est son marché flottant. Dès l\'aube, des centaines de pirogues chargées de denrées colorées (poissons, fruits, légumes, tissus) se pressent. Les échanges se font au fil de l\'eau, dans un ballet incessant de mouvements et de cris joyeux. C’est ici que l’on prend véritablement le pouls de l’économie locale, basée essentiellement sur la pêche.</p>', 'contenus/couvertures/BDjG5CgTwl1biubHKgcs9hudNP3jQ78JvUYLoh1V.webp', 6, 10, 6, 2, 4, 'validated', 1, 0, NULL, NULL, 3, 0, 2, NULL, '2025-12-23 04:51:04', '2026-01-07 19:02:46');

-- --------------------------------------------------------

--
-- Structure de la table `contenu_traductions`
--

CREATE TABLE `contenu_traductions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contenu_id` bigint(20) UNSIGNED NOT NULL,
  `langue_id` bigint(20) UNSIGNED NOT NULL,
  `traduit_par` bigint(20) UNSIGNED DEFAULT NULL,
  `texte` longtext DEFAULT NULL,
  `status` enum('pending','validated','rejected') NOT NULL DEFAULT 'pending',
  `validated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `demande_contributeurs`
--

CREATE TABLE `demande_contributeurs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `motivation` text NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `traite_par` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `demande_roles`
--

CREATE TABLE `demande_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_demande` varchar(255) NOT NULL,
  `motif` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `validated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `demande_roles`
--

INSERT INTO `demande_roles` (`id`, `user_id`, `role_demande`, `motif`, `status`, `validated_by`, `created_at`, `updated_at`) VALUES
(1, 2, 'contributeur', 'Pour contribuer', 'accepted', 1, '2025-12-12 00:57:38', '2025-12-12 03:45:46'),
(2, 2, 'contributeur', 'Pour contribuer', 'accepted', 1, '2025-12-30 23:32:54', '2025-12-30 23:35:30'),
(3, 2, 'contributeur', 'pour contribuer', 'accepted', 1, '2026-01-07 19:54:00', '2026-01-07 19:55:14');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `favoris`
--

CREATE TABLE `favoris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `contenu_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `favoris`
--

INSERT INTO `favoris` (`id`, `user_id`, `contenu_id`, `created_at`, `updated_at`) VALUES
(2, 1, 1, '2025-12-08 03:43:39', '2025-12-08 03:43:39'),
(3, 2, 4, '2025-12-10 08:29:05', '2025-12-10 08:29:05'),
(4, 2, 1, '2025-12-12 00:40:58', '2025-12-12 00:40:58');

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `langues`
--

CREATE TABLE `langues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(10) NOT NULL COMMENT 'Code court de la langue : fon, yor, fr',
  `nom` varchar(255) NOT NULL COMMENT 'Nom complet de la langue',
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `icone` varchar(255) DEFAULT NULL COMMENT 'Chemin de l’icône SVG ou PNG',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `langues`
--

INSERT INTO `langues` (`id`, `code`, `nom`, `description`, `is_active`, `icone`, `created_at`, `updated_at`) VALUES
(1, 'fon', 'Fon', NULL, 1, NULL, '2025-12-07 15:08:56', '2025-12-07 15:08:56'),
(2, 'yor', 'Yoruba', NULL, 1, NULL, '2025-12-07 15:08:56', '2025-12-07 15:08:56'),
(3, 'gou', 'Goun', NULL, 1, NULL, '2025-12-07 15:08:56', '2025-12-07 15:08:56'),
(4, 'bar', 'Bariba', NULL, 1, NULL, '2025-12-07 15:08:56', '2025-12-07 15:08:56'),
(5, 'den', 'Dendi', NULL, 1, NULL, '2025-12-07 15:08:56', '2025-12-07 15:08:56'),
(6, 'fr', 'Français', NULL, 1, NULL, NULL, NULL),
(7, 'an', 'Anglais', NULL, 1, NULL, '2025-12-07 22:31:00', '2025-12-07 22:31:00');

-- --------------------------------------------------------

--
-- Structure de la table `medias`
--

CREATE TABLE `medias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contenu_id` bigint(20) UNSIGNED NOT NULL,
  `type_media_id` bigint(20) UNSIGNED NOT NULL,
  `langue_id` bigint(20) UNSIGNED DEFAULT NULL,
  `titre` varchar(255) DEFAULT NULL COMMENT 'Titre du média',
  `description` text DEFAULT NULL,
  `fichier` varchar(255) NOT NULL COMMENT 'Chemin du fichier dans storage',
  `extension` varchar(10) DEFAULT NULL,
  `taille` int(11) DEFAULT NULL COMMENT 'Taille du fichier en KB',
  `uploaded_by` bigint(20) UNSIGNED NOT NULL,
  `validated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('pending','validated','rejected') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `medias`
--

INSERT INTO `medias` (`id`, `contenu_id`, `type_media_id`, `langue_id`, `titre`, `description`, `fichier`, `extension`, `taille`, `uploaded_by`, `validated_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 6, 'Les cultures du Bénin : Un patrimoine exceptionnel', NULL, 'medias/ASEovpz31PjJkmS7CU2eXlGjeGLh00tHpZqt02HF.mp4', 'mp4', 9557, 1, 1, 'validated', '2025-12-07 22:48:47', '2025-12-07 23:35:12'),
(2, 3, 1, 6, 'La gastronomie Béninoise : Un mélange de saveurs et de traditions', NULL, 'medias/dni83fdeBZxQO0jeHNskFHxTknhsUCmRfQ0isuXG.webp', 'webp', 19, 1, 1, 'validated', '2025-12-08 20:39:28', '2025-12-08 20:39:38');

-- --------------------------------------------------------

--
-- Structure de la table `message_contacts`
--

CREATE TABLE `message_contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `message_contacts`
--

INSERT INTO `message_contacts` (`id`, `name`, `email`, `message`, `created_at`, `updated_at`) VALUES
(1, 'Emma', 'koutchikaharahel095@gmail.com', 'COMMENT COLLABORER?', '2025-12-12 16:15:11', '2025-12-12 16:15:11');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_11_26_224213_create_permission_tables', 1),
(5, '2025_11_27_004503_create_langues_table', 1),
(6, '2025_11_27_015503_create_regions_table', 1),
(7, '2025_11_27_161404_create_typecontenus_table', 1),
(8, '2025_11_27_163920_create_typemedias_table', 1),
(9, '2025_11_27_171934_create_contenus_table', 1),
(10, '2025_11_27_174244_create_traductions_table', 1),
(11, '2025_11_27_234225_demande_contributeurs', 1),
(12, '2025_11_28_183108_create_medias_table', 1),
(13, '2025_11_29_155518_create_commentaires_table', 1),
(14, '2025_12_02_143319_create_paiements_table', 1),
(15, '2025_12_06_071220_create_favoris_table', 1),
(16, '2025_12_07_182452_create_message_contact_table', 2),
(17, '2025_12_08_192720_create_demande_roles_table', 2),
(18, '2026_01_05_161048_add_last_login_at_to_users_table', 3);

-- --------------------------------------------------------

--
-- Structure de la table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 3),
(2, 'App\\Models\\User', 4),
(3, 'App\\Models\\User', 2),
(4, 'App\\Models\\User', 2);

-- --------------------------------------------------------

--
-- Structure de la table `paiements`
--

CREATE TABLE `paiements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reference` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `contenu_id` bigint(20) UNSIGNED NOT NULL,
  `montant` decimal(10,2) NOT NULL,
  `devise` varchar(10) NOT NULL DEFAULT 'XOF',
  `gateway` enum('fedapay','kkiapay') NOT NULL COMMENT 'Passerelle de paiement utilisée',
  `statut` enum('en_attente','paye','echec','annule') NOT NULL DEFAULT 'en_attente',
  `paye_le` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `paiements`
--

INSERT INTO `paiements` (`id`, `reference`, `user_id`, `contenu_id`, `montant`, `devise`, `gateway`, `statut`, `paye_le`, `created_at`, `updated_at`) VALUES
(1, 'aW9XkgJ7T', 2, 2, 100.00, 'XOF', 'kkiapay', 'paye', '2025-12-08 09:47:26', '2025-12-08 09:47:26', '2025-12-08 09:47:26');

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('harahelkoutchika@gmail.com', '$2y$12$BE9ro3KWppelit5L0Y6H5uWxFnjk/jzN.9IXRp.0YBtUTSb1J8Jau', '2025-12-21 20:36:33');

-- --------------------------------------------------------

--
-- Structure de la table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'voir-contenus', 'web', '2025-12-07 15:08:42', '2025-12-07 15:08:42'),
(2, 'commenter', 'web', '2025-12-07 15:08:42', '2025-12-07 15:08:42'),
(3, 'noter', 'web', '2025-12-07 15:08:42', '2025-12-07 15:08:42'),
(4, 'favoris', 'web', '2025-12-07 15:08:42', '2025-12-07 15:08:42'),
(5, 'creer-contenu', 'web', '2025-12-07 15:08:42', '2025-12-07 15:08:42'),
(6, 'modifier-contenu', 'web', '2025-12-07 15:08:42', '2025-12-07 15:08:42'),
(7, 'supprimer-contenu', 'web', '2025-12-07 15:08:42', '2025-12-07 15:08:42'),
(8, 'uploader-media', 'web', '2025-12-07 15:08:42', '2025-12-07 15:08:42'),
(9, 'supprimer-media', 'web', '2025-12-07 15:08:42', '2025-12-07 15:08:42'),
(10, 'proposer-traduction', 'web', '2025-12-07 15:08:42', '2025-12-07 15:08:42'),
(11, 'valider-contenu', 'web', '2025-12-07 15:08:42', '2025-12-07 15:08:42'),
(12, 'rejeter-contenu', 'web', '2025-12-07 15:08:42', '2025-12-07 15:08:42'),
(13, 'valider-media', 'web', '2025-12-07 15:08:42', '2025-12-07 15:08:42'),
(14, 'rejeter-media', 'web', '2025-12-07 15:08:42', '2025-12-07 15:08:42'),
(15, 'valider-commentaire', 'web', '2025-12-07 15:08:42', '2025-12-07 15:08:42'),
(16, 'rejeter-commentaire', 'web', '2025-12-07 15:08:42', '2025-12-07 15:08:42'),
(17, 'valider-traduction', 'web', '2025-12-07 15:08:42', '2025-12-07 15:08:42'),
(18, 'rejeter-traduction', 'web', '2025-12-07 15:08:42', '2025-12-07 15:08:42'),
(19, 'gerer-langues', 'web', '2025-12-07 15:08:42', '2025-12-07 15:08:42'),
(20, 'gerer-regions', 'web', '2025-12-07 15:08:42', '2025-12-07 15:08:42'),
(21, 'gerer-typecontenu', 'web', '2025-12-07 15:08:42', '2025-12-07 15:08:42'),
(22, 'gerer-typemedia', 'web', '2025-12-07 15:08:42', '2025-12-07 15:08:42'),
(23, 'gerer-users', 'web', '2025-12-07 15:08:42', '2025-12-07 15:08:42'),
(24, 'gerer-paiements', 'web', '2025-12-07 15:08:42', '2025-12-07 15:08:42');

-- --------------------------------------------------------

--
-- Structure de la table `regions`
--

CREATE TABLE `regions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `langue_principale_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `regions`
--

INSERT INTO `regions` (`id`, `nom`, `type`, `description`, `langue_principale_id`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Atacora', 'Département', NULL, NULL, 1, '2025-12-07 15:18:06', '2025-12-07 15:18:06'),
(2, 'Donga', 'Département', NULL, NULL, 1, '2025-12-07 15:18:06', '2025-12-07 15:18:06'),
(3, 'Zou', 'Département', NULL, NULL, 1, '2025-12-07 15:18:06', '2025-12-07 15:18:06'),
(4, 'Mono', 'Département', NULL, NULL, 1, '2025-12-07 15:18:06', '2025-12-07 15:18:06'),
(5, 'Collines', 'Département', NULL, NULL, 1, '2025-12-07 15:18:06', '2025-12-07 15:18:06'),
(6, 'Atlantique', 'Département', NULL, NULL, 1, '2025-12-23 04:45:28', '2025-12-23 04:45:28'),
(7, 'Borgou', 'Département', NULL, NULL, 1, '2025-12-23 04:46:04', '2025-12-23 04:46:04'),
(8, 'Ouémé', 'Département', NULL, NULL, 1, '2025-12-23 04:46:36', '2025-12-23 04:46:36'),
(9, 'Littoral', 'Département', NULL, NULL, 1, '2025-12-23 04:46:55', '2025-12-23 04:46:55'),
(10, 'Ganvié', 'Village', NULL, NULL, 1, '2025-12-23 04:47:12', '2025-12-23 04:47:12'),
(11, 'Alibori', 'Département', NULL, NULL, 1, '2025-12-23 04:47:30', '2025-12-23 04:47:30');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2025-12-07 15:08:42', '2025-12-07 15:08:42'),
(2, 'moderateur', 'web', '2025-12-07 15:08:42', '2025-12-07 15:08:42'),
(3, 'contributeur', 'web', '2025-12-07 15:08:42', '2025-12-07 15:08:42'),
(4, 'lecteur', 'web', '2025-12-07 15:08:42', '2025-12-07 15:08:42');

-- --------------------------------------------------------

--
-- Structure de la table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 1),
(2, 3),
(2, 4),
(3, 1),
(3, 3),
(3, 4),
(4, 1),
(4, 3),
(4, 4),
(5, 1),
(5, 3),
(6, 1),
(6, 3),
(7, 1),
(7, 3),
(8, 1),
(8, 3),
(9, 1),
(9, 3),
(10, 1),
(10, 3),
(11, 1),
(11, 2),
(12, 1),
(12, 2),
(13, 1),
(13, 2),
(14, 1),
(14, 2),
(15, 1),
(15, 2),
(16, 1),
(16, 2),
(17, 1),
(17, 2),
(18, 1),
(18, 2),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1);

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('1emQRop4jNsRXA6Am6ZxglYuj8SrNjfHHC3jFV3i', NULL, '66.249.93.71', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRXd6ZklKU3hRZUx3VnJYTlA4MHRvdkZTcnROcUl5OHVORG10RlhGWiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo2MzoiaHR0cHM6Ly9iZW5pbmN1bHR1cmUuaW5maW5pdHlmcmVlYXBwLmNvbS9jb250cmlidXRldXIvZGFzaGJvYXJkIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NjM6Imh0dHBzOi8vYmVuaW5jdWx0dXJlLmluZmluaXR5ZnJlZWFwcC5jb20vY29udHJpYnV0ZXVyL2Rhc2hib2FyZCI7czo1OiJyb3V0ZSI7czoyMjoiY29udHJpYnV0ZXVyLmRhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1767551274),
('2JACv4fp8yrCz3XG9e7Fugxaa4uZgNbwrMREJRP6', NULL, '196.49.8.196', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiT0FwdVd0R1l3VlJ2VzJJU0d1cVM4R1BSNVZrRlo2ekhFWUxGR0Y3eSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTA6Imh0dHBzOi8vYmVuaW5jdWx0dXJlLmluZmluaXR5ZnJlZWFwcC5jb20vbG9naW4/aT0xIjtzOjU6InJvdXRlIjtzOjU6ImxvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1767104719),
('2JhBoPJbyA8cbDAQRaNMhIN6Q76DPpIjmryqlWpd', NULL, '66.249.93.71', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNWFUSFNzbkV1QWFBbmZ6cHNQVGR3cm14WWFZNzRlWEZxQ1VXRnFzZyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDY6Imh0dHBzOi8vYmVuaW5jdWx0dXJlLmluZmluaXR5ZnJlZWFwcC5jb20vbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1767551313),
('6Ma5QlcNOcAg7UrACQFQfkMMveieSTSIzzZcUURc', NULL, '66.249.93.72', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaVlUTWxJb1kydjYwM1pNa09Na2ZkejBMUXF1NWhtbGVxc2RHZ3pNYSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDY6Imh0dHBzOi8vYmVuaW5jdWx0dXJlLmluZmluaXR5ZnJlZWFwcC5jb20vbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1767108799),
('6uCT9WsxH5ZOseSjP5tfNDdV7ytwWBtCUFuvqlqH', NULL, '66.249.93.71', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSXlyVjV1aWJGQWJBWGRySWt0MURydHJkZXNrSVpvQUdXZWxqNXlsMCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDY6Imh0dHBzOi8vYmVuaW5jdWx0dXJlLmluZmluaXR5ZnJlZWFwcC5jb20vbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1767108287),
('7ay3Eokhvy8rsYlDVW9eeLeNV1VW7b239FhXr5d2', 2, '137.255.26.0', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMU1iNmRadEtCdVFJWldhdllPOENnWFVnSE9pdzEzaWNPbldQVkJ6SiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHBzOi8vYmVuaW5jdWx0dXJlLmluZmluaXR5ZnJlZWFwcC5jb20iO3M6NToicm91dGUiO3M6MTA6ImZyb250LmhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=', 1767476443),
('Ayp5cYmJ6dpQbMlAd8JoT9f8uT80jTJP5j51yTiS', 2, '137.255.26.0', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTTJCRUZkWmpnT3JRV3RLU1BNdmZIbG5adW80a2tBVG5ZR0szZm01UCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NjM6Imh0dHBzOi8vYmVuaW5jdWx0dXJlLmluZmluaXR5ZnJlZWFwcC5jb20vcmVjaGVyY2hlP3E9Q3VsdHVyZSUyMCI7czo1OiJyb3V0ZSI7czoxMjoiZnJvbnQuc2VhcmNoIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1767551523),
('ayQzT13B24733A0FNdW0F15rVVk55Zl4fyPskGtu', NULL, '66.249.93.70', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNm1LaHpQRWxKbTloZEVaNkhaVkNtWnZLMVBrdWlkQUpUUkRiMHdkaSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo1ODoiaHR0cHM6Ly9iZW5pbmN1bHR1cmUuaW5maW5pdHlmcmVlYXBwLmNvbS9hZG1pbi90cmFkdWN0aW9ucyI7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjU4OiJodHRwczovL2JlbmluY3VsdHVyZS5pbmZpbml0eWZyZWVhcHAuY29tL2FkbWluL3RyYWR1Y3Rpb25zIjtzOjU6InJvdXRlIjtzOjIzOiJhZG1pbi50cmFkdWN0aW9ucy5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1767108117),
('b3sQipcChEHDvWq37fZ8Ss5lvaFwQhqMUcD06Uvs', NULL, '66.249.93.71', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQXJsV3NLeVc2NkR0SjJGQzVEOUJ2ZXFYTDBHcVZqVmhpd0E3WThFRSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDY6Imh0dHBzOi8vYmVuaW5jdWx0dXJlLmluZmluaXR5ZnJlZWFwcC5jb20vbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1767109100),
('bF8NboLTxAJIQwtmNcVfQpJnyNPLHXRI31kZNZlX', NULL, '66.249.83.103', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTzBzWVgzZ0QycllOZ25uOEZ2N1FHdk5rRTJJemFZSXQ4enlYVTN5eCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDY6Imh0dHBzOi8vYmVuaW5jdWx0dXJlLmluZmluaXR5ZnJlZWFwcC5jb20vbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1767476148),
('cf4l1DxO25K5cBIJcJh7lGfgnaGrJjoK65DT6n3X', NULL, '66.249.93.72', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiT0EyZUxZVnp6eTBkaVNFcUo3YjhGVllEbjdCRXdNbmhrVXk4TkxhVCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo1NzoiaHR0cHM6Ly9iZW5pbmN1bHR1cmUuaW5maW5pdHlmcmVlYXBwLmNvbS9hZG1pbi90eXBlbWVkaWFzIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTc6Imh0dHBzOi8vYmVuaW5jdWx0dXJlLmluZmluaXR5ZnJlZWFwcC5jb20vYWRtaW4vdHlwZW1lZGlhcyI7czo1OiJyb3V0ZSI7czoyMjoiYWRtaW4udHlwZW1lZGlhcy5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1767108286),
('cKYmWk7bC9r0QByR7h6AX7QawreH0RKl0iYpc5Nd', NULL, '66.249.93.70', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRTdWTWZRS0hWYUdTRUZhaXd0elN5WHJHTHpVUUhnNlo1VDVQQW15ciI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo1NToiaHR0cHM6Ly9iZW5pbmN1bHR1cmUuaW5maW5pdHlmcmVlYXBwLmNvbS9hZG1pbi9jb250ZW51cyI7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjU1OiJodHRwczovL2JlbmluY3VsdHVyZS5pbmZpbml0eWZyZWVhcHAuY29tL2FkbWluL2NvbnRlbnVzIjtzOjU6InJvdXRlIjtzOjIwOiJhZG1pbi5jb250ZW51cy5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1767108027),
('CNH6OKZiJY2ImW6XuM6JIh5722Z6hjzJAfe8XtP6', NULL, '66.249.93.71', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ29XQU5YQ3AydjJWMUFVWWVDWXhCNXl2TUliaDdsa1VRVmt5VUp5ayI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDY6Imh0dHBzOi8vYmVuaW5jdWx0dXJlLmluZmluaXR5ZnJlZWFwcC5jb20vbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1767108192),
('fFr3tyIrZomxTfBHUfObyMhUZy6epxAOYNCoTDYV', NULL, '196.49.8.196', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Mobile Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZmtHMGU2ejlLbnFLQXpQc0tpd1E5Z1VJRkJBdll1S3VkWGQ0cWVhZyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo1ODoiaHR0cHM6Ly9iZW5pbmN1bHR1cmUuaW5maW5pdHlmcmVlYXBwLmNvbS9hZG1pbi9yZWdpb25zP2k9MSI7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjQ2OiJodHRwczovL2JlbmluY3VsdHVyZS5pbmZpbml0eWZyZWVhcHAuY29tL2xvZ2luIjtzOjU6InJvdXRlIjtzOjU6ImxvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1767108210),
('hofQ1kMSTV8hStd2AVMSKpzTBxbvQXnFKA6tOCST', NULL, '196.49.8.196', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTUVTUE1qVUlvcVJya2xEcEdwMFFrSmxvS29PdkVpRnlzdUxHbU5QRSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHBzOi8vYmVuaW5jdWx0dXJlLmluZmluaXR5ZnJlZWFwcC5jb20vP2k9MSI7czo1OiJyb3V0ZSI7czoxMDoiZnJvbnQuaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1767107733),
('Ka1VB2BW6JnpQ0tIQj3Iy2Y5S4lJjJZEJinKRGOn', NULL, '66.249.93.72', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVVpheE40MUFRWXlqdDRHb3lLMWRCaWlXTnM1bzQ3UjJUeWM5QUR3WSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDY6Imh0dHBzOi8vYmVuaW5jdWx0dXJlLmluZmluaXR5ZnJlZWFwcC5jb20vbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1767551274),
('KFMUYxnrNFFcYZsD80lYsMDIvvBvRPv3TE2PcBLj', NULL, '66.249.93.72', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiV1M3eWxFSUQ1UGJrcjdRbFNrUU1Fdzh3R3lIQldhc2FVQlNaNlV1bSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo2OToiaHR0cHM6Ly9iZW5pbmN1bHR1cmUuaW5maW5pdHlmcmVlYXBwLmNvbS9jb250cmlidXRldXIvY29udGVudXMvY3JlYXRlIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Njk6Imh0dHBzOi8vYmVuaW5jdWx0dXJlLmluZmluaXR5ZnJlZWFwcC5jb20vY29udHJpYnV0ZXVyL2NvbnRlbnVzL2NyZWF0ZSI7czo1OiJyb3V0ZSI7czoyODoiY29udHJpYnV0ZXVyLmNvbnRlbnVzLmNyZWF0ZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1767109099),
('KFyf9JY8Fjzu6R5sh2kQE5rsy47XI4gTaubiJnCo', NULL, '66.249.83.102', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU3ZWV3E0eGJGUW1MMzZCbmdzNEh3UXpJRnBnWXkzak9kU1AyQ1BpUSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDk6Imh0dHBzOi8vYmVuaW5jdWx0dXJlLmluZmluaXR5ZnJlZWFwcC5jb20vY29udGVudXMiO3M6NToicm91dGUiO3M6MjA6ImZyb250LmNvbnRlbnVzLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1767550778),
('kHNSWXw8QCHMV9d9SkzF0EmYypAXWN6ioqNZfDnu', NULL, '196.49.8.198', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieW5CSjNYM1RLekpkWXIxeXVIN053MG1GejU5V1VienlBb3cxZjZVNCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTA6Imh0dHBzOi8vYmVuaW5jdWx0dXJlLmluZmluaXR5ZnJlZWFwcC5jb20vbG9naW4/aT0xIjtzOjU6InJvdXRlIjtzOjU6ImxvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1767476159),
('lzbxlFfjjDVUPzReAMHlMOSJ2lkX8jdcPX9U8U3o', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTUVkYmpzTzNFZllIMnpnOE0wQWk4ZVNTZ2N4UWp3MUVXWDRYNDRWMiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czoxMDoiZnJvbnQuaG9tZSI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1768248169),
('mecE23zldMRRYzKOzLsqzw3LEm0wRZuYzkcPA3fM', 1, '137.255.31.125', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiMk42RTVoeUhUN29FMEljem1xYU1yZmJXaWdXSUEzUDNJeVhpRVVwYiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo1NToiaHR0cDovL2JlbmluY3VsdHVyZS5pbmZpbml0eWZyZWVhcHAuY29tL2FkbWluL3VzZXJzP2k9MSI7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjUxOiJodHRwOi8vYmVuaW5jdWx0dXJlLmluZmluaXR5ZnJlZWFwcC5jb20vYWRtaW4vdXNlcnMiO3M6NToicm91dGUiO3M6MTc6ImFkbWluLnVzZXJzLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1767628920),
('mpWktyD575fMRNcMF4z4BQPNaIdzWrb0ht4DZqI5', NULL, '196.49.8.198', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Mobile Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiS1p6Nzd1UGJ2dUM3U3RuNDVPU3k1SWlJcmZZclFjWWs4QjJ4amM5YiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo1OToiaHR0cHM6Ly9iZW5pbmN1bHR1cmUuaW5maW5pdHlmcmVlYXBwLmNvbS9hZG1pbi9jb250ZW51cz9pPTEiO31zOjk6Il9wcmV2aW91cyI7YToyOntzOjM6InVybCI7czo0NjoiaHR0cHM6Ly9iZW5pbmN1bHR1cmUuaW5maW5pdHlmcmVlYXBwLmNvbS9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1767108032),
('Nc6vLgpDDL3RHL1m8zqxr0hD5HqZBxI17yPHr6R0', NULL, '66.249.83.103', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMzZYWGZZTEV2Rk5ZUFhmaVV1ZVkwbHd0UjZjeTllUUFmU3ZSRXkzQyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo2MzoiaHR0cHM6Ly9iZW5pbmN1bHR1cmUuaW5maW5pdHlmcmVlYXBwLmNvbS9jb250cmlidXRldXIvZGFzaGJvYXJkIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NjM6Imh0dHBzOi8vYmVuaW5jdWx0dXJlLmluZmluaXR5ZnJlZWFwcC5jb20vY29udHJpYnV0ZXVyL2Rhc2hib2FyZCI7czo1OiJyb3V0ZSI7czoyMjoiY29udHJpYnV0ZXVyLmRhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1767476147),
('O009jZ1AIgSPMZMyUnHYvXoWnNeUbToAWgjBgPs2', NULL, '66.249.93.70', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTGhUYnpaYnU5Mk53RllZbGRCV1Y2dHJMY0JhMTFqeTVsUmVGbG1FYiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo2NDoiaHR0cHM6Ly9iZW5pbmN1bHR1cmUuaW5maW5pdHlmcmVlYXBwLmNvbS9jb250cmlidXRldXIvY29udGVudXMvNSI7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjY0OiJodHRwczovL2JlbmluY3VsdHVyZS5pbmZpbml0eWZyZWVhcHAuY29tL2NvbnRyaWJ1dGV1ci9jb250ZW51cy81IjtzOjU6InJvdXRlIjtzOjI2OiJjb250cmlidXRldXIuY29udGVudXMuc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1767551313),
('RcKGFrNzsgBfuuMzDi19fggPvyaWiRgSYZNmJwXw', NULL, '66.249.93.70', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRm5HU0lXWUZZT3RneExRMHprM00xOXZFZ1JiZHg5Tkl2Rkx6Nk1ZYiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo1NDoiaHR0cHM6Ly9iZW5pbmN1bHR1cmUuaW5maW5pdHlmcmVlYXBwLmNvbS9hZG1pbi9yZWdpb25zIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTQ6Imh0dHBzOi8vYmVuaW5jdWx0dXJlLmluZmluaXR5ZnJlZWFwcC5jb20vYWRtaW4vcmVnaW9ucyI7czo1OiJyb3V0ZSI7czoxOToiYWRtaW4ucmVnaW9ucy5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1767108191),
('s9aZKD2xgOdrQQAMlP3lwVpUnEmSiMdE5n9eZTkb', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicXU2MjU2ZTNYMFppdTlRTTlFckRGRjZ5M0JmZnRNUW5pM2FwTG9kayI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czoxMDoiZnJvbnQuaG9tZSI7fX0=', 1767819354),
('Sm8QsH59CFkQPgpZ9OKDrBHBTgr0I1SMveEIlaAA', 2, '41.79.219.156', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMTF1aWpkN2RnOWJQS09QbG1RTlEyZzE2RkVjTkJYWFNhbkpjaXlHbyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NjM6Imh0dHBzOi8vYmVuaW5jdWx0dXJlLmluZmluaXR5ZnJlZWFwcC5jb20vY29udHJpYnV0ZXVyL2Rhc2hib2FyZCI7czo1OiJyb3V0ZSI7czoyMjoiY29udHJpYnV0ZXVyLmRhc2hib2FyZCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1767109119),
('ttEAtTpTnwPPypIXMeuTeRgOkLhIok4eqeMK31Hi', NULL, '196.49.8.196', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQnZyM2ZURlNIYmtHRzVSUHBtZDRNbWZXbUtuOGdnd0g3TnpCZ2lEcyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHBzOi8vYmVuaW5jdWx0dXJlLmluZmluaXR5ZnJlZWFwcC5jb20vP2k9MiI7czo1OiJyb3V0ZSI7czoxMDoiZnJvbnQuaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1767476136),
('U9T8VeihsSupbkHDJdOHw62EoIwftoeWqcYScYz3', NULL, '66.249.93.70', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicHhxamdhUGJER2w2S2pjSENrVFBRU0pnVk0yWThxeDlCQmVpT2RNVyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDY6Imh0dHBzOi8vYmVuaW5jdWx0dXJlLmluZmluaXR5ZnJlZWFwcC5jb20vbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1767108027),
('uclexfUZ8VrJXXZZWshSMKQQ1Xi2I75CeVFuCz5F', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUXBoajAxT0VXWndaSzNhQlNMS1djbWw4OU9KVlBJMUJYVjV0aDBzMSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7czo1OiJyb3V0ZSI7czoxMDoiZnJvbnQuaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1767815498),
('UXZPCiBFgPX6mM4M8nMmzpVTXtuOLUXyW76F7hwp', NULL, '66.249.93.71', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiR0hSZDJvZ3BFOWpGOWh3ajFsVkowd0dPaU02eUFNMldwTmxGdmZjcSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo1NToiaHR0cHM6Ly9iZW5pbmN1bHR1cmUuaW5maW5pdHlmcmVlYXBwLmNvbS9hZG1pbi9kZW1hbmRlcyI7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjU1OiJodHRwczovL2JlbmluY3VsdHVyZS5pbmZpbml0eWZyZWVhcHAuY29tL2FkbWluL2RlbWFuZGVzIjtzOjU6InJvdXRlIjtzOjIwOiJhZG1pbi5kZW1hbmRlcy5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1767108799),
('vBnTN3xPBU7aUQDRG0ynE2OAPEXjildKgygR5DGL', NULL, '66.249.93.70', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidGRSZEJQTnZCT1VJN210QVVpM1lrdWFUMnJiRG1kc2haYXhPNFM2WSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDY6Imh0dHBzOi8vYmVuaW5jdWx0dXJlLmluZmluaXR5ZnJlZWFwcC5jb20vbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1767108117),
('WNPPQsYmxYVaGVsj2pu4C4MrsL8wCRIulF3YBc3Z', 1, '137.255.26.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYnlTVGw3TW5YNmNNelI2ejVRWjF1NGxMSTVmV3lEVGliUnJvUFFzZCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDc6Imh0dHA6Ly9iZW5pbmN1bHR1cmUuaW5maW5pdHlmcmVlYXBwLmNvbS9jb250YWN0IjtzOjU6InJvdXRlIjtzOjEzOiJmcm9udC5jb250YWN0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1767551948),
('xfSyveAbTroNhJNARhCnydOT0HT0pv1hF6BfXrCA', NULL, '66.249.83.102', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoic3d0Qm1FQTNJZGZhM0tReThEcGhMTzJhbGVFbWRxd3JTd3lvcTE5NyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDk6Imh0dHBzOi8vYmVuaW5jdWx0dXJlLmluZmluaXR5ZnJlZWFwcC5jb20vY29udGVudXMiO3M6NToicm91dGUiO3M6MjA6ImZyb250LmNvbnRlbnVzLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1767550777),
('yJEVpQtWrKQ6fGWt4l6KwBlPLdBg51PvJslVuYTu', NULL, '66.249.83.102', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoienBlTk9TR2ZoaWRQc0NDMmg3SHVpYWNyR0Z5N1BqRzh6UldHZEhmUSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDk6Imh0dHBzOi8vYmVuaW5jdWx0dXJlLmluZmluaXR5ZnJlZWFwcC5jb20vY29udGVudXMiO3M6NToicm91dGUiO3M6MjA6ImZyb250LmNvbnRlbnVzLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1767550778),
('ZNDGnDx3Zt94AA0z5qBuvDgB1Ph7EzufUQm0rT9a', NULL, '196.49.8.198', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Mobile Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiS2Z2NlAwV0JuRDlIZEVoanFpZmtmWWtkRGdCMkpSVUNnRmFMcVVlViI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo1NDoiaHR0cHM6Ly9iZW5pbmN1bHR1cmUuaW5maW5pdHlmcmVlYXBwLmNvbS9wcm9maWw/Mj0maT0xIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDY6Imh0dHBzOi8vYmVuaW5jdWx0dXJlLmluZmluaXR5ZnJlZWFwcC5jb20vbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1767108796);

-- --------------------------------------------------------

--
-- Structure de la table `typecontenus`
--

CREATE TABLE `typecontenus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL COMMENT 'Nom du type de contenu : conte, musique, histoire, art…',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `typecontenus`
--

INSERT INTO `typecontenus` (`id`, `nom`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Recette', 1, '2025-12-07 19:15:01', '2025-12-07 19:15:01'),
(2, 'Savoir', 1, '2025-12-07 19:15:22', '2025-12-07 19:15:22'),
(3, 'Histoire', 1, '2025-12-07 19:15:51', '2025-12-07 19:15:51'),
(4, 'Pratique', 1, '2025-12-07 19:16:08', '2025-12-07 19:16:08'),
(5, 'Tutoriel', 1, '2025-12-07 19:16:29', '2025-12-07 19:16:29'),
(6, 'Article', 1, '2025-12-07 19:16:45', '2025-12-07 19:16:45');

-- --------------------------------------------------------

--
-- Structure de la table `typemedias`
--

CREATE TABLE `typemedias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL COMMENT 'image, video, audio',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `typemedias`
--

INSERT INTO `typemedias` (`id`, `nom`, `created_at`, `updated_at`) VALUES
(1, 'image', '2025-12-07 19:18:00', '2025-12-07 19:18:00'),
(2, 'video', '2025-12-07 19:18:21', '2025-12-07 19:18:21'),
(3, 'audio', '2025-12-07 19:18:54', '2025-12-07 19:18:54');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `last_login_ip` varchar(45) DEFAULT NULL,
  `last_login_user_agent` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `adresse`, `email_verified_at`, `password`, `avatar`, `phone`, `bio`, `is_active`, `is_admin`, `remember_token`, `created_at`, `updated_at`, `last_login_at`, `last_login_ip`, `last_login_user_agent`) VALUES
(1, 'Harahel', 'admin', 'harahelkoutchika@gmail.com', NULL, NULL, '$2y$12$.EVj/ePYUMiMAxmX5ODmhOlqaUu6wmM1qe8kAslhqz2dAQ36Jojyq', 'avatars/Ngq8wxXCDekSre3mIqD1exH2EW2oVeZTcXpPpLPh.jpg', NULL, NULL, 1, 1, NULL, '2025-12-07 18:21:54', '2026-01-12 18:40:21', '2026-01-12 18:40:21', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0'),
(2, 'KOUTCHIKA', 'Emma', 'koutchikaharahel095@gmail.com', 'Cotonou, Bénin', NULL, '$2y$12$xmXn7MONmh7IoQBQIX69DOQ.nn51infq7TESVVI1A6VdVKWeVooxK', 'avatars/DYmneemwj0qjcjYj37WeIaAXkadB7fIsZXEW05xN.png', '0190861710', 'Passionner de culture', 1, 0, NULL, '2025-12-07 19:23:30', '2026-01-07 19:45:51', NULL, NULL, NULL),
(3, 'COMLAN Maurice', 'AdminMaurice', 'maurice.comlan@uac.bj', 'Cotonou, Bénin', NULL, '$2y$12$Zp3gC.1aKFLO.h/dZcT.9.d3WZ4i7szGo6qXnZuPxM0THn5iZ5D42', 'avatars/S5tS6Uw01vSpC4y74Z6DauyVw4c05c8brtXYscIh.jpg', '+2290195340236', 'Super Admin', 1, 0, NULL, '2025-12-08 21:27:27', '2025-12-08 21:27:27', NULL, NULL, NULL),
(4, 'WLOGAN iris', 'Iris204', 'irisgrace905@gmail.com', 'Cotonou, Bénin', NULL, '$2y$12$7i8NY.mQolRVCVt.uFpQv.AgyFbH6bS0Wllv46mwynUIpbj0TGFm6', 'avatars/6tv7nmXVsEOi5v88nzHnBDVDWzb3pZoB2hoG7o4B.jpg', '+2290190861710', 'modératrice', 1, 0, NULL, '2025-12-23 04:21:46', '2026-01-07 19:38:51', NULL, NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `commentaires_contenu_id_foreign` (`contenu_id`),
  ADD KEY `commentaires_user_id_foreign` (`user_id`),
  ADD KEY `commentaires_statut_created_at_index` (`statut`,`created_at`);

--
-- Index pour la table `contenus`
--
ALTER TABLE `contenus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `contenus_slug_unique` (`slug`),
  ADD KEY `contenus_langue_id_foreign` (`langue_id`),
  ADD KEY `contenus_region_id_foreign` (`region_id`),
  ADD KEY `contenus_typecontenu_id_foreign` (`typecontenu_id`),
  ADD KEY `contenus_user_id_foreign` (`user_id`),
  ADD KEY `contenus_validated_by_foreign` (`validated_by`);

--
-- Index pour la table `contenu_traductions`
--
ALTER TABLE `contenu_traductions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contenu_traductions_contenu_id_foreign` (`contenu_id`),
  ADD KEY `contenu_traductions_langue_id_foreign` (`langue_id`),
  ADD KEY `contenu_traductions_traduit_par_foreign` (`traduit_par`),
  ADD KEY `contenu_traductions_validated_by_foreign` (`validated_by`);

--
-- Index pour la table `demande_contributeurs`
--
ALTER TABLE `demande_contributeurs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `demande_contributeurs_user_id_foreign` (`user_id`),
  ADD KEY `demande_contributeurs_traite_par_foreign` (`traite_par`);

--
-- Index pour la table `demande_roles`
--
ALTER TABLE `demande_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `demande_roles_user_id_foreign` (`user_id`),
  ADD KEY `demande_roles_validated_by_foreign` (`validated_by`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `favoris`
--
ALTER TABLE `favoris`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `favoris_user_id_contenu_id_unique` (`user_id`,`contenu_id`),
  ADD KEY `favoris_contenu_id_foreign` (`contenu_id`);

--
-- Index pour la table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Index pour la table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `langues`
--
ALTER TABLE `langues`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `langues_code_unique` (`code`),
  ADD UNIQUE KEY `langues_nom_unique` (`nom`),
  ADD KEY `langues_nom_index` (`nom`),
  ADD KEY `langues_is_active_index` (`is_active`);

--
-- Index pour la table `medias`
--
ALTER TABLE `medias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medias_contenu_id_foreign` (`contenu_id`),
  ADD KEY `medias_type_media_id_foreign` (`type_media_id`),
  ADD KEY `medias_langue_id_foreign` (`langue_id`),
  ADD KEY `medias_uploaded_by_foreign` (`uploaded_by`),
  ADD KEY `medias_validated_by_foreign` (`validated_by`),
  ADD KEY `medias_status_index` (`status`);

--
-- Index pour la table `message_contacts`
--
ALTER TABLE `message_contacts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Index pour la table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Index pour la table `paiements`
--
ALTER TABLE `paiements`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `paiements_reference_unique` (`reference`),
  ADD KEY `paiements_contenu_id_foreign` (`contenu_id`),
  ADD KEY `paiements_user_id_contenu_id_index` (`user_id`,`contenu_id`),
  ADD KEY `paiements_statut_index` (`statut`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Index pour la table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `regions_nom_unique` (`nom`),
  ADD KEY `regions_langue_principale_id_foreign` (`langue_principale_id`),
  ADD KEY `regions_is_active_index` (`is_active`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Index pour la table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Index pour la table `typecontenus`
--
ALTER TABLE `typecontenus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `typecontenus_nom_unique` (`nom`),
  ADD KEY `typecontenus_nom_index` (`nom`);

--
-- Index pour la table `typemedias`
--
ALTER TABLE `typemedias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `typemedias_nom_unique` (`nom`),
  ADD KEY `typemedias_nom_index` (`nom`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `contenus`
--
ALTER TABLE `contenus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `contenu_traductions`
--
ALTER TABLE `contenu_traductions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `demande_contributeurs`
--
ALTER TABLE `demande_contributeurs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `demande_roles`
--
ALTER TABLE `demande_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `favoris`
--
ALTER TABLE `favoris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `langues`
--
ALTER TABLE `langues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `medias`
--
ALTER TABLE `medias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `message_contacts`
--
ALTER TABLE `message_contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `paiements`
--
ALTER TABLE `paiements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `typecontenus`
--
ALTER TABLE `typecontenus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `typemedias`
--
ALTER TABLE `typemedias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `commentaires_contenu_id_foreign` FOREIGN KEY (`contenu_id`) REFERENCES `contenus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `commentaires_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `contenus`
--
ALTER TABLE `contenus`
  ADD CONSTRAINT `contenus_langue_id_foreign` FOREIGN KEY (`langue_id`) REFERENCES `langues` (`id`),
  ADD CONSTRAINT `contenus_region_id_foreign` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `contenus_typecontenu_id_foreign` FOREIGN KEY (`typecontenu_id`) REFERENCES `typecontenus` (`id`),
  ADD CONSTRAINT `contenus_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `contenus_validated_by_foreign` FOREIGN KEY (`validated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `contenu_traductions`
--
ALTER TABLE `contenu_traductions`
  ADD CONSTRAINT `contenu_traductions_contenu_id_foreign` FOREIGN KEY (`contenu_id`) REFERENCES `contenus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contenu_traductions_langue_id_foreign` FOREIGN KEY (`langue_id`) REFERENCES `langues` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contenu_traductions_traduit_par_foreign` FOREIGN KEY (`traduit_par`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `contenu_traductions_validated_by_foreign` FOREIGN KEY (`validated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `demande_contributeurs`
--
ALTER TABLE `demande_contributeurs`
  ADD CONSTRAINT `demande_contributeurs_traite_par_foreign` FOREIGN KEY (`traite_par`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `demande_contributeurs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `demande_roles`
--
ALTER TABLE `demande_roles`
  ADD CONSTRAINT `demande_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `demande_roles_validated_by_foreign` FOREIGN KEY (`validated_by`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `favoris`
--
ALTER TABLE `favoris`
  ADD CONSTRAINT `favoris_contenu_id_foreign` FOREIGN KEY (`contenu_id`) REFERENCES `contenus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favoris_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `medias`
--
ALTER TABLE `medias`
  ADD CONSTRAINT `medias_contenu_id_foreign` FOREIGN KEY (`contenu_id`) REFERENCES `contenus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `medias_langue_id_foreign` FOREIGN KEY (`langue_id`) REFERENCES `langues` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `medias_type_media_id_foreign` FOREIGN KEY (`type_media_id`) REFERENCES `typemedias` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `medias_uploaded_by_foreign` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `medias_validated_by_foreign` FOREIGN KEY (`validated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `paiements`
--
ALTER TABLE `paiements`
  ADD CONSTRAINT `paiements_contenu_id_foreign` FOREIGN KEY (`contenu_id`) REFERENCES `contenus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `paiements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `regions`
--
ALTER TABLE `regions`
  ADD CONSTRAINT `regions_langue_principale_id_foreign` FOREIGN KEY (`langue_principale_id`) REFERENCES `langues` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
