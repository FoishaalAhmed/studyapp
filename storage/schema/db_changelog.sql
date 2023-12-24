-- Testimonial table
ALTER TABLE `testimonials` ADD `user_id` INT NOT NULL AFTER `photo`, ADD `status` VARCHAR(15) NOT NULL AFTER `user_id`, ADD INDEX `user_id_testimonials_idx` (`user_id`), ADD INDEX `status_testimonials_idx` (`status`); 
ALTER TABLE `testimonials` CHANGE `status` `status` VARCHAR(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'In Review' COMMENT 'Published, In Review'; 

-- Blog table
ALTER TABLE `blogs` CHANGE `status` `status` VARCHAR(15) NOT NULL DEFAULT 'In Review' COMMENT 'In Review, Published'; 

-- Buy table
ALTER TABLE `buys` CHANGE `status` `status` VARCHAR(15) NOT NULL DEFAULT 'Not Confirm' COMMENT 'Not Confirm, Confirm'; 

-- Exam table
ALTER TABLE `exams` CHANGE `type` `type` VARCHAR(7) NOT NULL DEFAULT 'Free' COMMENT 'Free,Premium';
ALTER TABLE `exams` CHANGE `status` `status` VARCHAR(10) NOT NULL DEFAULT 'In Review' COMMENT 'Published, In Review';
ALTER TABLE `exams` CHANGE `draft` `draft` VARCHAR(10) NOT NULL DEFAULT 'Yes' COMMENT 'Yes, No';

-- Lecture Sheet
ALTER TABLE `lecture_sheets` CHANGE `type` `type` VARCHAR(7) NOT NULL DEFAULT 'Free' COMMENT 'Free,Premium';
ALTER TABLE `lecture_sheets` CHANGE `status` `status` VARCHAR(10) NOT NULL DEFAULT 'In Review' COMMENT 'Published, In Review';
ALTER TABLE `lecture_sheets` ADD `user_id` BIGINT NULL DEFAULT NULL AFTER `status`, ADD INDEX `lecture_sheets_user_id_idx` (`user_id`);

-- Ebook
ALTER TABLE `ebooks` CHANGE `type` `type` VARCHAR(7) NOT NULL DEFAULT 'Free' COMMENT 'Free,Premium';
ALTER TABLE `ebooks` CHANGE `status` `status` VARCHAR(10) NOT NULL DEFAULT 'In Review' COMMENT 'Published, In Review';
ALTER TABLE `ebooks` ADD `user_id` BIGINT NULL DEFAULT NULL AFTER `status`, ADD INDEX `ebooks_user_id_idx` (`user_id`);

-- Model Test
ALTER TABLE `model_tests` CHANGE `type` `type` VARCHAR(7) NOT NULL DEFAULT 'Free' COMMENT 'Free,Premium';
ALTER TABLE `model_tests` CHANGE `status` `status` VARCHAR(10) NOT NULL DEFAULT 'In Review' COMMENT 'Published, In Review';
ALTER TABLE `model_tests` CHANGE `draft` `draft` VARCHAR(10) NOT NULL DEFAULT 'Yes' COMMENT 'Yes, No';

-- Job Category
ALTER TABLE `job_categories` ADD `user_id` BIGINT NULL DEFAULT NULL AFTER `photo`, ADD INDEX `job_categories_user_id_idx` (`user_id`); 

-- Job
ALTER TABLE `jobs` CHANGE `file` `photo` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;
ALTER TABLE `jobs` ADD `user_id` BIGINT NULL DEFAULT NULL AFTER `photo`, ADD INDEX `jobs_user_id_idx` (`user_id`);