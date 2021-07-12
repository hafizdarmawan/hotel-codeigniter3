-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Feb 2021 pada 09.23
-- Versi server: 10.3.15-MariaDB
-- Versi PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coba3`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `banner`
--

CREATE TABLE `banner` (
  `id_banner` int(9) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `judul` varchar(128) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `status` enum('0','1') DEFAULT NULL,
  `sequence` int(11) NOT NULL DEFAULT 0,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `banner`
--

INSERT INTO `banner` (`id_banner`, `nama`, `judul`, `deskripsi`, `gambar`, `status`, `sequence`, `id_user`) VALUES
(9, 'Hotel Al Ashri Inn By Urban', 'Selamat datang di', 'Hotel Al Ashri Inn By Urban', 'dee9990720b178d6f91ab8e8c4b42f92.jpg', '1', 0, 1),
(10, 'Hotel Al Asri Inn by Urban', 'Selamat datang di', 'Hotel Al Asri Inn by Urban', '74e1b15062220a03cc2d4904c362bb70.jpeg', '1', 1, 1),
(12, 'Hotel Al Ashri In By Urban', 'Selamat Datang', 'Hotel Al Ashri In By Urban', 'eb13097ba5224fac1e8b34bc14a31c68.jpg', '1', 0, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id_fasilitas` int(10) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `only_kamar` tinyint(1) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `fasilitas`
--

INSERT INTO `fasilitas` (`id_fasilitas`, `nama`, `status`, `only_kamar`, `deskripsi`, `gambar`) VALUES
(1, 'Televisi', '1', 1, 'Televisi', 'f55f257e92f7b8850099f9bb4648bb48.png'),
(3, 'Ac', '1', 1, 'Ac', '5d6cf5e70ffa0582aebf1907895fc432.png'),
(4, 'Parkir Gratis', '1', 0, 'parkir', 'b0896f5fa9a8905cdadc02d3df658994.png'),
(5, 'Wifi', '1', 0, 'wifi', '284a038c4bd71da15eaaf8b98ac99911.png'),
(6, 'CCTV', '1', 0, 'CCTV', '3c7b24613a714bace1b28e4364e451c9.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `galleri`
--

CREATE TABLE `galleri` (
  `id_galleri` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `galleri`
--

INSERT INTO `galleri` (`id_galleri`, `judul`, `id_user`) VALUES
(24, 'Tipe Kamar', 1),
(27, 'Bangunan', 1),
(32, 'Lobby', 1),
(34, 'Fasilitas', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `galleri_rel_gambar`
--

CREATE TABLE `galleri_rel_gambar` (
  `id_rel_galleri` int(11) NOT NULL,
  `id_galleri` int(11) NOT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `is_prioritas` tinyint(4) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `galleri_rel_gambar`
--

INSERT INTO `galleri_rel_gambar` (`id_rel_galleri`, `id_galleri`, `caption`, `is_prioritas`, `gambar`) VALUES
(77, 24, 'Super Room', 0, 'eaa9add73a688203665b4e5377f7cadb.jpeg'),
(78, 24, 'Super Room', 0, 'ffc87d532e015060760a943c61329c75.jpeg'),
(79, 24, 'Standar Room', 0, '817d36fbd379190a90341612c75ded46.jpeg'),
(80, 24, 'Standar Room', 0, '89a3a0cc2c78b280e3590054be7911bd.jpeg'),
(81, 24, 'Bunkbed', 0, '6fdbf1d7d457e0482eb2ab6088d93474.jpeg'),
(82, 24, 'BunkBed', 0, '12ca06e0600273807c1f399595c7b6e5.jpeg'),
(83, 27, 'Bangunan1', 0, '0898df85f3264b7a2866cd8e2d6e1389.jpg'),
(84, 27, 'Bangunan2', 0, '8f717d59f6307089777e6880bb693b44.jpeg'),
(85, 27, 'Bangunan3', 0, '4b843827cf38245e4d0478cc37746fe9.jpg'),
(86, 32, 'lobby1', 0, '9e1fe9a67941ebcaa20becb64979b586.jpeg'),
(87, 32, 'Lobby 2', 0, 'b71e13fa98db99d1c89bcde9add4a015.jpg'),
(88, 34, 'Restoran', 0, '25fbc26eb93d48cb1d57fab8737d23c2.jpg'),
(89, 34, 'Ruang Rapat', 0, 'fed0984198ace502bec0dc3bea59006b.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `harga`
--

CREATE TABLE `harga` (
  `id_harga` int(10) NOT NULL,
  `id_tipe_kamar` int(10) NOT NULL,
  `mon` decimal(10,2) NOT NULL,
  `tue` decimal(10,2) NOT NULL,
  `wed` decimal(10,2) NOT NULL,
  `thu` decimal(10,2) NOT NULL,
  `fri` decimal(10,2) NOT NULL,
  `sat` decimal(10,2) NOT NULL,
  `sun` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `harga`
--

INSERT INTO `harga` (`id_harga`, `id_tipe_kamar`, `mon`, `tue`, `wed`, `thu`, `fri`, `sat`, `sun`) VALUES
(6, 1, '350000.00', '350000.00', '350000.00', '350000.00', '350000.00', '350000.00', '300000.00'),
(7, 3, '300000.00', '300000.00', '300000.00', '300000.00', '300000.00', '300000.00', '300000.00'),
(8, 4, '350000.00', '350000.00', '350000.00', '350000.00', '350000.00', '350000.00', '350000.00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `harga_spesial`
--

CREATE TABLE `harga_spesial` (
  `id_harga_spesial` int(11) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `id_tipe_kamar` int(10) NOT NULL,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `mon` decimal(10,2) NOT NULL,
  `tue` decimal(10,2) NOT NULL,
  `wed` decimal(10,2) NOT NULL,
  `thu` decimal(10,2) NOT NULL,
  `fri` decimal(10,2) NOT NULL,
  `sat` decimal(10,2) NOT NULL,
  `sun` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `harga_spesial`
--

INSERT INTO `harga_spesial` (`id_harga_spesial`, `judul`, `id_tipe_kamar`, `date_from`, `date_to`, `mon`, `tue`, `wed`, `thu`, `fri`, `sat`, `sun`) VALUES
(10, 'coba', 1, '2021-02-07', '2021-02-13', '150000.00', '150000.00', '150000.00', '150000.00', '150000.00', '150000.00', '150000.00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kamar`
--

CREATE TABLE `kamar` (
  `id_kamar` int(11) NOT NULL,
  `id_lantai` int(10) NOT NULL,
  `no_kamar` varchar(255) NOT NULL,
  `id_tipe_kamar` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kamar`
--

INSERT INTO `kamar` (`id_kamar`, `id_lantai`, `no_kamar`, `id_tipe_kamar`, `status`) VALUES
(10, 1, '1', 4, 1),
(11, 1, '2', 4, 1),
(12, 1, '3', 4, 1),
(18, 1, '4', 4, 1),
(19, 1, '5', 4, 1),
(20, 2, '6', 3, 1),
(21, 2, '7', 3, 1),
(22, 2, '8', 3, 1),
(23, 2, '9', 3, 1),
(24, 2, '10', 3, 1),
(25, 2, '11', 1, 1),
(26, 2, '12', 1, 1),
(27, 2, '13', 1, 1),
(28, 2, '14', 1, 1),
(29, 2, '15', 1, 1),
(30, 1, '16', 1, 1),
(31, 1, '17', 1, 1),
(32, 2, '18', 1, 1),
(33, 1, '124', 1, 1),
(34, 1, '20', 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `lantai`
--

CREATE TABLE `lantai` (
  `id_lantai` int(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_lantai` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `lantai`
--

INSERT INTO `lantai` (`id_lantai`, `nama`, `no_lantai`, `deskripsi`, `status`) VALUES
(1, 'Lantai 1', '1', '   lantai 1', '1'),
(2, 'Lantai 2', '2', ' lantai 2', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `layanan`
--

CREATE TABLE `layanan` (
  `id_layanan` int(10) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `short_deskripsi` text NOT NULL,
  `tipe_biaya` int(11) NOT NULL,
  `biaya` decimal(10,2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `layanan`
--

INSERT INTO `layanan` (`id_layanan`, `judul`, `deskripsi`, `short_deskripsi`, `tipe_biaya`, `biaya`, `status`) VALUES
(3, 'Sarapan Pagi', '<p>makan</p>', '', 1, '20000.00', 1),
(5, 'Makan Malam', '<p>makan malam</p>', '', 1, '30000.00', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mail_template`
--

CREATE TABLE `mail_template` (
  `id_tempmail` int(10) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `mail_templates`
--

CREATE TABLE `mail_templates` (
  `id_tempmail` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mail_templates`
--

INSERT INTO `mail_templates` (`id_tempmail`, `name`, `subject`, `content`) VALUES
(1, 'Registration Confirmation', 'Thank you for registring at {site_name}', '<p>Dear {customer_name},</p><p>Thanks for registering at {site_name}. Your participation is appreciated. After registering, you should have been logged in automatically. You may access your account by using the email address this notice was sent to, and the password you signed up with. If you forget your password, on the login page, click the \"forgot password\" link and you can genrate a new password.</p><p>Thanks,</p><p>{site_name}</p>'),
(2, 'Booking  Order Confirmation', 'Thank you for your order with {site_name}', '<p>Dear {customer_name},</p><p>Thank you for your order with {site_name}!</p><p>{order_summary}</p>'),
(3, 'Room Number Confrm Notification', 'Your Booking  has assigned a room number booking number  : {booking_number} at  {site_name}', '<p>Dear {customer_name},</p><p>This message is to inform you that your booking {booking_number} has been assigned a room number.</p><p>{room_details}</p><p>Thank You</p><p>{site_name}</p>'),
(4, 'Forgot Password Message', '{site_name} Your Password Reset Link', '<p>Dear {customer_name},</p><p>You Are Requested For Reset Password at {site_name}. Your Password Reset Link Is Attached With This Email,If You Do Not Want To Change Password Then Ignore This Email.</p><p>{password_reset_link}</p><p>Thanks,<br>{site_name}</p>'),
(5, 'Booking  Order Cancelation', 'Your booking with {site_name} is canceled', '<p>Dear {customer_name},</p><p>Your booking is canceled with {site_name}!</p><p>{order_summary}</p>');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL,
  `no_order` varchar(255) NOT NULL,
  `id_tamu` int(11) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `malam` tinyint(4) NOT NULL DEFAULT 0,
  `dewasa` tinyint(4) UNSIGNED NOT NULL,
  `jml_kamar` int(11) NOT NULL,
  `id_tipe_kamar` int(10) NOT NULL,
  `tgl_order` datetime NOT NULL,
  `status_kode` int(4) NOT NULL,
  `tarif_dasar` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `jumlah_layanan` decimal(10,2) DEFAULT NULL,
  `total_jumlah` decimal(10,2) NOT NULL,
  `voucher` varchar(255) DEFAULT NULL,
  `voucher_diskon` decimal(10,2) DEFAULT NULL,
  `total_sudah_voucher` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id_order`, `no_order`, `id_tamu`, `check_in`, `check_out`, `malam`, `dewasa`, `jml_kamar`, `id_tipe_kamar`, `tgl_order`, `status_kode`, `tarif_dasar`, `total`, `jumlah_layanan`, `total_jumlah`, `voucher`, `voucher_diskon`, `total_sudah_voucher`) VALUES
(1, 'OR16127769726', 6, '2021-02-08', '2021-02-09', 1, 2, 2, 1, '2021-02-08 16:37:40', 200, '200000.00', '300000.00', '60000.00', '360000.00', NULL, NULL, NULL),
(2, 'OR16127815148', 8, '2021-02-08', '2021-02-10', 2, 1, 1, 3, '2021-02-08 17:51:58', 202, '250000.00', '600000.00', NULL, '600000.00', NULL, NULL, NULL),
(3, 'OR16128066599', 9, '2021-02-09', '2021-02-10', 1, 2, 2, 1, '2021-02-09 00:51:04', 200, '200000.00', '300000.00', '60000.00', '360000.00', NULL, NULL, NULL),
(4, 'OR161280794210', 10, '2021-02-09', '2021-02-11', 2, 1, 3, 3, '2021-02-09 01:12:24', 200, '250000.00', '1800000.00', NULL, '1800000.00', NULL, NULL, NULL),
(5, 'OR161280808011', 11, '2021-02-11', '2021-02-11', 1, 1, 1, 4, '2021-02-09 01:14:42', 200, '200000.00', '350000.00', NULL, '350000.00', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders_rel_harga`
--

CREATE TABLE `orders_rel_harga` (
  `id_order_rel_harga` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `kode_reservasi` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `id_kamar` int(10) NOT NULL,
  `status_reservasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `orders_rel_harga`
--

INSERT INTO `orders_rel_harga` (`id_order_rel_harga`, `id_order`, `kode_reservasi`, `tanggal`, `harga`, `id_kamar`, `status_reservasi`) VALUES
(1, 1, 'R16127770606S0', '2021-02-08', '150000.00', 25, 3),
(2, 1, 'R16127770606S1', '2021-02-08', '150000.00', 26, 3),
(3, 2, 'R16127815188S0', '2021-02-08', '300000.00', 0, 1),
(4, 2, 'R16127815188S0', '2021-02-09', '300000.00', 0, 1),
(5, 3, 'R16128066649S0', '2021-02-09', '150000.00', 25, 3),
(6, 3, 'R16128066649S1', '2021-02-09', '150000.00', 26, 3),
(7, 4, 'R161280794410S0', '2021-02-09', '300000.00', 0, 1),
(8, 4, 'R161280794410S0', '2021-02-10', '300000.00', 0, 1),
(9, 4, 'R161280794410S1', '2021-02-09', '300000.00', 0, 1),
(10, 4, 'R161280794410S1', '2021-02-10', '300000.00', 0, 1),
(11, 4, 'R161280794510S2', '2021-02-09', '300000.00', 0, 1),
(12, 4, 'R161280794510S2', '2021-02-10', '300000.00', 0, 1),
(13, 5, 'R161280808211S0', '2021-02-11', '350000.00', 0, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders_rel_layanan`
--

CREATE TABLE `orders_rel_layanan` (
  `id_order_layanan` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_layanan` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `orders_rel_layanan`
--

INSERT INTO `orders_rel_layanan` (`id_order_layanan`, `id_order`, `id_layanan`, `total`) VALUES
(1, 1, 5, '60000.00'),
(2, 3, 5, '60000.00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `no_order` varchar(50) NOT NULL,
  `waktu` datetime DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  `metode_pembayaran` varchar(255) DEFAULT NULL,
  `bank` varchar(50) NOT NULL,
  `nomor_va` varchar(100) NOT NULL,
  `pdf_url` varchar(255) NOT NULL,
  `status_kode` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_order`, `no_order`, `waktu`, `total`, `metode_pembayaran`, `bank`, `nomor_va`, `pdf_url`, `status_kode`) VALUES
(1, 1, 'OR16127769726', '2021-02-08 16:44:21', '360000.00', 'bank_transfer', 'bri', '627585269385767383', 'x', '200'),
(2, 2, 'OR16127815148', '2021-02-08 17:53:03', '600000.00', 'bank_transfer', 'bri', '627585571896899396', 'x', '202'),
(3, 3, 'OR16128066599', '2021-02-09 00:51:20', '360000.00', 'bank_transfer', 'bni', '9886275819573607', 'x', '200'),
(4, 4, 'OR161280794210', '2021-02-09 01:12:42', '1800000.00', 'bank_transfer', 'bri', '627589213465378019', 'x', '200'),
(5, 5, 'OR161280808011', '2021-02-09 01:14:59', '350000.00', 'bank_transfer', 'bri', '627584666880779153', 'x', '200');

-- --------------------------------------------------------

--
-- Struktur dari tabel `settings`
--

CREATE TABLE `settings` (
  `id_setting` int(10) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `map` text NOT NULL,
  `logo` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_telepon` varchar(255) NOT NULL,
  `fax` varchar(255) NOT NULL,
  `format_tanggal` varchar(255) NOT NULL,
  `minimum_booking` int(11) DEFAULT NULL,
  `pembayaran_dp` decimal(10,2) DEFAULT NULL,
  `waktu_check_in` time NOT NULL,
  `waktu_check_out` time NOT NULL,
  `format_waktu` tinyint(1) NOT NULL DEFAULT 0,
  `payment_gateway` text NOT NULL,
  `smtp_mail` varchar(255) NOT NULL,
  `smtp_host` varchar(255) NOT NULL,
  `smtp_user` varchar(255) NOT NULL,
  `smtp_pass` varchar(255) NOT NULL,
  `smtp_port` varchar(8) NOT NULL,
  `invoice` int(11) DEFAULT NULL,
  `midtrans` tinyint(1) DEFAULT NULL,
  `client_key` varchar(255) DEFAULT NULL,
  `marchant_id` varchar(255) DEFAULT NULL,
  `server_key` varchar(255) DEFAULT NULL,
  `durasi_bayar` int(3) NOT NULL,
  `facebook_link` text DEFAULT NULL,
  `instagram_link` text NOT NULL,
  `twitter_link` text DEFAULT NULL,
  `google_plus_link` text DEFAULT NULL,
  `linkedin_link` text DEFAULT NULL,
  `section_judul` varchar(255) DEFAULT 'NULL',
  `section_deskripsi` text DEFAULT '\'NULL\'',
  `sort_section_deskripsi` text NOT NULL,
  `meta_keywords` text DEFAULT 'NULL',
  `meta_description` text DEFAULT 'NULL',
  `image` varchar(255) NOT NULL,
  `footer_text` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `settings`
--

INSERT INTO `settings` (`id_setting`, `nama`, `map`, `logo`, `alamat`, `email`, `no_telepon`, `fax`, `format_tanggal`, `minimum_booking`, `pembayaran_dp`, `waktu_check_in`, `waktu_check_out`, `format_waktu`, `payment_gateway`, `smtp_mail`, `smtp_host`, `smtp_user`, `smtp_pass`, `smtp_port`, `invoice`, `midtrans`, `client_key`, `marchant_id`, `server_key`, `durasi_bayar`, `facebook_link`, `instagram_link`, `twitter_link`, `google_plus_link`, `linkedin_link`, `section_judul`, `section_deskripsi`, `sort_section_deskripsi`, `meta_keywords`, `meta_description`, `image`, `footer_text`) VALUES
(1, 'Hotel Al Ashri Inn By Urban', ' <iframe src=\"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15810.794727393262!2d110.35384001429445!3d-7.821683223410568!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a57bf6f96898d%3A0xb39a68de765c8c6b!2sAl%20Ashri%20Inn%20By%20Urban!5e0!3m2!1sid!2sid!4v1604471065864!5m2!1sid!2sid\" width=\"100%\" height=\"450\" frameborder=\"0\" style=\"border:0;\" allowfullscreen=\"\" aria-hidden=\"false\" tabindex=\"0\"></iframe>', '1611049836955.png', 'Jl. DI Panjaitan No.104, Mantrijeron, Kec. Mantrijeron, Kota Yogyakarta, DIY', 'hotelalashri@gmail.com', '+9198765-43210', '-', '', NULL, NULL, '14:00:00', '12:00:00', 2, '', 'mckckck8@gmail.com', 'ssl://smtp.gmail.com', 'mckckck8@gmail.com', '*#sarmi12345Hd', '465', 100, NULL, 'SB-Mid-client-SoGL3Mr5A-z9s1RS', 'G946862758', 'SB-Mid-server-9DQ4NPgJMAZrccDy0YwfsUbt', 10, 'https://www.facebook.com/', 'https://www.Instagram.com/', 'https://www.twitter.com/', 'https://www.plus.google.com/', 'https://www.linkedin.com/', 'Al Ashri Inn By Urban Hotel', '<p>Hotel Al Ashri Inn by Urban merupakan akomodasi bintang 2 di Mantrijeron yang terletak sejauh 2,2 km dari Museum Perjuangan. Hotel ini menyediakan ruangan rapat yang dapat digunakan untuk mengakomodir acara formal dan area parkir pribadi gratis untuk tamu yang membawa kendaraan. WiFi gratis tersedia di seluruh area.</p><p>Hotel Al Ashri Inn by Urban memiliki desain yang fungsional, beberapa kamar dilengkapi dengan tempat tidur bertingkat. AC, TV layar datar dan meja samping tempat tidur tersedia di seluruh kamar. Air mineral gratis juga sudah termasuk. Kamar mandi pribadinya menyediakan handuk, toilet, fasilitas shower dan peralatan mandi gratis.</p><p>Check-in atau check-out ekspres dapat dilakukan untuk pengalaman menginap yang lebih mudah. Staf hotel dapat membantumu selama 24 jam jika kamu memerlukan layanan laundry atau layanan antar-jemput bandara.</p>', '<p>Hotel Al Ashri Inn by Urban merupakan akomodasi bintang 2 di Mantrijeron yang terletak sejauh 2,2 km dari Museum Perjuangan. Hotel ini menyediakan ruangan rapat yang dapat digunakan untuk mengakomodir acara formal dan area parkir pribadi gratis untuk tamu yang membawa kendaraan. WiFi gratis tersedia di seluruh area.</p>', 'al ashri in by urban hotel yogyakarta', 'al ashri in by urban hotel yogyakarta', '1608041296771.jpg', 'Hotel Al Ashri Inn By Urban');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tamu`
--

CREATE TABLE `tamu` (
  `id_tamu` int(11) NOT NULL,
  `nama_depan` varchar(255) NOT NULL,
  `nama_belakang` varchar(255) NOT NULL,
  `jenis_kelamin` enum('0','1') NOT NULL,
  `tempat_lahir` varchar(150) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_telepon` varchar(32) NOT NULL,
  `password` varchar(40) NOT NULL,
  `alamat` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `dibuat` datetime DEFAULT NULL,
  `diubah` datetime NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `token` text DEFAULT NULL,
  `create_token` int(11) NOT NULL,
  `last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tamu`
--

INSERT INTO `tamu` (`id_tamu`, `nama_depan`, `nama_belakang`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `email`, `no_telepon`, `password`, `alamat`, `image`, `dibuat`, `diubah`, `status`, `token`, `create_token`, `last_login`) VALUES
(6, 'Hafiz', 'Darmawan', '1', 'pacitan', '2021-01-09', 'hafizzdarmawann@gmail.com', '087758373050', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', 'pacitan', '1612947918201.jpg', '2020-12-30 08:27:49', '2021-01-09 04:51:00', '1', '16129026785d525782d7e9ea0c2531d28595b63bd6d9dfb2eb', 1612902678, '2021-02-11 01:53:00'),
(8, 'Muklis', 'Adi Saputro', '0', '', '0000-00-00', 'hafizdarmawan53@gmail.com', '087758273718', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', '', '', '2020-12-30 08:45:36', '2021-01-25 19:36:30', '1', '16092927369045d8439eea23d2589e6384b7629387e9178dde', 1609292736, '2021-02-10 17:06:27'),
(9, 'kusno', 'kusno', '0', '', '0000-00-00', 'danyprianta5@gmail.com', '1234567890', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', '', '', '2021-01-10 18:10:19', '0000-00-00 00:00:00', '1', '1610277019f5d542e0f7c2e0ebd0d81663ba91e71270042a07', 1610277019, '2021-02-09 00:50:24'),
(10, 'Muhammed', 'Salah', '0', '', '0000-00-00', 'mckckck8@gmail.com', '128900987654', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', '', '1612951495945.jpg', '2021-01-23 10:47:02', '2021-01-25 20:18:58', '1', '16113736220794e7df591524d3340b1c8c049cc5ddec3f3757', 1611373622, '2021-02-10 17:04:14'),
(11, 'boby', 'satria', '0', '', '0000-00-00', 'bobysatria@gmail.com', '085562452123', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', '', '', '2021-01-23 13:24:35', '0000-00-00 00:00:00', '1', '161138307558ce2f0959e4703ae3952bb13b5c6b460ea3396b', 1611383075, '2021-02-09 01:13:58'),
(12, 'Muhammad', 'Iskandar', '0', '', '0000-00-00', 'iskandar123@gmail.com', '0892890342345', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', '', '', '2021-01-23 13:25:37', '0000-00-00 00:00:00', '1', '1611383137253cd19cd731849a8719372b4a37b60b20e7bacf', 1611383137, '0000-00-00 00:00:00'),
(13, 'Muhammad', 'Ali Sodikin', '0', '', '0000-00-00', 'alishodikin@gmail.com', '085234123456', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', '', '', '2021-01-23 13:27:04', '0000-00-00 00:00:00', '1', '1611383224b2df20019195c0dc83788005c454763b7951c4e7', 1611383224, '0000-00-00 00:00:00'),
(14, 'Umi', 'Mandala Ayu', '0', '', '0000-00-00', 'umimandalaayu@gmail.com', '087758234567', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', '', '', '2021-01-23 13:28:14', '0000-00-00 00:00:00', '1', '16113832946518b645f497144fd2f39e63e033b46b0d5ea764', 1611383294, '0000-00-00 00:00:00'),
(15, 'Muhammad', 'Thoha', '0', '', '0000-00-00', 'muhammadthoha0105@gmail.com', '08786546780', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', '', '', '2021-01-24 17:59:52', '0000-00-00 00:00:00', '1', '1611485992937950c04d3bea1768cc356d3731c7576ad7a5f1', 1611485992, '0000-00-00 00:00:00'),
(16, 'Ria', 'Febrianan', '0', '', '0000-00-00', 'riafebriana@gmail.com', '087758373405', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', '', '', '2021-01-26 19:25:21', '0000-00-00 00:00:00', '1', '161166392110f133e6dae51d71a280e0bdc871eb099921d272', 1611663921, '0000-00-00 00:00:00'),
(17, 'Ria', 'Febriana', '0', '', '0000-00-00', 'riafebri125@gmail.com', '085834201201', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', '', '', '2021-02-09 23:26:42', '0000-00-00 00:00:00', '0', '161288804913b9dfaa15518e17acc866ef3e806471c13bd8bc', 1612888049, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tipe_kamar`
--

CREATE TABLE `tipe_kamar` (
  `id_tipe_kamar` int(10) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `slug` varchar(556) NOT NULL,
  `shortcode` varchar(32) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `higher_occupancy` varchar(255) NOT NULL,
  `tarif_dasar` decimal(10,2) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tipe_kamar`
--

INSERT INTO `tipe_kamar` (`id_tipe_kamar`, `judul`, `slug`, `shortcode`, `deskripsi`, `higher_occupancy`, `tarif_dasar`, `status`) VALUES
(1, 'Superior Room', 'Superior-Room', 'Superior Room', '<p>Kamar Superior dengan luas 24sqm salah satu pilihan tipe kamar yang nyaman.</p>', '2', '200000.00', 1),
(3, 'Standart Room', 'Standart-Room', 'Standart Room', '<p>Kamar Standar dengan luas 24sqm salah satu pilihan tipe kamar yang nyaman.</p>', '2', '250000.00', 1),
(4, 'Bunkbed Room', 'Bunkbed-Room', 'Bunkbed Room', '<p>Kamar Bunkbed dengan luas 24sqm salah satu pilihan tipe kamar yang nyaman.</p>', '4', '200000.00', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tipe_kamar_gambar`
--

CREATE TABLE `tipe_kamar_gambar` (
  `id_tipe_gambar` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `di_tampilkan` tinyint(1) NOT NULL DEFAULT 0,
  `id_tipe_kamar` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tipe_kamar_gambar`
--

INSERT INTO `tipe_kamar_gambar` (`id_tipe_gambar`, `image`, `di_tampilkan`, `id_tipe_kamar`) VALUES
(3, '1611782399840.jpeg', 0, 1),
(4, '1611782426665.jpeg', 0, 1),
(5, '161178242671.jpeg', 0, 1),
(7, '1611782504618.jpeg', 0, 3),
(8, '1611784474736.jpeg', 0, 4),
(9, '1611784474106.jpeg', 0, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tipe_rel_fasilitas`
--

CREATE TABLE `tipe_rel_fasilitas` (
  `id_tipe_fasilitas` int(11) NOT NULL,
  `id_tipe_kamar` int(10) NOT NULL,
  `id_fasilitas` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tipe_rel_fasilitas`
--

INSERT INTO `tipe_rel_fasilitas` (`id_tipe_fasilitas`, `id_tipe_kamar`, `id_fasilitas`) VALUES
(44, 3, 1),
(45, 3, 3),
(51, 1, 1),
(52, 4, 1),
(53, 4, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tipe_rel_layanan`
--

CREATE TABLE `tipe_rel_layanan` (
  `id_tipe_layanan` int(11) NOT NULL,
  `id_tipe_kamar` int(10) NOT NULL,
  `id_layanan` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tipe_rel_layanan`
--

INSERT INTO `tipe_rel_layanan` (`id_tipe_layanan`, `id_tipe_kamar`, `id_layanan`) VALUES
(16, 1, 5),
(17, 3, 5),
(18, 4, 5),
(19, 3, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama_depan` varchar(255) NOT NULL,
  `nama_belakang` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `no_telepon` varchar(32) NOT NULL,
  `jenis_kelamin` enum('0','1') NOT NULL,
  `tempat_lahir` varchar(32) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `level_users` enum('1','2') NOT NULL,
  `status_users` enum('0','1') NOT NULL,
  `foto` varchar(255) NOT NULL,
  `tgl_dibuat` timestamp NULL DEFAULT current_timestamp(),
  `tgl_diubah` datetime NOT NULL,
  `token` text NOT NULL,
  `create_token` int(11) NOT NULL,
  `last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `nama_depan`, `nama_belakang`, `username`, `email`, `password`, `no_telepon`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `level_users`, `status_users`, `foto`, `tgl_dibuat`, `tgl_diubah`, `token`, `create_token`, `last_login`) VALUES
(1, 'Hafiz', 'Darmawan', 'admin', 'admin@admin.com', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', '9829829292', '1', 'Pacitan', '1986-12-28', 'Pacitan', '1', '1', '2aed3b987f1f3021f0a29219e05f8793.png', '2016-09-27 17:00:00', '2021-01-28 03:53:37', '160653539301c0797fe99c48d3908be71d96c6f28085d13a8a', 1606535393, '2021-02-10 22:05:42'),
(2, 'Hafiz', 'Darma', 'hafizd', 'hafizzdarmawann@gmail.com', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', '+6282136352876', '1', 'Pacitan', '2020-11-25', 'wwwww', '2', '1', '4ca1b9e3c66b3dafb93e31e2318cd418.jpg', '2020-11-25 17:00:00', '2021-02-07 01:13:55', '1611490679af8b5a4422bc9b8f10a25547febf9272b930226f', 1611490679, '2021-02-07 02:32:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `voucher`
--

CREATE TABLE `voucher` (
  `id_voucher` int(10) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `kode` varchar(255) NOT NULL,
  `tipe` enum('Persen','Tetap','','') NOT NULL,
  `nilai` varchar(255) NOT NULL,
  `date_from` datetime NOT NULL,
  `date_to` datetime NOT NULL,
  `min_total` decimal(10,2) NOT NULL,
  `max_total` decimal(10,2) NOT NULL,
  `include_tamu` text NOT NULL,
  `exclude_tamu` text NOT NULL,
  `include_tipe_kamar` text NOT NULL,
  `exclude_tipe_kamar` text NOT NULL,
  `limit_per_tamu` int(11) DEFAULT NULL,
  `limit_per_voucher` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `voucher`
--

INSERT INTO `voucher` (`id_voucher`, `judul`, `deskripsi`, `gambar`, `kode`, `tipe`, `nilai`, `date_from`, `date_to`, `min_total`, `max_total`, `include_tamu`, `exclude_tamu`, `include_tipe_kamar`, `exclude_tipe_kamar`, `limit_per_tamu`, `limit_per_voucher`) VALUES
(16, 'Coba Voucher', '<p>coba_voucher</p>', 'cf4f9ef4bdcfa5b91eb87f1c70ee7857.jpg', 'coba', 'Tetap', '100000', '2021-02-05 00:00:00', '2021-02-07 00:00:00', '0.00', '0.00', 'null', 'null', '[\"1\",\"3\",\"4\"]', 'null', 2, 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id_banner`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id_fasilitas`);

--
-- Indeks untuk tabel `galleri`
--
ALTER TABLE `galleri`
  ADD PRIMARY KEY (`id_galleri`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `galleri_rel_gambar`
--
ALTER TABLE `galleri_rel_gambar`
  ADD PRIMARY KEY (`id_rel_galleri`),
  ADD KEY `id_gallery` (`id_galleri`);

--
-- Indeks untuk tabel `harga`
--
ALTER TABLE `harga`
  ADD PRIMARY KEY (`id_harga`),
  ADD KEY `id_tipe_kamar` (`id_tipe_kamar`);

--
-- Indeks untuk tabel `harga_spesial`
--
ALTER TABLE `harga_spesial`
  ADD PRIMARY KEY (`id_harga_spesial`),
  ADD KEY `id_tipe_kamar` (`id_tipe_kamar`);

--
-- Indeks untuk tabel `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id_kamar`),
  ADD KEY `id_lantai` (`id_lantai`,`id_tipe_kamar`),
  ADD KEY `id_tipe_kamar` (`id_tipe_kamar`);

--
-- Indeks untuk tabel `lantai`
--
ALTER TABLE `lantai`
  ADD PRIMARY KEY (`id_lantai`);

--
-- Indeks untuk tabel `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id_layanan`);

--
-- Indeks untuk tabel `mail_template`
--
ALTER TABLE `mail_template`
  ADD PRIMARY KEY (`id_tempmail`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `mail_templates`
--
ALTER TABLE `mail_templates`
  ADD PRIMARY KEY (`id_tempmail`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `orders_ibfk_1` (`id_tamu`),
  ADD KEY `id_tipe_kamar` (`id_tipe_kamar`);

--
-- Indeks untuk tabel `orders_rel_harga`
--
ALTER TABLE `orders_rel_harga`
  ADD PRIMARY KEY (`id_order_rel_harga`),
  ADD KEY `order_id` (`id_order`),
  ADD KEY `id_kamar` (`id_kamar`);

--
-- Indeks untuk tabel `orders_rel_layanan`
--
ALTER TABLE `orders_rel_layanan`
  ADD PRIMARY KEY (`id_order_layanan`),
  ADD KEY `id_order` (`id_order`),
  ADD KEY `id_layanan` (`id_layanan`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `pembayaran_ibfk_1` (`id_order`);

--
-- Indeks untuk tabel `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indeks untuk tabel `tamu`
--
ALTER TABLE `tamu`
  ADD PRIMARY KEY (`id_tamu`);

--
-- Indeks untuk tabel `tipe_kamar`
--
ALTER TABLE `tipe_kamar`
  ADD PRIMARY KEY (`id_tipe_kamar`);

--
-- Indeks untuk tabel `tipe_kamar_gambar`
--
ALTER TABLE `tipe_kamar_gambar`
  ADD PRIMARY KEY (`id_tipe_gambar`),
  ADD KEY `id_tipe_kamar` (`id_tipe_kamar`);

--
-- Indeks untuk tabel `tipe_rel_fasilitas`
--
ALTER TABLE `tipe_rel_fasilitas`
  ADD PRIMARY KEY (`id_tipe_fasilitas`),
  ADD KEY `id_tipe_kamar` (`id_tipe_kamar`),
  ADD KEY `id_amenities` (`id_fasilitas`),
  ADD KEY `id_tipe_kamar_2` (`id_tipe_kamar`);

--
-- Indeks untuk tabel `tipe_rel_layanan`
--
ALTER TABLE `tipe_rel_layanan`
  ADD PRIMARY KEY (`id_tipe_layanan`),
  ADD KEY `id_tipe_kamar` (`id_tipe_kamar`),
  ADD KEY `id_service` (`id_layanan`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`id_voucher`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `banner`
--
ALTER TABLE `banner`
  MODIFY `id_banner` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id_fasilitas` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `galleri`
--
ALTER TABLE `galleri`
  MODIFY `id_galleri` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `galleri_rel_gambar`
--
ALTER TABLE `galleri_rel_gambar`
  MODIFY `id_rel_galleri` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT untuk tabel `harga`
--
ALTER TABLE `harga`
  MODIFY `id_harga` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `harga_spesial`
--
ALTER TABLE `harga_spesial`
  MODIFY `id_harga_spesial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `kamar`
--
ALTER TABLE `kamar`
  MODIFY `id_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `lantai`
--
ALTER TABLE `lantai`
  MODIFY `id_lantai` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `layanan`
--
ALTER TABLE `layanan`
  MODIFY `id_layanan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `mail_template`
--
ALTER TABLE `mail_template`
  MODIFY `id_tempmail` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `mail_templates`
--
ALTER TABLE `mail_templates`
  MODIFY `id_tempmail` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `orders_rel_harga`
--
ALTER TABLE `orders_rel_harga`
  MODIFY `id_order_rel_harga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `orders_rel_layanan`
--
ALTER TABLE `orders_rel_layanan`
  MODIFY `id_order_layanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `settings`
--
ALTER TABLE `settings`
  MODIFY `id_setting` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tamu`
--
ALTER TABLE `tamu`
  MODIFY `id_tamu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `tipe_kamar`
--
ALTER TABLE `tipe_kamar`
  MODIFY `id_tipe_kamar` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tipe_kamar_gambar`
--
ALTER TABLE `tipe_kamar_gambar`
  MODIFY `id_tipe_gambar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tipe_rel_fasilitas`
--
ALTER TABLE `tipe_rel_fasilitas`
  MODIFY `id_tipe_fasilitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT untuk tabel `tipe_rel_layanan`
--
ALTER TABLE `tipe_rel_layanan`
  MODIFY `id_tipe_layanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `voucher`
--
ALTER TABLE `voucher`
  MODIFY `id_voucher` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `harga`
--
ALTER TABLE `harga`
  ADD CONSTRAINT `FK_harga_rel_tipekamar` FOREIGN KEY (`id_tipe_kamar`) REFERENCES `tipe_kamar` (`id_tipe_kamar`);

--
-- Ketidakleluasaan untuk tabel `harga_spesial`
--
ALTER TABLE `harga_spesial`
  ADD CONSTRAINT `FK_harga_spesial_rel_tipekamar` FOREIGN KEY (`id_tipe_kamar`) REFERENCES `tipe_kamar` (`id_tipe_kamar`);

--
-- Ketidakleluasaan untuk tabel `kamar`
--
ALTER TABLE `kamar`
  ADD CONSTRAINT `FK_kamar_rel_lantai` FOREIGN KEY (`id_lantai`) REFERENCES `lantai` (`id_lantai`),
  ADD CONSTRAINT `FK_kamar_rel_tipekamar` FOREIGN KEY (`id_tipe_kamar`) REFERENCES `tipe_kamar` (`id_tipe_kamar`);

--
-- Ketidakleluasaan untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`id_tamu`) REFERENCES `tamu` (`id_tamu`) ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`id_tipe_kamar`) REFERENCES `tipe_kamar` (`id_tipe_kamar`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `orders_rel_harga`
--
ALTER TABLE `orders_rel_harga`
  ADD CONSTRAINT `orders_rel_harga_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id_order`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `orders_rel_layanan`
--
ALTER TABLE `orders_rel_layanan`
  ADD CONSTRAINT `orders_rel_layanan_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id_order`) ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_rel_layanan_ibfk_2` FOREIGN KEY (`id_layanan`) REFERENCES `layanan` (`id_layanan`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id_order`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tipe_kamar_gambar`
--
ALTER TABLE `tipe_kamar_gambar`
  ADD CONSTRAINT `FK_tipe_kamar_gambar` FOREIGN KEY (`id_tipe_kamar`) REFERENCES `tipe_kamar` (`id_tipe_kamar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tipe_rel_fasilitas`
--
ALTER TABLE `tipe_rel_fasilitas`
  ADD CONSTRAINT `FK_tipe_rel_fasilitas` FOREIGN KEY (`id_fasilitas`) REFERENCES `fasilitas` (`id_fasilitas`),
  ADD CONSTRAINT `FK_tipe_rel_fasilitas_tipe_kamar` FOREIGN KEY (`id_tipe_kamar`) REFERENCES `tipe_kamar` (`id_tipe_kamar`);

--
-- Ketidakleluasaan untuk tabel `tipe_rel_layanan`
--
ALTER TABLE `tipe_rel_layanan`
  ADD CONSTRAINT `FK_tipe_rel_layanan` FOREIGN KEY (`id_layanan`) REFERENCES `layanan` (`id_layanan`),
  ADD CONSTRAINT `FK_tipe_rel_layanan_rel_tipekamar` FOREIGN KEY (`id_tipe_kamar`) REFERENCES `tipe_kamar` (`id_tipe_kamar`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
