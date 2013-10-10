-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Време на генериране: 
-- Версия на сървъра: 5.5.32
-- Версия на PHP: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- БД: `messageboard`
--
CREATE DATABASE IF NOT EXISTS `messageboard` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `messageboard`;

-- --------------------------------------------------------

--
-- Структура на таблица `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`category_id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Схема на данните от таблица `groups`
--

INSERT INTO `groups` (`category_id`, `name`) VALUES
(1, 'Новини'),
(2, 'Разни'),
(3, 'Забавни');

-- --------------------------------------------------------

--
-- Структура на таблица `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category_id` int(11) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `text` varchar(250) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`message_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- Схема на данните от таблица `messages`
--

INSERT INTO `messages` (`message_id`, `date`, `category_id`, `title`, `text`, `user_id`) VALUES
(40, '2013-10-09 18:43:49', 2, 'Рецепта', 'Мусака', 16),
(29, '2013-10-09 16:32:29', 1, 'Закриват ВМА за цивилни структури', 'Поредната простотия ....', 1),
(34, '2013-10-09 17:20:34', 1, 'Парламентът не затвори границите', 'Нека отворим очите си за реалностите – в България нахлуват терористи, пропагандира депутатката...', 1);

-- --------------------------------------------------------

--
-- Структура на таблица `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(12) DEFAULT NULL,
  `is_admin` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Схема на данните от таблица `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `is_admin`) VALUES
(1, 'admin', '12345', 1),
(6, 'user1', 'user1', 0),
(8, 'qwerty', 'qwerty', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
