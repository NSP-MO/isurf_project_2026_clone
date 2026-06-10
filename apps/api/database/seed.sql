-- apps/api/database/seed.sql

-- Clear existing data
SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE `irrigation_logs`;
TRUNCATE TABLE `irrigation_schedules`;
TRUNCATE TABLE `alerts`;
TRUNCATE TABLE `sensor_readings`;
TRUNCATE TABLE `sensors`;
TRUNCATE TABLE `devices`;
SET FOREIGN_KEY_CHECKS = 1;

-- Seed Devices
INSERT INTO `devices` (`id`, `device_code`, `name`, `type`, `location`, `status`, `last_heartbeat`, `firmware_version`) VALUES
(1, 'ESP32_MAIN_01', 'Greenhouse Controller Alpha', 'esp32_irrigation', 'Greenhouse A - Sector 1', 'online', NOW(), 'v1.2.0'),
(2, 'ESP32_SUB_02', 'Nursery Monitor Beta', 'esp32_monitor', 'Nursery B', 'online', NOW(), 'v1.1.5'),
(3, 'ESP32_OUT_03', 'Outdoor Soil Station', 'esp32_monitor', 'Outdoor Farm 1', 'offline', DATE_SUB(NOW(), INTERVAL 2 DAY), 'v1.0.0');

-- Seed Sensors for Device 1 (Main Controller)
INSERT INTO `sensors` (`id`, `device_id`, `name`, `sensor_type`, `unit`, `min_threshold`, `max_threshold`, `is_active`) VALUES
(1, 1, 'Soil Moisture Sensor 1', 'moisture', '%', 40.0, 85.0, 1),
(2, 1, 'Water Tank Level', 'ultrasonic', 'L', 10.0, 100.0, 1),
(3, 1, 'Water pH Level', 'ph', 'pH', 5.5, 7.5, 1),
(4, 1, 'Water Quality (TDS)', 'tds', 'ppm', 0.0, 800.0, 1),
(5, 1, 'Air Temperature', 'temperature', '°C', 15.0, 35.0, 1);

-- Seed Sensors for Device 2
INSERT INTO `sensors` (`id`, `device_id`, `name`, `sensor_type`, `unit`, `min_threshold`, `max_threshold`, `is_active`) VALUES
(6, 2, 'Nursery Soil Moisture', 'moisture', '%', 50.0, 90.0, 1),
(7, 2, 'Nursery Temperature', 'temperature', '°C', 20.0, 30.0, 1);

-- Seed Users
-- Password for all seed users is 'password123'
INSERT INTO `users` (`username`, `email`, `password_hash`, `auth_key`, `status`, `created_at`, `updated_at`, `full_name`, `role`) VALUES
('admin', 'admin@isurf.local', '$2y$13$GpSZwptusVqUqjURiwKO.edMcGWQw1kgqY/Mlj/RIstaXWgAeGXtW', 'auth_key_admin_1', 10, UNIX_TIMESTAMP(), UNIX_TIMESTAMP(), 'System Administrator', 'admin'),
('operator1', 'operator@isurf.local', '$2y$13$GpSZwptusVqUqjURiwKO.edMcGWQw1kgqY/Mlj/RIstaXWgAeGXtW', 'auth_key_operator_2', 10, UNIX_TIMESTAMP(), UNIX_TIMESTAMP(), 'Greenhouse Operator', 'operator'),
('viewer1', 'viewer@isurf.local', '$2y$13$GpSZwptusVqUqjURiwKO.edMcGWQw1kgqY/Mlj/RIstaXWgAeGXtW', 'auth_key_viewer_3', 10, UNIX_TIMESTAMP(), UNIX_TIMESTAMP(), 'Guest Viewer', 'viewer');

-- Seed Recent Readings (Just a few for initial state, the generator will create more)
INSERT INTO `sensor_readings` (`sensor_id`, `device_id`, `value`, `recorded_at`) VALUES
(1, 1, 72.5, DATE_SUB(NOW(), INTERVAL 5 MINUTE)),
(2, 1, 85.0, DATE_SUB(NOW(), INTERVAL 5 MINUTE)),
(3, 1, 6.8, DATE_SUB(NOW(), INTERVAL 5 MINUTE)),
(4, 1, 450.0, DATE_SUB(NOW(), INTERVAL 5 MINUTE)),
(5, 1, 26.5, DATE_SUB(NOW(), INTERVAL 5 MINUTE)),
(6, 2, 65.0, DATE_SUB(NOW(), INTERVAL 10 MINUTE)),
(7, 2, 24.0, DATE_SUB(NOW(), INTERVAL 10 MINUTE));

-- Seed Alerts
INSERT INTO `alerts` (`device_id`, `sensor_id`, `alert_type`, `message`, `value`, `threshold_exceeded`, `is_read`, `created_at`) VALUES
(1, 1, 'warning', 'Soil moisture is dropping below optimal levels.', 42.5, 40.0, 0, DATE_SUB(NOW(), INTERVAL 2 HOUR)),
(3, NULL, 'critical', 'Device went offline unexpectedly.', NULL, NULL, 0, DATE_SUB(NOW(), INTERVAL 2 DAY)),
(1, 4, 'warning', 'TDS levels are slightly high.', 780.0, 800.0, 1, DATE_SUB(NOW(), INTERVAL 3 DAY));

-- Seed Irrigation Schedules
INSERT INTO `irrigation_schedules` (`id`, `device_id`, `name`, `start_time`, `duration_minutes`, `days_of_week`, `is_active`) VALUES
(1, 1, 'Morning Watering', '06:00:00', 15, '1,2,3,4,5,6,0', 1),
(2, 1, 'Evening Supplemental', '17:30:00', 10, '1,3,5', 1);

-- Seed Irrigation Logs
INSERT INTO `irrigation_logs`
(`schedule_id`, `device_id`, `trigger_type`, `started_at`, `ended_at`, `status`, `water_volume_liters`)
VALUES
(
    1,
    1,
    'scheduled',
    NOW(),
    NOW(),
    'completed',
    25.5
),
(
    NULL,
    1,
    'manual',
    NOW(),
    NOW(),
    'completed',
    18.0
);