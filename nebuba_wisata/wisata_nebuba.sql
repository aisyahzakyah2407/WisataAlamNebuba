-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Agu 2025 pada 15.34
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wisata_nebuba`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `nama`, `username`, `password`) VALUES
(1, 'Administrator', 'admin123', 'admin321');

-- --------------------------------------------------------

--
-- Struktur dari tabel `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id` int(11) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `keterangan` text NOT NULL,
  `gambar` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `fasilitas`
--

INSERT INTO `fasilitas` (`id`, `nama`, `keterangan`, `gambar`) VALUES
(12, 'Vila Pondok Mahari', 'Vila Pondok Mahari menyediakan fasilitas lengkap yang dapat menampung 40-50 orang, cocok untuk liburan bersama rombongan besar.', 'WhatsApp Image 2025-08-04 at 00.08.41.jpeg'),
(13, 'Vila Kurcaci 1 Lt', 'Vila Kurcaci 1 Lantai cocok untuk 2-4 orang yang menginginkan suasana nyaman dan tenang.', 'WhatsApp Image 2025-08-05 at 06.35.31.jpeg'),
(14, 'Vila Kurcaci 2 Lt', 'Vila Kurcaci 2 Lantai ideal untuk keluarga maupun kelompok kecil, dengan kapasitas 5-7 orang dan fasilitas pendukung yang lengkap.', 'WhatsApp Image 2025-08-05 at 06.35.32.jpeg'),
(15, 'Vila Bukit', 'Vila Bukit 2 Lantai merupakan akomodasi yang nyaman dan lengkap, dengan lantai dua yang dilengkapi balkon luas. Kapasitas vila ini diperkirakan dapat menampung sekitar 10-15 orang, cocok untuk keluarga besar maupun kelompok kecil', 'WhatsApp Image 2025-08-05 at 11.53.00.jpeg'),
(16, 'Tenda Camping Tepian Sungai', 'Rasakan sensasi berkemah di pinggir sungai yang asri dan damai! Tenda Camping Tepian Sungai siap menyambut petualang dengan kapasitas 5-10 orang.', 'WhatsApp Image 2025-08-05 at 06.06.59.jpeg'),
(17, 'Tenda Camping Tepian Sungai', 'Nikmati pengalaman berkemah yang tenang dan alami di tepi sungai dengan fasilitas tenda camping kami. Kapasitas tenda ini dapat menampung sekitar 5-10 orang, cocok untuk keluarga atau kelompok kecil yang ingin bersantai dan menikmati suasana alam.', 'WhatsApp Image 2025-08-05 at 06.47.41.jpeg'),
(18, 'Keranjang Sultan', 'Duduk di \"Keranjang Sultan\" yang mengantung langsung di atas sungai, rasakan ketenangan sambil menikmati suara gemericik air dan pemandangan asri.', 'WhatsApp Image 2025-04-27 at 07.21.34 (1).jpeg'),
(19, 'Rainbow Slide', 'Meluncur bersama teman atau pasangan di lintasan pelangi yang memacu adrenalin. rasakan sensasi kecepatan sambil tertawa lepas', 'WhatsApp Image 2025-04-27 at 07.21.34 (2).jpeg'),
(20, 'Gazebo', 'istirahat nyaman di gazebo berwarna-warni sambil menikmati udara sejuk dan panorama sungai yang istirahat menenangkan.', 'WhatsApp Image 2025-04-27 at 07.22.01 (1).jpeg'),
(21, 'Payung Pelangi', 'Nikmati waktu bersama keluarga di bawah payung warna-warni, sambil berendam di kolam alami yang jernih dan segar', 'WhatsApp Image 2025-08-05 at 07.23.21 (1).jpeg'),
(22, 'Aula Seribu Batu', 'Ruang serbaguna yang nyaman untuk kegiatan seperti seminar,pelatihan atau reuni keluarga besar', 'WhatsApp Image 2025-08-05 at 07.23.21.jpeg'),
(23, 'ATV', 'Uji adrenalin di jalur berbatuan dan tanah alami sambil mengendarai ATV', 'WhatsApp Image 2025-08-05 at 06.35.29 (1).jpeg'),
(24, 'Ayunan Seribu Batu', 'Ayunan jumbo di pinggir sungai yang jadi spot wajib untuk selfie bareng keluarga atau teman', 'WhatsApp Image 2025-08-05 at 06.35.31 (1).jpeg'),
(25, 'Flying Fox', 'Terbang dari ketinggian melewati sungai, flying fox ini memberikan sensasi luar biasa sekaligus pemandangan indah dari atas', 'WhatsApp Image 2025-08-05 at 07.16.34.jpeg'),
(26, 'Musholla', 'Suasana mushola yang sederhana ini menghadirkan kedamaian dan ketenangan. Tempat ini mengingatkan kita akan pentingnya beribadah dan menghargai kerukunan dalam kehidupan sehari-hari.', 'WhatsApp Image 2025-04-27 at 07.22.02.jpeg'),
(27, 'Kids Outboud Area', 'Jelajahi area outbound kids yang penuh warna dan keseruan! Tempat bermain yang aman dan menyenangkan untuk anak-anak', 'WhatsApp Image 2025-04-27 at 06.59.57 (2).jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `galeri`
--

CREATE TABLE `galeri` (
  `id` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `gambar` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `galeri`
--

INSERT INTO `galeri` (`id`, `keterangan`, `gambar`) VALUES
(8, 'Seru-seruan di alam, cocok buat liburan keluarga.', '6896eb7296d3e_slide1.jpeg'),
(9, 'Santai sambil nikmati suasana alami.', 'slide2.jpeg'),
(10, 'Tempat menginap yang beda dan asri banget.', 'WhatsApp Image 2025-04-27 at 06.59.54.jpeg'),
(11, 'Camping seru dan suasana hangat', 'WhatsApp Image 2025-08-05 at 13.01.27.jpeg'),
(12, 'Menikmati keindahan alam', '1.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `informasi`
--

CREATE TABLE `informasi` (
  `id` int(11) NOT NULL,
  `judul` varchar(250) NOT NULL,
  `isi` text NOT NULL,
  `tanggal` date NOT NULL,
  `gambar` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `informasi`
--

INSERT INTO `informasi` (`id`, `judul`, `isi`, `tanggal`, `gambar`) VALUES
(4, 'Peringatan Hari Jadi Luwu ke-66', 'Acara memperingati hari jadi Kabupaten Luwu yang ke-6, dihadiri oleh masyarakat dan tokoh setempat. Semoga kita bisa mengenang sejarah dan meningkatkan semangat pembangunan daerah.\\r\\nTanggal:\\r\\n04 Juli 2025', '2025-08-05', 'WhatsApp Image 2025-08-05 at 05.55.23.jpeg'),
(5, 'Selamat Hari Raya Idul Adha 1446 H', 'Semoga kita dapat memaknai pengorbanan dan keikhlasan di hari yang suci ini. Mari tingkatkan rasa syukur dan kebersamaan keluarga.\r\n\r\nTanggal:\r\n1 Syawal 1446 H (tanggal sesuai kalender hijriah)', '2025-08-05', 'WhatsApp Image 2025-08-05 at 06.13.46.jpeg'),
(6, 'Selamat Hari Raya Idul Fitri 1446 H', 'Segenap keluarga besar Negeri Seribu Batu mengucapkan Selamat Hari Raya Idul Fitri. Semoga hari ini penuh berkah, kedamaian, dan kebahagiaan bagi kita semua.\r\n\r\nTanggal:\r\n1 Syawal 1446 H (tanggal sesuai kalender hijriah)', '2025-08-05', 'WhatsApp Image 2025-08-05 at 06.35.29.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kontak`
--

CREATE TABLE `kontak` (
  `id` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `whatsapp` varchar(15) NOT NULL,
  `instagram` varchar(50) NOT NULL,
  `facebook` varchar(100) NOT NULL,
  `jam_operasional` varchar(50) DEFAULT '24 Jam Setiap Hari',
  `nama` varchar(100) DEFAULT NULL,
  `pesan` text DEFAULT NULL,
  `tanggal` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kontak`
--

INSERT INTO `kontak` (`id`, `alamat`, `telepon`, `whatsapp`, `instagram`, `facebook`, `jam_operasional`, `nama`, `pesan`, `tanggal`) VALUES
(1, 'Bukit Harapan, Kecamatan Bua, Kota Palopo, Sulawesi Selatan, Palopo, 91991', '085342747891', '85342747891', 'nebuba', 'profile.php?id=100090344000936', '24 Jam Setiap Hari', NULL, NULL, '2025-08-04 12:35:19'),
(2, '', '081234567890', '', '', '', '24 Jam Setiap Hari', 'Lia', 'halo', '2025-08-09 13:40:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesan`
--

CREATE TABLE `pesan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `pesan` text DEFAULT NULL,
  `tanggal` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `profil`
--

CREATE TABLE `profil` (
  `id` int(11) NOT NULL,
  `judul` varchar(250) NOT NULL,
  `isi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `profil`
--

INSERT INTO `profil` (`id`, `judul`, `isi`) VALUES
(1, 'Wisata Alam Nebuba - Negeri Seribu Batu', 'Wisata Alam Nebuba (Negeri Seribu Batu) merupakan destinasi berbasis alam seluas 3,2 hektar yang menyajikan panorama alami berupa sungai jernih yang diapit dua bukit. Batu-batu sungai yang tersusun secara alami menambah keindahan pemandangan yang menarik minat pengunjung untuk berlama-lama menikmati suasana.\n\nSelain menawarkan keindahan alam, Nebuba juga menyediakan fasilitas seperti penginapan, area outbound, wahana permainan, dan spot-spot foto menarik yang menjadi daya tarik tersendiri bagi wisatawan.\n\nLokasi: Desa Bukit Harapan, Kecamatan Bua, Kabupaten Luwu, Sulawesi Selatan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `reservasi`
--

CREATE TABLE `reservasi` (
  `id` int(11) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `catatan` text DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Pending',
  `tanggal_dibuat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `reservasi`
--

INSERT INTO `reservasi` (`id`, `nama`, `email`, `telepon`, `jenis`, `tanggal`, `jumlah`, `catatan`, `status`, `tanggal_dibuat`) VALUES
(2, 'Ani Wijaya', 'ani@yahoo.com', '082345678912', 'Vila', '2025-07-20', 1, 'Menginap 2 malam', 'Rejected', '2025-06-12 06:30:45'),
(3, 'Citra Dewi', 'citra@gmail.com', '083456789123', 'Tenda', '2025-08-05', 2, 'Membawa tenda sendiri', 'Confirmed', '2025-06-15 02:20:33'),
(4, 'Lia', '', '081234567890', 'Tiket Masuk', '2025-08-30', 1, '', 'Confirmed', '2025-08-03 12:42:12'),
(5, 'Lia', '', '085342747891', 'Lapak', '2025-08-29', 3, '', 'Rejected', '2025-08-08 23:18:23'),
(6, 'nila', '', '082311244657', 'Tenda', '2025-09-16', 4, '', 'Pending', '2025-08-08 23:20:26');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `informasi`
--
ALTER TABLE `informasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kontak`
--
ALTER TABLE `kontak`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `reservasi`
--
ALTER TABLE `reservasi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `informasi`
--
ALTER TABLE `informasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `kontak`
--
ALTER TABLE `kontak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `profil`
--
ALTER TABLE `profil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `reservasi`
--
ALTER TABLE `reservasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
