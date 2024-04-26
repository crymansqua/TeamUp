-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 26, 2024 at 12:51 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `teamup`
--

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `project_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `creator_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`project_id`, `title`, `description`, `start_date`, `end_date`, `creator_id`, `created_at`) VALUES
(5, 'Web Design', 'Website design for beginners', '2024-04-26', '2024-04-26', NULL, '2024-04-26 00:50:02'),
(6, 'DatasCIENCE', 'DESCRIPYTION SBOUT THID PTJRC', '2024-04-26', '2024-05-10', NULL, '2024-04-26 04:11:12'),
(7, 'DATA analytcs Project 1', 'fydgyasgsgtyfsrasdd', '2024-04-25', '2024-05-11', NULL, '2024-04-26 07:08:58'),
(8, 'Web Designing', 'WP THEMe ctreation -chld theme', '2024-04-26', '2024-05-11', NULL, '2024-04-26 10:30:59'),
(9, 'web scraping', 'web scraping for ebsite team up', '2024-04-24', '2024-04-27', NULL, '2024-04-26 10:32:00');

-- --------------------------------------------------------

--
-- Table structure for table `project_members`
--

CREATE TABLE `project_members` (
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project_members`
--

INSERT INTO `project_members` (`project_id`, `user_id`) VALUES
(5, 1),
(6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `project_skills`
--

CREATE TABLE `project_skills` (
  `project_id` int(11) NOT NULL,
  `skill_id` int(11) NOT NULL,
  `proficiency_level_required` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project_skills`
--

INSERT INTO `project_skills` (`project_id`, `skill_id`, `proficiency_level_required`) VALUES
(5, 47, 10),
(9, 53, 10);

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `skill_id` int(11) NOT NULL,
  `skill_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`skill_id`, `skill_name`) VALUES
(44, 'Programming'),
(45, 'Hacking 101'),
(46, 'Data Science'),
(47, 'web design'),
(48, 'Hacking 101'),
(49, 'Data Science'),
(50, 'TechnicalSupport'),
(51, 'Hacking 101'),
(52, 'Data Science'),
(53, 'TechnicalSupport');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `resume_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `created_at`, `resume_path`) VALUES
(1, 'Kenn', 'ken@gmail.com', '$2y$10$kwdEt/CHrws7Ayhi1au.iuNZQiHpj/AsQu6sAKeJncxH9lC2vNoGm', '2024-04-25 21:34:53', NULL),
(2, 'kennet', 'kik@gmail.com', '$2y$10$Nxq9elESKDgjQrrHfP91A.Dmsj9zvSGJ0gF08I0msFfHYUgVt1Mf.', '2024-04-26 08:47:47', NULL),
(3, 'teamup', 'kimutai20230322@gmail.com', '$2y$10$34MbFHwFwj7kgmDJhgs5D.99oUcDsIRNMKy18fJl72psN8fiYisQW', '2024-04-26 10:28:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_skills`
--

CREATE TABLE `user_skills` (
  `user_id` int(11) NOT NULL,
  `skill_id` int(11) NOT NULL,
  `proficiency_level` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_skills`
--

INSERT INTO `user_skills` (`user_id`, `skill_id`, `proficiency_level`) VALUES
(1, 45, 10),
(1, 46, 8),
(1, 47, 1),
(2, 48, 7),
(2, 49, 1),
(2, 50, 1),
(3, 51, 10),
(3, 52, 10),
(3, 53, 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`project_id`),
  ADD KEY `creator_id` (`creator_id`);

--
-- Indexes for table `project_members`
--
ALTER TABLE `project_members`
  ADD PRIMARY KEY (`project_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `project_skills`
--
ALTER TABLE `project_skills`
  ADD PRIMARY KEY (`project_id`,`skill_id`),
  ADD KEY `skill_id` (`skill_id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`skill_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_skills`
--
ALTER TABLE `user_skills`
  ADD PRIMARY KEY (`user_id`,`skill_id`),
  ADD KEY `skill_id` (`skill_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `skill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`creator_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `project_members`
--
ALTER TABLE `project_members`
  ADD CONSTRAINT `project_members_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`),
  ADD CONSTRAINT `project_members_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `project_skills`
--
ALTER TABLE `project_skills`
  ADD CONSTRAINT `project_skills_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`),
  ADD CONSTRAINT `project_skills_ibfk_2` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`skill_id`);

--
-- Constraints for table `user_skills`
--
ALTER TABLE `user_skills`
  ADD CONSTRAINT `user_skills_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `user_skills_ibfk_2` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`skill_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
