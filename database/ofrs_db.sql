-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 28, 2024 at 01:45 AM
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
-- Database: `fireclone`
--
CREATE DATABASE IF NOT EXISTS `fireclone` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `fireclone`;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact_no` varchar(15) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `facebook_page` varchar(255) DEFAULT NULL,
  `municipality_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_date` datetime NOT NULL,
  `municipality_id` int(11) NOT NULL,
  `barangay` varchar(100) NOT NULL,
  `sitio_street` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('upcoming','completed','canceled') DEFAULT 'upcoming',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fire_incident_reports`
--

CREATE TABLE `fire_incident_reports` (
  `report_id` int(11) NOT NULL,
  `reporter_first_name` varchar(50) NOT NULL,
  `reporter_middle_name` varchar(50) DEFAULT NULL,
  `reporter_last_name` varchar(50) NOT NULL,
  `municipality_id` int(11) DEFAULT NULL,
  `barangay` varchar(100) NOT NULL,
  `sitio_street` varchar(255) NOT NULL,
  `image_proof` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `contact_no` varchar(15) DEFAULT NULL,
  `report_code` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `incident_history`
--

CREATE TABLE `incident_history` (
  `id` int(11) NOT NULL,
  `incident_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `remarks` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `municipalities`
--

CREATE TABLE `municipalities` (
  `municipality_id` int(11) NOT NULL,
  `municipality_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `response_teams`
--

CREATE TABLE `response_teams` (
  `team_id` int(11) NOT NULL,
  `team_name` varchar(100) NOT NULL,
  `team_leader` varchar(100) NOT NULL,
  `contact_no` varchar(15) DEFAULT NULL,
  `team_members` int(11) NOT NULL,
  `specialization` enum('fire','flood','earthquake','medical','general') DEFAULT 'general',
  `availability_status` enum('available','deployed','unavailable') DEFAULT 'available',
  `municipality_id` int(11) DEFAULT NULL,
  `assigned_incident_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','district_admin') DEFAULT 'district_admin',
  `district` varchar(100) DEFAULT NULL,
  `municipality_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `municipality_id` (`municipality_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `municipality_id` (`municipality_id`);

--
-- Indexes for table `fire_incident_reports`
--
ALTER TABLE `fire_incident_reports`
  ADD PRIMARY KEY (`report_id`),
  ADD UNIQUE KEY `report_code` (`report_code`),
  ADD KEY `municipality_id` (`municipality_id`);

--
-- Indexes for table `incident_history`
--
ALTER TABLE `incident_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `incident_id` (`incident_id`),
  ADD KEY `team_id` (`team_id`);

--
-- Indexes for table `municipalities`
--
ALTER TABLE `municipalities`
  ADD PRIMARY KEY (`municipality_id`);

--
-- Indexes for table `response_teams`
--
ALTER TABLE `response_teams`
  ADD PRIMARY KEY (`team_id`),
  ADD KEY `municipality_id` (`municipality_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `municipality_id` (`municipality_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fire_incident_reports`
--
ALTER TABLE `fire_incident_reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incident_history`
--
ALTER TABLE `incident_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `municipalities`
--
ALTER TABLE `municipalities`
  MODIFY `municipality_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `response_teams`
--
ALTER TABLE `response_teams`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`municipality_id`) REFERENCES `municipalities` (`municipality_id`);

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`municipality_id`) REFERENCES `municipalities` (`municipality_id`);

--
-- Constraints for table `fire_incident_reports`
--
ALTER TABLE `fire_incident_reports`
  ADD CONSTRAINT `fire_incident_reports_ibfk_1` FOREIGN KEY (`municipality_id`) REFERENCES `municipalities` (`municipality_id`);

--
-- Constraints for table `incident_history`
--
ALTER TABLE `incident_history`
  ADD CONSTRAINT `incident_history_ibfk_1` FOREIGN KEY (`incident_id`) REFERENCES `fire_incident_reports` (`report_id`),
  ADD CONSTRAINT `incident_history_ibfk_2` FOREIGN KEY (`team_id`) REFERENCES `response_teams` (`team_id`);

--
-- Constraints for table `response_teams`
--
ALTER TABLE `response_teams`
  ADD CONSTRAINT `response_teams_ibfk_1` FOREIGN KEY (`municipality_id`) REFERENCES `municipalities` (`municipality_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`municipality_id`) REFERENCES `municipalities` (`municipality_id`);
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
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events_list`
--

INSERT INTO `events_list` (`id`, `event_name`, `event_description`, `event_date`, `municipality`, `barangay`, `sitio`, `event_image`, `created_at`, `updated_at`, `delete_flag`) VALUES
(52, 'Earthquake Drill', 'dgadasdfas', '2024-10-31', 'Santa Fe', 'Talisay', 'Hilotongan national highschool', '../uploads/1728012246_04dea8632a9bc02fff16d40f39a79f88.jpg', '2024-10-04 03:24:06', '2024-10-04 03:24:06', 0),
(68, 'Flood Drill', 'nagbaha na akun kabogo tabang', '2024-11-03', 'Bantayan', 'Botigues', 'Mancilang Elem School', '1728178257_𝘩𝘪𝘴𝘶𝘪 𝘩𝘦𝘢𝘥𝘦𝘳𝘴 • 𝘬𝘪𝘮𝘦𝘵𝘴𝘶 𝘯𝘰 𝘺𝘢𝘪𝘣𝘢_ 𝘺𝘶𝘶𝘬𝘢𝘬𝘶-𝘩𝘦𝘯.jpg', '2024-10-06 01:30:57', '2024-10-06 01:30:57', 0),
(71, 'Tornado Drill', 'Tornado drills are a crucial part of emergency preparedness, ensuring that individuals know how to respond effectively during a tornado threat. Regular practice helps to instill confidence and readiness, potentially saving lives in the event of a real tornado.', '2024-11-09', 'Bantayan', 'Doong', 'Doong Elem School', '1728189826_𝐓𝐚𝐧𝐣𝐢𝐫𝐨 • 𝐊𝐢𝐦𝐞𝐭𝐬𝐮 𝐧𝐨 𝐘𝐚𝐢𝐛𝐚.jpg', '2024-10-06 04:43:46', '2024-10-06 04:43:46', 0),
(72, 'Evacuation Drill', 'on sunday we have a evacuation drill to do at san agustin national highschool', '2024-11-08', 'Santa Fe', 'Kinatarkan', 'Doong Elem School', '1728194565_your name movie.jpg', '2024-10-06 06:02:45', '2024-10-06 06:02:45', 0),
(73, 'Earthquake Drill', 'may earth quake drill nga pagahimoon sa bantayan national high school bwas', '2024-11-05', 'Bantayan', 'Ticad', 'BNHS', '1728213802_DALL·E 2024-09-20 08.16.39 - A scene illustrating disaster response activities during floods, earthquakes, and typhoons. Firefighters and emergency response teams are seen rescuin.webp', '2024-10-06 11:23:22', '2024-10-06 11:23:22', 0),
(74, 'Tornado Drill', 'to akefnalenal k', '2024-10-28', 'Bantayan', 'Kabangbang', 'Quari', '1730072608_wallpaperflare.com_wallpaper.jpg', '2024-10-27 23:43:28', '2024-10-27 23:43:28', 0);

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
(118, 78, 1, 'Request has been assign to a fire control team.', '2024-10-04 20:39:06'),
(119, 89, 1, 'Request has been assign to a fire control team.', '2024-10-15 19:46:53');

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
-- Table structure for table `municipalities`
--

CREATE TABLE `municipalities` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `municipalities`
--

INSERT INTO `municipalities` (`id`, `name`, `logo`) VALUES
(1, 'Bantayan', ''),
(2, 'Santa Fe', ''),
(3, 'Madridejos', '');

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
  `deleted_reports` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request_list`
--

INSERT INTO `request_list` (`id`, `team_id`, `code`, `lastname`, `firstname`, `middlename`, `contact`, `subject`, `message`, `image`, `municipality`, `barangay`, `sitio_street`, `status`, `date_created`, `date_updated`, `deleted_reports`) VALUES
(73, NULL, '20240913-0001', 'Oflas', 'Mary', 'Ann', '09325247257', 'Flood', 'hello lord', '../uploads/ec380e786054aa3cdd247f583471fe85.jpg', 'Madridejos', 'Pili', 'Purok lubi 2, cahutay srt.', 5, '2024-09-13 16:58:40', '2024-10-07 11:26:04', '{\"id\":\"73\",\"team_id\":null,\"code\":\"20240913-0001\",\"lastname\":\"Oflas\",\"firstname\":\"Mary\",\"middlename\":\"Ann\",\"contact\":\"09325247257\",\"subject\":\"Flood\",\"message\":\"hello lord\",\"image\":\"..\\/uploads\\/ec380e786054aa3cdd247f583471fe85.jpg\",\"municipality\":\"Madridejos\",\"barangay\":\"Pili\",\"sitio_street\":\"Purok lubi 2, cahutay srt.\",\"status\":\"5\",\"date_created\":\"2024-09-13 16:58:40\",\"date_updated\":\"2024-10-07 11:22:33\",\"deleted_reports\":\"{\\\\\\\"id\\\\\\\":73,\\\\\\\"team_id\\\\\\\":null,\\\\\\\"code\\\\\\\":\\\\\\\"20240913-0001\\\\\\\",\\\\\\\"lastname\\\\\\\":\\\\\\\"Oflas\\\\\\\",\\\\\\\"firstname\\\\\\\":\\\\\\\"Mary\\\\\\\",\\\\\\\"middlename\\\\\\\":\\\\\\\"Ann\\\\\\\",\\\\\\\"contact\\\\\\\":\\\\\\\"09325247257\\\\\\\",\\\\\\\"subject\\\\\\\":\\\\\\\"Flood\\\\\\\",\\\\\\\"message\\\\\\\":\\\\\\\"hello lord\\\\\\\",\\\\\\\"image\\\\\\\":\\\\\\\"..\\\\\\\\\\/uploads\\\\\\\\\\/ec380e786054aa3cdd247f583471fe85.jpg\\\\\\\",\\\\\\\"municipality\\\\\\\":\\\\\\\"Madridejos\\\\\\\",\\\\\\\"barangay\\\\\\\":\\\\\\\"Pili\\\\\\\",\\\\\\\"sitio_street\\\\\\\":\\\\\\\"Purok lubi 2, cahutay srt.\\\\\\\",\\\\\\\"status\\\\\\\":5,\\\\\\\"date_created\\\\\\\":\\\\\\\"2024-09-13 16:58:40\\\\\\\",\\\\\\\"date_updated\\\\\\\":\\\\\\\"2024-09-19 11:08:04\\\\\\\",\\\\\\\"deleted_reports\\\\\\\":\\\\\\\"{\\\\\\\\\\\\\\\"id\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\"73\\\\\\\\\\\\\\\",\\\\\\\\\\\\\\\"team_id\\\\\\\\\\\\\\\":null,\\\\\\\\\\\\\\\"code\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\"20240913-0001\\\\\\\\\\\\\\\",\\\\\\\\\\\\\\\"lastname\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\"Oflas\\\\\\\\\\\\\\\",\\\\\\\\\\\\\\\"firstname\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\"Mary\\\\\\\\\\\\\\\",\\\\\\\\\\\\\\\"middlename\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\"Ann\\\\\\\\\\\\\\\",\\\\\\\\\\\\\\\"contact\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\"09325247257\\\\\\\\\\\\\\\",\\\\\\\\\\\\\\\"subject\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\"Flood\\\\\\\\\\\\\\\",\\\\\\\\\\\\\\\"message\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\"hello lord\\\\\\\\\\\\\\\",\\\\\\\\\\\\\\\"image\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\"..\\\\\\\\\\\\\\\\\\\\\\\\\\/uploads\\\\\\\\\\\\\\\\\\\\\\\\\\/ec380e786054aa3cdd247f583471fe85.jpg\\\\\\\\\\\\\\\",\\\\\\\\\\\\\\\"municipality\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\"Madridej\\\\\\\"}\"}'),
(75, NULL, '20240917-0001', 'Durant', 'Kevin', 'James', '09325247257', 'Flood', 'jafhsakdfjksa', '../uploads/4b4cd4a350ebe4090bcf4fdf9bcc40f3.jpeg', 'Bantayan', 'Tamiao', 'Purok Mangga 2', 5, '2024-09-17 10:28:12', '2024-10-07 11:26:01', '{\"id\":\"75\",\"team_id\":null,\"code\":\"20240917-0001\",\"lastname\":\"Durant\",\"firstname\":\"Kevin\",\"middlename\":\"James\",\"contact\":\"09325247257\",\"subject\":\"Flood\",\"message\":\"jafhsakdfjksa\",\"image\":\"..\\/uploads\\/4b4cd4a350ebe4090bcf4fdf9bcc40f3.jpeg\",\"municipality\":\"Bantayan\",\"barangay\":\"Tamiao\",\"sitio_street\":\"Purok Mangga 2\",\"status\":\"5\",\"date_created\":\"2024-09-17 10:28:12\",\"date_updated\":\"2024-09-19 11:08:23\",\"deleted_reports\":\"{\\\"id\\\":\\\"75\\\",\\\"team_id\\\":null,\\\"code\\\":\\\"20240917-0001\\\",\\\"lastname\\\":\\\"Durant\\\",\\\"firstname\\\":\\\"Kevin\\\",\\\"middlename\\\":\\\"James\\\",\\\"contact\\\":\\\"09325247257\\\",\\\"subject\\\":\\\"Flood\\\",\\\"message\\\":\\\"jafhsakdfjksa\\\",\\\"image\\\":\\\"..\\\\\\/uploads\\\\\\/4b4cd4a350ebe4090bcf4fdf9bcc40f3.jpeg\\\",\\\"municipality\\\":\\\"\"}'),
(76, NULL, '20240918-0001', 'Lebron', 'James', 'Bron', '09325247257', 'Sunog', 'my house is on fire', '../uploads/c16cbd9d41079ad647a0efbacefcc1f0.jpg', 'Santa Fe', 'Okoy', 'Purok Bakhawan', 5, '2024-09-18 18:02:26', '2024-10-07 11:25:58', '{\"id\":\"76\",\"team_id\":null,\"code\":\"20240918-0001\",\"lastname\":\"Lebron\",\"firstname\":\"James\",\"middlename\":\"Bron\",\"contact\":\"09325247257\",\"subject\":\"Sunog\",\"message\":\"my house is on fire\",\"image\":\"..\\/uploads\\/c16cbd9d41079ad647a0efbacefcc1f0.jpg\",\"municipality\":\"Santa Fe\",\"barangay\":\"Okoy\",\"sitio_street\":\"Purok Bakhawan\",\"status\":\"5\",\"date_created\":\"2024-09-18 18:02:26\",\"date_updated\":\"2024-09-19 11:41:49\",\"deleted_reports\":\"{\\\"id\\\":\\\"76\\\",\\\"team_id\\\":null,\\\"code\\\":\\\"20240918-0001\\\",\\\"lastname\\\":\\\"Lebron\\\",\\\"firstname\\\":\\\"James\\\",\\\"middlename\\\":\\\"Bron\\\",\\\"contact\\\":\\\"09325247257\\\",\\\"subject\\\":\\\"Sunog\\\",\\\"message\\\":\\\"my house is on fire\\\",\\\"image\\\":\\\"..\\\\\\/uploads\\\\\\/c16cbd9d41079ad647a0efbacefcc1f0.jpg\\\",\\\"municipalit\"}'),
(77, 2, '20240919-0001', 'Steph', 'Curry', 'Karlitos', '09283239293', 'Flood', 'oracle has on fire', '../uploads/add6466412d7ab2196c8b3f2b92b1f9e.jpg', 'Santa Fe', 'Maricaban', 'Purok Danggit', 5, '2024-09-19 15:43:46', '2024-10-07 11:25:55', '{\"id\":\"77\",\"team_id\":\"2\",\"code\":\"20240919-0001\",\"lastname\":\"Steph\",\"firstname\":\"Curry\",\"middlename\":\"Karlitos\",\"contact\":\"09283239293\",\"subject\":\"Flood\",\"message\":\"oracle has on fire\",\"image\":\"..\\/uploads\\/add6466412d7ab2196c8b3f2b92b1f9e.jpg\",\"municipality\":\"Santa Fe\",\"barangay\":\"Maricaban\",\"sitio_street\":\"Purok Danggit\",\"status\":\"5\",\"date_created\":\"2024-09-19 15:43:46\",\"date_updated\":\"2024-10-04 20:46:17\",\"deleted_reports\":\"{\\\"id\\\":\\\"77\\\",\\\"team_id\\\":\\\"2\\\",\\\"code\\\":\\\"20240919-0001\\\",\\\"lastname\\\":\\\"Steph\\\",\\\"firstname\\\":\\\"Curry\\\",\\\"middlename\\\":\\\"Karlitos\\\",\\\"contact\\\":\\\"09283239293\\\",\\\"subject\\\":\\\"Flood\\\",\\\"message\\\":\\\"oracle has on fire\\\",\\\"image\\\":\\\"..\\\\\\/uploads\\\\\\/add6466412d7ab2196c8b3f2b92b1f9e.jpg\\\",\\\"municipali\"}'),
(78, 7, '20241004-0001', 'Kurosaki', 'Ichigo', 'Kun', '09122777291', 'Fire', 'Wild fires in the middle of ocaeans', '../uploads/ca4e7d5a06944ab502dbf829d3167478.jpg', 'Bantayan', 'Lipayran', 'Purok Danggit', 5, '2024-10-04 20:38:41', '2024-10-07 11:25:52', '{\"id\":\"78\",\"team_id\":\"7\",\"code\":\"20241004-0001\",\"lastname\":\"Kurosaki\",\"firstname\":\"Ichigo\",\"middlename\":\"Kun\",\"contact\":\"09122777291\",\"subject\":\"Fire\",\"message\":\"Wild fires in the middle of ocaeans\",\"image\":\"..\\/uploads\\/ca4e7d5a06944ab502dbf829d3167478.jpg\",\"municipality\":\"Bantayan\",\"barangay\":\"Lipayran\",\"sitio_street\":\"Purok Danggit\",\"status\":\"5\",\"date_created\":\"2024-10-04 20:38:41\",\"date_updated\":\"2024-10-07 11:22:22\",\"deleted_reports\":\"{\\\\\\\"id\\\\\\\":78,\\\\\\\"team_id\\\\\\\":7,\\\\\\\"code\\\\\\\":\\\\\\\"20241004-0001\\\\\\\",\\\\\\\"lastname\\\\\\\":\\\\\\\"Kurosaki\\\\\\\",\\\\\\\"firstname\\\\\\\":\\\\\\\"Ichigo\\\\\\\",\\\\\\\"middlename\\\\\\\":\\\\\\\"Kun\\\\\\\",\\\\\\\"contact\\\\\\\":\\\\\\\"09122777291\\\\\\\",\\\\\\\"subject\\\\\\\":\\\\\\\"Fire\\\\\\\",\\\\\\\"message\\\\\\\":\\\\\\\"Wild fires in the middle of ocaeans\\\\\\\",\\\\\\\"image\\\\\\\":\\\\\\\"..\\\\\\\\\\/uploads\\\\\\\\\\/ca4e7d5a06944ab502dbf829d3167478.jpg\\\\\\\",\\\\\\\"municipality\\\\\\\":\\\\\\\"Bantayan\\\\\\\",\\\\\\\"barangay\\\\\\\":\\\\\\\"Lipayran\\\\\\\",\\\\\\\"sitio_street\\\\\\\":\\\\\\\"Purok Danggit\\\\\\\",\\\\\\\"status\\\\\\\":5,\\\\\\\"date_created\\\\\\\":\\\\\\\"2024-10-04 20:38:41\\\\\\\",\\\\\\\"date_updated\\\\\\\":\\\\\\\"2024-10-04 20:46:12\\\\\\\",\\\\\\\"deleted_reports\\\\\\\":\\\\\\\"{\\\\\\\\\\\\\\\"id\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\"78\\\\\\\\\\\\\\\",\\\\\\\\\\\\\\\"team_id\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\"7\\\\\\\\\\\\\\\",\\\\\\\\\\\\\\\"code\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\"20241004-0001\\\\\\\\\\\\\\\",\\\\\\\\\\\\\\\"lastname\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\"Kurosaki\\\\\\\\\\\\\\\",\\\\\\\\\\\\\\\"firstname\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\"Ichigo\\\\\\\\\\\\\\\",\\\\\\\\\\\\\\\"middlename\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\"Kun\\\\\\\\\\\\\\\",\\\\\\\\\\\\\\\"contact\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\"09122777291\\\\\\\\\\\\\\\",\\\\\\\\\\\\\\\"subject\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\"Fire\\\\\\\\\\\\\\\",\\\\\\\\\\\\\\\"message\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\"Wild fires in the middle of ocaeans\\\\\\\\\\\\\\\",\\\\\\\\\\\\\\\"image\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\"..\\\\\\\\\\\\\\\\\\\\\\\\\\/uploads\\\\\\\\\\\\\\\\\\\\\\\\\\/ca4e7d5a06944ab502dbf829d3167478.j\\\\\\\"}\"}'),
(79, NULL, '20241004-0002', 'Ichiro ', 'Yuda', 'Yuji', '09343243243', 'Rescue', 'fasdfsaf', '../uploads/ddb929ab25befd718d1cd929b55dfe65.jpg', 'Santa Fe', 'Okoy', 'Purok Gusaw', 5, '2024-10-04 20:44:10', '2024-10-07 11:25:49', '{\"id\":\"79\",\"team_id\":null,\"code\":\"20241004-0002\",\"lastname\":\"Ichiro \",\"firstname\":\"Yuda\",\"middlename\":\"Yuji\",\"contact\":\"09343243243\",\"subject\":\"Rescue\",\"message\":\"fasdfsaf\",\"image\":\"..\\/uploads\\/ddb929ab25befd718d1cd929b55dfe65.jpg\",\"municipality\":\"Santa Fe\",\"barangay\":\"Okoy\",\"sitio_street\":\"Purok Gusaw\",\"status\":\"5\",\"date_created\":\"2024-10-04 20:44:10\",\"date_updated\":\"2024-10-04 20:46:02\",\"deleted_reports\":\"{\\\"id\\\":\\\"79\\\",\\\"team_id\\\":null,\\\"code\\\":\\\"20241004-0002\\\",\\\"lastname\\\":\\\"Ichiro \\\",\\\"firstname\\\":\\\"Yuda\\\",\\\"middlename\\\":\\\"Yuji\\\",\\\"contact\\\":\\\"09343243243\\\",\\\"subject\\\":\\\"Rescue\\\",\\\"message\\\":\\\"fasdfsaf\\\",\\\"image\\\":\\\"..\\\\\\/uploads\\\\\\/ddb929ab25befd718d1cd929b55dfe65.jpg\\\",\\\"municipality\\\":\\\"Santa \"}'),
(80, NULL, '20241004-0003', 'Kurosaki', 'Yuda', 'Kun', '09122777291', 'Rescue', 'hoo kabogo', '../uploads/bdf5aab32c6d73b67cddc116dc88604f.jpeg', 'Bantayan', 'Lipayran', 'Purok Guso', 5, '2024-10-04 20:51:53', '2024-10-07 11:25:46', '{\"id\":\"80\",\"team_id\":null,\"code\":\"20241004-0003\",\"lastname\":\"Kurosaki\",\"firstname\":\"Yuda\",\"middlename\":\"Kun\",\"contact\":\"09122777291\",\"subject\":\"Rescue\",\"message\":\"hoo kabogo\",\"image\":\"..\\/uploads\\/bdf5aab32c6d73b67cddc116dc88604f.jpeg\",\"municipality\":\"Bantayan\",\"barangay\":\"Lipayran\",\"sitio_street\":\"Purok Guso\",\"status\":\"5\",\"date_created\":\"2024-10-04 20:51:53\",\"date_updated\":\"2024-10-04 20:54:14\",\"deleted_reports\":\"{\\\"id\\\":\\\"80\\\",\\\"team_id\\\":null,\\\"code\\\":\\\"20241004-0003\\\",\\\"lastname\\\":\\\"Kurosaki\\\",\\\"firstname\\\":\\\"Yuda\\\",\\\"middlename\\\":\\\"Kun\\\",\\\"contact\\\":\\\"09122777291\\\",\\\"subject\\\":\\\"Rescue\\\",\\\"message\\\":\\\"hoo kabogo\\\",\\\"image\\\":\\\"..\\\\\\/uploads\\\\\\/bdf5aab32c6d73b67cddc116dc88604f.jpeg\\\",\\\"municipality\\\":\\\"Ban\"}'),
(81, NULL, '20241007-0001', 'Amegos', 'Coffee', 'Mix', '09343892757', 'Flood', 'unta maayo kana nga archive ka', '../uploads/6879e465942d5883d37edf3cfdf68172.jpg', 'Santa Fe', 'Langub', 'Purok Bakhaw, Mariano Street', 5, '2024-10-07 10:10:45', '2024-10-07 11:25:42', '{\"id\":\"81\",\"team_id\":null,\"code\":\"20241007-0001\",\"lastname\":\"Amegos\",\"firstname\":\"Coffee\",\"middlename\":\"Mix\",\"contact\":\"09343892757\",\"subject\":\"Flood\",\"message\":\"unta maayo kana nga archive ka\",\"image\":\"..\\/uploads\\/6879e465942d5883d37edf3cfdf68172.jpg\",\"municipality\":\"Santa Fe\",\"barangay\":\"Langub\",\"sitio_street\":\"Purok Bakhaw, Mariano Street\",\"status\":\"5\",\"date_created\":\"2024-10-07 10:10:45\",\"date_updated\":\"2024-10-07 11:25:26\",\"deleted_reports\":\"{\\\"id\\\":\\\"81\\\",\\\"team_id\\\":null,\\\"code\\\":\\\"20241007-0001\\\",\\\"lastname\\\":\\\"Amegos\\\",\\\"firstname\\\":\\\"Coffee\\\",\\\"middlename\\\":\\\"Mix\\\",\\\"contact\\\":\\\"09343892757\\\",\\\"subject\\\":\\\"Flood\\\",\\\"message\\\":\\\"unta maayo kana nga archive ka\\\",\\\"image\\\":\\\"..\\\\\\/uploads\\\\\\/6879e465942d5883d37edf3cfdf68172.jpg\\\",\\\"municipality\\\":\\\"Santa Fe\\\",\\\"barangay\\\":\\\"Langub\\\",\\\"sitio_street\\\":\\\"Purok Bakhaw, Mariano Street\\\",\\\"status\\\":\\\"5\\\",\\\"date_created\\\":\\\"2024-10-07 10:10:45\\\",\\\"date_updated\\\":\\\"2024-10-07 11:22:27\\\",\\\"deleted_reports\\\":\\\"{\\\\\\\\\\\\\\\"id\\\\\\\\\\\\\\\":81,\\\\\\\\\\\\\\\"team_id\\\\\\\\\\\\\\\":null,\\\\\\\\\\\\\\\"code\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\"20241007-0001\\\\\\\\\\\\\\\",\\\\\\\\\\\\\\\"lastname\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\"Amegos\\\\\\\\\\\\\\\",\\\\\\\\\\\\\\\"firstname\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\"Coffee\\\\\\\\\\\\\\\",\\\\\\\\\\\\\\\"middlename\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\"Mix\\\\\\\\\\\\\\\",\\\\\\\\\\\\\\\"contact\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\"09343892757\\\\\\\\\\\\\\\",\\\\\\\\\\\\\\\"subject\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\"Flood\\\\\\\\\\\\\\\",\\\\\\\\\\\\\\\"message\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\"unta maayo kana nga archive ka\\\\\\\\\\\\\\\",\\\\\\\\\\\\\\\"image\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\"..\\\\\\\\\\\\\\\\\\\\\\/uploads\\\\\\\\\\\\\\\\\\\\\\/6879e465942d5883d37edf3cfdf68172.jpg\\\\\\\\\\\\\\\",\\\\\\\\\\\\\\\"municipality\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\"Santa Fe\\\\\\\\\\\\\\\",\\\\\\\\\\\\\\\"barangay\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\"Langub\\\\\\\\\\\\\\\",\\\\\\\\\\\\\\\"sitio_street\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\"Purok Bakhaw, Mariano Street\\\\\\\\\\\\\\\",\\\\\\\\\\\\\\\"status\\\\\\\\\\\\\\\":5,\\\\\\\\\\\\\\\"date_created\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\"2024-10-07 10:10:45\\\\\\\\\\\\\\\",\\\\\\\\\\\\\\\"date_updated\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\"2024-10-07 10:39:43\\\\\\\\\\\\\\\",\\\\\\\\\\\\\\\"deleted_reports\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\"{\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"id\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"81\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\",\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"team_id\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\":null,\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"code\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"20241007-0001\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\",\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"lastname\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"Amegos\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\",\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"firstname\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"Coffee\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\",\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"middlename\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"Mix\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\",\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"contact\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"09343892757\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\",\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"subject\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"Flood\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\",\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"message\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"unta maayo kana nga archive ka\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\",\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"image\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"..\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\/uploads\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\/6879e465942d5883d37edf3cfdf68172.jpg\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\",\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"municipality\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"Santa Fe\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\",\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"barangay\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"Langub\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\",\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"sitio_street\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"Purok Bakhaw, Mariano Street\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\",\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"status\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"0\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\",\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"date_created\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"2024-10-07 10:10:45\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\",\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"date_updated\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\":\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"2024-10-07 10:10:45\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\",\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"deleted_reports\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\":null}\\\\\\\\\\\\\\\"}\\\"}\"}'),
(82, NULL, '20241007-0002', 'Kapi', 'Bara', 'Bucks', '09343892757', 'Sunog', 'maysunog tabang ', '../uploads/350ed3e273da35211ea157e9221dbcd0.jpg', 'Santa Fe', 'Okoy', 'Purok Bakhaw, Mariano Street', 5, '2024-10-07 11:32:11', '2024-10-07 11:32:45', '{\"id\":\"82\",\"team_id\":null,\"code\":\"20241007-0002\",\"lastname\":\"Kapi\",\"firstname\":\"Bara\",\"middlename\":\"Bucks\",\"contact\":\"09343892757\",\"subject\":\"Sunog\",\"message\":\"maysunog tabang \",\"image\":\"..\\/uploads\\/350ed3e273da35211ea157e9221dbcd0.jpg\",\"municipality\":\"Santa Fe\",\"barangay\":\"Okoy\",\"sitio_street\":\"Purok Bakhaw, Mariano Street\",\"status\":\"0\",\"date_created\":\"2024-10-07 11:32:11\",\"date_updated\":\"2024-10-07 11:32:11\",\"deleted_reports\":null}'),
(83, NULL, '20241007-0003', 'Bai', 'Nano', 'Layaog', '09489712811', 'Linog', 'adkfieqlfakj fkjadfowejf  adskfalvnclmx', '../uploads/b5848853808a382c94d4a8aa81ffd280.jpg', 'Madridejos', 'Talangnan', 'Purok litob, Mariano Street', 5, '2024-10-07 11:36:34', '2024-10-07 11:47:08', '{\"id\":\"83\",\"team_id\":null,\"code\":\"20241007-0003\",\"lastname\":\"Bai\",\"firstname\":\"Nano\",\"middlename\":\"Layaog\",\"contact\":\"09489712811\",\"subject\":\"Linog\",\"message\":\"adkfieqlfakj fkjadfowejf  adskfalvnclmx\",\"image\":\"..\\/uploads\\/b5848853808a382c94d4a8aa81ffd280.jpg\",\"municipality\":\"Madridejos\",\"barangay\":\"Talangnan\",\"sitio_street\":\"Purok litob, Mariano Street\",\"status\":\"0\",\"date_created\":\"2024-10-07 11:36:34\",\"date_updated\":\"2024-10-07 11:36:34\",\"deleted_reports\":null}'),
(84, NULL, '20241007-0004', 'Bai', 'Tinoy', 'Pikar', '09489712811', 'Tsunami', 'hahahhaaaaaaaaaaaaaaaaaaaaaaaa', '../uploads/6f545635d93d65de3792377f97ca85fa.jpeg', 'Bantayan', 'Doong', 'Purok pyanas, Mariano Street', 5, '2024-10-07 11:50:14', '2024-10-07 11:50:32', '{\"id\":\"84\",\"team_id\":null,\"code\":\"20241007-0004\",\"lastname\":\"Bai\",\"firstname\":\"Tinoy\",\"middlename\":\"Pikar\",\"contact\":\"09489712811\",\"subject\":\"Tsunami\",\"message\":\"hahahhaaaaaaaaaaaaaaaaaaaaaaaa\",\"image\":\"..\\/uploads\\/6f545635d93d65de3792377f97ca85fa.jpeg\",\"municipality\":\"Bantayan\",\"barangay\":\"Doong\",\"sitio_street\":\"Purok pyanas, Mariano Street\",\"status\":\"0\",\"date_created\":\"2024-10-07 11:50:14\",\"date_updated\":\"2024-10-07 11:50:14\",\"deleted_reports\":null}'),
(85, NULL, '20241007-0005', 'Pisti', 'Kalibog ', 'Naha', '09489712811', 'Tsunami', 'fadfsafadf', '../uploads/ba318f59ee5c64d675d7ed7e5186872f.jpg', 'Santa Fe', 'Kinatarkan', 'Purok litob, Mariano Street', 5, '2024-10-07 19:53:46', '2024-10-08 10:21:12', '{\"id\":\"85\",\"team_id\":null,\"code\":\"20241007-0005\",\"lastname\":\"Pisti\",\"firstname\":\"Kalibog \",\"middlename\":\"Naha\",\"contact\":\"09489712811\",\"subject\":\"Tsunami\",\"message\":\"fadfsafadf\",\"image\":\"..\\/uploads\\/ba318f59ee5c64d675d7ed7e5186872f.jpg\",\"municipality\":\"Santa Fe\",\"barangay\":\"Kinatarkan\",\"sitio_street\":\"Purok litob, Mariano Street\",\"status\":\"5\",\"date_created\":\"2024-10-07 19:53:46\",\"date_updated\":\"2024-10-07 19:53:57\",\"deleted_reports\":\"{\\\"id\\\":\\\"85\\\",\\\"team_id\\\":null,\\\"code\\\":\\\"20241007-0005\\\",\\\"lastname\\\":\\\"Pisti\\\",\\\"firstname\\\":\\\"Kalibog \\\",\\\"middlename\\\":\\\"Naha\\\",\\\"contact\\\":\\\"09489712811\\\",\\\"subject\\\":\\\"Tsunami\\\",\\\"message\\\":\\\"fadfsafadf\\\",\\\"image\\\":\\\"..\\\\\\/uploads\\\\\\/ba318f59ee5c64d675d7ed7e5186872f.jpg\\\",\\\"municipality\\\":\\\"Santa Fe\\\",\\\"barangay\\\":\\\"Kinatarkan\\\",\\\"sitio_street\\\":\\\"Purok litob, Mariano Street\\\",\\\"status\\\":\\\"0\\\",\\\"date_created\\\":\\\"2024-10-07 19:53:46\\\",\\\"date_updated\\\":\\\"2024-10-07 19:53:46\\\",\\\"deleted_reports\\\":null}\",\"is_restored\":\"0\"}'),
(86, NULL, '20241008-0001', 'Pisti', 'Tinoy', 'Layaog', '09489712811', 'Tsunami', 'fasfdas', '../uploads/00e573754512482037a355af41427fbf.jpg', 'Bantayan', 'Atop-Atop', 'Sitio tinago, Mariano Street', 5, '2024-10-08 10:09:41', '2024-10-08 10:23:11', '{\"id\":\"86\",\"team_id\":null,\"code\":\"20241008-0001\",\"lastname\":\"Pisti\",\"firstname\":\"Tinoy\",\"middlename\":\"Layaog\",\"contact\":\"09489712811\",\"subject\":\"Tsunami\",\"message\":\"fasfdas\",\"image\":\"..\\/uploads\\/00e573754512482037a355af41427fbf.jpg\",\"municipality\":\"Bantayan\",\"barangay\":\"Atop-Atop\",\"sitio_street\":\"Sitio tinago, Mariano Street\",\"status\":\"5\",\"date_created\":\"2024-10-08 10:09:41\",\"date_updated\":\"2024-10-08 10:21:03\",\"deleted_reports\":\"{\\\"id\\\":\\\"86\\\",\\\"team_id\\\":null,\\\"code\\\":\\\"20241008-0001\\\",\\\"lastname\\\":\\\"Pisti\\\",\\\"firstname\\\":\\\"Tinoy\\\",\\\"middlename\\\":\\\"Layaog\\\",\\\"contact\\\":\\\"09489712811\\\",\\\"subject\\\":\\\"Tsunami\\\",\\\"message\\\":\\\"fasfdas\\\",\\\"image\\\":\\\"..\\\\\\/uploads\\\\\\/00e573754512482037a355af41427fbf.jpg\\\",\\\"municipality\\\":\\\"Bantayan\\\",\\\"barangay\\\":\\\"Atop-Atop\\\",\\\"sitio_street\\\":\\\"Sitio tinago, Mariano Street\\\",\\\"status\\\":\\\"5\\\",\\\"date_created\\\":\\\"2024-10-08 10:09:41\\\",\\\"date_updated\\\":\\\"2024-10-08 10:09:54\\\",\\\"deleted_reports\\\":\\\"{\\\\\\\"id\\\\\\\":\\\\\\\"86\\\\\\\",\\\\\\\"team_id\\\\\\\":null,\\\\\\\"code\\\\\\\":\\\\\\\"20241008-0001\\\\\\\",\\\\\\\"lastname\\\\\\\":\\\\\\\"Pisti\\\\\\\",\\\\\\\"firstname\\\\\\\":\\\\\\\"Tinoy\\\\\\\",\\\\\\\"middlename\\\\\\\":\\\\\\\"Layaog\\\\\\\",\\\\\\\"contact\\\\\\\":\\\\\\\"09489712811\\\\\\\",\\\\\\\"subject\\\\\\\":\\\\\\\"Tsunami\\\\\\\",\\\\\\\"message\\\\\\\":\\\\\\\"fasfdas\\\\\\\",\\\\\\\"image\\\\\\\":\\\\\\\"..\\\\\\\\\\\\\\/uploads\\\\\\\\\\\\\\/00e573754512482037a355af41427fbf.jpg\\\\\\\",\\\\\\\"municipality\\\\\\\":\\\\\\\"Bantayan\\\\\\\",\\\\\\\"barangay\\\\\\\":\\\\\\\"Atop-Atop\\\\\\\",\\\\\\\"sitio_street\\\\\\\":\\\\\\\"Sitio tinago, Mariano Street\\\\\\\",\\\\\\\"status\\\\\\\":\\\\\\\"0\\\\\\\",\\\\\\\"date_created\\\\\\\":\\\\\\\"2024-10-08 10:09:41\\\\\\\",\\\\\\\"date_updated\\\\\\\":\\\\\\\"2024-10-08 10:09:41\\\\\\\",\\\\\\\"deleted_reports\\\\\\\":null,\\\\\\\"is_restored\\\\\\\":\\\\\\\"0\\\\\\\"}\\\",\\\"is_restored\\\":\\\"0\\\"}\",\"is_restored\":\"0\"}'),
(87, NULL, '20241008-0002', 'Bitoon', 'Sa', 'Langit', '09489712811', 'Baha', 'Baha Sa Kadagatan', '../uploads/57d09c5e697fc04226f36c818e395e7e.jpg', 'Bantayan', 'Kangkaibe', 'Purok Bakhaw Mariano Street', 5, '2024-10-08 21:37:28', '2024-10-08 21:48:41', '{\"id\":\"87\",\"team_id\":null,\"code\":\"20241008-0002\",\"lastname\":\"Bitoon\",\"firstname\":\"Sa\",\"middlename\":\"Langit\",\"contact\":\"09489712811\",\"subject\":\"Baha\",\"message\":\"Baha Sa Kadagatan\",\"image\":\"..\\/uploads\\/57d09c5e697fc04226f36c818e395e7e.jpg\",\"municipality\":\"Bantayan\",\"barangay\":\"Kangkaibe\",\"sitio_street\":\"Purok Bakhaw Mariano Street\",\"status\":\"0\",\"date_created\":\"2024-10-08 21:37:28\",\"date_updated\":\"2024-10-08 21:37:28\",\"deleted_reports\":null,\"is_restored\":\"0\"}'),
(88, NULL, '20241008-0003', 'Konoha', 'Uzumaki', 'Kirito', '09343944303', 'Linog', 'You dipota diponggol', '../uploads/d4ba34dc241e16d4919ffc1992e97c0b.jpg', 'Santa Fe', 'Okoy', 'Purok Lubi / Mariano Beach Street', 5, '2024-10-08 21:47:05', '2024-10-08 21:48:36', '{\"id\":\"88\",\"team_id\":null,\"code\":\"20241008-0003\",\"lastname\":\"Konoha\",\"firstname\":\"Uzumaki\",\"middlename\":\"Kirito\",\"contact\":\"09343944303\",\"subject\":\"Linog\",\"message\":\"You dipota diponggol\",\"image\":\"..\\/uploads\\/d4ba34dc241e16d4919ffc1992e97c0b.jpg\",\"municipality\":\"Santa Fe\",\"barangay\":\"Okoy\",\"sitio_street\":\"Purok Lubi \\/ Mariano Beach Street\",\"status\":\"0\",\"date_created\":\"2024-10-08 21:47:05\",\"date_updated\":\"2024-10-08 21:47:05\",\"deleted_reports\":null,\"is_restored\":\"0\"}'),
(89, 2, '20241015-0001', 'Jahnson', 'Kill', 'Mid', '00938438211', 'Baha', 'niko nikoni', '../uploads/d69767068d8e49aec585e99ab886b0cc.jpg', 'Bantayan', 'Hilotongan', 'Marciano Street', 5, '2024-10-15 09:47:37', '2024-10-15 19:51:22', '{\"id\":\"89\",\"team_id\":\"2\",\"code\":\"20241015-0001\",\"lastname\":\"Jahnson\",\"firstname\":\"Kill\",\"middlename\":\"Mid\",\"contact\":\"00938438211\",\"subject\":\"Baha\",\"message\":\"niko nikoni\",\"image\":\"..\\/uploads\\/d69767068d8e49aec585e99ab886b0cc.jpg\",\"municipality\":\"Bantayan\",\"barangay\":\"Hilotongan\",\"sitio_street\":\"Marciano Street\",\"status\":\"1\",\"date_created\":\"2024-10-15 09:47:37\",\"date_updated\":\"2024-10-15 19:46:53\",\"deleted_reports\":null}'),
(90, NULL, '20241015-0002', 'Jino', 'The ', 'Gret', '09284891299', 'Buhawi', 'sate sate ganbare senpai', '../uploads/ff8a2fc98acac631f01c438b15f82467.jpg', 'Bantayan', 'Botigues', 'Mambakayaw Stree', 5, '2024-10-15 19:50:46', '2024-10-18 19:38:39', '{\"id\":\"90\",\"team_id\":null,\"code\":\"20241015-0002\",\"lastname\":\"Jino\",\"firstname\":\"The \",\"middlename\":\"Gret\",\"contact\":\"09284891299\",\"subject\":\"Buhawi\",\"message\":\"sate sate ganbare senpai\",\"image\":\"..\\/uploads\\/ff8a2fc98acac631f01c438b15f82467.jpg\",\"municipality\":\"Bantayan\",\"barangay\":\"Botigues\",\"sitio_street\":\"Mambakayaw Stree\",\"status\":\"0\",\"date_created\":\"2024-10-15 19:50:46\",\"date_updated\":\"2024-10-17 06:53:22\",\"deleted_reports\":null}'),
(91, NULL, '20241016-0001', 'Ban', 'Na', 'Nana', '09343944303', 'Tsunami', 'nikoninkoninkona', '../uploads/cdbeb65b1124f406a08544093860f9e0.jpeg', 'Madridejos', 'San Agustin', 'Purok Bakhaw Mariano Street', 0, '2024-10-16 10:09:34', '2024-10-16 10:09:34', NULL),
(92, NULL, '20241019-0001', 'Okada', 'Itchi', 'Oda', '09123456789', 'Sunamai', 'kokororokaor', '../uploads/2488a365a12b7910e8cc7afd2f7c2ef6.jpg', 'Bantayan', 'Lipayran', 'Purok Dangit', 5, '2024-10-19 09:52:47', '2024-10-19 09:53:46', '{\"id\":\"92\",\"team_id\":null,\"code\":\"20241019-0001\",\"lastname\":\"Okada\",\"firstname\":\"Itchi\",\"middlename\":\"Oda\",\"contact\":\"09123456789\",\"subject\":\"Sunamai\",\"message\":\"kokororokaor\",\"image\":\"..\\/uploads\\/2488a365a12b7910e8cc7afd2f7c2ef6.jpg\",\"municipality\":\"Bantayan\",\"barangay\":\"Lipayran\",\"sitio_street\":\"Purok Dangit\",\"status\":\"0\",\"date_created\":\"2024-10-19 09:52:47\",\"date_updated\":\"2024-10-19 09:52:47\",\"deleted_reports\":null}'),
(93, NULL, '20241019-0002', 'Kakaa', 'Kikiki', 'Kokoko', '09123456789', 'Sunamai', 'fadeqsgh4', '../uploads/af622cbcadb45b61e7d5587dd8b679c0.jpg', 'Bantayan', 'Kabac', 'Fase Gase', 0, '2024-10-19 10:30:04', '2024-10-19 10:30:04', NULL),
(94, NULL, '20241020-0001', 'Hoo ', 'Kahapo ', 'Ngkurso', '09123456789', 'Buhawi', 'jaakeiwlqocamfka  jkdfasiefw ', '../uploads/55edc5c6a7b2d902ac10bab5712ed7b8.jpg', 'Santa Fe', 'Poblacion', 'Batiancila Street', 0, '2024-10-20 11:31:52', '2024-10-20 11:31:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL,
  `municipality_id` int(11) DEFAULT NULL,
  `municipality_logo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`, `municipality_id`, `municipality_logo`) VALUES
(1, 'name', 'Online Fire Reporting System', NULL, NULL),
(6, 'short_name', 'BANTAYAN FIRE STATION', NULL, NULL),
(11, 'logo', 'uploads/logo.png?v=1728734287', NULL, NULL),
(13, 'user_avatar', 'uploads/user_avatar.jpg', NULL, NULL),
(14, 'cover', 'uploads/cover.png?v=1730032502', NULL, NULL),
(17, 'phone', '(032)420-9070', NULL, NULL),
(18, 'mobile', '09224048279', NULL, NULL),
(19, 'email', 'madridejosbfp@gmail.com', NULL, NULL),
(20, 'address', 'Poblacion, Madridejos, Cebu', NULL, NULL),
(21, 'facebook', 'https://bantayan-bfp.com/', NULL, NULL);

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
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `municipality` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team_list`
--

INSERT INTO `team_list` (`id`, `code`, `district`, `leader_name`, `leader_contact`, `members`, `delete_flag`, `date_created`, `date_updated`, `municipality`) VALUES
(2, 'F-1014', 'Bantayan', 'Johnny Deep', '09654789123', 'Member 101, Member 102, Member 103, Member 104', 0, '2022-05-21 09:44:15', '2024-10-01 09:16:36', NULL),
(7, 'K-043135', 'Santa Fe', 'Roger', '09358275838', 'Red Hair, Marco, Ace, White Beard', 0, '2024-07-15 21:18:36', '2024-09-11 15:45:47', NULL),
(9, 'RJ-45', 'Santa Fe', 'Trafalgar', '09122222222', 'BIPO, CHOPPER, USOP, ZORO', 0, '2024-10-15 09:39:53', '2024-10-15 09:39:53', NULL),
(10, 'BR-93', 'Madridejos', 'Boyaks', '09282819582', 'Ace, Gon, Kin, Yas', 0, '2024-10-15 12:00:47', '2024-10-15 12:00:47', NULL),
(11, '75-VP', 'Bantayan', 'VEGAPUNK', '09318924723', 'VP0, VP1, VP2, VP3', 0, '2024-10-15 20:00:20', '2024-10-15 20:00:20', NULL),
(12, 'M-41', 'Bantayan', 'PJ', '09832957328', 'P1, P2, P3, P4', 0, '2024-10-17 06:42:52', '2024-10-17 06:42:52', NULL);

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
  `date_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `otp_code` varchar(10) DEFAULT NULL,
  `otp_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='2';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `username`, `district`, `email`, `password`, `reset_token`, `token_expiry`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`, `otp_code`, `otp_expiry`) VALUES
(10, 'Bantayan ', '', 'BFP', 'Bantayan-RVII', 'Bantayan', 'bantayanbfp@gmail.com', '277becbd98926acb200321f42d51397a', NULL, NULL, NULL, NULL, 1, '2024-10-06 22:16:59', '2024-10-08 22:27:15', NULL, NULL),
(11, 'Madridejos', '', 'BFP', 'Madridejos-RVII', 'Madridejos', 'madridejosbfp@gmail.com', '7341f73b48a40a7d999c3911ce928b1a', NULL, NULL, 'uploads/avatars/11.png?v=1728224493', NULL, 1, '2024-10-06 22:21:33', '2024-10-06 22:37:40', NULL, NULL),
(12, 'SantaFe', '', 'BFP', 'SantaFe-RVII', 'Santa Fe', 'santafebfp@gmail.com', '52eca04a1d24a245527c50175acadb57', NULL, NULL, 'uploads/avatars/12.png?v=1728224668', NULL, 1, '2024-10-06 22:24:28', '2024-10-06 22:38:43', NULL, NULL);

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
-- Indexes for table `municipalities`
--
ALTER TABLE `municipalities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_list`
--
ALTER TABLE `request_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `team_id_fk_rl` (`team_id`),
  ADD KEY `idx_deleted_reports` (`deleted_reports`(768));

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `history_list`
--
ALTER TABLE `history_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `inquiry_list`
--
ALTER TABLE `inquiry_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `municipalities`
--
ALTER TABLE `municipalities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `request_list`
--
ALTER TABLE `request_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `team_list`
--
ALTER TABLE `team_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
('root', '[{\"db\":\"ofrs_db\",\"table\":\"events_list\"},{\"db\":\"fireclone\",\"table\":\"users\"},{\"db\":\"ofrs_db\",\"table\":\"system_info\"},{\"db\":\"ofrs_db\",\"table\":\"history_list\"},{\"db\":\"ofrs_db\",\"table\":\"inquiry_list\"},{\"db\":\"fireclone\",\"table\":\"municipalities\"},{\"db\":\"fireclone\",\"table\":\"fire_incident_reports\"},{\"db\":\"ofrs_db\",\"table\":\"team_list\"},{\"db\":\"ofrs_db\",\"table\":\"request_list\"},{\"db\":\"ofrs_db\",\"table\":\"users\"}]');

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
('root', '2024-10-28 00:14:55', '{\"Console\\/Mode\":\"collapse\"}');

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
  `is_deleted` tinyint(1) DEFAULT 0,
  `deleted_report` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request_list`
--

INSERT INTO `request_list` (`id`, `team_id`, `code`, `fullname`, `contact`, `message`, `location`, `status`, `date_created`, `date_updated`, `is_deleted`, `deleted_report`) VALUES
(1, NULL, '2022052100001', 'Ella Zane', '09456987455', 'A Residential Area is on Fire.', '2688 Goosetown Drive, Charlotte, North Carolina, 28202', 5, '2022-05-21 10:25:02', '2024-10-17 20:14:57', 0, NULL),
(2, NULL, '2022052100002', 'Dina Santos', '0978945631', 'Sample report only', '4250 Star Trek Drive, Tallahassee, Florida, 32303', 5, '2022-05-21 14:35:12', '2024-09-19 10:56:04', 0, NULL),
(4, NULL, '2022052100003', 'Martha V Whitten', '562-397-5583', 'Commercial Buiding is on fire.', '3621 Thompson Drive, San Leandro, California(CA), 94578', 5, '2022-05-21 14:51:56', '2024-09-17 07:54:42', 0, NULL),
(5, NULL, '2024091700001', 'fadas', '09325247257', 'fdsafsa', 'fasfsa', 5, '2024-09-17 09:41:23', '2024-09-17 09:41:51', 0, NULL),
(6, NULL, '2024091700002', 'Jericho C. Batuigas', '09325247257', 'fsadfsa', 'fsadfsa', 5, '2024-09-17 10:31:57', '2024-09-17 10:42:43', 0, NULL),
(7, NULL, '2024091900001', 'jericho', '09325247257', 'fsad', 'fasdf', 1, '2024-09-19 15:41:18', '2024-09-19 15:41:44', 0, NULL),
(8, NULL, '2024101700001', 'jericcho ', '09357275245', 'afsdaeggwe', 'fsadfg', 5, '2024-10-17 18:49:58', '2024-10-17 20:14:51', 0, NULL),
(9, NULL, '2024101700002', 'fasd', 'e1fdas', 'fadfsa', 'fasfas', 5, '2024-10-17 20:15:27', '2024-10-17 20:15:35', 0, NULL),
(10, NULL, '2024101800001', 'you', '122233333333333', 'fadiekanwqmz.x', 'fadien, kaowlepz', 5, '2024-10-18 07:24:26', '2024-10-18 07:36:34', 1, '{\"id\":\"10\",\"team_id\":null,\"code\":\"2024101800001\",\"fullname\":\"you\",\"contact\":\"122233333333333\",\"message\":\"fadiekanwqmz.x\",\"location\":\"fadien, kaowlepz\",\"status\":\"0\",\"date_created\":\"2024-10-18 07:24:26\",\"date_updated\":\"2024-10-18 07:24:51\",\"is_deleted\":\"1\",'),
(11, NULL, '2024102400001', 'Maki M. Kima', '09123456789', 'fsaf353gfad', 'fasdew', 0, '2024-10-24 08:30:49', '2024-10-24 08:30:49', 0, NULL);

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
(3, 'W-579', 'clark', '09328573732', 'P1, P2, P3, P4', 0, '2024-10-24 08:30:21', '2024-10-24 08:30:21');

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
(1, 'Adminstrator', '', 'Admin', 'admin', 'bantayanbfp@gmail.com', '0192023a7bbd73250516f069df18b500', 'uploads/avatars/1.png?v=1649834664', NULL, 1, '2021-01-20 14:02:37', '2024-10-21 19:50:51', '$2y$10$y.jWZ60E1BzRxQOVYKPoq.kMBSAPXz.3mfhtsgl.UCWe.f7HgQxDq', '2024-10-21 14:50:51'),
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
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `team_list`
--
ALTER TABLE `team_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
