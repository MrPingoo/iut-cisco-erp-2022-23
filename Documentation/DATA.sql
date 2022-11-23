-- Adminer 4.8.1 MySQL 8.0.31-0ubuntu0.20.04.1 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

INSERT INTO `subject` (`id`, `name`) VALUES
(3,	'Mathématiques'),
(4,	'Physique - Chimie'),
(5,	'SVT'),
(6,	'Enseignement scientifique'),
(7,	'Français'),
(8,	'Philosophie'),
(9,	'Histoire - Géographie'),
(10,	'Anglais'),
(11,	'Economie'),
(12,	'Espagnol'),
(13,	'Allemand'),
(14,	'Méthodologie'),
(15,	'Sciences de l\'ingénieur');

INSERT INTO `lvl` (`id`, `name`, `value`) VALUES
(1,	'6ème',	1),
(2,	'5ème',	2),
(3,	'4ème',	3),
(4,	'3ème',	4),
(5,	'2nd',	5),
(6,	'1er',	6),
(7,	'Term',	7);

-- 2022-11-07 16:21:48
