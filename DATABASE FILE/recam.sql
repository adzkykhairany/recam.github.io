-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Des 2022 pada 16.27
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recam`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `aduan`
--

CREATE TABLE `aduan` (
  `id` int(11) NOT NULL,
  `customer_username` varchar(35) NOT NULL,
  `camera_name` varchar(50) NOT NULL,
  `number` varchar(12) NOT NULL,
  `aduan` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `aduan`
--

INSERT INTO `aduan` (`id`, `customer_username`, `camera_name`, `number`, `aduan`) VALUES
(1, 'lucas', 'FUJIFILM X-T10 18-55mm', '1', 'rusak'),
(2, 'yeri', 'Canon', '2', 'lensa pecah'),
(3, 'lucas', 'FUJIFILM X-T10 18-55mm', '1', 'mahal');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cameras`
--

CREATE TABLE `cameras` (
  `camera_id` int(20) NOT NULL,
  `camera_name` varchar(50) NOT NULL,
  `camera_img` varchar(50) DEFAULT 'NA',
  `lensa_price` float NOT NULL,
  `tl_price` float NOT NULL,
  `tl_price_per_day` float NOT NULL,
  `lensa_price_per_day` float NOT NULL,
  `tipe_camera` enum('DSLR','Mirrorless','Poket','Action cam') NOT NULL,
  `camera_availability` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `cameras`
--

INSERT INTO `cameras` (`camera_id`, `camera_name`, `camera_img`, `lensa_price`, `tl_price`, `tl_price_per_day`, `lensa_price_per_day`, `tipe_camera`, `camera_availability`) VALUES
(1, 'CANON EOS 700D 18-55mm', 'assets/img/cameras/canon-700d.png', 0, 0, 100000, 130000, 'DSLR', 'yes'),
(2, 'NIKON D850 24-120mm', 'assets/img/cameras/nikon-d850.jpeg', 0, 0, 500000, 750000, 'DSLR', 'yes'),
(15, 'SONY A6000 Kit 16-50mm ', 'assets/img/cameras/sony-a6000.jpeg', 0, 0, 90000, 150000, 'Mirrorless', 'no'),
(16, 'SONY A7III 28-70mm', 'assets/img/cameras/sony-a7iii.webp', 0, 0, 450000, 600000, 'Mirrorless', 'no'),
(17, 'CANON G9X', 'assets/img/cameras/canon-g9x.jpeg', 0, 0, 0, 100000, 'Poket', 'yes'),
(18, 'FUJIFILM X-T10 18-55mm', 'assets/img/cameras/ff-xt10.jpeg', 0, 0, 100000, 175000, 'Mirrorless', 'yes'),
(19, 'FUJIFILM X-A3 16-50mm', 'assets/img/cameras/ff-xa3.jpg', 0, 0, 95000, 150000, 'Mirrorless', 'no'),
(20, 'GOPRO Hero 7', 'assets/img/cameras/gp-hero7.png', 0, 0, 0, 175000, 'Action cam', 'yes'),
(21, 'NIKON D780 24-120mm', 'assets/img/cameras/nikon-d780.jpg', 0, 0, 400000, 600000, 'DSLR', 'yes'),
(22, 'FUJIFILM X-100V ', 'assets/img/cameras/ff-x100v.jpg', 0, 0, 0, 150000, 'Poket', 'yes'),
(24, 'GOPRO Hero 9', 'assets/img/cameras/gp-hero9.jpg', 0, 0, 0, 225000, 'Action cam', 'no');

-- --------------------------------------------------------

--
-- Struktur dari tabel `clientcameras`
--

CREATE TABLE `clientcameras` (
  `camera_id` int(20) NOT NULL,
  `client_username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `clientcameras`
--

INSERT INTO `clientcameras` (`camera_id`, `client_username`) VALUES
(17, 'harry'),
(18, 'harry'),
(22, 'harry'),
(23, 'harry'),
(24, 'harry'),
(2, 'jenny'),
(15, 'jenny'),
(16, 'jenny'),
(19, 'tom'),
(20, 'tom'),
(21, 'tom');

-- --------------------------------------------------------

--
-- Struktur dari tabel `clients`
--

CREATE TABLE `clients` (
  `client_username` varchar(50) NOT NULL,
  `client_name` varchar(50) NOT NULL,
  `client_phone` varchar(15) NOT NULL,
  `client_email` varchar(25) NOT NULL,
  `client_address` varchar(50) CHARACTER SET utf8 COLLATE utf8_estonian_ci NOT NULL,
  `client_password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `clients`
--

INSERT INTO `clients` (`client_username`, `client_name`, `client_phone`, `client_email`, `client_address`, `client_password`) VALUES
('harry', 'Harry Den', '9876543210', 'harryden@gmail.com', '2477  Harley Vincent Drive', 'h12'),
('jenny', 'Jeniffer Washington', '7850000069', 'washjeni@gmail.com', '4139  Mesa Drive', 'jenny'),
('tom', 'Tommy Doee', '900696969', 'tom@gmail.com', '4645  Dawson Drive', 't12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customers`
--

CREATE TABLE `customers` (
  `customer_username` varchar(50) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `customer_phone` varchar(15) NOT NULL,
  `customer_email` varchar(25) NOT NULL,
  `customer_address` varchar(50) NOT NULL,
  `customer_password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `customers`
--

INSERT INTO `customers` (`customer_username`, `customer_name`, `customer_phone`, `customer_email`, `customer_address`, `customer_password`) VALUES
('antonio', 'Antonio M', '0785556580', 'antony@gmail.com', '2677  Burton Avenue', 'password'),
('christine', 'Christine', '8544444444', 'chr@gmail.com', '3701  Fairway Drive', 'password'),
('ethan', 'Ethan Hawk', '69741111110', 'thisisethan@gmail.com', '4554  Rowes Lane', 'password'),
('james', 'James Washington', '0258786969', 'james@gmail.com', '2316  Mayo Street', 'password'),
('lucas', 'Lucas Rhoades', '7003658500', 'lucas@gmail.com', '2737  Fowler Avenue', 'lucas'),
('yeri', 'yeri siti', '123', 'yeri@gmail', 'qrfqa', '123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `feedback`
--

CREATE TABLE `feedback` (
  `name` varchar(20) NOT NULL,
  `e_mail` varchar(30) NOT NULL,
  `message` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `feedback`
--

INSERT INTO `feedback` (`name`, `e_mail`, `message`) VALUES
('Nikhil', 'nikhil@gmail.com', 'Hope this works.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rentedcameras`
--

CREATE TABLE `rentedcameras` (
  `id` int(100) NOT NULL,
  `customer_username` varchar(50) NOT NULL,
  `camera_id` int(20) NOT NULL,
  `booking_date` date NOT NULL,
  `rent_start_date` date NOT NULL,
  `rent_end_date` date NOT NULL,
  `camera_return_date` date DEFAULT NULL,
  `fare` double NOT NULL,
  `charge_type` varchar(25) NOT NULL DEFAULT 'days',
  `no_of_days` int(50) DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `return_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `rentedcameras`
--

INSERT INTO `rentedcameras` (`id`, `customer_username`, `camera_id`, `booking_date`, `rent_start_date`, `rent_end_date`, `camera_return_date`, `fare`, `charge_type`, `no_of_days`, `total_amount`, `return_status`) VALUES
(1, 'yeri', 15, '2022-12-13', '2022-12-14', '2022-12-15', '2022-12-20', 90000, 'days', 6, 50000, 'R'),
(574681275, 'lucas', 24, '2022-12-21', '2022-12-23', '2022-12-24', '2022-12-21', 225000, 'days', -2, 0, 'R'),
(574681281, 'yeri', 16, '2022-12-21', '2022-12-21', '2022-12-22', '2022-12-21', 600000, 'days', 0, 0, 'R'),
(574681282, 'lucas', 18, '2022-12-21', '2022-12-21', '2022-12-22', '2022-12-23', 100000, 'days', 2, 10000, 'R'),
(574681283, 'lucas', 2, '2022-12-21', '2022-12-21', '2022-12-29', '2022-12-24', 750000, 'days', 3, 0, 'R'),
(574681284, 'lucas', 24, '2022-12-21', '2022-12-22', '2022-12-26', '2022-12-24', 225000, 'days', 2, 0, 'R'),
(574681285, 'lucas', 15, '2022-12-21', '2022-12-22', '2022-12-27', NULL, 150000, 'days', NULL, NULL, 'NR'),
(574681286, 'lucas', 16, '2022-12-22', '2022-12-22', '2022-12-22', NULL, 450000, 'days', NULL, NULL, 'NR'),
(574681287, 'lucas', 1, '2022-12-23', '2022-12-23', '2022-12-27', '2022-12-24', 130000, 'days', 1, 0, 'R'),
(574681288, 'lucas', 19, '2022-12-23', '2022-12-23', '2022-12-28', NULL, 150000, 'days', NULL, NULL, 'NR'),
(574681289, 'lucas', 24, '2022-12-24', '2022-12-24', '2022-12-25', NULL, 225000, 'days', NULL, NULL, 'NR'),
(574681290, 'lucas', 24, '2022-12-24', '2022-12-24', '2022-12-25', NULL, 225000, 'days', NULL, NULL, 'NR');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `aduan`
--
ALTER TABLE `aduan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cameras`
--
ALTER TABLE `cameras`
  ADD PRIMARY KEY (`camera_id`);

--
-- Indeks untuk tabel `clientcameras`
--
ALTER TABLE `clientcameras`
  ADD PRIMARY KEY (`camera_id`),
  ADD KEY `client_username` (`client_username`);

--
-- Indeks untuk tabel `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_username`);

--
-- Indeks untuk tabel `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_username`);

--
-- Indeks untuk tabel `rentedcameras`
--
ALTER TABLE `rentedcameras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_username` (`customer_username`),
  ADD KEY `camera_id` (`camera_id`) USING BTREE;

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `aduan`
--
ALTER TABLE `aduan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `cameras`
--
ALTER TABLE `cameras`
  MODIFY `camera_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `rentedcameras`
--
ALTER TABLE `rentedcameras`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=574681291;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
