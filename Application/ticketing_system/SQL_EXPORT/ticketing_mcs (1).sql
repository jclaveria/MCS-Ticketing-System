-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2015 at 02:05 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ticketing_mcs`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE IF NOT EXISTS `audit_logs` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `audit_action` varchar(100) NOT NULL,
  `audit_task` int(11) NOT NULL,
  `audit_user` int(11) NOT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`log_id`),
  KEY `fk_audit_logs_tasks1_idx` (`audit_task`),
  KEY `fk_audit_logs_users1_idx` (`audit_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `name`, `description`) VALUES
(1, 'Sample Client 1', 'Sample client 1 from europe');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `name`, `description`) VALUES
(1, 'Task Received', 'Task has been received by Admin'),
(2, 'In Progress', 'Task is being worked on'),
(3, 'For Testing', 'Task is done, and is being checked for QA'),
(4, 'Returned', 'Task did not pass QA. Returned to assignee'),
(5, 'Accepted', 'Task has passed QA.'),
(6, 'Closed', 'Task is now Closed');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`task_id`, `summary`, `description`, `assignee`, `task_owner`, `start_date`, `scheduled_date`, `task_category`, `status_id`, `client_id`, `project_value`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(2, 'Summary 1', 'dsadasd', 1, 1, '2015-12-01', '2015-12-21', 'PC', 1, 1, '112.00', '2015-12-05 03:38:06', 4, '2015-12-09 16:50:28', NULL),
(3, 'Sample Task 1', 'lorem pusim sdjf hhwpwp klfdslkjs asd', 1, 1, '2015-12-02', '2015-12-25', 'admin task', 1, 1, '1000.00', '2015-12-09 09:54:34', 1, '2015-12-09 09:54:34', 1),
(4, '2nd task', 'sample 2nd task', 1, 1, '2015-12-01', '2015-12-17', 'asdasd', 1, 1, '1999.00', '2015-12-09 09:55:08', 1, '2015-12-09 09:55:08', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `user_type`, `fname`, `lname`, `mname`, `birthdate`, `position_id`, `created_by`, `created_date`, `updated_by`, `updated_date`, `disabled`, `authKey`, `accessToken`) VALUES
(1, 'admin', 'admin', 'admin', 'Admin First', 'Admin Last', 'Admin Middle', '1991-02-20', 1, 1, '2015-11-11 16:00:00', 1, '2015-11-11 16:00:00', 0, '', ''),
(3, 'admin2', 'admin2', 'admin', 'admin2f', 'admin2l', 'admin2m', '1991-02-20', 1, 1, '2015-11-11 16:00:00', 1, '2015-11-11 16:00:00', 0, '', ''),
(4, 'jrbarron', 'jrbarron', 'user', 'John Robert', 'Barron', 'Claveria', '1988-08-11', 1, 1, '2015-11-11 16:00:00', 1, '2015-11-11 16:00:00', 0, '', ''),
(5, 'caloy', 'admin', 'user', 'asd', 'asd', 'asd', '2015-12-22', 1, 1, '2015-12-10 15:30:35', 1, '2015-12-10 15:30:35', 0, NULL, NULL);

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
