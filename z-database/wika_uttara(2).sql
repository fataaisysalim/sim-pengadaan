-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2016 at 01:50 PM
-- Server version: 10.0.17-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wika_uttara`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `activity_id` int(15) NOT NULL,
  `users_id` int(11) NOT NULL,
  `activity_date` datetime DEFAULT NULL,
  `activity_action` text,
  `activity_ct` varchar(50) DEFAULT NULL,
  `activity_agent` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`activity_id`, `users_id`, `activity_date`, `activity_action`, `activity_ct`, `activity_agent`) VALUES
(1, 1, '2016-05-04 17:20:53', 'Log in system', 'access', '192.168.1.107;Chrome;Unknown Windows OS'),
(2, 1, '2016-05-04 17:21:08', 'Created <b>OPO</b> on Master Material Category', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(3, 1, '2016-05-04 17:21:12', 'Deleted <b>OPO</b> of Master Material Category', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(4, 1, '2016-05-04 17:21:26', 'Created <b>OPO</b> on Master Material Sub', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(5, 1, '2016-05-04 17:21:34', 'Updated <b>OPO</b> on Master Material Sub', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(6, 1, '2016-05-04 17:21:38', 'Deleted <b>OPO</b> of Master Material Sub', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(7, 1, '2016-05-04 17:22:06', 'Created <b>Xiaomi</b> on Master Equipment', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(8, 1, '2016-05-04 17:22:14', 'Updated <b>Xiaomi Yi</b> on Master Equipment', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(9, 1, '2016-05-04 17:22:21', 'Deleted <b>Xiaomi Yi</b> of Master Equipment', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(10, 1, '2016-05-04 17:22:29', 'Created <b>Alat Sedang</b> on Master Equipment Category', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(11, 1, '2016-05-04 17:22:33', 'Deleted <b>Alat Sedang</b> of Master Equipment Category', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(12, 1, '2016-05-04 17:22:40', 'Created <b>Bks</b> on Master Equipment Unit', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(13, 1, '2016-05-04 17:22:44', 'Deleted <b>Bks</b> of Master Equipment Unit', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(14, 1, '2016-05-04 17:27:51', 'Created <b>Wo</b> on Master Resource Code', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(15, 1, '2016-05-04 17:27:57', 'Updated <b>Wow</b> on Master Resource Code', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(16, 1, '2016-05-04 17:28:42', 'Created <b>aaa</b> on Work Order', 'procurement', '192.168.1.107;Chrome;Unknown Windows OS'),
(17, 1, '2016-05-04 17:28:42', 'Created <b>laundry (1246)</b> on Work Order', 'procurement', '192.168.1.107;Chrome;Unknown Windows OS'),
(18, 1, '2016-05-04 17:29:05', 'edit <b>laundry (1246)</b> on Work Order', 'procurement', '192.168.1.107;Chrome;Unknown Windows OS'),
(19, 1, '2016-05-04 17:29:28', 'edit <b>laundry (1246)</b> on Work Order', 'procurement', '192.168.1.107;Chrome;Unknown Windows OS'),
(20, 1, '2016-05-04 17:47:05', 'Log in system', 'access', '192.168.1.102;Firefox;Unknown Windows OS'),
(21, 1, '2016-05-04 17:49:08', 'Logout of system', 'access', '192.168.1.107;Chrome;Unknown Windows OS'),
(22, 21, '2016-05-04 17:49:18', 'Log in system', 'access', '192.168.1.107;Chrome;Unknown Windows OS'),
(23, 21, '2016-05-04 17:50:29', 'Created <b>pemasangan genteng (4545554)</b> on Work Order', 'procurement', '192.168.1.107;Chrome;Unknown Windows OS'),
(24, 21, '2016-05-04 17:50:43', 'edit <b>laundry (12465)</b> on Work Order', 'procurement', '192.168.1.107;Chrome;Unknown Windows OS'),
(25, 21, '2016-05-04 17:52:46', 'Created <b>123ab</b> on Work Order', 'procurement', '192.168.1.107;Chrome;Unknown Windows OS'),
(26, 21, '2016-05-04 17:52:46', 'Created <b>cuci piring (785212)</b> on Work Order', 'procurement', '192.168.1.107;Chrome;Unknown Windows OS'),
(27, 21, '2016-05-04 17:55:36', 'Created <b>ngepel (5545455)</b> on Work Order', 'procurement', '192.168.1.107;Chrome;Unknown Windows OS'),
(28, 21, '2016-05-04 17:56:14', 'Created <b>abc (122221)</b> on Work Order', 'procurement', '192.168.1.107;Chrome;Unknown Windows OS'),
(29, 21, '2016-05-04 17:56:41', 'Logout of system', 'access', '192.168.1.107;Chrome;Unknown Windows OS'),
(30, 1, '2016-05-04 17:57:03', 'Log in system', 'access', '192.168.1.107;Chrome;Unknown Windows OS'),
(31, 1, '2016-05-04 17:57:19', 'Logout of system', 'access', '192.168.1.107;Chrome;Unknown Windows OS'),
(32, 27, '2016-05-04 17:57:27', 'Log in system', 'access', '192.168.1.107;Chrome;Unknown Windows OS'),
(33, 27, '2016-05-04 17:58:24', 'Created invoice No. 123456 on Invoice Transaction', 'finance', '192.168.1.107;Chrome;Unknown Windows OS'),
(34, 27, '2016-05-04 17:59:11', 'Created invoice No. 1355 on Invoice Transaction', 'finance', '192.168.1.107;Chrome;Unknown Windows OS'),
(35, 27, '2016-05-04 18:00:54', 'Created invoice No. 156646 on Invoice Transaction', 'finance', '192.168.1.107;Chrome;Unknown Windows OS'),
(36, 27, '2016-05-04 18:01:18', 'Created invoice No. 125355 on Invoice Transaction', 'finance', '192.168.1.107;Chrome;Unknown Windows OS'),
(37, 27, '2016-05-04 18:01:51', 'Created invoice No. 122155 on Invoice Transaction', 'finance', '192.168.1.107;Chrome;Unknown Windows OS'),
(38, 27, '2016-05-04 18:02:42', 'Logout of system', 'access', '192.168.1.107;Chrome;Unknown Windows OS'),
(39, 1, '2016-05-04 18:02:52', 'Log in system', 'access', '192.168.1.107;Chrome;Unknown Windows OS'),
(40, 1, '2016-05-04 18:03:13', 'Created <b>prisma</b> on Master Employee', 'dashboard', '192.168.1.107;Chrome;Unknown Windows OS'),
(41, 1, '2016-05-04 18:03:30', 'Created <b>prisma</b> on Master Users', 'dashboard', '192.168.1.107;Chrome;Unknown Windows OS'),
(42, 1, '2016-05-04 18:03:53', 'Setting access <b>prisma</b> to Proyek Apartemen UTTARA The Icon project', 'dashboard', '192.168.1.107;Chrome;Unknown Windows OS'),
(43, 1, '2016-05-04 18:04:08', 'Logout of system', 'access', '192.168.1.107;Chrome;Unknown Windows OS'),
(44, 1, '2016-05-04 18:04:50', 'Log in system', 'access', '192.168.1.107;Chrome;Unknown Windows OS'),
(45, 1, '2016-05-04 18:05:08', 'Logout of system', 'access', '192.168.1.107;Chrome;Unknown Windows OS'),
(46, 28, '2016-05-04 18:05:27', 'Log in system', 'access', '192.168.1.107;Chrome;Unknown Windows OS'),
(47, 28, '2016-05-04 18:06:18', 'Created invoice No. 123 on Invoice Transaction', 'finance', '192.168.1.107;Chrome;Unknown Windows OS'),
(48, 28, '2016-05-04 18:06:38', 'Logout of system', 'access', '192.168.1.107;Chrome;Unknown Windows OS'),
(49, 1, '2016-05-04 18:06:52', 'Log in system', 'access', '192.168.1.107;Chrome;Unknown Windows OS'),
(50, 1, '2016-05-04 18:07:21', 'Logout of system', 'access', '192.168.1.107;Chrome;Unknown Windows OS'),
(51, 1, '2016-05-04 18:07:46', 'Log in system', 'access', '192.168.1.107;Chrome;Unknown Windows OS'),
(52, 1, '2016-05-04 18:08:02', 'Logout of system', 'access', '192.168.1.107;Chrome;Unknown Windows OS'),
(53, 22, '2016-05-04 18:08:15', 'Log in system', 'access', '192.168.1.107;Chrome;Unknown Windows OS'),
(54, 22, '2016-05-04 18:08:42', 'Logout of system', 'access', '192.168.1.107;Chrome;Unknown Windows OS'),
(55, 1, '2016-05-04 18:08:52', 'Log in system', 'access', '192.168.1.107;Chrome;Unknown Windows OS'),
(56, 1, '2016-05-04 18:11:22', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(57, 1, '2016-05-04 18:11:22', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(58, 1, '2016-05-04 18:11:22', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(59, 1, '2016-05-04 18:11:22', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(60, 1, '2016-05-04 18:11:22', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(61, 1, '2016-05-04 18:11:22', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(62, 1, '2016-05-04 18:11:23', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(63, 1, '2016-05-04 18:11:23', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(64, 1, '2016-05-04 18:11:23', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(65, 1, '2016-05-04 18:11:23', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(66, 1, '2016-05-04 18:11:23', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(67, 1, '2016-05-04 18:11:23', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(68, 1, '2016-05-04 18:11:23', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(69, 1, '2016-05-04 18:11:23', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(70, 1, '2016-05-04 18:11:23', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(71, 1, '2016-05-04 18:11:24', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(72, 1, '2016-05-04 18:11:24', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(73, 1, '2016-05-04 18:11:24', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(74, 1, '2016-05-04 18:11:24', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(75, 1, '2016-05-04 18:11:24', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(76, 1, '2016-05-04 18:11:24', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(77, 1, '2016-05-04 18:11:24', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(78, 1, '2016-05-04 18:11:24', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(79, 1, '2016-05-04 18:11:24', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(80, 1, '2016-05-04 18:11:24', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(81, 1, '2016-05-04 18:11:25', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(82, 1, '2016-05-04 18:11:25', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(83, 1, '2016-05-04 18:11:25', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(84, 1, '2016-05-04 18:11:25', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(85, 1, '2016-05-04 18:11:25', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(86, 1, '2016-05-04 18:11:25', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(87, 1, '2016-05-04 18:11:25', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(88, 1, '2016-05-04 18:11:25', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(89, 1, '2016-05-04 18:11:25', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(90, 1, '2016-05-04 18:11:26', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(91, 1, '2016-05-04 18:11:26', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(92, 1, '2016-05-04 18:11:26', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(93, 1, '2016-05-04 18:11:26', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(94, 1, '2016-05-04 18:11:26', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(95, 1, '2016-05-04 18:11:26', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(96, 1, '2016-05-04 18:11:26', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(97, 1, '2016-05-04 18:11:26', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(98, 1, '2016-05-04 18:11:26', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(99, 1, '2016-05-04 18:11:26', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(100, 1, '2016-05-04 18:11:27', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(101, 1, '2016-05-04 18:11:27', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(102, 1, '2016-05-04 18:11:27', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(103, 1, '2016-05-04 18:11:27', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(104, 1, '2016-05-04 18:11:27', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(105, 1, '2016-05-04 18:11:27', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(106, 1, '2016-05-04 18:11:27', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(107, 1, '2016-05-04 18:11:27', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(108, 1, '2016-05-04 18:11:27', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(109, 1, '2016-05-04 18:11:27', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(110, 1, '2016-05-04 18:11:28', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(111, 1, '2016-05-04 18:11:28', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(112, 1, '2016-05-04 18:11:28', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(113, 1, '2016-05-04 18:11:28', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(114, 1, '2016-05-04 18:11:28', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(115, 1, '2016-05-04 18:11:28', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(116, 1, '2016-05-04 18:11:28', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(117, 1, '2016-05-04 18:11:28', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(118, 1, '2016-05-04 18:11:28', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(119, 1, '2016-05-04 18:11:28', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(120, 1, '2016-05-04 18:11:29', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(121, 1, '2016-05-04 18:11:29', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(122, 1, '2016-05-04 18:11:29', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(123, 1, '2016-05-04 18:11:29', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(124, 1, '2016-05-04 18:11:29', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(125, 1, '2016-05-04 18:11:29', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(126, 1, '2016-05-04 18:11:29', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(127, 1, '2016-05-04 18:11:29', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(128, 1, '2016-05-04 18:11:29', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(129, 1, '2016-05-04 18:11:29', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(130, 1, '2016-05-04 18:11:29', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(131, 1, '2016-05-04 18:11:30', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(132, 1, '2016-05-04 18:11:30', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(133, 1, '2016-05-04 18:11:30', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(134, 1, '2016-05-04 18:11:30', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(135, 1, '2016-05-04 18:11:30', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(136, 1, '2016-05-04 18:11:30', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(137, 1, '2016-05-04 18:11:30', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(138, 1, '2016-05-04 18:11:30', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(139, 1, '2016-05-04 18:11:30', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(140, 1, '2016-05-04 18:11:30', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(141, 1, '2016-05-04 18:11:30', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(142, 1, '2016-05-04 18:11:30', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(143, 1, '2016-05-04 18:11:31', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(144, 1, '2016-05-04 18:11:31', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(145, 1, '2016-05-04 18:11:31', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(146, 1, '2016-05-04 18:11:31', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(147, 1, '2016-05-04 18:11:31', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(148, 1, '2016-05-04 18:11:31', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(149, 1, '2016-05-04 18:11:31', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(150, 1, '2016-05-04 18:11:31', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(151, 1, '2016-05-04 18:11:31', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(152, 1, '2016-05-04 18:11:31', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(153, 1, '2016-05-04 18:11:31', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(154, 1, '2016-05-04 18:11:32', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(155, 1, '2016-05-04 18:11:32', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(156, 1, '2016-05-04 18:11:32', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(157, 1, '2016-05-04 18:11:32', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(158, 1, '2016-05-04 18:11:32', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(159, 1, '2016-05-04 18:11:32', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(160, 1, '2016-05-04 18:11:32', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(161, 1, '2016-05-04 18:11:32', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(162, 1, '2016-05-04 18:11:32', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(163, 1, '2016-05-04 18:11:32', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(164, 1, '2016-05-04 18:11:32', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(165, 1, '2016-05-04 18:11:33', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(166, 1, '2016-05-04 18:11:33', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(167, 1, '2016-05-04 18:11:33', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(168, 1, '2016-05-04 18:11:33', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(169, 1, '2016-05-04 18:11:33', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(170, 1, '2016-05-04 18:11:33', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(171, 1, '2016-05-04 18:11:33', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(172, 1, '2016-05-04 18:11:33', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(173, 1, '2016-05-04 18:11:33', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(174, 1, '2016-05-04 18:11:33', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(175, 1, '2016-05-04 18:11:33', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(176, 1, '2016-05-04 18:11:33', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(177, 1, '2016-05-04 18:11:34', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(178, 1, '2016-05-04 18:11:34', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(179, 1, '2016-05-04 18:11:34', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(180, 1, '2016-05-04 18:11:34', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(181, 1, '2016-05-04 18:11:34', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(182, 1, '2016-05-04 18:11:34', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(183, 1, '2016-05-04 18:11:34', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(184, 1, '2016-05-04 18:11:34', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(185, 1, '2016-05-04 18:11:34', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(186, 1, '2016-05-04 18:11:34', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(187, 1, '2016-05-04 18:11:34', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(188, 1, '2016-05-04 18:11:35', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(189, 1, '2016-05-04 18:11:35', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(190, 1, '2016-05-04 18:11:35', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(191, 1, '2016-05-04 18:11:35', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(192, 1, '2016-05-04 18:11:35', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(193, 1, '2016-05-04 18:11:35', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(194, 1, '2016-05-04 18:11:35', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(195, 1, '2016-05-04 18:11:35', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(196, 1, '2016-05-04 18:11:35', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(197, 1, '2016-05-04 18:11:35', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(198, 1, '2016-05-04 18:11:35', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(199, 1, '2016-05-04 18:11:35', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(200, 1, '2016-05-04 18:11:36', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(201, 1, '2016-05-04 18:11:36', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(202, 1, '2016-05-04 18:11:36', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(203, 1, '2016-05-04 18:11:36', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(204, 1, '2016-05-04 18:11:36', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(205, 1, '2016-05-04 18:11:36', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(206, 1, '2016-05-04 18:11:36', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(207, 1, '2016-05-04 18:11:36', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(208, 1, '2016-05-04 18:11:36', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(209, 1, '2016-05-04 18:11:36', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(210, 1, '2016-05-04 18:11:36', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(211, 1, '2016-05-04 18:11:36', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(212, 1, '2016-05-04 18:11:37', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(213, 1, '2016-05-04 18:11:37', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(214, 1, '2016-05-04 18:11:37', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(215, 1, '2016-05-04 18:11:37', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(216, 1, '2016-05-04 18:11:37', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(217, 1, '2016-05-04 18:11:37', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(218, 1, '2016-05-04 18:11:37', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(219, 1, '2016-05-04 18:11:37', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(220, 1, '2016-05-04 18:11:37', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(221, 1, '2016-05-04 18:11:37', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(222, 1, '2016-05-04 18:11:37', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(223, 1, '2016-05-04 18:11:37', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(224, 1, '2016-05-04 18:11:38', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(225, 1, '2016-05-04 18:11:38', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(226, 1, '2016-05-04 18:11:38', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(227, 1, '2016-05-04 18:11:38', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(228, 1, '2016-05-04 18:11:38', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(229, 1, '2016-05-04 18:11:38', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(230, 1, '2016-05-04 18:11:38', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(231, 1, '2016-05-04 18:11:38', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(232, 1, '2016-05-04 18:11:38', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(233, 1, '2016-05-04 18:11:38', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(234, 1, '2016-05-04 18:11:38', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(235, 1, '2016-05-04 18:11:39', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(236, 1, '2016-05-04 18:11:39', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(237, 1, '2016-05-04 18:11:39', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(238, 1, '2016-05-04 18:11:39', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(239, 1, '2016-05-04 18:11:39', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(240, 1, '2016-05-04 18:11:39', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(241, 1, '2016-05-04 18:11:39', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(242, 1, '2016-05-04 18:11:39', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(243, 1, '2016-05-04 18:11:39', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(244, 1, '2016-05-04 18:11:39', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(245, 1, '2016-05-04 18:11:39', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(246, 1, '2016-05-04 18:11:39', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(247, 1, '2016-05-04 18:11:40', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(248, 1, '2016-05-04 18:11:40', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(249, 1, '2016-05-04 18:11:40', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(250, 1, '2016-05-04 18:11:40', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(251, 1, '2016-05-04 18:11:40', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(252, 1, '2016-05-04 18:11:40', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(253, 1, '2016-05-04 18:11:40', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(254, 1, '2016-05-04 18:11:40', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(255, 1, '2016-05-04 18:11:40', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(256, 1, '2016-05-04 18:11:40', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(257, 1, '2016-05-04 18:11:40', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(258, 1, '2016-05-04 18:11:40', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(259, 1, '2016-05-04 18:11:41', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(260, 1, '2016-05-04 18:11:41', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(261, 1, '2016-05-04 18:11:41', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(262, 1, '2016-05-04 18:11:41', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(263, 1, '2016-05-04 18:11:41', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(264, 1, '2016-05-04 18:11:41', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(265, 1, '2016-05-04 18:12:51', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(266, 1, '2016-05-04 18:12:51', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(267, 1, '2016-05-04 18:12:51', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(268, 1, '2016-05-04 18:12:52', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(269, 1, '2016-05-04 18:12:52', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(270, 1, '2016-05-04 18:12:52', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(271, 1, '2016-05-04 18:12:52', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(272, 1, '2016-05-04 18:12:52', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(273, 1, '2016-05-04 18:12:52', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(274, 1, '2016-05-04 18:12:52', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(275, 1, '2016-05-04 18:12:52', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(276, 1, '2016-05-04 18:12:52', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(277, 1, '2016-05-04 18:12:52', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(278, 1, '2016-05-04 18:12:52', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(279, 1, '2016-05-04 18:12:52', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(280, 1, '2016-05-04 18:12:53', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(281, 1, '2016-05-04 18:12:53', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(282, 1, '2016-05-04 18:12:53', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(283, 1, '2016-05-04 18:12:53', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(284, 1, '2016-05-04 18:12:53', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(285, 1, '2016-05-04 18:12:53', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(286, 1, '2016-05-04 18:12:53', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(287, 1, '2016-05-04 18:12:53', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(288, 1, '2016-05-04 18:12:53', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(289, 1, '2016-05-04 18:12:53', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(290, 1, '2016-05-04 18:12:53', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(291, 1, '2016-05-04 18:12:53', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(292, 1, '2016-05-04 18:12:54', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(293, 1, '2016-05-04 18:12:54', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(294, 1, '2016-05-04 18:12:54', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(295, 1, '2016-05-04 18:12:54', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(296, 1, '2016-05-04 18:12:54', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(297, 1, '2016-05-04 18:12:54', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(298, 1, '2016-05-04 18:12:54', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(299, 1, '2016-05-04 18:12:54', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(300, 1, '2016-05-04 18:12:54', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(301, 1, '2016-05-04 18:13:26', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(302, 1, '2016-05-04 18:13:26', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(303, 1, '2016-05-04 18:13:26', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(304, 1, '2016-05-04 18:13:27', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(305, 1, '2016-05-04 18:13:27', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(306, 1, '2016-05-04 18:13:27', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(307, 1, '2016-05-04 18:13:27', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(308, 1, '2016-05-04 18:13:27', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(309, 1, '2016-05-04 18:13:27', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(310, 1, '2016-05-04 18:13:27', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(311, 1, '2016-05-04 18:13:27', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(312, 1, '2016-05-04 18:13:27', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(313, 1, '2016-05-04 18:13:27', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(314, 1, '2016-05-04 18:13:27', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(315, 1, '2016-05-04 18:13:27', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(316, 1, '2016-05-04 18:13:28', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(317, 1, '2016-05-04 18:13:28', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(318, 1, '2016-05-04 18:13:28', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(319, 1, '2016-05-04 18:13:28', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(320, 1, '2016-05-04 18:13:28', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(321, 1, '2016-05-04 18:13:28', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(322, 1, '2016-05-04 18:13:28', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(323, 1, '2016-05-04 18:13:28', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(324, 1, '2016-05-04 18:13:28', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(325, 1, '2016-05-04 18:13:28', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(326, 1, '2016-05-04 18:13:28', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(327, 1, '2016-05-04 18:13:28', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(328, 1, '2016-05-04 18:13:29', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(329, 1, '2016-05-04 18:13:29', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(330, 1, '2016-05-04 18:13:29', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(331, 1, '2016-05-04 18:13:29', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(332, 1, '2016-05-04 18:13:29', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(333, 1, '2016-05-04 18:13:29', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(334, 1, '2016-05-04 18:13:29', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(335, 1, '2016-05-04 18:13:29', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(336, 1, '2016-05-04 18:13:29', 'Setup initial stock', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(337, 1, '2016-05-04 18:14:09', 'Created BAPB No. <b>000001 (<i>123ab</i>)</b> on Transaction BAPB', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(338, 1, '2016-05-04 18:15:01', 'Created BAPB No. <b>000002 (<i>abc</i>)</b> on Transaction BAPB', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(339, 1, '2016-05-04 18:15:58', 'Created BPM No. <b>000003 (<i>123ab</i>)</b> on Transaction BPM', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(340, 1, '2016-05-04 18:16:33', 'Created BPM No. <b>000004 (<i>abc</i>)</b> on Transaction BPM', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(341, 1, '2016-05-04 18:17:52', 'Created BAPP No. <b>000001 (<i>123ab</i>)</b> on Transaction BAPP', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(342, 1, '2016-05-04 18:18:26', 'Created BAPP No. <b>000002 (<i>abc</i>)</b> on Transaction BAPP', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(343, 1, '2016-05-04 18:19:09', 'Created BPP No. <b>000003 (<i>123ab</i>)</b> on Transaction BPP', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(344, 1, '2016-05-04 18:19:44', 'Created BPP No. <b>000004 (<i>abc</i>)</b> on Transaction BPP', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(345, 1, '2016-05-04 18:20:10', 'Updated BAPB No. <b>000005 (<i>abc</i>)</b> on Transaction BAPB', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(346, 1, '2016-05-04 18:20:30', 'Updated BAPB No. <b>000005 (<i>123ab</i>)</b> on Transaction BAPB', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(347, 1, '2016-05-04 18:20:46', 'Updated BPM No. <b>000005 (<i>123ab</i>)</b> on Transaction BPM', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(348, 1, '2016-05-04 18:21:05', 'Updated BPM No. <b>000005 (<i>abc</i>)</b> on Transaction BPM', 'warehouse', '192.168.1.107;Chrome;Unknown Windows OS'),
(349, 1, '2016-05-04 18:24:11', 'Log in system', 'access', '192.168.1.102;Firefox;Unknown Windows OS');

-- --------------------------------------------------------

--
-- Table structure for table `actor`
--

CREATE TABLE `actor` (
  `actor_id` int(11) NOT NULL,
  `actor_name` varchar(50) NOT NULL,
  `actor_identity` varchar(50) DEFAULT NULL,
  `actor_address` text,
  `actor_phone` varchar(18) DEFAULT NULL,
  `actor_email` varchar(20) DEFAULT NULL,
  `actor_code` varchar(31) DEFAULT NULL,
  `actor_category_id` int(2) DEFAULT NULL,
  `actor_status` int(1) NOT NULL DEFAULT '1',
  `actor_image` varchar(50) DEFAULT NULL,
  `users_id` int(11) NOT NULL,
  `actor_pkp_date` date NOT NULL,
  `actor_pkp_number` varchar(50) NOT NULL,
  `actor_tax_number` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `actor`
--

INSERT INTO `actor` (`actor_id`, `actor_name`, `actor_identity`, `actor_address`, `actor_phone`, `actor_email`, `actor_code`, `actor_category_id`, `actor_status`, `actor_image`, `users_id`, `actor_pkp_date`, `actor_pkp_number`, `actor_tax_number`) VALUES
(1, 'abc', '13654646', 'jakarta', '02134587', NULL, NULL, 2, 1, NULL, 0, '0000-00-00', '', ''),
(2, '123ab', '1235466', 'yogyakarta', '021458656', NULL, NULL, 2, 1, NULL, 0, '0000-00-00', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `actor_category`
--

CREATE TABLE `actor_category` (
  `actor_category_id` int(2) NOT NULL,
  `actor_category_name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `actor_category`
--

INSERT INTO `actor_category` (`actor_category_id`, `actor_category_name`) VALUES
(1, 'Supplier'),
(2, 'Subcon'),
(3, 'Foreman'),
(4, 'Relation');

-- --------------------------------------------------------

--
-- Table structure for table `apps`
--

CREATE TABLE `apps` (
  `apps_id` int(1) NOT NULL,
  `apps_name` varchar(100) DEFAULT NULL,
  `apps_logo` varchar(30) DEFAULT NULL,
  `apps_site` varchar(50) DEFAULT NULL,
  `apps_phone` varchar(18) DEFAULT NULL,
  `apps_mail` varchar(50) DEFAULT NULL,
  `apps_address` text,
  `apps_favicon` varchar(30) DEFAULT NULL,
  `apps_meta_description` text NOT NULL,
  `apps_meta_keyword` text NOT NULL,
  `apps_client` varchar(100) NOT NULL,
  `app_client_npwp` varchar(50) NOT NULL,
  `app_client_npkp` varchar(50) NOT NULL,
  `app_client_npkp_date` date NOT NULL,
  `apps_image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apps`
--

INSERT INTO `apps` (`apps_id`, `apps_name`, `apps_logo`, `apps_site`, `apps_phone`, `apps_mail`, `apps_address`, `apps_favicon`, `apps_meta_description`, `apps_meta_keyword`, `apps_client`, `app_client_npwp`, `app_client_npkp`, `app_client_npkp_date`, `apps_image`) VALUES
(1, 'WG System', '489318logo.png', 'www.wikagedung-system.com', '(0274) 541 802', 'support@wikagedung-system.com', 'Jl. Kaliurang KM 4.5 No 72, Yogyakarta', '465362forconnectLOGO.png', 'WG Project Management System', 'system, erp, project, PM, wika gedung, sg system', 'PT. WIJAYA KARYA BANGUNAN GEDUNG', '01.061.311.5.093.000', '01.061.311.5.093.000', '1965-02-01', '59082back1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `apps_gallery`
--

CREATE TABLE `apps_gallery` (
  `apps_gallery_id` int(3) NOT NULL,
  `apps_gallery_files` varchar(50) DEFAULT NULL,
  `apps_gallery_date` datetime DEFAULT NULL,
  `apps_gallery_status` int(1) DEFAULT NULL,
  `apps_gallery_note` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apps_gallery`
--

INSERT INTO `apps_gallery` (`apps_gallery_id`, `apps_gallery_files`, `apps_gallery_date`, `apps_gallery_status`, `apps_gallery_note`) VALUES
(2, 'assets/folarium/gallery/37866109807.jpg', '0000-00-00 00:00:00', 1, '0'),
(3, 'assets/folarium/gallery/41713567708.jpg', '0000-00-00 00:00:00', 0, '0'),
(4, 'assets/folarium/gallery/45561025709.jpg', '0000-00-00 00:00:00', 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('0848908851001e93dbee91a5a03550a6', '192.168.1.107', 'Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.57 Safari/537.36', 1462357205, ''),
('56cf320238f12e35ad9bf402416271df', '104.148.44.34', '0', 1462360985, ''),
('7f794fc2949b49fc1b814dcef8d94f4a', '192.168.1.102', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0', 1462359662, 'a:2:{s:9:"user_data";s:0:"";s:32:"840a75af69eec69cd03c29bc5050f751";a:3:{s:7:"user_id";s:1:"1";s:11:"position_id";s:1:"1";s:5:"login";b:1;}}'),
('c28257951ece15c3bd384fe0933a498e', '192.168.1.102', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0', 1462361035, 'a:2:{s:9:"user_data";s:0:"";s:32:"840a75af69eec69cd03c29bc5050f751";a:3:{s:7:"user_id";s:1:"1";s:11:"position_id";s:1:"1";s:5:"login";b:1;}}'),
('d06fe3b5836fde4229238c82dc93d115', '5.39.222.159', 'Mozilla/5.0 (Linux; U; Android 4.2.2; en-us; A1-810 Build/JDQ39) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safa', 1462357939, ''),
('e45991f419226fa5286f7f8ee16820db', '192.168.1.107', 'Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.57 Safari/537.36', 1462362483, 'a:2:{s:9:"user_data";s:0:"";s:32:"840a75af69eec69cd03c29bc5050f751";a:3:{s:7:"user_id";s:1:"1";s:11:"position_id";s:1:"1";s:5:"login";b:1;}}');

-- --------------------------------------------------------

--
-- Table structure for table `code`
--

CREATE TABLE `code` (
  `code_id` int(11) NOT NULL,
  `code_ct_id` int(1) NOT NULL,
  `code_name` varchar(50) NOT NULL,
  `code_status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `code`
--

INSERT INTO `code` (`code_id`, `code_ct_id`, `code_name`, `code_status`) VALUES
(1, 1, 'Cek', 1),
(2, 2, 'Tes', 1),
(3, 1, 'Sasa', 1),
(4, 2, 'Fdsfd', 1),
(5, 1, 'Wow', 1);

-- --------------------------------------------------------

--
-- Table structure for table `code_ct`
--

CREATE TABLE `code_ct` (
  `code_ct_id` int(5) NOT NULL,
  `code_ct_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `code_ct`
--

INSERT INTO `code_ct` (`code_ct_id`, `code_ct_name`) VALUES
(1, 'Material'),
(2, 'Equipment');

-- --------------------------------------------------------

--
-- Table structure for table `debt`
--

CREATE TABLE `debt` (
  `debt_id` int(11) NOT NULL,
  `actor_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `equipment_id` int(11) DEFAULT NULL,
  `debt_date` datetime DEFAULT NULL,
  `debt_total` double DEFAULT NULL,
  `debt_rest` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `debt_final`
--

CREATE TABLE `debt_final` (
  `debt_final_id` int(11) NOT NULL,
  `actor_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `equipment_id` int(11) DEFAULT NULL,
  `debt_final_date` datetime DEFAULT NULL,
  `debt_final_rest` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `doc_attach`
--

CREATE TABLE `doc_attach` (
  `doc_attach_id` int(11) NOT NULL,
  `doc_control_id` int(11) NOT NULL,
  `doc_attach_name` varchar(50) DEFAULT NULL,
  `doc_attach_files` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `doc_control`
--

CREATE TABLE `doc_control` (
  `doc_control_id` int(11) NOT NULL,
  `doc_control_letcode_id` int(3) NOT NULL,
  `doc_control_ct_id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `actor_id` int(11) DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL,
  `doc_control_desc` text,
  `doc_control_date` datetime DEFAULT NULL,
  `doc_control_number` varchar(100) DEFAULT NULL,
  `doc_control_case` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `doc_control_ct`
--

CREATE TABLE `doc_control_ct` (
  `doc_control_ct_id` int(11) NOT NULL,
  `doc_control_ct_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doc_control_ct`
--

INSERT INTO `doc_control_ct` (`doc_control_ct_id`, `doc_control_ct_name`) VALUES
(1, 'Masuk'),
(2, 'Keluar');

-- --------------------------------------------------------

--
-- Table structure for table `doc_control_letcode`
--

CREATE TABLE `doc_control_letcode` (
  `doc_control_letcode_id` int(3) NOT NULL,
  `doc_control_letcode_name` varchar(50) DEFAULT NULL,
  `doc_control_letcode_number` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doc_control_letcode`
--

INSERT INTO `doc_control_letcode` (`doc_control_letcode_id`, `doc_control_letcode_name`, `doc_control_letcode_number`) VALUES
(1, 'PT. Wika Gedung', 'TP.02.09/F.UTI.A.'),
(2, 'Owner', 'TP.02.09/F.UTI.B.'),
(3, 'MK', 'TP.02.09/F.UTI.C.'),
(4, 'Supplier/Subkon', 'TP.02.09/F.UTI.D.'),
(5, 'Pihak Lain', 'TP.02.09/F.UTI.E.');

-- --------------------------------------------------------

--
-- Table structure for table `doc_control_verify`
--

CREATE TABLE `doc_control_verify` (
  `doc_control_verify_id` int(11) NOT NULL,
  `doc_control_id` int(11) NOT NULL,
  `doc_control_verify_date` datetime DEFAULT NULL,
  `doc_control_verify_status` int(1) DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL,
  `employee_nik` varchar(30) DEFAULT NULL,
  `employee_name` varchar(30) DEFAULT NULL,
  `employee_address` text,
  `employee_email` varchar(20) DEFAULT NULL,
  `employee_phone` varchar(14) DEFAULT NULL,
  `employee_photo` varchar(50) DEFAULT NULL,
  `employee_status` varchar(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `employee_nik`, `employee_name`, `employee_address`, `employee_email`, `employee_phone`, `employee_photo`, `employee_status`) VALUES
(1, '12345', 'Kuncoro Admodjo S', 'jakal', 'kuncoro@gmail.com', '0898765646', 'profile233093.jpg', '1'),
(27, '1234', 'Suwarso', 'Purwokerto', '', '085691112403', NULL, '1'),
(28, '1234A', 'M. Ansor', 'Jakarta Cipete', '', '085774991454', NULL, '1'),
(29, '1234B', 'Putri', 'Klaten', '', '081325460410', NULL, '1'),
(30, '1234C', 'Fika Ayu', 'Jogja', '', '089675132221', NULL, '1'),
(31, '1234D', 'Ode Prasetyo', 'Parung - Bogor', 'ekopode@yahoo.com', '081257028746', NULL, '1'),
(32, '1234E', 'Dalil', 'Boyolali', '', '081329339329', NULL, '1'),
(33, '1234F', 'Riyadi ', 'Cibubur', '', '081807787582', NULL, '1'),
(34, '1234G', 'Ali', 'Surabaya', '', '08235657018', NULL, '1'),
(35, '1234H', 'Mispan', 'Jakarta', '', '082139505075', NULL, '1'),
(36, '1234I', 'Dirga', 'Jakrta', '', '081280015076', NULL, '1'),
(37, '1234J', 'Tomo Dwi Hasputro', 'cibubur', '', '081519063226', NULL, '1'),
(38, '1234K', 'Gesha', 'Semarang', '', '081347854830', NULL, '1'),
(39, '1234M', 'Daryoto', 'Jakarta', '', '082112266658', NULL, '1'),
(40, '9839', 'pengadaan', '', '', '', NULL, '1'),
(41, '9383', 'gudang', '', '', '', NULL, '1'),
(43, '123456', 'manajer', '', '', '08098437493', NULL, '1'),
(44, '', 'satu', '', '', '', NULL, '1'),
(46, '', 'sekretariat', '', '', '', NULL, '1'),
(47, '', 'kepala seksi', '', '', '', NULL, '1'),
(48, '', 'pelaksana', '', '', '', NULL, '1'),
(49, '', 'keuangan', '', '', '', NULL, '1'),
(50, '123''', 'prisma', '', '', '', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `equipment_id` int(11) NOT NULL,
  `equipment_ct_id` int(3) NOT NULL,
  `equipment_unit_id` int(3) NOT NULL,
  `equipment_name` varchar(30) DEFAULT NULL,
  `equipment_status` int(1) DEFAULT '1',
  `equipment_type` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`equipment_id`, `equipment_ct_id`, `equipment_unit_id`, `equipment_name`, `equipment_status`, `equipment_type`) VALUES
(5, 2, 3, 'MAIN FRAME', 1, '190'),
(6, 2, 3, 'MAIN FRAME', 1, '170'),
(7, 2, 3, 'LEADER FRAME', 1, '90'),
(8, 2, 3, 'LEADER FRAME', 1, '50'),
(9, 2, 3, 'CROSS BRACE', 1, '193'),
(10, 2, 3, 'CROSS BRACE', 1, '220'),
(11, 2, 3, 'JOINT PIN', 1, ''),
(12, 2, 3, 'U HEAD ', 1, '60'),
(13, 2, 3, 'U HEAD', 1, '40'),
(14, 3, 3, 'JACK BASE 60', 1, '60'),
(15, 3, 3, 'JACK BASE', 1, '40'),
(16, 3, 3, 'CATWALK', 1, ''),
(17, 3, 3, 'PIPA SUPPORT', 1, 'TS 90'),
(18, 3, 3, 'SWIVEL CLAMP', 1, ''),
(19, 3, 4, 'STEEL PIPA', 1, '3 METER'),
(20, 3, 4, 'STEEL PIPA', 1, '6 METER'),
(21, 3, 3, 'SIKU BALOK', 1, '47'),
(22, 3, 3, 'CAWALL', 1, '45'),
(23, 3, 3, 'SURI - SURI', 1, ''),
(24, 3, 3, 'STAIR', 1, ''),
(25, 3, 3, 'SAFETY DECK', 1, ''),
(26, 3, 4, 'HOLLOW ', 1, '4 X 4 X 3 M'),
(27, 3, 4, 'HOLLOW ', 1, '5 X 5 X 3 M'),
(28, 3, 4, 'HOLLOW ', 1, '4 X 4 X 6 M'),
(29, 2, 3, 'HOLLOW ', 1, '5 X 5 X 6 M'),
(30, 3, 3, 'PUSH PULL PROFF', 1, ''),
(31, 3, 3, 'BAR BENDER', 1, ''),
(32, 2, 3, 'BAR CUTTER', 1, ''),
(33, 3, 3, 'COMPRESOR', 1, ''),
(34, 2, 3, 'TOWER CRANE', 1, ''),
(35, 2, 3, 'POMPA DEEP WEEL', 1, ''),
(36, 2, 3, 'POMPA SAMPIT', 1, ''),
(37, 3, 3, 'THEODOLIT', 1, ''),
(38, 2, 3, 'BAK UKUR', 1, ''),
(39, 3, 3, 'STATIP', 1, ''),
(40, 3, 3, 'WATERPASS', 1, ''),
(41, 0, 0, 'Dhakja', 1, 'e7e'),
(42, 0, 0, 'Sasa', 1, 'sdfeks'),
(43, 0, 0, 'Wawa', 1, 'da'),
(44, 0, 0, 'Ada', 1, 'www');

-- --------------------------------------------------------

--
-- Table structure for table `equipment_ct`
--

CREATE TABLE `equipment_ct` (
  `equipment_ct_id` int(3) NOT NULL,
  `equipment_ct_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `equipment_ct`
--

INSERT INTO `equipment_ct` (`equipment_ct_id`, `equipment_ct_name`) VALUES
(2, 'Alat Berat'),
(3, 'Alat Ringan');

-- --------------------------------------------------------

--
-- Table structure for table `equipment_stock`
--

CREATE TABLE `equipment_stock` (
  `equipment_stock_id` int(11) NOT NULL,
  `equipt_transaction_id` varchar(5) DEFAULT NULL,
  `equipment_id` int(11) NOT NULL,
  `project_id` varchar(5) NOT NULL,
  `actor_id` int(5) DEFAULT NULL,
  `equipment_stock_entry` double DEFAULT NULL,
  `equipment_stock_exit` double DEFAULT NULL,
  `equipment_stock_date` datetime DEFAULT NULL,
  `equipment_stock_rest` double DEFAULT NULL,
  `equipment_stock_price` double DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `equipment_stock`
--

INSERT INTO `equipment_stock` (`equipment_stock_id`, `equipt_transaction_id`, `equipment_id`, `project_id`, `actor_id`, `equipment_stock_entry`, `equipment_stock_exit`, `equipment_stock_date`, `equipment_stock_rest`, `equipment_stock_price`) VALUES
(1, NULL, 5, '1', 1, 1225, NULL, '2016-05-04 18:12:51', 1225, 0),
(2, NULL, 6, '1', 1, 14554, NULL, '2016-05-04 18:12:51', 14554, 0),
(3, NULL, 7, '1', 1, 4548, NULL, '2016-05-04 18:12:51', 4548, 0),
(4, NULL, 8, '1', 1, 54548, NULL, '2016-05-04 18:12:51', 54548, 0),
(5, NULL, 9, '1', 1, 5458, NULL, '2016-05-04 18:12:51', 5458, 0),
(6, NULL, 10, '1', 1, 48858, NULL, '2016-05-04 18:12:51', 48858, 0),
(7, NULL, 11, '1', 1, 0, NULL, '2016-05-04 18:12:51', 0, 0),
(8, NULL, 12, '1', 1, 0, NULL, '2016-05-04 18:12:51', 0, 0),
(9, NULL, 13, '1', 1, 0, NULL, '2016-05-04 18:12:51', 0, 0),
(10, NULL, 14, '1', 1, 4499, NULL, '2016-05-04 18:12:51', 4499, 0),
(11, NULL, 15, '1', 1, 545458, NULL, '2016-05-04 18:12:51', 545458, 0),
(12, NULL, 16, '1', 1, 0, NULL, '2016-05-04 18:12:51', 0, 0),
(13, NULL, 17, '1', 1, 0, NULL, '2016-05-04 18:12:51', 0, 0),
(14, NULL, 18, '1', 1, 145456, NULL, '2016-05-04 18:12:51', 145456, 0),
(15, NULL, 19, '1', 1, 54646, NULL, '2016-05-04 18:12:51', 54646, 0),
(16, NULL, 20, '1', 1, 54566, NULL, '2016-05-04 18:12:51', 54566, 0),
(17, NULL, 21, '1', 1, 5666, NULL, '2016-05-04 18:12:51', 5666, 0),
(18, NULL, 22, '1', 1, 0, NULL, '2016-05-04 18:12:51', 0, 0),
(19, NULL, 23, '1', 1, 0, NULL, '2016-05-04 18:12:51', 0, 0),
(20, NULL, 24, '1', 1, 0, NULL, '2016-05-04 18:12:51', 0, 0),
(21, NULL, 25, '1', 1, 0, NULL, '2016-05-04 18:12:51', 0, 0),
(22, NULL, 26, '1', 1, 15574, NULL, '2016-05-04 18:12:51', 15574, 0),
(23, NULL, 27, '1', 1, 4848, NULL, '2016-05-04 18:12:51', 4848, 0),
(24, NULL, 28, '1', 1, 87846, NULL, '2016-05-04 18:12:51', 87846, 0),
(25, NULL, 29, '1', 1, 78845, NULL, '2016-05-04 18:12:51', 78845, 0),
(26, NULL, 30, '1', 1, 498748, NULL, '2016-05-04 18:12:51', 498748, 0),
(27, NULL, 31, '1', 1, 0, NULL, '2016-05-04 18:12:51', 0, 0),
(28, NULL, 32, '1', 1, 0, NULL, '2016-05-04 18:12:51', 0, 0),
(29, NULL, 33, '1', 1, 0, NULL, '2016-05-04 18:12:51', 0, 0),
(30, NULL, 34, '1', 1, 0, NULL, '2016-05-04 18:12:51', 0, 0),
(31, NULL, 35, '1', 1, 0, NULL, '2016-05-04 18:12:51', 0, 0),
(32, NULL, 36, '1', 1, 0, NULL, '2016-05-04 18:12:51', 0, 0),
(33, NULL, 37, '1', 1, 15422, NULL, '2016-05-04 18:12:51', 15422, 0),
(34, NULL, 38, '1', 1, 1548, NULL, '2016-05-04 18:12:51', 1548, 0),
(35, NULL, 39, '1', 1, 45496, NULL, '2016-05-04 18:12:51', 45496, 0),
(36, NULL, 40, '1', 1, 4849, NULL, '2016-05-04 18:12:51', 4849, 0),
(37, NULL, 5, '1', 2, 15145, NULL, '2016-05-04 18:13:26', 15145, 0),
(38, NULL, 6, '1', 2, 5554, NULL, '2016-05-04 18:13:26', 5554, 0),
(39, NULL, 7, '1', 2, 45848, NULL, '2016-05-04 18:13:26', 45848, 0),
(40, NULL, 8, '1', 2, 4848, NULL, '2016-05-04 18:13:26', 4848, 0),
(41, NULL, 9, '1', 2, 0, NULL, '2016-05-04 18:13:26', 0, 0),
(42, NULL, 10, '1', 2, 0, NULL, '2016-05-04 18:13:26', 0, 0),
(43, NULL, 11, '1', 2, 0, NULL, '2016-05-04 18:13:26', 0, 0),
(44, NULL, 12, '1', 2, 0, NULL, '2016-05-04 18:13:26', 0, 0),
(45, NULL, 13, '1', 2, 0, NULL, '2016-05-04 18:13:26', 0, 0),
(46, NULL, 14, '1', 2, 0, NULL, '2016-05-04 18:13:26', 0, 0),
(47, NULL, 15, '1', 2, 0, NULL, '2016-05-04 18:13:26', 0, 0),
(48, NULL, 16, '1', 2, 0, NULL, '2016-05-04 18:13:26', 0, 0),
(49, NULL, 17, '1', 2, 0, NULL, '2016-05-04 18:13:26', 0, 0),
(50, NULL, 18, '1', 2, 0, NULL, '2016-05-04 18:13:26', 0, 0),
(51, NULL, 19, '1', 2, 0, NULL, '2016-05-04 18:13:26', 0, 0),
(52, NULL, 20, '1', 2, 0, NULL, '2016-05-04 18:13:26', 0, 0),
(53, NULL, 21, '1', 2, 454561, NULL, '2016-05-04 18:13:26', 454561, 0),
(54, NULL, 22, '1', 2, 54584, NULL, '2016-05-04 18:13:26', 54584, 0),
(55, NULL, 23, '1', 2, 4846, NULL, '2016-05-04 18:13:26', 4846, 0),
(56, NULL, 24, '1', 2, 0, NULL, '2016-05-04 18:13:26', 0, 0),
(57, NULL, 25, '1', 2, 54848, NULL, '2016-05-04 18:13:26', 54848, 0),
(58, NULL, 26, '1', 2, 4884, NULL, '2016-05-04 18:13:26', 4884, 0),
(59, NULL, 27, '1', 2, 8484, NULL, '2016-05-04 18:13:26', 8484, 0),
(60, NULL, 28, '1', 2, 4888, NULL, '2016-05-04 18:13:26', 4888, 0),
(61, NULL, 29, '1', 2, 0, NULL, '2016-05-04 18:13:26', 0, 0),
(62, NULL, 30, '1', 2, 0, NULL, '2016-05-04 18:13:26', 0, 0),
(63, NULL, 31, '1', 2, 0, NULL, '2016-05-04 18:13:26', 0, 0),
(64, NULL, 32, '1', 2, 0, NULL, '2016-05-04 18:13:26', 0, 0),
(65, NULL, 33, '1', 2, 0, NULL, '2016-05-04 18:13:26', 0, 0),
(66, NULL, 34, '1', 2, 0, NULL, '2016-05-04 18:13:26', 0, 0),
(67, NULL, 35, '1', 2, 45466, NULL, '2016-05-04 18:13:26', 45466, 0),
(68, NULL, 36, '1', 2, 6964, NULL, '2016-05-04 18:13:26', 6964, 0),
(69, NULL, 37, '1', 2, 5466, NULL, '2016-05-04 18:13:26', 5466, 0),
(70, NULL, 38, '1', 2, 54898, NULL, '2016-05-04 18:13:26', 54898, 0),
(71, NULL, 39, '1', 2, 584898, NULL, '2016-05-04 18:13:26', 584898, 0),
(72, NULL, 40, '1', 2, 54898, NULL, '2016-05-04 18:13:26', 54898, 0),
(73, '1', 38, '1', 2, 120, NULL, '2016-05-04 18:17:52', 55018, 1245),
(74, '1', 16, '1', 2, 1.24, NULL, '2016-05-04 18:17:52', 1.24, 1230),
(75, '1', 6, '1', 2, 450, NULL, '2016-05-04 18:17:52', 6004, 2400),
(76, '1', 36, '1', 2, 1.23, NULL, '2016-05-04 18:17:52', 6965.23, 2565),
(77, '2', 10, '1', 1, 4.135, NULL, '2016-05-04 18:18:26', 48862.135, 1200),
(78, '2', 33, '1', 1, 2.1, NULL, '2016-05-04 18:18:26', 2.1, 1232),
(79, '3', 8, '1', 2, NULL, 120, '2016-05-04 18:19:09', 4728, NULL),
(80, '3', 28, '1', 2, NULL, 200, '2016-05-04 18:19:09', 4688, NULL),
(81, '4', 9, '1', 1, NULL, 1.245, '2016-05-04 18:19:45', 5456.755, NULL),
(82, '4', 10, '1', 1, NULL, 1.532, '2016-05-04 18:19:45', 48860.603, NULL),
(83, '4', 15, '1', 1, NULL, 4.542, '2016-05-04 18:19:45', 545453.458, NULL),
(84, '1', 7, '1', 2, 10, NULL, '2016-05-04 18:21:35', 45858, 2000),
(85, '2', 35, '1', 1, 10, NULL, '2016-05-04 18:22:09', 10, 1230),
(86, '4', 39, '1', 1, NULL, 10, '2016-05-04 18:43:07', 45486, NULL),
(87, '3', 38, '1', 2, NULL, 50, '2016-05-04 18:43:29', 54968, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `equipment_stock_final`
--

CREATE TABLE `equipment_stock_final` (
  `equipment_stock_final_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `actor_id` int(5) DEFAULT NULL,
  `equipment_id` int(11) NOT NULL,
  `equipment_stock_final_date` datetime NOT NULL,
  `equipment_stock_final_rest` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `equipment_stock_final`
--

INSERT INTO `equipment_stock_final` (`equipment_stock_final_id`, `project_id`, `actor_id`, `equipment_id`, `equipment_stock_final_date`, `equipment_stock_final_rest`) VALUES
(1, 1, 1, 5, '2016-05-04 18:12:51', 1225),
(2, 1, 1, 6, '2016-05-04 18:12:51', 14554),
(3, 1, 1, 7, '2016-05-04 18:12:51', 4548),
(4, 1, 1, 8, '2016-05-04 18:12:51', 54548),
(5, 1, 1, 9, '2016-05-04 00:00:00', 5456.755),
(6, 1, 1, 10, '2016-05-04 00:00:00', 48860.603),
(7, 1, 1, 11, '2016-05-04 18:12:51', 0),
(8, 1, 1, 12, '2016-05-04 18:12:51', 0),
(9, 1, 1, 13, '2016-05-04 18:12:51', 0),
(10, 1, 1, 14, '2016-05-04 18:12:51', 4499),
(11, 1, 1, 15, '2016-05-04 00:00:00', 545453.458),
(12, 1, 1, 16, '2016-05-04 18:12:51', 0),
(13, 1, 1, 17, '2016-05-04 18:12:51', 0),
(14, 1, 1, 18, '2016-05-04 18:12:51', 145456),
(15, 1, 1, 19, '2016-05-04 18:12:51', 54646),
(16, 1, 1, 20, '2016-05-04 18:12:51', 54566),
(17, 1, 1, 21, '2016-05-04 18:12:51', 5666),
(18, 1, 1, 22, '2016-05-04 18:12:51', 0),
(19, 1, 1, 23, '2016-05-04 18:12:51', 0),
(20, 1, 1, 24, '2016-05-04 18:12:51', 0),
(21, 1, 1, 25, '2016-05-04 18:12:51', 0),
(22, 1, 1, 26, '2016-05-04 18:12:51', 15574),
(23, 1, 1, 27, '2016-05-04 18:12:51', 4848),
(24, 1, 1, 28, '2016-05-04 18:12:51', 87846),
(25, 1, 1, 29, '2016-05-04 18:12:51', 78845),
(26, 1, 1, 30, '2016-05-04 18:12:51', 498748),
(27, 1, 1, 31, '2016-05-04 18:12:51', 0),
(28, 1, 1, 32, '2016-05-04 18:12:51', 0),
(29, 1, 1, 33, '2016-05-04 00:00:00', 2.1),
(30, 1, 1, 34, '2016-05-04 18:12:51', 0),
(31, 1, 1, 35, '2016-05-04 00:00:00', 10),
(32, 1, 1, 36, '2016-05-04 18:12:51', 0),
(33, 1, 1, 37, '2016-05-04 18:12:51', 15422),
(34, 1, 1, 38, '2016-05-04 18:12:51', 1548),
(35, 1, 1, 39, '2016-05-04 00:00:00', 45486),
(36, 1, 1, 40, '2016-05-04 18:12:51', 4849),
(37, 1, 2, 5, '2016-05-04 18:13:26', 15145),
(38, 1, 2, 6, '2016-05-04 00:00:00', 6004),
(39, 1, 2, 7, '2016-05-04 00:00:00', 45858),
(40, 1, 2, 8, '2016-05-04 00:00:00', 4728),
(41, 1, 2, 9, '2016-05-04 18:13:26', 0),
(42, 1, 2, 10, '2016-05-04 18:13:26', 0),
(43, 1, 2, 11, '2016-05-04 18:13:26', 0),
(44, 1, 2, 12, '2016-05-04 18:13:26', 0),
(45, 1, 2, 13, '2016-05-04 18:13:26', 0),
(46, 1, 2, 14, '2016-05-04 18:13:26', 0),
(47, 1, 2, 15, '2016-05-04 18:13:26', 0),
(48, 1, 2, 16, '2016-05-04 00:00:00', 1.24),
(49, 1, 2, 17, '2016-05-04 18:13:26', 0),
(50, 1, 2, 18, '2016-05-04 18:13:26', 0),
(51, 1, 2, 19, '2016-05-04 18:13:26', 0),
(52, 1, 2, 20, '2016-05-04 18:13:26', 0),
(53, 1, 2, 21, '2016-05-04 18:13:26', 454561),
(54, 1, 2, 22, '2016-05-04 18:13:26', 54584),
(55, 1, 2, 23, '2016-05-04 18:13:26', 4846),
(56, 1, 2, 24, '2016-05-04 18:13:26', 0),
(57, 1, 2, 25, '2016-05-04 18:13:26', 54848),
(58, 1, 2, 26, '2016-05-04 18:13:26', 4884),
(59, 1, 2, 27, '2016-05-04 18:13:26', 8484),
(60, 1, 2, 28, '2016-05-04 00:00:00', 4688),
(61, 1, 2, 29, '2016-05-04 18:13:26', 0),
(62, 1, 2, 30, '2016-05-04 18:13:26', 0),
(63, 1, 2, 31, '2016-05-04 18:13:26', 0),
(64, 1, 2, 32, '2016-05-04 18:13:26', 0),
(65, 1, 2, 33, '2016-05-04 18:13:26', 0),
(66, 1, 2, 34, '2016-05-04 18:13:26', 0),
(67, 1, 2, 35, '2016-05-04 18:13:26', 45466),
(68, 1, 2, 36, '2016-05-04 00:00:00', 6965.23),
(69, 1, 2, 37, '2016-05-04 18:13:26', 5466),
(70, 1, 2, 38, '2016-05-04 00:00:00', 54968),
(71, 1, 2, 39, '2016-05-04 18:13:26', 584898),
(72, 1, 2, 40, '2016-05-04 18:13:26', 54898);

-- --------------------------------------------------------

--
-- Table structure for table `equipment_unit`
--

CREATE TABLE `equipment_unit` (
  `equipment_unit_id` int(3) NOT NULL,
  `equipment_unit_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `equipment_unit`
--

INSERT INTO `equipment_unit` (`equipment_unit_id`, `equipment_unit_name`) VALUES
(3, 'PCS'),
(4, 'BTG');

-- --------------------------------------------------------

--
-- Table structure for table `equipt_transaction`
--

CREATE TABLE `equipt_transaction` (
  `equipt_transaction_id` int(11) NOT NULL,
  `equipt_transaction_rent_id` int(11) DEFAULT NULL,
  `users_id` int(6) NOT NULL,
  `transaction_ct_id` int(3) NOT NULL,
  `actor_id` int(11) DEFAULT NULL,
  `project_id` varchar(5) NOT NULL,
  `equipt_transaction_number` varchar(10) DEFAULT NULL,
  `equipt_transaction_date` datetime DEFAULT NULL,
  `equipt_transaction_total` double DEFAULT NULL,
  `equipt_transaction_letter` varchar(200) DEFAULT NULL,
  `equipt_transaction_car` varchar(15) DEFAULT NULL,
  `equipt_transaction_driver` varchar(15) DEFAULT NULL,
  `equipt_transaction_driver_identity` varchar(30) DEFAULT NULL,
  `equipt_transaction_date_verify` datetime DEFAULT NULL,
  `equipt_transaction_status` varchar(1) NOT NULL DEFAULT '0' COMMENT 'default = NULL; 0 = sedang dipinjam/maintenance; 1 = peminjaman/maintenance dikembalikan;'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `equipt_transaction`
--

INSERT INTO `equipt_transaction` (`equipt_transaction_id`, `equipt_transaction_rent_id`, `users_id`, `transaction_ct_id`, `actor_id`, `project_id`, `equipt_transaction_number`, `equipt_transaction_date`, `equipt_transaction_total`, `equipt_transaction_letter`, `equipt_transaction_car`, `equipt_transaction_driver`, `equipt_transaction_driver_identity`, `equipt_transaction_date_verify`, `equipt_transaction_status`) VALUES
(1, NULL, 1, 1, 2, '1', '000005', '2016-05-04 18:17:52', 1253195, '103656', '2545612', 'JONO', '55464646', '2016-05-04 18:21:35', '1'),
(2, NULL, 1, 1, 1, '1', '000005', '2016-05-04 18:18:26', 19564, '45133', '131885', 'sana', '14546658', '2016-05-04 18:22:09', '1'),
(3, NULL, 1, 2, 2, '1', '000005', '2016-05-04 18:19:09', NULL, NULL, '145315', 'dana', '154564845', '2016-05-04 18:43:29', '1'),
(4, NULL, 1, 2, 1, '1', '000005', '2016-05-04 18:19:44', NULL, NULL, '1555', 'saori', '1546466', '2016-05-04 18:43:07', '1');

-- --------------------------------------------------------

--
-- Table structure for table `equipt_transaction_dt`
--

CREATE TABLE `equipt_transaction_dt` (
  `equipt_transaction_dt_id` int(11) NOT NULL,
  `equipt_transaction_id` int(11) NOT NULL,
  `equipment_id` int(11) NOT NULL,
  `code_id` varchar(1) DEFAULT NULL,
  `equipt_transaction_dt_condition` varchar(14) DEFAULT NULL,
  `equipt_transaction_dt_volume` int(6) DEFAULT NULL,
  `equipt_transaction_dt_price` double DEFAULT NULL,
  `equipt_transaction_dt_note` text,
  `equipt_transaction_dt_status` varchar(1) NOT NULL DEFAULT '1' COMMENT '1 = beli; 2 = sewa; 3 = kembali'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `equipt_transaction_dt`
--

INSERT INTO `equipt_transaction_dt` (`equipt_transaction_dt_id`, `equipt_transaction_id`, `equipment_id`, `code_id`, `equipt_transaction_dt_condition`, `equipt_transaction_dt_volume`, `equipt_transaction_dt_price`, `equipt_transaction_dt_note`, `equipt_transaction_dt_status`) VALUES
(1, 1, 38, NULL, NULL, 120, 1245, NULL, '1'),
(2, 1, 16, NULL, NULL, 1, 1230, NULL, '1'),
(3, 1, 6, NULL, NULL, 450, 2400, NULL, '1'),
(4, 1, 36, NULL, NULL, 1, 2565, NULL, '1'),
(5, 2, 10, NULL, NULL, 4, 1200, NULL, '1'),
(6, 2, 33, NULL, NULL, 2, 1232, NULL, '1'),
(7, 3, 8, NULL, 'Baik, ', 120, NULL, NULL, '3'),
(8, 3, 28, NULL, 'Baik, ', 200, NULL, NULL, '3'),
(9, 4, 9, NULL, 'Baik, ', 1, NULL, NULL, '3'),
(10, 4, 10, NULL, 'Baik, ', 2, NULL, NULL, '3'),
(11, 4, 15, NULL, 'Baik, ', 5, NULL, NULL, '3'),
(12, 1, 7, NULL, NULL, 10, 2000, NULL, '1'),
(13, 1, 35, NULL, NULL, 10, 1230, NULL, '1'),
(14, 1, 39, NULL, 'Baik, ', 10, NULL, NULL, '3'),
(15, 1, 38, NULL, 'Baik, ', 50, NULL, NULL, '3');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` int(11) NOT NULL,
  `work_order_id` int(11) DEFAULT NULL,
  `invoice_ct_id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `actor_id` int(11) DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL,
  `invoice_number` varchar(20) DEFAULT NULL,
  `invoice_tax_serial` varchar(50) DEFAULT NULL,
  `invoice_date_kwt` datetime DEFAULT NULL,
  `invoice_date_pry` datetime DEFAULT NULL,
  `invoice_date_dpt` varchar(20) DEFAULT NULL,
  `invoice_date_due` datetime DEFAULT NULL,
  `invoice_total` double NOT NULL DEFAULT '0',
  `invoice_netto` double NOT NULL DEFAULT '0',
  `invoice_bruto` double NOT NULL DEFAULT '0',
  `invoice_total_final` double NOT NULL,
  `invoice_resource_code` varchar(1) NOT NULL DEFAULT '1',
  `invoice_payment_status` varchar(1) NOT NULL DEFAULT '0' COMMENT '0 : belum dibayar (keterangan menjadi outstanding), 1 : sudah dibayar (paid)',
  `invoice_note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `work_order_id`, `invoice_ct_id`, `project_id`, `actor_id`, `users_id`, `invoice_number`, `invoice_tax_serial`, `invoice_date_kwt`, `invoice_date_pry`, `invoice_date_dpt`, `invoice_date_due`, `invoice_total`, `invoice_netto`, `invoice_bruto`, `invoice_total_final`, `invoice_resource_code`, `invoice_payment_status`, `invoice_note`) VALUES
(1, 3, 1, 1, 2, 27, '123456', '987456', '2016-05-04 00:00:00', '2016-05-04 00:00:00', NULL, NULL, 50000000, 5000000, 5500000, 5350000, '4', '0', ''),
(2, 3, 1, 1, 2, 27, '1355', '55455', '2016-05-05 00:00:00', '2016-05-04 00:00:00', NULL, NULL, 50000000, 17000000, 18700000, 18190000, '4', '0', ''),
(3, 3, 1, 1, 2, 27, '156646', '46614596', '2016-05-06 00:00:00', '2016-05-04 00:00:00', NULL, NULL, 50000000, 11050000, 12155000, 11823500, '4', '0', ''),
(4, 3, 1, 1, 2, 27, '125355', '554466', '2016-05-07 00:00:00', '2016-05-04 00:00:00', NULL, NULL, 50000000, 10157500, 11173250, 10868525, '4', '0', ''),
(5, 3, 1, 1, 2, 27, '122155', '545555', '2016-05-08 00:00:00', '2016-05-04 00:00:00', NULL, NULL, 50000000, 4292500, 4721750, 4592975, '4', '0', ''),
(6, 3, 1, 1, 2, 28, '123', '14585', '2016-05-05 00:00:00', '2016-05-04 00:00:00', NULL, NULL, 50000000, 2500000, 2750000, 2675000, '4', '0', '');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_dt`
--

CREATE TABLE `invoice_dt` (
  `invoice_dt_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `transaction_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_equipt_dt`
--

CREATE TABLE `invoice_equipt_dt` (
  `invoice_equipt_id` int(5) NOT NULL,
  `invoice_id` int(5) NOT NULL,
  `equipment_id` int(5) NOT NULL,
  `debt_id` int(5) NOT NULL,
  `invoice_equipt_dt_total` double NOT NULL,
  `invoice_equipt_dt_status` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_tax`
--

CREATE TABLE `invoice_tax` (
  `invoice_tax_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `tax_id` int(5) NOT NULL,
  `invoice_tax_cuts` double NOT NULL DEFAULT '0',
  `invoice_tax_nominal` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_tax`
--

INSERT INTO `invoice_tax` (`invoice_tax_id`, `invoice_id`, `tax_id`, `invoice_tax_cuts`, `invoice_tax_nominal`) VALUES
(1, 1, 3, 10, 500000),
(2, 1, 15, 3, 150000),
(3, 2, 3, 10, 1700000),
(4, 2, 15, 3, 510000),
(5, 3, 3, 10, 1105000),
(6, 3, 15, 3, 331500),
(7, 4, 3, 10, 1015750),
(8, 4, 15, 3, 304725),
(9, 5, 3, 10, 429250),
(10, 5, 15, 3, 128775),
(11, 6, 3, 10, 250000),
(12, 6, 15, 3, 75000);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_wo`
--

CREATE TABLE `invoice_wo` (
  `invoice_wo_id` int(22) NOT NULL,
  `invoice_wo_ct_id` int(5) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `invoice_wo_date` datetime DEFAULT NULL,
  `invoice_wo_sequence` int(3) DEFAULT NULL,
  `invoice_wo_total` double DEFAULT NULL,
  `invoice_wo_nominal` double DEFAULT NULL,
  `invoice_wo_percent` double DEFAULT NULL,
  `invoice_wo_dp` double DEFAULT NULL,
  `invoice_wo_retensi` double DEFAULT NULL,
  `invoice_wo_note` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_wo`
--

INSERT INTO `invoice_wo` (`invoice_wo_id`, `invoice_wo_ct_id`, `invoice_id`, `invoice_wo_date`, `invoice_wo_sequence`, `invoice_wo_total`, `invoice_wo_nominal`, `invoice_wo_percent`, `invoice_wo_dp`, `invoice_wo_retensi`, `invoice_wo_note`) VALUES
(1, 1, 1, '2016-05-04 00:00:00', 0, 5350000, 5000000, NULL, NULL, NULL, NULL),
(2, 2, 2, '2016-05-04 00:00:00', 1, 18190000, 20000000, 40, 2000000, 1000000, NULL),
(3, 2, 3, '2016-05-04 00:00:00', 2, 11823500, 13000000, 60, 1300000, 650000, NULL),
(4, 2, 4, '2016-05-04 00:00:00', 3, 10868525, 11950000, 80, 1195000, 597500, NULL),
(5, 2, 5, '2016-05-04 00:00:00', 4, 4592975, 11792500, 100, 5000000, 2500000, NULL),
(6, 3, 6, '2016-05-04 00:00:00', 0, 2675000, 50000000, NULL, NULL, 2500000, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_wo_ct`
--

CREATE TABLE `invoice_wo_ct` (
  `invoice_wo_ct_id` int(5) NOT NULL,
  `invoice_wo_ct_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_wo_ct`
--

INSERT INTO `invoice_wo_ct` (`invoice_wo_ct_id`, `invoice_wo_ct_name`) VALUES
(1, 'Uang Muka'),
(2, 'Termin'),
(3, 'Retensi');

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE `material` (
  `material_id` int(11) NOT NULL,
  `material_unit_id` int(3) NOT NULL,
  `material_category_id` int(2) NOT NULL,
  `material_name` varchar(50) DEFAULT NULL,
  `material_code` varchar(11) DEFAULT NULL,
  `material_status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`material_id`, `material_unit_id`, `material_category_id`, `material_name`, `material_code`, `material_status`) VALUES
(1, 2, 1, 'Besi', '1234', 1),
(2, 3, 1, 'Semen', '122', 1),
(3, 0, 1, 'Paku', '221', 1),
(4, 0, 1, 'Balok', '142', 1),
(5, 0, 1, 'Kaso', '524', 1),
(6, 0, 1, 'Triplek', '563', 1),
(7, 0, 1, 'Lain - Lain Struktur', '142', 1),
(8, 0, 1, 'Beton K', '125', 1),
(9, 0, 1, 'Hollow', '145', 1),
(10, 0, 2, 'Resibon', '987', 1),
(11, 0, 2, 'Tambang', '967', 1),
(12, 0, 2, 'Terpal', '976', 1),
(13, 0, 2, 'Meteran', '956', 1),
(14, 0, 2, 'Mata Bor', '957', 1),
(15, 0, 2, 'Setop Kran', '768', 1),
(16, 0, 2, 'Kabel', '456', 1),
(17, 0, 2, 'Lampu Phillips', '576', 1),
(18, 0, 2, 'Cat', '756', 1),
(19, 0, 2, 'Pylox', '765', 1),
(20, 0, 2, 'Kuas', '463', 1),
(21, 0, 2, 'PVC', '759', 1),
(22, 0, 2, 'Elbow L', '876', 1),
(23, 0, 2, 'Tee', '978', 1),
(24, 0, 2, 'Sok', '854', 1),
(25, 0, 2, 'Keni', '698', 1),
(26, 0, 2, 'Kawat', '984', 1),
(27, 0, 5, 'Helm', '578', 1),
(28, 0, 2, 'Lain - Lain Bantu', '945', 1),
(29, 0, 3, 'Mortar', '675', 1),
(30, 0, 3, 'Lain - Lain Finishing', '398', 1),
(31, 0, 3, 'PMP', '986', 1),
(32, 0, 3, 'PMA', '209', 1),
(33, 0, 3, 'PMI', '208', 1),
(34, 0, 3, 'SKIM COAT', '207', 1),
(35, 0, 4, 'Genset', 'gen', 1),
(36, 0, 1, 'Kawat', 'Kawat', 1),
(37, 0, 5, 'Sepatu ', 'Sepatu', 1),
(38, 0, 5, 'Rompi', 'Rompi', 1),
(39, 0, 5, 'Body Harnes', 'Body Harnes', 1),
(40, 0, 5, 'MASKER', 'MASKER', 1),
(41, 0, 3, 'SIKA', 'SIKA', 1),
(42, 0, 5, 'ALAT FOGING', 'ALAT FOGING', 1);

-- --------------------------------------------------------

--
-- Table structure for table `material_category`
--

CREATE TABLE `material_category` (
  `material_category_id` int(2) NOT NULL,
  `material_category_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `material_category`
--

INSERT INTO `material_category` (`material_category_id`, `material_category_name`) VALUES
(1, 'Struktur'),
(2, 'Alat Bantu'),
(3, 'Finishing'),
(4, 'MEP'),
(5, 'Safety ');

-- --------------------------------------------------------

--
-- Table structure for table `material_sub`
--

CREATE TABLE `material_sub` (
  `material_sub_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `material_unit_id` int(11) NOT NULL,
  `material_sub_name` varchar(90) NOT NULL,
  `material_sub_convertion` double DEFAULT NULL,
  `material_sub_price` int(11) DEFAULT NULL,
  `material_sub_status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `material_sub`
--

INSERT INTO `material_sub` (`material_sub_id`, `material_id`, `material_unit_id`, `material_sub_name`, `material_sub_convertion`, `material_sub_price`, `material_sub_status`) VALUES
(7, 36, 7, 'KAWAT BENDRAT', 0, 0, 1),
(8, 3, 4, 'PAKU 7"', 0, 0, 1),
(9, 3, 4, 'PAKU 5"', 0, 0, 1),
(10, 3, 4, 'PAKU 10"', 0, 0, 1),
(11, 3, 4, 'PAKU 4 ', 0, 0, 1),
(12, 4, 2, 'BALOK 4X12X4 MTR', 0, 0, 1),
(13, 4, 2, 'BALOK 6X12X3 MTR', 0, 0, 1),
(14, 4, 2, 'BALOK 6X12X34 MTR', 0, 0, 1),
(15, 4, 2, 'BALOK 8X12X4 MTR', 0, 0, 1),
(16, 4, 2, 'BALOK 8X12X3 MTR', 0, 0, 1),
(17, 4, 2, 'BALOK 6X12X4 MTR', 0, 0, 1),
(18, 7, 2, 'KAYU SENGON', 0, 0, 1),
(19, 5, 2, 'KASO 5X7X3 MTR', 0, 0, 1),
(20, 5, 2, 'KASO 5X7X4 MTR', 0, 0, 1),
(21, 5, 2, 'KASO 5X7X2 MTR', 0, 0, 1),
(22, 6, 13, 'TRIPLEK POLOS 3 MM', 0, 0, 1),
(23, 6, 13, 'TRIPLEK 6 MM', 0, 0, 1),
(24, 6, 13, 'TRIPLEK 9 MM', 0, 0, 1),
(25, 6, 13, 'TRIPLEK 15 MM POLOS', 0, 0, 1),
(26, 6, 13, 'PHENOLIC 15 MM (1 Sisi)', 0, 0, 1),
(28, 1, 2, 'BESI 8', 4.74, 0, 1),
(29, 1, 2, 'BESI 10', 7.4, 0, 1),
(30, 1, 2, 'BESI 13', 12.48, 0, 1),
(31, 1, 2, 'BESI 16', 18.96, 0, 1),
(32, 1, 2, 'BESI 19', 26.76, 0, 1),
(33, 1, 2, 'BESI 22', 35.76, 0, 1),
(34, 1, 2, 'BESI 25', 46.2, 0, 1),
(35, 1, 2, 'BESI 29', 62.28, 0, 1),
(36, 1, 2, 'BESI 32', 75.72, 0, 1),
(37, 7, 13, 'PLAT BESI', 0, 0, 1),
(38, 8, 8, 'BETON K - 300  SLAM 10', 0, 0, 1),
(39, 8, 8, 'BETON K - 300 SLAM 14', 0, 0, 1),
(40, 8, 8, 'BETON K - 350  SLAM 10', 0, 0, 1),
(41, 8, 8, 'BETON K - 350 SLAM 14', 0, 0, 1),
(42, 8, 8, 'BETON K - 400 SLAM 10', 0, 0, 1),
(43, 8, 8, 'BETON K - 400 SLAM 14', 0, 0, 1),
(44, 8, 8, 'BETON K - 450 SLAM 10', 0, 0, 1),
(45, 8, 8, 'BETON K - 450 SLAM 14', 0, 0, 1),
(46, 8, 8, 'BETON K-225 (FA 15)', 0, 0, 1),
(47, 7, 2, 'PLAT SETRIP 2X4X6', 0, 0, 1),
(48, 9, 2, 'HOLLOW 5X5X2.5 Mm (6 meter)', 0, 0, 1),
(49, 9, 2, 'HOLLOW 5X4X5 Mm (6meter)', 0, 0, 1),
(50, 9, 2, 'HOLLOW 5X4X4 mm (6 meter)', 0, 0, 1),
(52, 9, 2, 'HOLLOW 4x4x2,5 mm (6meter)', 0, 0, 1),
(56, 10, 1, 'Resibon 4"', 0, 0, 1),
(57, 10, 1, 'Resibon 14"', 0, 0, 1),
(58, 28, 1, 'EMBER COR', 0, 0, 1),
(59, 28, 1, 'CANGKUL', 0, 0, 1),
(60, 28, 1, 'SEKOP', 0, 0, 1),
(61, 11, 7, 'Tambang 5 MM', 0, 0, 1),
(62, 11, 7, 'Tambang 6 MM', 0, 0, 1),
(63, 12, 13, 'Terpal 3x4', 0, 0, 1),
(64, 12, 13, 'Terpal 4x6', 0, 0, 1),
(65, 12, 13, 'Terpal 6x8', 0, 0, 1),
(66, 13, 1, 'Meteran 5M', 0, 0, 1),
(67, 13, 1, 'Meteran 7.5M', 0, 0, 1),
(68, 28, 6, 'SARUNG TANGAN KAIN', 0, 0, 1),
(69, 28, 6, 'SARUNG TANGAN KARET', 0, 0, 1),
(70, 40, 1, 'MASKER', 0, 0, 1),
(71, 28, 1, 'BENANG NILON', 0, 0, 1),
(72, 28, 9, 'Sunny House 4', 0, 0, 1),
(73, 28, 9, 'Sunny House 6', 0, 0, 1),
(74, 28, 9, 'Sunny House 8', 0, 0, 1),
(75, 28, 7, 'SLANG 3/4', 0, 0, 1),
(76, 14, 1, 'Mata bor beton 10"', 0, 0, 1),
(77, 14, 1, 'Mata bor beton 12"', 0, 0, 1),
(78, 14, 1, 'Mata bor beton 16"', 0, 0, 1),
(79, 14, 1, 'Mata bor beton 4"', 0, 0, 1),
(80, 14, 1, 'MATA GERINDA KERAMIK 4', 0, 0, 1),
(81, 28, 1, 'SAPU KARET', 0, 0, 1),
(82, 28, 1, 'SAPU LIDI', 0, 0, 1),
(83, 28, 1, 'KARUNG BEKAS', 0, 0, 1),
(84, 28, 2, 'BAMBU', 0, 0, 1),
(85, 28, 5, 'GEDEK KULIT', 0, 0, 1),
(86, 28, 1, 'RODA ARCO', 0, 0, 1),
(87, 15, 1, 'Setop kran 1"', 0, 0, 1),
(88, 15, 1, 'Setop kran 1/2"', 0, 0, 1),
(89, 15, 1, 'Setop kran 2 1/2"', 0, 0, 1),
(90, 15, 1, 'Setop kran 3/4"', 0, 0, 1),
(92, 28, 1, 'LAKBAN BENING', 0, 0, 1),
(93, 28, 1, 'LAKBAN COKLAT', 0, 0, 1),
(94, 28, 1, 'LAKBAN KERTAS', 0, 0, 1),
(95, 28, 1, 'T-DOS', 0, 0, 1),
(96, 28, 1, 'ISOLASI', 0, 0, 1),
(97, 16, 1, 'KABEL KLEM', 0, 0, 1),
(99, 16, 9, 'Twisted 4x25', 0, 0, 1),
(100, 16, 9, 'Schoen 25 MM', 0, 0, 1),
(101, 16, 7, 'NYM 2 x 2,5 mm', 0, 0, 1),
(104, 16, 7, 'NYM 2 X 4 mm', 0, 0, 1),
(105, 17, 1, 'LAMPU PHILIPS 5 Watt', 0, 0, 1),
(106, 17, 1, 'Lampu philips 18 W', 0, 0, 1),
(107, 17, 1, 'Lampu philips 23 W', 0, 0, 1),
(108, 28, 1, 'BOX PANEL', 0, 0, 1),
(109, 28, 1, 'STOP KONTAK (TREMINAL)', 0, 0, 1),
(110, 28, 1, 'JEK', 0, 0, 1),
(111, 28, 1, 'Bohlam HPIT 400 W/220 V', 0, 0, 1),
(112, 28, 1, 'MCCB 40A', 0, 0, 1),
(113, 28, 1, 'STANG BLENDER', 0, 0, 1),
(114, 28, 1, 'STANG LAS', 0, 0, 1),
(115, 28, 1, 'LEM AIBON', 0, 0, 1),
(116, 28, 1, 'LEM EPOXI', 0, 0, 1),
(117, 28, 4, 'PAKU SEKRUP 10X35', 0, 0, 1),
(118, 28, 4, 'PAKU SENG', 0, 0, 1),
(119, 18, 11, 'CAT MINYAK HITAM', 0, 0, 1),
(120, 18, 11, 'CAT MINYAK ORANGE 1', 0, 0, 1),
(121, 18, 12, 'CAT MINYAK ORANGE 2', 0, 0, 1),
(122, 18, 10, 'CAT TEMBOK PUTIH 1', 0, 0, 1),
(123, 18, 11, 'CAT TEMBOK PUTIH 2', 0, 0, 1),
(124, 19, 1, 'PYLOX BIRU', 0, 0, 1),
(125, 19, 1, 'PYLOX MERAH', 0, 0, 1),
(126, 19, 1, 'PYLOX ORANGE', 0, 0, 1),
(127, 20, 1, 'Kuas 2"', 0, 0, 1),
(128, 20, 1, 'Kuas 4"', 0, 0, 1),
(129, 20, 1, 'Kuas roll besar', 0, 0, 1),
(130, 20, 1, 'Kuas roll kecil', 0, 0, 1),
(131, 21, 1, 'PVC 1/4"', 0, 0, 1),
(132, 21, 1, 'PVC', 0, 0, 1),
(133, 21, 1, 'PVC  5/8"', 0, 0, 1),
(134, 21, 1, 'PVC 1 1/4"', 0, 0, 1),
(135, 21, 1, 'PVC 1"', 0, 0, 1),
(136, 21, 1, 'PVC 1/2"', 0, 0, 1),
(137, 21, 1, 'PVC 2 1/2"', 0, 0, 1),
(138, 21, 1, 'PVC 3"', 0, 0, 1),
(139, 21, 1, 'PVC 3/4"', 0, 0, 1),
(140, 21, 1, 'PVC 4"', 0, 0, 1),
(141, 21, 1, 'PVC 5"', 0, 0, 1),
(142, 21, 1, 'PVC 6"', 0, 0, 1),
(143, 21, 1, 'PVC 8"', 0, 0, 1),
(144, 22, 1, 'ELBOW L  1"', 0, 0, 1),
(145, 22, 1, 'ELBOW L  2 1/2"', 0, 0, 1),
(146, 22, 1, 'ELBOW L  3"', 0, 0, 1),
(152, 22, 1, 'ELBOW L 1/2"', 0, 0, 1),
(153, 22, 1, 'ELBOW L  8"', 0, 0, 1),
(154, 22, 1, 'ELBOW L  6"', 0, 0, 1),
(155, 22, 1, 'ELBOW L  4/8', 0, 0, 1),
(156, 22, 1, 'ELBOW L 1/4"', 0, 0, 1),
(157, 22, 1, 'ELBOW L 1 1/4"', 0, 0, 1),
(158, 22, 1, 'ELBOW L  5"', 0, 0, 1),
(159, 22, 1, 'ELBOW L  4"', 0, 0, 1),
(160, 22, 1, 'ELBOW L  3/4"', 0, 0, 1),
(161, 23, 1, 'TEE 1/2"', 0, 0, 1),
(162, 23, 1, 'TEE 1 1/4"', 0, 0, 1),
(163, 23, 1, 'TEE 1/4"', 0, 0, 1),
(164, 23, 1, 'TEE 2 1/2"', 0, 0, 1),
(165, 23, 1, 'TEE 3/4"', 0, 0, 1),
(166, 23, 1, 'TEE 5/4"', 0, 0, 1),
(167, 23, 1, 'TEE 1"', 0, 0, 1),
(168, 23, 1, 'TEE 3"', 0, 0, 1),
(169, 23, 1, 'TEE 4"', 0, 0, 1),
(170, 23, 1, 'TEE 5"', 0, 0, 1),
(171, 23, 1, 'TEE 6"', 0, 0, 1),
(172, 23, 1, 'TEE 8"', 0, 0, 0),
(173, 24, 1, 'SOK 1/2"', 0, 0, 1),
(174, 24, 1, 'SOK 1 1/4"', 0, 0, 1),
(175, 24, 1, 'SOK 1/4"', 0, 0, 1),
(176, 24, 1, 'SOK 2 1/2"', 0, 0, 1),
(177, 24, 1, 'SOK 3/4"', 0, 0, 1),
(178, 25, 1, 'KENI', 0, 0, 1),
(179, 25, 1, 'KENI 1/2"', 0, 0, 1),
(180, 25, 1, 'KENI 6"', 0, 0, 1),
(181, 25, 1, 'KENI 2"', 0, 0, 1),
(182, 25, 1, 'KENI 4"', 0, 0, 1),
(183, 28, 1, 'SDD  2"', 0, 0, 1),
(184, 28, 1, 'SDD  3/4"', 0, 0, 1),
(185, 28, 1, 'SDL  2"', 0, 0, 1),
(186, 28, 1, 'SDL  3/4"', 0, 0, 1),
(187, 28, 10, 'THINER ND ', 0, 0, 1),
(188, 28, 11, 'THINER', 0, 0, 1),
(189, 36, 4, 'KAWAT DWG (Kawat putih 12)', 0, 0, 1),
(190, 36, 4, 'KAWAT DWG ( Kawat putih 14)', 0, 0, 1),
(191, 26, 7, 'Kawat ayam', 0, 0, 1),
(192, 26, 14, 'Kawat las RT 26 ', 0, 0, 1),
(193, 26, 14, 'Kawat las LB 3.2', 0, 0, 1),
(194, 37, 6, 'SEPATU BOAD AP', 0, 0, 1),
(195, 37, 6, 'SEPATU ATT', 0, 0, 1),
(196, 27, 1, 'HELEM KUNING', 0, 0, 1),
(197, 27, 1, 'HELEM BIRU', 0, 0, 1),
(198, 27, 1, 'HELEM MERAH', 0, 0, 1),
(199, 27, 1, 'KERANGKA HELEM ', 0, 0, 1),
(200, 38, 1, 'ROMPI ORANGE', 0, 0, 1),
(201, 39, 1, 'BODY HARMES', 0, 0, 1),
(202, 28, 1, 'POLICE LINE', 0, 0, 1),
(203, 29, 3, 'PMA 103 ACIAN', 0, 0, 1),
(205, 29, 3, 'MU - 200', 0, 0, 1),
(207, 29, 3, 'PMP 102 PLASTERAN', 0, 0, 1),
(212, 29, 3, 'PMT 101 THINBED', 0, 0, 1),
(214, 34, 3, 'SKIM COAT PMC 400', 0, 0, 1),
(216, 41, 3, 'SIKA GROUNDT', 0, 0, 1),
(217, 30, 1, 'STEROFOAM', 0, 0, 1),
(218, 30, 1, 'BUSA', 0, 0, 1),
(219, 35, 16, 'x25', 0, 0, 1),
(220, 2, 3, 'SEMEN PUGER', 0, 0, 1),
(221, 6, 13, 'PHENOLIC 18 MM (2 Sisi)', 0, 0, 1),
(222, 9, 2, 'HOLLOW 4x4x3 Mm (6meter)', 0, 0, 1),
(223, 14, 1, 'MATA BOR BETON 14"', 0, 0, 1),
(224, 14, 1, 'MATA BOR BETON 8"', 0, 0, 1),
(225, 14, 1, 'MATA BOR BETON 18"', 0, 0, 1),
(226, 14, 1, 'MATA GERINDA FLEKSIBEL 4"', 0, 0, 1),
(227, 41, 3, 'COMBEXTRA', 0, 0, 1),
(228, 11, 7, 'TAMBANG 8 MM', 0, 0, 1),
(230, 42, 1, 'MEMBRAN FOGING 150 KA', 0, 0, 1),
(231, 28, 1, 'HANDLE PINTU WANLY', 0, 0, 1),
(232, 42, 1, 'SHIL ORING 38', 0, 0, 1),
(233, 28, 1, 'CARBON BRASS  GSH 388', 0, 0, 1),
(234, 28, 1, 'SIKAT KAWAT', 0, 0, 1),
(235, 28, 16, 'AUTOMATIC LEVEL TOPCON 1', 0, 0, 1),
(236, 28, 16, 'TRIPOD', 0, 0, 1),
(237, 28, 16, 'RAMBU UKUR', 0, 0, 1),
(238, 30, 14, 'KERAMIK MULIA 30X30 PUTIH', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `material_unit`
--

CREATE TABLE `material_unit` (
  `material_unit_id` int(3) NOT NULL,
  `material_unit_name` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `material_unit`
--

INSERT INTO `material_unit` (`material_unit_id`, `material_unit_name`) VALUES
(1, 'PCS'),
(2, 'BTG'),
(3, 'ZAK'),
(4, 'KG'),
(5, 'LMBR'),
(6, 'PSNG'),
(7, 'ROLL'),
(8, 'M3'),
(9, 'MTR'),
(10, 'GALON'),
(11, 'KALENG'),
(12, 'PILL'),
(13, 'LBR'),
(14, 'PACK'),
(15, 'KOD'),
(16, 'UNIT');

-- --------------------------------------------------------

--
-- Table structure for table `modul`
--

CREATE TABLE `modul` (
  `modul_id` int(5) NOT NULL,
  `modul_name` varchar(30) DEFAULT NULL,
  `modul_icon` varchar(30) DEFAULT NULL,
  `modul_url` varchar(100) DEFAULT NULL,
  `modul_position` int(2) DEFAULT NULL,
  `modul_status` int(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modul`
--

INSERT INTO `modul` (`modul_id`, `modul_name`, `modul_icon`, `modul_url`, `modul_position`, `modul_status`) VALUES
(1, 'Dashboard', 'fa fa-home', 'dashboard', 1, 1),
(2, 'Warehouse', 'fa fa-truck', 'warehouse', 2, 1),
(3, 'Procurement', 'fa fa-briefcase', 'procurement', 3, 1),
(4, 'Finance', 'fa fa-sign-in', 'finance', 4, 1),
(5, 'Secretariat', 'fa fa-envelope', 'secretariat', 5, 1),
(6, 'Accounting', 'fa fa-bookmark', 'accounting', 6, 0),
(7, 'Commercial', 'fa fa-folder', 'commercial', 7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mod_menu`
--

CREATE TABLE `mod_menu` (
  `mod_menu_id` int(11) NOT NULL,
  `modul_id` int(5) NOT NULL,
  `mod_menu_name` varchar(50) DEFAULT NULL,
  `mod_menu_icon` varchar(30) DEFAULT NULL,
  `mod_menu_url` varchar(100) DEFAULT NULL,
  `mod_menu_position` varchar(5) DEFAULT NULL,
  `mod_menu_special` int(1) NOT NULL DEFAULT '0',
  `mod_menu_create` int(1) DEFAULT '0',
  `mod_menu_read` int(1) DEFAULT '0',
  `mod_menu_update` int(1) DEFAULT '0',
  `mod_menu_delete` int(1) DEFAULT '0',
  `mod_menu_status` int(1) DEFAULT '1',
  `mod_menu_display` enum('modal','redirect') NOT NULL DEFAULT 'redirect',
  `mod_menu_production` int(1) NOT NULL DEFAULT '0' COMMENT 'development or production step'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mod_menu`
--

INSERT INTO `mod_menu` (`mod_menu_id`, `modul_id`, `mod_menu_name`, `mod_menu_icon`, `mod_menu_url`, `mod_menu_position`, `mod_menu_special`, `mod_menu_create`, `mod_menu_read`, `mod_menu_update`, `mod_menu_delete`, `mod_menu_status`, `mod_menu_display`, `mod_menu_production`) VALUES
(1, 1, 'Project', NULL, '#', '2', 0, 0, 1, 0, 0, 1, 'redirect', 0),
(2, 1, 'Project Access', NULL, 'dashboard/project_access', '2.2', 0, 1, 1, 1, 1, 1, 'redirect', 0),
(3, 1, 'Project Master', NULL, 'dashboard/project', '2.3', 0, 1, 1, 1, 1, 1, 'redirect', 0),
(5, 1, 'Users', '', 'dashboard/users', '3', 1, 1, 1, 1, 1, 1, 'redirect', 0),
(6, 1, 'System', '', '#', '4', 0, 0, 1, 0, 0, 1, 'redirect', 0),
(7, 5, 'Master Data', NULL, '#', '1', 0, 0, 1, 0, 0, 1, 'redirect', 0),
(8, 5, 'Relation', '', 'secretariat/relation', '1.1', 0, 1, 1, 1, 1, 1, 'redirect', 0),
(9, 5, 'Document Code', '', 'secretariat/doc-code', '1.2', 0, 1, 1, 1, 1, 1, 'redirect', 0),
(10, 5, 'Transaction', NULL, '#', '2', 0, 0, 1, 0, 0, 1, 'redirect', 0),
(11, 5, 'Document Control', '', 'secretariat/doc-control', '2.1', 1, 1, 0, 1, 0, 1, 'redirect', 0),
(12, 5, 'Information', NULL, '#', '3', 0, 0, 1, 0, 0, 1, 'redirect', 0),
(13, 5, 'Relation', '', 'secretariat/relation-info', '3.1', 1, 0, 1, 0, 0, 1, 'modal', 0),
(14, 5, 'Document In', '', 'secretariat/doc_entry', '3.2', 0, 0, 1, 1, 1, 1, 'modal', 0),
(15, 5, 'Document Out', '', 'secretariat/doc_exits', '3.3', 0, 0, 1, 1, 1, 1, 'modal', 0),
(16, 1, 'Modul & Menu', NULL, 'dashboard/menu', '5', 1, 1, 1, 1, 1, 1, 'redirect', 1),
(17, 1, 'Modul Access', NULL, 'dashboard/menu_access', '6', 1, 1, 1, 1, 1, 1, 'redirect', 0),
(18, 1, 'Employee', NULL, 'dashboard/employee', '1', 0, 1, 1, 1, 1, 1, 'redirect', 0),
(19, 2, 'Master Data', NULL, '#', '1', 0, 0, 1, 0, 0, 1, 'redirect', 0),
(20, 2, 'Supplier', NULL, 'warehouse/supplier', '1.1', 0, 1, 1, 1, 1, 1, 'redirect', 0),
(21, 2, 'Foreman', NULL, 'warehouse/foreman', '1.2', 0, 1, 1, 1, 1, 1, 'redirect', 0),
(22, 2, 'Sub Contractor', '', 'warehouse/sub-contractor', '1.3', 0, 1, 1, 1, 1, 1, 'redirect', 0),
(23, 2, 'Material', NULL, 'warehouse/material', '1.4', 0, 1, 1, 1, 1, 1, 'redirect', 0),
(24, 2, 'Equipment', NULL, 'warehouse/equipment', '1.5', 0, 1, 1, 1, 1, 1, 'redirect', 0),
(25, 3, 'Resource Code', '', 'procurement/rescode', '1.1', 0, 1, 1, 1, 1, 1, 'redirect', 0),
(26, 2, 'Transaction', NULL, '#', '2', 0, 0, 1, 0, 0, 1, 'redirect', 0),
(27, 2, 'BAPB - Material Receipt', NULL, 'warehouse/bapb', '2.1', 1, 1, 0, 1, 0, 1, 'redirect', 0),
(28, 2, 'BPM - Material Usage', NULL, 'warehouse/bpm', '2.2', 1, 1, 0, 1, 0, 1, 'redirect', 0),
(29, 2, 'BAPP - Equipment Receipt', '', 'warehouse/bapp', '2.3', 1, 1, 0, 1, 0, 1, 'redirect', 0),
(30, 2, 'BPP - Equpment Return', '', 'warehouse/bpp', '2.4', 1, 1, 0, 1, 0, 1, 'redirect', 0),
(31, 2, 'Information', NULL, '#', '3', 0, 0, 1, 0, 0, 1, 'redirect', 0),
(32, 2, 'Vendor & Foreman', '', 'warehouse/vendor-foreman', '3.1', 1, 0, 1, 0, 0, 1, 'modal', 0),
(33, 2, 'Data Material', '', 'warehouse/mt-information', '3.2', 1, 0, 1, 0, 0, 1, 'modal', 0),
(34, 2, 'Data Equipment', '', 'warehouse/eq-information', '3.3', 1, 0, 1, 0, 0, 1, 'modal', 0),
(35, 2, 'Data Material Stock', '', 'warehouse/mt-stock', '3.4', 0, 0, 1, 0, 0, 1, 'modal', 0),
(36, 2, 'Data Equipment Stock', '', 'warehouse/eq-stock', '3.5', 0, 0, 1, 0, 0, 1, 'modal', 0),
(37, 2, 'Data BAPB & BPM', '', 'warehouse/bapb-bpm-information', '3.6', 1, 0, 1, 1, 1, 1, 'modal', 0),
(38, 2, 'BAPB Processing', NULL, 'warehouse/mog/process', '3.7', 0, 0, 1, 1, 1, 2, 'modal', 0),
(39, 2, 'Data BAPP & BPP', '', 'warehouse/bapp-bpp-information', '3.8', 1, 0, 1, 1, 1, 1, 'modal', 0),
(40, 2, 'BAPP Processing', NULL, 'warehouse/transaction/equipment/process', '3.9', 0, 0, 1, 1, 1, 2, 'modal', 0),
(41, 2, 'Equipment Monitoring', '', 'warehouse/eq-monitoring', '3.10', 0, 0, 1, 0, 0, 1, 'modal', 0),
(42, 2, 'Report', NULL, '#', '4', 0, 0, 1, 0, 0, 1, 'redirect', 0),
(43, 2, 'Inventories Warehouse Administration (APG)', '', 'warehouse/apg', '4.1', 0, 0, 1, 0, 0, 1, 'redirect', 0),
(44, 2, 'BAPB Monitoring Supplier', NULL, 'warehouse/asm', '4.2', 0, 0, 1, 0, 0, 1, 'redirect', 0),
(45, 2, 'Settings', NULL, '#', '5', 0, 0, 1, 0, 0, 1, 'redirect', 0),
(46, 2, 'Initial Stock', '', 'warehouse/stock_initial', '5.1', 0, 0, 0, 1, 0, 1, 'redirect', 0),
(47, 4, 'Master Data', NULL, '#', '1', 0, 0, 1, 0, 0, 1, 'redirect', 0),
(48, 4, 'Tax', NULL, 'finance/tax', '1.1', 0, 0, 1, 1, 0, 1, 'redirect', 0),
(49, 4, 'Supplier', NULL, 'finance/supplier', '1.2', 0, 1, 1, 1, 1, 1, 'redirect', 0),
(50, 4, 'Foreman', '', 'finance/foreman', '1.3', 0, 1, 1, 1, 1, 1, 'redirect', 0),
(51, 4, 'Sub Contractor', '', 'finance/sub-contractor', '1.4', 0, 1, 1, 1, 1, 1, 'redirect', 0),
(52, 4, 'Transaction', NULL, '#', '2', 0, 0, 1, 0, 0, 1, 'redirect', 0),
(54, 4, 'Invoice', '', 'finance/invoice', '2.1', 1, 1, 0, 1, 0, 1, 'redirect', 0),
(55, 4, 'Payment', '', 'finance/payment', '2.2', 1, 1, 0, 1, 0, 1, 'redirect', 0),
(56, 4, 'Foreman Fee', '', 'finance/fee-transaction', '2.3', 1, 1, 0, 1, 1, 1, 'redirect', 0),
(57, 4, 'Information', NULL, '#', '3', 0, 0, 1, 0, 0, 1, 'redirect', 0),
(58, 4, 'Vendor & Foreman', '', 'finance/vendor-foreman', '3.1', 1, 0, 1, 0, 0, 1, 'modal', 0),
(59, 4, 'Invoice', '', 'finance/inv-information', '3.2', 1, 0, 1, 1, 1, 1, 'modal', 0),
(60, 4, 'Foreman Fee', '', 'finance/foreman-fee', '3.3', 1, 0, 1, 1, 1, 1, 'modal', 0),
(61, 4, 'Work Order Progress', '', 'finance/wo-progress', '3.4', 1, 0, 1, 1, 0, 1, 'modal', 0),
(62, 4, 'Monitoring Equipment', '', 'finance/eq-monitoring', '3.5', 0, 0, 1, 0, 0, 1, 'modal', 0),
(63, 4, 'Report', NULL, '#', '4', 0, 0, 1, 0, 0, 1, 'redirect', 0),
(64, 4, 'Tax PPN 10%', '', 'finance/tax-report-vat', '4.1', 0, 0, 1, 0, 0, 1, 'redirect', 0),
(65, 4, 'Income Tax Article 21', '', 'finance/tax-report-pph21', '4.2', 0, 0, 1, 0, 0, 1, 'redirect', 0),
(66, 4, 'Income Tax Article 22', '', 'finance/tax-report-pph22', '4.3', 0, 0, 1, 0, 0, 1, 'redirect', 0),
(67, 4, 'Income Tax Article 23', '', 'finance/tax-report-pph23', '4.4', 0, 0, 1, 0, 0, 1, 'redirect', 0),
(68, 3, 'Master Data', NULL, '#', '1', 0, 0, 1, 0, 0, 1, 'redirect', 0),
(69, 3, 'Transaction', NULL, '#', '2', 0, 0, 1, 0, 0, 1, 'redirect', 0),
(70, 3, 'BAPB Process', NULL, 'procurement/transaction/material', '2.1', 0, 1, 0, 1, 0, 1, 'redirect', 0),
(71, 3, 'BAPP Process', NULL, 'procurement/transaction/equipment/entry', '2.2', 0, 1, 0, 1, 0, 1, 'redirect', 0),
(72, 3, 'Work Order', '', 'procurement/work-order', '2.3', 0, 1, 1, 1, 1, 1, 'redirect', 0),
(73, 3, 'Information', NULL, '#', '3', 0, 0, 1, 0, 0, 1, 'redirect', 0),
(74, 3, 'Vendor & Foreman', '', 'procurement/vendor-foreman', '3.1', 1, 0, 1, 0, 0, 1, 'modal', 0),
(75, 3, 'BAPB & BAPP Process', '', 'procurement/bapb-bapp-process', '3.2', 0, 0, 1, 1, 1, 1, 'modal', 0),
(76, 3, 'Data BAPP & BPP', NULL, 'warehouse/transaction/equipment/info', '3.3', 0, 0, 1, 0, 0, 2, 'modal', 0),
(77, 3, 'Report', NULL, '#', '5', 0, 0, 1, 0, 0, 1, 'redirect', 0),
(78, 1, 'Profile System', '', 'dashboard/system', '4.1', 0, 0, 1, 1, 0, 1, 'redirect', 0),
(79, 1, 'Gallery Company', '', 'dashboard/gallery', '4.2', 1, 1, 1, 1, 1, 1, 'redirect', 0),
(80, 1, 'Login Template', '', 'dashboard/login-page', '4.3', 1, 1, 1, 1, 1, 1, 'redirect', 0);

-- --------------------------------------------------------

--
-- Table structure for table `mod_menu_access`
--

CREATE TABLE `mod_menu_access` (
  `mod_menu_access_id` int(11) NOT NULL,
  `users_position_id` int(11) NOT NULL,
  `mod_menu_id` int(11) NOT NULL,
  `access_create` int(1) DEFAULT '0',
  `access_read` int(1) DEFAULT '0',
  `access_update` int(1) DEFAULT '0',
  `access_delete` int(1) DEFAULT '0',
  `access_special` int(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mod_menu_access`
--

INSERT INTO `mod_menu_access` (`mod_menu_access_id`, `users_position_id`, `mod_menu_id`, `access_create`, `access_read`, `access_update`, `access_delete`, `access_special`) VALUES
(19, 9, 31, 0, 1, 0, 0, 0),
(20, 9, 41, 0, 1, 0, 0, 0),
(21, 9, 35, 0, 1, 0, 0, 0),
(22, 9, 36, 0, 1, 0, 0, 0),
(23, 9, 37, 0, 1, 0, 0, 0),
(24, 9, 38, 0, 1, 0, 0, 0),
(25, 9, 40, 0, 1, 0, 0, 0),
(26, 9, 42, 0, 1, 0, 0, 0),
(27, 9, 43, 0, 1, 0, 0, 0),
(28, 9, 44, 0, 1, 0, 0, 0),
(29, 9, 73, 0, 1, 0, 0, 0),
(30, 9, 75, 0, 1, 0, 0, 0),
(31, 9, 76, 0, 1, 0, 0, 0),
(32, 9, 57, 0, 1, 0, 0, 0),
(33, 9, 59, 0, 1, 0, 0, 0),
(34, 9, 60, 0, 1, 0, 0, 0),
(35, 9, 62, 0, 1, 0, 0, 0),
(36, 9, 12, 0, 1, 0, 0, 0),
(37, 9, 13, 0, 1, 0, 0, 0),
(38, 9, 14, 0, 1, 0, 0, 0),
(39, 9, 15, 0, 1, 0, 0, 0),
(494, 2, 31, 0, 1, 0, 0, 0),
(495, 2, 41, 0, 1, 0, 0, 0),
(496, 2, 35, 0, 1, 0, 0, 0),
(497, 2, 36, 0, 1, 0, 0, 0),
(498, 2, 37, 0, 1, 0, 0, 0),
(499, 2, 38, 0, 1, 0, 0, 0),
(500, 2, 40, 0, 1, 0, 0, 0),
(501, 2, 42, 0, 1, 0, 0, 0),
(502, 2, 43, 0, 1, 0, 0, 0),
(503, 2, 44, 0, 1, 0, 0, 0),
(504, 2, 73, 0, 1, 0, 0, 0),
(505, 2, 75, 0, 1, 0, 0, 0),
(506, 2, 76, 0, 1, 0, 0, 0),
(507, 2, 57, 0, 1, 0, 0, 0),
(508, 2, 59, 0, 1, 0, 0, 0),
(509, 2, 60, 0, 1, 0, 0, 0),
(510, 2, 62, 0, 1, 0, 0, 0),
(511, 2, 12, 0, 1, 0, 0, 0),
(512, 2, 13, 0, 1, 0, 0, 0),
(513, 2, 14, 0, 1, 0, 0, 0),
(514, 2, 15, 0, 1, 0, 0, 0),
(524, 6, 47, 0, 1, 0, 0, 0),
(525, 6, 48, 0, 1, 1, 0, 0),
(526, 6, 49, 1, 1, 1, 1, 0),
(527, 6, 50, 1, 1, 1, 1, 0),
(528, 6, 51, 1, 1, 1, 1, 0),
(529, 6, 52, 0, 1, 0, 0, 0),
(530, 6, 54, 1, 0, 1, 0, 0),
(531, 6, 55, 0, 1, 1, 0, 0),
(532, 6, 56, 1, 0, 1, 0, 0),
(533, 6, 57, 0, 1, 0, 0, 0),
(534, 6, 58, 0, 1, 0, 0, 0),
(535, 6, 59, 0, 1, 0, 0, 0),
(536, 6, 60, 0, 1, 0, 0, 0),
(537, 6, 61, 0, 1, 0, 0, 0),
(538, 6, 62, 0, 1, 0, 0, 0),
(539, 6, 63, 0, 1, 0, 0, 0),
(540, 6, 64, 0, 1, 0, 0, 0),
(541, 6, 65, 0, 1, 0, 0, 0),
(542, 6, 66, 0, 1, 0, 0, 0),
(543, 6, 67, 0, 1, 0, 0, 0),
(544, 5, 68, 0, 1, 0, 0, 0),
(545, 5, 69, 0, 1, 0, 0, 0),
(546, 5, 70, 1, 0, 1, 0, 0),
(547, 5, 71, 1, 0, 1, 0, 0),
(548, 5, 72, 1, 1, 1, 1, 0),
(549, 5, 73, 0, 1, 0, 0, 0),
(550, 5, 74, 0, 1, 0, 0, 0),
(551, 5, 75, 0, 1, 0, 0, 0),
(552, 5, 76, 0, 1, 0, 0, 0),
(553, 5, 77, 0, 1, 0, 0, 0),
(2670, 4, 19, 0, 1, 0, 0, 0),
(2671, 4, 20, 1, 1, 1, 1, 0),
(2672, 4, 21, 1, 1, 1, 1, 0),
(2673, 4, 22, 1, 1, 1, 1, 0),
(2674, 4, 23, 1, 1, 1, 1, 0),
(2675, 4, 24, 1, 1, 1, 1, 0),
(2676, 4, 26, 0, 1, 0, 0, 0),
(2677, 4, 27, 1, 0, 1, 0, 0),
(2678, 4, 28, 1, 0, 1, 0, 0),
(2679, 4, 29, 1, 0, 1, 0, 0),
(2680, 4, 30, 1, 0, 1, 0, 0),
(2681, 4, 31, 0, 1, 0, 0, 0),
(2682, 4, 32, 0, 1, 0, 0, 0),
(2683, 4, 41, 0, 1, 0, 0, 0),
(2684, 4, 35, 0, 1, 0, 0, 0),
(2685, 4, 36, 0, 1, 0, 0, 0),
(2686, 4, 37, 0, 1, 0, 0, 1),
(2687, 4, 39, 0, 1, 0, 0, 1),
(2688, 4, 42, 0, 1, 0, 0, 0),
(2689, 4, 43, 0, 1, 0, 0, 0),
(2690, 3, 31, 0, 1, 0, 0, 0),
(2691, 3, 32, 0, 1, 0, 0, 0),
(2692, 3, 41, 0, 1, 0, 0, 0),
(2693, 3, 35, 0, 1, 0, 0, 0),
(2694, 3, 36, 0, 1, 0, 0, 0),
(2695, 3, 37, 0, 1, 0, 0, 0),
(2696, 3, 39, 0, 1, 0, 0, 0),
(2697, 3, 42, 0, 1, 0, 0, 0),
(2698, 3, 43, 0, 1, 0, 0, 0),
(2699, 3, 44, 0, 1, 0, 0, 0),
(2700, 3, 73, 0, 1, 0, 0, 0),
(2701, 3, 74, 0, 1, 0, 0, 0),
(2702, 3, 75, 0, 1, 0, 0, 0),
(2703, 3, 76, 0, 1, 0, 0, 0),
(2704, 3, 57, 0, 1, 0, 0, 0),
(2705, 3, 58, 0, 1, 0, 0, 0),
(2706, 3, 59, 0, 1, 0, 0, 0),
(2707, 3, 60, 0, 1, 0, 0, 0),
(2708, 3, 61, 0, 1, 0, 0, 0),
(2709, 3, 62, 0, 1, 0, 0, 0),
(2710, 3, 63, 0, 1, 0, 0, 0),
(2711, 3, 64, 0, 1, 0, 0, 0),
(2712, 3, 65, 0, 1, 0, 0, 0),
(2713, 3, 66, 0, 1, 0, 0, 0),
(2714, 3, 67, 0, 1, 0, 0, 0),
(2715, 3, 12, 0, 1, 0, 0, 0),
(2716, 3, 13, 0, 1, 0, 0, 0),
(2717, 3, 14, 0, 1, 0, 0, 0),
(2718, 3, 15, 0, 1, 0, 0, 0),
(3020, 7, 7, 0, 1, 0, 0, 0),
(3021, 7, 8, 1, 1, 1, 1, 0),
(3022, 7, 9, 1, 1, 1, 1, 0),
(3023, 7, 10, 0, 1, 0, 0, 0),
(3024, 7, 11, 1, 0, 1, 0, 0),
(3025, 7, 12, 0, 1, 0, 0, 0),
(3026, 7, 13, 0, 1, 0, 0, 0),
(3027, 7, 14, 0, 1, 1, 0, 0),
(3028, 7, 15, 0, 1, 1, 0, 0),
(3249, 1, 18, 1, 1, 1, 1, 0),
(3250, 1, 1, 0, 1, 0, 0, 0),
(3251, 1, 2, 1, 1, 1, 1, 0),
(3252, 1, 3, 1, 1, 1, 1, 0),
(3253, 1, 5, 1, 1, 1, 1, 1),
(3254, 1, 6, 0, 1, 0, 0, 0),
(3255, 1, 78, 0, 1, 1, 0, 0),
(3256, 1, 79, 1, 1, 1, 1, 1),
(3257, 1, 80, 1, 1, 1, 1, 1),
(3258, 1, 16, 1, 1, 1, 1, 1),
(3259, 1, 17, 1, 1, 1, 1, 1),
(3260, 1, 19, 0, 1, 0, 0, 0),
(3261, 1, 20, 1, 1, 1, 1, 0),
(3262, 1, 21, 1, 1, 1, 1, 0),
(3263, 1, 22, 1, 1, 1, 1, 0),
(3264, 1, 23, 1, 1, 1, 1, 0),
(3265, 1, 24, 1, 1, 1, 1, 0),
(3266, 1, 26, 0, 1, 0, 0, 0),
(3267, 1, 27, 1, 0, 1, 0, 1),
(3268, 1, 28, 1, 0, 1, 0, 1),
(3269, 1, 29, 1, 0, 1, 0, 1),
(3270, 1, 30, 1, 0, 1, 0, 1),
(3271, 1, 31, 0, 1, 0, 0, 0),
(3272, 1, 32, 0, 1, 0, 0, 1),
(3273, 1, 41, 0, 1, 0, 0, 0),
(3274, 1, 33, 0, 1, 0, 0, 1),
(3275, 1, 34, 0, 1, 0, 0, 1),
(3276, 1, 35, 0, 1, 0, 0, 0),
(3277, 1, 36, 0, 1, 0, 0, 0),
(3278, 1, 37, 0, 1, 1, 1, 1),
(3279, 1, 39, 0, 1, 1, 1, 1),
(3280, 1, 42, 0, 1, 0, 0, 0),
(3281, 1, 43, 0, 1, 0, 0, 0),
(3282, 1, 44, 0, 1, 0, 0, 0),
(3283, 1, 45, 0, 1, 0, 0, 0),
(3284, 1, 46, 0, 0, 1, 0, 0),
(3285, 1, 68, 0, 1, 0, 0, 0),
(3286, 1, 25, 1, 1, 1, 1, 0),
(3287, 1, 69, 0, 1, 0, 0, 0),
(3288, 1, 70, 1, 0, 1, 0, 0),
(3289, 1, 71, 1, 0, 1, 0, 0),
(3290, 1, 72, 1, 1, 1, 1, 0),
(3291, 1, 73, 0, 1, 0, 0, 0),
(3292, 1, 74, 0, 1, 0, 0, 1),
(3293, 1, 75, 0, 1, 1, 1, 0),
(3294, 1, 47, 0, 1, 0, 0, 0),
(3295, 1, 48, 0, 1, 1, 0, 0),
(3296, 1, 49, 1, 1, 1, 1, 0),
(3297, 1, 50, 1, 1, 1, 1, 0),
(3298, 1, 51, 1, 1, 1, 1, 0),
(3299, 1, 52, 0, 1, 0, 0, 0),
(3300, 1, 54, 1, 0, 1, 0, 0),
(3301, 1, 55, 0, 0, 1, 0, 0),
(3302, 1, 56, 1, 0, 1, 1, 1),
(3303, 1, 57, 0, 1, 0, 0, 0),
(3304, 1, 58, 0, 1, 0, 0, 1),
(3305, 1, 59, 0, 1, 1, 1, 1),
(3306, 1, 60, 0, 1, 1, 1, 1),
(3307, 1, 61, 0, 1, 1, 0, 1),
(3308, 1, 62, 0, 1, 0, 0, 0),
(3309, 1, 63, 0, 1, 0, 0, 0),
(3310, 1, 64, 0, 1, 0, 0, 0),
(3311, 1, 65, 0, 1, 0, 0, 0),
(3312, 1, 66, 0, 1, 0, 0, 0),
(3313, 1, 67, 0, 1, 0, 0, 0),
(3314, 1, 7, 0, 1, 0, 0, 0),
(3315, 1, 8, 1, 1, 1, 1, 0),
(3316, 1, 9, 1, 1, 1, 1, 0),
(3317, 1, 10, 0, 1, 0, 0, 0),
(3318, 1, 11, 1, 0, 1, 0, 1),
(3319, 1, 12, 0, 1, 0, 0, 0),
(3320, 1, 13, 0, 1, 0, 0, 0),
(3321, 1, 14, 0, 1, 1, 1, 0),
(3322, 1, 15, 0, 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mog`
--

CREATE TABLE `mog` (
  `mog_id` int(11) NOT NULL,
  `transaction_ct_id` int(3) NOT NULL,
  `users_id` int(6) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `actor_id` int(11) DEFAULT NULL,
  `mog_number_letter` varchar(20) DEFAULT NULL,
  `mog_number` varchar(11) DEFAULT NULL,
  `mog_date` datetime DEFAULT NULL,
  `mog_date_verify` date DEFAULT NULL,
  `mog_total` double NOT NULL,
  `mog_status` varchar(1) DEFAULT NULL COMMENT 'default = NULL; 1 = proses MOG selesai'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mog`
--

INSERT INTO `mog` (`mog_id`, `transaction_ct_id`, `users_id`, `project_id`, `actor_id`, `mog_number_letter`, `mog_number`, `mog_date`, `mog_date_verify`, `mog_total`, `mog_status`) VALUES
(1, 1, 1, 1, 2, '123466', '000005', '2016-05-04 18:14:09', '2016-05-04', 8390400, '1'),
(2, 1, 1, 1, 1, '12466', '000005', '2016-05-04 18:15:01', '2016-05-04', 169564777, '1'),
(3, 2, 1, 1, 2, '0', '000005', '2016-05-04 18:15:58', NULL, 0, '1'),
(4, 2, 1, 1, 1, '0', '000005', '2016-05-04 18:16:33', NULL, 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `mog_dt`
--

CREATE TABLE `mog_dt` (
  `mog_dt_id` int(11) NOT NULL,
  `material_sub_id` int(11) NOT NULL,
  `code_id` varchar(2) DEFAULT NULL,
  `mog_id` int(11) NOT NULL,
  `mog_dt_volume` double DEFAULT NULL,
  `mog_dt_date` datetime DEFAULT NULL,
  `mog_dt_convertion` double DEFAULT NULL,
  `mog_dt_price` double DEFAULT NULL,
  `mog_dt_note` text,
  `mog_dt_status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mog_dt`
--

INSERT INTO `mog_dt` (`mog_dt_id`, `material_sub_id`, `code_id`, `mog_id`, `mog_dt_volume`, `mog_dt_date`, `mog_dt_convertion`, `mog_dt_price`, `mog_dt_note`, `mog_dt_status`) VALUES
(1, 222, NULL, 1, 1200, '2016-05-04 18:20:30', 0, 1250, NULL, 1),
(2, 43, NULL, 1, 500, '2016-05-04 18:20:30', 0, 1230, NULL, 1),
(3, 38, NULL, 1, 120, '2016-05-04 18:20:30', 0, 4500, NULL, 1),
(4, 190, NULL, 2, 123, '2016-05-04 18:20:10', 0, 1340, NULL, 1),
(5, 36, NULL, 2, 1360, '2016-05-04 18:20:10', 75.72, 1466, NULL, 1),
(6, 28, NULL, 2, 1200, '2016-05-04 18:20:10', 4.74, 2400, NULL, 1),
(7, 15, NULL, 2, 1250, '2016-05-04 18:20:10', 0, 1335, NULL, 1),
(8, 222, NULL, 3, 210, '2016-05-04 18:20:46', NULL, 0, NULL, 1),
(9, 43, NULL, 3, 100, '2016-05-04 18:20:46', NULL, 0, NULL, 1),
(10, 7, NULL, 3, 24, '2016-05-04 18:20:46', NULL, 0, NULL, 1),
(11, 132, NULL, 4, 50, '2016-05-04 18:21:05', NULL, 0, NULL, 1),
(12, 8, NULL, 4, 200, '2016-05-04 18:21:05', NULL, 0, NULL, 1),
(13, 189, NULL, 2, 1245, '2016-05-04 18:20:10', 0, 2500, NULL, 1),
(14, 28, NULL, 1, 500, '2016-05-04 18:20:30', 4.74, 2420, NULL, 1),
(15, 190, NULL, 4, 10, '2016-05-04 18:21:05', NULL, 0, NULL, 1),
(16, 11, NULL, 4, 5, '2016-05-04 18:21:05', NULL, 0, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mog_print`
--

CREATE TABLE `mog_print` (
  `mog_print_id` int(11) NOT NULL,
  `mog_id` int(11) NOT NULL,
  `users_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `page_config`
--

CREATE TABLE `page_config` (
  `page_config_id` int(11) NOT NULL,
  `page_config_ct_id` int(2) NOT NULL,
  `page_config_name` varchar(100) DEFAULT NULL,
  `page_config_url` varchar(100) DEFAULT NULL,
  `page_config_picture` varchar(100) DEFAULT NULL,
  `page_config_status` int(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page_config`
--

INSERT INTO `page_config` (`page_config_id`, `page_config_ct_id`, `page_config_name`, `page_config_url`, `page_config_picture`, `page_config_status`) VALUES
(1, 1, 'LOGIN FORFLAT', 'LOGIN/FORFLAT', 'assets/files/login-page/815052617fororiginal.png', 1),
(2, 1, 'LOGIN TIMEXSOON', 'LOGIN/FORTIMEXSOON', 'assets/files/login-page/177940292fortimexzoom.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `page_config_ct`
--

CREATE TABLE `page_config_ct` (
  `page_config_ct_id` int(2) NOT NULL,
  `page_config_ct_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page_config_ct`
--

INSERT INTO `page_config_ct` (`page_config_ct_id`, `page_config_ct_name`) VALUES
(1, 'Login'),
(2, 'Backend');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(22) NOT NULL,
  `payment_ct_id` int(5) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `payment_date` datetime DEFAULT NULL,
  `payment_sequence` int(3) DEFAULT NULL,
  `payment_total` double DEFAULT NULL,
  `payment_retensi` double NOT NULL,
  `payment_note` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment_ct`
--

CREATE TABLE `payment_ct` (
  `payment_ct_id` int(5) NOT NULL,
  `payment_ct_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_ct`
--

INSERT INTO `payment_ct` (`payment_ct_id`, `payment_ct_name`) VALUES
(1, 'Uang Muka'),
(2, 'Termin');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `project_id` int(11) NOT NULL,
  `project_name` varchar(50) NOT NULL,
  `project_address` text,
  `project_number` int(11) NOT NULL,
  `project_code` varchar(10) DEFAULT NULL,
  `project_region` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`project_id`, `project_name`, `project_address`, `project_number`, `project_code`, `project_region`) VALUES
(1, 'Proyek Apartemen UTTARA The Icon', 'jl. kaliurang Yogyakarta  ', 1234567, 'UTR', 'YOGYAKARTA'),
(2, 'Trowongan Sucipto', 'jl. solo', 123, 'TS', 'YOGYAKRTA');

-- --------------------------------------------------------

--
-- Table structure for table `project_access`
--

CREATE TABLE `project_access` (
  `project_access_id` int(11) NOT NULL,
  `users_id` int(6) NOT NULL,
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_access`
--

INSERT INTO `project_access` (`project_access_id`, `users_id`, `project_id`) VALUES
(1, 1, 1),
(23, 15, 1),
(24, 14, 1),
(25, 13, 1),
(26, 12, 1),
(27, 11, 1),
(28, 10, 1),
(29, 9, 1),
(30, 8, 1),
(31, 20, 1),
(32, 18, 1),
(33, 16, 1),
(34, 19, 1),
(35, 21, 1),
(36, 22, 1),
(38, 23, 1),
(39, 24, 1),
(40, 25, 1),
(41, 26, 1),
(42, 27, 1),
(43, 1, 2),
(44, 28, 1);

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `salary_id` int(11) NOT NULL,
  `salary_ct_id` int(11) NOT NULL,
  `actor_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `salary_number` varchar(40) DEFAULT NULL,
  `salary_date` datetime DEFAULT NULL,
  `salary_pay` double DEFAULT NULL,
  `salary_opname` double DEFAULT NULL,
  `salary_pkp` double DEFAULT '0',
  `salary_total_final` double NOT NULL DEFAULT '0',
  `salary_evidence` varchar(40) DEFAULT NULL,
  `salary_note` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `salary_tax`
--

CREATE TABLE `salary_tax` (
  `salary_tax_id` int(11) NOT NULL,
  `salary_id` int(11) NOT NULL,
  `tax_id` int(5) NOT NULL,
  `salary_tax_cuts` double NOT NULL DEFAULT '0',
  `salary_tax_nominal` double DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `stock_id` int(11) NOT NULL,
  `mog_id` int(11) DEFAULT NULL,
  `project_id` int(11) NOT NULL,
  `material_sub_id` int(11) NOT NULL,
  `stock_entry` double DEFAULT NULL,
  `stock_exit` double DEFAULT NULL,
  `stock_rest` double DEFAULT NULL,
  `stock_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stock_id`, `mog_id`, `project_id`, `material_sub_id`, `stock_entry`, `stock_exit`, `stock_rest`, `stock_date`) VALUES
(1, NULL, 1, 7, 12543, NULL, 12543, '2016-05-04 18:11:22'),
(2, NULL, 1, 8, 12546, NULL, 12546, '2016-05-04 18:11:22'),
(3, NULL, 1, 9, 5454, NULL, 5454, '2016-05-04 18:11:22'),
(4, NULL, 1, 10, 56636, NULL, 56636, '2016-05-04 18:11:22'),
(5, NULL, 1, 11, 8466, NULL, 8466, '2016-05-04 18:11:22'),
(6, NULL, 1, 12, 0, NULL, 0, '2016-05-04 18:11:22'),
(7, NULL, 1, 13, 0, NULL, 0, '2016-05-04 18:11:22'),
(8, NULL, 1, 14, 0, NULL, 0, '2016-05-04 18:11:22'),
(9, NULL, 1, 15, 0, NULL, 0, '2016-05-04 18:11:22'),
(10, NULL, 1, 16, 0, NULL, 0, '2016-05-04 18:11:22'),
(11, NULL, 1, 17, 0, NULL, 0, '2016-05-04 18:11:22'),
(12, NULL, 1, 18, 0, NULL, 0, '2016-05-04 18:11:22'),
(13, NULL, 1, 19, 0, NULL, 0, '2016-05-04 18:11:22'),
(14, NULL, 1, 20, 0, NULL, 0, '2016-05-04 18:11:22'),
(15, NULL, 1, 21, 0, NULL, 0, '2016-05-04 18:11:22'),
(16, NULL, 1, 22, 0, NULL, 0, '2016-05-04 18:11:22'),
(17, NULL, 1, 23, 0, NULL, 0, '2016-05-04 18:11:22'),
(18, NULL, 1, 24, 0, NULL, 0, '2016-05-04 18:11:22'),
(19, NULL, 1, 25, 0, NULL, 0, '2016-05-04 18:11:22'),
(20, NULL, 1, 26, 0, NULL, 0, '2016-05-04 18:11:22'),
(21, NULL, 1, 28, 45145, NULL, 45145, '2016-05-04 18:11:22'),
(22, NULL, 1, 29, 5555, NULL, 5555, '2016-05-04 18:11:22'),
(23, NULL, 1, 30, 12456, NULL, 12456, '2016-05-04 18:11:22'),
(24, NULL, 1, 31, 15462, NULL, 15462, '2016-05-04 18:11:22'),
(25, NULL, 1, 32, 0, NULL, 0, '2016-05-04 18:11:22'),
(26, NULL, 1, 33, 0, NULL, 0, '2016-05-04 18:11:22'),
(27, NULL, 1, 34, 0, NULL, 0, '2016-05-04 18:11:22'),
(28, NULL, 1, 35, 0, NULL, 0, '2016-05-04 18:11:22'),
(29, NULL, 1, 36, 0, NULL, 0, '2016-05-04 18:11:22'),
(30, NULL, 1, 37, 0, NULL, 0, '2016-05-04 18:11:22'),
(31, NULL, 1, 38, 0, NULL, 0, '2016-05-04 18:11:22'),
(32, NULL, 1, 39, 125456, NULL, 125456, '2016-05-04 18:11:22'),
(33, NULL, 1, 40, 56863, NULL, 56863, '2016-05-04 18:11:22'),
(34, NULL, 1, 41, 12346, NULL, 12346, '2016-05-04 18:11:22'),
(35, NULL, 1, 42, 0, NULL, 0, '2016-05-04 18:11:22'),
(36, NULL, 1, 43, 0, NULL, 0, '2016-05-04 18:11:22'),
(37, NULL, 1, 44, 0, NULL, 0, '2016-05-04 18:11:22'),
(38, NULL, 1, 45, 0, NULL, 0, '2016-05-04 18:11:22'),
(39, NULL, 1, 46, 0, NULL, 0, '2016-05-04 18:11:22'),
(40, NULL, 1, 47, 0, NULL, 0, '2016-05-04 18:11:22'),
(41, NULL, 1, 48, 0, NULL, 0, '2016-05-04 18:11:22'),
(42, NULL, 1, 49, 0, NULL, 0, '2016-05-04 18:11:22'),
(43, NULL, 1, 50, 0, NULL, 0, '2016-05-04 18:11:22'),
(44, NULL, 1, 52, 0, NULL, 0, '2016-05-04 18:11:22'),
(45, NULL, 1, 56, 0, NULL, 0, '2016-05-04 18:11:22'),
(46, NULL, 1, 57, 0, NULL, 0, '2016-05-04 18:11:22'),
(47, NULL, 1, 58, 0, NULL, 0, '2016-05-04 18:11:22'),
(48, NULL, 1, 59, 0, NULL, 0, '2016-05-04 18:11:22'),
(49, NULL, 1, 60, 12146, NULL, 12146, '2016-05-04 18:11:22'),
(50, NULL, 1, 61, 4662, NULL, 4662, '2016-05-04 18:11:22'),
(51, NULL, 1, 62, 6595, NULL, 6595, '2016-05-04 18:11:22'),
(52, NULL, 1, 63, 5685, NULL, 5685, '2016-05-04 18:11:22'),
(53, NULL, 1, 64, 9595, NULL, 9595, '2016-05-04 18:11:22'),
(54, NULL, 1, 65, 9895, NULL, 9895, '2016-05-04 18:11:22'),
(55, NULL, 1, 66, 0, NULL, 0, '2016-05-04 18:11:22'),
(56, NULL, 1, 67, 0, NULL, 0, '2016-05-04 18:11:22'),
(57, NULL, 1, 68, 0, NULL, 0, '2016-05-04 18:11:22'),
(58, NULL, 1, 69, 0, NULL, 0, '2016-05-04 18:11:22'),
(59, NULL, 1, 70, 0, NULL, 0, '2016-05-04 18:11:22'),
(60, NULL, 1, 71, 0, NULL, 0, '2016-05-04 18:11:22'),
(61, NULL, 1, 72, 0, NULL, 0, '2016-05-04 18:11:22'),
(62, NULL, 1, 73, 0, NULL, 0, '2016-05-04 18:11:22'),
(63, NULL, 1, 74, 0, NULL, 0, '2016-05-04 18:11:22'),
(64, NULL, 1, 75, 0, NULL, 0, '2016-05-04 18:11:22'),
(65, NULL, 1, 76, 0, NULL, 0, '2016-05-04 18:11:22'),
(66, NULL, 1, 77, 56656, NULL, 56656, '2016-05-04 18:11:22'),
(67, NULL, 1, 78, 0, NULL, 0, '2016-05-04 18:11:22'),
(68, NULL, 1, 79, 5646, NULL, 5646, '2016-05-04 18:11:22'),
(69, NULL, 1, 80, 88546, NULL, 88546, '2016-05-04 18:11:22'),
(70, NULL, 1, 81, 49925, NULL, 49925, '2016-05-04 18:11:22'),
(71, NULL, 1, 82, 8746, NULL, 8746, '2016-05-04 18:11:22'),
(72, NULL, 1, 83, 1346, NULL, 1346, '2016-05-04 18:11:22'),
(73, NULL, 1, 84, 46622, NULL, 46622, '2016-05-04 18:11:22'),
(74, NULL, 1, 85, 0, NULL, 0, '2016-05-04 18:11:22'),
(75, NULL, 1, 86, 0, NULL, 0, '2016-05-04 18:11:22'),
(76, NULL, 1, 87, 0, NULL, 0, '2016-05-04 18:11:22'),
(77, NULL, 1, 88, 0, NULL, 0, '2016-05-04 18:11:22'),
(78, NULL, 1, 89, 0, NULL, 0, '2016-05-04 18:11:22'),
(79, NULL, 1, 90, 0, NULL, 0, '2016-05-04 18:11:22'),
(80, NULL, 1, 92, 0, NULL, 0, '2016-05-04 18:11:22'),
(81, NULL, 1, 93, 0, NULL, 0, '2016-05-04 18:11:22'),
(82, NULL, 1, 94, 0, NULL, 0, '2016-05-04 18:11:22'),
(83, NULL, 1, 95, 0, NULL, 0, '2016-05-04 18:11:22'),
(84, NULL, 1, 96, 0, NULL, 0, '2016-05-04 18:11:22'),
(85, NULL, 1, 97, 0, NULL, 0, '2016-05-04 18:11:22'),
(86, NULL, 1, 99, 45612, NULL, 45612, '2016-05-04 18:11:22'),
(87, NULL, 1, 100, 1562, NULL, 1562, '2016-05-04 18:11:22'),
(88, NULL, 1, 101, 46622, NULL, 46622, '2016-05-04 18:11:22'),
(89, NULL, 1, 104, 4962, NULL, 4962, '2016-05-04 18:11:22'),
(90, NULL, 1, 105, 0, NULL, 0, '2016-05-04 18:11:22'),
(91, NULL, 1, 106, 0, NULL, 0, '2016-05-04 18:11:22'),
(92, NULL, 1, 107, 0, NULL, 0, '2016-05-04 18:11:22'),
(93, NULL, 1, 108, 0, NULL, 0, '2016-05-04 18:11:22'),
(94, NULL, 1, 109, 0, NULL, 0, '2016-05-04 18:11:22'),
(95, NULL, 1, 110, 0, NULL, 0, '2016-05-04 18:11:22'),
(96, NULL, 1, 111, 0, NULL, 0, '2016-05-04 18:11:22'),
(97, NULL, 1, 112, 0, NULL, 0, '2016-05-04 18:11:22'),
(98, NULL, 1, 113, 0, NULL, 0, '2016-05-04 18:11:22'),
(99, NULL, 1, 114, 15664, NULL, 15664, '2016-05-04 18:11:22'),
(100, NULL, 1, 115, 6495, NULL, 6495, '2016-05-04 18:11:22'),
(101, NULL, 1, 116, 56552, NULL, 56552, '2016-05-04 18:11:22'),
(102, NULL, 1, 117, 45852, NULL, 45852, '2016-05-04 18:11:22'),
(103, NULL, 1, 118, 89514, NULL, 89514, '2016-05-04 18:11:22'),
(104, NULL, 1, 119, 0, NULL, 0, '2016-05-04 18:11:22'),
(105, NULL, 1, 120, 0, NULL, 0, '2016-05-04 18:11:22'),
(106, NULL, 1, 121, 0, NULL, 0, '2016-05-04 18:11:22'),
(107, NULL, 1, 122, 0, NULL, 0, '2016-05-04 18:11:22'),
(108, NULL, 1, 123, 0, NULL, 0, '2016-05-04 18:11:22'),
(109, NULL, 1, 124, 0, NULL, 0, '2016-05-04 18:11:22'),
(110, NULL, 1, 125, 0, NULL, 0, '2016-05-04 18:11:22'),
(111, NULL, 1, 126, 0, NULL, 0, '2016-05-04 18:11:22'),
(112, NULL, 1, 127, 0, NULL, 0, '2016-05-04 18:11:22'),
(113, NULL, 1, 128, 0, NULL, 0, '2016-05-04 18:11:22'),
(114, NULL, 1, 129, 0, NULL, 0, '2016-05-04 18:11:22'),
(115, NULL, 1, 130, 0, NULL, 0, '2016-05-04 18:11:22'),
(116, NULL, 1, 131, 2548, NULL, 2548, '2016-05-04 18:11:22'),
(117, NULL, 1, 132, 46514, NULL, 46514, '2016-05-04 18:11:22'),
(118, NULL, 1, 133, 0, NULL, 0, '2016-05-04 18:11:22'),
(119, NULL, 1, 134, 5685, NULL, 5685, '2016-05-04 18:11:22'),
(120, NULL, 1, 135, 5677, NULL, 5677, '2016-05-04 18:11:22'),
(121, NULL, 1, 136, 845, NULL, 845, '2016-05-04 18:11:22'),
(122, NULL, 1, 137, 0, NULL, 0, '2016-05-04 18:11:22'),
(123, NULL, 1, 138, 0, NULL, 0, '2016-05-04 18:11:22'),
(124, NULL, 1, 139, 0, NULL, 0, '2016-05-04 18:11:22'),
(125, NULL, 1, 140, 0, NULL, 0, '2016-05-04 18:11:22'),
(126, NULL, 1, 141, 0, NULL, 0, '2016-05-04 18:11:22'),
(127, NULL, 1, 142, 0, NULL, 0, '2016-05-04 18:11:22'),
(128, NULL, 1, 143, 0, NULL, 0, '2016-05-04 18:11:22'),
(129, NULL, 1, 144, 0, NULL, 0, '2016-05-04 18:11:22'),
(130, NULL, 1, 145, 0, NULL, 0, '2016-05-04 18:11:22'),
(131, NULL, 1, 146, 0, NULL, 0, '2016-05-04 18:11:22'),
(132, NULL, 1, 152, 0, NULL, 0, '2016-05-04 18:11:22'),
(133, NULL, 1, 153, 0, NULL, 0, '2016-05-04 18:11:22'),
(134, NULL, 1, 154, 0, NULL, 0, '2016-05-04 18:11:22'),
(135, NULL, 1, 155, 0, NULL, 0, '2016-05-04 18:11:22'),
(136, NULL, 1, 156, 0, NULL, 0, '2016-05-04 18:11:22'),
(137, NULL, 1, 157, 0, NULL, 0, '2016-05-04 18:11:22'),
(138, NULL, 1, 158, 0, NULL, 0, '2016-05-04 18:11:22'),
(139, NULL, 1, 159, 0, NULL, 0, '2016-05-04 18:11:22'),
(140, NULL, 1, 160, 0, NULL, 0, '2016-05-04 18:11:22'),
(141, NULL, 1, 161, 0, NULL, 0, '2016-05-04 18:11:22'),
(142, NULL, 1, 162, 12466, NULL, 12466, '2016-05-04 18:11:22'),
(143, NULL, 1, 163, 6464, NULL, 6464, '2016-05-04 18:11:22'),
(144, NULL, 1, 164, 0, NULL, 0, '2016-05-04 18:11:22'),
(145, NULL, 1, 165, 0, NULL, 0, '2016-05-04 18:11:22'),
(146, NULL, 1, 166, 0, NULL, 0, '2016-05-04 18:11:22'),
(147, NULL, 1, 167, 0, NULL, 0, '2016-05-04 18:11:22'),
(148, NULL, 1, 168, 0, NULL, 0, '2016-05-04 18:11:22'),
(149, NULL, 1, 169, 0, NULL, 0, '2016-05-04 18:11:22'),
(150, NULL, 1, 170, 0, NULL, 0, '2016-05-04 18:11:22'),
(151, NULL, 1, 171, 0, NULL, 0, '2016-05-04 18:11:22'),
(152, NULL, 1, 172, 0, NULL, 0, '2016-05-04 18:11:22'),
(153, NULL, 1, 173, 0, NULL, 0, '2016-05-04 18:11:22'),
(154, NULL, 1, 174, 0, NULL, 0, '2016-05-04 18:11:22'),
(155, NULL, 1, 175, 0, NULL, 0, '2016-05-04 18:11:22'),
(156, NULL, 1, 176, 0, NULL, 0, '2016-05-04 18:11:22'),
(157, NULL, 1, 177, 0, NULL, 0, '2016-05-04 18:11:22'),
(158, NULL, 1, 178, 0, NULL, 0, '2016-05-04 18:11:22'),
(159, NULL, 1, 179, 0, NULL, 0, '2016-05-04 18:11:22'),
(160, NULL, 1, 180, 0, NULL, 0, '2016-05-04 18:11:22'),
(161, NULL, 1, 181, 0, NULL, 0, '2016-05-04 18:11:22'),
(162, NULL, 1, 182, 0, NULL, 0, '2016-05-04 18:11:22'),
(163, NULL, 1, 183, 0, NULL, 0, '2016-05-04 18:11:22'),
(164, NULL, 1, 184, 0, NULL, 0, '2016-05-04 18:11:22'),
(165, NULL, 1, 185, 0, NULL, 0, '2016-05-04 18:11:22'),
(166, NULL, 1, 186, 0, NULL, 0, '2016-05-04 18:11:22'),
(167, NULL, 1, 187, 0, NULL, 0, '2016-05-04 18:11:22'),
(168, NULL, 1, 188, 0, NULL, 0, '2016-05-04 18:11:22'),
(169, NULL, 1, 189, 0, NULL, 0, '2016-05-04 18:11:22'),
(170, NULL, 1, 190, 0, NULL, 0, '2016-05-04 18:11:22'),
(171, NULL, 1, 191, 0, NULL, 0, '2016-05-04 18:11:22'),
(172, NULL, 1, 192, 0, NULL, 0, '2016-05-04 18:11:22'),
(173, NULL, 1, 193, 0, NULL, 0, '2016-05-04 18:11:22'),
(174, NULL, 1, 194, 0, NULL, 0, '2016-05-04 18:11:22'),
(175, NULL, 1, 195, 0, NULL, 0, '2016-05-04 18:11:22'),
(176, NULL, 1, 196, 0, NULL, 0, '2016-05-04 18:11:22'),
(177, NULL, 1, 197, 0, NULL, 0, '2016-05-04 18:11:22'),
(178, NULL, 1, 198, 0, NULL, 0, '2016-05-04 18:11:22'),
(179, NULL, 1, 199, 0, NULL, 0, '2016-05-04 18:11:22'),
(180, NULL, 1, 200, 0, NULL, 0, '2016-05-04 18:11:22'),
(181, NULL, 1, 201, 0, NULL, 0, '2016-05-04 18:11:22'),
(182, NULL, 1, 202, 0, NULL, 0, '2016-05-04 18:11:22'),
(183, NULL, 1, 203, 0, NULL, 0, '2016-05-04 18:11:22'),
(184, NULL, 1, 205, 0, NULL, 0, '2016-05-04 18:11:22'),
(185, NULL, 1, 207, 0, NULL, 0, '2016-05-04 18:11:22'),
(186, NULL, 1, 212, 0, NULL, 0, '2016-05-04 18:11:22'),
(187, NULL, 1, 214, 0, NULL, 0, '2016-05-04 18:11:22'),
(188, NULL, 1, 216, 0, NULL, 0, '2016-05-04 18:11:22'),
(189, NULL, 1, 217, 0, NULL, 0, '2016-05-04 18:11:22'),
(190, NULL, 1, 218, 0, NULL, 0, '2016-05-04 18:11:22'),
(191, NULL, 1, 219, 0, NULL, 0, '2016-05-04 18:11:22'),
(192, NULL, 1, 220, 0, NULL, 0, '2016-05-04 18:11:22'),
(193, NULL, 1, 221, 0, NULL, 0, '2016-05-04 18:11:22'),
(194, NULL, 1, 222, 0, NULL, 0, '2016-05-04 18:11:22'),
(195, NULL, 1, 223, 0, NULL, 0, '2016-05-04 18:11:22'),
(196, NULL, 1, 224, 0, NULL, 0, '2016-05-04 18:11:22'),
(197, NULL, 1, 225, 0, NULL, 0, '2016-05-04 18:11:22'),
(198, NULL, 1, 226, 0, NULL, 0, '2016-05-04 18:11:22'),
(199, NULL, 1, 227, 0, NULL, 0, '2016-05-04 18:11:22'),
(200, NULL, 1, 228, 0, NULL, 0, '2016-05-04 18:11:22'),
(201, NULL, 1, 230, 0, NULL, 0, '2016-05-04 18:11:22'),
(202, NULL, 1, 231, 0, NULL, 0, '2016-05-04 18:11:22'),
(203, NULL, 1, 232, 0, NULL, 0, '2016-05-04 18:11:22'),
(204, NULL, 1, 233, 0, NULL, 0, '2016-05-04 18:11:22'),
(205, NULL, 1, 234, 0, NULL, 0, '2016-05-04 18:11:22'),
(206, NULL, 1, 235, 4566, NULL, 4566, '2016-05-04 18:11:22'),
(207, NULL, 1, 236, 865625, NULL, 865625, '2016-05-04 18:11:22'),
(208, NULL, 1, 237, 4466, NULL, 4466, '2016-05-04 18:11:22'),
(209, NULL, 1, 238, 66256, NULL, 66256, '2016-05-04 18:11:22'),
(210, 1, 1, 222, 1200, NULL, 1200, '2016-05-04 18:14:09'),
(211, 1, 1, 43, 500, NULL, 500, '2016-05-04 18:14:09'),
(212, 1, 1, 38, 120, NULL, 120, '2016-05-04 18:14:09'),
(213, 2, 1, 190, 123, NULL, 123, '2016-05-04 18:15:01'),
(214, 2, 1, 36, 1360, NULL, 1360, '2016-05-04 18:15:01'),
(215, 2, 1, 28, 1200, NULL, 46345, '2016-05-04 18:15:01'),
(216, 2, 1, 15, 1250, NULL, 1250, '2016-05-04 18:15:01'),
(217, 3, 1, 222, NULL, 210, 990, '2016-05-04 18:15:58'),
(218, 3, 1, 43, NULL, 100, 400, '2016-05-04 18:15:58'),
(219, 3, 1, 7, NULL, 24, 12519, '2016-05-04 18:15:58'),
(220, 4, 1, 132, NULL, 50, 46464, '2016-05-04 18:16:33'),
(221, 4, 1, 8, NULL, 200, 12346, '2016-05-04 18:16:33'),
(222, 2, 1, 189, 1245, NULL, 1245, '2016-05-04 00:00:00'),
(223, 1, 1, 28, 500, NULL, 46845, '2016-05-04 00:00:00'),
(224, 3, 1, 190, NULL, 10, 113, '2016-05-04 00:00:00'),
(225, 4, 1, 11, NULL, 5, 8461, '2016-05-04 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `stock_final`
--

CREATE TABLE `stock_final` (
  `stock_final_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `material_sub_id` int(11) NOT NULL,
  `stock_final_date` datetime DEFAULT NULL,
  `stock_final_rest` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_final`
--

INSERT INTO `stock_final` (`stock_final_id`, `project_id`, `material_sub_id`, `stock_final_date`, `stock_final_rest`) VALUES
(1, 1, 7, '2016-05-04 18:15:59', 12519),
(2, 1, 8, '2016-05-04 18:16:33', 12346),
(3, 1, 9, '2016-05-04 18:11:22', 5454),
(4, 1, 10, '2016-05-04 18:11:22', 56636),
(5, 1, 11, '2016-05-04 18:21:05', 8461),
(6, 1, 12, '2016-05-04 18:11:22', 0),
(7, 1, 13, '2016-05-04 18:11:22', 0),
(8, 1, 14, '2016-05-04 18:11:22', 0),
(9, 1, 15, '2016-05-04 18:15:01', 1250),
(10, 1, 16, '2016-05-04 18:11:22', 0),
(11, 1, 17, '2016-05-04 18:11:22', 0),
(12, 1, 18, '2016-05-04 18:11:22', 0),
(13, 1, 19, '2016-05-04 18:11:22', 0),
(14, 1, 20, '2016-05-04 18:11:22', 0),
(15, 1, 21, '2016-05-04 18:11:22', 0),
(16, 1, 22, '2016-05-04 18:11:22', 0),
(17, 1, 23, '2016-05-04 18:11:22', 0),
(18, 1, 24, '2016-05-04 18:11:22', 0),
(19, 1, 25, '2016-05-04 18:11:22', 0),
(20, 1, 26, '2016-05-04 18:11:22', 0),
(21, 1, 28, '2016-05-04 18:20:30', 46845),
(22, 1, 29, '2016-05-04 18:11:22', 5555),
(23, 1, 30, '2016-05-04 18:11:22', 12456),
(24, 1, 31, '2016-05-04 18:11:22', 15462),
(25, 1, 32, '2016-05-04 18:11:22', 0),
(26, 1, 33, '2016-05-04 18:11:22', 0),
(27, 1, 34, '2016-05-04 18:11:22', 0),
(28, 1, 35, '2016-05-04 18:11:22', 0),
(29, 1, 36, '2016-05-04 18:15:01', 1360),
(30, 1, 37, '2016-05-04 18:11:22', 0),
(31, 1, 38, '2016-05-04 18:14:10', 120),
(32, 1, 39, '2016-05-04 18:11:22', 125456),
(33, 1, 40, '2016-05-04 18:11:22', 56863),
(34, 1, 41, '2016-05-04 18:11:22', 12346),
(35, 1, 42, '2016-05-04 18:11:22', 0),
(36, 1, 43, '2016-05-04 18:15:58', 400),
(37, 1, 44, '2016-05-04 18:11:22', 0),
(38, 1, 45, '2016-05-04 18:11:22', 0),
(39, 1, 46, '2016-05-04 18:11:22', 0),
(40, 1, 47, '2016-05-04 18:11:22', 0),
(41, 1, 48, '2016-05-04 18:11:22', 0),
(42, 1, 49, '2016-05-04 18:11:22', 0),
(43, 1, 50, '2016-05-04 18:11:22', 0),
(44, 1, 52, '2016-05-04 18:11:22', 0),
(45, 1, 56, '2016-05-04 18:11:22', 0),
(46, 1, 57, '2016-05-04 18:11:22', 0),
(47, 1, 58, '2016-05-04 18:11:22', 0),
(48, 1, 59, '2016-05-04 18:11:22', 0),
(49, 1, 60, '2016-05-04 18:11:22', 12146),
(50, 1, 61, '2016-05-04 18:11:22', 4662),
(51, 1, 62, '2016-05-04 18:11:22', 6595),
(52, 1, 63, '2016-05-04 18:11:22', 5685),
(53, 1, 64, '2016-05-04 18:11:22', 9595),
(54, 1, 65, '2016-05-04 18:11:22', 9895),
(55, 1, 66, '2016-05-04 18:11:22', 0),
(56, 1, 67, '2016-05-04 18:11:22', 0),
(57, 1, 68, '2016-05-04 18:11:22', 0),
(58, 1, 69, '2016-05-04 18:11:22', 0),
(59, 1, 70, '2016-05-04 18:11:22', 0),
(60, 1, 71, '2016-05-04 18:11:22', 0),
(61, 1, 72, '2016-05-04 18:11:22', 0),
(62, 1, 73, '2016-05-04 18:11:22', 0),
(63, 1, 74, '2016-05-04 18:11:22', 0),
(64, 1, 75, '2016-05-04 18:11:22', 0),
(65, 1, 76, '2016-05-04 18:11:22', 0),
(66, 1, 77, '2016-05-04 18:11:22', 56656),
(67, 1, 78, '2016-05-04 18:11:22', 0),
(68, 1, 79, '2016-05-04 18:11:22', 5646),
(69, 1, 80, '2016-05-04 18:11:22', 88546),
(70, 1, 81, '2016-05-04 18:11:22', 49925),
(71, 1, 82, '2016-05-04 18:11:22', 8746),
(72, 1, 83, '2016-05-04 18:11:22', 1346),
(73, 1, 84, '2016-05-04 18:11:22', 46622),
(74, 1, 85, '2016-05-04 18:11:22', 0),
(75, 1, 86, '2016-05-04 18:11:22', 0),
(76, 1, 87, '2016-05-04 18:11:22', 0),
(77, 1, 88, '2016-05-04 18:11:22', 0),
(78, 1, 89, '2016-05-04 18:11:22', 0),
(79, 1, 90, '2016-05-04 18:11:22', 0),
(80, 1, 92, '2016-05-04 18:11:22', 0),
(81, 1, 93, '2016-05-04 18:11:22', 0),
(82, 1, 94, '2016-05-04 18:11:22', 0),
(83, 1, 95, '2016-05-04 18:11:22', 0),
(84, 1, 96, '2016-05-04 18:11:22', 0),
(85, 1, 97, '2016-05-04 18:11:22', 0),
(86, 1, 99, '2016-05-04 18:11:22', 45612),
(87, 1, 100, '2016-05-04 18:11:22', 1562),
(88, 1, 101, '2016-05-04 18:11:22', 46622),
(89, 1, 104, '2016-05-04 18:11:22', 4962),
(90, 1, 105, '2016-05-04 18:11:22', 0),
(91, 1, 106, '2016-05-04 18:11:22', 0),
(92, 1, 107, '2016-05-04 18:11:22', 0),
(93, 1, 108, '2016-05-04 18:11:22', 0),
(94, 1, 109, '2016-05-04 18:11:22', 0),
(95, 1, 110, '2016-05-04 18:11:22', 0),
(96, 1, 111, '2016-05-04 18:11:22', 0),
(97, 1, 112, '2016-05-04 18:11:22', 0),
(98, 1, 113, '2016-05-04 18:11:22', 0),
(99, 1, 114, '2016-05-04 18:11:22', 15664),
(100, 1, 115, '2016-05-04 18:11:22', 6495),
(101, 1, 116, '2016-05-04 18:11:22', 56552),
(102, 1, 117, '2016-05-04 18:11:22', 45852),
(103, 1, 118, '2016-05-04 18:11:22', 89514),
(104, 1, 119, '2016-05-04 18:11:22', 0),
(105, 1, 120, '2016-05-04 18:11:22', 0),
(106, 1, 121, '2016-05-04 18:11:22', 0),
(107, 1, 122, '2016-05-04 18:11:22', 0),
(108, 1, 123, '2016-05-04 18:11:22', 0),
(109, 1, 124, '2016-05-04 18:11:22', 0),
(110, 1, 125, '2016-05-04 18:11:22', 0),
(111, 1, 126, '2016-05-04 18:11:22', 0),
(112, 1, 127, '2016-05-04 18:11:22', 0),
(113, 1, 128, '2016-05-04 18:11:22', 0),
(114, 1, 129, '2016-05-04 18:11:22', 0),
(115, 1, 130, '2016-05-04 18:11:22', 0),
(116, 1, 131, '2016-05-04 18:11:22', 2548),
(117, 1, 132, '2016-05-04 18:16:33', 46464),
(118, 1, 133, '2016-05-04 18:11:22', 0),
(119, 1, 134, '2016-05-04 18:11:22', 5685),
(120, 1, 135, '2016-05-04 18:11:22', 5677),
(121, 1, 136, '2016-05-04 18:11:22', 845),
(122, 1, 137, '2016-05-04 18:11:22', 0),
(123, 1, 138, '2016-05-04 18:11:22', 0),
(124, 1, 139, '2016-05-04 18:11:22', 0),
(125, 1, 140, '2016-05-04 18:11:22', 0),
(126, 1, 141, '2016-05-04 18:11:22', 0),
(127, 1, 142, '2016-05-04 18:11:22', 0),
(128, 1, 143, '2016-05-04 18:11:22', 0),
(129, 1, 144, '2016-05-04 18:11:22', 0),
(130, 1, 145, '2016-05-04 18:11:22', 0),
(131, 1, 146, '2016-05-04 18:11:22', 0),
(132, 1, 152, '2016-05-04 18:11:22', 0),
(133, 1, 153, '2016-05-04 18:11:22', 0),
(134, 1, 154, '2016-05-04 18:11:22', 0),
(135, 1, 155, '2016-05-04 18:11:22', 0),
(136, 1, 156, '2016-05-04 18:11:22', 0),
(137, 1, 157, '2016-05-04 18:11:22', 0),
(138, 1, 158, '2016-05-04 18:11:22', 0),
(139, 1, 159, '2016-05-04 18:11:22', 0),
(140, 1, 160, '2016-05-04 18:11:22', 0),
(141, 1, 161, '2016-05-04 18:11:22', 0),
(142, 1, 162, '2016-05-04 18:11:22', 12466),
(143, 1, 163, '2016-05-04 18:11:22', 6464),
(144, 1, 164, '2016-05-04 18:11:22', 0),
(145, 1, 165, '2016-05-04 18:11:22', 0),
(146, 1, 166, '2016-05-04 18:11:22', 0),
(147, 1, 167, '2016-05-04 18:11:22', 0),
(148, 1, 168, '2016-05-04 18:11:22', 0),
(149, 1, 169, '2016-05-04 18:11:22', 0),
(150, 1, 170, '2016-05-04 18:11:22', 0),
(151, 1, 171, '2016-05-04 18:11:22', 0),
(152, 1, 172, '2016-05-04 18:11:22', 0),
(153, 1, 173, '2016-05-04 18:11:22', 0),
(154, 1, 174, '2016-05-04 18:11:22', 0),
(155, 1, 175, '2016-05-04 18:11:22', 0),
(156, 1, 176, '2016-05-04 18:11:22', 0),
(157, 1, 177, '2016-05-04 18:11:22', 0),
(158, 1, 178, '2016-05-04 18:11:22', 0),
(159, 1, 179, '2016-05-04 18:11:22', 0),
(160, 1, 180, '2016-05-04 18:11:22', 0),
(161, 1, 181, '2016-05-04 18:11:22', 0),
(162, 1, 182, '2016-05-04 18:11:22', 0),
(163, 1, 183, '2016-05-04 18:11:22', 0),
(164, 1, 184, '2016-05-04 18:11:22', 0),
(165, 1, 185, '2016-05-04 18:11:22', 0),
(166, 1, 186, '2016-05-04 18:11:22', 0),
(167, 1, 187, '2016-05-04 18:11:22', 0),
(168, 1, 188, '2016-05-04 18:11:22', 0),
(169, 1, 189, '2016-05-04 18:20:10', 1245),
(170, 1, 190, '2016-05-04 18:20:46', 113),
(171, 1, 191, '2016-05-04 18:11:22', 0),
(172, 1, 192, '2016-05-04 18:11:22', 0),
(173, 1, 193, '2016-05-04 18:11:22', 0),
(174, 1, 194, '2016-05-04 18:11:22', 0),
(175, 1, 195, '2016-05-04 18:11:22', 0),
(176, 1, 196, '2016-05-04 18:11:22', 0),
(177, 1, 197, '2016-05-04 18:11:22', 0),
(178, 1, 198, '2016-05-04 18:11:22', 0),
(179, 1, 199, '2016-05-04 18:11:22', 0),
(180, 1, 200, '2016-05-04 18:11:22', 0),
(181, 1, 201, '2016-05-04 18:11:22', 0),
(182, 1, 202, '2016-05-04 18:11:22', 0),
(183, 1, 203, '2016-05-04 18:11:22', 0),
(184, 1, 205, '2016-05-04 18:11:22', 0),
(185, 1, 207, '2016-05-04 18:11:22', 0),
(186, 1, 212, '2016-05-04 18:11:22', 0),
(187, 1, 214, '2016-05-04 18:11:22', 0),
(188, 1, 216, '2016-05-04 18:11:22', 0),
(189, 1, 217, '2016-05-04 18:11:22', 0),
(190, 1, 218, '2016-05-04 18:11:22', 0),
(191, 1, 219, '2016-05-04 18:11:22', 0),
(192, 1, 220, '2016-05-04 18:11:22', 0),
(193, 1, 221, '2016-05-04 18:11:22', 0),
(194, 1, 222, '2016-05-04 18:15:58', 990),
(195, 1, 223, '2016-05-04 18:11:22', 0),
(196, 1, 224, '2016-05-04 18:11:22', 0),
(197, 1, 225, '2016-05-04 18:11:22', 0),
(198, 1, 226, '2016-05-04 18:11:22', 0),
(199, 1, 227, '2016-05-04 18:11:22', 0),
(200, 1, 228, '2016-05-04 18:11:22', 0),
(201, 1, 230, '2016-05-04 18:11:22', 0),
(202, 1, 231, '2016-05-04 18:11:22', 0),
(203, 1, 232, '2016-05-04 18:11:22', 0),
(204, 1, 233, '2016-05-04 18:11:22', 0),
(205, 1, 234, '2016-05-04 18:11:22', 0),
(206, 1, 235, '2016-05-04 18:11:22', 4566),
(207, 1, 236, '2016-05-04 18:11:22', 865625),
(208, 1, 237, '2016-05-04 18:11:22', 4466),
(209, 1, 238, '2016-05-04 18:11:22', 66256);

-- --------------------------------------------------------

--
-- Table structure for table `tax`
--

CREATE TABLE `tax` (
  `tax_id` int(5) NOT NULL,
  `tax_ct_id` int(2) NOT NULL,
  `tax_mode_id` int(11) NOT NULL,
  `tax_type` int(2) NOT NULL COMMENT '0: ppn, pph 1',
  `tax_name` varchar(20) NOT NULL,
  `tax_cuts` double NOT NULL DEFAULT '0',
  `tax_status` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tax`
--

INSERT INTO `tax` (`tax_id`, `tax_ct_id`, `tax_mode_id`, `tax_type`, `tax_name`, `tax_cuts`, `tax_status`) VALUES
(1, 1, 1, 0, 'PPN', 10, '1'),
(2, 1, 2, 0, 'PPN', 10, '0'),
(3, 2, 1, 0, 'PPN', 10, '1'),
(4, 2, 2, 0, 'PPN', 10, '0'),
(5, 3, 1, 0, 'PPh 21', 5, '1'),
(6, 3, 2, 1, 'PPh 21', 6, '1'),
(7, 1, 1, 1, 'PPh 21', 3, '0'),
(8, 1, 2, 1, 'PPh 21', 6, '0'),
(9, 3, 1, 1, 'PPh 22', 4, '0'),
(10, 3, 2, 1, 'PPh 22', 6, '0'),
(11, 1, 1, 1, 'PPh 22', 4, '1'),
(12, 1, 2, 1, 'PPh 22', 6, '1'),
(13, 3, 1, 1, 'PPh 23', 3, '0'),
(14, 3, 2, 1, 'PPh 23', 4, '0'),
(15, 2, 1, 1, 'PPh 23', 3, '1'),
(16, 2, 2, 1, 'PPh 23', 4, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tax_ct`
--

CREATE TABLE `tax_ct` (
  `tax_ct_id` int(2) NOT NULL,
  `tax_ct_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tax_ct`
--

INSERT INTO `tax_ct` (`tax_ct_id`, `tax_ct_name`) VALUES
(1, 'Material'),
(2, 'Equipment'),
(3, 'Personal');

-- --------------------------------------------------------

--
-- Table structure for table `tax_mode`
--

CREATE TABLE `tax_mode` (
  `tax_mode_id` int(11) NOT NULL,
  `tax_mode_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tax_mode`
--

INSERT INTO `tax_mode` (`tax_mode_id`, `tax_mode_name`) VALUES
(1, 'PKP'),
(2, 'Non PKP');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_ct`
--

CREATE TABLE `transaction_ct` (
  `transaction_ct_id` int(3) NOT NULL,
  `transaction_ct_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_ct`
--

INSERT INTO `transaction_ct` (`transaction_ct_id`, `transaction_ct_name`) VALUES
(1, 'Entry'),
(2, 'Exit'),
(3, 'Maintenance');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` int(6) NOT NULL,
  `users_position_id` int(3) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `users_username` varchar(20) NOT NULL,
  `users_password` varchar(50) NOT NULL,
  `users_registered` datetime NOT NULL,
  `users_status` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `users_position_id`, `employee_id`, `users_username`, `users_password`, `users_registered`, `users_status`) VALUES
(1, 1, 1, 'kuncoro', 'c51ab9e7d1621a037b5a6689cdf931ee', '2015-09-16 10:00:00', 1),
(8, 4, 27, 'suwarso', '1bd626fcd36204625da8d6029b1c35d8', '2015-11-03 10:23:31', 1),
(9, 4, 28, 'amsor', 'c0097a5904d40bf8c06f30dd88d41556', '2015-11-03 10:23:59', 1),
(10, 6, 29, 'putri', 'b985d585711459d868206bb2c54481aa', '2015-11-03 10:24:24', 1),
(11, 7, 30, 'fika', '54b53072540eeeb8f8e9343e71f28176', '2015-11-03 10:24:49', 1),
(12, 5, 31, 'ode', '54b53072540eeeb8f8e9343e71f28176', '2015-11-03 10:25:11', 1),
(13, 4, 32, 'dalil', '5b686b15b2005f537e965c4e6dec1521', '2015-11-03 10:28:05', 1),
(14, 3, 33, 'riyadi', '54b53072540eeeb8f8e9343e71f28176', '2015-11-03 10:29:11', 1),
(15, 9, 34, 'ali', '54b53072540eeeb8f8e9343e71f28176', '2015-11-03 11:03:49', 1),
(16, 3, 36, 'dirga', '54b53072540eeeb8f8e9343e71f28176', '2015-11-03 11:15:08', 1),
(17, 9, 35, 'mispan', '54b53072540eeeb8f8e9343e71f28176', '2015-11-03 11:15:23', 1),
(18, 2, 37, 'tomo', '54b53072540eeeb8f8e9343e71f28176', '2015-11-03 11:15:34', 1),
(19, 3, 38, 'gesha', '1c959a12620ea5d4fd34c8e26cc08ba3', '2015-11-03 11:15:51', 1),
(20, 9, 39, 'daryoto', '54b53072540eeeb8f8e9343e71f28176', '2015-11-03 11:20:41', 1),
(21, 5, 40, 'pengadaan', '847f55e913a1327b5519168555e22595', '2015-11-16 12:45:16', 1),
(22, 4, 41, 'gudang', '6bb4415fb9c6ed925d5470f50ec8d177', '2015-11-19 13:24:24', 1),
(23, 2, 43, 'manajer', '8ba69a89747fd2b571c8d76d7918a7a3', '2015-11-25 10:57:54', 1),
(24, 7, 46, 'sekre', 'd4087a1442a3fab4701c009f9d412bc9', '2015-11-25 11:43:16', 1),
(25, 3, 47, 'kepsi', '9d4b098bd793beef1c062a1c95595e12', '2015-11-25 12:19:25', 1),
(26, 9, 48, 'pelaksana', '0b9fd46a29fd3c08184c36fe4e279f0a', '2015-11-25 12:51:58', 1),
(27, 6, 49, 'keuangan', 'a4151d4b2856ec63368a7c784b1f0a6e', '2015-11-25 16:30:19', 1),
(28, 6, 50, 'prisma', '27d4f7b1a280d04644643fce4284493b', '2016-05-04 18:03:30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_position`
--

CREATE TABLE `users_position` (
  `users_position_id` int(3) NOT NULL,
  `users_position_name` varchar(50) DEFAULT NULL,
  `users_position_status` int(2) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_position`
--

INSERT INTO `users_position` (`users_position_id`, `users_position_name`, `users_position_status`) VALUES
(1, 'Administrator', 1),
(2, 'Manajer', 1),
(3, 'Kepala Seksi', 1),
(4, 'Gudang', 1),
(5, 'Pengadaan', 1),
(6, 'Keuangan', 1),
(7, 'Sekretariat', 1),
(8, 'Akuntansi', 1),
(9, 'Pelaksana', 1);

-- --------------------------------------------------------

--
-- Table structure for table `work_order`
--

CREATE TABLE `work_order` (
  `work_order_id` int(11) NOT NULL,
  `actor_id` int(11) DEFAULT NULL,
  `project_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `work_order_number` varchar(50) DEFAULT NULL,
  `work_order_date` datetime NOT NULL,
  `work_order_date_fn` datetime DEFAULT NULL,
  `work_order_desc` text,
  `work_order_contract` double DEFAULT NULL,
  `work_order_dp` double DEFAULT NULL,
  `work_order_retensi` double DEFAULT NULL,
  `work_order_extra` double DEFAULT NULL,
  `work_order_extra_mode` tinyint(3) UNSIGNED DEFAULT NULL,
  `work_order_status` tinyint(3) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_order`
--

INSERT INTO `work_order` (`work_order_id`, `actor_id`, `project_id`, `users_id`, `work_order_number`, `work_order_date`, `work_order_date_fn`, `work_order_desc`, `work_order_contract`, `work_order_dp`, `work_order_retensi`, `work_order_extra`, `work_order_extra_mode`, `work_order_status`) VALUES
(1, 1, 1, 21, '12465', '2016-05-04 17:50:43', NULL, 'laundry', 50000000, 10, 5, NULL, NULL, 0),
(2, 1, 1, 21, '4545554', '2016-05-04 17:50:29', NULL, 'pemasangan genteng', 90000000, 20, 5, NULL, NULL, 0),
(3, 2, 1, 21, '785212', '2016-05-04 17:52:46', NULL, 'cuci piring', 50000000, 10, 5, NULL, NULL, 3),
(4, 2, 1, 21, '5545455', '2016-05-04 17:55:36', NULL, 'ngepel', 1000000, 15, 5, NULL, NULL, 0),
(5, 1, 1, 21, '122221', '2016-05-04 17:56:13', NULL, 'abc', 12000000, 5, 5, NULL, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`activity_id`);

--
-- Indexes for table `actor`
--
ALTER TABLE `actor`
  ADD PRIMARY KEY (`actor_id`),
  ADD KEY `actor_FKIndex2` (`actor_category_id`);

--
-- Indexes for table `actor_category`
--
ALTER TABLE `actor_category`
  ADD PRIMARY KEY (`actor_category_id`);

--
-- Indexes for table `apps`
--
ALTER TABLE `apps`
  ADD PRIMARY KEY (`apps_id`);

--
-- Indexes for table `apps_gallery`
--
ALTER TABLE `apps_gallery`
  ADD PRIMARY KEY (`apps_gallery_id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `last_activity_idx` (`last_activity`);

--
-- Indexes for table `code`
--
ALTER TABLE `code`
  ADD PRIMARY KEY (`code_id`);

--
-- Indexes for table `code_ct`
--
ALTER TABLE `code_ct`
  ADD PRIMARY KEY (`code_ct_id`);

--
-- Indexes for table `debt`
--
ALTER TABLE `debt`
  ADD PRIMARY KEY (`debt_id`);

--
-- Indexes for table `debt_final`
--
ALTER TABLE `debt_final`
  ADD PRIMARY KEY (`debt_final_id`);

--
-- Indexes for table `doc_attach`
--
ALTER TABLE `doc_attach`
  ADD PRIMARY KEY (`doc_attach_id`),
  ADD KEY `doc_attach_FKIndex1` (`doc_control_id`);

--
-- Indexes for table `doc_control`
--
ALTER TABLE `doc_control`
  ADD PRIMARY KEY (`doc_control_id`),
  ADD KEY `doc_control_FKIndex1` (`doc_control_ct_id`),
  ADD KEY `doc_control_FKIndex2` (`doc_control_letcode_id`);

--
-- Indexes for table `doc_control_ct`
--
ALTER TABLE `doc_control_ct`
  ADD PRIMARY KEY (`doc_control_ct_id`);

--
-- Indexes for table `doc_control_letcode`
--
ALTER TABLE `doc_control_letcode`
  ADD PRIMARY KEY (`doc_control_letcode_id`);

--
-- Indexes for table `doc_control_verify`
--
ALTER TABLE `doc_control_verify`
  ADD PRIMARY KEY (`doc_control_verify_id`),
  ADD KEY `doc_control_verify_FKIndex1` (`doc_control_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`equipment_id`),
  ADD KEY `equipment_FKIndex1` (`equipment_ct_id`);

--
-- Indexes for table `equipment_ct`
--
ALTER TABLE `equipment_ct`
  ADD PRIMARY KEY (`equipment_ct_id`);

--
-- Indexes for table `equipment_stock`
--
ALTER TABLE `equipment_stock`
  ADD PRIMARY KEY (`equipment_stock_id`),
  ADD KEY `equipment_stok_FKIndex1` (`equipment_id`);

--
-- Indexes for table `equipment_stock_final`
--
ALTER TABLE `equipment_stock_final`
  ADD PRIMARY KEY (`equipment_stock_final_id`);

--
-- Indexes for table `equipment_unit`
--
ALTER TABLE `equipment_unit`
  ADD PRIMARY KEY (`equipment_unit_id`);

--
-- Indexes for table `equipt_transaction`
--
ALTER TABLE `equipt_transaction`
  ADD PRIMARY KEY (`equipt_transaction_id`),
  ADD KEY `equipment_form_FKIndex1` (`actor_id`),
  ADD KEY `equipt_transaction_FKIndex2` (`transaction_ct_id`),
  ADD KEY `equipt_transaction_FKIndex3` (`users_id`);

--
-- Indexes for table `equipt_transaction_dt`
--
ALTER TABLE `equipt_transaction_dt`
  ADD PRIMARY KEY (`equipt_transaction_dt_id`),
  ADD KEY `equipment_form_detail_FKIndex1` (`equipment_id`),
  ADD KEY `equipment_form_detail_FKIndex2` (`equipt_transaction_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`),
  ADD KEY `invoice_ct_id` (`invoice_ct_id`);

--
-- Indexes for table `invoice_dt`
--
ALTER TABLE `invoice_dt`
  ADD PRIMARY KEY (`invoice_dt_id`),
  ADD KEY `invoice_dt_FKIndex1` (`invoice_id`);

--
-- Indexes for table `invoice_equipt_dt`
--
ALTER TABLE `invoice_equipt_dt`
  ADD PRIMARY KEY (`invoice_equipt_id`);

--
-- Indexes for table `invoice_tax`
--
ALTER TABLE `invoice_tax`
  ADD PRIMARY KEY (`invoice_tax_id`),
  ADD KEY `invoice_id` (`invoice_id`,`tax_id`),
  ADD KEY `tax_id` (`tax_id`);

--
-- Indexes for table `invoice_wo`
--
ALTER TABLE `invoice_wo`
  ADD PRIMARY KEY (`invoice_wo_id`),
  ADD KEY `payment_FKIndex1` (`invoice_id`);

--
-- Indexes for table `invoice_wo_ct`
--
ALTER TABLE `invoice_wo_ct`
  ADD PRIMARY KEY (`invoice_wo_ct_id`);

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`material_id`),
  ADD KEY `material_FKIndex1` (`material_category_id`),
  ADD KEY `material_FKIndex2` (`material_unit_id`);

--
-- Indexes for table `material_category`
--
ALTER TABLE `material_category`
  ADD PRIMARY KEY (`material_category_id`);

--
-- Indexes for table `material_sub`
--
ALTER TABLE `material_sub`
  ADD PRIMARY KEY (`material_sub_id`),
  ADD KEY `material_sub_FKIndex1` (`material_id`);

--
-- Indexes for table `material_unit`
--
ALTER TABLE `material_unit`
  ADD PRIMARY KEY (`material_unit_id`),
  ADD KEY `material_unit_id` (`material_unit_id`);

--
-- Indexes for table `modul`
--
ALTER TABLE `modul`
  ADD PRIMARY KEY (`modul_id`);

--
-- Indexes for table `mod_menu`
--
ALTER TABLE `mod_menu`
  ADD PRIMARY KEY (`mod_menu_id`),
  ADD KEY `mod_sub_menu_FKIndex1` (`modul_id`);

--
-- Indexes for table `mod_menu_access`
--
ALTER TABLE `mod_menu_access`
  ADD PRIMARY KEY (`mod_menu_access_id`),
  ADD KEY `mod_sub_menu_access_FKIndex2` (`mod_menu_id`),
  ADD KEY `mod_menu_access_FKIndex2` (`users_position_id`);

--
-- Indexes for table `mog`
--
ALTER TABLE `mog`
  ADD PRIMARY KEY (`mog_id`),
  ADD KEY `mog_FKIndex1` (`project_id`),
  ADD KEY `mog_FKIndex2` (`actor_id`),
  ADD KEY `mog_FKIndex4` (`users_id`),
  ADD KEY `mog_FKIndex5` (`transaction_ct_id`);

--
-- Indexes for table `mog_dt`
--
ALTER TABLE `mog_dt`
  ADD PRIMARY KEY (`mog_dt_id`),
  ADD KEY `entry_FKIndex2` (`mog_id`),
  ADD KEY `entry_FKIndex3` (`material_sub_id`);

--
-- Indexes for table `mog_print`
--
ALTER TABLE `mog_print`
  ADD PRIMARY KEY (`mog_print_id`),
  ADD KEY `mog_id` (`mog_id`),
  ADD KEY `users_id` (`users_id`);

--
-- Indexes for table `page_config`
--
ALTER TABLE `page_config`
  ADD PRIMARY KEY (`page_config_id`),
  ADD KEY `page_config_FKIndex1` (`page_config_ct_id`);

--
-- Indexes for table `page_config_ct`
--
ALTER TABLE `page_config_ct`
  ADD PRIMARY KEY (`page_config_ct_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `payment_FKIndex1` (`invoice_id`);

--
-- Indexes for table `payment_ct`
--
ALTER TABLE `payment_ct`
  ADD PRIMARY KEY (`payment_ct_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `project_access`
--
ALTER TABLE `project_access`
  ADD PRIMARY KEY (`project_access_id`),
  ADD KEY `project_access_FKIndex2` (`project_id`),
  ADD KEY `project_access_FKIndex3` (`users_id`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`salary_id`),
  ADD KEY `salary_ct_id` (`salary_ct_id`),
  ADD KEY `actor_id` (`actor_id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `salary_tax`
--
ALTER TABLE `salary_tax`
  ADD PRIMARY KEY (`salary_tax_id`),
  ADD KEY `salary_id` (`salary_id`,`tax_id`),
  ADD KEY `tax_id` (`tax_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stock_id`),
  ADD KEY `stock_FKIndex1` (`material_sub_id`),
  ADD KEY `stock_FKIndex2` (`project_id`),
  ADD KEY `stock_FKIndex3` (`mog_id`);

--
-- Indexes for table `stock_final`
--
ALTER TABLE `stock_final`
  ADD PRIMARY KEY (`stock_final_id`),
  ADD KEY `stock_final_FKIndex1` (`material_sub_id`),
  ADD KEY `stock_final_FKIndex2` (`project_id`);

--
-- Indexes for table `tax`
--
ALTER TABLE `tax`
  ADD PRIMARY KEY (`tax_id`),
  ADD KEY `tax_FKIndex1` (`tax_ct_id`),
  ADD KEY `tax_ct_id` (`tax_ct_id`),
  ADD KEY `tax_mode_id` (`tax_mode_id`);

--
-- Indexes for table `tax_ct`
--
ALTER TABLE `tax_ct`
  ADD PRIMARY KEY (`tax_ct_id`);

--
-- Indexes for table `tax_mode`
--
ALTER TABLE `tax_mode`
  ADD PRIMARY KEY (`tax_mode_id`);

--
-- Indexes for table `transaction_ct`
--
ALTER TABLE `transaction_ct`
  ADD PRIMARY KEY (`transaction_ct_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`),
  ADD KEY `users_FKIndex1` (`employee_id`),
  ADD KEY `users_FKIndex2` (`users_position_id`);

--
-- Indexes for table `users_position`
--
ALTER TABLE `users_position`
  ADD PRIMARY KEY (`users_position_id`);

--
-- Indexes for table `work_order`
--
ALTER TABLE `work_order`
  ADD PRIMARY KEY (`work_order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `activity_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=350;
--
-- AUTO_INCREMENT for table `actor`
--
ALTER TABLE `actor`
  MODIFY `actor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `actor_category`
--
ALTER TABLE `actor_category`
  MODIFY `actor_category_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `apps`
--
ALTER TABLE `apps`
  MODIFY `apps_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `apps_gallery`
--
ALTER TABLE `apps_gallery`
  MODIFY `apps_gallery_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `code`
--
ALTER TABLE `code`
  MODIFY `code_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `code_ct`
--
ALTER TABLE `code_ct`
  MODIFY `code_ct_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `debt`
--
ALTER TABLE `debt`
  MODIFY `debt_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `debt_final`
--
ALTER TABLE `debt_final`
  MODIFY `debt_final_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `doc_attach`
--
ALTER TABLE `doc_attach`
  MODIFY `doc_attach_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `doc_control`
--
ALTER TABLE `doc_control`
  MODIFY `doc_control_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `doc_control_ct`
--
ALTER TABLE `doc_control_ct`
  MODIFY `doc_control_ct_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `doc_control_letcode`
--
ALTER TABLE `doc_control_letcode`
  MODIFY `doc_control_letcode_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `doc_control_verify`
--
ALTER TABLE `doc_control_verify`
  MODIFY `doc_control_verify_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `equipment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `equipment_ct`
--
ALTER TABLE `equipment_ct`
  MODIFY `equipment_ct_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `equipment_stock`
--
ALTER TABLE `equipment_stock`
  MODIFY `equipment_stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
--
-- AUTO_INCREMENT for table `equipment_stock_final`
--
ALTER TABLE `equipment_stock_final`
  MODIFY `equipment_stock_final_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `equipment_unit`
--
ALTER TABLE `equipment_unit`
  MODIFY `equipment_unit_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `equipt_transaction`
--
ALTER TABLE `equipt_transaction`
  MODIFY `equipt_transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `equipt_transaction_dt`
--
ALTER TABLE `equipt_transaction_dt`
  MODIFY `equipt_transaction_dt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `invoice_dt`
--
ALTER TABLE `invoice_dt`
  MODIFY `invoice_dt_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `invoice_equipt_dt`
--
ALTER TABLE `invoice_equipt_dt`
  MODIFY `invoice_equipt_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `invoice_tax`
--
ALTER TABLE `invoice_tax`
  MODIFY `invoice_tax_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `invoice_wo`
--
ALTER TABLE `invoice_wo`
  MODIFY `invoice_wo_id` int(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `invoice_wo_ct`
--
ALTER TABLE `invoice_wo_ct`
  MODIFY `invoice_wo_ct_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `material_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `material_category`
--
ALTER TABLE `material_category`
  MODIFY `material_category_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `material_sub`
--
ALTER TABLE `material_sub`
  MODIFY `material_sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=239;
--
-- AUTO_INCREMENT for table `material_unit`
--
ALTER TABLE `material_unit`
  MODIFY `material_unit_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `modul`
--
ALTER TABLE `modul`
  MODIFY `modul_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `mod_menu`
--
ALTER TABLE `mod_menu`
  MODIFY `mod_menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT for table `mod_menu_access`
--
ALTER TABLE `mod_menu_access`
  MODIFY `mod_menu_access_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3323;
--
-- AUTO_INCREMENT for table `mog`
--
ALTER TABLE `mog`
  MODIFY `mog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `mog_dt`
--
ALTER TABLE `mog_dt`
  MODIFY `mog_dt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `mog_print`
--
ALTER TABLE `mog_print`
  MODIFY `mog_print_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `page_config`
--
ALTER TABLE `page_config`
  MODIFY `page_config_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `page_config_ct`
--
ALTER TABLE `page_config_ct`
  MODIFY `page_config_ct_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(22) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payment_ct`
--
ALTER TABLE `payment_ct`
  MODIFY `payment_ct_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `project_access`
--
ALTER TABLE `project_access`
  MODIFY `project_access_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
  MODIFY `salary_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `salary_tax`
--
ALTER TABLE `salary_tax`
  MODIFY `salary_tax_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=226;
--
-- AUTO_INCREMENT for table `stock_final`
--
ALTER TABLE `stock_final`
  MODIFY `stock_final_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=210;
--
-- AUTO_INCREMENT for table `tax`
--
ALTER TABLE `tax`
  MODIFY `tax_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `tax_ct`
--
ALTER TABLE `tax_ct`
  MODIFY `tax_ct_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tax_mode`
--
ALTER TABLE `tax_mode`
  MODIFY `tax_mode_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `transaction_ct`
--
ALTER TABLE `transaction_ct`
  MODIFY `transaction_ct_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `users_position`
--
ALTER TABLE `users_position`
  MODIFY `users_position_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `work_order`
--
ALTER TABLE `work_order`
  MODIFY `work_order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
