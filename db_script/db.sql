CREATE DATABASE IF NOT EXISTS `admin`;

CREATE TABLE IF NOT EXISTS `admin`.`users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL ,
  `user_password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`),
  UNIQUE KEY `user_email` (`user_email`)
) DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ;

CREATE TABLE IF NOT EXISTS `tracker` (
`id` INT(11) NOT NULL AUTO_INCREMENT,
`date` DATE NOT NULL,
`time` TIME NOT NULL,
`ip` TEXT NOT NULL,
`country` TEXT NOT NULL,
`city` TEXT NOT NULL,
`query_string` TEXT NOT NULL,
`http_referer` TEXT NOT NULL,
`http_user_agent` TEXT NOT NULL,
`isbot` INT(11) NOT NULL,
`page` TEXT,
PRIMARY KEY  (`id`)
);