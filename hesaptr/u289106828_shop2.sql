-- Adminer 4.8.1 MySQL 10.11.9-MariaDB dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
  `id` bigint(21) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(300) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `img` varchar(300) DEFAULT NULL,
  `content` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `bank_notifies`;
CREATE TABLE `bank_notifies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` decimal(10,2) NOT NULL,
  `datetime` datetime NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `billing_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`billing_details`)),
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel_cache_14a0fe0788347e46832d63669bfab451',	'i:1;',	1728498360),
('laravel_cache_14a0fe0788347e46832d63669bfab451:timer',	'i:1728498360;',	1728498360),
('laravel_cache_991ee1d8a26e23562f40a88e005f5dcb',	'i:5;',	1725562983),
('laravel_cache_991ee1d8a26e23562f40a88e005f5dcb:timer',	'i:1725562983;',	1725562983),
('laravel_cache_agree_message',	'N;',	2040976615),
('laravel_cache_checkout_message',	'N;',	2040976615),
('laravel_cache_contact_address',	's:20:\"İstanbul, Ataşehir\";',	2040989380),
('laravel_cache_contact_email',	's:17:\"km.tftk@gmail.com\";',	2040989380),
('laravel_cache_contact_meta_description',	'N;',	2040989380),
('laravel_cache_contact_meta_title',	'N;',	2040989380),
('laravel_cache_contact_phone',	's:11:\"05360603666\";',	2040989380),
('laravel_cache_convert_to_exchange_rate_paytr',	'N;',	2042828940),
('laravel_cache_convert_to_exchange_rate_shopier',	's:1:\"1\";',	2040907680),
('laravel_cache_currency',	's:3:\"TRY\";',	2040976615),
('laravel_cache_currency_symbol',	's:3:\"₺\";',	2040976615),
('laravel_cache_extra_footer',	'N;',	2040989268),
('laravel_cache_extra_header',	's:44:\"<a href=\"https://strotik.net/\">Ana Sayfa</a>\";',	2040989268),
('laravel_cache_favicon_img',	's:19:\"uploads/favicon.ico\";',	2040907907),
('laravel_cache_footer_menu_column1',	's:34:\"Strotik.net her hakkı saklıdır.\";',	2040989435),
('laravel_cache_footer_menu_column2',	's:34:\"Strotik.net her hakkı saklıdır.\";',	2040989435),
('laravel_cache_footer_menu_column3',	's:34:\"Strotik.net her hakkı saklıdır.\";',	2040989435),
('laravel_cache_hudsoosv24@gmail.com|187.60.253.34',	'i:4;',	1727873532),
('laravel_cache_hudsoosv24@gmail.com|187.60.253.34:timer',	'i:1727873532;',	1727873532),
('laravel_cache_iban_active',	's:1:\"1\";',	2040907748),
('laravel_cache_iban_name',	's:10:\"Havale/EFT\";',	2040907748),
('laravel_cache_ibans',	'a:2:{i:0;a:3:{s:4:\"iban\";s:26:\"TR040001009010384902705002\";s:9:\"iban_bank\";s:15:\"Ziraat Bankası\";s:9:\"iban_name\";s:17:\"Kaan Melih Tiftik\";}i:1;a:3:{s:4:\"iban\";s:26:\"TR040006701000000098308556\";s:9:\"iban_bank\";s:7:\"garanti\";s:9:\"iban_name\";s:17:\"kaan melih tiftik\";}}',	2040907748),
('laravel_cache_language',	's:2:\"tr\";',	2040976615),
('laravel_cache_logo_img',	's:17:\"uploads/logo.webp\";',	2040907907),
('laravel_cache_maksvellwhitneyv1994@gmail.com|80.85.247.90',	'i:4;',	1728092797),
('laravel_cache_maksvellwhitneyv1994@gmail.com|80.85.247.90:timer',	'i:1728092797;',	1728092797),
('laravel_cache_paytr_active',	'N;',	2042828940),
('laravel_cache_paytr_merchant_id',	'N;',	2042828940),
('laravel_cache_paytr_merchant_key',	'N;',	2042828940),
('laravel_cache_paytr_merchant_salt',	'N;',	2042828940),
('laravel_cache_paytr_name',	'N;',	2042828940),
('laravel_cache_product_columns_count',	'N;',	2040976615),
('laravel_cache_shopier_active',	's:1:\"1\";',	2040907680),
('laravel_cache_shopier_api_secret',	's:32:\"1a533baf7e91d03e9a3dbac3b88c6c9c\";',	2040907680),
('laravel_cache_shopier_api_username',	's:32:\"5244e24ac949cd76158d54139b627ea3\";',	2040907680),
('laravel_cache_shopier_name',	's:7:\"shopier\";',	2040907680),
('laravel_cache_site_locale',	'N;',	2040976615),
('laravel_cache_site_name',	'N;',	2040976615),
('laravel_cache_to_exchange_paytr',	'N;',	2042828940),
('laravel_cache_to_exchange_shopier',	's:3:\"TRY\";',	2040907680),
('laravel_cache_yandex_translate_active',	'N;',	2040976615);

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` bigint(21) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `img`, `created_at`, `updated_at`) VALUES
(1,	'İnstagram Hizmetleri',	'instagram-hizmetleri',	'Kaliteli İnstagram Hizmetleri',	'uploads/categories/cat_1725547322.webp',	'2024-09-05 17:42:02',	'2024-09-05 17:42:02'),
(2,	'Google Maps Hizmetleri',	'google-maps-hizmetleri',	'Kaliteli Google Hizmetleri',	'uploads/categories/cat_1725547356.webp',	'2024-09-05 17:42:36',	'2024-09-05 17:42:36'),
(4,	'E-pin Hizmetleri',	'e-pin-hizmetleri',	'Kaliteli E-pin Hizmetleri',	'uploads/categories/cat_1725547402.webp',	'2024-09-05 17:43:22',	'2024-09-05 17:43:22'),
(5,	'SEO hizmetleri',	'seo-hizmetleri',	'Kaliteli SEO hizmetleri',	'uploads/categories/cat_1725547420.webp',	'2024-09-05 17:43:40',	'2024-09-05 17:43:40'),
(6,	'Windows Lisans Hizmetleri',	'windows-lisans-hizmetleri',	'Kaliteli Lisans Hizmetleri',	'uploads/categories/cat_1725617516.webp',	'2024-09-06 13:11:56',	'2024-09-06 13:11:56'),
(7,	'Office Lisans Hizmetleri',	'office-lisans-hizmetleri',	'Kaliteli Office Lisansları',	'uploads/categories/cat_1725617564.webp',	'2024-09-06 13:12:44',	'2024-09-06 13:12:44'),
(8,	'Antivirüs Programları',	'antivirus-programlari',	'Kaliteli Antivirüs Programları',	'uploads/categories/cat_1725617662.webp',	'2024-09-06 13:14:22',	'2024-09-06 13:14:22'),
(10,	'Script',	'script',	'Birbirinden kaliteli scriptler',	'uploads/categories/cat_1725732073.webp',	'2024-09-07 21:01:13',	'2024-09-07 21:01:13'),
(11,	'website',	'website',	'Kaliteli Website Hizmetleri.',	'uploads/categories/cat_1725922165.webp',	'2024-09-10 01:49:25',	'2024-09-10 01:49:25'),
(12,	'İçerik arşivleri',	'icerik-arsivleri',	'Kaliteli içerik paketleri',	'uploads/categories/cat_1726282530.webp',	'2024-09-14 05:55:30',	'2024-09-14 05:55:30');

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE `contacts` (
  `id` bigint(21) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `message` varchar(500) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `coupons`;
CREATE TABLE `coupons` (
  `id` bigint(21) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` decimal(10,2) unsigned NOT NULL,
  `min_price_limit` decimal(10,2) unsigned DEFAULT NULL,
  `used` int(10) unsigned NOT NULL DEFAULT 0,
  `max_used` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `favorites`;
CREATE TABLE `favorites` (
  `id` bigint(21) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(21) unsigned DEFAULT NULL,
  `product_id` bigint(21) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `footer_menus`;
CREATE TABLE `footer_menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `column` int(10) unsigned DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(300) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` bigint(21) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` varchar(255) NOT NULL,
  `user_id` bigint(21) DEFAULT NULL,
  `billing_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`billing_details`)),
  `product` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`product`)),
  `total` decimal(10,2) DEFAULT NULL,
  `coupon_code` varchar(255) DEFAULT NULL,
  `payment_status` tinyint(1) DEFAULT 0,
  `order_status` varchar(25) DEFAULT NULL,
  `note` varchar(300) DEFAULT NULL,
  `ip` varchar(100) DEFAULT NULL,
  `stocks` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`stocks`)),
  `file` varchar(300) DEFAULT NULL,
  `file_url` varchar(300) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `payment_method` varchar(30) DEFAULT NULL,
  `wallet` tinyint(1) unsigned DEFAULT NULL,
  `archived` tinyint(1) unsigned DEFAULT NULL,
  `download` tinyint(1) unsigned DEFAULT NULL,
  `customer_answers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`customer_answers`)),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `orders` (`id`, `order_id`, `user_id`, `billing_details`, `product`, `total`, `coupon_code`, `payment_status`, `order_status`, `note`, `ip`, `stocks`, `file`, `file_url`, `created_at`, `updated_at`, `payment_method`, `wallet`, `archived`, `download`, `customer_answers`) VALUES
(1,	'66d9c4ca9a7ca',	3,	'{\n    \"name\": \"tiftik\",\n    \"surname\": \"julo\",\n    \"email\": \"km.tftk@gmail.com\",\n    \"phone\": \"000000000\",\n    \"ip\": \"95.8.215.15\"\n}',	'{\n    \"product_id\": 1,\n    \"name\": \"\\u0130nstagram -> Fenomen ve \\u0130\\u015fletme B\\u00fcy\\u00fctme Paketi (Bronz)\",\n    \"price\": \"1900.00\",\n    \"qty\": 1,\n    \"total\": 1900\n}',	1900.00,	NULL,	0,	NULL,	NULL,	NULL,	NULL,	'uploads/files/product_#1725547543.png',	NULL,	'2024-09-05 14:48:42',	'2024-09-05 17:48:42',	'Havale/EFT',	NULL,	NULL,	NULL,	NULL),
(2,	'66d9c4e74ebf6',	3,	'{\n    \"name\": \"tiftik\",\n    \"surname\": \"julo\",\n    \"email\": \"km.tftk@gmail.com\",\n    \"phone\": \"000000000\",\n    \"ip\": \"95.8.215.15\"\n}',	'{\n    \"product_id\": 1,\n    \"name\": \"\\u0130nstagram -> Fenomen ve \\u0130\\u015fletme B\\u00fcy\\u00fctme Paketi (Bronz)\",\n    \"price\": \"1900.00\",\n    \"qty\": 1,\n    \"total\": 1900\n}',	1900.00,	NULL,	0,	NULL,	NULL,	NULL,	NULL,	'uploads/files/product_#1725547543.png',	NULL,	'2024-09-05 14:49:11',	'2024-09-05 17:49:11',	'Havale/EFT',	NULL,	NULL,	NULL,	NULL),
(3,	'66d9c51347828',	3,	'{\n    \"name\": \"tiftik\",\n    \"surname\": \"julo\",\n    \"email\": \"km.tftk@gmail.com\",\n    \"phone\": \"000000000\",\n    \"ip\": \"95.8.215.15\"\n}',	'{\n    \"product_id\": 1,\n    \"name\": \"\\u0130nstagram -> Fenomen ve \\u0130\\u015fletme B\\u00fcy\\u00fctme Paketi (Bronz)\",\n    \"price\": \"1900.00\",\n    \"qty\": 1,\n    \"total\": 1900\n}',	1900.00,	NULL,	0,	NULL,	NULL,	NULL,	NULL,	'uploads/files/product_#1725547543.png',	NULL,	'2024-09-05 14:49:55',	'2024-09-05 17:49:55',	'shopier',	NULL,	NULL,	NULL,	NULL),
(4,	'66d9ff4bd9002',	3,	'{\n    \"name\": \"tiftik\",\n    \"surname\": \"julo\",\n    \"email\": \"km.tftk@gmail.com\",\n    \"phone\": \"000000000\",\n    \"ip\": \"95.8.215.15\"\n}',	'{\n    \"product_id\": 5,\n    \"name\": \"\\u0130nstagram Ke\\u015ffet Paketi %50\",\n    \"price\": \"350.00\",\n    \"qty\": 1,\n    \"total\": 350\n}',	350.00,	NULL,	0,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2024-09-05 18:58:19',	'2024-09-05 21:58:19',	'Havale/EFT',	NULL,	NULL,	NULL,	NULL),
(5,	'66d9ff8f5975c',	3,	'{\n    \"name\": \"kaan\",\n    \"surname\": \"tiftik\",\n    \"email\": \"km.tftk@gmail.com\",\n    \"phone\": \"05360603666\",\n    \"ip\": \"95.8.215.15\"\n}',	'{\n    \"product_id\": 5,\n    \"name\": \"\\u0130nstagram Ke\\u015ffet Paketi %50\",\n    \"price\": \"350.00\",\n    \"qty\": 1,\n    \"total\": 350\n}',	350.00,	NULL,	1,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2024-09-05 19:02:37',	'2024-09-05 22:02:37',	'Havale/EFT',	NULL,	NULL,	NULL,	NULL),
(6,	'66ed829c53232',	3,	'{\n    \"name\": \"kaan\",\n    \"surname\": \"tiftik\",\n    \"email\": \"km.tftk@gmail.com\",\n    \"phone\": \"05360603666\",\n    \"ip\": \"78.191.91.99\"\n}',	'{\n    \"product_id\": 39,\n    \"name\": \"+1000 Viral  Video Ar\\u015fivi\",\n    \"price\": \"250.00\",\n    \"qty\": 1,\n    \"total\": 250\n}',	250.00,	NULL,	0,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2024-09-20 14:11:40',	'2024-09-20 17:11:40',	'shopier',	NULL,	NULL,	NULL,	NULL),
(7,	'66f5e11648c86',	NULL,	'{\n    \"name\": \"test\",\n    \"surname\": \"test\",\n    \"email\": \"test@test.com\",\n    \"phone\": \"05555555555\",\n    \"ip\": \"188.57.65.166\"\n}',	'{\n    \"product_id\": 36,\n    \"name\": \"Wordpress (E-ticaret) websitesi\",\n    \"price\": \"1750.00\",\n    \"qty\": 1,\n    \"total\": 1750\n}',	1750.00,	NULL,	0,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2024-09-26 22:32:54',	'2024-09-27 01:32:54',	'shopier',	NULL,	NULL,	NULL,	NULL);

DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` bigint(21) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(300) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` bigint(21) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint(21) unsigned DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(300) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `sliders` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `old_price` decimal(10,2) unsigned DEFAULT NULL,
  `price` decimal(10,2) unsigned DEFAULT NULL,
  `discount_rate` int(10) unsigned DEFAULT NULL,
  `discount_more` varchar(255) DEFAULT NULL,
  `even_if_out_of_stock` tinyint(1) unsigned DEFAULT NULL,
  `whatsapp` varchar(25) DEFAULT NULL,
  `buy_button` tinyint(1) DEFAULT 1,
  `demo_url` varchar(255) DEFAULT NULL,
  `admin_demo_url` varchar(255) DEFAULT NULL,
  `properties` varchar(255) DEFAULT NULL,
  `sales_count` int(10) unsigned NOT NULL DEFAULT 0,
  `views_count` int(10) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `content` longtext DEFAULT NULL,
  `file` varchar(300) DEFAULT NULL,
  `file_url` varchar(300) DEFAULT NULL,
  `customer_inputs` varchar(1000) DEFAULT NULL,
  `faqs` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`faqs`)),
  `draft` tinyint(1) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `description`, `img`, `sliders`, `old_price`, `price`, `discount_rate`, `discount_more`, `even_if_out_of_stock`, `whatsapp`, `buy_button`, `demo_url`, `admin_demo_url`, `properties`, `sales_count`, `views_count`, `created_at`, `updated_at`, `content`, `file`, `file_url`, `customer_inputs`, `faqs`, `draft`) VALUES
(1,	1,	'İnstagram -> Fenomen ve İşletme Büyütme Paketi (Bronz)',	'instagram-fenomen-ve-isletme-buyutme-paketi-bronz',	'Kaliteli İnstagram Hizmetleri /ℹ️ℹ️ℹ️ℹ️ℹ️ Satın alma işlemi sırasında NOT kısmına instagram sayfanızın urlsini yazmanız gerekiyor. aksi taktirde işleminiz iptal edilip. paranız iade edilir. ℹ️ℹ️ℹ️ℹ️ℹ️ /Satın Almadan önce sayfanın altındaki Açıklamayı okuyunuz.',	'uploads/products/product_1725547578.webp',	NULL,	NULL,	1900.00,	NULL,	NULL,	1,	NULL,	1,	NULL,	NULL,	NULL,	0,	12,	'2024-09-05 17:45:43',	'2024-10-08 02:41:23',	'<p><span>ℹ️ Bu servisi satın aldığınız işletmeniz hızla sosyal medyada pop&uuml;ler hale gelecektir. Y&uuml;kselmenize ve işinizi b&uuml;y&uuml;tmenizde size yardımcı olacaktır.</span><br><br><span>💥 BRONZ PAKET İ&Ccedil;ERİĞİ :</span><br><br><span>🙎🏻&zwj;♂️ 3000 Premium T&uuml;rk Takip&ccedil;i</span><br><span>❤️ 30 G&uuml;n Boyunca 30 G&ouml;nderinize 300 Ger&ccedil;ek T&uuml;rk Beğeni</span><br><span>❤️ 5 Tane Eski G&ouml;nderiye 100 Ger&ccedil;ek T&uuml;rk Beğeni</span><br><span>🎥 30 G&uuml;n Boyunca 30 Videoya 2000 İzlenme</span><br><span>💬 Son 5 G&ouml;nderinin Her Birine 20 Adet Yorum + Kaydet</span><br><span>🔔 50 Adet T&uuml;rk Hesaptan Hikayede Paylaşarak Takip Etme &Ouml;nerisi (72 Saat İ&ccedil;erisinde)</span><br><span>🔔 50 Adet T&uuml;rk Hesaptan Hikayede G&ouml;nderinizi Paylaşma (72 Saat İ&ccedil;erisinde)</span><br><span>🎉 +100K Takip&ccedil;i &Uuml;zeri 1 Adet Bloggerdan Profili POST+STORY Paylaşımı</span></p>',	'uploads/files/product_#1725547543.png',	NULL,	NULL,	NULL,	NULL),
(2,	1,	'İnstagram -> Fenomen ve İşletme Büyütme Paketi (Gümüş)',	'instagram-fenomen-ve-isletme-buyutme-paketi-gumus',	'Kaliteli İnstagram Hizmetleri /ℹ️ℹ️ℹ️ℹ️ℹ️ Satın alma işlemi sırasında NOT kısmına instagram sayfanızın urlsini yazmanız gerekiyor. aksi taktirde işleminiz iptal edilip. paranız iade edilir. ℹ️ℹ️ℹ️ℹ️ℹ️ /Satın Almadan önce sayfanın altındaki Açıklamayı okuyunuz.',	'uploads/products/product_1725562092.webp',	NULL,	NULL,	3100.00,	NULL,	NULL,	1,	NULL,	1,	NULL,	NULL,	NULL,	0,	14,	'2024-09-05 21:48:12',	'2024-10-07 05:24:24',	'<p><span>ℹ️ Bu servisi satın aldığınız işletmeniz hızla sosyal medyada pop&uuml;ler hale gelecektir. Y&uuml;kselmenize ve işinizi b&uuml;y&uuml;tmenizde size yardımcı olacaktır.</span><br><br><span>💥 G&Uuml;M&Uuml;Ş PAKET İ&Ccedil;ERİĞİ :</span><br><br><span>🙎🏻&zwj;♂️ 5.000 Premium T&uuml;rk Takip&ccedil;i</span><br><span>❤️ 30 G&uuml;n Boyunca 30 G&ouml;nderinize 750 Ger&ccedil;ek T&uuml;rk Beğeni</span><br><span>❤️ 5 Tane Eski G&ouml;nderiye 250 Ger&ccedil;ek T&uuml;rk Beğeni</span><br><span>🎥 30 G&uuml;n Boyunca 30 Videoya 5000 İzlenme</span><br><span>💬 Son 10 G&ouml;nderinin Her Birine 20 Adet Yorum + Kaydet</span><br><span>🔔 100 Adet T&uuml;rk Hesaptan Hikayede Paylaşarak Takip Etme &Ouml;nerisi (72 Saat İ&ccedil;erisinde)</span><br><span>🔔 100 Adet T&uuml;rk Hesaptan Hikayede G&ouml;nderinizi Paylaşma (72 Saat İ&ccedil;erisinde)</span><br><span>🎉 +100K Takip&ccedil;i &Uuml;zeri 2 Adet Bloggerdan Profili POST+STORY Paylaşımı</span></p>',	NULL,	NULL,	NULL,	NULL,	NULL),
(3,	1,	'İnstagram -> Fenomen ve İşletme Büyütme Paketi (Altın)',	'-instagram-fenomen-ve-isletme-buyutme-paketi-altin',	'Kaliteli İnstagram Hizmetleri /ℹ️ℹ️ℹ️ℹ️ℹ️ Satın alma işlemi sırasında NOT kısmına instagram sayfanızın urlsini yazmanız gerekiyor. aksi taktirde işleminiz iptal edilip. paranız iade edilir. ℹ️ℹ️ℹ️ℹ️ℹ️ /Satın Almadan önce sayfanın altındaki Açıklamayı okuyunuz.',	'uploads/products/product_1725562129.webp',	NULL,	NULL,	6000.00,	NULL,	NULL,	1,	NULL,	1,	NULL,	NULL,	NULL,	0,	5,	'2024-09-05 21:48:49',	'2024-09-27 01:32:28',	'<p><span>ℹ️ Bu servisi satın aldığınız işletmeniz hızla sosyal medyada pop&uuml;ler hale gelecektir. Y&uuml;kselmenize ve işinizi b&uuml;y&uuml;tmenizde size yardımcı olacaktır.</span><br><br><span>💥 ALTIN PAKET İ&Ccedil;ERİĞİ :</span><br><br><span>🙎🏻&zwj;♂️ 10.000 Premium T&uuml;rk Takip&ccedil;i</span><br><span>❤️ 30 G&uuml;n Boyunca 30 G&ouml;nderinize 1500 Ger&ccedil;ek T&uuml;rk Beğeni</span><br><span>❤️ 5 Tane Eski G&ouml;nderiye 1000 Ger&ccedil;ek T&uuml;rk Beğeni</span><br><span>🎥 30 G&uuml;n Boyunca 30 Videoya 10.000 İzlenme</span><br><span>💬 Son 10 G&ouml;nderinin Her Birine 40 Adet Yorum + Kaydet</span><br><span>🔔 200 Adet T&uuml;rk Hesaptan Hikayede Paylaşarak Takip Etme &Ouml;nerisi (72 Saat İ&ccedil;erisinde)</span><br><span>🔔 200 Adet T&uuml;rk Hesaptan Hikayede G&ouml;nderinizi Paylaşma (72 Saat İ&ccedil;erisinde)</span><br><span>🎉 +100K Takip&ccedil;i &Uuml;zeri 3 Adet Bloggerdan Profili POST+STORY Paylaşımı</span></p>',	NULL,	NULL,	NULL,	NULL,	NULL),
(4,	1,	'İnstagram -> Fenomen ve İşletme Büyütme Paketi (Elmas)',	'instagram-fenomen-ve-isletme-buyutme-paketi-elmas',	'Kaliteli İnstagram Hizmetleri /ℹ️ℹ️ℹ️ℹ️ℹ️ Satın alma işlemi sırasında NOT kısmına instagram sayfanızın urlsini yazmanız gerekiyor. aksi taktirde işleminiz iptal edilip. paranız iade edilir. ℹ️ℹ️ℹ️ℹ️ℹ️ /Satın Almadan önce sayfanın altındaki Açıklamayı okuyunuz.',	'uploads/products/product_1725562163.webp',	NULL,	NULL,	12000.00,	NULL,	NULL,	1,	NULL,	1,	NULL,	NULL,	NULL,	0,	9,	'2024-09-05 21:49:24',	'2024-10-15 17:11:55',	'<p><span>ℹ️ Bu servisi satın aldığınız işletmeniz hızla sosyal medyada pop&uuml;ler hale gelecektir. Y&uuml;kselmenize ve işinizi b&uuml;y&uuml;tmenizde size yardımcı olacaktır.</span><br><br><span>💥 ELMAS PAKET İ&Ccedil;ERİĞİ :</span><br><br><span>🙎🏻&zwj;♂️ 20.000 Premium T&uuml;rk Takip&ccedil;i (48-72 Saat İ&ccedil;erisinde Doğal Olarak Gelir)</span><br><span>❤️ 30 G&uuml;n Boyunca 30 G&ouml;nderinize 3.000 Ger&ccedil;ek T&uuml;rk Beğeni</span><br><span>❤️ 5 Tane Eski G&ouml;nderiye 2.000 Ger&ccedil;ek T&uuml;rk Beğeni</span><br><span>🎥 30 G&uuml;n Boyunca 30 Videoya 20.000 İzlenme</span><br><span>💬 Son 10 G&ouml;nderinin Her Birine 80 Adet Yorum + Kaydet</span><br><span>🔔 400 Adet T&uuml;rk Hesaptan Hikayede Paylaşarak Takip Etme &Ouml;nerisi (72 Saat İ&ccedil;erisinde)</span><br><span>🔔 400 Adet T&uuml;rk Hesaptan Hikayede G&ouml;nderinizi Paylaşma (72 Saat İ&ccedil;erisinde)</span><br><span>🎉 +100K Takip&ccedil;i &Uuml;zeri 5 Adet Bloggerdan Profili POST+STORY Paylaşımı</span></p>',	NULL,	NULL,	NULL,	NULL,	NULL),
(5,	1,	'İnstagram Keşfet Paketi %50',	'instagram-kesfet-paketi-50',	'Kaliteli İnstagram Hizmetleri /ℹ️ℹ️ℹ️ℹ️ℹ️ Satın alma işlemi sırasında NOT kısmına instagram gönderinizin urlsini yazmanız gerekiyor. aksi taktirde işleminiz iptal edilip. paranız iade edilir. ℹ️ℹ️ℹ️ℹ️ℹ️ /Satın Almadan önce sayfanın altındaki Açıklamayı okuyunuz.',	'uploads/products/product_1725562222.webp',	NULL,	NULL,	350.00,	NULL,	NULL,	1,	NULL,	1,	NULL,	NULL,	NULL,	0,	13,	'2024-09-05 21:50:22',	'2024-10-10 11:24:59',	'<p><span>❗️UYARI ❗️</span><br><span>Instagram hesabınız işletme / profesyonel hesap olmalıdır.</span><br><span>G&ouml;nderinin işletme / profesyonel hesabı iken paylaşılmış olması gerekmektedir.</span><br><span>Bu bilgileri dikkate alarak sipariş veriniz.</span><br><br><span>ℹ️ Bu paketi satın aldığınızda link kısmına gireceğiniz Instagram g&ouml;nderiniz %50 ihtimalle Instagram keşfete d&uuml;şmektedir. Takip&ccedil;i, beğeni, yorum, kaydetme ve paylaşma gibi işlemler aynı kullanıcılar tarafından yapılacağından keşfete d&uuml;ş&uuml;rmektedir. Tamamen %100 ger&ccedil;ek T&uuml;rk hesaplardan işlemler sağlanacağı i&ccedil;in g&ouml;nderinizin ve profilinizin t&uuml;m istatistikleri y&uuml;kselecektir.</span><br><br><span>✅ Paketlerimiz alanında profesyonel ekibimizce test edilmiş, keşfete d&uuml;ş&uuml;rd&uuml;ğ&uuml; g&ouml;zlemlenmiştir.</span><br><br><span>💥 Paket İ&ccedil;eriği : Takip&ccedil;i + Beğeni + Yorum + Kaydet + Paylaşım + Profil Ziyareti + G&ouml;sterim + Etkileşim + Erişim</span><br><br><span>🙎🏻&zwj;♂️ 100 Adet %100 T&uuml;rk ger&ccedil;ek aktif hesap kendi istekleri ile sizi takip ederler.</span><br><span>❤️ 100 Adet %100 T&uuml;rk ger&ccedil;ek aktif hesap kendi istekleri ile g&ouml;nderinizi beğenirler.</span><br><span>💬 20 Adet %100 T&uuml;rk ger&ccedil;ek aktif hesaplardan son g&ouml;nderinize yorum yapılır.</span><br><span>🏳️ 20 Adet %100 T&uuml;rk ger&ccedil;ek aktif hesaplardan son g&ouml;nderinize kaydetme sağlanır.</span><br><span>📩 20 Adet %100 T&uuml;rk ger&ccedil;ek aktif hesaplardan son g&ouml;nderinize paylaşım sağlanır.</span><br><span>➕ Instagram Etkileşim + Paylaşım + Erişim + G&ouml;sterim + Profil Ziyareti istatistikleriniz hızlı y&uuml;kselir.</span></p>',	NULL,	NULL,	NULL,	NULL,	NULL),
(6,	1,	'İnstagram Keşfet Paketi %75',	'instagram-kesfet-paketi-75',	'Kaliteli İnstagram Hizmetleri /ℹ️ℹ️ℹ️ℹ️ℹ️ Satın alma işlemi sırasında NOT kısmına instagram gönderinizin urlsini yazmanız gerekiyor. aksi taktirde işleminiz iptal edilip. paranız iade edilir. ℹ️ℹ️ℹ️ℹ️ℹ️ /Satın Almadan önce sayfanın altındaki Açıklamayı okuyunuz.',	'uploads/products/product_1725562257.webp',	NULL,	NULL,	710.00,	NULL,	NULL,	1,	NULL,	1,	NULL,	NULL,	NULL,	0,	17,	'2024-09-05 21:50:57',	'2024-10-13 00:53:58',	'<p><span>❗️UYARI ❗️</span><br><span>Instagram hesabınız işletme / profesyonel hesap olmalıdır.</span><br><span>G&ouml;nderinin işletme / profesyonel hesabı iken paylaşılmış olması gerekmektedir.</span><br><span>Bu bilgileri dikkate alarak sipariş veriniz.</span><br><br><span>ℹ️ Bu paketi satın aldığınızda not kısmına gireceğiniz Instagram g&ouml;nderiniz %75 ihtimalle Instagram keşfete d&uuml;şmektedir. Takip&ccedil;i, beğeni, yorum, kaydetme ve paylaşma gibi işlemler aynı kullanıcılar tarafından yapılacağından keşfete d&uuml;ş&uuml;rmektedir. Tamamen %100 ger&ccedil;ek T&uuml;rk hesaplardan işlemler sağlanacağı i&ccedil;in g&ouml;nderinizin ve profilinizin t&uuml;m istatistikleri y&uuml;kselecektir.</span><br><br><span>✅ Paketlerimiz alanında profesyonel ekibimizce test edilmiş, keşfete d&uuml;ş&uuml;rd&uuml;ğ&uuml; g&ouml;zlemlenmiştir.</span><br><br><span>💥 Paket İ&ccedil;eriği : Takip&ccedil;i + Beğeni + Yorum + Kaydet + Paylaşım + Profil Ziyareti + G&ouml;sterim + Etkileşim + Erişim</span><br><br><span>🙎🏻&zwj;♂️ 200 Adet %100 T&uuml;rk ger&ccedil;ek aktif hesap kendi istekleri ile sizi takip ederler.</span><br><span>❤️ 200 Adet %100 T&uuml;rk ger&ccedil;ek aktif hesap kendi istekleri ile g&ouml;nderinizi beğenirler.</span><br><span>💬 40 Adet %100 T&uuml;rk ger&ccedil;ek aktif hesaplardan son g&ouml;nderinize yorum yapılır.</span><br><span>🏳️ 40 Adet %100 T&uuml;rk ger&ccedil;ek aktif hesaplardan son g&ouml;nderinize kaydetme sağlanır.</span><br><span>📩 40 Adet %100 T&uuml;rk ger&ccedil;ek aktif hesaplardan son g&ouml;nderinize paylaşım sağlanır.</span><br><span>➕ Instagram Etkileşim + Paylaşım + Erişim + G&ouml;sterim + Profil Ziyareti istatistikleriniz hızla y&uuml;kselir.</span></p>',	NULL,	NULL,	NULL,	NULL,	NULL),
(7,	1,	'İnstagram Keşfet Paketi %100',	'instagram-kesfet-paketi-100',	'Kaliteli İnstagram Hizmetleri /ℹ️ℹ️ℹ️ℹ️ℹ️ Satın alma işlemi sırasında NOT kısmına instagram gönderinizin urlsini yazmanız gerekiyor. aksi taktirde işleminiz iptal edilip. paranız iade edilir. ℹ️ℹ️ℹ️ℹ️ℹ️ /Satın Almadan önce sayfanın altındaki Açıklamayı okuyunuz.',	'uploads/products/product_1725562317.webp',	NULL,	NULL,	1300.00,	NULL,	NULL,	1,	NULL,	1,	NULL,	NULL,	NULL,	0,	17,	'2024-09-05 21:51:57',	'2024-10-14 10:55:14',	'<p><span>❗️UYARI ❗️</span><br><span>Instagram hesabınız işletme / profesyonel hesap olmalıdır.</span><br><span>G&ouml;nderinin işletme / profesyonel hesabı iken paylaşılmış olması gerekmektedir.</span><br><span>Bu bilgileri dikkate alarak sipariş veriniz.</span><br><br><span>ℹ️ Bu paketi satın aldığınızda link kısmına gireceğiniz Instagram g&ouml;nderiniz %100 ihtimalle Instagram keşfete d&uuml;şmektedir. Takip&ccedil;i, beğeni, yorum, kaydetme ve paylaşma gibi işlemler aynı kullanıcılar tarafından yapılacağından keşfete d&uuml;ş&uuml;rmektedir. Tamamen %100 ger&ccedil;ek T&uuml;rk hesaplardan işlemler sağlanacağı i&ccedil;in g&ouml;nderinizin ve profilinizin t&uuml;m istatistikleri y&uuml;kselecektir.</span><br><br><span>🔸Link: Reels paylaşımlarında instagram keşfet istatistiği sunmadığından reels paylaşımları işleme alınmaz.</span><br><br><span>✅ Paketlerimiz alanında profesyonel ekibimizce test edilmiş, keşfete d&uuml;ş&uuml;rd&uuml;ğ&uuml; g&ouml;zlemlenmiştir.</span><br><br><span>💥 Paket İ&ccedil;eriği : Takip&ccedil;i + Beğeni + Yorum + Kaydet + Paylaşım + Profil Ziyareti + G&ouml;sterim + Etkileşim + Erişim</span><br><br><span>🙎🏻&zwj;♂️ 400 Adet %100 T&uuml;rk ger&ccedil;ek aktif hesap kendi istekleri ile sizi takip eder.</span><br><span>❤️ 400 Adet %100 T&uuml;rk ger&ccedil;ek aktif hesap kendi istekleri ile g&ouml;nderinizi beğenirler.</span><br><span>💬 80 Adet %100 T&uuml;rk ger&ccedil;ek aktif hesaplardan son g&ouml;nderinize yorum yapılır.</span><br><span>🏳️ 80 Adet %100 T&uuml;rk ger&ccedil;ek aktif hesaplardan son g&ouml;nderinize kaydetme sağlanır.</span><br><span>📩 80 Adet %100 T&uuml;rk ger&ccedil;ek aktif hesaplardan son g&ouml;nderinize paylaşım sağlanır.</span><br><span>➕ Instagram Etkileşim + Paylaşım + Erişim + G&ouml;sterim + Profil Ziyareti istatistikleriniz hızla y&uuml;kselir.</span></p>',	NULL,	NULL,	NULL,	NULL,	NULL),
(8,	5,	'Kaliteli Backlink Paketi (Gümüş)',	'kaliteli-backlink-paketi-gumus',	'Satın almadan önce açıklama kısmını okuyunuz.',	'uploads/products/product_1725562389.webp',	NULL,	NULL,	2000.00,	NULL,	NULL,	1,	NULL,	1,	NULL,	NULL,	NULL,	0,	26,	'2024-09-05 21:53:10',	'2024-10-13 23:57:07',	'<p><span>🔸 4500 Adet Blog Backlink</span><br><span>🔸 2000 Adet Profil Backlink</span><br><span>🔸 500 Adet Sosyal İmlenme Backlink</span><br><span>🔸 300 Adet Wkipedia Backlink</span><br><span>🔸 4 Adet Anahtar</span><br><span>🔸 Kaliteli y&uuml;ksek DA-PA siteler</span><br><span>🔸 Google hızlı sıralama artışı</span><br><span>🔸 Google hızlı index</span><br><span>🔸 Detaylı &ccedil;alışma raporu</span><br><span>🔸 Link building</span><br><span>🔸 Seo Analizi</span><br><span>🔸 2 Adet Backlink makalelerine resim</span><br><span>🔸 1 Adet Backlink makalelerine video</span><br><br><span>📌 1000 Adet Organik Ziyaret&ccedil;i</span><br><span>📌 Backlinkler DoFollow\'dur.</span><br><span>📌 Link : 1 Adet Link - 4 Adet Anahtar Kelime</span></p>',	NULL,	NULL,	NULL,	NULL,	NULL),
(9,	5,	'Kaliteli Backlink Paketi (Bronz)',	'-kaliteli-backlink-paketi-bronz',	NULL,	'uploads/products/product_1725562435.webp',	NULL,	NULL,	1500.00,	NULL,	NULL,	1,	NULL,	1,	NULL,	NULL,	NULL,	0,	16,	'2024-09-05 21:53:55',	'2024-10-15 12:39:43',	'<p><span>🔸 2200 Adet Blog Backlink</span><br><span>🔸 1200 Adet Profil Backlink</span><br><span>🔸 250 Adet Sosyal İmlenme Backlink</span><br><span>🔸 150 Adet Wkipedia Backlink</span><br><span>🔸 3 Adet anahtar kelime</span><br><span>🔸 Kaliteli y&uuml;ksek DA-PA siteler</span><br><span>🔸 Google hızlı sıralama artışı</span><br><span>🔸 Google hızlı index</span><br><span>🔸 Detaylı &ccedil;alışma raporu</span><br><span>🔸 Link building</span><br><span>🔸 Seo Analizi</span><br><span>🔸 1 Adet Backlink makalelerine resim</span><br><br><br><span>📌 Backlinkler DoFollow\'dur.</span><br><span>📌 Link : 1 Adet Link - 3 Adet Anahtar Kelime</span></p>',	NULL,	NULL,	NULL,	NULL,	NULL),
(10,	5,	'Kaliteli Backlink Paketi (VİP)',	'kaliteli-backlink-paketi-vip',	'Satın almadan önce açıklama kısmını okuyunuz.',	'uploads/products/product_1725562466.webp',	NULL,	NULL,	3000.00,	NULL,	NULL,	1,	NULL,	1,	NULL,	NULL,	NULL,	0,	10,	'2024-09-05 21:54:26',	'2024-10-11 21:02:43',	'<p><span>🔸 8000 Adet Blog Backlink</span><br><span>🔸 3000 Adet Profil Backlink</span><br><span>🔸 1600 Adet Sosyal İmlenme Backlink</span><br><span>🔸 300 Adet Wkipedia Backlink</span><br><span>🔸 5 Adet Anahtar</span><br><span>🔸 Kaliteli y&uuml;ksek DA-PA siteler</span><br><span>🔸 Google hızlı sıralama artışı</span><br><span>🔸 Google hızlı index</span><br><span>🔸 Detaylı &ccedil;alışma raporu</span><br><span>🔸 Link building</span><br><span>🔸 Seo Analizi</span><br><span>🔸 3 Adet Backlink makalelerine resim</span><br><span>🔸 2 Adet Backlink makalelerine video</span><br><br><span>📌 2500 Adet Organik Ziyaret&ccedil;i</span><br><span>📌 Backlinkler DoFollow\'dur.</span><br><span>📌 Link : 1 Adet Link - 5 Adet Anahtar Kelime</span></p>',	NULL,	NULL,	NULL,	NULL,	NULL),
(11,	2,	'Google Maps Kötü Yorum kaldırma (10 adet)',	'google-maps-kotu-yorum-kaldirma-10-adet',	'Satın almadan önce açıklama kısmını okuyunuz.',	'uploads/products/product_1725617027.webp',	NULL,	NULL,	12000.00,	NULL,	NULL,	1,	NULL,	1,	NULL,	NULL,	NULL,	0,	13,	'2024-09-06 13:03:47',	'2024-10-15 08:30:57',	'<p><span>İşletmenize gelen Google Harita yorumlarından k&ouml;t&uuml; olanları kaldırır.</span><br><span>Sipariş girdiğinizde harita yorumlarınız incelenir ve 1 yıldızlı k&ouml;t&uuml; yorumlar se&ccedil;ilerek kaldırılır.</span><br><br><span>🔸1 adet k&ouml;t&uuml; yorum kaldırma &uuml;creti 1000TL\'dir.</span><br><span>🔸Not: İşletmenin Google Haritalar Linki</span><br><span>🔸Yorum sayısı: 10</span><br><span>🔸10 adet kaldırma s&uuml;resi 1 ay s&uuml;rebilir. Sipariş miktarı arttık&ccedil;a s&uuml;re azalır.</span><br><span>🔸Servis %100 etkilidir.</span><br><br><span>Sorularınız i&ccedil;in destek ekibi ile iletişime ge&ccedil;ebilirsiniz.</span></p>',	NULL,	NULL,	NULL,	NULL,	NULL),
(12,	2,	'Google maps 5 yıldız / yorum',	'google-maps-5-yildiz-yorum',	NULL,	NULL,	NULL,	NULL,	30.00,	NULL,	NULL,	1,	NULL,	1,	NULL,	NULL,	NULL,	0,	0,	'2024-09-06 13:04:51',	'2024-09-06 13:04:51',	NULL,	NULL,	NULL,	NULL,	NULL,	1),
(13,	6,	'Windows 10 Home - Retail (Telefon aktivasyon)',	'windows-10-home-retail-telefon-aktivasyon',	'Key olarak teslim edilir. Ömür boyudur. 1 gün içerisinde kullanılmalıdır.',	'uploads/products/product_1725725980.webp',	NULL,	NULL,	40.00,	NULL,	NULL,	1,	NULL,	1,	NULL,	NULL,	NULL,	0,	8,	'2024-09-06 13:36:42',	'2024-09-27 01:31:58',	'<h4><strong>TELEFON AKTİVASYON İ&Ccedil;İN TALİMATLAR:</strong></h4>\r\n<ul>\r\n<li>Lisans anahtarını girdiğinizde aldığınız hata kodu \"0xc004c<strong>008</strong>\" olmalıdır.&nbsp;</li>\r\n<li>Hata ekranını kapatın ve \"&Ccedil;alıştır\" ekranını a&ccedil;ıp SLUI 4 yazın ve enter\'a basın.</li>\r\n<li>Gelen ekrandan b&ouml;lgenizi se&ccedil;erek ilerleyin.</li>\r\n<li>Şimdi ekranda uzun bir sayı dizisi g&ouml;receksiniz.</li>\r\n<li>Ekrandaki numaralardan birini arayarak (212li olanlardan) Microsoft\'un telesekreterine bağlanın ve adımları takip ederek onay kodunuzu alın.</li>\r\n<li>Telesekreterin başka ka&ccedil; cihazda kullanıldı sorusuna 1 demelisiniz.</li>\r\n</ul>',	NULL,	NULL,	NULL,	NULL,	NULL),
(14,	6,	'OEM Windows 10 Home (Online Aktivasyon)',	'oem-windows-10-home-online-aktivasyon',	'Key olarak teslim edilir. Ömür boyudur. 1 gün içerisinde kullanılmalıdır.',	'uploads/products/product_1725725998.webp',	NULL,	NULL,	100.00,	NULL,	NULL,	1,	NULL,	1,	NULL,	NULL,	NULL,	0,	6,	'2024-09-06 13:37:55',	'2024-09-27 01:32:02',	'<ul>\r\n<li>\r\n<h4><strong>ONLINE AKTİVASYON İ&Ccedil;İN TALİMATLAR:</strong></h4>\r\n<ul>\r\n<li>Format veya yeni kurulum sonrası masa&uuml;st&uuml; bilgisayarım sağ tık &ouml;zellikler diyerek aldığınız lisansı girmelisiniz.</li>\r\n<li>Cihazınızın internete bağlı ve g&uuml;ncel olması yeterlidir.</li>\r\n</ul>\r\n</li>\r\n</ul>',	NULL,	NULL,	NULL,	NULL,	NULL),
(15,	6,	'Windows 11 Pro - Retail (Online Aktivasyon)',	'windows-11-pro-retail-online-aktivasyon',	'Key olarak teslim edilir. Ömür boyudur. 1 gün içerisinde kullanılmalıdır.',	'uploads/products/product_1725726043.webp',	NULL,	NULL,	100.00,	NULL,	NULL,	1,	NULL,	1,	NULL,	NULL,	NULL,	0,	5,	'2024-09-06 13:39:06',	'2024-10-10 04:57:35',	'<h4><strong>ONLINE AKTİVASYON İ&Ccedil;İN TALİMATLAR:</strong></h4>\r\n<ul>\r\n<li>Format veya yeni kurulum sonrası masa&uuml;st&uuml; bilgisayarım sağ tık &ouml;zellikler diyerek aldığınız lisansı girmelisiniz.</li>\r\n<li>Cihazınızın internete bağlı ve g&uuml;ncel olması yeterlidir.</li>\r\n</ul>',	NULL,	NULL,	NULL,	NULL,	NULL),
(16,	6,	'Windows 11 Pro - Retail (Telefon Aktivasyon)',	'windows-11-pro-retail-telefon-aktivasyon',	'Key olarak teslim edilir. Ömür boyudur. 1 gün içerisinde kullanılmalıdır.',	'uploads/products/product_1725726010.webp',	NULL,	NULL,	40.00,	NULL,	NULL,	1,	NULL,	1,	NULL,	NULL,	NULL,	0,	10,	'2024-09-06 13:39:56',	'2024-10-02 09:29:23',	'<h4><strong>TELEFON AKTİVASYON İ&Ccedil;İN TALİMATLAR:</strong></h4>\r\n<ul>\r\n<li>Lisans anahtarını girdiğinizde aldığınız hata kodu \"0xc004c<strong>008</strong>\" olmalıdır.&nbsp;</li>\r\n<li>Hata ekranını kapatın ve \"&Ccedil;alıştır\" ekranını a&ccedil;ıp SLUI 4 yazın ve enter\'a basın.</li>\r\n<li>Gelen ekrandan b&ouml;lgenizi se&ccedil;erek ilerleyin.</li>\r\n<li>Şimdi ekranda uzun bir sayı dizisi g&ouml;receksiniz.</li>\r\n<li>Ekrandaki numaralardan birini arayarak (212li olanlardan) Microsoft\'un telesekreterine bağlanın ve adımları takip ederek onay kodunuzu alın.</li>\r\n<li>Telesekreterin başka ka&ccedil; cihazda kullanıldı sorusuna 1 demelisiniz.</li>\r\n</ul>',	NULL,	NULL,	NULL,	NULL,	NULL),
(17,	6,	'OEM Windows 10 Pro (Online Aktivasyon)',	'oem-windows-10-pro-online-aktivasyon',	'Key olarak teslim edilir. Ömür boyudur. 1 gün içerisinde kullanılmalıdır.',	'uploads/products/product_1725726058.webp',	NULL,	NULL,	110.00,	NULL,	NULL,	1,	NULL,	1,	NULL,	NULL,	NULL,	0,	7,	'2024-09-06 13:41:22',	'2024-09-29 12:24:15',	'<h4><strong>ONLINE AKTİVASYON İ&Ccedil;İN TALİMATLAR:</strong></h4>\r\n<ul>\r\n<li>Format veya yeni kurulum sonrası masa&uuml;st&uuml; bilgisayarım sağ tık &ouml;zellikler diyerek aldığınız lisansı girmelisiniz.</li>\r\n<li>Cihazınızın internete bağlı ve g&uuml;ncel olması yeterlidir.</li>\r\n</ul>',	NULL,	NULL,	NULL,	NULL,	NULL),
(18,	6,	'Windows 10 Pro - Retail (Online Aktivasyon)',	'windows-10-pro-retail-online-aktivasyon',	'Key olarak teslim edilir. Ömür boyudur. 1 gün içerisinde kullanılmalıdır.',	'uploads/products/product_1725726080.webp',	NULL,	NULL,	100.00,	NULL,	NULL,	1,	NULL,	1,	NULL,	NULL,	NULL,	0,	5,	'2024-09-06 13:42:05',	'2024-09-27 01:32:05',	'<h4><strong>ONLINE AKTİVASYON İ&Ccedil;İN TALİMATLAR:</strong></h4>\r\n<ul>\r\n<li>Format veya yeni kurulum sonrası masa&uuml;st&uuml; bilgisayarım sağ tık &ouml;zellikler diyerek aldığınız lisansı girmelisiniz.</li>\r\n<li>Cihazınızın internete bağlı ve g&uuml;ncel olması yeterlidir.</li>\r\n</ul>',	NULL,	NULL,	NULL,	NULL,	NULL),
(19,	6,	'OEM Windows 11 Home (Online Aktivasyon)',	'oem-windows-11-home-online-aktivasyon',	'Key olarak teslim edilir. Ömür boyudur. 1 gün içerisinde kullanılmalıdır.',	'uploads/products/product_1725726129.webp',	NULL,	NULL,	100.00,	NULL,	NULL,	1,	NULL,	1,	NULL,	NULL,	NULL,	0,	5,	'2024-09-06 13:44:41',	'2024-10-14 16:40:58',	'<h4><strong>ONLINE AKTİVASYON İ&Ccedil;İN TALİMATLAR:</strong></h4>\r\n<ul>\r\n<li>Format veya yeni kurulum sonrası masa&uuml;st&uuml; bilgisayarım sağ tık &ouml;zellikler diyerek aldığınız lisansı girmelisiniz.</li>\r\n<li>Cihazınızın internete bağlı ve g&uuml;ncel olması yeterlidir.</li>\r\n</ul>',	NULL,	NULL,	NULL,	NULL,	NULL),
(20,	6,	'Windows 11 Home - Retail (Telefon Aktivasyon)',	'windows-11-home-retail-telefon-aktivasyon',	'Key olarak teslim edilir. Ömür boyudur. 1 gün içerisinde kullanılmalıdır.',	'uploads/products/product_1725726095.webp',	NULL,	NULL,	40.00,	NULL,	NULL,	1,	NULL,	1,	NULL,	NULL,	NULL,	0,	18,	'2024-09-06 13:45:28',	'2024-10-14 04:31:00',	'<h4><strong>TELEFON AKTİVASYON İ&Ccedil;İN TALİMATLAR:</strong></h4>\r\n<ul>\r\n<li>Lisans anahtarını girdiğinizde aldığınız hata kodu \"0xc004c<strong>008</strong>\" olmalıdır.&nbsp;</li>\r\n<li>Hata ekranını kapatın ve \"&Ccedil;alıştır\" ekranını a&ccedil;ıp SLUI 4 yazın ve enter\'a basın.</li>\r\n<li>Gelen ekrandan b&ouml;lgenizi se&ccedil;erek ilerleyin.</li>\r\n<li>Şimdi ekranda uzun bir sayı dizisi g&ouml;receksiniz.</li>\r\n<li>Ekrandaki numaralardan birini arayarak (212li olanlardan) Microsoft\'un telesekreterine bağlanın ve adımları takip ederek onay kodunuzu alın.</li>\r\n<li>Telesekreterin başka ka&ccedil; cihazda kullanıldı sorusuna 1 demelisiniz.</li>\r\n</ul>',	NULL,	NULL,	NULL,	NULL,	NULL),
(21,	6,	'Windows 10 Pro - Retail (Telefon Aktivasyon)',	'windows-10-pro-retail-telefon-aktivasyon',	'Key olarak teslim edilir. Ömür boyudur. 1 gün içerisinde kullanılmalıdır.',	'uploads/products/product_1725725881.webp',	NULL,	NULL,	40.00,	NULL,	NULL,	1,	NULL,	1,	NULL,	NULL,	NULL,	0,	14,	'2024-09-06 13:46:12',	'2024-10-06 06:43:27',	'<h4><strong>TELEFON AKTİVASYON İ&Ccedil;İN TALİMATLAR:</strong></h4>\r\n<ul>\r\n<li>Lisans anahtarını girdiğinizde aldığınız hata kodu \"0xc004c<strong>008</strong>\" olmalıdır.&nbsp;</li>\r\n<li>Hata ekranını kapatın ve \"&Ccedil;alıştır\" ekranını a&ccedil;ıp SLUI 4 yazın ve enter\'a basın.</li>\r\n<li>Gelen ekrandan b&ouml;lgenizi se&ccedil;erek ilerleyin.</li>\r\n<li>Şimdi ekranda uzun bir sayı dizisi g&ouml;receksiniz.</li>\r\n<li>Ekrandaki numaralardan birini arayarak (212li olanlardan) Microsoft\'un telesekreterine bağlanın ve adımları takip ederek onay kodunuzu alın.</li>\r\n<li>Telesekreterin başka ka&ccedil; cihazda kullanıldı sorusuna 1 demelisiniz.</li>\r\n</ul>',	NULL,	NULL,	NULL,	NULL,	NULL),
(22,	6,	'OEM Windows 11 Pro (Online Aktivasyon)',	'oem-windows-11-pro-online-aktivasyon',	'Key olarak teslim edilir. Ömür boyudur. 1 gün içerisinde kullanılmalıdır.',	'uploads/products/product_1725726116.webp',	NULL,	NULL,	100.00,	NULL,	NULL,	1,	NULL,	1,	NULL,	NULL,	NULL,	0,	9,	'2024-09-06 13:47:03',	'2024-10-02 04:46:10',	'<h4><strong>ONLINE AKTİVASYON İ&Ccedil;İN TALİMATLAR:</strong></h4>\r\n<ul>\r\n<li>Format veya yeni kurulum sonrası masa&uuml;st&uuml; bilgisayarım sağ tık &ouml;zellikler diyerek aldığınız lisansı girmelisiniz.</li>\r\n<li>Cihazınızın internete bağlı ve g&uuml;ncel olması yeterlidir.</li>\r\n</ul>',	NULL,	NULL,	NULL,	NULL,	NULL),
(23,	7,	'Office 2021 Pro Plus - Retail (Telefon Aktivasyon)',	'office-2021-pro-plus-retail-telefon-aktivasyon',	'Key olarak teslim edilir. Ömür boyudur. 1 gün içerisinde kullanılmalıdır.',	'uploads/products/product_1725725936.webp',	NULL,	NULL,	110.00,	NULL,	NULL,	1,	NULL,	1,	NULL,	NULL,	NULL,	0,	6,	'2024-09-06 13:48:27',	'2024-10-14 09:14:43',	'<p><strong>Office 2021 Pro Plus İndirme Linki:</strong></p>\r\n<p><a href=\"https://officecdn.microsoft.com/db/492350f6-3a01-4f97-b9c0-c7c6ddf67d60/media/tr-tr/ProPlus2021Retail.img\">https://officecdn.microsoft.com/db/492350f6-3a01-4f97-b9c0-c7c6ddf67d60/media/tr-tr/ProPlus2021Retail.img</a></p>\r\n<p>&nbsp;</p>\r\n<p><strong>Kurulum D&ouml;k&uuml;mantasyonu</strong></p>\r\n<ul>\r\n<li>Kurulum tamamlandıktan office uygulamasını a&ccedil;ın ve karşınıza gelen ekrana keyi girin.</li>\r\n<li>Sonra karşınıza gelen aktivasyon sayfasında *Telefon ile Aktivasyonu* se&ccedil;erek ileri diyelim.</li>\r\n<li>Gelen ekrandan b&ouml;lgenizi se&ccedil;erek ilerleyin.</li>\r\n<li>Şimdi ekranda uzun bir sayı dizisi g&ouml;receksiniz.</li>\r\n<li>Ekrandaki numaralardan birini arayarak (+90 212 375 50 18) Microsoft\'un telesekreterine bağlanın ve adımları takip ederek onay kodunuzu alın.</li>\r\n<li>Aldığınız onay kodunu ekranınızdaki boş kutucuklara girin ve işlemi tamamlayın.</li>\r\n</ul>\r\n<p>Dikkat:</p>\r\n<ul>\r\n<li>Telesekreterin başka ka&ccedil; cihazda kullanıldı sorusuna 1 demelisiniz.</li>\r\n<li>T&Uuml;M OFFICE S&Uuml;R&Uuml;MLERİNİ KALDIRIP TEMİZ KURULUM YAPMAZSANIZ LİSANS &Ccedil;ALIŞMAZ.</li>\r\n</ul>',	NULL,	NULL,	NULL,	NULL,	NULL),
(24,	7,	'Office 365 - Windows & Mac',	'office-365-windows-mac',	'32 & 64 bit uyumludur. ONE DRİVE İçermez. İlk giriş garantilidir, harici garanti verilmez.',	'uploads/products/product_1725725839.webp',	NULL,	NULL,	90.00,	NULL,	NULL,	1,	NULL,	1,	NULL,	NULL,	NULL,	0,	12,	'2024-09-06 13:49:15',	'2024-10-09 19:29:40',	'<section class=\"py-3\">\r\n<div class=\"container\">\r\n<div class=\"row\">\r\n<div class=\"col-lg-12\">\r\n<div class=\"card border-0 shadow-sm rounded-4\">\r\n<div class=\"card-body\">\r\n<div class=\"tab-content\" id=\"nav-tabContent\">\r\n<div class=\"tab-pane fade show active\" id=\"nav-home\" role=\"tabpanel\" aria-labelledby=\"nav-home-tab\" tabindex=\"0\">\r\n<ul>\r\n<li>İlk olarak www.office.com\'a gidin.</li>\r\n<li>Teslim aldığınız mail adresi-parola ile giriş yapın.</li>\r\n<li>İlk girişte yeni parola belirlemeniz gerekmektedir.</li>\r\n<li>Giriş sonrası sağ &uuml;st k&ouml;şede Office Uygulamasını Y&uuml;kleyin butonuna basın.</li>\r\n<li>Kurduktan sonra uygulamadan satın aldığınız hesap ile giriş yapın.</li>\r\n<li>Parolanızı not almayı unutmayınız.</li>\r\n<li>Hesaba giriş yaptıktan sonra ekranınıza gelen Authenticator\'u aktif edebilirsiniz, bu hesabınızın g&uuml;venliğini artırır.</li>\r\n<li>Talimatları takip etmeden direkt uygulamadan giriş yapmayı denerseniz hesap kilitlenebilir. Talimatları takip ediniz.</li>\r\n</ul>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</section>',	NULL,	NULL,	NULL,	NULL,	NULL),
(25,	7,	'Office 2019 Full Sürüm / Pro Plus',	'office-2019-full-surum-pro-plus',	'Satın almadan önce mutlaka Açıklama kısmını okuyun.',	'uploads/products/product_1725725921.webp',	NULL,	NULL,	100.00,	NULL,	NULL,	1,	NULL,	1,	NULL,	NULL,	NULL,	0,	9,	'2024-09-06 13:51:11',	'2024-10-14 23:54:26',	'<p><span>🔸 Not kısmına istediğinizi yazabilirsiniz. Sipariş verildikten sonra 12 saat i&ccedil;inde mail yoluyla teslim edilir.</span></p>\r\n<p><span>🔸 Kullanım s&uuml;resi sınırsızdır.</span><br><span>🔸 Lisans Key ile teslim edilir</span><br><span>🔸 Format sonrası kullanılmaz.</span><br><span>🔸 Tek cihazda kullanım&nbsp;imkanı&nbsp;verir</span><br><span>🔸İndirme Linki ; https://setup.office.com/?omkt=tr-tr</span><br><br><span>NOT: Kurulum yapmadan &ouml;nce bilgisayarınızda bulunan diğer office s&uuml;r&uuml;mlerini kaldırın ardından indirdiğiniz office s&uuml;r&uuml;m&uuml;n&uuml; y&uuml;kleyin. Y&uuml;kleme tamamlandıktan sonra boş bir word dosyası a&ccedil;ın karşınıza &ccedil;ıkan b&ouml;l&uuml;mden telefon aktivasyonu diyip &ccedil;ıkan rakamları 0212 375 50 18 \'i arayarak onay almanız&nbsp;gerekmektedir.</span></p>',	NULL,	NULL,	NULL,	NULL,	NULL),
(26,	7,	'Office 2016 Full Sürüm / Pro Plus',	'office-2016-full-surum-pro-plus',	'Satın almadan önce mutlaka Açıklama kısmını okuyun.',	'uploads/products/product_1725725897.webp',	NULL,	NULL,	90.00,	NULL,	NULL,	1,	NULL,	1,	NULL,	NULL,	NULL,	0,	11,	'2024-09-06 13:51:47',	'2024-10-09 21:25:03',	'<p><span>🔸 Not kısmına istediğinizi yazabilirsiniz. Sipariş verildikten sonra 12 saat i&ccedil;inde mail yoluyla teslim edilir.</span></p>\r\n<p><span>🔸 Kullanım s&uuml;resi sınırsızdır.</span><br><span>🔸 Lisans Key ile teslim edilir</span><br><span>🔸 Format sonrası kullanılmaz.</span><br><span>🔸 Tek cihazda kullanım&nbsp;imkanı&nbsp;verir</span><br><span>🔸İndirme Linki ; https://setup.office.com/?omkt=tr-tr</span><br><br><span>NOT: Kurulum yapmadan &ouml;nce bilgisayarınızda bulunan diğer office s&uuml;r&uuml;mlerini kaldırın ardından indirdiğiniz office s&uuml;r&uuml;m&uuml;n&uuml; y&uuml;kleyin. Y&uuml;kleme tamamlandıktan sonra boş bir word dosyası a&ccedil;ın karşınıza &ccedil;ıkan b&ouml;l&uuml;mden telefon aktivasyonu diyip &ccedil;ıkan rakamları 0212 375 50 18 \'i arayarak onay almanız&nbsp;gerekmektedir.</span></p>',	NULL,	NULL,	NULL,	NULL,	NULL),
(27,	8,	'Kaspersky Premium Total Security',	'kaspersky-premium-total-security',	'1 yıllıktır. Tek cihaz içindir. (330-365 gün arası net kullanım) 3 gün içerisinde indirilmelidir.',	NULL,	NULL,	NULL,	150.00,	NULL,	NULL,	1,	NULL,	1,	NULL,	NULL,	NULL,	0,	8,	'2024-09-06 14:56:25',	'2024-10-05 18:07:45',	'<p>Şunlarla uyumludur: Windows - macOS - Android - iOS</p>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li>Mailinize gelen bağlantıyı kullanarak indirme sağlayın.</li>\r\n<li>Aynı mail ile kaspersky oturumunuzu a&ccedil;ın.</li>\r\n<li>Program direkt lisanslı başlayacaktır.</li>\r\n</ul>\r\n<p><strong>DİKKAT:</strong></p>\r\n<ul>\r\n<li>Aynı maille başka bir cihazda oturum a&ccedil;mayın.</li>\r\n<li>A&ccedil;manız durumunda lisans k&ouml;t&uuml;ye kullanım olarak algılanır.</li>\r\n<li>Sistemde aynı maille birden fazla oturum a&ccedil;ıldığı g&ouml;r&uuml;l&uuml;rse lisans banlanır.</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p>Bayiye Notlar:</p>\r\n<p>Mobil cihazdan a&ccedil;ılan oturumlar ikinci cihaz sayılır.</p>\r\n<p>VPN y&uuml;klenen ve kullanılan oturumlar ikinci cihaz sayılır.</p>\r\n<p>&Uuml;r&uuml;n sadece T&uuml;rkiyede ge&ccedil;erlidir. Farklı &uuml;lkeden aktif etmek isteyenler VPN\'den TR lokasyon ile yapabilir.</p>',	NULL,	NULL,	NULL,	NULL,	NULL),
(28,	11,	'Couple website kişiye özel',	'couple-website-kisiye-ozel',	'Satın aldıktan sonra whatsapptan iletişime geçilecektir. iletişime geçtikten sonra 1-2 saat içerisinde teslim edilir.',	'uploads/products/product_1725978032.webp',	'[\"uploads\\/products\\/sliders\\/slider_1725922689.webp\",\"uploads\\/products\\/sliders\\/slider_1725922689.webp\",\"uploads\\/products\\/sliders\\/slider_1725922689.webp\",\"uploads\\/products\\/sliders\\/slider_1725922690.webp\",\"uploads\\/products\\/sliders\\/slider_1725922690.webp\",\"uploads\\/products\\/sliders\\/slider_1725922691.webp\",\"uploads\\/products\\/sliders\\/slider_1725922691.webp\"]',	NULL,	150.00,	NULL,	NULL,	1,	NULL,	1,	NULL,	NULL,	NULL,	0,	58,	'2024-09-06 20:51:01',	'2024-10-14 22:52:35',	'<p style=\"text-align: center;\">Sende sevgilini, arkadaşını, dostunu bir kahve fiyatına mutlu etmek istemez misin?</p>\r\n<p style=\"text-align: center;\">Kişiseltirebileceğin kişiye &ouml;zel websitesi</p>\r\n<p style=\"text-align: center;\">Satın almadan &ouml;nce Mutlaka Oku!!</p>\r\n<p style=\"text-align: center;\">Satın alırken telefon numaranızı kesinlikle doğru yazmanız gerekmektedir.(site i&ccedil;in kullanılacak fotoğrafları, metinleri oradan alıyoruz.)</p>\r\n<p style=\"text-align: center;\">not kısmına istediğinizi yazabilirsiniz.</p>\r\n<p style=\"text-align: center;\">sayfaların kalıcılığı 1 ay s&uuml;rer. 1 ay sonra kapatılır.</p>\r\n<p style=\"text-align: center;\">link(istediğiniz_isim.strotik.net)</p>\r\n<p style=\"text-align: center;\"></p>\r\n<p style=\"text-align: center;\"><iframe width=\"478\" height=\"849\" src=\"https://www.youtube.com/embed/U0ge6QzDVO0\" title=\"couple websitesi tanıtım\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen=\"allowfullscreen\"></iframe></p>',	NULL,	NULL,	NULL,	NULL,	NULL),
(30,	10,	'AjansV1 Ajans sitesi',	'ajansv1-ajans-sitesi-',	'Kaliteli script hizmeti.',	'uploads/products/product_1725732572.webp',	'[\"uploads\\/products\\/sliders\\/slider_1725732572.webp\",\"uploads\\/products\\/sliders\\/slider_1725732572.webp\",\"uploads\\/products\\/sliders\\/slider_1725732573.webp\"]',	NULL,	150.00,	NULL,	NULL,	1,	'905519368150',	1,	'https://ajans1.strotik.net/',	'https://ajans1.strotik.net/admin/giris-yap.php',	NULL,	0,	27,	'2024-09-07 21:09:34',	'2024-10-15 17:35:17',	'<p>A&ccedil;ık kaynak script şeklinde satılır.<br>satın aldıktan sonra mailinize dosya iletilir.<br>mailinize gelen dosyayı indirip kurulumu yapabilirsiniz.</p>',	'uploads/files/product_#1725732573.zip',	NULL,	NULL,	NULL,	NULL),
(31,	10,	'AjansV2 Ajans sitesi',	'ajansv2-ajans-sitesi-',	'Satın aldığınızda .zip olarak teslim edilir.',	'uploads/products/product_1725740111.webp',	'[\"uploads\\/products\\/sliders\\/slider_1725740111.webp\",\"uploads\\/products\\/sliders\\/slider_1725740111.webp\",\"uploads\\/products\\/sliders\\/slider_1725740112.webp\"]',	NULL,	150.00,	NULL,	NULL,	1,	'905519368150',	1,	'https://ajans2.strotik.net/',	'https://ajans2.strotik.net/admin/login.php',	NULL,	0,	17,	'2024-09-07 23:15:12',	'2024-10-15 08:29:40',	NULL,	'uploads/files/product_#1725740155AjansV2.zip',	NULL,	NULL,	NULL,	NULL),
(32,	10,	'BlogV1 Blog teması (Açık Kaynak)',	'blogv1-blog-temasi-acik-kaynak',	'Kaliteli script hizmeti.',	'uploads/products/product_1725970153.webp',	NULL,	NULL,	150.00,	NULL,	NULL,	1,	'905519368150',	1,	'https://blog1.strotik.net/',	'https://blog1.strotik.net/admin',	NULL,	0,	84,	'2024-09-09 01:08:37',	'2024-10-15 23:23:04',	'<p><span>A&ccedil;ık kaynak script şeklinde satılır.</span><br><span>satın aldıktan sonra mailinize dosya iletilir.</span><br><span>mailinize gelen dosyayı indirip kurulumu yapabilirsiniz.</span></p>',	NULL,	NULL,	NULL,	NULL,	NULL),
(33,	10,	'BlogV2 Blog teması (Açık Kaynak)',	'blogv2-blog-temasi-acik-kaynak',	'demo adreslerine girmeden önce açıklama kısmına bakınız.',	'uploads/products/product_1725970644.webp',	NULL,	NULL,	150.00,	NULL,	NULL,	1,	'905519368150',	1,	'https://blog2.strotik.net/',	'https://blog2.strotik.net/admin/giris.php',	NULL,	0,	69,	'2024-09-10 15:17:24',	'2024-10-15 18:15:48',	'<p>admin paneli i&ccedil;in<br>e-posta:&nbsp;<a href=\"mailto:demo@demo.com\">demo@demo.com</a>&nbsp;<br>şifre: demo</p>\r\n<p><span>A&ccedil;ık kaynak script şeklinde satılır.</span><br><span>satın aldıktan sonra mailinize dosya iletilir.</span><br><span>mailinize gelen dosyayı indirip kurulumu yapabilirsiniz.</span></p>',	NULL,	NULL,	NULL,	NULL,	NULL),
(34,	10,	'E-pin / Lisans / Dijital Ürün Satış Scripti (Açık Kaynak)',	'e-pin-lisans-dijital-urun-satis-scripti-acik-kaynak',	'demo adreslerine girmeden önce açıklama kısmına bakınız.',	'uploads/products/product_1725971832.webp',	NULL,	NULL,	150.00,	NULL,	NULL,	1,	'905519368150',	1,	'https://epin.strotik.net/',	'https://epin.strotik.net/admin',	NULL,	0,	109,	'2024-09-10 15:37:13',	'2024-10-15 18:08:12',	'<p>admin panel i&ccedil;in;<br>e-posta:&nbsp;<a href=\"mailto:admin@hotmail.com\">admin@hotmail.com</a><br>şifre: <a href=\"mailto:admin@hotmail.com\">admin@hotmail.com</a></p>\r\n<p></p>\r\n<p><span>A&ccedil;ık kaynak script şeklinde satılır.</span><br><span>satın aldıktan sonra mailinize dosya iletilir.</span><br><span>mailinize gelen dosyayı indirip kurulumu yapabilirsiniz.</span></p>',	NULL,	NULL,	NULL,	NULL,	NULL),
(35,	11,	'Wordpress (Blog&Kişisel) websitesi',	'wordpress-blogkisisel-websitesi',	'Satın almadan önce açıklama kısmını okuyunuz.',	'uploads/products/product_1725977817.webp',	NULL,	NULL,	1500.00,	NULL,	NULL,	1,	NULL,	1,	NULL,	NULL,	NULL,	0,	18,	'2024-09-10 17:16:58',	'2024-10-15 12:39:40',	'<table xmlns=\"http://www.w3.org/1999/xhtml\" cellspacing=\"0\" cellpadding=\"0\" dir=\"ltr\" border=\"1\" data-sheets-root=\"1\" data-sheets-baot=\"1\" style=\"width: 12.0867%; height: 345.859px; margin-left: auto; margin-right: auto;\"><colgroup><col width=\"211\" style=\"width: 100%;\"></colgroup>\r\n<tbody>\r\n<tr style=\"height: 44.7812px;\">\r\n<td style=\"text-align: center; height: 44.7812px;\">Wordpress (Blog&amp;Kişisel) websitesi</td>\r\n</tr>\r\n<tr style=\"height: 22.3906px;\">\r\n<td style=\"height: 22.3906px;\">Wordpress Kurulumu</td>\r\n</tr>\r\n<tr style=\"height: 22.3906px;\">\r\n<td style=\"height: 22.3906px;\">SSL kurulumu</td>\r\n</tr>\r\n<tr style=\"height: 22.3906px;\">\r\n<td style=\"height: 22.3906px;\">Hositnger altyapısı</td>\r\n</tr>\r\n<tr style=\"height: 22.3906px;\">\r\n<td style=\"height: 22.3906px;\">1 yıllık domain</td>\r\n</tr>\r\n<tr style=\"height: 22.3906px;\">\r\n<td style=\"height: 22.3906px;\">1 yıllık hosting</td>\r\n</tr>\r\n<tr style=\"height: 22.3906px;\">\r\n<td style=\"height: 22.3906px;\">&Uuml;cretli Tema kurulumu</td>\r\n</tr>\r\n<tr style=\"height: 22.3906px;\">\r\n<td style=\"height: 22.3906px;\">Tema T&uuml;rk&ccedil;eleştirme</td>\r\n</tr>\r\n<tr style=\"height: 22.3906px;\">\r\n<td style=\"height: 22.3906px;\">%100 Mobil uyumlu</td>\r\n</tr>\r\n<tr style=\"height: 22.3906px;\">\r\n<td style=\"height: 22.3906px;\">&Uuml;cretli Eklenti kurulumu</td>\r\n</tr>\r\n<tr style=\"height: 22.3906px;\">\r\n<td style=\"height: 22.3906px;\">SEO ayarları</td>\r\n</tr>\r\n<tr style=\"height: 22.3906px;\">\r\n<td style=\"height: 22.3906px;\">Google Analytics Kurulumu</td>\r\n</tr>\r\n<tr style=\"height: 22.3906px;\">\r\n<td style=\"height: 22.3906px;\">3 G&uuml;n i&ccedil;erisinde Teslim</td>\r\n</tr>\r\n<tr style=\"height: 22.3906px;\">\r\n<td style=\"height: 22.3906px;\">1 Ay Teknik Destek</td>\r\n</tr>\r\n<tr style=\"height: 10px;\">\r\n<td style=\"height: 10px;\"></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p></p>\r\n<p>İstediğiniz Alan adını Not kısmında belirtiniz. &ouml;ncesinde <a href=\"https://www.hostinger.com.tr/domain-sorgulama\">linke tıklayıp&nbsp;</a> alan adı kontrol&uuml;n&uuml; yapınız.</p>\r\n<p>satın alma işlemi sonrası whatshapptan iletişime ge&ccedil;ilecektir. Site tasarımı, İstediğiniz D&uuml;zen şekli oradan ayarlanacaktır.&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n<p></p>\r\n<p><span>&Uuml;cretli Tema se&ccedil;enekleri:</span><br><br><br></p>\r\n<ul>\r\n<li>Blocksy<span>&nbsp;</span><a rel=\"nofollow noopener noreferrer ugc\" href=\"https://www.r10.net/yonlendir/?adres=https%3A%2F%2Fstartersites.io%2Fblocksy%2Fe-bike%2F&amp;token=395636cd462a25bfe6cf827fc87e698f\" target=\"_blank\">demo</a></li>\r\n<li>Kadence Pro<span>&nbsp;</span><a rel=\"nofollow noopener noreferrer ugc\" href=\"https://www.r10.net/yonlendir/?adres=https%3A%2F%2Fwww.kadencewp.com%2F&amp;token=c81328fb11c5ce622d81faf18618615a\" target=\"_blank\">demo</a></li>\r\n<li>Zakra<span>&nbsp;</span><a rel=\"nofollow noopener noreferrer ugc\" href=\"https://www.r10.net/yonlendir/?adres=https%3A%2F%2Fzakratheme.com%2Fstarter-sites%2F%23%2F&amp;token=2514859629faba8abd1594fb6628aa8b\" target=\"_blank\">demo</a></li>\r\n<li>Divi<span>&nbsp;</span><a rel=\"nofollow noopener noreferrer ugc\" href=\"https://www.r10.net/yonlendir/?adres=https%3A%2F%2Fdivi.express%2Fhome-page-layouts%2F&amp;token=d3a8dc71422e94c3a7624e2c46075f62\" target=\"_blank\">demo</a></li>\r\n<li>Neve Pro<span>&nbsp;</span><a rel=\"nofollow noopener noreferrer ugc\" href=\"https://www.r10.net/yonlendir/?adres=https%3A%2F%2Fthemeisle.com%2Fthemes%2Fneve%2F%3Fgad_source%3D1%26gclid%3DCjwKCAjw3P-2BhAEEiwA3yPhwKMQmyrFHQchSOSTjxOsQZz2MxJ0FnSZMNnRkg98vnlO-oDYQNWS6BoCi1wQAvD_BwE&amp;token=4db9208f2fcf55559ea7fad81cc13280\" target=\"_blank\">demo</a></li>\r\n<li>Bricks<span>&nbsp;</span><a rel=\"nofollow noopener noreferrer ugc\" href=\"https://www.r10.net/yonlendir/?adres=https%3A%2F%2Fpreview.themeforest.net%2Fitem%2Fbrick-a-contemporary-multipurpose-theme%2Ffull_screen_preview%2F11051623%3F_ga%3D2.141681778.132777799.1725976011-970263437.1725479759%26_gac%3D1.160632399.1725976154.CjwKCAjw3P-2BhAEEiwA3yPhwPuoPhFS4ellKcOuOVdk8oL8wi1_93KYeHBxPpdAbajrq82wBKhSWRoCjh4QAvD_BwE&amp;token=18be4ef63093fff16d994e15a4accac1\" target=\"_blank\">demo</a></li>\r\n<li>Pinnacle Pro<span>&nbsp;</span><a rel=\"nofollow noopener noreferrer ugc\" href=\"https://www.r10.net/yonlendir/?adres=https%3A%2F%2Fwww.kadencewp.com%2Fproduct%2Fpinnacle-premium-wordpress-theme%2F&amp;token=d76a677d59604a8149b73d881b620b65\" target=\"_blank\">demo</a></li>\r\n<li>GeneratePress<span>&nbsp;</span><a rel=\"nofollow noopener noreferrer ugc\" href=\"https://www.r10.net/yonlendir/?adres=https%3A%2F%2Fwordpress.org%2Fthemes%2Fgeneratepress%2Fpreview%2F&amp;token=30ec0c0c63d3fb178a971caadc66e911\" target=\"_blank\">demo</a></li>\r\n<li>Ascend Pro<span>&nbsp;</span><a rel=\"nofollow noopener noreferrer ugc\" href=\"https://www.r10.net/yonlendir/?adres=https%3A%2F%2Fdemos.kadencewp.com%2Fascend-premium%2F&amp;token=f18e161933d12c5b2915d955e0a06b5c\" target=\"_blank\">demo</a></li>\r\n<li>Astra<span>&nbsp;</span><a rel=\"nofollow noopener noreferrer ugc\" href=\"https://www.r10.net/yonlendir/?adres=https%3A%2F%2Fwordpress.org%2Fthemes%2Fastra%2Fpreview%2F&amp;token=df8d4e31c6f42c057fe8c7b81bf32685\" target=\"_blank\">demo</a></li>\r\n</ul>',	NULL,	NULL,	NULL,	NULL,	NULL),
(36,	11,	'Wordpress (E-ticaret) websitesi',	'wordpress-e-ticaret-websitesi',	'Satın almadan önce açıklama kısmını okuyunuz.',	'uploads/products/product_1725981355.webp',	NULL,	NULL,	1750.00,	NULL,	NULL,	1,	'905519368150',	1,	NULL,	NULL,	NULL,	0,	10,	'2024-09-10 18:15:55',	'2024-10-04 07:34:00',	'<table xmlns=\"http://www.w3.org/1999/xhtml\" cellspacing=\"0\" cellpadding=\"0\" dir=\"ltr\" border=\"1\" data-sheets-root=\"1\" data-sheets-baot=\"1\" style=\"width: 12.4857%; height: 450.188px;\">\r\n<tbody>\r\n<tr style=\"height: 23.6875px;\">\r\n<td style=\"width: 98.8799%; height: 23.6875px;\">Wordpress (E-ticaret) websitesi</td>\r\n</tr>\r\n<tr style=\"height: 23.6875px;\">\r\n<td style=\"width: 98.8799%; height: 23.6875px;\">Wordpress Kurulumu</td>\r\n</tr>\r\n<tr style=\"height: 23.6875px;\">\r\n<td style=\"width: 98.8799%; height: 23.6875px;\">SSL kurulumu</td>\r\n</tr>\r\n<tr style=\"height: 23.6875px;\">\r\n<td style=\"width: 98.8799%; height: 23.6875px;\">Hositnger altyapısı</td>\r\n</tr>\r\n<tr style=\"height: 23.6875px;\">\r\n<td style=\"width: 98.8799%; height: 23.6875px;\">1 yıllık domain</td>\r\n</tr>\r\n<tr style=\"height: 23.6875px;\">\r\n<td style=\"width: 98.8799%; height: 23.6875px;\">1 yıllık hosting</td>\r\n</tr>\r\n<tr style=\"height: 23.6875px;\">\r\n<td style=\"width: 98.8799%; height: 23.6875px;\">&Uuml;cretli Tema kurulumu</td>\r\n</tr>\r\n<tr style=\"height: 23.6875px;\">\r\n<td style=\"width: 98.8799%; height: 23.6875px;\">Tema T&uuml;rk&ccedil;eleştirme</td>\r\n</tr>\r\n<tr style=\"height: 23.6875px;\">\r\n<td style=\"width: 98.8799%; height: 23.6875px;\">%100 Mobil uyumlu</td>\r\n</tr>\r\n<tr style=\"height: 23.6875px;\">\r\n<td style=\"width: 98.8799%; height: 23.6875px;\">Woocommerce Kurulumu</td>\r\n</tr>\r\n<tr style=\"height: 23.6875px;\">\r\n<td style=\"width: 98.8799%; height: 23.6875px;\">Sanal Pos Entegrasyonu</td>\r\n</tr>\r\n<tr style=\"height: 23.6875px;\">\r\n<td style=\"width: 98.8799%; height: 23.6875px;\">Kargo Takip Mod&uuml;l&uuml;</td>\r\n</tr>\r\n<tr style=\"height: 23.6875px;\">\r\n<td style=\"width: 98.8799%; height: 23.6875px;\">3 &Ouml;rnek &Uuml;r&uuml;n girişi</td>\r\n</tr>\r\n<tr style=\"height: 23.6875px;\">\r\n<td style=\"width: 98.8799%; height: 23.6875px;\">&Uuml;cretli Eklenti kurulumu</td>\r\n</tr>\r\n<tr style=\"height: 23.6875px;\">\r\n<td style=\"width: 98.8799%; height: 23.6875px;\">SEO ayarları</td>\r\n</tr>\r\n<tr style=\"height: 23.6875px;\">\r\n<td style=\"width: 98.8799%; height: 23.6875px;\">Google Analytics Kurulumu</td>\r\n</tr>\r\n<tr style=\"height: 23.6875px;\">\r\n<td style=\"width: 98.8799%; height: 23.6875px;\">3 G&uuml;n i&ccedil;erisinde Teslim</td>\r\n</tr>\r\n<tr style=\"height: 23.8125px;\">\r\n<td style=\"width: 98.8799%; height: 23.8125px;\">1 Ay Teknik Destek</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p></p>\r\n<p>İstediğiniz Alan adını Not kısmında belirtiniz. &ouml;ncesinde<span>&nbsp;</span><a href=\"https://www.hostinger.com.tr/domain-sorgulama\">linke tıklayıp&nbsp;</a><span>&nbsp;</span>alan adı kontrol&uuml;n&uuml; yapınız.</p>\r\n<p>satın alma işlemi sonrası whatshapptan iletişime ge&ccedil;ilecektir. Site tasarımı, İstediğiniz D&uuml;zen şekli oradan ayarlanacaktır.&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n<p></p>\r\n<p><span>&Uuml;cretli Tema se&ccedil;enekleri:</span><br><br><br></p>\r\n<ul>\r\n<li>Blocksy<span>&nbsp;</span><a rel=\"nofollow noopener noreferrer ugc\" href=\"https://www.r10.net/yonlendir/?adres=https%3A%2F%2Fstartersites.io%2Fblocksy%2Fe-bike%2F&amp;token=395636cd462a25bfe6cf827fc87e698f\" target=\"_blank\">demo</a></li>\r\n<li>Kadence Pro<span>&nbsp;</span><a rel=\"nofollow noopener noreferrer ugc\" href=\"https://www.r10.net/yonlendir/?adres=https%3A%2F%2Fwww.kadencewp.com%2F&amp;token=c81328fb11c5ce622d81faf18618615a\" target=\"_blank\">demo</a></li>\r\n<li>Zakra<span>&nbsp;</span><a rel=\"nofollow noopener noreferrer ugc\" href=\"https://www.r10.net/yonlendir/?adres=https%3A%2F%2Fzakratheme.com%2Fstarter-sites%2F%23%2F&amp;token=2514859629faba8abd1594fb6628aa8b\" target=\"_blank\">demo</a></li>\r\n<li>Divi<span>&nbsp;</span><a rel=\"nofollow noopener noreferrer ugc\" href=\"https://www.r10.net/yonlendir/?adres=https%3A%2F%2Fdivi.express%2Fhome-page-layouts%2F&amp;token=d3a8dc71422e94c3a7624e2c46075f62\" target=\"_blank\">demo</a></li>\r\n<li>Neve Pro<span>&nbsp;</span><a rel=\"nofollow noopener noreferrer ugc\" href=\"https://www.r10.net/yonlendir/?adres=https%3A%2F%2Fthemeisle.com%2Fthemes%2Fneve%2F%3Fgad_source%3D1%26gclid%3DCjwKCAjw3P-2BhAEEiwA3yPhwKMQmyrFHQchSOSTjxOsQZz2MxJ0FnSZMNnRkg98vnlO-oDYQNWS6BoCi1wQAvD_BwE&amp;token=4db9208f2fcf55559ea7fad81cc13280\" target=\"_blank\">demo</a></li>\r\n<li>Bricks<span>&nbsp;</span><a rel=\"nofollow noopener noreferrer ugc\" href=\"https://www.r10.net/yonlendir/?adres=https%3A%2F%2Fpreview.themeforest.net%2Fitem%2Fbrick-a-contemporary-multipurpose-theme%2Ffull_screen_preview%2F11051623%3F_ga%3D2.141681778.132777799.1725976011-970263437.1725479759%26_gac%3D1.160632399.1725976154.CjwKCAjw3P-2BhAEEiwA3yPhwPuoPhFS4ellKcOuOVdk8oL8wi1_93KYeHBxPpdAbajrq82wBKhSWRoCjh4QAvD_BwE&amp;token=18be4ef63093fff16d994e15a4accac1\" target=\"_blank\">demo</a></li>\r\n<li>Pinnacle Pro<span>&nbsp;</span><a rel=\"nofollow noopener noreferrer ugc\" href=\"https://www.r10.net/yonlendir/?adres=https%3A%2F%2Fwww.kadencewp.com%2Fproduct%2Fpinnacle-premium-wordpress-theme%2F&amp;token=d76a677d59604a8149b73d881b620b65\" target=\"_blank\">demo</a></li>\r\n<li>GeneratePress<span>&nbsp;</span><a rel=\"nofollow noopener noreferrer ugc\" href=\"https://www.r10.net/yonlendir/?adres=https%3A%2F%2Fwordpress.org%2Fthemes%2Fgeneratepress%2Fpreview%2F&amp;token=30ec0c0c63d3fb178a971caadc66e911\" target=\"_blank\">demo</a></li>\r\n<li>Ascend Pro<span>&nbsp;</span><a rel=\"nofollow noopener noreferrer ugc\" href=\"https://www.r10.net/yonlendir/?adres=https%3A%2F%2Fdemos.kadencewp.com%2Fascend-premium%2F&amp;token=f18e161933d12c5b2915d955e0a06b5c\" target=\"_blank\">demo</a></li>\r\n<li>Astra<span>&nbsp;</span><a rel=\"nofollow noopener noreferrer ugc\" href=\"https://www.r10.net/yonlendir/?adres=https%3A%2F%2Fwordpress.org%2Fthemes%2Fastra%2Fpreview%2F&amp;token=df8d4e31c6f42c057fe8c7b81bf32685\" target=\"_blank\">demo</a></li>\r\n</ul>',	NULL,	NULL,	NULL,	NULL,	NULL),
(37,	11,	'Wordpress (Kurumsal) websitesi',	'wordpress-kurumsal-websitesi',	'Satın almadan önce açıklama kısmını okuyunuz.',	'uploads/products/product_1725981528.webp',	NULL,	NULL,	1499.00,	NULL,	NULL,	1,	'905519368150',	1,	NULL,	NULL,	NULL,	0,	9,	'2024-09-10 18:18:49',	'2024-09-27 19:49:02',	'<table xmlns=\"http://www.w3.org/1999/xhtml\" cellspacing=\"0\" cellpadding=\"0\" dir=\"ltr\" border=\"1\" data-sheets-root=\"1\" data-sheets-baot=\"1\" style=\"width: 12.0867%; height: 345.859px; margin-left: auto; margin-right: auto;\">\r\n<tbody>\r\n<tr style=\"height: 44.7812px;\">\r\n<td style=\"text-align: center; height: 44.7812px;\"><span data-sheets-root=\"1\">Wordpress (Kurumsal) websitesi</span></td>\r\n</tr>\r\n<tr style=\"height: 22.3906px;\">\r\n<td style=\"height: 22.3906px;\">Wordpress Kurulumu</td>\r\n</tr>\r\n<tr style=\"height: 22.3906px;\">\r\n<td style=\"height: 22.3906px;\">SSL kurulumu</td>\r\n</tr>\r\n<tr style=\"height: 22.3906px;\">\r\n<td style=\"height: 22.3906px;\">Hositnger altyapısı</td>\r\n</tr>\r\n<tr style=\"height: 22.3906px;\">\r\n<td style=\"height: 22.3906px;\">1 yıllık domain</td>\r\n</tr>\r\n<tr style=\"height: 22.3906px;\">\r\n<td style=\"height: 22.3906px;\">1 yıllık hosting</td>\r\n</tr>\r\n<tr style=\"height: 22.3906px;\">\r\n<td style=\"height: 22.3906px;\">&Uuml;cretli Tema kurulumu</td>\r\n</tr>\r\n<tr style=\"height: 22.3906px;\">\r\n<td style=\"height: 22.3906px;\">Tema T&uuml;rk&ccedil;eleştirme</td>\r\n</tr>\r\n<tr style=\"height: 22.3906px;\">\r\n<td style=\"height: 22.3906px;\">%100 Mobil uyumlu</td>\r\n</tr>\r\n<tr style=\"height: 22.3906px;\">\r\n<td style=\"height: 22.3906px;\">&Uuml;cretli Eklenti kurulumu</td>\r\n</tr>\r\n<tr style=\"height: 22.3906px;\">\r\n<td style=\"height: 22.3906px;\">SEO ayarları</td>\r\n</tr>\r\n<tr style=\"height: 22.3906px;\">\r\n<td style=\"height: 22.3906px;\">Google Analytics Kurulumu</td>\r\n</tr>\r\n<tr style=\"height: 22.3906px;\">\r\n<td style=\"height: 22.3906px;\">3 G&uuml;n i&ccedil;erisinde Teslim</td>\r\n</tr>\r\n<tr style=\"height: 22.3906px;\">\r\n<td style=\"height: 22.3906px;\">1 Ay Teknik Destek</td>\r\n</tr>\r\n<tr style=\"height: 10px;\">\r\n<td style=\"height: 10px;\"></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>İstediğiniz Alan adını Not kısmında belirtiniz. &ouml;ncesinde<span>&nbsp;</span><a href=\"https://www.hostinger.com.tr/domain-sorgulama\">linke tıklayıp&nbsp;</a><span>&nbsp;</span>alan adı kontrol&uuml;n&uuml; yapınız.</p>\r\n<p>satın alma işlemi sonrası whatshapptan iletişime ge&ccedil;ilecektir. Site tasarımı, İstediğiniz D&uuml;zen şekli oradan ayarlanacaktır.&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n<p></p>\r\n<p><span>&Uuml;cretli Tema se&ccedil;enekleri:</span><br><br><br></p>\r\n<ul>\r\n<li>Blocksy<span>&nbsp;</span><a rel=\"nofollow noopener noreferrer ugc\" href=\"https://www.r10.net/yonlendir/?adres=https%3A%2F%2Fstartersites.io%2Fblocksy%2Fe-bike%2F&amp;token=395636cd462a25bfe6cf827fc87e698f\" target=\"_blank\">demo</a></li>\r\n<li>Kadence Pro<span>&nbsp;</span><a rel=\"nofollow noopener noreferrer ugc\" href=\"https://www.r10.net/yonlendir/?adres=https%3A%2F%2Fwww.kadencewp.com%2F&amp;token=c81328fb11c5ce622d81faf18618615a\" target=\"_blank\">demo</a></li>\r\n<li>Zakra<span>&nbsp;</span><a rel=\"nofollow noopener noreferrer ugc\" href=\"https://www.r10.net/yonlendir/?adres=https%3A%2F%2Fzakratheme.com%2Fstarter-sites%2F%23%2F&amp;token=2514859629faba8abd1594fb6628aa8b\" target=\"_blank\">demo</a></li>\r\n<li>Divi<span>&nbsp;</span><a rel=\"nofollow noopener noreferrer ugc\" href=\"https://www.r10.net/yonlendir/?adres=https%3A%2F%2Fdivi.express%2Fhome-page-layouts%2F&amp;token=d3a8dc71422e94c3a7624e2c46075f62\" target=\"_blank\">demo</a></li>\r\n<li>Neve Pro<span>&nbsp;</span><a rel=\"nofollow noopener noreferrer ugc\" href=\"https://www.r10.net/yonlendir/?adres=https%3A%2F%2Fthemeisle.com%2Fthemes%2Fneve%2F%3Fgad_source%3D1%26gclid%3DCjwKCAjw3P-2BhAEEiwA3yPhwKMQmyrFHQchSOSTjxOsQZz2MxJ0FnSZMNnRkg98vnlO-oDYQNWS6BoCi1wQAvD_BwE&amp;token=4db9208f2fcf55559ea7fad81cc13280\" target=\"_blank\">demo</a></li>\r\n<li>Bricks<span>&nbsp;</span><a rel=\"nofollow noopener noreferrer ugc\" href=\"https://www.r10.net/yonlendir/?adres=https%3A%2F%2Fpreview.themeforest.net%2Fitem%2Fbrick-a-contemporary-multipurpose-theme%2Ffull_screen_preview%2F11051623%3F_ga%3D2.141681778.132777799.1725976011-970263437.1725479759%26_gac%3D1.160632399.1725976154.CjwKCAjw3P-2BhAEEiwA3yPhwPuoPhFS4ellKcOuOVdk8oL8wi1_93KYeHBxPpdAbajrq82wBKhSWRoCjh4QAvD_BwE&amp;token=18be4ef63093fff16d994e15a4accac1\" target=\"_blank\">demo</a></li>\r\n<li>Pinnacle Pro<span>&nbsp;</span><a rel=\"nofollow noopener noreferrer ugc\" href=\"https://www.r10.net/yonlendir/?adres=https%3A%2F%2Fwww.kadencewp.com%2Fproduct%2Fpinnacle-premium-wordpress-theme%2F&amp;token=d76a677d59604a8149b73d881b620b65\" target=\"_blank\">demo</a></li>\r\n<li>GeneratePress<span>&nbsp;</span><a rel=\"nofollow noopener noreferrer ugc\" href=\"https://www.r10.net/yonlendir/?adres=https%3A%2F%2Fwordpress.org%2Fthemes%2Fgeneratepress%2Fpreview%2F&amp;token=30ec0c0c63d3fb178a971caadc66e911\" target=\"_blank\">demo</a></li>\r\n<li>Ascend Pro<span>&nbsp;</span><a rel=\"nofollow noopener noreferrer ugc\" href=\"https://www.r10.net/yonlendir/?adres=https%3A%2F%2Fdemos.kadencewp.com%2Fascend-premium%2F&amp;token=f18e161933d12c5b2915d955e0a06b5c\" target=\"_blank\">demo</a></li>\r\n<li>Astra<span>&nbsp;</span><a rel=\"nofollow noopener noreferrer ugc\" href=\"https://www.r10.net/yonlendir/?adres=https%3A%2F%2Fwordpress.org%2Fthemes%2Fastra%2Fpreview%2F&amp;token=df8d4e31c6f42c057fe8c7b81bf32685\" target=\"_blank\">demo</a></li>\r\n</ul>',	NULL,	NULL,	NULL,	NULL,	NULL),
(38,	12,	'İçerik arşivi - 15.000+ video arşivi',	'icerik-arsivi-15000-video-arsivi',	'Satın almadan önce açıklama kısmını okuyunuz.',	'uploads/products/product_1726282497.webp',	NULL,	NULL,	200.00,	NULL,	NULL,	1,	'905519368150',	1,	NULL,	NULL,	NULL,	0,	15,	'2024-09-14 05:54:57',	'2024-09-29 11:14:55',	'<p>Satın alma işleminden sonra direkt olarak siparişler b&ouml;l&uuml;m&uuml;nden arşivi indirebilirsiniz, ya da google drive yoluyla istediğiniz gibi kullanabilirsiniz.</p>',	NULL,	'https://drive.google.com/drive/u/0/folders/1JXLrateZt4otkBlfTyAQADUmz--34nh2',	NULL,	NULL,	NULL),
(39,	12,	'+1000 Viral  Video Arşivi',	'1000-viral-video-arsivi',	'Senin hikayen de duyulmayı hak ediyor. Senin için viral videoları derledik. Hadi, sesin milyonlara ulaşsın!',	'uploads/products/product_1726282736.webp',	NULL,	NULL,	250.00,	NULL,	NULL,	1,	NULL,	1,	NULL,	NULL,	NULL,	0,	409,	'2024-09-14 05:58:57',	'2024-10-10 22:16:02',	'<div parenttag=\"Col\" class=\"FskSZsdmmfYK\">\r\n<div class=\"gp-flex\">\r\n<h2 data-gp-text=\"\" class=\"[&amp;_p]:gp-inline [&amp;_p]:after:gp-whitespace-pre-wrap [&amp;_p]:after:gp-content-[\'\\A\'] gp-text\">+1000 Viral Video<br>G&uuml;nl&uuml;k olarak g&uuml;ncellenir!</h2>\r\n</div>\r\n</div>\r\n<div parenttag=\"Col\" class=\"dwNUaAswEBlx\">\r\n<div class=\"gp-flex\">\r\n<div data-gp-text=\"\" class=\"[&amp;_p]:gp-inline [&amp;_p]:after:gp-whitespace-pre-wrap [&amp;_p]:after:gp-content-[\'\\A\'] gp-text\">\r\n<p>ŞİMDİDEN 800 MİLYONDAN FAZLA G&Ouml;R&Uuml;NT&Uuml;LEMEYE SAHİP OLAN VİRAL KANCALAR, ŞUNLAR İ&Ccedil;İN M&Uuml;KEMMEL</p>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"gCJENSUucE\">\r\n<div class=\"gp-flex\">\r\n<div class=\"gp-inline-flex gp-flex-col\">\r\n<div class=\"gp-icon-list-wrapper gp-flex\">\r\n<div class=\"gp-icon-list-icon gp-inline-flex gp-shrink-0 gp-overflow-hidden\">Videoları Viral Yapın</div>\r\n</div>\r\n<div class=\"gp-icon-list-wrapper gp-flex\">\r\n<div class=\"gp-icon-list-icon gp-inline-flex gp-shrink-0 gp-overflow-hidden\">Reklamlarda Fark Edilin</div>\r\n</div>\r\n<div class=\"gp-icon-list-wrapper gp-flex\">\r\n<div class=\"gp-icon-list-icon gp-inline-flex gp-shrink-0 gp-overflow-hidden\">Instagram ve TikTok\'ta Takip&ccedil;i Kazanın</div>\r\n</div>\r\n<div class=\"gp-icon-list-wrapper gp-flex\">\r\n<div class=\"gp-icon-list-icon gp-inline-flex gp-shrink-0 gp-overflow-hidden\">Etkileşimi Arttırın</div>\r\n</div>\r\n<div class=\"gp-icon-list-wrapper gp-flex\">\r\n<div class=\"gp-icon-list-icon gp-inline-flex gp-shrink-0 gp-overflow-hidden\">TikTok\'ta Viral Olun</div>\r\n<div class=\"gp-icon-list-icon gp-inline-flex gp-shrink-0 gp-overflow-hidden\">İNDİR VE KULLANMAYA BAŞLA!</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>',	NULL,	NULL,	NULL,	NULL,	NULL),
(40,	12,	'Dijital Ajans Kurma Eğitimi',	'dijital-ajans-kurma-egitimi',	'not kısmına mailinizi girmeyi unutmayın.',	'uploads/products/product_1727351007.webp',	NULL,	NULL,	300.00,	NULL,	NULL,	1,	NULL,	1,	NULL,	NULL,	NULL,	0,	14,	'2024-09-26 14:43:27',	'2024-10-15 12:39:44',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL);

DROP TABLE IF EXISTS `product_properties`;
CREATE TABLE `product_properties` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `img` varchar(300) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `product_stocks`;
CREATE TABLE `product_stocks` (
  `id` bigint(21) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(21) unsigned DEFAULT NULL,
  `product_id` bigint(21) unsigned DEFAULT NULL,
  `content` varchar(2000) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `product_stocks` (`id`, `user_id`, `product_id`, `content`, `created_at`, `updated_at`) VALUES
(27,	3,	1,	'1',	'2024-09-05 14:46:18',	'2024-09-05 14:46:18'),
(28,	3,	1,	'2',	'2024-09-05 14:46:18',	'2024-09-05 14:46:18'),
(29,	3,	1,	'3',	'2024-09-05 14:46:18',	'2024-09-05 14:46:18'),
(30,	3,	1,	'4',	'2024-09-05 14:46:18',	'2024-09-05 14:46:18'),
(31,	3,	1,	'5',	'2024-09-05 14:46:18',	'2024-09-05 14:46:18'),
(32,	3,	1,	'6',	'2024-09-05 14:46:18',	'2024-09-05 14:46:18'),
(33,	3,	1,	'7',	'2024-09-05 14:46:18',	'2024-09-05 14:46:18'),
(34,	3,	1,	'8',	'2024-09-05 14:46:18',	'2024-09-05 14:46:18'),
(35,	3,	1,	'9',	'2024-09-05 14:46:18',	'2024-09-05 14:46:18'),
(36,	3,	1,	'1',	'2024-09-05 14:46:18',	'2024-09-05 14:46:18'),
(37,	3,	1,	'1',	'2024-09-05 14:46:18',	'2024-09-05 14:46:18'),
(38,	3,	1,	'1',	'2024-09-05 14:46:18',	'2024-09-05 14:46:18'),
(39,	3,	1,	'1',	'2024-09-05 14:46:18',	'2024-09-05 14:46:18'),
(40,	3,	1,	'1',	'2024-09-05 14:46:18',	'2024-09-05 14:46:18'),
(41,	3,	1,	'1',	'2024-09-05 14:46:18',	'2024-09-05 14:46:18'),
(42,	3,	1,	'1',	'2024-09-05 14:46:18',	'2024-09-05 14:46:18'),
(43,	3,	1,	'1',	'2024-09-05 14:46:18',	'2024-09-05 14:46:18'),
(44,	3,	1,	'1',	'2024-09-05 14:46:18',	'2024-09-05 14:46:18'),
(45,	3,	1,	'11',	'2024-09-05 14:46:18',	'2024-09-05 14:46:18'),
(46,	3,	1,	'1',	'2024-09-05 14:46:18',	'2024-09-05 14:46:18'),
(47,	3,	1,	'1',	'2024-09-05 14:46:18',	'2024-09-05 14:46:18'),
(48,	3,	1,	'1',	'2024-09-05 14:46:18',	'2024-09-05 14:46:18'),
(49,	3,	1,	'1',	'2024-09-05 14:46:18',	'2024-09-05 14:46:18'),
(50,	3,	1,	'1',	'2024-09-05 14:46:18',	'2024-09-05 14:46:18'),
(51,	3,	1,	'1',	'2024-09-05 14:46:18',	'2024-09-05 14:46:18'),
(52,	3,	1,	'1',	'2024-09-05 14:46:18',	'2024-09-05 14:46:18');

DROP TABLE IF EXISTS `sliders`;
CREATE TABLE `sliders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `img` varchar(300) DEFAULT NULL,
  `url` varchar(300) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `stories`;
CREATE TABLE `stories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  `img` varchar(300) NOT NULL,
  `url` varchar(300) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `phone` varchar(25) NOT NULL DEFAULT '000000000',
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `ip` varchar(255) DEFAULT NULL,
  `ban` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `wallet` decimal(10,2) NOT NULL DEFAULT 0.00,
  `google_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `surname`, `phone`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `ip`, `ban`, `wallet`, `google_id`) VALUES
(1,	'Admin',	NULL,	'000000000',	'admin@admin.com',	NULL,	'$2a$12$DKEOZSrr/iIFq64SHgjPMu620.zwUufJZONxyOxsreSo/VoKAIfMm',	NULL,	'2023-01-17 11:41:24',	'2023-01-17 11:41:24',	1,	NULL,	0,	0.00,	NULL),
(3,	'kaan',	'tiftik',	'05360603666',	'km.tftk@gmail.com',	NULL,	'$2y$10$GcAz2sRwoKfjKviBksRYAexMean0BFuLTTmVEv.v6L2WOUT.dZkJ2',	'cZNyZpymkYORfaDueRvca3ZrXGrIGCoS5z2qPw6zXZCmQem2PKers93ypK50',	'2023-01-17 11:41:24',	'2024-09-20 17:09:29',	1,	'78.191.91.99',	0,	0.00,	NULL),
(4,	'Yusuf Bülbül',	NULL,	'000000000',	'bulbulyusuf12@gmail.com',	NULL,	'$2y$10$G9pb84OCobTCelg5Aix9S.6FbAkzd92LZOaabIXM5uXILZERgN8q2',	NULL,	'2024-09-11 18:12:27',	'2024-09-11 18:12:27',	0,	NULL,	0,	0.00,	NULL),
(5,	'WilliamJeamb',	NULL,	'000000000',	'eee666@rambler.ru',	NULL,	'$2y$10$M7gn/46hwl2YUlXC43wp6OimlBmLEFnGfVLPxEyakRLkE56rWqkdS',	NULL,	'2024-09-25 04:06:09',	'2024-09-25 04:06:09',	0,	NULL,	0,	0.00,	NULL),
(6,	'gorridaJeamb',	NULL,	'000000000',	'dmtest005@rambler.ru',	NULL,	'$2y$10$FeP9m1ezshIVPyQPZNivROGQedlbL/g7hLiVMHAreoL5mNdTVaz4K',	NULL,	'2024-09-26 11:25:30',	'2024-09-26 11:25:30',	0,	NULL,	0,	0.00,	NULL),
(7,	'fernnostiJeamb',	NULL,	'000000000',	'l2test004@rambler.ru',	NULL,	'$2y$10$kDQZGvTUNB/r.6OdnkAWXekFzXY5I6o1BxMLQ6tSA1OIC87hvWFym',	NULL,	'2024-09-27 00:02:42',	'2024-09-27 00:02:42',	0,	NULL,	0,	0.00,	NULL),
(8,	'fuTdvHWVl',	NULL,	'000000000',	'hudsoosv24@gmail.com',	NULL,	'$2y$10$SfRbkREZr49vsWu5VTfOsuHeMqBlAf1ApPJ/dF6uX0EXA5aBzd2gK',	NULL,	'2024-10-02 15:52:02',	'2024-10-02 15:52:02',	0,	NULL,	0,	0.00,	NULL),
(9,	'SUhOPgwxIZtT',	NULL,	'000000000',	'maksvellwhitneyv1994@gmail.com',	NULL,	'$2y$10$IFJAiwGnfOEB10bHt5DVBO7vH2fzRqtwA3j4TmaQ/YEDzNFyRG1WS',	NULL,	'2024-10-05 04:46:14',	'2024-10-05 04:46:14',	0,	NULL,	0,	0.00,	NULL);

-- 2024-10-15 22:13:31
