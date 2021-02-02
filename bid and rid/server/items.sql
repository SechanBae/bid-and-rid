-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2020 at 05:23 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `000803348`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `itemid` int(11) NOT NULL,
  `itemname` varchar(25) NOT NULL,
  `description` varchar(50) NOT NULL,
  `seller` varchar(15) NOT NULL,
  `startingprice` decimal(10,2) NOT NULL,
  `highestbid` decimal(10,2) NOT NULL,
  `dateposted` date NOT NULL DEFAULT current_timestamp(),
  `highestbidder` varchar(15) DEFAULT NULL,
  `complete` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`itemid`, `itemname`, `description`, `seller`, `startingprice`, `highestbid`, `dateposted`, `highestbidder`, `complete`) VALUES
(2, 'test', 'some description blahblah', 'admin', '101.01', '266.00', '2020-12-13', 'test', 1),
(10, '213', '1231231', 'admin', '100.00', '102.00', '2020-12-13', 'test', 1),
(19, '23', '23', 'admin', '23.00', '23.20', '2020-12-13', 'ChanBae', 0),
(20, 'cup', 'cup 250ml', 'ChanBae', '10.00', '10.00', '2020-12-13', NULL, 0),
(21, 'bed', 'king sized bed', 'ChanBae', '250.00', '250.00', '2020-12-13', NULL, 0),
(22, 'earphones', 'Sony earphones wireless', 'ChanBae', '150.00', '150.00', '2020-12-13', NULL, 0),
(23, 'Laptop', 'Lenovo thinkpad', 'ChanBae', '500.00', '500.00', '2020-12-13', NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`itemid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `itemid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
