-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 05. Okt 2018 um 16:56
-- Server-Version: 10.1.36-MariaDB
-- PHP-Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `bluesorcerer`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `deck`
--

CREATE TABLE `deck` (
  `Id` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Description` varchar(250) DEFAULT NULL,
  `Class` varchar(100) DEFAULT NULL,
  `Published` tinyint(1) DEFAULT NULL,
  `PublishDate` TIMESTAMP DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `deckcard`
--

CREATE TABLE `deckcard` (
  `DeckId` int(11) NOT NULL,
  `CardId` varchar(10) NOT NULL,
  `Count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `role`
--

CREATE TABLE `role` (
  `Id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `role`
--

INSERT INTO `role` (`Id`, `Name`) VALUES
(1, 'Administrator'),
(2, 'Guest');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `Id` int(11) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `RoleId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`Id`, `Username`, `Password`, `Email`, `RoleId`) VALUES
(1, 'admin', '$2y$10$3dAA8rRh89l4RsMeRFIu1eE.Ysmeh5yYDBCySXW7z88Uh7NhIMCke', 'admin@admin.com', 1);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `deck`
--
ALTER TABLE `deck`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FK_User` (`UserId`);

--
-- Indizes für die Tabelle `deckcard`
--
ALTER TABLE `deckcard`
  ADD PRIMARY KEY (`DeckId`,`CardId`);

--
-- Indizes für die Tabelle `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`Id`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `deck`
--
ALTER TABLE `deck`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `role`
--
ALTER TABLE `role`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `deck`
--
ALTER TABLE `deck`
  ADD CONSTRAINT `FK_User` FOREIGN KEY (`UserId`) REFERENCES `user` (`Id`);

--
-- Constraints der Tabelle `deckcard`
--
ALTER TABLE `deckcard`
  ADD CONSTRAINT `FK_Deck` FOREIGN KEY (`DeckId`) REFERENCES `deck` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
