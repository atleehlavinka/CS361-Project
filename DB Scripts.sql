DROP TABLE IF EXISTS User;
CREATE TABLE `User` (
	`id` INT NOT NULL AUTO_INCREMENT,
    `first_name` VARCHAR(255),
    `last_name` VARCHAR(255),
    `phone` VARCHAR(12),
    `email` VARCHAR(255),
    `password_hash` VARCHAR(255),
    PRIMARY KEY (`id`)
);

DROP TABLE IF EXISTS Course;
CREATE TABLE `Course` (
	`id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255),
    `description` VARCHAR(255),
    `instructor` VARCHAR(255),
    `date` DATE,
    `price` DECIMAL(19,2),
    PRIMARY KEY (`id`)
);