
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- appliances
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `appliances`;

CREATE TABLE `appliances`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(32) NOT NULL,
    `memberOf` INTEGER,
    `lastPing` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `name` (`name`),
    UNIQUE INDEX `id` (`id`),
    INDEX `id_2` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- members
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `members`;

CREATE TABLE `members`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `applianceId` INTEGER NOT NULL,
    `serviceId` INTEGER NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `applianceId` (`applianceId`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- services
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `services`;

CREATE TABLE `services`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `portnum` smallint(5) unsigned NOT NULL,
    `servicename` VARCHAR(32) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `portnum` (`portnum`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
