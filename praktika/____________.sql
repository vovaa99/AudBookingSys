-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 04 2018 г., 14:17
-- Версия сервера: 5.7.21
-- Версия PHP: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `заявка`
--

-- --------------------------------------------------------

--
-- Структура таблицы `заявка`
--

DROP TABLE IF EXISTS `заявка`;
CREATE TABLE IF NOT EXISTS `заявка` (
  `№ заявки` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `№ аудитории` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Логин` varchar(255) NOT NULL,
  `ФИО просящего` varchar(255) CHARACTER SET utf8 NOT NULL,
  `ФИО преподавателя` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Цель` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Статус` varchar(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`№ заявки`),
  KEY `№ аудитории` (`№ аудитории`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `заявка`
--

INSERT INTO `заявка` (`№ заявки`, `№ аудитории`, `Логин`, `ФИО просящего`, `ФИО преподавателя`, `Цель`, `Статус`) VALUES
(2, '17-A', 'petrov', 'Иванов Иван Иванович', 'Иванов Иван Иванович', 'для леккции', '0'),
(3, '17-A', 'petrov', 'Иванов Иван Иванович', 'Иванов Иван Иванович', 'для пары', '0'),
(4, '17-A', 'petrov', 'Иванов Иван Иванович', 'Иванов Иван Иванович', 'для пары', '0');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
