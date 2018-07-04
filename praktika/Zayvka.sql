-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 04 2018 г., 17:23
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
  `Дата` date NOT NULL,
  `№ пары` int(1) UNSIGNED NOT NULL,
  `Логин` varchar(255) NOT NULL,
  `ФИО просящего` varchar(255) CHARACTER SET utf8 NOT NULL,
  `ФИО преподавателя` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Цель` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Статус` varchar(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`№ заявки`),
  KEY `№ аудитории` (`№ аудитории`),
  KEY `№ пары` (`№ пары`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `заявка`
--

INSERT INTO `заявка` (`№ заявки`, `№ аудитории`, `Дата`, `№ пары`, `Логин`, `ФИО просящего`, `ФИО преподавателя`, `Цель`, `Статус`) VALUES
(2, '17-A', '2000-01-01', 5, 'petrov', 'Иванов Иван Иванович', 'Иванов Иван Иванович', 'для леккции', '0'),
(3, '17-A', '2000-01-01', 4, 'petrov', 'Иванов Иван Иванович', 'Иванов Иван Иванович', 'для пары', '0'),
(4, '17-A', '2000-01-01', 1, 'petrov', 'Иванов Иван Иванович', 'Иванов Иван Иванович', 'для пары', '0'),
(5, '31-Б', '2018-03-19', 4, 'lolgin', 'ivanov i.i', 'prepod go', 'xz', '0'),
(6, '31-Б', '2018-03-19', 4, 'lolgin', 'ivanov i.i', 'prepod go', 'xz', '0');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
