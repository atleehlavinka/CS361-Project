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