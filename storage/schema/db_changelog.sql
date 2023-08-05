-- Testimonial table

ALTER TABLE `testimonials` ADD `user_id` INT NOT NULL AFTER `photo`, ADD `status` VARCHAR(15) NOT NULL AFTER `user_id`, ADD INDEX `user_id_testimonials_idx` (`user_id`), ADD INDEX `status_testimonials_idx` (`status`); 

ALTER TABLE `testimonials` CHANGE `status` `status` VARCHAR(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'In Review' COMMENT 'Published, In Review'; 

-- Blog table

ALTER TABLE `blogs` CHANGE `status` `status` VARCHAR(15) NOT NULL DEFAULT 'In Review' COMMENT 'In Review, Published'; 

-- Buy table

ALTER TABLE `buys` CHANGE `status` `status` VARCHAR(15) NOT NULL DEFAULT 'Not Confirm' COMMENT 'Not Confirm, Confirm'; 

-- Exam table

ALTER TABLE `exams` CHANGE `type` `type` VARCHAR(7) NOT NULL COMMENT 'free,premium';
ALTER TABLE `exams` CHANGE `status` `status` VARCHAR(10) NOT NULL DEFAULT 'In Review' COMMENT 'Published, In Review';