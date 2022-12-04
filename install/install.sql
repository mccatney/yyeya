-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2019 at 07:52 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 5.6.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gg`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` int(11) NOT NULL,
  `uid` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `action` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `topup_amount` varchar(11) COLLATE utf8_unicode_ci DEFAULT '0',
  `transaction` varchar(14) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `announce`
--

CREATE TABLE `announce` (
  `id` int(11) NOT NULL,
  `html` text COLLATE utf8_unicode_ci NOT NULL,
  `date_create` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `announce`
--

INSERT INTO `announce` (`id`, `html`, `date_create`) VALUES
(5, 'โปรโมชั่นเฉพาะช่วงนี้เท่านั้น เติมเงิน X2 ทุกราคาบัตร ห้ามพลาดดด !!', '15/10/2019 20:42:28');

-- --------------------------------------------------------

--
-- Table structure for table `authme`
--

CREATE TABLE `authme` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `realname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ip` varchar(40) NOT NULL DEFAULT '127.0.0.1',
  `lastlogin` bigint(20) DEFAULT '0',
  `x` double NOT NULL DEFAULT '0',
  `y` double NOT NULL DEFAULT '0',
  `z` double NOT NULL DEFAULT '0',
  `world` varchar(255) DEFAULT 'world',
  `email` varchar(255) DEFAULT 'your@email.com',
  `isLogged` smallint(6) NOT NULL DEFAULT '0',
  `hasSession` smallint(6) NOT NULL DEFAULT '0',
  `points` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `status` enum('member','admin') NOT NULL DEFAULT 'member',
  `rp` varchar(255) NOT NULL DEFAULT '0',
  `topup` double(62,2) NOT NULL DEFAULT '0.00',
  `regdate` bigint(20) NOT NULL DEFAULT '0',
  `regip` varchar(40) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL,
  `yaw` float DEFAULT NULL,
  `pitch` float DEFAULT NULL,
  `topup_m` double(64,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `authme`
--

INSERT INTO `authme` (`id`, `username`, `realname`, `password`, `ip`, `lastlogin`, `x`, `y`, `z`, `world`, `email`, `isLogged`, `hasSession`, `points`, `status`, `rp`, `topup`, `regdate`, `regip`, `yaw`, `pitch`, `topup_m`) VALUES
(1, 'bigonegamer_tv', 'BigoneGamer_tv', '$SHA$ITIf0Taxw7mbshQN$7cfaa64dd12e7d49bac814242da7bc6925683c1aeb54f80df862b3c0154707ed', '223.206.246.29', 1571049334040, 0, 0, 0, 'world', 'bigbaba55yo@gmail.com', 0, 0, '10000', 'admin', '10', 10.00, 1569507293056, '223.206.234.140', NULL, NULL, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `bungeecord`
--

CREATE TABLE `bungeecord` (
  `id` int(11) NOT NULL,
  `name_server` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip_server` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `port` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bungeecord`
--

INSERT INTO `bungeecord` (`id`, `name_server`, `ip_server`, `port`, `password`) VALUES
(1, 'LobbyRank', '104.215.190.129', '25576', 'NewiMC1234');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `download`
--

CREATE TABLE `download` (
  `id` int(11) NOT NULL,
  `mc_download` varchar(255) NOT NULL,
  `ja64_download` varchar(255) NOT NULL,
  `ja32_download` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `gift`
--

CREATE TABLE `gift` (
  `id` int(11) NOT NULL,
  `uid_send` int(11) NOT NULL,
  `uid_receive` int(11) NOT NULL,
  `date` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `command` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `server_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `redeem`
--

CREATE TABLE `redeem` (
  `id` int(11) NOT NULL,
  `code` varchar(256) NOT NULL DEFAULT '@amc',
  `cmd` varchar(256) NOT NULL DEFAULT '9999',
  `status` varchar(256) NOT NULL DEFAULT '0',
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rp`
--

CREATE TABLE `rp` (
  `id` int(11) NOT NULL,
  `rp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rp`
--

INSERT INTO `rp` (`id`, `rp`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 0);

-- --------------------------------------------------------

--
-- Table structure for table `rp_shop`
--

CREATE TABLE `rp_shop` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `price` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `category` int(11) NOT NULL,
  `command` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pic` varchar(1500) COLLATE utf8_unicode_ci NOT NULL,
  `server_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rp_shop`
--

INSERT INTO `rp_shop` (`id`, `name`, `price`, `category`, `command`, `pic`, `server_id`) VALUES
(1, 'TEST', '1000', 0, 'say test', 'http://localhost/SYSTEM-MineScript/BackupV2/images/panda.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `backend_password` varchar(255) NOT NULL,
  `name_server` varchar(255) NOT NULL,
  `www` varchar(255) NOT NULL,
  `youtube_watch` varchar(255) NOT NULL,
  `discord_id` varchar(255) NOT NULL,
  `announce` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `ip_server` varchar(255) NOT NULL,
  `port_server` varchar(255) NOT NULL,
  `version_server` varchar(255) NOT NULL,
  `page_facebook` varchar(255) NOT NULL,
  `detail_server` varchar(255) NOT NULL,
  `max_reg` varchar(255) NOT NULL,
  `query_port` varchar(255) NOT NULL,
  `slash` enum('slash','slash_off') NOT NULL,
  `bg` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `backend_password`, `name_server`, `www`, `youtube_watch`, `discord_id`, `announce`, `icon`, `ip_server`, `port_server`, `version_server`, `page_facebook`, `detail_server`, `max_reg`, `query_port`, `slash`, `bg`) VALUES
(1, 'Bigone2543', 'MineShopSettingMC ระบบร้านค้ามายคราฟ', 'http://192.168.1.2/shop/', '_zE-8T0pY8Y', 'discord_id', '5555', 'http://www.mc-bigonecraft.tk/webshop/images/logo.png', '127.0.0.1', '25565', '1.8 - 1.12', 'https://web.facebook.com/BigoneCraftNetwork/?modal=admin_todo_tour/', 'คำอธิบาย Server', '3', '25565', '', 'http://www.mc-bigonecraft.tk/webshop/img/big.png');

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `price` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `category` int(11) NOT NULL,
  `command` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pic` varchar(1500) COLLATE utf8_unicode_ci NOT NULL,
  `server_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `slide`
--

CREATE TABLE `slide` (
  `id` int(11) NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `truemoney`
--

CREATE TABLE `truemoney` (
  `id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `truemoney`
--

INSERT INTO `truemoney` (`id`, `amount`, `points`) VALUES
(1, 50, 50),
(2, 90, 90),
(3, 150, 150),
(4, 300, 300),
(5, 500, 500),
(6, 1000, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `truewallet_token`
--

CREATE TABLE `truewallet_token` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `truewallet_token`
--

INSERT INTO `truewallet_token` (`id`, `email`, `token`) VALUES
(5, 'bigonecraft@gmail.com', 'f6eb3dd1-51c9-4457-a5cc-fbb02fa900e2');

-- --------------------------------------------------------

--
-- Table structure for table `wallet_account`
--

CREATE TABLE `wallet_account` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mutiple` int(11) NOT NULL DEFAULT '1',
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `reference_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `wallet_account`
--

INSERT INTO `wallet_account` (`id`, `email`, `password`, `phone`, `name`, `mutiple`, `message`, `reference_token`) VALUES
(1, 'test', 'test', '0000000000', 'เอกชัย ไพรินทร์', 2, '0', 'f0b9aba985b8bfc9a27c8b7dd8c4da5d');

-- --------------------------------------------------------

--
-- Table structure for table `wallet_password`
--

CREATE TABLE `wallet_password` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reference_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wallet_password`
--

INSERT INTO `wallet_password` (`id`, `email`, `password`, `reference_token`) VALUES
(2, 'test', 'test', 'f0b9aba985b8bfc9a27c8b7dd8c4da5d');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `announce`
--
ALTER TABLE `announce`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `authme`
--
ALTER TABLE `authme`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `bungeecord`
--
ALTER TABLE `bungeecord`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gift`
--
ALTER TABLE `gift`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `redeem`
--
ALTER TABLE `redeem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rp`
--
ALTER TABLE `rp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rp_shop`
--
ALTER TABLE `rp_shop`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slide`
--
ALTER TABLE `slide`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `truemoney`
--
ALTER TABLE `truemoney`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `truewallet_token`
--
ALTER TABLE `truewallet_token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet_account`
--
ALTER TABLE `wallet_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet_password`
--
ALTER TABLE `wallet_password`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `announce`
--
ALTER TABLE `announce`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `authme`
--
ALTER TABLE `authme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=333;

--
-- AUTO_INCREMENT for table `bungeecord`
--
ALTER TABLE `bungeecord`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gift`
--
ALTER TABLE `gift`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `redeem`
--
ALTER TABLE `redeem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rp`
--
ALTER TABLE `rp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `rp_shop`
--
ALTER TABLE `rp_shop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `slide`
--
ALTER TABLE `slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `truemoney`
--
ALTER TABLE `truemoney`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `truewallet_token`
--
ALTER TABLE `truewallet_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wallet_account`
--
ALTER TABLE `wallet_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wallet_password`
--
ALTER TABLE `wallet_password`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
