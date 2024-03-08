-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2022 at 02:54 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `odp`
--

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `document` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `orgname` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `orgphone` varchar(50) NOT NULL,
  `ngo` varchar(20) NOT NULL,
  `approval` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `document`, `name`, `orgname`, `phone`, `orgphone`, `ngo`, `approval`) VALUES
(6, '../documents/sanjida.pdf', 'Sanjida Khatun', 'Happy Life Organization', '01763254891', '01325478964', 'sanjida', 1),
(7, '../documents/sharmin.pdf', 'Sharmin Jahan', 'Happy Life Organization', '01745896241', '01325478964', 'sharmin', 1),
(8, '../documents/mahfuz.pdf', 'Mahfuz Hasan', 'Happy Life Organization', '01732145897', '01325478964', 'mahfuz', 1),
(9, '../documents/farid.pdf', 'Farid Islam', 'Happy Life Organization', '01715975328', '01325478964', 'farid', 1);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `details` text NOT NULL,
  `target` float NOT NULL,
  `raised` float NOT NULL,
  `stype` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `time` datetime NOT NULL,
  `ngo` varchar(20) NOT NULL,
  `reason` text NOT NULL,
  `admin` varchar(20) NOT NULL,
  `notify` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `details`, `target`, `raised`, `stype`, `status`, `time`, `ngo`, `reason`, `admin`, `notify`) VALUES
(6, 'Poor people of Kabul, Afghanistan require emergency food.', 10000, 10200, 3, 'completed', '2022-01-26 17:21:40', 'sanjida', '', 'siam', '2022-01-26 20:04:40'),
(7, 'Two primary schools are needed to be built for ensuring education for free of cost in Afghanistan.', 50000, 840, 1, 'accepted', '2022-01-26 17:23:40', 'sanjida', '', 'nawshin', '2022-01-26 19:56:07'),
(8, 'Need USD 10000 to build a school in Nigeria.', 10000, 0, 2, 'rejected', '2022-01-26 17:31:28', 'sharmin', 'Please do not mention the donation amount directly in the request details.', 'siam', '2022-01-26 17:31:28'),
(10, 'Need donation.', 50000, 0, 2, 'rejected', '2022-01-26 18:54:59', 'mahfuz', 'Please mention the exact reason, location, and for whom the donation will be made, in your request details.', 'sohel', '2022-01-26 18:54:59'),
(11, 'We need to build two health clinics for deprived people near Nakuru, Kenya.', 45000, 5000, 1, 'accepted', '2022-01-26 19:00:47', 'sharmin', '', 'taifa', '2022-01-26 19:53:10'),
(12, 'Need donation for providing food for people in Mogadishu, Somalia.', 10000, 10500, 3, 'completed', '2022-01-26 19:03:11', 'mahfuz', '', 'taifa', '2022-01-26 20:00:15'),
(13, 'We need to establish two colleges to provide free education for all, in Marka, Somalia.', 50000, 3000, 1, 'accepted', '2022-01-26 19:04:59', 'mahfuz', '', 'taifa', '2022-01-26 19:51:20'),
(14, 'We need donations for helping to build two large hospitals in Nairobi, Kenya.', 70000, 2600, 1, 'accepted', '2022-01-26 19:16:10', 'sharmin', '', 'siam', '2022-01-29 18:18:17'),
(15, 'Donation needed to build three primary schools in Kassala, Sudan.', 80000, 1026, 1, 'accepted', '2022-01-26 19:20:30', 'sanjida', '', 'siam', '2022-01-26 19:56:51'),
(16, 'Need donations for building houses for more than a thousand poor people in Lamu, Kenya.', 100000, 2000, 1, 'accepted', '2022-01-26 19:23:18', 'sharmin', '', 'nawshin', '2022-01-26 19:48:41'),
(17, 'Donation needed to buy winter clothes for the deprived people in Nyala, Sudan.', 30000, 0, 0, 'pending', '2022-01-26 19:27:00', 'sanjida', '', '', '2022-01-26 19:27:00'),
(18, 'We need donations for building two medical centers in Khartoum, Sudan.', 50000, 0, 0, 'pending', '2022-01-26 19:30:10', 'sanjida', '', '', '2022-01-26 19:30:10'),
(20, 'Emergency donation needed for providing winter clothes to the people of Gulu, Uganda.', 10000, 1000, 1, 'accepted', '2022-01-29 19:24:41', 'farid', '', 'siam', '2022-01-29 19:44:08');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `request` int(11) NOT NULL,
  `amount` float NOT NULL,
  `donor` varchar(20) NOT NULL,
  `ngo` varchar(20) NOT NULL,
  `method` varchar(50) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `request`, `amount`, `donor`, `ngo`, `method`, `time`) VALUES
(13, 14, 600, 'salam', 'sharmin', 'nagad', '2022-01-26 19:43:05'),
(14, 12, 5000, 'adib', 'mahfuz', 'western-union', '2022-01-26 19:46:47'),
(15, 16, 2000, 'alif', 'sharmin', 'paypal', '2022-01-26 19:48:41'),
(16, 6, 3000, 'alif', 'sanjida', 'paypal', '2022-01-26 19:49:35'),
(17, 13, 3000, 'adib', 'mahfuz', 'western-union', '2022-01-26 19:51:20'),
(18, 11, 5000, 'adib', 'sharmin', 'western-union', '2022-01-26 19:53:10'),
(19, 7, 840, 'salam', 'sanjida', 'bkash', '2022-01-26 19:56:07'),
(20, 15, 1026, 'salam', 'sanjida', 'nagad', '2022-01-26 19:56:51'),
(21, 12, 5500, 'alif', 'mahfuz', 'paypal', '2022-01-26 20:00:15'),
(22, 6, 5000, 'adib', 'sanjida', 'western-union', '2022-01-26 20:02:18'),
(23, 6, 1000, 'alif', 'sanjida', 'paypal', '2022-01-26 20:03:05'),
(24, 6, 1200, 'salam', 'sanjida', 'bkash', '2022-01-26 20:04:40'),
(25, 14, 2000, 'adib', 'sharmin', 'western-union', '2022-01-29 18:18:17'),
(26, 20, 1000, 'robin', 'farid', 'paypal', '2022-01-29 19:44:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `type` int(11) NOT NULL,
  `role` varchar(20) NOT NULL,
  `approval` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `type`, `role`, `approval`) VALUES
(1, 'siam', 'siam.cse5.bu@gmail.com', '12345678', 1, 'admin', 0),
(2, 'taifa', 'taifa.cse5.bu@gmail.com', '12345678', 1, 'admin', 0),
(3, 'nawshin', 'nawshin.cse5.bu@gmail.com', '12345678', 1, 'admin', 0),
(4, 'salam', 'salam@yahoo.com', '123456', 3, 'donor', 0),
(5, 'sanjida', 'sanjida@gmail.com', '123456', 2, 'ngo', 2),
(7, 'sharmin', 'sharmin@gmail.com', '123456', 2, 'ngo', 2),
(8, 'alif', 'alif@yahoo.com', '123456', 3, 'donor', 0),
(10, 'adib', 'adib@outlook.com', '123456', 3, 'donor', 0),
(11, 'mahfuz', 'mahfuz@yahoo.com', '123456', 2, 'ngo', 2),
(12, 'sohel', 'sohel@gmail.com', '12345678', 1, 'admin', 0),
(14, 'jahid', 'jahid@yahoo.com', '12345678', 1, 'admin', 0),
(15, 'farid', 'farid@outlook.com', '123456', 2, 'ngo', 2),
(16, 'robin', 'robin@gmail.com', '123456', 3, 'donor', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
