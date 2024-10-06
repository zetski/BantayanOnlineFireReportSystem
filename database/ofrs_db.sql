-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 06, 2024 at 04:40 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ofrs_db`
--
CREATE DATABASE IF NOT EXISTS `ofrs_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ofrs_db`;

-- --------------------------------------------------------

--
-- Table structure for table `events_list`
--

CREATE TABLE `events_list` (
  `id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_description` text NOT NULL,
  `event_date` date NOT NULL,
  `municipality` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `sitio` varchar(255) NOT NULL,
  `event_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events_list`
--

INSERT INTO `events_list` (`id`, `event_name`, `event_description`, `event_date`, `municipality`, `barangay`, `sitio`, `event_image`, `created_at`, `updated_at`) VALUES
(52, 'Earthquake Drill', 'dgadasdfas', '2024-10-31', 'Santa Fe', 'Talisay', 'Hilotongan national highschool', '../uploads/1728012246_04dea8632a9bc02fff16d40f39a79f88.jpg', '2024-10-04 03:24:06', '2024-10-04 03:24:06'),
(68, 'Flood Drill', 'nagbaha na akun kabogo tabang', '2024-11-03', 'Bantayan', 'Botigues', 'Mancilang Elem School', '1728178257_𝘩𝘪𝘴𝘶𝘪 𝘩𝘦𝘢𝘥𝘦𝘳𝘴 • 𝘬𝘪𝘮𝘦𝘵𝘴𝘶 𝘯𝘰 𝘺𝘢𝘪𝘣𝘢_ 𝘺𝘶𝘶𝘬𝘢𝘬𝘶-𝘩𝘦𝘯.jpg', '2024-10-06 01:30:57', '2024-10-06 01:30:57'),
(71, 'Tornado Drill', 'Tornado drills are a crucial part of emergency preparedness, ensuring that individuals know how to respond effectively during a tornado threat. Regular practice helps to instill confidence and readiness, potentially saving lives in the event of a real tornado.', '2024-11-09', 'Bantayan', 'Doong', 'Doong Elem School', '1728189826_𝐓𝐚𝐧𝐣𝐢𝐫𝐨 • 𝐊𝐢𝐦𝐞𝐭𝐬𝐮 𝐧𝐨 𝐘𝐚𝐢𝐛𝐚.jpg', '2024-10-06 04:43:46', '2024-10-06 04:43:46'),
(72, 'Evacuation Drill', 'on sunday we have a evacuation drill to do at san agustin national highschool', '2024-11-08', 'Santa Fe', 'Kinatarkan', 'Doong Elem School', '1728194565_your name movie.jpg', '2024-10-06 06:02:45', '2024-10-06 06:02:45'),
(73, 'Earthquake Drill', 'may earth quake drill nga pagahimoon sa bantayan national high school bwas', '2024-11-05', 'Bantayan', 'Ticad', 'BNHS', '1728213802_DALL·E 2024-09-20 08.16.39 - A scene illustrating disaster response activities during floods, earthquakes, and typhoons. Firefighters and emergency response teams are seen rescuin.webp', '2024-10-06 11:23:22', '2024-10-06 11:23:22');

-- --------------------------------------------------------

--
-- Table structure for table `history_list`
--

CREATE TABLE `history_list` (
  `id` int(30) NOT NULL,
  `request_id` int(30) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `remarks` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history_list`
--

INSERT INTO `history_list` (`id`, `request_id`, `status`, `remarks`, `date_created`) VALUES
(117, 77, 1, 'Request has been assign to a fire control team.', '2024-09-19 15:44:03'),
(118, 78, 1, 'Request has been assign to a fire control team.', '2024-10-04 20:39:06');

-- --------------------------------------------------------

--
-- Table structure for table `inquiry_list`
--

CREATE TABLE `inquiry_list` (
  `id` int(30) NOT NULL,
  `fullname` text NOT NULL,
  `email` text NOT NULL,
  `contact` text NOT NULL,
  `message` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `request_list`
--

CREATE TABLE `request_list` (
  `id` int(30) NOT NULL,
  `team_id` int(30) DEFAULT NULL,
  `code` varchar(100) NOT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `contact` text NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `municipality` varchar(255) DEFAULT NULL,
  `barangay` varchar(255) DEFAULT NULL,
  `sitio_street` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = Pending,\r\n1 = Assigned to Team,\r\n2 = Team on their Way\r\n3 = Relief on progress\r\n4 = Completed',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_reports` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request_list`
--

INSERT INTO `request_list` (`id`, `team_id`, `code`, `lastname`, `firstname`, `middlename`, `contact`, `subject`, `message`, `image`, `municipality`, `barangay`, `sitio_street`, `status`, `date_created`, `date_updated`, `deleted_reports`) VALUES
(73, NULL, '20240913-0001', 'Oflas', 'Mary', 'Ann', '09325247257', 'Flood', 'hello lord', '../uploads/ec380e786054aa3cdd247f583471fe85.jpg', 'Madridejos', 'Pili', 'Purok lubi 2, cahutay srt.', 5, '2024-09-13 16:58:40', '2024-09-19 11:08:04', '{\"id\":\"73\",\"team_id\":null,\"code\":\"20240913-0001\",\"lastname\":\"Oflas\",\"firstname\":\"Mary\",\"middlename\":\"Ann\",\"contact\":\"09325247257\",\"subject\":\"Flood\",\"message\":\"hello lord\",\"image\":\"..\\/uploads\\/ec380e786054aa3cdd247f583471fe85.jpg\",\"municipality\":\"Madridej'),
(75, NULL, '20240917-0001', 'Durant', 'Kevin', 'James', '09325247257', 'Flood', 'jafhsakdfjksa', '../uploads/4b4cd4a350ebe4090bcf4fdf9bcc40f3.jpeg', 'Bantayan', 'Tamiao', 'Purok Mangga 2', 5, '2024-09-17 10:28:12', '2024-09-19 11:08:23', '{\"id\":\"75\",\"team_id\":null,\"code\":\"20240917-0001\",\"lastname\":\"Durant\",\"firstname\":\"Kevin\",\"middlename\":\"James\",\"contact\":\"09325247257\",\"subject\":\"Flood\",\"message\":\"jafhsakdfjksa\",\"image\":\"..\\/uploads\\/4b4cd4a350ebe4090bcf4fdf9bcc40f3.jpeg\",\"municipality\":\"'),
(76, NULL, '20240918-0001', 'Lebron', 'James', 'Bron', '09325247257', 'Sunog', 'my house is on fire', '../uploads/c16cbd9d41079ad647a0efbacefcc1f0.jpg', 'Santa Fe', 'Okoy', 'Purok Bakhawan', 5, '2024-09-18 18:02:26', '2024-09-19 11:41:49', '{\"id\":\"76\",\"team_id\":null,\"code\":\"20240918-0001\",\"lastname\":\"Lebron\",\"firstname\":\"James\",\"middlename\":\"Bron\",\"contact\":\"09325247257\",\"subject\":\"Sunog\",\"message\":\"my house is on fire\",\"image\":\"..\\/uploads\\/c16cbd9d41079ad647a0efbacefcc1f0.jpg\",\"municipalit'),
(77, 2, '20240919-0001', 'Steph', 'Curry', 'Karlitos', '09283239293', 'Flood', 'oracle has on fire', '../uploads/add6466412d7ab2196c8b3f2b92b1f9e.jpg', 'Santa Fe', 'Maricaban', 'Purok Danggit', 5, '2024-09-19 15:43:46', '2024-10-04 20:46:17', '{\"id\":\"77\",\"team_id\":\"2\",\"code\":\"20240919-0001\",\"lastname\":\"Steph\",\"firstname\":\"Curry\",\"middlename\":\"Karlitos\",\"contact\":\"09283239293\",\"subject\":\"Flood\",\"message\":\"oracle has on fire\",\"image\":\"..\\/uploads\\/add6466412d7ab2196c8b3f2b92b1f9e.jpg\",\"municipali'),
(78, 7, '20241004-0001', 'Kurosaki', 'Ichigo', 'Kun', '09122777291', 'Fire', 'Wild fires in the middle of ocaeans', '../uploads/ca4e7d5a06944ab502dbf829d3167478.jpg', 'Bantayan', 'Lipayran', 'Purok Danggit', 5, '2024-10-04 20:38:41', '2024-10-04 20:46:12', '{\"id\":\"78\",\"team_id\":\"7\",\"code\":\"20241004-0001\",\"lastname\":\"Kurosaki\",\"firstname\":\"Ichigo\",\"middlename\":\"Kun\",\"contact\":\"09122777291\",\"subject\":\"Fire\",\"message\":\"Wild fires in the middle of ocaeans\",\"image\":\"..\\/uploads\\/ca4e7d5a06944ab502dbf829d3167478.j'),
(79, NULL, '20241004-0002', 'Ichiro ', 'Yuda', 'Yuji', '09343243243', 'Rescue', 'fasdfsaf', '../uploads/ddb929ab25befd718d1cd929b55dfe65.jpg', 'Santa Fe', 'Okoy', 'Purok Gusaw', 5, '2024-10-04 20:44:10', '2024-10-04 20:46:02', '{\"id\":\"79\",\"team_id\":null,\"code\":\"20241004-0002\",\"lastname\":\"Ichiro \",\"firstname\":\"Yuda\",\"middlename\":\"Yuji\",\"contact\":\"09343243243\",\"subject\":\"Rescue\",\"message\":\"fasdfsaf\",\"image\":\"..\\/uploads\\/ddb929ab25befd718d1cd929b55dfe65.jpg\",\"municipality\":\"Santa '),
(80, NULL, '20241004-0003', 'Kurosaki', 'Yuda', 'Kun', '09122777291', 'Rescue', 'hoo kabogo', '../uploads/bdf5aab32c6d73b67cddc116dc88604f.jpeg', 'Bantayan', 'Lipayran', 'Purok Guso', 5, '2024-10-04 20:51:53', '2024-10-04 20:54:14', '{\"id\":\"80\",\"team_id\":null,\"code\":\"20241004-0003\",\"lastname\":\"Kurosaki\",\"firstname\":\"Yuda\",\"middlename\":\"Kun\",\"contact\":\"09122777291\",\"subject\":\"Rescue\",\"message\":\"hoo kabogo\",\"image\":\"..\\/uploads\\/bdf5aab32c6d73b67cddc116dc88604f.jpeg\",\"municipality\":\"Ban');

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'Online Fire Reporting System'),
(6, 'short_name', 'BANTAYAN FIRE STATION'),
(11, 'logo', 'uploads/logo.png?v=1719406619'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/cover.png?v=1719455712'),
(17, 'phone', '(032)420-9079'),
(18, 'mobile', '09224048279'),
(19, 'email', 'bantayanfirestation@gmail.com'),
(20, 'address', 'Suba, Bantayan, Cebu'),
(21, 'facebook', 'https://bantayan-bfp.com/');

-- --------------------------------------------------------

--
-- Table structure for table `team_list`
--

CREATE TABLE `team_list` (
  `id` int(30) NOT NULL,
  `code` varchar(100) NOT NULL,
  `district` varchar(255) DEFAULT NULL,
  `leader_name` text NOT NULL,
  `leader_contact` text NOT NULL,
  `members` text NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team_list`
--

INSERT INTO `team_list` (`id`, `code`, `district`, `leader_name`, `leader_contact`, `members`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 'F-623', NULL, 'Mark D Cooper', '09456789123', 'John Smith, Mike Ross, Steven Miller, Anthony Wheeler', 1, '2022-05-21 09:31:00', '2024-07-15 13:46:11'),
(2, 'F-1014', 'Bantayan', 'Johnny Deep', '09654789123', 'Member 101, Member 102, Member 103, Member 104', 0, '2022-05-21 09:44:15', '2024-10-01 09:16:36'),
(3, 'PRSK', NULL, 'sakabi', '09977888122', 'buning, tiring, koring, daring', 1, '2024-07-09 23:56:34', '2024-07-09 23:56:45'),
(4, '738LPG', NULL, 'jose', '09384237583', 'kano, negro, arabo, indiano', 1, '2024-07-11 20:05:09', '2024-07-12 08:13:01'),
(5, '235FKR9', NULL, 'nonoy', '09834737222', 'k, j, l, ah', 1, '2024-07-12 21:09:10', '2024-07-14 20:38:37'),
(6, '123KILL', NULL, 'kiboy', '09848673723', 'karl, kelra, chaknu, flap', 1, '2024-07-14 20:51:47', '2024-07-14 20:53:09'),
(7, 'K-043135', 'Santa Fe', 'Roger', '09358275838', 'Red Hair, Marco, Ace, White Beard', 0, '2024-07-15 21:18:36', '2024-09-11 15:45:47'),
(8, 'F-2349', NULL, 'Black Beard', '09328573732', 'Member 110, Member 111, Member 112, Member 113', 1, '2024-07-15 21:25:41', '2024-07-15 21:26:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `middlename` text DEFAULT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `district` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `token_expiry` datetime DEFAULT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='2';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `username`, `district`, `email`, `password`, `reset_token`, `token_expiry`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`) VALUES
(10, 'Bantayan ', '', 'BFP', 'Bantayan-RVII', 'Bantayan', 'bantayanbfp@gmail.com', '288a63c940e4ece7eedbca07b26c03f2', NULL, NULL, NULL, NULL, 1, '2024-10-06 22:16:59', '2024-10-06 22:16:59'),
(11, 'Madridejos', '', 'BFP', 'Madridejos-RVII', 'Madridejos', 'madridejosbfp@gmail.com', '7341f73b48a40a7d999c3911ce928b1a', NULL, NULL, 'uploads/avatars/11.png?v=1728224493', NULL, 1, '2024-10-06 22:21:33', '2024-10-06 22:37:40'),
(12, 'SantaFe', '', 'BFP', 'SantaFe-RVII', 'Santa Fe', 'santafebfp@gmail.com', '52eca04a1d24a245527c50175acadb57', NULL, NULL, 'uploads/avatars/12.png?v=1728224668', NULL, 1, '2024-10-06 22:24:28', '2024-10-06 22:38:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events_list`
--
ALTER TABLE `events_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_list`
--
ALTER TABLE `history_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `request_id` (`request_id`);

--
-- Indexes for table `inquiry_list`
--
ALTER TABLE `inquiry_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_list`
--
ALTER TABLE `request_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `team_id_fk_rl` (`team_id`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team_list`
--
ALTER TABLE `team_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events_list`
--
ALTER TABLE `events_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `history_list`
--
ALTER TABLE `history_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `inquiry_list`
--
ALTER TABLE `inquiry_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `request_list`
--
ALTER TABLE `request_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `team_list`
--
ALTER TABLE `team_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `history_list`
--
ALTER TABLE `history_list`
  ADD CONSTRAINT `request_id_fh_hl` FOREIGN KEY (`request_id`) REFERENCES `request_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `request_list`
--
ALTER TABLE `request_list`
  ADD CONSTRAINT `team_id_fk_rl` FOREIGN KEY (`team_id`) REFERENCES `team_list` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;
--
-- Database: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Table structure for table `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) NOT NULL DEFAULT '',
  `user` varchar(255) NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `query` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Table structure for table `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) NOT NULL,
  `col_name` varchar(64) NOT NULL,
  `col_type` varchar(64) NOT NULL,
  `col_length` text DEFAULT NULL,
  `col_collation` varchar(64) NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) DEFAULT '',
  `col_default` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Table structure for table `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `column_name` varchar(64) NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `transformation` varchar(255) NOT NULL DEFAULT '',
  `transformation_options` varchar(255) NOT NULL DEFAULT '',
  `input_transformation` varchar(255) NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) NOT NULL,
  `settings_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Table structure for table `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL,
  `export_type` varchar(10) NOT NULL,
  `template_name` varchar(64) NOT NULL,
  `template_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Table structure for table `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Table structure for table `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db` varchar(64) NOT NULL DEFAULT '',
  `table` varchar(64) NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) NOT NULL,
  `item_name` varchar(64) NOT NULL,
  `item_type` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Table structure for table `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Dumping data for table `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"ofrs_db\",\"table\":\"users\"},{\"db\":\"ofrs_db\",\"table\":\"request_list\"},{\"db\":\"ofrs_db\",\"table\":\"system_info\"},{\"db\":\"ofrs_db\",\"table\":\"events_list\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) NOT NULL DEFAULT '',
  `master_table` varchar(64) NOT NULL DEFAULT '',
  `master_field` varchar(64) NOT NULL DEFAULT '',
  `foreign_db` varchar(64) NOT NULL DEFAULT '',
  `foreign_table` varchar(64) NOT NULL DEFAULT '',
  `foreign_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Table structure for table `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `search_name` varchar(64) NOT NULL DEFAULT '',
  `search_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `display_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `prefs` text NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

-- --------------------------------------------------------

--
-- Table structure for table `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text NOT NULL,
  `schema_sql` text DEFAULT NULL,
  `data_sql` longtext DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Dumping data for table `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2024-10-06 14:39:59', '{\"Console\\/Mode\":\"collapse\"}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) NOT NULL,
  `tab` varchar(64) NOT NULL,
  `allowed` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Table structure for table `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) NOT NULL,
  `usergroup` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indexes for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indexes for table `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indexes for table `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indexes for table `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indexes for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indexes for table `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indexes for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indexes for table `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indexes for table `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indexes for table `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indexes for table `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indexes for table `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indexes for table `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Database: `sunog`
--
CREATE DATABASE IF NOT EXISTS `sunog` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `sunog`;

-- --------------------------------------------------------

--
-- Table structure for table `events_list`
--

CREATE TABLE `events_list` (
  `id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_description` text NOT NULL,
  `event_date` date NOT NULL,
  `municipality` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `sitio` varchar(255) NOT NULL,
  `event_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events_list`
--

INSERT INTO `events_list` (`id`, `event_name`, `event_description`, `event_date`, `municipality`, `barangay`, `sitio`, `event_image`, `created_at`, `updated_at`) VALUES
(1, '', '', '0000-00-00', '', '', '', '', '2024-09-24 15:41:10', '2024-09-24 15:41:10'),
(2, '', '', '0000-00-00', '', '', '', '', '2024-09-24 15:44:36', '2024-09-24 15:44:36'),
(3, '', '', '0000-00-00', '', '', '', '', '2024-09-24 15:44:39', '2024-09-24 15:44:39'),
(4, '', '', '0000-00-00', '', '', '', '', '2024-09-25 00:00:46', '2024-09-25 00:00:46'),
(5, '', '', '0000-00-00', '', '', '', '', '2024-09-25 00:06:21', '2024-09-25 00:06:21');

-- --------------------------------------------------------

--
-- Table structure for table `history_list`
--

CREATE TABLE `history_list` (
  `id` int(30) NOT NULL,
  `request_id` int(30) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `remarks` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history_list`
--

INSERT INTO `history_list` (`id`, `request_id`, `status`, `remarks`, `date_created`) VALUES
(1, 1, 1, 'Request has been assign to a fire control team.', '2022-05-21 12:08:58'),
(2, 1, 2, 'The assigned fire control team is on its way.', '2022-05-21 13:51:02'),
(3, 1, 3, 'The Fire Control team is in on-progress of putting the fire down.', '2022-05-21 13:54:15'),
(4, 1, 4, 'Fire has been successfully controlled.', '2022-05-21 13:54:52'),
(5, 2, 1, 'Request has been assign to a fire control team.', '2022-05-21 14:48:55'),
(6, 7, 2, 'fasd', '2024-09-19 15:41:38'),
(7, 7, 1, 'Request has been assign to a fire control team.', '2024-09-19 15:41:44');

-- --------------------------------------------------------

--
-- Table structure for table `inquiry_list`
--

CREATE TABLE `inquiry_list` (
  `id` int(30) NOT NULL,
  `fullname` text NOT NULL,
  `email` text NOT NULL,
  `contact` text NOT NULL,
  `message` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `request_list`
--

CREATE TABLE `request_list` (
  `id` int(30) NOT NULL,
  `team_id` int(30) DEFAULT NULL,
  `code` varchar(100) NOT NULL,
  `fullname` text NOT NULL,
  `contact` text NOT NULL,
  `message` text NOT NULL,
  `location` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = Pending,\r\n1 = Assigned to Team,\r\n2 = Team on their Way\r\n3 = Relief on progress\r\n4 = Completed',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_report` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request_list`
--

INSERT INTO `request_list` (`id`, `team_id`, `code`, `fullname`, `contact`, `message`, `location`, `status`, `date_created`, `date_updated`, `deleted_report`) VALUES
(1, 2, '2022052100001', 'Ella Zane', '09456987455', 'A Residential Area is on Fire.', '2688 Goosetown Drive, Charlotte, North Carolina, 28202', 4, '2022-05-21 10:25:02', '2022-05-21 13:54:52', NULL),
(2, 1, '2022052100002', 'Dina Santos', '0978945631', 'Sample report only', '4250 Star Trek Drive, Tallahassee, Florida, 32303', 5, '2022-05-21 14:35:12', '2024-09-19 10:56:04', '{\"id\":\"2\",\"team_id\":\"1\",\"code\":\"2022052100002\",\"fullname\":\"Dina Santos\",\"contact\":\"0978945631\",\"message\":\"Sample report only\",\"location\":\"4250 Star Trek Drive, Tallahassee, Florida, 32303\",\"status\":\"1\",\"date_created\":\"2022-05-21 14:35:12\",\"date_updated\":\"'),
(4, NULL, '2022052100003', 'Martha V Whitten', '562-397-5583', 'Commercial Buiding is on fire.', '3621 Thompson Drive, San Leandro, California(CA), 94578', 5, '2022-05-21 14:51:56', '2024-09-17 07:54:42', '{\"id\":\"4\",\"team_id\":null,\"code\":\"2022052100003\",\"fullname\":\"Martha V Whitten\",\"contact\":\"562-397-5583\",\"message\":\"Commercial Buiding is on fire.\",\"location\":\"3621 Thompson Drive, San Leandro, California(CA), 94578\",\"status\":\"0\",\"date_created\":\"2022-05-21 '),
(5, NULL, '2024091700001', 'fadas', '09325247257', 'fdsafsa', 'fasfsa', 5, '2024-09-17 09:41:23', '2024-09-17 09:41:51', '{\"id\":\"5\",\"team_id\":null,\"code\":\"2024091700001\",\"fullname\":\"fadas\",\"contact\":\"09325247257\",\"message\":\"fdsafsa\",\"location\":\"fasfsa\",\"status\":\"0\",\"date_created\":\"2024-09-17 09:41:23\",\"date_updated\":\"2024-09-17 09:41:23\",\"deleted_report\":null}'),
(6, NULL, '2024091700002', 'Jericho C. Batuigas', '09325247257', 'fsadfsa', 'fsadfsa', 5, '2024-09-17 10:31:57', '2024-09-17 10:42:43', '{\"id\":\"6\",\"team_id\":null,\"code\":\"2024091700002\",\"fullname\":\"Jericho C. Batuigas\",\"contact\":\"09325247257\",\"message\":\"fsadfsa\",\"location\":\"fsadfsa\",\"status\":\"5\",\"date_created\":\"2024-09-17 10:31:57\",\"date_updated\":\"2024-09-17 10:42:22\",\"deleted_report\":\"{\"id'),
(7, 1, '2024091900001', 'jericho', '09325247257', 'fsad', 'fasdf', 1, '2024-09-19 15:41:18', '2024-09-19 15:41:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'Online Fire Reporting System'),
(6, 'short_name', 'OFRS - PHP'),
(11, 'logo', 'uploads/logo.png?v=1653095716'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/cover.png?v=1653095717'),
(17, 'phone', '456-987-1231'),
(18, 'mobile', '09123456987 / 094563212222 '),
(19, 'email', 'info@firedepartment.com'),
(20, 'address', '7087 Henry St. Clifton Park, NY 12065'),
(21, 'event_name', 'Fire Drill'),
(22, 'event_description', 'fadsfas'),
(23, 'event_date', '2024-09-19'),
(24, 'event_time', '06:29'),
(25, 'recurrence', 'monthly'),
(26, 'event_month', 'February');

-- --------------------------------------------------------

--
-- Table structure for table `team_list`
--

CREATE TABLE `team_list` (
  `id` int(30) NOT NULL,
  `code` varchar(100) NOT NULL,
  `leader_name` text NOT NULL,
  `leader_contact` text NOT NULL,
  `members` text NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team_list`
--

INSERT INTO `team_list` (`id`, `code`, `leader_name`, `leader_contact`, `members`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 'F-623', 'Mark D Cooper', '09456789123', 'John Smith, Mike Ross, Steven Miller, Anthony Wheeler', 0, '2022-05-21 09:31:00', '2022-05-21 09:33:50'),
(2, 'F-1014', 'Johnny Deep', '09654789123', 'Member 101, Member 102, Member 103, Member 104', 0, '2022-05-21 09:44:15', '2022-05-21 09:44:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `middlename` text DEFAULT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `reset_token` varchar(255) DEFAULT NULL,
  `token_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='2';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `username`, `email`, `password`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`, `reset_token`, `token_expiry`) VALUES
(1, 'Adminstrator', '', 'Admin', 'admin', 'henitsu@gmail.com', '0192023a7bbd73250516f069df18b500', 'uploads/avatars/1.png?v=1649834664', NULL, 1, '2021-01-20 14:02:37', '2024-09-30 09:06:40', NULL, NULL),
(6, 'Mark', 'D', 'Cooper', 'mcooper', '', 'c7162ff89c647f444fcaa5c635dac8c3', 'uploads/avatars/6.png?v=1653035960', NULL, 2, '2022-05-20 16:39:20', '2022-05-20 16:39:20', NULL, NULL),
(9, 'Jericho', 'Capus', 'Gwapo', 'Gwapolang', 'jerichobatuigas66@gmail.com', '5ebe2294ecd0e0f08eab7690d2a6ee69', NULL, NULL, 1, '2024-09-15 19:03:18', '2024-09-30 20:23:07', '$2y$10$MT.TkcCilCwawgBhZ84/0uE3nf0gCDSgNOM492iR6g6L1/ys9aoqi', '2024-09-30 15:23:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events_list`
--
ALTER TABLE `events_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_list`
--
ALTER TABLE `history_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `request_id` (`request_id`);

--
-- Indexes for table `inquiry_list`
--
ALTER TABLE `inquiry_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_list`
--
ALTER TABLE `request_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `team_id_fk_rl` (`team_id`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team_list`
--
ALTER TABLE `team_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events_list`
--
ALTER TABLE `events_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `history_list`
--
ALTER TABLE `history_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `inquiry_list`
--
ALTER TABLE `inquiry_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `request_list`
--
ALTER TABLE `request_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `team_list`
--
ALTER TABLE `team_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `history_list`
--
ALTER TABLE `history_list`
  ADD CONSTRAINT `request_id_fh_hl` FOREIGN KEY (`request_id`) REFERENCES `request_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `request_list`
--
ALTER TABLE `request_list`
  ADD CONSTRAINT `team_id_fk_rl` FOREIGN KEY (`team_id`) REFERENCES `team_list` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;
--
-- Database: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
