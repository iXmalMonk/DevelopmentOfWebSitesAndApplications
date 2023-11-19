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
    PRIMARY KEY (`id`),
    UNIQUE (`email`));