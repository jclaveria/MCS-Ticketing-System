-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Apr 14, 2016 at 02:53 AM
-- Server version: 5.5.44-MariaDB-cll-lve
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sparksit_ticketing`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE IF NOT EXISTS `audit_logs` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `audit_action` varchar(100) NOT NULL,
  `audit_task` int(11) DEFAULT NULL,
  `audit_user` int(11) NOT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`log_id`),
  KEY `fk_audit_logs_tasks1_idx` (`audit_task`),
  KEY `fk_audit_logs_users1_idx` (`audit_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `audit_logs`
--

INSERT INTO `audit_logs` (`log_id`, `audit_action`, `audit_task`, `audit_user`, `created_date`) VALUES
(2, 'Uploaded file maynilad', 4, 1, '2016-01-04 14:48:11'),
(3, 'Added comment mike please update the attached maynilad.jpg', 4, 1, '2016-01-04 14:48:24'),
(4, 'Logged out', NULL, 1, '2016-01-04 14:48:33'),
(5, 'Logged in', NULL, 4, '2016-01-04 14:48:39'),
(6, 'Added comment yes po', 4, 4, '2016-01-04 14:49:06'),
(7, 'Logged out', NULL, 4, '2016-01-04 14:49:08'),
(8, 'Logged in', NULL, 1, '2016-01-04 14:49:14'),
(9, 'Logged out', NULL, 1, '2016-01-04 14:52:52'),
(10, 'Logged in', NULL, 1, '2016-01-05 00:54:37'),
(11, 'Added comment Remote', 2, 1, '2016-01-05 00:54:52'),
(12, 'Logged in', NULL, 1, '2016-01-05 01:11:26'),
(13, 'Logged out', NULL, 1, '2016-01-05 01:19:57'),
(14, 'Logged in', NULL, 1, '2016-01-05 01:22:43'),
(15, 'Added comment sample desktop', 2, 1, '2016-01-05 01:23:00'),
(16, 'Added comment in mobile: Mobile', 8, 1, '2016-01-05 01:26:07'),
(17, 'Added comment desktop', 8, 1, '2016-01-05 01:26:25'),
(18, 'Created task', 9, 1, '2016-01-05 01:27:21'),
(19, 'Logged out', NULL, 1, '2016-01-05 01:27:50'),
(20, 'Logged in', NULL, 4, '2016-01-05 01:28:03'),
(21, 'Logged out', NULL, 4, '2016-01-05 01:28:36'),
(22, 'Logged in', NULL, 6, '2016-01-05 01:28:49'),
(23, 'Added comment afafaf', 7, 6, '2016-01-05 01:29:18'),
(24, 'Uploaded file starwrs', 7, 6, '2016-01-05 01:31:02'),
(25, 'Logged in', NULL, 1, '2016-01-05 01:32:58'),
(26, 'Uploaded file images', 2, 1, '2016-01-05 01:33:18'),
(27, 'Uploaded file starwrs', 7, 6, '2016-01-05 01:36:34'),
(28, 'Logged out', NULL, 6, '2016-01-05 01:38:16'),
(29, 'Logged in', NULL, 4, '2016-01-05 01:38:37'),
(30, 'Updated task', 9, 4, '2016-01-05 01:44:58'),
(31, 'Logged out', NULL, 4, '2016-01-05 01:45:30'),
(32, 'Logged in', NULL, 4, '2016-01-05 01:46:00'),
(33, 'Added comment in mobile: 2016', 3, 6, '2016-01-05 02:21:03'),
(34, 'Logged out', NULL, 4, '2016-01-05 02:27:21'),
(35, 'Logged in', NULL, 1, '2016-01-05 02:27:39'),
(36, 'Logged out', NULL, 1, '2016-01-05 02:29:08'),
(37, 'Logged in', NULL, 1, '2016-01-05 02:32:42'),
(38, 'Updated task', 2, 1, '2016-01-05 02:34:23'),
(39, 'Updated task', 2, 1, '2016-01-05 02:35:02'),
(40, 'Logged out', NULL, 1, '2016-01-05 03:54:40'),
(41, 'Logged in', NULL, 1, '2016-01-05 03:56:28'),
(42, 'Added comment hi 2016', 2, 1, '2016-01-05 03:58:10'),
(43, 'Logged out', NULL, 1, '2016-01-05 04:08:48'),
(44, 'Logged in', NULL, 1, '2016-01-05 04:10:39'),
(45, 'Logged out', NULL, 1, '2016-01-05 04:20:03'),
(46, 'Logged in', NULL, 4, '2016-01-05 04:20:20'),
(47, 'Added comment in mobile: Test comment\r\n', 2, 1, '2016-01-05 04:23:23'),
(48, 'Logged out', NULL, 4, '2016-01-05 04:25:49'),
(49, 'Logged in', NULL, 1, '2016-01-05 04:26:07'),
(50, 'Logged in', NULL, 1, '2016-01-08 08:25:44'),
(51, 'Logged in', NULL, 1, '2016-01-16 08:01:15'),
(52, 'Logged out', NULL, 1, '2016-01-16 08:01:18');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `name`, `description`) VALUES
(1, 'Sample Client 1', 'Sample client 1 from europe'),
(3, 'Test1', 'Case2');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `text` varchar(45) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `task_id` int(11) NOT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `fk_comments_users1_idx` (`user_id`),
  KEY `fk_comments_tasks1_idx` (`task_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `user_id`, `text`, `created_date`, `task_id`) VALUES
(1, 1, 'fixed!', '2015-12-13 16:24:23', 2),
(2, 4, '=)', '2015-12-13 16:31:04', 5),
(3, 9, 'adrian was here!', '2015-12-14 04:04:26', 2),
(4, 4, 'asdasd', '2015-12-15 23:58:18', 5),
(5, 6, 'hi pogi mark herras', '2015-12-19 01:21:11', 3),
(6, 1, 'mariel', '2015-12-19 05:07:35', 2),
(7, 1, '', '2015-12-19 05:08:39', 2),
(8, 4, 'ahfhg', '2016-01-04 02:49:22', 5),
(9, 1, 'mike please update the attached maynilad.jpg', '2016-01-04 14:48:24', 4),
(10, 4, 'yes po', '2016-01-04 14:49:06', 4),
(11, 1, 'Remote', '2016-01-05 00:54:52', 2),
(12, 1, 'sample desktop', '2016-01-05 01:23:00', 2),
(13, 1, 'Mobile', '2016-01-05 01:26:07', 8),
(14, 1, 'desktop', '2016-01-05 01:26:25', 8),
(15, 6, 'afafaf', '2016-01-05 01:29:18', 7),
(16, 6, '2016', '2016-01-05 02:21:03', 3),
(17, 1, 'hi 2016', '2016-01-05 03:58:10', 2),
(18, 1, 'Test comment\r\n', '2016-01-05 04:23:23', 2);

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE IF NOT EXISTS `positions` (
  `position_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`position_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`position_id`, `name`, `level`) VALUES
(1, 'Administration', 1),
(2, 'Technical - Online Department', 5),
(3, 'Technical - Networking', 4);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` varchar(45) NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `name`, `description`) VALUES
(1, 'Task Received', 'Task has been received by Admin'),
(2, 'In Progress', 'Task is being worked on'),
(3, 'For Testing', 'Task is done, and is being checked for QA'),
(4, 'Returned', 'Task did not pass QA. Returned to assignee'),
(5, 'Accepted', 'Task has passed QA.'),
(6, 'Closed', 'Task is now Closed'),
(8, 'jjj', 'yuuu'),
(9, 'jjj', 'yuuu');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `task_id` int(11) NOT NULL AUTO_INCREMENT,
  `summary` varchar(45) NOT NULL,
  `description` varchar(2500) NOT NULL,
  `assignee` int(11) NOT NULL,
  `task_owner` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `scheduled_date` date DEFAULT NULL,
  `task_category` varchar(45) DEFAULT NULL,
  `status_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `project_value` decimal(10,2) DEFAULT '0.00',
  `created_date` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`task_id`),
  KEY `fk_tasks_clients_idx` (`client_id`),
  KEY `fk_tasks_users1_idx` (`assignee`),
  KEY `fk_tasks_status1_idx` (`status_id`),
  KEY `task_owner` (`task_owner`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`task_id`, `summary`, `description`, `assignee`, `task_owner`, `start_date`, `scheduled_date`, `task_category`, `status_id`, `client_id`, `project_value`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(2, 'Summary 1ssssssssssssssssssssssssssssssssssss', 'dsadasdffffffffff', 1, 4, '2015-12-01', '2015-12-21', 'PC', 4, 1, '112.00', '2015-12-05 03:38:06', 4, '2016-01-05 02:34:48', 1),
(3, 'Sample Task 1', 'lorem pusim sdjf hhwpwp klfdslkjs asd', 6, 1, '2015-12-02', '2015-12-25', 'admin task', 1, 1, '1000.00', '2015-12-09 09:54:34', 1, '2015-12-15 10:05:32', 1),
(4, '2nd task', 'sample 2nd task', 1, 1, '2015-12-01', '2015-12-17', 'asdasd', 4, 1, '1999.00', '2015-12-09 09:55:08', 1, '2015-12-09 09:55:08', 1),
(5, 'weeeeeeeeeeee', 'weeeee', 4, 1, '2015-12-16', '2015-12-17', 'exam', 2, 1, '5000.00', '2015-12-13 16:26:31', 1, '2015-12-13 16:26:31', 1),
(6, 'asara', 'afafaf', 6, 1, '2015-12-01', '2015-12-02', 'task', 1, 1, '100.00', '2015-12-13 17:56:44', 1, '2015-12-13 17:56:44', 1),
(7, 'New task', 'Sample task', 6, 1, '2015-12-14', '2015-12-15', 'Photo', 1, 1, '1000.00', '2015-12-14 07:15:24', 1, '2015-12-14 07:15:24', 1),
(8, '123', '123', 1, 1, '2015-12-01', '2015-12-09', '123', 6, 1, '123.00', '2015-12-19 04:51:47', 1, '2015-12-19 04:51:47', 1),
(9, 'data encoding', 'this is a task for data encoding', 6, 6, '2016-01-06', '2016-01-08', 'accounting', 3, 3, '100000.00', '2016-01-05 01:11:44', 1, '2016-01-05 01:44:44', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tasks_attachment`
--

CREATE TABLE IF NOT EXISTS `tasks_attachment` (
  `attachment_id` int(11) NOT NULL AUTO_INCREMENT,
  `file_destination` varchar(1024) NOT NULL,
  `file_extension` varchar(12) NOT NULL,
  `tasks_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `users_id` int(11) NOT NULL,
  PRIMARY KEY (`attachment_id`),
  KEY `tasks_id` (`tasks_id`,`users_id`),
  KEY `users_id` (`users_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tasks_attachment`
--

INSERT INTO `tasks_attachment` (`attachment_id`, `file_destination`, `file_extension`, `tasks_id`, `created_date`, `users_id`) VALUES
(1, 'erd', 'png', 5, '2015-12-15 23:58:00', 4),
(2, 'MCSOJdocu', 'docx', 2, '2015-12-19 02:26:56', 1),
(3, 'WBSpp', 'jpg', 5, '2015-12-19 02:32:18', 1),
(4, 'maynilad', 'jpg', 4, '2016-01-04 14:48:11', 1),
(5, 'starwrs', 'jpg', 7, '2016-01-05 01:31:02', 6),
(6, 'images', 'jpg', 2, '2016-01-05 01:33:18', 1),
(7, 'starwrs', 'jpg', 7, '2016-01-05 01:36:34', 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `user_type` enum('user','admin') DEFAULT NULL,
  `fname` varchar(45) DEFAULT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `mname` varchar(45) DEFAULT NULL,
  `birthdate` varchar(45) DEFAULT NULL,
  `position_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `disabled` tinyint(1) DEFAULT NULL,
  `authKey` varchar(100) DEFAULT NULL,
  `accessToken` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `fk_users_positions1_idx` (`position_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `user_type`, `fname`, `lname`, `mname`, `birthdate`, `position_id`, `created_by`, `created_date`, `updated_by`, `updated_date`, `disabled`, `authKey`, `accessToken`) VALUES
(1, 'admin', 'admin', 'admin', 'Admin First', 'Admin Last', 'Admin Middle', '1991-02-20', 1, 1, '2015-11-11 16:00:00', 1, '2015-11-11 16:00:00', 0, '', ''),
(3, 'admin2', 'admin2', 'admin', 'admin2f', 'admin2l', 'admin2m', '1991-02-20', 1, 1, '2015-11-11 16:00:00', 1, '2015-11-11 16:00:00', 0, '', ''),
(4, 'jrbarron', 'jrbarron', 'user', 'John Robert', 'Barron', 'Claveria', '1988-08-11', 1, 1, '2015-11-11 16:00:00', 1, '2015-11-11 16:00:00', 0, '', ''),
(6, 'kim', '1234', 'user', 'kim', 'dialogo', '', '', 2, 1, '2015-12-13 16:44:29', 1, '2015-12-13 16:44:29', 0, NULL, NULL),
(7, 'keane', '1234', 'user', 'keane', 'almo', '', '', 3, 1, '2015-12-13 16:49:07', 1, '2015-12-13 16:49:07', 0, NULL, NULL),
(8, 'mark', '1234', 'user', 'mark', 'alfonso', '', '', 2, 1, '2015-12-13 16:49:41', 1, '2015-12-13 16:49:41', 0, NULL, NULL),
(9, 'adrian', '1234', 'user', 'adrian', 'hortelano', '', '', 3, 1, '2015-12-13 16:50:02', 1, '2015-12-13 16:50:02', 0, NULL, NULL),
(11, 'test1', 'test2', 'admin', 'Test', 'Plan', 'Case', '1995-11-01', 1, 1, '2015-12-19 01:47:44', 1, '2015-12-19 01:47:44', 0, NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD CONSTRAINT `fk_audit_logs_tasks1` FOREIGN KEY (`audit_task`) REFERENCES `tasks` (`task_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_audit_logs_users1` FOREIGN KEY (`audit_user`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_tasks1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`task_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comments_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `fk_tasks_clients` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tasks_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tasks_users1` FOREIGN KEY (`assignee`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`task_owner`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tasks_attachment`
--
ALTER TABLE `tasks_attachment`
  ADD CONSTRAINT `tasks_attachment_ibfk_1` FOREIGN KEY (`tasks_id`) REFERENCES `tasks` (`task_id`),
  ADD CONSTRAINT `tasks_attachment_ibfk_2` FOREIGN KEY (`users_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_positions1` FOREIGN KEY (`position_id`) REFERENCES `positions` (`position_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
