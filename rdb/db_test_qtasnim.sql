-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 02, 2023 at 07:23 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_test_qtasnim`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_product`
--

CREATE TABLE `tb_product` (
  `product_id` int(4) NOT NULL,
  `product_name` varchar(200) DEFAULT NULL,
  `product_type` int(2) DEFAULT NULL,
  `stock` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_product`
--

INSERT INTO `tb_product` (`product_id`, `product_name`, `product_type`, `stock`) VALUES
(1, 'kopi', 1, 85),
(2, 'Teh', 1, 75),
(3, 'Pasta Gigi', 2, 70),
(4, 'Sabun Mandi', 2, 55),
(5, 'Sampo', 2, 70);

-- --------------------------------------------------------

--
-- Table structure for table `tb_sale`
--

CREATE TABLE `tb_sale` (
  `sale_id` int(4) NOT NULL,
  `product_id` int(4) DEFAULT NULL,
  `sale_date` date DEFAULT NULL,
  `sold` int(4) DEFAULT NULL,
  `stock` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_sale`
--

INSERT INTO `tb_sale` (`sale_id`, `product_id`, `sale_date`, `sold`, `stock`) VALUES
(1, 1, '2023-06-02', 10, 100),
(2, 2, '2023-06-02', 20, 100),
(3, 3, '2023-06-02', 20, 100),
(4, 4, '2023-06-02', 30, 100),
(5, 5, '2023-06-02', 25, 100),
(6, 1, '2023-06-02', 5, 90),
(7, 2, '2023-06-02', 5, 80),
(8, 3, '2023-06-02', 10, 80),
(9, 4, '2023-06-02', 15, 70),
(10, 5, '2023-06-02', 5, 75);

-- --------------------------------------------------------

--
-- Table structure for table `tb_type`
--

CREATE TABLE `tb_type` (
  `type_id` int(2) NOT NULL,
  `type_name` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_type`
--

INSERT INTO `tb_type` (`type_id`, `type_name`) VALUES
(1, 'Konsumsi'),
(2, 'Pembersih');

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_product`
-- (See below for the actual view)
--
CREATE TABLE `vw_product` (
`product_id` int(4)
,`product_name` varchar(200)
,`type_id` int(2)
,`type_name` varchar(200)
,`stock` int(2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_sale`
-- (See below for the actual view)
--
CREATE TABLE `vw_sale` (
`sale_id` int(4)
,`product_name` varchar(200)
,`type_id` int(2)
,`type_name` varchar(200)
,`sale_date` date
,`stock` int(4)
,`sold` int(4)
);

-- --------------------------------------------------------

--
-- Structure for view `vw_product`
--
DROP TABLE IF EXISTS `vw_product`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_product`  AS SELECT `p`.`product_id` AS `product_id`, `p`.`product_name` AS `product_name`, `t`.`type_id` AS `type_id`, `t`.`type_name` AS `type_name`, `p`.`stock` AS `stock` FROM (`tb_product` `p` left join `tb_type` `t` on(`p`.`product_type` = `t`.`type_id`))  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_sale`
--
DROP TABLE IF EXISTS `vw_sale`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_sale`  AS SELECT `s`.`sale_id` AS `sale_id`, `p`.`product_name` AS `product_name`, `p`.`type_id` AS `type_id`, `p`.`type_name` AS `type_name`, `s`.`sale_date` AS `sale_date`, `s`.`stock` AS `stock`, `s`.`sold` AS `sold` FROM (`tb_sale` `s` left join `vw_product` `p` on(`s`.`product_id` = `p`.`product_id`))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_product`
--
ALTER TABLE `tb_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `tb_sale`
--
ALTER TABLE `tb_sale`
  ADD PRIMARY KEY (`sale_id`);

--
-- Indexes for table `tb_type`
--
ALTER TABLE `tb_type`
  ADD PRIMARY KEY (`type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_product`
--
ALTER TABLE `tb_product`
  MODIFY `product_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_sale`
--
ALTER TABLE `tb_sale`
  MODIFY `sale_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_type`
--
ALTER TABLE `tb_type`
  MODIFY `type_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
