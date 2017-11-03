-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Ноя 03 2017 г., 19:06
-- Версия сервера: 10.1.21-MariaDB
-- Версия PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `tv`
--
CREATE DATABASE IF NOT EXISTS `tv` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `tv`;

-- --------------------------------------------------------

--
-- Структура таблицы `sources`
--

CREATE TABLE IF NOT EXISTS `sources` (
  `ID_NAME` int(11) NOT NULL AUTO_INCREMENT,
  `CHANNEL` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID_NAME`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `uptimes`
--

CREATE TABLE IF NOT EXISTS `uptimes` (
  `ID_UPTIMES` int(11) NOT NULL AUTO_INCREMENT,
  `TODAY` time NOT NULL DEFAULT '00:01:00',
  `YESTERDAY` time NOT NULL DEFAULT '00:00:00',
  `TOTAL` time NOT NULL DEFAULT '00:01:00',
  PRIMARY KEY (`ID_UPTIMES`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `views`
--

CREATE TABLE IF NOT EXISTS `views` (
  `ID_VIEWS` int(11) NOT NULL AUTO_INCREMENT,
  `TODAY` int(11) NOT NULL DEFAULT '1',
  `YESTERDAY` int(11) NOT NULL DEFAULT '0',
  `TOTAL` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID_VIEWS`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
