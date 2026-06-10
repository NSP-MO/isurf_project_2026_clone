-- apps/api/database/schema.sql

-- 1. Tabel users (Memperluas struktur bawaan Yii2)
CREATE TABLE IF NOT EXISTS `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(255) NOT NULL UNIQUE,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `password_hash` VARCHAR(255) NOT NULL,
  `auth_key` VARCHAR(32) NOT NULL,
  `password_reset_token` VARCHAR(255) UNIQUE,
  `status` SMALLINT NOT NULL DEFAULT 10,
  `created_at` INT NOT NULL,
  `updated_at` INT NOT NULL,
  -- Kolom tambahan untuk iSURF
  `full_name` VARCHAR(255),
  `role` ENUM('admin') DEFAULT 'admin',
  `avatar_url` VARCHAR(255),
  `last_login_at` INT
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 2. Tabel devices
CREATE TABLE IF NOT EXISTS `devices` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `device_code` VARCHAR(100) NOT NULL UNIQUE,
  `name` VARCHAR(255) NOT NULL,
  `type` VARCHAR(100),
  `location` VARCHAR(255),
  `status` ENUM('online', 'offline', 'maintenance') DEFAULT 'offline',
  `last_heartbeat` DATETIME,
  `firmware_version` VARCHAR(50),
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. Tabel sensors
CREATE TABLE IF NOT EXISTS `sensors` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `device_id` INT NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `sensor_type` ENUM('tds', 'ph', 'moisture', 'ultrasonic', 'temperature') NOT NULL,
  `unit` VARCHAR(20) NOT NULL,
  `min_threshold` FLOAT,
  `max_threshold` FLOAT,
  `is_active` BOOLEAN DEFAULT TRUE,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`device_id`) REFERENCES `devices`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. Tabel sensor_readings
CREATE TABLE IF NOT EXISTS `sensor_readings` (
  `id` BIGINT AUTO_INCREMENT PRIMARY KEY,
  `sensor_id` INT NOT NULL,
  `device_id` INT NOT NULL,
  `value` FLOAT NOT NULL,
  `recorded_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`sensor_id`) REFERENCES `sensors`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`device_id`) REFERENCES `devices`(`id`) ON DELETE CASCADE,
  INDEX `idx_recorded_at` (`recorded_at`),
  INDEX `idx_device_sensor` (`device_id`, `sensor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 5. Tabel alerts
CREATE TABLE IF NOT EXISTS `alerts` (
  `id` BIGINT AUTO_INCREMENT PRIMARY KEY,
  `device_id` INT NOT NULL,
  `sensor_id` INT,
  `alert_type` ENUM('info', 'warning', 'critical') NOT NULL,
  `message` TEXT NOT NULL,
  `value` FLOAT,
  `threshold_exceeded` FLOAT,
  `is_read` BOOLEAN DEFAULT FALSE,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `resolved_at` DATETIME,
  FOREIGN KEY (`device_id`) REFERENCES `devices`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`sensor_id`) REFERENCES `sensors`(`id`) ON DELETE SET NULL,
  INDEX `idx_is_read` (`is_read`),
  INDEX `idx_created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 6. Tabel irrigation_schedules
CREATE TABLE IF NOT EXISTS `irrigation_schedules` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `device_id` INT NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `start_time` TIME NOT NULL,
  `duration_minutes` INT NOT NULL,
  `days_of_week` VARCHAR(50) NOT NULL COMMENT 'Contoh: 1,3,5 untuk Mon,Wed,Fri',
  `is_active` BOOLEAN DEFAULT TRUE,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`device_id`) REFERENCES `devices`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 7. Tabel irrigation_logs
CREATE TABLE IF NOT EXISTS `irrigation_logs` (
  `id` BIGINT AUTO_INCREMENT PRIMARY KEY,
  `schedule_id` INT,
  `device_id` INT NOT NULL,
  `trigger_type` ENUM('manual', 'scheduled', 'auto_sensor') NOT NULL,
  `started_at` DATETIME NOT NULL,
  `ended_at` DATETIME,
  `status` ENUM('running', 'completed', 'failed') NOT NULL DEFAULT 'running',
  `water_volume_liters` FLOAT,
  FOREIGN KEY (`device_id`) REFERENCES `devices`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`schedule_id`) REFERENCES `irrigation_schedules`(`id`) ON DELETE SET NULL,
  INDEX `idx_started_at` (`started_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 8. Tabel data_requests
CREATE TABLE IF NOT EXISTS `data_requests` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `tracking_code` VARCHAR(50) NOT NULL UNIQUE,
  `full_name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `nim_nip` VARCHAR(50) NOT NULL,
  `reason` TEXT NOT NULL,
  `document_path` VARCHAR(255) NOT NULL,
  `data_type` ENUM('monitoring','analytics') NOT NULL,
  `requested_sensors` JSON,
  `date_start` DATE,
  `date_end` DATE,
  `status` ENUM('pending','approved','rejected') DEFAULT 'pending',
  `admin_notes` TEXT,
  `download_token` VARCHAR(64),
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `reviewed_at` DATETIME,
  `reviewed_by` INT,
  FOREIGN KEY (`reviewed_by`) REFERENCES `users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
