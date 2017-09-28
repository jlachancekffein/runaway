# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Hôte: 127.0.0.1 (MySQL 5.7.19-0ubuntu0.16.04.1)
# Base de données: runway2doorway
# Temps de génération: 2017-09-28 12:52:16 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Affichage de la table addresses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `addresses`;

CREATE TABLE `addresses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `address_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `province` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `postal_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `addresses_address_id_customer_id_index` (`address_id`,`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Affichage de la table article_translations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `article_translations`;

CREATE TABLE `article_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int(10) unsigned NOT NULL,
  `locale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `seo_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seo_description` text COLLATE utf8_unicode_ci NOT NULL,
  `seo_slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `article_translations_article_id_locale_unique` (`article_id`,`locale`),
  UNIQUE KEY `article_translations_seo_slug_locale_unique` (`seo_slug`,`locale`),
  KEY `article_translations_article_id_locale_seo_slug_index` (`article_id`,`locale`,`seo_slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `article_translations` WRITE;
/*!40000 ALTER TABLE `article_translations` DISABLE KEYS */;

INSERT INTO `article_translations` (`id`, `article_id`, `locale`, `title`, `description`, `seo_title`, `seo_description`, `seo_slug`, `image`, `content`)
VALUES
	(5,3,'fr','ASSUMÉE !','','ASSUMÉE !','','assumee','/storage/articles/6/a/1/6a1b765673b7bc4dbc90cd51bc39099f33d58e8d.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Marques de v\\u00eatements utilis\\u00e9s pour r\\u00e9aliser ce look sont :\\n\\n* MARC CAIN\\n* REPEAT\",\"image\":\"\\/storage\\/articles\\/6\\/a\\/1\\/6a1b765673b7bc4dbc90cd51bc39099f33d58e8d.jpeg\"}}]'),
	(6,3,'en','ASSUMED !','','ASSUMED !','','assumed','/storage/articles/6/a/1/6a1b765673b7bc4dbc90cd51bc39099f33d58e8d.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Brands used to create this look:  \\n\\n* MARC CAIN\\n* REPEAT\",\"image\":\"\\/storage\\/articles\\/6\\/a\\/1\\/6a1b765673b7bc4dbc90cd51bc39099f33d58e8d.jpeg\"}}]'),
	(7,4,'fr','MON BÉBÉ EST NÉ !','Lorsqu’un projet prend 9 mois à naître, on peut presque le considérer comme un bébé non ? D’autant plus que c’est mon premier grand projet d’affaires depuis ma sortie de l’École d’Entrepreneurship de Beauce et que mes yeux s’illuminent dès que je pose mes yeux sur lui. ','MON BÉBÉ EST NÉ !','Lorsqu’un projet prend 9 mois à naître, on peut presque le considérer comme un bébé non ? D’autant plus que c’est mon premier grand projet d’affaires...','mon-bebe-est-ne','/storage/articles/c/b/d/cbdc33e9df20ef5847dfd47eab74a90d7eaf7a4e.png','[{\"templateId\":\"blockTextImage\",\"data\":{\"text\":\"MON B\\u00c9B\\u00c9 EST N\\u00c9 !\\n\\nLorsqu\\u2019un projet prend 9 mois \\u00e0 na\\u00eetre, on peut presque le consid\\u00e9rer comme un b\\u00e9b\\u00e9 non ? D\\u2019autant plus que c\\u2019est mon premier grand projet d\\u2019affaires depuis ma sortie de l\\u2019\\u00c9cole d\\u2019Entrepreneurship de Beauce et que mes yeux s\\u2019illuminent d\\u00e8s que je pose mes yeux sur lui. \\n\\nBien s\\u00fbr, il y a [Pink Poka](https:\\/\\/pinkpoka.com\\/), ma boutique en ligne d\\u2019accessoire haut de gamme, mais mon tout nouveau b\\u00e9b\\u00e9, Runway2Doorway, a un petit je-ne-sais-quoi \\u00bb qui me rend bien fi\\u00e8re ! \\n\\nJ\\u2019esp\\u00e8re que vous serez aussi \\u00e9merveill\\u00e9s que moi de notre site et du service exclusif que nous offrons.\\n\\nMais surtout, j\\u2019esp\\u00e8re que notre service gratuit de stylisme et de magasinage personnalis\\u00e9 saura vous aider dans la gestion de votre temps. Car le but de Runway2Doorway est de vous simplifier la vie et de la rendre encore plus belle.\\nJe vous invite d\\u00e8s maintenant \\u00e0 [remplir votre profil](http:\\/\\/runway2doorway.imarcom.ca\\/register). Un petit cinq minutes qui vous en fera sauver des centaines par la suite. \\n\\nMa belle gang de stylistes n\\u2019attend que vous !\\n\\nAu plaisir,\\n\\nMarie-Chrystelle Cheikha\\nStyliste fondatrice R2D\\n\",\"image\":\"\\/storage\\/articles\\/c\\/b\\/d\\/cbdc33e9df20ef5847dfd47eab74a90d7eaf7a4e.png\"}}]'),
	(8,4,'en','MY BABY IS BORN !','When it takes 9 month of dedicated preparation for a project to be brought to life, we can definetely compare it to a baby, can’t we?  It is also my first big business project since i graduated from Entrepreuneurship Bauce’s School. I will not lie, I have litterally sparks in my eyes every time I talk about it. ','MY BABY IS BORN !','When it takes 9 month of dedicated preparation for a project to be brought to life, we can definetely compare it to a baby, can’t we?  It is also my f...','my-baby-is-born','/storage/articles/c/b/d/cbdc33e9df20ef5847dfd47eab74a90d7eaf7a4e.png','[{\"templateId\":\"blockTextImage\",\"data\":{\"text\":\"My baby is born! \\n\\nWhen it takes 9 month of dedicated preparation for a project to be brought to life, we can definetely compare it to a baby, can\\u2019t we?  It is also my first big business project since i graduated from Entrepreuneurship Beauce\\u2019s School. I will not lie, I have litterally sparks in my eyes every time I talk about it. \\n\\nOf course I own Pink Poka, a high-end accessories online store, but Runway2Doorway is the main project that makes me so proud. \\n\\nI sincerely hope that you will that you will be as amazed as I am about this exclusive personal styling service. \\n\\nAbove all, I truly believe that you will save a massive amount of time and headeaches using our service. Runway2Doorway will also let you live your life to the fullest, knowing that you are wearing high-end clothes and accessories that are the top in fashion trends. \\n\\nI invite you to [get started today](http:\\/\\/runway2doorway.imarcom.ca\\/register). It will take you a 5 minutes that will make you save a lot more. \\n\\nMy awesome team of personal stylists is waiting for you! \\n\\nBest regards, \\n\\nMarie-Chrystelle Cheikha\\nPersonal stylist and founder of R2D\\n\",\"image\":\"\\/storage\\/articles\\/c\\/b\\/d\\/cbdc33e9df20ef5847dfd47eab74a90d7eaf7a4e.png\"}}]'),
	(9,5,'fr','ROCK IT!','','ROCK IT!','','rock-it','/storage/articles/c/9/a/c9af8936d91fe177b22cd5294f6deb2a520b05fd.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Marques de v\\u00eatements utilis\\u00e9s pour r\\u00e9aliser ce look sont:\\n\\n* 360 CASHMERE\\n\\n* CAMBIO\\n\",\"image\":\"\\/storage\\/articles\\/c\\/9\\/a\\/c9af8936d91fe177b22cd5294f6deb2a520b05fd.jpeg\"}}]'),
	(10,5,'en','ROCK IT!','','ROCK IT!','','rock-it','/storage/articles/c/9/a/c9af8936d91fe177b22cd5294f6deb2a520b05fd.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Brands used to create this look: \\n\\n* 360 CASHMERE\\n\\n* CAMBIO\\n\",\"image\":\"\\/storage\\/articles\\/c\\/9\\/a\\/c9af8936d91fe177b22cd5294f6deb2a520b05fd.jpeg\"}}]'),
	(11,6,'fr','100 % CACHEMIRE','','100 % CACHEMIRE','','100-cachemire','/storage/articles/b/b/f/bbf13f3c5f7336beda5428a357625c5e96e3544e.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Marques de v\\u00eatements utilis\\u00e9s pour r\\u00e9aliser ce look sont:\\n\\n* 360 CASHMERE\\n\\n* LUISA CERANO\\n\",\"image\":\"\\/storage\\/articles\\/b\\/b\\/f\\/bbf13f3c5f7336beda5428a357625c5e96e3544e.jpeg\"}}]'),
	(12,6,'en','100% CASHMERE','','100% CASHMERE','','100-cashmere','/storage/articles/b/b/f/bbf13f3c5f7336beda5428a357625c5e96e3544e.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Brand used to create this look: \\n\\n* 360 CASHMERE\\n\\n*  LUISA CERANO\\n\\n\\n\",\"image\":\"\\/storage\\/articles\\/b\\/b\\/f\\/bbf13f3c5f7336beda5428a357625c5e96e3544e.jpeg\"}}]'),
	(13,7,'fr','PASTEL','','PASTEL','','pastel','/storage/articles/f/d/e/fde8a52601c180c0928540ecc8e7da1a05d593bc.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Marque de v\\u00eatements utilis\\u00e9 pour r\\u00e9aliser ce look est:\\n\\n* MARC CAIN\\n\",\"image\":\"\\/storage\\/articles\\/f\\/d\\/e\\/fde8a52601c180c0928540ecc8e7da1a05d593bc.jpeg\"}}]'),
	(14,7,'en','PASTEL','','PASTEL','','pastel','/storage/articles/f/d/e/fde8a52601c180c0928540ecc8e7da1a05d593bc.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Brand used o create this look: \\n\\n* MARC CAIN\",\"image\":\"\\/storage\\/articles\\/f\\/d\\/e\\/fde8a52601c180c0928540ecc8e7da1a05d593bc.jpeg\"}}]'),
	(15,8,'fr','TOUT BLANC','','TOUT BLANC','','tout-blanc','/storage/articles/5/f/d/5fd0bc63e504a725d986acfc176f792e05db666f.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Marques de v\\u00eatements utilis\\u00e9s pour r\\u00e9aliser ce look sont:\\n\\n* CBY WHITE\\n\\n* FTC CASHMERE\\n\\n* CAMBIO\\n\\n* MARC CAIN\\n\",\"image\":\"\\/storage\\/articles\\/5\\/f\\/d\\/5fd0bc63e504a725d986acfc176f792e05db666f.jpeg\"}}]'),
	(16,8,'en','ALL WHITE','','ALL WHITE','','all-white','/storage/articles/5/f/d/5fd0bc63e504a725d986acfc176f792e05db666f.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Brands used to create this look: \\n\\n* CBY WHITE\\n\\n* FTC CASHMERE\\n\\n* CAMBIO\\n\\n* MARC CAIN\\n\",\"image\":\"\\/storage\\/articles\\/5\\/f\\/d\\/5fd0bc63e504a725d986acfc176f792e05db666f.jpeg\"}}]'),
	(17,9,'fr','VENT DE FRAICHEUR','','VENT DE FRAICHEUR','','vent-de-fraicheur','/storage/articles/e/5/6/e56696376e4891ea3879ddea1c83136038059b01.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Marques de v\\u00eatements utilis\\u00e9es pour r\\u00e9aliser ce look: \\n\\n* TAIFUN\\n\\n* CLASSIC\\n\\n* MARC CAIN\\n\\n* LAUR\\u00c8L\",\"image\":\"\\/storage\\/articles\\/e\\/5\\/6\\/e56696376e4891ea3879ddea1c83136038059b01.jpeg\"}}]'),
	(18,9,'en','FRESH WIND','','FRESH WIND','','fresh-wind','/storage/articles/e/5/6/e56696376e4891ea3879ddea1c83136038059b01.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Brands used to create this look: \\n\\n* TAIFUN\\n\\n* CLASSIC\\n\\n* MARC CAIN\\n\\n* LAUR\\u00c8L\",\"image\":\"\\/storage\\/articles\\/e\\/5\\/6\\/e56696376e4891ea3879ddea1c83136038059b01.jpeg\"}}]'),
	(19,10,'fr','FLUIDITÉ','','FLUIDITÉ','','fluidite','/storage/articles/2/4/0/240d7e39357c7d9fcaf4af1bfb2f748e0cdec756.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Marques de v\\u00eatements utilis\\u00e9es pour r\\u00e9aliser ce look sont:\\n\\n* GEORGES RECH\\n\\n* LAUR\\u00c8L\\n\\n* CAMBIO\",\"image\":\"\\/storage\\/articles\\/2\\/4\\/0\\/240d7e39357c7d9fcaf4af1bfb2f748e0cdec756.jpeg\"}}]'),
	(20,10,'en','FLUIDITY','','FLUIDITY','','fluidity','/storage/articles/2/4/0/240d7e39357c7d9fcaf4af1bfb2f748e0cdec756.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Brands used to create this look are:\\n\\n* GEORGES RECH\\n\\n* LAUR\\u00c8L\\n\\n* CAMBIO\",\"image\":\"\\/storage\\/articles\\/2\\/4\\/0\\/240d7e39357c7d9fcaf4af1bfb2f748e0cdec756.jpeg\"}}]'),
	(21,11,'fr','SOYEZ DIFFÉRENTE','','SOYEZ DIFFÉRENTE','','soyez-differente','/storage/articles/a/4/9/a499f4a664aa045d928e4f7e3c709c0d1c5d69c0.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Marque de v\\u00eatements utilis\\u00e9e pour r\\u00e9aliser ce look est:\\n\\n* RIANI\",\"image\":\"\\/storage\\/articles\\/a\\/4\\/9\\/a499f4a664aa045d928e4f7e3c709c0d1c5d69c0.jpeg\"}}]'),
	(22,11,'en','BE DIFFERENT','','BE DIFFERENT','','be-different','/storage/articles/a/4/9/a499f4a664aa045d928e4f7e3c709c0d1c5d69c0.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Brand used to create this look is:\\n\\n* RIANI\",\"image\":\"\\/storage\\/articles\\/a\\/4\\/9\\/a499f4a664aa045d928e4f7e3c709c0d1c5d69c0.jpeg\"}}]'),
	(23,12,'fr','LA FILLE D\'À CÔTÉ','','LA FILLE D\'À CÔTÉ','','la-fille-da-cote','/storage/articles/5/8/e/58e0df6bd65a266d5f7ef187ec57372548545539.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Marques de v\\u00eatements utilis\\u00e9es pour r\\u00e9aliser ce look sont:\\n\\n* MARC CAIN \\n\\n* RIANI\",\"image\":\"\\/storage\\/articles\\/5\\/8\\/e\\/58e0df6bd65a266d5f7ef187ec57372548545539.jpeg\"}}]'),
	(24,12,'en','THE GIRL NEXT DOOR','','THE GIRL NEXT DOOR','','the-girl-next-door','/storage/articles/5/8/e/58e0df6bd65a266d5f7ef187ec57372548545539.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Brands used to create this look are: \\n\\n* MARC CAIN\\n\\n* RIANI\",\"image\":\"\\/storage\\/articles\\/5\\/8\\/e\\/58e0df6bd65a266d5f7ef187ec57372548545539.jpeg\"}}]'),
	(25,13,'fr','DÉTERMINÉ','','DÉTERMINÉ','','determine','/storage/articles/e/d/b/edbe1ddc67951242d14c78e8ae2dc8c7a88af96e.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Marques de v\\u00eatements utilis\\u00e9es pour r\\u00e9aliser ce look sont:\\n\\n* RIANI\\n\\n* MARC CAIN\\n\\n* TAIFUN\",\"image\":\"\\/storage\\/articles\\/e\\/d\\/b\\/edbe1ddc67951242d14c78e8ae2dc8c7a88af96e.jpeg\"}}]'),
	(26,13,'en','DETERMINATED','','DETERMINATED','','determinated','/storage/articles/e/d/b/edbe1ddc67951242d14c78e8ae2dc8c7a88af96e.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Brands used to create this look are:\\n\\n* RIANI\\n\\n* MARC CAIN\\n\\n* TAIFUN\",\"image\":\"\\/storage\\/articles\\/e\\/d\\/b\\/edbe1ddc67951242d14c78e8ae2dc8c7a88af96e.jpeg\"}}]'),
	(27,14,'fr','COQUETEL','','COQUETEL','','coquetel','/storage/articles/4/4/2/442e880747f93e464a0e0c660de1f4971f295fdc.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Marque de v\\u00eatement utilis\\u00e9e pour r\\u00e9aliser ce look:\\n\\n* AIDAN MATTOX\",\"image\":\"\\/storage\\/articles\\/4\\/4\\/2\\/442e880747f93e464a0e0c660de1f4971f295fdc.jpeg\"}}]'),
	(28,14,'en','COCKTAIL','','COCKTAIL','','cocktail','/storage/articles/4/4/2/442e880747f93e464a0e0c660de1f4971f295fdc.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Brand to create this look is :\\n\\n* AIDEN MATTOX\",\"image\":\"\\/storage\\/articles\\/4\\/4\\/2\\/442e880747f93e464a0e0c660de1f4971f295fdc.jpeg\"}}]'),
	(29,15,'fr','IMPRIMÉ','','IMPRIMÉ','','imprime','/storage/articles/3/1/7/3178a145f9e69e7c6dae878ac0d5eb1be6a25f6c.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Marques de v\\u00eatements utilis\\u00e9es pour r\\u00e9aliser ce look sont:\\n\\n* CLASSIC\\n\\n* MARC CAIN\",\"image\":\"\\/storage\\/articles\\/3\\/1\\/7\\/3178a145f9e69e7c6dae878ac0d5eb1be6a25f6c.jpeg\"}}]'),
	(30,15,'en','PRINTED','','PRINTED','','printed','/storage/articles/3/1/7/3178a145f9e69e7c6dae878ac0d5eb1be6a25f6c.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Brands used to create this look are:\\n\\n* CLASSIC\\n\\n* MARC CAIN\",\"image\":\"\\/storage\\/articles\\/3\\/1\\/7\\/3178a145f9e69e7c6dae878ac0d5eb1be6a25f6c.jpeg\"}}]'),
	(31,16,'fr','FLAMBOYANTE','','FLAMBOYANTE','','flamboyante','/storage/articles/f/c/9/fc9b95aa41393d742cbdf28e67b95bc1d60e152e.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Marques de v\\u00eatements utilis\\u00e9es pour r\\u00e9aliser ce look:\\n\\n* CODELLO\\n\\n* TAIFUN\\n\\n* RIANI\\n\\n* LUISA CERANO\",\"image\":\"\\/storage\\/articles\\/f\\/c\\/9\\/fc9b95aa41393d742cbdf28e67b95bc1d60e152e.jpeg\"}}]'),
	(32,16,'en','FLAMBOYANT','','FLAMBOYANT','','flamboyant','/storage/articles/f/c/9/fc9b95aa41393d742cbdf28e67b95bc1d60e152e.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Brands used to create this look are:\\n\\n* CODELLO\\n\\n* TAIFUN\\n\\n* RIANI\\n\\n* LUISA CERANO\",\"image\":\"\\/storage\\/articles\\/f\\/c\\/9\\/fc9b95aa41393d742cbdf28e67b95bc1d60e152e.jpeg\"}}]'),
	(33,17,'fr','GOLF 1','','GOLF 1','','golf-1','/storage/articles/6/5/d/65d8ee40911f0931d0ae81c6605592e48285ece4.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Marque utilis\\u00e9e pour r\\u00e9aliser ce look:\\n\\n* MASTER GOLF\",\"image\":\"\\/storage\\/articles\\/6\\/5\\/d\\/65d8ee40911f0931d0ae81c6605592e48285ece4.jpeg\"}}]'),
	(34,17,'en','GOLF 1','','GOLF 1','','golf-1','/storage/articles/6/5/d/65d8ee40911f0931d0ae81c6605592e48285ece4.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Brand used to create this look:\\n\\n* MASTER GOLF\",\"image\":\"\\/storage\\/articles\\/6\\/5\\/d\\/65d8ee40911f0931d0ae81c6605592e48285ece4.jpeg\"}}]'),
	(35,18,'fr','BRILLANTE','','BRILLANTE','','brillante','/storage/articles/2/5/8/2582aff7ef212557ced3a8532f71152adf15c5f1.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Marques utlis\\u00e9es pour r\\u00e9aliser ce look:\\n\\n* RIANI\\n\\n* LAUR\\u00c8L\\n\\n\",\"image\":\"\\/storage\\/articles\\/2\\/5\\/8\\/2582aff7ef212557ced3a8532f71152adf15c5f1.jpeg\"}}]'),
	(36,18,'en','BRIGHT','','BRIGHT','','bright','/storage/articles/2/5/8/2582aff7ef212557ced3a8532f71152adf15c5f1.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Brands used to create this look:\\n\\n* RIANI\\n\\n* LAUR\\u00c8L\",\"image\":\"\\/storage\\/articles\\/2\\/5\\/8\\/2582aff7ef212557ced3a8532f71152adf15c5f1.jpeg\"}}]'),
	(37,19,'fr','OSEZ MARINE ET NOIR','','OSEZ MARINE ET NOIR','','osez-marine-et-noir','/storage/articles/7/f/5/7f59fda2af4b00790113eb60264b9749478dc479.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Marques utilis\\u00e9es pour r\\u00e9aliser ce look:\\n\\n* RIANI\\n\\n* CAMBIO\\n\\n\",\"image\":\"\\/storage\\/articles\\/7\\/f\\/5\\/7f59fda2af4b00790113eb60264b9749478dc479.jpeg\"}}]'),
	(38,19,'en','TRY MARINE AND BLACK','','TRY MARINE AND BLACK','','try-marine-and-black','/storage/articles/7/f/5/7f59fda2af4b00790113eb60264b9749478dc479.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Brands used to create this look:\\n\\n* RIANI\\n\\n* CAMBIO\",\"image\":\"\\/storage\\/articles\\/7\\/f\\/5\\/7f59fda2af4b00790113eb60264b9749478dc479.jpeg\"}}]'),
	(39,20,'fr','DOUCE','','DOUCE','','douce','/storage/articles/1/3/4/13474731b6621176ec3f3745933426b211f51540.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Marques utilis\\u00e9es pour r\\u00e9aliser ce look:\\n\\n* MARC CAIN\\n\\n* CLASSIC\",\"image\":\"\\/storage\\/articles\\/1\\/3\\/4\\/13474731b6621176ec3f3745933426b211f51540.jpeg\"}}]'),
	(40,20,'en','SOFT','','SOFT','','soft','/storage/articles/1/3/4/13474731b6621176ec3f3745933426b211f51540.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Brands to use to create this look:\\n\\n* MARC CAIN\\n\\n* CLASSIC\",\"image\":\"\\/storage\\/articles\\/1\\/3\\/4\\/13474731b6621176ec3f3745933426b211f51540.jpeg\"}}]'),
	(41,21,'fr','IRRÉSISTIBLE','','IRRÉSISTIBLE','','irresistible','/storage/articles/2/7/0/270ea3958855830b70e4626d56530bee4178f1b2.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Marque utilis\\u00e9e pour r\\u00e9aliser ce look:\\n\\n* MARC CAIN\",\"image\":\"\\/storage\\/articles\\/2\\/7\\/0\\/270ea3958855830b70e4626d56530bee4178f1b2.jpeg\"}}]'),
	(42,21,'en','IRRESISTIBLE','','IRRESISTIBLE','','irresistible','/storage/articles/2/7/0/270ea3958855830b70e4626d56530bee4178f1b2.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Brand use to create this look:\\n\\n* MARC CAIN\",\"image\":\"\\/storage\\/articles\\/2\\/7\\/0\\/270ea3958855830b70e4626d56530bee4178f1b2.jpeg\"}}]'),
	(43,22,'fr','KENNEDY','','KENNEDY','','kennedy','/storage/articles/b/c/7/bc7ff191f314f3e1d54668b5fc64f89e30e8388c.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Marques utilis\\u00e9es pour r\\u00e9aliser ce look:\\n\\n* MARC CAIN\\n\\n* RIANI\",\"image\":\"\\/storage\\/articles\\/b\\/c\\/7\\/bc7ff191f314f3e1d54668b5fc64f89e30e8388c.jpeg\"}}]'),
	(44,22,'en','KENNEDY','','KENNEDY','','kennedy','/storage/articles/b/c/7/bc7ff191f314f3e1d54668b5fc64f89e30e8388c.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Brands used to create this look:\\n\\n* MARC CAIN\\n\\n* RIANI\",\"image\":\"\\/storage\\/articles\\/b\\/c\\/7\\/bc7ff191f314f3e1d54668b5fc64f89e30e8388c.jpeg\"}}]'),
	(45,23,'fr','FÉMININE','','FÉMININE','','feminine','/storage/articles/8/2/a/82a53f433c4b528f200358e7a36c0829dd335294.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Marque utilis\\u00e9e pour cr\\u00e9er ce look:\\n\\n* GEORGES RECH\",\"image\":\"\\/storage\\/articles\\/8\\/2\\/a\\/82a53f433c4b528f200358e7a36c0829dd335294.jpeg\"}}]'),
	(46,23,'en','FEMININE','','FEMININE','','feminine','/storage/articles/8/2/a/82a53f433c4b528f200358e7a36c0829dd335294.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Brand used to create this look:\\n\\n* GEORGES RECH\",\"image\":\"\\/storage\\/articles\\/8\\/2\\/a\\/82a53f433c4b528f200358e7a36c0829dd335294.jpeg\"}}]'),
	(47,24,'fr','SÉDUCTRICE','','SÉDUCTRICE','','seductrice','/storage/articles/6/4/9/6494b45e1aa8f9eb2ff327860a3f4c1d0d657235.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Marque utilis\\u00e9e pour r\\u00e9aliser ce look:\\n\\n* LAUR\\u00c8L\",\"image\":\"\\/storage\\/articles\\/6\\/4\\/9\\/6494b45e1aa8f9eb2ff327860a3f4c1d0d657235.jpeg\"}}]'),
	(48,24,'en','SEDUCTION','','SEDUCTION','','seduction','/storage/articles/6/4/9/6494b45e1aa8f9eb2ff327860a3f4c1d0d657235.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Brand used to create this look:\\n\\n* LAUR\\u00c8L\",\"image\":\"\\/storage\\/articles\\/6\\/4\\/9\\/6494b45e1aa8f9eb2ff327860a3f4c1d0d657235.jpeg\"}}]'),
	(49,25,'fr','ROBE DE SOIRÉE','','ROBE DE SOIRÉE','','robe-de-soiree','/storage/articles/1/c/c/1cc43729957f122db7588a6e1ccb3a82048076d6.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Marque utilis\\u00e9e pour r\\u00e9aliser ce look:\\n\\n* JS COLLECTION\",\"image\":\"\\/storage\\/articles\\/1\\/c\\/c\\/1cc43729957f122db7588a6e1ccb3a82048076d6.jpeg\"}}]'),
	(50,25,'en','EVENING DRESS','','EVENING DRESS','','evening-dress','/storage/articles/1/c/c/1cc43729957f122db7588a6e1ccb3a82048076d6.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Brand used to create this look:\\n\\n* JS COLLECTION\\n\",\"image\":\"\\/storage\\/articles\\/1\\/c\\/c\\/1cc43729957f122db7588a6e1ccb3a82048076d6.jpeg\"}}]'),
	(51,26,'fr','BELLE !','','BELLE !','','belle','/storage/articles/8/f/5/8f55d4e0f7d2b75a20ca2a4b436c0a54fff69c75.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Marques utilis\\u00e9es pour r\\u00e9aliser ce look:\\n\\n* LAFAYETTE 148 NEW-YORK\\n\\n* LUISA CERANO\\n\\n* CAMBIO\",\"image\":\"\\/storage\\/articles\\/8\\/f\\/5\\/8f55d4e0f7d2b75a20ca2a4b436c0a54fff69c75.jpeg\"}}]'),
	(52,26,'en','BELLE!','','BELLE!','','belle','/storage/articles/8/f/5/8f55d4e0f7d2b75a20ca2a4b436c0a54fff69c75.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Brands used to create this look:\\n\\n* LAFAYETTE 148 NEW-YORK\\n\\n* LUISA CERANO\\n\\n* CAMBIO\",\"image\":\"\\/storage\\/articles\\/8\\/f\\/5\\/8f55d4e0f7d2b75a20ca2a4b436c0a54fff69c75.jpeg\"}}]'),
	(53,27,'fr','GOLF 2','','GOLF 2','','golf-2','/storage/articles/3/6/0/360cf730ba46990ccebc601a08e3957862cd23b3.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Marques utilis\\u00e9s pour r\\u00e9aliser ce look:\\n\\n* MASTER GOLF\",\"image\":\"\\/storage\\/articles\\/3\\/6\\/0\\/360cf730ba46990ccebc601a08e3957862cd23b3.jpeg\"}}]'),
	(54,27,'en','GOLF 2','','GOLF 2','','golf-2','/storage/articles/3/6/0/360cf730ba46990ccebc601a08e3957862cd23b3.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Brand used to create this look:\\n\\n* MASTER GOLF\",\"image\":\"\\/storage\\/articles\\/3\\/6\\/0\\/360cf730ba46990ccebc601a08e3957862cd23b3.jpeg\"}}]'),
	(55,28,'fr','AMOUREUSE DES JEANS','','AMOUREUSE DES JEANS','','amoureuse-des-jeans','/storage/articles/e/d/8/ed83d0effa0284084b642612ec16131e55174099.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Marques utilis\\u00e9es pour r\\u00e9aliser ce look:\\n\\n* * LUISA CERANO\\n\\n* GEORGES RECH\\n\\n* RAFAELLO ROSSI\",\"image\":\"\\/storage\\/articles\\/e\\/d\\/8\\/ed83d0effa0284084b642612ec16131e55174099.jpeg\"}}]'),
	(56,28,'en','JEANS LOVER','','JEANS LOVER','','jeans-lover','/storage/articles/e/d/8/ed83d0effa0284084b642612ec16131e55174099.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Brands used to create this look:\\n\\n* LUISA CERANO\\n\\n* GEORGES RECH\\n\\n* RAFAELLO ROSSI\",\"image\":\"\\/storage\\/articles\\/e\\/d\\/8\\/ed83d0effa0284084b642612ec16131e55174099.jpeg\"}}]'),
	(57,29,'fr','TOP SECRET','','TOP SECRET','','top-secret','/storage/articles/9/4/e/94e96c35af6f89a24f31022bba3dca252b2a6422.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Marques utilis\\u00e9es pour r\\u00e9aliser ce look:\\n\\n* LAUR\\u00c8L\\n\\n* CBY WHITE\",\"image\":\"\\/storage\\/articles\\/9\\/4\\/e\\/94e96c35af6f89a24f31022bba3dca252b2a6422.jpeg\"}}]'),
	(58,29,'en','TOP SECRET','','TOP SECRET','','top-secret','/storage/articles/9/4/e/94e96c35af6f89a24f31022bba3dca252b2a6422.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Brands used to create this look:\\n\\n* LAUR\\u00c8L\\n\\n* CBY WHITE\",\"image\":\"\\/storage\\/articles\\/9\\/4\\/e\\/94e96c35af6f89a24f31022bba3dca252b2a6422.jpeg\"}}]'),
	(59,30,'fr','TOUT DE GRIS','','TOUT DE GRIS','','tout-de-gris','/storage/articles/f/8/e/f8e8f7f997ab2d33485261132ff58035abcc911a.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Marques utilis\\u00e9es pour r\\u00e9aliser ce look:\\n\\n* MARC CAIN\\n\\n* ALLUDE\",\"image\":\"\\/storage\\/articles\\/f\\/8\\/e\\/f8e8f7f997ab2d33485261132ff58035abcc911a.jpeg\"}},{\"templateId\":\"blockText\",\"data\":{\"text0\":\"\",\"text1\":\"\"}}]'),
	(60,30,'en','ALL GREY','','ALL GREY','','all-grey','/storage/articles/f/8/e/f8e8f7f997ab2d33485261132ff58035abcc911a.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Brands used to create this look:\\n\\n* MARC CAIN\\n\\n* ALLUDE\",\"image\":\"\\/storage\\/articles\\/f\\/8\\/e\\/f8e8f7f997ab2d33485261132ff58035abcc911a.jpeg\"}}]'),
	(63,32,'fr','SPORT','','SPORT','','sport','/storage/articles/1/b/5/1b54dc76884a359adf0cb0163bb88380358ae3d4.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Marques utilis\\u00e9es pour r\\u00e9aliser ce look:\\n\\n* CBY WHITE\\n\\n* MARC CAIN\\n\\n* RAFAELLO ROSSI\",\"image\":\"\\/storage\\/articles\\/1\\/b\\/5\\/1b54dc76884a359adf0cb0163bb88380358ae3d4.jpeg\"}}]'),
	(64,32,'en','SPORT','','SPORT','','sport','/storage/articles/1/b/5/1b54dc76884a359adf0cb0163bb88380358ae3d4.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Brands used to create this look:\\n\\n* CBY WHITE\\n\\n* MARC CAIN\\n\\n* RAFAELLO ROSSI\",\"image\":\"\\/storage\\/articles\\/1\\/b\\/5\\/1b54dc76884a359adf0cb0163bb88380358ae3d4.jpeg\"}}]'),
	(65,33,'fr','PRINCESSE','','PRINCESSE','','princesse','/storage/articles/9/8/d/98d3d210645c1dcfc1f086f05898f858ef98d9df.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Marque utilis\\u00e9e pour r\\u00e9aliser ce look:\\n\\n* JS COLLECTION\",\"image\":\"\\/storage\\/articles\\/9\\/8\\/d\\/98d3d210645c1dcfc1f086f05898f858ef98d9df.jpeg\"}}]'),
	(66,33,'en','PRINCESS','','PRINCESS','','princess','/storage/articles/9/8/d/98d3d210645c1dcfc1f086f05898f858ef98d9df.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Brand used to create this look:\\n\\n* JS COLLECTION\",\"image\":\"\\/storage\\/articles\\/9\\/8\\/d\\/98d3d210645c1dcfc1f086f05898f858ef98d9df.jpeg\"}}]'),
	(67,34,'fr','TARTAN','','TARTAN','','tartan','/storage/articles/2/1/7/217fc80978939349947a761c78cb6a1bb0f65118.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Marques utilis\\u00e9es pour r\\u00e9aliser ce look:\\n\\n* CAMBIO\\n\\n* RIANI\",\"image\":\"\\/storage\\/articles\\/2\\/1\\/7\\/217fc80978939349947a761c78cb6a1bb0f65118.jpeg\"}}]'),
	(68,34,'en','TARTAN','','TARTAN','','tartan','/storage/articles/2/1/7/217fc80978939349947a761c78cb6a1bb0f65118.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Brands used to create this look:\\n\\n* CAMBIO\\n\\n* RIANI\",\"image\":\"\\/storage\\/articles\\/2\\/1\\/7\\/217fc80978939349947a761c78cb6a1bb0f65118.jpeg\"}}]'),
	(69,35,'fr','ANGE','','ANGE','','ange','/storage/articles/2/1/b/21b5193eb9b2f70ac9888bf81649a72e18d95399.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Marques utilis\\u00e9es pour r\\u00e9aliser ce look:\\n\\n* ALLUDE\\n\\n* CBY WHITE\\n\\n* MARC CAIN\\n\\n* 360 SWEATER\",\"image\":\"\\/storage\\/articles\\/2\\/1\\/b\\/21b5193eb9b2f70ac9888bf81649a72e18d95399.jpeg\"}}]'),
	(70,35,'en','ANGEL','','ANGEL','','angel','/storage/articles/2/1/b/21b5193eb9b2f70ac9888bf81649a72e18d95399.jpeg','[{\"templateId\":\"blockImageText\",\"data\":{\"text\":\"Brands used to create this look:\\n\\n* ALLUDE\\n\\n* CBY WHITE\\n\\n* MARC CAIN\\n\\n* 360 SWEATER\",\"image\":\"\\/storage\\/articles\\/2\\/1\\/b\\/21b5193eb9b2f70ac9888bf81649a72e18d95399.jpeg\"}}]');

/*!40000 ALTER TABLE `article_translations` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table articles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `articles`;

CREATE TABLE `articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` enum('draft','approved') COLLATE utf8_unicode_ci NOT NULL,
  `section` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `publication_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `articles_status_section_publication_date_index` (`status`,`section`,`publication_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;

INSERT INTO `articles` (`id`, `status`, `section`, `publication_date`, `created_at`, `updated_at`)
VALUES
	(3,'approved','lookbook','2017-02-14','2017-02-03 16:40:08','2017-02-14 12:44:09'),
	(4,'approved','blog','2017-02-03','2017-02-03 18:35:33','2017-02-03 18:35:33'),
	(5,'approved','lookbook','2017-02-14','2017-02-08 18:28:45','2017-02-14 12:44:26'),
	(6,'approved','lookbook','2017-02-14','2017-02-08 18:30:54','2017-02-14 12:44:41'),
	(7,'approved','lookbook','2017-02-14','2017-02-08 18:31:52','2017-02-14 12:44:56'),
	(8,'approved','lookbook','2017-02-14','2017-02-08 18:32:51','2017-02-14 12:45:16'),
	(9,'approved','lookbook','2017-02-14','2017-02-09 16:16:30','2017-02-14 12:46:36'),
	(10,'approved','lookbook','2017-02-14','2017-02-09 16:17:32','2017-02-14 12:50:54'),
	(11,'approved','lookbook','2017-02-14','2017-02-09 16:18:28','2017-02-14 12:52:55'),
	(12,'approved','lookbook','2017-02-14','2017-02-09 16:19:21','2017-02-14 12:59:28'),
	(13,'approved','lookbook','2017-02-14','2017-02-09 16:20:10','2017-02-14 13:06:50'),
	(14,'approved','lookbook','2017-02-14','2017-02-09 16:21:07','2017-02-14 13:25:03'),
	(15,'approved','lookbook','2017-02-14','2017-02-09 16:28:56','2017-02-14 13:29:33'),
	(16,'approved','lookbook','2017-02-14','2017-02-09 16:30:02','2017-02-14 13:33:44'),
	(17,'approved','lookbook','2017-02-14','2017-02-09 16:30:50','2017-02-14 13:37:35'),
	(18,'approved','lookbook','2017-02-14','2017-02-09 16:31:35','2017-02-14 13:39:31'),
	(19,'approved','lookbook','2017-02-14','2017-02-09 16:32:42','2017-02-14 13:44:45'),
	(20,'approved','lookbook','2017-02-14','2017-02-09 16:33:30','2017-02-14 14:00:45'),
	(21,'approved','lookbook','2017-02-14','2017-02-09 16:34:26','2017-02-14 14:03:17'),
	(22,'approved','lookbook','2017-02-14','2017-02-09 16:36:00','2017-02-14 14:05:19'),
	(23,'approved','lookbook','2017-02-14','2017-02-12 13:49:41','2017-02-14 14:06:57'),
	(24,'approved','lookbook','2017-02-14','2017-02-12 13:51:16','2017-02-14 14:08:10'),
	(25,'approved','lookbook','2017-02-14','2017-02-12 14:07:21','2017-02-14 14:16:12'),
	(26,'approved','lookbook','2017-02-14','2017-02-12 14:08:35','2017-02-14 14:27:27'),
	(27,'approved','lookbook','2017-02-14','2017-02-12 14:10:20','2017-02-14 14:31:06'),
	(28,'approved','lookbook','2017-02-14','2017-02-12 14:11:32','2017-02-14 14:33:47'),
	(29,'approved','lookbook','2017-02-14','2017-02-12 14:12:49','2017-02-14 14:37:51'),
	(30,'approved','lookbook','2017-02-14','2017-02-12 14:14:36','2017-02-14 14:40:39'),
	(32,'approved','lookbook','2017-02-14','2017-02-12 14:17:54','2017-02-14 14:45:32'),
	(33,'approved','lookbook','2017-02-14','2017-02-12 14:20:32','2017-02-14 14:39:06'),
	(34,'approved','lookbook','2017-02-14','2017-02-12 14:22:04','2017-02-14 14:43:29'),
	(35,'approved','lookbook','2017-02-14','2017-02-12 14:23:22','2017-02-14 14:36:11');

/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table kit_requests
# ------------------------------------------------------------

DROP TABLE IF EXISTS `kit_requests`;

CREATE TABLE `kit_requests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `budget` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  `status` enum('pending','answered') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kit_requests_customer_id_status_index` (`customer_id`,`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `kit_requests` WRITE;
/*!40000 ALTER TABLE `kit_requests` DISABLE KEYS */;

INSERT INTO `kit_requests` (`id`, `customer_id`, `name`, `budget`, `comment`, `status`, `created_at`, `updated_at`)
VALUES
	(1,7,'asDasda','-1000','','answered','2017-02-03 20:29:26','2017-02-03 20:31:21'),
	(2,12,'dxczxc','-50_complet','zxczxc','pending','2017-09-28 08:50:28','2017-09-28 08:50:28');

/*!40000 ALTER TABLE `kit_requests` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table kits
# ------------------------------------------------------------

DROP TABLE IF EXISTS `kits`;

CREATE TABLE `kits` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `kit_request_id` int(11) DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('draft','pending','seen','sold') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'draft',
  `expire_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kits_customer_id_kit_request_id_status_index` (`customer_id`,`kit_request_id`,`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `kits` WRITE;
/*!40000 ALTER TABLE `kits` DISABLE KEYS */;

INSERT INTO `kits` (`id`, `customer_id`, `kit_request_id`, `photo`, `status`, `expire_at`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,7,1,'kits/abvmTT2Pz1OtvGzG9DxJ.jpg','sold','2017-02-14 05:00:00','2017-02-03 20:31:21','2017-02-10 13:31:37',NULL);

/*!40000 ALTER TABLE `kits` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`migration`, `batch`)
VALUES
	('2014_10_12_000000_create_users_table',1),
	('2014_10_12_100000_create_password_resets_table',1),
	('2016_10_08_135739_create_transactions_table',1),
	('2016_10_08_140220_create_products_table',1),
	('2016_10_12_183331_create_articles_table',1),
	('2016_11_08_211658_create_kit_requests_table',1),
	('2016_11_09_142656_create_kits_table',1),
	('2016_12_19_155727_add_submit_to_kits_status',1),
	('2016_12_21_165221_change_status_in_kits_kitrequests_transactions',1),
	('2016_12_23_133049_modify_products_transaction_id_type',1),
	('2016_12_23_143012_add_transactions_tracking_number',1),
	('2016_12_28_151223_create_addresses_table',1),
	('2016_12_29_151343_add_transactions_shipping_address_and_billing_address',1),
	('2017_01_03_105009_add_expire_at_to_kits',1),
	('2017_01_18_161142_create_provinces_table',1),
	('2017_01_18_162002_create_taxes_table',1),
	('2017_02_02_102042_add_express_shipping_to_transactions',1);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table password_resets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Affichage de la table products
# ------------------------------------------------------------

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kit_id` int(11) NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `regular_price` double(8,2) NOT NULL,
  `reduced_price` double(8,2) DEFAULT NULL,
  `marker_x` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `marker_y` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `brand` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_kit_id_transaction_id_index` (`kit_id`,`transaction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;

INSERT INTO `products` (`id`, `kit_id`, `transaction_id`, `name`, `regular_price`, `reduced_price`, `marker_x`, `marker_y`, `brand`, `created_at`, `updated_at`)
VALUES
	(1,1,'ch_19jDmHHz4fdKLD6pd11jGo9V','Barbe',5.00,2.00,'54.473684210526315%','36.26990365806841%','Magic','2017-02-03 20:31:21','2017-02-10 13:31:37'),
	(2,1,'ch_19jDmHHz4fdKLD6pd11jGo9V','anneau',3.00,1.00,'74.3859649122807%','98.22123909983364%','bete de foire','2017-02-03 20:31:21','2017-02-10 13:31:37'),
	(3,1,'ch_19jDmHHz4fdKLD6pd11jGo9V','Fond d\'écran',5768.00,3.00,'11.228070175438596%','71.07731120089213%','Blanc','2017-02-03 20:31:21','2017-02-10 13:31:37');

/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table provinces
# ------------------------------------------------------------

DROP TABLE IF EXISTS `provinces`;

CREATE TABLE `provinces` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `provinces` WRITE;
/*!40000 ALTER TABLE `provinces` DISABLE KEYS */;

INSERT INTO `provinces` (`id`, `key`, `created_at`, `updated_at`)
VALUES
	(1,'alberta','2017-02-02 18:27:28','2017-02-02 18:27:28'),
	(2,'british-columbia','2017-02-02 18:27:28','2017-02-02 18:27:28'),
	(3,'manitoba','2017-02-02 18:27:28','2017-02-02 18:27:28'),
	(4,'new-brunswick','2017-02-02 18:27:28','2017-02-02 18:27:28'),
	(5,'newfoundland-and-labrador','2017-02-02 18:27:28','2017-02-02 18:27:28'),
	(6,'northwest-territories','2017-02-02 18:27:28','2017-02-02 18:27:28'),
	(7,'nova-scotia','2017-02-02 18:27:28','2017-02-02 18:27:28'),
	(8,'nunavut','2017-02-02 18:27:28','2017-02-02 18:27:28'),
	(9,'ontario','2017-02-02 18:27:28','2017-02-02 18:27:28'),
	(10,'prince-edward-island','2017-02-02 18:27:28','2017-02-02 18:27:28'),
	(11,'quebec','2017-02-02 18:27:28','2017-02-02 18:27:28'),
	(12,'saskatchewan','2017-02-02 18:27:28','2017-02-02 18:27:28'),
	(13,'yukon','2017-02-02 18:27:28','2017-02-02 18:27:28');

/*!40000 ALTER TABLE `provinces` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table taxes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `taxes`;

CREATE TABLE `taxes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `percentage` double DEFAULT NULL,
  `province_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `taxes` WRITE;
/*!40000 ALTER TABLE `taxes` DISABLE KEYS */;

INSERT INTO `taxes` (`id`, `key`, `percentage`, `province_id`, `created_at`, `updated_at`)
VALUES
	(1,'TPS',0.05,1,'2017-02-02 18:27:28','2017-02-03 15:25:15'),
	(2,'',NULL,1,'2017-02-02 18:27:28','2017-02-03 15:25:15'),
	(3,'TPS',0.05,2,'2017-02-02 18:27:28','2017-02-03 15:25:15'),
	(4,'TVP',0.07,2,'2017-02-02 18:27:28','2017-02-03 15:25:15'),
	(5,'TPS',0.05,3,'2017-02-02 18:27:28','2017-02-03 15:25:15'),
	(6,'TVP',0.08,3,'2017-02-02 18:27:28','2017-02-03 15:25:16'),
	(7,'TVH',0.15,4,'2017-02-02 18:27:28','2017-02-03 15:25:16'),
	(8,'',NULL,4,'2017-02-02 18:27:28','2017-02-03 15:25:16'),
	(9,'TVH',0.15,5,'2017-02-02 18:27:28','2017-02-03 15:25:16'),
	(10,'',NULL,5,'2017-02-02 18:27:28','2017-02-03 15:25:16'),
	(11,'TPS',0.05,6,'2017-02-02 18:27:28','2017-02-03 15:25:16'),
	(12,'',NULL,6,'2017-02-02 18:27:28','2017-02-03 15:25:16'),
	(13,'TVH',0.15,7,'2017-02-02 18:27:28','2017-02-03 15:25:16'),
	(14,'',NULL,7,'2017-02-02 18:27:28','2017-02-03 15:25:16'),
	(15,'TPS',0.05,8,'2017-02-02 18:27:28','2017-02-03 15:25:16'),
	(16,'',NULL,8,'2017-02-02 18:27:28','2017-02-03 15:25:16'),
	(17,'TVH',0.13,9,'2017-02-02 18:27:28','2017-02-03 15:25:16'),
	(18,'',NULL,9,'2017-02-02 18:27:28','2017-02-03 15:25:16'),
	(19,'TVH',0.15,10,'2017-02-02 18:27:28','2017-02-03 15:25:16'),
	(20,'',NULL,10,'2017-02-02 18:27:28','2017-02-03 15:25:16'),
	(21,'TPS',0.05,11,'2017-02-02 18:27:28','2017-02-03 15:25:16'),
	(22,'TVQ',0.9975,11,'2017-02-02 18:27:28','2017-02-03 15:25:16'),
	(23,'TPS',0.05,12,'2017-02-02 18:27:28','2017-02-03 15:25:16'),
	(24,'TVP',0.05,12,'2017-02-02 18:27:28','2017-02-03 15:25:16'),
	(25,'TPS',0.05,13,'2017-02-02 18:27:28','2017-02-03 15:25:16'),
	(26,'',NULL,13,'2017-02-02 18:27:28','2017-02-03 15:25:16');

/*!40000 ALTER TABLE `taxes` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table transactions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `transactions`;

CREATE TABLE `transactions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `status` enum('paid','sent','returned','refund') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'paid',
  `subtotal` double(8,2) NOT NULL,
  `tax0` double(8,2) NOT NULL,
  `tax1` double(8,2) DEFAULT NULL,
  `express_shipping` tinyint(1) NOT NULL,
  `total` double(8,2) NOT NULL,
  `stripe_transaction_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kit_id` int(11) NOT NULL,
  `tracking_number` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `shipping_address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `billing_address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transactions_customer_id_status_kit_id_index` (`customer_id`,`status`,`kit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;

INSERT INTO `transactions` (`id`, `customer_id`, `status`, `subtotal`, `tax0`, `tax1`, `express_shipping`, `total`, `stripe_transaction_id`, `kit_id`, `tracking_number`, `shipping_address`, `billing_address`, `created_at`, `updated_at`)
VALUES
	(1,7,'sent',6.00,2.80,55.86,50,114.66,'ch_19jDmHHz4fdKLD6pd11jGo9V',1,'','contact','contact','2017-02-03 20:35:10','2017-02-10 13:31:37');

/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` enum('member','admin') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'member',
  `google_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `preferences` text COLLATE utf8_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `language` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_name_email_role_index` (`name`,`email`,`role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `google_id`, `facebook_id`, `avatar`, `preferences`, `remember_token`, `created_at`, `updated_at`, `language`)
VALUES
	(1,'Marc-Antoine Noreau-Marois','manoreaumarois@imarcom.net',NULL,'admin','102374776375498318675',NULL,'https://lh3.googleusercontent.com/-sAtq-S0s-M8/AAAAAAAAAAI/AAAAAAAAAAA/9kalTMUuUA4/photo.jpg?sz=50',NULL,'rCoWDKEA4NNBVVTgfqwvHateeVUQHIb4HZHA88xEzsx7Xj8SCWdDH93MeRpS','2017-02-02 18:27:28','2017-02-13 14:20:22',NULL),
	(2,'Christian Bergeron','christianbergeron44@hotmail.com',NULL,'member',NULL,'10212048214907268','https://graph.facebook.com/v2.8/10212048214907268/picture?type=normal','{\"styles\":[],\"lastQuestionAnswered\":\"10\",\"hairColor\":[\"brun-fonce\"],\"eyeColor\":[\"bleu-pale\"],\"skinColor\":[\"f6e9da\"],\"hairColors\":[],\"eyeColors\":[],\"skinColors\":[],\"bodyShape\":[\"hourglass\"],\"bodyShapes\":[],\"height\":\"58\",\"weight\":\"123\",\"weightUnit\":[\"livres\"],\"braBandSize\":\"n\\/a\",\"braCupSize\":\"n\\/a\",\"shoeSize\":\"6\",\"allergies\":\"\",\"pantsSize\":\"2\",\"favoritePants\":[\"taille-haute\"],\"shirtSize\":\"2\",\"dressSize\":\"2\",\"piercedEars\":[\"0\"],\"weightUnits\":[],\"excludedSkirts\":[],\"excludedPants\":[],\"excludedTops\":[],\"excludedNecks\":[],\"excludedClothes\":[],\"excludedColors\":[],\"favoritePatterns\":[],\"favoriteAccessories\":[],\"favoriteColors\":[],\"favoriteClothes\":[],\"brands\":[],\"name\":\"Christian Bergeron\",\"address\":\"123 fausse rue\",\"city\":\"quebec\",\"postal_code\":\"g1g1g1\",\"province\":\"quebec\",\"phone\":\"4445556666\",\"contact_method\":\"email\",\"contact_hours\":\"\",\"terms\":\"on\",\"provinces\":[]}','7FbxAZDYfzMp6Yhn8MbZNZc7t7gTRl5TK6UCdSEQw5apOFiSvM1QzPKATTwt','2017-02-02 18:28:11','2017-02-02 20:11:48',NULL),
	(3,NULL,'samuel.richard@imarcom.net','$2y$10$ePbuPkS8zZqib.I1jtg6u.1zhvAeQvQlPMG8xIPDc0ZJPXL78bZ5a','admin','111159456794550108785',NULL,'https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=50',NULL,'gwE2fxKlho4ozCwEKqh5Tq5FpEHRTqfeXzDCEDljH52FUMaIYnNtpCBCNmq3','2017-02-02 19:31:36','2017-02-08 18:37:17',NULL),
	(4,NULL,'m_cheikha@hotmail.com','$2y$10$v4mjyyrHJEqK27Btl0R1rOonft9CoGLH5QyC2aPbmHwfOgfa1ODA2','admin',NULL,'10154754945225102','https://graph.facebook.com/v2.8/10154754945225102/picture?type=normal',NULL,'IHKWGpZ61f873PnFY4m98AdhcOAODQKVaOJt22ZaKga7O3rIUpWvBoXjWC9G','2017-02-02 19:31:41','2017-02-13 20:42:08',NULL),
	(5,'Christian Bergeron','christian@imarcom.net','$2y$10$eOWmptJ7VacEi2x2CejOPOagduubHBvj130IfVFJHu0Lk3pwPwH92','member',NULL,NULL,NULL,'{\"styles\":[],\"lastQuestionAnswered\":\"10\",\"hairColor\":[\"gris\"],\"eyeColor\":[\"bleu-fonce\"],\"skinColor\":[\"d4b5a1\"],\"hairColors\":[],\"eyeColors\":[],\"skinColors\":[],\"bodyShape\":[\"hourglass\"],\"bodyShapes\":[],\"height\":\"59\",\"weight\":\"123\",\"weightUnit\":[\"livres\"],\"braBandSize\":\"32\",\"braCupSize\":\"n\\/a\",\"shoeSize\":\"7\",\"allergies\":\"\",\"pantsSize\":\"4\",\"favoritePants\":[\"taille-haute\"],\"shirtSize\":\"4\",\"dressSize\":\"2\",\"piercedEars\":[\"0\"],\"weightUnits\":[],\"excludedSkirts\":[],\"excludedPants\":[],\"excludedTops\":[],\"excludedNecks\":[],\"excludedClothes\":[],\"excludedColors\":[],\"favoritePatterns\":[],\"favoriteAccessories\":[],\"favoriteColors\":[],\"favoriteClothes\":[],\"brands\":[],\"name\":\"Christian Bergeron\",\"address\":\"839 rue saint-joseph est #110\",\"city\":\"Qu\\u00e9bec\",\"postal_code\":\"g1g1g1\",\"province\":\"quebec\",\"phone\":\"4445556666\",\"contact_method\":\"email\",\"contact_hours\":\"\",\"terms\":\"on\",\"provinces\":[]}','sPNwqTmn0eNy3YtAOg4iL4gBOc8Lva89Gqd1Z0MQKgbpQykCCRX7zdLKEdGd','2017-02-02 20:11:55','2017-02-03 15:53:40',NULL),
	(6,'Inès Hamard','ines@imarcom.ca','$2y$10$tPMhsgw3sWwLpV0nl9YK/.mwW2KjKtyHuKeNvnWSA2tZWCyxbkqUq','admin',NULL,NULL,NULL,'{\"styles\":[\"glamour\"],\"lastQuestionAnswered\":\"10\",\"hairColor\":[\"brun-fonce\"],\"eyeColor\":[\"gris\"],\"skinColor\":[\"e8cbba\"],\"hairColors\":[],\"eyeColors\":[],\"skinColors\":[],\"bodyShape\":[\"hourglass\"],\"bodyShapes\":[],\"height\":\"64\",\"weight\":\"115\",\"weightUnit\":[\"livres\"],\"braBandSize\":\"32\",\"braCupSize\":\"b\",\"shoeSize\":\"7,5\",\"allergies\":\"\",\"pantsSize\":\"2\",\"favoritePants\":[\"taille-haute\"],\"shirtSize\":\"2\",\"dressSize\":\"2\",\"piercedEars\":[\"1\"],\"weightUnits\":[],\"excludedSkirts\":[],\"excludedPants\":[],\"excludedTops\":[],\"excludedNecks\":[],\"excludedClothes\":[],\"excludedColors\":[],\"favoritePatterns\":[],\"favoriteAccessories\":[],\"favoriteColors\":[],\"favoriteClothes\":[],\"brands\":[],\"name\":\"In\\u00e8s Hamard\",\"address\":\"839 rue st joseph est\",\"city\":\"Qu\\u00e9bec\",\"postal_code\":\"G1K 3C8\",\"province\":\"quebec\",\"phone\":\"5555555555\",\"contact_method\":\"email\",\"contact_hours\":\"\",\"terms\":\"on\",\"provinces\":[]}',NULL,'2017-02-03 16:34:09','2017-02-03 16:34:09',NULL),
	(7,'Samuel Richard','samuelrichard31@gmail.com',NULL,'member','110055589259052811802',NULL,'https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=50','{\"styles\":[\"cocktail\"],\"lastQuestionAnswered\":\"10\",\"hairColor\":[\"blond-pale\"],\"eyeColor\":[\"bleu-pale\"],\"skinColor\":[\"f6e9da\"],\"hairColors\":[],\"eyeColors\":[],\"skinColors\":[],\"bodyShape\":[\"hourglass\"],\"bodyShapes\":[],\"height\":\"59\",\"weight\":\"500\",\"weightUnit\":[\"livres\"],\"braBandSize\":\"32\",\"braCupSize\":\"c\",\"shoeSize\":\"6,5\",\"allergies\":\"kryptonite\",\"pantsSize\":\"6\",\"favoritePants\":[\"taille-haute\"],\"shirtSize\":\"4\",\"dressSize\":\"10\",\"piercedEars\":[\"1\"],\"weightUnits\":[],\"excludedSkirts\":[],\"excludedPants\":[],\"excludedTops\":[],\"excludedNecks\":[],\"excludedClothes\":[],\"excludedColors\":[],\"favoritePatterns\":[],\"favoriteAccessories\":[],\"favoriteColors\":[],\"favoriteClothes\":[],\"brand\":[\"laurel\"],\"brands\":[],\"name\":\"Samuel Richard\",\"address\":\"asDadsaSD\",\"city\":\"asdaAs\",\"postal_code\":\"g1e 2r4\",\"province\":\"quebec\",\"phone\":\"4188888888\",\"contact_method\":\"email\",\"contact_hours\":\"\",\"terms\":\"on\",\"provinces\":[]}','aZ0yBpAMwch7iR3qvnzL2GUEbj6YIiC3QRjbiTumerbbgHRpQrP8GEC7EyTv','2017-02-03 20:25:07','2017-02-08 18:27:03',NULL),
	(8,'Stephanie Johnson','stephjohnson05@hotmail.com',NULL,'member',NULL,'1452999081385553','https://graph.facebook.com/v2.8/1452999081385553/picture?type=normal','{\"styles\":[],\"lastQuestionAnswered\":\"4\",\"hairColor\":[\"chatain\"],\"eyeColor\":[\"gris\"],\"skinColor\":[\"e9d3c1\"],\"hairColors\":[],\"eyeColors\":[],\"skinColors\":[],\"bodyShape\":[\"hourglass\"],\"bodyShapes\":[]}','oMV0wODNAq2PYFBni3VVVukB9g644vIDUAlOYoYd5fqmQoQpvUsx7pApGIhm','2017-02-08 00:06:55','2017-02-08 00:12:24',NULL),
	(9,NULL,'info@organik-multimedia.com','$2y$10$u.eH.vlu.6YnRkS5qPaa/.piRuxXaajfRyT9JNklSFfN6UFg0MlvO','member',NULL,NULL,NULL,'{\"styles\":[],\"lastQuestionAnswered\":\"9\",\"hairColor\":[\"brun-pale\"],\"eyeColor\":[\"brun-pale\"],\"skinColor\":[\"d4b5a1\"],\"hairColors\":[],\"eyeColors\":[],\"skinColors\":[],\"bodyShape\":[\"hourglass\"],\"bodyShapes\":[],\"height\":\"59\",\"weight\":\"43\",\"weightUnit\":[\"livres\"],\"braBandSize\":\"34\",\"braCupSize\":\"d\",\"shoeSize\":\"7\",\"allergies\":\"\",\"pantsSize\":\"6\",\"favoritePants\":[\"taille-haute\"],\"shirtSize\":\"10\",\"dressSize\":\"6\",\"piercedEars\":[\"1\"],\"weightUnits\":[],\"excludedSkirts\":[\"short\"],\"excludedPants\":[\"three-quarter\"],\"excludedTops\":[\"sleeveless-camisoles\"],\"excludedNecks\":[\"v-neck\"],\"excludedClothes\":[\"one-piece\"],\"excludedColors\":[\"2869c1\"],\"favoritePatterns\":[\"handstooth\"],\"favoriteAccessories\":[\"rings\"],\"favoriteColors\":[\"5b006f\"],\"showArms\":[\"0\"],\"showChest\":[\"1\"],\"favoriteClothes\":[\"amples\"],\"brand\":[\"marc-cain\",\"luisa-cerano\"],\"brands\":[]}',NULL,'2017-02-10 17:09:42','2017-02-10 17:15:23',NULL),
	(10,NULL,'mccheikha@groupecheikha.com','$2y$10$RnkauIXC7oUf5p1e4.IuAOUU1Ru0MYgfYPy.xG79EYjX35M6WsoNC','member',NULL,NULL,NULL,'{\"styles\":[\"classique\"],\"lastQuestionAnswered\":\"9\",\"hairColor\":[\"rouge\"],\"eyeColor\":[\"bleu-fonce\"],\"skinColor\":[\"d4b5a1\"],\"hairColors\":[],\"eyeColors\":[],\"skinColors\":[],\"bodyShape\":[\"pear\"],\"bodyShapes\":[],\"height\":\"59\",\"weight\":\"134\",\"weightUnit\":[\"livres\"],\"braBandSize\":\"38\",\"braCupSize\":\"d\",\"shoeSize\":\"7.5\",\"allergies\":\"\",\"pantsSize\":\"4\",\"favoritePants\":[\"taille-haute\"],\"shirtSize\":\"10\",\"dressSize\":\"8\",\"piercedEars\":[\"1\"],\"weightUnits\":[],\"excludedSkirts\":[\"short\"],\"excludedPants\":[\"capri\"],\"excludedTops\":[\"sleeveless-camisoles\"],\"excludedNecks\":[\"turtleneck\"],\"excludedClothes\":[\"one-piece\"],\"excludedColors\":[\"2869c1\"],\"favoritePatterns\":[],\"favoriteAccessories\":[],\"favoriteColors\":[],\"showArms\":[\"0\"],\"showChest\":[\"1\"],\"favoriteClothes\":[\"droits\"],\"brands\":[]}','OO6ZK6xAnW6Sc474eO1WZtu1eIwd0AVEWM3TT8EmSxo8s9WSpL6UAml8Knqu','2017-02-13 20:42:53','2017-02-13 20:59:24',NULL),
	(11,NULL,'mister-guanaco@hotmail.com','$2y$10$NoTy6RXg.QYpsqwQbc2khudDQ7LTX.iOqT.2O6lXvPt08.awtPCVu','member',NULL,NULL,NULL,'{\"styles\":[\"sportif\",\"chic-event\"],\"lastQuestionAnswered\":\"5\",\"hairColor\":[\"brun-rouge\"],\"eyeColor\":[\"brun\"],\"skinColor\":[\"e9d3c1\"],\"hairColors\":[],\"eyeColors\":[],\"skinColors\":[],\"bodyShape\":[\"pear\"],\"bodyShapes\":[],\"height\":\"58\",\"weight\":\"45\",\"weightUnit\":[\"livres\"],\"braBandSize\":\"38\",\"braCupSize\":\"d\",\"shoeSize\":\"8\",\"allergies\":\"\",\"pantsSize\":\"6\",\"favoritePants\":[\"taille-haute\"],\"shirtSize\":\"10\",\"dressSize\":\"10\",\"piercedEars\":[\"1\"],\"weightUnits\":[]}',NULL,'2017-02-13 22:21:43','2017-02-13 22:23:05',NULL),
	(12,'test','joel@kffein.com','$2y$10$YC67tVpk2JBpo5/Lc/jl4upmMzjOAyaGSkoECdndyzqn0FT69rF3a','member',NULL,NULL,NULL,'{\"styles\":[\"outdoor\"],\"lastQuestionAnswered\":\"10\",\"hairColor\":[\"noir\"],\"eyeColor\":[\"vert\"],\"skinColor\":[\"e7caab\"],\"hairColors\":[],\"eyeColors\":[],\"skinColors\":[],\"bodyShape\":[\"apple\"],\"bodyShapes\":[],\"height\":\"59\",\"weight\":\"123\",\"weightUnit\":[\"livres\"],\"braBandSize\":\"34\",\"braCupSize\":\"c\",\"shoeSize\":\"7\",\"allergies\":\"\",\"pantsSize\":\"6\",\"favoritePants\":[\"taille-haute\"],\"shirtSize\":\"8\",\"dressSize\":\"8\",\"piercedEars\":[\"1\"],\"weightUnits\":[],\"excludedSkirts\":[],\"excludedPants\":[],\"excludedTops\":[],\"excludedNecks\":[],\"excludedClothes\":[],\"excludedColors\":[],\"favoritePatterns\":[\"leopard\"],\"favoriteAccessories\":[\"earrings\"],\"favoriteColors\":[\"2869c1\"],\"favoriteClothes\":[],\"brands\":[],\"name\":\"test\",\"address\":\"test\",\"city\":\"test\",\"postal_code\":\"t6y7u8\",\"province\":\"quebec\",\"phone\":\"4445556666\",\"contact_method\":\"email\",\"contact_hours\":\"\",\"birthday\":{\"year\":\"1987\",\"month\":\"01\",\"day\":\"02\"},\"terms\":\"on\",\"provinces\":[]}',NULL,'2017-09-28 08:47:37','2017-09-28 08:50:01','fr');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
