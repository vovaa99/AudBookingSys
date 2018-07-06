CREATE TABLE IF NOT EXISTS `audbookingsys1`.`booking` (
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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;  

 DROP `rooms`
     CREATE TABLE IF NOT EXISTS `rooms` (
  `Номер` text(9) DEFAULT NULL,
  `Корпус` char(1) DEFAULT NULL,
  `Состояние` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    
     INSERT INTO `rooms` (`Номер`, `Корпус`, `Состояние`) VALUES
('17-А', 'А', '1'),
('107-А', 'А', '1'),
('209-А', 'А', '1'),
('304-А', 'А', '1'),
('305-А', 'А', '1'),
('315-А', 'А', '1'),
('323-А', 'А', '1'),
('332-А', 'А', '1'),
('334-А', 'А', '1'),
('335-А', 'А', '1'),
('401-А', 'А', '1'),
('402-А', 'А', '1'),
('404-А', 'А', '1'),
('423-А', 'А', '1'),
('504-А', 'А', '1'),
('508-А', 'А', '1'),
('601-А', 'А', '1'),
('602-А', 'А', '1'),
('603-А', 'А', '1'),
('604-А', 'А', '1'),
('607-А', 'А', '1'),
('701-А', 'А', '1'),
('702-А', 'А', '1'),
('708-А', 'А', '1'),
('806-А', 'А', '1'),
('808-А', 'А', '1'),
('901-А', 'А', '1'),
('902-А', 'А', '1'),
('908-А', 'А', '1'),
('1001-А', 'А', '1'),
('1002-А', 'А', '1'),
('1005-А', 'А', '1'),
('1006-А', 'А', '1'),
('2401-А', 'А', '1'),
('101-Б', 'Б', '1'),
('105-Б', 'Б', '1'),
('201-Б', 'Б', '1'),
('203-Б', 'Б', '1'),
('207-Б', 'Б', '1'),
('209-Б', 'Б', '1'),
('228-Б', 'Б', '1'),
('303-Б', 'Б', '1'),
('311-Б', 'Б', '1'),
('315-Б', 'Б', '1'),
('319-Б', 'Б', '1'),
('321-Б', 'Б', '1'),
('323-Б', 'Б', '1'),
('513-Б', 'Б', '1'),
('515-Б', 'Б', '1'),
('517-Б', 'Б', '1'),
('518-Б', 'Б', '1'),
('1000-Б', 'Б', '1'),
('1-В', 'В', '1'),
('205-В', 'В', '1'),
('301-В', 'В', '1'),
('302-В', 'В', '1'),
('305-В', 'В', '1'),
('306-В', 'В', '1'),
('309-В', 'В', '1'),
('310-В', 'В', '1'),
('311-В', 'В', '1'),
('401-В', 'В', '1'),
('405-В', 'В', '1'),
('406-В', 'В', '1'),
('408-В', 'В', '1'),
('409-В', 'В', '1'),
('411-В', 'В', '1'),
('412-В', 'В', '1');