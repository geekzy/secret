-- phpMyAdmin SQL Dump
-- version 2.6.4-pl4
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Jan 06, 2008 at 08:00 PM
-- Server version: 5.0.16
-- PHP Version: 5.1.1
-- 
-- Database: `tulang`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `basis_aturan`
-- 

CREATE TABLE `basis_aturan` (
  `id` int(11) NOT NULL auto_increment,
  `penyakit` varchar(4) default NULL,
  `gejala1` varchar(4) default NULL,
  `gejala2` varchar(4) default NULL,
  `gejala3` varchar(4) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

-- 
-- Dumping data for table `basis_aturan`
-- 

INSERT INTO `basis_aturan` VALUES (1, 'P001', 'G001', 'G002', 'G003');
INSERT INTO `basis_aturan` VALUES (3, 'P001', 'G003', '-', 'G004');
INSERT INTO `basis_aturan` VALUES (4, 'P001', 'G004', 'G005', 'P001');
INSERT INTO `basis_aturan` VALUES (6, 'P002', 'G006', 'G007', 'G008');
INSERT INTO `basis_aturan` VALUES (7, 'P002', 'G008', 'G009', 'P002');
INSERT INTO `basis_aturan` VALUES (8, 'P003', 'G004', 'G010', 'G011');
INSERT INTO `basis_aturan` VALUES (9, 'P003', 'G011', '-', 'G012');
INSERT INTO `basis_aturan` VALUES (10, 'P003', 'G012', 'G016', 'G017');
INSERT INTO `basis_aturan` VALUES (11, 'P003', 'G017', '-', 'P003');
INSERT INTO `basis_aturan` VALUES (12, 'P004', 'G015', 'G014', 'G013');
INSERT INTO `basis_aturan` VALUES (13, 'P004', 'G013', '-', 'G004');
INSERT INTO `basis_aturan` VALUES (14, 'P004', 'G004', '-', 'G018');
INSERT INTO `basis_aturan` VALUES (15, 'P004', 'G018', 'G019', 'P004');
INSERT INTO `basis_aturan` VALUES (16, 'P005', 'G030', 'G020', 'G021');
INSERT INTO `basis_aturan` VALUES (17, 'P005', 'G021', '-', 'P005');
INSERT INTO `basis_aturan` VALUES (18, 'P006', 'G022', 'G023', 'G005');
INSERT INTO `basis_aturan` VALUES (19, 'P006', 'G005', '-', 'G024');
INSERT INTO `basis_aturan` VALUES (20, 'P006', 'G024', '-', 'G025');
INSERT INTO `basis_aturan` VALUES (21, 'P006', 'G025', 'G004', 'G026');
INSERT INTO `basis_aturan` VALUES (22, 'P006', 'G026', '-', 'G027');
INSERT INTO `basis_aturan` VALUES (23, 'P006', 'G027', 'G015', 'P006');
INSERT INTO `basis_aturan` VALUES (24, 'P007', 'G029', 'G027', 'G003');
INSERT INTO `basis_aturan` VALUES (25, 'P007', 'G003', '-', 'G025');
INSERT INTO `basis_aturan` VALUES (26, 'P007', 'G025', 'G031', 'P007');

-- --------------------------------------------------------

-- 
-- Table structure for table `forum_jawab`
-- 

CREATE TABLE `forum_jawab` (
  `id_jawab` int(11) NOT NULL auto_increment,
  `id_forum` int(11) NOT NULL default '0',
  `nama` varchar(255) NOT NULL default '',
  `email` varchar(255) NOT NULL default '',
  `komentar` text NOT NULL,
  `waktu` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id_jawab`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

-- 
-- Dumping data for table `forum_jawab`
-- 

INSERT INTO `forum_jawab` VALUES (18, 23, 'dewa', 'neng_jayuz@yahoo.com', 'hei penyusuuup...', '23-10-2007 ; 20:47:39');
INSERT INTO `forum_jawab` VALUES (16, 21, 'dewa', 'cahserang@yahoo.com', 'yupiiii', '15-11-2006 ; 20:03:48');
INSERT INTO `forum_jawab` VALUES (19, 24, 'dewa', 'pemula85@yahoo.com', 'bener ya q coba kalo mo jerit2...\r\ng papa ko seneng malah q ^_^', '11-12-2007 ; 08:19:44');

-- --------------------------------------------------------

-- 
-- Table structure for table `forum_tanya`
-- 

CREATE TABLE `forum_tanya` (
  `id_forum` int(11) NOT NULL auto_increment,
  `nama` varchar(255) NOT NULL default '',
  `email` varchar(255) NOT NULL default '',
  `judul` varchar(255) NOT NULL default '',
  `komentar` text NOT NULL,
  `waktu` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id_forum`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

-- 
-- Dumping data for table `forum_tanya`
-- 

INSERT INTO `forum_tanya` VALUES (23, 'inan', 'weduz_jenjen@ngusngus.com', 'saya lagi cuba', 'tr76 yrtr grftr', '23-10-2007 ; 20:46:18');
INSERT INTO `forum_tanya` VALUES (21, 'Patria jaya', 'jaya@patra.com', 'Mengolah limbah di Jogja', 'beberapa saat yang lalu, limbah yang ada di Jogja....', '20-08-2004 ; 10:46:27');
INSERT INTO `forum_tanya` VALUES (24, 'anita karla', 'anita@yahoo.com', 'coba dulu baru ngaku', '^_^', '11-12-2007 ; 08:17:06');

-- --------------------------------------------------------

-- 
-- Table structure for table `gejala`
-- 

CREATE TABLE `gejala` (
  `kode_gejala` varchar(4) NOT NULL default '',
  `nama_gejala` text NOT NULL,
  `probabilitas` float default NULL,
  PRIMARY KEY  (`kode_gejala`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `gejala`
-- 

INSERT INTO `gejala` VALUES ('G001', 'Nyeri dalam yang terlokalisasi disendi yang terkena', 0.9);
INSERT INTO `gejala` VALUES ('G002', 'Pemakaian sendi berlebihan dan hilang dengan istirahat', 0.6);
INSERT INTO `gejala` VALUES ('G003', 'Nyeri malam hari', 0.6);
INSERT INTO `gejala` VALUES ('G004', 'kekakuan sendi pada pagi hari', 0.7);
INSERT INTO `gejala` VALUES ('G005', 'mudah letih dan lemas', 0.7);
INSERT INTO `gejala` VALUES ('G006', 'kulit wajah dan kepala menebal', 0.4);
INSERT INTO `gejala` VALUES ('G007', 'dahi dan kulit kepala beralur-alur', 0.3);
INSERT INTO `gejala` VALUES ('G008', 'kulit wajah dan kepala biasanya berminyak', 0.8);
INSERT INTO `gejala` VALUES ('G009', 'keringat berlebihan terutama ditelapak tangan dan kaki', 0.7);
INSERT INTO `gejala` VALUES ('G010', 'jari seperti sosis (daktilitis)', 0.6);
INSERT INTO `gejala` VALUES ('G011', 'kuku berbergerigi', 0.9);
INSERT INTO `gejala` VALUES ('G012', 'kuku pitting', 0.4);
INSERT INTO `gejala` VALUES ('G013', 'nyeri sendi', 0.8);
INSERT INTO `gejala` VALUES ('G014', ' rasa hangat', 0.7);
INSERT INTO `gejala` VALUES ('G015', 'pembengkakan sendi', 0.9);
INSERT INTO `gejala` VALUES ('G016', 'penyulit mata meradang', 0.4);
INSERT INTO `gejala` VALUES ('G017', 'nyeri punggung bawah', 0.8);
INSERT INTO `gejala` VALUES ('G018', 'kekakuan sendi setelah istirahat', 0.5);
INSERT INTO `gejala` VALUES ('G019', 'kekakuan serta nyeri hilang setelah olahraga', 0.4);
INSERT INTO `gejala` VALUES ('G020', 'gerakan-gerakan tangan dan muka yang tidak diinginkan', 0.6);
INSERT INTO `gejala` VALUES ('G021', 'kelabilan emosi pada anak-anak', 0.3);
INSERT INTO `gejala` VALUES ('G022', 'hilangnya nafsu makan', 0.8);
INSERT INTO `gejala` VALUES ('G023', 'bobot badan menurun', 0.6);
INSERT INTO `gejala` VALUES ('G024', 'kadang-kadang demam', 0.6);
INSERT INTO `gejala` VALUES ('G025', 'keterbatasan gerak yang menimbulkan sakit', 0.4);
INSERT INTO `gejala` VALUES ('G026', 'nyeri pada gerak', 0.2);
INSERT INTO `gejala` VALUES ('G027', 'nyeri pada waktu istirahat', 0.2);
INSERT INTO `gejala` VALUES ('G028', 'pada stadium q dapat menyebabkan kecacatan', 0.9);
INSERT INTO `gejala` VALUES ('G029', 'nyeri yang tergantung pada cuaca', 0.6);
INSERT INTO `gejala` VALUES ('G030', 'Bunyi jantung berpindah-pindah', 0.6);
INSERT INTO `gejala` VALUES ('G031', 'Nyeri tiba-tiba', 0.6);

-- --------------------------------------------------------

-- 
-- Table structure for table `gejalapenyakit`
-- 

CREATE TABLE `gejalapenyakit` (
  `kd_penyakit` varchar(4) NOT NULL default '',
  `kd_gejala` varchar(4) NOT NULL default '',
  `prob` float default '0',
  `urut` int(2) default '0',
  KEY `NewIndex` (`kd_gejala`,`kd_penyakit`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `gejalapenyakit`
-- 

INSERT INTO `gejalapenyakit` VALUES ('P001', 'G001', 0.7, 1);
INSERT INTO `gejalapenyakit` VALUES ('P001', 'G002', 0.5, 2);
INSERT INTO `gejalapenyakit` VALUES ('P001', 'G003', 0.7, 3);
INSERT INTO `gejalapenyakit` VALUES ('P001', 'G004', 0.3, 4);
INSERT INTO `gejalapenyakit` VALUES ('P001', 'G005', 0.6, 5);
INSERT INTO `gejalapenyakit` VALUES ('P002', 'G006', 0.5, 1);
INSERT INTO `gejalapenyakit` VALUES ('P002', 'G008', 0.3, 3);
INSERT INTO `gejalapenyakit` VALUES ('P002', 'G007', 0.3, 2);
INSERT INTO `gejalapenyakit` VALUES ('P002', 'G009', 0.5, 4);
INSERT INTO `gejalapenyakit` VALUES ('P003', 'G004', 0.7, 4);
INSERT INTO `gejalapenyakit` VALUES ('P003', 'G010', 0.5, 5);
INSERT INTO `gejalapenyakit` VALUES ('P003', 'G011', 0.6, 6);
INSERT INTO `gejalapenyakit` VALUES ('P003', 'G012', 0.8, 7);
INSERT INTO `gejalapenyakit` VALUES ('P003', 'G016', 0.5, 8);
INSERT INTO `gejalapenyakit` VALUES ('P003', 'G017', 0.6, 9);
INSERT INTO `gejalapenyakit` VALUES ('P004', 'G015', 0.7, 1);
INSERT INTO `gejalapenyakit` VALUES ('P004', 'G014', 0.4, 2);
INSERT INTO `gejalapenyakit` VALUES ('P004', 'G013', 0.7, 3);
INSERT INTO `gejalapenyakit` VALUES ('P004', 'G004', 0.6, 4);
INSERT INTO `gejalapenyakit` VALUES ('P004', 'G018', 0.4, 5);
INSERT INTO `gejalapenyakit` VALUES ('P004', 'G019', 0.3, 6);
INSERT INTO `gejalapenyakit` VALUES ('P005', 'G030', 0.7, 1);
INSERT INTO `gejalapenyakit` VALUES ('P005', 'G020', 0.3, 2);
INSERT INTO `gejalapenyakit` VALUES ('P005', 'G021', 0.6, 3);
INSERT INTO `gejalapenyakit` VALUES ('P006', 'G022', 0.4, 1);
INSERT INTO `gejalapenyakit` VALUES ('P006', 'G023', 0.4, 2);
INSERT INTO `gejalapenyakit` VALUES ('P006', 'G005', 0.2, 5);
INSERT INTO `gejalapenyakit` VALUES ('P006', 'G001', 0.9, 6);
INSERT INTO `gejalapenyakit` VALUES ('P006', 'G025', 0.6, 7);
INSERT INTO `gejalapenyakit` VALUES ('P006', 'G026', 0.6, 8);
INSERT INTO `gejalapenyakit` VALUES ('P006', 'G027', 0.8, 9);
INSERT INTO `gejalapenyakit` VALUES ('P006', 'G015', 0.7, 10);
INSERT INTO `gejalapenyakit` VALUES ('P007', 'G029', 0.9, 1);
INSERT INTO `gejalapenyakit` VALUES ('P007', 'G027', 0.6, 9);
INSERT INTO `gejalapenyakit` VALUES ('P007', 'G025', 0.5, 7);
INSERT INTO `gejalapenyakit` VALUES ('P007', 'G031', 0.5, 10);

-- --------------------------------------------------------

-- 
-- Table structure for table `penyakit`
-- 

CREATE TABLE `penyakit` (
  `kode_penyakit` varchar(4) NOT NULL default '',
  `nama_penyakit` varchar(75) NOT NULL default '',
  `definisi` text,
  `keterangan` text,
  PRIMARY KEY  (`kode_penyakit`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `penyakit`
-- 

INSERT INTO `penyakit` VALUES ('P001', 'Osteoartritis', 'Osteaortritis disebut juga penyakit sendi degeneratif yang mencerminkan kegagalan sendi diartodial. Osteaortritis adalah penyakit sendi yang paling sering ditemukan. Faktor resiko tertinggi untuk osteaortritis adalah usia. Peningkatan progresif prevalensi osteaortritis dijumpai seiring dengan peningkatan usia. Selain itu, trauma besar dan penggunaan sendi secara berulang merupakan faktor resiko untuk osteaortritis. Kerusakan tulang rawan sendi dapat terjadi pada saat cedera atau sesudahnya. Pola keterlibatan sendi dipengaruhi oleh beban yang berkaitan dengan pekerjaan (vokasional) atau (avokasional) sebelumnya. Faktor resiko lain yang dapat menyebabkan osteaortritis adalah obesitas.', 'Terapi obat untuk osteaortritis antara lain adalah NSAID, krim kapsain dan injeksi intra (periartikularis proparat glukokortikoid). Sedangkan terapi fisis dapat dilakukan dengan cara apikasi panas untuk mengurangi kekakuan dan berendam air panas, artroplati sendi total (bedah penggantian sendi), olahraga, menurunkan berat badan untuk pasien obesitas dan istirahat disiang hari.');
INSERT INTO `penyakit` VALUES ('P002', 'Osteoartropati Hipertrofik', 'Osteoartropati hipertrofik terjadi dalam bentuk primer atau familial yang biasanya berawal pada masa kanak-kanak. Bentuk osteoartropati hipertrofik disebabkan oleh keganasan intra toraks, penyakit paru supuratif, penyakit jantung kongenital, dan berbagai penyakit lain.', 'Terapi obat untuk menangani penyakit tulang osteoartropati hipertrofik antara lain antibiotik, aspirin, obat anti inflamasi lain atau analgesik yang dapat membantu mengontrol gejala osteoartropati hipertrofik. Sedangkan untuk terapi fisis dapat dilakukan dengan pengangkatan atau kemotrapi terhadap tumor.');
INSERT INTO `penyakit` VALUES ('P003', 'Artritis Psoriatik', 'Artritis psosiatik adalah artritis peradangan kronik yang mengenai 5 sampai 8 persen pasien psoriasis. Penyakit tulang ini disebabkan oleh infeksi (virus), trauma, peningkatan imunitas seluler terhadap streptokokus, penurunan pengaktifan sel T penekan, komplek imun, atau kelainan fungsi leukosit polimorfonukleus (abnormal polymorphonuclear, PMN).', 'Terapi fisis yang dapat dilakukan untuk mengobati artritis psosiatik antara lain pendidikan pasien untuk mempertahankan kekuatan otot, sendi dan fungsi otot. Selain itu, dapat juga dilakukan dengan PUVA (psoralen ditambah radiasi UVA).\r\nSelain terapi fisis, artritis psosiatik juga dapat disembuhkan dengan terapi obat antara lain dengan glukokortikoid intra sendi, salisilat, kolisin oral, hidrosiklorokuin, sulfasalazin dan garam emas intra muskulus namun terapi yang paling utama adalah dengan NSAID (anti inflamasi nonsteroid).\r\n');
INSERT INTO `penyakit` VALUES ('P004', 'Artritis Perifer', 'Artritis perifer timbul pada 9 sampe 20 persen yang mempunyai penyakit radang usus. artritis perifer lebih besar kemungkinannya pada pasien penyakit usus besar dan pada pasien dengan komplikasi seperti abses, perianus, eritema, dan nodosum. Faktor utama penyebab artritis perifer adalah kekambuhan kelainan usus.', '');
INSERT INTO `penyakit` VALUES ('P005', 'Demam Reumatik', 'Demam reumatik adalah penyakit yang menyebabkan perubahan meradang terutama pada persendian besar, jantung, kulit, dan sistem syaraf pusat yang terlibat khususnya anak-anak dan orang dewasa muda. Kemungkinan besar penyakit ini disebabkan oleh suatu realisasi autoimun setelah sensibilisasi melawan antigen streptokokus tertentu', 'Untuk mengobati demam reumatik dapat digunakan antibiotik, contohnya pinisilin. Selain itu, dapat diobati dengan super dioksida dismutase (orgotein, peroxnorm) dan glukokortikoid.');
INSERT INTO `penyakit` VALUES ('P006', 'Artritis Reumatik', 'Artritis reumatik adalah penyakit yang dalam lingkup bahasa Jerman kebanyakan disebut sebagai poliortritis kronik (primer atau progredien) merupakan penyakit sistematik meradang kronik dan jaringan ikat. artritis reumatik disebabkan karena disposisi genetika bersama dengan penginfeksi sebagian besar dapat dipastikan adanya patogenesis autoimun. Diduga bahwa suatu bahan merugikan atau noksa misalnya bakteri, virus, gangguan-gangguan ketelapan atau mekanik menyebabkan reaksi-reaksi meradang, kerusakan sel dan atau pembebasan antigen.', 'Terapi obat yang dapat digunakan untuk menangani artritis reumatik antara lain autotigkikosa (aureotan), auro tiopoli peptida (aura-dexotin), natrium aurotiomalat (pauredon), auronofin (ridauva) untuk pemakaian oral, D-penisilamin (metal kaptase, trolokol), anti malaria, terutama kloroluia (peso chin)');
INSERT INTO `penyakit` VALUES ('P007', 'Artrosis Deformans', 'artrosis deformans mencakup penyakit-penyakit degenesis persediaan perifer. Penyakit ini disebabkan oleh gejala-gejala tak terpakainya tulang rawan persendian, seperti pembentukan serat berlebihan, cacat renelis, lubang dan pengecilan', 'Untuk pengobatan artrosis deformans diperlukan  saat terapi, baik terapi obat maupun terapi fisis. Untuk terapi obat yang mengandung ekstrak tulang rawan (aru malon), ester asam polisulfat,dengan mukopoli sakanda (arteparon), D-glukosaminsulfat (Dona 200-5).');

-- --------------------------------------------------------

-- 
-- Table structure for table `penyebab`
-- 

CREATE TABLE `penyebab` (
  `kode_penyebab` varchar(4) NOT NULL default '',
  `nama_penyebab` text,
  PRIMARY KEY  (`kode_penyebab`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `penyebab`
-- 

INSERT INTO `penyebab` VALUES ('S001', 'usia');
INSERT INTO `penyebab` VALUES ('S002', 'penggunaan sendi secara berulang ');
INSERT INTO `penyebab` VALUES ('S003', 'obesitas');
INSERT INTO `penyebab` VALUES ('S004', 'keganasan intra toraks');
INSERT INTO `penyebab` VALUES ('S005', 'penyakit paru supuratif');
INSERT INTO `penyebab` VALUES ('S006', 'penyakit jantung kongenital');
INSERT INTO `penyebab` VALUES ('S007', 'infeksi yang disebabkan virus');
INSERT INTO `penyebab` VALUES ('S008', 'Trauma');
INSERT INTO `penyebab` VALUES ('S009', 'peningkatan imunitas seluler terhadap streptokokus');
INSERT INTO `penyebab` VALUES ('S010', 'penurunan pengaktifan sel T ');
INSERT INTO `penyebab` VALUES ('S011', 'komplek imun');
INSERT INTO `penyebab` VALUES ('S012', 'kelainan fungsi leukosit polimorfonukleus (abnormal polymorphonuclear)');
INSERT INTO `penyebab` VALUES ('S013', 'kekambuhan kelainan usus');
INSERT INTO `penyebab` VALUES ('S014', 'realisasi autoimun setelah sensibilisasi melawan antigen streptokokus tertentu');
INSERT INTO `penyebab` VALUES ('S015', 'gangguan-gangguan ketelapan atau mekanik menyebabkan reaksi-reaksi meradang');
INSERT INTO `penyebab` VALUES ('S016', 'kerusakan sel dan atau pembebasan antigen');
INSERT INTO `penyebab` VALUES ('S017', 'pembentukan serat berlebihan');
INSERT INTO `penyebab` VALUES ('S018', 'cacat renelis');
INSERT INTO `penyebab` VALUES ('S019', 'lubang dan pengecilan');

-- --------------------------------------------------------

-- 
-- Table structure for table `penyebabpenyakit`
-- 

CREATE TABLE `penyebabpenyakit` (
  `kd_penyakit` varchar(4) NOT NULL default '',
  `kd_penyebab` varchar(4) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `penyebabpenyakit`
-- 

INSERT INTO `penyebabpenyakit` VALUES ('P001', 'S001');
INSERT INTO `penyebabpenyakit` VALUES ('P001', 'S002');
INSERT INTO `penyebabpenyakit` VALUES ('P001', 'S003');
INSERT INTO `penyebabpenyakit` VALUES ('P002', 'S004');
INSERT INTO `penyebabpenyakit` VALUES ('P002', 'S005');
INSERT INTO `penyebabpenyakit` VALUES ('P002', 'S006');
INSERT INTO `penyebabpenyakit` VALUES ('P003', 'S007');
INSERT INTO `penyebabpenyakit` VALUES ('P003', 'S008');
INSERT INTO `penyebabpenyakit` VALUES ('P003', 'S009');
INSERT INTO `penyebabpenyakit` VALUES ('P003', 'S010');
INSERT INTO `penyebabpenyakit` VALUES ('P003', 'S011');
INSERT INTO `penyebabpenyakit` VALUES ('P003', 'S012');
INSERT INTO `penyebabpenyakit` VALUES ('P004', 'S013');
INSERT INTO `penyebabpenyakit` VALUES ('P005', 'S014');
INSERT INTO `penyebabpenyakit` VALUES ('P006', 'S017');
INSERT INTO `penyebabpenyakit` VALUES ('P006', 'S015');
INSERT INTO `penyebabpenyakit` VALUES ('P007', 'S016');
INSERT INTO `penyebabpenyakit` VALUES ('P007', 'S018');
INSERT INTO `penyebabpenyakit` VALUES ('P007', 'S019');

-- --------------------------------------------------------

-- 
-- Table structure for table `solusi`
-- 

CREATE TABLE `solusi` (
  `kode_solusi` varchar(4) NOT NULL default '',
  `nama_solusi` text,
  PRIMARY KEY  (`kode_solusi`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `solusi`
-- 

INSERT INTO `solusi` VALUES ('T001', 'minum banyak cairan (baik air putih maupun jus buah)');
INSERT INTO `solusi` VALUES ('T002', 'digunakan tetes hidung yang mengandung larutan garam');
INSERT INTO `solusi` VALUES ('T003', 'menggunakan asetaminofen');
INSERT INTO `solusi` VALUES ('T004', 'obat anti-virus ribavirin');
INSERT INTO `solusi` VALUES ('T005', 'oksigen yang lembab dan obat-obatan untuk membuka saluran pernapasan');

-- --------------------------------------------------------

-- 
-- Table structure for table `solusipenyakit`
-- 

CREATE TABLE `solusipenyakit` (
  `kd_solusi` varchar(4) NOT NULL default '',
  `kd_penyakit` varchar(4) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `solusipenyakit`
-- 

INSERT INTO `solusipenyakit` VALUES ('T001', 'P001');
INSERT INTO `solusipenyakit` VALUES ('T002', 'P001');
INSERT INTO `solusipenyakit` VALUES ('T003', 'P001');
INSERT INTO `solusipenyakit` VALUES ('T004', 'P001');
INSERT INTO `solusipenyakit` VALUES ('T005', 'P001');

-- --------------------------------------------------------

-- 
-- Table structure for table `tamu`
-- 

CREATE TABLE `tamu` (
  `no_id` int(5) NOT NULL auto_increment,
  `nama` varchar(50) NOT NULL default '',
  `email` varchar(60) NOT NULL default '',
  `waktu` varchar(30) NOT NULL default '',
  `koment` text NOT NULL,
  PRIMARY KEY  (`no_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `tamu`
-- 

INSERT INTO `tamu` VALUES (1, 'heyu', 'ujrftj@fchf.hdd', '11-12-2007, 08:06:46', 'ftjrftjrf');
INSERT INTO `tamu` VALUES (2, 'ghg', 'jgsh@gfhsa.fgsa', '13-12-2007, 18:43:50', '&lt;b&gt;coba&lt;/b&gt;');

-- --------------------------------------------------------

-- 
-- Table structure for table `user`
-- 

CREATE TABLE `user` (
  `username` varchar(10) NOT NULL default '',
  `password` varchar(100) NOT NULL default '',
  `kode` varchar(5) NOT NULL default '',
  `nama` varchar(30) NOT NULL default '',
  `alamat` text NOT NULL,
  PRIMARY KEY  (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `user`
-- 

INSERT INTO `user` VALUES ('anita', '83349cbdac695f3943635a4fd1aaa7d0', 'user', 'anita karla', 'jl. Kalimantan');
INSERT INTO `user` VALUES ('aku', '3b31aae2787818ba209950b2edb35e01', 'pakar', 'dewa', 'alamat');
