
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- region_type
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `region_type`;

CREATE TABLE `region_type`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `value` VARCHAR(255),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- street_type
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `street_type`;

CREATE TABLE `street_type`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `value` VARCHAR(255),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- city_type
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `city_type`;

CREATE TABLE `city_type`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `value` VARCHAR(255),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- building_type
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `building_type`;

CREATE TABLE `building_type`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `value` VARCHAR(255),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- person
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `person`;

CREATE TABLE `person`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `first_name` VARCHAR(255) NOT NULL,
    `last_name` VARCHAR(255) NOT NULL,
    `phone` INTEGER NOT NULL,
    `address_id` INTEGER NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `person_fi_a7b49f` (`address_id`),
    CONSTRAINT `person_fk_a7b49f`
        FOREIGN KEY (`address_id`)
        REFERENCES `address` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- address
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `address`;

CREATE TABLE `address`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `address_str` VARCHAR(255),
    `building_number` VARCHAR(255),
    `number` VARCHAR(255),
    `street_id` INTEGER,
    `building_type_id` INTEGER,
    PRIMARY KEY (`id`),
    INDEX `address_fi_2b2eff` (`street_id`),
    INDEX `address_fi_a7f9b2` (`building_type_id`),
    CONSTRAINT `address_fk_2b2eff`
        FOREIGN KEY (`street_id`)
        REFERENCES `street` (`id`),
    CONSTRAINT `address_fk_a7f9b2`
        FOREIGN KEY (`building_type_id`)
        REFERENCES `building_type` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- street
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `street`;

CREATE TABLE `street`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255),
    `street_type_id` INTEGER,
    `city_id` INTEGER,
    PRIMARY KEY (`id`),
    INDEX `street_fi_48ce03` (`city_id`),
    INDEX `street_fi_6723d9` (`street_type_id`),
    CONSTRAINT `street_fk_48ce03`
        FOREIGN KEY (`city_id`)
        REFERENCES `city` (`id`),
    CONSTRAINT `street_fk_6723d9`
        FOREIGN KEY (`street_type_id`)
        REFERENCES `street_type` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- city
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `city`;

CREATE TABLE `city`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255),
    `region_id` INTEGER,
    `city_type_id` INTEGER,
    PRIMARY KEY (`id`),
    INDEX `city_fi_c400b0` (`region_id`),
    INDEX `city_fi_2352d5` (`city_type_id`),
    CONSTRAINT `city_fk_c400b0`
        FOREIGN KEY (`region_id`)
        REFERENCES `region` (`id`),
    CONSTRAINT `city_fk_2352d5`
        FOREIGN KEY (`city_type_id`)
        REFERENCES `city_type` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- region
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `region`;

CREATE TABLE `region`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255),
    `region_type_id` INTEGER,
    PRIMARY KEY (`id`),
    INDEX `region_fi_4d815a` (`region_type_id`),
    CONSTRAINT `region_fk_4d815a`
        FOREIGN KEY (`region_type_id`)
        REFERENCES `region_type` (`id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
