-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2014 at 04:53 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `php_dev`
--

-- --------------------------------------------------------

--
-- Table structure for table `web_users`
--

CREATE TABLE IF NOT EXISTS `web_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) CHARACTER SET latin1 NOT NULL,
  `password` varchar(64) CHARACTER SET latin1 NOT NULL,
  `salt` varchar(32) CHARACTER SET latin1 NOT NULL,
  `name` varchar(50) CHARACTER SET latin1 NOT NULL,
  `joined` datetime NOT NULL,
  `group` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `web_users`
--

INSERT INTO `web_users` (`id`, `username`, `password`, `salt`, `name`, `joined`, `group`) VALUES
(3, 'JMMM', '948cf1c8321d187886fc208136229075c777352362e5c1181636f8debd7bc6a2', 'John Manuel Maguigad'),
(4, 'Leilanie', 'd436e93da61ccbb33cdf4ff4702370fa69ba75fc532bb013d098ca17c677a4ef', 'Leilanie Ranola'),
(5, 'asdasdsad', 'd4d333ecf7c83118050f66ee9bfb1ee88d88b95901ef3ba3e8e781009a71da9f', 'asdasdasd'),
(6, 'jmmaguigad', 'eaa704dac347b7242ddac0a00f3c53556604e52249e3faf7558a8840bd9cc588', 'John Manuel Maguigad'),
(7, 'abraham', '42619f33861be3ec34c332bd1b208503867a881a20171177a6c550ccf3e90551', 'abraham'),
(8, 'judyann', '9605f2489cba60fe70d6dbdb83330f748c45e66040a7762d5eaa94b2841ab640', 'judyann');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
