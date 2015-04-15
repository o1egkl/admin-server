CREATE DATABASE IF NOT EXISTS `admin`;

CREATE TABLE IF NOT EXISTS `admin`.`users` (
  `user_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `user_name` VARCHAR(64) NOT NULL,
  `user_password_hash` VARCHAR(255) NOT NULL,
  `user_email` VARCHAR(64) NOT NULL ,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ;

CREATE TABLE IF NOT EXISTS `admin`.`tracker` (
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