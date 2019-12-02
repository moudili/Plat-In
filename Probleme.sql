CREATE DATABASE IF NOT EXISTS ProblemePlatIn;
USE ProblemePlatIn;

CREATE TABLE IF NOT EXISTS `foods` (
  `ID_food` INT NOT NULL AUTO_INCREMENT,
  `food_name` VARCHAR(45) NULL,
  PRIMARY KEY (`ID_food`))
ENGINE = InnoDB;

INSERT INTO `foods` (`ID_food`, `food_name`) VALUES
(1, 'pomme'),
(2, 'poire'),
(3, 'sel'),
(4, 'tomate'),
(5, 'patate'),
(6, 'bonbon');

CREATE TABLE IF NOT EXISTS `kinds_of_food` (
  `ID_kind_of_food` INT NOT NULL AUTO_INCREMENT,
  `name_k` VARCHAR(45) NULL,
  PRIMARY KEY (`ID_kind_of_food`))
ENGINE = InnoDB;

INSERT INTO `kinds_of_food` (`ID_kind_of_food`, `name_k`) VALUES
(1, 'salé'),
(2, 'sucré'),
(3, 'fruit'),
(4, 'legume');

CREATE TABLE IF NOT EXISTS `food_categories` (
  `ID_food_categories` INT NOT NULL AUTO_INCREMENT,
  `ID_food` INT NOT NULL,
  `ID_kind_of_food` INT NOT NULL,
  PRIMARY KEY (`ID_food_categories`, `ID_food`, `ID_kind_of_food`))
ENGINE = InnoDB;

INSERT INTO `food_categories` (`ID_food_categories`, `ID_food`, `ID_kind_of_food`) VALUES
(1, 1, 2),
(2, 1, 3),
(3, 2, 2),
(4, 3, 1),
(5, 5, 1),
(6, 5, 4);

