-- phpMyAdmin SQL Dump
-- version 2.11.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 27, 2010 at 12:03 AM
-- Server version: 5.0.45
-- PHP Version: 5.2.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `basis_aturan`
--

INSERT INTO `basis_aturan` (`id`, `penyakit`, `gejala1`, `gejala2`, `gejala3`) VALUES
(1, 'P001', 'G001', 'G002', 'G003'),
(3, 'P001', 'G003', '-', 'G004'),
(4, 'P001', 'G004', 'G005', 'P001'),
(6, 'P002', 'G006', 'G007', 'G008'),
(7, 'P002', 'G008', 'G009', 'P002'),
(8, 'P003', 'G004', 'G010', 'G011'),
(9, 'P003', 'G011', '-', 'G012'),
(10, 'P003', 'G012', 'G016', 'G017'),
(11, 'P003', 'G017', '-', 'P003'),
(12, 'P004', 'G015', 'G014', 'G013'),
(13, 'P004', 'G013', '-', 'G004'),
(14, 'P004', 'G004', '-', 'G018'),
(15, 'P004', 'G018', 'G019', 'P004'),
(16, 'P005', 'G030', 'G020', 'G021'),
(17, 'P005', 'G021', '-', 'P005'),
(18, 'P006', 'G022', 'G023', 'G005'),
(19, 'P006', 'G005', '-', 'G024'),
(20, 'P006', 'G024', '-', 'G025'),
(21, 'P006', 'G025', 'G004', 'G026'),
(22, 'P006', 'G026', '-', 'G027'),
(23, 'P006', 'G027', 'G015', 'P006'),
(24, 'P007', 'G029', 'G027', 'G003'),
(25, 'P007', 'G003', '-', 'G025'),
(26, 'P007', 'G025', 'G031', 'P007');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `forum_jawab`
--

INSERT INTO `forum_jawab` (`id_jawab`, `id_forum`, `nama`, `email`, `komentar`, `waktu`) VALUES
(18, 23, 'dewa', 'neng_jayuz@yahoo.com', 'hei penyusuuup...', '23-10-2007 ; 20:47:39'),
(16, 21, 'dewa', 'cahserang@yahoo.com', 'yupiiii', '15-11-2006 ; 20:03:48'),
(19, 24, 'dewa', 'pemula85@yahoo.com', 'bener ya q coba kalo mo jerit2...\r\ng papa ko seneng malah q ^_^', '11-12-2007 ; 08:19:44');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `forum_tanya`
--

INSERT INTO `forum_tanya` (`id_forum`, `nama`, `email`, `judul`, `komentar`, `waktu`) VALUES
(23, 'inan', 'weduz_jenjen@ngusngus.com', 'saya lagi cuba', 'tr76 yrtr grftr', '23-10-2007 ; 20:46:18'),
(21, 'Patria jaya', 'jaya@patra.com', 'Mengolah limbah di Jogja', 'beberapa saat yang lalu, limbah yang ada di Jogja....', '20-08-2004 ; 10:46:27'),
(24, 'anita karla', 'anita@yahoo.com', 'coba dulu baru ngaku', '^_^', '11-12-2007 ; 08:17:06');

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

INSERT INTO `gejala` (`kode_gejala`, `nama_gejala`, `probabilitas`) VALUES
('G001', 'Nyeri dalam yang terlokalisasi disendi yang terkena', 0.9),
('G002', 'Pemakaian sendi berlebihan dan hilang dengan istirahat', 0.6),
('G003', 'Nyeri malam hari', 0.6),
('G004', 'kekakuan sendi pada pagi hari', 0.7),
('G005', 'mudah letih dan lemas', 0.7),
('G006', 'kulit wajah dan kepala menebal', 0.4),
('G007', 'dahi dan kulit kepala beralur-alur', 0.3),
('G008', 'kulit wajah dan kepala biasanya berminyak', 0.8),
('G009', 'keringat berlebihan terutama ditelapak tangan dan kaki', 0.7),
('G010', 'jari seperti sosis (daktilitis)', 0.6),
('G011', 'kuku berbergerigi', 0.9),
('G012', 'kuku pitting', 0.4),
('G013', 'nyeri sendi', 0.8),
('G014', ' rasa hangat', 0.7),
('G015', 'pembengkakan sendi', 0.9),
('G016', 'penyulit mata meradang', 0.4),
('G017', 'nyeri punggung bawah', 0.8),
('G018', 'kekakuan sendi setelah istirahat', 0.5),
('G019', 'kekakuan serta nyeri hilang setelah olahraga', 0.4),
('G020', 'gerakan-gerakan tangan dan muka yang tidak diinginkan', 0.6),
('G021', 'kelabilan emosi pada anak-anak', 0.3),
('G022', 'hilangnya nafsu makan', 0.8),
('G023', 'bobot badan menurun', 0.6),
('G024', 'kadang-kadang demam', 0.6),
('G025', 'keterbatasan gerak yang menimbulkan sakit', 0.4),
('G026', 'nyeri pada gerak', 0.2),
('G027', 'nyeri pada waktu istirahat', 0.2),
('G028', 'pada stadium q dapat menyebabkan kecacatan', 0.9),
('G029', 'nyeri yang tergantung pada cuaca', 0.6),
('G030', 'Bunyi jantung berpindah-pindah', 0.6),
('G031', 'Nyeri tiba-tiba', 0.6);

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

INSERT INTO `gejalapenyakit` (`kd_penyakit`, `kd_gejala`, `prob`, `urut`) VALUES
('P001', 'G001', 0.7, 1),
('P001', 'G002', 0.5, 2),
('P001', 'G003', 0.7, 3),
('P001', 'G004', 0.3, 4),
('P001', 'G005', 0.6, 5),
('P002', 'G006', 0.5, 1),
('P002', 'G008', 0.3, 3),
('P002', 'G007', 0.3, 2),
('P002', 'G009', 0.5, 4),
('P003', 'G004', 0.7, 4),
('P003', 'G010', 0.5, 5),
('P003', 'G011', 0.6, 6),
('P003', 'G012', 0.8, 7),
('P003', 'G016', 0.5, 8),
('P003', 'G017', 0.6, 9),
('P004', 'G015', 0.7, 1),
('P004', 'G014', 0.4, 2),
('P004', 'G013', 0.7, 3),
('P004', 'G004', 0.6, 4),
('P004', 'G018', 0.4, 5),
('P004', 'G019', 0.3, 6),
('P005', 'G030', 0.7, 1),
('P005', 'G020', 0.3, 2),
('P005', 'G021', 0.6, 3),
('P006', 'G022', 0.4, 1),
('P006', 'G023', 0.4, 2),
('P006', 'G005', 0.2, 5),
('P006', 'G001', 0.9, 6),
('P006', 'G025', 0.6, 7),
('P006', 'G026', 0.6, 8),
('P006', 'G027', 0.8, 9),
('P006', 'G015', 0.7, 10),
('P007', 'G029', 0.9, 1),
('P007', 'G027', 0.6, 9),
('P007', 'G025', 0.5, 7),
('P007', 'G031', 0.5, 10);

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

INSERT INTO `penyakit` (`kode_penyakit`, `nama_penyakit`, `definisi`, `keterangan`) VALUES
('P001', 'Osteoartritis', 'Osteaortritis disebut juga penyakit sendi degeneratif yang mencerminkan kegagalan sendi diartodial. Osteaortritis adalah penyakit sendi yang paling sering ditemukan. Faktor resiko tertinggi untuk osteaortritis adalah usia. Peningkatan progresif prevalensi osteaortritis dijumpai seiring dengan peningkatan usia. Selain itu, trauma besar dan penggunaan sendi secara berulang merupakan faktor resiko untuk osteaortritis. Kerusakan tulang rawan sendi dapat terjadi pada saat cedera atau sesudahnya. Pola keterlibatan sendi dipengaruhi oleh beban yang berkaitan dengan pekerjaan (vokasional) atau (avokasional) sebelumnya. Faktor resiko lain yang dapat menyebabkan osteaortritis adalah obesitas.', 'Terapi obat untuk osteaortritis antara lain adalah NSAID, krim kapsain dan injeksi intra (periartikularis proparat glukokortikoid). Sedangkan terapi fisis dapat dilakukan dengan cara apikasi panas untuk mengurangi kekakuan dan berendam air panas, artroplati sendi total (bedah penggantian sendi), olahraga, menurunkan berat badan untuk pasien obesitas dan istirahat disiang hari.'),
('P002', 'Osteoartropati Hipertrofik', 'Osteoartropati hipertrofik terjadi dalam bentuk primer atau familial yang biasanya berawal pada masa kanak-kanak. Bentuk osteoartropati hipertrofik disebabkan oleh keganasan intra toraks, penyakit paru supuratif, penyakit jantung kongenital, dan berbagai penyakit lain.', 'Terapi obat untuk menangani penyakit tulang osteoartropati hipertrofik antara lain antibiotik, aspirin, obat anti inflamasi lain atau analgesik yang dapat membantu mengontrol gejala osteoartropati hipertrofik. Sedangkan untuk terapi fisis dapat dilakukan dengan pengangkatan atau kemotrapi terhadap tumor.'),
('P003', 'Artritis Psoriatik', 'Artritis psosiatik adalah artritis peradangan kronik yang mengenai 5 sampai 8 persen pasien psoriasis. Penyakit tulang ini disebabkan oleh infeksi (virus), trauma, peningkatan imunitas seluler terhadap streptokokus, penurunan pengaktifan sel T penekan, komplek imun, atau kelainan fungsi leukosit polimorfonukleus (abnormal polymorphonuclear, PMN).', 'Terapi fisis yang dapat dilakukan untuk mengobati artritis psosiatik antara lain pendidikan pasien untuk mempertahankan kekuatan otot, sendi dan fungsi otot. Selain itu, dapat juga dilakukan dengan PUVA (psoralen ditambah radiasi UVA).\r\nSelain terapi fisis, artritis psosiatik juga dapat disembuhkan dengan terapi obat antara lain dengan glukokortikoid intra sendi, salisilat, kolisin oral, hidrosiklorokuin, sulfasalazin dan garam emas intra muskulus namun terapi yang paling utama adalah dengan NSAID (anti inflamasi nonsteroid).\r\n'),
('P004', 'Artritis Perifer', 'Artritis perifer timbul pada 9 sampe 20 persen yang mempunyai penyakit radang usus. artritis perifer lebih besar kemungkinannya pada pasien penyakit usus besar dan pada pasien dengan komplikasi seperti abses, perianus, eritema, dan nodosum. Faktor utama penyebab artritis perifer adalah kekambuhan kelainan usus.', ''),
('P005', 'Demam Reumatik', 'Demam reumatik adalah penyakit yang menyebabkan perubahan meradang terutama pada persendian besar, jantung, kulit, dan sistem syaraf pusat yang terlibat khususnya anak-anak dan orang dewasa muda. Kemungkinan besar penyakit ini disebabkan oleh suatu realisasi autoimun setelah sensibilisasi melawan antigen streptokokus tertentu', 'Untuk mengobati demam reumatik dapat digunakan antibiotik, contohnya pinisilin. Selain itu, dapat diobati dengan super dioksida dismutase (orgotein, peroxnorm) dan glukokortikoid.'),
('P006', 'Artritis Reumatik', 'Artritis reumatik adalah penyakit yang dalam lingkup bahasa Jerman kebanyakan disebut sebagai poliortritis kronik (primer atau progredien) merupakan penyakit sistematik meradang kronik dan jaringan ikat. artritis reumatik disebabkan karena disposisi genetika bersama dengan penginfeksi sebagian besar dapat dipastikan adanya patogenesis autoimun. Diduga bahwa suatu bahan merugikan atau noksa misalnya bakteri, virus, gangguan-gangguan ketelapan atau mekanik menyebabkan reaksi-reaksi meradang, kerusakan sel dan atau pembebasan antigen.', 'Terapi obat yang dapat digunakan untuk menangani artritis reumatik antara lain autotigkikosa (aureotan), auro tiopoli peptida (aura-dexotin), natrium aurotiomalat (pauredon), auronofin (ridauva) untuk pemakaian oral, D-penisilamin (metal kaptase, trolokol), anti malaria, terutama kloroluia (peso chin)'),
('P007', 'Artrosis Deformans', 'artrosis deformans mencakup penyakit-penyakit degenesis persediaan perifer. Penyakit ini disebabkan oleh gejala-gejala tak terpakainya tulang rawan persendian, seperti pembentukan serat berlebihan, cacat renelis, lubang dan pengecilan', 'Untuk pengobatan artrosis deformans diperlukan  saat terapi, baik terapi obat maupun terapi fisis. Untuk terapi obat yang mengandung ekstrak tulang rawan (aru malon), ester asam polisulfat,dengan mukopoli sakanda (arteparon), D-glukosaminsulfat (Dona 200-5).');

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

INSERT INTO `penyebab` (`kode_penyebab`, `nama_penyebab`) VALUES
('S001', 'usia'),
('S002', 'penggunaan sendi secara berulang '),
('S003', 'obesitas'),
('S004', 'keganasan intra toraks'),
('S005', 'penyakit paru supuratif'),
('S006', 'penyakit jantung kongenital'),
('S007', 'infeksi yang disebabkan virus'),
('S008', 'Trauma'),
('S009', 'peningkatan imunitas seluler terhadap streptokokus'),
('S010', 'penurunan pengaktifan sel T '),
('S011', 'komplek imun'),
('S012', 'kelainan fungsi leukosit polimorfonukleus (abnormal polymorphonuclear)'),
('S013', 'kekambuhan kelainan usus'),
('S014', 'realisasi autoimun setelah sensibilisasi melawan antigen streptokokus tertentu'),
('S015', 'gangguan-gangguan ketelapan atau mekanik menyebabkan reaksi-reaksi meradang'),
('S016', 'kerusakan sel dan atau pembebasan antigen'),
('S017', 'pembentukan serat berlebihan'),
('S018', 'cacat renelis'),
('S019', 'lubang dan pengecilan');

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

INSERT INTO `penyebabpenyakit` (`kd_penyakit`, `kd_penyebab`) VALUES
('P001', 'S001'),
('P001', 'S002'),
('P001', 'S003'),
('P002', 'S004'),
('P002', 'S005'),
('P002', 'S006'),
('P003', 'S007'),
('P003', 'S008'),
('P003', 'S009'),
('P003', 'S010'),
('P003', 'S011'),
('P003', 'S012'),
('P004', 'S013'),
('P005', 'S014'),
('P006', 'S017'),
('P006', 'S015'),
('P007', 'S016'),
('P007', 'S018'),
('P007', 'S019');

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

INSERT INTO `solusi` (`kode_solusi`, `nama_solusi`) VALUES
('T001', 'minum banyak cairan (baik air putih maupun jus buah)'),
('T002', 'digunakan tetes hidung yang mengandung larutan garam'),
('T003', 'menggunakan asetaminofen'),
('T004', 'obat anti-virus ribavirin'),
('T005', 'oksigen yang lembab dan obat-obatan untuk membuka saluran pernapasan');

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

INSERT INTO `solusipenyakit` (`kd_solusi`, `kd_penyakit`) VALUES
('T001', 'P001'),
('T002', 'P001'),
('T003', 'P001'),
('T004', 'P001'),
('T005', 'P001');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tamu`
--

INSERT INTO `tamu` (`no_id`, `nama`, `email`, `waktu`, `koment`) VALUES
(1, 'heyu', 'ujrftj@fchf.hdd', '11-12-2007, 08:06:46', 'ftjrftjrf'),
(2, 'ghg', 'jgsh@gfhsa.fgsa', '13-12-2007, 18:43:50', '&lt;b&gt;coba&lt;/b&gt;');

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

INSERT INTO `user` (`username`, `password`, `kode`, `nama`, `alamat`) VALUES
('anita', '83349cbdac695f3943635a4fd1aaa7d0', 'user', 'anita karla', 'jl. Kalimantan'),
('aku', 'e10adc3949ba59abbe56e057f20f883e', 'pakar', 'dewa', 'alamat'),
('', 'd41d8cd98f00b204e9800998ecf8427e', 'user', '', '');
