<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMissingDbDesign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        \DB::unprepared("
DROP TABLE IF EXISTS `order_material` ;

CREATE TABLE IF NOT EXISTS `order_material` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `percent` SMALLINT NOT NULL DEFAULT 0,
  `material_name` VARCHAR(45) NOT NULL,
  `created_at` TIMESTAMP NOT NULL,
  `order_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_order_material_order1_idx` (`order_id` ASC),
  CONSTRAINT `fk_order_material_order1`
    FOREIGN KEY (`order_id`)
    REFERENCES `order` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

DROP TABLE IF EXISTS `order_processing_guide` ;

CREATE TABLE IF NOT EXISTS `order_processing_guide` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `image_path` TEXT NULL,
  `order_id` INT UNSIGNED NOT NULL,
  `comment` TEXT NULL,
  `created_at` TIMESTAMP NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_order_processing_guide_order1_idx` (`order_id` ASC),
  CONSTRAINT `fk_order_processing_guide_order1`
    FOREIGN KEY (`order_id`)
    REFERENCES `order` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

DROP TABLE IF EXISTS `order_cad` ;

CREATE TABLE IF NOT EXISTS `order_cad` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `tailor_id` INT UNSIGNED NOT NULL COMMENT 'person who is incharge of tailor',
  `order_id` INT UNSIGNED NOT NULL,
  `file_path` TEXT NULL,
  `created_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_order_CAD_order1_idx` (`order_id` ASC),
  CONSTRAINT `fk_order_CAD_order1`
    FOREIGN KEY (`order_id`)
    REFERENCES `order` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

DROP TABLE IF EXISTS `order_conversation` ;

CREATE TABLE IF NOT EXISTS `order_conversation` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `sender_id` INT NOT NULL COMMENT 'person who sends message\n',
  `receiver_id` INT NOT NULL COMMENT 'person who receives the message',
  `content` TEXT NOT NULL,
  `order_id` INT UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NOT NULL,
  `is_CS` TINYINT NOT NULL DEFAULT 0 COMMENT '1: Conflict support',
  PRIMARY KEY (`id`),
  INDEX `fk_order_conversation_order1_idx` (`order_id` ASC),
  CONSTRAINT `fk_order_conversation_order1`
    FOREIGN KEY (`order_id`)
    REFERENCES `order` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

DROP TABLE IF EXISTS `order_property` ;

CREATE TABLE IF NOT EXISTS `order_property` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` INT UNSIGNED NOT NULL COMMENT 'FK - category, for level 3',
  `created_at` TIMESTAMP NOT NULL,
  `order_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_order_property_order1_idx` (`order_id` ASC),
  CONSTRAINT `fk_order_property_order1`
    FOREIGN KEY (`order_id`)
    REFERENCES `order` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
        ");
        \DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('order_property');
        Schema::dropIfExists('order_conversation');
        Schema::dropIfExists('order_cad');
        Schema::dropIfExists('order_processing_guide');
        Schema::dropIfExists('order_material');
        \DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
