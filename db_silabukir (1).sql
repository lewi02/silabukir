-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2020 at 09:55 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_silabukir`
--

-- --------------------------------------------------------

--
-- Table structure for table `pertanyaan`
--

CREATE TABLE `pertanyaan` (
  `id_pertanyaan` int(11) NOT NULL,
  `judul_pertanyaan` varchar(100) NOT NULL,
  `uraian_pertanyaan` text NOT NULL,
  `jawaban` text NOT NULL,
  `tanggal_kirim` datetime NOT NULL,
  `pengirim` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pertanyaan`
--

INSERT INTO `pertanyaan` (`id_pertanyaan`, `judul_pertanyaan`, `uraian_pertanyaan`, `jawaban`, `tanggal_kirim`, `pengirim`) VALUES
(2, 'afa', '<p>dafa</p>', '', '2020-10-25 10:58:00', 'YULI, S.Pd'),
(5, 'ddad', '<p>adad</p>', '', '2020-10-25 11:13:29', 'YULI, S.Pd'),
(7, 'adda', '<p>adad</p>', '', '2020-10-25 14:50:53', 'YULI, S.Pd'),
(8, 'pak sekolah kami kurang bangku dan meja', '<p>tolong di tanggapi</p>', '', '2020-10-26 04:31:43', 'YULI, S.Pd'),
(9, 'loporan bulanan', '<p>laporan bulan juli&nbsp;</p>', 'adaeq', '2020-10-26 04:38:36', 'YULI, S.Pd');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `username`, `password`, `nama_lengkap`) VALUES
(1, 'Admin', '12', 'Admin Dinas');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dkinerja`
--

CREATE TABLE `tbl_dkinerja` (
  `id_dkinerja` int(11) NOT NULL,
  `id_kinerja` varchar(25) NOT NULL,
  `id_indikator_kinerja` int(11) NOT NULL,
  `isi_kinerja` text NOT NULL,
  `file_pendukung` varchar(100) NOT NULL,
  `nilai` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_dkinerja`
--

INSERT INTO `tbl_dkinerja` (`id_dkinerja`, `id_kinerja`, `id_indikator_kinerja`, `isi_kinerja`, `file_pendukung`, `nilai`) VALUES
(2, '1994120701202010', 3, 'dokumentasi pembelajaran sisiwa ', '89854069.jpg', 0),
(3, '199412070120203', 1, 'foto kegiatan belajar', '14350728.jpg', 90),
(4, '199412070120203', 2, 'memeriksa hasil kerja siswa', '15194375.jpg', 90),
(5, '199412070120203', 3, 'penilaian hasil belajar siswa', '31933409.jpg', 89),
(6, '199412070120203', 4, 'guru harus memahami kemapauan belajar siswa ', '78533324.jpg', 0),
(7, '199412070120203', 5, 'bertanggung jawab penuh sebagai guru kelas ubah', '40422012.jpg', 0),
(8, '199412070120203', 6, 'mengikuti rapat kurikulum', '78761182.jpg', 0),
(9, '199412070120203', 7, 'dokumentasi guru yang mengikuti kepramukaan', '74299821.jpg', 0),
(10, '199412070120203', 8, 'dokumentasi guru yang mengawas ujian sekolah', '47993945.jpg', 0),
(11, '199412070120203', 9, 'dokumentasi guru yang mengawas ujian nasional', '37167649.jpg', 0),
(12, '1994120701202010', 1, 'dokumentasi pembelajaran siswa', '79865686.jpg', 0),
(13, '1994120701202010', 1, 'dokumentasi pembelajaran siswa', '20815942.jpg', 0),
(14, '1994120701202010', 2, 'memeriksa hasil kerja siswa', '62817835.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dlaporan`
--

CREATE TABLE `tbl_dlaporan` (
  `id_dlaporan` int(11) NOT NULL,
  `id_laporan` varchar(25) NOT NULL,
  `id_subindikator_laporan` int(11) NOT NULL,
  `isi_laporan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_dlaporan`
--

INSERT INTO `tbl_dlaporan` (`id_dlaporan`, `id_laporan`, `id_subindikator_laporan`, `isi_laporan`) VALUES
(1, '', 1, '12121'),
(2, '', 1, '121'),
(3, '', 1, '121'),
(4, '1234202010', 3, '13'),
(6, '123420204', 1, '12'),
(7, '123420204', 3, '34');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_guru`
--

CREATE TABLE `tbl_guru` (
  `id_guru` varchar(15) NOT NULL,
  `nama_guru` varchar(100) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `pangkat` varchar(50) NOT NULL,
  `gol` varchar(50) NOT NULL,
  `tmt_tugas` date NOT NULL,
  `pendidikan` varchar(255) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `password` varchar(30) NOT NULL,
  `npsn` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_guru`
--

INSERT INTO `tbl_guru` (`id_guru`, `nama_guru`, `nip`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `pangkat`, `gol`, `tmt_tugas`, `pendidikan`, `jabatan`, `password`, `npsn`) VALUES
('1994120701', 'YULI, S.Pd', '1234', 'MUNA', '1994-12-07', 'P', 'IIIA', 'PENATA MUDA', '2019-01-03', 'S1(PENDIDIKAN KIMIA)/UNIVERSITAS HALU', 'GURU', '123', '1234'),
('1994120901', 'YEFRI PANDI, S.Pd', '1999191866516254', 'TOLULOS', '1994-12-09', 'L', 'IIIA', 'PENATA MUDA', '2020-11-29', 'S1(PKN)UNTIKA', 'GURU', '1234', '69759864'),
('1998082901', 'IMRAN', '198701182019031005', 'SALAKAN', '1998-08-29', 'L', 'IV/a', 'PEMBINA', '2019-01-02', 'S1(PENJAS)/AMIK NURMAL LUWUK', 'GURU', '1234', '69759864'),
('1998092201', 'zulkifli s.ag', '128884765516738', 'tatakalai', '1998-09-22', 'L', 'IV/a', 'PEMBINA', '2020-01-25', 'S1(PENDIDIKAN AGAMA)UNTAD', 'KEPALA SEKOLAH', '123', '69759864');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_indikator_kinerja`
--

CREATE TABLE `tbl_indikator_kinerja` (
  `id_indikator_kinerja` int(11) NOT NULL,
  `uraian_indikator_kinerja` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_indikator_kinerja`
--

INSERT INTO `tbl_indikator_kinerja` (`id_indikator_kinerja`, `uraian_indikator_kinerja`) VALUES
(1, 'MERENCANAKAN DAN MELAKSANAKAN PEMBELAJARAN'),
(2, 'MENGEVALUASI DAN MENILAI HASIL PEMBELAJARAN'),
(3, 'MENGANALISIS HASIL PEMBELAJARAN'),
(4, 'MELAKSANAKAN TINDAK LANJUT HASIL PENILAIAN'),
(5, 'MELAKSANAKAN PEMBIMBINGAN PADA KELAS YANG MENJADI TANGGUNG JAWABNYA'),
(6, 'MENGIKUTI DIKLAT FUNGSIONAL, LAMANYA ANTARA 30 S.D 80 JAM'),
(7, 'MENJADI ANGGOTA AKTIF KEPRAMUKAAN'),
(8, 'PENGAWAS UJIAN SEKOLAH'),
(9, 'PENGAWAS UJIAN NASIONAL');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_indikator_laporan`
--

CREATE TABLE `tbl_indikator_laporan` (
  `id_indikator_laporan` int(11) NOT NULL,
  `uraian_indikator_laporan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_indikator_laporan`
--

INSERT INTO `tbl_indikator_laporan` (`id_indikator_laporan`, `uraian_indikator_laporan`) VALUES
(1, 'JUMLAH SISWA'),
(2, 'JUMLAH KELAS'),
(3, 'JUMLAH GURU/TU'),
(4, 'LUAS TANAH'),
(5, 'JUMLAH RUANGAN'),
(6, 'SARANA OLAHRAGA');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kinerja`
--

CREATE TABLE `tbl_kinerja` (
  `id_kinerja` varchar(25) NOT NULL,
  `bulan` int(2) NOT NULL,
  `tahun` int(4) NOT NULL,
  `id_guru` varchar(15) NOT NULL,
  `status` enum('1','2','3','4','5') NOT NULL,
  `tgl_kirim` date NOT NULL,
  `keterangan` text NOT NULL,
  `penilai` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kinerja`
--

INSERT INTO `tbl_kinerja` (`id_kinerja`, `bulan`, `tahun`, `id_guru`, `status`, `tgl_kirim`, `keterangan`, `penilai`) VALUES
('1994120701202010', 10, 2020, '1994120701', '1', '2020-10-26', '', ''),
('1994120701202011', 11, 2020, '1994120701', '2', '2020-10-26', '', ''),
('199412070120203', 3, 2020, '1994120701', '4', '2020-10-26', '<p>adada</p>', 'SMP NEGERI 1  TINANGKUNG'),
('199412070120204', 4, 2020, '1994120701', '5', '2020-10-26', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_laporan`
--

CREATE TABLE `tbl_laporan` (
  `id_laporan` varchar(25) NOT NULL,
  `bulan` int(2) NOT NULL,
  `tahun` int(4) NOT NULL,
  `npsn` varchar(15) NOT NULL,
  `status` enum('1','2','3','4','5') NOT NULL,
  `tgl_kirim` date NOT NULL,
  `keterangan` text NOT NULL,
  `pemeriksa` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_laporan`
--

INSERT INTO `tbl_laporan` (`id_laporan`, `bulan`, `tahun`, `npsn`, `status`, `tgl_kirim`, `keterangan`, `pemeriksa`) VALUES
('123420204', 4, 2020, '1234', '3', '2020-10-26', '<p>adad</p>', 'qeqe');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sekolah`
--

CREATE TABLE `tbl_sekolah` (
  `npsn` varchar(10) NOT NULL,
  `nama_sekolah` varchar(100) NOT NULL,
  `alamat_sekolah` text NOT NULL,
  `telp_sekolah` varchar(50) NOT NULL,
  `desa` varchar(100) NOT NULL,
  `kecamatan` varchar(100) NOT NULL,
  `jenjang_sekolah` varchar(50) NOT NULL,
  `nama_kepala_sekolah` varchar(50) DEFAULT NULL,
  `password_sekolah` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sekolah`
--

INSERT INTO `tbl_sekolah` (`npsn`, `nama_sekolah`, `alamat_sekolah`, `telp_sekolah`, `desa`, `kecamatan`, `jenjang_sekolah`, `nama_kepala_sekolah`, `password_sekolah`) VALUES
('1234', 'SMP NEGERI 1  TINANGKUNG', 'SALAKAN', '3', 'KELURAHAN SALAKAN', 'TINANGKUNG', 'SMP', 'ZULKIFLI', '12'),
('69759864', 'SMP NEGERI 5 SATAP BULAGI', 'DESA KOMBA KOMBA', '0', 'KOMBA KOMBA', 'BULAGI', 'SD', 'YEPRI PANDI', '123');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subindikator_laporan`
--

CREATE TABLE `tbl_subindikator_laporan` (
  `id_subindikator_laporan` int(11) NOT NULL,
  `id_indikator_laporan` int(11) NOT NULL,
  `uraian_subindikator_laporan` varchar(100) NOT NULL,
  `satuan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_subindikator_laporan`
--

INSERT INTO `tbl_subindikator_laporan` (`id_subindikator_laporan`, `id_indikator_laporan`, `uraian_subindikator_laporan`, `satuan`) VALUES
(1, 1, 'KELAS 1', 'SISWA'),
(3, 1, 'KELAS 2', 'SISWA'),
(4, 1, 'KELAS 3', 'SISWA'),
(5, 1, 'KELAS 4', 'SISWA'),
(8, 1, 'KELAS 5', 'SISWA'),
(10, 1, 'KELAS 6', 'SISWA'),
(11, 1, 'KELAS 7', 'SISWA'),
(12, 1, 'KELAS 8', 'SISWA'),
(13, 1, 'KELAS 9', 'SISWA'),
(14, 2, 'KELAS 1', 'RUANG'),
(15, 2, 'KELAS 2', 'RUANG'),
(16, 2, 'KELAS 3', 'RUANG'),
(17, 2, 'KELAS 4', 'RUANG'),
(18, 2, 'KELAS 5', 'RUANG'),
(19, 2, 'KELAS 6', 'RUANG'),
(20, 2, 'KELAS 7', 'RUANG'),
(21, 2, 'KELAS 8', 'RUANG'),
(22, 2, 'KELAS 9', 'RUANG'),
(23, 3, 'KEPALA SEKOLAH', 'ORANG'),
(24, 3, 'WAKASEK', 'ORANG'),
(25, 3, 'GURU TETEAP', 'ORANG'),
(26, 3, 'GURU BANTU', 'ORANG'),
(27, 3, 'GTT DAERAH', 'ORANG'),
(28, 3, 'GTT', 'ORANG'),
(29, 3, 'PEGAWAI TETAP', 'ORANG'),
(30, 3, 'PEGAWAI TIDAK TETAP', 'ORANG'),
(31, 3, 'SATPAM', 'ORANG'),
(32, 3, 'PNS DIPERBANTUKAN', 'ORANG'),
(33, 4, 'LUAS TANAH', 'M2'),
(34, 4, 'LUAS BANGUNAN', 'M2'),
(35, 4, 'LUAS TANAH BELUM TERPAKAI', 'M2'),
(36, 5, 'RUANGAN KEPALA SEKOLAH', 'RUANG'),
(37, 5, 'RUANG WAKASEK', 'RUANG'),
(38, 5, 'RUANG TAMU', 'RUANG'),
(39, 5, 'RUANG BP/BK', 'RUANG'),
(40, 5, 'RUANG GURU', 'RUANG'),
(41, 5, 'RUANG LABORATORIUM', 'RUANG'),
(42, 5, 'RUANG PERPUSTAKAAN', 'RUANG'),
(43, 5, 'RUANG KETERAMPILAN', 'RUANG'),
(44, 5, 'RUANG KELAS', 'RUANG'),
(45, 5, 'RUANG UKS', 'RUANG'),
(46, 5, 'WC SISWA', 'RUANG'),
(47, 5, 'WC GURU', 'RUANG'),
(48, 5, 'WC KEPALA SEKOLAH', 'RUANG'),
(49, 5, 'RUANG DINAS KEPALA SEKOLAH', 'RUANG'),
(50, 5, 'RUANG DINAS (MESS) GURU', 'RUANG'),
(51, 5, 'RUANG DINAS PENJAGA SEKOLAH', 'RUANG'),
(52, 5, 'MUSHOLLAH', 'RUANG'),
(53, 5, 'GARDU SATPAM', 'RUANG'),
(54, 5, 'TEMPAT PARKIR', 'RUANG'),
(55, 6, 'LAPANGAN BASKET', 'BUAH'),
(56, 6, 'LAPANGAN BATMINTON', 'BUAH'),
(57, 6, 'LAPANGAN VOLLY', 'BUAH'),
(58, 6, 'LAPANGAN TAKRAW', 'BUAH'),
(59, 6, 'TENIS MEJA', 'BUAH'),
(60, 6, 'MATRAS', 'BUAH');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD PRIMARY KEY (`id_pertanyaan`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tbl_dkinerja`
--
ALTER TABLE `tbl_dkinerja`
  ADD PRIMARY KEY (`id_dkinerja`);

--
-- Indexes for table `tbl_dlaporan`
--
ALTER TABLE `tbl_dlaporan`
  ADD PRIMARY KEY (`id_dlaporan`);

--
-- Indexes for table `tbl_guru`
--
ALTER TABLE `tbl_guru`
  ADD PRIMARY KEY (`id_guru`),
  ADD KEY `npsn` (`npsn`);

--
-- Indexes for table `tbl_indikator_kinerja`
--
ALTER TABLE `tbl_indikator_kinerja`
  ADD PRIMARY KEY (`id_indikator_kinerja`);

--
-- Indexes for table `tbl_indikator_laporan`
--
ALTER TABLE `tbl_indikator_laporan`
  ADD PRIMARY KEY (`id_indikator_laporan`);

--
-- Indexes for table `tbl_kinerja`
--
ALTER TABLE `tbl_kinerja`
  ADD PRIMARY KEY (`id_kinerja`);

--
-- Indexes for table `tbl_laporan`
--
ALTER TABLE `tbl_laporan`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indexes for table `tbl_sekolah`
--
ALTER TABLE `tbl_sekolah`
  ADD PRIMARY KEY (`npsn`);

--
-- Indexes for table `tbl_subindikator_laporan`
--
ALTER TABLE `tbl_subindikator_laporan`
  ADD PRIMARY KEY (`id_subindikator_laporan`),
  ADD KEY `id_indikator_laporan` (`id_indikator_laporan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  MODIFY `id_pertanyaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_dkinerja`
--
ALTER TABLE `tbl_dkinerja`
  MODIFY `id_dkinerja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_dlaporan`
--
ALTER TABLE `tbl_dlaporan`
  MODIFY `id_dlaporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_indikator_kinerja`
--
ALTER TABLE `tbl_indikator_kinerja`
  MODIFY `id_indikator_kinerja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_indikator_laporan`
--
ALTER TABLE `tbl_indikator_laporan`
  MODIFY `id_indikator_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_subindikator_laporan`
--
ALTER TABLE `tbl_subindikator_laporan`
  MODIFY `id_subindikator_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
