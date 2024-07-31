-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2024 at 05:52 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carstaging_db`
--
CREATE DATABASE IF NOT EXISTS `carstaging_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `carstaging_db`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking`
--

CREATE TABLE `tbl_booking` (
  `id` varchar(25) NOT NULL,
  `username` varchar(33) NOT NULL,
  `car_license_number` varchar(255) NOT NULL,
  `car_type_id` varchar(255) NOT NULL,
  `open_id` int(10) NOT NULL,
  `boot` varchar(255) NOT NULL,
  `building_id` varchar(5) NOT NULL,
  `hall_id` varchar(10) NOT NULL,
  `driver_name` varchar(255) DEFAULT NULL,
  `driver_phone` varchar(255) DEFAULT NULL,
  `booking_date` date NOT NULL,
  `booking_time` time NOT NULL,
  `booking_time_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '\'{}\'' COMMENT 'Example {"08:00","08:10","08:20","08:30"}',
  `queue_number` varchar(10) DEFAULT NULL COMMENT 'hhmm_00000',
  `running_number` varchar(5) NOT NULL,
  `booking_data` varchar(255) DEFAULT NULL,
  `qr_code_image` longblob NOT NULL,
  `ref_id` varchar(40) NOT NULL,
  `ref_json` longtext NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '-2:Cancel\r\n-1:Skip\r\n0 :Booked\r\n1 :Waiting\r\n2 :Calling\r\n3 :Accept\r\n4 :Loading\r\n5 :Loaded/Completed ',
  `parking_rate` int(11) NOT NULL DEFAULT 0,
  `take_time_minutes` int(11) NOT NULL DEFAULT 0,
  `time_in_area` datetime DEFAULT NULL COMMENT 'เวลาที่เข้ามาในพื้นที่(เข้ามาใน Impact)',
  `time_out_area` datetime DEFAULT NULL COMMENT 'เวลาที่ออกนอกพื้นที่(ออกจาก Impact)',
  `time_in` datetime DEFAULT NULL COMMENT 'เวลาที่เข้าใน Loading(time_in_loading)',
  `time_out` datetime DEFAULT NULL COMMENT 'เวลาที่ออกจาก Loading(time_out_loading)',
  `time_1st_alert` datetime DEFAULT NULL COMMENT 'เวลาการแจ้ง alert ครั้งที่ 1 ก่อนเวลา booking 30 นาที',
  `time_2nd_alert` datetime DEFAULT NULL COMMENT 'เวลาการแจ้ง alert ครั้งที่ 2 ก่อนเวลา booking 15 นาที',
  `time_3nd_alert` datetime DEFAULT NULL COMMENT 'เวลาการแจ้ง alert ให้เข้า Loading',
  `time_accept` datetime DEFAULT NULL COMMENT 'เวลาที่ตอบกลับจากการ alert เรียกให้เข้า Loading(ครั้งที่ 3)',
  `parking_time` time DEFAULT NULL,
  `parking_overtime` time DEFAULT NULL,
  `parking_overtime_hours` int(11) NOT NULL DEFAULT 0,
  `parking_fee` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Booking';

--
-- Dumping data for table `tbl_booking`
--

INSERT INTO `tbl_booking` (`id`, `username`, `car_license_number`, `car_type_id`, `open_id`, `boot`, `building_id`, `hall_id`, `driver_name`, `driver_phone`, `booking_date`, `booking_time`, `booking_time_json`, `queue_number`, `running_number`, `booking_data`, `qr_code_image`, `ref_id`, `ref_json`, `status`, `parking_rate`, `take_time_minutes`, `time_in_area`, `time_out_area`, `time_in`, `time_out`, `time_1st_alert`, `time_2nd_alert`, `time_3nd_alert`, `time_accept`, `parking_time`, `parking_overtime`, `parking_overtime_hours`, `parking_fee`, `is_active`, `is_deleted`) VALUES
('ID659f81334e5926.22478781', 'cust1', '1 กก 1234', '1', 40, '001', 'CH', 'hall03', 'คนที่ 1', '1234567890', '2024-01-12', '08:00:00', '{\"08:00\":1,\"08:10\":1,\"08:20\":1,\"08:30\":1}', '0800_0001', '0001', '', '', '40CHhall032024-01-1208:000001', '{\"id\":\"ID659f81334e5926.22478781\",\"ทะเบียนรถ\":\"1 กก 1234\",\"ชื่องาน\":\"ABC\",\"รหัสอาคาร\":\"CH\",\"ชื่ออาคาร\":\"Challenger\",\"พื้นที่\":\"Hall 3\",\"เลขคิว\":\"0800_0001\",\"ประเภทรถ\":\"รถ 4 ล้อ\",\"วันที่จอง\":\"2024-01-12\",\"เวลาจอง\":\"08:00\",\"เวลาที่ใช้\":40,\"ค่าปรับ\":\"400\"}', 0, 400, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 0),
('ID659f84727f9846.17326930', 'cust2', '10-111110', '3', 42, '001', 'IF', 'hall04', 'เจิด', '1234567890', '2024-01-12', '10:00:00', '{\"10:00\":1,\"10:10\":1,\"10:20\":1,\"10:30\":1,\"10:40\":1,\"10:50\":1,\"11:00\":1,\"11:10\":1,\"11:20\":1,\"11:30\":1}', '1000_0001', '0001', '', '', '42IFhall042024-01-1210:000001', '{\"id\":\"ID659f84727f9846.17326930\",\"ทะเบียนรถ\":\"10-111110\",\"ชื่องาน\":\"Test\",\"รหัสอาคาร\":\"IF\",\"ชื่ออาคาร\":\"Impact Forum\",\"พื้นที่\":\"Hall 4\",\"เลขคิว\":\"1000_0001\",\"ประเภทรถ\":\"รถ 10 ล้อ\",\"วันที่จอง\":\"2024-01-12\",\"เวลาจอง\":\"10:00\",\"เวลาที่ใช้\":100,\"ค่าปรับ\":\"1000\"}', 0, 1000, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 0),
('ID659f8486c88690.98134226', 'cust2', '10-111110', '3', 40, '001', 'CH', 'hall03', 'เจิด', '1234567890', '2024-01-12', '08:00:00', '{\"08:00\":1,\"08:10\":1,\"08:20\":1,\"08:30\":1,\"08:40\":1,\"08:50\":1,\"09:00\":1,\"09:10\":1,\"09:20\":1,\"09:30\":1}', '0800_0002', '0002', '', '', '40CHhall032024-01-1208:000002', '{\"id\":\"ID659f8486c88690.98134226\",\"ทะเบียนรถ\":\"10-111110\",\"ชื่องาน\":\"ABC\",\"รหัสอาคาร\":\"CH\",\"ชื่ออาคาร\":\"Challenger\",\"พื้นที่\":\"Hall 3\",\"เลขคิว\":\"0800_0002\",\"ประเภทรถ\":\"รถ 10 ล้อ\",\"วันที่จอง\":\"2024-01-12\",\"เวลาจอง\":\"08:00\",\"เวลาที่ใช้\":100,\"ค่าปรับ\":\"1000\"}', 0, 1000, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 0),
('ID65a4ad50a9b613.73231504', 'cust1', '1 กก 1234', '1', 40, '001', 'CH', 'hall03', 'คนที่ 1', '1234567890', '2024-01-15', '08:00:00', '{\"08:00\":1,\"08:10\":1,\"08:20\":1,\"08:30\":1}', '0800_0001', '0001', '', '', '40CHhall032024-01-1608:000001', '{\"id\":\"ID65a4ad50a9b613.73231504\",\"ทะเบียนรถ\":\"1 กก 1234\",\"ชื่องาน\":\"ABC\",\"รหัสอาคาร\":\"CH\",\"ชื่ออาคาร\":\"Challenger\",\"พื้นที่\":\"Hall 3\",\"เลขคิว\":\"0800_0001\",\"ประเภทรถ\":\"รถ 4 ล้อ\",\"วันที่จอง\":\"2024-01-16\",\"เวลาจอง\":\"08:00\",\"เวลาที่ใช้\":40,\"ค่าปรับ\":\"400\"}', 5, 400, 40, '2024-01-15 11:05:44', '2024-01-15 11:25:52', '2024-01-15 11:25:23', '2024-01-15 11:25:52', NULL, NULL, NULL, NULL, '00:00:29', '00:00:00', 0, 0, 1, 0),
('ID65ae3e5ba80e00.20876566', 'cust1', '1 กก 1234', '1', 40, '001', 'CH', 'hall03', 'คนที่ 1', '1234567890', '2024-01-23', '08:00:00', '{\"08:00\":1,\"08:10\":1,\"08:20\":1,\"08:30\":1}', '0800_0001', '0001', '', '', '40CHhall032024-01-2308:000001', '{\"id\":\"ID65ae3e5ba80e00.20876566\",\"ทะเบียนรถ\":\"1 กก 1234\",\"ชื่องาน\":\"ABC\",\"รหัสอาคาร\":\"CH\",\"ชื่ออาคาร\":\"Challenger\",\"พื้นที่\":\"Hall 3\",\"เลขคิว\":\"0800_0001\",\"ประเภทรถ\":\"รถ 4 ล้อ\",\"วันที่จอง\":\"2024-01-23\",\"เวลาจอง\":\"08:00\",\"เวลาที่ใช้\":40,\"ค่าปรับ\":\"400\"}', 0, 400, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 0),
('ID65ae3e6e186173.40416651', 'cust1', '1 กก 1234', '1', 40, '001', 'CH', 'hall03', 'คนที่ 1', '1234567890', '2024-01-24', '08:00:00', '{\"08:00\":1,\"08:10\":1,\"08:20\":1,\"08:30\":1}', '0800_0001', '0001', '', '', '40CHhall032024-01-2408:000001', '{\"id\":\"ID65ae3e6e186173.40416651\",\"ทะเบียนรถ\":\"1 กก 1234\",\"ชื่องาน\":\"ABC\",\"รหัสอาคาร\":\"CH\",\"ชื่ออาคาร\":\"Challenger\",\"พื้นที่\":\"Hall 3\",\"เลขคิว\":\"0800_0001\",\"ประเภทรถ\":\"รถ 4 ล้อ\",\"วันที่จอง\":\"2024-01-24\",\"เวลาจอง\":\"08:00\",\"เวลาที่ใช้\":40,\"ค่าปรับ\":\"400\"}', 0, 400, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 0),
('ID65ae43e10375f0.70180774', 'cust1', '1 กก 1234', '1', 40, '001', 'CH', 'hall03', 'คนที่ 1', '1234567890', '2024-01-23', '08:00:00', '{\"08:00\":1,\"08:10\":1,\"08:20\":1,\"08:30\":1}', '0800_0002', '0002', '', '', '40CHhall032024-01-2308:000002', '{\"id\":\"ID65ae43e10375f0.70180774\",\"ทะเบียนรถ\":\"1 กก 1234\",\"ชื่องาน\":\"ABC\",\"รหัสอาคาร\":\"CH\",\"ชื่ออาคาร\":\"Challenger\",\"พื้นที่\":\"Hall 3\",\"เลขคิว\":\"0800_0002\",\"ประเภทรถ\":\"รถ 4 ล้อ\",\"วันที่จอง\":\"2024-01-23\",\"เวลาจอง\":\"08:00\",\"เวลาที่ใช้\":40,\"ค่าปรับ\":\"400\"}', 0, 400, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 0),
('ID65ae4795cffaa0.49498460', 'cust1', '1 กก 123', '1', 40, '001', 'CH', 'hall03', 'คนที่ 1', '1234567890', '2024-01-23', '08:00:00', '{\"08:00\":1,\"08:10\":1,\"08:20\":1,\"08:30\":1}', '0800_0003', '0003', '', '', '40CHhall032024-01-2308:000003', '{\"id\":\"ID65ae4795cffaa0.49498460\",\"ทะเบียนรถ\":\"1 กก 123\",\"ชื่องาน\":\"ABC\",\"รหัสอาคาร\":\"CH\",\"ชื่ออาคาร\":\"Challenger\",\"พื้นที่\":\"Hall 3\",\"เลขคิว\":\"0800_0003\",\"ประเภทรถ\":\"รถ 4 ล้อ\",\"วันที่จอง\":\"2024-01-23\",\"เวลาจอง\":\"08:00\",\"เวลาที่ใช้\":40,\"ค่าปรับ\":\"400\"}', 0, 400, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 0),
('ID65ae47a7a76072.02037117', 'cust1', '1 กก 123', '1', 40, '001', 'CH', 'hall03', 'คนที่ 1', '1234567890', '2024-01-24', '08:00:00', '{\"08:00\":1,\"08:10\":1,\"08:20\":1,\"08:30\":1}', '0800_0002', '0002', '', '', '40CHhall032024-01-2408:000002', '{\"id\":\"ID65ae47a7a76072.02037117\",\"ทะเบียนรถ\":\"1 กก 123\",\"ชื่องาน\":\"ABC\",\"รหัสอาคาร\":\"CH\",\"ชื่ออาคาร\":\"Challenger\",\"พื้นที่\":\"Hall 3\",\"เลขคิว\":\"0800_0002\",\"ประเภทรถ\":\"รถ 4 ล้อ\",\"วันที่จอง\":\"2024-01-24\",\"เวลาจอง\":\"08:00\",\"เวลาที่ใช้\":40,\"ค่าปรับ\":\"400\"}', 0, 400, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 0),
('ID65af18f053dfb0.41615594', 'cust1', '10-111112', '2', 40, '001', 'CH', 'hall03', 'Vin', '1234567890', '2024-01-24', '08:00:00', '{\"08:00\":1,\"08:10\":1,\"08:20\":1,\"08:30\":1,\"08:40\":1,\"08:50\":1}', '0800_0003', '0003', '', '', '40CHhall032024-01-2408:000003', '{\"id\":\"ID65af18f053dfb0.41615594\",\"ทะเบียนรถ\":\"10-111112\",\"ชื่องาน\":\"ABC\",\"รหัสอาคาร\":\"CH\",\"ชื่ออาคาร\":\"Challenger\",\"พื้นที่\":\"Hall 3\",\"เลขคิว\":\"0800_0003\",\"ประเภทรถ\":\"รถ 6 ล้อ\",\"วันที่จอง\":\"2024-01-24\",\"เวลาจอง\":\"08:00\",\"เวลาที่ใช้\":60,\"ค่าปรับ\":\"600\"}', 0, 600, 60, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 0),
('ID65af190b6b04d0.18609583', 'cust1', '10-111112', '2', 41, '001', 'IEC', 'hall09', 'Vin', '1234567890', '2024-01-24', '08:00:00', '{\"08:00\":1,\"08:10\":1,\"08:20\":1,\"08:30\":1,\"08:40\":1,\"08:50\":1}', '0800_0001', '0001', '', '', '41IEChall092024-01-2408:000001', '{\"id\":\"ID65af190b6b04d0.18609583\",\"ทะเบียนรถ\":\"10-111112\",\"ชื่องาน\":\"XYZ\",\"รหัสอาคาร\":\"IEC\",\"ชื่ออาคาร\":\"Exhibition Center\",\"พื้นที่\":\"Hall 9\",\"เลขคิว\":\"0800_0001\",\"ประเภทรถ\":\"รถ 6 ล้อ\",\"วันที่จอง\":\"2024-01-24\",\"เวลาจอง\":\"08:00\",\"เวลาที่ใช้\":60,\"ค่าปรับ\":\"600\"}', 0, 600, 60, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_building`
--

CREATE TABLE `tbl_building` (
  `building_id` varchar(5) NOT NULL,
  `building_name` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='อาคาร';

--
-- Dumping data for table `tbl_building`
--

INSERT INTO `tbl_building` (`building_id`, `building_name`, `is_active`, `is_deleted`) VALUES
('CH', 'Challenger', 1, 0),
('IEC', 'Exhibition Center', 1, 0),
('IF', 'Impact Forum', 1, 0),
('TD', 'Thunder Dom', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_car_registration`
--

CREATE TABLE `tbl_car_registration` (
  `username` varchar(255) NOT NULL,
  `car_registration` varchar(10) NOT NULL,
  `car_type_id` varchar(255) NOT NULL,
  `event_id` varchar(10) NOT NULL,
  `boot` varchar(255) NOT NULL,
  `building_id` varchar(5) NOT NULL,
  `hall_id` varchar(10) NOT NULL,
  `driver_name` varchar(255) DEFAULT NULL,
  `driver_phone` varchar(255) DEFAULT NULL,
  `booking_date` date NOT NULL,
  `booking_time` time NOT NULL,
  `queue_number` varchar(255) NOT NULL,
  `qr_code_image` longblob NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='ข้อมูลรถของผู้ขายในการเข้าพื้นที่';

-- --------------------------------------------------------

--
-- Table structure for table `tbl_car_type`
--

CREATE TABLE `tbl_car_type` (
  `car_type_id` int(11) NOT NULL,
  `car_type_name` varchar(255) NOT NULL,
  `take_time_minutes` int(11) NOT NULL,
  `parking_fee` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='ประเภทรถ';

--
-- Dumping data for table `tbl_car_type`
--

INSERT INTO `tbl_car_type` (`car_type_id`, `car_type_name`, `take_time_minutes`, `parking_fee`, `is_active`, `is_deleted`) VALUES
(1, 'รถ 4 ล้อ', 40, 400, 1, 0),
(2, 'รถ 6 ล้อ', 60, 600, 1, 0),
(3, 'รถ 10 ล้อ', 100, 1000, 1, 0),
(4, 'รถ 10 ล้อขึ้นไป', 150, 1500, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `username` varchar(33) NOT NULL,
  `password` varchar(25) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `line_id` varchar(255) DEFAULT NULL,
  `line_user_id` varchar(33) DEFAULT NULL,
  `role_id` varchar(10) NOT NULL DEFAULT 'member',
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `register_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `approved_by` varchar(25) DEFAULT NULL,
  `approved_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `create_by` varchar(25) DEFAULT NULL,
  `create_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `update_by` varchar(25) DEFAULT NULL,
  `update_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='ลูกค้า';

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`username`, `password`, `firstname`, `lastname`, `line_id`, `line_user_id`, `role_id`, `address`, `phone`, `email`, `register_datetime`, `approved_by`, `approved_datetime`, `create_by`, `create_datetime`, `update_by`, `update_datetime`, `is_active`, `is_deleted`) VALUES
('cust1', '1111', 'นาย ก.ไก่', 'กอเอ๋ยกอไก่', '', 'U749f9114c302b60d04acdfcf8e430d1f', 'member', '9/47 บ้านกลางเมือง', '0628793650', 'poj11@hotmail.com', '2023-08-21 15:29:40', 'admin', '2023-08-21 17:23:54', NULL, '2023-08-21 15:29:40', NULL, '2023-08-21 15:29:40', 1, 0),
('cust2', '1111', 'นาย ข.ไข่', 'ในเล้า', '', 'U749f9114c302b60d04acdfcf8e430d1f', 'member', '9/2', '0123456789', 'cust2@xxx.com', '2023-08-21 15:29:40', 'admin', '2023-08-23 14:52:05', NULL, '2023-08-21 15:29:40', NULL, '2023-08-21 15:29:40', 1, 0),
('cust3', '1111', 'นาย ฃ.ฃวด', 'ของเรา', '', 'U749f9114c302b60d04acdfcf8e430d1f', 'member', '9/3', '0123456789', 'cust3@xxx.com', '2023-08-21 15:29:40', 'admin', '2023-08-23 14:52:16', NULL, '2023-08-21 15:29:40', NULL, '2023-08-21 15:29:40', 1, 0),
('cust4', '1111', 'นาย ค.ควาย', 'เข้านา', '', 'U749f9114c302b60d04acdfcf8e430d1f', 'member', '9/4', '0123456789', 'cust4@xxx.com', '2023-08-21 15:29:40', NULL, '2023-08-21 15:29:40', NULL, '2023-08-21 15:29:40', NULL, '2023-08-21 15:29:40', 1, 0),
('cust5', '1111', 'นาย ฅ.ฅน', 'ขึงขัง', '', 'U749f9114c302b60d04acdfcf8e430d1f', 'member', '9/5', '0123456789', 'cust5@xxx.com', '2023-08-21 15:29:40', NULL, '2023-08-21 15:29:40', NULL, '2023-08-21 15:29:40', NULL, '2023-08-21 15:29:40', 1, 0),
('cust6', '1111', 'นาย ฆ.ระฆัง', 'ข้างฝา', '', 'U749f9114c302b60d04acdfcf8e430d1f', 'member', '9/6', '0123456789', 'cust6@xxx.com', '2023-08-21 15:29:40', NULL, '2023-08-21 15:29:40', NULL, '2023-08-21 15:29:40', NULL, '2023-08-21 15:29:40', 1, 0),
('U7a2c24d345d2667c442c95c3a34ba241', '', 'poj11', 'poj11', '', 'U7a2c24d345d2667c442c95c3a34ba241', 'member', '', '', 'poj11@hotmail.com', '2023-09-15 12:17:36', NULL, '2023-09-15 12:17:36', NULL, '2023-09-15 12:17:36', NULL, '2023-09-15 12:17:36', 1, 0),
('Uead3fc1bacb477985924b342c33f19d1', '', 'itapplication', 'itapplication', '', 'Uead3fc1bacb477985924b342c33f19d1', 'member', '', '', '', '2023-10-26 10:04:39', NULL, '2023-10-26 10:04:39', NULL, '2023-10-26 10:04:39', NULL, '2023-10-26 10:04:39', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_department`
--

CREATE TABLE `tbl_department` (
  `department_id` varchar(10) NOT NULL COMMENT 'IT, OP, ...',
  `department_name` varchar(255) NOT NULL COMMENT 'IT, OP, ...',
  `create_by` varchar(25) NOT NULL,
  `create_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `update_by` varchar(25) NOT NULL,
  `update_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_department`
--

INSERT INTO `tbl_department` (`department_id`, `department_name`, `create_by`, `create_datetime`, `update_by`, `update_datetime`, `is_active`, `is_deleted`) VALUES
('ITD', 'Infomation Technology', '', '2023-08-07 11:28:35', '', '2023-08-07 17:40:12', 1, 0),
('OPD', 'Operation Management', '', '2023-08-07 11:29:32', '', '2023-08-07 11:30:56', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_event`
--

CREATE TABLE `tbl_event` (
  `event_id` varchar(10) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `date_start_booking` date NOT NULL DEFAULT current_timestamp(),
  `date_end_booking` date NOT NULL DEFAULT current_timestamp(),
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Events';

--
-- Dumping data for table `tbl_event`
--

INSERT INTO `tbl_event` (`event_id`, `event_name`, `date_start_booking`, `date_end_booking`, `is_active`, `is_deleted`) VALUES
('20026', 'Thai Education for ASEAN Community', '2023-10-16', '2023-10-26', 1, 0),
('20027', 'Dog', '2023-10-18', '2023-10-31', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hall`
--

CREATE TABLE `tbl_hall` (
  `hall_id` varchar(10) NOT NULL,
  `hall_name` varchar(255) NOT NULL,
  `building_id` varchar(5) NOT NULL,
  `reservable_slots` int(11) NOT NULL,
  `total_slots` int(11) NOT NULL,
  `start_time` time NOT NULL DEFAULT '08:00:00',
  `end_time` time NOT NULL DEFAULT '22:00:00',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='พื้นที่โหลด';

--
-- Dumping data for table `tbl_hall`
--

INSERT INTO `tbl_hall` (`hall_id`, `hall_name`, `building_id`, `reservable_slots`, `total_slots`, `start_time`, `end_time`, `is_active`, `is_deleted`) VALUES
('hall01', 'Hall 1', 'CH', 30, 48, '08:00:00', '18:00:00', 1, 0),
('hall02', 'Hall 2', 'CH', 83, 83, '09:00:00', '17:00:00', 1, 0),
('hall03', 'Hall 3', 'CH', 43, 43, '08:00:00', '18:00:00', 1, 0),
('hall04', 'Hall 4', 'IF', 10, 10, '08:00:00', '18:00:00', 1, 0),
('hall05', 'Hall 5', 'IEC', 51, 51, '08:00:00', '18:00:00', 1, 0),
('hall06', 'Hall 6', 'IEC', 65, 65, '08:00:00', '18:00:00', 1, 0),
('hall07', 'Hall 7', 'IEC', 56, 56, '08:00:00', '18:00:00', 1, 0),
('hall08', 'Hall 8', 'IEC', 30, 30, '08:00:00', '18:00:00', 1, 0),
('hall09', 'Hall 9', 'IEC', 36, 36, '08:00:00', '18:00:00', 1, 0),
('hall10', 'Hall 10', 'IEC', 36, 36, '08:00:00', '18:00:00', 1, 0),
('hall11', 'Hall 11', 'IEC', 19, 19, '08:00:00', '18:00:00', 1, 0),
('hall12', 'Hall 12', 'IEC', 19, 19, '08:00:00', '18:00:00', 1, 0),
('hall14', 'Hall 14', 'IEC', 10, 10, '08:00:00', '18:00:00', 0, 0),
('thunderdom', 'Thunder', 'TD', 5, 6, '09:00:00', '17:00:00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_log`
--

CREATE TABLE `tbl_log` (
  `line_user_id` text NOT NULL,
  `text` text NOT NULL,
  `timestamp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_member`
--

CREATE TABLE `tbl_member` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `line_id` varchar(255) DEFAULT NULL,
  `register_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='ผู้ขาย';

--
-- Dumping data for table `tbl_member`
--

INSERT INTO `tbl_member` (`username`, `password`, `role`, `email`, `fname`, `lname`, `address`, `phone`, `line_id`, `register_datetime`, `is_approved`, `is_active`, `is_deleted`) VALUES
('admin', 'admin', 'admin', 'poj11@hotmail.com', 'Administrator', '-', 'Admin Impact', '0123456789', 'admin007', '2023-02-21 14:51:14', 1, 1, 0),
('nathapat', '1111', 'guest', 'kittipoj1178@gmail.com', 'Nathapat', 'Soontornpurmsap', '8 ฮอกวอตต์ ลาดพร้าว กรุงเทพฯ', '0626262626', 'ssssssss', '2023-02-21 14:55:21', 1, 1, 0),
('poj11', '1111', 'admin', 'poj11@hotmail.com', 'Nathapat', 'Soontornpurmsap', '9/47 บ้านกลางเมือง กรุงเทพฯ', '0123456789', 'poj11', '2023-02-21 14:51:14', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_open_area_schedule_detail`
--

CREATE TABLE `tbl_open_area_schedule_detail` (
  `open_id` int(10) NOT NULL,
  `id` varchar(25) NOT NULL,
  `building_id` varchar(5) NOT NULL,
  `hall_id` varchar(10) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `open_date_start` date NOT NULL DEFAULT current_timestamp(),
  `open_date_end` date NOT NULL DEFAULT current_timestamp(),
  `open_time_start` time NOT NULL,
  `open_time_end` time NOT NULL,
  `reservable_slots` int(11) NOT NULL DEFAULT 1,
  `car_type_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '[1,2,3]',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='กำหนดการเปิดพื้นที่';

--
-- Dumping data for table `tbl_open_area_schedule_detail`
--

INSERT INTO `tbl_open_area_schedule_detail` (`open_id`, `id`, `building_id`, `hall_id`, `event_name`, `open_date_start`, `open_date_end`, `open_time_start`, `open_time_end`, `reservable_slots`, `car_type_json`, `is_active`, `is_deleted`) VALUES
(40, 'OA659f80e66ae754.77627952', 'CH', 'hall03', 'ABC', '2024-01-11', '2024-02-04', '08:00:00', '18:00:00', 3, '[1,2,3]', 1, 0),
(41, 'OA659f811946a556.03984573', 'IEC', 'hall09', 'XYZ', '2024-01-15', '2024-02-03', '08:00:00', '18:00:00', 3, '[1,2,3]', 1, 0),
(42, 'OA659f83f89fdcd6.51463346', 'IF', 'hall04', 'Test', '2024-01-11', '2024-01-14', '08:00:00', '18:00:00', 2, '[1,2,3]', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_open_area_schedule_header`
--

CREATE TABLE `tbl_open_area_schedule_header` (
  `open_id` int(10) NOT NULL,
  `id` varchar(25) NOT NULL,
  `building_id` varchar(5) NOT NULL,
  `hall_id` varchar(10) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `open_date_start` date DEFAULT current_timestamp(),
  `open_date_end` date DEFAULT current_timestamp(),
  `open_time_start` time NOT NULL,
  `open_time_end` time NOT NULL,
  `total_slots` int(11) NOT NULL,
  `reservable_slots` int(11) NOT NULL DEFAULT 1,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='กำหนดการเปิดพื้นที่';

--
-- Dumping data for table `tbl_open_area_schedule_header`
--

INSERT INTO `tbl_open_area_schedule_header` (`open_id`, `id`, `building_id`, `hall_id`, `event_name`, `open_date_start`, `open_date_end`, `open_time_start`, `open_time_end`, `total_slots`, `reservable_slots`, `is_active`, `is_deleted`) VALUES
(40, 'OA659f80e66ae754.77627952', 'CH', 'hall03', 'ABC', '2024-01-11', '2024-02-04', '08:00:00', '18:00:00', 43, 1, 1, 0),
(41, 'OA659f811946a556.03984573', 'IEC', 'hall09', 'XYZ', '2024-01-11', '2024-02-03', '08:00:00', '18:00:00', 36, 1, 1, 0),
(42, 'OA659f83f89fdcd6.51463346', 'IF', 'hall04', 'Test', '2024-01-11', '2024-01-14', '08:00:00', '18:00:00', 10, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_open_area_schedule_sub_detail`
--

CREATE TABLE `tbl_open_area_schedule_sub_detail` (
  `open_id` int(10) NOT NULL,
  `id` varchar(25) NOT NULL,
  `building_id` varchar(5) NOT NULL,
  `hall_id` varchar(10) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `open_date_start` date NOT NULL DEFAULT current_timestamp(),
  `open_date_end` date NOT NULL DEFAULT current_timestamp(),
  `open_time_start` time NOT NULL,
  `open_time_end` time NOT NULL,
  `open_date` date NOT NULL DEFAULT current_timestamp(),
  `open_time` time NOT NULL,
  `number_slots_already_booked` int(11) NOT NULL DEFAULT 0,
  `reservable_slots` int(11) NOT NULL DEFAULT 1,
  `car_type_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '[1,2,3]',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='กำหนดการเปิดพื้นที่';

-- --------------------------------------------------------

--
-- Table structure for table `tbl_open_area_schedule_sub_details`
--

CREATE TABLE `tbl_open_area_schedule_sub_details` (
  `open_id` int(10) NOT NULL,
  `id` varchar(25) NOT NULL,
  `building_id` varchar(5) NOT NULL,
  `hall_id` varchar(10) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `open_date_start` date NOT NULL DEFAULT current_timestamp(),
  `open_date_end` date NOT NULL DEFAULT current_timestamp(),
  `open_time_start` time NOT NULL,
  `open_time_end` time NOT NULL,
  `open_date` date NOT NULL DEFAULT current_timestamp(),
  `open_time_json` longtext NOT NULL,
  `number_slots_already_booked` int(11) NOT NULL DEFAULT 0,
  `reservable_slots` int(11) NOT NULL DEFAULT 1,
  `car_type_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '[1,2,3]',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='กำหนดการเปิดพื้นที่';

--
-- Dumping data for table `tbl_open_area_schedule_sub_details`
--

INSERT INTO `tbl_open_area_schedule_sub_details` (`open_id`, `id`, `building_id`, `hall_id`, `event_name`, `open_date_start`, `open_date_end`, `open_time_start`, `open_time_end`, `open_date`, `open_time_json`, `number_slots_already_booked`, `reservable_slots`, `car_type_json`, `is_active`, `is_deleted`) VALUES
(40, 'OA659f80e66ae754.77627952', 'CH', 'hall03', 'ABC', '2024-01-11', '2024-02-04', '08:00:00', '18:00:00', '2024-01-11', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3,\"10:10\":3,\"10:20\":3,\"10:30\":3,\"10:40\":3,\"10:50\":3,\"11:00\":3,\"11:10\":3,\"11:20\":3,\"11:30\":3,\"11:40\":3,\"11:50\":3,\"12:00\":3,\"12:10\":3,\"12:20\":3,\"12:30\":3,\"12:40\":3,\"12:50\":3,\"13:00\":3,\"13:10\":3,\"13:20\":3,\"13:30\":3,\"13:40\":3,\"13:50\":3,\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3,\"16:10\":3,\"16:20\":3,\"16:30\":3,\"16:40\":3,\"16:50\":3,\"17:00\":3,\"17:10\":3,\"17:20\":3,\"17:30\":3,\"17:40\":3,\"17:50\":3,\"18:00\":3}', 0, 3, '[1,2,3]', 1, 0),
(40, 'OA659f80e66ae754.77627952', 'CH', 'hall03', 'ABC', '2024-01-11', '2024-02-04', '08:00:00', '18:00:00', '2024-01-12', '{\"08:00\": 1, \"08:10\": 1, \"08:20\": 1, \"08:30\": 1, \"08:40\": 2, \"08:50\": 2, \"09:00\": 2, \"09:10\": 2, \"09:20\": 2, \"09:30\": 2, \"09:40\": 3, \"09:50\": 3, \"10:00\": 3, \"10:10\": 3, \"10:20\": 3, \"10:30\": 3, \"10:40\": 3, \"10:50\": 3, \"11:00\": 3, \"11:10\": 3, \"11:20\": 3, \"11:30\": 3, \"11:40\": 3, \"11:50\": 3, \"12:00\": 3, \"12:10\": 3, \"12:20\": 3, \"12:30\": 3, \"12:40\": 3, \"12:50\": 3, \"13:00\": 3, \"13:10\": 3, \"13:20\": 3, \"13:30\": 3, \"13:40\": 3, \"13:50\": 3, \"14:00\": 3, \"14:10\": 3, \"14:20\": 3, \"14:30\": 3, \"14:40\": 3, \"14:50\": 3, \"15:00\": 3, \"15:10\": 3, \"15:20\": 3, \"15:30\": 3, \"15:40\": 3, \"15:50\": 3, \"16:00\": 3, \"16:10\": 3, \"16:20\": 3, \"16:30\": 3, \"16:40\": 3, \"16:50\": 3, \"17:00\": 3, \"17:10\": 3, \"17:20\": 3, \"17:30\": 3, \"17:40\": 3, \"17:50\": 3, \"18:00\": 3}', 0, 3, '[1,2,3]', 1, 0),
(40, 'OA659f80e66ae754.77627952', 'CH', 'hall03', 'ABC', '2024-01-11', '2024-02-04', '08:00:00', '18:00:00', '2024-01-13', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3,\"10:10\":3,\"10:20\":3,\"10:30\":3,\"10:40\":3,\"10:50\":3,\"11:00\":3,\"11:10\":3,\"11:20\":3,\"11:30\":3,\"11:40\":3,\"11:50\":3,\"12:00\":3,\"12:10\":3,\"12:20\":3,\"12:30\":3,\"12:40\":3,\"12:50\":3,\"13:00\":3,\"13:10\":3,\"13:20\":3,\"13:30\":3,\"13:40\":3,\"13:50\":3,\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3,\"16:10\":3,\"16:20\":3,\"16:30\":3,\"16:40\":3,\"16:50\":3,\"17:00\":3,\"17:10\":3,\"17:20\":3,\"17:30\":3,\"17:40\":3,\"17:50\":3,\"18:00\":3}', 0, 3, '[1,2,3]', 1, 0),
(40, 'OA659f80e66ae754.77627952', 'CH', 'hall03', 'ABC', '2024-01-11', '2024-02-04', '08:00:00', '18:00:00', '2024-01-14', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3,\"10:10\":3,\"10:20\":3,\"10:30\":3,\"10:40\":3,\"10:50\":3,\"11:00\":3,\"11:10\":3,\"11:20\":3,\"11:30\":3,\"11:40\":3,\"11:50\":3,\"12:00\":3,\"12:10\":3,\"12:20\":3,\"12:30\":3,\"12:40\":3,\"12:50\":3,\"13:00\":3,\"13:10\":3,\"13:20\":3,\"13:30\":3,\"13:40\":3,\"13:50\":3,\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3,\"16:10\":3,\"16:20\":3,\"16:30\":3,\"16:40\":3,\"16:50\":3,\"17:00\":3,\"17:10\":3,\"17:20\":3,\"17:30\":3,\"17:40\":3,\"17:50\":3,\"18:00\":3}', 0, 3, '[1,2,3]', 1, 0),
(40, 'OA659f80e66ae754.77627952', 'CH', 'hall03', 'ABC', '2024-01-11', '2024-02-04', '08:00:00', '18:00:00', '2024-01-15', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3,\"10:10\":3,\"10:20\":3,\"10:30\":3,\"10:40\":3,\"10:50\":3,\"11:00\":3,\"11:10\":3,\"11:20\":3,\"11:30\":3,\"11:40\":3,\"11:50\":3,\"12:00\":3,\"12:10\":3,\"12:20\":3,\"12:30\":3,\"12:40\":3,\"12:50\":3,\"13:00\":3,\"13:10\":3,\"13:20\":3,\"13:30\":3,\"13:40\":3,\"13:50\":3,\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3,\"16:10\":3,\"16:20\":3,\"16:30\":3,\"16:40\":3,\"16:50\":3,\"17:00\":3,\"17:10\":3,\"17:20\":3,\"17:30\":3,\"17:40\":3,\"17:50\":3,\"18:00\":3}', 0, 3, '[1,2,3]', 1, 0),
(40, 'OA659f80e66ae754.77627952', 'CH', 'hall03', 'ABC', '2024-01-11', '2024-02-04', '08:00:00', '18:00:00', '2024-01-16', '{\"08:00\": 2, \"08:10\": 2, \"08:20\": 2, \"08:30\": 2, \"08:40\": 3, \"08:50\": 3, \"09:00\": 3, \"09:10\": 3, \"09:20\": 3, \"09:30\": 3, \"09:40\": 3, \"09:50\": 3, \"10:00\": 3, \"10:10\": 3, \"10:20\": 3, \"10:30\": 3, \"10:40\": 3, \"10:50\": 3, \"11:00\": 3, \"11:10\": 3, \"11:20\": 3, \"11:30\": 3, \"11:40\": 3, \"11:50\": 3, \"12:00\": 3, \"12:10\": 3, \"12:20\": 3, \"12:30\": 3, \"12:40\": 3, \"12:50\": 3, \"13:00\": 3, \"13:10\": 3, \"13:20\": 3, \"13:30\": 3, \"13:40\": 3, \"13:50\": 3, \"14:00\": 3, \"14:10\": 3, \"14:20\": 3, \"14:30\": 3, \"14:40\": 3, \"14:50\": 3, \"15:00\": 3, \"15:10\": 3, \"15:20\": 3, \"15:30\": 3, \"15:40\": 3, \"15:50\": 3, \"16:00\": 3, \"16:10\": 3, \"16:20\": 3, \"16:30\": 3, \"16:40\": 3, \"16:50\": 3, \"17:00\": 3, \"17:10\": 3, \"17:20\": 3, \"17:30\": 3, \"17:40\": 3, \"17:50\": 3, \"18:00\": 3}', 0, 3, '[1,2,3]', 1, 0),
(40, 'OA659f80e66ae754.77627952', 'CH', 'hall03', 'ABC', '2024-01-11', '2024-02-04', '08:00:00', '18:00:00', '2024-01-17', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3,\"10:10\":3,\"10:20\":3,\"10:30\":3,\"10:40\":3,\"10:50\":3,\"11:00\":3,\"11:10\":3,\"11:20\":3,\"11:30\":3,\"11:40\":3,\"11:50\":3,\"12:00\":3,\"12:10\":3,\"12:20\":3,\"12:30\":3,\"12:40\":3,\"12:50\":3,\"13:00\":3,\"13:10\":3,\"13:20\":3,\"13:30\":3,\"13:40\":3,\"13:50\":3,\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3,\"16:10\":3,\"16:20\":3,\"16:30\":3,\"16:40\":3,\"16:50\":3,\"17:00\":3,\"17:10\":3,\"17:20\":3,\"17:30\":3,\"17:40\":3,\"17:50\":3,\"18:00\":3}', 0, 3, '[1,2,3]', 1, 0),
(40, 'OA659f80e66ae754.77627952', 'CH', 'hall03', 'ABC', '2024-01-11', '2024-02-04', '08:00:00', '18:00:00', '2024-01-18', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3,\"10:10\":3,\"10:20\":3,\"10:30\":3,\"10:40\":3,\"10:50\":3,\"11:00\":3,\"11:10\":3,\"11:20\":3,\"11:30\":3,\"11:40\":3,\"11:50\":3,\"12:00\":3,\"12:10\":3,\"12:20\":3,\"12:30\":3,\"12:40\":3,\"12:50\":3,\"13:00\":3,\"13:10\":3,\"13:20\":3,\"13:30\":3,\"13:40\":3,\"13:50\":3,\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3,\"16:10\":3,\"16:20\":3,\"16:30\":3,\"16:40\":3,\"16:50\":3,\"17:00\":3,\"17:10\":3,\"17:20\":3,\"17:30\":3,\"17:40\":3,\"17:50\":3,\"18:00\":3}', 0, 3, '[1,2,3]', 1, 0),
(40, 'OA659f80e66ae754.77627952', 'CH', 'hall03', 'ABC', '2024-01-11', '2024-02-04', '08:00:00', '18:00:00', '2024-01-19', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3,\"10:10\":3,\"10:20\":3,\"10:30\":3,\"10:40\":3,\"10:50\":3,\"11:00\":3,\"11:10\":3,\"11:20\":3,\"11:30\":3,\"11:40\":3,\"11:50\":3,\"12:00\":3,\"12:10\":3,\"12:20\":3,\"12:30\":3,\"12:40\":3,\"12:50\":3,\"13:00\":3,\"13:10\":3,\"13:20\":3,\"13:30\":3,\"13:40\":3,\"13:50\":3,\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3,\"16:10\":3,\"16:20\":3,\"16:30\":3,\"16:40\":3,\"16:50\":3,\"17:00\":3,\"17:10\":3,\"17:20\":3,\"17:30\":3,\"17:40\":3,\"17:50\":3,\"18:00\":3}', 0, 3, '[1,2,3]', 1, 0),
(40, 'OA659f80e66ae754.77627952', 'CH', 'hall03', 'ABC', '2024-01-11', '2024-02-04', '08:00:00', '18:00:00', '2024-01-20', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3,\"10:10\":3,\"10:20\":3,\"10:30\":3,\"10:40\":3,\"10:50\":3,\"11:00\":3,\"11:10\":3,\"11:20\":3,\"11:30\":3,\"11:40\":3,\"11:50\":3,\"12:00\":3,\"12:10\":3,\"12:20\":3,\"12:30\":3,\"12:40\":3,\"12:50\":3,\"13:00\":3,\"13:10\":3,\"13:20\":3,\"13:30\":3,\"13:40\":3,\"13:50\":3,\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3,\"16:10\":3,\"16:20\":3,\"16:30\":3,\"16:40\":3,\"16:50\":3,\"17:00\":3,\"17:10\":3,\"17:20\":3,\"17:30\":3,\"17:40\":3,\"17:50\":3,\"18:00\":3}', 0, 3, '[1,2,3]', 1, 0),
(40, 'OA659f80e66ae754.77627952', 'CH', 'hall03', 'ABC', '2024-01-11', '2024-02-04', '08:00:00', '18:00:00', '2024-01-21', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3,\"10:10\":3,\"10:20\":3,\"10:30\":3,\"10:40\":3,\"10:50\":3,\"11:00\":3,\"11:10\":3,\"11:20\":3,\"11:30\":3,\"11:40\":3,\"11:50\":3,\"12:00\":3,\"12:10\":3,\"12:20\":3,\"12:30\":3,\"12:40\":3,\"12:50\":3,\"13:00\":3,\"13:10\":3,\"13:20\":3,\"13:30\":3,\"13:40\":3,\"13:50\":3,\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3,\"16:10\":3,\"16:20\":3,\"16:30\":3,\"16:40\":3,\"16:50\":3,\"17:00\":3,\"17:10\":3,\"17:20\":3,\"17:30\":3,\"17:40\":3,\"17:50\":3,\"18:00\":3}', 0, 3, '[1,2,3]', 1, 0),
(40, 'OA659f80e66ae754.77627952', 'CH', 'hall03', 'ABC', '2024-01-11', '2024-02-04', '08:00:00', '18:00:00', '2024-01-22', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3,\"10:10\":3,\"10:20\":3,\"10:30\":3,\"10:40\":3,\"10:50\":3,\"11:00\":3,\"11:10\":3,\"11:20\":3,\"11:30\":3,\"11:40\":3,\"11:50\":3,\"12:00\":3,\"12:10\":3,\"12:20\":3,\"12:30\":3,\"12:40\":3,\"12:50\":3,\"13:00\":3,\"13:10\":3,\"13:20\":3,\"13:30\":3,\"13:40\":3,\"13:50\":3,\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3,\"16:10\":3,\"16:20\":3,\"16:30\":3,\"16:40\":3,\"16:50\":3,\"17:00\":3,\"17:10\":3,\"17:20\":3,\"17:30\":3,\"17:40\":3,\"17:50\":3,\"18:00\":3}', 0, 3, '[1,2,3]', 1, 0),
(40, 'OA659f80e66ae754.77627952', 'CH', 'hall03', 'ABC', '2024-01-11', '2024-02-04', '08:00:00', '18:00:00', '2024-01-23', '{\"08:00\": 0, \"08:10\": 0, \"08:20\": 0, \"08:30\": 0, \"08:40\": 3, \"08:50\": 3, \"09:00\": 3, \"09:10\": 3, \"09:20\": 3, \"09:30\": 3, \"09:40\": 3, \"09:50\": 3, \"10:00\": 3, \"10:10\": 3, \"10:20\": 3, \"10:30\": 3, \"10:40\": 3, \"10:50\": 3, \"11:00\": 3, \"11:10\": 3, \"11:20\": 3, \"11:30\": 3, \"11:40\": 3, \"11:50\": 3, \"12:00\": 3, \"12:10\": 3, \"12:20\": 3, \"12:30\": 3, \"12:40\": 3, \"12:50\": 3, \"13:00\": 3, \"13:10\": 3, \"13:20\": 3, \"13:30\": 3, \"13:40\": 3, \"13:50\": 3, \"14:00\": 3, \"14:10\": 3, \"14:20\": 3, \"14:30\": 3, \"14:40\": 3, \"14:50\": 3, \"15:00\": 3, \"15:10\": 3, \"15:20\": 3, \"15:30\": 3, \"15:40\": 3, \"15:50\": 3, \"16:00\": 3, \"16:10\": 3, \"16:20\": 3, \"16:30\": 3, \"16:40\": 3, \"16:50\": 3, \"17:00\": 3, \"17:10\": 3, \"17:20\": 3, \"17:30\": 3, \"17:40\": 3, \"17:50\": 3, \"18:00\": 3}', 0, 3, '[1,2,3]', 1, 0),
(40, 'OA659f80e66ae754.77627952', 'CH', 'hall03', 'ABC', '2024-01-11', '2024-02-04', '08:00:00', '18:00:00', '2024-01-24', '{\"08:00\": 0, \"08:10\": 0, \"08:20\": 0, \"08:30\": 0, \"08:40\": 2, \"08:50\": 2, \"09:00\": 3, \"09:10\": 3, \"09:20\": 3, \"09:30\": 3, \"09:40\": 3, \"09:50\": 3, \"10:00\": 3, \"10:10\": 3, \"10:20\": 3, \"10:30\": 3, \"10:40\": 3, \"10:50\": 3, \"11:00\": 3, \"11:10\": 3, \"11:20\": 3, \"11:30\": 3, \"11:40\": 3, \"11:50\": 3, \"12:00\": 3, \"12:10\": 3, \"12:20\": 3, \"12:30\": 3, \"12:40\": 3, \"12:50\": 3, \"13:00\": 3, \"13:10\": 3, \"13:20\": 3, \"13:30\": 3, \"13:40\": 3, \"13:50\": 3, \"14:00\": 3, \"14:10\": 3, \"14:20\": 3, \"14:30\": 3, \"14:40\": 3, \"14:50\": 3, \"15:00\": 3, \"15:10\": 3, \"15:20\": 3, \"15:30\": 3, \"15:40\": 3, \"15:50\": 3, \"16:00\": 3, \"16:10\": 3, \"16:20\": 3, \"16:30\": 3, \"16:40\": 3, \"16:50\": 3, \"17:00\": 3, \"17:10\": 3, \"17:20\": 3, \"17:30\": 3, \"17:40\": 3, \"17:50\": 3, \"18:00\": 3}', 0, 3, '[1,2,3]', 1, 0),
(40, 'OA659f80e66ae754.77627952', 'CH', 'hall03', 'ABC', '2024-01-11', '2024-02-04', '08:00:00', '18:00:00', '2024-01-25', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3,\"10:10\":3,\"10:20\":3,\"10:30\":3,\"10:40\":3,\"10:50\":3,\"11:00\":3,\"11:10\":3,\"11:20\":3,\"11:30\":3,\"11:40\":3,\"11:50\":3,\"12:00\":3,\"12:10\":3,\"12:20\":3,\"12:30\":3,\"12:40\":3,\"12:50\":3,\"13:00\":3,\"13:10\":3,\"13:20\":3,\"13:30\":3,\"13:40\":3,\"13:50\":3,\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3,\"16:10\":3,\"16:20\":3,\"16:30\":3,\"16:40\":3,\"16:50\":3,\"17:00\":3,\"17:10\":3,\"17:20\":3,\"17:30\":3,\"17:40\":3,\"17:50\":3,\"18:00\":3}', 0, 3, '[1,2,3]', 1, 0),
(40, 'OA659f80e66ae754.77627952', 'CH', 'hall03', 'ABC', '2024-01-11', '2024-02-04', '08:00:00', '18:00:00', '2024-01-26', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3,\"10:10\":3,\"10:20\":3,\"10:30\":3,\"10:40\":3,\"10:50\":3,\"11:00\":3,\"11:10\":3,\"11:20\":3,\"11:30\":3,\"11:40\":3,\"11:50\":3,\"12:00\":3,\"12:10\":3,\"12:20\":3,\"12:30\":3,\"12:40\":3,\"12:50\":3,\"13:00\":3,\"13:10\":3,\"13:20\":3,\"13:30\":3,\"13:40\":3,\"13:50\":3,\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3,\"16:10\":3,\"16:20\":3,\"16:30\":3,\"16:40\":3,\"16:50\":3,\"17:00\":3,\"17:10\":3,\"17:20\":3,\"17:30\":3,\"17:40\":3,\"17:50\":3,\"18:00\":3}', 0, 3, '[1,2,3]', 1, 0),
(40, 'OA659f80e66ae754.77627952', 'CH', 'hall03', 'ABC', '2024-01-11', '2024-02-04', '08:00:00', '18:00:00', '2024-01-27', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3,\"10:10\":3,\"10:20\":3,\"10:30\":3,\"10:40\":3,\"10:50\":3,\"11:00\":3,\"11:10\":3,\"11:20\":3,\"11:30\":3,\"11:40\":3,\"11:50\":3,\"12:00\":3,\"12:10\":3,\"12:20\":3,\"12:30\":3,\"12:40\":3,\"12:50\":3,\"13:00\":3,\"13:10\":3,\"13:20\":3,\"13:30\":3,\"13:40\":3,\"13:50\":3,\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3,\"16:10\":3,\"16:20\":3,\"16:30\":3,\"16:40\":3,\"16:50\":3,\"17:00\":3,\"17:10\":3,\"17:20\":3,\"17:30\":3,\"17:40\":3,\"17:50\":3,\"18:00\":3}', 0, 3, '[1,2,3]', 1, 0),
(40, 'OA659f80e66ae754.77627952', 'CH', 'hall03', 'ABC', '2024-01-11', '2024-02-04', '08:00:00', '18:00:00', '2024-01-28', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3,\"10:10\":3,\"10:20\":3,\"10:30\":3,\"10:40\":3,\"10:50\":3,\"11:00\":3,\"11:10\":3,\"11:20\":3,\"11:30\":3,\"11:40\":3,\"11:50\":3,\"12:00\":3,\"12:10\":3,\"12:20\":3,\"12:30\":3,\"12:40\":3,\"12:50\":3,\"13:00\":3,\"13:10\":3,\"13:20\":3,\"13:30\":3,\"13:40\":3,\"13:50\":3,\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3,\"16:10\":3,\"16:20\":3,\"16:30\":3,\"16:40\":3,\"16:50\":3,\"17:00\":3,\"17:10\":3,\"17:20\":3,\"17:30\":3,\"17:40\":3,\"17:50\":3,\"18:00\":3}', 0, 3, '[1,2,3]', 1, 0),
(40, 'OA659f80e66ae754.77627952', 'CH', 'hall03', 'ABC', '2024-01-11', '2024-02-04', '08:00:00', '18:00:00', '2024-01-29', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3,\"10:10\":3,\"10:20\":3,\"10:30\":3,\"10:40\":3,\"10:50\":3,\"11:00\":3,\"11:10\":3,\"11:20\":3,\"11:30\":3,\"11:40\":3,\"11:50\":3,\"12:00\":3,\"12:10\":3,\"12:20\":3,\"12:30\":3,\"12:40\":3,\"12:50\":3,\"13:00\":3,\"13:10\":3,\"13:20\":3,\"13:30\":3,\"13:40\":3,\"13:50\":3,\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3,\"16:10\":3,\"16:20\":3,\"16:30\":3,\"16:40\":3,\"16:50\":3,\"17:00\":3,\"17:10\":3,\"17:20\":3,\"17:30\":3,\"17:40\":3,\"17:50\":3,\"18:00\":3}', 0, 3, '[1,2,3]', 1, 0),
(40, 'OA659f80e66ae754.77627952', 'CH', 'hall03', 'ABC', '2024-01-11', '2024-02-04', '08:00:00', '18:00:00', '2024-01-30', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3,\"10:10\":3,\"10:20\":3,\"10:30\":3,\"10:40\":3,\"10:50\":3,\"11:00\":3,\"11:10\":3,\"11:20\":3,\"11:30\":3,\"11:40\":3,\"11:50\":3,\"12:00\":3,\"12:10\":3,\"12:20\":3,\"12:30\":3,\"12:40\":3,\"12:50\":3,\"13:00\":3,\"13:10\":3,\"13:20\":3,\"13:30\":3,\"13:40\":3,\"13:50\":3,\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3,\"16:10\":3,\"16:20\":3,\"16:30\":3,\"16:40\":3,\"16:50\":3,\"17:00\":3,\"17:10\":3,\"17:20\":3,\"17:30\":3,\"17:40\":3,\"17:50\":3,\"18:00\":3}', 0, 3, '[1,2,3]', 1, 0),
(40, 'OA659f80e66ae754.77627952', 'CH', 'hall03', 'ABC', '2024-01-11', '2024-02-04', '08:00:00', '18:00:00', '2024-01-31', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3,\"10:10\":3,\"10:20\":3,\"10:30\":3,\"10:40\":3,\"10:50\":3,\"11:00\":3,\"11:10\":3,\"11:20\":3,\"11:30\":3,\"11:40\":3,\"11:50\":3,\"12:00\":3,\"12:10\":3,\"12:20\":3,\"12:30\":3,\"12:40\":3,\"12:50\":3,\"13:00\":3,\"13:10\":3,\"13:20\":3,\"13:30\":3,\"13:40\":3,\"13:50\":3,\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3,\"16:10\":3,\"16:20\":3,\"16:30\":3,\"16:40\":3,\"16:50\":3,\"17:00\":3,\"17:10\":3,\"17:20\":3,\"17:30\":3,\"17:40\":3,\"17:50\":3,\"18:00\":3}', 0, 3, '[1,2,3]', 1, 0),
(40, 'OA659f80e66ae754.77627952', 'CH', 'hall03', 'ABC', '2024-01-11', '2024-02-04', '08:00:00', '18:00:00', '2024-02-01', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3,\"10:10\":3,\"10:20\":3,\"10:30\":3,\"10:40\":3,\"10:50\":3,\"11:00\":3,\"11:10\":3,\"11:20\":3,\"11:30\":3,\"11:40\":3,\"11:50\":3,\"12:00\":3,\"12:10\":3,\"12:20\":3,\"12:30\":3,\"12:40\":3,\"12:50\":3,\"13:00\":3,\"13:10\":3,\"13:20\":3,\"13:30\":3,\"13:40\":3,\"13:50\":3,\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3,\"16:10\":3,\"16:20\":3,\"16:30\":3,\"16:40\":3,\"16:50\":3,\"17:00\":3,\"17:10\":3,\"17:20\":3,\"17:30\":3,\"17:40\":3,\"17:50\":3,\"18:00\":3}', 0, 3, '[1,2,3]', 1, 0),
(40, 'OA659f80e66ae754.77627952', 'CH', 'hall03', 'ABC', '2024-01-11', '2024-02-04', '08:00:00', '18:00:00', '2024-02-02', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3,\"10:10\":3,\"10:20\":3,\"10:30\":3,\"10:40\":3,\"10:50\":3,\"11:00\":3,\"11:10\":3,\"11:20\":3,\"11:30\":3,\"11:40\":3,\"11:50\":3,\"12:00\":3,\"12:10\":3,\"12:20\":3,\"12:30\":3,\"12:40\":3,\"12:50\":3,\"13:00\":3,\"13:10\":3,\"13:20\":3,\"13:30\":3,\"13:40\":3,\"13:50\":3,\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3,\"16:10\":3,\"16:20\":3,\"16:30\":3,\"16:40\":3,\"16:50\":3,\"17:00\":3,\"17:10\":3,\"17:20\":3,\"17:30\":3,\"17:40\":3,\"17:50\":3,\"18:00\":3}', 0, 3, '[1,2,3]', 1, 0),
(40, 'OA659f80e66ae754.77627952', 'CH', 'hall03', 'ABC', '2024-01-11', '2024-02-04', '08:00:00', '18:00:00', '2024-02-03', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3,\"10:10\":3,\"10:20\":3,\"10:30\":3,\"10:40\":3,\"10:50\":3,\"11:00\":3,\"11:10\":3,\"11:20\":3,\"11:30\":3,\"11:40\":3,\"11:50\":3,\"12:00\":3,\"12:10\":3,\"12:20\":3,\"12:30\":3,\"12:40\":3,\"12:50\":3,\"13:00\":3,\"13:10\":3,\"13:20\":3,\"13:30\":3,\"13:40\":3,\"13:50\":3,\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3,\"16:10\":3,\"16:20\":3,\"16:30\":3,\"16:40\":3,\"16:50\":3,\"17:00\":3,\"17:10\":3,\"17:20\":3,\"17:30\":3,\"17:40\":3,\"17:50\":3,\"18:00\":3}', 0, 3, '[1,2,3]', 1, 0),
(40, 'OA659f80e66ae754.77627952', 'CH', 'hall03', 'ABC', '2024-01-11', '2024-02-04', '08:00:00', '18:00:00', '2024-02-04', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3,\"10:10\":3,\"10:20\":3,\"10:30\":3,\"10:40\":3,\"10:50\":3,\"11:00\":3,\"11:10\":3,\"11:20\":3,\"11:30\":3,\"11:40\":3,\"11:50\":3,\"12:00\":3,\"12:10\":3,\"12:20\":3,\"12:30\":3,\"12:40\":3,\"12:50\":3,\"13:00\":3,\"13:10\":3,\"13:20\":3,\"13:30\":3,\"13:40\":3,\"13:50\":3,\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3,\"16:10\":3,\"16:20\":3,\"16:30\":3,\"16:40\":3,\"16:50\":3,\"17:00\":3,\"17:10\":3,\"17:20\":3,\"17:30\":3,\"17:40\":3,\"17:50\":3,\"18:00\":3}', 0, 3, '[1,2,3]', 1, 0),
(41, 'OA659f811946a556.03984573', 'IEC', 'hall09', 'XYZ', '2024-01-15', '2024-02-03', '08:00:00', '18:00:00', '2024-01-15', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3,\"10:10\":3,\"10:20\":3,\"10:30\":3,\"10:40\":3,\"10:50\":3,\"11:00\":3,\"11:10\":3,\"11:20\":3,\"11:30\":3,\"11:40\":3,\"11:50\":3,\"12:00\":3,\"12:10\":3,\"12:20\":3,\"12:30\":3,\"12:40\":3,\"12:50\":3,\"13:00\":3,\"13:10\":3,\"13:20\":3,\"13:30\":3,\"13:40\":3,\"13:50\":3,\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3,\"16:10\":3,\"16:20\":3,\"16:30\":3,\"16:40\":3,\"16:50\":3,\"17:00\":3,\"17:10\":3,\"17:20\":3,\"17:30\":3,\"17:40\":3,\"17:50\":3,\"18:00\":3}', 0, 3, '[1,2,3]', 1, 0),
(41, 'OA659f811946a556.03984573', 'IEC', 'hall09', 'XYZ', '2024-01-15', '2024-02-03', '08:00:00', '18:00:00', '2024-01-16', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3,\"10:10\":3,\"10:20\":3,\"10:30\":3,\"10:40\":3,\"10:50\":3,\"11:00\":3,\"11:10\":3,\"11:20\":3,\"11:30\":3,\"11:40\":3,\"11:50\":3,\"12:00\":3,\"12:10\":3,\"12:20\":3,\"12:30\":3,\"12:40\":3,\"12:50\":3,\"13:00\":3,\"13:10\":3,\"13:20\":3,\"13:30\":3,\"13:40\":3,\"13:50\":3,\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3,\"16:10\":3,\"16:20\":3,\"16:30\":3,\"16:40\":3,\"16:50\":3,\"17:00\":3,\"17:10\":3,\"17:20\":3,\"17:30\":3,\"17:40\":3,\"17:50\":3,\"18:00\":3}', 0, 3, '[1,2,3]', 1, 0),
(41, 'OA659f811946a556.03984573', 'IEC', 'hall09', 'XYZ', '2024-01-15', '2024-02-03', '08:00:00', '18:00:00', '2024-01-17', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3,\"10:10\":3,\"10:20\":3,\"10:30\":3,\"10:40\":3,\"10:50\":3,\"11:00\":3,\"11:10\":3,\"11:20\":3,\"11:30\":3,\"11:40\":3,\"11:50\":3,\"12:00\":3,\"12:10\":3,\"12:20\":3,\"12:30\":3,\"12:40\":3,\"12:50\":3,\"13:00\":3,\"13:10\":3,\"13:20\":3,\"13:30\":3,\"13:40\":3,\"13:50\":3,\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3,\"16:10\":3,\"16:20\":3,\"16:30\":3,\"16:40\":3,\"16:50\":3,\"17:00\":3,\"17:10\":3,\"17:20\":3,\"17:30\":3,\"17:40\":3,\"17:50\":3,\"18:00\":3}', 0, 3, '[1,2,3]', 1, 0),
(41, 'OA659f811946a556.03984573', 'IEC', 'hall09', 'XYZ', '2024-01-15', '2024-02-03', '08:00:00', '18:00:00', '2024-01-18', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3,\"10:10\":3,\"10:20\":3,\"10:30\":3,\"10:40\":3,\"10:50\":3,\"11:00\":3,\"11:10\":3,\"11:20\":3,\"11:30\":3,\"11:40\":3,\"11:50\":3,\"12:00\":3,\"12:10\":3,\"12:20\":3,\"12:30\":3,\"12:40\":3,\"12:50\":3,\"13:00\":3,\"13:10\":3,\"13:20\":3,\"13:30\":3,\"13:40\":3,\"13:50\":3,\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3,\"16:10\":3,\"16:20\":3,\"16:30\":3,\"16:40\":3,\"16:50\":3,\"17:00\":3,\"17:10\":3,\"17:20\":3,\"17:30\":3,\"17:40\":3,\"17:50\":3,\"18:00\":3}', 0, 3, '[1,2,3]', 1, 0),
(41, 'OA659f811946a556.03984573', 'IEC', 'hall09', 'XYZ', '2024-01-15', '2024-02-03', '08:00:00', '18:00:00', '2024-01-19', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3,\"10:10\":3,\"10:20\":3,\"10:30\":3,\"10:40\":3,\"10:50\":3,\"11:00\":3,\"11:10\":3,\"11:20\":3,\"11:30\":3,\"11:40\":3,\"11:50\":3,\"12:00\":3,\"12:10\":3,\"12:20\":3,\"12:30\":3,\"12:40\":3,\"12:50\":3,\"13:00\":3,\"13:10\":3,\"13:20\":3,\"13:30\":3,\"13:40\":3,\"13:50\":3,\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3,\"16:10\":3,\"16:20\":3,\"16:30\":3,\"16:40\":3,\"16:50\":3,\"17:00\":3,\"17:10\":3,\"17:20\":3,\"17:30\":3,\"17:40\":3,\"17:50\":3,\"18:00\":3}', 0, 3, '[1,2,3]', 1, 0),
(41, 'OA659f811946a556.03984573', 'IEC', 'hall09', 'XYZ', '2024-01-15', '2024-02-03', '08:00:00', '18:00:00', '2024-01-20', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3,\"10:10\":3,\"10:20\":3,\"10:30\":3,\"10:40\":3,\"10:50\":3,\"11:00\":3,\"11:10\":3,\"11:20\":3,\"11:30\":3,\"11:40\":3,\"11:50\":3,\"12:00\":3,\"12:10\":3,\"12:20\":3,\"12:30\":3,\"12:40\":3,\"12:50\":3,\"13:00\":3,\"13:10\":3,\"13:20\":3,\"13:30\":3,\"13:40\":3,\"13:50\":3,\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3,\"16:10\":3,\"16:20\":3,\"16:30\":3,\"16:40\":3,\"16:50\":3,\"17:00\":3,\"17:10\":3,\"17:20\":3,\"17:30\":3,\"17:40\":3,\"17:50\":3,\"18:00\":3}', 0, 3, '[1,2,3]', 1, 0),
(41, 'OA659f811946a556.03984573', 'IEC', 'hall09', 'XYZ', '2024-01-15', '2024-02-03', '08:00:00', '18:00:00', '2024-01-21', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3,\"10:10\":3,\"10:20\":3,\"10:30\":3,\"10:40\":3,\"10:50\":3,\"11:00\":3,\"11:10\":3,\"11:20\":3,\"11:30\":3,\"11:40\":3,\"11:50\":3,\"12:00\":3,\"12:10\":3,\"12:20\":3,\"12:30\":3,\"12:40\":3,\"12:50\":3,\"13:00\":3,\"13:10\":3,\"13:20\":3,\"13:30\":3,\"13:40\":3,\"13:50\":3,\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3,\"16:10\":3,\"16:20\":3,\"16:30\":3,\"16:40\":3,\"16:50\":3,\"17:00\":3,\"17:10\":3,\"17:20\":3,\"17:30\":3,\"17:40\":3,\"17:50\":3,\"18:00\":3}', 0, 3, '[1,2,3]', 1, 0),
(41, 'OA659f811946a556.03984573', 'IEC', 'hall09', 'XYZ', '2024-01-15', '2024-02-03', '08:00:00', '18:00:00', '2024-01-22', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3,\"10:10\":3,\"10:20\":3,\"10:30\":3,\"10:40\":3,\"10:50\":3,\"11:00\":3,\"11:10\":3,\"11:20\":3,\"11:30\":3,\"11:40\":3,\"11:50\":3,\"12:00\":3,\"12:10\":3,\"12:20\":3,\"12:30\":3,\"12:40\":3,\"12:50\":3,\"13:00\":3,\"13:10\":3,\"13:20\":3,\"13:30\":3,\"13:40\":3,\"13:50\":3,\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3,\"16:10\":3,\"16:20\":3,\"16:30\":3,\"16:40\":3,\"16:50\":3,\"17:00\":3,\"17:10\":3,\"17:20\":3,\"17:30\":3,\"17:40\":3,\"17:50\":3,\"18:00\":3}', 0, 3, '[1,2,3]', 1, 0),
(41, 'OA659f811946a556.03984573', 'IEC', 'hall09', 'XYZ', '2024-01-15', '2024-02-03', '08:00:00', '18:00:00', '2024-01-23', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3,\"10:10\":3,\"10:20\":3,\"10:30\":3,\"10:40\":3,\"10:50\":3,\"11:00\":3,\"11:10\":3,\"11:20\":3,\"11:30\":3,\"11:40\":3,\"11:50\":3,\"12:00\":3,\"12:10\":3,\"12:20\":3,\"12:30\":3,\"12:40\":3,\"12:50\":3,\"13:00\":3,\"13:10\":3,\"13:20\":3,\"13:30\":3,\"13:40\":3,\"13:50\":3,\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3,\"16:10\":3,\"16:20\":3,\"16:30\":3,\"16:40\":3,\"16:50\":3,\"17:00\":3,\"17:10\":3,\"17:20\":3,\"17:30\":3,\"17:40\":3,\"17:50\":3,\"18:00\":3}', 0, 3, '[1,2,3]', 1, 0),
(41, 'OA659f811946a556.03984573', 'IEC', 'hall09', 'XYZ', '2024-01-15', '2024-02-03', '08:00:00', '18:00:00', '2024-01-24', '{\"08:00\": 2, \"08:10\": 2, \"08:20\": 2, \"08:30\": 2, \"08:40\": 2, \"08:50\": 2, \"09:00\": 3, \"09:10\": 3, \"09:20\": 3, \"09:30\": 3, \"09:40\": 3, \"09:50\": 3, \"10:00\": 3, \"10:10\": 3, \"10:20\": 3, \"10:30\": 3, \"10:40\": 3, \"10:50\": 3, \"11:00\": 3, \"11:10\": 3, \"11:20\": 3, \"11:30\": 3, \"11:40\": 3, \"11:50\": 3, \"12:00\": 3, \"12:10\": 3, \"12:20\": 3, \"12:30\": 3, \"12:40\": 3, \"12:50\": 3, \"13:00\": 3, \"13:10\": 3, \"13:20\": 3, \"13:30\": 3, \"13:40\": 3, \"13:50\": 3, \"14:00\": 3, \"14:10\": 3, \"14:20\": 3, \"14:30\": 3, \"14:40\": 3, \"14:50\": 3, \"15:00\": 3, \"15:10\": 3, \"15:20\": 3, \"15:30\": 3, \"15:40\": 3, \"15:50\": 3, \"16:00\": 3, \"16:10\": 3, \"16:20\": 3, \"16:30\": 3, \"16:40\": 3, \"16:50\": 3, \"17:00\": 3, \"17:10\": 3, \"17:20\": 3, \"17:30\": 3, \"17:40\": 3, \"17:50\": 3, \"18:00\": 3}', 0, 3, '[1,2,3]', 1, 0),
(41, 'OA659f811946a556.03984573', 'IEC', 'hall09', 'XYZ', '2024-01-15', '2024-02-03', '08:00:00', '18:00:00', '2024-01-25', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3,\"10:10\":3,\"10:20\":3,\"10:30\":3,\"10:40\":3,\"10:50\":3,\"11:00\":3,\"11:10\":3,\"11:20\":3,\"11:30\":3,\"11:40\":3,\"11:50\":3,\"12:00\":3,\"12:10\":3,\"12:20\":3,\"12:30\":3,\"12:40\":3,\"12:50\":3,\"13:00\":3,\"13:10\":3,\"13:20\":3,\"13:30\":3,\"13:40\":3,\"13:50\":3,\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3,\"16:10\":3,\"16:20\":3,\"16:30\":3,\"16:40\":3,\"16:50\":3,\"17:00\":3,\"17:10\":3,\"17:20\":3,\"17:30\":3,\"17:40\":3,\"17:50\":3,\"18:00\":3}', 0, 3, '[1,2,3]', 1, 0),
(41, 'OA659f811946a556.03984573', 'IEC', 'hall09', 'XYZ', '2024-01-15', '2024-02-03', '08:00:00', '18:00:00', '2024-01-26', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3,\"10:10\":3,\"10:20\":3,\"10:30\":3,\"10:40\":3,\"10:50\":3,\"11:00\":3,\"11:10\":3,\"11:20\":3,\"11:30\":3,\"11:40\":3,\"11:50\":3,\"12:00\":3,\"12:10\":3,\"12:20\":3,\"12:30\":3,\"12:40\":3,\"12:50\":3,\"13:00\":3,\"13:10\":3,\"13:20\":3,\"13:30\":3,\"13:40\":3,\"13:50\":3,\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3,\"16:10\":3,\"16:20\":3,\"16:30\":3,\"16:40\":3,\"16:50\":3,\"17:00\":3,\"17:10\":3,\"17:20\":3,\"17:30\":3,\"17:40\":3,\"17:50\":3,\"18:00\":3}', 0, 3, '[1,2,3]', 1, 0),
(41, 'OA659f811946a556.03984573', 'IEC', 'hall09', 'XYZ', '2024-01-15', '2024-02-03', '08:00:00', '18:00:00', '2024-01-27', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3,\"10:10\":3,\"10:20\":3,\"10:30\":3,\"10:40\":3,\"10:50\":3,\"11:00\":3,\"11:10\":3,\"11:20\":3,\"11:30\":3,\"11:40\":3,\"11:50\":3,\"12:00\":3,\"12:10\":3,\"12:20\":3,\"12:30\":3,\"12:40\":3,\"12:50\":3,\"13:00\":3,\"13:10\":3,\"13:20\":3,\"13:30\":3,\"13:40\":3,\"13:50\":3,\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3,\"16:10\":3,\"16:20\":3,\"16:30\":3,\"16:40\":3,\"16:50\":3,\"17:00\":3,\"17:10\":3,\"17:20\":3,\"17:30\":3,\"17:40\":3,\"17:50\":3,\"18:00\":3}', 0, 3, '[1,2,3]', 1, 0),
(41, 'OA659f811946a556.03984573', 'IEC', 'hall09', 'XYZ', '2024-01-15', '2024-02-03', '08:00:00', '18:00:00', '2024-01-28', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3,\"10:10\":3,\"10:20\":3,\"10:30\":3,\"10:40\":3,\"10:50\":3,\"11:00\":3,\"11:10\":3,\"11:20\":3,\"11:30\":3,\"11:40\":3,\"11:50\":3,\"12:00\":3,\"12:10\":3,\"12:20\":3,\"12:30\":3,\"12:40\":3,\"12:50\":3,\"13:00\":3,\"13:10\":3,\"13:20\":3,\"13:30\":3,\"13:40\":3,\"13:50\":3,\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3,\"16:10\":3,\"16:20\":3,\"16:30\":3,\"16:40\":3,\"16:50\":3,\"17:00\":3,\"17:10\":3,\"17:20\":3,\"17:30\":3,\"17:40\":3,\"17:50\":3,\"18:00\":3}', 0, 3, '[1,2,3]', 1, 0),
(41, 'OA659f811946a556.03984573', 'IEC', 'hall09', 'XYZ', '2024-01-15', '2024-02-03', '08:00:00', '18:00:00', '2024-01-29', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3,\"10:10\":3,\"10:20\":3,\"10:30\":3,\"10:40\":3,\"10:50\":3,\"11:00\":3,\"11:10\":3,\"11:20\":3,\"11:30\":3,\"11:40\":3,\"11:50\":3,\"12:00\":3,\"12:10\":3,\"12:20\":3,\"12:30\":3,\"12:40\":3,\"12:50\":3,\"13:00\":3,\"13:10\":3,\"13:20\":3,\"13:30\":3,\"13:40\":3,\"13:50\":3,\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3,\"16:10\":3,\"16:20\":3,\"16:30\":3,\"16:40\":3,\"16:50\":3,\"17:00\":3,\"17:10\":3,\"17:20\":3,\"17:30\":3,\"17:40\":3,\"17:50\":3,\"18:00\":3}', 0, 3, '[1,2,3]', 1, 0),
(41, 'OA659f811946a556.03984573', 'IEC', 'hall09', 'XYZ', '2024-01-15', '2024-02-03', '08:00:00', '18:00:00', '2024-01-30', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3,\"10:10\":3,\"10:20\":3,\"10:30\":3,\"10:40\":3,\"10:50\":3,\"11:00\":3,\"11:10\":3,\"11:20\":3,\"11:30\":3,\"11:40\":3,\"11:50\":3,\"12:00\":3,\"12:10\":3,\"12:20\":3,\"12:30\":3,\"12:40\":3,\"12:50\":3,\"13:00\":3,\"13:10\":3,\"13:20\":3,\"13:30\":3,\"13:40\":3,\"13:50\":3,\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3,\"16:10\":3,\"16:20\":3,\"16:30\":3,\"16:40\":3,\"16:50\":3,\"17:00\":3,\"17:10\":3,\"17:20\":3,\"17:30\":3,\"17:40\":3,\"17:50\":3,\"18:00\":3}', 0, 3, '[1,2,3]', 1, 0),
(41, 'OA659f811946a556.03984573', 'IEC', 'hall09', 'XYZ', '2024-01-15', '2024-02-03', '08:00:00', '18:00:00', '2024-01-31', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3,\"10:10\":3,\"10:20\":3,\"10:30\":3,\"10:40\":3,\"10:50\":3,\"11:00\":3,\"11:10\":3,\"11:20\":3,\"11:30\":3,\"11:40\":3,\"11:50\":3,\"12:00\":3,\"12:10\":3,\"12:20\":3,\"12:30\":3,\"12:40\":3,\"12:50\":3,\"13:00\":3,\"13:10\":3,\"13:20\":3,\"13:30\":3,\"13:40\":3,\"13:50\":3,\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3,\"16:10\":3,\"16:20\":3,\"16:30\":3,\"16:40\":3,\"16:50\":3,\"17:00\":3,\"17:10\":3,\"17:20\":3,\"17:30\":3,\"17:40\":3,\"17:50\":3,\"18:00\":3}', 0, 3, '[1,2,3]', 1, 0),
(41, 'OA659f811946a556.03984573', 'IEC', 'hall09', 'XYZ', '2024-01-15', '2024-02-03', '08:00:00', '18:00:00', '2024-02-01', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3,\"10:10\":3,\"10:20\":3,\"10:30\":3,\"10:40\":3,\"10:50\":3,\"11:00\":3,\"11:10\":3,\"11:20\":3,\"11:30\":3,\"11:40\":3,\"11:50\":3,\"12:00\":3,\"12:10\":3,\"12:20\":3,\"12:30\":3,\"12:40\":3,\"12:50\":3,\"13:00\":3,\"13:10\":3,\"13:20\":3,\"13:30\":3,\"13:40\":3,\"13:50\":3,\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3,\"16:10\":3,\"16:20\":3,\"16:30\":3,\"16:40\":3,\"16:50\":3,\"17:00\":3,\"17:10\":3,\"17:20\":3,\"17:30\":3,\"17:40\":3,\"17:50\":3,\"18:00\":3}', 0, 3, '[1,2,3]', 1, 0),
(41, 'OA659f811946a556.03984573', 'IEC', 'hall09', 'XYZ', '2024-01-15', '2024-02-03', '08:00:00', '18:00:00', '2024-02-02', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3,\"10:10\":3,\"10:20\":3,\"10:30\":3,\"10:40\":3,\"10:50\":3,\"11:00\":3,\"11:10\":3,\"11:20\":3,\"11:30\":3,\"11:40\":3,\"11:50\":3,\"12:00\":3,\"12:10\":3,\"12:20\":3,\"12:30\":3,\"12:40\":3,\"12:50\":3,\"13:00\":3,\"13:10\":3,\"13:20\":3,\"13:30\":3,\"13:40\":3,\"13:50\":3,\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3,\"16:10\":3,\"16:20\":3,\"16:30\":3,\"16:40\":3,\"16:50\":3,\"17:00\":3,\"17:10\":3,\"17:20\":3,\"17:30\":3,\"17:40\":3,\"17:50\":3,\"18:00\":3}', 0, 3, '[1,2,3]', 1, 0),
(41, 'OA659f811946a556.03984573', 'IEC', 'hall09', 'XYZ', '2024-01-15', '2024-02-03', '08:00:00', '18:00:00', '2024-02-03', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3,\"10:10\":3,\"10:20\":3,\"10:30\":3,\"10:40\":3,\"10:50\":3,\"11:00\":3,\"11:10\":3,\"11:20\":3,\"11:30\":3,\"11:40\":3,\"11:50\":3,\"12:00\":3,\"12:10\":3,\"12:20\":3,\"12:30\":3,\"12:40\":3,\"12:50\":3,\"13:00\":3,\"13:10\":3,\"13:20\":3,\"13:30\":3,\"13:40\":3,\"13:50\":3,\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3,\"16:10\":3,\"16:20\":3,\"16:30\":3,\"16:40\":3,\"16:50\":3,\"17:00\":3,\"17:10\":3,\"17:20\":3,\"17:30\":3,\"17:40\":3,\"17:50\":3,\"18:00\":3}', 0, 3, '[1,2,3]', 1, 0),
(42, 'OA659f83f89fdcd6.51463346', 'IF', 'hall04', 'Test', '2024-01-11', '2024-01-14', '08:00:00', '18:00:00', '2024-01-11', '{\"08:00\":2,\"08:10\":2,\"08:20\":2,\"08:30\":2,\"08:40\":2,\"08:50\":2,\"09:00\":2,\"09:10\":2,\"09:20\":2,\"09:30\":2,\"09:40\":2,\"09:50\":2,\"10:00\":2,\"10:10\":2,\"10:20\":2,\"10:30\":2,\"10:40\":2,\"10:50\":2,\"11:00\":2,\"11:10\":2,\"11:20\":2,\"11:30\":2,\"11:40\":2,\"11:50\":2,\"12:00\":2,\"12:10\":2,\"12:20\":2,\"12:30\":2,\"12:40\":2,\"12:50\":2,\"13:00\":2,\"13:10\":2,\"13:20\":2,\"13:30\":2,\"13:40\":2,\"13:50\":2,\"14:00\":2,\"14:10\":2,\"14:20\":2,\"14:30\":2,\"14:40\":2,\"14:50\":2,\"15:00\":2,\"15:10\":2,\"15:20\":2,\"15:30\":2,\"15:40\":2,\"15:50\":2,\"16:00\":2,\"16:10\":2,\"16:20\":2,\"16:30\":2,\"16:40\":2,\"16:50\":2,\"17:00\":2,\"17:10\":2,\"17:20\":2,\"17:30\":2,\"17:40\":2,\"17:50\":2,\"18:00\":2}', 0, 2, '[1,2,3]', 1, 0),
(42, 'OA659f83f89fdcd6.51463346', 'IF', 'hall04', 'Test', '2024-01-11', '2024-01-14', '08:00:00', '18:00:00', '2024-01-12', '{\"08:00\": 2, \"08:10\": 2, \"08:20\": 2, \"08:30\": 2, \"08:40\": 2, \"08:50\": 2, \"09:00\": 2, \"09:10\": 2, \"09:20\": 2, \"09:30\": 2, \"09:40\": 2, \"09:50\": 2, \"10:00\": 1, \"10:10\": 1, \"10:20\": 1, \"10:30\": 1, \"10:40\": 1, \"10:50\": 1, \"11:00\": 1, \"11:10\": 1, \"11:20\": 1, \"11:30\": 1, \"11:40\": 2, \"11:50\": 2, \"12:00\": 2, \"12:10\": 2, \"12:20\": 2, \"12:30\": 2, \"12:40\": 2, \"12:50\": 2, \"13:00\": 2, \"13:10\": 2, \"13:20\": 2, \"13:30\": 2, \"13:40\": 2, \"13:50\": 2, \"14:00\": 2, \"14:10\": 2, \"14:20\": 2, \"14:30\": 2, \"14:40\": 2, \"14:50\": 2, \"15:00\": 2, \"15:10\": 2, \"15:20\": 2, \"15:30\": 2, \"15:40\": 2, \"15:50\": 2, \"16:00\": 2, \"16:10\": 2, \"16:20\": 2, \"16:30\": 2, \"16:40\": 2, \"16:50\": 2, \"17:00\": 2, \"17:10\": 2, \"17:20\": 2, \"17:30\": 2, \"17:40\": 2, \"17:50\": 2, \"18:00\": 2}', 0, 2, '[1,2,3]', 1, 0),
(42, 'OA659f83f89fdcd6.51463346', 'IF', 'hall04', 'Test', '2024-01-11', '2024-01-14', '08:00:00', '18:00:00', '2024-01-13', '{\"08:00\":2,\"08:10\":2,\"08:20\":2,\"08:30\":2,\"08:40\":2,\"08:50\":2,\"09:00\":2,\"09:10\":2,\"09:20\":2,\"09:30\":2,\"09:40\":2,\"09:50\":2,\"10:00\":2,\"10:10\":2,\"10:20\":2,\"10:30\":2,\"10:40\":2,\"10:50\":2,\"11:00\":2,\"11:10\":2,\"11:20\":2,\"11:30\":2,\"11:40\":2,\"11:50\":2,\"12:00\":2,\"12:10\":2,\"12:20\":2,\"12:30\":2,\"12:40\":2,\"12:50\":2,\"13:00\":2,\"13:10\":2,\"13:20\":2,\"13:30\":2,\"13:40\":2,\"13:50\":2,\"14:00\":2,\"14:10\":2,\"14:20\":2,\"14:30\":2,\"14:40\":2,\"14:50\":2,\"15:00\":2,\"15:10\":2,\"15:20\":2,\"15:30\":2,\"15:40\":2,\"15:50\":2,\"16:00\":2,\"16:10\":2,\"16:20\":2,\"16:30\":2,\"16:40\":2,\"16:50\":2,\"17:00\":2,\"17:10\":2,\"17:20\":2,\"17:30\":2,\"17:40\":2,\"17:50\":2,\"18:00\":2}', 0, 2, '[1,2,3]', 1, 0),
(42, 'OA659f83f89fdcd6.51463346', 'IF', 'hall04', 'Test', '2024-01-11', '2024-01-14', '08:00:00', '18:00:00', '2024-01-14', '{\"08:00\":2,\"08:10\":2,\"08:20\":2,\"08:30\":2,\"08:40\":2,\"08:50\":2,\"09:00\":2,\"09:10\":2,\"09:20\":2,\"09:30\":2,\"09:40\":2,\"09:50\":2,\"10:00\":2,\"10:10\":2,\"10:20\":2,\"10:30\":2,\"10:40\":2,\"10:50\":2,\"11:00\":2,\"11:10\":2,\"11:20\":2,\"11:30\":2,\"11:40\":2,\"11:50\":2,\"12:00\":2,\"12:10\":2,\"12:20\":2,\"12:30\":2,\"12:40\":2,\"12:50\":2,\"13:00\":2,\"13:10\":2,\"13:20\":2,\"13:30\":2,\"13:40\":2,\"13:50\":2,\"14:00\":2,\"14:10\":2,\"14:20\":2,\"14:30\":2,\"14:40\":2,\"14:50\":2,\"15:00\":2,\"15:10\":2,\"15:20\":2,\"15:30\":2,\"15:40\":2,\"15:50\":2,\"16:00\":2,\"16:10\":2,\"16:20\":2,\"16:30\":2,\"16:40\":2,\"16:50\":2,\"17:00\":2,\"17:10\":2,\"17:20\":2,\"17:30\":2,\"17:40\":2,\"17:50\":2,\"18:00\":2}', 0, 2, '[1,2,3]', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role`
--

CREATE TABLE `tbl_role` (
  `role_id` varchar(10) NOT NULL COMMENT 'admin, super, user',
  `role_name` varchar(255) NOT NULL COMMENT 'Admin, Superuser, Users,',
  `create_by` varchar(25) NOT NULL,
  `create_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `update_by` varchar(25) NOT NULL,
  `update_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_role`
--

INSERT INTO `tbl_role` (`role_id`, `role_name`, `create_by`, `create_datetime`, `update_by`, `update_datetime`, `is_active`, `is_deleted`) VALUES
('admin', 'Administrator', '', '2023-08-07 11:52:40', '', '2023-08-07 11:52:40', 1, 0),
('member', 'Member', '', '2023-08-16 12:49:49', '', '2023-08-16 12:49:49', 1, 0),
('mgr', 'Manager', '', '2023-08-07 11:53:02', '', '2023-08-07 11:53:02', 1, 0),
('superuser', 'Super User', '', '2023-08-07 11:53:21', '', '2023-08-07 11:53:21', 1, 0),
('user', 'Users', '', '2023-08-07 11:52:53', '', '2023-08-07 13:33:58', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `line_id` varchar(255) DEFAULT NULL,
  `line_user_id` varchar(33) DEFAULT NULL,
  `role_id` varchar(10) NOT NULL DEFAULT 'user',
  `department_id` varchar(10) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `create_by` varchar(25) NOT NULL,
  `create_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `update_by` varchar(25) NOT NULL,
  `update_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`username`, `password`, `fullname`, `line_id`, `line_user_id`, `role_id`, `department_id`, `phone`, `email`, `create_by`, `create_datetime`, `update_by`, `update_datetime`, `is_active`, `is_deleted`) VALUES
('admin', 'admin', 'Administrator', '', NULL, 'admin', 'ITD', '0628793650', 'nathapats@impact.co.th', '', '2023-08-07 14:53:53', '', '2023-08-07 14:53:53', 1, 0),
('nathapats', 'db99br0on', 'ณัฏฐพัชร สุนทรเพิ่มทรัพย์', '0897995769', 'U749f9114c302b60d04acdfcf8e430d1f', 'admin', 'ITD', '0628793650', 'nathapats@impact.co.th', '', '2023-08-07 16:46:50', '', '2023-08-09 14:47:37', 1, 0),
('poj11', '1111', 'Kittipoj Soontornpurmsap', '', 'U7a2c24d345d2667c442c95c3a34ba241', 'user', 'ITD', '012345678', 'poj11@hotmail.com', '', '2023-08-07 17:22:14', '', '2023-08-09 16:06:25', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  ADD PRIMARY KEY (`id`,`open_id`) USING BTREE,
  ADD UNIQUE KEY `booking_idx` (`username`,`car_license_number`,`booking_date`,`booking_time`,`queue_number`,`id`,`open_id`) USING BTREE;

--
-- Indexes for table `tbl_building`
--
ALTER TABLE `tbl_building`
  ADD PRIMARY KEY (`building_id`),
  ADD UNIQUE KEY `area_name` (`building_name`);

--
-- Indexes for table `tbl_car_registration`
--
ALTER TABLE `tbl_car_registration`
  ADD PRIMARY KEY (`username`,`car_registration`,`event_id`,`booking_date`,`booking_time`);

--
-- Indexes for table `tbl_car_type`
--
ALTER TABLE `tbl_car_type`
  ADD PRIMARY KEY (`car_type_id`),
  ADD UNIQUE KEY `car_type_name` (`car_type_name`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `tbl_department`
--
ALTER TABLE `tbl_department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `tbl_event`
--
ALTER TABLE `tbl_event`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `tbl_hall`
--
ALTER TABLE `tbl_hall`
  ADD PRIMARY KEY (`hall_id`,`building_id`) USING BTREE;

--
-- Indexes for table `tbl_member`
--
ALTER TABLE `tbl_member`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `tbl_open_area_schedule_detail`
--
ALTER TABLE `tbl_open_area_schedule_detail`
  ADD PRIMARY KEY (`id`,`open_date_start`,`open_date_end`,`open_time_start`,`open_time_end`);

--
-- Indexes for table `tbl_open_area_schedule_header`
--
ALTER TABLE `tbl_open_area_schedule_header`
  ADD PRIMARY KEY (`open_id`);

--
-- Indexes for table `tbl_open_area_schedule_sub_detail`
--
ALTER TABLE `tbl_open_area_schedule_sub_detail`
  ADD PRIMARY KEY (`id`,`open_date`,`open_time`);

--
-- Indexes for table `tbl_role`
--
ALTER TABLE `tbl_role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_car_type`
--
ALTER TABLE `tbl_car_type`
  MODIFY `car_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_open_area_schedule_header`
--
ALTER TABLE `tbl_open_area_schedule_header`
  MODIFY `open_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- Database: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Table structure for table `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) NOT NULL DEFAULT '',
  `user` varchar(255) NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `query` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Table structure for table `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) NOT NULL,
  `col_name` varchar(64) NOT NULL,
  `col_type` varchar(64) NOT NULL,
  `col_length` text DEFAULT NULL,
  `col_collation` varchar(64) NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) DEFAULT '',
  `col_default` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Table structure for table `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `column_name` varchar(64) NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `transformation` varchar(255) NOT NULL DEFAULT '',
  `transformation_options` varchar(255) NOT NULL DEFAULT '',
  `input_transformation` varchar(255) NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) NOT NULL,
  `settings_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Table structure for table `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL,
  `export_type` varchar(10) NOT NULL,
  `template_name` varchar(64) NOT NULL,
  `template_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Table structure for table `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Table structure for table `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db` varchar(64) NOT NULL DEFAULT '',
  `table` varchar(64) NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) NOT NULL,
  `item_name` varchar(64) NOT NULL,
  `item_type` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Table structure for table `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Dumping data for table `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"carstaging_db\",\"table\":\"tbl_booking\"},{\"db\":\"carstaging_db\",\"table\":\"tbl_open_area_schedule_sub_details\"},{\"db\":\"carstaging_db\",\"table\":\"tbl_open_area_schedule_sub_detail\"},{\"db\":\"carstaging_db\",\"table\":\"tbl_hall\"},{\"db\":\"carstaging_db\",\"table\":\"tbl_open_area_schedule_header\"},{\"db\":\"carstaging_db\",\"table\":\"tbl_open_area_schedule_detail\"},{\"db\":\"carstaging_db\",\"table\":\"tbl_building\"},{\"db\":\"carstaging_db\",\"table\":\"tbl_car_type\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) NOT NULL DEFAULT '',
  `master_table` varchar(64) NOT NULL DEFAULT '',
  `master_field` varchar(64) NOT NULL DEFAULT '',
  `foreign_db` varchar(64) NOT NULL DEFAULT '',
  `foreign_table` varchar(64) NOT NULL DEFAULT '',
  `foreign_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Table structure for table `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `search_name` varchar(64) NOT NULL DEFAULT '',
  `search_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `display_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `prefs` text NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

-- --------------------------------------------------------

--
-- Table structure for table `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text NOT NULL,
  `schema_sql` text DEFAULT NULL,
  `data_sql` longtext DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Dumping data for table `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2024-01-22 10:12:10', '{\"Console\\/Mode\":\"collapse\"}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) NOT NULL,
  `tab` varchar(64) NOT NULL,
  `allowed` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Table structure for table `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) NOT NULL,
  `usergroup` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indexes for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indexes for table `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indexes for table `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indexes for table `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indexes for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indexes for table `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indexes for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indexes for table `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indexes for table `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indexes for table `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indexes for table `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indexes for table `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indexes for table `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Database: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
