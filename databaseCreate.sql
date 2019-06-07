-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 07, 2019 at 08:44 AM
-- Server version: 5.7.25
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `CurrencyFair`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `currencyfrom_view`
-- (See below for the actual view)
--
CREATE TABLE `currencyfrom_view` (
`Total` bigint(21)
,`Country` text
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `currencyto_view`
-- (See below for the actual view)
--
CREATE TABLE `currencyto_view` (
`Total` bigint(21)
,`Country` text
);

-- --------------------------------------------------------

--
-- Table structure for table `MessageInformation`
--

CREATE TABLE `MessageInformation` (
  `RecordId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `CurrencyFrom` text NOT NULL,
  `CurrencyTo` text NOT NULL,
  `AmountSell` decimal(10,0) NOT NULL,
  `AmountBuy` decimal(10,0) NOT NULL,
  `Rate` decimal(5,4) NOT NULL,
  `TimePlaced` varchar(32) NOT NULL,
  `OriginatingCountry` text NOT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



-- --------------------------------------------------------

--
-- Stand-in structure for view `originatingcountry_view`
-- (See below for the actual view)
--
CREATE TABLE `originatingcountry_view` (
`Total` bigint(21)
,`Country` text
);

-- --------------------------------------------------------

--
-- Structure for view `currencyfrom_view`
--
DROP TABLE IF EXISTS `currencyfrom_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `currencyfrom_view`  AS  select count(`messageinformation`.`CurrencyFrom`) AS `Total`,`messageinformation`.`CurrencyFrom` AS `Country` from `messageinformation` group by `messageinformation`.`CurrencyFrom` ;

-- --------------------------------------------------------

--
-- Structure for view `currencyto_view`
--
DROP TABLE IF EXISTS `currencyto_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `currencyto_view`  AS  select count(`messageinformation`.`CurrencyTo`) AS `Total`,`messageinformation`.`CurrencyTo` AS `Country` from `messageinformation` group by `messageinformation`.`CurrencyTo` ;

-- --------------------------------------------------------

--
-- Structure for view `originatingcountry_view`
--
DROP TABLE IF EXISTS `originatingcountry_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `originatingcountry_view`  AS  select count(`messageinformation`.`OriginatingCountry`) AS `Total`,`messageinformation`.`OriginatingCountry` AS `Country` from `messageinformation` group by `messageinformation`.`OriginatingCountry` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `MessageInformation`
--
ALTER TABLE `MessageInformation`
  ADD PRIMARY KEY (`RecordId`),
  ADD KEY `CurrencyFrom_Index` (`CurrencyFrom`(3)),
  ADD KEY `OriginationCountry_index` (`OriginatingCountry`(3)),
  ADD KEY `CurrenctyTo_Index` (`CurrencyTo`(3)) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `MessageInformation`
--
ALTER TABLE `MessageInformation`
  MODIFY `RecordId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=334;
