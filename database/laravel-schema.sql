-- ==========================================================
-- Laravel Webinar App - Full Database Schema + Seed Data
-- Import this file via phpMyAdmin
-- ==========================================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+07:00";

-- -----------------------------------------------------------
-- 1. USERS (admin login)
-- -----------------------------------------------------------
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- 2. PASSWORD RESET TOKENS
-- -----------------------------------------------------------
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- 3. SESSIONS
-- -----------------------------------------------------------
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- 4. CACHE
-- -----------------------------------------------------------
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- 5. CACHE LOCKS
-- -----------------------------------------------------------
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- 6. JOBS (queue)
-- -----------------------------------------------------------
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- 7. JOB BATCHES
-- -----------------------------------------------------------
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- 8. FAILED JOBS
-- -----------------------------------------------------------
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- 9. WEBINARS
-- -----------------------------------------------------------
CREATE TABLE `webinars` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tag` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date DEFAULT NULL,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flyer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `platform` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `has_two_prices` tinyint(1) NOT NULL DEFAULT '0',
  `register_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lms_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `professions` text COLLATE utf8mb4_unicode_ci,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_account_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_account_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_left_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_left_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_right_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_right_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `health_channel_text` text COLLATE utf8mb4_unicode_ci,
  `health_channel_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `health_channel_btn_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `speakers` json DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `register_closed` tinyint(1) NOT NULL DEFAULT '0',
  `wa_message` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- 10. SPEAKERS
-- -----------------------------------------------------------
CREATE TABLE `speakers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `inst` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'male',
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- 11. TESTIMONIALS
-- -----------------------------------------------------------
CREATE TABLE `testimonials` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'male',
  `stars` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '★★★★★',
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- 12. CONTACT SETTINGS
-- -----------------------------------------------------------
CREATE TABLE `contact_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `contact_settings_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------
-- 13. MIGRATIONS (so Laravel knows all migrations are done)
-- -----------------------------------------------------------
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('0001_01_01_000000_create_users_table', 1),
('0001_01_01_000001_create_cache_table', 1),
('0001_01_01_000002_create_jobs_table', 1),
('2026_05_29_181244_create_webinars_table', 1),
('2026_05_29_184455_create_speakers_table', 1),
('2026_05_29_184456_create_testimonials_table', 1),
('2026_05_29_184456_create_contact_settings_table', 1),
('2026_05_29_184508_add_register_closed_to_webinars_table', 1),
('2026_05_29_184701_add_stars_to_testimonials_table', 1),
('2026_05_29_185934_add_wa_message_to_webinars_table', 1),
('2026_05_29_194012_add_gender_to_speakers_table', 1),
('2026_05_29_194317_add_gender_to_testimonials_table', 1),
('2026_05_29_200309_add_date_to_speakers_table', 1),
('2026_05_29_200314_add_date_to_testimonials_table', 1),
('2026_05_30_030631_add_bank_fields_to_webinars_table', 1),
('2026_05_30_131436_add_lms_link_to_webinars_table', 1),
('2026_06_01_000000_change_title_to_text_in_webinars_table', 1);

-- -----------------------------------------------------------
-- 14. SEED: Admin User (password: admin123)
-- -----------------------------------------------------------
INSERT INTO `users` (`name`, `email`, `password`, `created_at`, `updated_at`) VALUES
('Admin', 'admin@admin.com', '$2y$12$aH1GW1RY9q98JGH2if6wxe3g70NfJxoiFRuqaMRUON1Eg2YvF4mA2', NOW(), NOW());

-- -----------------------------------------------------------
-- 15. SEED: Contact Settings (default)
-- -----------------------------------------------------------
INSERT INTO `contact_settings` (`key`, `value`, `created_at`, `updated_at`) VALUES
('email', 'admin@admin.com', NOW(), NOW()),
('phone', '+6281234567890', NOW(), NOW()),
('address', 'Jl. Contoh No. 123, Jakarta', NOW(), NOW()),
('map_embed', '', NOW(), NOW());

COMMIT;
