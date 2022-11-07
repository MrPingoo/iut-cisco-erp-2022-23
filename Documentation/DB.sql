-- Adminer 4.8.1 MySQL 8.0.31-0ubuntu0.20.04.1 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `booking`;
CREATE TABLE `booking` (
  `slot_id` int NOT NULL,
  `student_id` int NOT NULL,
  PRIMARY KEY (`slot_id`,`student_id`),
  KEY `fk_slot_has_student_student1_idx` (`student_id`),
  KEY `fk_slot_has_student_slot1_idx` (`slot_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


DROP TABLE IF EXISTS `lvl`;
CREATE TABLE `lvl` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `value` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


DROP TABLE IF EXISTS `room`;
CREATE TABLE `room` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `capacity` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


DROP TABLE IF EXISTS `slot`;
CREATE TABLE `slot` (
  `id` int NOT NULL AUTO_INCREMENT,
  `begin` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `room_id` int NOT NULL,
  `tutor_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_slot_room1_idx` (`room_id`),
  KEY `fk_slot_tutor1_idx` (`tutor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


DROP TABLE IF EXISTS `slot_has_subject`;
CREATE TABLE `slot_has_subject` (
  `slot_id` int NOT NULL,
  `subject_id` int NOT NULL,
  `lvl_id` int NOT NULL,
  PRIMARY KEY (`slot_id`,`subject_id`,`lvl_id`),
  KEY `fk_slot_has_subject_subject1_idx` (`subject_id`),
  KEY `fk_slot_has_subject_slot1_idx` (`slot_id`),
  KEY `fk_slot_has_subject_lvl1_idx` (`lvl_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


DROP TABLE IF EXISTS `student`;
CREATE TABLE `student` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `user_id` int NOT NULL,
  `lvl_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_student_user_idx` (`user_id`),
  KEY `fk_student_lvl1_idx` (`lvl_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


DROP TABLE IF EXISTS `subject`;
CREATE TABLE `subject` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


DROP TABLE IF EXISTS `tutor`;
CREATE TABLE `tutor` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


-- 2022-11-07 15:46:46
