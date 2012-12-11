# MySQL-Front 3.2  (Build 6.11)

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES 'latin1' */;

# Host: localhost    Database: ujian
# ------------------------------------------------------
# Server version 5.0.45-community-nt

DROP DATABASE IF EXISTS `ujian`;
CREATE DATABASE `ujian` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `ujian`;

#
# Table structure for table detiljual
#

CREATE TABLE `detiljual` (
  `nourutjual` int(10) NOT NULL default '0',
  `kodebarang` char(3) default NULL,
  `jumlahjual` int(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`nourutjual`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Dumping data for table detiljual
#


#
# Table structure for table masterbarang
#

CREATE TABLE `masterbarang` (
  `kodebarang` char(3) NOT NULL,
  `namabarang` varchar(50) default NULL,
  `stokbarang` int(5) unsigned default NULL,
  `satuanbarang` varchar(10) default NULL,
  `hargajualbarang` int(8) unsigned default NULL,
  PRIMARY KEY  (`kodebarang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Dumping data for table masterbarang
#


#
# Table structure for table masteruser
#

CREATE TABLE `masteruser` (
  `username` varchar(10) NOT NULL,
  `nama` varchar(50) default NULL,
  `password` varchar(255) default NULL,
  PRIMARY KEY  (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Dumping data for table masteruser
#


#
# Table structure for table penjualan
#

CREATE TABLE `penjualan` (
  `nourutjual` int(10) NOT NULL auto_increment,
  `tanggaljual` date NOT NULL,
  `totaljual` bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY  (`nourutjual`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Dumping data for table penjualan
#


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
