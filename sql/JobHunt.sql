-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Erstellungszeit: 22. Jun 2023 um 21:47
-- Server-Version: 10.10.2-MariaDB-1:10.10.2+maria~ubu2204
-- PHP-Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `JobHunt`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(10000) NOT NULL,
  `author` int(255) NOT NULL,
  `posted_at` datetime NOT NULL,
  `salary` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `article`
--

INSERT INTO `article` (`id`, `title`, `content`, `author`, `posted_at`, `salary`) VALUES
(14, 'Ux designer', 'can you design? Ask Eef', 16, '2023-06-22 17:16:09', 501);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `jobTypes`
--

CREATE TABLE `jobTypes` (
  `id` int(11) NOT NULL,
  `job_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `jobTypes`
--

INSERT INTO `jobTypes` (`id`, `job_type`) VALUES
(0, 'Show All'),
(1, 'UX/UI Designer'),
(4, 'test'),
(5, 'Database Engeneer');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `reply`
--

CREATE TABLE `reply` (
  `id` int(255) NOT NULL,
  `content` varchar(500) NOT NULL,
  `reply_from` int(255) NOT NULL,
  `reply_to` int(255) NOT NULL,
  `posted_at` date NOT NULL,
  `article_id` int(200) NOT NULL,
  `accept` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `id` int(20) NOT NULL,
  `firstname` varchar(55) NOT NULL,
  `lastname` varchar(55) NOT NULL,
  `email` varchar(100) NOT NULL,
  `type_id` int(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `certificate` varchar(500) DEFAULT NULL,
  `job_type` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `email`, `type_id`, `password`, `certificate`, `job_type`) VALUES
(16, 'Employer', 'Job', 'employer@gmail.com', 2, '$2y$10$.bzyp9Sad2PHM59kTaW3n.ZUfmwyIK0UtWnhOlZzQ6XC5o9NSS8vG', 'Cat', 0),
(17, 'user', 'employee', 'user@employee.com', 3, '$2y$10$sEqBsR6YucgrtJZysKUaaui7x0yhF/meb3dHQZ0U3XOLZEFzki3A2', 'uni diploma', 0),
(18, 'Roby', 'Admin', 'roby@email.com', 1, '$2y$10$T2fy3.8gnwD2wxuA3fFeBOLLAwcK/TOL7O3fVYKrSb68Vqe/xS4Oa', 'Admin', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `usertype`
--

CREATE TABLE `usertype` (
  `type_id` int(10) NOT NULL,
  `user_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `usertype`
--

INSERT INTO `usertype` (`type_id`, `user_type`) VALUES
(1, 'Admin'),
(2, 'Employer'),
(3, 'User');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author`);

--
-- Indizes für die Tabelle `jobTypes`
--
ALTER TABLE `jobTypes`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reply_from` (`reply_from`),
  ADD KEY `reply_to` (`reply_to`),
  ADD KEY `article_id` (`article_id`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indizes für die Tabelle `usertype`
--
ALTER TABLE `usertype`
  ADD PRIMARY KEY (`type_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT für Tabelle `jobTypes`
--
ALTER TABLE `jobTypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `reply`
--
ALTER TABLE `reply`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`author`) REFERENCES `user` (`id`);

--
-- Constraints der Tabelle `reply`
--
ALTER TABLE `reply`
  ADD CONSTRAINT `reply_ibfk_1` FOREIGN KEY (`reply_from`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `reply_ibfk_2` FOREIGN KEY (`reply_to`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `reply_ibfk_3` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ON DELETE CASCADE;

--
-- Constraints der Tabelle `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `usertype` (`type_id`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`job_type`) REFERENCES `jobTypes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
