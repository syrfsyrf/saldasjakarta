-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2021 at 09:14 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_saldas`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `PROCaddOrder` (IN `INid_stock` INT(1), IN `INid_user` INT(5), IN `INqty` INT(11), OUT `OUTcd` INT(3), OUT `OUTmsg` VARCHAR(100))  BEGIN
    DECLARE curr_id INT(11);
    DECLARE new_id INT(11);
    DECLARE curr_status INT(1);
    DECLARE EXIT HANDLER FOR 1062
    BEGIN
        SET OUTcd = 99;
        SET OUTmsg = 'Error while executing PROCaddOrder';
    END;
    
    SELECT id, status
    INTO curr_id, curr_status
    FROM pesanan WHERE id_user = INid_user ORDER BY insert_date
    desc LIMIT 1;
    
    IF curr_status = 3
    THEN
        SET OUTcd = '00';
        SET OUTmsg = 'Please Finish Your Order Before Add To Cart';


    ELSEIF curr_status = 0
    THEN
        CALL PROCupdateOrder(curr_id, INid_stock, INqty, OUTcd, OUTmsg);

    ELSEIF curr_status = 1 OR curr_status = 5
    THEN
        CALL PROCcreateOrder(INid_user, 0, new_id, OUTcd, OUTmsg);

        IF OUTcd = '200'
        THEN
            SET OUTmsg = NULL;
            CALL PROCupdateOrder(new_id, INid_stock, INqty, OUTcd, OUTmsg);
        END IF;
    ELSEIF curr_status NOT IN ('5','1','0','3')
	THEN
	SET OUTcd = '99';
        SET OUTmsg = 'Error';
    ELSE
        CALL PROCcreateOrder(INid_user, 0, new_id, OUTcd, OUTmsg);

        IF OUTcd = '200'
        THEN
            SET OUTmsg = NULL;
            CALL PROCupdateOrder(new_id, INid_stock, INqty, OUTcd, OUTmsg);
        END IF;
    END IF;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PROCcalculateStock` (IN `INtype` VARCHAR(2), IN `INidPesanan` INT(11))  BEGIN
	DECLARE done INT DEFAULT 0;
	DECLARE id_stocks2 INT;

	DEClARE stocksnum 
	CURSOR FOR 
		SELECT id FROM pesanan_detail WHERE id_pesanan = INidPesanan;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

	OPEN stocksnum;
	getID: LOOP
		FETCH stocksnum INTO id_stocks2;
		IF done = 1 THEN
            LEAVE getID;
        END IF;
		IF INtype = 'ON' 
		THEN
        SELECT 1 FROM DUAL;
			
		ELSEIF INtype = 'OF'
		THEN
			UPDATE stock SET used_stok = used_stok + (SELECT kuantitas FROM pesanan_detail WHERE id = id_stocks2) 
			WHERE id = (SELECT id_stock FROM pesanan_detail WHERE id = id_stocks2);
		END IF;
	END LOOP getID;
	CLOSE stocksnum;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PROCcheckOutOrder` (IN `INtypeTrans` VARCHAR(2), IN `INidPesanan` INT(11), IN `INmetodePembayaran` INT(2), IN `INketOrder` TEXT, OUT `OUTcd` INT(3), OUT `OUTmsg` INT(100))  BEGIN
	DECLARE tranactionNum VARCHAR(100);
	SET tranactionNum = CONCAT(INtypeTrans, DATE_FORMAT(SYSDATE(), '%y%m%d'), INidPesanan);
	IF INtypeTrans = 'OF'
	THEN
		CALL PROCcalculateStock(INtypeTrans, INidPesanan);

		UPDATE pesanan SET total = (SELECT SUM((harga_stock * kuantitas)) as 'total_order_nof' FROM pesanan_detail WHERE id_pesanan = INidPesanan), 
		status = '1', is_approved = 1, tgl_pembayaran = SYSDATE(), 
		transaction_id = tranactionNum
		WHERE id = INidPesanan;
		SET OUTcd = 200;
		SET OUTmsg = CONCAT('Success check out with transaction id: ',tranactionNum);
	ELSEIF INtypeTrans = 'ON'
	THEN
		CALL PROCcalculateStock(INtypeTrans, INidPesanan);
		UPDATE pesanan SET total = (SELECT SUM((harga_stock * kuantitas)) as 'total_order_nof' FROM pesanan_detail WHERE id_pesanan = INidPesanan), 
		status = '3', metode_pembayaran = INmetodePembayaran, 
		transaction_id = tranactionNum
		WHERE id = INidPesanan;
		INSERT INTO order_job (id_pesanan, ket_order) VALUES (INidPesanan, INketOrder);
		SET OUTcd = 200;
		SET OUTmsg = CONCAT('Success check out with transaction id: ',tranactionNum);
	END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PROCcreateOrder` (IN `INid_user` INT(11), IN `INmetode_pembayaran` INT(2), OUT `OUTid_new` INT(11), OUT `OUTcd` INT(3), OUT `OUTmsg` VARCHAR(100))  BEGIN
	DECLARE EXIT HANDLER FOR 1062
    BEGIN
    SET OUTcd = 99;
 	SET OUTmsg = 'Error while executing PROCcreateOrder';
    END;
    
	INSERT INTO pesanan (id_user, metode_pembayaran)
    VALUES (INid_user, INmetode_pembayaran);
    SELECT LAST_INSERT_ID() INTO OUTid_new;
    COMMIT;
    SET OUTcd = 200;
    SET OUTmsg = 'Success Create Transaction';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PROCupdateOrder` (IN `INid` VARCHAR(11), IN `INid_stock` INT, IN `INqty` INT, OUT `OUTcd` INT(3), OUT `OUTmsg` VARCHAR(100))  BEGIN
	DECLARE curr_count INT(11);
	DECLARE EXIT HANDLER FOR 1062
    BEGIN
	    SET OUTcd = 99;
	 	SET OUTmsg = 'Error while executing PROCupdateOrder';
 	END;

	SELECT count(*) INTO curr_count FROM pesanan_detail WHERE id_pesanan = INid AND id_stock = INid_stock;
	IF curr_count > 0
	THEN
		UPDATE pesanan_detail SET kuantitas = kuantitas + INqty WHERE id_pesanan = INid AND id_stock = INid_stock;
		SET OUTcd = 200;
		SET OUTmsg = 'Success Updating';
	ELSE
		INSERT INTO pesanan_detail 
			(id_pesanan, id_produk, id_stock, harga_stock, kuantitas)
			SELECT
			INid AS id_pesanan,
			id_produk AS id_produk,
			id AS id_stock,
			harga AS harga_stock,
			INqty AS kuantitas
			FROM stock WHERE id = INid_stock;
		SET OUTcd = 200;
		SET OUTmsg = 'Success Inserting';
	END IF;	
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `alamat`
--

CREATE TABLE `alamat` (
  `id` int(11) NOT NULL,
  `id_user` varchar(11) NOT NULL,
  `jalan` text DEFAULT NULL,
  `rt` varchar(3) DEFAULT NULL,
  `rw` varchar(3) DEFAULT NULL,
  `kecamatan` varchar(50) DEFAULT NULL,
  `kelurahan` varchar(50) DEFAULT NULL,
  `kota` varchar(50) DEFAULT NULL,
  `kd_pos` varchar(5) DEFAULT NULL,
  `provinsi` varchar(50) DEFAULT NULL,
  `desa` varchar(50) DEFAULT NULL,
  `update_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `insert_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_user`
--

CREATE TABLE `data_user` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `telp` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `jenis` varchar(11) DEFAULT NULL,
  `aksi` varchar(6) DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL COMMENT '1 = aktif 0 = non aktif',
  `ip` varchar(100) DEFAULT NULL,
  `browser` varchar(100) DEFAULT NULL,
  `version` varchar(100) DEFAULT NULL,
  `platform` varchar(100) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `id_user` varchar(11) NOT NULL,
  `insert_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mst_jenis_harga`
--

CREATE TABLE `mst_jenis_harga` (
  `id` int(11) NOT NULL,
  `jenis` varchar(100) DEFAULT NULL,
  `jumlah` varchar(3) NOT NULL,
  `singkatan_berat` varchar(2) NOT NULL,
  `berat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_jenis_harga`
--

INSERT INTO `mst_jenis_harga` (`id`, `jenis`, `jumlah`, `singkatan_berat`, `berat`) VALUES
(1, '500 Gr', '500', 'Gr', 'Gram'),
(2, '1 Kg', '1', 'Kg', 'Kilo Gram'),
(3, '100 Gr', '100', 'Gr', 'Gram'),
(4, '250 Gr', '250', 'Gr', 'Gram'),
(5, '650 Gr', '650', 'Gr', 'Gram'),
(6, '300 Gr', '300', 'Gr', 'Gram');

-- --------------------------------------------------------

--
-- Table structure for table `mst_kategori`
--

CREATE TABLE `mst_kategori` (
  `id` int(11) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_kategori`
--

INSERT INTO `mst_kategori` (`id`, `jenis`, `is_active`) VALUES
(1, 'Daging Sapi', 1),
(2, 'Daging Kambing', 1),
(3, 'Daging Ayam', 1),
(4, 'Daging Ikan', 1),
(5, 'Frozen Food', 1),
(6, 'Home Made', 1),
(7, 'TESTING KATEGORI', 0);

-- --------------------------------------------------------

--
-- Table structure for table `mst_log`
--

CREATE TABLE `mst_log` (
  `id` int(11) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `tabel` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_log`
--

INSERT INTO `mst_log` (`id`, `jenis`, `tabel`) VALUES
(1, 'login', 'mst_user'),
(2, 'insert pesanan', 'pesanan');

-- --------------------------------------------------------

--
-- Table structure for table `mst_metode_pembayaran`
--

CREATE TABLE `mst_metode_pembayaran` (
  `id` int(11) NOT NULL,
  `jenis` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `metode` varchar(1) NOT NULL COMMENT '1 = online, 2 = offline',
  `offline_visibility` tinyint(1) NOT NULL,
  `acc_number` varchar(100) DEFAULT NULL,
  `acc_name` varchar(200) DEFAULT NULL,
  `bank` varchar(100) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_metode_pembayaran`
--

INSERT INTO `mst_metode_pembayaran` (`id`, `jenis`, `metode`, `offline_visibility`, `acc_number`, `acc_name`, `bank`, `is_active`) VALUES
(0, 'ONLINE', '1', 0, NULL, NULL, NULL, 0),
(1, 'CASH', '2', 1, NULL, NULL, NULL, 1),
(2, 'DEBIT BCA', '2', 1, NULL, NULL, 'BCA', 0),
(3, 'DEBIT MANDIRI', '2', 1, NULL, NULL, 'MANDIRI', 0),
(4, 'DIRECT BANK TRANSFER BCA', '1', 0, '123871923871932', 'SALDAS', 'BCA', 1),
(5, 'DIRECT BANK TRANSFER MANDIRI', '1', 0, '123', 'SALDAS', 'MANDIRI', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mst_produk`
--

CREATE TABLE `mst_produk` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `file` varchar(200) DEFAULT NULL,
  `path` varchar(200) DEFAULT './assets/uploaded/product',
  `insert_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mst_settings`
--

CREATE TABLE `mst_settings` (
  `id` int(11) NOT NULL,
  `type` varchar(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `detail` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mst_user`
--

CREATE TABLE `mst_user` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '1bed95eb46b5fad100b4c5a3bd99e0c0',
  `role` varchar(1) NOT NULL COMMENT '1 = super user 2 = admin 3 = manager 4 = kasir 5 = pembeli',
  `status` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '1' COMMENT '1 = aktif 0 = non aktif',
  `aktivasi` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '1 = aktif 0 = non aktif',
  `insert_date` timestamp NULL DEFAULT current_timestamp(),
  `created_by` varchar(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_user`
--

INSERT INTO `mst_user` (`id`, `username`, `nama`, `password`, `role`, `status`, `aktivasi`, `insert_date`, `created_by`) VALUES
(1, 'superadmin', 'Syarief Hidayatullah', '858227e6c04bbadca0f5d44827aab219', '1', '1', '1', '2021-11-13 09:44:57', '1'),
(2, 'admin', 'Anrico Ananda Putra', 'be89e250d8388c5e7ded2f1630e5daa4', '2', '1', '1', '2021-11-13 09:44:57', '1'),
(3, 'owner', 'Rizki Irwandi', '3e089c076bf1ec3a8332280ee35c28d4', '3', '1', '1', '2021-11-13 09:44:57', '1'),
(4, 'kasir', 'kasir', 'c7911af3adbd12a035b289556d96470a', '4', '1', '1', '2021-11-13 09:44:57', '1');

-- --------------------------------------------------------

--
-- Table structure for table `order_job`
--

CREATE TABLE `order_job` (
  `id` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `ket_order` text NOT NULL,
  `file` varchar(200) DEFAULT NULL,
  `directory` varchar(200) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `approved_by` varchar(11) DEFAULT NULL,
  `approved_date` timestamp NULL DEFAULT NULL,
  `insert_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `transaction_id` varchar(100) NOT NULL,
  `id_user` varchar(11) NOT NULL,
  `metode_pembayaran` int(11) DEFAULT 0,
  `tgl_pembayaran` datetime DEFAULT NULL,
  `tgl_expired_pembayaran` datetime DEFAULT NULL,
  `total` int(11) DEFAULT 0,
  `status` varchar(1) NOT NULL DEFAULT '0' COMMENT '1 = lunas, 0 = belum lunas, 3 = on progress, 5 = delete',
  `is_approved` tinyint(1) DEFAULT NULL,
  `insert_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `pesanan`
--
DELIMITER $$
CREATE TRIGGER `TRG_PESANAN_INS` AFTER INSERT ON `pesanan` FOR EACH ROW BEGIN
	DECLARE s_SYSDATE CHAR(14);
    
    SELECT DATE_FORMAT(SYSDATE(), '%Y%m%d%H%i%s') INTO s_SYSDATE FROM DUAL;
    
    INSERT INTO log (jenis, aksi, catatan, id_user) VALUES ('2', 'INSERT', s_SYSDATE, '1');
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_detail`
--

CREATE TABLE `pesanan_detail` (
  `id` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_stock` int(11) NOT NULL,
  `harga_stock` int(11) DEFAULT NULL,
  `kuantitas` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `insert_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(11) NOT NULL,
  `bulan_tahun` date DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  `total` int(11) NOT NULL DEFAULT 0,
  `generate_by` varchar(11) DEFAULT NULL,
  `insert_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah_stok` int(11) DEFAULT NULL,
  `harga` varchar(11) DEFAULT NULL,
  `jenis_harga` int(11) NOT NULL,
  `jenis_harga_detail` varchar(100) DEFAULT NULL,
  `tgl_expired` date DEFAULT NULL,
  `used_stok` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `hold_stock` int(11) NOT NULL DEFAULT 0,
  `status` varchar(1) NOT NULL DEFAULT '1' COMMENT '1 = aktif 0 = non aktif',
  `insert_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_berat`
--

CREATE TABLE `tb_berat` (
  `id` int(11) NOT NULL,
  `singkatan_berat` varchar(3) NOT NULL,
  `berat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_berat`
--

INSERT INTO `tb_berat` (`id`, `singkatan_berat`, `berat`) VALUES
(1, 'Kg', 'Kilo Gram'),
(2, 'Gr', 'Gram');

-- --------------------------------------------------------

--
-- Table structure for table `tb_menu`
--

CREATE TABLE `tb_menu` (
  `ID` int(11) NOT NULL,
  `NAMA_MENU` varchar(30) DEFAULT NULL,
  `URL` text DEFAULT NULL,
  `ROLE` varchar(7) DEFAULT NULL,
  `IS_PARENT` varchar(1) DEFAULT NULL,
  `PARENT` varchar(2) DEFAULT NULL,
  `CHILD` varchar(2) DEFAULT NULL,
  `SUBCHILD` varchar(2) DEFAULT NULL,
  `MENU` varchar(2) DEFAULT NULL,
  `MENU_TEXT` varchar(30) DEFAULT NULL,
  `URUTAN` int(11) DEFAULT NULL,
  `ICON` text DEFAULT NULL,
  `UPDATE_DATE` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `INSERT_DATE` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_menu`
--

INSERT INTO `tb_menu` (`ID`, `NAMA_MENU`, `URL`, `ROLE`, `IS_PARENT`, `PARENT`, `CHILD`, `SUBCHILD`, `MENU`, `MENU_TEXT`, `URUTAN`, `ICON`, `UPDATE_DATE`, `INSERT_DATE`) VALUES
(1, 'Dashboard', 'Dashboard', '1|2|3|4', 'Y', '1', 'N', NULL, '1', 'MENU', 1, 'nav-icon fas fa-tachometer-alt', '2021-11-17 18:42:37', '2021-04-15 23:31:55'),
(2, 'Produk', '#', '2', 'Y', '2', 'Y', NULL, '2', 'MASTER DATA', 10, 'nav-icon fas fa-database', '2021-11-18 20:42:34', '2021-04-15 23:33:07'),
(3, 'Manage Produk', 'Produk/manage', '1|2|4', NULL, '2', NULL, NULL, '1', 'MENU', 11, NULL, '2021-11-18 20:39:49', '2021-04-15 23:37:14'),
(4, 'Transaksi & Pendapatan', '#', '1|3', 'Y', '4', 'Y', NULL, '2', 'MASTER DATA', 20, 'nav-icon fas fa-database', '2021-11-17 18:42:37', '2021-04-15 23:33:07'),
(5, 'Transaksi', 'Transaksi', '1|3', NULL, '4', NULL, NULL, '1', 'MENU', 21, NULL, '2021-11-17 18:42:37', '2021-04-15 23:37:14'),
(6, 'Master Data', '#', '1', 'Y', '6', 'Y', NULL, '2', 'MASTER DATA', 50, 'nav-icon fas fa-database', '2021-11-17 18:42:37', '2021-04-15 23:33:07'),
(7, 'Product Category', 'Master/kategori', '1', NULL, '6', NULL, NULL, '1', 'MENU', 51, NULL, '2021-11-17 18:42:37', '2021-04-15 23:37:14'),
(8, 'Price Type', 'Master/jenisHarga', '1', NULL, '6', NULL, NULL, '1', 'MENU', 55, NULL, '2021-11-17 18:42:37', '2021-04-15 23:37:14'),
(9, 'Pembayaran', '#', '1|2', 'Y', '9', 'Y', NULL, '2', 'MASTER DATA', 30, 'nav-icon fas fa-database', '2021-11-18 20:40:00', '2021-04-15 23:33:07'),
(10, 'Manage Pembayaran', '#', '1', NULL, '9', NULL, NULL, '1', 'MENU', 31, NULL, '2021-11-17 18:42:37', '2021-04-15 23:37:14'),
(11, 'Settings', '#', '1', 'Y', '11', 'Y', NULL, '3', 'MASTER DATA', 60, 'nav-icon fas fa-database', '2021-11-17 18:42:37', '0000-00-00 00:00:00'),
(12, 'Menus', '#', '1', NULL, '11', NULL, NULL, '3', 'MENU', 61, NULL, '2021-11-17 18:42:37', '0000-00-00 00:00:00'),
(13, 'Approve Pembayaran', 'Pembayaran/approve', '2|3', NULL, '9', NULL, NULL, '1', 'MENU', 32, NULL, '2021-11-17 18:42:37', '2021-04-15 23:37:14'),
(14, 'Pendapatan', 'Transaksi/pendapatan', '1|3', NULL, '4', NULL, NULL, '1', 'MENU', 22, NULL, '2021-11-17 18:42:37', '2021-04-15 23:37:14'),
(15, 'Report', 'Transaksi/report', '3', NULL, '4', NULL, NULL, '1', 'MENU', 23, NULL, '2021-11-17 18:42:37', '2021-04-15 23:37:14'),
(16, 'Users', 'Master/users', '1', NULL, '6', NULL, NULL, '1', 'MENU', 57, NULL, '2021-11-17 18:42:37', '2021-04-15 23:37:14'),
(17, 'Logs', '#', '1', 'Y', '17', 'Y', NULL, '2', 'MASTER DATA', 40, 'nav-icon fas fa-database', '2021-11-17 18:42:37', '2021-04-15 23:33:07'),
(18, 'Activity Log', '#', '1', NULL, '17', NULL, NULL, '1', 'MENU', 41, NULL, '2021-11-17 18:42:37', '2021-04-15 23:37:14'),
(19, 'Log Type', '#', '1', NULL, '17', NULL, NULL, '1', 'MENU', 42, NULL, '2021-11-17 18:42:37', '2021-04-15 23:37:14'),
(20, 'User Type', '#', '1', NULL, '11', NULL, NULL, '3', 'MENU', 62, NULL, '2021-11-17 18:42:37', '0000-00-00 00:00:00'),
(21, 'Access Control List', '#', '1', NULL, '11', NULL, NULL, '3', 'MENU', 63, NULL, '2021-11-17 18:42:37', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_status_pesanan`
--

CREATE TABLE `tb_status_pesanan` (
  `id` int(11) NOT NULL,
  `detail` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_status_pesanan`
--

INSERT INTO `tb_status_pesanan` (`id`, `detail`) VALUES
(0, 'ON PROGRESS'),
(1, 'LUNAS'),
(3, 'PENDING'),
(5, 'CANCELLED');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `user` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `user`) VALUES
(1, 'Super User'),
(2, 'Admin'),
(3, 'Owner'),
(4, 'Kasir'),
(5, 'Pembeli');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alamat`
--
ALTER TABLE `alamat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_user`
--
ALTER TABLE `data_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_jenis_harga`
--
ALTER TABLE `mst_jenis_harga`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_kategori`
--
ALTER TABLE `mst_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_log`
--
ALTER TABLE `mst_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_metode_pembayaran`
--
ALTER TABLE `mst_metode_pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_produk`
--
ALTER TABLE `mst_produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `mst_settings`
--
ALTER TABLE `mst_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_user`
--
ALTER TABLE `mst_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `order_job`
--
ALTER TABLE `order_job`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_pesanan` (`id_pesanan`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `metode_pembayaran` (`metode_pembayaran`);

--
-- Indexes for table `pesanan_detail`
--
ALTER TABLE `pesanan_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pesanan` (`id_pesanan`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_stock` (`id_stock`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `jenis_harga` (`jenis_harga`);

--
-- Indexes for table `tb_berat`
--
ALTER TABLE `tb_berat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_menu`
--
ALTER TABLE `tb_menu`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tb_status_pesanan`
--
ALTER TABLE `tb_status_pesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alamat`
--
ALTER TABLE `alamat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_user`
--
ALTER TABLE `data_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mst_jenis_harga`
--
ALTER TABLE `mst_jenis_harga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mst_kategori`
--
ALTER TABLE `mst_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mst_log`
--
ALTER TABLE `mst_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mst_metode_pembayaran`
--
ALTER TABLE `mst_metode_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mst_produk`
--
ALTER TABLE `mst_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mst_user`
--
ALTER TABLE `mst_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_job`
--
ALTER TABLE `order_job`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pesanan_detail`
--
ALTER TABLE `pesanan_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_berat`
--
ALTER TABLE `tb_berat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_menu`
--
ALTER TABLE `tb_menu`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tb_status_pesanan`
--
ALTER TABLE `tb_status_pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mst_produk`
--
ALTER TABLE `mst_produk`
  ADD CONSTRAINT `mst_produk_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `mst_kategori` (`id`);

--
-- Constraints for table `pesanan_detail`
--
ALTER TABLE `pesanan_detail`
  ADD CONSTRAINT `pesanan_detail_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
