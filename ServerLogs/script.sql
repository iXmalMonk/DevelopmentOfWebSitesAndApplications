CREATE DATABASE `database`;

CREATE TABLE `database`.`request` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `method` TEXT NOT NULL,
    `path` TEXT NOT NULL,
    `version` TEXT NOT NULL
);

CREATE TABLE `database`.`response` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `code` INT NOT NULL,
    `size` INT NOT NULL
);

CREATE TABLE `database`.`url_browser` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `url` TEXT NOT NULL,
    `browser` TEXT NOT NULL
);

CREATE TABLE `database`.`server_log` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `ip_address` TEXT NOT NULL,
    `date` DATETIME NOT NULL,
    `request_id` INT NOT NULL,
    `response_id` INT NOT NULL,
    `url_browser_id` INT NOT NULL,
    FOREIGN KEY (`request_id`) REFERENCES `request` (`id`),
    FOREIGN KEY (`response_id`) REFERENCES `response` (`id`),
    FOREIGN KEY (`url_browser_id`) REFERENCES `url_browser` (`id`)
);

DELIMITER //
CREATE PROCEDURE `database`.`insert_data` (
    IN `p_method` TEXT,
    IN `p_path` TEXT,
    IN `p_version` TEXT,
    IN `p_code` INT,
    IN `p_size` INT,
    IN `p_url` TEXT,
    IN `p_browser` TEXT,
    IN `p_ipAddress` TEXT,
    IN `p_date` DATETIME
)
BEGIN
    DECLARE `requestId` INT;
    DECLARE `responseId` INT;
    DECLARE `urlBrowserId` INT;
    INSERT INTO `database`.`request` (`method`, `path`, `version`) VALUES (`p_method`, `p_path`, `p_version`);
    SET `requestId` = LAST_INSERT_ID();
    INSERT INTO `database`.`response` (`code`, `size`) VALUES (`p_code`, `p_size`);
    SET `responseId` = LAST_INSERT_ID();
    INSERT INTO `database`.`url_browser` (`url`, `browser`) VALUES (`p_url`, `p_browser`);
    SET `urlBrowserId` = LAST_INSERT_ID();
    INSERT INTO `database`.`server_log` (`ip_address`, `date`, `request_id`, `response_id`, `url_browser_id`) 
    VALUES (`p_ipAddress`, `p_date`, `requestId`, `responseId`, `urlBrowserId`);
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE `database`.`select_data`()
BEGIN
    SELECT `sl`.`id`, `sl`.`ip_address`, `sl`.`date`, `req`.`method`, `req`.`path`, `req`.`version`, `res`.`code`, `res`.`size`, `ub`.`url`, `ub`.`browser`
    FROM `server_log` AS `sl`
    JOIN `request` AS `req` ON `sl`.`request_id` = `req`.`id`
    JOIN `response` AS `res` ON `sl`.`response_id` = `res`.`id`
    JOIN `url_browser` AS `ub` ON `sl`.`url_browser_id` = `ub`.`id`;
END //
DELIMITER ;