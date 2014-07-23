-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 23, 2014 at 10:51 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `marijuana`
--
CREATE DATABASE IF NOT EXISTS `marijuana` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `marijuana`;

-- --------------------------------------------------------

--
-- Table structure for table `buzz_types`
--

CREATE TABLE IF NOT EXISTS `buzz_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `buzz_types`
--

INSERT INTO `buzz_types` (`id`, `title`) VALUES
(1, 'Active'),
(2, 'Body High'),
(3, 'Cerebral'),
(4, 'Clean'),
(5, 'Couch Lock'),
(6, 'Creeper'),
(7, 'Immediate'),
(8, 'Medium'),
(9, 'Strong'),
(10, 'Weak');

-- --------------------------------------------------------

--
-- Table structure for table `effects`
--

CREATE TABLE IF NOT EXISTS `effects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `effects`
--

INSERT INTO `effects` (`id`, `title`) VALUES
(1, 'Aroused'),
(2, 'Creative'),
(3, 'Confusion'),
(4, 'Energetic'),
(5, 'Euphoric'),
(6, 'Focused'),
(7, 'Giggly'),
(8, 'Happy'),
(9, 'Hungry'),
(10, 'Relaxed'),
(11, 'Sleepy'),
(12, 'Talkative'),
(13, 'Tingly'),
(14, 'Uplifted'),
(15, 'Anxious'),
(16, 'Dizzy'),
(17, 'Dry Eyes'),
(18, 'Dry Mouth'),
(19, 'Headache'),
(20, 'Paranoid');

-- --------------------------------------------------------

--
-- Table structure for table `effectstrains`
--

CREATE TABLE IF NOT EXISTS `effectstrains` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `strain_id` int(11) NOT NULL,
  `effect_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `effect_ratings`
--

CREATE TABLE IF NOT EXISTS `effect_ratings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `strain_id` int(11) NOT NULL,
  `effect_id` int(11) NOT NULL,
  `rate` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `effect_ratings`
--

INSERT INTO `effect_ratings` (`id`, `user_id`, `strain_id`, `effect_id`, `rate`) VALUES
(1, 1, 1, 8, '1.75'),
(2, 1, 1, 10, '1.41'),
(5, 1, 1, 9, '2.45'),
(6, 1, 1, 1, '2.62'),
(7, 1, 1, 12, '2.75'),
(8, 1, 1, 4, '1.70'),
(10, 1, 1, 20, '1.70'),
(11, 1, 1, 2, '1.66'),
(13, 1, 1, 3, '1.41');

-- --------------------------------------------------------

--
-- Table structure for table `flavors`
--

CREATE TABLE IF NOT EXISTS `flavors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ftype_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `flavors`
--

INSERT INTO `flavors` (`id`, `ftype_id`, `title`) VALUES
(1, 0, 'Sweet'),
(2, 1, 'Blueberry'),
(3, 1, 'Strawberry'),
(4, 1, 'Grape'),
(5, 2, 'Orange'),
(6, 2, 'Lime'),
(7, 2, 'Grapefruit'),
(8, 2, 'Lemon'),
(9, 3, 'Pineapple'),
(10, 3, 'Mango'),
(11, 4, 'Apple'),
(12, 4, 'Pear'),
(13, 4, 'Peach'),
(14, 4, 'Apricot'),
(15, 5, 'Plum'),
(16, 6, 'Lavender'),
(17, 6, 'Rose'),
(18, 6, 'Violet'),
(19, 6, 'Honey'),
(20, 6, 'Earthy'),
(21, 7, 'Skunk'),
(22, 7, 'Blue Cheese'),
(23, 7, 'Cheese'),
(24, 7, 'Butter'),
(25, 8, 'Pine'),
(26, 8, 'Tea'),
(27, 8, 'Tobacco'),
(28, 9, 'Vanilla'),
(29, 9, 'Chestnut'),
(30, 9, 'Coffee'),
(31, 10, 'Tar'),
(32, 10, 'Ammonia'),
(33, 10, 'Diesel'),
(34, 10, 'Menthol'),
(35, 11, 'Sage'),
(36, 11, 'Mint'),
(37, 11, 'Pepper');

-- --------------------------------------------------------

--
-- Table structure for table `flavorstrains`
--

CREATE TABLE IF NOT EXISTS `flavorstrains` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `strain_id` int(11) NOT NULL,
  `flavor_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `flavor_types`
--

CREATE TABLE IF NOT EXISTS `flavor_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `flavor_types`
--

INSERT INTO `flavor_types` (`id`, `title`) VALUES
(1, 'Berry'),
(2, 'Citrus'),
(3, 'Tropical'),
(4, 'Tree Fruit'),
(5, 'Flowery'),
(6, 'Pungent'),
(7, 'Woody'),
(8, 'Nutty'),
(9, 'Chemical'),
(10, 'Spicy/Herbal');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city` varchar(255) NOT NULL,
  `state_province` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `overall_effect_ratings`
--

CREATE TABLE IF NOT EXISTS `overall_effect_ratings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `strain_id` int(11) NOT NULL,
  `effect_id` int(11) NOT NULL,
  `rate` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `overall_ratings`
--

CREATE TABLE IF NOT EXISTS `overall_ratings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `strain_id` int(11) NOT NULL,
  `rate` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `overall_symptom_ratings`
--

CREATE TABLE IF NOT EXISTS `overall_symptom_ratings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `strain_id` int(11) NOT NULL,
  `symptom_id` int(11) NOT NULL,
  `rate` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `strain_id` int(11) NOT NULL,
  `form` varchar(100) NOT NULL,
  `consumption` varchar(100) NOT NULL,
  `rate` float NOT NULL,
  `review` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `strain_id`, `form`, `consumption`, `rate`, `review`) VALUES
(1, 0, 0, 'raw', 'eat', 2.73, 'asasd asdasdas');

-- --------------------------------------------------------

--
-- Table structure for table `strains`
--

CREATE TABLE IF NOT EXISTS `strains` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `rating` float NOT NULL,
  `review` text NOT NULL,
  `extraction_raw` varchar(255) NOT NULL,
  `consumption` varchar(255) NOT NULL,
  `buzz_id` int(11) NOT NULL,
  `buzz_length` varchar(255) NOT NULL,
  `published_date` date NOT NULL,
  `slug` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `strains`
--

INSERT INTO `strains` (`id`, `type_id`, `name`, `description`, `rating`, `review`, `extraction_raw`, `consumption`, `buzz_id`, `buzz_length`, `published_date`, `slug`) VALUES
(1, 1, 'Purple Nepal', 'Purple Nepal is a cross between an original Nepalese strain and Lemon Thai. A happy, medium-level indica, this strain will not leave you stuck on the couch but is best used when you are looking to unwind at the end of the day. Sweet and flowery, Purple Nepal has a mellow, earthy grape taste that complements its almost completely purple leaves. This strain is easy to cultivate and typically flowers between 8 and 9 weeks. While it may be grown outdoors with some difficulty, it typically grows best and produces high yields when grown indoors.', 5, '1', 'extraction', 'Smoke', 1, 'Light Year', '2014-07-22', 'purple_nepal');

-- --------------------------------------------------------

--
-- Table structure for table `strain_images`
--

CREATE TABLE IF NOT EXISTS `strain_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `strain_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `strain_locations`
--

CREATE TABLE IF NOT EXISTS `strain_locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `strain_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `strain_types`
--

CREATE TABLE IF NOT EXISTS `strain_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `strain_types`
--

INSERT INTO `strain_types` (`id`, `title`, `description`) VALUES
(1, 'Indica', 'Indica'),
(2, 'Sativa', 'Sativa'),
(3, 'Hybrid', 'Hybrid');

-- --------------------------------------------------------

--
-- Table structure for table `symptoms`
--

CREATE TABLE IF NOT EXISTS `symptoms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `symptoms`
--

INSERT INTO `symptoms` (`id`, `title`) VALUES
(1, 'ADD/ADHD'),
(2, 'Alzheimer''s'),
(3, 'Anorexia'),
(4, 'Anxiety'),
(5, 'OCD'),
(6, 'Arthritis'),
(7, 'Asthma'),
(8, 'Bipolar Disorder'),
(9, 'Cachexia'),
(10, 'Cancer'),
(11, 'Crohn''s Disease'),
(12, 'Epilepsy'),
(13, 'Fibromyalgia'),
(14, 'Gastrointestinal Disorder'),
(15, 'Glaucoma'),
(16, 'HIV/AIDS'),
(17, 'Hypertension'),
(18, 'Migraines'),
(19, 'Multiple Sclerosis'),
(20, 'Muscular Dystrophy'),
(21, 'Parkinson''s'),
(22, 'Phantom Limb Pain'),
(23, 'PMS'),
(24, 'PTSD'),
(25, 'Spinal Cord Injury'),
(26, 'Tinnitus'),
(27, 'Tourette''s Syndrome'),
(28, 'Cramps'),
(29, 'Depression'),
(30, 'Eye Pressure'),
(31, 'Fatigue'),
(32, 'Headaches'),
(33, 'Inflammation'),
(34, 'Insomnia'),
(35, 'Lack Of Appetite'),
(36, 'Muscle Spasms'),
(37, 'Nausea'),
(38, 'Pain'),
(39, 'Seizures'),
(40, 'Spasticity'),
(41, 'Stress'),
(42, 'Anti-social'),
(43, 'Joint Pain');

-- --------------------------------------------------------

--
-- Table structure for table `symptomstrains`
--

CREATE TABLE IF NOT EXISTS `symptomstrains` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `strain_id` int(11) NOT NULL,
  `symptop_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `symptom_ratings`
--

CREATE TABLE IF NOT EXISTS `symptom_ratings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `strain_id` int(11) NOT NULL,
  `symptom_id` int(11) NOT NULL,
  `rate` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `symptom_ratings`
--

INSERT INTO `symptom_ratings` (`id`, `user_id`, `strain_id`, `symptom_id`, `rate`) VALUES
(6, 1, 1, 43, '3.25'),
(7, 1, 1, 8, '2.54'),
(8, 1, 1, 29, '4.25'),
(9, 1, 1, 3, '1.70'),
(10, 1, 1, 6, '1.58'),
(11, 1, 1, 4, '2.70'),
(12, 1, 1, 18, '2.62');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fbid` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `age_group` varchar(255) NOT NULL,
  `health` varchar(255) NOT NULL,
  `weight` varchar(255) NOT NULL,
  `years_of_experience` varchar(255) NOT NULL,
  `frequency` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fbid`, `username`, `email`, `password`, `nationality`, `gender`, `age_group`, `health`, `weight`, `years_of_experience`, `frequency`) VALUES
(1, '', 'warrior', 'warriorbik@gmail.com', 'warrior', 'asian', 'male', '51', 'average', '11', '11', 'rarely'),
(2, '', 'aasas', 'warriorbik1@gmail.com', 'aaaa', '', '', '', '', '', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
