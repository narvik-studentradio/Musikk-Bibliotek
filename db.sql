-- phpMyAdmin SQL Dump
-- version x.x.x
-- http://www.phpmyadmin.net
--
-- Vert: localhost
-- Generert den: dd. Mmm, yyyy 24:xx PM
-- Tjenerversjon: x.x.xx
-- PHP-Versjon: x.x.x

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `nsrmb`
--

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `library`
--

CREATE TABLE IF NOT EXISTS `library` (
  `sangid` int(12) NOT NULL AUTO_INCREMENT COMMENT 'sangid i nsrmb (intern)',
  `artist` varchar(100) DEFAULT NULL COMMENT 'Artist navn',
  `title` varchar(100) DEFAULT NULL COMMENT 'Navn på sangen',
  `duration` int(10) DEFAULT NULL,
  `lastPlayed` int(10) NOT NULL,
  `playcounter` int(10) NOT NULL DEFAULT '0',
  `type` varchar(20) NOT NULL,
  PRIMARY KEY (`sangid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;