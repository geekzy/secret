-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 22, 2012 at 03:24 AM
-- Server version: 5.1.44
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `CMS`
--
CREATE DATABASE `CMS` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `CMS`;

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE IF NOT EXISTS `berita` (
  `idberita` int(5) NOT NULL AUTO_INCREMENT,
  `idkategori` int(5) NOT NULL,
  `iduser` varchar(50) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `isiberita` text NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `hari` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `counter` int(5) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idberita`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `berita`
--


-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `idkategori` int(5) NOT NULL AUTO_INCREMENT,
  `namakategori` varchar(50) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  PRIMARY KEY (`idkategori`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`idkategori`, `namakategori`, `keterangan`) VALUES
(1, 'Windows', 'Tentang segalam macam tetek bengek Sistem Operasi Windows'),
(2, 'Linux', 'Tentang segalam macam tetek bengek Sistem Operasi Linux'),
(3, 'Mac OSX', 'Tentang segalam macam tetek bengek Sistem Operasi Mac OSX');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `iduser` varchar(50) NOT NULL DEFAULT '',
  `username` varchar(13) DEFAULT NULL,
  `password` varchar(10) DEFAULT NULL,
  `namalengkap` varchar(30) DEFAULT NULL,
  `email` varchar(25) DEFAULT NULL,
  `level` varchar(25) NOT NULL DEFAULT 'user',
  PRIMARY KEY (`iduser`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`iduser`, `username`, `password`, `namalengkap`, `email`, `level`) VALUES
('001', 'Bayu', 'bayu', 'Bayu D. Nugroho ', 'bayu.nugro@gmail.com', 'Admin'),
('002', 'Eliyati', 'eliyati', 'Eliyati', 'eli.ibu@gmail.com', 'User'),
('003', 'Ogin', 'ogin', 'Syahrin Nuar Muqod', 'oginn12@yahoo.com', 'User');
