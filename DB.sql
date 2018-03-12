-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 10.1.13-MariaDB - mariadb.org binary distribution
-- OS Server:                    Win32
-- HeidiSQL Versi:               9.4.0.5154
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Membuang struktur basisdata untuk warungayam
CREATE DATABASE IF NOT EXISTS `warungayam` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `warungayam`;

-- membuang struktur untuk table warungayam.detailtransaksi
CREATE TABLE IF NOT EXISTS `detailtransaksi` (
  `notransaksi` bigint(20) DEFAULT NULL,
  `idmenu` int(4) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  KEY `FK_Transaksi` (`notransaksi`),
  KEY `FK_Menu` (`idmenu`),
  CONSTRAINT `FK_Menu` FOREIGN KEY (`idmenu`) REFERENCES `menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_Transaksi` FOREIGN KEY (`notransaksi`) REFERENCES `transaksi` (`notransaksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel warungayam.detailtransaksi: ~26 rows (lebih kurang)
/*!40000 ALTER TABLE `detailtransaksi` DISABLE KEYS */;
REPLACE INTO `detailtransaksi` (`notransaksi`, `idmenu`, `jumlah`) VALUES
	(1, 2, 2),
	(1, 5, 1),
	(2, 1, 2),
	(2, 2, 2),
	(2, 4, 1),
	(3, 1, 1),
	(3, 2, 1),
	(3, 3, 1),
	(3, 5, 1),
	(3, 6, 1),
	(3, 4, 1),
	(4, 1, 2),
	(4, 6, 1),
	(4, 4, 1),
	(4, 5, 3),
	(5, 1, 1),
	(5, 3, 2),
	(5, 5, 1),
	(5, 11, 1),
	(6, 2, 2),
	(6, 6, 2),
	(6, 11, 1),
	(7, 1, 1),
	(7, 2, 3),
	(7, 3, 1),
	(7, 5, 1),
	(8, 1, 1),
	(8, 2, 2);
/*!40000 ALTER TABLE `detailtransaksi` ENABLE KEYS */;

-- membuang struktur untuk table warungayam.menu
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `nama` varchar(30) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `image` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nama` (`nama`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel warungayam.menu: ~12 rows (lebih kurang)
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
REPLACE INTO `menu` (`id`, `nama`, `harga`, `image`) VALUES
	(1, 'Ayam Bakar', 11000, 'Menu_AyamBakar.png'),
	(2, 'Ayam Bakar + Kremes', 11500, 'Menu_AyamBakarKremes.png'),
	(3, 'Paket Ayam Goreng', 17500, 'Menu_AyamGoreng.png'),
	(4, 'Paket Ayam Bakar', 18500, 'Menu_PaketAyamBakar.png'),
	(5, 'Paket Bebek Goreng', 23500, 'Menu_PaketBebekGoreng.png'),
	(6, 'Paket Bebek Bakar', 24500, 'Menu_PaketBebekBakar.png'),
	(7, 'Paket Bandeng Presto', 18500, 'Menu_PaketBandengPresto.png'),
	(8, 'Paket Nila Goreng', 18500, 'Menu_PaketNilaGoreng.png'),
	(9, 'Paket Hemat 1', 10000, 'Menu_PaketHemat1.png'),
	(10, 'Paket Hemat 2', 11000, 'Menu_PaketHemat2.png'),
	(11, 'Paket Hemat 3', 13000, 'Menu_PaketHemat3.png'),
	(12, 'Paket Hemat 4', 15000, 'Menu_PaketHemat4.png');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;

-- membuang struktur untuk table warungayam.transaksi
CREATE TABLE IF NOT EXISTS `transaksi` (
  `notransaksi` bigint(20) NOT NULL AUTO_INCREMENT,
  `jumlah` int(4) DEFAULT NULL,
  `kembali` int(11) DEFAULT NULL,
  `userid` varchar(20) DEFAULT NULL,
  `waktu` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`notransaksi`),
  KEY `FK_User` (`userid`),
  CONSTRAINT `FK_User` FOREIGN KEY (`userid`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel warungayam.transaksi: ~5 rows (lebih kurang)
/*!40000 ALTER TABLE `transaksi` DISABLE KEYS */;
REPLACE INTO `transaksi` (`notransaksi`, `jumlah`, `kembali`, `userid`, `waktu`) VALUES
	(1, 46500, 3500, 'yandi', '2016-12-20 01:44:35'),
	(2, 63500, 6500, 'yandi', '2016-12-20 14:59:21'),
	(3, 106500, 43500, 'yandi', '2016-12-20 19:25:31'),
	(4, 135500, 14500, 'yandi', '2016-12-20 19:29:58'),
	(5, 82500, 17500, 'yandi', '2016-12-20 19:58:31'),
	(6, 85000, 15000, 'yandi', '2016-12-20 20:01:17'),
	(7, 86500, 3500, 'yandi', '2017-04-22 13:57:15'),
	(8, 34000, 16000, 'yandi', '2017-05-29 08:23:21');
/*!40000 ALTER TABLE `transaksi` ENABLE KEYS */;

-- membuang struktur untuk table warungayam.user
CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nama` varchar(35) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  PRIMARY KEY (`username`),
  KEY `password` (`password`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel warungayam.user: ~2 rows (lebih kurang)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
REPLACE INTO `user` (`username`, `password`, `nama`, `level`) VALUES
	('tole', 'mindmindmind', 'Tolemindfreak', 2),
	('yandi', 'mindmindmind', 'Muhammad Rusdyanto', 1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
