
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- wines
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `wines`;


CREATE TABLE `wines`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER  NOT NULL,
	`lable` VARCHAR(255),
	`picture` VARCHAR(255),
	`description` TEXT,
	PRIMARY KEY (`id`),
	INDEX `wines_FI_1` (`user_id`),
	CONSTRAINT `wines_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- wine_property_name
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `wine_property_name`;


CREATE TABLE `wine_property_name`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255),
	`description` TEXT,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- wine_property_value
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `wine_property_value`;


CREATE TABLE `wine_property_value`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`property_id` INTEGER  NOT NULL,
	`name` VARCHAR(255),
	PRIMARY KEY (`id`),
	INDEX `wine_property_value_FI_1` (`property_id`),
	CONSTRAINT `wine_property_value_FK_1`
		FOREIGN KEY (`property_id`)
		REFERENCES `wine_property_name` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- wine_properties
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `wine_properties`;


CREATE TABLE `wine_properties`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`wine_id` INTEGER  NOT NULL,
	`wine_property_value_id` INTEGER  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `wine_properties_FI_1` (`wine_id`),
	CONSTRAINT `wine_properties_FK_1`
		FOREIGN KEY (`wine_id`)
		REFERENCES `wines` (`id`)
		ON DELETE CASCADE,
	INDEX `wine_properties_FI_2` (`wine_property_value_id`),
	CONSTRAINT `wine_properties_FK_2`
		FOREIGN KEY (`wine_property_value_id`)
		REFERENCES `wine_property_value` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
