-- Create the products table
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `summary` text,
  `price` decimal(10,2) NOT NULL,
  `category` varchar(255) NOT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert your actual data from the SQLite database
INSERT INTO `products` (`id`, `name`, `summary`, `price`, `category`, `cover_image`, `author`, `created_at`, `updated_at`) VALUES
(2, 'Wireless Mouse', 'Ergonomic wireless mouse', 79.99, 'Accessories', 'https://m.media-amazon.com/images/I/71GtJIryZJL.jpg', NULL, '2025-06-24 15:18:52', '2025-06-24 17:48:29'),
(3, 'Mechanical Keyboard', 'RGB mechanical gaming keyboard', 149.99, 'Accessories', NULL, NULL, '2025-06-24 15:18:52', '2025-06-24 15:18:52'),
(4, 'Test', 'test', 13.99, 'Dogs', NULL, NULL, '2025-06-24 16:00:08', '2025-06-24 16:00:08');