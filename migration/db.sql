CREATE DATABASE IF NOT EXISTS `chat` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `chat`;

-- Damp table chat.online_visitors
CREATE TABLE online_visitors(
  session_id CHAR(100) NOT NULL DEFAULT '',
  `user_id` int(11) NOT NULL,
  time INT(11) NOT NULL DEFAULT '0'
);

-- Damp table chat.status
CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Damp table data chat.status: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
REPLACE INTO `status` (`id`, `name`) VALUES
  (1, 'online'),
  (2, 'offline');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;

-- Damp table hillel.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(80) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT '2',
  `online_state` int(1) NOT NULL DEFAULT '0',
  `last_active` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `FK_users_status` (`status_id`),
  CONSTRAINT `FK_users_status` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Damp table data chat.users: ~4 rows
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
REPLACE INTO `users` (`id`, `email`, `name`, `password`, `status_id`, `online_state`, `last_active`, `created_at`, `updated_at`) VALUES
  (4, 'alarmdemo@ukr.net', 'roma', '$2y$10$Zy8pWdActDEKFzYYuV9P7.UvmxhkRYOfGLvGZpCXGfPgkDnJRHfiW', 2, 0, '2017-08-21 21:25:35', '2017-08-21 19:44:46', NULL),
  (6, 'alarmdemo@ukr.net22', '----', '$2y$10$yZFKsQ8oZ/e5tvtbrJY9mu049cxTQU92ACQ1Wq32K074X/vse8gmu', 2, 0, '2017-08-21 19:44:15', '2017-08-21 19:44:46', NULL),
  (7, 'alarmdemo@ukr.net33', '----', '$2y$10$rhOt2FQvSS5MbusDA7J9ne804Pu0zIM0E//OAhMvO3ToLHgkT4smy', 2, 0, '2017-08-21 19:44:15', '2017-08-21 19:44:46', NULL),
  (8, 'alarmdemo@ukr.net111', 'anzhela', '$2y$10$rhOt2FQvSS5MbusDA7J9ne804Pu0zIM0E//OAhMvO3ToLHgkT4smy', 2, 0, '2017-08-21 19:44:15', '2017-08-21 19:44:46', NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

-- damp table chat.messages
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `read_status` int(1) DEFAULT '0',
  `sender_id` int(11) NOT NULL,
  `recipient_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_messages_users` (`sender_id`),
  KEY `FK_messages_users_2` (`recipient_id`),
  CONSTRAINT `FK_messages_users` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`),
  CONSTRAINT `FK_messages_users_2` FOREIGN KEY (`recipient_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп структуры для таблица hillel.messages
CREATE TABLE IF NOT EXISTS `request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accepted` int(1) DEFAULT '0',
  `sender_id` int(11) NOT NULL,
  `recipient_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_messages_request` (`sender_id`),
  KEY `FK_messages_request_2` (`recipient_id`),
  CONSTRAINT `FK_messages_request` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`),
  CONSTRAINT `FK_messages_request_2` FOREIGN KEY (`recipient_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Damp table data chat.request: ~1 rows
/*!40000 ALTER TABLE `request` DISABLE KEYS */;
REPLACE INTO `request` (`id`, `accepted`, `sender_id`, `recipient_id`, `created_at`) VALUES
  (1, 0, 4, 8, '2017-08-21 21:25:35');
/*!40000 ALTER TABLE `request` ENABLE KEYS */;

-- Damp table chat.messages
CREATE TABLE IF NOT EXISTS `friends` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_messages_friends` (`user_id`),
  KEY `FK_messages_friends_2` (`friend_id`),
  CONSTRAINT `FK_messages_friends` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `FK_messages_friends_2` FOREIGN KEY (`friend_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Damp table data chat.friends: ~1 rows
/*!40000 ALTER TABLE `friends` DISABLE KEYS */;
REPLACE INTO `friends` (`id`, `user_id`, `friend_id`, `created_at`) VALUES
  (1, 8, 4, '2017-08-21 21:25:35');
/*!40000 ALTER TABLE `friends` ENABLE KEYS */;


-- Create Indexs
CREATE INDEX idx_users_name ON users (name);
