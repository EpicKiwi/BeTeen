-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 09 Décembre 2014 à 22:04
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `beteen`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `allowSujetStandard` tinyint(1) NOT NULL,
  `lft` int(11) NOT NULL,
  `lvl` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `root` int(11) DEFAULT NULL,
  `slug` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_CB8C5497989D9B62` (`slug`),
  KEY `IDX_CB8C5497727ACA70` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`id`, `parent_id`, `nom`, `description`, `allowSujetStandard`, `lft`, `lvl`, `rgt`, `root`, `slug`) VALUES
(1, NULL, 'Index', 'Racine du forum', 1, 1, 0, 2, 1, 'index');

-- --------------------------------------------------------

--
-- Structure de la table `ext_log_entries`
--

CREATE TABLE IF NOT EXISTS `ext_log_entries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `logged_at` datetime NOT NULL,
  `object_id` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `object_class` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `version` int(11) NOT NULL,
  `data` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `log_class_lookup_idx` (`object_class`),
  KEY `log_date_lookup_idx` (`logged_at`),
  KEY `log_user_lookup_idx` (`username`),
  KEY `log_version_lookup_idx` (`object_id`,`object_class`,`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `ext_translations`
--

CREATE TABLE IF NOT EXISTS `ext_translations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `locale` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `object_class` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `field` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `foreign_key` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lookup_unique_idx` (`locale`,`object_class`,`field`,`foreign_key`),
  KEY `translations_lookup_idx` (`locale`,`object_class`,`foreign_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `reponsestandard`
--

CREATE TABLE IF NOT EXISTS `reponsestandard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sujet_id` int(11) NOT NULL,
  `contenu` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `auteur_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9C0B150B7C4D497E` (`sujet_id`),
  KEY `IDX_9C0B150B60BB6FE6` (`auteur_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Contenu de la table `reponsestandard`
--

INSERT INTO `reponsestandard` (`id`, `sujet_id`, `contenu`, `date`, `auteur_id`) VALUES
(1, 1, 'J''aime les kiwis', '2014-11-20 20:46:22', 2),
(2, 1, 'Moi aussi <3', '2014-11-20 20:47:41', 3),
(3, 1, 'Je suis nouveau ! :D', '2014-11-24 21:50:07', 4),
(4, 2, 'Je ne sait pas ... :-s', '2014-11-24 22:03:44', 4),
(5, 1, 'Bienvenue', '2014-11-24 22:15:19', 2),
(6, 1, '**Lorem ipsum dolor sit amet**, consectetur adipiscing elit. Etiam non libero orci. In maximus quam at dictum eleifend. Vestibulum quis sagittis tortor. Interdum et malesuada fames ac ante ipsum primis in faucibus. Cras eu est lorem. Sed ante libero, facilisis eu metus at, scelerisque feugiat felis. Aenean sed aliquam velit. Aenean bibendum facilisis nibh eu fermentum.  \n\nPhasellus id euismod nulla. *Sed purus* magna, dictum non est in, gravida rhoncus ligula. Etiam interdum eros non dolor imperdiet iaculis. Proin in ante tortor. Nullam neque purus, pretium ac ante elementum, egestas tempus tellus. Fusce pharetra, dolor ut elementum tempus, felis lectus semper velit, vel pretium odio nunc non nisi. Etiam vel lacus id eros ornare dictum id sed eros. Sed eget finibus lorem. Mauris in risus libero. Nulla nec auctor metus. Pellentesque vehicula, mauris ac faucibus faucibus, tortor dolor finibus orci, vitae cursus massa ex sed leo. Mauris nisi risus, placerat non felis at, maximus elementum ex. Integer sit amet ex auctor, dapibus velit sit amet, sodales lorem.\n\nSed at tempus nisl, ac elementum mi. Maecenas molestie, nisl ac malesuada convallis, dolor lectus rutrum sem, efficitur porttitor urna lorem at tellus. Nunc tempus ultricies arcu vitae sagittis. Fusce egestas tristique dolor, a volutpat ex suscipit pretium. Nulla porta pellentesque ipsum, vitae convallis sapien tempor in. Vestibulum lacinia nulla et est placerat consequat. Mauris vel est hendrerit, finibus nisi sit amet, maximus justo. Sed orci lacus, euismod eu mauris quis, pharetra semper est. Mauris et ligula ligula. Quisque sed est id erat volutpat dignissim id eu nisi. Integer vitae rhoncus ex.\n\nFusce eu velit non diam egestas posuere sed ut nibh. Curabitur laoreet enim nunc, vel lobortis velit interdum eu. Vivamus tincidunt sollicitudin lacus condimentum aliquet. Nam eu urna nec diam sodales auctor a sed nunc. Proin vulputate urna leo, a sodales massa rutrum a. Maecenas consectetur ipsum sed tellus egestas, eu venenatis ex condimentum. Nunc dignissim sed nisl nec convallis.\n\nDuis consectetur, ipsum id suscipit viverra, risus enim pretium turpis, non semper justo turpis at quam. Pellentesque efficitur viverra magna, sed lacinia enim ultrices ac. Mauris molestie velit a dolor tincidunt laoreet id a diam. Duis erat turpis, ornare eu libero id, rutrum congue diam. Curabitur posuere pretium massa, et tincidunt neque placerat et. Cras in ante et nibh imperdiet laoreet ut et purus. Vivamus ut volutpat ex. Sed diam erat, luctus at orci ut, facilisis auctor felis. Fusce vitae aliquam nulla. Vestibulum sed ipsum non turpis aliquet convallis eu non* mauris*. Mauris vel libero eu diam sodales commodo ut vitae neque. Nullam blandit aliquam dolor, tempus finibus diam convallis at. Etiam eget ex imperdiet, vulputate enim eu, accumsan lacus. Praesent vitae ante et mauris tristique ullamcorper a ac ante.', '2014-11-24 22:19:24', 2),
(7, 1, 'Késsé ???', '2014-11-24 22:20:46', 4),
(8, 1, 'Gné O_o', '2014-11-24 22:25:20', 3),
(9, 1, 'C''est du lorem ipsum sa permet de remplir pour donner une idée ...', '2014-11-24 22:26:25', 2);

-- --------------------------------------------------------

--
-- Structure de la table `sujetstandard`
--

CREATE TABLE IF NOT EXISTS `sujetstandard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categorie_id` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contenu` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `verouille` tinyint(1) NOT NULL,
  `slug` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `auteur_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_A3841230989D9B62` (`slug`),
  KEY `IDX_A3841230BCF5E72D` (`categorie_id`),
  KEY `IDX_A384123060BB6FE6` (`auteur_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `sujetstandard`
--

INSERT INTO `sujetstandard` (`id`, `categorie_id`, `titre`, `contenu`, `date`, `verouille`, `slug`, `auteur_id`) VALUES
(1, 1, 'Hello World', 'Good Bye !', '2014-11-05 19:28:42', 0, 'hello-world', 3),
(2, 1, 'Idées de catégories', 'Donnez des idées pour les futur catégories du forum ;)', '2014-11-20 20:52:58', 0, 'idees-de-categories', 2);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `background` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_2DA17977F85E0677` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `salt`, `roles`, `email`, `avatar`, `background`, `description`) VALUES
(2, 'Admin', '1f9ee94d2640c828d18547d96491a287c282baf510dc99e0bfd5cdd396d66fb5fcea28558d3dfcf048c2dd4542e3be627f3ddaf4181c3a7ee472e2e3f4b0f5ed', '', 'a:1:{i:0;s:10:"ROLE_ADMIN";}', 'admin@local.info', 'admin.jpg', 'admin-default.jpg', 'L''administrateur'),
(3, 'EpicKiwi', 'fdacda1c657dc354d5c4f12854c26d99f650c66c7e232311c2bf36488494195e40f1c9e67ccd5e2025ea29d28bd2b2cd316c032276630f559099ee09e3860f62', '', 'a:1:{i:0;s:16:"ROLE_SUPER_ADMIN";}', 'lelycandu76@gmail.com', 'epickiwi.png', 'epickiwi-default.jpg', 'Hello World'),
(4, 'Utilisateur', '109f6b653401d5e5ebc0c037abd26b251552c906aab171b435b98503ac12659d0944bac69802e7e8550fe26783bf2843d8b3903d6ac41726a73678ccf50a817b', '', 'a:1:{i:0;s:9:"ROLE_USER";}', 'user@hotmail.com', '', '', '');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD CONSTRAINT `FK_CB8C5497727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `categorie` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `reponsestandard`
--
ALTER TABLE `reponsestandard`
  ADD CONSTRAINT `FK_9C0B150B60BB6FE6` FOREIGN KEY (`auteur_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_9C0B150B7C4D497E` FOREIGN KEY (`sujet_id`) REFERENCES `sujetstandard` (`id`);

--
-- Contraintes pour la table `sujetstandard`
--
ALTER TABLE `sujetstandard`
  ADD CONSTRAINT `FK_A384123060BB6FE6` FOREIGN KEY (`auteur_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_A3841230BCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
