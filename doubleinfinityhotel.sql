-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2015 at 09:10 PM
-- Server version: 5.6.17-log
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `doubleinfinityhotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `administratori`
--

CREATE TABLE IF NOT EXISTS `administratori` (
  `username` varchar(30) COLLATE utf8_slovenian_ci NOT NULL,
  `password` varchar(250) COLLATE utf8_slovenian_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_slovenian_ci NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `administratori`
--

INSERT INTO `administratori` (`username`, `password`, `email`) VALUES
('admin1', '7c6a180b36896a0a8c02787eeafb0e4c', 'zana@hotmail.com'),
('admin2', '6cb75f652a9b52798eb6cf2201057c73', 'admin@hotmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE IF NOT EXISTS `komentar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `novost` int(11) NOT NULL,
  `tekst` text COLLATE utf8_slovenian_ci NOT NULL,
  `autor` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `email` varchar(20) COLLATE utf8_slovenian_ci NOT NULL,
  `vrijeme` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `novost` (`novost`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci AUTO_INCREMENT=66 ;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`id`, `novost`, `tekst`, `autor`, `email`, `vrijeme`) VALUES
(63, 1, 'Ovo je odlično!Prezadovoljna sam!', 'Zana Tatar', 'zana_14t@hotmail.com', '2015-05-28 18:48:36'),
(64, 1, 'Hvala vam na obavještenju!', 'Lejla Sukman', 'lejla@hotmail.com', '2015-05-28 18:50:37');

-- --------------------------------------------------------

--
-- Table structure for table `novosti`
--

CREATE TABLE IF NOT EXISTS `novosti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naslov` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `slika` varchar(200) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `tekst` text COLLATE utf8_slovenian_ci NOT NULL,
  `autor` varchar(20) COLLATE utf8_slovenian_ci NOT NULL,
  `datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `novosti`
--

INSERT INTO `novosti` (`id`, `naslov`, `slika`, `tekst`, `autor`, `datum`) VALUES
(1, 'Noćno kupanje!', 'http://static.panoramio.com/photos/large/9200412.jpg', 'Otvaramo sezonu noćnog kupanja.Bazen će biti otvoren u toku noći, od 22:00 do 5:00 h.Uz, to pripremamo razne događaje u okviru hotelskebašte kao što su:nastupi poznatih pjevača, stand up komedije i razne igre.Piće i hrana će se nuditi po promotivnim cijenama.Moći ćete okustiti razne poznate koktele, kao i naše specijalitete.Rezervišite sebi mjesto, stol, stolicu ili ležajku.', 'Zerina Balic', '2015-05-26 20:13:12'),
(3, 'Hladno Pivo svira samo za Vas!', '', 'Poznati zagrebački rock bend, uveseljvat će Vas 25.06.2015 godine sa početkom u 21:00 h. U sklopu otvaranja ljetne sezone, odlučili smo se obradovati Vas odličnom svirkom. Ulaz je besplatan u bar je besplatan.Rezervisite svoje mjesto što prije!', 'Lejla Šukman', '2015-05-24 17:30:26');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
