-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Värd: localhost
-- Skapad: 14 mars 2013 kl 13:32
-- Serverversion: 5.5.25
-- PHP-version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `schoolbox`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `files`
--

CREATE TABLE `files` (
  `fileid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `filename` varchar(200) DEFAULT NULL,
  `filesize` double NOT NULL,
  `userid` int(11) DEFAULT NULL,
  PRIMARY KEY (`fileid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE `users` (
  `userid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(80) DEFAULT NULL,
  `lastname` varchar(80) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `schoolname` varchar(200) DEFAULT NULL,
  `active` timestamp NULL DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `storageused` float DEFAULT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`userid`, `firstname`, `lastname`, `email`, `password`, `schoolname`, `active`, `created`, `storageused`) VALUES
(1, 'Kenth', 'S&ouml;derholm', 'kenth.south@gmail.com', 'kenth', 'derp', '2013-03-14 09:55:32', '2013-03-11 09:19:37', 0),
(2, 'Oliwer', 'Hels&eacute;n', 'oliwer@schoolbox.se', 'oliwer', 'derp', '2013-03-11 09:19:37', '2013-03-11 09:19:37', 0),
(3, 'Martin', 'Nilsson', 'martin@moku.se', 'martin', NULL, '2013-03-14 09:07:51', '2013-03-14 09:07:51', 0);

-- --------------------------------------------------------

--
-- Tabellstruktur `usersXfiles`
--

CREATE TABLE `usersXfiles` (
  `userfilesid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `filesid` int(11) DEFAULT NULL,
  PRIMARY KEY (`userfilesid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
