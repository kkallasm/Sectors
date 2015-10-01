-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Oct 01, 2015 at 08:41 PM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `helmes`
--

-- --------------------------------------------------------

--
-- Table structure for table `sectors`
--

CREATE TABLE `sectors` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=583 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sectors`
--

INSERT INTO `sectors` (`id`, `parent_id`, `name`, `level`) VALUES
(1, NULL, 'Manufacturing', 0),
(2, NULL, 'Service', 0),
(3, NULL, 'Other', 0),
(5, 1, 'Printing', 1),
(6, 1, 'Food and Beverage', 1),
(7, 1, 'Textile and Clothing', 1),
(8, 1, 'Wood', 1),
(9, 1, 'Plastic and Rubber', 1),
(11, 1, 'Metalworking', 1),
(12, 1, 'Machinery', 1),
(13, 1, 'Furniture', 1),
(18, 1, 'Electronics and Optics', 1),
(19, 1, 'Construction materials', 1),
(21, 2, 'Transport and Logistics', 1),
(22, 2, 'Tourism', 1),
(25, 2, 'Business services', 1),
(28, 2, 'Information Technology and Telecommunications', 1),
(29, 3, 'Energy technology', 1),
(33, 3, 'Environment', 1),
(35, 2, 'Engineering', 1),
(37, 3, 'Creative industries', 1),
(39, 6, 'Milk & dairy products', 2),
(40, 6, 'Meat & meat products', 2),
(42, 6, 'Fish & fish products', 2),
(43, 6, 'Beverages', 2),
(44, 7, 'Clothing', 2),
(45, 7, 'Textile', 2),
(47, 8, 'Wooden houses', 2),
(51, 8, 'Wooden building materials', 2),
(53, 559, 'Plastics welding and processing', 3),
(54, 9, 'Packaging', 2),
(55, 559, 'Blowing', 3),
(57, 559, 'Moulding', 3),
(62, 542, 'Forgings, Fasteners', 3),
(66, 542, 'MIG, TIG, Aluminum welding', 3),
(67, 11, 'Construction of metal structures', 2),
(69, 542, 'Gas, Plasma, Laser cutting', 3),
(75, 542, 'CNC-machining', 3),
(91, 12, 'Machinery equipment/tools', 2),
(93, 12, 'Metal structures', 2),
(94, 12, 'Machinery components', 2),
(97, 12, 'Maritime', 2),
(98, 13, 'Kitchen', 2),
(99, 13, 'Project furniture', 2),
(101, 13, 'Living room', 2),
(111, 21, 'Air', 2),
(112, 21, 'Road', 2),
(113, 21, 'Water', 2),
(114, 21, 'Rail', 2),
(121, 28, 'Software, Hardware', 2),
(122, 28, 'Telecommunications', 2),
(141, 2, 'Translation services', 1),
(145, 5, 'Labelling and packaging printing', 2),
(148, 5, 'Advertising', 2),
(150, 5, 'Book/Periodicals printing', 2),
(224, 12, 'Manufacture of machinery', 2),
(227, 12, 'Repair and maintenance service', 2),
(230, 97, 'Ship repair and conversion', 3),
(263, 11, 'Houses and buildings', 2),
(267, 11, 'Metal products', 2),
(269, 97, 'Boat/Yacht building', 3),
(271, 97, 'Aluminium and steel workboats', 3),
(337, 8, 'Other (Wood)', 2),
(341, 13, 'Outdoor', 2),
(342, 6, 'Bakery & confectionery products', 2),
(378, 6, 'Sweets & snack food', 2),
(385, 13, 'Bedroom', 2),
(389, 13, 'Bathroom/sauna', 2),
(390, 13, 'Children''s room', 2),
(392, 13, 'Office', 2),
(394, 13, 'Other (Furniture)', 2),
(437, 6, 'Other', 2),
(508, 12, 'Other', 2),
(542, 11, 'Metal works', 2),
(556, 9, 'Plastic goods', 2),
(559, 9, 'Plastic processing technology', 2),
(560, 9, 'Plastic profiles', 2),
(576, 28, 'Programming, Consultancy', 2),
(581, 28, 'Data processing, Web portals, E-marketing', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`) VALUES
(1, 'Test12');

-- --------------------------------------------------------

--
-- Table structure for table `user_sectors`
--

CREATE TABLE `user_sectors` (
  `user_id` int(11) NOT NULL,
  `sector_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_sectors`
--

INSERT INTO `user_sectors` (`user_id`, `sector_id`) VALUES
(1, 342),
(1, 43);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sectors`
--
ALTER TABLE `sectors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sectors`
--
ALTER TABLE `user_sectors`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `sector_id` (`sector_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sectors`
--
ALTER TABLE `sectors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=583;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_sectors`
--
ALTER TABLE `user_sectors`
  ADD CONSTRAINT `user_sectors_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_sectors_ibfk_2` FOREIGN KEY (`sector_id`) REFERENCES `sectors` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
