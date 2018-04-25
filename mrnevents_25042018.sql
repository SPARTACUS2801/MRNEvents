-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 25. Apr 2018 um 18:03
-- Server-Version: 10.1.16-MariaDB
-- PHP-Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `mrnevents`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `events_test`
--

CREATE TABLE `events_test` (
  `id` int(11) NOT NULL,
  `titel` varchar(255) DEFAULT NULL,
  `text` longtext,
  `bild` varchar(255) DEFAULT NULL,
  `zusagen` int(11) DEFAULT NULL,
  `datum` datetime NOT NULL,
  `kategorie` varchar(16) NOT NULL,
  `veranstalter` int(11) NOT NULL,
  `public` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `events_test`
--

INSERT INTO `events_test` (`id`, `titel`, `text`, `bild`, `zusagen`, `datum`, `kategorie`, `veranstalter`, `public`) VALUES
(2, 'Mannheimer Stadtfest', 'Diese größte Open-Air-Veranstaltung bei freiem Eintritt in der Region ist Tradition und das Datum im Kalender vieler Besucherinnen und Besucher lange vorgemerkt. Auch im Rahmen der Plankenneugestaltung ist es wieder gelungen, ein abwechslungsreiches Musikprogramm auf vier Bu?hnen mit Live-Auftritten regionaler Bands und DJs anzubieten. Es freut mich ganz besonders, dass auch in diesem Jahr Musikgruppen der Mannheimer Popakademie auftreten. Ergänzt wird das bunte Programm durch das beliebte Kinderfest auf den Kapuzinerplanken und dem traditionellen Kunsthandwerkermarkt, welcher dieses Jahr zum ersten Mal auf dem Paradeplatz stattnden wird.', 'stadtfest.jpg', NULL, '2018-04-18 00:00:00', 'Kultur', 0, 0),
(3, 'Cubes', 'Der CUBES Club befindet sich in der Innenstadt der Metropole Mannheim â€“ direkt am Mannheimer Wahrzeichen, dem Wasserturm. Das CUBES ist ein exklusiver Nachtclub und ein Zuhause fÃ¼r Hip Hop Tunes, Black Beats oder auch Mixed Music Sounds, sowie Sonderveranstaltungen. Jedes Wochenende prÃ¤sentieren wir unseren GÃ¤sten wechselnde Top DJâ€™s, verschiedenste Musikgenres und GetrÃ¤nkespecials. Neben Longdrinks an der Bar und Shots an der Shotbar, ist es mÃ¶glich Flaschen zu kaufen und Lounges zu reservieren. Hierbei genieÃŸt ihr bevorzugten Eintritt, sowie Garderobennutzung und exklusiven Service an der reservierten Lounge.', 'cubes.jpg', NULL, '2018-04-30 00:00:00', 'Party', 0, 0),
(31, 'Julians Hausparty', 'Ladet all eure Freunde ein', '14184458_527550964106701_2383608548037322949_n.jpg', NULL, '2040-04-20 20:40:00', 'kultur', 0, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `imgdata` longblob,
  `imgtype` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `interessen`
--

CREATE TABLE `interessen` (
  `eventid` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `teilnahmen`
--

CREATE TABLE `teilnahmen` (
  `eventid` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `teilnahmen`
--

INSERT INTO `teilnahmen` (`eventid`, `userid`) VALUES
(3, 4),
(31, 4);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `vorname` varchar(255) DEFAULT NULL,
  `nachname` varchar(255) DEFAULT NULL,
  `veranstalter` tinyint(1) DEFAULT NULL,
  `moderator` tinyint(1) DEFAULT '0',
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`userid`, `email`, `vorname`, `nachname`, `veranstalter`, `moderator`, `password`) VALUES
(1, 'admin@web.de', 'admin', 'admin', 0, 1, '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918'),
(2, 'v@web.de', 'mein', 'veranstalter', 0, 0, '9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08'),
(3, 'v2@web.de', 'mein2', 'veranstalter2', 1, 0, '9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08'),
(4, 'test@test.de', 'Test', 'User', 0, 1, '1f8ac10f23c5b5bc1167bda84b833e5c057a77d2');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `events_test`
--
ALTER TABLE `events_test`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `interessen`
--
ALTER TABLE `interessen`
  ADD PRIMARY KEY (`eventid`,`userid`);

--
-- Indizes für die Tabelle `teilnahmen`
--
ALTER TABLE `teilnahmen`
  ADD PRIMARY KEY (`eventid`,`userid`),
  ADD UNIQUE KEY `eventid` (`eventid`,`userid`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `userid` (`userid`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `events_test`
--
ALTER TABLE `events_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT für Tabelle `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
