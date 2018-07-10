
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema  DB_NAME
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema  DB_NAME
-- -----------------------------------------------------
-- CREATE SCHEMA IF NOT EXISTS `DB_NAME` DEFAULT CHARACTER SET utf8 ;
USE `DB_NAME` ;

-- -----------------------------------------------------
-- Table `DB_NAME`.`acc_management`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB_NAME`.`acc_management` (
  `#` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Type` TINYINT(1) UNSIGNED NOT NULL,
  `Email` VARCHAR(255) NOT NULL,
  `Password` LONGTEXT NOT NULL,
  `Name` VARCHAR(255) NULL DEFAULT NULL,
  `Tel` VARCHAR(255) NULL DEFAULT NULL,
  `Faculty` VARCHAR(255) NULL DEFAULT NULL,
  `Rank` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`#`))
ENGINE = INNODB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `DB_NAME`.`rooms`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB_NAME`.`rooms` (
  `Room` VARCHAR(9) NOT NULL,
  `Building` CHAR(1) NOT NULL DEFAULT '0',
  `Capacity` INT(1) NOT NULL DEFAULT '0',
  `Status` INT(1) NOT NULL DEFAULT '0')
ENGINE = INNODB
DEFAULT CHARACTER SET = utf8;

INSERT INTO `DB_NAME`.`rooms` (`Room`, `Building`, `Capacity` ,`Status`) VALUES
('17-А', 'А', '100', '1'),
('107-А', 'А', '100', '1'),
('209-А', 'А', '100', '1'),
('304-А', 'А', '100', '1'),
('305-А', 'А', '100', '1'),
('315-А', 'А', '100', '1'),
('323-А', 'А', '100', '1'),
('332-А', 'А', '100', '1'),
('334-А', 'А', '100', '1'),
('335-А', 'А', '100', '1'),
('401-А', 'А', '100', '1'),
('402-А', 'А', '100', '1'),
('404-А', 'А', '100', '1'),
('423-А', 'А', '100', '1'),
('504-А', 'А', '100', '1'),
('508-А', 'А', '100', '1'),
('601-А', 'А', '100', '1'),
('602-А', 'А', '100', '1'),
('603-А', 'А', '100', '1'),
('604-А', 'А', '100', '1'),
('607-А', 'А', '100', '1'),
('701-А', 'А', '100', '1'),
('702-А', 'А', '100', '1'),
('708-А', 'А', '100', '1'),
('806-А', 'А', '100', '1'),
('808-А', 'А', '100', '1'),
('901-А', 'А', '100', '1'),
('902-А', 'А', '100', '1'),
('908-А', 'А', '100', '1'),
('1001-А', 'А', '100', '1'),
('1002-А', 'А', '100', '1'),
('1005-А', 'А', '100', '1'),
('1006-А', 'А', '100', '1'),
('2401-А', 'А', '100', '1'),
('101-Б', 'Б', '100', '1'),
('105-Б', 'Б', '100', '1'),
('201-Б', 'Б', '100', '1'),
('203-Б', 'Б', '100', '1'),
('207-Б', 'Б', '100', '1'),
('209-Б', 'Б', '100', '1'),
('228-Б', 'Б', '100', '1'),
('303-Б', 'Б', '100', '1'),
('311-Б', 'Б', '100', '1'),
('315-Б', 'Б', '100', '1'),
('319-Б', 'Б', '100', '1'),
('321-Б', 'Б', '100', '1'),
('323-Б', 'Б', '100', '1'),
('513-Б', 'Б', '100', '1'),
('515-Б', 'Б', '100', '1'),
('517-Б', 'Б', '100', '1'),
('518-Б', 'Б', '100', '1'),
('1000-Б', 'Б', '100', '1'),
('1-В', 'В', '100', '1'),
('205-В', 'В', '100', '1'),
('301-В', 'В', '100', '1'),
('302-В', 'В', '100', '1'),
('305-В', 'В', '100', '1'),
('306-В', 'В', '100', '1'),
('309-В', 'В', '100', '1'),
('310-В', 'В', '100', '1'),
('311-В', 'В', '100', '1'),
('401-В', 'В', '100', '1'),
('405-В', 'В', '100', '1'),
('406-В', 'В', '100', '1'),
('408-В', 'В', '100', '1'),
('409-В', 'В', '100', '1'),
('411-В', 'В', '100', '1'),
('412-В', 'В', '100', '1');


-- -----------------------------------------------------
-- Table `DB_NAME`.`booking`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DB_NAME`.`booking` (
  `#` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Room` VARCHAR(9) NOT NULL,
  `Date` DATE NOT NULL,
  `Lesson` INT(1) UNSIGNED NOT NULL,
  `Email` VARCHAR(255) NOT NULL,
  `AskerName` VARCHAR(255) NOT NULL,
  `Faculty` VARCHAR(255) NOT NULL,
  `PrepName` VARCHAR(255) NOT NULL,
  `Aim` VARCHAR(255) NOT NULL,
  `Status` VARCHAR(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`#`),
  INDEX `Room` (`Room` ASC),
  INDEX `Lesson` (`Lesson` ASC),
  INDEX (`Email` ASC),
  INDEX (`AskerName` ASC),
  INDEX (`Faculty` ASC))
ENGINE = INNODB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
