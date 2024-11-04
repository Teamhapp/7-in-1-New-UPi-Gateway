-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 19, 2024 at 07:55 AM
-- Server version: 10.11.9-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u990442797_vinay`
--

-- --------------------------------------------------------

--
-- Table structure for table `api_settings`
--

CREATE TABLE `api_settings` (
  `id` int(11) NOT NULL,
  `whatsapp_api_url` varchar(255) NOT NULL,
  `sender_id` varchar(50) NOT NULL,
  `api_key` varchar(100) NOT NULL,
  `sender_email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `api_settings`
--

INSERT INTO `api_settings` (`id`, `whatsapp_api_url`, `sender_id`, `api_key`, `sender_email`) VALUES
(1, 'web.imb.org.in', '1234567890', 'XIsLeipb3l8JJJYH94YCgkG3oOKLNt', 'support@onopay.in');

-- --------------------------------------------------------

--
-- Table structure for table `bharatpe_tokens`
--

CREATE TABLE `bharatpe_tokens` (
  `id` int(11) NOT NULL,
  `user_token` longtext DEFAULT NULL,
  `phoneNumber` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `cookie` text DEFAULT NULL,
  `merchantId` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(255) DEFAULT 'Deactive',
  `Upiid` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `callback_report`
--

CREATE TABLE `callback_report` (
  `id` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `request_url` longtext NOT NULL,
  `response` longtext NOT NULL,
  `user_token` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `freecharge_token`
--

CREATE TABLE `freecharge_token` (
  `id` int(11) NOT NULL,
  `phoneNumber` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `user_token` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `app_fc` text CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `Upiid` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `status` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `user_id` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `googlepay_tokens`
--

CREATE TABLE `googlepay_tokens` (
  `id` int(12) NOT NULL,
  `user_token` longtext DEFAULT NULL,
  `phoneNumber` varchar(255) DEFAULT NULL,
  `Instance_Id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(255) DEFAULT 'Deactive',
  `Upiid` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `googlepay_transactions`
--

CREATE TABLE `googlepay_transactions` (
  `id` int(11) NOT NULL,
  `user_token` longtext DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `utr` bigint(20) DEFAULT NULL,
  `user_id` int(12) DEFAULT NULL,
  `paymentTimestamp` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hdfc`
--

CREATE TABLE `hdfc` (
  `id` int(11) NOT NULL,
  `number` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `seassion` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `device_id` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `user_token` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pin` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `upi_hdfc` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `UPI` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tidlist` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `mobile` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `user_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mobikwik_token`
--

CREATE TABLE `mobikwik_token` (
  `id` int(11) NOT NULL,
  `user_token` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `phoneNumber` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `Authorization` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `merchant_upi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `date` timestamp NULL DEFAULT current_timestamp(),
  `status` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT 'Deactive',
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_id` mediumtext NOT NULL,
  `user_token` longtext NOT NULL,
  `status` text NOT NULL,
  `amount` int(11) NOT NULL,
  `utr` longtext NOT NULL,
  `plan_id` longtext NOT NULL,
  `customer_name` longtext DEFAULT NULL,
  `customer_mobile` longtext NOT NULL,
  `redirect_url` longtext NOT NULL,
  `remark1` longtext NOT NULL,
  `remark2` longtext NOT NULL,
  `gateway_txn` longtext NOT NULL,
  `method` text NOT NULL,
  `HDFC_TXNID` mediumtext DEFAULT NULL,
  `upiLink` mediumtext DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `byteTransactionId` varchar(255) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `paytm_txn_ref` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_links`
--

CREATE TABLE `payment_links` (
  `id` int(11) NOT NULL,
  `link_token` varchar(255) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paytm_tokens`
--

CREATE TABLE `paytm_tokens` (
  `id` int(11) NOT NULL,
  `user_token` longtext NOT NULL,
  `phoneNumber` varchar(255) DEFAULT NULL,
  `MID` varchar(255) DEFAULT NULL,
  `Upiid` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) DEFAULT 'Deactive',
  `user_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phonepe_tokens`
--

CREATE TABLE `phonepe_tokens` (
  `sl` int(11) NOT NULL,
  `user_token` longtext NOT NULL,
  `phoneNumber` longtext NOT NULL,
  `userId` longtext NOT NULL,
  `token` longtext NOT NULL,
  `refreshToken` longtext NOT NULL,
  `name` text NOT NULL,
  `device_data` longtext NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Deactive',
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `transactionId` mediumtext DEFAULT NULL,
  `status` mediumtext DEFAULT NULL,
  `order_id` mediumtext DEFAULT NULL,
  `vpa` mediumtext DEFAULT NULL,
  `paymentApp` mediumtext DEFAULT NULL,
  `amount` mediumtext DEFAULT NULL,
  `user_token` mediumtext DEFAULT NULL,
  `UTR` mediumtext DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `mobile` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `merchantTransactionId` varchar(255) DEFAULT NULL,
  `transactionNote` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sbi_token`
--

CREATE TABLE `sbi_token` (
  `id` int(11) NOT NULL,
  `phoneNumber` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `merchant_username` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `merchant_session` text CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `merchant_csrftoken` text CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `merchant_token` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `merchant_upi` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `status` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `user_token` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `user_id` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settlement`
--

CREATE TABLE `settlement` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `utr_no` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `remark` text DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `logo_url` varchar(255) NOT NULL,
  `site_link` varchar(255) NOT NULL,
  `whatsapp_number` varchar(20) NOT NULL,
  `copyright_text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `brand_name`, `logo_url`, `site_link`, `whatsapp_number`, `copyright_text`) VALUES
(1, 'OnoPay', 'https://pay.onopay.in/img/hdfc.png', 'https://pay.onopay.in/', '9305872054', 'OnoPay');

-- --------------------------------------------------------

--
-- Table structure for table `store_id`
--

CREATE TABLE `store_id` (
  `sl` int(11) NOT NULL,
  `user_token` longtext NOT NULL,
  `unitId` longtext NOT NULL,
  `roleName` longtext NOT NULL,
  `groupValue` longtext NOT NULL,
  `groupId` longtext NOT NULL,
  `user_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `role` enum('User','Admin','','') NOT NULL DEFAULT 'User',
  `password` varchar(255) NOT NULL,
  `is_otp` enum('YES','NO') NOT NULL,
  `otp` varchar(6) NOT NULL,
  `otp_expiry` datetime NOT NULL,
  `whatsapp_alert` enum('YES','NO') NOT NULL,
  `email_alert` enum('YES','NO') NOT NULL,
  `email` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `pin` varchar(255) NOT NULL,
  `pan` varchar(255) NOT NULL,
  `aadhaar` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `user_token` varchar(255) NOT NULL,
  `expiry` date NOT NULL,
  `callback_url` longtext NOT NULL,
  `bptoken` longtext NOT NULL,
  `upiid` longtext NOT NULL,
  `acc_lock` int(11) NOT NULL DEFAULT 0,
  `acc_ban` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'off',
  `upi_id` mediumtext DEFAULT NULL COMMENT 'This is the UPI ID for PhonePe',
  `phonepe_connected` varchar(3) DEFAULT 'No',
  `hdfc_connected` varchar(3) DEFAULT 'No',
  `paytm_connected` varchar(3) DEFAULT 'No',
  `bharatpe_connected` varchar(3) DEFAULT 'No',
  `googlepay_connected` varchar(3) DEFAULT 'No',
  `mobikwik_connected` enum('Yes','No') NOT NULL DEFAULT 'No',
  `sbi_connected` enum('Yes','No') NOT NULL DEFAULT 'No',
  `freecharge_connected` enum('Yes','No') NOT NULL DEFAULT 'No',
  `amazonpay_connected` varchar(3) DEFAULT 'No',
  `instance_id` varchar(255) DEFAULT NULL,
  `instance_secret` varchar(255) DEFAULT NULL,
  `fixed_navbar` varchar(50) DEFAULT NULL,
  `fixed_layout` varchar(50) DEFAULT NULL,
  `sidebar_layout` varchar(50) DEFAULT NULL,
  `box_style` varchar(50) DEFAULT NULL,
  `theme_color` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `mobile`, `role`, `password`, `is_otp`, `otp`, `otp_expiry`, `whatsapp_alert`, `email_alert`, `email`, `company`, `pin`, `pan`, `aadhaar`, `location`, `user_token`, `expiry`, `callback_url`, `bptoken`, `upiid`, `acc_lock`, `acc_ban`, `upi_id`, `phonepe_connected`, `hdfc_connected`, `paytm_connected`, `bharatpe_connected`, `googlepay_connected`, `mobikwik_connected`, `sbi_connected`, `freecharge_connected`, `amazonpay_connected`, `instance_id`, `instance_secret`, `fixed_navbar`, `fixed_layout`, `sidebar_layout`, `box_style`, `theme_color`) VALUES
(162, 'OnoPay', '1122334455', 'Admin', '$2y$10$zDwsjbq.AHVWa9jOQjnj2u.r./GR3a37DtyUYvEWPlVFKmEZ36IbC', 'NO', '668164', '2024-09-30 09:52:02', 'YES', 'YES', 'admin@ggmail.com', 'sunpay', '234557', 'FGHIU5432Q', '987654321021', 'ttrr', '3b5a65c28184fb285ab2751307c8908c', '2034-10-01', '', '', '', 0, 'off', NULL, 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'ISFPZhiUZ9721689543', NULL, NULL, NULL, NULL, NULL, 'purple-light');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `api_settings`
--
ALTER TABLE `api_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bharatpe_tokens`
--
ALTER TABLE `bharatpe_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `callback_report`
--
ALTER TABLE `callback_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `freecharge_token`
--
ALTER TABLE `freecharge_token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `googlepay_tokens`
--
ALTER TABLE `googlepay_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `googlepay_transactions`
--
ALTER TABLE `googlepay_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hdfc`
--
ALTER TABLE `hdfc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mobikwik_token`
--
ALTER TABLE `mobikwik_token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_links`
--
ALTER TABLE `payment_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paytm_tokens`
--
ALTER TABLE `paytm_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phonepe_tokens`
--
ALTER TABLE `phonepe_tokens`
  ADD PRIMARY KEY (`sl`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `merchantTransactionId` (`merchantTransactionId`);

--
-- Indexes for table `sbi_token`
--
ALTER TABLE `sbi_token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settlement`
--
ALTER TABLE `settlement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_id`
--
ALTER TABLE `store_id`
  ADD PRIMARY KEY (`sl`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `api_settings`
--
ALTER TABLE `api_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bharatpe_tokens`
--
ALTER TABLE `bharatpe_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `callback_report`
--
ALTER TABLE `callback_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `freecharge_token`
--
ALTER TABLE `freecharge_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `googlepay_tokens`
--
ALTER TABLE `googlepay_tokens`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `googlepay_transactions`
--
ALTER TABLE `googlepay_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hdfc`
--
ALTER TABLE `hdfc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `mobikwik_token`
--
ALTER TABLE `mobikwik_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=300;

--
-- AUTO_INCREMENT for table `payment_links`
--
ALTER TABLE `payment_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=300;

--
-- AUTO_INCREMENT for table `paytm_tokens`
--
ALTER TABLE `paytm_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `phonepe_tokens`
--
ALTER TABLE `phonepe_tokens`
  MODIFY `sl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `sbi_token`
--
ALTER TABLE `sbi_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `settlement`
--
ALTER TABLE `settlement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `store_id`
--
ALTER TABLE `store_id`
  MODIFY `sl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `settlement`
--
ALTER TABLE `settlement`
  ADD CONSTRAINT `settlement_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
