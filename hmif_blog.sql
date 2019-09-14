-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Sep 2019 pada 13.30
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hmif_blog`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `citations`
--

CREATE TABLE `citations` (
  `id` int(11) NOT NULL,
  `postId` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `year` year(4) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `publisher` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `page` varchar(255) DEFAULT NULL,
  `createDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updateDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `citations`
--

INSERT INTO `citations` (`id`, `postId`, `type`, `year`, `title`, `author`, `publisher`, `city`, `page`, `createDate`, `updateDate`) VALUES
(1, 1, 1, 2019, 'ajksdjaskdhjkasd', 'Kiki', 'Media', 'Tasikmalaya', '2', '2019-07-30 16:07:45', '2019-08-30 14:16:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `parrentId` int(11) NOT NULL DEFAULT '0',
  `postId` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `content` mediumtext CHARACTER SET latin1 NOT NULL,
  `createDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updateDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `comments`
--

INSERT INTO `comments` (`id`, `parrentId`, `postId`, `userId`, `content`, `createDate`, `updateDate`) VALUES
(1, 0, 1, 1, 'editkontent', '2019-07-30 15:30:35', '2019-08-31 04:19:27'),
(14, 1, 1, 2, 'Ini Child commentar 1', '2019-07-30 15:31:01', '2019-07-30 15:31:01'),
(15, 14, 1, 3, 'ini child child commentar 1', '2019-07-30 15:31:21', '2019-07-30 15:31:21'),
(16, 0, 1, 1, 'ini parent komentar 2', '2019-07-30 15:31:38', '2019-07-30 15:33:19'),
(17, 0, 2, 1, 'ini peranku', '2019-08-30 13:34:15', '2019-08-30 13:35:47'),
(18, 17, 2, 1, 'ini contoh', '2019-08-30 13:36:08', '2019-08-30 13:36:27'),
(19, 0, 7, 1, 'ini komentar via api', '2019-08-30 13:59:41', '2019-08-30 13:59:41'),
(20, 19, 7, 1, 'ini komentar via api', '2019-08-30 13:59:50', '2019-08-30 13:59:50'),
(21, 20, 7, 1, 'ini komentar via api', '2019-08-30 13:59:56', '2019-08-30 13:59:56'),
(22, 19, 7, 1, 'ini komentar via api', '2019-08-30 14:00:00', '2019-08-30 14:00:00'),
(23, 0, 7, 1, 'ini komentar via api', '2019-08-30 14:00:06', '2019-08-30 14:00:06'),
(24, 0, 7, 1, 'ini komentar via api', '2019-08-30 14:00:07', '2019-08-30 14:00:07'),
(25, 0, 7, 1, 'ini komentar via api', '2019-08-30 14:00:08', '2019-08-30 14:00:08'),
(26, 25, 7, 1, 'ini komentar via api', '2019-08-30 14:00:13', '2019-08-30 14:00:13'),
(27, 25, 7, 1, 'ini komentar via api', '2019-08-30 14:00:13', '2019-08-30 14:00:13'),
(28, 25, 7, 1, 'ini komentar via api', '2019-08-30 14:00:14', '2019-08-30 14:00:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `diktat`
--

CREATE TABLE `diktat` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `matkul_id` int(11) DEFAULT NULL,
  `dosen_id` int(11) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateUpdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dosen`
--

CREATE TABLE `dosen` (
  `id` int(11) NOT NULL,
  `nidn` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `dateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dateUpdated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `dosen`
--

INSERT INTO `dosen` (`id`, `nidn`, `nama`, `dateCreated`, `dateUpdated`) VALUES
(1, '99119', 'Nur Widyasono, S.T. M.T.', '2019-08-21 13:58:48', '2019-08-21 13:58:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurnal`
--

CREATE TABLE `jurnal` (
  `id` int(11) NOT NULL,
  `userId` varchar(255) DEFAULT NULL,
  `anggota` varchar(255) DEFAULT NULL,
  `staus` varchar(255) DEFAULT NULL,
  `konfirmasi` varchar(255) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `nama_jurnal` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `issn` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `vol` varchar(5) CHARACTER SET utf8 DEFAULT NULL,
  `no` int(5) DEFAULT NULL,
  `hal` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `publikasi` varchar(255) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `postId` int(11) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `mata_kuliah`
--

CREATE TABLE `mata_kuliah` (
  `id` int(11) NOT NULL,
  `kode_matkul` varchar(255) NOT NULL,
  `nama_matkul` varchar(255) NOT NULL,
  `jml_sks` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pages`
--

CREATE TABLE `pages` (
  `page_id` mediumint(8) NOT NULL,
  `tittle` varchar(100) NOT NULL,
  `seo_tittle` varchar(100) NOT NULL,
  `content` mediumtext NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateUpdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `pages`
--

INSERT INTO `pages` (`page_id`, `tittle`, `seo_tittle`, `content`, `dateCreated`, `dateUpdated`, `status`) VALUES
(1, 'Tes Halaman Pertama', 'test-halaman-peratama', 'ini kontennya bre', '2019-08-21 13:42:53', '2019-08-21 13:42:58', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `creatorId` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` mediumtext,
  `tag` varchar(255) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `views` int(11) DEFAULT '0',
  `likes` int(11) DEFAULT '0',
  `imageUrl` varchar(255) DEFAULT NULL,
  `createDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updateDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `post`
--

INSERT INTO `post` (`id`, `creatorId`, `title`, `content`, `tag`, `category`, `views`, `likes`, `imageUrl`, `createDate`, `updateDate`) VALUES
(1, 1, 'Ini merupakan postingan pertama ', 'postingan pertama bre ek kumaha?', 'Berita,Cerita', 1, 0, 0, NULL, '2019-07-30 16:04:31', '2019-07-30 16:04:36'),
(2, 1, 'update judulnya saja', 'isi postinganneun', 'berita,pengumuman,cerita', 2, 0, 0, 'http://localhost/', '2019-07-30 16:09:51', '2019-08-30 12:44:38'),
(3, 0, 'update judulnya saja', 'isi postinganneun', 'berita,pengumuman,cerita', 2, NULL, NULL, 'http://localhost/', '2019-08-29 15:02:38', '2019-08-30 13:25:22'),
(4, 0, 'update judulnya saja', 'isi postinganneun', 'berita,pengumuman,cerita', 2, 0, 0, 'http://localhost/', '2019-08-29 15:58:57', '2019-08-30 13:25:15'),
(5, 1, 'update judulnya saja', 'isi postinganneun', 'berita,pengumuman,cerita', 2, 0, 0, 'http://localhost/', '2019-08-29 16:00:05', '2019-08-30 13:25:05'),
(6, 1, 'update judulnya saja', 'isi postinganneun', 'berita,pengumuman,cerita', 2, 0, 0, 'http://localhost/', '2019-08-30 13:23:17', '2019-08-30 13:23:17'),
(7, 1, 'update judulnya saja', 'isi postinganneun', 'berita,pengumuman,cerita', 2, 0, 0, 'http://localhost/', '2019-08-30 13:24:38', '2019-08-30 13:24:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `series`
--

CREATE TABLE `series` (
  `id` int(11) NOT NULL,
  `seriesId` varchar(255) DEFAULT NULL,
  `parrentId` varchar(255) DEFAULT NULL,
  `creatorId` varchar(255) DEFAULT NULL,
  `content` mediumtext,
  `image` varchar(255) DEFAULT NULL,
  `sequence` int(11) DEFAULT NULL,
  `createDate` datetime DEFAULT NULL,
  `updateDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `system_user`
--

CREATE TABLE `system_user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `token` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `system_user`
--

INSERT INTO `system_user` (`id`, `name`, `username`, `password`, `type`, `last_login`, `token`) VALUES
(1, 'Rifki Mubarok', 'kiki', 'bbfc7cdcae0f8e7d29a3e97f06833d271dca1857', '1', '2019-08-30 12:39:40', 'e0e25f3b049ef2fde53e914c7b92088b');

--
-- Trigger `system_user`
--
DELIMITER $$
CREATE TRIGGER `system_user_before_insert` BEFORE INSERT ON `system_user` FOR EACH ROW BEGIN
    SET NEW.password = sha1(md5(NEW.password));
  END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `system_user_before_update` BEFORE UPDATE ON `system_user` FOR EACH ROW BEGIN

  IF NEW.password <> OLD.password THEN
    SET NEW.password = sha1(md5(NEW.password));
  END IF;
  END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `citations`
--
ALTER TABLE `citations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `diktat`
--
ALTER TABLE `diktat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jurnal`
--
ALTER TABLE `jurnal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`page_id`) USING BTREE;

--
-- Indeks untuk tabel `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `system_user`
--
ALTER TABLE `system_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `citations`
--
ALTER TABLE `citations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `diktat`
--
ALTER TABLE `diktat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `series`
--
ALTER TABLE `series`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `system_user`
--
ALTER TABLE `system_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
