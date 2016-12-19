# ************************************************************
# Sequel Pro SQL dump
# Version 4499
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Hôte: 127.0.0.1 (MySQL 5.7.16-0ubuntu0.16.04.1)
# Base de données: eminehakan
# Temps de génération: 2016-12-17 15:20:37 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Affichage de la table eh_article
# ------------------------------------------------------------

DROP TABLE IF EXISTS `eh_article`;

CREATE TABLE `eh_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position` int(11) NOT NULL,
  `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(1000) COLLATE utf8_unicode_ci DEFAULT '',
  `image_url` varchar(2500) COLLATE utf8_unicode_ci DEFAULT '',
  `url` varchar(2500) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `eh_article` WRITE;
/*!40000 ALTER TABLE `eh_article` DISABLE KEYS */;

INSERT INTO `eh_article` (`id`, `position`, `title`, `description`, `image_url`, `url`)
VALUES
	(1,0,'Ostéopathie, bienfaits, applications, en pratique','L\'ostéopathie est une « médecine manuelle ». Ses praticiens palpent les corps pour déceler les tensions ou les déséquilibres qui causent des malaises ou des maladies, puis font des manipulations pour rétablir l\'équilibre.','http://www.passeportsante.net/DocumentsProteus/images/osteopathie_th-1.jpg','http://www.passeportsante.net/fr/Therapies/Guide/Fiche.aspx?doc=osteopathie_th'),
	(2,2,'Ostéopathes ou kinésithérapeutes : quand les consulter ?','Les deux professions se font tant la guerre que l\'on ne sait plus à quel professionnel se vouer pour dire bye bye à son lumbago récurrent.','http://i.f1g.fr/media/ext/1900x800_crop/madame.lefigaro.fr/sites/default/files/img/2016/07/kine-ou-osteo--quand-les-consulter-.jpg','http://madame.lefigaro.fr/bien-etre/osteopathe-ou-kine-quand-les-consulter-040716-115195'),
	(3,1,'L\'ostéopathie de demain','Médecine parallèle fondée sur la manipulation des muscles, du squelette et des organes, l’ostéopathie est-elle condamnée à rester à l’écart des pratiques médicales dite conventionnelles, centrées sur les médicaments et la chirurgie?','https://plesklinux11.dns26.com:8443/sitebuilder/sites/3b/3b48fefbb7a7c9312adfdfa9ed974df4/attachments/Image/accueil1_2.jpg?1438204260452','http://www.bonasavoir.ch/924597-losteopathie-de-demain');

/*!40000 ALTER TABLE `eh_article` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table eh_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `eh_user`;

CREATE TABLE `eh_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `role` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `eh_user` WRITE;
/*!40000 ALTER TABLE `eh_user` DISABLE KEYS */;

INSERT INTO `eh_user` (`id`, `username`, `password`, `role`, `salt`)
VALUES
	(1,'admin','1RgS0G32aumNxCw5isBwM7/HjWNWHYY3gHolIxQsTkl2liIy4cz/NClPm7HG6kFCJlWvljI5fTyblvHmtGOiJg==','ROLE_ADMIN','%qUgq3NAYfC1MKwrW?yevbE');

/*!40000 ALTER TABLE `eh_user` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
