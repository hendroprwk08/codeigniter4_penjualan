-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.11-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             10.3.0.5771
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for dbpenjualan
DROP DATABASE IF EXISTS `dbpenjualan`;
CREATE DATABASE IF NOT EXISTS `dbpenjualan` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `dbpenjualan`;

-- Dumping structure for table dbpenjualan.barang
DROP TABLE IF EXISTS `barang`;
CREATE TABLE IF NOT EXISTS `barang` (
  `idbarang` varchar(3) NOT NULL,
  `namabarang` varchar(30) DEFAULT NULL,
  `hargabeli` double DEFAULT 0,
  `hargajual` double DEFAULT 0,
  `stok` int(11) DEFAULT 0,
  `idsupplier` varchar(5) DEFAULT NULL,
  `expired` datetime DEFAULT NULL,
  PRIMARY KEY (`idbarang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table dbpenjualan.barang: ~14 rows (approximately)
/*!40000 ALTER TABLE `barang` DISABLE KEYS */;
REPLACE INTO `barang` (`idbarang`, `namabarang`, `hargabeli`, `hargajual`, `stok`, `idsupplier`, `expired`) VALUES
	('B01', 'Lenovo', 5000000, 5300000, 24, 'SP010', '2017-12-02 00:00:00'),
	('B02', 'Asus AMD E205', 3000000, 3300000, 15, 'SP007', '2017-12-02 00:00:00'),
	('B03', 'Asus AMD E450', 4000000, 4800000, 14, 'SP011', '2017-12-02 00:00:00'),
	('B04', 'Asus AMD8', 6000000, 6500000, 24, 'SP002', '2017-12-02 00:00:00'),
	('B05', 'Acer core i3', 5500000, 6000000, 4, 'SP002', '2017-12-02 00:00:00'),
	('B06', 'Acer Core i5', 6500000, 7000000, 4, 'SP002', '2017-06-01 00:00:00'),
	('B07', 'Acer Core i7', 9000000, 11200000, 22, 'SP003', '2017-06-01 00:00:00'),
	('B08', 'Lenovo intel core', 2000000, 2300000, 2, 'SP003', '2017-06-01 00:00:00'),
	('B09', 'Asus core i5', 5000000, 5300000, 15, 'SP003', '2017-06-01 00:00:00'),
	('B10', 'Asus Core i7', 9500000, 10000000, 2, 'SP004', '2017-06-01 00:00:00'),
	('B11', 'Asus intel inside', 4000000, 4400000, 11, 'SP004', '2017-01-01 00:00:00'),
	('B12', 'Aser Intel inside', 3500000, 4000000, 15, 'SP004', '2017-01-01 00:00:00'),
	('B13', 'Hp core i3', 4500000, 5100000, 16, 'SP010', '2017-01-01 00:00:00'),
	('B14', 'Hp core i5', 6000000, 6300000, 13, 'SP007', '2017-01-01 00:00:00');
/*!40000 ALTER TABLE `barang` ENABLE KEYS */;

-- Dumping structure for table dbpenjualan.customer
DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `idcustomer` varchar(5) NOT NULL,
  `namacustomer` varchar(20) DEFAULT NULL,
  `telpcustomer` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`idcustomer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table dbpenjualan.customer: ~4 rows (approximately)
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
REPLACE INTO `customer` (`idcustomer`, `namacustomer`, `telpcustomer`) VALUES
	('MR001', 'Andi Ibnu Subarja', '081389889876'),
	('MR002', 'Empat Sekawan PT', '021850000'),
	('MR003', 'Bintang Emas UD', '021800000'),
	('MR005', 'Triyani akhirina', '021870000');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;

-- Dumping structure for table dbpenjualan.customer_backup
DROP TABLE IF EXISTS `customer_backup`;
CREATE TABLE IF NOT EXISTS `customer_backup` (
  `idcustomer` varchar(5) DEFAULT NULL,
  `namacustomer` varchar(20) DEFAULT NULL,
  `telpcustomer` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table dbpenjualan.customer_backup: ~4 rows (approximately)
/*!40000 ALTER TABLE `customer_backup` DISABLE KEYS */;
REPLACE INTO `customer_backup` (`idcustomer`, `namacustomer`, `telpcustomer`) VALUES
	('MR02', 'tes', '0833'),
	('jl', 'kljl', '313'),
	('klj', 'kljl', '34234'),
	('MR004', 'Yusuf', '021860000');
/*!40000 ALTER TABLE `customer_backup` ENABLE KEYS */;

-- Dumping structure for table dbpenjualan.detjual
DROP TABLE IF EXISTS `detjual`;
CREATE TABLE IF NOT EXISTS `detjual` (
  `faktur` varchar(10) DEFAULT NULL,
  `idbarang` varchar(3) DEFAULT NULL,
  `qty` int(11) DEFAULT 0,
  `harga` double DEFAULT 0,
  `diskon` double DEFAULT 0,
  KEY `FK_detjual_jual` (`faktur`),
  KEY `FK_detjual_barang` (`idbarang`),
  CONSTRAINT `FK_detjual_barang` FOREIGN KEY (`idbarang`) REFERENCES `barang` (`idbarang`),
  CONSTRAINT `FK_detjual_jual` FOREIGN KEY (`faktur`) REFERENCES `jual` (`faktur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table dbpenjualan.detjual: ~5 rows (approximately)
/*!40000 ALTER TABLE `detjual` DISABLE KEYS */;
REPLACE INTO `detjual` (`faktur`, `idbarang`, `qty`, `harga`, `diskon`) VALUES
	('FJ2002002', 'B09', 3, 5300000, 0),
	('FJ2002002', 'B11', 2, 4400000, 0),
	('FJ2002002', 'B12', 7, 4000000, 0),
	('FJ2002002', 'B06', 4, 7000000, 0),
	('FJ2002001', 'B11', 1, 4400000, 0);
/*!40000 ALTER TABLE `detjual` ENABLE KEYS */;

-- Dumping structure for function dbpenjualan.fCekStatus
DROP FUNCTION IF EXISTS `fCekStatus`;
DELIMITER //
CREATE FUNCTION `fCekStatus`(`id` varchar(5)
) RETURNS varchar(20) CHARSET utf8mb4
begin
  declare stat VARCHAR(20); 
  DECLARE st INT;
  
  set st = (select stok FROM barang WHERE idbarang = id);
  
  if st > 100  then SET stat = 'berlebih';		
  ELSEIF (st > 50 and st <= 100) then SET stat = 'cukup';		
  ELSEIF (st > 10 and st <= 50) then SET stat = 'aman';	
  ELSE SET stat = 'kurang';			  	
  end if;
  
  RETURN (stat);
END//
DELIMITER ;

-- Dumping structure for table dbpenjualan.jual
DROP TABLE IF EXISTS `jual`;
CREATE TABLE IF NOT EXISTS `jual` (
  `faktur` varchar(10) NOT NULL,
  `tanggal` datetime DEFAULT NULL,
  `idcustomer` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`faktur`),
  KEY `FK_jual_customer` (`idcustomer`),
  CONSTRAINT `FK_jual_customer` FOREIGN KEY (`idcustomer`) REFERENCES `customer` (`idcustomer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table dbpenjualan.jual: ~2 rows (approximately)
/*!40000 ALTER TABLE `jual` DISABLE KEYS */;
REPLACE INTO `jual` (`faktur`, `tanggal`, `idcustomer`) VALUES
	('FJ2002001', '2020-02-11 00:00:00', 'MR003'),
	('FJ2002002', '2020-02-11 00:00:00', 'MR001');
/*!40000 ALTER TABLE `jual` ENABLE KEYS */;

-- Dumping structure for procedure dbpenjualan.spDelJual
DROP PROCEDURE IF EXISTS `spDelJual`;
DELIMITER //
CREATE PROCEDURE `spDelJual`(
	IN `id` VARCHAR(50)
)
BEGIN
	DELETE FROM detjual WHERE faktur = id;
	DELETE FROM jual WHERE faktur = id;
END//
DELIMITER ;

-- Dumping structure for procedure dbpenjualan.spGetAllSupplier
DROP PROCEDURE IF EXISTS `spGetAllSupplier`;
DELIMITER //
CREATE PROCEDURE `spGetAllSupplier`()
BEGIN
SELECT * FROM supplier;
END//
DELIMITER ;

-- Dumping structure for procedure dbpenjualan.spInsSupplier
DROP PROCEDURE IF EXISTS `spInsSupplier`;
DELIMITER //
CREATE PROCEDURE `spInsSupplier`(
  in pid varchar(5),
  in pnama varchar(20),
  in palamat varchar(30),
  in ptelp varchar(12),
  in pemail varchar(30),
  in ppic varchar(30)
)
begin
  insert into supplier values(pid, pnama, palamat, 
         ptelp, pemail, ppic);
END//
DELIMITER ;

-- Dumping structure for table dbpenjualan.supplier
DROP TABLE IF EXISTS `supplier`;
CREATE TABLE IF NOT EXISTS `supplier` (
  `idsupplier` varchar(5) NOT NULL,
  `namasupplier` varchar(20) DEFAULT NULL,
  `alamatsupplier` varchar(30) DEFAULT NULL,
  `telpsupplier` varchar(12) DEFAULT NULL,
  `emailsupplier` varchar(30) DEFAULT NULL,
  `picsupplier` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idsupplier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table dbpenjualan.supplier: ~6 rows (approximately)
/*!40000 ALTER TABLE `supplier` DISABLE KEYS */;
REPLACE INTO `supplier` (`idsupplier`, `namasupplier`, `alamatsupplier`, `telpsupplier`, `emailsupplier`, `picsupplier`) VALUES
	('SP002', 'Tiga Roda Bagus PD', 'Depok', '021850000', 'becak@yahoo.com', 'Rasyidah'),
	('SP003', 'Batubara Corp', 'Jogjakarta', '021800000', 'batubaracorporation.com', 'Ashraf'),
	('SP004', 'Indo Tiga PT', 'Depok', '021860000', 'bertiga@yahoo.com', 'Ahmad'),
	('SP006', 'indah Jaya PT', 'Depok', '021880000', 'indahjaya@yahoo.com', 'Indah'),
	('SP007', 'Candra Jaya PT', 'Depok', '021890000', 'candrajaya@yahoo.com', 'Candra'),
	('SP010', 'Marga Jaya PT', 'Bandung', '08134563421', 'marketing@mjaya.com', 'nandi');
/*!40000 ALTER TABLE `supplier` ENABLE KEYS */;

-- Dumping structure for view dbpenjualan.vbarangsupplier
DROP VIEW IF EXISTS `vbarangsupplier`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `vbarangsupplier` (
	`idbarang` VARCHAR(3) NOT NULL COLLATE 'utf8mb4_general_ci',
	`namabarang` VARCHAR(30) NULL COLLATE 'utf8mb4_general_ci',
	`hargabeli` DOUBLE NULL,
	`hargajual` DOUBLE NULL,
	`stok` INT(11) NULL,
	`expired` DATETIME NULL,
	`idsupplier` VARCHAR(5) NULL COLLATE 'utf8mb4_general_ci',
	`namasupplier` VARCHAR(20) NULL COLLATE 'utf8mb4_general_ci'
) ENGINE=MyISAM;

-- Dumping structure for view dbpenjualan.vcompletejual
DROP VIEW IF EXISTS `vcompletejual`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `vcompletejual` (
	`faktur` VARCHAR(10) NOT NULL COLLATE 'utf8mb4_general_ci',
	`tanggal` DATETIME NULL,
	`idcustomer` VARCHAR(5) NULL COLLATE 'utf8mb4_general_ci',
	`idbarang` VARCHAR(3) NULL COLLATE 'utf8mb4_general_ci',
	`namabarang` VARCHAR(30) NULL COLLATE 'utf8mb4_general_ci',
	`harga` DOUBLE NULL,
	`qty` INT(11) NULL,
	`diskon` DOUBLE NULL
) ENGINE=MyISAM;

-- Dumping structure for view dbpenjualan.vdetjual
DROP VIEW IF EXISTS `vdetjual`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `vdetjual` (
	`faktur` VARCHAR(10) NULL COLLATE 'utf8mb4_general_ci',
	`idbarang` VARCHAR(3) NULL COLLATE 'utf8mb4_general_ci',
	`namabarang` VARCHAR(30) NULL COLLATE 'utf8mb4_general_ci',
	`harga` DOUBLE NULL,
	`qty` INT(11) NULL,
	`diskon` DOUBLE NULL,
	`jumlah` DOUBLE NULL
) ENGINE=MyISAM;

-- Dumping structure for view dbpenjualan.vjual
DROP VIEW IF EXISTS `vjual`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `vjual` (
	`faktur` VARCHAR(10) NOT NULL COLLATE 'utf8mb4_general_ci',
	`tanggal` DATETIME NULL,
	`idcustomer` VARCHAR(5) NULL COLLATE 'utf8mb4_general_ci',
	`namacustomer` VARCHAR(20) NULL COLLATE 'utf8mb4_general_ci',
	`total` DOUBLE NULL
) ENGINE=MyISAM;

-- Dumping structure for trigger dbpenjualan.delBackUpCustomer
DROP TRIGGER IF EXISTS `delBackUpCustomer`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE trigger delBackUpCustomer
BEFORE DELETE on customer 
FOR EACH row
begin
	insert into customer_backup VALUES (OLD.idcustomer, OLD.namacustomer, OLD.telpcustomer);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for view dbpenjualan.vbarangsupplier
DROP VIEW IF EXISTS `vbarangsupplier`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `vbarangsupplier`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vbarangsupplier` AS select 
Barang.idbarang, Barang.namabarang, 
Barang.hargabeli, Barang.hargajual,
Barang.stok, Barang.expired,
supplier.idsupplier, supplier.namasupplier
from barang left join supplier
on Barang.idsupplier = supplier.idsupplier ;

-- Dumping structure for view dbpenjualan.vcompletejual
DROP VIEW IF EXISTS `vcompletejual`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `vcompletejual`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vcompletejual` AS SELECT 
jual.faktur,
jual.tanggal,
jual.idcustomer, 
detjual.idbarang, 
barang.namabarang, 
detjual.harga, 
detjual.qty, 
detjual.diskon
FROM detjual 
INNER JOIN barang ON detjual.idbarang = barang.idbarang 
INNER JOIN jual ON detjual.faktur = jual.faktur ;

-- Dumping structure for view dbpenjualan.vdetjual
DROP VIEW IF EXISTS `vdetjual`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `vdetjual`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vdetjual` AS SELECT 
detjual.faktur, 
detjual.idbarang, 
barang.namabarang, 
detjual.harga, 
detjual.qty, 
detjual.diskon,   
( barang.hargajual - detjual.diskon ) * detjual.qty AS jumlah
FROM detjual INNER JOIN barang
ON detjual.idbarang = barang.idbarang ;

-- Dumping structure for view dbpenjualan.vjual
DROP VIEW IF EXISTS `vjual`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `vjual`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vjual` AS SELECT 
jual.faktur, 
jual.tanggal, 
jual.idcustomer, 
customer.namacustomer,
sum(vdetjual.jumlah) AS total
FROM
jual 
INNER JOIN customer ON jual.idcustomer = customer.idcustomer 
INNER JOIN vdetjual ON jual.faktur = vdetjual.faktur 
GROUP BY
jual.faktur, 
jual.tanggal, 
jual.idcustomer ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
