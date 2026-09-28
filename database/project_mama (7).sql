-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2025 at 11:19 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_mama`
--

-- --------------------------------------------------------

--
-- Table structure for table `acc`
--

CREATE TABLE `acc` (
  `id` int(5) NOT NULL,
  `uid` int(5) NOT NULL,
  `date` date NOT NULL,
  `type` int(1) NOT NULL,
  `action` varchar(50) NOT NULL,
  `detail` varchar(50) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `acc`
--

INSERT INTO `acc` (`id`, `uid`, `date`, `type`, `action`, `detail`, `status`) VALUES
(1, 0, '2025-01-20', 1, 'purchase', 'test', 1);

-- --------------------------------------------------------

--
-- Table structure for table `access_control_list`
--

CREATE TABLE `access_control_list` (
  `id` int(5) NOT NULL,
  `ug_id` int(5) NOT NULL,
  `appid` int(5) NOT NULL,
  `accl` int(1) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `access_control_list`
--

INSERT INTO `access_control_list` (`id`, `ug_id`, `appid`, `accl`, `status`) VALUES
(1, 2, 1, 4, 0),
(2, 2, 2, 2, 0),
(3, 2, 3, 0, 0),
(4, 2, 4, 0, 0),
(5, 2, 5, 0, 0),
(6, 2, 6, 0, 0),
(7, 1, 1, 7, 1),
(8, 1, 2, 0, 1),
(9, 1, 3, 0, 1),
(10, 1, 4, 4, 1),
(11, 1, 5, 0, 1),
(12, 1, 6, 0, 1),
(13, 2, 1, 0, 1),
(14, 2, 2, 0, 1),
(15, 2, 3, 3, 1),
(16, 2, 4, 0, 1),
(17, 2, 5, 0, 1),
(18, 2, 6, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `accounting_type`
--

CREATE TABLE `accounting_type` (
  `id` int(5) NOT NULL,
  `type` int(5) NOT NULL,
  `root` int(5) NOT NULL,
  `ord` int(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounting_type`
--

INSERT INTO `accounting_type` (`id`, `type`, `root`, `ord`, `name`, `status`) VALUES
(1, 1, 0, 1, 'สินทรัพย์', 1),
(2, 2, 0, 1, 'หนี้สิน', 1),
(3, 3, 0, 1, 'ทุน', 1),
(4, 4, 0, 1, 'รายรับ', 1),
(5, 5, 0, 1, 'ค่าใช้จ่าย', 1),
(6, 1, 1, 1, 'เงินสด', 1),
(7, 1, 1, 2, 'เงินฝากธนาคาร', 1),
(8, 1, 1, 3, 'วัตถุดิบ', 1),
(9, 2, 2, 1, 'เจ้าหนี้ - วัตถุดิบ', 1),
(10, 1, 1, 4, 'สินค้าระหว่างผลิต', 1),
(11, 1, 1, 5, 'สินค้าสำเร็จรูป', 1);

-- --------------------------------------------------------

--
-- Table structure for table `acc_detil`
--

CREATE TABLE `acc_detil` (
  `id` int(5) NOT NULL,
  `acc_id` int(5) NOT NULL,
  `typ_id` int(5) NOT NULL,
  `typ` int(5) NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `id` int(5) NOT NULL,
  `name` varchar(30) NOT NULL,
  `dir` varchar(30) NOT NULL,
  `detail` varchar(30) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`id`, `name`, `dir`, `detail`, `status`) VALUES
(1, 'PR', 'gdgd', '', 1),
(2, 'po', 'hfhfhf', 'hfhf', 1),
(3, 'payment', '', '', 1),
(4, 'supplier', '', '', 1),
(5, 'Customer', '', '', 1),
(6, 'payment', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer_data`
--

CREATE TABLE `customer_data` (
  `id` int(5) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `tel` varchar(10) NOT NULL,
  `tex_number` varchar(20) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer_data`
--

INSERT INTO `customer_data` (`id`, `name`, `address`, `tel`, `tex_number`, `status`) VALUES
(1, 'นาย ศุภกิจ อารีย์', 'ดาวอังคาร', '0222222222', '1111111111', 1),
(2, 'นาย อภิวัฒน์', 'fdgdfd', '5455454545', '1000000000', 1),
(3, 'kfhafas', 'asdasdasda', '0444444444', '1111111111', 1);

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `id` int(5) NOT NULL,
  `po_id` int(5) NOT NULL,
  `customer_id` int(5) NOT NULL,
  `uid` int(5) NOT NULL,
  `apv_uid` int(5) NOT NULL,
  `date` date NOT NULL,
  `apv_date` date NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`id`, `po_id`, `customer_id`, `uid`, `apv_uid`, `date`, `apv_date`, `status`) VALUES
(1, 1, 1, 2, 2, '2025-01-20', '2025-01-20', 2),
(2, 4, 1, 2, 2, '2025-01-20', '2025-01-20', 2),
(3, 3, 1, 2, 2, '2025-01-20', '2025-01-20', 2),
(4, 2, 2, 2, 2, '2025-01-20', '2025-01-20', 2),
(5, 5, 2, 2, 0, '2025-01-20', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_detail`
--

CREATE TABLE `delivery_detail` (
  `id` int(5) NOT NULL,
  `dvr_id` int(5) NOT NULL,
  `product_id` int(5) NOT NULL,
  `quantity` int(5) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `delivery_detail`
--

INSERT INTO `delivery_detail` (`id`, `dvr_id`, `product_id`, `quantity`, `price`, `status`) VALUES
(1, 1, 9, 10, '174.00', 1),
(2, 2, 8, 8, '174.00', 1),
(3, 2, 9, 7, '174.00', 1),
(4, 2, 10, 9, '174.00', 1),
(5, 3, 8, 40, '174.00', 1),
(6, 4, 8, 4, '174.00', 1),
(7, 5, 8, 8, '174.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `sirname` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `sirname`, `birthday`, `address`, `email`, `phone`, `status`) VALUES
(1, 'สรยุทธ', 'เหมหงษ์', '1990-06-22', 'ดาวศุกร์', 'da@gmail.com', '0333333333', 1),
(2, 'ศุภวิทย์', 'มาแล้ว', '2025-01-11', 'fsfsfsfs', 'dasdasdas@fsfsfs', '0777777777', 1),
(3, 'jndsds', 'dsdsds', '2025-01-14', 'kdlasjdaida', 'da@gmail.com', '0111111111', 1),
(4, 'gdgsfdaada', 'ffdfdfd', '2025-01-09', 'gfgfgf', 'ejdsal@gmail.com', '0111111111', 1),
(5, 'fsjkfsjf', 'fsfsfs', '2025-01-08', 'kdlgdgd', 'kfogkofg@gmail.com', '0123456789', 1);

-- --------------------------------------------------------

--
-- Table structure for table `inspection`
--

CREATE TABLE `inspection` (
  `id` int(5) NOT NULL,
  `uid` int(5) NOT NULL,
  `date` date NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `inspection`
--

INSERT INTO `inspection` (`id`, `uid`, `date`, `status`) VALUES
(1, 2, '2025-01-20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `inspection_detail`
--

CREATE TABLE `inspection_detail` (
  `id` int(5) NOT NULL,
  `ins_id` int(5) NOT NULL,
  `product_id` int(5) NOT NULL,
  `detail` varchar(100) NOT NULL,
  `state` varchar(50) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `inspection_detail`
--

INSERT INTO `inspection_detail` (`id`, `ins_id`, `product_id`, `detail`, `state`, `status`) VALUES
(1, 1, 1, '', 'เสีย', 1);

-- --------------------------------------------------------

--
-- Table structure for table `in_out_working`
--

CREATE TABLE `in_out_working` (
  `id` int(5) NOT NULL,
  `emp_id` int(5) NOT NULL,
  `date_time` datetime NOT NULL,
  `type` int(1) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `in_out_working`
--

INSERT INTO `in_out_working` (`id`, `emp_id`, `date_time`, `type`, `status`) VALUES
(1, 1, '2025-01-22 05:13:26', 1, 1),
(2, 1, '2025-01-22 05:13:29', 2, 1),
(3, 1, '2025-01-22 05:13:32', 1, 1),
(4, 1, '2025-01-22 05:13:36', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `leaved`
--

CREATE TABLE `leaved` (
  `id` int(1) NOT NULL,
  `emp_id` int(5) NOT NULL,
  `apv_uid` int(5) NOT NULL,
  `lve_type` int(5) NOT NULL,
  `lve_req` int(5) NOT NULL,
  `lve_date` date NOT NULL,
  `due_date` date NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `leaved`
--

INSERT INTO `leaved` (`id`, `emp_id`, `apv_uid`, `lve_type`, `lve_req`, `lve_date`, `due_date`, `status`) VALUES
(1, 1, 2, 2, 2, '0002-02-07', '2025-01-31', 2),
(2, 1, 2, 1, 2, '2025-01-15', '2025-01-24', 2),
(3, 1, 2, 2, 2, '2025-01-15', '0000-00-00', 2),
(4, 1, 2, 1, 1, '2025-01-16', '0000-00-00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `leaved_require`
--

CREATE TABLE `leaved_require` (
  `id` int(1) NOT NULL,
  `require` varchar(50) NOT NULL,
  `detail` varchar(50) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `leaved_require`
--

INSERT INTO `leaved_require` (`id`, `require`, `detail`, `status`) VALUES
(1, 'ครึ่งวัน', 'หยุดทำไม', 1),
(2, 'เต็มวัน', 'หยุดเป็นเดือนไปเลย', 1);

-- --------------------------------------------------------

--
-- Table structure for table `leaved_type`
--

CREATE TABLE `leaved_type` (
  `id` int(1) NOT NULL,
  `type` varchar(50) NOT NULL,
  `detail` varchar(50) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `leaved_type`
--

INSERT INTO `leaved_type` (`id`, `type`, `detail`, `status`) VALUES
(1, 'ลากิจ', 'อยากหยุด', 1),
(2, 'ลาป่วย', 'ป่วยการเมือง', 1);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(5) NOT NULL,
  `type` int(1) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `type`, `name`, `address`, `status`) VALUES
(1, 1, 'dsds', 'dsdsds', 1);

-- --------------------------------------------------------

--
-- Table structure for table `location_product_detail`
--

CREATE TABLE `location_product_detail` (
  `id` int(5) NOT NULL,
  `location_id` int(5) NOT NULL,
  `product_id` int(5) NOT NULL,
  `quantity` int(5) NOT NULL,
  `detail` varchar(50) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(5) NOT NULL,
  `uid` int(5) NOT NULL,
  `action` varchar(50) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `uid`, `action`, `datetime`) VALUES
(1, 2, 'login', '2025-01-18 10:43:59'),
(2, 2, 'loguot', '2025-01-18 13:48:20'),
(3, 2, 'login', '2025-01-19 00:16:10'),
(4, 2, 'Add PR_id 1', '2025-01-19 00:16:27'),
(5, 2, 'Add Batch_id 1', '2025-01-19 00:39:36'),
(6, 2, 'Approve Batch_id 1', '2025-01-19 00:39:38'),
(7, 2, 'Add Production_id 1', '2025-01-19 00:39:44'),
(8, 2, 'Approve Production_id 1', '2025-01-19 00:46:11'),
(9, 2, 'loguot', '2025-01-19 03:57:44'),
(10, 2, 'login', '2025-01-19 14:40:31'),
(11, 2, 'Approve PR_id 1', '2025-01-19 15:31:15'),
(12, 2, 'Add PO_id 1', '2025-01-19 15:31:25'),
(13, 2, 'Approve PO_id 1', '2025-01-19 15:31:29'),
(14, 2, 'Add receive_order_id 3', '2025-01-19 17:12:12'),
(15, 2, 'login', '2025-01-19 20:30:15'),
(16, 2, 'Add receive_order_id 1', '2025-01-19 20:43:24'),
(17, 2, 'Add receive_order_id 1', '2025-01-19 20:46:13'),
(18, 2, 'Add receive_order_id 1', '2025-01-19 20:48:40'),
(19, 2, 'Add receive_order_id 2', '2025-01-19 21:04:02'),
(20, 2, 'In-Active receive_order_id 1', '2025-01-19 23:33:13'),
(21, 2, 'Active receive_order_id 1', '2025-01-19 23:33:15'),
(22, 2, 'In-Active receive_order_id 1', '2025-01-19 23:33:18'),
(23, 2, 'Active receive_order_id 1', '2025-01-19 23:33:20'),
(24, 2, 'Approve receive_order_id 1', '2025-01-20 00:12:51'),
(25, 2, 'Approve receive_order_id 2', '2025-01-20 00:13:57'),
(26, 2, 'Add Batch_id 2', '2025-01-20 00:40:52'),
(27, 2, 'Approve Batch_id 2', '2025-01-20 00:41:00'),
(28, 2, 'Add Production_id 2', '2025-01-20 00:41:12'),
(29, 2, 'loguot', '2025-01-20 03:25:12'),
(30, 4, 'login', '2025-01-20 03:25:20'),
(31, 4, 'loguot', '2025-01-20 03:25:37'),
(32, 2, 'login', '2025-01-20 03:25:47'),
(33, 2, 'loguot', '2025-01-20 03:26:21'),
(34, 4, 'login', '2025-01-20 03:26:55'),
(35, 4, 'loguot', '2025-01-20 03:27:17'),
(36, 4, 'cannot login', '2025-01-20 03:27:24'),
(37, 2, 'login', '2025-01-20 03:27:37'),
(38, 2, 'loguot', '2025-01-20 03:32:27'),
(39, 4, 'login', '2025-01-20 03:32:35'),
(40, 4, 'loguot', '2025-01-20 03:32:42'),
(41, 4, 'login', '2025-01-20 03:32:51'),
(42, 4, 'loguot', '2025-01-20 03:32:55'),
(43, 4, 'cannot login', '2025-01-20 03:33:02'),
(44, 2, 'login', '2025-01-20 03:33:11'),
(45, 2, 'loguot', '2025-01-20 03:36:52'),
(46, 4, 'cannot login', '2025-01-20 03:37:02'),
(47, 4, 'login', '2025-01-20 03:37:06'),
(48, 4, 'loguot', '2025-01-20 03:38:27'),
(49, 4, 'cannot login', '2025-01-20 03:38:39'),
(50, 4, 'cannot login', '2025-01-20 03:38:44'),
(51, 4, 'login', '2025-01-20 03:38:48'),
(52, 4, 'loguot', '2025-01-20 03:38:56'),
(53, 2, 'login', '2025-01-20 03:39:04'),
(54, 2, 'Add Quontation_id 1', '2025-01-20 04:47:07'),
(55, 2, 'Approve Quontation_id 1', '2025-01-20 04:47:10'),
(56, 2, 'Add Sale Order_id 1', '2025-01-20 04:47:21'),
(57, 2, 'Approve Sale Order_id 1', '2025-01-20 04:47:25'),
(58, 2, 'Add Requisition_id 1', '2025-01-20 04:49:39'),
(59, 2, 'Approve requisition_id 1', '2025-01-20 05:00:55'),
(60, 2, 'Add Requisition_id 1', '2025-01-20 05:14:22'),
(61, 2, 'Approve requisition_id 1', '2025-01-20 05:16:26'),
(62, 2, 'loguot', '2025-01-20 05:29:21'),
(63, 2, 'login', '2025-01-20 10:59:12'),
(64, 2, 'Add Batch_id 3', '2025-01-20 11:01:18'),
(65, 2, 'Approve Batch_id 3', '2025-01-20 11:01:20'),
(66, 2, 'Add Production_id 3', '2025-01-20 11:01:30'),
(67, 2, 'Approve Production_id 3', '2025-01-20 11:01:34'),
(68, 2, 'Add Delivery_id 1', '2025-01-20 11:08:25'),
(69, 2, 'Approve Delivery_id 1', '2025-01-20 11:08:29'),
(70, 2, 'Add Receipt_id 1', '2025-01-20 11:08:44'),
(71, 2, 'Add Quontation_id 2', '2025-01-20 11:35:07'),
(72, 2, 'Approve Quontation_id 2', '2025-01-20 11:35:12'),
(73, 2, 'Add Sale Order_id 2', '2025-01-20 11:36:05'),
(74, 2, 'Approve Sale Order_id 2', '2025-01-20 11:36:15'),
(75, 2, 'Add Requisition_id 2', '2025-01-20 11:59:32'),
(76, 2, 'Add Quontation_id 3', '2025-01-20 12:30:06'),
(77, 2, 'Approve Quontation_id 3', '2025-01-20 12:30:10'),
(78, 2, 'Add Sale Order_id 3', '2025-01-20 12:30:23'),
(79, 2, 'Approve Sale Order_id 3', '2025-01-20 12:30:32'),
(80, 2, 'Add Batch_id 4', '2025-01-20 13:40:54'),
(81, 2, 'Add Batch_id 5', '2025-01-20 13:51:16'),
(82, 2, 'Approve Batch_id 5', '2025-01-20 13:53:17'),
(83, 2, 'Add Batch_id 1', '2025-01-20 14:02:02'),
(84, 2, 'Approve Batch_id 1', '2025-01-20 14:02:05'),
(85, 2, 'loguot', '2025-01-20 14:51:16'),
(86, 0, 'cannot login', '2025-01-20 14:51:25'),
(87, 2, 'login', '2025-01-20 14:51:51'),
(88, 2, 'loguot', '2025-01-20 14:52:10'),
(89, 2, 'login', '2025-01-20 14:52:18'),
(90, 2, 'loguot', '2025-01-20 14:58:57'),
(91, 2, 'login', '2025-01-20 14:59:05'),
(92, 2, 'Add Batch_id 2', '2025-01-20 15:48:21'),
(93, 2, 'Approve Batch_id 2', '2025-01-20 15:48:23'),
(94, 2, 'Add Production_id 1', '2025-01-20 15:53:38'),
(95, 2, 'Add Production_id 2', '2025-01-20 15:54:05'),
(96, 2, 'Add Batch_id 1', '2025-01-20 15:59:10'),
(97, 2, 'Approve Batch_id 1', '2025-01-20 15:59:25'),
(98, 2, 'Add Production_id 1', '2025-01-20 16:00:49'),
(99, 2, 'Add Production_id 1', '2025-01-20 16:03:09'),
(100, 2, 'Add PR_id 2', '2025-01-20 16:24:05'),
(101, 2, 'Approve PR_id 2', '2025-01-20 16:24:12'),
(102, 2, 'Add PO_id 2', '2025-01-20 16:24:32'),
(103, 2, 'Approve PO_id 2', '2025-01-20 16:24:37'),
(104, 2, 'Add receive_order_id 3', '2025-01-20 16:25:04'),
(105, 2, 'Approve receive_order_id 3', '2025-01-20 16:25:10'),
(106, 2, 'Add Payment_id 1', '2025-01-20 16:25:23'),
(107, 2, 'Approve Payment_id 1', '2025-01-20 16:25:30'),
(108, 2, 'Add Quontation_id 4', '2025-01-20 16:27:29'),
(109, 2, 'Approve Quontation_id 4', '2025-01-20 16:27:33'),
(110, 2, 'Add Sale Order_id 4', '2025-01-20 16:27:51'),
(111, 2, 'Approve Sale Order_id 4', '2025-01-20 16:27:56'),
(112, 2, 'Add Requisition_id 3', '2025-01-20 16:28:16'),
(113, 2, 'Approve requisition_id 3', '2025-01-20 16:28:36'),
(114, 2, 'Add Delivery_id 2', '2025-01-20 16:28:49'),
(115, 2, 'Approve Delivery_id 2', '2025-01-20 16:28:58'),
(116, 2, 'Add Receipt_id 2', '2025-01-20 16:29:05'),
(117, 2, 'Approve requisition_id 2', '2025-01-20 16:31:03'),
(118, 2, 'Add Batch_id 2', '2025-01-20 16:31:31'),
(119, 2, 'Approve Batch_id 2', '2025-01-20 16:31:34'),
(120, 2, 'Add Production_id 2', '2025-01-20 16:31:42'),
(121, 2, 'Approve Production_id 2', '2025-01-20 16:32:07'),
(122, 2, 'Approve Production_id 1', '2025-01-20 16:32:30'),
(123, 2, 'Add PR_id 3', '2025-01-20 16:42:17'),
(124, 2, 'Approve PR_id 3', '2025-01-20 16:42:21'),
(125, 2, 'Add PO_id 3', '2025-01-20 16:42:39'),
(126, 2, 'Approve PO_id 3', '2025-01-20 16:42:43'),
(127, 2, 'Add receive_order_id 4', '2025-01-20 16:43:00'),
(128, 2, 'Approve receive_order_id 4', '2025-01-20 16:43:03'),
(129, 2, 'Add Payment_id 2', '2025-01-20 16:43:10'),
(130, 2, 'Approve Payment_id 2', '2025-01-20 16:43:13'),
(131, 2, 'Add Quontation_id 5', '2025-01-20 16:48:34'),
(132, 2, 'Approve Quontation_id 5', '2025-01-20 16:48:37'),
(133, 2, 'Add Sale Order_id 5', '2025-01-20 16:48:45'),
(134, 2, 'Approve Sale Order_id 5', '2025-01-20 16:48:49'),
(135, 2, 'Add Requisition_id 4', '2025-01-20 16:48:55'),
(136, 2, 'Approve requisition_id 4', '2025-01-20 16:49:02'),
(137, 2, 'Add Delivery_id 3', '2025-01-20 16:49:11'),
(138, 2, 'Approve Delivery_id 3', '2025-01-20 16:49:17'),
(139, 2, 'Add Receipt_id 3', '2025-01-20 16:49:22'),
(140, 2, 'Add Batch_id 3', '2025-01-20 16:49:58'),
(141, 2, 'Approve Batch_id 3', '2025-01-20 16:50:02'),
(142, 2, 'Add Production_id 3', '2025-01-20 16:50:12'),
(143, 2, 'Approve Production_id 3', '2025-01-20 16:50:16'),
(144, 2, 'Add receive_order_id 5', '2025-01-20 16:51:21'),
(145, 2, 'Approve receive_order_id 5', '2025-01-20 16:51:23'),
(146, 2, 'Add Batch_id 4', '2025-01-20 16:52:03'),
(147, 2, 'Approve Batch_id 4', '2025-01-20 16:52:05'),
(148, 2, 'Add Production_id 4', '2025-01-20 16:52:12'),
(149, 2, 'Approve Production_id 4', '2025-01-20 16:52:15'),
(150, 2, 'Add receive_order_id 6', '2025-01-20 16:52:54'),
(151, 2, 'Approve receive_order_id 6', '2025-01-20 16:52:58'),
(152, 2, 'Add Delivery_id 4', '2025-01-20 17:27:02'),
(153, 2, 'Approve Delivery_id 4', '2025-01-20 17:27:05'),
(154, 2, 'Add Quontation_id 6', '2025-01-20 17:30:53'),
(155, 2, 'Approve Quontation_id 6', '2025-01-20 17:30:55'),
(156, 2, 'Add Sale Order_id 6', '2025-01-20 17:31:04'),
(157, 2, 'Approve Sale Order_id 6', '2025-01-20 17:31:05'),
(158, 2, 'Add Delivery_id 5', '2025-01-20 17:31:11'),
(159, 2, 'login', '2025-01-22 00:03:51'),
(160, 2, 'Approve Leaved 3', '2025-01-22 00:57:34'),
(161, 2, 'Approve Leaved 4', '2025-01-22 01:02:01');

-- --------------------------------------------------------

--
-- Table structure for table `open_batch`
--

CREATE TABLE `open_batch` (
  `id` int(5) NOT NULL,
  `uid` int(5) NOT NULL,
  `apv_uid` int(5) NOT NULL,
  `date` date NOT NULL,
  `apv_date` date NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `open_batch`
--

INSERT INTO `open_batch` (`id`, `uid`, `apv_uid`, `date`, `apv_date`, `status`) VALUES
(1, 2, 2, '2025-01-20', '2025-01-20', 2),
(2, 2, 2, '2025-01-20', '2025-01-20', 2),
(3, 2, 2, '2025-01-20', '2025-01-20', 2),
(4, 2, 2, '2025-01-20', '2025-01-20', 2);

-- --------------------------------------------------------

--
-- Table structure for table `open_batch_detail`
--

CREATE TABLE `open_batch_detail` (
  `id` int(5) NOT NULL,
  `batch_id` int(5) NOT NULL,
  `product_id` int(5) NOT NULL,
  `quantity` int(5) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `open_batch_detail`
--

INSERT INTO `open_batch_detail` (`id`, `batch_id`, `product_id`, `quantity`, `status`) VALUES
(1, 1, 1, 10, 1),
(2, 1, 8, 5, 1),
(3, 1, 9, 5, 1),
(4, 2, 1, 7, 1),
(5, 2, 2, 8, 1),
(6, 2, 3, 9, 1),
(7, 2, 8, 5, 1),
(8, 2, 9, 6, 1),
(9, 2, 10, 7, 1),
(10, 3, 1, 8, 1),
(11, 3, 2, 9, 1),
(12, 3, 3, 6, 1),
(13, 4, 1, 8, 1),
(14, 4, 2, 8, 1),
(15, 4, 8, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(5) NOT NULL,
  `po_id` int(5) NOT NULL,
  `supplier_id` int(5) NOT NULL,
  `uid` int(5) NOT NULL,
  `apv_uid` int(5) NOT NULL,
  `date` date NOT NULL,
  `apv_date` date NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `po_id`, `supplier_id`, `uid`, `apv_uid`, `date`, `apv_date`, `status`) VALUES
(1, 2, 2, 2, 2, '2025-01-20', '2025-01-20', 2),
(2, 3, 2, 2, 2, '2025-01-20', '2025-01-20', 2);

-- --------------------------------------------------------

--
-- Table structure for table `payment_detail`
--

CREATE TABLE `payment_detail` (
  `id` int(5) NOT NULL,
  `payment_id` int(5) NOT NULL,
  `product_id` int(5) NOT NULL,
  `quantity` int(5) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment_detail`
--

INSERT INTO `payment_detail` (`id`, `payment_id`, `product_id`, `quantity`, `price`, `status`) VALUES
(1, 1, 1, 5, '40.00', 1),
(2, 1, 2, 7, '30.00', 1),
(3, 1, 3, 8, '20.00', 1),
(4, 2, 1, 45, '40.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `po`
--

CREATE TABLE `po` (
  `id` int(5) NOT NULL,
  `pr_id` int(5) NOT NULL,
  `supplier_id` int(5) NOT NULL,
  `uid` int(5) NOT NULL,
  `apv_uid` int(5) NOT NULL,
  `date` date NOT NULL,
  `apv_date` date NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `po`
--

INSERT INTO `po` (`id`, `pr_id`, `supplier_id`, `uid`, `apv_uid`, `date`, `apv_date`, `status`) VALUES
(1, 1, 1, 2, 2, '2025-01-19', '2025-01-19', 2),
(2, 2, 2, 2, 2, '2025-01-20', '2025-01-20', 2),
(3, 3, 2, 2, 2, '2025-01-20', '2025-01-20', 2);

-- --------------------------------------------------------

--
-- Table structure for table `po_detail`
--

CREATE TABLE `po_detail` (
  `id` int(5) NOT NULL,
  `po_id` int(5) NOT NULL,
  `product_id` int(5) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(5) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `po_detail`
--

INSERT INTO `po_detail` (`id`, `po_id`, `product_id`, `price`, `quantity`, `status`) VALUES
(1, 1, 1, '40.00', 10, 1),
(2, 2, 1, '40.00', 5, 1),
(3, 2, 2, '30.00', 7, 1),
(4, 2, 3, '20.00', 8, 1),
(5, 3, 1, '40.00', 45, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pr`
--

CREATE TABLE `pr` (
  `id` int(5) NOT NULL,
  `uid` int(5) NOT NULL,
  `apv_uid` int(5) NOT NULL,
  `date` date NOT NULL,
  `apv_date` date NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pr`
--

INSERT INTO `pr` (`id`, `uid`, `apv_uid`, `date`, `apv_date`, `status`) VALUES
(1, 2, 2, '2025-01-19', '2025-01-19', 2),
(2, 2, 2, '2025-01-20', '2025-01-20', 2),
(3, 2, 2, '2025-01-20', '2025-01-20', 2);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(5) NOT NULL,
  `type` int(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `unit` varchar(30) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `type`, `name`, `price`, `unit`, `status`) VALUES
(1, 1, 'น้ำมันปาล์ม', '40.00', 'ลิตร', 1),
(2, 1, 'กระเทียม', '30.00', 'กิโลกรัม', 1),
(3, 1, 'ตะไคร', '20.00', 'กิโลกรัม', 1),
(4, 1, 'มะนาว', '50.00', 'กิโลกรัม', 1),
(5, 1, 'ใบมะกรูต', '70.00', 'กิโลกรัม', 1),
(6, 1, 'พริก', '40.00', 'กิโลกรัม', 1),
(7, 1, 'ใบกะเพา', '60.00', 'กิโลกรัม', 1),
(8, 2, 'มาม่าต้มยำกุ้ง', '174.00', 'ลัง', 1),
(9, 2, 'มาม่าหมูสับ', '174.00', 'ลัง', 1),
(10, 2, 'มาม่าหม่าล่าเนื้อ', '174.00', 'ลัง', 1);

-- --------------------------------------------------------

--
-- Table structure for table `production`
--

CREATE TABLE `production` (
  `id` int(5) NOT NULL,
  `op_batch_id` int(5) NOT NULL,
  `uid` int(5) NOT NULL,
  `apv_uid` int(5) NOT NULL,
  `date` date NOT NULL,
  `apv_date` date NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `production`
--

INSERT INTO `production` (`id`, `op_batch_id`, `uid`, `apv_uid`, `date`, `apv_date`, `status`) VALUES
(1, 1, 2, 2, '2025-01-20', '2025-01-20', 2),
(2, 2, 2, 2, '2025-01-20', '2025-01-20', 2),
(3, 3, 2, 2, '2025-01-20', '2025-01-20', 2),
(4, 4, 2, 2, '2025-01-20', '2025-01-20', 2);

-- --------------------------------------------------------

--
-- Table structure for table `production_detail`
--

CREATE TABLE `production_detail` (
  `id` int(5) NOT NULL,
  `pdt_id` int(5) NOT NULL,
  `product_id` int(5) NOT NULL,
  `quantity` int(5) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `production_detail`
--

INSERT INTO `production_detail` (`id`, `pdt_id`, `product_id`, `quantity`, `status`) VALUES
(1, 1, 1, 10, 1),
(2, 1, 8, 5, 1),
(3, 1, 9, 5, 1),
(4, 2, 1, 7, 1),
(5, 2, 2, 8, 1),
(6, 2, 3, 9, 1),
(7, 2, 8, 5, 1),
(8, 2, 9, 6, 1),
(9, 2, 10, 7, 1),
(10, 3, 1, 8, 1),
(11, 3, 2, 9, 1),
(12, 3, 3, 6, 1),
(13, 4, 1, 8, 1),
(14, 4, 2, 8, 1),
(15, 4, 8, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `production_lost`
--

CREATE TABLE `production_lost` (
  `id` int(5) NOT NULL,
  `pdt_id` int(5) NOT NULL,
  `uid` int(5) NOT NULL,
  `date` date NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `production_lost`
--

INSERT INTO `production_lost` (`id`, `pdt_id`, `uid`, `date`, `status`) VALUES
(1, 3, 2, '2025-01-20', 1),
(2, 2, 2, '2025-01-20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `production_lost_detail`
--

CREATE TABLE `production_lost_detail` (
  `id` int(5) NOT NULL,
  `pdl_id` int(5) NOT NULL,
  `product_id` int(5) NOT NULL,
  `loss_num` int(5) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `production_lost_detail`
--

INSERT INTO `production_lost_detail` (`id`, `pdl_id`, `product_id`, `loss_num`, `status`) VALUES
(1, 1, 8, 10, 1),
(2, 2, 1, 7, 1),
(3, 2, 2, 8, 1),
(4, 2, 3, 0, 1),
(5, 2, 8, 0, 1),
(6, 2, 9, 0, 1),
(7, 2, 10, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `production_result`
--

CREATE TABLE `production_result` (
  `id` int(5) NOT NULL,
  `pdt_id` int(5) NOT NULL,
  `uid` int(5) NOT NULL,
  `date` date NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `production_result`
--

INSERT INTO `production_result` (`id`, `pdt_id`, `uid`, `date`, `status`) VALUES
(1, 1, 2, '2025-01-19', 1),
(2, 3, 2, '2025-01-20', 1),
(3, 4, 2, '2025-01-20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `production_result_detail`
--

CREATE TABLE `production_result_detail` (
  `id` int(5) NOT NULL,
  `pdr_id` int(5) NOT NULL,
  `product_id` int(5) NOT NULL,
  `pdt_num` int(5) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `production_result_detail`
--

INSERT INTO `production_result_detail` (`id`, `pdr_id`, `product_id`, `pdt_num`, `status`) VALUES
(1, 1, 8, 10, 1),
(2, 2, 8, 30, 1),
(3, 3, 1, 0, 1),
(4, 3, 2, 0, 1),
(5, 3, 8, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pr_detail`
--

CREATE TABLE `pr_detail` (
  `id` int(5) NOT NULL,
  `pr_id` int(5) NOT NULL,
  `product_id` int(5) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(5) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pr_detail`
--

INSERT INTO `pr_detail` (`id`, `pr_id`, `product_id`, `price`, `quantity`, `status`) VALUES
(1, 1, 1, '40.00', 10, 1),
(2, 2, 1, '40.00', 5, 1),
(3, 2, 2, '30.00', 7, 1),
(4, 2, 3, '20.00', 8, 1),
(5, 3, 1, '40.00', 45, 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE `purchase_order` (
  `id` int(5) NOT NULL,
  `quo_id` int(5) NOT NULL,
  `customer_id` int(5) NOT NULL,
  `uid` int(5) NOT NULL,
  `apv_uid` int(5) NOT NULL,
  `date` date NOT NULL,
  `apv_date` date NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `purchase_order`
--

INSERT INTO `purchase_order` (`id`, `quo_id`, `customer_id`, `uid`, `apv_uid`, `date`, `apv_date`, `status`) VALUES
(1, 1, 1, 2, 2, '2025-01-20', '2025-01-20', 2),
(2, 2, 2, 2, 2, '2025-01-20', '2025-01-20', 2),
(3, 3, 1, 2, 2, '2025-01-20', '2025-01-20', 2),
(4, 4, 1, 2, 2, '2025-01-20', '2025-01-20', 2),
(5, 5, 2, 2, 2, '2025-01-20', '2025-01-20', 2),
(6, 6, 1, 2, 2, '2025-01-20', '2025-01-20', 2);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_detail`
--

CREATE TABLE `purchase_order_detail` (
  `id` int(5) NOT NULL,
  `pur_ord_id` int(5) NOT NULL,
  `product_id` int(5) NOT NULL,
  `quantity` int(5) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `purchase_order_detail`
--

INSERT INTO `purchase_order_detail` (`id`, `pur_ord_id`, `product_id`, `quantity`, `price`, `status`) VALUES
(1, 1, 9, 10, '174.00', 1),
(2, 2, 8, 4, '174.00', 1),
(3, 3, 8, 40, '174.00', 1),
(4, 4, 8, 8, '174.00', 1),
(5, 4, 9, 7, '174.00', 1),
(6, 4, 10, 9, '174.00', 1),
(7, 5, 8, 8, '174.00', 1),
(8, 6, 8, 4, '174.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `quotation`
--

CREATE TABLE `quotation` (
  `id` int(5) NOT NULL,
  `uid` int(5) NOT NULL,
  `apv_uid` int(5) NOT NULL,
  `date` date NOT NULL,
  `apv_date` date NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `quotation`
--

INSERT INTO `quotation` (`id`, `uid`, `apv_uid`, `date`, `apv_date`, `status`) VALUES
(1, 2, 2, '2025-01-20', '2025-01-20', 2),
(2, 2, 2, '2025-01-20', '2025-01-20', 2),
(3, 2, 2, '2025-01-20', '2025-01-20', 2),
(4, 2, 2, '2025-01-20', '2025-01-20', 2),
(5, 2, 2, '2025-01-20', '2025-01-20', 2),
(6, 2, 2, '2025-01-20', '2025-01-20', 2);

-- --------------------------------------------------------

--
-- Table structure for table `quotation_detail`
--

CREATE TABLE `quotation_detail` (
  `id` int(5) NOT NULL,
  `quo_id` int(5) NOT NULL,
  `product_id` int(5) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(5) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `quotation_detail`
--

INSERT INTO `quotation_detail` (`id`, `quo_id`, `product_id`, `price`, `quantity`, `status`) VALUES
(1, 1, 9, '174.00', 10, 1),
(2, 2, 8, '174.00', 4, 1),
(3, 3, 8, '174.00', 40, 1),
(4, 4, 8, '174.00', 8, 1),
(5, 4, 9, '174.00', 7, 1),
(6, 4, 10, '174.00', 9, 1),
(7, 5, 8, '174.00', 8, 1),
(8, 6, 8, '174.00', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `receipt`
--

CREATE TABLE `receipt` (
  `id` int(5) NOT NULL,
  `delivery_id` int(5) NOT NULL,
  `customer_id` int(5) NOT NULL,
  `uid` int(5) NOT NULL,
  `date` date NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `receipt`
--

INSERT INTO `receipt` (`id`, `delivery_id`, `customer_id`, `uid`, `date`, `status`) VALUES
(1, 1, 1, 2, '2025-01-20', 1),
(2, 2, 1, 2, '2025-01-20', 1),
(3, 3, 1, 2, '2025-01-20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `receipt_detail`
--

CREATE TABLE `receipt_detail` (
  `id` int(5) NOT NULL,
  `receipt_id` int(5) NOT NULL,
  `product_id` int(5) NOT NULL,
  `quantity` int(5) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `receipt_detail`
--

INSERT INTO `receipt_detail` (`id`, `receipt_id`, `product_id`, `quantity`, `price`, `status`) VALUES
(1, 1, 9, 10, '174.00', 1),
(2, 2, 8, 8, '174.00', 1),
(3, 2, 9, 7, '174.00', 1),
(4, 2, 10, 9, '174.00', 1),
(5, 3, 8, 40, '174.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `receive_order`
--

CREATE TABLE `receive_order` (
  `id` int(5) NOT NULL,
  `ref_id` int(5) NOT NULL,
  `uid` int(5) NOT NULL,
  `apv_uid` int(5) NOT NULL,
  `type` int(1) NOT NULL,
  `date` date NOT NULL,
  `apv_date` date NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `receive_order`
--

INSERT INTO `receive_order` (`id`, `ref_id`, `uid`, `apv_uid`, `type`, `date`, `apv_date`, `status`) VALUES
(1, 1, 2, 2, 1, '2025-01-19', '2025-01-20', 2),
(2, 1, 2, 2, 2, '2025-01-19', '2025-01-20', 2),
(3, 2, 2, 2, 1, '2025-01-20', '2025-01-20', 2),
(4, 3, 2, 2, 1, '2025-01-20', '2025-01-20', 2),
(5, 3, 2, 2, 2, '2025-01-20', '2025-01-20', 2),
(6, 4, 2, 2, 2, '2025-01-20', '2025-01-20', 2);

-- --------------------------------------------------------

--
-- Table structure for table `receive_order_detail`
--

CREATE TABLE `receive_order_detail` (
  `id` int(5) NOT NULL,
  `receive_id` int(5) NOT NULL,
  `product_id` int(5) NOT NULL,
  `quantity` int(5) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `receive_order_detail`
--

INSERT INTO `receive_order_detail` (`id`, `receive_id`, `product_id`, `quantity`, `status`) VALUES
(1, 1, 1, 10, 1),
(2, 2, 8, 10, 1),
(3, 3, 1, 5, 1),
(4, 3, 2, 7, 1),
(5, 3, 3, 8, 1),
(6, 4, 1, 45, 1),
(7, 5, 8, 30, 1),
(8, 6, 1, 8, 1),
(9, 6, 2, 8, 1),
(10, 6, 8, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `requisition`
--

CREATE TABLE `requisition` (
  `id` int(5) NOT NULL,
  `ref_id` int(5) NOT NULL,
  `uid` int(5) NOT NULL,
  `apv_uid` int(5) NOT NULL,
  `type` int(1) NOT NULL,
  `date` date NOT NULL,
  `apv_date` date NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `requisition`
--

INSERT INTO `requisition` (`id`, `ref_id`, `uid`, `apv_uid`, `type`, `date`, `apv_date`, `status`) VALUES
(1, 1, 2, 2, 1, '2025-01-20', '2025-01-20', 2),
(2, 2, 2, 2, 1, '2025-01-20', '2025-01-20', 2),
(3, 4, 2, 2, 1, '2025-01-20', '2025-01-20', 2),
(4, 3, 2, 2, 1, '2025-01-20', '2025-01-20', 2);

-- --------------------------------------------------------

--
-- Table structure for table `requisition_detail`
--

CREATE TABLE `requisition_detail` (
  `id` int(5) NOT NULL,
  `req_id` int(5) NOT NULL,
  `product_id` int(5) NOT NULL,
  `quantity` int(5) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `requisition_detail`
--

INSERT INTO `requisition_detail` (`id`, `req_id`, `product_id`, `quantity`, `status`) VALUES
(1, 1, 9, 10, 1),
(2, 2, 8, 4, 1),
(3, 3, 8, 8, 1),
(4, 3, 9, 7, 1),
(5, 3, 10, 9, 1),
(6, 4, 8, 40, 1);

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `id` int(5) NOT NULL,
  `emp_id` int(5) NOT NULL,
  `uid` int(5) NOT NULL,
  `apv_uid` int(5) NOT NULL,
  `date` date NOT NULL,
  `apv_date` date NOT NULL,
  `salary` decimal(10,2) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`id`, `emp_id`, `uid`, `apv_uid`, `date`, `apv_date`, `salary`, `status`) VALUES
(1, 1, 2, 0, '2025-01-11', '0000-00-00', '456565.00', 1),
(2, 1, 2, 0, '2025-01-15', '0000-00-00', '0.00', 1),
(3, 2, 2, 2, '2025-01-20', '2025-01-20', '48000.00', 2),
(4, 1, 2, 2, '2025-01-20', '2025-01-20', '15000.00', 2),
(5, 4, 2, 0, '2025-01-22', '0000-00-00', '67949.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `supplier_data`
--

CREATE TABLE `supplier_data` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `tel` varchar(10) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `supplier_data`
--

INSERT INTO `supplier_data` (`id`, `name`, `address`, `tel`, `status`) VALUES
(1, 'บริษัท thai nippon foods', '1/21 สวนอุตสาหกรรมโรจนะ หมู่ 5 ตำบลคานหาม อำเภออุทัย จังหวัดพระนครศรีอยุธยา 13210', '098xxx4859', 1),
(2, 'บริษัท โกโก้หมักหมู  จำกัดมหาชน', '1/21 สวนอุตสาหกรรมโรจนะ หมู่ 5 ตำบลคานหาม อำเภออุทัย จังหวัดพระนครศรีอยุธยา 13210', '0981234859', 1),
(3, 'บริษัท มาม่า', 'จันทน์ 45', '0802276598', 1),
(4, 'บริษัท ไวไว', 'ดาวพลูโต', '0111111111', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `firstname`, `lastname`, `email`, `phone`, `status`) VALUES
(1, 'admin12345', '$2y$10$5HMo2f0sfrnQZr2KoTKqr.RzPsbXP7A/8LcsWe7mnGt', 'ศุภกิจ', 'อารีย์', '48998@suthi.ac.th', '0989909665', 1),
(2, 'admin1234', '$2y$10$oROKwEOKlfL/TRVm.ukyN.Apopm/A6wU9b99boplK2n4xMKSZ.cA.', 'พิชาญ', 'กล้าวิเศษ', '48998@suthi.ac.th', '0989909665', 1),
(3, 'user1234', '$2y$10$YXpQts4mphyDYgLha8shluF/w1Gbk6Q2jGmF5K3njqWMfyUqjS/iS', 'อภิวัด', 'กา', 'royuti@gmail.com', '0894456123', 1),
(4, 'purchase', '$2y$10$q34Qx.u8JaEdcZF3p.Yd2uRnHX0CD.huc3ZsFPLdytY9S2CA1WGgC', 'yoyo', 'hoho', 'tyfo@gmail.com', '1234567894', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE `user_group` (
  `id` int(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `detail` varchar(50) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`id`, `name`, `detail`, `status`) VALUES
(1, 'Purchase', '', 1),
(2, 'Sale Manager', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_in_group`
--

CREATE TABLE `user_in_group` (
  `id` int(5) NOT NULL,
  `uid` int(5) NOT NULL,
  `ug_id` int(5) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_in_group`
--

INSERT INTO `user_in_group` (`id`, `uid`, `ug_id`, `status`) VALUES
(1, 2, 1, 1),
(2, 1, 2, 0),
(3, 2, 2, 0),
(4, 1, 2, 0),
(5, 2, 2, 0),
(6, 1, 2, 1),
(7, 2, 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acc`
--
ALTER TABLE `acc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `access_control_list`
--
ALTER TABLE `access_control_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounting_type`
--
ALTER TABLE `accounting_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `acc_detil`
--
ALTER TABLE `acc_detil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_data`
--
ALTER TABLE `customer_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_detail`
--
ALTER TABLE `delivery_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inspection`
--
ALTER TABLE `inspection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inspection_detail`
--
ALTER TABLE `inspection_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `in_out_working`
--
ALTER TABLE `in_out_working`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaved`
--
ALTER TABLE `leaved`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaved_require`
--
ALTER TABLE `leaved_require`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaved_type`
--
ALTER TABLE `leaved_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location_product_detail`
--
ALTER TABLE `location_product_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `open_batch`
--
ALTER TABLE `open_batch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `open_batch_detail`
--
ALTER TABLE `open_batch_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_detail`
--
ALTER TABLE `payment_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `po`
--
ALTER TABLE `po`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `po_detail`
--
ALTER TABLE `po_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pr`
--
ALTER TABLE `pr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `production`
--
ALTER TABLE `production`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `production_detail`
--
ALTER TABLE `production_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `production_lost`
--
ALTER TABLE `production_lost`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `production_lost_detail`
--
ALTER TABLE `production_lost_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `production_result`
--
ALTER TABLE `production_result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `production_result_detail`
--
ALTER TABLE `production_result_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pr_detail`
--
ALTER TABLE `pr_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_order_detail`
--
ALTER TABLE `purchase_order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotation`
--
ALTER TABLE `quotation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotation_detail`
--
ALTER TABLE `quotation_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receipt`
--
ALTER TABLE `receipt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receipt_detail`
--
ALTER TABLE `receipt_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receive_order`
--
ALTER TABLE `receive_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receive_order_detail`
--
ALTER TABLE `receive_order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requisition`
--
ALTER TABLE `requisition`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requisition_detail`
--
ALTER TABLE `requisition_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier_data`
--
ALTER TABLE `supplier_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_in_group`
--
ALTER TABLE `user_in_group`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acc`
--
ALTER TABLE `acc`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `access_control_list`
--
ALTER TABLE `access_control_list`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `accounting_type`
--
ALTER TABLE `accounting_type`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `acc_detil`
--
ALTER TABLE `acc_detil`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `application`
--
ALTER TABLE `application`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer_data`
--
ALTER TABLE `customer_data`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `delivery_detail`
--
ALTER TABLE `delivery_detail`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `inspection`
--
ALTER TABLE `inspection`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inspection_detail`
--
ALTER TABLE `inspection_detail`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `in_out_working`
--
ALTER TABLE `in_out_working`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `leaved`
--
ALTER TABLE `leaved`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `leaved_require`
--
ALTER TABLE `leaved_require`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `leaved_type`
--
ALTER TABLE `leaved_type`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `location_product_detail`
--
ALTER TABLE `location_product_detail`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT for table `open_batch`
--
ALTER TABLE `open_batch`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `open_batch_detail`
--
ALTER TABLE `open_batch_detail`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment_detail`
--
ALTER TABLE `payment_detail`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `po`
--
ALTER TABLE `po`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `po_detail`
--
ALTER TABLE `po_detail`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pr`
--
ALTER TABLE `pr`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `production`
--
ALTER TABLE `production`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `production_detail`
--
ALTER TABLE `production_detail`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `production_lost`
--
ALTER TABLE `production_lost`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `production_lost_detail`
--
ALTER TABLE `production_lost_detail`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `production_result`
--
ALTER TABLE `production_result`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `production_result_detail`
--
ALTER TABLE `production_result_detail`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pr_detail`
--
ALTER TABLE `pr_detail`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `purchase_order`
--
ALTER TABLE `purchase_order`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `purchase_order_detail`
--
ALTER TABLE `purchase_order_detail`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `quotation`
--
ALTER TABLE `quotation`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `quotation_detail`
--
ALTER TABLE `quotation_detail`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `receipt`
--
ALTER TABLE `receipt`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `receipt_detail`
--
ALTER TABLE `receipt_detail`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `receive_order`
--
ALTER TABLE `receive_order`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `receive_order_detail`
--
ALTER TABLE `receive_order_detail`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `requisition`
--
ALTER TABLE `requisition`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `requisition_detail`
--
ALTER TABLE `requisition_detail`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `supplier_data`
--
ALTER TABLE `supplier_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_group`
--
ALTER TABLE `user_group`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_in_group`
--
ALTER TABLE `user_in_group`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
