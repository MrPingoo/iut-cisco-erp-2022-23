CREATE TABLE IF NOT EXISTS `room` (
  `id` INT NOT NULL,
  `name` VARCHAR(255) NULL DEFAULT NULL,
  `capacity` INT NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `tutor` (
  `id` INT NOT NULL,
  `firstname` VARCHAR(255) NULL DEFAULT NULL,
  `lastname` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `slot` (
  `id` INT NOT NULL,
  `begin` DATETIME NULL DEFAULT NULL,
  `end` DATETIME NULL DEFAULT NULL,
  `room_id` INT NOT NULL,
  `tutor_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_slot_room1_idx` (`room_id` ASC),
  INDEX `fk_slot_tutor1_idx` (`tutor_id` ASC))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `user` (
  `id` INT NOT NULL,
  `firstname` VARCHAR(255) NULL DEFAULT NULL,
  `lastname` VARCHAR(255) NULL DEFAULT NULL,
  `email` VARCHAR(255) NULL DEFAULT NULL,
  `password` TEXT(5000) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `lvl` (
  `id` INT NOT NULL,
  `name` VARCHAR(255) NULL DEFAULT NULL,
  `value` INT NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `student` (
  `id` INT NOT NULL,
  `firstname` VARCHAR(255) NULL DEFAULT NULL,
  `lastname` VARCHAR(255) NULL DEFAULT NULL,
  `user_id` INT NOT NULL,
  `lvl_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_student_user_idx` (`user_id` ASC),
  INDEX `fk_student_lvl1_idx` (`lvl_id` ASC))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `booking` (
  `slot_id` INT NOT NULL,
  `student_id` INT NOT NULL,
  PRIMARY KEY (`slot_id`, `student_id`),
  INDEX `fk_slot_has_student_student1_idx` (`student_id` ASC),
  INDEX `fk_slot_has_student_slot1_idx` (`slot_id` ASC))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `subject` (
  `id` INT NOT NULL,
  `name` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `slot_has_subject` (
  `slot_id` INT NOT NULL,
  `subject_id` INT NOT NULL,
  `lvl_id` INT NOT NULL,
  PRIMARY KEY (`slot_id`, `subject_id`, `lvl_id`),
  INDEX `fk_slot_has_subject_subject1_idx` (`subject_id` ASC),
  INDEX `fk_slot_has_subject_slot1_idx` (`slot_id` ASC),
  INDEX `fk_slot_has_subject_lvl1_idx` (`lvl_id` ASC))
ENGINE = InnoDB;
