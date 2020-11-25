-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Inang: 127.0.0.1
-- Waktu pembuatan: 23 Okt 2016 pada 21.04
-- Versi Server: 5.5.32
-- Versi PHP: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Basis data: `db_gis`
--
CREATE DATABASE IF NOT EXISTS `db_gis` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_gis`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_admin`
--

CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `id_admin` int(5) NOT NULL AUTO_INCREMENT,
  `nama_admin` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `type` varchar(5) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `nama_admin`, `username`, `password`, `type`) VALUES
(1, 'Dinas Bina Marga Kota Bandar Lampung', 'dbmkota', 'de0209b6a63c0b95e8aa056f699fab15', '1'),
(2, 'Dinas Bina Marga Provinsi Lampung', 'dbmprovinsi', '7711307784dd7b0891f01986b797b9d4', '1'),
(3, 'Bagian Pembangunan Jalan', 'pj', '827ccb0eea8a706c4c34a16891f84e7b', '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_detaillapor`
--

CREATE TABLE IF NOT EXISTS `tbl_detaillapor` (
  `id_lapor` int(5) NOT NULL,
  `disposisi` varchar(100) NOT NULL,
  `status_lapor` varchar(50) NOT NULL,
  `proses_perbaikan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_detaillapor`
--

INSERT INTO `tbl_detaillapor` (`id_lapor`, `disposisi`, `status_lapor`, `proses_perbaikan`) VALUES
(1, 'Belum Ditentukan', 'Diterima', '0'),
(2, 'Dinas Bina Marga Provinsi Lampung', 'Proses Perbaikan', '50'),
(3, 'Dinas Bina Marga Kota Bandar Lampung', 'Selesai', '100'),
(4, 'Belum Ditentukan', 'Diterima', '0'),
(5, 'Dinas Bina Marga Kota Bandar Lampung', 'Diterima', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_foto`
--

CREATE TABLE IF NOT EXISTS `tbl_foto` (
  `id_lapor` int(5) NOT NULL,
  `foto_jalan` varchar(30) DEFAULT NULL,
  KEY `FK_tbl_foto` (`id_lapor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `tbl_foto`
--

INSERT INTO `tbl_foto` (`id_lapor`, `foto_jalan`) VALUES
(1, '14772476460.jpg'),
(2, '14772476800.jpg'),
(3, '14772477090.jpg'),
(3, '14772477091.jpg'),
(4, '14772486000.jpg'),
(5, '14772486390.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kategori`
--

CREATE TABLE IF NOT EXISTS `tbl_kategori` (
  `id_kategori` varchar(10) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `ikon` varchar(250) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id_kategori`, `nama_kategori`, `ikon`) VALUES
('1', 'Jalan Rusak Ringan', 'ringan.png'),
('2', 'Jalan Rusak Sedang', 'sedang.png'),
('3', 'Jalan Rusak Berat', 'berat.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_lapor`
--

CREATE TABLE IF NOT EXISTS `tbl_lapor` (
  `id_lapor` int(5) NOT NULL AUTO_INCREMENT,
  `tanggal_lapor` varchar(50) NOT NULL,
  `nama_pelapor` varchar(30) NOT NULL,
  `nik` varchar(15) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `nama_jalan` varchar(100) NOT NULL,
  `id_kategori` int(5) NOT NULL,
  `lat` varchar(20) NOT NULL,
  `lng` varchar(20) NOT NULL,
  PRIMARY KEY (`id_lapor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=COMPACT AUTO_INCREMENT=6 ;

--
-- Dumping data untuk tabel `tbl_lapor`
--

INSERT INTO `tbl_lapor` (`id_lapor`, `tanggal_lapor`, `nama_pelapor`, `nik`, `alamat`, `no_hp`, `nama_jalan`, `id_kategori`, `lat`, `lng`) VALUES
(1, 'Minggu, 23 Oktober 2016', 'Rio', '0917419479', 'jalan urip sumoharjo bandar lampung', '0184019481', 'jalan urip sumoharjo bandar lampung', 1, '-5.3900155', '105.27477929999998'),
(2, 'Minggu, 23 Oktober 2016', 'Agus', '0184901', 'jalan zainal abidin pagar alam bandar lampung', '014809174', 'jalan zainal abidin pagar alam bandar lampung', 2, '-5.3736948', '105.24165829999993'),
(3, 'Minggu, 23 Oktober 2016', 'Intan', '1094819048', 'jalan gatot subroto bandar lampung', '10940194', 'jalan gatot subroto bandar lampung', 3, '-5.435057899999999', '105.28139069999997'),
(4, 'Minggu, 23 Oktober 2016', 'Irwan', '01941094', 'jalan imam bonjol bandar lampung', '0148109481', 'jalan imam bonjol bandar lampung', 2, '-5.3935872', '105.23145399999999'),
(5, 'Minggu, 23 Oktober 2016', 'Nina', '184901', 'jalan onta bandar lampung', '0141098', 'jalan onta bandar lampung', 3, '-5.397365700000001', '105.2550506');

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_foto`
--
ALTER TABLE `tbl_foto`
  ADD CONSTRAINT `FK_tbl_foto` FOREIGN KEY (`id_lapor`) REFERENCES `tbl_lapor` (`id_lapor`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
