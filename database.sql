-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost:3306
-- Üretim Zamanı: 14 Ağu 2020, 21:04:17
-- Sunucu sürümü: 5.7.31-cll-lve
-- PHP Sürümü: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `kasyomed_hesapsat`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `created_date` int(11) NOT NULL,
  `days` int(11) NOT NULL,
  `verified` int(11) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `price` float NOT NULL,
  `details` text NOT NULL,
  `category` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `bought_date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `accounts`
--

INSERT INTO `accounts` (`id`, `created_date`, `days`, `verified`, `email`, `password`, `price`, `details`, `category`, `user`, `bought_date`) VALUES
(1, 1596315600, 30, 0, 'https', '//facebook.com', 300, '', 2, 4, 1596320479),
(2, 1596315600, 30, 1, 'http://google.com', 'yok', 50, '', 2, 5, 1596329709),
(3, 1596315600, 0, 0, 'http://google.com', '', 1, '', 2, 5, 1596328837);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `banks`
--

CREATE TABLE `banks` (
  `id` int(11) NOT NULL,
  `bank_name` varchar(300) NOT NULL,
  `name` varchar(300) NOT NULL,
  `number` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `categories`
--

INSERT INTO `categories` (`id`, `name`, `active`) VALUES
(2, 'İnstagram Proxy İpv6', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `configs`
--

CREATE TABLE `configs` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `configs`
--

INSERT INTO `configs` (`id`, `name`, `value`) VALUES
(1, 'site_name', 'RemoPix'),
(2, 'site_description', 'Sitemiz sayesinde kolayca Dijital Ürün Alabilirsiniz.'),
(3, 'site_tags', 'Dijital Ürün Al , ucuza Dijital Ürün Al'),
(4, 'site_lang', 'tr'),
(5, 'site_money_sign', '₺'),
(6, 'recaptcha_enabled', '0'),
(7, 'recaptcha_site_key', ''),
(8, 'recaptcha_secret_key', ''),
(9, 'smtp_host', 'smtp.hosting.com'),
(10, 'smtp_user', 'noreply@hosting.com'),
(11, 'smtp_pass', '123456'),
(12, 'smtp_port', '25'),
(13, 'minimum_payment', '1'),
(14, 'payment_method', 'shopier'),
(15, 'shopier_api_key', 'api_key'),
(16, 'shopier_api_secret', 'api_anahtar'),
(17, 'shopier_site_index', '1'),
(18, 'payment_commission', '0'),
(19, 'weepay_seller_id', '1000'),
(20, 'weepay_api_key', 'weepay_api_key'),
(21, 'weepay_secret_key', 'weepay_secret_key'),
(22, 'logo', '0'),
(23, 'site_timezone', 'Europe/Istanbul');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `slug` varchar(500) NOT NULL,
  `description` varchar(500) NOT NULL,
  `tags` varchar(500) NOT NULL,
  `content` text NOT NULL,
  `menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `pages`
--

INSERT INTO `pages` (`id`, `name`, `slug`, `description`, `tags`, `content`, `menu`) VALUES
(6, 'Kullanım Koşulları', 'kullanim-kosullari', 'Sitemizi kullanarak bazı şartları kabul etmiş olursunuz.', 'kullanım koşulları', '<p>Site &Uuml;zerinden Alınan Dijital Ürünlerden Ve Aldıgınız Bu Dijital Ürünlerden Yapacagınız T&uuml;m İşlemlerden Dijital Ürünü  Alan Kişi Sorumludur. Her Hangi Bir Dijital Ürün Alımında Bu Sorumlulukları Kabul Etmiş Olursunuz.</p>\n', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `user` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `payments`
--

INSERT INTO `payments` (`id`, `amount`, `user`, `time`, `status`) VALUES
(3, 100, 1, 1596331027, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `payment_notifications`
--

CREATE TABLE `payment_notifications` (
  `id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `bank` int(11) NOT NULL,
  `amount` float NOT NULL,
  `user` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `title` varchar(300) NOT NULL,
  `user` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ticket_messages`
--

CREATE TABLE `ticket_messages` (
  `id` int(11) NOT NULL,
  `ticket` int(11) NOT NULL,
  `message` text NOT NULL,
  `user` int(11) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(64) NOT NULL,
  `balance` float NOT NULL,
  `created_date` int(11) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `balance`, `created_date`, `role`) VALUES
(1, 'Admin', 'admin@remopix.com', '1da494a21233a1a7a0f34e4ee1ba822374df6fb4b5d7526d94b06aed8ca6fc02', 0, 1589888075, 1);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `configs`
--
ALTER TABLE `configs`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `payment_notifications`
--
ALTER TABLE `payment_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `ticket_messages`
--
ALTER TABLE `ticket_messages`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `banks`
--
ALTER TABLE `banks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `configs`
--
ALTER TABLE `configs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Tablo için AUTO_INCREMENT değeri `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `payment_notifications`
--
ALTER TABLE `payment_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `ticket_messages`
--
ALTER TABLE `ticket_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
