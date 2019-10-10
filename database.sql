-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2019 at 06:21 PM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `droidpay`
--

-- --------------------------------------------------------

--
-- Table structure for table `card`
--

CREATE TABLE `card` (
  `card_id` int(11) NOT NULL,
  `card_uid` text NOT NULL,
  `card_no` varchar(256) NOT NULL,
  `card_ref` int(11) NOT NULL,
  `card_created_at` date NOT NULL DEFAULT current_timestamp(),
  `card_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `card`
--

INSERT INTO `card` (`card_id`, `card_uid`, `card_no`, `card_ref`, `card_created_at`, `card_status`) VALUES
(2, 'card11409652', '2222-1111-3333', 1, '2019-08-08', 1),
(12, '89958618', '356954838585', 2, '2019-08-20', 1),
(14, '85210147', '7185-6945-7276', 3, '2019-08-20', 1),
(15, '842517416', '7512-4148-7829', 3, '2019-09-01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `card_pin`
--

CREATE TABLE `card_pin` (
  `card_pin_id` int(11) NOT NULL,
  `card_pin_val` text NOT NULL,
  `card_pin_ref` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `card_pin`
--

INSERT INTO `card_pin` (`card_pin_id`, `card_pin_val`, `card_pin_ref`) VALUES
(1, '51d1cd3a02276948f566e6ea0a7d78cb', 2);

-- --------------------------------------------------------

--
-- Table structure for table `portfolio`
--

CREATE TABLE `portfolio` (
  `portfolio_id` int(11) NOT NULL,
  `portfolio_cat` text NOT NULL,
  `portfolio_title` text NOT NULL,
  `portfolio_desc` text NOT NULL,
  `portfolio_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `portfolio`
--

INSERT INTO `portfolio` (`portfolio_id`, `portfolio_cat`, `portfolio_title`, `portfolio_desc`, `portfolio_image`) VALUES
(3, 'dfg', 'Title', '\r\nfg\r\n\r\n', 'vendor/upload/dfg38d7355701b6f3760ee49852904319c1f33dc5483be5538172f6e326dc2a4266potfolio.jpg'),
(4, 'Title cat', 'Titlwe', '<p>eddweded</p>', 'vendor/upload/Titlwe82cdf1ac62cb48e7478d35a28e9288603b5f4f19719aa9a67efe63169ce94037potfolio.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` int(11) NOT NULL,
  `transaction_amount` varchar(256) NOT NULL,
  `transaction_type` int(11) NOT NULL,
  `transaction_ref` int(11) NOT NULL,
  `transaction_src` text DEFAULT NULL,
  `transaction_date` date NOT NULL,
  `transaction_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `transaction_uid` varchar(512) NOT NULL,
  `transaction_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `transaction_amount`, `transaction_type`, `transaction_ref`, `transaction_src`, `transaction_date`, `transaction_created_at`, `transaction_uid`, `transaction_status`) VALUES
(18, '200', 1, 1, 'RazorPay Paymentpay_D8uL9ArwzJnbGg', '2019-08-22', '2019-08-22 08:14:12', '43915a37aac813879a843707838925a78383', 1),
(19, '200', 1, 1, 'RazorPay Paymentpay_D8uPuMCLLwYMd2', '2019-08-22', '2019-08-22 08:18:42', 'cfba6af8e44b14d5cee4cf393855949c8201', 1),
(20, '200', 1, 1, 'RazorPay Paymentpay_D8uZaFA5zTQUr6', '2019-08-22', '2019-08-22 08:27:52', '0e86c5ceb922ec1631274c7c2c7100f27923', 1),
(21, '200', 1, 1, 'RazorPay Paymentpay_D8urHArCtnpaTd', '2019-08-22', '2019-08-22 08:44:35', 'ad1cdc460988bcd9990d4b7f841978b61377', 1),
(22, '20', 1, 1, 'RazorPay Paymentpay_D8uxj8qeGVk1mq', '2019-08-22', '2019-08-22 08:50:43', '518100a1da2955e80dc5061564fbe5b95862', 1),
(23, '2580', 1, 1, 'RazorPay Paymentpay_D8uygDG2O2Lw1j', '2019-08-22', '2019-08-22 08:51:37', 'bd69bce732e27f21519ef0da66be3d434238', 1),
(24, '200', 1, 1, 'RazorPay Paymentpay_D8v4rDTVU08bab', '2019-08-22', '2019-08-22 08:57:28', '0f86ab199c9c9430e577167cfde6954b8823', 1),
(25, '100', 1, 1, 'RazorPay Paymentpay_D8v5WLNC8KeuS4', '2019-08-22', '2019-08-22 08:58:06', 'eb388e3390f5e97b6fe3cade6500021c5500', 1),
(26, '2580', 1, 1, 'RazorPay Paymentpay_D8v7sKZas4gOIG', '2019-08-22', '2019-08-22 08:59:52', 'ba1d23f8cddde78ce3aa0f4d9051fd697297', 1),
(27, '5000', 1, 1, NULL, '2019-08-22', '2019-08-22 09:00:50', '16eb747e8e3b015c9026722d1c69b5169306', 2),
(28, '2580', 1, 1, NULL, '2019-08-22', '2019-08-22 09:05:24', '13c8475a4d57148ee2bb422245e2246c4205', 2),
(29, '2580', 1, 1, NULL, '2019-08-22', '2019-08-22 11:39:30', '1bcac5983f3926524b3df882b5bf38641386', 2),
(30, '2000', 1, 1, 'RazorPay Paymentpay_D8zQLB3eRaP8dm', '2019-08-22', '2019-08-22 13:12:34', '0d1dac78aa382bbf12c8a7aa36ee709f2039', 1),
(31, '10', 1, 1, 'RazorPay Paymentpay_D8zR6yWiJTw0JS', '2019-08-22', '2019-08-22 13:13:19', '71e820f3e62227874f5564a70696729e6967', 1),
(32, '20', 1, 1, NULL, '2019-08-22', '2019-08-22 15:11:47', 'ce24c84dcafedcf06641a1e2ed76214b1497', 2),
(33, '2580', 1, 1, NULL, '2019-08-22', '2019-08-22 16:06:04', 'efe479e6559412aaff13b980a22ad99c1824', 2),
(34, '100', 1, 1, NULL, '2019-08-22', '2019-08-22 16:06:13', '25720ea24c43d6007e1c58a17e35cd069096', 2),
(35, '20', 1, 1, 'RazorPay Paymentpay_D92OBPsUWZJSdH', '2019-08-22', '2019-08-22 16:06:36', 'f4dd76de7cf48097a69c2df7d2d9f62f6422', 1),
(36, '200', 1, 1, NULL, '2019-08-22', '2019-08-22 17:58:49', '54153ef767144cc531e14f98c08f1df93515', 2),
(37, '1000', 1, 1, 'RazorPay Paymentpay_D94LrOyG78DRC2', '2019-08-22', '2019-08-22 18:00:48', '6c8bd78cc863f5f38cfed0f003cf301e1434', 1),
(38, '2000', 1, 1, 'RazorPay Paymentpay_D94Uhy7My2Xi1i', '2019-08-22', '2019-08-22 18:09:47', 'bd860c0254eca9073330c1b032aa780e3654', 1),
(39, '2580', 1, 1, NULL, '2019-08-22', '2019-08-22 18:18:07', '11a0b86ff07c2a5bc2e2e034977439985641', 2),
(40, '2000', 1, 1, NULL, '2019-08-22', '2019-08-22 18:20:44', 'e646c6098a1c8da49b761b1c251c31059707', 2),
(41, '280', 1, 1, NULL, '2019-08-22', '2019-08-22 19:07:15', 'b8d21035f12dfc41385163c5f12da4536360', 2),
(42, '25', 1, 2, 'From:9835555982 RefFood', '2019-08-23', '2019-08-23 06:26:38', 'd7f426ccbc6db7e235c57958c21c5dfa', 1),
(43, '25', 2, 1, 'To:9835555982 RefFood', '2019-08-23', '2019-08-23 06:26:38', '8819159f9246232ed1299a7414448ab4', 1),
(44, '25', 1, 2, 'From:6204304229 Ref : Food', '2019-08-23', '2019-08-23 06:50:27', '07fc15c9d169ee48573edd749d25945d', 1),
(45, '25', 2, 1, 'To:9835555982 Ref : Food', '2019-08-23', '2019-08-23 06:50:27', '265eceb6d4d961057f1b483a558e2885', 1),
(46, '200', 1, 2, 'From:6204304229 Ref : food', '2019-08-23', '2019-08-23 07:01:18', '0993b7960f34c29b1fdb6516be27046f', 1),
(47, '200', 2, 1, 'To:9835555982 Ref : food', '2019-08-23', '2019-08-23 07:01:18', '83f97f4825290be4cb794ec6a234595f', 1),
(48, '100', 1, 2, 'From:6204304229 Ref : test', '2019-08-23', '2019-08-23 07:03:57', '4c56392b1bd5e94efe423ed048c7b91a', 1),
(49, '100', 2, 1, 'To:9835555982 Ref : test', '2019-08-23', '2019-08-23 07:03:57', '044a23cadb567653eb51d4eb40acaa88', 1),
(50, '1000', 1, 2, 'From:6204304229 Ref : test', '2019-08-23', '2019-08-23 07:04:53', '4589b8b6a21b964025a84f6499070b83', 1),
(51, '1000', 2, 1, 'To:9835555982 Ref : test', '2019-08-23', '2019-08-23 07:04:53', 'ff1d4796fe85a21ba86081db7bf2196b', 1),
(52, '2000', 1, 2, 'From:6204304229 Ref : test', '2019-08-23', '2019-08-23 07:08:45', 'beba25deef966d6816093e38d989b9ca', 1),
(53, '2000', 2, 1, 'To:9835555982 Ref : test', '2019-08-23', '2019-08-23 07:08:45', 'f6a673f09493afcd8b129a0bcf1cd5bc', 1),
(54, '20', 1, 2, 'From:6204304229 Ref : ', '2019-08-23', '2019-08-23 07:11:24', '9af76329c78e28c977ab1bcd1c3fe9b8', 1),
(55, '20', 2, 1, 'To:9835555982 Ref : ', '2019-08-23', '2019-08-23 07:11:24', 'dd111a74f4ff9cf2cbf198cef2579800', 1),
(56, '10', 1, 2, 'From:6204304229 Ref : N/A', '2019-08-23', '2019-08-23 07:13:08', 'de01d76e793fec3fba32f4401a45fb20', 1),
(57, '10', 2, 1, 'To:9835555982 Ref : N/A', '2019-08-23', '2019-08-23 07:13:08', '1f72e258ff730035f2a1fb6637f562c2', 1),
(58, '05', 1, 2, 'From:6204304229 Ref : N/A', '2019-08-23', '2019-08-23 07:14:38', 'a16f3a5bda35f1de87328623f0a1711f', 1),
(59, '05', 2, 1, 'To:9835555982 Ref : N/A', '2019-08-23', '2019-08-23 07:14:38', '2c6a0bae0f071cbbf0bb3d5b11d90a82', 1),
(60, '5000', 1, 2, 'From:6204304229 Ref : N/A', '2019-08-23', '2019-08-23 07:15:32', 'a0dc078ca0d99b5ebb465a9f1cad54ba', 1),
(61, '5000', 2, 1, 'To:9835555982 Ref : N/A', '2019-08-23', '2019-08-23 07:15:32', '4424d2deec2f9468fb61e2db07ecd6b6', 1),
(62, '10', 1, 2, 'From:6204304229 Ref : N/A', '2019-08-23', '2019-08-23 07:16:15', '6e8404c3b93a9527c8db241a1846599a', 1),
(63, '10', 2, 1, 'To:9835555982 Ref : N/A', '2019-08-23', '2019-08-23 07:16:15', '554644c0cc70e64757bfdfe8512f90c6', 1),
(64, '200', 1, 2, 'From:6204304229 Ref : ref', '2019-08-23', '2019-08-23 07:17:13', '29e11dc359bad383e1243f730bdbe032', 1),
(65, '200', 2, 1, 'To:9835555982 Ref : ref', '2019-08-23', '2019-08-23 07:17:13', 'f50c7035e532c49a0f6993d988e2e843', 1),
(66, '2', 1, 2, 'From:6204304229 Ref : N/A', '2019-08-23', '2019-08-23 07:17:59', 'aac933717a429f57c6ca58f32975c597', 1),
(67, '2', 2, 1, 'To:9835555982 Ref : N/A', '2019-08-23', '2019-08-23 07:17:59', 'fb1378d0b80ae44aae0000a3cff0b90f', 1),
(68, '10', 1, 2, 'From:6204304229 Ref : N/A', '2019-08-23', '2019-08-23 11:06:11', '333943ff8a14617d66ea94ec176fc787', 1),
(69, '10', 2, 1, 'To:9835555982 Ref : N/A', '2019-08-23', '2019-08-23 11:06:11', 'ec73a08511f0f15158c830720aee7588', 1),
(70, '5000', 1, 1, NULL, '2019-08-23', '2019-08-23 12:28:51', '750edd84590b1feab369558319634d7c7995', 2),
(71, '1902', 1, 1, NULL, '2019-08-23', '2019-08-23 12:29:58', '7b6cf90187ce61e06c290436de88bb226936', 2),
(72, '1902', 1, 1, 'RazorPay Paymentpay_D9NJEoLdmNDDp2', '2019-08-23', '2019-08-23 12:34:06', '69e61fc016db500f4d3532500c65d8e46883', 1),
(73, '200', 1, 2, 'From:6204304229 Ref : N/A', '2019-08-23', '2019-08-23 12:35:30', '0ee8b85a85a49346fdff9665312a5cc4', 1),
(74, '200', 2, 1, 'To:9835555982 Ref : N/A', '2019-08-23', '2019-08-23 12:35:30', '88fee0421317424e4469f33a48f50cb0', 1),
(75, '200', 1, 1, 'RazorPay Paymentpay_D9NLkFPdt5CxhZ', '2019-08-23', '2019-08-23 12:36:51', '794dde314d895d37587af38ca7a703c95276', 1),
(76, '1000', 1, 1, 'RazorPay Paymentpay_D9NMYe4uhyRDgq', '2019-08-23', '2019-08-23 12:37:23', '8e771cde80cb2acc699e630e006c62143707', 1),
(77, '5000', 1, 2, 'From:6204304229 Ref : N/A', '2019-08-23', '2019-08-23 12:38:52', 'db116b39f7a3ac5366079b1d9fe249a5', 1),
(78, '5000', 2, 1, 'To:9835555982 Ref : N/A', '2019-08-23', '2019-08-23 12:38:52', '77369e37b2aa1404f416275183ab055f', 1),
(79, '200', 1, 1, 'RazorPay Paymentpay_D9NOflPkz5S3Cb', '2019-08-23', '2019-08-23 12:39:40', '56b2d744dda4795c44be9810eb4ddbb42549', 1),
(80, '1200', 1, 2, 'From:6204304229 Ref : test final', '2019-08-23', '2019-08-23 12:39:45', '8763d72bba4a7ade23f9ae1f09f4efc7', 1),
(81, '1200', 2, 1, 'To:9835555982 Ref : test final', '2019-08-23', '2019-08-23 12:39:45', '39cd7b469beae7c617c73e0d008195ef', 1),
(82, '10000', 1, 1, NULL, '2019-08-01', '2019-08-23 12:41:47', '819b1c6493df653afb8c7846bc4b8db63026', 2),
(83, '10000', 1, 1, NULL, '2019-08-23', '2019-08-23 12:42:00', 'b73569af50ab099fbb5bfa18bc002f7a5200', 2),
(84, '10', 1, 1, NULL, '2019-08-23', '2019-08-23 12:43:44', '27711af0dc6a3450451fb51ed8554b7e8655', 2),
(85, '2580', 1, 1, NULL, '2019-08-23', '2019-08-23 12:44:03', 'a73e15d3959ad40c300f4765d239c01f3116', 2),
(86, '2000', 1, 1, NULL, '2019-08-23', '2019-08-23 12:45:28', '0a4ce87729847cf3c57d84932d865dcd4961', 2),
(87, '100', 1, 1, 'RazorPay Paymentpay_D9NiOe5lU3R8Rk', '2019-08-23', '2019-08-23 12:58:18', '9f7eb8aa0246df0014c837eb52bfebfe4871', 1),
(88, '100', 1, 2, 'From:6204304229 Ref : test', '2019-08-23', '2019-08-23 12:58:31', 'f3b7e5d3eb074cde5b76e26bc0fb5776', 1),
(89, '100', 2, 1, 'To:9835555982 Ref : test', '2019-08-23', '2019-08-23 12:58:31', 'b427426b8acd2c2e53827970f2c2f526', 1),
(90, '1000', 1, 1, NULL, '2019-08-23', '2019-08-23 14:21:02', 'd9ee02888caabf3f9a3875bc82fb9f217441', 2),
(91, '100', 1, 1, 'From:9835555982 Ref : N/A', '2019-08-23', '2019-08-23 15:14:51', '10907813b97e249163587e6246612e21', 1),
(92, '100', 2, 2, 'To:6204304229 Ref : N/A', '2019-08-23', '2019-08-23 15:14:51', '08fe2621d8e716b02ec0da35256a998d', 1),
(93, '5000', 1, 1, 'From:9835555982 Ref : test Passbook', '2019-08-23', '2019-08-23 15:33:39', '0aae0fede9a4d278e2f9a171e62fc76b', 1),
(94, '5000', 2, 2, 'To:6204304229 Ref : test Passbook', '2019-08-23', '2019-08-23 15:33:39', 'dabd8d2ce74e782c65a973ef76fd540b', 1),
(95, '10', 1, 1, 'From:9835555982 Ref : N/A', '2019-08-23', '2019-08-23 15:35:18', 'f8d2e80c1458ea2501f98a2cafadb397', 1),
(96, '10', 2, 2, 'To:6204304229 Ref : N/A', '2019-08-23', '2019-08-23 15:35:18', '57cd30d9088b0185cf0ebca1a472ff1d', 1),
(97, '5000', 1, 1, 'From:9835555982 Ref : N/A', '2019-08-23', '2019-08-23 15:35:54', 'bc047286b224b7bfa73d4cb02de1238d', 1),
(98, '5000', 2, 2, 'To:6204304229 Ref : N/A', '2019-08-23', '2019-08-23 15:35:54', '7b3403f79b478699224bb449509694cf', 1),
(99, '5000', 1, 2, 'From:6204304229 Ref : N/A', '2019-08-23', '2019-08-23 16:30:43', '991327d63593b0ba2c45618bf81f6a64', 1),
(100, '5000', 2, 1, 'To:9835555982 Ref : N/A', '2019-08-23', '2019-08-23 16:30:43', '2a0f97f81755e2878b264adf39cba68e', 1),
(101, '890', 1, 1, 'RazorPay Paymentpay_D9RLFEZZcPHDzB', '2019-08-23', '2019-08-23 16:31:08', 'ce80cf941cfddf35d57721618d31bf016354', 1),
(102, '6000', 1, 2, 'From:6204304229 Ref : N/A', '2019-08-23', '2019-08-23 16:31:22', 'b8b12f949378552c21f28deff8ba8eb6', 1),
(103, '6000', 2, 1, 'To:9835555982 Ref : N/A', '2019-08-23', '2019-08-23 16:31:22', '7cb1f2f2baf6ab2ae929ad8cb88d6210', 1),
(104, '100', 1, 1, 'RazorPay Paymentpay_D9SWsSqB2acHQQ', '2019-08-23', '2019-08-23 17:40:35', '816dda856c6caba63909d3e6dd2034a68902', 1),
(105, '60', 1, 2, 'From:6204304229 Ref : N/A', '2019-08-23', '2019-08-23 17:41:31', '310cc7ca5a76a446f85c1a0d641ba96d', 1),
(106, '60', 2, 1, 'To:9835555982 Ref : N/A', '2019-08-23', '2019-08-23 17:41:31', '573eec40e4ef4f2089531dd5cbf629f8', 1),
(107, '40', 1, 2, 'From:6204304229 Ref : N/A', '2019-08-23', '2019-08-23 17:41:46', 'dba132f6ab6a3e3d17a8d59e82105f4c', 1),
(108, '40', 2, 1, 'To:9835555982 Ref : N/A', '2019-08-23', '2019-08-23 17:41:46', 'ab24cd2b811ee48a416fc7a833d736a9', 1),
(109, '20', 1, 1, NULL, '2019-08-23', '2019-08-23 17:42:04', 'e67f37b127d8cadd5712e7732b70e32c7802', 2),
(110, '100', 1, 1, 'RazorPay Paymentpay_D9SbyKa5JUxF7T', '2019-08-23', '2019-08-23 17:45:32', '1e12e718565912623e2cc256578d97ea2541', 1),
(111, '80', 1, 2, 'From:6204304229 Ref : N/A', '2019-08-23', '2019-08-23 17:46:13', 'de9240f5c623bf031dcf0fca9770db44', 1),
(112, '80', 2, 1, 'To:9835555982 Ref : N/A', '2019-08-23', '2019-08-23 17:46:13', 'b069b3415151fa7217e870017374de7c', 1),
(113, '30', 1, 1, 'RazorPay Paymentpay_D9Scz0sG9SyjEf', '2019-08-23', '2019-08-23 17:46:34', '6bbe39271850a171da509038bf6c0c126117', 1),
(114, '50', 1, 2, 'From:6204304229 Ref : N/A', '2019-08-23', '2019-08-23 17:46:48', '72c25197b6a491816d9a84b42d7205f0', 1),
(115, '50', 2, 1, 'To:9835555982 Ref : N/A', '2019-08-23', '2019-08-23 17:46:48', '00430c0c1fae276c9713ab5f21167882', 1),
(116, '200', 1, 1, NULL, '2019-08-24', '2019-08-24 09:10:11', '2d5e53bec83964d17825dd02b10f27f01037', 2);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_status`
--

CREATE TABLE `transaction_status` (
  `transaction_status_id` int(11) NOT NULL,
  `transaction_status_val` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_status`
--

INSERT INTO `transaction_status` (`transaction_status_id`, `transaction_status_val`) VALUES
(1, 'Success'),
(2, 'Failed');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_type`
--

CREATE TABLE `transaction_type` (
  `transaction_type_id` int(11) NOT NULL,
  `transaction_type_val` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_type`
--

INSERT INTO `transaction_type` (`transaction_type_id`, `transaction_type_val`) VALUES
(1, 'Credit'),
(2, 'Debit');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(256) NOT NULL,
  `user_mobile` varchar(12) NOT NULL,
  `user_email` varchar(512) NOT NULL,
  `user_uid` text DEFAULT NULL,
  `user_created_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_status` tinyint(1) NOT NULL DEFAULT 0,
  `user_password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_mobile`, `user_email`, `user_uid`, `user_created_on`, `user_status`, `user_password`) VALUES
(1, 'md khalid', '6204304229', 'raza@lpu.in', 'abc3c47e8978f8f9548e5027c9be2874', '2019-08-07 18:25:18', 1, '827ccb0eea8a706c4c34a16891f84e7b'),
(2, 'khalid', '9835555982', 'zeeshanahmad117@gmail.coml', '4177c4cf3697f36c68fd78e34865a6d5', '2019-08-19 20:06:12', 1, 'e10adc3949ba59abbe56e057f20f883e'),
(3, 'Zeeshan Ahmad', '8603417231', 'zeeshanahmad117@gmail.com', 'bf832ca7f9fd0fc0f188d1b4d855e332', '2019-08-20 18:32:28', 1, 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `user_token_id` int(11) NOT NULL,
  `user_token_val` text NOT NULL,
  `user_token_ref` int(11) NOT NULL,
  `user_token_created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `wallet_id` int(11) NOT NULL,
  `wallet_amount` int(11) NOT NULL DEFAULT 0,
  `wallet_ref` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wallet`
--

INSERT INTO `wallet` (`wallet_id`, `wallet_amount`, `wallet_ref`) VALUES
(1, 0, 1),
(2, 16252, 2),
(3, 0, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `card`
--
ALTER TABLE `card`
  ADD PRIMARY KEY (`card_id`),
  ADD KEY `card_ref` (`card_ref`);

--
-- Indexes for table `card_pin`
--
ALTER TABLE `card_pin`
  ADD PRIMARY KEY (`card_pin_id`),
  ADD KEY `card_pin_ref` (`card_pin_ref`);

--
-- Indexes for table `portfolio`
--
ALTER TABLE `portfolio`
  ADD PRIMARY KEY (`portfolio_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `transaction_ref` (`transaction_ref`),
  ADD KEY `transaction_type` (`transaction_type`),
  ADD KEY `transaction_status` (`transaction_status`);

--
-- Indexes for table `transaction_status`
--
ALTER TABLE `transaction_status`
  ADD PRIMARY KEY (`transaction_status_id`);

--
-- Indexes for table `transaction_type`
--
ALTER TABLE `transaction_type`
  ADD PRIMARY KEY (`transaction_type_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`user_token_id`),
  ADD KEY `user_token_ref` (`user_token_ref`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`wallet_id`),
  ADD KEY `wallet_ref` (`wallet_ref`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `card`
--
ALTER TABLE `card`
  MODIFY `card_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `card_pin`
--
ALTER TABLE `card_pin`
  MODIFY `card_pin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `portfolio`
--
ALTER TABLE `portfolio`
  MODIFY `portfolio_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `transaction_status`
--
ALTER TABLE `transaction_status`
  MODIFY `transaction_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaction_type`
--
ALTER TABLE `transaction_type`
  MODIFY `transaction_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `user_token_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `wallet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `card`
--
ALTER TABLE `card`
  ADD CONSTRAINT `card_ibfk_1` FOREIGN KEY (`card_ref`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `card_pin`
--
ALTER TABLE `card_pin`
  ADD CONSTRAINT `card_pin_ibfk_1` FOREIGN KEY (`card_pin_ref`) REFERENCES `card` (`card_id`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`transaction_ref`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`transaction_type`) REFERENCES `transaction_type` (`transaction_type_id`),
  ADD CONSTRAINT `transaction_ibfk_3` FOREIGN KEY (`transaction_status`) REFERENCES `transaction_status` (`transaction_status_id`);

--
-- Constraints for table `user_token`
--
ALTER TABLE `user_token`
  ADD CONSTRAINT `user_token_ibfk_1` FOREIGN KEY (`user_token_ref`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `wallet`
--
ALTER TABLE `wallet`
  ADD CONSTRAINT `wallet_ibfk_1` FOREIGN KEY (`wallet_ref`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
