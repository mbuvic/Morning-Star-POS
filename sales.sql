-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2024 at 09:15 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sales`
--

-- --------------------------------------------------------

--
-- Table structure for table `collection`
--

CREATE TABLE `collection` (
  `transaction_id` int(11) NOT NULL,
  `date` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `invoice` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `balance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `membership_number` varchar(100) NOT NULL,
  `prod_name` varchar(550) NOT NULL,
  `expected_date` varchar(500) NOT NULL,
  `note` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `address`, `contact`, `membership_number`, `prod_name`, `expected_date`, `note`) VALUES
(15, 'Robert Thuo', '12', '0712345678', '', '', '', ''),
(16, 'Ngesh', '', '', '', '', '', ''),
(17, 'sdfg', '', '', '', '', '', ''),
(18, 'Tobia Mulwa', '', '', '', '', '', ''),
(19, '', '', '', '', '', '', ''),
(20, 'Charles Mbuvi', '', '', '', '', '', ''),
(21, 'Nelson', '', '', '', '', '', ''),
(22, 'Michael', '', '', '', '', '', ''),
(23, 'Devidson', '', '', '', '', '', ''),
(24, 'Allanamano', '', '', '', '', '', ''),
(25, 'hh', '', '', '', '', '', ''),
(26, 'Mercy', '', '', '', '', '', ''),
(27, 'Mutunga', '', '', '', '', '', ''),
(28, 'Customer', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_code` varchar(200) NOT NULL,
  `gen_name` varchar(200) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `cost` varchar(100) NOT NULL,
  `o_price` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `profit` varchar(100) NOT NULL,
  `supplier` varchar(100) NOT NULL,
  `onhand_qty` int(10) NOT NULL,
  `qty` int(10) NOT NULL,
  `qty_sold` int(10) NOT NULL,
  `expiry_date` varchar(500) NOT NULL,
  `date_arrival` varchar(500) NOT NULL,
  `b_code` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_code`, `gen_name`, `product_name`, `cost`, `o_price`, `price`, `profit`, `supplier`, `onhand_qty`, `qty`, `qty_sold`, `expiry_date`, `date_arrival`, `b_code`) VALUES
(60, 'HUA JUN TOOLS', 'Screw Set', ' Pocket precision screw driver set   ', '', '150', '300', '150', 'Excel Supplies', 0, 7, 30, '2031-06-17', '2023-09-12', '8562214521235'),
(61, 'STEAM', 'Energy Drink', ' Energy   ', '', '40', '50', '10', 'Excel Supplies', 0, 10, 23, '2024-01-30', '2023-09-12', '6161112464242'),
(63, 'Anthills of the Savannah', 'Anthills', ' Set Book', '', '500', '700', '200', 'Excel Supplies', 0, 1, 45, '2033-10-11', '2023-09-12', '9789966463753'),
(64, 'Test Product 01', 'Product 01', ' Product 01', '', '1000000', '1670000', '670000', 'Muthokinju Paints', 0, 2147483646, 90000000, '2032-06-08', '2023-10-05', '22');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `transaction_id` int(11) NOT NULL,
  `invoice_number` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `suplier` varchar(100) NOT NULL,
  `remarks` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchases_item`
--

CREATE TABLE `purchases_item` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `cost` varchar(100) NOT NULL,
  `invoice` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `transaction_id` int(11) NOT NULL,
  `invoice_number` varchar(100) NOT NULL,
  `cashier` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `profit` varchar(100) NOT NULL,
  `due_date` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `balance` varchar(100) NOT NULL,
  `pmethod` varchar(100) NOT NULL,
  `sdiscount` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`transaction_id`, `invoice_number`, `cashier`, `date`, `type`, `amount`, `profit`, `due_date`, `name`, `balance`, `pmethod`, `sdiscount`) VALUES
(142, 'RS-332328', 'Admin', '07/12/23', 'cash', '740', '240', '1000', 'Robert Thuo', '', '', 0),
(143, 'RS-33293007', 'Admin', '07/13/23', 'cash', '370', '120', '500', 'Ngesh', '', '', 0),
(144, 'RS-0333923', 'Cashier Pharmacy', '07/13/23', 'cash', '370', '120', '400', 'Ngesh', '', '', 0),
(145, 'RS-26222352', 'Cashier Pharmacy', '08/03/23', 'cash', '370', '120', '370', 'Ngesh', '', '', 0),
(146, 'RS-23626202', 'Admin', '08/03/23', 'cash', '370', '120', '390', 'sdfg', '', '', 0),
(147, 'RS-30232', 'Admin', '08/25/23', 'cash', '740', '240', '1000', 'Tobia Mulwa', '', '', 0),
(148, 'RS-3223482', 'Admin', '08/25/23', 'cash', '370', '120', '500', '', '', '', 0),
(149, 'RS-3302023', 'Admin', '08/25/23', 'cash', '30', '15', '50', '', '', '', 0),
(150, 'RS-3926282', 'Admin', '09/12/23', 'cash', '350', '160', '500', 'Charles Mbuvi', '', '', 0),
(151, 'RS-203280', 'Cashier Pharmacy', '09/12/23', 'cash', '50', '10', '50', 'Charles Mbuvi', '', '', 0),
(152, 'RS-907302', 'Admin', '09/12/23', 'cash', '650', '310', '1000', 'Charles Mbuvi', '', '', 0),
(153, 'RS-322330', 'Admin', '09/12/23', 'cash', '1550', '490', '2000', 'Charles Mbuvi', '', '', 0),
(154, 'RS-64706792', 'Admin', '09/12/23', 'cash', '3000', '1500', '3000', 'Nelson', '', '', 0),
(155, 'RS-2032223', 'Admin', '09/12/23', 'cash', '50', '10', '60', '', '', '', 0),
(156, 'RS-0386306', 'Admin', '09/12/23', 'cash', '1500', '570', '2000', '', '', '', 0),
(157, 'RS-0386306', 'Admin', '09/12/23', 'cash', '2550', '1050', '3000', '', '', '', 0),
(158, 'RS-22929322', 'Cashier Pharmacy', '09/12/23', 'cash', '50', '10', '50', '', '', '', 0),
(159, 'RS-33232760', 'Cashier Pharmacy', '09/12/23', 'cash', '600', '300', '1000', '', '', '', 0),
(160, 'RS-643209', 'Cashier Pharmacy', '09/12/23', 'cash', '1800', '810', '2000', '', '', '', 0),
(161, 'RS-5000380', 'Cashier Pharmacy', '09/12/23', 'cash', '1350', '360', '1500', 'Michael', '', '', 0),
(162, 'RS-043032', 'Cashier Pharmacy', '09/12/23', 'cash', '4400', '2050', '5000', '', '', '', 0),
(163, 'RS-4283093', 'Admin', '09/13/23', 'cash', '600', '300', '1000', '', '', '', 0),
(164, 'RS-43243332', 'Admin', '09/13/23', 'cash', '3200', '970', '3500', '', '', '', 0),
(165, 'RS-33320235', 'Charles Mbuvi', '09/13/23', 'cash', '700', '200', '700', '', '', '', 0),
(166, 'RS-33220232', 'Admin', '09/14/23', 'cash', '1350', '510', '1500', '', '', '', 0),
(167, 'RS-6832343', 'Admin', '09/17/23', 'cash', '50', '10', '100', '', '', '', 0),
(168, 'RS-00668320', 'Admin', '09/18/23', 'cash', '530', '300', '600', '', '', '', 0),
(169, 'RS-2330252', 'Admin', '09/18/23', 'cash', '980', '370', '1000', '', '', '', 0),
(170, 'RS-0233024', 'Admin', '09/18/23', 'cash', '50', '10', '100', '', '', '', 0),
(171, 'RS-2330099', 'Dennis Muema', '09/18/23', 'cash', '895', '', '1000', '', '', '', 0),
(172, 'RS-2334032', 'Admin', '09/19/23', 'cash', '600', '100', '600', '', '', '', 0),
(173, 'RS-28022272', 'Dennis Muema', '09/19/23', 'cash', '290', '140', '300', '', '', '', 0),
(174, 'RS-302282', 'Dennis Muema', '09/19/23', 'cash', '1645', '455', '2000', 'Robert Thuo', '', '', 0),
(175, 'RS-3003226', 'Admin', '09/19/23', 'cash', '50', '10', '100', '', '', '', 0),
(176, 'RS-39233', 'Admin', '09/20/23', 'cash', '50', '10', '50', '', '', '', 0),
(177, 'RS-0702', 'Admin', '09/20/23', 'cash', '50', '10', '100', 'Devidson', '', '', 0),
(178, 'RS-5302393', 'Admin', '09/20/23', 'cash', '750', '210', '1000', 'Allanamano', '', '', 0),
(179, 'RS-3733329', 'Admin', '09/20/23', 'cash', '980', '330', '1000', 'Charles Mbuvi', '', '', 0),
(180, 'RS-237090', 'Admin', '09/20/23', 'cash', '730', '190', '1000', 'Charles Mbuvi', '', '', 0),
(181, 'RS-2502333', 'Admin', '09/20/23', 'cash', '730', '190', '1000', 'hh', '', 'cash', 30),
(182, 'RS-3220393', 'Admin', '09/21/23', 'cash', '290', '140', '300', '', '', 'mpesa', 20),
(183, 'RS-322724', 'Admin', '09/21/23', 'cash', '690', '190', '1000', '', '', 'cash', 20),
(184, 'RS-2643052', 'Admin', '09/21/23', 'cash', '680', '180', '700', 'Michael', '', 'cash', 20),
(185, 'RS-82222', 'Admin', '09/21/23', 'cash', '600', '100', '1000', '', '', 'cash', 100),
(186, 'RS-3023222', 'Admin', '09/21/23', 'cash', '600', '100', '1000', 'Mercy', '', 'cash', 100),
(187, 'RS-032304', 'Admin', '09/21/23', 'cash', '690', '150', '1000', '', '', 'cash', 60),
(188, 'RS-2004033', 'Admin', '09/21/23', 'cash', '930', '280', '1000', 'Mutunga', '', 'cash', 70),
(189, 'RS-02902033', 'Admin', '09/21/23', 'cash', '550', '250', '1000', 'Mutunga', '', 'cash', 50),
(190, 'RS-04073', 'Admin', '09/21/23', 'cash', '50', '10', '70', '', '', 'cash', 0),
(191, 'RS-830424', 'Admin', '09/21/23', 'cash', '690', '150', '1000', '', '', 'cash', 60),
(192, 'RS-2000023', 'Admin', '09/21/23', 'cash', '900', '250', '100', '', '', 'cash', 100),
(193, 'RS-2000023', 'Admin', '09/21/23', 'cash', '900', '250', '1000', '', '', 'cash', 100),
(194, 'RS-2000023', 'Admin', '09/21/23', 'cash', '940', '250', '1000', '', '', 'cash', 110),
(195, 'RS-528303', 'Admin', '09/21/23', 'cash', '640', '100', '1000', '', '', 'cash', 110),
(196, 'RS-765233', 'Admin', '09/21/23', 'cash', '50', '10', '200', '', '', 'mpesa', 0),
(197, 'RS-023208', 'Admin', '09/21/23', 'cash', '1540', '350', '2000', 'Customer', '', 'Cash', 210),
(198, 'RS-9302580', 'Admin', '09/21/23', 'cash', '650', '150', '650', 'Customer', '', 'Mpesa', 50),
(199, 'RS-7327233', 'Admin', '09/21/23', 'cash', '50', '10', '50', '', '', 'Mpesa', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sales_order`
--

CREATE TABLE `sales_order` (
  `transaction_id` int(11) NOT NULL,
  `invoice` varchar(100) NOT NULL,
  `product` varchar(100) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `profit` varchar(100) NOT NULL,
  `product_code` varchar(150) NOT NULL,
  `gen_name` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `price` varchar(100) NOT NULL,
  `discount` varchar(100) NOT NULL,
  `date` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sales_order`
--

INSERT INTO `sales_order` (`transaction_id`, `invoice`, `product`, `qty`, `amount`, `profit`, `product_code`, `gen_name`, `name`, `price`, `discount`, `date`) VALUES
(504, 'RS-82222', '63', '1', '650', '150', 'Anthills of the Savannah', 'Anthills', ' Set Book', '700', '50', '09/21/23'),
(505, 'RS-3023222', '63', '1', '650', '150', 'Anthills of the Savannah', 'Anthills', ' Set Book', '700', '50', '09/21/23'),
(506, 'RS-032304', '63', '1', '700', '200', 'Anthills of the Savannah', 'Anthills', ' Set Book', '700', '00', '09/21/23'),
(507, 'RS-032304', '61', '1', '40', '0', 'STEAM', 'Energy Drink', ' Energy   ', '50', '10', '09/21/23'),
(508, 'RS-2004033', '60', '1', '300', '150', 'HUA JUN TOOLS', 'Screw Set', ' Pocket precision screw driver set   ', '300', '00', '09/21/23'),
(509, 'RS-2004033', '63', '1', '650', '150', 'Anthills of the Savannah', 'Anthills', ' Set Book', '700', '50', '09/21/23'),
(510, 'RS-02902033', '60', '1', '290', '140', 'HUA JUN TOOLS', 'Screw Set', ' Pocket precision screw driver set   ', '300', '10', '09/21/23'),
(511, 'RS-02902033', '60', '1', '300', '150', 'HUA JUN TOOLS', 'Screw Set', ' Pocket precision screw driver set   ', '300', '00', '09/21/23'),
(512, 'RS-04073', '61', '1', '50', '10', 'STEAM', 'Energy Drink', ' Energy   ', '50', '00', '09/21/23'),
(513, 'RS-830424', '61', '1', '40', '0', 'STEAM', 'Energy Drink', ' Energy   ', '50', '10', '09/21/23'),
(514, 'RS-830424', '63', '1', '700', '200', 'Anthills of the Savannah', 'Anthills', ' Set Book', '700', '00', '09/21/23'),
(515, 'RS-2000023', '60', '1', '300', '150', 'HUA JUN TOOLS', 'Screw Set', ' Pocket precision screw driver set   ', '300', '00', '09/21/23'),
(516, 'RS-2000023', '63', '1', '650', '150', 'Anthills of the Savannah', 'Anthills', ' Set Book', '700', '50', '09/21/23'),
(517, 'RS-2000023', '61', '1', '40', '0', 'STEAM', 'Energy Drink', ' Energy   ', '50', '10', '09/21/23'),
(518, 'RS-528303', '61', '1', '40', '0', 'STEAM', 'Energy Drink', ' Energy   ', '50', '10', '09/21/23'),
(519, 'RS-528303', '63', '1', '650', '150', 'Anthills of the Savannah', 'Anthills', ' Set Book', '700', '50', '09/21/23'),
(520, 'RS-765233', '61', '1', '50', '10', 'STEAM', 'Energy Drink', ' Energy   ', '50', '00', '09/21/23'),
(521, 'RS-023208', '60', '1', '290', '140', 'HUA JUN TOOLS', 'Screw Set', ' Pocket precision screw driver set   ', '300', '10', '09/21/23'),
(522, 'RS-023208', '63', '1', '650', '150', 'Anthills of the Savannah', 'Anthills', ' Set Book', '700', '50', '09/21/23'),
(523, 'RS-023208', '61', '1', '50', '10', 'STEAM', 'Energy Drink', ' Energy   ', '50', '00', '09/21/23'),
(524, 'RS-023208', '63', '1', '600', '100', 'Anthills of the Savannah', 'Anthills', ' Set Book', '700', '100', '09/21/23'),
(525, 'RS-9302580', '63', '1', '700', '200', 'Anthills of the Savannah', 'Anthills', ' Set Book', '700', '00', '09/21/23'),
(526, 'RS-7327233', '61', '1', '50', '10', 'STEAM', 'Energy Drink', ' Energy   ', '50', '00', '09/21/23'),
(529, 'RS-2323022', '61', '1', '50', '10', 'STEAM', 'Energy Drink', ' Energy   ', '50', '', '09/22/23'),
(531, 'RS-230033', '61', '1', '50', '10', 'STEAM', 'Energy Drink', ' Energy   ', '50', '00', '10/05/23'),
(544, 'RS-02300320', '64', '1', '1670000', '670000', 'Test Product 01', 'Product 01', ' Product 01', '1670000', '00', '10/05/23');

-- --------------------------------------------------------

--
-- Table structure for table `supliers`
--

CREATE TABLE `supliers` (
  `suplier_id` int(11) NOT NULL,
  `suplier_name` varchar(100) NOT NULL,
  `suplier_address` varchar(100) NOT NULL,
  `suplier_contact` varchar(100) NOT NULL,
  `contact_person` varchar(100) NOT NULL,
  `note` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `supliers`
--

INSERT INTO `supliers` (`suplier_id`, `suplier_name`, `suplier_address`, `suplier_contact`, `contact_person`, `note`) VALUES
(5, 'Excel Supplies', '12 Kithyoko', 'Derrick Ngoma', '0701298273', 'Excel Industries Mwingi'),
(6, 'Muthokinju Paints', '12', '070129129', 'robinson', 'Paint supliers');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `name`, `position`) VALUES
(1, 'admin', 'admin', 'Admin', 'admin'),
(2, 'cashier', 'cashier', 'Charles Mbuvi', 'cashier'),
(3, 'admin', 'admin123', 'Administrator', 'admin'),
(4, 'Dennis', 'Dennis', 'Dennis Muema', 'cashier');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `collection`
--
ALTER TABLE `collection`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `purchases_item`
--
ALTER TABLE `purchases_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `sales_order`
--
ALTER TABLE `sales_order`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `supliers`
--
ALTER TABLE `supliers`
  ADD PRIMARY KEY (`suplier_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `collection`
--
ALTER TABLE `collection`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `purchases_item`
--
ALTER TABLE `purchases_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- AUTO_INCREMENT for table `sales_order`
--
ALTER TABLE `sales_order`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=547;

--
-- AUTO_INCREMENT for table `supliers`
--
ALTER TABLE `supliers`
  MODIFY `suplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
