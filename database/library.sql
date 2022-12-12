-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.25-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.2.0.6576
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table library.books
CREATE TABLE IF NOT EXISTS `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(50) DEFAULT NULL,
  `pengarang` varchar(30) DEFAULT NULL,
  `penerbit` varchar(30) DEFAULT NULL,
  `isbn` char(9) DEFAULT NULL,
  `tahun_terbit` year(4) DEFAULT NULL,
  `gambar` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=176 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table library.books: ~20 rows (approximately)
INSERT INTO `books` (`id`, `judul`, `pengarang`, `penerbit`, `isbn`, `tahun_terbit`, `gambar`) VALUES
	(1, 'You Do You', 'Fellexandro Ruby', 'PT. Gramedia', '237419872', '2017', 'you.jpg'),
	(2, 'The Origin', 'Dan Brown', 'PT. Jendela Dunia', '948239817', '2017', 'origin.jpg'),
	(4, 'Atomic Habits', 'James Clear', 'PT. Buku Baru', '923792347', '2022', 'atomic.jpg'),
	(5, 'Rich Dad Poor Dad', 'Robert Kiyosaki', 'PT. Buku Dunia', '913284018', '2021', 'richdad.jpg'),
	(6, 'How to Escape The Matrix', 'Andrew Tate', 'PT. Cobra Tate', '759247994', '2021', 'matrix.jpg'),
	(7, 'How to Become Rich', 'Jim Rohn', 'PT. Great Books', '123481094', '2021', 'rich.jpg'),
	(8, 'How to Become Strong Man', 'Jordan Peterson', 'PT. Real Man', '328947198', '2019', 'strong.jpg'),
	(9, 'How to Become Succesful', 'Elon Musk', 'PT. Entrepeneur', '923471974', '2020', 'success.jpg'),
	(66, 'Lord Of The Rings', 'Dale Carnegie', 'PT. Imajinasi', '123987563', '2017', 'lord.jpg'),
	(67, 'Da Vinci Code', 'Dan Brown', 'PT. Jendela Dunia', '758294086', '2012', 'davinci.jpg'),
	(163, 'Kamu Terlalu Banyak Bercanda', 'Marchella FP', 'PT. Gramedia', '732491183', '2018', '639420ef414fa.jpg'),
	(164, 'Generasi Kembali ke Akar', 'Muhammad Faisal', 'PT. Baca Buku', '123847197', '2018', '63942123cdf2d.jpg'),
	(165, 'Ku Antar ke Gerbang', 'Ramadhan KH', 'PT. Kutu Buku', '823147189', '2020', '6394218d2bee5.jpg'),
	(166, 'Guru Aini', 'Andrea Hirata', 'PT. Rumah Buku', '721487212', '2020', '639421ce611ed.jpg'),
	(167, 'Jika Kita Tak Jadi Apa - Apa', 'Alvi Syahrin', 'PT. Gramedia', '347187272', '2023', '639422032932e.jpg'),
	(168, 'Perjamun Khong Guan', 'Joko Pinurbo', 'PT. Gramedia', '247129847', '2022', '6394222e1168a.jpg'),
	(169, 'Seni Membuat Hidup Lebih Ringan', 'Francine Jay', 'PT. Gramedia', '327489174', '2020', '6394228333899.jpg'),
	(170, 'Sunny Everywhere', 'Sunny Dahye', 'PT. Gramedia', '238471894', '2019', '639422b055081.jpg'),
	(171, 'Techno Preneur Ship', 'Eko Suhartanto', 'PT. Buku Berkembang', '724174983', '2017', '639422e5889c7.jpg'),
	(172, 'Filosofi Teras', 'Henry Manampiring', 'PT. Baca Buku', '723481748', '2020', '6394241b0df99.jpg');

-- Dumping structure for table library.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table library.users: ~1 rows (approximately)
INSERT INTO `users` (`id`, `username`, `password`) VALUES
	(12, 'user', '$2y$10$bTSvjYKGW84YelW/2kQwKe/DquaFiawDaXspyTTcDH/1/EK/N6Cb2'),
	(17, 'admin', '$2y$10$/xV.ZBS0SG8lSrGziY18nuEuB81XA7mtbamo0J90B51/nSgQTHrCe');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
