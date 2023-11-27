CREATE DATABASE `database`;
CREATE TABLE `database`.`user`(
    `id` INT NOT NULL AUTO_INCREMENT,
    `login` VARCHAR(32) NOT NULL,
    `password` VARCHAR(32) NOT NULL,
    `full_name` VARCHAR(32) NOT NULL,
    `email` VARCHAR(32) NOT NULL,
    `avatar` VARCHAR(512) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE (`login`),
    UNIQUE (`email`));
CREATE TABLE `database`.`token`(
    `id` INT NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(32) NOT NULL,
    `token` VARCHAR(32) NOT NULL,
    `date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE (`email`));
CREATE EVENT `delete_token_event`
    ON SCHEDULE EVERY 1 MINUTE
    DO
    DELETE FROM `token` WHERE `date` < (NOW() - INTERVAL 1 MINUTE);
SET GLOBAL `event_scheduler` = ON;