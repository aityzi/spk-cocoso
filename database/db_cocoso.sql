-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jun 07, 2024 at 05:29 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!40101 SET NAMES utf8mb4 */
;
--
-- Database: `db_spk_sarah`
--

-- --------------------------------------------------------
--
-- Table structure for table `tbl_alternatif`
--

CREATE TABLE `tbl_alternatif` (
  `Tanggal` date NOT NULL,
  `KodeAlternatif` varchar(12) NOT NULL,
  `NamaAlternatif` varchar(30) NOT NULL,
  `C1` double NOT NULL,
  `C2` double NOT NULL,
  `C3` double NOT NULL,
  `C4` double NOT NULL,
  `C5` double NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
--
-- Dumping data for table `tbl_alternatif`
--

INSERT INTO `tbl_alternatif` (
    `Tanggal`,
    `KodeAlternatif`,
    `NamaAlternatif`,
    `C1`,
    `C2`,
    `C3`,
    `C4`,
    `C5`
  )
VALUES (
    '2024-02-18',
    'A1',
    'Jl. Yos Sudarso',
    5,
    4,
    2,
    3,
    2
  ),
  (
    '2024-02-18',
    'A2',
    'Jl Abdul Hakim ',
    1,
    2,
    1,
    1,
    2
  ),
  (
    '2024-02-18',
    'A3',
    'Jl. Marendal',
    1,
    3,
    2,
    3,
    2
  ),
  (
    '2024-02-18',
    'A4',
    'Jl Kapten Muslim',
    5,
    2,
    4,
    3,
    2
  ),
  (
    '2024-02-18',
    'A5',
    'Jl Jamin Ginting',
    1,
    2,
    1,
    2,
    3
  ),
  (
    '2024-02-18',
    'A6',
    'Jl Setia Budi',
    5,
    3,
    3,
    4,
    2
  ),
  (
    '2024-02-18',
    'A7',
    'Jl Brigjend Katamso',
    1,
    2,
    2,
    2,
    2
  ),
  (
    '2024-02-18',
    'A8',
    'Jl Besar Delitua',
    1,
    4,
    1,
    4,
    2
  ),
  (
    '2024-02-18',
    'A9',
    'Jl Karya Wisata',
    5,
    3,
    2,
    3,
    2
  ),
  (
    '2024-02-18',
    'A10',
    'Jl Muchtar Basir',
    1,
    1,
    1,
    2,
    2
  );
-- --------------------------------------------------------
--
-- Table structure for table `tbl_kriteria`
--

CREATE TABLE `tbl_kriteria` (
  `KodeKriteria` varchar(12) NOT NULL,
  `NamaKriteria` varchar(30) NOT NULL,
  `BobotKriteria` double NOT NULL,
  `JenisKriteria` varchar(10) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
--
-- Dumping data for table `tbl_kriteria`
--

INSERT INTO `tbl_kriteria` (
    `KodeKriteria`,
    `NamaKriteria`,
    `BobotKriteria`,
    `JenisKriteria`
  )
VALUES ('C1', 'Luas Tanah', 0.25, 'Benefit'),
  ('C2', 'Jarak Lokasi', 0.20, 'Cost'),
  ('C3', 'Harga Sewa', 0.25, 'Cost'),
  ('C4', 'Pesaing', 0.15, 'Cost'),
  ('C5', 'Akses Jalan', 0.15, 'Benefit');
-- --------------------------------------------------------
--
-- Table structure for table `tbl_login`
--

CREATE TABLE `tbl_login` (
  `KodeAkun` varchar(12) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Password` varchar(100) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`KodeAkun`, `Username`, `Password`)
VALUES (
    'A0',
    'sarah',
    'ec26202651ed221cf8f993668c459d46'
  );
-- --------------------------------------------------------
--
-- Table structure for table `tbl_proses_cocoso`
--

CREATE TABLE `tbl_proses_cocoso` (
  `KodePerhitungan` varchar(12) NOT NULL,
  `Tanggal` date NOT NULL,
  `KodeAlternatif` varchar(12) NOT NULL,
  `Kia` double NOT NULL,
  `Kib` double NOT NULL,
  `Kic` double NOT NULL,
  `Ki` double NOT NULL,
  `Rangking` int(12) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
-- --------------------------------------------------------
--
-- Table structure for table `tbl_sub_kriteria`
--

CREATE TABLE `tbl_sub_kriteria` (
  `KodeSubKriteria` varchar(12) NOT NULL,
  `KodeKriteria` varchar(12) NOT NULL,
  `Nilai` double NOT NULL,
  `Keterangan` varchar(50) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
--
-- Dumping data for table `tbl_sub_kriteria`
--
INSERT INTO `tbl_sub_kriteria` (
`KodeSubKriteria`,
`KodeKriteria`,
`Nilai`,
`Keterangan`
)
VALUES ('S86872', 'C1', 1, '< 100 m2'),
  ('S86873', 'C1', 5, '> 100 m2'),
  ('S12289', 'C2', 1, '1 - 5 Km'),
  ('S14077', 'C2', 2, '6 - 10 Km'),
  ('S26614', 'C2', 3, '11 - 15 Km'),
  ('S27569', 'C2', 4, '> 16 Km'),
  ('S36048', 'C3', 1, '< Rp. 50.000.000'),
  (
    'S36897',
    'C3',
    2,
    'Rp. 51.000.000 - Rp. 75.000.000'
  ),
  (
    'S37288',
    'C3',
    3,
    'Rp. 76.000.000 - 100.000.000'
  ),
  ('S56855', 'C3', 4, '> Rp. 100.000.000'),
  ('S57743', 'C4', 1, 'Tidak Ada'),
  ('S59320', 'C4', 2, '1 - 2'),
  ('S61941', 'C4', 3, '3 - 4'),
  ('S67556', 'C4', 4, '>5'),
  ('S8009', 'C5', 1, 'Jalan Desa'),
  ('S86870', 'C5', 2, 'Jalan Kota/ Kabupaten'),
  ('S86871', 'C5', 3, 'Jalan Provinsi');
--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_alternatif`
--
ALTER TABLE `tbl_alternatif`
ADD PRIMARY KEY (`KodeAlternatif`);
--
-- Indexes for table `tbl_kriteria`
--
ALTER TABLE `tbl_kriteria`
ADD PRIMARY KEY (`KodeKriteria`);
--
-- Indexes for table `tbl_login`
--
ALTER TABLE `tbl_login`
ADD PRIMARY KEY (`KodeAkun`);
--
-- Indexes for table `tbl_proses_cocoso`
--
ALTER TABLE `tbl_proses_cocoso`
ADD PRIMARY KEY (`KodePerhitungan`),
  ADD KEY `KodeAlternatif` (`KodeAlternatif`);
--
-- Indexes for table `tbl_sub_kriteria`
--
ALTER TABLE `tbl_sub_kriteria`
ADD PRIMARY KEY (`KodeSubKriteria`),
  ADD KEY `KodeKriteria` (`KodeKriteria`);
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_proses_cocoso`
--
ALTER TABLE `tbl_proses_cocoso`
ADD CONSTRAINT `tbl_proses_cocoso_ibfk_1` FOREIGN KEY (`KodeAlternatif`) REFERENCES `tbl_alternatif` (`KodeAlternatif`);
COMMIT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;