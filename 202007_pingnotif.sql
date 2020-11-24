-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Nov 2020 pada 03.02
-- Versi server: 10.1.34-MariaDB
-- Versi PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `202007_broadcast`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `history_billing`
--

CREATE TABLE `history_billing` (
  `id_his_bill` int(11) NOT NULL,
  `id_wa` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_invoice` varchar(100) NOT NULL,
  `kd_unik` int(11) NOT NULL,
  `status` enum('pending','konfirmasi','lunas','batal') NOT NULL,
  `status_akses` enum('debit','kredit') NOT NULL,
  `nominal` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `history_billing`
--

INSERT INTO `history_billing` (`id_his_bill`, `id_wa`, `created_at`, `id_invoice`, `kd_unik`, `status`, `status_akses`, `nominal`, `id_user`) VALUES
(37, 9, '2020-11-20 07:55:23', 'Inv-235201120025350', 433, 'lunas', 'kredit', 250433, 2),
(38, 10, '2020-11-20 07:54:43', 'Inv-236201120025350', 286, 'lunas', 'kredit', 250286, 2),
(39, 12, '2020-11-20 07:53:50', 'Inv-137201120025350', 912, 'pending', 'kredit', 250912, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `history_wa`
--

CREATE TABLE `history_wa` (
  `id_his_wa` int(11) NOT NULL,
  `id_wa` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `no_tujuan` varchar(15) DEFAULT NULL,
  `isi_pesan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `history_wa`
--

INSERT INTO `history_wa` (`id_his_wa`, `id_wa`, `created_at`, `no_tujuan`, `isi_pesan`) VALUES
(1, 9, '2020-11-20 07:57:00', NULL, ''),
(2, 9, '2020-11-20 07:57:49', NULL, ''),
(3, 9, '2020-11-20 07:58:44', NULL, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `item_debit`
--

CREATE TABLE `item_debit` (
  `id_item_debit` int(11) NOT NULL,
  `id_his_bill` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `item_debit`
--

INSERT INTO `item_debit` (`id_item_debit`, `id_his_bill`) VALUES
(5, 38);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sms_account`
--

CREATE TABLE `sms_account` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `number` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_billing`
--

CREATE TABLE `tb_billing` (
  `id_billing` int(11) NOT NULL,
  `id_wa` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `masa_aktif` date DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_billing`
--

INSERT INTO `tb_billing` (`id_billing`, `id_wa`, `created_at`, `masa_aktif`, `id_user`) VALUES
(35, 9, '2020-11-20 07:55:23', '2020-12-23', 2),
(36, 10, '2020-11-20 07:54:44', '2020-12-23', 2),
(37, 12, '2020-11-20 07:53:50', NULL, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_domain`
--

CREATE TABLE `tb_domain` (
  `id_domain` int(11) NOT NULL,
  `id_no_hp` int(11) NOT NULL,
  `domain` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_domain`
--

INSERT INTO `tb_domain` (`id_domain`, `id_no_hp`, `domain`, `created_at`) VALUES
(9, 9, 'ardiansdr.com', '2020-11-16 05:08:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_konfirmasi`
--

CREATE TABLE `tb_konfirmasi` (
  `id_konfirmasi` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `status` enum('pending','sukses','batal') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_his_bill` int(11) DEFAULT NULL,
  `metode` enum('auto','manual') DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `bukti` varchar(100) DEFAULT NULL,
  `tanggal_transfer` date DEFAULT NULL,
  `bank` enum('mandiri','bri','bni','bca') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_konfirmasi`
--

INSERT INTO `tb_konfirmasi` (`id_konfirmasi`, `id_user`, `status`, `created_at`, `id_his_bill`, `metode`, `keterangan`, `bukti`, `tanggal_transfer`, `bank`) VALUES
(10, 2, 'sukses', '2020-11-20 07:54:43', 38, 'manual', 'konfirmasi manual', '5530-20201120145405.png', '2020-11-18', 'bri');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pesan_otomatis`
--

CREATE TABLE `tb_pesan_otomatis` (
  `id_otomatis` int(11) NOT NULL,
  `pesan` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `waktu` time DEFAULT NULL,
  `id_wa` int(11) DEFAULT NULL,
  `status` enum('aktif','non_aktif') NOT NULL,
  `setiap_waktu` enum('ya','tidak') DEFAULT NULL,
  `nomor_kirim_wa` text,
  `tanggal_terbit` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pesan_otomatis`
--

INSERT INTO `tb_pesan_otomatis` (`id_otomatis`, `pesan`, `created_at`, `id_user`, `waktu`, `id_wa`, `status`, `setiap_waktu`, `nomor_kirim_wa`, `tanggal_terbit`) VALUES
(1, 'Test sdsdsd', '2020-11-23 07:56:47', 2, '13:00:00', 9, 'aktif', 'ya', 'a:2:{i:0;s:11:\"23223233333\";i:1;s:13:\"0865436272782\";}', '2020-11-24'),
(2, 'Test sdsdsdrgfgnghjhjkhjhhkhj', '2020-11-23 07:58:07', 2, '13:00:00', 9, 'aktif', 'ya', 'a:2:{i:0;s:13:\"0865436272782\";i:1;s:11:\"23223233333\";}', '2020-11-24'),
(3, 'Test test test', '2020-11-23 08:22:57', 2, '17:30:00', 10, 'aktif', 'ya', 'a:2:{i:0;s:9:\"434567899\";i:1;s:12:\"094847464546\";}', '2020-11-28'),
(4, 'asdfasdfasdfdsfdsfgh', '2020-11-23 09:25:16', 2, '17:30:00', 10, 'aktif', 'ya', 'a:2:{i:0;s:15:\"234567865432456\";i:1;s:14:\"23456789935467\";}', '2020-11-24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_saldo`
--

CREATE TABLE `tb_saldo` (
  `id_saldo` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nominal` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_saldo`
--

INSERT INTO `tb_saldo` (`id_saldo`, `id_user`, `nominal`, `created_at`) VALUES
(5, 2, 5000000, '2020-11-23 03:02:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_dev` enum('superadmin','user') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_user` enum('owner','user') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_owner` int(11) DEFAULT NULL,
  `hak_akses_wa` text COLLATE utf8mb4_unicode_ci,
  `hak_akses_sms` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `status_dev`, `status_user`, `id_owner`, `hak_akses_wa`, `hak_akses_sms`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@admin.com', NULL, '$2y$10$xbWIKkIK2FA/vdujqM8Lce9ZsYgc6KwqydKjVUbxzKmHS5y01GKcS', NULL, 'user', NULL, NULL, NULL, NULL, '2020-11-11 19:44:25', '2020-11-05 01:06:53'),
(2, 'ardian', 'ardian@admin.com', NULL, '$2y$10$sIzBWs9Hc0WwKRLUbtDT1eB5enWmuxS/SoS.A1DZS2lnOtagxXa4e', NULL, 'superadmin', NULL, NULL, NULL, NULL, '2020-11-10 04:52:40', '2020-11-10 04:52:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wa_account`
--

CREATE TABLE `wa_account` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `number` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `session` text,
  `token` text,
  `status` enum('aktif','nonaktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `wa_account`
--

INSERT INTO `wa_account` (`id`, `user_id`, `number`, `created_at`, `updated_at`, `session`, `token`, `status`) VALUES
(9, 2, '854125662244455', '2020-11-16 05:01:26', '2020-11-16 05:03:12', 'a:4:{s:11:\"WABrowserId\";s:26:\"\"EbRxMHRn+DqxSl25r4ZPww==\"\";s:14:\"WASecretBundle\";s:166:\"{\"key\":\"ABpdr0ohOfrKKABFzaYy7k2/RArthpVKC7RUQNflxlY=\",\"encKey\":\"gd5F89e4/A4eazkN79TaFJJyJhT7S/wElVy5lCQjKc8=\",\"macKey\":\"ABpdr0ohOfrKKABFzaYy7k2/RArthpVKC7RUQNflxlY=\"}\";s:8:\"WAToken1\";s:46:\"\"rFzjqaRyEvpLhyBtViDAAwUhUJ6oTwatCv0Ob9yDeqU=\"\";s:8:\"WAToken2\";s:84:\"\"1@h5PsIRWMzTmpk4ivja1IlYc1Y0/fe4v6oc6hIzJu2kXwKaSHryGcdjzblaTJ/jgsvpUpml1YBLBgSQ==\"\";}', 'b82b4bf37b7dc494b975e388d2e14c1b', 'aktif'),
(10, 2, '8221212121241', '2020-11-16 06:41:19', '2020-11-16 06:41:19', NULL, NULL, 'aktif'),
(11, 1, '854125662244455', '2020-11-17 06:07:55', '2020-11-17 06:07:55', NULL, NULL, 'nonaktif'),
(12, 1, '585226621633333', '2020-11-17 07:20:37', '2020-11-17 07:20:37', 'a:4:{s:11:\"WABrowserId\";s:26:\"\"EbRxMHRn+DqxSl25r4ZPww==\"\";s:14:\"WASecretBundle\";s:166:\"{\"key\":\"ABpdr0ohOfrKKABFzaYy7k2/RArthpVKC7RUQNflxlY=\",\"encKey\":\"gd5F89e4/A4eazkN79TaFJJyJhT7S/wElVy5lCQjKc8=\",\"macKey\":\"ABpdr0ohOfrKKABFzaYy7k2/RArthpVKC7RUQNflxlY=\"}\";s:8:\"WAToken1\";s:46:\"\"rFzjqaRyEvpLhyBtViDAAwUhUJ6oTwatCv0Ob9yDeqU=\"\";s:8:\"WAToken2\";s:84:\"\"1@h5PsIRWMzTmpk4ivja1IlYc1Y0/fe4v6oc6hIzJu2kXwKaSHryGcdjzblaTJ/jgsvpUpml1YBLBgSQ==\"\";}', 'b82b4bf37b7dc494b975e388d2e14c1b', 'aktif');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `history_billing`
--
ALTER TABLE `history_billing`
  ADD PRIMARY KEY (`id_his_bill`);

--
-- Indeks untuk tabel `history_wa`
--
ALTER TABLE `history_wa`
  ADD PRIMARY KEY (`id_his_wa`);

--
-- Indeks untuk tabel `item_debit`
--
ALTER TABLE `item_debit`
  ADD PRIMARY KEY (`id_item_debit`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sms_account`
--
ALTER TABLE `sms_account`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `tb_billing`
--
ALTER TABLE `tb_billing`
  ADD PRIMARY KEY (`id_billing`);

--
-- Indeks untuk tabel `tb_domain`
--
ALTER TABLE `tb_domain`
  ADD PRIMARY KEY (`id_domain`);

--
-- Indeks untuk tabel `tb_konfirmasi`
--
ALTER TABLE `tb_konfirmasi`
  ADD PRIMARY KEY (`id_konfirmasi`);

--
-- Indeks untuk tabel `tb_pesan_otomatis`
--
ALTER TABLE `tb_pesan_otomatis`
  ADD PRIMARY KEY (`id_otomatis`);

--
-- Indeks untuk tabel `tb_saldo`
--
ALTER TABLE `tb_saldo`
  ADD PRIMARY KEY (`id_saldo`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `wa_account`
--
ALTER TABLE `wa_account`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `history_billing`
--
ALTER TABLE `history_billing`
  MODIFY `id_his_bill` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `history_wa`
--
ALTER TABLE `history_wa`
  MODIFY `id_his_wa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `item_debit`
--
ALTER TABLE `item_debit`
  MODIFY `id_item_debit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `sms_account`
--
ALTER TABLE `sms_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_billing`
--
ALTER TABLE `tb_billing`
  MODIFY `id_billing` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `tb_domain`
--
ALTER TABLE `tb_domain`
  MODIFY `id_domain` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tb_konfirmasi`
--
ALTER TABLE `tb_konfirmasi`
  MODIFY `id_konfirmasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tb_pesan_otomatis`
--
ALTER TABLE `tb_pesan_otomatis`
  MODIFY `id_otomatis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_saldo`
--
ALTER TABLE `tb_saldo`
  MODIFY `id_saldo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `wa_account`
--
ALTER TABLE `wa_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
