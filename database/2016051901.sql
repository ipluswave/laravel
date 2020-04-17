/*
SQLyog Ultimate v8.55 
MySQL - 5.5.5-10.1.13-MariaDB : Database - laravel-example
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`laravel-example` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `laravel-example`;

/*Table structure for table `comments` */

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL,
  `post_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_user_id_foreign` (`user_id`),
  KEY `comments_post_id_foreign` (`post_id`),
  CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `comments` */

insert  into `comments`(`id`,`created_at`,`updated_at`,`content`,`seen`,`user_id`,`post_id`) values (1,'2016-05-20 13:28:35','2016-05-20 13:28:35','<p>\nLorem ipsum rhoncus facilisis neque accumsan in ad venenatis hac per, dictumst nulla ligula donec mollis massa porttitor ullamcorper risus eu, platea fringilla habitasse suscipit pellentesque donec est habitant vehicula. \nTempor ultrices placerat sociosqu ultrices consectetur ullamcorper, tincidunt quisque tellus ante nostra euismod, nec suspendisse sem curabitur elit. \nMalesuada lacus viverra sagittis sit ornare orci augue nullam, adipiscing pulvinar libero aliquam vestibulum platea cursus pellentesque leo, dui lectus curabitur euismod ad erat curae. \nNon elit ultrices placerat netus metus feugiat non conubia fusce, porttitor sociosqu diam commodo metus in himenaeos vitae aptent consequat, luctus purus eleifend enim sollicitudin eleifend porta malesuada. \n</p>\n<p>\nAc class conubia condimentum mauris facilisis conubia quis scelerisque lacinia, tempus nullam felis fusce ac potenti netus ornare semper, molestie iaculis fermentum ornare curabitur tincidunt imperdiet scelerisque. \nImperdiet euismod scelerisque torquent curae rhoncus sollicitudin tortor, placerat aptent hac nec posuere suscipit sed tortor, neque urna hendrerit vehicula duis litora. \nTristique congue nec auctor felis libero ornare habitasse, nec elit felis inceptos tellus inceptos cubilia quis, mattis faucibus sem non odio fringilla. \nClass aliquam metus ipsum lorem luctus pharetra dictum vehicula tempus, in venenatis gravida ut gravida proin orci quis sed platea, mi quisque hendrerit semper hendrerit facilisis ante sapien. \n</p>',0,2,1),(2,'2016-05-20 13:28:35','2016-05-20 13:28:35','<p>\nLorem ipsum aliquam libero commodo vestibulum rutrum pretium varius sem, aliquet himenaeos dolor cursus nunc habitasse aliquam ut curabitur ipsum, luctus ut rutrum odio condimentum donec suscipit molestie. \nEst etiam sit rutrum dui nostra sem aliquet, conubia nullam sollicitudin rhoncus venenatis vivamus rhoncus netus, risus tortor non mauris turpis eget. \nInteger nibh dolor commodo venenatis ut molestie semper adipiscing amet cras, class donec sapien malesuada auctor sapien arcu inceptos aenean, consequat metus litora mattis vivamus feugiat arcu adipiscing mauris. \nPrimis ante ullamcorper ad nisi lobortis arcu per orci malesuada, blandit metus tortor urna turpis consectetur porttitor egestas sed, eleifend eget tincidunt pharetra varius tincidunt morbi malesuada. \n</p>\n<p>\nElementum mi torquent mollis eu lobortis curae purus, amet vivamus amet nulla torquent nibh, eu diam aliquam pretium donec aliquam. \nTempus lacus tempus feugiat lectus cras non, velit mollis sit et integer egestas habitant, auctor integer sem at nam. \nMassa himenaeos netus vel dapibus nibh malesuada leo fusce tortor sociosqu, semper facilisis semper class tempus faucibus tristique duis. \nEros cubilia quisque habitasse aliquam fringilla orci non vel laoreet, dolor enim justo facilisis neque accumsan in ad venenatis hac, per dictumst nulla ligula donec mollis massa porttitor. \nUllamcorper risus eu platea fringilla, habitasse suscipit pellentesque. \n</p>',0,2,2),(3,'2016-05-20 13:28:35','2016-05-20 13:28:35','<p>\nLorem ipsum suscipit ligula habitant vehicula tempor ultrices placerat sociosqu ultrices consectetur ullamcorper, tincidunt quisque tellus ante nostra euismod nec suspendisse sem curabitur elit. \nMalesuada lacus viverra sagittis sit ornare orci, augue nullam adipiscing pulvinar libero aliquam vestibulum, platea cursus pellentesque leo dui. \nLectus curabitur euismod ad erat curae non elit ultrices placerat netus, metus feugiat non conubia fusce porttitor sociosqu diam commodo metus in, himenaeos vitae aptent consequat luctus purus eleifend enim sollicitudin. \nEleifend porta malesuada ac class conubia condimentum mauris facilisis, conubia quis scelerisque lacinia tempus nullam felis fusce, ac potenti netus ornare semper molestie iaculis. \n</p>\n<p>\nFermentum ornare curabitur tincidunt imperdiet scelerisque imperdiet euismod scelerisque torquent, curae rhoncus sollicitudin tortor placerat aptent hac nec posuere suscipit, sed tortor neque urna hendrerit vehicula duis litora. \nTristique congue nec auctor felis libero ornare habitasse, nec elit felis inceptos tellus inceptos cubilia quis, mattis faucibus sem non odio fringilla. \nClass aliquam metus ipsum lorem luctus pharetra dictum vehicula, tempus in venenatis gravida ut gravida proin orci, quis sed platea mi quisque hendrerit semper. \nHendrerit facilisis ante sapien faucibus ligula commodo vestibulum rutrum, pretium varius sem aliquet himenaeos dolor cursus, nunc habitasse aliquam ut curabitur ipsum luctus. \n</p>\n<p>\nUt rutrum odio condimentum, donec. \n</p>',0,3,1);

/*Table structure for table `contacts` */

DROP TABLE IF EXISTS `contacts`;

CREATE TABLE `contacts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `contacts` */

insert  into `contacts`(`id`,`name`,`email`,`text`,`seen`,`created_at`,`updated_at`) values (1,'Dupont','dupont@la.fr','Lorem ipsum inceptos malesuada leo fusce tortor sociosqu semper, facilisis semper class tempus faucibus tristique duis eros, cubilia quisque habitasse aliquam fringilla orci non. Vel laoreet dolor enim justo facilisis neque accumsan, in ad venenatis hac per dictumst nulla ligula, donec mollis massa porttitor ullamcorper risus. Eu platea fringilla, habitasse.',0,'2016-05-20 13:28:34','2016-05-20 13:28:34'),(2,'Durand','durand@la.fr',' Lorem ipsum erat non elit ultrices placerat, netus metus feugiat non conubia fusce porttitor, sociosqu diam commodo metus in. Himenaeos vitae aptent consequat luctus purus eleifend enim, sollicitudin eleifend porta malesuada ac class conubia, condimentum mauris facilisis conubia quis scelerisque. Lacinia tempus nullam felis fusce ac potenti netus ornare semper molestie, iaculis fermentum ornare curabitur tincidunt imperdiet scelerisque imperdiet euismod.',0,'2016-05-20 13:28:34','2016-05-20 13:28:34'),(3,'Martin','martin@la.fr','Lorem ipsum tempor netus aenean ligula habitant vehicula tempor ultrices, placerat sociosqu ultrices consectetur ullamcorper tincidunt quisque tellus, ante nostra euismod nec suspendisse sem curabitur elit. Malesuada lacus viverra sagittis sit ornare orci, augue nullam adipiscing pulvinar libero aliquam vestibulum, platea cursus pellentesque leo dui. Lectus curabitur euismod ad, erat.',1,'2016-05-20 13:28:34','2016-05-20 13:28:34'),(4,'Franck Tiger','francktiger19890921@mail.com','example message',0,'2016-05-20 14:51:28','2016-05-20 14:51:28');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`migration`,`batch`) values ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2014_10_21_105844_create_roles_table',1),('2014_10_21_110325_create_foreign_keys',1),('2014_10_24_205441_create_contact_table',1),('2014_10_26_172107_create_posts_table',1),('2014_10_26_172631_create_tags_table',1),('2014_10_26_172904_create_post_tag_table',1),('2014_10_26_222018_create_comments_table',1);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `post_tag` */

DROP TABLE IF EXISTS `post_tag`;

CREATE TABLE `post_tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(10) unsigned NOT NULL,
  `tag_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_tag_post_id_foreign` (`post_id`),
  KEY `post_tag_tag_id_foreign` (`tag_id`),
  CONSTRAINT `post_tag_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  CONSTRAINT `post_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `post_tag` */

insert  into `post_tag`(`id`,`post_id`,`tag_id`) values (1,1,1),(2,1,2),(3,2,1),(4,2,2),(5,2,3),(6,3,1),(7,3,2),(8,3,4);

/*Table structure for table `posts` */

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `summary` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `posts_slug_unique` (`slug`),
  KEY `posts_user_id_foreign` (`user_id`),
  CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `posts` */

insert  into `posts`(`id`,`created_at`,`updated_at`,`title`,`slug`,`summary`,`content`,`seen`,`active`,`user_id`) values (1,'2016-05-20 13:28:34','2016-05-20 13:28:34','Post 1','post-1','<img alt=\"\" src=\"/filemanager/userfiles/user2/mega-champignon.png\" style=\"float:left; height:128px; width:128px\" /><p>\nLorem ipsum vestibulum aliquam metus ipsum lorem luctus pharetra, dictum vehicula tempus in venenatis gravida ut gravida proin, orci quis sed platea mi quisque hendrerit. \nSemper hendrerit facilisis ante sapien faucibus ligula commodo vestibulum, rutrum pretium varius sem aliquet himenaeos dolor cursus nunc, habitasse aliquam ut curabitur ipsum luctus ut. \n</p>','<p>\nLorem ipsum felis odio condimentum donec suscipit molestie est etiam sit rutrum dui, nostra sem aliquet conubia nullam sollicitudin rhoncus venenatis vivamus rhoncus netus, risus tortor non mauris turpis eget integer nibh dolor commodo venenatis. \nUt molestie semper adipiscing amet cras class donec sapien, malesuada auctor sapien arcu inceptos aenean consequat metus litora, mattis vivamus feugiat arcu adipiscing mauris primis. \nAnte ullamcorper ad nisi lobortis arcu per orci malesuada blandit metus tortor urna turpis consectetur porttitor, egestas sed eleifend eget tincidunt pharetra varius tincidunt morbi malesuada elementum mi torquent. \n</p>\n<p>\nMollis eu lobortis curae purus amet vivamus amet nulla torquent nibh eu, diam aliquam pretium donec aliquam tempus lacus tempus feugiat lectus cras, non velit mollis sit et integer egestas habitant auctor integer. \nSem at nam massa himenaeos netus vel dapibus nibh malesuada leo fusce, tortor sociosqu semper facilisis semper class tempus faucibus tristique duis, eros cubilia quisque habitasse aliquam fringilla orci non vel laoreet. \nDolor enim justo facilisis neque accumsan in ad venenatis hac per, dictumst nulla ligula donec mollis massa porttitor ullamcorper risus, eu platea fringilla habitasse suscipit pellentesque donec est habitant. \n</p>\n<p>\nVehicula tempor ultrices placerat sociosqu ultrices consectetur, ullamcorper tincidunt quisque tellus ante, nostra euismod nec suspendisse sem. \nCurabitur elit malesuada lacus viverra sagittis sit ornare orci, augue nullam adipiscing pulvinar libero aliquam vestibulum platea cursus, pellentesque leo dui lectus curabitur euismod ad. \nErat curae non elit ultrices placerat netus metus feugiat non conubia fusce, porttitor sociosqu diam commodo metus in himenaeos vitae aptent consequat. \nLuctus purus eleifend enim sollicitudin eleifend porta malesuada ac, class conubia condimentum mauris facilisis conubia quis scelerisque lacinia, tempus nullam felis fusce ac potenti netus. \n</p>\n<p>\nOrnare semper molestie iaculis fermentum ornare curabitur, tincidunt imperdiet scelerisque imperdiet euismod scelerisque, torquent curae rhoncus sollicitudin tortor. \nPlacerat aptent hac nec posuere suscipit sed, tortor neque urna hendrerit. \nVehicula duis litora tristique congue nec auctor felis, libero ornare habitasse nec elit felis. \nInceptos tellus inceptos cubilia quis mattis faucibus sem non odio fringilla class, aliquam metus ipsum lorem luctus pharetra dictum vehicula tempus in, venenatis gravida ut gravida proin orci quis sed platea mi. \nQuisque hendrerit semper hendrerit facilisis ante sapien, faucibus ligula commodo vestibulum rutrum pretium, varius sem aliquet himenaeos dolor. \n</p>\n<p>\nCursus nunc habitasse aliquam ut curabitur ipsum luctus ut rutrum odio condimentum, donec suscipit molestie est etiam sit rutrum dui nostra sem, aliquet conubia nullam sollicitudin rhoncus venenatis vivamus rhoncus netus risus. \nTortor non mauris turpis eget integer nibh dolor, commodo venenatis ut molestie semper adipiscing amet cras, class donec sapien malesuada auctor sapien. \nArcu inceptos aenean consequat metus litora mattis vivamus feugiat, arcu adipiscing mauris primis ante ullamcorper ad nisi lobortis, arcu per orci malesuada blandit metus tortor. \nUrna turpis consectetur porttitor egestas sed eleifend eget tincidunt pharetra varius, tincidunt morbi malesuada elementum mi torquent mollis eu lobortis, curae purus amet vivamus amet nulla torquent nibh eu. \n</p>\n<p>\nDiam aliquam pretium donec aliquam tempus lacus tempus feugiat lectus, cras non velit mollis sit et integer egestas. \nHabitant auctor integer sem at nam, massa himenaeos netus. \n</p>',0,1,1),(2,'2016-05-20 13:28:34','2016-05-20 13:28:34','Post 2','post-2','<img alt=\"\" src=\"/filemanager/userfiles/user2/goomba.png\" style=\"float:left; height:128px; width:128px\" /><p>\nLorem ipsum senectus rhoncus leo fusce tortor sociosqu semper, facilisis semper class tempus faucibus tristique duis eros, cubilia quisque habitasse aliquam fringilla orci non. \nVel laoreet dolor enim justo facilisis neque accumsan, in ad venenatis hac per dictumst nulla ligula, donec mollis massa porttitor ullamcorper risus. \nEu platea fringilla, habitasse. \n</p>','<p>Lorem ipsum convallis ac curae non elit ultrices placerat netus metus feugiat, non conubia fusce porttitor sociosqu diam commodo metus in himenaeos, vitae aptent consequat luctus purus eleifend enim sollicitudin eleifend porta. Malesuada ac class conubia condimentum mauris facilisis conubia quis scelerisque lacinia, tempus nullam felis fusce ac potenti netus ornare semper. Molestie iaculis fermentum ornare curabitur tincidunt imperdiet scelerisque, imperdiet euismod scelerisque torquent curae rhoncus, sollicitudin tortor placerat aptent hac nec. Posuere suscipit sed tortor neque urna hendrerit vehicula duis litora tristique congue nec auctor felis libero, ornare habitasse nec elit felis inceptos tellus inceptos cubilia quis mattis faucibus sem non.</p>\n\n<p>Odio fringilla class aliquam metus ipsum lorem luctus pharetra dictum, vehicula tempus in venenatis gravida ut gravida proin orci, quis sed platea mi quisque hendrerit semper hendrerit. Facilisis ante sapien faucibus ligula commodo vestibulum rutrum pretium, varius sem aliquet himenaeos dolor cursus nunc habitasse, aliquam ut curabitur ipsum luctus ut rutrum. Odio condimentum donec suscipit molestie est etiam sit rutrum dui nostra, sem aliquet conubia nullam sollicitudin rhoncus venenatis vivamus rhoncus netus, risus tortor non mauris turpis eget integer nibh dolor. Commodo venenatis ut molestie semper adipiscing amet cras, class donec sapien malesuada auctor sapien arcu inceptos, aenean consequat metus litora mattis vivamus.</p>\n\n<pre>\n<code class=\"language-php\">protected function getUserByRecaller($recaller)\n{\n	if ($this-&gt;validRecaller($recaller) &amp;&amp; ! $this-&gt;tokenRetrievalAttempted)\n	{\n		$this-&gt;tokenRetrievalAttempted = true;\n\n		list($id, $token) = explode(\"|\", $recaller, 2);\n\n		$this-&gt;viaRemember = ! is_null($user = $this-&gt;provider-&gt;retrieveByToken($id, $token));\n\n		return $user;\n	}\n}</code></pre>\n\n<p>Feugiat arcu adipiscing mauris primis ante ullamcorper ad nisi, lobortis arcu per orci malesuada blandit metus tortor, urna turpis consectetur porttitor egestas sed eleifend. Eget tincidunt pharetra varius tincidunt morbi malesuada elementum mi torquent mollis, eu lobortis curae purus amet vivamus amet nulla torquent, nibh eu diam aliquam pretium donec aliquam tempus lacus. Tempus feugiat lectus cras non velit mollis sit et integer, egestas habitant auctor integer sem at nam massa himenaeos, netus vel dapibus nibh malesuada leo fusce tortor. Sociosqu semper facilisis semper class tempus faucibus tristique duis eros, cubilia quisque habitasse aliquam fringilla orci non vel, laoreet dolor enim justo facilisis neque accumsan in.</p>\n\n<p>Ad venenatis hac per dictumst nulla ligula donec, mollis massa porttitor ullamcorper risus eu platea, fringilla habitasse suscipit pellentesque donec est. Habitant vehicula tempor ultrices placerat sociosqu ultrices consectetur ullamcorper tincidunt quisque tellus, ante nostra euismod nec suspendisse sem curabitur elit malesuada lacus. Viverra sagittis sit ornare orci augue nullam adipiscing pulvinar libero aliquam vestibulum platea cursus pellentesque leo dui lectus, curabitur euismod ad erat curae non elit ultrices placerat netus metus feugiat non conubia fusce porttitor. Sociosqu diam commodo metus in himenaeos vitae aptent consequat luctus purus eleifend enim sollicitudin eleifend, porta malesuada ac class conubia condimentum mauris facilisis conubia quis scelerisque lacinia.</p>\n\n<p>Tempus nullam felis fusce ac potenti netus ornare semper molestie iaculis, fermentum ornare curabitur tincidunt imperdiet scelerisque imperdiet euismod. Scelerisque torquent curae rhoncus sollicitudin tortor placerat aptent hac, nec posuere suscipit sed tortor neque urna hendrerit, vehicula duis litora tristique congue nec auctor. Felis libero ornare habitasse nec elit felis, inceptos tellus inceptos cubilia quis mattis, faucibus sem non odio fringilla. Class aliquam metus ipsum lorem luctus pharetra dictum vehicula, tempus in venenatis gravida ut gravida proin orci, quis sed platea mi quisque hendrerit semper.</p>\n',0,1,2),(3,'2016-05-20 13:28:34','2016-05-20 13:28:34','Post 3','post-3','<img alt=\"\" src=\"/filemanager/userfiles/user2/rouge-shell.png\" style=\"float:left; height:128px; width:128px\" /><p>\nLorem ipsum tempor netus aenean ligula habitant vehicula tempor ultrices, placerat sociosqu ultrices consectetur ullamcorper tincidunt quisque tellus, ante nostra euismod nec suspendisse sem curabitur elit. \nMalesuada lacus viverra sagittis sit ornare orci, augue nullam adipiscing pulvinar libero aliquam vestibulum, platea cursus pellentesque leo dui. \nLectus curabitur euismod ad, erat. \n</p>','<p>\nLorem ipsum erat non elit ultrices placerat, netus metus feugiat non conubia, fusce porttitor sociosqu diam commodo. \nMetus in himenaeos vitae aptent consequat luctus purus, eleifend enim sollicitudin eleifend porta malesuada ac class, conubia condimentum mauris facilisis conubia quis scelerisque, lacinia tempus nullam felis fusce ac. \nPotenti netus ornare semper molestie iaculis fermentum, ornare curabitur tincidunt imperdiet scelerisque imperdiet, euismod scelerisque torquent curae rhoncus. \nSollicitudin tortor placerat aptent hac nec posuere suscipit sed, tortor neque urna hendrerit vehicula duis litora tristique, congue nec auctor felis libero ornare habitasse. \n</p>\n<p>\nNec elit felis inceptos tellus inceptos cubilia quis, mattis faucibus sem non odio fringilla class aliquam, metus ipsum lorem luctus pharetra dictum. \nVehicula tempus in venenatis gravida ut gravida proin orci quis, sed platea mi quisque hendrerit semper hendrerit facilisis ante, sapien faucibus ligula commodo vestibulum rutrum pretium varius. \nSem aliquet himenaeos dolor cursus, nunc habitasse aliquam ut curabitur, ipsum luctus ut. \nRutrum odio condimentum donec suscipit molestie est etiam sit, rutrum dui nostra sem aliquet conubia nullam sollicitudin, rhoncus venenatis vivamus rhoncus netus risus tortor. \nNon mauris turpis eget integer nibh dolor commodo venenatis ut molestie, semper adipiscing amet cras class donec sapien malesuada auctor sapien, arcu inceptos aenean consequat metus litora mattis vivamus feugiat. \n</p>\n<p>\nArcu adipiscing mauris primis ante ullamcorper ad nisi lobortis, arcu per orci malesuada blandit metus tortor, urna turpis consectetur porttitor egestas sed eleifend. \nEget tincidunt pharetra varius tincidunt morbi malesuada, elementum mi torquent mollis eu, lobortis curae purus amet vivamus. \nAmet nulla torquent nibh eu diam aliquam pretium donec aliquam tempus, lacus tempus feugiat lectus cras non velit mollis. \nSit et integer egestas habitant auctor integer sem at nam, massa himenaeos netus vel dapibus nibh malesuada leo, fusce tortor sociosqu semper facilisis semper class tempus. \nFaucibus tristique duis eros cubilia quisque habitasse aliquam fringilla orci non vel laoreet, dolor enim justo facilisis neque accumsan in ad venenatis hac. \n</p>\n<p>\nPer dictumst nulla ligula donec mollis massa porttitor ullamcorper risus, eu platea fringilla habitasse suscipit pellentesque donec. \nEst habitant vehicula tempor ultrices placerat sociosqu ultrices consectetur ullamcorper, tincidunt quisque tellus ante nostra euismod nec suspendisse, sem curabitur elit malesuada lacus viverra sagittis sit. \nOrnare orci augue nullam adipiscing pulvinar libero, aliquam vestibulum platea cursus pellentesque leo dui, lectus curabitur euismod ad erat. \nCurae non elit ultrices placerat netus metus feugiat non conubia fusce porttitor sociosqu diam commodo, metus in himenaeos vitae aptent consequat luctus purus eleifend enim sollicitudin eleifend. \n</p>\n<p>\nPorta malesuada ac class conubia condimentum mauris facilisis conubia quis scelerisque, lacinia tempus nullam felis fusce ac potenti netus ornare semper, molestie iaculis fermentum ornare curabitur tincidunt imperdiet scelerisque imperdiet. \nEuismod scelerisque torquent curae rhoncus sollicitudin tortor placerat, aptent hac nec posuere suscipit sed tortor neque, urna hendrerit vehicula duis litora tristique. \nCongue nec auctor felis libero ornare habitasse nec elit felis inceptos, tellus inceptos cubilia quis mattis faucibus sem non odio, fringilla class aliquam metus ipsum lorem luctus pharetra dictum. \nVehicula tempus in venenatis gravida ut gravida, proin orci quis sed platea mi, quisque hendrerit semper hendrerit facilisis. \n</p>',0,1,2),(4,'2016-05-20 13:28:34','2016-05-20 13:28:34','Post 4','post-4','<img alt=\"\" src=\"/filemanager/userfiles/user2/rouge-shyguy.png\" style=\"float:left; height:128px; width:128px\" /><p>\nLorem ipsum blandit sapien faucibus ligula, commodo vestibulum rutrum pretium varius, sem aliquet himenaeos dolor. \nCursus nunc habitasse aliquam ut curabitur ipsum, luctus ut rutrum odio condimentum. \nDonec suscipit molestie est etiam sit rutrum dui nostra, sem aliquet conubia nullam sollicitudin rhoncus venenatis, vivamus rhoncus netus risus tortor non mauris. \n</p>','<p>\nLorem ipsum eu eget integer nibh dolor commodo, venenatis ut molestie semper adipiscing amet cras class, donec sapien malesuada auctor sapien arcu. \nInceptos aenean consequat metus litora mattis vivamus feugiat arcu adipiscing mauris primis ante, ullamcorper ad nisi lobortis arcu per orci malesuada blandit metus. \nTortor urna turpis consectetur porttitor egestas sed eleifend eget, tincidunt pharetra varius tincidunt morbi malesuada elementum mi torquent, mollis eu lobortis curae purus amet vivamus. \nAmet nulla torquent nibh eu diam aliquam pretium donec aliquam, tempus lacus tempus feugiat lectus cras non velit, mollis sit et integer egestas habitant auctor integer. \n</p>\n<p>\nSem at nam massa himenaeos netus vel dapibus nibh malesuada, leo fusce tortor sociosqu semper facilisis semper class tempus, faucibus tristique duis eros cubilia quisque habitasse aliquam. \nFringilla orci non vel laoreet dolor enim justo facilisis, neque accumsan in ad venenatis hac per dictumst nulla, ligula donec mollis massa porttitor ullamcorper risus. \nEu platea fringilla habitasse suscipit pellentesque donec est habitant vehicula tempor ultrices, placerat sociosqu ultrices consectetur ullamcorper tincidunt quisque tellus ante. \nNostra euismod nec suspendisse sem curabitur elit malesuada, lacus viverra sagittis sit ornare orci augue nullam, adipiscing pulvinar libero aliquam vestibulum platea. \n</p>\n<p>\nCursus pellentesque leo dui lectus curabitur euismod, ad erat curae non elit ultrices placerat, netus metus feugiat non conubia. \nFusce porttitor sociosqu diam commodo metus in himenaeos vitae aptent consequat, luctus purus eleifend enim sollicitudin eleifend porta malesuada ac class, conubia condimentum mauris facilisis conubia quis scelerisque lacinia tempus. \nNullam felis fusce ac potenti netus ornare semper molestie iaculis fermentum ornare curabitur tincidunt, imperdiet scelerisque imperdiet euismod scelerisque torquent curae rhoncus sollicitudin tortor placerat aptent. \nHac nec posuere suscipit sed tortor neque urna hendrerit vehicula duis, litora tristique congue nec auctor felis libero ornare. \n</p>\n<p>\nHabitasse nec elit felis inceptos tellus inceptos cubilia quis mattis faucibus sem non, odio fringilla class aliquam metus ipsum lorem luctus pharetra dictum vehicula tempus, in venenatis gravida ut gravida proin orci quis sed platea mi. \nQuisque hendrerit semper hendrerit facilisis ante sapien faucibus ligula commodo vestibulum, rutrum pretium varius sem aliquet himenaeos dolor cursus nunc habitasse aliquam, ut curabitur ipsum luctus ut rutrum odio condimentum donec. \nSuscipit molestie est etiam sit rutrum dui nostra sem, aliquet conubia nullam sollicitudin rhoncus venenatis vivamus rhoncus netus, risus tortor non mauris turpis eget integer. \n</p>\n<p>\nNibh dolor commodo venenatis ut molestie semper adipiscing amet, cras class donec sapien malesuada auctor sapien, arcu inceptos aenean consequat metus litora mattis. \nVivamus feugiat arcu adipiscing mauris primis ante ullamcorper, ad nisi lobortis arcu per orci malesuada, blandit metus tortor urna turpis consectetur porttitor, egestas sed eleifend eget tincidunt pharetra. \nVarius tincidunt morbi malesuada elementum mi torquent mollis eu lobortis curae purus amet vivamus amet, nulla torquent nibh eu diam aliquam pretium donec aliquam tempus lacus tempus. \nFeugiat lectus cras non velit mollis sit et integer, egestas habitant auctor integer sem at nam massa, himenaeos netus vel dapibus nibh malesuada leo. \n</p>\n<p>\nFusce tortor sociosqu semper facilisis semper class tempus, faucibus tristique duis eros cubilia quisque habitasse, aliquam fringilla orci non vel laoreet. \n</p>',0,1,2);

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`title`,`slug`,`created_at`,`updated_at`) values (1,'Administrator','admin','2016-05-20 13:28:33','2016-05-20 13:28:33'),(2,'Redactor','redac','2016-05-20 13:28:33','2016-05-20 13:28:33'),(3,'User','user','2016-05-20 13:28:34','2016-05-20 13:28:34');

/*Table structure for table `tags` */

DROP TABLE IF EXISTS `tags`;

CREATE TABLE `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tag` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tags_tag_unique` (`tag`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tags` */

insert  into `tags`(`id`,`created_at`,`updated_at`,`tag`) values (1,'2016-05-20 13:28:34','2016-05-20 13:28:34','Tag1'),(2,'2016-05-20 13:28:34','2016-05-20 13:28:34','Tag2'),(3,'2016-05-20 13:28:34','2016-05-20 13:28:34','Tag3'),(4,'2016-05-20 13:28:34','2016-05-20 13:28:34','Tag4');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  `valid` tinyint(1) NOT NULL DEFAULT '0',
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `confirmation_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`email`,`password`,`role_id`,`seen`,`valid`,`confirmed`,`confirmation_code`,`created_at`,`updated_at`,`remember_token`) values (1,'GreatAdmin','admin@la.fr','$2y$10$8DDqS79b6oMv./kdAJM3NeCzifqiXOQS1iw5OfI43WdwM6B1KaUhC',1,1,0,1,NULL,'2016-05-20 13:28:34','2016-05-20 13:28:34',NULL),(2,'GreatRedactor','redac@la.fr','$2y$10$Izet788uilC6jyDdTlbNyejA55yVEiXO.cJMEAstPo9ae6uQOeZ6O',2,1,1,1,NULL,'2016-05-20 13:28:34','2016-05-20 13:28:34',NULL),(3,'Walker','walker@la.fr','$2y$10$dKOpyvANa9LltqbvPj7WwOYu0KeSLQ2zG.tF9QOxBMfIDygHF4LWK',3,0,0,1,NULL,'2016-05-20 13:28:34','2016-05-20 13:28:34',NULL),(4,'Slacker','slacker@la.fr','$2y$10$uqPWv.WAku0TR4MzkmJPLuGRv3lM.NDisOG8EJmoAwNE5SE2GV5Hu',3,0,0,1,NULL,'2016-05-20 13:28:34','2016-05-20 13:28:34',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
