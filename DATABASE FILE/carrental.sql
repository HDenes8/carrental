-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2023. Dec 08. 05:14
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
-- Adatbázis: `carrental`
--
CREATE DATABASE IF NOT EXISTS `carrental` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `carrental`;
-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cars`
--

CREATE TABLE `cars` (
  `car_id` int(20) NOT NULL,
  `car_name` varchar(50) NOT NULL,
  `car_nameplate` varchar(50) NOT NULL,
  `car_img` varchar(250) DEFAULT 'NA',
  `ac_price` float NOT NULL,
  `non_ac_price` float NOT NULL,
  `ac_price_per_day` float NOT NULL,
  `non_ac_price_per_day` float NOT NULL,
  `car_availability` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- A tábla adatainak kiíratása `cars`
--

INSERT INTO `cars` (`car_id`, `car_name`, `car_nameplate`, `car_img`, `ac_price`, `non_ac_price`, `ac_price_per_day`, `non_ac_price_per_day`, `car_availability`) VALUES
(1, 'Audi A4', 'QRS-269', 'assets/img/cars/audi-a4.jpg', 3600, 2600, 52000, 26000, 'yes'),
(2, 'Hyundai Creta', 'NOP-495', 'assets/img/cars/creta.jpg', 2200, 1200, 29000, 14000, 'yes'),
(3, 'BMW 6-Series', 'KLM-738', 'assets/img/cars/bmw6.jpg', 3900, 3000, 69500, 59990, 'yes'),
(4, 'Mercedes-Benz E-Class', 'HIJ-192', 'assets/img/cars/mcec.jpg', 4500, 3000, 72000, 52000, 'yes'),
(6, 'Ford EcoSport', 'EFG-718', 'assets/img/cars/ecosport.png', 2100, 1300, 38900, 26000, 'yes'),
(7, 'Honda Amaze', 'BCD-161', 'assets/img/cars/amaze.png', 1400, 1200, 28000, 24000, 'yes'),
(8, 'Land Rover Range Rover Sport', 'YZA-415', 'assets/img/cars/rangero.jpg', 3600, 2600, 60000, 46000, 'yes'),
(9, 'MG Hector', 'YZA-416', 'assets/img/cars/mghector.jpg', 2000, 1200, 29000, 14000, 'yes'),
(10, 'Honda CR-V', 'VWX-131', 'assets/img/cars/hondacr.jpg', 2200, 1500, 28500, 14000, 'yes'),
(11, 'Mahindra XUV 500', 'GHI-321', 'assets/img/cars/Mahindra XUV.jpg', 1500, 1300, 30000, 26000, 'yes'),
(12, 'Toyota Fortuner', 'DEF-789', 'assets/img/cars/Fortuner.png', 1600, 1400, 32000, 28000, 'yes'),
(13, 'Hyundai Veloster', 'XYZ-456', 'assets/img/cars/hyundai0.png', 2300, 1500, 45000, 35000, 'yes'),
(14, 'Jaguar XF', 'OPQ-579', 'assets/img/cars/jaguarxf.jpg', 3900, 2900, 61000, 43800, 'yes'),
(15, 'Range Rover', 'RST-802', 'assets/img/cars/jannis-lucas-uFYZ85fsn24-unsplash.jpg', 1320, 2100, 21000, 12000, 'yes'),
(16, 'Hyundai Creta', 'LMN-246', 'assets/img/cars/lance-asper-Wl6OeSGyOf4-unsplash.jpg', 5600, 5600, 56000, 56000, 'yes'),
(17, 'Hyundai Creta', 'GHI-753', 'assets/img/cars/ew.jpg', 5600, 4500, 45000, 50000, 'yes'),
(18, 'Ford Mustang', 'ABC-123', 'assets/img/cars/ford-mustang-hu-red_mustang.jpg', 3500, 2500, 30000, 20000, 'yes');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `clientcars`
--

CREATE TABLE `clientcars` (
  `car_id` int(20) NOT NULL,
  `client_username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- A tábla adatainak kiíratása `clientcars`
--

INSERT INTO `clientcars` (`car_id`, `client_username`) VALUES
(1, 'ferenc'),
(3, 'ferenc'),
(7, 'ferenc'),
(8, 'ferenc'),
(9, 'ferenc'),
(11, 'ferenc'),
(12, 'ferenc'),
(2, 'szabodani'),
(4, 'szabodani'),
(6, 'szabodani'),
(10, 'szabodani'),
(13, 'szabodani'),
(14, 'szabodani'),
(15, 'szabodani'),
(16, 'szabodani'),
(17, 'szabodani'),
(18, 'szabodani');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `clients`
--

CREATE TABLE `clients` (
  `client_username` varchar(50) NOT NULL,
  `client_name` varchar(50) NOT NULL,
  `client_phone` varchar(15) NOT NULL,
  `client_email` varchar(25) NOT NULL,
  `client_address` varchar(50) CHARACTER SET utf8 COLLATE utf8_estonian_ci NOT NULL,
  `client_password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- A tábla adatainak kiíratása `clients`
--

INSERT INTO `clients` (`client_username`, `client_name`, `client_phone`, `client_email`, `client_address`, `client_password`) VALUES
('ferenc', 'Ferenc Nagy', '+36 30 852 4414', 'ferencnagy@gmail.com', '2477  Nagyfa, tasli utca 32', 'ferenc'),
('szabodani', 'Szabó Dániel', '+36 30 334 8850', 'szabodani@gmail.com', '6729 Szeged, Árpa utca 23.', 'szabodani'),
('tamas', 'Tamás Márinz', '+36 50 558 4862', 'tomi@gmail.com', '4645  Satorosujhely, Attila utca 2.', 'tamas');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `customers`
--

CREATE TABLE `customers` (
  `customer_username` varchar(50) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `customer_phone` varchar(15) NOT NULL,
  `customer_email` varchar(25) NOT NULL,
  `customer_address` varchar(50) NOT NULL,
  `customer_password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- A tábla adatainak kiíratása `customers`
--

INSERT INTO `customers` (`customer_username`, `customer_name`, `customer_phone`, `customer_email`, `customer_address`, `customer_password`) VALUES
('antal', 'Antal Faragó', '+36 70 987 4545', 'antalfarag@gmail.com', '2677  Árpa, Alma utca 2.', 'antal'),
('attila', 'Attila Béla', '+36 70 232 5214', 'thisisattila@gmail.com', '6729 Szeged, Béke utca 8.', 'attila'),
('hdenes', 'Horváth Dénes', '+36 30 650 0544', 'horvathdenes@gmail.com', '6729 Szeged, Tán utca 55.', 'hdenes'),
('jános', 'János Telep', '+36 20 159 7878', 'jánosnagyon@gmail.com', '2316  Maja, Telep út 75.', 'jános'),
('kevin', 'Kevin Rózsavölgyi', '+36 70 852 5545', 'keve@gmail.com', '6729 Szeged, Hargitai utca 47.', 'kevin'),
('sanyi', 'Sándor Nagy', '+36 90 888 8888', 'sanyivagyok@mail.com', '6729 Szeged, Alma utca 11.', 'sanyi'),
('zsigmond', 'Zsigmond Balogh', '+36 20 554 6589', 'baloghzsigmond@gmail.com', '6726 Szeged, Traktor utca 8.', 'zsigmond');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `driver`
--

CREATE TABLE `driver` (
  `driver_id` int(20) NOT NULL,
  `driver_name` varchar(50) NOT NULL,
  `dl_number` varchar(50) NOT NULL,
  `driver_phone` varchar(15) NOT NULL,
  `driver_address` varchar(50) NOT NULL,
  `driver_gender` varchar(10) NOT NULL,
  `client_username` varchar(50) NOT NULL,
  `driver_availability` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- A tábla adatainak kiíratása `driver`
--

INSERT INTO `driver` (`driver_id`, `driver_name`, `dl_number`, `driver_phone`, `driver_address`, `driver_gender`, `client_username`, `driver_availability`) VALUES
(1, 'Barnabás Elek', '27840218658 ', '+36 30 986 4545', '6729 Szeged, Kereskedő Köz 1.', 'Férfi', 'ferenc', 'yes'),
(2, 'Nagy Ferenc', '03191563155 ', '+36 20 456 4414', '6729 Szeged, Kereskedő Köz 2.', 'Férfi', 'ferenc', 'yes'),
(3, 'Nemes Sándor', '32346288078 ', '+36 62 654 5145', '6729 Szeged, Kereskedő Köz 3.', 'Férfi', 'ferenc', 'yes'),
(4, 'Miskolci Ivett', '04316015965 ', '+3620 854 6658', '6729 Szeged, Kereskedő Köz 4.', 'Nő', 'szabodani', 'yes'),
(5, 'Törteli Hanna ', '68799466631 ', '+36 80 159 8847', '6729 Szeged, Kereskedő Köz 5.', 'Nő', 'szabodani', 'yes'),
(6, 'Bálint Nándor', '36740186040 ', '+36 30 457 9595', '6729 Szeged, Kereskedő Köz 6.', 'Férfi', 'tamas', 'yes'),
(7, 'Barát Nándor', '44919316260 ', '+36 62 452 5578', '6729 Szeged, Kereskedő Köz 7.', 'Férfi', 'ferenc', 'yes'),
(8, 'Pán Péter', '94592817723', '+36 50 159 8825', '6729 Szeged, Kereskedő Köz 8.', 'Férfi', 'szabodani', 'yes'),
(9, 'Boros László', '3245678908', '+36 30 458 2296', '6729 Szeged, Kereskedő Köz 9.', 'Férfi', 'ferenc', 'yes'),
(10, 'Lacika Farkas', '61984098603', '+36 30 650 2525', '6729 Szeged, Szilágyi u. 13.', 'Férfi', 'szabodani', 'yes');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `feedback`
--

CREATE TABLE `feedback` (
  `name` varchar(20) NOT NULL,
  `e_mail` varchar(30) NOT NULL,
  `message` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- A tábla adatainak kiíratása `feedback`
--

INSERT INTO `feedback` (`name`, `e_mail`, `message`) VALUES
('Dénes', 'horvathdenes@gmail.com', 'Remelem ez mukodik.');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `rentedcars`
--

CREATE TABLE `rentedcars` (
  `id` int(100) NOT NULL,
  `customer_username` varchar(50) NOT NULL,
  `car_id` int(20) NOT NULL,
  `driver_id` int(20) NOT NULL,
  `booking_date` date NOT NULL,
  `rent_start_date` date NOT NULL,
  `rent_end_date` date NOT NULL,
  `car_return_date` date DEFAULT NULL,
  `fare` double NOT NULL,
  `charge_type` varchar(25) NOT NULL DEFAULT 'days',
  `distance` double DEFAULT NULL,
  `no_of_days` int(50) DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `return_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- A tábla adatainak kiíratása `rentedcars`
--

INSERT INTO `rentedcars` (`id`, `customer_username`, `car_id`, `driver_id`, `booking_date`, `rent_start_date`, `rent_end_date`, `car_return_date`, `fare`, `charge_type`, `distance`, `no_of_days`, `total_amount`, `return_status`) VALUES
(574681245, 'attila', 4, 2, '2023-07-18', '2023-07-01', '2023-07-02', '2023-07-18', 11, 'km', 244, 1, 5884, 'R'),
(574681246, 'jános', 6, 6, '2023-07-18', '2023-06-01', '2023-06-28', '2023-07-18', 15, 'km', 69, 27, 5035, 'R'),
(574681247, 'antal', 3, 1, '2023-07-18', '2023-07-19', '2023-07-22', '2023-07-20', 13, 'km', 421, 3, 5473, 'R'),
(574681248, 'attila', 1, 2, '2023-07-20', '2023-07-28', '2023-07-29', '2023-07-20', 10, 'km', 69, 1, 690, 'R'),
(574681249, 'jános', 1, 2, '2023-07-23', '2023-07-24', '2023-07-25', '2023-07-23', 10, 'km', 500, 1, 5000, 'R'),
(574681250, 'zsigmond', 3, 2, '2023-07-23', '2023-07-23', '2023-07-24', '2023-07-23', 2600, 'days', NULL, 1, 2600, 'R'),
(574681251, 'jános', 10, 1, '2023-07-23', '2023-07-25', '2023-07-30', '2023-07-23', 10, 'km', 60, 2, 600, 'R'),
(574681252, 'kevin', 11, 2, '2023-07-23', '2023-07-23', '2023-07-23', '2023-07-23', 13, 'km', 200, 0, 2600, 'R'),
(574681253, 'kevin', 6, 7, '2023-07-23', '2023-07-23', '2023-08-03', '2023-07-23', 2600, 'days', NULL, 11, 28600, 'R'),
(574681254, 'attila', 12, 5, '2023-07-23', '2023-07-23', '2023-07-26', '2023-07-23', 3200, 'days', NULL, 3, 9600, 'R'),
(574681255, 'kevin', 8, 5, '2023-07-23', '2023-07-23', '2023-08-08', '2023-07-23', 2400, 'days', NULL, 16, 38400, 'R'),
(574681257, 'jános', 7, 4, '2023-08-11', '2023-08-13', '2023-08-17', '2023-12-07', 14, 'km', 259, 4, 26026, 'R'),
(574681258, 'zsigmond', 3, 1, '2021-03-24', '2021-03-24', '2021-03-25', '2021-03-24', 2600, 'days', NULL, 1, 2600, 'R'),
(574681259, 'zsigmond', 14, 8, '2021-03-24', '2021-03-24', '2021-03-26', '2021-03-24', 6100, 'days', NULL, 2, 12200, 'R'),
(574681260, 'zsigmond', 4, 8, '2023-06-27', '2023-06-27', '2023-06-27', '2023-12-03', 7200, 'days', NULL, 0, 31800, 'R'),
(574681261, 'zsigmond', 4, 8, '2023-06-27', '2023-06-27', '2023-06-27', '2023-12-03', 7200, 'days', NULL, 0, 31800, 'R'),
(574681262, 'zsigmond', 4, 8, '2023-06-27', '2023-06-27', '2023-06-27', '2023-12-07', 7200, 'days', NULL, 0, 32600, 'R'),
(574681263, 'zsigmond', 6, 5, '2023-12-03', '2023-12-07', '2023-12-30', '2023-12-07', 21, 'km', 600, 23, 12600, 'R'),
(574681265, 'zsigmond', 4, 8, '2023-12-03', '2023-12-07', '2023-12-28', NULL, 7200, 'days', NULL, NULL, NULL, 'NR'),
(574681266, 'zsigmond', 3, 3, '2023-12-03', '2023-12-08', '2023-12-13', '2023-12-07', 6950, 'days', NULL, 5, 34750, 'R'),
(574681267, 'zsigmond', 3, 3, '2023-12-03', '2023-12-08', '2023-12-13', NULL, 6950, 'days', NULL, NULL, NULL, 'NR'),
(574681268, 'zsigmond', 3, 3, '2023-12-03', '2023-12-08', '2023-12-13', NULL, 6950, 'days', NULL, NULL, NULL, 'NR'),
(574681269, 'zsigmond', 18, 10, '2023-12-03', '2023-12-24', '2023-12-31', '2023-12-03', 30000, 'days', NULL, 7, 210000, 'R'),
(574681270, 'zsigmond', 18, 10, '2023-12-03', '2023-12-03', '2023-12-16', '2023-12-03', 4500, 'km', 200, 13, 1500, 'R'),
(574681271, 'zsigmond', 18, 8, '2023-12-03', '2023-12-03', '2023-12-06', '2023-12-03', 5500, '', 3, 3, 1500, 'R'),
(574681273, 'hdenes', 4, 8, '2023-12-03', '2023-12-03', '2023-12-17', '2023-12-03', 7200, 'days', NULL, 14, 100800, 'R'),
(574681274, 'hdenes', 18, 8, '2023-12-03', '2023-12-03', '2023-12-04', '2023-12-03', 3500, 'km', 100, 1, 350000, 'R'),
(574681275, 'hdenes', 18, 8, '2023-12-03', '2023-12-03', '2023-12-10', '2023-12-03', 3500, 'km', 60, 7, 210000, 'R'),
(574681276, 'hdenes', 18, 8, '2023-12-03', '2023-12-03', '2023-12-04', '2023-12-03', 3500, '', 1, 1, 1500, 'R'),
(574681277, 'hdenes', 18, 10, '2023-12-03', '2023-12-03', '2023-12-13', '2023-12-03', 1500, 'days', NULL, 10, 1500, 'R'),
(574681278, 'hdenes', 18, 10, '2023-12-03', '2023-12-03', '2023-12-10', '2023-12-03', 3500, 'km', 80, 7, 280000, 'R'),
(574681279, 'hdenes', 4, 8, '2023-12-03', '2023-12-03', '2023-12-07', '2023-12-03', 72000, 'days', NULL, 4, 288000, 'R'),
(574681280, 'zsigmond', 11, 1, '2023-12-07', '2023-12-07', '2023-12-22', '2023-12-07', 1500, 'km', 60, 15, 90000, 'R'),
(574681281, 'zsigmond', 13, 8, '2023-12-07', '2023-12-22', '2023-12-23', '2023-12-07', 45000, 'days', NULL, 1, 45000, 'R'),
(574681282, 'zsigmond', 13, 8, '2023-12-07', '2023-12-22', '2023-12-23', NULL, 45000, 'days', NULL, NULL, NULL, 'NR'),
(574681283, 'hdenes', 18, 5, '2023-12-08', '2023-12-04', '2023-12-08', '2023-12-08', 30000, 'days', NULL, 4, 120000, 'R'),
(574681284, 'hdenes', 4, 4, '2023-12-08', '2023-12-08', '2023-12-13', '2023-12-08', 3000, 'km', 78, 5, 234000, 'R'),
(574681285, 'hdenes', 9, 1, '2023-12-08', '2023-12-08', '2023-12-09', '2023-12-08', 14000, 'days', NULL, 1, 14000, 'R'),
(574681286, 'hdenes', 17, 5, '2023-12-08', '2023-12-08', '2023-12-29', '2023-12-08', 45000, 'days', NULL, 21, 945000, 'R'),
(574681287, 'hdenes', 17, 5, '2023-12-08', '2023-12-08', '2023-12-29', '2023-12-08', 45000, 'days', NULL, 21, 945000, 'R'),
(574681288, 'hdenes', 17, 5, '2023-12-08', '2023-12-08', '2023-12-29', '2023-12-08', 45000, 'days', NULL, 21, 945000, 'R'),
(574681289, 'hdenes', 9, 2, '2023-12-08', '2023-12-08', '2023-12-21', '2023-12-08', 29000, 'days', NULL, 13, 377000, 'R'),
(574681290, 'hdenes', 9, 2, '2023-12-08', '2023-12-08', '2023-12-21', '2023-12-08', 29000, 'days', NULL, 13, 377000, 'R');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`car_id`),
  ADD UNIQUE KEY `car_nameplate` (`car_nameplate`);

--
-- A tábla indexei `clientcars`
--
ALTER TABLE `clientcars`
  ADD PRIMARY KEY (`car_id`),
  ADD KEY `client_username` (`client_username`);

--
-- A tábla indexei `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_username`);

--
-- A tábla indexei `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_username`);

--
-- A tábla indexei `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`driver_id`),
  ADD UNIQUE KEY `dl_number` (`dl_number`),
  ADD KEY `client_username` (`client_username`);

--
-- A tábla indexei `rentedcars`
--
ALTER TABLE `rentedcars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_username` (`customer_username`),
  ADD KEY `car_id` (`car_id`),
  ADD KEY `driver_id` (`driver_id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `cars`
--
ALTER TABLE `cars`
  MODIFY `car_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT a táblához `driver`
--
ALTER TABLE `driver`
  MODIFY `driver_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT a táblához `rentedcars`
--
ALTER TABLE `rentedcars`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=574681291;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `clientcars`
--
ALTER TABLE `clientcars`
  ADD CONSTRAINT `clientcars_ibfk_1` FOREIGN KEY (`client_username`) REFERENCES `clients` (`client_username`),
  ADD CONSTRAINT `clientcars_ibfk_2` FOREIGN KEY (`car_id`) REFERENCES `cars` (`car_id`);

--
-- Megkötések a táblához `driver`
--
ALTER TABLE `driver`
  ADD CONSTRAINT `driver_ibfk_1` FOREIGN KEY (`client_username`) REFERENCES `clients` (`client_username`);

--
-- Megkötések a táblához `rentedcars`
--
ALTER TABLE `rentedcars`
  ADD CONSTRAINT `rentedcars_ibfk_1` FOREIGN KEY (`customer_username`) REFERENCES `customers` (`customer_username`),
  ADD CONSTRAINT `rentedcars_ibfk_2` FOREIGN KEY (`car_id`) REFERENCES `cars` (`car_id`),
  ADD CONSTRAINT `rentedcars_ibfk_3` FOREIGN KEY (`driver_id`) REFERENCES `driver` (`driver_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
