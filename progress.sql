CREATE TABLE `progress` (
  `id` int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `accuracy_percentage` int(11) DEFAULT NULL,
  `typing_speed_wpm` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

