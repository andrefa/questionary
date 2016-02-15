SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `questionary` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `questionary`;

-- -----------------------------------------------------
-- Table `mydb`.`admin_user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`admin_user` (
  `admin_user_id` BIGINT NOT NULL AUTO_INCREMENT,
  `full_name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `login` VARCHAR(50) NOT NULL,
  `password` VARCHAR(64) NOT NULL,
  `creation_date` DATETIME NOT NULL DEFAULT now(),
  PRIMARY KEY (`admin_user_id`),
  UNIQUE INDEX `login_UNIQUE` (`login` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`questionary`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`questionary` (
  `questionary_id` BIGINT NOT NULL AUTO_INCREMENT,
  `questionary_name` VARCHAR(45) NOT NULL,
  `question_count` INT NOT NULL,
  `created_by_user_id` BIGINT NOT NULL,
  `creation_date` DATETIME NOT NULL DEFAULT now(),
  PRIMARY KEY (`questionary_id`),
  INDEX `fk_questionary_admin_user_idx` (`created_by_user_id` ASC),
  CONSTRAINT `fk_questionary_admin_user`
    FOREIGN KEY (`created_by_user_id`)
    REFERENCES `mydb`.`admin_user` (`admin_user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`question_score_setting`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`question_score_setting` (
  `question_score_setting_id` BIGINT NOT NULL AUTO_INCREMENT,
  `correct_score` TINYINT NOT NULL DEFAULT 0,
  `wrong_score` TINYINT NOT NULL DEFAULT 0,
  `blank_score` TINYINT NOT NULL DEFAULT 0,
  `creation_date` DATETIME NOT NULL DEFAULT now(),
  PRIMARY KEY (`question_score_setting_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`question_option`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`question_option` (
  `question_option_id` BIGINT NOT NULL AUTO_INCREMENT,
  `question_option_description` VARCHAR(200) NOT NULL,
  `creation_date` DATETIME NOT NULL DEFAULT now(),
  PRIMARY KEY (`question_option_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`question`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`question` (
  `question_id` BIGINT NOT NULL AUTO_INCREMENT,
  `question_description` VARCHAR(500) NOT NULL,
  `seconds_to_answer` INT NOT NULL,
  `correct_question_option_id` BIGINT NOT NULL,
  `question_score_setting_id` BIGINT NOT NULL,
  `creation_date` DATETIME NOT NULL DEFAULT now(),
  PRIMARY KEY (`question_id`),
  INDEX `fk_question_question_score_setting1_idx` (`question_score_setting_id` ASC),
  INDEX `fk_question_question_option1_idx` (`correct_question_option_id` ASC),
  CONSTRAINT `fk_question_question_score_setting1`
    FOREIGN KEY (`question_score_setting_id`)
    REFERENCES `mydb`.`question_score_setting` (`question_score_setting_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_question_question_option1`
    FOREIGN KEY (`correct_question_option_id`)
    REFERENCES `mydb`.`question_option` (`question_option_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`question_options`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`question_options` (
  `question_id` BIGINT NOT NULL,
  `question_option_id` BIGINT NOT NULL,
  PRIMARY KEY (`question_id`, `question_option_id`),
  INDEX `fk_question_has_question_option_question_option1_idx` (`question_option_id` ASC),
  INDEX `fk_question_has_question_option_question1_idx` (`question_id` ASC),
  CONSTRAINT `fk_question_has_question_option_question1`
    FOREIGN KEY (`question_id`)
    REFERENCES `mydb`.`question` (`question_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_question_has_question_option_question_option1`
    FOREIGN KEY (`question_option_id`)
    REFERENCES `mydb`.`question_option` (`question_option_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`questionary_question`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`questionary_question` (
  `questionary_id` BIGINT NOT NULL,
  `question_id` BIGINT NOT NULL,
  PRIMARY KEY (`questionary_id`, `question_id`),
  INDEX `fk_questionary_has_question_question1_idx` (`question_id` ASC),
  INDEX `fk_questionary_has_question_questionary1_idx` (`questionary_id` ASC),
  CONSTRAINT `fk_questionary_has_question_questionary1`
    FOREIGN KEY (`questionary_id`)
    REFERENCES `mydb`.`questionary` (`questionary_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_questionary_has_question_question1`
    FOREIGN KEY (`question_id`)
    REFERENCES `mydb`.`question` (`question_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`user` (
  `user_id` BIGINT NOT NULL AUTO_INCREMENT,
  `full_name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `login` VARCHAR(50) NOT NULL,
  `password` VARCHAR(64) NOT NULL,
  `active` TINYINT(1) NOT NULL DEFAULT 1,
  `creation_date` DATETIME NOT NULL DEFAULT now(),
  PRIMARY KEY (`user_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`user_questionary`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`user_questionary` (
  `user_questionary_id` BIGINT NOT NULL AUTO_INCREMENT,
  `user_id` BIGINT NOT NULL,
  `questionary_id` BIGINT NOT NULL,
  `score` INT NULL,
  `creation_date` DATETIME NOT NULL DEFAULT now(),
  PRIMARY KEY (`user_questionary_id`),
  INDEX `fk_user_has_questionary_questionary1_idx` (`questionary_id` ASC),
  INDEX `fk_user_has_questionary_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_user_has_questionary_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `mydb`.`user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_has_questionary_questionary1`
    FOREIGN KEY (`questionary_id`)
    REFERENCES `mydb`.`questionary` (`questionary_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`user_questionary_question_answer`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`user_questionary_question_answer` (
  `user_questionary_answer_id` BIGINT NOT NULL AUTO_INCREMENT,
  `user_questionary_id` BIGINT NOT NULL,
  `answered_question_option_id` BIGINT NULL,
  `answer_date` DATETIME NULL,
  `creation_date` DATETIME NOT NULL DEFAULT now(),
  PRIMARY KEY (`user_questionary_answer_id`),
  INDEX `fk_user_questionary_question_answer_question_option1_idx` (`answered_question_option_id` ASC),
  INDEX `fk_user_questionary_question_answer_user_questionary1_idx` (`user_questionary_id` ASC),
  CONSTRAINT `fk_user_questionary_question_answer_question_option1`
    FOREIGN KEY (`answered_question_option_id`)
    REFERENCES `mydb`.`question_option` (`question_option_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_questionary_question_answer_user_questionary1`
    FOREIGN KEY (`user_questionary_id`)
    REFERENCES `mydb`.`user_questionary` (`user_questionary_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;