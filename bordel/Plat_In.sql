CREATE DATABASE IF NOT EXISTS Plat_In;
USE Plat_In;

CREATE TABLE IF NOT EXISTS `users` (
  `ID_user` INT NOT NULL AUTO_INCREMENT,
  `user` VARCHAR(45) NULL,
  `password` VARCHAR(45) NULL,
  `first_name` VARCHAR(45) NULL,
  `last_name` VARCHAR(45) NULL,
  `adress` VARCHAR(45) NULL,
  `mail` VARCHAR(45) NULL,
  `phone_number` INT NULL,
  `picture` BLOB NULL,
  `status_u` ENUM('admin', 'operator', 'membre', 'ban') NULL,
  `connection` ENUM('co', 'dc') NULL,
  PRIMARY KEY (`ID_user`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `recipes` (
  `ID_recipe` INT NOT NULL AUTO_INCREMENT,
  `name_r` VARCHAR(45) NULL,
  `text` BLOB NULL,
  `picture` BLOB NULL,
  `date_r` DATE NULL,
  `cooking_time` TIME NULL,
  `ID_user` INT NOT NULL,
  `ID_origin` INT NOT NULL,
  PRIMARY KEY (`ID_recipe`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `reviews` (
  `ID_review` INT NOT NULL AUTO_INCREMENT,
  `review` INT NULL,
  `ID_user` INT NOT NULL,
  `ID_recipe` INT NOT NULL,
  PRIMARY KEY (`ID_review`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `origins` (
  `ID_origin` INT NOT NULL AUTO_INCREMENT,
  `origin_name` VARCHAR(45) NULL,
  PRIMARY KEY (`ID_origin`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `meals` (
  `ID_meal` INT NOT NULL AUTO_INCREMENT,
  `name_m` VARCHAR(45) NULL,
  `date_m` DATETIME NULL,
  `status_m` ENUM('requested', 'accepted') NULL,
  PRIMARY KEY (`ID_meal`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `guests` (
  `ID_guest` INT NOT NULL AUTO_INCREMENT,
  `ID_user` INT NOT NULL,
  `ID_meal` INT NOT NULL,
  `statut_g` ENUM('membre', 'admin') NULL,
  PRIMARY KEY (`ID_guest`, `ID_user`, `ID_meal`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `dishes` (
  `ID_dishe` INT NOT NULL AUTO_INCREMENT,
  `ID_recipe` INT NOT NULL,
  `ID_meal` INT NOT NULL,
  `service_name` VARCHAR(45) NULL,
  PRIMARY KEY (`ID_dishe`, `ID_recipe`, `ID_meal`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `foods` (
  `ID_food` INT NOT NULL AUTO_INCREMENT,
  `food_name` VARCHAR(45) NULL,
  PRIMARY KEY (`ID_food`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `ingredients` (
  `ID_ingredient` INT NOT NULL AUTO_INCREMENT,
  `ID_food` INT NOT NULL,
  `ID_recipe` INT NOT NULL,
  PRIMARY KEY (`ID_ingredient`, `ID_food`, `ID_recipe`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `kinds_of_food` (
  `ID_kind_of_food` INT NOT NULL,
  `name_k` VARCHAR(45) NULL,
  PRIMARY KEY (`ID_kind_of_food`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `preferences` (
  `ID_preference` INT NOT NULL AUTO_INCREMENT,
  `grade` INT NULL,
  `ID_user` INT NOT NULL,
  `ID_kind_of_food` INT NOT NULL,
  PRIMARY KEY (`ID_preference`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `friends` (
  `ID_friend` INT NOT NULL AUTO_INCREMENT,
  `ID_user` INT NULL,
  `status_f` ENUM('accepted', 'requested', 'blocked') NULL,
  PRIMARY KEY (`ID_friend`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `diets` (
  `ID_diet` INT NOT NULL,
  `name_d` VARCHAR(45) NULL,
  PRIMARY KEY (`ID_diet`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `food_categories` (
  `ID_food_categories` INT NOT NULL AUTO_INCREMENT,
  `ID_food` INT NOT NULL,
  `ID_kind_of_food` INT NOT NULL,
  PRIMARY KEY (`ID_food_categories`, `ID_food`, `ID_kind_of_food`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `can_t_eat` (
  `ID_can_t_eat` INT NOT NULL AUTO_INCREMENT,
  `ID_diet` INT NOT NULL,
  `ID_kind_of_food` INT NOT NULL,
  PRIMARY KEY (`ID_can_t_eat`, `ID_diet`, `ID_kind_of_food`))
ENGINE = InnoDB;
