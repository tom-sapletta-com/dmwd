CREATE DATABASE dmwd;
GRANT ALL PRIVILEGES ON dmwd.* TO root@localhost IDENTIFIED BY 'root';
FLUSH PRIVILEGES;
quit



DROP DATABASE dmwd;
DROP TABLE `videos`;

USE dmwd;

CREATE TABLE `videos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `xml_id` bigint(20) DEFAULT 0 NOT NULL,
  `released` datetime NOT NULL,
  `duration` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,

  `date` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `video_240p` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `video_360p` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `video_480p` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `video_720p` varchar(100) COLLATE utf8_unicode_ci NOT NULL,

  `keywords` TEXT COLLATE utf8_unicode_ci NULL,
  `categories` TEXT COLLATE utf8_unicode_ci NULL,

  `blacklist` tinyint(1) DEFAULT 0 NULL,

  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


