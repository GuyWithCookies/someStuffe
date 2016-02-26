-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 26. Feb 2016 um 17:42
-- Server-Version: 10.1.9-MariaDB
-- PHP-Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `volleyball`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `takespartin`
--

CREATE TABLE `takespartin` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `TurnierID` int(11) NOT NULL,
  `Teilnahme` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `takespartin`
--

INSERT INTO `takespartin` (`ID`, `UserID`, `TurnierID`, `Teilnahme`) VALUES
(18, 17, 2, 2),
(19, 17, 4, 1),
(20, 17, 5, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `training`
--

CREATE TABLE `training` (
  `ID` int(11) NOT NULL,
  `Datum` date NOT NULL,
  `Essen` tinyint(1) NOT NULL DEFAULT '0',
  `Trinken` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `turniere`
--

CREATE TABLE `turniere` (
  `ID` int(11) NOT NULL,
  `Name` text NOT NULL,
  `Datum` date NOT NULL,
  `Startzeit` varchar(10) NOT NULL,
  `Ausschreibung` text NOT NULL,
  `Kommentar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `turniere`
--

INSERT INTO `turniere` (`ID`, `Name`, `Datum`, `Startzeit`, `Ausschreibung`, `Kommentar`) VALUES
(1, 'Sparkassencup', '2016-02-17', '15:00', 'Some Text', 'gagafdaf'),
(2, 'Sparkassencup2', '2016-03-17', '15:00', 'Some Text', 'gagafdaf'),
(3, 'Mitternachtstunier', '2015-12-15', '15:00', 'afdsaaaaaaa', 'asdfasdfsfsdf'),
(4, 'Sparkassencup', '2016-03-11', '15:00', '', 'gagafdaf'),
(5, 'Sparkassencup3', '2016-03-23', '15:00', 'Some Text', ''),
(9, 'Tunier', '0000-00-00', '3:00', 'etwetr', 'etwetr');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `Vorname` text NOT NULL,
  `Nachname` text NOT NULL,
  `Password` text NOT NULL,
  `Telefonnummer` text NOT NULL,
  `Email` text NOT NULL,
  `Admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`ID`, `Vorname`, `Nachname`, `Password`, `Telefonnummer`, `Email`, `Admin`) VALUES
(17, 'Benjamin', 'Schimke', '5d9f71b71b207b9e665820c0dce67bdb', '03529511901', 'Benni.Schimke@web.de', 1),
(32, 'Test1', 'Test1', '91111fb1f8b088438d80367df81cb6cf', '', '', 1),
(33, 'Test12', 'Test12', '91111fb1f8b088438d80367df81cb6cf', '', '', 0),
(34, 'Test123', 'Test123', '91111fb1f8b088438d80367df81cb6cf', '', '', 0),
(35, 'Tina', 'ClauÃŸner', '91111fb1f8b088438d80367df81cb6cf', '', '', 1),
(36, 'Silvio', 'ClauÃŸner', '91111fb1f8b088438d80367df81cb6cf', '', '', 0),
(37, 'Test1333', 'Test13', '91111fb1f8b088438d80367df81cb6cf', '', '', 0),
(38, 'Test13332', 'Test132', '91111fb1f8b088438d80367df81cb6cf', '', '', 0),
(39, 'Test133323', 'Test1323', '91111fb1f8b088438d80367df81cb6cf', '', '', 0),
(40, 'Test1333233', 'Test13233', '91111fb1f8b088438d80367df81cb6cf', '', '', 0),
(41, 'Test1333233', 'Test1323333', '91111fb1f8b088438d80367df81cb6cf', '', '', 0),
(42, 'Test133323344', 'Test1323333', '91111fb1f8b088438d80367df81cb6cf', '', '', 0),
(43, 'Tina', 'ClauÃŸ', '91111fb1f8b088438d80367df81cb6cf', '', '', 1),
(44, 'Paul', 'Meyer', '91111fb1f8b088438d80367df81cb6cf', '', '', 1);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `takespartin`
--
ALTER TABLE `takespartin`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `training`
--
ALTER TABLE `training`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `turniere`
--
ALTER TABLE `turniere`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `takespartin`
--
ALTER TABLE `takespartin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT für Tabelle `training`
--
ALTER TABLE `training`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `turniere`
--
ALTER TABLE `turniere`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
