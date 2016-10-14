-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 
-- Версия на сървъра: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `database_proba`
--

-- --------------------------------------------------------

--
-- Структура на таблица `list_tasks_tbl`
--

CREATE TABLE IF NOT EXISTS `list_tasks_tbl` (
  `id_list` int(11) NOT NULL AUTO_INCREMENT,
  `name_list` varchar(50) NOT NULL,
  `date_added` int(20) NOT NULL,
  `id_user` int(11) NOT NULL,
  `arhiv_flag` tinyint(4) NOT NULL DEFAULT '0',
  `zabelejka` varchar(50) NOT NULL,
  `zaqvka_del` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_list`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Схема на данните от таблица `list_tasks_tbl`
--

INSERT INTO `list_tasks_tbl` (`id_list`, `name_list`, `date_added`, `id_user`, `arhiv_flag`, `zabelejka`, `zaqvka_del`) VALUES
(1, 'Списък едно', 1476401449, 2, 1, '', 1),
(2, 'Списък две', 1476401457, 2, 0, '', 1),
(3, 'Списък три', 1476401463, 1, 0, '', 0),
(6, 'xxxxxxxxxxx', 1476401937, 2, 1, 'Искам да има забележка тука', 1),
(7, 'yyyyyyyyyyy', 1476402099, 1, 0, '', 1);

-- --------------------------------------------------------

--
-- Структура на таблица `tasks_tbl`
--

CREATE TABLE IF NOT EXISTS `tasks_tbl` (
  `id_tasks` int(11) NOT NULL AUTO_INCREMENT,
  `name_task` varchar(50) NOT NULL,
  `date_added_tasks` int(11) NOT NULL,
  `id_list_tasks` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `belejka` varchar(50) NOT NULL,
  PRIMARY KEY (`id_tasks`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Схема на данните от таблица `tasks_tbl`
--

INSERT INTO `tasks_tbl` (`id_tasks`, `name_task`, `date_added_tasks`, `id_list_tasks`, `status`, `belejka`) VALUES
(1, 'edno', 0, 1, 'nqma', ''),
(3, 'za petyk ', 1476402371, 6, 'v chas 00.00', ''),
(6, 'ffffffff', 1476402977, 1, 'izpylnena', 'Важно е ');

-- --------------------------------------------------------

--
-- Структура на таблица `users_tbl`
--

CREATE TABLE IF NOT EXISTS `users_tbl` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `mail` varchar(20) NOT NULL,
  `password` varchar(200) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Схема на данните от таблица `users_tbl`
--

INSERT INTO `users_tbl` (`id_user`, `mail`, `password`, `type`) VALUES
(1, 'admin@abv.bg', '$2y$10$7zkyRSrvALC86cRjMXWZduAMsgzhxoVooOBxPdDzab8miiMF/8pE.', 2),
(2, 'niyazi_1992@abv.bg', '$2y$10$7lQho/VRdT4cmkn.2ewgcOYptX5JDPgO8o/ZeMaIncbG4N7A4MIsm', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
