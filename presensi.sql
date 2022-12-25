-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Des 2022 pada 17.09
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `presensi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `presensi_guru`
--

CREATE TABLE `presensi_guru` (
  `id_presensi` int(11) NOT NULL,
  `id_guru` varchar(16) NOT NULL,
  `tgl_presensi` date DEFAULT NULL,
  `status` varchar(6) NOT NULL,
  `valid` varchar(3) NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `presensi_guru`
--

INSERT INTO `presensi_guru` (`id_presensi`, `id_guru`, `tgl_presensi`, `status`, `valid`, `keterangan`) VALUES
(2, '1990111320190312', '2022-12-25', 'hadir', 'Y', 'IMG-20221127-WA0017.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `presensi_siswa`
--

CREATE TABLE `presensi_siswa` (
  `id_presensi` int(11) NOT NULL,
  `id_siswa` varchar(16) NOT NULL,
  `tgl_presensi` date NOT NULL,
  `status` varchar(6) NOT NULL,
  `valid` varchar(3) NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `presensi_siswa`
--

INSERT INTO `presensi_siswa` (`id_presensi`, `id_siswa`, `tgl_presensi`, `status`, `valid`, `keterangan`) VALUES
(21, '20106050026', '2022-12-25', 'hadir', 'Y', 'IMG20221112114333.jpg'),
(22, '20106050029', '2022-12-25', 'hadir', 'NY', 'IMG20221029112836.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(16) NOT NULL,
  `pw_admin` varchar(32) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `jk` varchar(3) NOT NULL,
  `alamat` varchar(40) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `tgl_lhr` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `pw_admin`, `nama`, `jk`, `alamat`, `no_hp`, `tgl_lhr`) VALUES
(1, '21232f297a57a5a743894a0e4a801fc3', 'Akhsan', 'L', 'Kudus', '085678912345', '2002-02-02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_guru`
--

CREATE TABLE `tb_guru` (
  `id_guru` varchar(16) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `jk` varchar(3) NOT NULL,
  `alamat` varchar(40) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `tgl_lhr` date NOT NULL,
  `pw_guru` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_guru`
--

INSERT INTO `tb_guru` (`id_guru`, `nama`, `jk`, `alamat`, `no_hp`, `tgl_lhr`, `pw_guru`) VALUES
('1990111320190312', 'Muhammad Galih Wonoseto', 'L', 'Sleman', '088844442222', '1990-01-01', '5bb5f844dac13bc003f6ba50026249b8');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `id_siswa` varchar(16) NOT NULL,
  `pw_siswa` varchar(32) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `jk` varchar(3) NOT NULL,
  `alamat` varchar(40) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `tgl_lhr` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_siswa`
--

INSERT INTO `tb_siswa` (`id_siswa`, `pw_siswa`, `nama`, `jk`, `alamat`, `no_hp`, `tgl_lhr`) VALUES
('20106050026', 'a70d09e95b1d2764433e333040243094', 'Fatkhi Nur Akhsan', 'L', 'Kudus', '085156474693', '2002-07-06'),
('20106050029', '070aa66550916626673f492bdbdb655f', 'Nabil Ilyasa', 'L', 'Purworejo', '088888777666', '2002-12-27');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `presensi_guru`
--
ALTER TABLE `presensi_guru`
  ADD PRIMARY KEY (`id_presensi`),
  ADD KEY `fk_presensi_guru` (`id_guru`);

--
-- Indeks untuk tabel `presensi_siswa`
--
ALTER TABLE `presensi_siswa`
  ADD PRIMARY KEY (`id_presensi`),
  ADD KEY `fk_presensi_siswa` (`id_siswa`);

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `tb_guru`
--
ALTER TABLE `tb_guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indeks untuk tabel `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD UNIQUE KEY `id_siswa` (`id_siswa`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `presensi_guru`
--
ALTER TABLE `presensi_guru`
  MODIFY `id_presensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `presensi_siswa`
--
ALTER TABLE `presensi_siswa`
  MODIFY `id_presensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `presensi_guru`
--
ALTER TABLE `presensi_guru`
  ADD CONSTRAINT `fk_presensi_guru` FOREIGN KEY (`id_guru`) REFERENCES `tb_guru` (`id_guru`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `presensi_siswa`
--
ALTER TABLE `presensi_siswa`
  ADD CONSTRAINT `fk_presensi_siswa` FOREIGN KEY (`id_siswa`) REFERENCES `tb_siswa` (`id_siswa`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
