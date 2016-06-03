-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 03, 2016 at 08:08 
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sensorman`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sensor`
--

CREATE TABLE `sensor` (
  `id` int(11) UNSIGNED NOT NULL,
  `group_id` int(11) UNSIGNED DEFAULT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `shared_with` int(11) UNSIGNED DEFAULT NULL,
  `sensor_key` varchar(512) NOT NULL,
  `sensor_type` varchar(16) DEFAULT NULL,
  `sensor_name` varchar(512) NOT NULL,
  `sensor_description` text,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sensor_collab`
--

CREATE TABLE `sensor_collab` (
  `sensor_collab_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `sensor_collab_name` varchar(512) NOT NULL,
  `sensor_collab_desc` text,
  `sensor_x_id` int(11) UNSIGNED NOT NULL,
  `sensor_y_id` int(11) UNSIGNED DEFAULT NULL,
  `sensor_z_id` int(11) UNSIGNED DEFAULT NULL,
  `sensor_x_rule_id` int(11) UNSIGNED DEFAULT NULL,
  `sensor_y_rule_id` int(11) UNSIGNED DEFAULT NULL,
  `sensor_z_rule_id` int(11) UNSIGNED DEFAULT NULL,
  `comp_operator` varchar(16) DEFAULT NULL,
  `operator` varchar(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sensor_collab_data`
--

CREATE TABLE `sensor_collab_data` (
  `sensor_collab_data_id` int(11) UNSIGNED NOT NULL,
  `sensor_x_value` float DEFAULT NULL,
  `sensor_y_value` float DEFAULT NULL,
  `sensor_collab_id` int(11) UNSIGNED NOT NULL,
  `sensor_reading` float DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sensor_data`
--

CREATE TABLE `sensor_data` (
  `id` int(255) UNSIGNED NOT NULL,
  `sensor_id` int(11) UNSIGNED NOT NULL,
  `sensor_reading` float DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sensor_group`
--

CREATE TABLE `sensor_group` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_name` varchar(512) NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sensor_rule`
--

CREATE TABLE `sensor_rule` (
  `rule_id` int(11) UNSIGNED NOT NULL,
  `sensor_id` int(11) UNSIGNED NOT NULL,
  `rule_type` varchar(32) NOT NULL,
  `rule_value` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sensor_rule_status`
--

CREATE TABLE `sensor_rule_status` (
  `status_id` int(11) UNSIGNED NOT NULL,
  `sensor_rule_id` int(11) UNSIGNED NOT NULL,
  `triggered_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `api_key` varchar(512) NOT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `sensor_limit` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `api_key`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `sensor_limit`) VALUES
(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', '', 'admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1268889823, 1, 'Admin', 'istrator', NULL),
(2, '::1', 'hadrianbsrg', '$2y$08$zevCjimkNuwkmn4IwRn7Deqfq3273/sbXzWbaazP5LH1lV2R7zLzq', NULL, '', 'bay@datangaja.com', NULL, NULL, NULL, NULL, 1460047354, 1464728958, 1, NULL, NULL, 10),
(3, '::1', 'hadrianbs', '$2y$08$kq7J/AWgJHs5af3TsrJFxO3fiShK/GXLmbLgVs8Jzhq4SRf.4PIDO', NULL, '', 'hadrianbayanulhaq@gmail.com', NULL, NULL, NULL, NULL, 1464633997, 1464682007, 1, NULL, NULL, 10);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(4, 3, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sensor`
--
ALTER TABLE `sensor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `shared_with` (`shared_with`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `sensor_collab`
--
ALTER TABLE `sensor_collab`
  ADD PRIMARY KEY (`sensor_collab_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `sensor_x_id` (`sensor_x_id`),
  ADD KEY `sensor_y_id` (`sensor_y_id`),
  ADD KEY `sensor_x_rule_id` (`sensor_x_rule_id`),
  ADD KEY `sensor_y_rule_id` (`sensor_y_rule_id`);

--
-- Indexes for table `sensor_collab_data`
--
ALTER TABLE `sensor_collab_data`
  ADD PRIMARY KEY (`sensor_collab_data_id`),
  ADD KEY `sensor_collab_id` (`sensor_collab_id`);

--
-- Indexes for table `sensor_data`
--
ALTER TABLE `sensor_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sensor_id` (`sensor_id`);

--
-- Indexes for table `sensor_group`
--
ALTER TABLE `sensor_group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `sensor_rule`
--
ALTER TABLE `sensor_rule`
  ADD PRIMARY KEY (`rule_id`),
  ADD KEY `sensor_id_2` (`sensor_id`);

--
-- Indexes for table `sensor_rule_status`
--
ALTER TABLE `sensor_rule_status`
  ADD PRIMARY KEY (`status_id`),
  ADD KEY `sensor_rule_id` (`sensor_rule_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sensor`
--
ALTER TABLE `sensor`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `sensor_collab`
--
ALTER TABLE `sensor_collab`
  MODIFY `sensor_collab_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sensor_collab_data`
--
ALTER TABLE `sensor_collab_data`
  MODIFY `sensor_collab_data_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sensor_data`
--
ALTER TABLE `sensor_data`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sensor_group`
--
ALTER TABLE `sensor_group`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sensor_rule`
--
ALTER TABLE `sensor_rule`
  MODIFY `rule_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sensor_rule_status`
--
ALTER TABLE `sensor_rule_status`
  MODIFY `status_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `sensor`
--
ALTER TABLE `sensor`
  ADD CONSTRAINT `FK_sensor_sensor_group` FOREIGN KEY (`group_id`) REFERENCES `sensor_group` (`id`),
  ADD CONSTRAINT `FK_sensor_shared_with_users_id` FOREIGN KEY (`shared_with`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_sensor_user_id_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `sensor_collab`
--
ALTER TABLE `sensor_collab`
  ADD CONSTRAINT `fk_sensor_x` FOREIGN KEY (`sensor_x_id`) REFERENCES `sensor` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sensor_y` FOREIGN KEY (`sensor_y_id`) REFERENCES `sensor` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `sensor_data`
--
ALTER TABLE `sensor_data`
  ADD CONSTRAINT `sensor_data_sensor_id_sensor_FK` FOREIGN KEY (`sensor_id`) REFERENCES `sensor` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `sensor_group`
--
ALTER TABLE `sensor_group`
  ADD CONSTRAINT `FK_sensor_group_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `sensor_rule`
--
ALTER TABLE `sensor_rule`
  ADD CONSTRAINT `FK_sensor_id_sensor_rule_sensor` FOREIGN KEY (`sensor_id`) REFERENCES `sensor` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
