CREATE DATABASE `database`;

CREATE TABLE `database`.`request` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `method` VARCHAR(8) NOT NULL,
    `path` TEXT NOT NULL,
    `version` VARCHAR(8) NOT NULL
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
    `ip_address` VARCHAR(16) NOT NULL,
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
    IN `p_method` VARCHAR(8),
    IN `p_path` TEXT,
    IN `p_version` VARCHAR(8),
    IN `p_code` INT,
    IN `p_size` INT,
    IN `p_url` TEXT,
    IN `p_browser` TEXT,
    IN `p_ipAddress` VARCHAR(16),
    IN `p_date` DATETIME
)
BEGIN
    DECLARE `requestId` INT;
    DECLARE `responseId` INT;
    DECLARE `urlBrowserId` INT;
    START TRANSACTION;
    INSERT INTO `database`.`request` (`method`, `path`, `version`) SELECT `p_method`, `p_path`, `p_version`;
    SET `requestId` = LAST_INSERT_ID();
    INSERT INTO `database`.`response` (`code`, `size`) SELECT `p_code`, `p_size`;
    SET `responseId` = LAST_INSERT_ID();
    INSERT INTO `database`.`url_browser` (`url`, `browser`) SELECT `p_url`, `p_browser`;
    SET `urlBrowserId` = LAST_INSERT_ID();
    INSERT INTO `database`.`server_log` (`ip_address`, `date`, `request_id`, `response_id`, `url_browser_id`) 
    VALUES (`p_ipAddress`, `p_date`, `requestId`, `responseId`, `urlBrowserId`);
    COMMIT;
END //
DELIMITER ;