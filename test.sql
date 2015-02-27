-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2015 at 02:08 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `subject`, `description`) VALUES
(1, 'Mickey Mouse', 'mmouse@ucsd.edu', 'How can I make $500?', 'I need a place to live and $500.  Any ideas?'),
(2, 'Felix the Cat', 'fcat@kitty.com', 'Where can I get a mouse?', 'I''m hungry!'),
(3, 'Mickey Mouse', 'Mickey.Mouse@ucsd.edu', 'Where''s Minnie Mouse?', 'I''m trying to find my girlfriend.  Have you seen her?'),
(14, 'Speedy Gonzalez', 'sgonzalez@mouse.com', 'Looking for a new place to live.', 'I heard UCSD has nice places to live.  Are there any openings?');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE IF NOT EXISTS `service` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `unit` int(11) NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `note` text NOT NULL,
  `active` tinyint(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `name`, `unit`, `price`, `note`, `active`) VALUES
(1, 'New Mouse', 1, '500.00', 'Get me a shiny new mouse', 1),
(2, 'Feed Mouse - Cheese', 1, '1.25', 'Mice prefer Cheddar Cheese', 1),
(3, 'Feed Mouse - Sunflower Seeds', 5, '0.10', 'Feed Mouse Five Sunflower Seeds', 1),
(4, 'Clean Up Cage', 1, '10.00', 'Clean Cage.  Put in fresh bedding.', 1),
(5, 'New Cage', 1, '2000.00', 'These mice are special.  Get them a really nice cage.', 1),
(6, 'Relocate Mouse - Snake Food', 1, '3.00', 'Mouse is no longer useful.  Feed to snake.', 1),
(7, 'Kitty Cat', 2, '3.20', 'Get only rescue cats', 0),
(8, 'Mouse Wheel', 1, '5.50', 'Mice need exercise to stay in shape.  ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `service_request`
--

CREATE TABLE IF NOT EXISTS `service_request` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `service` int(11) NOT NULL,
  `request_date` varchar(255) NOT NULL,
  `complete_date` varchar(255) NOT NULL,
  `note` text NOT NULL,
  `index_nbr` int(11) NOT NULL,
  `bill_to` varchar(255) NOT NULL,
  `bill_address` varchar(255) NOT NULL,
  `bill_email` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service_request`
--

INSERT INTO `service_request` (`id`, `name`, `address`, `city`, `phone`, `email`, `service`, `request_date`, `complete_date`, `note`, `index_nbr`, `bill_to`, `bill_address`, `bill_email`) VALUES
(1, ' Minnie Mouse', 'Cage 1', 'La Jolla', '619-123-4567', 'minnie.mouse@ucsd.edu', 2, '02/23/2015', '02/24/2015', 'I prefer Gouda cheese.', 1, 'Mickey Mouse', 'Cage 2', 'mmouse@ucsd.edu'),
(13, 'Mel Nutter', '123 Main Street', 'San Diego', '858-254-0104', 'mel.nutter@outlook.com', 1, '02/26/2015', '03/05/2015', 'My cat is really hungry.  Please send a mouse to Felix.', 12345, 'Felix The Cat', 'Same house as Mel', 'fcat@kitty.com'),
(14, 'Stuart Little', 'Cage 15', 'La Jolla', '619-223-1400', 'slittle@mouse.con', 3, '02/27/2015', '02/28/2015', 'I''m having a party this weekend.  Please send sunflower seeds.', 4, 'UCSD', 'Extension Office', 'extension@ucsd.edu'),
(15, 'Mighty Mouse', 'Cage 22', 'La Jolla', '(619) 222-1277', 'iammighty@mouse.com', 6, '03/01/2015', '03/08/2015', 'I heard there is a snake eating mice.  Send the snake over.  I''ll beat him up.', 55, 'Snake Charmer', '14 Snake Charmer Way', 'scharmer@ucsd.edu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_request`
--
ALTER TABLE `service_request`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `service_request`
--
ALTER TABLE `service_request`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
