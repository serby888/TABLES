-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Ноя 09 2017 г., 19:03
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
-- Структура таблицы `channels`
--

CREATE TABLE IF NOT EXISTS `channels` (
  `ID` int(11) NOT NULL,
  `NAME` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `uptimes`
--

CREATE TABLE IF NOT EXISTS `uptimes` (
  `ID` int(11) NOT NULL,
  `TODAY` time NOT NULL DEFAULT '00:01:00',
  `YESTERDAY` time NOT NULL DEFAULT '00:00:00',
  `TOTAL` time NOT NULL DEFAULT '00:01:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `views`
--

CREATE TABLE IF NOT EXISTS `views` (
  `ID` int(11) NOT NULL,
  `TODAY` int(11) NOT NULL DEFAULT '1',
  `YESTERDAY` int(11) NOT NULL DEFAULT '0',
  `TOTAL` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
