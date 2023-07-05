-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2023 at 06:35 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopa`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL COMMENT 'รหัสหมวดหมู่',
  `cat_name` varchar(50) NOT NULL COMMENT 'ชื่อสำหรับ category'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`) VALUES
(1, 'food'),
(2, 'electronic'),
(3, 'fashion'),
(4, 'entertainment'),
(5, 'pet'),
(6, 'automotive'),
(7, 'commodity'),
(8, 'etc');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL COMMENT 'รหัสคอมเมนต์',
  `user_id` int(11) NOT NULL COMMENT 'รหัสผู้เจ้าของคอมเมนต์',
  `product_id` int(11) NOT NULL COMMENT 'รหัสสินค้า',
  `content` text NOT NULL COMMENT 'ข้อความ'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `user_id`, `product_id`, `content`) VALUES
(1, 13, 6, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.'),
(2, 14, 6, 'อยากกินจังเลยครับ'),
(3, 13, 13, 'sdafsdfsfdsfsfhksajdfsldkjhfsakjfhlksadfhsakjfsldkfhslkf'),
(4, 13, 13, 'sadfsafsafsadfsafsagsfgsgsgsarg'),
(5, 13, 42, 'Goooddddd'),
(6, 13, 15, 'เย็นมากๆๆๆๆๆ'),
(7, 14, 7, 'เผ็กมากกกกก');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL COMMENT 'รหัสorder',
  `user_id` int(11) NOT NULL COMMENT 'ชื่อผู้ใช้',
  `trans_id` int(50) NOT NULL COMMENT 'รหัสการขนส่ง',
  `status` varchar(50) NOT NULL COMMENT 'สถานะคำสั่งซื้อ',
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'การอัปเดต'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_id`, `user_id`, `trans_id`, `status`, `last_update`) VALUES
(6, 13, 3, 'confirmed', '2023-07-03 04:27:49'),
(7, 13, 2, 'canceled', '2023-07-04 16:03:04'),
(8, 13, 1, 'waiting confirm', '2023-06-29 15:50:18'),
(9, 13, 3, 'canceled', '2023-07-04 07:47:02'),
(10, 13, 3, 'confirmed', '2023-07-03 04:54:04'),
(11, 14, 1, 'canceled', '2023-07-03 04:53:57'),
(12, 14, 2, 'confirmed', '2023-07-03 04:29:51'),
(13, 13, 1, 'confirmed', '2023-07-03 04:41:03'),
(14, 14, 2, 'confirmed', '2023-07-03 12:06:38'),
(15, 13, 1, 'confirmed', '2023-07-03 12:06:41'),
(16, 15, 3, 'confirmed', '2023-07-03 13:53:26'),
(17, 13, 1, 'confirmed', '2023-07-04 07:46:52'),
(18, 13, 2, 'waiting confirm', '2023-07-04 14:12:32'),
(19, 13, 2, 'confirmed', '2023-07-04 16:03:13'),
(20, 14, 1, 'waiting confirm', '2023-07-04 16:06:32');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `order_detail_id` int(11) NOT NULL COMMENT 'รหัสorder_detail',
  `order_id` int(11) NOT NULL COMMENT 'รหัสการซื้อ',
  `product_attr_id` int(11) NOT NULL COMMENT 'รหัสสินค้า',
  `qty` int(11) NOT NULL COMMENT 'จำนวนสินค้า'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`order_detail_id`, `order_id`, `product_attr_id`, `qty`) VALUES
(2, 6, 31, 2),
(3, 6, 21, 2),
(4, 6, 56, 1),
(5, 7, 69, 3),
(6, 7, 37, 3),
(7, 8, 80, 3),
(8, 8, 20, 2),
(9, 9, 37, 2),
(10, 9, 11, 3),
(11, 10, 16, 3),
(12, 10, 21, 2),
(13, 11, 62, 2),
(14, 11, 17, 2),
(15, 11, 21, 3),
(16, 12, 95, 5),
(17, 13, 124, 4),
(18, 14, 9, 2),
(19, 14, 59, 2),
(20, 14, 89, 4),
(21, 15, 56, 2),
(22, 15, 17, 2),
(23, 16, 58, 10),
(24, 16, 47, 2),
(25, 16, 63, 100),
(26, 17, 8, 2),
(27, 17, 21, 2),
(28, 18, 6, 4),
(29, 18, 21, 4),
(30, 19, 46, 2),
(31, 19, 55, 2),
(32, 20, 13, 20);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL COMMENT 'รหัสproduct',
  `cat_id` varchar(50) NOT NULL COMMENT 'รหัสcategory',
  `product_name` varchar(50) NOT NULL COMMENT 'ชื่อสินค้า',
  `detail` longtext NOT NULL COMMENT 'รายละเอียด',
  `unit_price` double NOT NULL COMMENT 'ราคาต่อหน่วย',
  `score_total` int(11) NOT NULL,
  `num_user_review` int(11) NOT NULL,
  `img1` varchar(200) NOT NULL COMMENT 'filepath1',
  `img2` varchar(200) NOT NULL COMMENT 'filepath2',
  `img3` varchar(200) NOT NULL COMMENT 'filepath3',
  `img4` varchar(200) NOT NULL COMMENT 'filepath4'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `cat_id`, `product_name`, `detail`, `unit_price`, `score_total`, `num_user_review`, `img1`, `img2`, `img3`, `img4`) VALUES
(6, '1', 'บะหมี่กึ่งสำเส็จรูป', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 7.5, 9, 2, 'uploads/01_01_01.png', 'uploads/01_01_02.jpg', 'uploads/01_01_03.jpg', 'uploads/01_01_04.jpg'),
(7, '1', 'น้ำพริกกากหมู', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 80, 8, 2, 'uploads/01_02_01.jpg', 'uploads/01_02_02.jpg', 'uploads/01_02_03.jpg', 'uploads/01_02_04.jpg'),
(8, '1', 'ปลากระป๋อง', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 20, 0, 0, 'uploads/01_03_01.png', 'uploads/01_03_02.jpg', 'uploads/01_03_03.jpg', 'uploads/01_03_04.png'),
(9, '1', 'นมวัวแท้ๆๆๆ', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 50, 0, 0, 'uploads/01_04_01.jpg', 'uploads/01_04_02.jpg', 'uploads/01_04_03.jpg', 'uploads/01_04_04.jpg'),
(10, '1', 'ไก่ต้มน้ำปลา', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 150, 3, 1, 'uploads/01_05_01.jpg', 'uploads/01_05_02.jpg', 'uploads/01_05_03.jpg', 'uploads/01_05_04.jpg'),
(11, '2', 'Macbook', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 50000, 0, 0, 'uploads/02_01_01.jpg', 'uploads/02_01_02.jpg', 'uploads/02_01_03.jpg', 'uploads/02_01_04.jpg'),
(12, '2', 'ตู้เย็น จัดๆ', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 20000, 4, 1, 'uploads/02_02_01.jpg', 'uploads/02_02_02.jpg', 'uploads/02_02_03.jpg', 'uploads/02_02_04.jpg'),
(13, '2', 'Smart TV', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 20000, 3, 1, 'uploads/02_03_01.jpg', 'uploads/02_03_02.jpg', 'uploads/02_03_03.jpg', 'uploads/02_03_04.jpg'),
(14, '2', 'Sumsung galaxy s21', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 30000, 0, 0, 'uploads/02_04_01.jpg', 'uploads/02_04_02.jpg', 'uploads/02_04_03.jpg', 'uploads/02_04_04.jpg'),
(15, '2', 'พัดลม hatari', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 2000, 2, 1, 'uploads/02_05_01.jpg', 'uploads/02_05_02.jpg', 'uploads/02_05_03.jpg', 'uploads/02_05_04.jpg'),
(16, '3', 'Man City Kit 2022', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 2000, 3, 1, 'uploads/03_01_01.jpg', 'uploads/03_01_02.jpg', 'uploads/03_01_03.jpg', 'uploads/03_01_04.jpg'),
(17, '3', 'Liverpool Kit 2022', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 2000, 0, 0, 'uploads/03_02_01.jpg', 'uploads/03_02_02.jpg', 'uploads/03_02_03.jpg', 'uploads/03_02_04.jpg'),
(18, '3', 'Man United Kit 2022', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 2000, 0, 0, 'uploads/03_03_01.jpg', 'uploads/03_03_02.jpg', 'uploads/03_03_03.jpg', 'uploads/03_03_04.jpg'),
(19, '3', 'Cheasea Kit 2022', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 2000, 0, 0, 'uploads/03_04_01.jpg', 'uploads/03_04_02.jpg', 'uploads/03_04_03.jpg', 'uploads/03_04_04.jpg'),
(20, '3', 'Real Madrid Kit 2022', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 2000, 0, 0, 'uploads/03_05_01.jpg', 'uploads/03_05_02.jpg', 'uploads/03_05_03.jpg', 'uploads/03_05_04.jpg'),
(21, '4', 'คอนเสิร์ต Black Pink', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 5000, 4, 1, 'uploads/04_01_01.jpg', 'uploads/04_01_02.jpg', 'uploads/04_01_03.jpg', 'uploads/04_01_04.jpg'),
(22, '4', 'สวนสนุก Dreme World', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 500, 0, 0, 'uploads/04_02_01.jpg', 'uploads/04_02_02.jpg', 'uploads/04_02_03.jpg', 'uploads/04_02_04.jpg'),
(23, '4', 'งานบวชนาค', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 200, 0, 0, 'uploads/04_03_01.jpg', 'uploads/04_03_02.jpg', 'uploads/04_03_03.jpg', 'uploads/04_03_04.jpg'),
(24, '4', 'คอนเสิร์ต เสียงอีสาน', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 100, 0, 0, 'uploads/04_04_01.jpg', 'uploads/04_04_02.jpg', 'uploads/04_04_03.jpg', 'uploads/04_04_04.jpg'),
(25, '4', 'คอนเสิร์ต คาราบาว', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 3000, 0, 0, 'uploads/04_05_01.jpg', 'uploads/04_05_02.jpg', 'uploads/04_05_03.jpg', 'uploads/04_05_04.jpg'),
(26, '5', 'อาหาร สุนัข', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 500, 0, 0, 'uploads/05_01_01.jpg', 'uploads/05_01_02.jpg', 'uploads/05_01_03.jpg', 'uploads/05_01_04.jpg'),
(27, '5', 'อาหาร แมว', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 300, 0, 0, 'uploads/05_02_01.jpg', 'uploads/05_02_02.jpg', 'uploads/05_02_03.jpg', 'uploads/05_02_04.jpg'),
(28, '5', 'อาหาร กระต่าย', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 500, 0, 0, 'uploads/05_03_01.jpg', 'uploads/05_03_02.jpg', 'uploads/05_03_03.jpg', 'uploads/05_03_04.jpg'),
(29, '5', 'แชมพู สุนัข', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 200, 0, 0, 'uploads/05_04_01.jpg', 'uploads/05_04_02.jpg', 'uploads/05_04_03.jpg', 'uploads/05_04_04.jpg'),
(30, '5', 'ทรายแมว ภูเขาไฟ', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 500, 0, 0, 'uploads/05_05_01.jpg', 'uploads/05_05_02.jpg', 'uploads/05_05_03.jpg', 'uploads/05_05_04.jpg'),
(31, '6', 'หมวกกันน็อค มอเตอร์ไซต์', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 500, 0, 0, 'uploads/06_01_01.jpg', 'uploads/06_01_02.jpg', 'uploads/06_01_03.jpg', 'uploads/06_01_04.jpg'),
(32, '6', 'ถุงมือขับมอเตอร์ไซต์', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 600, 0, 0, 'uploads/06_02_01.jpg', 'uploads/06_02_02.jpg', 'uploads/06_02_03.jpg', 'uploads/06_02_04.jpg'),
(33, '6', 'ล้อแม็ก ขอบ 18 นิ้ว', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 50000, 0, 0, 'uploads/06_03_01.jpg', 'uploads/06_03_02.jpg', 'uploads/06_03_03.jpg', 'uploads/06_03_04.jpg'),
(34, '6', 'มอร์เตอร์ไซต์ Wave 110', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 70000, 0, 0, 'uploads/06_04_01.jpg', 'uploads/06_04_02.jpg', 'uploads/06_04_03.jpg', 'uploads/06_04_04.jpg'),
(35, '6', 'มอร์เตอร์ไซต์ PCX', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 100000, 8, 2, 'uploads/06_05_01.jpg', 'uploads/06_05_02.jpg', 'uploads/06_05_03.jpg', 'uploads/06_05_04.jpg'),
(36, '7', 'ผงซักฝอก', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 50, 0, 0, 'uploads/07_01_01.jpg', 'uploads/07_01_02.jpg', 'uploads/07_01_03.jpg', 'uploads/07_01_04.jpg'),
(37, '7', 'น้ำยาปรับผ้านุ่ม', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 50, 0, 0, 'uploads/07_02_01.jpg', 'uploads/07_02_02.jpg', 'uploads/07_02_03.jpg', 'uploads/07_02_04.jpg'),
(38, '7', 'น้ำหอมผู้ชาย', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 600, 0, 0, 'uploads/07_03_01.jpg', 'uploads/07_03_02.jpg', 'uploads/07_03_03.jpg', 'uploads/07_03_04.jpg'),
(39, '8', 'โซฟานั่ง สบายๆ', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 6000, 0, 0, 'uploads/08_01_01.jpg', 'uploads/08_01_02.jpg', 'uploads/08_01_03.jpg', 'uploads/08_01_04.jpg'),
(40, '8', 'หนังสือเรียน', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 100, 3, 1, 'uploads/08_02_01.jpg', 'uploads/08_02_02.jpg', 'uploads/08_02_03.jpg', 'uploads/08_02_04.jpg'),
(41, '1', 'อาหารกลางวัน', 'หกดหฟดหกฟดหฟกดหฟ', 50, 0, 0, 'uploads/4DQpjUtzLUwmJZZPGSbJyPI1S2AdYPMN6CWSSnj3hHBV.jpg', 'uploads/cy4p-hero.jpg', 'uploads/blackpink-born-pink.jpg', 'uploads/1553078046154-o62701cbd946893f8429d52f864878976_19679463_190310_0006.jpg'),
(42, '2', 'iphone', 'gdfdsgdsfgdsfg', 25000, 3, 1, 'uploads/iphone.jpg', 'uploads/iphone-14-plus-blue-witb-202209_FMT_WHH.jpg', 'uploads/iphone-14-pro-model-unselect-gallery-2-202209.jpg', 'uploads/MPU63.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_attr`
--

CREATE TABLE `product_attr` (
  `product_attr_id` int(11) NOT NULL COMMENT 'รหัสคุณสมบัติพิเศษ',
  `product_id` int(11) NOT NULL COMMENT 'รหัสสินค้า',
  `attr_name` varchar(50) NOT NULL COMMENT 'ชื่อคุณสมบัติพิเศษ',
  `product_stock` int(11) NOT NULL COMMENT 'จำนวนสินค้าเหลือในคลัง',
  `sale` int(11) NOT NULL COMMENT 'ยอดขายทั้งหมด'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `product_attr`
--

INSERT INTO `product_attr` (`product_attr_id`, `product_id`, `attr_name`, `product_stock`, `sale`) VALUES
(6, 6, 'รสต้มยำ', 199, 1),
(8, 6, 'รสหมูสับ', 88, 22),
(9, 6, 'รสหม่าล่า', 0, 57),
(10, 6, 'รสเตี๋ยวเรือ', 150, 0),
(11, 7, 'เผ็ดมาก', 50, 0),
(12, 7, 'เผ็ดกลาง', 95, 5),
(13, 7, 'เผ็ดน้อย', 1000, 0),
(14, 8, 'รสดั้งเดิม', 100, 0),
(15, 8, 'รสมะนาว', 100, 0),
(16, 8, 'รสมะขาม', 197, 3),
(17, 9, 'รสจืด', 0, 2),
(18, 9, 'รสสตอเบอร์รี่', 30, 0),
(19, 9, 'รสช็อคโกเล็ต', 50, 0),
(20, 9, 'รสหวาน', 30, 0),
(21, 10, 'ไซต์ ใหญ่', 16, 44),
(22, 11, 'Black', 22, 0),
(23, 11, 'Grey', 30, 0),
(24, 11, 'White', 52, 0),
(25, 12, 'black', 30, 0),
(26, 12, 'red', 20, 0),
(27, 12, 'red', 50, 0),
(28, 12, 'blue', 60, 0),
(29, 12, 'gold', 30, 0),
(30, 13, 'Black', 20, 0),
(31, 13, 'Grey', 30, 0),
(32, 13, 'White', 50, 0),
(33, 14, 'Black', 30, 0),
(34, 14, 'Grey', 20, 0),
(35, 14, 'White', 50, 0),
(36, 14, 'Blue', 20, 0),
(37, 15, 'Black', 50, 0),
(38, 15, 'Pink', 50, 0),
(39, 15, 'White', 50, 0),
(40, 16, 'Blue', 500, 0),
(41, 16, 'Black/Red', 200, 0),
(42, 16, 'Green/Black', 100, 0),
(43, 17, 'Red', 50, 0),
(44, 17, 'White', 52, 0),
(45, 17, 'Green', 50, 0),
(46, 18, 'Red', 48, 2),
(47, 18, 'Blue', 48, 2),
(48, 18, 'Green', 50, 0),
(49, 19, 'Blue', 50, 0),
(50, 19, 'Brow', 50, 0),
(51, 19, 'White', 50, 0),
(52, 20, 'White', 100, 0),
(53, 20, 'Purple', 100, 0),
(54, 20, 'Black', 100, 0),
(55, 21, 'ZONE A', 48, 2),
(56, 21, 'ZONE B', 198, 2),
(57, 21, 'ZONE C', 3000, 0),
(58, 22, 'ทั้งวัน', 4990, 10),
(59, 23, 'สุดเหวี่ยง', 1998, 2),
(60, 24, 'ม่วนคักๆๆ', 45, 0),
(61, 25, 'ZONE A', 3, 0),
(62, 25, 'ZONE B', 2000, 0),
(63, 25, 'ZONE C', 1900, 100),
(64, 26, 'สูตร โตเร็ว', 202, 0),
(65, 26, 'สูตร วิ่งเร็ว', 500, 0),
(66, 26, 'สูตร กระโดดสูง', 500, 0),
(67, 26, 'สูตร น้อยเยอะ', 200, 0),
(68, 26, 'สูตร กลิ้งเร็ว', 100, 0),
(69, 27, 'สูตร โตเร็ว', 200, 0),
(70, 27, 'สูตร วิ่งเร็ว', 200, 0),
(71, 27, 'สูตร กระโดดสูง', 300, 0),
(72, 27, 'สูตร น้อยเยอะ', 100, 0),
(73, 27, 'สูตร กลิ้งเร็ว', 80, 0),
(74, 28, 'สูตร โตเร็ว', 200, 0),
(75, 28, 'สูตร วิ่งเร็ว', 200, 0),
(76, 28, 'สูตร กระโดดสูง', 200, 0),
(77, 28, 'สูตร น้อยเยอะ', 200, 0),
(78, 28, 'สูตร กลิ้งเร็ว', 200, 0),
(79, 29, 'กลิ่น มะนาว', 200, 0),
(80, 29, 'กลิ่น มะกูด', 200, 0),
(81, 29, 'กลิ่น ส้ม', 200, 0),
(82, 29, 'กลิ่น มะม่วง', 200, 0),
(83, 29, 'กลิ่น ตะไคร้', 200, 0),
(84, 30, 'คุณภาพดี', 500, 0),
(85, 31, 'Red', 200, 0),
(86, 31, 'White', 200, 0),
(87, 31, 'Green', 200, 0),
(88, 31, 'Blue', 200, 0),
(89, 31, 'Pink', 196, 4),
(90, 32, 'Red', 100, 0),
(91, 32, 'Grey', 100, 0),
(92, 32, 'White', 100, 0),
(93, 32, 'Blue', 100, 0),
(94, 32, 'Pink', 100, 0),
(95, 33, 'Red', 100, 0),
(96, 33, 'White', 100, 0),
(97, 33, 'Green', 100, 0),
(98, 33, 'Blue', 100, 0),
(99, 33, 'Pink', 100, 0),
(100, 34, 'Red', 20, 0),
(101, 34, 'White', 20, 0),
(102, 35, 'Black', 100, 0),
(103, 35, 'Grey', 100, 0),
(104, 36, 'กลิ่น มะนาว', 103, 0),
(105, 36, 'กลิ่น มะกูด', 100, 0),
(106, 36, 'กลิ่น ส้ม', 100, 0),
(107, 36, 'กลิ่น มะม่วง', 100, 0),
(108, 36, 'กลิ่น ตะไคร้', 100, 0),
(109, 37, 'กลิ่น มะนาว', 100, 0),
(110, 37, 'กลิ่น มะกูด', 100, 0),
(111, 37, 'กลิ่น ส้ม', 100, 0),
(112, 37, 'กลิ่น มะม่วง', 100, 0),
(113, 37, 'กลิ่น ตะไคร้', 100, 0),
(114, 38, 'กลิ่น มะนาว', 100, 0),
(115, 38, 'กลิ่น มะกูด', 100, 0),
(116, 38, 'กลิ่น ส้ม', 100, 0),
(117, 38, 'กลิ่น มะม่วง', 100, 0),
(118, 38, 'กลิ่น ตะไคร้', 100, 0),
(119, 39, 'Black', 100, 0),
(120, 39, 'Grey', 100, 0),
(121, 39, 'White', 100, 0),
(122, 39, 'Blue', 100, 0),
(123, 39, 'Gold', 100, 0),
(124, 40, 'วิชา ภาษาไทย', 196, 4),
(125, 40, 'วิชา เคมี', 200, 0),
(126, 40, 'วิชา ฟิสิกส์', 200, 0),
(127, 40, 'วิชา ชีวะ', 200, 0),
(128, 40, 'วิชา ชีวิต', 200, 0),
(129, 41, 'ข้าวมันไก๊', 20, 0),
(130, 41, 'ข้าวหมูแดง', 20, 0),
(131, 42, 'Black', 20, 0),
(132, 42, 'Grey', 25, 0);

-- --------------------------------------------------------

--
-- Table structure for table `score`
--

CREATE TABLE `score` (
  `score_id` int(11) NOT NULL COMMENT 'รหัสคะแนน',
  `user_id` int(11) NOT NULL COMMENT 'รหัสผู้ใช้',
  `product_id` int(50) NOT NULL COMMENT 'สินค้าที่ถูกให้คะแนน',
  `score` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `score`
--

INSERT INTO `score` (`score_id`, `user_id`, `product_id`, `score`) VALUES
(1, 13, 6, 4),
(2, 13, 7, 5),
(3, 13, 35, 5),
(4, 13, 40, 3),
(5, 13, 16, 3),
(6, 13, 12, 4),
(7, 14, 35, 3),
(8, 14, 6, 5),
(9, 13, 21, 4),
(10, 13, 10, 3),
(11, 13, 13, 3),
(12, 13, 42, 3),
(13, 13, 15, 2),
(14, 14, 7, 3);

-- --------------------------------------------------------

--
-- Table structure for table `transport`
--

CREATE TABLE `transport` (
  `trans_id` int(11) NOT NULL COMMENT 'รหัสการส่ง',
  `trans_name` varchar(50) NOT NULL COMMENT 'ชื่อการส่ง',
  `trans_price` int(11) NOT NULL COMMENT 'ราคาขนส่ง'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `transport`
--

INSERT INTO `transport` (`trans_id`, `trans_name`, `trans_price`) VALUES
(1, 'thai pos', 45),
(2, 'flash express', 60),
(3, 'kerry express', 70);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL COMMENT 'รหัสuser',
  `username` varchar(50) NOT NULL COMMENT 'ชื่อสำหรับ login',
  `password` varchar(200) NOT NULL COMMENT 'รหัส',
  `email` varchar(50) NOT NULL COMMENT 'อีเมลล์',
  `user_status` varchar(50) NOT NULL COMMENT 'สถานะ'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `email`, `user_status`) VALUES
(13, 'admin', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', 'admin@gmail.com', 'admin'),
(14, 'Karn', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', 'user@gmail.com', 'user'),
(15, 'Katy', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', 'user2@gmail.com', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`order_detail_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_attr`
--
ALTER TABLE `product_attr`
  ADD PRIMARY KEY (`product_attr_id`);

--
-- Indexes for table `score`
--
ALTER TABLE `score`
  ADD PRIMARY KEY (`score_id`);

--
-- Indexes for table `transport`
--
ALTER TABLE `transport`
  ADD PRIMARY KEY (`trans_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสหมวดหมู่', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสคอมเมนต์', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสorder', AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสorder_detail', AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสproduct', AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `product_attr`
--
ALTER TABLE `product_attr`
  MODIFY `product_attr_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสคุณสมบัติพิเศษ', AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `score`
--
ALTER TABLE `score`
  MODIFY `score_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสคะแนน', AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `transport`
--
ALTER TABLE `transport`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสการส่ง', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสuser', AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
