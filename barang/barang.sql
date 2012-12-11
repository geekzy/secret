# MySQL-Front 3.2  (Build 6.11)

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES 'latin1' */;

# Host: localhost    Database: mahasiswad3
# ------------------------------------------------------
# Server version 5.0.27-community-nt

DROP DATABASE IF EXISTS `mahasiswad3`;
CREATE DATABASE `mahasiswad3` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_general_ci */;
USE `mahasiswad3`;

#
# Table structure for table barang
#

CREATE TABLE `barang` (
  `kodebarang` varchar(5) NOT NULL,
  `namabarang` varchar(100) NOT NULL,
  `harga` float(10,0) NOT NULL,
  `persediaan` int(3) NOT NULL default '0',
  KEY `NewIndex` (`kodebarang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# Dumping data for table barang
#

INSERT INTO `barang` (`kodebarang`,`namabarang`,`harga`,`persediaan`) VALUES ('sssss','nokia 1200',1200000,4);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
