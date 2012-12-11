SET FOREIGN_KEY_CHECKS=0;


-- andi split --


drop table if exists `ci_sessions`;
-- andi split --
CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(50) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
-- andi split --
TRUNCATE `ci_sessions`;
-- andi split --

DROP TABLE IF EXISTS `fakultas`;
-- andi split --
CREATE TABLE `fakultas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `informasi` varchar(255) NOT NULL,
  `active` int(11) NOT NULL,
  `created_by` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;
-- andi split --
TRUNCATE `fakultas`;
-- andi split --

DROP TABLE IF EXISTS `group`;
-- andi split --
CREATE TABLE `group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL,
  `created_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;
-- andi split --
TRUNCATE `group`;
-- andi split --

DROP TABLE IF EXISTS `jurusan`;
-- andi split --
CREATE TABLE `jurusan` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `informasi_jurusan` varchar(255) NOT NULL,
  `jurusan_status` int(11) NOT NULL,
  `jurusan_jenjang` int(11) NOT NULL,
  `fakultas_id` int(11) NOT NULL,
  `kaprodi` varchar(110) NOT NULL,
  `web` varchar(255) NOT NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `year_data` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `created_by` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;
-- andi split --
TRUNCATE `jurusan`;
-- andi split --

DROP TABLE IF EXISTS `jurusan_foto`;
-- andi split --
CREATE TABLE `jurusan_foto` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `jurusan_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `is_default` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `created_by` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;
-- andi split --
TRUNCATE `jurusan_foto`;
-- andi split --

DROP TABLE IF EXISTS `kampus`;
-- andi split --
CREATE TABLE `kampus` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fax` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lang` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) unsigned NOT NULL,
  `created_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;
-- andi split --
TRUNCATE `kampus`;
-- andi split --

DROP TABLE IF EXISTS `matkul`;
-- andi split --
CREATE TABLE `matkul` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `code_matkul` varchar(255) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sks_id` int(11) NOT NULL,
  `jurusan_id` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `dosen_name` varchar(255) NOT NULL,
  `active` int(11) NOT NULL,
  `created_by` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=63 ;
-- andi split --
TRUNCATE `matkul`;
-- andi split --

DROP TABLE IF EXISTS `menu`;
-- andi split --
CREATE TABLE `menu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `uri` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  `parent_id` int(11) unsigned NOT NULL,
  `active` int(11) unsigned NOT NULL,
  `created_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;
-- andi split --
TRUNCATE `menu`;
-- andi split --

DROP TABLE IF EXISTS `nilai`;
-- andi split --
CREATE TABLE `nilai` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `bobot` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;
-- andi split --
TRUNCATE `nilai`;
-- andi split --

DROP TABLE IF EXISTS `nilai_semester_1`;
-- andi split --
CREATE TABLE `nilai_semester_1` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `matkul_id` int(11) NOT NULL,
  `nilai_id` int(11) NOT NULL,
  `jurusan_id` int(11) NOT NULL,
  `mahasiswa_id` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `created_by` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;
-- andi split --
TRUNCATE `nilai_semester_1`;
-- andi split --

DROP TABLE IF EXISTS `nilai_semester_2`;
-- andi split --
CREATE TABLE `nilai_semester_2` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `matkul_id` int(11) NOT NULL,
  `nilai_id` int(11) NOT NULL,
  `jurusan_id` int(11) NOT NULL,
  `mahasiswa_id` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `created_by` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;
-- andi split --
TRUNCATE `nilai_semester_2`;
-- andi split --

DROP TABLE IF EXISTS `nilai_semester_3`;
-- andi split --
CREATE TABLE `nilai_semester_3` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `matkul_id` int(11) NOT NULL,
  `nilai_id` int(11) NOT NULL,
  `jurusan_id` int(11) NOT NULL,
  `mahasiswa_id` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `created_by` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;
-- andi split --
TRUNCATE `nilai_semester_3`;
-- andi split --

DROP TABLE IF EXISTS `nilai_semester_4`;
-- andi split --
CREATE TABLE `nilai_semester_4` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `matkul_id` int(11) NOT NULL,
  `nilai_id` int(11) NOT NULL,
  `jurusan_id` int(11) NOT NULL,
  `mahasiswa_id` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `created_by` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;
-- andi split --
TRUNCATE `nilai_semester_4`;
-- andi split --

DROP TABLE IF EXISTS `nilai_semester_5`;
-- andi split --
CREATE TABLE `nilai_semester_5` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `matkul_id` int(11) NOT NULL,
  `nilai_id` int(11) NOT NULL,
  `jurusan_id` int(11) NOT NULL,
  `mahasiswa_id` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `created_by` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
-- andi split --
TRUNCATE `nilai_semester_5`;
-- andi split --

DROP TABLE IF EXISTS `nilai_semester_6`;
-- andi split --
CREATE TABLE `nilai_semester_6` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `matkul_id` int(11) NOT NULL,
  `nilai_id` int(11) NOT NULL,
  `jurusan_id` int(11) NOT NULL,
  `mahasiswa_id` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `created_by` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
-- andi split --
TRUNCATE `nilai_semester_6`;
-- andi split --

DROP TABLE IF EXISTS `nilai_semester_7`;
-- andi split --
CREATE TABLE `nilai_semester_7` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `matkul_id` int(11) NOT NULL,
  `nilai_id` int(11) NOT NULL,
  `jurusan_id` int(11) NOT NULL,
  `mahasiswa_id` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `created_by` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
-- andi split --
TRUNCATE `nilai_semester_7`;
-- andi split --

DROP TABLE IF EXISTS `nilai_semester_8`;
-- andi split --
CREATE TABLE `nilai_semester_8` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `matkul_id` int(11) NOT NULL,
  `nilai_id` int(11) NOT NULL,
  `jurusan_id` int(11) NOT NULL,
  `mahasiswa_id` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `created_by` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
-- andi split --
TRUNCATE `nilai_semester_8`;
-- andi split --

DROP TABLE IF EXISTS `privilege_group`;
-- andi split --
CREATE TABLE `privilege_group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `uri` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) unsigned NOT NULL,
  `created_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;
-- andi split --
TRUNCATE `privilege_group`;
-- andi split --

DROP TABLE IF EXISTS `sks`;
-- andi split --
CREATE TABLE `sks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;
-- andi split --
TRUNCATE `sks`;
-- andi split --

DROP TABLE IF EXISTS `sysparam`;
-- andi split --
CREATE TABLE `sysparam` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sgroup` varchar(255) NOT NULL,
  `skey` varchar(255) NOT NULL,
  `svalue` varchar(255) NOT NULL,
  `lvalue` text NOT NULL,
  `active` int(11) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;
-- andi split --
TRUNCATE `sysparam`;
-- andi split --

DROP TABLE IF EXISTS `user`;
-- andi split --
CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fakultas_id` int(11) NOT NULL,
  `jurusan_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `year_data` int(11) NOT NULL,
  `activation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) unsigned NOT NULL,
  `created_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;
-- andi split --
TRUNCATE `user`;
-- andi split --

DROP TABLE IF EXISTS `user_group`;
-- andi split --
CREATE TABLE `user_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `created_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=39 ;
-- andi split --
TRUNCATE `user_group`;
-- andi split --

DROP TABLE IF EXISTS `user_kampus`;
-- andi split --
CREATE TABLE `user_kampus` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `org_id` int(11) NOT NULL,
  `active` int(11) unsigned NOT NULL,
  `created_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=49 ;
-- andi split --
TRUNCATE `user_kampus`;
-- andi split --

INSERT INTO `fakultas` VALUES (1, 'Tekhnik', 'Fakultas takhnik universitas pamulang Tanggerang.', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `fakultas` VALUES (2, 'Sastra', 'Fakultas sastra universitas pamulang Tanggerang', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `fakultas` VALUES (3, 'Mipa', 'Fakultas Mipa Universitas Pamulang Tanggerang Banten, untuk orang-orang yang gemar berhitung.', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `fakultas` VALUES (4, 'Hukum', 'Fakultas Hukum Universitas Pamulang Tanggerang, untuk para hukumers dan hukumerwati.', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `fakultas` VALUES (5, 'Ekonomi', 'Fakultas Ekonomi Universitas Pamulang Tanggerang, untuk para penghitung uang.', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `group` VALUES (1, 'Superadmin', 1, 'andi', 'admin');
-- andi split --

INSERT INTO `group` VALUES (2, 'Mahasiswa', 1, 'andi', 'andi');
-- andi split --

INSERT INTO `jurusan` VALUES (1, 'Informatika', 'Didedikasikan untuk meluluskan para mahasiswa/i Universitas Pamulang agar mencapai dunia kerja yang sekarang menjadi dominan di pasar kerja jaman sekarang, yang sangat membutuhkan tenaga-tenaga Informatika/komputer yang berkualitas, pintar, dan jenius.', 4, 4, 1, 'Ir. Atang Susila, MEng', 'http://informatika.unpam.ac.id', 'jurusan/image/0c4f2499b044221b9cadce57e5e9082d.JPG', 2007, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `jurusan` VALUES (2, 'Elektro', 'Didedikasikan untuk meluluskan para mahasiswa/i Universitas Pamulang agar mencapai dunia kerja yang sekarang menjadi dominan di pasar kerja jaman sekarang, yang sangat membutuhkan tenaga-tenaga elektro yang berkualitas, pintar, dan jenius.', 5, 4, 1, 'Ir. Andi Susilo, MM', 'http://elektro.unpam.ac.id', '', 2006, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `jurusan` VALUES (3, 'Inggris', 'Didedikasikan untuk meluluskan para mahasiswa/i Universitas Pamulang agar mencapai dunia kerja yang sekarang menjadi dominan di pasar kerja jaman sekarang, yang sangat membutuhkan tenaga-tenaga bahasa inggris yang aktif, berkualitas, pintar, dan jenius.', 5, 4, 2, 'Nurhayati. MM', 'http://sastra.unpam.ac.id', '', 2006, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `jurusan` VALUES (5, 'Matematika', 'Didedikasikan untuk meluluskan para mahasiswa/i Universitas Pamulang agar mencapai dunia kerja yang sekarang menjadi dominan di pasar kerja jaman sekarang, yang sangat membutuhkan tenaga-tenaga matematika yang berkualitas, pintar, dan jenius.', 5, 4, 3, 'Ir. Budiono Sundoro. MSi', 'http://mipa.unpam.ac.id', '', 2006, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `jurusan` VALUES (7, 'Mesin', 'Didedikasikan untuk meluluskan para mahasiswa/i Universitas Pamulang agar mencapai dunia kerja yang sekarang menjadi dominan di pasar kerja jaman sekarang, yang sangat membutuhkan tenaga-tenaga yang berkualitas, pintar, dan jenius.', 5, 4, 1, 'Ir. Sarjana Muda. MM', 'http://mesin.unpam.ac.id', '', 2007, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `jurusan` VALUES (8, 'Industri', 'Didedikasikan untuk meluluskan para mahasiswa/i Universitas Pamulang agar mencapai dunia kerja yang sekarang menjadi dominan di pasar kerja jaman sekarang, yang sangat membutuhkan tenaga-tenaga yang berkualitas, pintar, dan jenius.', 4, 4, 1, 'Ir. Bambang Sudarmo. MM', 'http://industri.unpam.ac.id', '', 2007, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `jurusan` VALUES (9, 'Kimia', 'Didedikasikan untuk meluluskan para mahasiswa/i Universitas Pamulang agar mencapai dunia kerja yang sekarang menjadi dominan di pasar kerja jaman sekarang, yang sangat membutuhkan tenaga-tenaga yang berkualitas, pintar, dan jenius.', 4, 4, 1, 'Ir. Mardianto. MSi', 'http://kimia.unpam.ac.id', '', 2007, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `jurusan` VALUES (10, 'Indonesia', 'Didedikasikan untuk meluluskan para mahasiswa/i Universitas Pamulang agar mencapai dunia kerja yang sekarang menjadi dominan di pasar kerja jaman sekarang, yang sangat membutuhkan tenaga-tenaga yang berkualitas, pintar, dan jenius.', 4, 4, 2, 'Ir. Mardiansyah. MM', 'http://sastra.unpam.ac.id', '', 2007, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `jurusan` VALUES (11, 'Ilmu Hukum', 'Didedikasikan untuk meluluskan para mahasiswa/i Universitas Pamulang agar mencapai dunia kerja yang sekarang menjadi dominan di pasar kerja jaman sekarang, yang sangat membutuhkan tenaga-tenaga yang berkualitas, pintar, dan jenius.', 5, 4, 4, 'Ir. Maryaman. MM', 'http://hukum.unpam.ac.id', '', 2006, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `jurusan` VALUES (12, 'Manajemen S1', 'Didedikasikan untuk meluluskan para mahasiswa/i Universitas Pamulang agar mencapai dunia kerja yang sekarang menjadi dominan di pasar kerja jaman sekarang, yang sangat membutuhkan tenaga-tenaga yang berkualitas, pintar, dan jenius.', 5, 4, 5, 'Ir. Yulianto Wardoyo. MM', 'http://ekonomi.unpam.ac.id', '', 2004, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `jurusan` VALUES (13, 'Akuntansi S1', 'Didedikasikan untuk meluluskan para mahasiswa/i Universitas Pamulang agar mencapai dunia kerja yang sekarang menjadi dominan di pasar kerja jaman sekarang, yang sangat membutuhkan tenaga-tenaga yang berkualitas, pintar, dan jenius.', 4, 4, 5, 'Ir. Barokalloh. MM', 'http://ekonomi.unpam.ac.id', '', 2007, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `jurusan` VALUES (14, 'Sekretaris', 'Didedikasikan untuk meluluskan para mahasiswa/i Universitas Pamulang agar mencapai dunia kerja yang sekarang menjadi dominan di pasar kerja jaman sekarang, yang sangat membutuhkan tenaga-tenaga yang berkualitas, pintar, dan jenius.', 4, 3, 5, 'Ir. Santa Maulana. MM', 'http://ekonomi.unpam.ac.id', '', 2007, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `jurusan` VALUES (15, 'Akuntansi D3', 'Didedikasikan untuk meluluskan para mahasiswa/i Universitas Pamulang agar mencapai dunia kerja yang sekarang menjadi dominan di pasar kerja jaman sekarang, yang sangat membutuhkan tenaga-tenaga yang berkualitas, pintar, dan jenius.', 5, 3, 5, 'Ir. Marullah. MM', 'http://ekonomi.unpam.ac.id', '', 2006, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `jurusan` VALUES (16, 'Manajemen S2', 'Didedikasikan untuk meluluskan para mahasiswa/i Universitas Pamulang agar mencapai dunia kerja yang sekarang menjadi dominan di pasar kerja jaman sekarang, yang sangat membutuhkan tenaga-tenaga yang berkualitas, pintar, dan jenius.', 4, 5, 5, 'Ir. Dr. Budi Prasetyo. MM', 'http://ekonomi.unpam.ac.id', '', 2008, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `jurusan_foto` VALUES (2, 1, '', 'jurusan/image/0c4f2499b044221b9cadce57e5e9082d.JPG', 1, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `jurusan_foto` VALUES (3, 1, '', 'jurusan/image/de80f808c9d139bba5b18552131550b0.JPG', 0, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `jurusan_foto` VALUES (4, 1, '', 'jurusan/image/de37aa282279e66ee1c2e350e835bc14.JPG', 0, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `jurusan_foto` VALUES (5, 1, '', 'jurusan/image/7a14feb8db6f95d914dabd748722933a.JPG', 0, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `jurusan_foto` VALUES (6, 1, '', 'jurusan/image/54bb81d057d03739ec787d8ecc3bea92.JPG', 0, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `kampus` VALUES (1, 'Universitas Pamulang', 'Jln. Surya Kencana No. 1 Pamulang Tanggerang - Banten', '+62 21 95283066', 'andi.susilo@xinix.co.id', '+62 21 95283066', 'http://unpam.ac.id', '', 1, 'sys', 'sys');
-- andi split --

INSERT INTO `matkul` VALUES (1, 'TPLB22', 'Logika Informatika', 3, 1, 1, 'Ir. Ahmad Julianto,MM', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (2, 'TPLE02', 'Kecakapan Antar Personal', 2, 1, 1, 'Ir. Boediono. MM', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (3, 'TPLB19', 'Kalkulus I', 3, 1, 1, 'Andi Soesilo. Skom', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (4, 'TPLB17', 'Algorithma dan Pemrograman I', 2, 1, 1, 'Ir. Barokah Msi', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (5, 'TPLD37', 'Pengantar Aplikasi Komputer', 3, 1, 1, 'Ir. Susilo Nua. MM', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (6, 'FTB01', 'Fisika Dasar I', 2, 1, 1, 'Ir. Santosa Mardoyo. MM', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (7, 'FTE01', 'Bahasa Inggris I', 2, 1, 1, 'Sari Ayu, Skom', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (8, 'FTB03', 'Praktikum Fisika I', 1, 1, 1, 'Ninda Sari Puspa,SKom', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (9, 'TPLB02', 'Pengantar Teknologi Informasi', 2, 1, 1, 'Ir. Dimas Waluyo. Msi', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (10, 'TPLB04', 'Algoritma dan Pemrograman', 4, 1, 2, 'Ariyawan Batara. Skom', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (11, 'TPLB05', 'Prak Algorithma dan Pemrograman', 2, 1, 2, 'Bujana Irpandi. Skom', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (12, 'TPLB20', 'Kalkulus II', 3, 1, 2, 'Ir. Rahman Irpandi. Msi', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (13, 'TPLD38', 'Komunikasi Data', 2, 1, 2, 'Kanwari Jayadi. Skom', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (14, 'FTB02', 'Fisika Dasar II', 2, 1, 2, 'Pandi Nugraha. Skom', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (15, 'FTE02', 'Bahasa Inggris II', 2, 1, 2, 'Intan Malayati. Skom', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (16, 'FTB04', 'Praktikum Fisika II', 1, 1, 2, 'Nana Pradina. Skom', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (17, 'TPLE01', 'Komputer dan Masyarakat', 2, 1, 2, 'Ir. Ganggang Dapa. MM', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (19, 'TPLB21', 'Struktur Data', 3, 1, 3, 'Ir. Boediono. MM', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (20, 'TPLC19', 'Sistem Berkas', 2, 1, 3, 'Andi Soesilo. Skom', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (21, 'TPLB06', 'Matematika Diskrit', 2, 1, 3, 'Ir. Barokah Msi', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (22, 'TPLB07', 'Aljabar Linier dan Matriks', 2, 1, 3, 'Ir. Susilo Nua. MM', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (23, 'TPLB8', 'Statistik Dasar', 2, 1, 3, 'Ir. Santosa Mardoyo. MM', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (24, 'TPLD31', 'Sistem Operasi', 3, 1, 3, 'Sari Ayu, Skom', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (25, 'FTE03', 'Bahasa Inggris III', 2, 1, 3, 'Ninda Sari Puspa,SKom', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (26, 'TPLC34', 'Jaringan Komputer', 3, 1, 3, 'Ir. Dimas Waluyo. Msi', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (27, 'TPLB8', 'Statistik Dasar', 2, 1, 4, 'Ariyawan Batara. Skom', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (28, 'TPLD33', 'Pemrograman 1', 3, 1, 4, 'Bujana Irpandi. Skom', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (29, 'TPLD43', 'Basis Data I', 2, 1, 4, 'Ir. Rahman Irpandi. Msi', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (30, 'TPLB14', 'Pengantar Organisasi dan Bisnis', 2, 1, 4, 'Kanwari Jayadi. Skom', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (31, 'TPLC19', 'Sistem Berkas', 2, 1, 4, 'Pandi Nugraha. Skom', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (32, 'FTE04', 'Bahasa Inggris IV', 2, 1, 4, 'Intan Malayati. Skom', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (33, 'TPLE01', 'Komputer dan Masyarakat', 2, 1, 4, 'Nana Pradina. Skom', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (34, 'TPLB23', 'Graph Terapan', 2, 1, 4, 'Ir. Ganggang Dapa. MM', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (35, 'TPLD36', 'Interaksi Manusia dgn Komputer', 3, 1, 4, 'Ir. Ahmad Julianto,MM', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (36, 'TPLD42', 'Analisa dan Perancangan Sistem', 2, 1, 5, 'Ir. Boediono. MM', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (37, 'TPLC25', 'Pemrograman Web 1', 3, 1, 5, 'Andi Soesilo. Skom', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (38, 'TPLD33', 'Pemrograman 2', 3, 1, 5, 'Ir. Barokah Msi', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (39, 'TPLC16', 'Teori Bahasa & Automata', 2, 1, 5, 'Ir. Susilo Nua. MM', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (40, 'TPLC29', 'Teknik Riset Operasional', 2, 1, 5, 'Ir. Santosa Mardoyo. MM', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (41, 'TPLD36', 'Interaksi Manusia dengan Komputer', 3, 1, 5, 'Sari Ayu, Skom', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (42, 'TPLD32', 'Arsitektur dan Organisasi Komputer', 3, 1, 5, 'Ninda Sari Puspa,SKom', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (43, 'TPLD39', 'Komputer Grafik I', 2, 1, 6, 'Ir. Dimas Waluyo. Msi', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (44, 'TPLC26', 'Pemrograman Web 2', 3, 1, 6, 'Ariyawan Batara. Skom', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (45, 'TPLD42', 'Analisa dan Perancangan Sistem', 2, 1, 6, 'Bujana Irpandi. Skom', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (46, 'TPLD32', 'Arsitektur dan Organisasi Komputer', 3, 1, 6, 'Ir. Rahman Irpandi. Msi', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (47, 'TPLD19', 'Kecerdasan Buatan', 3, 1, 6, 'Kanwari Jayadi. Skom', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (48, 'TPLC17', 'Teknik Kompilasi', 2, 1, 6, 'Pandi Nugraha. Skom', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (49, 'TPLC31', 'Pemrograman Java', 3, 1, 6, 'Intan Malayati. Skom', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (50, 'TPLB11', 'Metode Numerik', 3, 1, 7, 'Nana Pradina. Skom', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (51, 'TPLD24', 'Manajemen Proyek Informatika', 2, 1, 7, 'Ir. Ganggang Dapa. MM', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (52, 'TPLD09', 'Metode Penelitian', 2, 1, 7, 'Darta Fardata. Skom', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (53, 'TPLC22', 'Kerja Praktek', 2, 1, 7, 'Ir. Dimas Waluyo. Msi', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (54, 'TPLD47', 'Testing dan QA Perangkat Lunak', 3, 1, 7, 'Ariyawan Batara. Skom', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (55, 'TPLD42', 'Analisa dan Perancangan Sistem', 2, 1, 7, 'Bujana Irpandi. Skom', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (56, 'TPLC31', 'Pemrograman Java', 3, 1, 7, 'Ir. Rahman Irpandi. Msi', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (57, 'TPLC23', 'Skripsi', 6, 1, 8, 'Kanwari Jayadi. Skom', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (58, 'TPLD28', 'Etika Profesi', 2, 1, 8, 'Ir. Ganggang Dapa. MM', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (59, 'TPLD24', 'Manajemen Proyek Informatika', 2, 1, 8, 'Darta Fardata. Skom', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `matkul` VALUES (60, 'TPLE02', 'Kecakapan Antar Personal', 2, 1, 8, 'Bujana Irpandi. Skom', 1, 'admin', 'admin');
-- andi split --


INSERT INTO `menu` VALUES (1, 'Home', '/', 0, 0, 1, 'sys', 'admin');
-- andi split --

INSERT INTO `menu` VALUES (2, 'System', '', 1, 0, 1, 'sys', 'admin');
-- andi split --

INSERT INTO `menu` VALUES (3, 'Logout', 'user/logout', 7, 0, 1, 'sys', 'admin');
-- andi split --

INSERT INTO `menu` VALUES (4, 'Mahasiswa', 'user/listing', 5, 0, 1, 'sys', 'admin');
-- andi split --

INSERT INTO `menu` VALUES (5, 'Group User', 'group/listing', 0, 2, 1, 'sys', 'admin');
-- andi split --

INSERT INTO `menu` VALUES (6, 'Edit Menu', 'menu/listing', 1, 2, 1, 'sys', 'admin');
-- andi split --

INSERT INTO `menu` VALUES (7, 'Fakultas', 'fakultas/listing', 2, 0, 1, 'sys', 'admin');
-- andi split --

INSERT INTO `menu` VALUES (8, 'Jurusan', 'jurusan/listing', 3, 0, 1, 'sys', 'admin');
-- andi split --

INSERT INTO `menu` VALUES (9, 'Trajectory', 'trajectory/listing', 10, 30, 1, 'sys', 'admin');
-- andi split --

INSERT INTO `menu` VALUES (12, 'Matkul', 'matkul/listing', 4, 0, 1, 'sys', 'admin');
-- andi split --

INSERT INTO `menu` VALUES (22, 'Ganti Password', 'user/ganti_password_admin', 2, 2, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai` VALUES (1, 'Nilai A', 4);
-- andi split --

INSERT INTO `nilai` VALUES (2, 'Nilai B', 3);
-- andi split --

INSERT INTO `nilai` VALUES (3, 'Nilai C', 2);
-- andi split --

INSERT INTO `nilai` VALUES (4, 'Nilai D', 1);
-- andi split --

INSERT INTO `nilai` VALUES (5, 'Nilai E', 0);
-- andi split --

INSERT INTO `nilai_semester_1` VALUES (1, 1, 1, 1, 2, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai_semester_1` VALUES (2, 2, 3, 1, 2, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai_semester_1` VALUES (3, 3, 3, 1, 2, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai_semester_1` VALUES (4, 4, 2, 1, 2, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai_semester_1` VALUES (5, 5, 2, 1, 2, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai_semester_1` VALUES (6, 6, 2, 1, 2, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai_semester_1` VALUES (7, 7, 1, 1, 2, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai_semester_1` VALUES (8, 8, 2, 1, 2, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai_semester_1` VALUES (9, 9, 1, 1, 2, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai_semester_1` VALUES (10, 1, 3, 1, 3, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai_semester_1` VALUES (11, 2, 2, 1, 3, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai_semester_1` VALUES (12, 3, 2, 1, 3, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai_semester_1` VALUES (13, 4, 3, 1, 3, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai_semester_1` VALUES (14, 5, 1, 1, 3, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai_semester_1` VALUES (15, 6, 1, 1, 3, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai_semester_1` VALUES (16, 7, 2, 1, 3, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai_semester_1` VALUES (17, 8, 2, 1, 3, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai_semester_1` VALUES (18, 9, 2, 1, 3, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai_semester_1` VALUES (19, 1, 1, 1, 4, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai_semester_1` VALUES (20, 2, 1, 1, 4, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai_semester_1` VALUES (21, 3, 1, 1, 4, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai_semester_1` VALUES (22, 4, 2, 1, 4, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai_semester_1` VALUES (23, 5, 2, 1, 4, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai_semester_1` VALUES (24, 6, 1, 1, 4, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai_semester_1` VALUES (25, 7, 1, 1, 4, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai_semester_1` VALUES (26, 8, 3, 1, 4, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai_semester_1` VALUES (27, 9, 3, 1, 4, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai_semester_2` VALUES (1, 10, 3, 1, 2, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai_semester_2` VALUES (2, 11, 1, 1, 2, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai_semester_2` VALUES (3, 12, 2, 1, 2, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai_semester_2` VALUES (4, 13, 4, 1, 2, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai_semester_2` VALUES (5, 14, 2, 1, 2, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai_semester_2` VALUES (6, 15, 1, 1, 2, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai_semester_2` VALUES (7, 16, 1, 1, 2, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai_semester_2` VALUES (8, 17, 1, 1, 2, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai_semester_3` VALUES (1, 19, 2, 1, 2, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai_semester_3` VALUES (2, 20, 4, 1, 2, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai_semester_3` VALUES (3, 21, 1, 1, 2, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai_semester_3` VALUES (4, 22, 2, 1, 2, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai_semester_3` VALUES (5, 23, 2, 1, 2, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai_semester_3` VALUES (6, 24, 3, 1, 2, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai_semester_3` VALUES (7, 25, 3, 1, 2, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai_semester_3` VALUES (8, 26, 3, 1, 2, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai_semester_3` VALUES (9, 27, 1, 1, 2, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai_semester_4` VALUES (1, 27, 2, 1, 2, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai_semester_4` VALUES (2, 28, 4, 1, 2, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai_semester_4` VALUES (3, 29, 1, 1, 2, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai_semester_4` VALUES (4, 30, 2, 1, 2, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai_semester_4` VALUES (5, 31, 2, 1, 2, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai_semester_4` VALUES (6, 32, 3, 1, 2, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai_semester_4` VALUES (7, 33, 3, 1, 2, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai_semester_4` VALUES (8, 34, 3, 1, 2, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `nilai_semester_4` VALUES (9, 35, 3, 1, 2, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `privilege_group` VALUES (1, 1, '*', 1, 'andi', 'andi');
-- andi split --

INSERT INTO `privilege_group` VALUES (2, 2, '/', 1, 'andi', 'andi');
-- andi split --

INSERT INTO `privilege_group` VALUES (3, 2, 'user/nilai_pdf', 1, 'andi', 'andi');
-- andi split --

INSERT INTO `privilege_group` VALUES (4, 2, 'user/ganti_password', 1, 'andi', 'andi');
-- andi split --

INSERT INTO `sks` (`id`, `name`) VALUES (1, '1 SKS');
-- andi split --

INSERT INTO `sks` (`id`, `name`) VALUES (2, '2 SKS');
-- andi split --

INSERT INTO `sks` (`id`, `name`) VALUES (3, '3 SKS');
-- andi split --

INSERT INTO `sks` (`id`, `name`) VALUES (4, '4 SKS');
-- andi split --

INSERT INTO `sks` (`id`, `name`) VALUES (5, '5 SKS');
-- andi split --

INSERT INTO `sks` (`id`, `name`) VALUES (6, '6 SKS');
-- andi split --

INSERT INTO `sysparam` VALUES (1, 'jurusan_jenjang', '1', 'D1', '', 1, 'sys', 'sys');
-- andi split --

INSERT INTO `sysparam` VALUES (2, 'jurusan_jenjang', '2', 'D2', '', 1, 'sys', 'sys');
-- andi split --

INSERT INTO `sysparam` VALUES (3, 'jurusan_jenjang', '3', 'D3', '', 1, 'sys', 'sys');
-- andi split --

INSERT INTO `sysparam` VALUES (4, 'jurusan_jenjang', '4', 'S1', '', 1, 'sys', 'sys');
-- andi split --

INSERT INTO `sysparam` VALUES (5, 'jurusan_jenjang', '5', 'S2', '', 1, 'sys', 'sys');
-- andi split --

INSERT INTO `sysparam` VALUES (6, 'jurusan_status', '1', 'Terktreditasi A', '', 1, 'sys', 'sys');
-- andi split --

INSERT INTO `sysparam` VALUES (7, 'jurusan_status', '2', 'Terktreditasi B', '', 1, 'sys', 'sys');
-- andi split --

INSERT INTO `sysparam` VALUES (8, 'jurusan_status', '3', 'Terktreditasi C', '', 1, 'sys', 'sys');
-- andi split --

INSERT INTO `sysparam` VALUES (9, 'jurusan_status', '5', 'Terktreditasi BAN-PT', '', 1, 'sys', 'sys');
-- andi split --

INSERT INTO `sysparam` VALUES (10, 'jurusan_status', '4', 'Dalam Proses', '', 1, 'sys', 'sys');
-- andi split --

INSERT INTO `sysparam` VALUES (11, 'semester', '1', 'Semester 1', '', 1, '', '');
-- andi split --

INSERT INTO `sysparam` VALUES (12, 'semester', '2', 'Semester 2', '', 1, '', '');
-- andi split --

INSERT INTO `sysparam` VALUES (13, 'semester', '3', 'Semester 3', '', 1, '', '');
-- andi split --

INSERT INTO `sysparam` VALUES (14, 'semester', '4', 'Semester 4', '', 1, '', '');
-- andi split --

INSERT INTO `sysparam` VALUES (15, 'semester', '5', 'Semester 5', '', 1, '', '');
-- andi split --

INSERT INTO `sysparam` VALUES (16, 'semester', '6', 'Semester 6', '', 1, '', '');
-- andi split --

INSERT INTO `sysparam` VALUES (17, 'semester', '7', 'Semester 7', '', 1, '', '');
-- andi split --

INSERT INTO `sysparam` VALUES (18, 'semester', '8', 'Semester 8', '', 1, '', '');
-- andi split --

INSERT INTO `user`VALUES (1, 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', '', 'Admin', 0, 0, '', '', 2011, '', 1, '', 'admin');
-- andi split --

INSERT INTO `user`VALUES (2, '2007140025', '5f4dcc3b5aa765d61d8327deb882cf99', '', 'Andi Susilo', 1, 1, 'mahasiswa/image/33c62150c9170a8ed2a149b04197bf8e.jpg', 'Jl. Talas I rt 02/10 Pd cabe ilir Pamulang Tanggerang BANTEN', 2007, '', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `user`VALUES (3, '2007140026', '5f4dcc3b5aa765d61d8327deb882cf99', '', 'Ari Setiawan', 1, 1, '', 'Jl. Karya Sakti Blok D no 65\nPamulang Barat Tanggerang Banten', 2007, '', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `user`VALUES (4, '2007140027', 'be4ea3938dfde3ec341dc80cc06764a0', '', 'Nia Setiawan', 1, 1, '', 'Jl. Jalan', 2007, '', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `user`VALUES (5, '2007140029', 'be4ea3938dfde3ec341dc80cc06764a0', '', 'Dian Saputra Ningsing', 1, 1, '', 'Jln. Kebayoran Lama Ciputat', 2007, '', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `user`VALUES (13, '2009130023', 'be4ea3938dfde3ec341dc80cc06764a0', '', 'Agung Wibowo', 1, 1, '', 'Jl. Baru aja jadi', 2007, '', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `user`VALUES (14, '2007140046', '8c343b3297b1d566d0ec9ec5b884f6b5', '', 'Muchlis', 1, 1, '', 'Pagedangan', 2007, '', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `user`VALUES (9, '2007140030', 'be4ea3938dfde3ec341dc80cc06764a0', '', 'Hendra Saputra', 1, 1, '', 'Jl. Kebangsaan Timur, Rt 03/10 Pondok Petir\nKebayoran Lama - Jakarta 12031', 2007, '', 1, 'admin', 'admin');
-- andi split --

INSERT INTO `user_group` VALUES (12, 1, 1, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `user_group` VALUES (28, 2, 2, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `user_group` VALUES (4, 3, 2, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `user_group` VALUES (7, 4, 2, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `user_group` VALUES (19, 5, 2, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `user_group` VALUES (9, 6, 2, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `user_group` VALUES (10, 7, 2, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `user_group` VALUES (11, 8, 2, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `user_group` VALUES (36, 9, 2, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `user_group` VALUES (23, 10, 2, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `user_group` VALUES (24, 11, 2, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `user_group` VALUES (26, 12, 2, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `user_group` VALUES (38, 13, 2, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `user_group` VALUES (32, 14, 2, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `user_group` VALUES (37, 15, 2, 1, '2007140025', '2007140025');
-- andi split --

INSERT INTO `user_kampus` VALUES (23, 1, 1, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `user_kampus` VALUES (39, 2, 1, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `user_kampus` VALUES (15, 3, 1, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `user_kampus` VALUES (18, 4, 1, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `user_kampus` VALUES (30, 5, 1, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `user_kampus` VALUES (22, 8, 1, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `user_kampus` VALUES (47, 9, 1, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `user_kampus` VALUES (34, 10, 1, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `user_kampus` VALUES (20, 6, 1, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `user_kampus` VALUES (21, 7, 1, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `user_kampus` VALUES (35, 11, 1, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `user_kampus` VALUES (37, 12, 1, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `user_kampus` VALUES (48, 13, 1, 1, 'admin', 'admin');
-- andi split --

INSERT INTO `user_kampus` VALUES (43, 14, 1, 1, 'admin', 'admin');
-- andi split --


SET FOREIGN_KEY_CHECKS=1;