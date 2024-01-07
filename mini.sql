-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2023 at 07:38 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mini`
--

-- --------------------------------------------------------

--
-- Table structure for table `retailer`
--

CREATE TABLE `retailer` (
  `sno` int(3) NOT NULL,
  `ret_name` varchar(20) NOT NULL,
  `shop_name` varchar(20) NOT NULL,
  `shop` varchar(255) DEFAULT NULL,
  `ret_add` varchar(50) NOT NULL,
  `ret_phn` varchar(10) NOT NULL,
  `ret_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `retailer`
--

INSERT INTO `retailer` (`sno`, `ret_name`, `shop_name`, `shop`, `ret_add`, `ret_phn`, `ret_type`) VALUES
(8, 'rishi saha', 'rishi store', NULL, 'jayashree', '7656596841', 'Grocery small'),
(9, 'Indrajit Prasad', 'Indrajit Store', NULL, 'ahmedabadas', '3216549855', 'Bakery C'),
(13, 'Tridip Saha', 'saha store', NULL, 'bangla', '7894561230', 'Grocery small');

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `email` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(15) NOT NULL,
  `conpassword` varchar(30) NOT NULL,
  `phn` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`email`, `username`, `password`, `conpassword`, `phn`) VALUES
('mitulrajrishi1999@gmail.com', '6128888', 'raj', '', '8895742922'),
('abx@gmail.com', 'asdfgh', 'qwerty', '', '1234567890'),
('mitulrajrishi1999@gmail.com', '789456', '556', '422', '4889456523'),
('raj@gmail.com', 'raj@', '455', '455', '6'),
('raj@gmail.com', 'raj@gmail.com', '464656', '6446464', '4664647897'),
('raj@gmail.com', 'raj@gmail.com', '464656', '6446464', '4664647897'),
('raj@gmail.com', 'raj@gmail.com', '464656', '6446464', '4664647897'),
('mitulrajrishi1999@gmail.com', 'raj', '123', '123', '8895742922');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `trans_id` int(4) NOT NULL,
  `sno` int(4) NOT NULL,
  `amount` decimal(8,0) NOT NULL,
  `date` date NOT NULL,
  `bill_no` varchar(15) NOT NULL,
  `trans_type` varchar(255) DEFAULT NULL,
  `remark` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`trans_id`, `sno`, `amount`, `date`, `bill_no`, `trans_type`, `remark`) VALUES
(6, 8, 342, '2023-12-20', '    BH1001SH', 'Credit', 'dgaga'),
(10, 9, 100, '2023-12-12', '  BL201', 'Credit', 'das'),
(11, 9, 50000, '2023-12-14', ' BH1001GH', 'Credit', 'cash'),
(15, 9, 2500, '2023-12-22', 'memo', 'Debit', 'cash');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `retailer`
--
ALTER TABLE `retailer`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`trans_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `retailer`
--
ALTER TABLE `retailer`
  MODIFY `sno` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `trans_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
