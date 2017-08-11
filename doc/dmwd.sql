CREATE DATABASE dmwd;
GRANT ALL PRIVILEGES ON dmwd.* TO root@localhost IDENTIFIED BY 'root';
FLUSH PRIVILEGES;
quit

USE versandstatistik;

CREATE TABLE `video1` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
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

  `blacklist` tinyint(1) DEFAULT 0 NULL,

  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `keywords` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `video_id` bigint(20) NOT NULL,

  `keyword` varchar(50) COLLATE utf8_unicode_ci NOT NULL,

  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `keywords_video_id` (`video_id`),
  CONSTRAINT `keywords_video_id` FOREIGN KEY (`video_id`) REFERENCES `video` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE `categories` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `video_id` bigint(20) NOT NULL,

  `category` varchar(50) COLLATE utf8_unicode_ci NOT NULL,

  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `categories_video_id` (`video_id`),
  CONSTRAINT `categories_video_id` FOREIGN KEY (`video_id`) REFERENCES `video` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;