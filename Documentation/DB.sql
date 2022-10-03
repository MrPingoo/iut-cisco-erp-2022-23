-- MySQL Script generated by MySQL Workbench
-- Mon Oct  3 14:50:54 2022
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Table `booking`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `booking` (
  `slot_id` INT NOT NULL,
  `student_id` INT NOT NULL,
  PRIMARY KEY (`slot_id`, `student_id`),
  INDEX `fk_slot_has_student_student1_idx` (`student_id` ASC) VISIBLE,
  INDEX `fk_slot_has_student_slot1_idx` (`slot_id` ASC) VISIBLE,
  CONSTRAINT `fk_slot_has_student_slot1`
    FOREIGN KEY (`slot_id`)
    REFERENCES `slot` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_slot_has_student_student1`
    FOREIGN KEY (`student_id`)
    REFERENCES `student` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `lvl`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `lvl` (
  `id` INT NOT NULL,
  `name` VARCHAR(255) NULL,
  `value` INT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `room`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `room` (
  `id` INT NOT NULL,
  `name` VARCHAR(255) NULL,
  `capacity` INT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `slot`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `slot` (
  `id` INT NOT NULL,
  `begin` DATETIME NULL,
  `end` DATETIME NULL,
  `room_id` INT NOT NULL,
  `tutor_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_slot_room1_idx` (`room_id` ASC) VISIBLE,
  INDEX `fk_slot_tutor1_idx` (`tutor_id` ASC) VISIBLE,
  CONSTRAINT `fk_slot_room1`
    FOREIGN KEY (`room_id`)
    REFERENCES `room` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_slot_tutor1`
    FOREIGN KEY (`tutor_id`)
    REFERENCES `tutor` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `slot_has_subject`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `slot_has_subject` (
  `slot_id` INT NOT NULL,
  `subject_id` INT NOT NULL,
  `lvl_id` INT NOT NULL,
  PRIMARY KEY (`slot_id`, `subject_id`, `lvl_id`),
  INDEX `fk_slot_has_subject_subject1_idx` (`subject_id` ASC) VISIBLE,
  INDEX `fk_slot_has_subject_slot1_idx` (`slot_id` ASC) VISIBLE,
  INDEX `fk_slot_has_subject_lvl1_idx` (`lvl_id` ASC) VISIBLE,
  CONSTRAINT `fk_slot_has_subject_slot1`
    FOREIGN KEY (`slot_id`)
    REFERENCES `slot` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_slot_has_subject_subject1`
    FOREIGN KEY (`subject_id`)
    REFERENCES `subject` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_slot_has_subject_lvl1`
    FOREIGN KEY (`lvl_id`)
    REFERENCES `lvl` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `student`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `student` (
  `id` INT NOT NULL,
  `firstname` VARCHAR(255) NULL,
  `lastname` VARCHAR(255) NULL,
  `user_id` INT NOT NULL,
  `lvl_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_student_user_idx` (`user_id` ASC) VISIBLE,
  INDEX `fk_student_lvl1_idx` (`lvl_id` ASC) VISIBLE,
  CONSTRAINT `fk_student_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_student_lvl1`
    FOREIGN KEY (`lvl_id`)
    REFERENCES `lvl` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `subject`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `subject` (
  `id` INT NOT NULL,
  `name` VARCHAR(255) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tutor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tutor` (
  `id` INT NOT NULL,
  `firstname` VARCHAR(255) NULL,
  `lastname` VARCHAR(255) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `user` (
  `id` INT NOT NULL,
  `firstname` VARCHAR(255) NULL,
  `lastname` VARCHAR(255) NULL,
  `email` VARCHAR(255) NULL,
  `password` TEXT(5000) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
