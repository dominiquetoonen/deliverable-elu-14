-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 20, 2018 at 11:18 PM
-- Server version: 5.6.38
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `deliverable`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `firstName` varchar(15) NOT NULL,
  `surNamePrefix` varchar(10) DEFAULT NULL,
  `surName` varchar(50) NOT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `mobile` varchar(11) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(64) NOT NULL,
  `loginCookie` varchar(64) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT NULL,
  `deletedAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `company_id`, `gender`, `firstName`, `surNamePrefix`, `surName`, `phone`, `mobile`, `email`, `password`, `loginCookie`, `createdAt`, `updatedAt`, `deletedAt`) VALUES
(21, NULL, 'male', 'Thijs', '', 'Karens', '0628449349', '0628449349', 'karens.thijs@gmail.com', '$2y$10$Q6B9KUDgvDxPmZHjtrb8y.3soTVGdno/aqLDfEoIJmPFM48Vy9bZ.', '3f4d1d4ac4e939b4a12605ee957b025e0e7719025e743901f0b7975b04a7c84f', '2018-06-20 21:14:23', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `account_role`
--

CREATE TABLE `account_role` (
  `account_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `street` varchar(50) NOT NULL,
  `houseNumber` int(11) NOT NULL,
  `houseNumberSuffix` varchar(10) DEFAULT NULL,
  `postcode` varchar(12) NOT NULL,
  `mailbox` int(11) DEFAULT NULL,
  `city` varchar(50) NOT NULL,
  `country` varchar(30) NOT NULL,
  `additionalInfo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `street`, `houseNumber`, `houseNumberSuffix`, `postcode`, `mailbox`, `city`, `country`, `additionalInfo`) VALUES
(1, 'Slotjesveld', 1, NULL, '4902ZP', NULL, 'Oosterhout', 'Nederland', NULL),
(2, 'Smederijstraat', 2, NULL, '4814DB', NULL, 'Breda', 'Nederland', NULL),
(3, 'Krijtenberg', 3, NULL, '4904PW', NULL, 'Oosterhout', 'Nederland', NULL),
(4, 'Lijndonk', 4, NULL, '4825BG', NULL, 'Breda', 'Nederland', NULL),
(5, 'Gilzeweg', 12, NULL, '4861AT', NULL, 'Chaam', 'Nederland', NULL),
(6, 'Mastenbroek', 17, NULL, '4822XG', NULL, 'Breda', 'Nederland', NULL),
(7, 'Boschstraat', 32, NULL, '4811GH', NULL, 'Breda', 'Nederland', NULL),
(8, 'Tielrodestraat', 37, NULL, '4826CM', NULL, 'Breda', 'Nederland', NULL),
(9, 'Speelhuislaan', 173, NULL, '4815CD', NULL, 'Breda', 'Nederland', NULL),
(10, 'Sterrebos', 191, NULL, '4817SE', NULL, 'Breda', 'Nederland', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `address_account`
--

CREATE TABLE `address_account` (
  `account_id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `attribute`
--

CREATE TABLE `attribute` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `value` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attribute`
--

INSERT INTO `attribute` (`id`, `name`, `value`) VALUES
(1, 'kleur', 'blauw'),
(2, 'kleur', 'rood'),
(3, 'kleur', 'wit'),
(4, 'kleur', 'geel'),
(5, 'kleur', 'zwart'),
(6, 'gram', '100'),
(7, 'gram', '200'),
(8, 'gram', '300'),
(9, 'aantal bladzijden', '300'),
(10, 'aantal bladzijden', '400'),
(11, 'aantal bladzijden', '500'),
(12, 'lengte cm', '10'),
(13, 'lengte cm', '20'),
(14, 'lengte cm', '30'),
(15, 'lengte cm', '40'),
(16, 'speelduur minuten', '60'),
(17, 'speelduur minuten', '90'),
(18, 'speelduur minuten', '120');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `cocNumber` int(11) NOT NULL,
  `vatNumber` varchar(14) NOT NULL,
  `website` varchar(50) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT NULL,
  `deletedAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `address_id`, `name`, `cocNumber`, `vatNumber`, `website`, `email`, `createdAt`, `updatedAt`, `deletedAt`) VALUES
(1, 1, 'JYSK', 34241425, 'NL812810788b01', 'jysk.nl', 'info@jyskbreda.nl', '2018-06-05 20:25:12', NULL, NULL),
(2, 2, 'MiKaa Kadoshop Breda', 29027869, 'NL812580788b01', NULL, 'info@mikaa.nl', '2018-06-05 20:25:12', NULL, NULL),
(3, 3, 'Jeffreys Schaar', 52281922, 'NL008174210B01', 'jeffreys-schaar.nl', 'info@jeffreys-schaar.nl', '2018-06-05 20:25:12', NULL, NULL),
(4, 4, 'Voet & Winkel', 17190314, 'NL004968748B01', 'voet-en-winkel.nl', 'info@voet-en-winkel.nl', '2018-06-05 20:25:12', NULL, NULL),
(5, 5, 'Santarello', 63885387, 'NL806425271B01', 'santarello.nl', 'info@santarello.nl', '2018-06-05 20:25:12', NULL, NULL),
(6, 6, 'Naron', 70211027, 'NL813264868B01', 'naron.nl', 'info@naron.nl', '2018-06-05 20:25:12', NULL, NULL),
(7, 7, 'Hello Design Classic', 70210292, 'NL160775796B01', 'hellodesign.nl', 'info@hellodesign.nl', '2018-06-05 20:25:12', NULL, NULL),
(8, 8, 'Loekz', 65915577, 'NL244298385B01', 'loekz.nl', 'info@loekz.nl', '2018-06-05 20:25:12', NULL, NULL),
(9, 9, 'Zusjes', 34194275, 'NL123104774B01', 'zusjes-breda.nl', 'info@zusjes-breda.nl', '2018-06-05 20:25:12', NULL, NULL),
(10, 10, 'Het Witgoedje', 34332256, 'NL001932706B01', NULL, 'hetwitgoedje@hotmail.com', '2018-06-05 20:25:12', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `company_product`
--

CREATE TABLE `company_product` (
  `company_id` int(11) NOT NULL,
  `product_id` varchar(13) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `price` double(6,2) NOT NULL,
  `instock` int(11) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deletedAt` timestamp NULL DEFAULT NULL,
  `updatedAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company_product`
--

INSERT INTO `company_product` (`company_id`, `product_id`, `status`, `price`, `instock`, `createdAt`, `deletedAt`, `updatedAt`) VALUES
(1, '0657258894020', 'niet beschikbaar', 149.95, 0, '2018-06-05 20:25:13', NULL, NULL),
(1, '4018653902578', 'beschikbaar', 21.99, 7, '2018-06-05 20:25:13', NULL, NULL),
(1, '4052025997731', 'beschikbaar', 89.95, 2, '2018-06-05 20:25:13', NULL, NULL),
(1, '4210201100713', 'beschikbaar', 49.95, 29, '2018-06-05 20:25:13', NULL, NULL),
(1, '8710126155738', 'beschikbaar', 15.95, 9, '2018-06-05 20:25:13', NULL, NULL),
(1, '8711983443488', 'beschikbaar', 23.95, 19, '2018-06-05 20:25:13', NULL, NULL),
(1, '9789024576791', 'beschikbaar', 9.99, 6, '2018-06-05 20:25:13', NULL, NULL),
(2, '4002432107421', 'beschikbaar', 4.99, 13, '2018-06-05 20:25:13', NULL, NULL),
(2, '4004218128996', 'beschikbaar', 8.95, 45, '2018-06-05 20:25:13', NULL, NULL),
(2, '4005556179343', 'beschikbaar', 5.95, 2, '2018-06-05 20:25:13', NULL, NULL),
(2, '4039784915916', 'beschikbaar', 125.95, 11, '2018-06-05 20:25:13', NULL, NULL),
(2, '4242002878676', 'beschikbaar', 199.00, 4, '2018-06-05 20:25:13', NULL, NULL),
(2, '8718637928278', 'niet beschikbaar', 7.95, 0, '2018-06-05 20:25:13', NULL, NULL),
(2, '9789024576791', 'beschikbaar', 8.00, 15, '2018-06-05 20:25:13', NULL, NULL),
(3, '3045388183416', 'niet beschikbaar', 12.95, 0, '2018-06-05 20:25:13', NULL, NULL),
(3, '4002432107421', 'beschikbaar', 4.95, 14, '2018-06-05 20:25:13', NULL, NULL),
(3, '4039784915916', 'beschikbaar', 112.00, 13, '2018-06-05 20:25:13', NULL, NULL),
(3, '8433228025500', 'beschikbaar', 399.49, 3, '2018-06-05 20:25:13', NULL, NULL),
(3, '8716404147754', 'beschikbaar', 14.95, 18, '2018-06-05 20:25:13', NULL, NULL),
(3, '8717953121301', 'beschikbaar', 114.95, 1, '2018-06-05 20:25:13', NULL, NULL),
(3, '9789021408101', 'beschikbaar', 14.99, 3, '2018-06-05 20:25:13', NULL, NULL),
(4, '0657258894020', 'niet beschikbaar', 139.95, 0, '2018-06-05 20:25:13', NULL, NULL),
(4, '3045388183416', 'beschikbaar', 12.95, 15, '2018-06-05 20:25:13', NULL, NULL),
(4, '4004218128996', 'beschikbaar', 7.95, 1, '2018-06-05 20:25:13', NULL, NULL),
(4, '4052025997731', 'niet beschikbaar', 79.95, 0, '2018-06-05 20:25:13', NULL, NULL),
(4, '4053858013599', 'beschikbaar', 49.95, 7, '2018-06-05 20:25:13', NULL, NULL),
(4, '5051888227855', 'niet beschikbaar', 16.95, 0, '2018-06-05 20:25:13', NULL, NULL),
(4, '8710126155738', 'beschikbaar', 14.95, 8, '2018-06-05 20:25:13', NULL, NULL),
(4, '9789021408101', 'beschikbaar', 13.99, 8, '2018-06-05 20:25:13', NULL, NULL),
(5, '4002432107421', 'beschikbaar', 3.99, 1, '2018-06-05 20:25:13', NULL, NULL),
(5, '4005556179343', 'beschikbaar', 5.99, 5, '2018-06-05 20:25:13', NULL, NULL),
(5, '4052025997731', 'beschikbaar', 79.95, 2, '2018-06-05 20:25:13', NULL, NULL),
(5, '4053858013599', 'niet beschikbaar', 44.95, 0, '2018-06-05 20:25:13', NULL, NULL),
(5, '5051888227855', 'beschikbaar', 21.95, 20, '2018-06-05 20:25:13', NULL, NULL),
(5, '8710103610779', 'beschikbaar', 49.95, 2, '2018-06-05 20:25:13', NULL, NULL),
(5, '8711983443488', 'beschikbaar', 26.95, 3, '2018-06-05 20:25:13', NULL, NULL),
(5, '8716404147754', 'beschikbaar', 12.95, 12, '2018-06-05 20:25:13', NULL, NULL),
(5, '9789024576791', 'beschikbaar', 12.00, 11, '2018-06-05 20:25:13', NULL, NULL),
(6, '4006381492881', 'beschikbaar', 12.95, 29, '2018-06-05 20:25:13', NULL, NULL),
(6, '4053858013599', 'beschikbaar', 59.95, 1, '2018-06-05 20:25:13', NULL, NULL),
(6, '4242002878676', 'niet beschikbaar', 189.00, 0, '2018-06-05 20:25:13', NULL, NULL),
(6, '5051888227855', 'niet beschikbaar', 19.99, 0, '2018-06-05 20:25:13', NULL, NULL),
(6, '8718475963363', 'beschikbaar', 499.00, 1, '2018-06-05 20:25:13', NULL, NULL),
(7, '3045388183416', 'beschikbaar', 12.95, 6, '2018-06-05 20:25:13', NULL, NULL),
(7, '3253922162005', 'beschikbaar', 39.95, 2, '2018-06-05 20:25:13', NULL, NULL),
(7, '8710126155738', 'beschikbaar', 12.95, 1, '2018-06-05 20:25:13', NULL, NULL),
(7, '8716404147754', 'beschikbaar', 10.95, 4, '2018-06-05 20:25:13', NULL, NULL),
(7, '8718475963363', 'beschikbaar', 449.00, 1, '2018-06-05 20:25:13', NULL, NULL),
(7, '8718637928278', 'beschikbaar', 6.95, 3, '2018-06-05 20:25:13', NULL, NULL),
(7, '9789024576791', 'beschikbaar', 10.00, 1, '2018-06-05 20:25:13', NULL, NULL),
(8, '4005556179343', 'beschikbaar', 6.49, 12, '2018-06-05 20:25:13', NULL, NULL),
(8, '4210201100713', 'beschikbaar', 51.00, 5, '2018-06-05 20:25:13', NULL, NULL),
(8, '4242002878676', 'beschikbaar', 219.95, 1, '2018-06-05 20:25:13', NULL, NULL),
(8, '5051888227855', 'beschikbaar', 19.95, 12, '2018-06-05 20:25:13', NULL, NULL),
(8, '8711983443488', 'beschikbaar', 22.99, 12, '2018-06-05 20:25:13', NULL, NULL),
(9, '3253922162005', 'beschikbaar', 38.95, 3, '2018-06-05 20:25:13', NULL, NULL),
(9, '4006381492881', 'beschikbaar', 13.95, 51, '2018-06-05 20:25:13', NULL, NULL),
(9, '4018653902578', 'beschikbaar', 21.95, 9, '2018-06-05 20:25:13', NULL, NULL),
(9, '4210201100713', 'beschikbaar', 44.95, 2, '2018-06-05 20:25:13', NULL, NULL),
(9, '8711983443488', 'beschikbaar', 28.95, 1, '2018-06-05 20:25:13', NULL, NULL),
(9, '9789024576791', 'beschikbaar', 7.00, 3, '2018-06-05 20:25:13', NULL, NULL),
(10, '3253922162005', 'beschikbaar', 39.95, 5, '2018-06-05 20:25:13', NULL, NULL),
(10, '4039784915916', 'beschikbaar', 119.95, 12, '2018-06-05 20:25:13', NULL, NULL),
(10, '4210201100713', 'beschikbaar', 49.99, 10, '2018-06-05 20:25:13', NULL, NULL),
(10, '4242002878676', 'beschikbaar', 149.95, 2, '2018-06-05 20:25:13', NULL, NULL),
(10, '8711983443488', 'beschikbaar', 27.95, 10, '2018-06-05 20:25:13', NULL, NULL),
(10, '8717953121301', 'niet beschikbaar', 114.95, 0, '2018-06-05 20:25:13', NULL, NULL),
(10, '9789021408101', 'beschikbaar', 15.99, 5, '2018-06-05 20:25:13', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `firstName` varchar(15) NOT NULL,
  `surNamePrefix` varchar(10) DEFAULT NULL,
  `surName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `mobile` varchar(11) DEFAULT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `company_id`, `firstName`, `surNamePrefix`, `surName`, `email`, `phone`, `mobile`, `type`) VALUES
(1, 1, 'Maarten', 'de', 'Kroon', 'm.dekroon@jyskbreda.nl', '076-4513587', '06-13587954', 'owner'),
(2, 1, 'Sofie', 'van', 'Hooft', 's.vanhooft@jyskbreda.nl', '076-4513586', '06-74932158', 'finance'),
(3, 2, 'Annelies', NULL, 'Manders', 'annelies@mikaa.nl', NULL, '06-87695123', 'owner'),
(4, 3, 'Femke', 'de', 'Vries', 'fdevries@jeffreys-schaar.nl', NULL, '06-87962148', 'other'),
(5, 4, 'Willemijn', NULL, 'Jansen', 'willemijnjansen@voet-en-winkel.nl', NULL, '06-98532647', 'owner'),
(6, 5, 'Jacques', NULL, 'Vermeulen', 'j.vermeulen@santarello.nl', '076-5894712', NULL, 'finance'),
(7, 6, 'John', 'van den', 'Heuvel', 'vandenheuvel@naron.nl', '076-9654123', '06-65478123', 'other'),
(8, 7, 'Karin', NULL, 'Wouters', 'k.wouters@hellodesign.nl', NULL, '06-98712546', 'owner'),
(9, 8, 'Patricia', 'van', 'Veen', 'pvanveen@loekz.nl', NULL, '06-87421658', 'finance'),
(10, 9, 'Cora', 'de', 'Winter', 'c.dewinter@zusjes-breda.nl', '076-9854123', NULL, 'owner'),
(11, 10, 'Dirk', 'van de', 'Plas', 'dvdplas@hotmail.com', '076-9654128', '06-86471256', 'owner');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ean` varchar(13) NOT NULL,
  `parent_id` varchar(13) DEFAULT NULL,
  `productCategory_id` int(11) NOT NULL,
  `productImage_Id` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `vat_type` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ean`, `parent_id`, `productCategory_id`, `productImage_Id`, `name`, `description`, `vat_type`) VALUES
('0657258894020', NULL, 8, NULL, 'Rockbros Skibri', 'Met deze modieuze skibril van ROCKBROS behoud je optimaal zicht tijdens het ski of snowboarden. De sferische lens met spiegelende coating filtert de felle zonnestralen en de UV400 anti-fog coating houden condensvorming tegen. Zo kan je in alle comfort ', 'h'),
('3045388183416', NULL, 3, NULL, 'Krups GVS241', 'Deze ijsmachine van Krups heeft een vermogen van 30 W. De ijsmachine heeft een koelbak en een ronddraaiende spatel voor schep- en softijs.', 'h'),
('3253922162005', NULL, 10, NULL, 'Curver Decobin ', 'De Curver Decobin pedaalemmer heeft de uitstraling van metaal en de voordelen van kunststof. Roest niet, deukt niet, is licht van gewicht, eenvoudig te reinigen en vingerafdrukken zijn niet zichtbaar. Naast het pedaal is de prullenbak ook voorzien van een', 'h'),
('4002432107421', NULL, 9, NULL, 'Leitz Style Met', 'Opvallende metalen nietmachine voor dagelijks gebruik, met een modern geborsteld oppervlakdesign en een geraffineerd kleurenscala: poolwit, granaatrood, zeegroen, titaniumblauw en satijnzwart. Robuust en betrouwbaar. De gepatenteerde Direct Impact Technol', 'h'),
('4004218128996', NULL, 12, NULL, 'Tetra Wafermix ', 'Uitgebalanceerd premiumvoer boordevol voedingsstoffen voor bodemvissen en kreeftachtigen\r\nMet garnalen voor gezonde groei Met spirulina-algen voor een hogere weerstand De vaste textuur van de wafeltjes voorkomt watervertroebeling', 'h'),
('4005556179343', NULL, 4, NULL, 'Ravensburger Sort your puzzle', 'Maak het puzzelen makkelijker! Met behulp van deze zes stapelbare sorteerbakjes. Sorteer alle puzzelstukjes gemakkelijk in deze bakjes. Geschikt voor kinderen vanaf 8 jaar.', 'h'),
('4006381492881', NULL, 9, NULL, 'STABILO BOSS OR', 'De belangrijkste dingen markeer je vanaf nu met vrolijke pastels!.De vertrouwde design klassieker is er nu ook in vrolijke pasteltinten Hoogste kwaliteit in materiaal, inkt en schrijfcomfort STABILO® Anti-Dry-Out Technology: vier uur zonder dop zond', 'h'),
('4018653902578', NULL, 12, NULL, 'Covalliero Paar', 'De universele paardrijbroek voor beginners is de perfecte keuze voor beginners en prijsbewuste consumenten! - nauwsluitende pasvorm met hoog draagcomfort door 4- weg elasticiteit - kuitsluiting met Velcro- klittenband - riemlussen en een tailleband met an', 'h'),
('4039784915916', NULL, 10, NULL, 'Karcher WV 2 Pr', 'Dankzij deze Karcher WV 2 Plus Ruitenreiniger heb je geen last meer van druppels en worden ramen makkelijker streeploos schoon. Bovendien is de Karcher Window Vac 2 flexibel in gebruik dankzij de duurzame accu. Dit model wordt geleverd met smalle zuigmond', 'h'),
('4052025997731', NULL, 11, NULL, 'Partytent feest', 'De zijwanden met 12 boogramen zijn oprolbaar indien nodig. Het paviljoen is voorzien van 4 verankerbare poten en een metalen constructie. Het dak - en zijbekleding is van waterafstotend materiaal. Het binnenframe is gemonteerd via beveiligde verbindingen.', 'h'),
('4053858013599', NULL, 7, NULL, 'Marc Jacobs', 'Marc Jacobs vrouwenhorloge. Dit horloge heeft een stalen horlogekast. De waterbestendigheid van het horloge is aangeduid als 5 ATM (Regen- & spatwaterdicht). Het horloge heeft daarnaast twee jaar garantie op het uurwerk.', 'h'),
('4210201100713', NULL, 6, NULL, 'Oral-B PRO 750', 'De Oral-B PRO 750 Black elektrische tandenborstel biedt een klinisch bewezen superieure reiniging in vergelijking met een gewone manuele tandenborstel. Het op professionele reinigingsinstrumenten geispireerde ontwerp van de CrossAction tandenborstelkop', 'h'),
('4242002878676', NULL, 3, NULL, 'Everglades EVOD', 'De Everglades EVOD207 Koelkast heeft een netto inhoud van 250 liter en valt in de energieklasse A+. Deze witte vrijstaande koelkast heeft 5 glazen planken waar al je etenswaren eenvoudig op gesorteerd kunnen worden. Door deze te plaatsen naast de Everglad', 'h'),
('5051888227855', NULL, 2, NULL, 'The Originals', 'Wanneer Klaus een bericht krijgt dat er iemand in New Orleans iets plant dat een bedreiging vormt, gaat hij samen met zijn broer en zus op onderzoek uit. Dit is de eerste keer dat ze weer in New Orleans zijn sinds 1919. Ze hebben de stad in feite', 'h'),
('8433228025500', NULL, 5, NULL, 'Concord REVERSO', 'REVERSO.PLUS i-Size Lengte: tot 105 cm Gewicht: tot 23 kg Leeftijd: ca. 4 jaar INNOVATIE OP HET GEBIED VAN ACHTERWAARTS GERICHTE AUTOSTOELEN: EXTREEM VEILIG, ERG LICHT Deze nieuwe achterwaartse autostoel van Concord is zeer veilig en extra licht', 'h'),
('8710103610779', NULL, 5, NULL, 'Philips Avent S', 'De Philips Avent DECT-babyfoon geeft je volledige gemoedsrust. Dankzij de betrouwbaarste verbinding in combinatie met rustgevende functies weet je zeker dat alles goed gaat met je baby. Dankzij de DECT-technologie ben je er zeker van dat andere', 'h'),
('8710126155738', NULL, 4, NULL, 'Jumbo Portapuzzle', 'De Jumbo Portapuzzle Deluxe is de perfecte puzzelaccessoire. De kunstleren map heeft een unieke binnenbekleding van plastic die de puzzelstukjes op hun plaats houdt en bovendien zeer geschikt is als ondergrond om op te puzzelen.Wanneer je het puzzelen', 'h'),
('8711983443488', NULL, 2, NULL, 'Blue Planet II', 'De afgelopen jaren heeft onze kennis van het leven in de oceanen zich spectaculair ontwikkeld. Blue Planet II, opvolger van de zeer succesvolle documentaireserie The Blue Planet, neemt de jongste doorbraken in wetenschap en technologie als uitgangspunt vo', 'h'),
('8716404147754', NULL, 8, NULL, 'Avento Basic Th', 'Heerlijk warm en comfortabel thermoshirt voor heren van Avento. Je draagt het thermoshirt direct op de huid zonder dat het strak zit. Door deze slim-fit pasvorm is het thermoshirt geschikt om te dragen bij intensieve activiteiten in wisselende weersomstan', 'h'),
('8717953121301', NULL, 6, NULL, 'BodyGauge Draad', 'De BodyGauge Bluetooth Smart Bloeddrukmeter is van hoge kwaliteit en zorgt voor een snelle en zeer nauwkeurige meting van jouw bloeddruk. De bloeddrukmeter kan als bloeddrukmeter worden gebruikt maar ook draadloos verbonden met je smartphone', 'h'),
('8718475963363', NULL, 11, NULL, 'vidaXL 17-delig', 'Deze rattan loungeset combineert stijl en functionaliteit, en zal het pronkstuk van uw tuin of terras worden. De meubelset is ontworpen om het hele jaar door buiten te worden gebruikt. Dankzij het weerbestendige en waterafstotende PE rattan is de loungese', 'h'),
('8718637928278', NULL, 7, NULL, 'Zak Horloge Kle', 'Mooi zakhorloge in de kleur brons.', 'h'),
('9789021408101', NULL, 1, NULL, 'Operatie Napoleon', 'Het Amerikaanse leger probeert stiekem een vliegtuigwrak te bergen op IJsland. Een jonge IJslander stuit op de operatie en verdwijnt. Vlak voor zijn verdwijning weet hij contact te leggen met zijn zus. Ze is vastbesloten de waarheid te achterhalen.', 'l'),
('9789024576791', NULL, 1, NULL, 'Oorsprong', 'Oorsprong is het nieuwe boek van Dan Brown, de populairste thrillerschrijver ter wereld. In Oorsprong houdt Robert Langdon zich bezig met de vragen: Waar komen wij vandaan en waar gaan wij naartoe? Het verhaal speelt zich af in Spanje: Madrid, Barcelona', 'l');

-- --------------------------------------------------------

--
-- Table structure for table `productCategory`
--

CREATE TABLE `productCategory` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `productCategory`
--

INSERT INTO `productCategory` (`id`, `parent_id`, `name`, `description`) VALUES
(1, NULL, 'Boeken', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis,'),
(2, NULL, 'Muziek & Film', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis,'),
(3, NULL, 'Elektronica', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis,'),
(4, NULL, 'Speelgoed', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis,'),
(5, NULL, 'Baby, Kind', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis,'),
(6, NULL, 'Mooi & Gezond', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis,'),
(7, NULL, 'Sieraden', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis,'),
(8, NULL, 'Vrije tijd', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis,'),
(9, NULL, 'Kantoor', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis,'),
(10, NULL, 'Wonen & Koken', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis,'),
(11, NULL, 'Tuin & Klussen', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis,'),
(12, NULL, 'Dier', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis,');

-- --------------------------------------------------------

--
-- Table structure for table `productImage`
--

CREATE TABLE `productImage` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `path` varchar(255) NOT NULL,
  `product_ean` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `productImage`
--

INSERT INTO `productImage` (`id`, `name`, `description`, `path`, `product_ean`) VALUES
(2, 'Oorsprong', 'cover', 'https://s.s-bol.com/imgbase0/imagebase3/regular/FC/3/0/4/2/9200000075752403.jpg', '9789024576791'),
(3, 'Operatie Napoleon', 'cover', 'https://s.s-bol.com/imgbase0/imagebase3/regular/FC/2/5/1/5/9200000079785152.jpg', '9789021408101'),
(4, 'The Originals', 'cover', 'https://s.s-bol.com/imgbase0/imagebase3/large/FC/4/7/7/5/9200000079695774.jpg', '5051888227855'),
(5, 'Blue Planet II', 'cover', 'https://s.s-bol.com/imgbase0/imagebase3/large/FC/4/0/5/5/9200000073695504.jpg', '8711983443488'),
(6, 'Krups GVS241', 'cover', 'https://s.s-bol.com/imgbase0/imagebase3/large/FC/1/0/0/5/9000000011035001.jpg', '3045388183416'),
(7, 'Everglades EVOD', 'cover', 'https://s.s-bol.com/imgbase0/imagebase3/large/FC/3/2/1/0/9200000055090123.jpg', '4242002878676'),
(8, 'Jumbo Portapuzzle', 'cover', 'https://s.s-bol.com/imgbase0/imagebase3/large/FC/4/0/9/5/1004004004575904.jpg', '8710126155738'),
(9, 'Ravensburger Sort your puzzle', 'cover', 'https://s.s-bol.com/imgbase0/imagebase3/large/FC/3/4/3/3/1004004013313343.jpg', '4005556179343'),
(10, 'Concord REVERSO', 'cover', 'https://s.s-bol.com/imgbase0/imagebase3/large/FC/7/7/9/9/9200000076469977.jpg', '8433228025500'),
(11, 'Philips Avent', 'cover', 'https://s.s-bol.com/imgbase0/imagebase3/large/FC/2/2/9/1/9200000020431922.jpg', '8710103610779'),
(12, 'Oral-B PRO 750', 'cover', 'https://s.s-bol.com/imgbase0/imagebase3/large/FC/3/4/3/5/9200000032845343.jpg', '4210201100713'),
(13, 'BodyGauge Draad', 'cover', 'https://s.s-bol.com/imgbase0/imagebase3/large/FC/1/6/7/4/9200000026074761.jpg', '8717953121301'),
(14, 'Marc Jacobs MBM', 'cover', 'https://s.s-bol.com/imgbase0/imagebase3/large/FC/9/6/2/5/9200000028635269.jpg', '4053858013599'),
(15, 'Zak Horloge', 'cover', 'https://s.s-bol.com/imgbase0/imagebase3/large/FC/4/2/9/0/9200000049820924.jpg', '8718637928278'),
(16, 'Avento Basic Th', 'cover', 'https://s.s-bol.com/imgbase0/imagebase3/large/FC/1/4/0/9/9200000035339041.jpg', '8716404147754'),
(17, 'Rockbros Skibri', 'cover', 'https://s.s-bol.com/imgbase0/imagebase3/large/FC/5/4/7/9/9200000086209745.jpg', '0657258894020'),
(18, 'STABILO BOSS OR', 'cover', 'https://s.s-bol.com/imgbase0/imagebase3/large/FC/3/5/2/3/9200000065663253.jpg', '4006381492881'),
(19, 'Leitz Style Met', 'cover', 'https://s.s-bol.com/imgbase0/imagebase3/large/FC/4/7/8/2/9200000057522874.jpg', '4002432107421'),
(20, 'Curver Decobin', 'cover', 'https://s.s-bol.com/imgbase0/imagebase3/large/FC/8/2/0/6/9200000002756028.jpg', '3253922162005'),
(21, 'Karcher WV 2 Pr', 'cover', 'https://s.s-bol.com/imgbase0/imagebase3/large/FC/5/6/7/9/9200000031839765.jpg', '4039784915916'),
(22, 'Partytent feest', 'cover', 'https://s.s-bol.com/imgbase0/imagebase3/large/FC/5/3/0/2/9200000080292035.jpg', '4052025997731'),
(23, 'vidaXL 17-delig', 'cover', 'https://s.s-bol.com/imgbase0/imagebase3/large/FC/7/2/0/6/9200000073106027.jpg', '8718475963363'),
(24, 'Covalliero Paar', 'cover', 'https://s.s-bol.com/imgbase0/imagebase3/large/FC/4/6/0/2/9200000057912064.jpg', '4018653902578'),
(25, 'Tetra Wafermix', 'cover', 'https://s.s-bol.com/imgbase0/imagebase3/large/FC/5/3/6/0/9200000010740635.jpg', '4004218128996');

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute`
--

CREATE TABLE `product_attribute` (
  `product_ean` varchar(13) NOT NULL,
  `attribute_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_attribute`
--

INSERT INTO `product_attribute` (`product_ean`, `attribute_id`) VALUES
('4039784915916', 1),
('4052025997731', 2),
('8710103610779', 2),
('9789024576791', 2),
('4004218128996', 3),
('4053858013599', 3),
('4005556179343', 5),
('4006381492881', 5),
('4210201100713', 5),
('4242002878676', 6),
('4018653902578', 7),
('5051888227855', 7),
('8433228025500', 8),
('0657258894020', 9),
('8710126155738', 9),
('3045388183416', 10),
('9789021408101', 11),
('8718637928278', 12),
('8718475963363', 13),
('8717953121301', 14),
('8716404147754', 15),
('3253922162005', 16),
('4002432107421', 17),
('8711983443488', 18);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'administrator'),
(2, 'company'),
(3, 'consumer');

-- --------------------------------------------------------

--
-- Table structure for table `vat`
--

CREATE TABLE `vat` (
  `type` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vat`
--

INSERT INTO `vat` (`type`) VALUES
('h'),
('l');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_company` (`company_id`);

--
-- Indexes for table `account_role`
--
ALTER TABLE `account_role`
  ADD PRIMARY KEY (`account_id`,`role_id`),
  ADD KEY `account_role_role` (`role_id`);

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `address_account`
--
ALTER TABLE `address_account`
  ADD PRIMARY KEY (`account_id`,`address_id`),
  ADD KEY `address_account_address` (`address_id`);

--
-- Indexes for table `attribute`
--
ALTER TABLE `attribute`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_address` (`address_id`);

--
-- Indexes for table `company_product`
--
ALTER TABLE `company_product`
  ADD PRIMARY KEY (`company_id`,`product_id`),
  ADD KEY `product_companyProduct` (`product_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contact_company` (`company_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ean`),
  ADD KEY `ProductCategory_product` (`productCategory_id`),
  ADD KEY `product_product` (`parent_id`),
  ADD KEY `product_vat` (`vat_type`);

--
-- Indexes for table `productCategory`
--
ALTER TABLE `productCategory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ProductCategory_ProductCategory` (`parent_id`);

--
-- Indexes for table `productImage`
--
ALTER TABLE `productImage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productImages_product` (`product_ean`);

--
-- Indexes for table `product_attribute`
--
ALTER TABLE `product_attribute`
  ADD PRIMARY KEY (`product_ean`,`attribute_id`),
  ADD KEY `product_attribute_attribute` (`attribute_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vat`
--
ALTER TABLE `vat`
  ADD PRIMARY KEY (`type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `attribute`
--
ALTER TABLE `attribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `productCategory`
--
ALTER TABLE `productCategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `productImage`
--
ALTER TABLE `productImage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_company` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`);

--
-- Constraints for table `account_role`
--
ALTER TABLE `account_role`
  ADD CONSTRAINT `account_role_account` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `account_role_role` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);

--
-- Constraints for table `address_account`
--
ALTER TABLE `address_account`
  ADD CONSTRAINT `address_account_account` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `address_account_address` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `company`
--
ALTER TABLE `company`
  ADD CONSTRAINT `company_address` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`);

--
-- Constraints for table `company_product`
--
ALTER TABLE `company_product`
  ADD CONSTRAINT `companyProduct_company` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_companyProduct` FOREIGN KEY (`product_id`) REFERENCES `product` (`ean`);

--
-- Constraints for table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contact_company` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `ProductCategory_product` FOREIGN KEY (`productCategory_id`) REFERENCES `productCategory` (`id`),
  ADD CONSTRAINT `product_product` FOREIGN KEY (`parent_id`) REFERENCES `product` (`ean`),
  ADD CONSTRAINT `product_vat` FOREIGN KEY (`vat_type`) REFERENCES `vat` (`type`) ON UPDATE CASCADE;

--
-- Constraints for table `productCategory`
--
ALTER TABLE `productCategory`
  ADD CONSTRAINT `ProductCategory_ProductCategory` FOREIGN KEY (`parent_id`) REFERENCES `productCategory` (`id`);

--
-- Constraints for table `productImage`
--
ALTER TABLE `productImage`
  ADD CONSTRAINT `productImages_product` FOREIGN KEY (`product_ean`) REFERENCES `product` (`ean`);

--
-- Constraints for table `product_attribute`
--
ALTER TABLE `product_attribute`
  ADD CONSTRAINT `product_attribute_attribute` FOREIGN KEY (`attribute_id`) REFERENCES `attribute` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_attribute_product` FOREIGN KEY (`product_ean`) REFERENCES `product` (`ean`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
