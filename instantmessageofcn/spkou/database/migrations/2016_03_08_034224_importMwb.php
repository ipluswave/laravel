<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ImportMwb extends Migration
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
            DROP TABLE IF EXISTS `users` ;

CREATE TABLE IF NOT EXISTS `users` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) CHARACTER SET 'utf8' NOT NULL,
  `password` VARCHAR(60) CHARACTER SET 'utf8' NOT NULL,
  `remember_token` VARCHAR(100) CHARACTER SET 'utf8' NULL DEFAULT NULL,
  `userscol` VARCHAR(45) NULL,
  `real_name` TEXT NOT NULL,
  `id_card_no` VARCHAR(45) NOT NULL,
  `gender` TINYINT(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0: male, 1: female',
  `date_of_birth` DATETIME NOT NULL,
  `address` TEXT NOT NULL,
  `handphone_no` VARCHAR(45) NOT NULL,
  `id_image_front` TEXT NOT NULL COMMENT 'url to the image',
  `id_image_back` TEXT NOT NULL,
  `del_flg` TINYINT(3) NOT NULL DEFAULT 0 COMMENT '1: user’s deleted',
  `is_validated` TINYINT(3) NOT NULL DEFAULT 0 COMMENT '1: validated, identity info is confirmed',
  `nick_name` VARCHAR(45) NOT NULL,
  `img_avatar` TEXT NOT NULL,
  `bank_id` INT UNSIGNED NOT NULL COMMENT 'Bank card Info: Main Bank',
  `bank_account_no` VARCHAR(45) NOT NULL COMMENT 'Bank card Info: bank account number',
  `bank_name` VARCHAR(45) NOT NULL COMMENT 'Bank card info: bank name\n',
  `bank_address` TEXT NOT NULL COMMENT 'Bank card info: Bank address',
  `upline_id` INT NOT NULL COMMENT 'user ID that invited this user',
  `did_first_sale` TINYINT NOT NULL DEFAULT 0 COMMENT '1: this user did first sale',
  `experience` VARCHAR(45) NULL,
  `is_tailor` TINYINT NOT NULL DEFAULT 0 COMMENT '1: become tailor, request to be tailor has been approved',
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `users_email_unique` (`email` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

DROP TABLE IF EXISTS `user_identity` ;

CREATE TABLE IF NOT EXISTS `user_identity` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `real_name` TEXT NOT NULL,
  `id_card_no` VARCHAR(45) NOT NULL,
  `gender` TINYINT(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0: male, 1: female',
  `date_of_birth` DATETIME NOT NULL,
  `address` TEXT NOT NULL,
  `handphone_no` VARCHAR(45) NOT NULL,
  `id_image_front` TEXT NOT NULL COMMENT 'url to the image',
  `id_image_back` TEXT NOT NULL,
  `status` TINYINT(3) NOT NULL DEFAULT 0 COMMENT '0: Pending, 1: Approved, 2: Declined',
  `user_id` INT(10) UNSIGNED NOT NULL,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  INDEX `fk_staff_identity_users_idx` (`user_id` ASC),
  CONSTRAINT `fk_staff_identity_users`
    FOREIGN KEY (`user_id`)
    REFERENCES `users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

DROP TABLE IF EXISTS `user_skill` ;

CREATE TABLE IF NOT EXISTS `user_skill` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT(10) UNSIGNED NOT NULL,
  `category_id` INT(10) UNSIGNED NOT NULL COMMENT 'aka skill',
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  INDEX `fk_user_skill_users1_idx` (`user_id` ASC),
  INDEX `fk_user_skill_category1_idx` (`category_id` ASC),
  CONSTRAINT `fk_user_skill_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_skill_category1`
    FOREIGN KEY (`category_id`)
    REFERENCES `category` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

DROP TABLE IF EXISTS `withdraw` ;

CREATE TABLE IF NOT EXISTS `withdraw` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `bank_id` INT UNSIGNED NOT NULL COMMENT 'bank ID',
  `bank_account_no` VARCHAR(45) NOT NULL,
  `bank_name` VARCHAR(45) NOT NULL,
  `bank_address` TEXT NOT NULL,
  `amount` DECIMAL(20,2) NOT NULL COMMENT 'amount to withdraw\n',
  `status` TINYINT NOT NULL DEFAULT 0 COMMENT '0: Pending, 1: accepted, 2: declined',
  `user_id` INT(10) UNSIGNED NOT NULL,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  INDEX `fk_withdraw_users1_idx` (`user_id` ASC),
  CONSTRAINT `fk_withdraw_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

DROP TABLE IF EXISTS `tailor_request` ;

CREATE TABLE IF NOT EXISTS `tailor_request` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT(10) UNSIGNED NOT NULL COMMENT 'person who send the request\n',
  `experience` VARCHAR(45) NULL,
  `status` TINYINT NOT NULL DEFAULT 0 COMMENT '0: Pending, 1: Approved, 2: Declined',
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  INDEX `fk_tailor_request_users1_idx` (`user_id` ASC),
  CONSTRAINT `fk_tailor_request_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

DROP TABLE IF EXISTS `tailor_request_skill` ;

CREATE TABLE IF NOT EXISTS `tailor_request_skill` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `tailor_request_id` INT UNSIGNED NOT NULL,
  `category_id` INT UNSIGNED NOT NULL COMMENT 'category ID\n',
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`, `tailor_request_id`),
  INDEX `fk_tailor_request_skill_tailor_request1_idx` (`tailor_request_id` ASC),
  CONSTRAINT `fk_tailor_request_skill_tailor_request1`
    FOREIGN KEY (`tailor_request_id`)
    REFERENCES `tailor_request` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

DROP TABLE IF EXISTS `order` ;

CREATE TABLE IF NOT EXISTS `order` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `creator_id` INT UNSIGNED NOT NULL COMMENT 'person who creates this post',
  `status` TINYINT NOT NULL DEFAULT 0 COMMENT '0: draft, 1: new, 2: hired, 3: complete, 4: cancel',
  `rate_quality` TINYINT UNSIGNED NOT NULL DEFAULT 0,
  `rate_communicate` TINYINT UNSIGNED NOT NULL DEFAULT 0,
  `rate_speed` TINYINT UNSIGNED NOT NULL DEFAULT 0,
  `text_review` TEXT NULL,
  `planned_date` DATETIME NOT NULL,
  `seal2` TINYINT NOT NULL DEFAULT 0 COMMENT '1: is selected',
  `seal1` TINYINT NOT NULL DEFAULT 0 COMMENT '1: is selected',
  `style` TINYINT NOT NULL DEFAULT 0 COMMENT 'category ID with level 1',
  `material` TINYINT NOT NULL DEFAULT 0 COMMENT '0: thick, 1: middle, 2: thin',
  `body_shape` TINYINT NOT NULL DEFAULT 0 COMMENT '0: asia, 1: europe, 2: america',
  `top_n_bottom` TINYINT NOT NULL DEFAULT 0 COMMENT 'category ID, level 2',
  `seal_width` TINYINT NOT NULL DEFAULT 0 COMMENT '1: is selected',
  `common_seal` TINYINT NOT NULL DEFAULT 0 COMMENT '1: is selected',
  `seal3` TINYINT NOT NULL DEFAULT 0 COMMENT '1: is selected',
  `niddle_size` TINYINT NOT NULL DEFAULT 0,
  `include_seal` TINYINT NOT NULL DEFAULT 0 COMMENT '1: is selected',
  `front_big_back_small` TINYINT NOT NULL DEFAULT 0 COMMENT '1: is selected',
  `front_small_back_big` TINYINT NOT NULL DEFAULT 0 COMMENT '1: is selected',
  `decrease_rate` TINYINT NOT NULL DEFAULT 0 COMMENT '1: is selected',
  `parar` SMALLINT UNSIGNED NOT NULL DEFAULT 0,
  `horiz` SMALLINT UNSIGNED NOT NULL DEFAULT 0,
  `category` SMALLINT NOT NULL DEFAULT 0 COMMENT '1: is selected',
  `category_type` SMALLINT NOT NULL DEFAULT 0 COMMENT '0: wool shirt, 1: niddle shirt, 2: flur shirt, 3: leather',
  `grading_needed` SMALLINT NOT NULL DEFAULT 0,
  `common_post` SMALLINT NOT NULL DEFAULT 0,
  `urgent_post` SMALLINT NOT NULL DEFAULT 0,
  `pay_price` DECIMAL(20,2) NOT NULL DEFAULT 0,
  `payment_method` TINYINT NOT NULL DEFAULT 0 COMMENT '0: alipay, 1: wechat, 2: paypal\n',
  `front_pattern_image` TEXT NOT NULL COMMENT 'image file path\n',
  `back_pattern_image` TEXT NOT NULL COMMENT 'image file path\n',
  `front_image_desc` TEXT NOT NULL,
  `common_seal_num` VARCHAR(45) NOT NULL,
  `seal_3_num` VARCHAR(45) NOT NULL,
  `seal_2_num` VARCHAR(45) NOT NULL,
  `seal_1_num` VARCHAR(45) NOT NULL,
  `niddle_size_num` VARCHAR(45) NOT NULL,
  `front_small_back_big_num` VARCHAR(45) NOT NULL,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

DROP TABLE IF EXISTS `order_size` ;

CREATE TABLE IF NOT EXISTS `order_size` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `size` SMALLINT UNSIGNED NOT NULL DEFAULT 0,
  `size_type` VARCHAR(45) NOT NULL,
  `created_at` TIMESTAMP NOT NULL,
  `order_id` INT UNSIGNED NOT NULL,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  INDEX `fk_order_size_order1_idx` (`order_id` ASC),
  CONSTRAINT `fk_order_size_order1`
    FOREIGN KEY (`order_id`)
    REFERENCES `order` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

DROP TABLE IF EXISTS `order_material` ;

CREATE TABLE IF NOT EXISTS `order_material` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `percent` SMALLINT NOT NULL DEFAULT 0,
  `material_name` VARCHAR(45) NOT NULL,
  `order_id` INT UNSIGNED NOT NULL,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
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
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  INDEX `fk_order_processing_guide_order1_idx` (`order_id` ASC),
  CONSTRAINT `fk_order_processing_guide_order1`
    FOREIGN KEY (`order_id`)
    REFERENCES `order` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

DROP TABLE IF EXISTS `order_CAD` ;

CREATE TABLE IF NOT EXISTS `order_CAD` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `tailor_id` INT UNSIGNED NOT NULL COMMENT 'person who is incharge of tailor',
  `order_id` INT UNSIGNED NOT NULL,
  `file_path` TEXT NULL,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
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
  `is_CS` TINYINT NOT NULL DEFAULT 0 COMMENT '1: Conflict support',
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  INDEX `fk_order_conversation_order1_idx` (`order_id` ASC),
  CONSTRAINT `fk_order_conversation_order1`
    FOREIGN KEY (`order_id`)
    REFERENCES `order` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

DROP TABLE IF EXISTS `log_post` ;

CREATE TABLE IF NOT EXISTS `log_post` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `tailor_id` INT NOT NULL COMMENT 'person who’s incharge of tailor\n',
  `order_id` INT UNSIGNED NOT NULL,
  `action_side` TINYINT NOT NULL DEFAULT 0 COMMENT '0: customer, 1: tailor\n',
  `type` TINYINT NOT NULL DEFAULT 0 COMMENT '1: tailor take job, 2: customer declined, 3: customer confirmed, 4: order complete, 5: customer cancel, 6: review',
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  INDEX `fk_log_post_order1_idx` (`order_id` ASC),
  CONSTRAINT `fk_log_post_order1`
    FOREIGN KEY (`order_id`)
    REFERENCES `order` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

DROP TABLE IF EXISTS `order_property` ;

CREATE TABLE IF NOT EXISTS `order_property` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` INT UNSIGNED NOT NULL COMMENT 'FK - category, for level 3',
  `order_id` INT UNSIGNED NOT NULL,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
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
        Schema::dropIfExists('log_post');
        Schema::dropIfExists('order_conversation');
        Schema::dropIfExists('order_CAD');
        Schema::dropIfExists('order_processing_guide');
        Schema::dropIfExists('order_material');
        Schema::dropIfExists('order_size');
        Schema::dropIfExists('order');
        Schema::dropIfExists('tailor_request_skill');
        Schema::dropIfExists('tailor_request');
        Schema::dropIfExists('withdraw');
        Schema::dropIfExists('user_skill');
        Schema::dropIfExists('user_identity');
        Schema::dropIfExists('users');
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->rememberToken();
            $table->timestamps();
        });
        \DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
