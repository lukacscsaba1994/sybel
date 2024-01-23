-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2024. Jan 23. 02:43
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `sybel`
--
CREATE DATABASE IF NOT EXISTS `sybel` DEFAULT CHARACTER SET utf8 COLLATE utf8_hungarian_ci;
USE `sybel`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `country_id` int(11) NOT NULL,
  `lat` varchar(255) NOT NULL,
  `long` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `cities`
--

INSERT INTO `cities` (`id`, `name`, `country_id`, `lat`, `long`) VALUES
(1, 'Budapest', 6, '47.4984', '19.0404'),
(2, 'Debrecen', 6, '47.5317', '21.6244'),
(3, 'Szeged', 6, '46.253', '20.1482'),
(11, 'Nicosia', 5, '35.1753', '33.3642'),
(12, 'Limassol', 5, '34.6841', '33.0379'),
(13, 'Larnaca', 5, '34.9229', '33.6233'),
(21, 'Zagreb', 4, '45.8144', '15.978'),
(22, 'Split', 4, '43.5089', '16.4392'),
(23, 'Rijeka', 4, '45.3267', '14.4424'),
(31, 'Sofia', 3, '42.6975', '23.3241'),
(32, 'Plovdiv', 3, '42.15', '24.75'),
(33, 'Varna', 3, '43.2167', '27.9167'),
(41, 'Vienna', 1, '48.2085', '16.3721'),
(42, 'Graz', 1, '47.0667', '15.45'),
(43, 'Linz', 1, '48.3064', '14.2861'),
(51, 'Brussels', 2, '50.8505', '4.3488'),
(52, 'Antwerp', 2, '51.2205', '4.4003'),
(53, 'Ghent', 2, '51.05', '3.7167');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `countries`
--

INSERT INTO `countries` (`id`, `name`) VALUES
(1, 'Austria'),
(2, 'Belgium'),
(3, 'Bulgaria'),
(4, 'Croatia'),
(5, 'Cyprus'),
(6, 'Hungary');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cron`
--

CREATE TABLE `cron` (
  `id` int(10) UNSIGNED NOT NULL,
  `endpoint` varchar(255) NOT NULL,
  `cronString` varchar(255) NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `createdAt` datetime NOT NULL,
  `lastModifiedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `weather`
--

CREATE TABLE `weather` (
  `id` int(10) UNSIGNED NOT NULL,
  `cityId` int(10) NOT NULL,
  `temperature` varchar(10) NOT NULL,
  `timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `country_id` (`country_id`);

--
-- A tábla indexei `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `cron`
--
ALTER TABLE `cron`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `weather`
--
ALTER TABLE `weather`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT a táblához `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT a táblához `cron`
--
ALTER TABLE `cron`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT a táblához `weather`
--
ALTER TABLE `weather`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
