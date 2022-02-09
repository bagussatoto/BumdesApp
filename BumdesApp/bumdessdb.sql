-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2020 at 07:49 PM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bumdessdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` varchar(15) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `kategori` varchar(10) NOT NULL,
  `kontak` varchar(15) DEFAULT NULL,
  `foto_user` varchar(20) DEFAULT NULL,
  `waktu_reg` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `email`, `password`, `kategori`, `kontak`, `foto_user`, `waktu_reg`) VALUES
('0081578813144', 'Steve rogers', '15523231@students.uii.ac.id', '25d55ad283aa400af464c76d713c07ad', 'GOV', '0832-5604-0453', '8001586623283.jpg', '2020-03-10 02:09:11'),
('0081585629042', 'Tony stark', 'prabowoa63@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'MNG', '030502060306', '8001586585613.jpg', '2020-03-31 11:30:42'),
('0081586049510', 'Administrator', 'sistemwebbumdij@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'SYS', NULL, '8001586025005.jpg', '2020-04-05 01:18:30');

--
-- Triggers `admin`
--
DELIMITER $$
CREATE TRIGGER `hapus_admin` BEFORE DELETE ON `admin` FOR EACH ROW BEGIN
	UPDATE log_admin SET admin=NULL, del_ad=old.nama WHERE admin=old.id_admin;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `aset`
--

CREATE TABLE `aset` (
  `id_aset` varchar(15) NOT NULL,
  `nomor_aset` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `sumber` varchar(10) NOT NULL,
  `harga_aset` int(11) DEFAULT NULL,
  `lokasi` varchar(100) NOT NULL,
  `kondisi` varchar(10) NOT NULL,
  `keadaan` varchar(10) NOT NULL,
  `gambar` varchar(20) DEFAULT NULL,
  `tanggal_masuk` date NOT NULL,
  `ket_aset` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aset`
--

INSERT INTO `aset` (`id_aset`, `nomor_aset`, `nama`, `sumber`, `harga_aset`, `lokasi`, `kondisi`, `keadaan`, `gambar`, `tanggal_masuk`, `ket_aset`) VALUES
('0051585410835', 'ASET/CONTOH', 'Mobil 1', 'Non-beli', NULL, 'Kalipuru', 'Baru', 'Baik', '3001585830162.jpg', '2020-03-28', NULL),
('0051585410896', 'ASET/CONTOH-004', 'Mobil bagus', 'Beli', 7000000, 'Kalipuru', 'Bekas', 'Baik', '3001585830251.jpg', '2020-03-28', NULL),
('0051585552294', 'ASET/2020/M-AIRCRAFT/0306/7', 'Boeing 747 - 8 Presidential Version', 'Beli', 560000, 'Kebumen', 'Baru', 'Baik', '3001585830016.jpg', '2020-03-30', NULL),
('0051588781759', '004/05/AST/BMDS/034', 'Sepeda motor', 'Beli', 80000000, 'Kalipuru 1', 'Baru', 'Baik', '0031588781759.png', '2020-05-06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `aset_disewakan`
--

CREATE TABLE `aset_disewakan` (
  `id_aset_sewa` varchar(15) NOT NULL,
  `aset_sw` varchar(15) NOT NULL,
  `harga_sewa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aset_disewakan`
--

INSERT INTO `aset_disewakan` (`id_aset_sewa`, `aset_sw`, `harga_sewa`) VALUES
('0031585412684', '0051585410835', 500000),
('0031588232943', '0051585410896', 710000);

-- --------------------------------------------------------

--
-- Table structure for table `bagi_hasil_aset`
--

CREATE TABLE `bagi_hasil_aset` (
  `id_bgh` varchar(15) NOT NULL,
  `deld_aset` varchar(100) DEFAULT NULL,
  `aset_bh` varchar(15) DEFAULT NULL,
  `aset_luar` varchar(100) DEFAULT NULL,
  `mitra` varchar(15) NOT NULL,
  `pers_bumdes` int(11) NOT NULL,
  `pers_mitra` int(11) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `status_bgh` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bagi_hasil_aset`
--

INSERT INTO `bagi_hasil_aset` (`id_bgh`, `deld_aset`, `aset_bh`, `aset_luar`, `mitra`, `pers_bumdes`, `pers_mitra`, `tanggal_mulai`, `tanggal_selesai`, `status_bgh`) VALUES
('0041585415114', NULL, '0051585410896', NULL, '0071585410227', 80, 20, '2020-03-29', '2021-11-29', 'Batal'),
('0041587821581', NULL, '0051585552294', NULL, '0071585554912', 40, 60, '2020-04-25', '2021-07-25', NULL),
('0041588233030', NULL, NULL, 'Motor', '0071585410227', 30, 70, '2020-04-30', '2021-04-30', 'Batal');

-- --------------------------------------------------------

--
-- Table structure for table `dividen_profit`
--

CREATE TABLE `dividen_profit` (
  `id_gdiv` varchar(15) NOT NULL,
  `jumlah_div` int(11) DEFAULT NULL,
  `tahun_div` varchar(5) NOT NULL,
  `cat_gdiv` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dividen_profit`
--

INSERT INTO `dividen_profit` (`id_gdiv`, `jumlah_div`, `tahun_div`, `cat_gdiv`) VALUES
('0091585550331', 10000000, '2019', 'Nah, mungkin banyak yang bingung apa dan untuk apa activation function? Sesuai dengan namanya, activation function befungsi untuk menentukan apakah neuron tersebut harus “aktif” atau tidak berdasarkan dari weighted sum dari input. Secara umum terdapat 2 jenis activation function, Linear dan Non-Linear Activation function.'),
('0091588233151', 9000000, '2020', NULL),
('0091591615431', 1200000, '2020', '');

--
-- Triggers `dividen_profit`
--
DELIMITER $$
CREATE TRIGGER `hapus_penerima` BEFORE DELETE ON `dividen_profit` FOR EACH ROW BEGIN
	DELETE FROM penerima_dividen WHERE id_div = old.id_gdiv;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `histori_harga_komoditas`
--

CREATE TABLE `histori_harga_komoditas` (
  `id_temp` int(11) NOT NULL,
  `komoditas` varchar(15) NOT NULL,
  `jenis` varchar(5) NOT NULL,
  `harga_lama` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `histori_harga_komoditas`
--

INSERT INTO `histori_harga_komoditas` (`id_temp`, `komoditas`, `jenis`, `harga_lama`, `tanggal`) VALUES
(1, '0071585408307', 'BELI', 12000, '2020-04-15'),
(2, '0071585408307', 'JUAL', 20000, '2020-04-15'),
(3, '0071585408307', 'BELI', 12500, '2020-04-15'),
(4, '0071585408307', 'BELI', 13500, '2020-04-15'),
(5, '0071585408307', 'JUAL', 21000, '2020-05-04'),
(6, '0071587976593', 'BELI', 15000, '2020-05-07');

-- --------------------------------------------------------

--
-- Table structure for table `komoditas`
--

CREATE TABLE `komoditas` (
  `id_kom` varchar(15) NOT NULL,
  `nama_komoditas` varchar(30) NOT NULL,
  `harga_jual` int(11) DEFAULT NULL,
  `harga_beli` int(11) DEFAULT NULL,
  `sat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `komoditas`
--

INSERT INTO `komoditas` (`id_kom`, `nama_komoditas`, `harga_jual`, `harga_beli`, `sat`) VALUES
('0071585408307', 'Telur', 30000, 14500, 1),
('0071587976593', 'Beras', 25000, 14000, 1);

--
-- Triggers `komoditas`
--
DELIMITER $$
CREATE TRIGGER `hapus_komoditas` BEFORE DELETE ON `komoditas` FOR EACH ROW BEGIN
	DELETE FROM histori_harga_komoditas WHERE komoditas = old.id_kom;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `perubahan_harga` AFTER UPDATE ON `komoditas` FOR EACH ROW BEGIN

    IF new.harga_beli <> old.harga_beli THEN
    	INSERT INTO `histori_harga_komoditas` (`komoditas`, `jenis`, `harga_lama`, `tanggal`) VALUES (new.id_kom, 'BELI', old.harga_beli, NOW());
    END IF;
    
    IF new.harga_jual <> old.harga_jual THEN
    	INSERT INTO `histori_harga_komoditas` (`komoditas`, `jenis`, `harga_lama`, `tanggal`) VALUES (new.id_kom, 'JUAL', old.harga_jual, NOW());
    END IF;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `log_admin`
--

CREATE TABLE `log_admin` (
  `id_temp` int(11) NOT NULL,
  `log` text NOT NULL,
  `admin` varchar(15) DEFAULT NULL,
  `del_ad` varchar(50) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `waktu` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_admin`
--

INSERT INTO `log_admin` (`id_temp`, `log`, `admin`, `del_ad`, `tanggal`, `waktu`) VALUES
(1, '[PRIVATE] Masuk ke sistem web pada 12-08-2020 09:35:17', '0081585629042', NULL, '2020-08-12', '09:35:17'),
(2, '[PRIVATE] Masuk ke sistem web pada 12-08-2020 10:00:13', '0081585629042', NULL, '2020-08-12', '10:00:13'),
(3, '[PRIVATE] Masuk ke sistem web pada 12-08-2020 10:02:07', '0081585629042', NULL, '2020-08-12', '10:02:07'),
(4, '[TAMBAH][KEUANGAN][STOK MASUK][0061597210053][0011597210053] Menambah arus kas keluar (Kredit) untuk pembelian Telur sebanyak 20 Kg', '0081585629042', NULL, '2020-08-12', '12:27:33'),
(5, '[TAMBAH][STOK MASUK][0011597210053] Penambahan stok masuk Telur sebanyak 20 Kg dengan cara Beli', '0081585629042', NULL, '2020-08-12', '12:27:33'),
(6, '[TAMBAH][KEUANGAN][STOK KELUAR][0061597210280][0011597210280] Menambah arus kas masuk (Debit) untuk penjualan Telur sebanyak 51.5 Kg', '0081585629042', NULL, '2020-08-12', '12:31:20'),
(7, '[TAMBAH][STOK KELUAR][0011597210280] Stok Telur keluar sebanyak 51.5 Kg untuk Distribusi kepada PT. Margomulyo nasi goreng', '0081585629042', NULL, '2020-08-12', '12:31:20'),
(8, '[PRIVATE] Masuk ke sistem web pada 12-08-2020 15:02:41', '0081585629042', NULL, '2020-08-12', '15:02:41'),
(9, '[PRIVATE] Masuk ke sistem web pada 14-08-2020 11:05:14', '0081585629042', NULL, '2020-08-14', '11:05:14'),
(10, '[PRIVATE] Masuk ke sistem web pada 14-08-2020 11:11:04', '0081578813144', NULL, '2020-08-14', '11:11:04'),
(11, '[PRIVATE] Masuk ke sistem web pada 14-08-2020 14:41:37', '0081578813144', NULL, '2020-08-14', '14:41:37'),
(12, '[PRIVATE] Masuk ke sistem web pada 18-08-2020 22:08:36', '0081585629042', NULL, '2020-08-18', '22:08:36'),
(13, '[PRIVATE] Masuk ke sistem web pada 19-08-2020 14:40:11', '0081585629042', NULL, '2020-08-19', '14:40:11'),
(14, '[PRIVATE] Masuk ke sistem web pada 19-08-2020 18:56:43', '0081585629042', NULL, '2020-08-19', '18:56:43'),
(15, '[PRIVATE] Masuk ke sistem web pada 20-08-2020 08:13:20', '0081585629042', NULL, '2020-08-20', '08:13:20'),
(16, '[PRIVATE] Masuk ke sistem web pada 02-09-2020 14:56:30', '0081585629042', NULL, '2020-09-02', '14:56:30'),
(17, '[TAMBAH][KEUANGAN][STOK MASUK][0061599033572][0011599033572] Menambah arus kas keluar (Kredit) untuk pembelian Beras sebanyak 10 Kg', '0081585629042', NULL, '2020-09-02', '14:59:32'),
(18, '[TAMBAH][STOK MASUK][0011599033572] Penambahan stok masuk Beras sebanyak 10 Kg dengan cara Beli', '0081585629042', NULL, '2020-09-02', '14:59:32'),
(19, '[PRIVATE] Masuk ke sistem web pada 03-09-2020 07:53:14', '0081585629042', NULL, '2020-09-03', '07:53:14'),
(20, '[PRIVATE] Masuk ke sistem web pada 03-09-2020 13:17:04', '0081585629042', NULL, '2020-09-03', '13:17:04'),
(21, '[PRIVATE] Masuk ke sistem web pada 03-09-2020 14:01:56', '0081585629042', NULL, '2020-09-03', '14:01:56'),
(22, '[TAMBAH][KEUANGAN][STOK KELUAR][0061599116632][0011599116632] Menambah arus kas masuk (Debit) untuk penjualan Telur sebanyak 90 Kg', '0081585629042', NULL, '2020-09-03', '14:03:52'),
(23, '[TAMBAH][STOK KELUAR][0011599116632] Stok Telur keluar sebanyak 90 Kg untuk Distribusi kepada PT. Margomulyo nasi goreng', '0081585629042', NULL, '2020-09-03', '14:03:52'),
(24, '[PRIVATE] Masuk ke sistem web pada 03-09-2020 14:20:16', '0081585629042', NULL, '2020-09-03', '14:20:16');

-- --------------------------------------------------------

--
-- Table structure for table `mitra`
--

CREATE TABLE `mitra` (
  `id_mitra` varchar(15) NOT NULL,
  `nama_mitra` varchar(50) NOT NULL,
  `penanggung_jawab` varchar(30) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `kontak_1` varchar(20) NOT NULL,
  `kontak_2` varchar(20) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mitra`
--

INSERT INTO `mitra` (`id_mitra`, `nama_mitra`, `penanggung_jawab`, `alamat`, `kontak_1`, `kontak_2`, `status`) VALUES
('0071585410227', 'PT. Margomulyo nasi goreng', 'Steven chow', 'Jln. Kaliurang', '040560780456', NULL, NULL),
('0071585554912', 'Saudi Aramco Co., Ltd', 'Black widow', 'Indonesia', '090908088787', NULL, NULL),
('0071588072959', 'Pertamina', 'Erick tohir', 'Jakarta', '00000000000', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pemb_bagi_hasil`
--

CREATE TABLE `pemb_bagi_hasil` (
  `id_pbgh` varchar(15) NOT NULL,
  `id_bagi` varchar(15) DEFAULT NULL,
  `pen_bumdes` int(11) NOT NULL,
  `pen_mitra` int(11) NOT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `catatan` varchar(100) NOT NULL,
  `tanggal_bayar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemb_bagi_hasil`
--

INSERT INTO `pemb_bagi_hasil` (`id_pbgh`, `id_bagi`, `pen_bumdes`, `pen_mitra`, `jumlah`, `catatan`, `tanggal_bayar`) VALUES
('4001585990026', '0041585415114', 720000, 180000, 900000, 'Pembayaran 2', '2020-03-04'),
('4001585990040', '0041585415114', 200000, 700000, 900000, 'Pembayaran 1', '2020-04-04'),
('4001585990127', '0041585415114', 300000, 600000, 1000000, 'Pembayaran ke 3', '2020-04-04'),
('4001586611878', '0041585415114', 400000, 100000, 500000, 'Coba input 11/Apr/20', '2020-04-11'),
('4001587822095', '0041587821581', 1033200, 1549800, 2583000, 'Pembayaran pertama', '2020-04-25'),
('4001588233080', '0041588233030', 180000, 420000, 600000, 'Pembayaran 1', '2020-04-30'),
('4001589904085', '0041588233030', 180000, 420000, 600000, 'Test 1', '2020-05-19');

-- --------------------------------------------------------

--
-- Table structure for table `penerima_dividen`
--

CREATE TABLE `penerima_dividen` (
  `id_ent_div` varchar(15) NOT NULL,
  `id_div` varchar(15) NOT NULL,
  `entitas_div` varchar(100) NOT NULL,
  `pers_jumlah_div` int(11) NOT NULL,
  `status_pemb_div` varchar(3) DEFAULT NULL,
  `tanggal_pemb_div` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penerima_dividen`
--

INSERT INTO `penerima_dividen` (`id_ent_div`, `id_div`, `entitas_div`, `pers_jumlah_div`, `status_pemb_div`, `tanggal_pemb_div`) VALUES
('1001585727692', '0091585550331', 'Modal Usaha', 30, NULL, NULL),
('1001588839908', '0091588233151', 'Modal', 30, NULL, NULL),
('1001591615431', '0091591615431', 'Pengelola', 10, NULL, NULL),
('1011585727692', '0091585550331', 'Penerimaan desa', 20, NULL, NULL),
('1011588839908', '0091588233151', 'Pengelola', 40, NULL, NULL),
('1011591615432', '0091591615431', 'Pemerintah Desa Pujotirto', 50, NULL, NULL),
('1021585727692', '0091585550331', 'Pengelola BUMDes', 20, NULL, NULL),
('1021588839908', '0091588233151', 'Desa', 30, NULL, NULL),
('1021591615432', '0091591615431', 'CSR Desa Pujotirto', 40, NULL, NULL),
('1031585727692', '0091585550331', 'CSR masyarakat Pujotirto', 15, NULL, NULL),
('1041585727692', '0091585550331', 'Mitra usaha', 15, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `penyewaan`
--

CREATE TABLE `penyewaan` (
  `id_sewa` varchar(15) NOT NULL,
  `deld_aset` varchar(100) DEFAULT NULL,
  `aset` varchar(15) DEFAULT NULL,
  `penyewa` varchar(50) NOT NULL,
  `kontak` varchar(20) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `harga` int(11) NOT NULL,
  `status_sewa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penyewaan`
--

INSERT INTO `penyewaan` (`id_sewa`, `deld_aset`, `aset`, `penyewa`, `kontak`, `tanggal_mulai`, `tanggal_selesai`, `harga`, `status_sewa`) VALUES
('0021585423535', NULL, '0051585410835', 'Iron man', '090904040505', '2020-03-29', '2020-04-10', 3000000, 1),
('0021585538027', NULL, '0051585410835', 'Steve rogers1', '04050605030', '2020-03-23', '2020-03-28', 2500000, 1),
('0021586616322', NULL, '0051585410835', 'Anu', '54545454', '2020-04-11', '2020-04-13', 1000000, 1),
('0021587816142', NULL, '0051585410835', 'Kor', '09090909', '2020-04-25', '2020-05-02', 3500000, 1),
('0021588232967', NULL, '0051585410896', 'Anu 1', '09090909090', '2020-04-30', '2020-05-02', 1400000, 1),
('0021588697689', NULL, '0051585410835', 'Orgg', '0909090909', '2020-05-05', '2020-05-07', 1000000, 1),
('0021589877782', NULL, '0051585410835', 'Test test', '090909090909', '2020-05-19', '2020-05-21', 1000000, 1),
('0021591450098', NULL, '0051585410835', 'Anut', '090909090909', '2020-06-06', '2020-06-08', 1000000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rekap_keuangan`
--

CREATE TABLE `rekap_keuangan` (
  `id_fin` varchar(15) NOT NULL,
  `jenis` varchar(10) NOT NULL,
  `keterangan` text NOT NULL,
  `debit` int(11) DEFAULT NULL,
  `kredit` int(11) DEFAULT NULL,
  `sld` int(11) DEFAULT NULL,
  `tanggal_fin` date NOT NULL,
  `last_change` datetime NOT NULL,
  `foreg_id` varchar(15) DEFAULT NULL,
  `actor` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rekap_keuangan`
--

INSERT INTO `rekap_keuangan` (`id_fin`, `jenis`, `keterangan`, `debit`, `kredit`, `sld`, `tanggal_fin`, `last_change`, `foreg_id`, `actor`) VALUES
('0061585552781', 'IN', 'Modal awal usaha', 50000000, NULL, 50000000, '2020-03-29', '2020-03-30 14:19:41', NULL, 'User'),
('0061585658313', 'IN', 'Penerimaan dari penjualan Telur sebanyak 10 Kg untuk tujuan Distribusi kepada Saudi Aramco Co., Ltd', 60000, NULL, 50060000, '2020-03-29', '2020-03-31 19:38:33', '0011585410299', 'System'),
('0061585715946', 'IN', 'Penerimaan dari penyewaan aset Mobil 1 mulai dari 23-03-2020 selama 5 oleh Steve rogers1', 2500000, NULL, 52560000, '2020-03-29', '2020-04-01 11:39:06', '0021585538027', 'System'),
('0061585990026', 'IN', 'Pembayaran bagi hasil usaha dengan  PT. Margomulyo nasi goreng  dari aset Mobil bagus ', 720000, NULL, 52220000, '2020-04-01', '2020-04-04 15:47:06', '0041585415114', 'System'),
('0061586009857', 'IN', 'Pembayaran bagi hasil usaha dengan PT. Margomulyo nasi goreng dari aset Mobil bagus', 720000, NULL, 53440000, '2020-04-02', '2020-04-04 21:17:37', '4001585990026', 'System'),
('0061586590156', 'OUT', 'Pembelian/stok masuk Telur sebanyak 30 Kg', NULL, 40000, 53400000, '2020-04-15', '2020-04-11 14:29:16', '0011586590156', 'System'),
('0061586611988', 'IN', 'Pembayaran bagi hasil usaha dengan PT. Margomulyo nasi goreng dari aset Mobil bagus', 400000, NULL, 53800000, '2020-04-16', '2020-04-11 20:33:08', '4001586611878', 'System'),
('0061586616322', 'IN', 'Penerimaan dari penyewaan aset Mobil 1 mulai dari 11-04-2020 selama 2 oleh Anu', 1000000, NULL, 54800000, '2020-04-17', '2020-04-11 21:45:22', '0021586616322', 'System'),
('0061586624320', 'OUT', 'Pembelian/stok masuk Telur sebanyak 30 Kg', NULL, 1467000, 53333000, '2020-04-21', '2020-04-11 23:58:40', '0011586624319', 'System'),
('0061586624640', 'OUT', 'Sumbangan desa', NULL, 2046000, 63169000, '2020-04-22', '2020-05-07 15:26:54', NULL, 'User'),
('0061586624877', 'OUT', 'Sumbangan CSR kabupaten', NULL, 1398000, 49890000, '2020-04-30', '2020-04-12 00:07:57', NULL, 'User'),
('0061587816143', 'IN', 'Penerimaan dari penyewaan aset Mobil 1 mulai dari 25-04-2020 selama 7 oleh Kor', 3500000, NULL, 53390000, '2020-04-25', '2020-04-25 19:02:23', '0021587816142', 'System'),
('0061587976653', 'OUT', 'Pembelian/stok masuk Beras sebanyak 60 Kg', NULL, 900000, 52490000, '2020-04-27', '2020-04-27 15:54:17', '0011587976653', 'System'),
('0061587977902', 'IN', 'Penerimaan dari penjualan Beras sebanyak 20 Kg untuk tujuan Distribusi kepada PT. Margomulyo nasi goreng', 500000, NULL, 52990000, '2020-04-27', '2020-04-27 16:16:05', '0011587977902', 'System'),
('0061588232647', 'OUT', 'Pembelian/stok masuk Telur sebanyak 50 Kg', NULL, 500000, 52490000, '2020-04-30', '2020-04-30 14:44:07', '0011588232647', 'System'),
('0061588232789', 'IN', 'Penerimaan dari penjualan Telur sebanyak 30 Kg untuk tujuan Distribusi kepada PT. Margomulyo nasi goreng', 6000000, NULL, 58490000, '2020-04-30', '2020-04-30 14:46:29', '0011588232788', 'System'),
('0061588232967', 'IN', 'Penerimaan dari penyewaan aset Mobil bagus mulai dari 30-04-2020 selama 2 oleh Anu 1', 1400000, NULL, 59890000, '2020-04-30', '2020-04-30 14:49:27', '0021588232967', 'System'),
('0061588233081', 'IN', 'Pembayaran bagi hasil usaha dengan  PT. Margomulyo nasi goreng  dari aset Motor ', 180000, NULL, 60070000, '2020-04-30', '2020-04-30 14:51:21', '4001588233080', 'System'),
('0061588544182', 'IN', 'Penerimaan dari penjualan Telur sebanyak 57 Kg untuk tujuan Distribusi kepada Saudi Aramco Co., Ltd', 1900000, NULL, 61170000, '2020-05-04', '2020-05-04 05:19:50', '0011588544182', 'System'),
('0061588574784', 'IN', 'Penerimaan dari penjualan Beras sebanyak 25 Kg untuk tujuan Non-distribusi', 1200000, NULL, 62370000, '2020-05-04', '2020-05-04 13:46:24', '0011588574784', 'System'),
('0061588697689', 'IN', 'Penerimaan dari penyewaan aset Mobil 1 mulai dari 05-05-2020 selama 2 oleh Orgg', 1000000, NULL, 64170000, '2020-05-05', '2020-05-05 23:54:49', '0021588697689', 'System'),
('0061588750764', 'OUT', 'Pembelian/stok masuk Telur sebanyak 50 Kg', NULL, 250000, 63920000, '2020-05-06', '2020-05-06 14:39:24', '0011588750764', 'System'),
('0061588750813', 'OUT', 'Pembelian/stok masuk Beras sebanyak 30 Kg', NULL, 750000, 63170000, '2020-05-06', '2020-05-07 01:24:41', '0011588750812', 'System'),
('0061589755868', 'OUT', 'Pembelian/stok masuk Telur sebanyak 50 Kg', NULL, 500000, 62669000, '2020-05-18', '2020-05-18 05:51:08', '0011589755868', 'System'),
('0061589877782', 'IN', 'Penerimaan dari penyewaan aset Mobil 1 mulai dari 19-05-2020 selama 2 oleh Test test', 1000000, NULL, 63669000, '2020-05-19', '2020-05-19 15:43:02', '0021589877782', 'System'),
('0061589904085', 'IN', 'Pembayaran bagi hasil usaha dengan  PT. Margomulyo nasi goreng  dari aset Motor ', 180000, NULL, 63849000, '2020-05-19', '2020-05-19 23:01:25', '4001589904085', 'System'),
('0061591450098', 'IN', 'Penerimaan dari penyewaan aset Mobil 1 mulai dari 06-06-2020 selama 2 oleh Anut', 1000000, NULL, 64849000, '2020-06-06', '2020-06-06 20:28:18', '0021591450098', 'System'),
('0061592291126', 'IN', 'Penerimaan dari penjualan Telur sebanyak 8 Kg untuk tujuan Distribusi kepada PT. Margomulyo nasi goreng', 1900000, NULL, 66749000, '2020-06-16', '2020-06-16 14:05:26', '0011592291126', 'System'),
('0061592382220', 'IN', 'Penerimaan dari penjualan Beras sebanyak 1.5 Kg untuk tujuan Non-distribusi', 700000, NULL, 67449000, '2020-06-17', '2020-06-17 15:23:40', '0011592382220', 'System'),
('0061592383130', 'IN', 'Penerimaan dari penjualan Beras sebanyak 1.5 Kg untuk tujuan Non-distribusi', 1900000, NULL, 69349000, '2020-06-17', '2020-06-17 15:38:50', '0011592383130', 'System'),
('0061592900729', 'OUT', 'Pembelian/stok masuk Telur sebanyak 40 Kg', NULL, 79000, 69270000, '2020-06-23', '2020-06-23 15:25:29', '0011592900729', 'System'),
('0061593242674', 'OUT', 'Pembelian/stok masuk Telur sebanyak 90 Kg', NULL, 800000, 68470000, '2020-06-27', '2020-06-27 14:24:34', '0011593242673', 'System'),
('0061596859149', 'OUT', 'Pembelian/stok masuk Telur sebanyak 60 Kg', NULL, 600000, 67870000, '2020-08-08', '2020-08-08 10:59:09', '0011596859149', 'System'),
('0061597210053', 'OUT', 'Pembelian/stok masuk Telur sebanyak 20 Kg', NULL, 300000, 67570000, '2020-08-12', '2020-08-12 12:27:33', '0011597210053', 'System'),
('0061597210280', 'IN', 'Penerimaan dari penjualan Telur sebanyak 51.5 Kg untuk tujuan Distribusi kepada PT. Margomulyo nasi goreng', 1030000, NULL, 68600000, '2020-08-12', '2020-08-12 12:31:20', '0011597210280', 'System'),
('0061599033572', 'OUT', 'Pembelian/stok masuk Beras sebanyak 10 Kg', NULL, 600000, 68000000, '2020-09-02', '2020-09-02 14:59:32', '0011599033572', 'System'),
('0061599116632', 'IN', 'Penerimaan dari penjualan Telur sebanyak 90 Kg untuk tujuan Distribusi kepada PT. Margomulyo nasi goreng', 843000, NULL, 68843000, '2020-09-03', '2020-09-03 14:03:52', '0011599116632', 'System');

--
-- Triggers `rekap_keuangan`
--
DELIMITER $$
CREATE TRIGGER `perubahan_rekap_keuangan` BEFORE UPDATE ON `rekap_keuangan` FOR EACH ROW BEGIN

	DECLARE last_saldo int;
    DECLARE jumlah_row varchar(15);
    DECLARE temp_nil int;
    
    SET last_saldo = (SELECT sld FROM rekap_keuangan ORDER BY last_change DESC LIMIT 1);
    SET jumlah_row = (SELECT COUNT(id_fin) FROM rekap_keuangan ORDER BY last_change);
    
    IF new.debit <> old.debit OR new.kredit <> old.kredit THEN
        IF jumlah_row = 1 THEN
            IF new.jenis = 'IN' THEN
                SET new.sld = new.debit;
            ELSE 
                SET new.sld = new.kredit;
            END IF;
        ELSE
            IF new.jenis = 'IN' AND new.debit > old.debit THEN
                SET temp_nil = new.debit - old.debit;
                SET new.sld = last_saldo + temp_nil;
            ELSEIF new.jenis = 'IN' AND new.debit < old.debit THEN
                SET temp_nil = old.debit - new.debit;
                SET new.sld = last_saldo - temp_nil;
            ELSEIF new.jenis = 'OUT' AND new.kredit > old.kredit THEN
                SET temp_nil = new.kredit - old.kredit;
                SET new.sld = last_saldo - temp_nil;
             ELSEIF new.jenis = 'OUT' AND new.kredit < old.kredit THEN
                SET temp_nil = old.kredit - new.kredit;
                SET new.sld = last_saldo + temp_nil;
             END IF;
            -- UPDATE `rekap_keuangan` SET `sld` = temp_nil WHERE `rekap_keuangan`.`id_fin` = last_id; --
          END IF;
          SET new.last_change = NOW();
      END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `set_saldo` BEFORE INSERT ON `rekap_keuangan` FOR EACH ROW BEGIN
	DECLARE saldo int;
    DECLARE r int;
    
    SET saldo = (select sld from rekap_keuangan order by last_change desc limit 1);
    SET r = (select count(sld) from rekap_keuangan order by last_change desc limit 1);
    
    IF(r=0) THEN
    	SET new.sld=new.debit;
    ELSE
    	IF(new.jenis='IN') THEN
        	SET new.sld = saldo + new.debit;
        ELSE 
        	SET new.sld = saldo - new.kredit;
        END IF;
     END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `id` int(11) NOT NULL,
  `satuan` varchar(15) NOT NULL,
  `ket_satuan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`id`, `satuan`, `ket_satuan`) VALUES
(1, 'Kg', NULL),
(5, 'L', 'Liter'),
(6, 'Cm', 'Sentimeter'),
(7, 'M', 'Meter');

-- --------------------------------------------------------

--
-- Table structure for table `stok_item`
--

CREATE TABLE `stok_item` (
  `id_stok` varchar(15) NOT NULL,
  `komoditas` varchar(15) DEFAULT NULL,
  `jenis` varchar(10) DEFAULT NULL,
  `jumlah` float DEFAULT NULL,
  `sat_barang` int(11) DEFAULT NULL,
  `stok` float NOT NULL,
  `tanggal` date NOT NULL,
  `last_change` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stok_item`
--

INSERT INTO `stok_item` (`id_stok`, `komoditas`, `jenis`, `jumlah`, `sat_barang`, `stok`, `tanggal`, `last_change`) VALUES
('0011585408360', '0071585408307', 'IN', 55, 1, 25, '2020-03-25', '2020-03-31 15:22:15'),
('0011585408395', '0071585408307', 'OUT', 15, 1, 35, '2020-04-28', '2020-03-28 22:13:15'),
('0011585409996', '0071585408307', 'OUT', 5, 1, 30, '2020-04-28', '2020-03-28 22:39:56'),
('0011585410299', '0071585408307', 'OUT', 10, 1, 20, '2020-03-24', '2020-03-28 22:44:59'),
('0011586590156', '0071585408307', 'IN', 30, 1, 55, '2020-04-11', '2020-04-11 14:29:16'),
('0011586624319', '0071585408307', 'IN', 30, 1, 85, '2020-04-11', '2020-04-11 23:58:39'),
('0011587976653', '0071587976593', 'IN', 60, 1, 60, '2020-04-27', '2020-04-27 15:37:33'),
('0011587977902', '0071587976593', 'OUT', 20, 1, 40, '2020-04-27', '2020-04-27 15:58:22'),
('0011588232647', '0071585408307', 'IN', 50, 1, 135, '2020-04-30', '2020-04-30 14:44:07'),
('0011588232788', '0071585408307', 'OUT', 30, 1, 105, '2020-04-30', '2020-04-30 14:46:28'),
('0011588544182', '0071585408307', 'OUT', 57, 1, 48, '2020-05-04', '2020-05-04 05:16:22'),
('0011588574784', '0071587976593', 'OUT', 25, 1, 45, '2020-05-04', '2020-05-07 13:37:26'),
('0011588750764', '0071585408307', 'IN', 50, 1, 98, '2020-05-06', '2020-05-06 14:39:24'),
('0011588750812', '0071587976593', 'IN', 30, 1, 50, '2020-05-06', '2020-05-06 14:40:12'),
('0011589755868', '0071585408307', 'IN', 50, 1, 148, '2020-05-18', '2020-05-18 05:51:08'),
('0011592291126', '0071585408307', 'OUT', 8, 1, 140, '2020-06-16', '2020-06-16 14:05:26'),
('0011592382220', '0071587976593', 'OUT', 2, 1, 43, '2020-06-17', '2020-06-17 15:23:40'),
('0011592383130', '0071587976593', 'OUT', 1.5, 1, 41.5, '2020-06-17', '2020-06-17 15:38:50'),
('0011592383553', '0071587976593', 'IN', 1.8, 1, 42.7, '2020-06-17', '2020-06-18 22:12:26'),
('0011592900729', '0071585408307', 'IN', 40, 1, 180, '2020-06-23', '2020-06-23 15:25:29'),
('0011593242673', '0071585408307', 'IN', 90, 1, 270, '2020-06-27', '2020-06-27 14:24:33'),
('0011596859149', '0071585408307', 'IN', 60, 1, 330, '2020-08-08', '2020-08-08 10:59:09'),
('0011597210053', '0071585408307', 'IN', 20, 1, 350, '2020-08-12', '2020-08-12 12:27:33'),
('0011597210280', '0071585408307', 'OUT', 51.5, 1, 298.5, '2020-08-12', '2020-08-12 12:31:20'),
('0011599033572', '0071587976593', 'IN', 10, 1, 52.7, '2020-09-02', '2020-09-02 14:59:32'),
('0011599116632', '0071585408307', 'OUT', 90, 1, 208.5, '2020-09-03', '2020-09-03 14:03:52');

--
-- Triggers `stok_item`
--
DELIMITER $$
CREATE TRIGGER `hapus_data_stok` BEFORE DELETE ON `stok_item` FOR EACH ROW BEGIN
	IF old.jenis = 'IN' THEN
    	DELETE FROM stok_masuk WHERE id_prb = old.id_stok;
    ELSE
    	DELETE FROM stok_keluar WHERE id_prb = old.id_stok;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_data_stok` BEFORE INSERT ON `stok_item` FOR EACH ROW BEGIN
	DECLARE nilai float;
    DECLARE r int;
SET nilai = (select `stok` from `stok_item` where `komoditas`=new.komoditas order by last_change DESC limit 1);

SET r = (select COUNT(`stok`) from `stok_item` where `komoditas`=new.komoditas order by last_change DESC limit 1);

IF (r=0) THEN
	SET nilai = new.jumlah;
ELSE
	IF (new.jenis = 'IN') THEN
           SET nilai = nilai+new.jumlah;
      ELSE
           SET nilai = nilai-new.jumlah;
      END IF;
END IF;        
	SET new.stok = nilai;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_data_stok` BEFORE UPDATE ON `stok_item` FOR EACH ROW BEGIN
	DECLARE stok_akhir float;
    DECLARE jumlah_data int;
    DECLARE temp float;
    
    SET stok_akhir = (select `stok` from `stok_item` WHERE komoditas=new.komoditas order by `last_change` DESC limit 1);
    SET jumlah_data = (SELECT COUNT(id_stok) FROM stok_item WHERE komoditas=new.komoditas);
    
    
    
    IF new.jumlah <> old.jumlah THEN
    	IF (jumlah_data=1) THEN
            SET new.stok =  new.jumlah;
        ELSE
            IF (new.jenis='IN') THEN
                IF (new.jumlah > old.jumlah) THEN
                    SET temp = new.jumlah - old.jumlah;
                    SET new.stok = stok_akhir + temp;
                ELSE
                    SET temp = old.jumlah - new.jumlah;
                    SET new.stok = stok_akhir - temp;
                END IF;
             ELSE
                IF (new.jumlah > old.jumlah) THEN
                    SET temp = new.jumlah - old.jumlah;
                    SET new.stok = stok_akhir - temp;
                ELSE
                    SET temp = old.jumlah - new.jumlah;
                    SET new.stok = stok_akhir + temp;
                END IF;
              END IF;
          END IF;
        SET new.last_change = NOW();
     END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `stok_keluar`
--

CREATE TABLE `stok_keluar` (
  `id_temp` int(11) NOT NULL,
  `id_prb` varchar(15) NOT NULL,
  `tujuan` varchar(15) NOT NULL,
  `nilai_transaksi` int(11) DEFAULT NULL,
  `margin` int(11) DEFAULT NULL,
  `mitra` varchar(15) DEFAULT NULL,
  `catatan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stok_keluar`
--

INSERT INTO `stok_keluar` (`id_temp`, `id_prb`, `tujuan`, `nilai_transaksi`, `margin`, `mitra`, `catatan`) VALUES
(1, '0011585408395', 'Non-distribusi', 500000, 320000, NULL, ''),
(2, '0011585409996', 'Distribusi', 50000, 0, '0071585554912', ''),
(3, '0011585410299', 'Distribusi', 60000, 0, '0071585554912', ''),
(4, '0011587977902', 'Distribusi', 510000, 210000, '0071585410227', ''),
(5, '0011588232788', 'Distribusi', 6000000, 5565000, '0071585410227', ''),
(6, '0011588544182', 'Distribusi', 1900000, 1073500, '0071585554912', ''),
(7, '0011588574784', 'Non-distribusi', 1200000, 900000, NULL, ''),
(8, '0011592291126', 'Distribusi', 1900000, 1784000, '0071585410227', ''),
(9, '0011592382220', 'Non-distribusi', 700000, 672000, NULL, ''),
(10, '0011592383130', 'Non-distribusi', 1900000, 1872000, NULL, ''),
(11, '0011597210280', 'Distribusi', 1030000, 276000, '0071585410227', ''),
(12, '0011599116632', 'Distribusi', 843000, 0, '0071585410227', '');

--
-- Triggers `stok_keluar`
--
DELIMITER $$
CREATE TRIGGER `hitung_margin_edit` BEFORE UPDATE ON `stok_keluar` FOR EACH ROW BEGIN
	DECLARE hgb int;
    DECLARE kom varchar(15);
    DECLARE total int;
    DECLARE total_out int;
    
    SET kom = (SELECT komoditas FROM stok_item WHERE id_stok=new.id_prb);
    SET hgb = (SELECT harga_beli FROM komoditas WHERE id_kom=kom);
    SET total_out = (SELECT jumlah FROM stok_item WHERE id_stok=new.id_prb);
    
    IF new.nilai_transaksi <> 0 AND old.nilai_transaksi <> new.nilai_transaksi THEN
    	SET total = new.nilai_transaksi-(total_out*hgb);
        IF total < 0 THEN
            SET new.margin = 0;
        ELSE
            SET new.margin = total;
        END IF;
    END IF;
    
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `hitung_margin_insert` BEFORE INSERT ON `stok_keluar` FOR EACH ROW BEGIN
	DECLARE hgb int;
    DECLARE kom varchar(15);
    DECLARE total int;
    DECLARE total_out int;
    
    SET kom = (SELECT komoditas FROM stok_item WHERE id_stok=new.id_prb);
    SET hgb = (SELECT harga_beli FROM komoditas WHERE id_kom=kom);
    SET total_out = (SELECT jumlah FROM stok_item WHERE id_stok=new.id_prb);
    
    IF new.nilai_transaksi <> 0 THEN
    	SET total = new.nilai_transaksi-(total_out*hgb);
        IF total < 0 THEN
            SET new.margin = 0;
        ELSE
            SET new.margin = total;
        END IF;
    END IF;
    
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `stok_masuk`
--

CREATE TABLE `stok_masuk` (
  `id_temp` int(11) NOT NULL,
  `id_prb` varchar(15) NOT NULL,
  `asal` varchar(10) NOT NULL,
  `nilai` int(11) DEFAULT NULL,
  `catatan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stok_masuk`
--

INSERT INTO `stok_masuk` (`id_temp`, `id_prb`, `asal`, `nilai`, `catatan`) VALUES
(1, '0011585408360', 'Beli', 5000000, 'Test perubahan'),
(2, '0011586590156', 'Beli', 40000, ''),
(3, '0011586624319', 'Beli', 1467000, ''),
(4, '0011587976653', 'Beli', 900000, ''),
(5, '0011588232647', 'Beli', 500000, 'Tst'),
(7, '0011588750764', 'Beli', 250000, ''),
(8, '0011588750812', 'Beli', 750000, ''),
(9, '0011589755868', 'Beli', 500000, ''),
(10, '0011592383553', 'Non-beli', NULL, ''),
(11, '0011592900729', 'Beli', 79000, ''),
(12, '0011593242673', 'Beli', 800000, ''),
(13, '0011596859149', 'Beli', 600000, ''),
(14, '0011597210053', 'Beli', 300000, ''),
(15, '0011599033572', 'Beli', 600000, '');

-- --------------------------------------------------------

--
-- Table structure for table `url_confirm`
--

CREATE TABLE `url_confirm` (
  `id` varchar(15) NOT NULL,
  `catatan` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `url_confirm`
--

INSERT INTO `url_confirm` (`id`, `catatan`, `status`) VALUES
('5001593329567', '0081585629042|15523231@students.uii.ac.id', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `aset`
--
ALTER TABLE `aset`
  ADD PRIMARY KEY (`id_aset`);

--
-- Indexes for table `aset_disewakan`
--
ALTER TABLE `aset_disewakan`
  ADD PRIMARY KEY (`id_aset_sewa`),
  ADD KEY `aset_sw` (`aset_sw`);

--
-- Indexes for table `bagi_hasil_aset`
--
ALTER TABLE `bagi_hasil_aset`
  ADD PRIMARY KEY (`id_bgh`),
  ADD KEY `aset_bh` (`aset_bh`),
  ADD KEY `mitra` (`mitra`);

--
-- Indexes for table `dividen_profit`
--
ALTER TABLE `dividen_profit`
  ADD PRIMARY KEY (`id_gdiv`);

--
-- Indexes for table `histori_harga_komoditas`
--
ALTER TABLE `histori_harga_komoditas`
  ADD PRIMARY KEY (`id_temp`),
  ADD KEY `komoditas` (`komoditas`);

--
-- Indexes for table `komoditas`
--
ALTER TABLE `komoditas`
  ADD PRIMARY KEY (`id_kom`),
  ADD KEY `sat` (`sat`);

--
-- Indexes for table `log_admin`
--
ALTER TABLE `log_admin`
  ADD PRIMARY KEY (`id_temp`),
  ADD KEY `admin` (`admin`);

--
-- Indexes for table `mitra`
--
ALTER TABLE `mitra`
  ADD PRIMARY KEY (`id_mitra`);

--
-- Indexes for table `pemb_bagi_hasil`
--
ALTER TABLE `pemb_bagi_hasil`
  ADD PRIMARY KEY (`id_pbgh`),
  ADD KEY `id_bagi` (`id_bagi`);

--
-- Indexes for table `penerima_dividen`
--
ALTER TABLE `penerima_dividen`
  ADD PRIMARY KEY (`id_ent_div`),
  ADD KEY `id_div` (`id_div`);

--
-- Indexes for table `penyewaan`
--
ALTER TABLE `penyewaan`
  ADD PRIMARY KEY (`id_sewa`),
  ADD KEY `aset` (`aset`);

--
-- Indexes for table `rekap_keuangan`
--
ALTER TABLE `rekap_keuangan`
  ADD PRIMARY KEY (`id_fin`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stok_item`
--
ALTER TABLE `stok_item`
  ADD PRIMARY KEY (`id_stok`),
  ADD KEY `komoditas` (`komoditas`),
  ADD KEY `sat_barang` (`sat_barang`);

--
-- Indexes for table `stok_keluar`
--
ALTER TABLE `stok_keluar`
  ADD PRIMARY KEY (`id_temp`),
  ADD KEY `id_prb` (`id_prb`),
  ADD KEY `mitra` (`mitra`);

--
-- Indexes for table `stok_masuk`
--
ALTER TABLE `stok_masuk`
  ADD PRIMARY KEY (`id_temp`),
  ADD KEY `id_prb` (`id_prb`);

--
-- Indexes for table `url_confirm`
--
ALTER TABLE `url_confirm`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `histori_harga_komoditas`
--
ALTER TABLE `histori_harga_komoditas`
  MODIFY `id_temp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `log_admin`
--
ALTER TABLE `log_admin`
  MODIFY `id_temp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `stok_keluar`
--
ALTER TABLE `stok_keluar`
  MODIFY `id_temp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `stok_masuk`
--
ALTER TABLE `stok_masuk`
  MODIFY `id_temp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aset_disewakan`
--
ALTER TABLE `aset_disewakan`
  ADD CONSTRAINT `aset_disewakan_ibfk_1` FOREIGN KEY (`aset_sw`) REFERENCES `aset` (`id_aset`);

--
-- Constraints for table `bagi_hasil_aset`
--
ALTER TABLE `bagi_hasil_aset`
  ADD CONSTRAINT `bagi_hasil_aset_ibfk_1` FOREIGN KEY (`aset_bh`) REFERENCES `aset` (`id_aset`),
  ADD CONSTRAINT `bagi_hasil_aset_ibfk_2` FOREIGN KEY (`mitra`) REFERENCES `mitra` (`id_mitra`);

--
-- Constraints for table `histori_harga_komoditas`
--
ALTER TABLE `histori_harga_komoditas`
  ADD CONSTRAINT `histori_harga_komoditas_ibfk_1` FOREIGN KEY (`komoditas`) REFERENCES `komoditas` (`id_kom`);

--
-- Constraints for table `komoditas`
--
ALTER TABLE `komoditas`
  ADD CONSTRAINT `komoditas_ibfk_1` FOREIGN KEY (`sat`) REFERENCES `satuan` (`id`);

--
-- Constraints for table `log_admin`
--
ALTER TABLE `log_admin`
  ADD CONSTRAINT `log_admin_ibfk_1` FOREIGN KEY (`admin`) REFERENCES `admin` (`id_admin`);

--
-- Constraints for table `pemb_bagi_hasil`
--
ALTER TABLE `pemb_bagi_hasil`
  ADD CONSTRAINT `pemb_bagi_hasil_ibfk_1` FOREIGN KEY (`id_bagi`) REFERENCES `bagi_hasil_aset` (`id_bgh`);

--
-- Constraints for table `penerima_dividen`
--
ALTER TABLE `penerima_dividen`
  ADD CONSTRAINT `penerima_dividen_ibfk_1` FOREIGN KEY (`id_div`) REFERENCES `dividen_profit` (`id_gdiv`);

--
-- Constraints for table `penyewaan`
--
ALTER TABLE `penyewaan`
  ADD CONSTRAINT `penyewaan_ibfk_1` FOREIGN KEY (`aset`) REFERENCES `aset` (`id_aset`);

--
-- Constraints for table `stok_item`
--
ALTER TABLE `stok_item`
  ADD CONSTRAINT `stok_item_ibfk_1` FOREIGN KEY (`komoditas`) REFERENCES `komoditas` (`id_kom`),
  ADD CONSTRAINT `stok_item_ibfk_2` FOREIGN KEY (`sat_barang`) REFERENCES `satuan` (`id`);

--
-- Constraints for table `stok_keluar`
--
ALTER TABLE `stok_keluar`
  ADD CONSTRAINT `stok_keluar_ibfk_1` FOREIGN KEY (`id_prb`) REFERENCES `stok_item` (`id_stok`),
  ADD CONSTRAINT `stok_keluar_ibfk_2` FOREIGN KEY (`mitra`) REFERENCES `mitra` (`id_mitra`);

--
-- Constraints for table `stok_masuk`
--
ALTER TABLE `stok_masuk`
  ADD CONSTRAINT `stok_masuk_ibfk_1` FOREIGN KEY (`id_prb`) REFERENCES `stok_item` (`id_stok`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
