SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

CREATE SCHEMA IF NOT EXISTS `Plat_In` DEFAULT CHARACTER SET utf8 ;
USE `Plat_In` ;

CREATE TABLE IF NOT EXISTS `Plat_In`.`users` (
  `ID_user` INT NOT NULL AUTO_INCREMENT,
  `user` VARCHAR(45) NULL,
  `u_password` VARCHAR(45) NULL,
  `first_name` VARCHAR(45) NULL,
  `last_name` VARCHAR(45) NULL,
  `adress` VARCHAR(45) NULL,
  `mail` VARCHAR(45) NULL,
  `phone_number` VARCHAR(45) NULL,
  `picture` BLOB NULL,
  `status_u` ENUM('admin', 'operator', 'membre', 'ban') NULL,
  `connection` ENUM('co', 'dc') NULL,
  PRIMARY KEY (`ID_user`))
ENGINE = InnoDB;

INSERT INTO `users` (`ID_user`, `user`, `u_password`, `first_name`, `last_name`, `adress`, `mail`, `phone_number`, `picture`, `status_u`, `connection`) VALUES ('1', 'admin', 'YWJjZGU=', 'admin', 'admin', NULL, NULL, NULL, NULL, 'admin', 'dc');

CREATE TABLE IF NOT EXISTS `Plat_In`.`foods` (
  `ID_food` INT NOT NULL AUTO_INCREMENT,
  `food_name` VARCHAR(45) NULL,
  PRIMARY KEY (`ID_food`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `Plat_In`.`kinds_of_food` (
  `ID_kind_of_food` INT NOT NULL AUTO_INCREMENT,
  `name_k` VARCHAR(45) NULL,
  PRIMARY KEY (`ID_kind_of_food`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `Plat_In`.`food_categories` (
  `ID_food_categorie` INT NOT NULL AUTO_INCREMENT,
  `ID_kind_of_food` INT NOT NULL,
  `ID_food` INT NOT NULL,
  PRIMARY KEY (`ID_food_categorie`),
  CONSTRAINT `fk_kinds_of_food_has_foods_kinds_of_food`
    FOREIGN KEY (`ID_kind_of_food`)
    REFERENCES `Plat_In`.`kinds_of_food` (`ID_kind_of_food`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_kinds_of_food_has_foods_foods1`
    FOREIGN KEY (`ID_food`)
    REFERENCES `Plat_In`.`foods` (`ID_food`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `Plat_In`.`preferences` (
  `ID_preference` INT NOT NULL AUTO_INCREMENT,
  `ID_kind_of_food` INT NOT NULL,
  `ID_user` INT NOT NULL,
  `grade` INT NULL,
  PRIMARY KEY (`ID_preference`),
  CONSTRAINT `fk_kinds_of_food_has_users_kinds_of_food1`
    FOREIGN KEY (`ID_kind_of_food`)
    REFERENCES `Plat_In`.`kinds_of_food` (`ID_kind_of_food`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_kinds_of_food_has_users_users1`
    FOREIGN KEY (`ID_user`)
    REFERENCES `Plat_In`.`users` (`ID_user`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `Plat_In`.`friends` (
  `ID_friend` INT NOT NULL  AUTO_INCREMENT,
  `ID_user` INT NOT NULL,
  `ID_user_receiver` INT NOT NULL,
  `status_f` ENUM('friend', 'requested', 'block') NULL,
  PRIMARY KEY (`ID_friend`),
  CONSTRAINT `fk_users_has_users_users1`
    FOREIGN KEY (`ID_user`)
    REFERENCES `Plat_In`.`users` (`ID_user`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_users_has_users_users2`
    FOREIGN KEY (`ID_user_receiver`)
    REFERENCES `Plat_In`.`users` (`ID_user`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `Plat_In`.`meals` (
  `ID_meal` INT NOT NULL AUTO_INCREMENT,
  `name_m` VARCHAR(45) NULL,
  `date_hours` TIME NULL,
  `date_days` DATE NULL,
  `location` VARCHAR(45) NULL,
  `text` BLOB NULL,
  PRIMARY KEY (`ID_meal`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `Plat_In`.`guests` (
  `ID_guest` INT NOT NULL AUTO_INCREMENT,
  `ID_user` INT NOT NULL,
  `ID_meals` INT NOT NULL,
  `status_g` ENUM('requested', 'membre', 'admin') NULL,
  PRIMARY KEY (`ID_guest`),
  CONSTRAINT `fk_users_has_meals_users1`
    FOREIGN KEY (`ID_user`)
    REFERENCES `Plat_In`.`users` (`ID_user`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_users_has_meals_meals1`
    FOREIGN KEY (`ID_meals`)
    REFERENCES `Plat_In`.`meals` (`ID_meal`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `Plat_In`.`origins` (
  `ID_origin` INT NOT NULL AUTO_INCREMENT,
  `origin_name` VARCHAR(45) NULL,
  PRIMARY KEY (`ID_origin`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `Plat_In`.`recipes` (
  `ID_recipes` INT NOT NULL AUTO_INCREMENT,
  `name_r` VARCHAR(45) NULL,
  `text` BLOB NULL,
  `picture` BLOB NULL,
  `date_r` DATE NULL,
  `cooking_time` TIME NULL,
  `ID_origin` INT NOT NULL,
  `ID_user` INT NOT NULL,
  PRIMARY KEY (`ID_recipes`),
  CONSTRAINT `fk_recipes_origins1`
    FOREIGN KEY (`ID_origin`)
    REFERENCES `Plat_In`.`origins` (`ID_origin`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_recipes_users1`
    FOREIGN KEY (`ID_user`)
    REFERENCES `Plat_In`.`users` (`ID_user`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `Plat_In`.`reviews` (
  `ID_reviews` INT NOT NULL AUTO_INCREMENT,
  `review` INT NULL,
  `ID_user` INT NOT NULL,
  `ID_recipes` INT NOT NULL,
  PRIMARY KEY (`ID_reviews`),
  CONSTRAINT `fk_users_has_recipes_users1`
    FOREIGN KEY (`ID_user`)
    REFERENCES `Plat_In`.`users` (`ID_user`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_users_has_recipes_recipes1`
    FOREIGN KEY (`ID_recipes`)
    REFERENCES `Plat_In`.`recipes` (`ID_recipes`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `Plat_In`.`dishes` (
  `ID_dishe` INT NOT NULL AUTO_INCREMENT,
  `ID_meals` INT NOT NULL,
  `ID_recipes` INT NOT NULL,
  `service_name` VARCHAR(45) NULL,
  PRIMARY KEY (`ID_dishe`),
  CONSTRAINT `fk_meals_has_recipes_meals1`
    FOREIGN KEY (`ID_meals`)
    REFERENCES `Plat_In`.`meals` (`ID_meal`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_meals_has_recipes_recipes1`
    FOREIGN KEY (`ID_recipes`)
    REFERENCES `Plat_In`.`recipes` (`ID_recipes`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `Plat_In`.`ingredients` (
  `ID_ingredient` INT NOT NULL AUTO_INCREMENT,
  `ID_recipes` INT NOT NULL,
  `ID_food` INT NOT NULL,
  PRIMARY KEY (`ID_ingredient`),
  CONSTRAINT `fk_recipes_has_foods_recipes1`
    FOREIGN KEY (`ID_recipes`)
    REFERENCES `Plat_In`.`recipes` (`ID_recipes`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_recipes_has_foods_foods1`
    FOREIGN KEY (`ID_food`)
    REFERENCES `Plat_In`.`foods` (`ID_food`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `Plat_In`.`diets` (
  `ID_diet` INT NOT NULL AUTO_INCREMENT,
  `name_d` VARCHAR(45) NULL,
  PRIMARY KEY (`ID_diet`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `Plat_In`.`can_t_eat` (
  `ID_can_t_eat` INT NOT NULL AUTO_INCREMENT,
  `ID_diet` INT NOT NULL,
  `ID_kind_of_food` INT NOT NULL,
  PRIMARY KEY (`ID_can_t_eat`),
  CONSTRAINT `fk_diets_has_kinds_of_food_diets1`
    FOREIGN KEY (`ID_diet`)
    REFERENCES `Plat_In`.`diets` (`ID_diet`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_diets_has_kinds_of_food_kinds_of_food1`
    FOREIGN KEY (`ID_kind_of_food`)
    REFERENCES `Plat_In`.`kinds_of_food` (`ID_kind_of_food`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
