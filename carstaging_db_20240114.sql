-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2024 at 11:10 AM
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
  `time_in_area` time DEFAULT NULL COMMENT 'เวลาที่เข้ามาในพื้นที่(เข้ามาใน Impact)',
  `time_out_area` time DEFAULT NULL COMMENT 'เวลาที่ออกนอกพื้นที่(ออกจาก Impact)',
  `time_in` time DEFAULT NULL COMMENT 'เวลาที่เข้าใน Loading(time_in_loading)',
  `time_out` time DEFAULT NULL COMMENT 'เวลาที่ออกจาก Loading(time_out_loading)',
  `time_1st_alert` time DEFAULT NULL COMMENT 'เวลาการแจ้ง alert ครั้งที่ 1 ก่อนเวลา booking 30 นาที',
  `time_2nd_alert` time DEFAULT NULL COMMENT 'เวลาการแจ้ง alert ครั้งที่ 2 ก่อนเวลา booking 15 นาที',
  `time_3rd_alert` time DEFAULT NULL COMMENT 'เวลาการแจ้ง alert ให้เข้า Loading',
  `time_accept` time DEFAULT NULL COMMENT 'เวลาที่ตอบกลับจากการ alert เรียกให้เข้า Loading(ครั้งที่ 3)',
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

INSERT INTO `tbl_booking` (`id`, `username`, `car_license_number`, `car_type_id`, `open_id`, `boot`, `building_id`, `hall_id`, `driver_name`, `driver_phone`, `booking_date`, `booking_time`, `booking_time_json`, `queue_number`, `running_number`, `booking_data`, `qr_code_image`, `ref_id`, `ref_json`, `status`, `parking_rate`, `take_time_minutes`, `time_in_area`, `time_out_area`, `time_in`, `time_out`, `time_1st_alert`, `time_2nd_alert`, `time_3rd_alert`, `time_accept`, `parking_time`, `parking_overtime`, `parking_overtime_hours`, `parking_fee`, `is_active`, `is_deleted`) VALUES
('ID65c8eabccfa4a6.25281903', 'U004f3c6e382c5d0d0f56d59bfec97bc5', '4กส9798', '1', 43, '123', 'CH', 'hall01', 'พจน์', '0628793333', '2024-02-12', '08:00:00', '{\"08:00\":1,\"08:10\":1,\"08:20\":1,\"08:30\":1}', '0800_0001', '0001', '', '', '43CHhall012024-02-1208:000001', '{\"id\":\"ID65c8eabccfa4a6.25281903\",\"ทะเบียนรถ\":\"4กส9798\",\"ชื่องาน\":\"cha_hall1_5\",\"รหัสอาคาร\":\"CH\",\"ชื่ออาคาร\":\"Challenger\",\"พื้นที่\":\"Hall 1\",\"เลขคิว\":\"0800_0001\",\"ประเภทรถ\":\"รถ 4 ล้อ\",\"วันที่จอง\":\"2024-02-12\",\"เวลาจอง\":\"08:00\",\"เวลาที่ใช้\":40,\"ค่าปรับ\":\"400\"}', 0, 400, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 0),
('ID65c8ead03f8cd7.25899242', 'U004f3c6e382c5d0d0f56d59bfec97bc5', '4กส9798', '1', 43, '123', 'CH', 'hall01', 'พจน์', '0628793333', '2024-02-12', '12:00:00', '{\"12:00\":1,\"12:10\":1,\"12:20\":1,\"12:30\":1}', '1200_0001', '0001', '', '', '43CHhall012024-02-1212:000001', '{\"id\":\"ID65c8ead03f8cd7.25899242\",\"ทะเบียนรถ\":\"4กส9798\",\"ชื่องาน\":\"cha_hall1_5\",\"รหัสอาคาร\":\"CH\",\"ชื่ออาคาร\":\"Challenger\",\"พื้นที่\":\"Hall 1\",\"เลขคิว\":\"1200_0001\",\"ประเภทรถ\":\"รถ 4 ล้อ\",\"วันที่จอง\":\"2024-02-12\",\"เวลาจอง\":\"12:00\",\"เวลาที่ใช้\":40,\"ค่าปรับ\":\"400\"}', 0, 400, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 0),
('ID65c8eaddda6ee5.52409392', 'U004f3c6e382c5d0d0f56d59bfec97bc5', '4กส9798', '1', 43, '123', 'CH', 'hall01', 'พจน์', '0628793333', '2024-02-13', '09:00:00', '{\"09:00\":1,\"09:10\":1,\"09:20\":1,\"09:30\":1}', '0900_0001', '0001', '', '', '43CHhall012024-02-1309:000001', '{\"id\":\"ID65c8eaddda6ee5.52409392\",\"ทะเบียนรถ\":\"4กส9798\",\"ชื่องาน\":\"cha_hall1_5\",\"รหัสอาคาร\":\"CH\",\"ชื่ออาคาร\":\"Challenger\",\"พื้นที่\":\"Hall 1\",\"เลขคิว\":\"0900_0001\",\"ประเภทรถ\":\"รถ 4 ล้อ\",\"วันที่จอง\":\"2024-02-13\",\"เวลาจอง\":\"09:00\",\"เวลาที่ใช้\":40,\"ค่าปรับ\":\"400\"}', 0, 400, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 0),
('ID65c8eaec02daf5.48463223', 'U004f3c6e382c5d0d0f56d59bfec97bc5', '4กส9798', '1', 43, '123', 'CH', 'hall01', 'พจน์', '0628793333', '2024-02-13', '13:00:00', '{\"13:00\":1,\"13:10\":1,\"13:20\":1,\"13:30\":1}', '1300_0001', '0001', '', '', '43CHhall012024-02-1313:000001', '{\"id\":\"ID65c8eaec02daf5.48463223\",\"ทะเบียนรถ\":\"4กส9798\",\"ชื่องาน\":\"cha_hall1_5\",\"รหัสอาคาร\":\"CH\",\"ชื่ออาคาร\":\"Challenger\",\"พื้นที่\":\"Hall 1\",\"เลขคิว\":\"1300_0001\",\"ประเภทรถ\":\"รถ 4 ล้อ\",\"วันที่จอง\":\"2024-02-13\",\"เวลาจอง\":\"13:00\",\"เวลาที่ใช้\":40,\"ค่าปรับ\":\"400\"}', 0, 400, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 0),
('ID65c8eb02dba844.72394661', 'U004f3c6e382c5d0d0f56d59bfec97bc5', '4กส9798', '1', 43, '123', 'CH', 'hall01', 'พจน์', '0628793333', '2024-02-14', '09:30:00', '{\"09:30\":1,\"09:40\":1,\"09:50\":1,\"10:00\":1}', '0930_0001', '0001', '', '', '43CHhall012024-02-1409:300001', '{\"id\":\"ID65c8eb02dba844.72394661\",\"ทะเบียนรถ\":\"4กส9798\",\"ชื่องาน\":\"cha_hall1_5\",\"รหัสอาคาร\":\"CH\",\"ชื่ออาคาร\":\"Challenger\",\"พื้นที่\":\"Hall 1\",\"เลขคิว\":\"0930_0001\",\"ประเภทรถ\":\"รถ 4 ล้อ\",\"วันที่จอง\":\"2024-02-14\",\"เวลาจอง\":\"09:30\",\"เวลาที่ใช้\":40,\"ค่าปรับ\":\"400\"}', 0, 400, 40, NULL, NULL, NULL, NULL, '14:30:00', '14:30:00', '16:30:00', NULL, NULL, NULL, 0, 0, 1, 0),
('ID65c8eb0be48442.69654486', 'U004f3c6e382c5d0d0f56d59bfec97bc5', '4กส9798', '1', 43, '123', 'CH', 'hall01', 'พจน์', '0628793333', '2024-02-15', '10:00:00', '{\"10:00\":1,\"10:10\":1,\"10:20\":1,\"10:30\":1}', '1000_0001', '0001', '', '', '43CHhall012024-02-1510:000001', '{\"id\":\"ID65c8eb0be48442.69654486\",\"ทะเบียนรถ\":\"4กส9798\",\"ชื่องาน\":\"cha_hall1_5\",\"รหัสอาคาร\":\"CH\",\"ชื่ออาคาร\":\"Challenger\",\"พื้นที่\":\"Hall 1\",\"เลขคิว\":\"1000_0001\",\"ประเภทรถ\":\"รถ 4 ล้อ\",\"วันที่จอง\":\"2024-02-15\",\"เวลาจอง\":\"10:00\",\"เวลาที่ใช้\":40,\"ค่าปรับ\":\"400\"}', 0, 400, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 0),
('ID65c8eb4f0ff563.93409862', 'U004f3c6e382c5d0d0f56d59bfec97bc5', '80-888888', '3', 43, '123', 'CH', 'hall01', 'Sobo', '0123456789', '2024-02-12', '08:00:00', '{\"08:00\":1,\"08:10\":1,\"08:20\":1,\"08:30\":1,\"08:40\":1,\"08:50\":1,\"09:00\":1,\"09:10\":1,\"09:20\":1,\"09:30\":1}', '0800_0002', '0002', '', '', '43CHhall012024-02-1208:000002', '{\"id\":\"ID65c8eb4f0ff563.93409862\",\"ทะเบียนรถ\":\"80-888888\",\"ชื่องาน\":\"cha_hall1_5\",\"รหัสอาคาร\":\"CH\",\"ชื่ออาคาร\":\"Challenger\",\"พื้นที่\":\"Hall 1\",\"เลขคิว\":\"0800_0002\",\"ประเภทรถ\":\"รถ 10 ล้อ\",\"วันที่จอง\":\"2024-02-12\",\"เวลาจอง\":\"08:00\",\"เวลาที่ใช้\":100,\"ค่าปรับ\":\"1000\"}', 0, 1000, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 0),
('ID65c8eb5a6819f8.63131855', 'U004f3c6e382c5d0d0f56d59bfec97bc5', '80-888888', '3', 43, '123', 'CH', 'hall01', 'Sobo', '0123456789', '2024-02-13', '08:30:00', '{\"08:30\":1,\"08:40\":1,\"08:50\":1,\"09:00\":1,\"09:10\":1,\"09:20\":1,\"09:30\":1,\"09:40\":1,\"09:50\":1,\"10:00\":1}', '0830_0001', '0001', '', '', '43CHhall012024-02-1308:300001', '{\"id\":\"ID65c8eb5a6819f8.63131855\",\"ทะเบียนรถ\":\"80-888888\",\"ชื่องาน\":\"cha_hall1_5\",\"รหัสอาคาร\":\"CH\",\"ชื่ออาคาร\":\"Challenger\",\"พื้นที่\":\"Hall 1\",\"เลขคิว\":\"0830_0001\",\"ประเภทรถ\":\"รถ 10 ล้อ\",\"วันที่จอง\":\"2024-02-13\",\"เวลาจอง\":\"08:30\",\"เวลาที่ใช้\":100,\"ค่าปรับ\":\"1000\"}', 0, 1000, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 0),
('ID65c8eb629ec812.50345456', 'U004f3c6e382c5d0d0f56d59bfec97bc5', '80-888888', '3', 43, '123', 'CH', 'hall01', 'Sobo', '0123456789', '2024-02-14', '09:00:00', '{\"09:00\":1,\"09:10\":1,\"09:20\":1,\"09:30\":1,\"09:40\":1,\"09:50\":1,\"10:00\":1,\"10:10\":1,\"10:20\":1,\"10:30\":1}', '0900_0001', '0001', '', '', '43CHhall012024-02-1409:000001', '{\"id\":\"ID65c8eb629ec812.50345456\",\"ทะเบียนรถ\":\"80-888888\",\"ชื่องาน\":\"cha_hall1_5\",\"รหัสอาคาร\":\"CH\",\"ชื่ออาคาร\":\"Challenger\",\"พื้นที่\":\"Hall 1\",\"เลขคิว\":\"0900_0001\",\"ประเภทรถ\":\"รถ 10 ล้อ\",\"วันที่จอง\":\"2024-02-14\",\"เวลาจอง\":\"09:00\",\"เวลาที่ใช้\":100,\"ค่าปรับ\":\"1000\"}', 0, 1000, 100, NULL, NULL, NULL, NULL, '14:30:00', '14:30:00', '16:30:00', NULL, NULL, NULL, 0, 0, 1, 0),
('ID65c8eb6b6bc301.33345891', 'U004f3c6e382c5d0d0f56d59bfec97bc5', '80-888888', '3', 43, '123', 'CH', 'hall01', 'Sobo', '0123456789', '2024-02-15', '08:00:00', '{\"08:00\":1,\"08:10\":1,\"08:20\":1,\"08:30\":1,\"08:40\":1,\"08:50\":1,\"09:00\":1,\"09:10\":1,\"09:20\":1,\"09:30\":1}', '0800_0001', '0001', '', '', '43CHhall012024-02-1508:000001', '{\"id\":\"ID65c8eb6b6bc301.33345891\",\"ทะเบียนรถ\":\"80-888888\",\"ชื่องาน\":\"cha_hall1_5\",\"รหัสอาคาร\":\"CH\",\"ชื่ออาคาร\":\"Challenger\",\"พื้นที่\":\"Hall 1\",\"เลขคิว\":\"0800_0001\",\"ประเภทรถ\":\"รถ 10 ล้อ\",\"วันที่จอง\":\"2024-02-15\",\"เวลาจอง\":\"08:00\",\"เวลาที่ใช้\":100,\"ค่าปรับ\":\"1000\"}', 0, 1000, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 0),
('ID65c8eb8de83bc7.07312807', 'U004f3c6e382c5d0d0f56d59bfec97bc5', '10-666666', '2', 43, '123', 'CH', 'hall01', 'Mac', '0123456789', '2024-02-12', '10:00:00', '{\"10:00\":1,\"10:10\":1,\"10:20\":1,\"10:30\":1,\"10:40\":1,\"10:50\":1}', '1000_0001', '0001', '', '', '43CHhall012024-02-1210:000001', '{\"id\":\"ID65c8eb8de83bc7.07312807\",\"ทะเบียนรถ\":\"10-666666\",\"ชื่องาน\":\"cha_hall1_5\",\"รหัสอาคาร\":\"CH\",\"ชื่ออาคาร\":\"Challenger\",\"พื้นที่\":\"Hall 1\",\"เลขคิว\":\"1000_0001\",\"ประเภทรถ\":\"รถ 6 ล้อ\",\"วันที่จอง\":\"2024-02-12\",\"เวลาจอง\":\"10:00\",\"เวลาที่ใช้\":60,\"ค่าปรับ\":\"600\"}', 0, 600, 60, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 0),
('ID65c8eb96072905.81932042', 'U004f3c6e382c5d0d0f56d59bfec97bc5', '10-666666', '2', 43, '123', 'CH', 'hall01', 'Mac', '0123456789', '2024-02-13', '10:00:00', '{\"10:00\":1,\"10:10\":1,\"10:20\":1,\"10:30\":1,\"10:40\":1,\"10:50\":1}', '1000_0001', '0001', '', '', '43CHhall012024-02-1310:000001', '{\"id\":\"ID65c8eb96072905.81932042\",\"ทะเบียนรถ\":\"10-666666\",\"ชื่องาน\":\"cha_hall1_5\",\"รหัสอาคาร\":\"CH\",\"ชื่ออาคาร\":\"Challenger\",\"พื้นที่\":\"Hall 1\",\"เลขคิว\":\"1000_0001\",\"ประเภทรถ\":\"รถ 6 ล้อ\",\"วันที่จอง\":\"2024-02-13\",\"เวลาจอง\":\"10:00\",\"เวลาที่ใช้\":60,\"ค่าปรับ\":\"600\"}', 0, 600, 60, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 0),
('ID65c8eb9c5dbc02.92429892', 'U004f3c6e382c5d0d0f56d59bfec97bc5', '10-666666', '2', 43, '123', 'CH', 'hall01', 'Mac', '0123456789', '2024-02-14', '10:00:00', '{\"10:00\":1,\"10:10\":1,\"10:20\":1,\"10:30\":1,\"10:40\":1,\"10:50\":1}', '1000_0001', '0001', '', '', '43CHhall012024-02-1410:000001', '{\"id\":\"ID65c8eb9c5dbc02.92429892\",\"ทะเบียนรถ\":\"10-666666\",\"ชื่องาน\":\"cha_hall1_5\",\"รหัสอาคาร\":\"CH\",\"ชื่ออาคาร\":\"Challenger\",\"พื้นที่\":\"Hall 1\",\"เลขคิว\":\"1000_0001\",\"ประเภทรถ\":\"รถ 6 ล้อ\",\"วันที่จอง\":\"2024-02-14\",\"เวลาจอง\":\"10:00\",\"เวลาที่ใช้\":60,\"ค่าปรับ\":\"600\"}', 0, 600, 60, NULL, NULL, NULL, NULL, '14:30:00', '14:30:00', '16:30:00', NULL, NULL, NULL, 0, 0, 1, 0),
('ID65c8eba28a8f14.36393667', 'U004f3c6e382c5d0d0f56d59bfec97bc5', '10-666666', '2', 43, '123', 'CH', 'hall01', 'Mac', '0123456789', '2024-02-15', '10:00:00', '{\"10:00\":1,\"10:10\":1,\"10:20\":1,\"10:30\":1,\"10:40\":1,\"10:50\":1}', '1000_0002', '0002', '', '', '43CHhall012024-02-1510:000002', '{\"id\":\"ID65c8eba28a8f14.36393667\",\"ทะเบียนรถ\":\"10-666666\",\"ชื่องาน\":\"cha_hall1_5\",\"รหัสอาคาร\":\"CH\",\"ชื่ออาคาร\":\"Challenger\",\"พื้นที่\":\"Hall 1\",\"เลขคิว\":\"1000_0002\",\"ประเภทรถ\":\"รถ 6 ล้อ\",\"วันที่จอง\":\"2024-02-15\",\"เวลาจอง\":\"10:00\",\"เวลาที่ใช้\":60,\"ค่าปรับ\":\"600\"}', 0, 600, 60, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 0),
('ID65c8ebc7b33334.58289212', 'U004f3c6e382c5d0d0f56d59bfec97bc5', '10-60000', '2', 43, '123', 'CH', 'hall01', 'Endo', '0123456789', '2024-02-12', '08:00:00', '{\"08:00\":1,\"08:10\":1,\"08:20\":1,\"08:30\":1,\"08:40\":1,\"08:50\":1}', '0800_0003', '0003', '', '', '43CHhall012024-02-1208:000003', '{\"id\":\"ID65c8ebc7b33334.58289212\",\"ทะเบียนรถ\":\"10-60000\",\"ชื่องาน\":\"cha_hall1_5\",\"รหัสอาคาร\":\"CH\",\"ชื่ออาคาร\":\"Challenger\",\"พื้นที่\":\"Hall 1\",\"เลขคิว\":\"0800_0003\",\"ประเภทรถ\":\"รถ 6 ล้อ\",\"วันที่จอง\":\"2024-02-12\",\"เวลาจอง\":\"08:00\",\"เวลาที่ใช้\":60,\"ค่าปรับ\":\"600\"}', 0, 600, 60, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 0),
('ID65c8ebcfaaa531.47259813', 'U004f3c6e382c5d0d0f56d59bfec97bc5', '10-60000', '2', 43, '123', 'CH', 'hall01', 'Endo', '0123456789', '2024-02-13', '09:00:00', '{\"09:00\":1,\"09:10\":1,\"09:20\":1,\"09:30\":1,\"09:40\":1,\"09:50\":1}', '0900_0002', '0002', '', '', '43CHhall012024-02-1309:000002', '{\"id\":\"ID65c8ebcfaaa531.47259813\",\"ทะเบียนรถ\":\"10-60000\",\"ชื่องาน\":\"cha_hall1_5\",\"รหัสอาคาร\":\"CH\",\"ชื่ออาคาร\":\"Challenger\",\"พื้นที่\":\"Hall 1\",\"เลขคิว\":\"0900_0002\",\"ประเภทรถ\":\"รถ 6 ล้อ\",\"วันที่จอง\":\"2024-02-13\",\"เวลาจอง\":\"09:00\",\"เวลาที่ใช้\":60,\"ค่าปรับ\":\"600\"}', 0, 600, 60, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 0),
('ID65cb0dfbe00a34.95120064', 'cust1', '1 กก 1234', '1', 43, '001', 'CH', 'hall01', 'คนที่ 1', '1234567890', '2024-02-15', '08:00:00', '{\"08:00\":1,\"08:10\":1,\"08:20\":1,\"08:30\":1}', '0800_0002', '0002', '', '', '43CHhall012024-02-1508:000002', '{\"id\":\"ID65cb0dfbe00a34.95120064\",\"ทะเบียนรถ\":\"1 กก 1234\",\"ชื่องาน\":\"cha_hall1_5\",\"รหัสอาคาร\":\"CH\",\"ชื่ออาคาร\":\"Challenger\",\"พื้นที่\":\"Hall 1\",\"เลขคิว\":\"0800_0002\",\"ประเภทรถ\":\"รถ 4 ล้อ\",\"วันที่จอง\":\"2024-02-15\",\"เวลาจอง\":\"08:00\",\"เวลาที่ใช้\":40,\"ค่าปรับ\":\"400\"}', 0, 400, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 0),
('ID65cb0e20000278.08212486', 'cust1', '1 กก 1235', '1', 43, '001', 'CH', 'hall01', 'คนที่ 2', '1234567890', '2024-02-15', '08:00:00', '{\"08:00\":1,\"08:10\":1,\"08:20\":1,\"08:30\":1}', '0800_0003', '0003', '', '', '43CHhall012024-02-1508:000003', '{\"id\":\"ID65cb0e20000278.08212486\",\"ทะเบียนรถ\":\"1 กก 1235\",\"ชื่องาน\":\"cha_hall1_5\",\"รหัสอาคาร\":\"CH\",\"ชื่ออาคาร\":\"Challenger\",\"พื้นที่\":\"Hall 1\",\"เลขคิว\":\"0800_0003\",\"ประเภทรถ\":\"รถ 4 ล้อ\",\"วันที่จอง\":\"2024-02-15\",\"เวลาจอง\":\"08:00\",\"เวลาที่ใช้\":40,\"ค่าปรับ\":\"400\"}', 0, 400, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 0),
('ID65cb0e34838799.52834040', 'cust1', '1 กก 1236', '2', 43, '001', 'CH', 'hall01', 'คนที่ 3', '1234567890', '2024-02-15', '08:00:00', '{\"08:00\":1,\"08:10\":1,\"08:20\":1,\"08:30\":1,\"08:40\":1,\"08:50\":1}', '0800_0004', '0004', '', '', '43CHhall012024-02-1508:000004', '{\"id\":\"ID65cb0e34838799.52834040\",\"ทะเบียนรถ\":\"1 กก 1236\",\"ชื่องาน\":\"cha_hall1_5\",\"รหัสอาคาร\":\"CH\",\"ชื่ออาคาร\":\"Challenger\",\"พื้นที่\":\"Hall 1\",\"เลขคิว\":\"0800_0004\",\"ประเภทรถ\":\"รถ 6 ล้อ\",\"วันที่จอง\":\"2024-02-15\",\"เวลาจอง\":\"08:00\",\"เวลาที่ใช้\":60,\"ค่าปรับ\":\"600\"}', 0, 600, 60, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 0),
('ID65cb0e45624675.23524444', 'cust1', '1 กก 1237', '2', 43, '001', 'CH', 'hall01', 'คนที่ 4', '1234567890', '2024-02-15', '10:00:00', '{\"10:00\":1,\"10:10\":1,\"10:20\":1,\"10:30\":1,\"10:40\":1,\"10:50\":1}', '1000_0003', '0003', '', '', '43CHhall012024-02-1510:000003', '{\"id\":\"ID65cb0e45624675.23524444\",\"ทะเบียนรถ\":\"1 กก 1237\",\"ชื่องาน\":\"cha_hall1_5\",\"รหัสอาคาร\":\"CH\",\"ชื่ออาคาร\":\"Challenger\",\"พื้นที่\":\"Hall 1\",\"เลขคิว\":\"1000_0003\",\"ประเภทรถ\":\"รถ 6 ล้อ\",\"วันที่จอง\":\"2024-02-15\",\"เวลาจอง\":\"10:00\",\"เวลาที่ใช้\":60,\"ค่าปรับ\":\"600\"}', 0, 600, 60, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 0),
('ID65cc387cf17f37.38203713', 'cust1', '10-123456', '2', 43, '201', 'CH', 'hall01', 'Vin', '1234567890', '2024-02-14', '11:30:00', '{\"11:30\":1,\"11:40\":1,\"11:50\":1,\"12:00\":1,\"12:10\":1,\"12:20\":1}', '1130_0001', '0001', '', '', '43CHhall012024-02-1511:300001', '{\"id\":\"ID65cc387cf17f37.38203713\",\"ทะเบียนรถ\":\"10-123456\",\"ชื่องาน\":\"cha_hall1_5\",\"รหัสอาคาร\":\"CH\",\"ชื่ออาคาร\":\"Challenger\",\"พื้นที่\":\"Hall 1\",\"เลขคิว\":\"1130_0001\",\"ประเภทรถ\":\"รถ 6 ล้อ\",\"วันที่จอง\":\"2024-02-15\",\"เวลาจอง\":\"11:30\",\"เวลาที่ใช้\":60,\"ค่าปรับ\":\"600\"}', 0, 600, 60, NULL, NULL, NULL, NULL, '14:30:00', '14:30:00', '16:30:00', NULL, NULL, NULL, 0, 0, 1, 0);

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
('U004f3c6e382c5d0d0f56d59bfec97bc5', '', 'poj11', 'poj11', '', 'U004f3c6e382c5d0d0f56d59bfec97bc5', 'member', '', '', 'poj11@hotmail.com', '2023-09-15 12:17:36', NULL, '2023-09-15 12:17:36', NULL, '2023-09-15 12:17:36', NULL, '2023-09-15 12:17:36', 1, 0),
('U9b7219915fa5ca5c1e871455228c9f9b', '', 'Noi_Knight', 'Noi_Knight', '', 'U9b7219915fa5ca5c1e871455228c9f9b', 'member', '', '', '', '2024-02-11 21:33:33', NULL, '2024-02-11 21:33:33', NULL, '2024-02-11 21:33:33', NULL, '2024-02-11 21:33:33', 1, 0),
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
(43, 'OA65c8ea053e4cf4.43566461', 'CH', 'hall01', 'cha_hall1_5', '2024-02-11', '2024-02-29', '08:00:00', '18:00:00', 5, '[1,2,3]', 1, 0),
(44, 'OA65c8ea318fdf84.54266493', 'IEC', 'hall05', 'ex_hall5_4', '2024-02-11', '2024-02-25', '08:00:00', '18:00:00', 4, '[1,2,3]', 1, 0),
(45, 'OA65c8ea6a3ecd99.10105562', 'IF', 'hall04', 'fo_hall4_3', '2024-02-13', '2024-02-24', '08:00:00', '18:00:00', 3, '[1,2,3]', 1, 0),
(46, 'OA65c9abb8375a62.06965850', 'CH', 'hall02', 'ch_hall2_3', '2024-02-13', '2024-02-29', '09:00:00', '13:00:00', 83, '[2,3]', 1, 0),
(46, 'OA65c9abb8375a62.06965850', 'CH', 'hall02', 'ch_hall2_3', '2024-02-13', '2024-02-29', '13:30:00', '17:00:00', 83, '[1]', 1, 0),
(47, 'OA65c9d0d24f5731.62424399', 'IEC', 'hall06', 'ex_hall6_3', '2024-02-12', '2024-02-20', '08:00:00', '10:00:00', 3, '[2,3]', 1, 0),
(47, 'OA65c9d0d24f5731.62424399', 'IEC', 'hall06', 'ex_hall6_3', '2024-02-12', '2024-02-20', '14:00:00', '16:00:00', 3, '[1]', 1, 0);

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
(43, 'OA65c8ea053e4cf4.43566461', 'CH', 'hall01', 'cha_hall1_5', '2024-02-11', '2024-02-29', '08:00:00', '18:00:00', 48, 1, 1, 0),
(44, 'OA65c8ea318fdf84.54266493', 'IEC', 'hall05', 'ex_hall5_4', '2024-02-11', '2024-02-25', '08:00:00', '18:00:00', 51, 1, 1, 0),
(45, 'OA65c8ea6a3ecd99.10105562', 'IF', 'hall04', 'fo_hall4_3', '2024-02-11', '2024-02-24', '08:00:00', '18:00:00', 10, 1, 1, 0),
(46, 'OA65c9abb8375a62.06965850', 'CH', 'hall02', 'ch_hall2_3', '2024-02-12', '2024-02-29', '09:00:00', '17:00:00', 83, 1, 1, 0),
(47, 'OA65c9d0d24f5731.62424399', 'IEC', 'hall06', 'ex_hall6_3', '2024-02-12', '2024-02-20', '08:00:00', '18:00:00', 65, 1, 1, 0);

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
(43, 'OA65c8ea053e4cf4.43566461', 'CH', 'hall01', 'cha_hall1_5', '2024-02-11', '2024-02-29', '08:00:00', '18:00:00', '2024-02-11', '{\"08:00\":5,\"08:10\":5,\"08:20\":5,\"08:30\":5,\"08:40\":5,\"08:50\":5,\"09:00\":5,\"09:10\":5,\"09:20\":5,\"09:30\":5,\"09:40\":5,\"09:50\":5,\"10:00\":5,\"10:10\":5,\"10:20\":5,\"10:30\":5,\"10:40\":5,\"10:50\":5,\"11:00\":5,\"11:10\":5,\"11:20\":5,\"11:30\":5,\"11:40\":5,\"11:50\":5,\"12:00\":5,\"12:10\":5,\"12:20\":5,\"12:30\":5,\"12:40\":5,\"12:50\":5,\"13:00\":5,\"13:10\":5,\"13:20\":5,\"13:30\":5,\"13:40\":5,\"13:50\":5,\"14:00\":5,\"14:10\":5,\"14:20\":5,\"14:30\":5,\"14:40\":5,\"14:50\":5,\"15:00\":5,\"15:10\":5,\"15:20\":5,\"15:30\":5,\"15:40\":5,\"15:50\":5,\"16:00\":5,\"16:10\":5,\"16:20\":5,\"16:30\":5,\"16:40\":5,\"16:50\":5,\"17:00\":5,\"17:10\":5,\"17:20\":5,\"17:30\":5,\"17:40\":5,\"17:50\":5,\"18:00\":5}', 0, 5, '[1,2,3]', 1, 0),
(43, 'OA65c8ea053e4cf4.43566461', 'CH', 'hall01', 'cha_hall1_5', '2024-02-11', '2024-02-29', '08:00:00', '18:00:00', '2024-02-12', '{\"08:00\": 2, \"08:10\": 2, \"08:20\": 2, \"08:30\": 2, \"08:40\": 3, \"08:50\": 3, \"09:00\": 4, \"09:10\": 4, \"09:20\": 4, \"09:30\": 4, \"09:40\": 5, \"09:50\": 5, \"10:00\": 4, \"10:10\": 4, \"10:20\": 4, \"10:30\": 4, \"10:40\": 4, \"10:50\": 4, \"11:00\": 5, \"11:10\": 5, \"11:20\": 5, \"11:30\": 5, \"11:40\": 5, \"11:50\": 5, \"12:00\": 4, \"12:10\": 4, \"12:20\": 4, \"12:30\": 4, \"12:40\": 5, \"12:50\": 5, \"13:00\": 5, \"13:10\": 5, \"13:20\": 5, \"13:30\": 5, \"13:40\": 5, \"13:50\": 5, \"14:00\": 5, \"14:10\": 5, \"14:20\": 5, \"14:30\": 5, \"14:40\": 5, \"14:50\": 5, \"15:00\": 5, \"15:10\": 5, \"15:20\": 5, \"15:30\": 5, \"15:40\": 5, \"15:50\": 5, \"16:00\": 5, \"16:10\": 5, \"16:20\": 5, \"16:30\": 5, \"16:40\": 5, \"16:50\": 5, \"17:00\": 5, \"17:10\": 5, \"17:20\": 5, \"17:30\": 5, \"17:40\": 5, \"17:50\": 5, \"18:00\": 5}', 0, 5, '[1,2,3]', 1, 0),
(43, 'OA65c8ea053e4cf4.43566461', 'CH', 'hall01', 'cha_hall1_5', '2024-02-11', '2024-02-29', '08:00:00', '18:00:00', '2024-02-13', '{\"08:00\": 5, \"08:10\": 5, \"08:20\": 5, \"08:30\": 4, \"08:40\": 4, \"08:50\": 4, \"09:00\": 2, \"09:10\": 2, \"09:20\": 2, \"09:30\": 2, \"09:40\": 3, \"09:50\": 3, \"10:00\": 3, \"10:10\": 4, \"10:20\": 4, \"10:30\": 4, \"10:40\": 4, \"10:50\": 4, \"11:00\": 5, \"11:10\": 5, \"11:20\": 5, \"11:30\": 5, \"11:40\": 5, \"11:50\": 5, \"12:00\": 5, \"12:10\": 5, \"12:20\": 5, \"12:30\": 5, \"12:40\": 5, \"12:50\": 5, \"13:00\": 4, \"13:10\": 4, \"13:20\": 4, \"13:30\": 4, \"13:40\": 5, \"13:50\": 5, \"14:00\": 5, \"14:10\": 5, \"14:20\": 5, \"14:30\": 5, \"14:40\": 5, \"14:50\": 5, \"15:00\": 5, \"15:10\": 5, \"15:20\": 5, \"15:30\": 5, \"15:40\": 5, \"15:50\": 5, \"16:00\": 5, \"16:10\": 5, \"16:20\": 5, \"16:30\": 5, \"16:40\": 5, \"16:50\": 5, \"17:00\": 5, \"17:10\": 5, \"17:20\": 5, \"17:30\": 5, \"17:40\": 5, \"17:50\": 5, \"18:00\": 5}', 0, 5, '[1,2,3]', 1, 0),
(43, 'OA65c8ea053e4cf4.43566461', 'CH', 'hall01', 'cha_hall1_5', '2024-02-11', '2024-02-29', '08:00:00', '18:00:00', '2024-02-14', '{\"08:00\": 5, \"08:10\": 5, \"08:20\": 5, \"08:30\": 5, \"08:40\": 5, \"08:50\": 5, \"09:00\": 4, \"09:10\": 4, \"09:20\": 4, \"09:30\": 3, \"09:40\": 3, \"09:50\": 3, \"10:00\": 2, \"10:10\": 3, \"10:20\": 3, \"10:30\": 3, \"10:40\": 4, \"10:50\": 4, \"11:00\": 5, \"11:10\": 5, \"11:20\": 5, \"11:30\": 5, \"11:40\": 5, \"11:50\": 5, \"12:00\": 5, \"12:10\": 5, \"12:20\": 5, \"12:30\": 5, \"12:40\": 5, \"12:50\": 5, \"13:00\": 5, \"13:10\": 5, \"13:20\": 5, \"13:30\": 5, \"13:40\": 5, \"13:50\": 5, \"14:00\": 5, \"14:10\": 5, \"14:20\": 5, \"14:30\": 5, \"14:40\": 5, \"14:50\": 5, \"15:00\": 5, \"15:10\": 5, \"15:20\": 5, \"15:30\": 5, \"15:40\": 5, \"15:50\": 5, \"16:00\": 5, \"16:10\": 5, \"16:20\": 5, \"16:30\": 5, \"16:40\": 5, \"16:50\": 5, \"17:00\": 5, \"17:10\": 5, \"17:20\": 5, \"17:30\": 5, \"17:40\": 5, \"17:50\": 5, \"18:00\": 5}', 0, 5, '[1,2,3]', 1, 0),
(43, 'OA65c8ea053e4cf4.43566461', 'CH', 'hall01', 'cha_hall1_5', '2024-02-11', '2024-02-29', '08:00:00', '18:00:00', '2024-02-15', '{\"08:00\": 1, \"08:10\": 1, \"08:20\": 1, \"08:30\": 1, \"08:40\": 3, \"08:50\": 3, \"09:00\": 4, \"09:10\": 4, \"09:20\": 4, \"09:30\": 4, \"09:40\": 5, \"09:50\": 5, \"10:00\": 2, \"10:10\": 2, \"10:20\": 2, \"10:30\": 2, \"10:40\": 3, \"10:50\": 3, \"11:00\": 5, \"11:10\": 5, \"11:20\": 5, \"11:30\": 4, \"11:40\": 4, \"11:50\": 4, \"12:00\": 4, \"12:10\": 4, \"12:20\": 4, \"12:30\": 5, \"12:40\": 5, \"12:50\": 5, \"13:00\": 5, \"13:10\": 5, \"13:20\": 5, \"13:30\": 5, \"13:40\": 5, \"13:50\": 5, \"14:00\": 5, \"14:10\": 5, \"14:20\": 5, \"14:30\": 5, \"14:40\": 5, \"14:50\": 5, \"15:00\": 5, \"15:10\": 5, \"15:20\": 5, \"15:30\": 5, \"15:40\": 5, \"15:50\": 5, \"16:00\": 5, \"16:10\": 5, \"16:20\": 5, \"16:30\": 5, \"16:40\": 5, \"16:50\": 5, \"17:00\": 5, \"17:10\": 5, \"17:20\": 5, \"17:30\": 5, \"17:40\": 5, \"17:50\": 5, \"18:00\": 5}', 0, 5, '[1,2,3]', 1, 0),
(43, 'OA65c8ea053e4cf4.43566461', 'CH', 'hall01', 'cha_hall1_5', '2024-02-11', '2024-02-29', '08:00:00', '18:00:00', '2024-02-16', '{\"08:00\":5,\"08:10\":5,\"08:20\":5,\"08:30\":5,\"08:40\":5,\"08:50\":5,\"09:00\":5,\"09:10\":5,\"09:20\":5,\"09:30\":5,\"09:40\":5,\"09:50\":5,\"10:00\":5,\"10:10\":5,\"10:20\":5,\"10:30\":5,\"10:40\":5,\"10:50\":5,\"11:00\":5,\"11:10\":5,\"11:20\":5,\"11:30\":5,\"11:40\":5,\"11:50\":5,\"12:00\":5,\"12:10\":5,\"12:20\":5,\"12:30\":5,\"12:40\":5,\"12:50\":5,\"13:00\":5,\"13:10\":5,\"13:20\":5,\"13:30\":5,\"13:40\":5,\"13:50\":5,\"14:00\":5,\"14:10\":5,\"14:20\":5,\"14:30\":5,\"14:40\":5,\"14:50\":5,\"15:00\":5,\"15:10\":5,\"15:20\":5,\"15:30\":5,\"15:40\":5,\"15:50\":5,\"16:00\":5,\"16:10\":5,\"16:20\":5,\"16:30\":5,\"16:40\":5,\"16:50\":5,\"17:00\":5,\"17:10\":5,\"17:20\":5,\"17:30\":5,\"17:40\":5,\"17:50\":5,\"18:00\":5}', 0, 5, '[1,2,3]', 1, 0),
(43, 'OA65c8ea053e4cf4.43566461', 'CH', 'hall01', 'cha_hall1_5', '2024-02-11', '2024-02-29', '08:00:00', '18:00:00', '2024-02-17', '{\"08:00\":5,\"08:10\":5,\"08:20\":5,\"08:30\":5,\"08:40\":5,\"08:50\":5,\"09:00\":5,\"09:10\":5,\"09:20\":5,\"09:30\":5,\"09:40\":5,\"09:50\":5,\"10:00\":5,\"10:10\":5,\"10:20\":5,\"10:30\":5,\"10:40\":5,\"10:50\":5,\"11:00\":5,\"11:10\":5,\"11:20\":5,\"11:30\":5,\"11:40\":5,\"11:50\":5,\"12:00\":5,\"12:10\":5,\"12:20\":5,\"12:30\":5,\"12:40\":5,\"12:50\":5,\"13:00\":5,\"13:10\":5,\"13:20\":5,\"13:30\":5,\"13:40\":5,\"13:50\":5,\"14:00\":5,\"14:10\":5,\"14:20\":5,\"14:30\":5,\"14:40\":5,\"14:50\":5,\"15:00\":5,\"15:10\":5,\"15:20\":5,\"15:30\":5,\"15:40\":5,\"15:50\":5,\"16:00\":5,\"16:10\":5,\"16:20\":5,\"16:30\":5,\"16:40\":5,\"16:50\":5,\"17:00\":5,\"17:10\":5,\"17:20\":5,\"17:30\":5,\"17:40\":5,\"17:50\":5,\"18:00\":5}', 0, 5, '[1,2,3]', 1, 0),
(43, 'OA65c8ea053e4cf4.43566461', 'CH', 'hall01', 'cha_hall1_5', '2024-02-11', '2024-02-29', '08:00:00', '18:00:00', '2024-02-18', '{\"08:00\":5,\"08:10\":5,\"08:20\":5,\"08:30\":5,\"08:40\":5,\"08:50\":5,\"09:00\":5,\"09:10\":5,\"09:20\":5,\"09:30\":5,\"09:40\":5,\"09:50\":5,\"10:00\":5,\"10:10\":5,\"10:20\":5,\"10:30\":5,\"10:40\":5,\"10:50\":5,\"11:00\":5,\"11:10\":5,\"11:20\":5,\"11:30\":5,\"11:40\":5,\"11:50\":5,\"12:00\":5,\"12:10\":5,\"12:20\":5,\"12:30\":5,\"12:40\":5,\"12:50\":5,\"13:00\":5,\"13:10\":5,\"13:20\":5,\"13:30\":5,\"13:40\":5,\"13:50\":5,\"14:00\":5,\"14:10\":5,\"14:20\":5,\"14:30\":5,\"14:40\":5,\"14:50\":5,\"15:00\":5,\"15:10\":5,\"15:20\":5,\"15:30\":5,\"15:40\":5,\"15:50\":5,\"16:00\":5,\"16:10\":5,\"16:20\":5,\"16:30\":5,\"16:40\":5,\"16:50\":5,\"17:00\":5,\"17:10\":5,\"17:20\":5,\"17:30\":5,\"17:40\":5,\"17:50\":5,\"18:00\":5}', 0, 5, '[1,2,3]', 1, 0),
(43, 'OA65c8ea053e4cf4.43566461', 'CH', 'hall01', 'cha_hall1_5', '2024-02-11', '2024-02-29', '08:00:00', '18:00:00', '2024-02-19', '{\"08:00\":5,\"08:10\":5,\"08:20\":5,\"08:30\":5,\"08:40\":5,\"08:50\":5,\"09:00\":5,\"09:10\":5,\"09:20\":5,\"09:30\":5,\"09:40\":5,\"09:50\":5,\"10:00\":5,\"10:10\":5,\"10:20\":5,\"10:30\":5,\"10:40\":5,\"10:50\":5,\"11:00\":5,\"11:10\":5,\"11:20\":5,\"11:30\":5,\"11:40\":5,\"11:50\":5,\"12:00\":5,\"12:10\":5,\"12:20\":5,\"12:30\":5,\"12:40\":5,\"12:50\":5,\"13:00\":5,\"13:10\":5,\"13:20\":5,\"13:30\":5,\"13:40\":5,\"13:50\":5,\"14:00\":5,\"14:10\":5,\"14:20\":5,\"14:30\":5,\"14:40\":5,\"14:50\":5,\"15:00\":5,\"15:10\":5,\"15:20\":5,\"15:30\":5,\"15:40\":5,\"15:50\":5,\"16:00\":5,\"16:10\":5,\"16:20\":5,\"16:30\":5,\"16:40\":5,\"16:50\":5,\"17:00\":5,\"17:10\":5,\"17:20\":5,\"17:30\":5,\"17:40\":5,\"17:50\":5,\"18:00\":5}', 0, 5, '[1,2,3]', 1, 0),
(43, 'OA65c8ea053e4cf4.43566461', 'CH', 'hall01', 'cha_hall1_5', '2024-02-11', '2024-02-29', '08:00:00', '18:00:00', '2024-02-20', '{\"08:00\":5,\"08:10\":5,\"08:20\":5,\"08:30\":5,\"08:40\":5,\"08:50\":5,\"09:00\":5,\"09:10\":5,\"09:20\":5,\"09:30\":5,\"09:40\":5,\"09:50\":5,\"10:00\":5,\"10:10\":5,\"10:20\":5,\"10:30\":5,\"10:40\":5,\"10:50\":5,\"11:00\":5,\"11:10\":5,\"11:20\":5,\"11:30\":5,\"11:40\":5,\"11:50\":5,\"12:00\":5,\"12:10\":5,\"12:20\":5,\"12:30\":5,\"12:40\":5,\"12:50\":5,\"13:00\":5,\"13:10\":5,\"13:20\":5,\"13:30\":5,\"13:40\":5,\"13:50\":5,\"14:00\":5,\"14:10\":5,\"14:20\":5,\"14:30\":5,\"14:40\":5,\"14:50\":5,\"15:00\":5,\"15:10\":5,\"15:20\":5,\"15:30\":5,\"15:40\":5,\"15:50\":5,\"16:00\":5,\"16:10\":5,\"16:20\":5,\"16:30\":5,\"16:40\":5,\"16:50\":5,\"17:00\":5,\"17:10\":5,\"17:20\":5,\"17:30\":5,\"17:40\":5,\"17:50\":5,\"18:00\":5}', 0, 5, '[1,2,3]', 1, 0),
(43, 'OA65c8ea053e4cf4.43566461', 'CH', 'hall01', 'cha_hall1_5', '2024-02-11', '2024-02-29', '08:00:00', '18:00:00', '2024-02-21', '{\"08:00\":5,\"08:10\":5,\"08:20\":5,\"08:30\":5,\"08:40\":5,\"08:50\":5,\"09:00\":5,\"09:10\":5,\"09:20\":5,\"09:30\":5,\"09:40\":5,\"09:50\":5,\"10:00\":5,\"10:10\":5,\"10:20\":5,\"10:30\":5,\"10:40\":5,\"10:50\":5,\"11:00\":5,\"11:10\":5,\"11:20\":5,\"11:30\":5,\"11:40\":5,\"11:50\":5,\"12:00\":5,\"12:10\":5,\"12:20\":5,\"12:30\":5,\"12:40\":5,\"12:50\":5,\"13:00\":5,\"13:10\":5,\"13:20\":5,\"13:30\":5,\"13:40\":5,\"13:50\":5,\"14:00\":5,\"14:10\":5,\"14:20\":5,\"14:30\":5,\"14:40\":5,\"14:50\":5,\"15:00\":5,\"15:10\":5,\"15:20\":5,\"15:30\":5,\"15:40\":5,\"15:50\":5,\"16:00\":5,\"16:10\":5,\"16:20\":5,\"16:30\":5,\"16:40\":5,\"16:50\":5,\"17:00\":5,\"17:10\":5,\"17:20\":5,\"17:30\":5,\"17:40\":5,\"17:50\":5,\"18:00\":5}', 0, 5, '[1,2,3]', 1, 0),
(43, 'OA65c8ea053e4cf4.43566461', 'CH', 'hall01', 'cha_hall1_5', '2024-02-11', '2024-02-29', '08:00:00', '18:00:00', '2024-02-22', '{\"08:00\":5,\"08:10\":5,\"08:20\":5,\"08:30\":5,\"08:40\":5,\"08:50\":5,\"09:00\":5,\"09:10\":5,\"09:20\":5,\"09:30\":5,\"09:40\":5,\"09:50\":5,\"10:00\":5,\"10:10\":5,\"10:20\":5,\"10:30\":5,\"10:40\":5,\"10:50\":5,\"11:00\":5,\"11:10\":5,\"11:20\":5,\"11:30\":5,\"11:40\":5,\"11:50\":5,\"12:00\":5,\"12:10\":5,\"12:20\":5,\"12:30\":5,\"12:40\":5,\"12:50\":5,\"13:00\":5,\"13:10\":5,\"13:20\":5,\"13:30\":5,\"13:40\":5,\"13:50\":5,\"14:00\":5,\"14:10\":5,\"14:20\":5,\"14:30\":5,\"14:40\":5,\"14:50\":5,\"15:00\":5,\"15:10\":5,\"15:20\":5,\"15:30\":5,\"15:40\":5,\"15:50\":5,\"16:00\":5,\"16:10\":5,\"16:20\":5,\"16:30\":5,\"16:40\":5,\"16:50\":5,\"17:00\":5,\"17:10\":5,\"17:20\":5,\"17:30\":5,\"17:40\":5,\"17:50\":5,\"18:00\":5}', 0, 5, '[1,2,3]', 1, 0),
(43, 'OA65c8ea053e4cf4.43566461', 'CH', 'hall01', 'cha_hall1_5', '2024-02-11', '2024-02-29', '08:00:00', '18:00:00', '2024-02-23', '{\"08:00\":5,\"08:10\":5,\"08:20\":5,\"08:30\":5,\"08:40\":5,\"08:50\":5,\"09:00\":5,\"09:10\":5,\"09:20\":5,\"09:30\":5,\"09:40\":5,\"09:50\":5,\"10:00\":5,\"10:10\":5,\"10:20\":5,\"10:30\":5,\"10:40\":5,\"10:50\":5,\"11:00\":5,\"11:10\":5,\"11:20\":5,\"11:30\":5,\"11:40\":5,\"11:50\":5,\"12:00\":5,\"12:10\":5,\"12:20\":5,\"12:30\":5,\"12:40\":5,\"12:50\":5,\"13:00\":5,\"13:10\":5,\"13:20\":5,\"13:30\":5,\"13:40\":5,\"13:50\":5,\"14:00\":5,\"14:10\":5,\"14:20\":5,\"14:30\":5,\"14:40\":5,\"14:50\":5,\"15:00\":5,\"15:10\":5,\"15:20\":5,\"15:30\":5,\"15:40\":5,\"15:50\":5,\"16:00\":5,\"16:10\":5,\"16:20\":5,\"16:30\":5,\"16:40\":5,\"16:50\":5,\"17:00\":5,\"17:10\":5,\"17:20\":5,\"17:30\":5,\"17:40\":5,\"17:50\":5,\"18:00\":5}', 0, 5, '[1,2,3]', 1, 0),
(43, 'OA65c8ea053e4cf4.43566461', 'CH', 'hall01', 'cha_hall1_5', '2024-02-11', '2024-02-29', '08:00:00', '18:00:00', '2024-02-24', '{\"08:00\":5,\"08:10\":5,\"08:20\":5,\"08:30\":5,\"08:40\":5,\"08:50\":5,\"09:00\":5,\"09:10\":5,\"09:20\":5,\"09:30\":5,\"09:40\":5,\"09:50\":5,\"10:00\":5,\"10:10\":5,\"10:20\":5,\"10:30\":5,\"10:40\":5,\"10:50\":5,\"11:00\":5,\"11:10\":5,\"11:20\":5,\"11:30\":5,\"11:40\":5,\"11:50\":5,\"12:00\":5,\"12:10\":5,\"12:20\":5,\"12:30\":5,\"12:40\":5,\"12:50\":5,\"13:00\":5,\"13:10\":5,\"13:20\":5,\"13:30\":5,\"13:40\":5,\"13:50\":5,\"14:00\":5,\"14:10\":5,\"14:20\":5,\"14:30\":5,\"14:40\":5,\"14:50\":5,\"15:00\":5,\"15:10\":5,\"15:20\":5,\"15:30\":5,\"15:40\":5,\"15:50\":5,\"16:00\":5,\"16:10\":5,\"16:20\":5,\"16:30\":5,\"16:40\":5,\"16:50\":5,\"17:00\":5,\"17:10\":5,\"17:20\":5,\"17:30\":5,\"17:40\":5,\"17:50\":5,\"18:00\":5}', 0, 5, '[1,2,3]', 1, 0),
(43, 'OA65c8ea053e4cf4.43566461', 'CH', 'hall01', 'cha_hall1_5', '2024-02-11', '2024-02-29', '08:00:00', '18:00:00', '2024-02-25', '{\"08:00\":5,\"08:10\":5,\"08:20\":5,\"08:30\":5,\"08:40\":5,\"08:50\":5,\"09:00\":5,\"09:10\":5,\"09:20\":5,\"09:30\":5,\"09:40\":5,\"09:50\":5,\"10:00\":5,\"10:10\":5,\"10:20\":5,\"10:30\":5,\"10:40\":5,\"10:50\":5,\"11:00\":5,\"11:10\":5,\"11:20\":5,\"11:30\":5,\"11:40\":5,\"11:50\":5,\"12:00\":5,\"12:10\":5,\"12:20\":5,\"12:30\":5,\"12:40\":5,\"12:50\":5,\"13:00\":5,\"13:10\":5,\"13:20\":5,\"13:30\":5,\"13:40\":5,\"13:50\":5,\"14:00\":5,\"14:10\":5,\"14:20\":5,\"14:30\":5,\"14:40\":5,\"14:50\":5,\"15:00\":5,\"15:10\":5,\"15:20\":5,\"15:30\":5,\"15:40\":5,\"15:50\":5,\"16:00\":5,\"16:10\":5,\"16:20\":5,\"16:30\":5,\"16:40\":5,\"16:50\":5,\"17:00\":5,\"17:10\":5,\"17:20\":5,\"17:30\":5,\"17:40\":5,\"17:50\":5,\"18:00\":5}', 0, 5, '[1,2,3]', 1, 0),
(43, 'OA65c8ea053e4cf4.43566461', 'CH', 'hall01', 'cha_hall1_5', '2024-02-11', '2024-02-29', '08:00:00', '18:00:00', '2024-02-26', '{\"08:00\":5,\"08:10\":5,\"08:20\":5,\"08:30\":5,\"08:40\":5,\"08:50\":5,\"09:00\":5,\"09:10\":5,\"09:20\":5,\"09:30\":5,\"09:40\":5,\"09:50\":5,\"10:00\":5,\"10:10\":5,\"10:20\":5,\"10:30\":5,\"10:40\":5,\"10:50\":5,\"11:00\":5,\"11:10\":5,\"11:20\":5,\"11:30\":5,\"11:40\":5,\"11:50\":5,\"12:00\":5,\"12:10\":5,\"12:20\":5,\"12:30\":5,\"12:40\":5,\"12:50\":5,\"13:00\":5,\"13:10\":5,\"13:20\":5,\"13:30\":5,\"13:40\":5,\"13:50\":5,\"14:00\":5,\"14:10\":5,\"14:20\":5,\"14:30\":5,\"14:40\":5,\"14:50\":5,\"15:00\":5,\"15:10\":5,\"15:20\":5,\"15:30\":5,\"15:40\":5,\"15:50\":5,\"16:00\":5,\"16:10\":5,\"16:20\":5,\"16:30\":5,\"16:40\":5,\"16:50\":5,\"17:00\":5,\"17:10\":5,\"17:20\":5,\"17:30\":5,\"17:40\":5,\"17:50\":5,\"18:00\":5}', 0, 5, '[1,2,3]', 1, 0),
(43, 'OA65c8ea053e4cf4.43566461', 'CH', 'hall01', 'cha_hall1_5', '2024-02-11', '2024-02-29', '08:00:00', '18:00:00', '2024-02-27', '{\"08:00\":5,\"08:10\":5,\"08:20\":5,\"08:30\":5,\"08:40\":5,\"08:50\":5,\"09:00\":5,\"09:10\":5,\"09:20\":5,\"09:30\":5,\"09:40\":5,\"09:50\":5,\"10:00\":5,\"10:10\":5,\"10:20\":5,\"10:30\":5,\"10:40\":5,\"10:50\":5,\"11:00\":5,\"11:10\":5,\"11:20\":5,\"11:30\":5,\"11:40\":5,\"11:50\":5,\"12:00\":5,\"12:10\":5,\"12:20\":5,\"12:30\":5,\"12:40\":5,\"12:50\":5,\"13:00\":5,\"13:10\":5,\"13:20\":5,\"13:30\":5,\"13:40\":5,\"13:50\":5,\"14:00\":5,\"14:10\":5,\"14:20\":5,\"14:30\":5,\"14:40\":5,\"14:50\":5,\"15:00\":5,\"15:10\":5,\"15:20\":5,\"15:30\":5,\"15:40\":5,\"15:50\":5,\"16:00\":5,\"16:10\":5,\"16:20\":5,\"16:30\":5,\"16:40\":5,\"16:50\":5,\"17:00\":5,\"17:10\":5,\"17:20\":5,\"17:30\":5,\"17:40\":5,\"17:50\":5,\"18:00\":5}', 0, 5, '[1,2,3]', 1, 0),
(43, 'OA65c8ea053e4cf4.43566461', 'CH', 'hall01', 'cha_hall1_5', '2024-02-11', '2024-02-29', '08:00:00', '18:00:00', '2024-02-28', '{\"08:00\":5,\"08:10\":5,\"08:20\":5,\"08:30\":5,\"08:40\":5,\"08:50\":5,\"09:00\":5,\"09:10\":5,\"09:20\":5,\"09:30\":5,\"09:40\":5,\"09:50\":5,\"10:00\":5,\"10:10\":5,\"10:20\":5,\"10:30\":5,\"10:40\":5,\"10:50\":5,\"11:00\":5,\"11:10\":5,\"11:20\":5,\"11:30\":5,\"11:40\":5,\"11:50\":5,\"12:00\":5,\"12:10\":5,\"12:20\":5,\"12:30\":5,\"12:40\":5,\"12:50\":5,\"13:00\":5,\"13:10\":5,\"13:20\":5,\"13:30\":5,\"13:40\":5,\"13:50\":5,\"14:00\":5,\"14:10\":5,\"14:20\":5,\"14:30\":5,\"14:40\":5,\"14:50\":5,\"15:00\":5,\"15:10\":5,\"15:20\":5,\"15:30\":5,\"15:40\":5,\"15:50\":5,\"16:00\":5,\"16:10\":5,\"16:20\":5,\"16:30\":5,\"16:40\":5,\"16:50\":5,\"17:00\":5,\"17:10\":5,\"17:20\":5,\"17:30\":5,\"17:40\":5,\"17:50\":5,\"18:00\":5}', 0, 5, '[1,2,3]', 1, 0),
(43, 'OA65c8ea053e4cf4.43566461', 'CH', 'hall01', 'cha_hall1_5', '2024-02-11', '2024-02-29', '08:00:00', '18:00:00', '2024-02-29', '{\"08:00\":5,\"08:10\":5,\"08:20\":5,\"08:30\":5,\"08:40\":5,\"08:50\":5,\"09:00\":5,\"09:10\":5,\"09:20\":5,\"09:30\":5,\"09:40\":5,\"09:50\":5,\"10:00\":5,\"10:10\":5,\"10:20\":5,\"10:30\":5,\"10:40\":5,\"10:50\":5,\"11:00\":5,\"11:10\":5,\"11:20\":5,\"11:30\":5,\"11:40\":5,\"11:50\":5,\"12:00\":5,\"12:10\":5,\"12:20\":5,\"12:30\":5,\"12:40\":5,\"12:50\":5,\"13:00\":5,\"13:10\":5,\"13:20\":5,\"13:30\":5,\"13:40\":5,\"13:50\":5,\"14:00\":5,\"14:10\":5,\"14:20\":5,\"14:30\":5,\"14:40\":5,\"14:50\":5,\"15:00\":5,\"15:10\":5,\"15:20\":5,\"15:30\":5,\"15:40\":5,\"15:50\":5,\"16:00\":5,\"16:10\":5,\"16:20\":5,\"16:30\":5,\"16:40\":5,\"16:50\":5,\"17:00\":5,\"17:10\":5,\"17:20\":5,\"17:30\":5,\"17:40\":5,\"17:50\":5,\"18:00\":5}', 0, 5, '[1,2,3]', 1, 0),
(44, 'OA65c8ea318fdf84.54266493', 'IEC', 'hall05', 'ex_hall5_4', '2024-02-11', '2024-02-25', '08:00:00', '18:00:00', '2024-02-11', '{\"08:00\":4,\"08:10\":4,\"08:20\":4,\"08:30\":4,\"08:40\":4,\"08:50\":4,\"09:00\":4,\"09:10\":4,\"09:20\":4,\"09:30\":4,\"09:40\":4,\"09:50\":4,\"10:00\":4,\"10:10\":4,\"10:20\":4,\"10:30\":4,\"10:40\":4,\"10:50\":4,\"11:00\":4,\"11:10\":4,\"11:20\":4,\"11:30\":4,\"11:40\":4,\"11:50\":4,\"12:00\":4,\"12:10\":4,\"12:20\":4,\"12:30\":4,\"12:40\":4,\"12:50\":4,\"13:00\":4,\"13:10\":4,\"13:20\":4,\"13:30\":4,\"13:40\":4,\"13:50\":4,\"14:00\":4,\"14:10\":4,\"14:20\":4,\"14:30\":4,\"14:40\":4,\"14:50\":4,\"15:00\":4,\"15:10\":4,\"15:20\":4,\"15:30\":4,\"15:40\":4,\"15:50\":4,\"16:00\":4,\"16:10\":4,\"16:20\":4,\"16:30\":4,\"16:40\":4,\"16:50\":4,\"17:00\":4,\"17:10\":4,\"17:20\":4,\"17:30\":4,\"17:40\":4,\"17:50\":4,\"18:00\":4}', 0, 4, '[1,2,3]', 1, 0),
(44, 'OA65c8ea318fdf84.54266493', 'IEC', 'hall05', 'ex_hall5_4', '2024-02-11', '2024-02-25', '08:00:00', '18:00:00', '2024-02-12', '{\"08:00\":4,\"08:10\":4,\"08:20\":4,\"08:30\":4,\"08:40\":4,\"08:50\":4,\"09:00\":4,\"09:10\":4,\"09:20\":4,\"09:30\":4,\"09:40\":4,\"09:50\":4,\"10:00\":4,\"10:10\":4,\"10:20\":4,\"10:30\":4,\"10:40\":4,\"10:50\":4,\"11:00\":4,\"11:10\":4,\"11:20\":4,\"11:30\":4,\"11:40\":4,\"11:50\":4,\"12:00\":4,\"12:10\":4,\"12:20\":4,\"12:30\":4,\"12:40\":4,\"12:50\":4,\"13:00\":4,\"13:10\":4,\"13:20\":4,\"13:30\":4,\"13:40\":4,\"13:50\":4,\"14:00\":4,\"14:10\":4,\"14:20\":4,\"14:30\":4,\"14:40\":4,\"14:50\":4,\"15:00\":4,\"15:10\":4,\"15:20\":4,\"15:30\":4,\"15:40\":4,\"15:50\":4,\"16:00\":4,\"16:10\":4,\"16:20\":4,\"16:30\":4,\"16:40\":4,\"16:50\":4,\"17:00\":4,\"17:10\":4,\"17:20\":4,\"17:30\":4,\"17:40\":4,\"17:50\":4,\"18:00\":4}', 0, 4, '[1,2,3]', 1, 0),
(44, 'OA65c8ea318fdf84.54266493', 'IEC', 'hall05', 'ex_hall5_4', '2024-02-11', '2024-02-25', '08:00:00', '18:00:00', '2024-02-13', '{\"08:00\":4,\"08:10\":4,\"08:20\":4,\"08:30\":4,\"08:40\":4,\"08:50\":4,\"09:00\":4,\"09:10\":4,\"09:20\":4,\"09:30\":4,\"09:40\":4,\"09:50\":4,\"10:00\":4,\"10:10\":4,\"10:20\":4,\"10:30\":4,\"10:40\":4,\"10:50\":4,\"11:00\":4,\"11:10\":4,\"11:20\":4,\"11:30\":4,\"11:40\":4,\"11:50\":4,\"12:00\":4,\"12:10\":4,\"12:20\":4,\"12:30\":4,\"12:40\":4,\"12:50\":4,\"13:00\":4,\"13:10\":4,\"13:20\":4,\"13:30\":4,\"13:40\":4,\"13:50\":4,\"14:00\":4,\"14:10\":4,\"14:20\":4,\"14:30\":4,\"14:40\":4,\"14:50\":4,\"15:00\":4,\"15:10\":4,\"15:20\":4,\"15:30\":4,\"15:40\":4,\"15:50\":4,\"16:00\":4,\"16:10\":4,\"16:20\":4,\"16:30\":4,\"16:40\":4,\"16:50\":4,\"17:00\":4,\"17:10\":4,\"17:20\":4,\"17:30\":4,\"17:40\":4,\"17:50\":4,\"18:00\":4}', 0, 4, '[1,2,3]', 1, 0),
(44, 'OA65c8ea318fdf84.54266493', 'IEC', 'hall05', 'ex_hall5_4', '2024-02-11', '2024-02-25', '08:00:00', '18:00:00', '2024-02-14', '{\"08:00\":4,\"08:10\":4,\"08:20\":4,\"08:30\":4,\"08:40\":4,\"08:50\":4,\"09:00\":4,\"09:10\":4,\"09:20\":4,\"09:30\":4,\"09:40\":4,\"09:50\":4,\"10:00\":4,\"10:10\":4,\"10:20\":4,\"10:30\":4,\"10:40\":4,\"10:50\":4,\"11:00\":4,\"11:10\":4,\"11:20\":4,\"11:30\":4,\"11:40\":4,\"11:50\":4,\"12:00\":4,\"12:10\":4,\"12:20\":4,\"12:30\":4,\"12:40\":4,\"12:50\":4,\"13:00\":4,\"13:10\":4,\"13:20\":4,\"13:30\":4,\"13:40\":4,\"13:50\":4,\"14:00\":4,\"14:10\":4,\"14:20\":4,\"14:30\":4,\"14:40\":4,\"14:50\":4,\"15:00\":4,\"15:10\":4,\"15:20\":4,\"15:30\":4,\"15:40\":4,\"15:50\":4,\"16:00\":4,\"16:10\":4,\"16:20\":4,\"16:30\":4,\"16:40\":4,\"16:50\":4,\"17:00\":4,\"17:10\":4,\"17:20\":4,\"17:30\":4,\"17:40\":4,\"17:50\":4,\"18:00\":4}', 0, 4, '[1,2,3]', 1, 0),
(44, 'OA65c8ea318fdf84.54266493', 'IEC', 'hall05', 'ex_hall5_4', '2024-02-11', '2024-02-25', '08:00:00', '18:00:00', '2024-02-15', '{\"08:00\":4,\"08:10\":4,\"08:20\":4,\"08:30\":4,\"08:40\":4,\"08:50\":4,\"09:00\":4,\"09:10\":4,\"09:20\":4,\"09:30\":4,\"09:40\":4,\"09:50\":4,\"10:00\":4,\"10:10\":4,\"10:20\":4,\"10:30\":4,\"10:40\":4,\"10:50\":4,\"11:00\":4,\"11:10\":4,\"11:20\":4,\"11:30\":4,\"11:40\":4,\"11:50\":4,\"12:00\":4,\"12:10\":4,\"12:20\":4,\"12:30\":4,\"12:40\":4,\"12:50\":4,\"13:00\":4,\"13:10\":4,\"13:20\":4,\"13:30\":4,\"13:40\":4,\"13:50\":4,\"14:00\":4,\"14:10\":4,\"14:20\":4,\"14:30\":4,\"14:40\":4,\"14:50\":4,\"15:00\":4,\"15:10\":4,\"15:20\":4,\"15:30\":4,\"15:40\":4,\"15:50\":4,\"16:00\":4,\"16:10\":4,\"16:20\":4,\"16:30\":4,\"16:40\":4,\"16:50\":4,\"17:00\":4,\"17:10\":4,\"17:20\":4,\"17:30\":4,\"17:40\":4,\"17:50\":4,\"18:00\":4}', 0, 4, '[1,2,3]', 1, 0),
(44, 'OA65c8ea318fdf84.54266493', 'IEC', 'hall05', 'ex_hall5_4', '2024-02-11', '2024-02-25', '08:00:00', '18:00:00', '2024-02-16', '{\"08:00\":4,\"08:10\":4,\"08:20\":4,\"08:30\":4,\"08:40\":4,\"08:50\":4,\"09:00\":4,\"09:10\":4,\"09:20\":4,\"09:30\":4,\"09:40\":4,\"09:50\":4,\"10:00\":4,\"10:10\":4,\"10:20\":4,\"10:30\":4,\"10:40\":4,\"10:50\":4,\"11:00\":4,\"11:10\":4,\"11:20\":4,\"11:30\":4,\"11:40\":4,\"11:50\":4,\"12:00\":4,\"12:10\":4,\"12:20\":4,\"12:30\":4,\"12:40\":4,\"12:50\":4,\"13:00\":4,\"13:10\":4,\"13:20\":4,\"13:30\":4,\"13:40\":4,\"13:50\":4,\"14:00\":4,\"14:10\":4,\"14:20\":4,\"14:30\":4,\"14:40\":4,\"14:50\":4,\"15:00\":4,\"15:10\":4,\"15:20\":4,\"15:30\":4,\"15:40\":4,\"15:50\":4,\"16:00\":4,\"16:10\":4,\"16:20\":4,\"16:30\":4,\"16:40\":4,\"16:50\":4,\"17:00\":4,\"17:10\":4,\"17:20\":4,\"17:30\":4,\"17:40\":4,\"17:50\":4,\"18:00\":4}', 0, 4, '[1,2,3]', 1, 0),
(44, 'OA65c8ea318fdf84.54266493', 'IEC', 'hall05', 'ex_hall5_4', '2024-02-11', '2024-02-25', '08:00:00', '18:00:00', '2024-02-17', '{\"08:00\":4,\"08:10\":4,\"08:20\":4,\"08:30\":4,\"08:40\":4,\"08:50\":4,\"09:00\":4,\"09:10\":4,\"09:20\":4,\"09:30\":4,\"09:40\":4,\"09:50\":4,\"10:00\":4,\"10:10\":4,\"10:20\":4,\"10:30\":4,\"10:40\":4,\"10:50\":4,\"11:00\":4,\"11:10\":4,\"11:20\":4,\"11:30\":4,\"11:40\":4,\"11:50\":4,\"12:00\":4,\"12:10\":4,\"12:20\":4,\"12:30\":4,\"12:40\":4,\"12:50\":4,\"13:00\":4,\"13:10\":4,\"13:20\":4,\"13:30\":4,\"13:40\":4,\"13:50\":4,\"14:00\":4,\"14:10\":4,\"14:20\":4,\"14:30\":4,\"14:40\":4,\"14:50\":4,\"15:00\":4,\"15:10\":4,\"15:20\":4,\"15:30\":4,\"15:40\":4,\"15:50\":4,\"16:00\":4,\"16:10\":4,\"16:20\":4,\"16:30\":4,\"16:40\":4,\"16:50\":4,\"17:00\":4,\"17:10\":4,\"17:20\":4,\"17:30\":4,\"17:40\":4,\"17:50\":4,\"18:00\":4}', 0, 4, '[1,2,3]', 1, 0),
(44, 'OA65c8ea318fdf84.54266493', 'IEC', 'hall05', 'ex_hall5_4', '2024-02-11', '2024-02-25', '08:00:00', '18:00:00', '2024-02-18', '{\"08:00\":4,\"08:10\":4,\"08:20\":4,\"08:30\":4,\"08:40\":4,\"08:50\":4,\"09:00\":4,\"09:10\":4,\"09:20\":4,\"09:30\":4,\"09:40\":4,\"09:50\":4,\"10:00\":4,\"10:10\":4,\"10:20\":4,\"10:30\":4,\"10:40\":4,\"10:50\":4,\"11:00\":4,\"11:10\":4,\"11:20\":4,\"11:30\":4,\"11:40\":4,\"11:50\":4,\"12:00\":4,\"12:10\":4,\"12:20\":4,\"12:30\":4,\"12:40\":4,\"12:50\":4,\"13:00\":4,\"13:10\":4,\"13:20\":4,\"13:30\":4,\"13:40\":4,\"13:50\":4,\"14:00\":4,\"14:10\":4,\"14:20\":4,\"14:30\":4,\"14:40\":4,\"14:50\":4,\"15:00\":4,\"15:10\":4,\"15:20\":4,\"15:30\":4,\"15:40\":4,\"15:50\":4,\"16:00\":4,\"16:10\":4,\"16:20\":4,\"16:30\":4,\"16:40\":4,\"16:50\":4,\"17:00\":4,\"17:10\":4,\"17:20\":4,\"17:30\":4,\"17:40\":4,\"17:50\":4,\"18:00\":4}', 0, 4, '[1,2,3]', 1, 0),
(44, 'OA65c8ea318fdf84.54266493', 'IEC', 'hall05', 'ex_hall5_4', '2024-02-11', '2024-02-25', '08:00:00', '18:00:00', '2024-02-19', '{\"08:00\":4,\"08:10\":4,\"08:20\":4,\"08:30\":4,\"08:40\":4,\"08:50\":4,\"09:00\":4,\"09:10\":4,\"09:20\":4,\"09:30\":4,\"09:40\":4,\"09:50\":4,\"10:00\":4,\"10:10\":4,\"10:20\":4,\"10:30\":4,\"10:40\":4,\"10:50\":4,\"11:00\":4,\"11:10\":4,\"11:20\":4,\"11:30\":4,\"11:40\":4,\"11:50\":4,\"12:00\":4,\"12:10\":4,\"12:20\":4,\"12:30\":4,\"12:40\":4,\"12:50\":4,\"13:00\":4,\"13:10\":4,\"13:20\":4,\"13:30\":4,\"13:40\":4,\"13:50\":4,\"14:00\":4,\"14:10\":4,\"14:20\":4,\"14:30\":4,\"14:40\":4,\"14:50\":4,\"15:00\":4,\"15:10\":4,\"15:20\":4,\"15:30\":4,\"15:40\":4,\"15:50\":4,\"16:00\":4,\"16:10\":4,\"16:20\":4,\"16:30\":4,\"16:40\":4,\"16:50\":4,\"17:00\":4,\"17:10\":4,\"17:20\":4,\"17:30\":4,\"17:40\":4,\"17:50\":4,\"18:00\":4}', 0, 4, '[1,2,3]', 1, 0),
(44, 'OA65c8ea318fdf84.54266493', 'IEC', 'hall05', 'ex_hall5_4', '2024-02-11', '2024-02-25', '08:00:00', '18:00:00', '2024-02-20', '{\"08:00\":4,\"08:10\":4,\"08:20\":4,\"08:30\":4,\"08:40\":4,\"08:50\":4,\"09:00\":4,\"09:10\":4,\"09:20\":4,\"09:30\":4,\"09:40\":4,\"09:50\":4,\"10:00\":4,\"10:10\":4,\"10:20\":4,\"10:30\":4,\"10:40\":4,\"10:50\":4,\"11:00\":4,\"11:10\":4,\"11:20\":4,\"11:30\":4,\"11:40\":4,\"11:50\":4,\"12:00\":4,\"12:10\":4,\"12:20\":4,\"12:30\":4,\"12:40\":4,\"12:50\":4,\"13:00\":4,\"13:10\":4,\"13:20\":4,\"13:30\":4,\"13:40\":4,\"13:50\":4,\"14:00\":4,\"14:10\":4,\"14:20\":4,\"14:30\":4,\"14:40\":4,\"14:50\":4,\"15:00\":4,\"15:10\":4,\"15:20\":4,\"15:30\":4,\"15:40\":4,\"15:50\":4,\"16:00\":4,\"16:10\":4,\"16:20\":4,\"16:30\":4,\"16:40\":4,\"16:50\":4,\"17:00\":4,\"17:10\":4,\"17:20\":4,\"17:30\":4,\"17:40\":4,\"17:50\":4,\"18:00\":4}', 0, 4, '[1,2,3]', 1, 0),
(44, 'OA65c8ea318fdf84.54266493', 'IEC', 'hall05', 'ex_hall5_4', '2024-02-11', '2024-02-25', '08:00:00', '18:00:00', '2024-02-21', '{\"08:00\":4,\"08:10\":4,\"08:20\":4,\"08:30\":4,\"08:40\":4,\"08:50\":4,\"09:00\":4,\"09:10\":4,\"09:20\":4,\"09:30\":4,\"09:40\":4,\"09:50\":4,\"10:00\":4,\"10:10\":4,\"10:20\":4,\"10:30\":4,\"10:40\":4,\"10:50\":4,\"11:00\":4,\"11:10\":4,\"11:20\":4,\"11:30\":4,\"11:40\":4,\"11:50\":4,\"12:00\":4,\"12:10\":4,\"12:20\":4,\"12:30\":4,\"12:40\":4,\"12:50\":4,\"13:00\":4,\"13:10\":4,\"13:20\":4,\"13:30\":4,\"13:40\":4,\"13:50\":4,\"14:00\":4,\"14:10\":4,\"14:20\":4,\"14:30\":4,\"14:40\":4,\"14:50\":4,\"15:00\":4,\"15:10\":4,\"15:20\":4,\"15:30\":4,\"15:40\":4,\"15:50\":4,\"16:00\":4,\"16:10\":4,\"16:20\":4,\"16:30\":4,\"16:40\":4,\"16:50\":4,\"17:00\":4,\"17:10\":4,\"17:20\":4,\"17:30\":4,\"17:40\":4,\"17:50\":4,\"18:00\":4}', 0, 4, '[1,2,3]', 1, 0),
(44, 'OA65c8ea318fdf84.54266493', 'IEC', 'hall05', 'ex_hall5_4', '2024-02-11', '2024-02-25', '08:00:00', '18:00:00', '2024-02-22', '{\"08:00\":4,\"08:10\":4,\"08:20\":4,\"08:30\":4,\"08:40\":4,\"08:50\":4,\"09:00\":4,\"09:10\":4,\"09:20\":4,\"09:30\":4,\"09:40\":4,\"09:50\":4,\"10:00\":4,\"10:10\":4,\"10:20\":4,\"10:30\":4,\"10:40\":4,\"10:50\":4,\"11:00\":4,\"11:10\":4,\"11:20\":4,\"11:30\":4,\"11:40\":4,\"11:50\":4,\"12:00\":4,\"12:10\":4,\"12:20\":4,\"12:30\":4,\"12:40\":4,\"12:50\":4,\"13:00\":4,\"13:10\":4,\"13:20\":4,\"13:30\":4,\"13:40\":4,\"13:50\":4,\"14:00\":4,\"14:10\":4,\"14:20\":4,\"14:30\":4,\"14:40\":4,\"14:50\":4,\"15:00\":4,\"15:10\":4,\"15:20\":4,\"15:30\":4,\"15:40\":4,\"15:50\":4,\"16:00\":4,\"16:10\":4,\"16:20\":4,\"16:30\":4,\"16:40\":4,\"16:50\":4,\"17:00\":4,\"17:10\":4,\"17:20\":4,\"17:30\":4,\"17:40\":4,\"17:50\":4,\"18:00\":4}', 0, 4, '[1,2,3]', 1, 0),
(44, 'OA65c8ea318fdf84.54266493', 'IEC', 'hall05', 'ex_hall5_4', '2024-02-11', '2024-02-25', '08:00:00', '18:00:00', '2024-02-23', '{\"08:00\":4,\"08:10\":4,\"08:20\":4,\"08:30\":4,\"08:40\":4,\"08:50\":4,\"09:00\":4,\"09:10\":4,\"09:20\":4,\"09:30\":4,\"09:40\":4,\"09:50\":4,\"10:00\":4,\"10:10\":4,\"10:20\":4,\"10:30\":4,\"10:40\":4,\"10:50\":4,\"11:00\":4,\"11:10\":4,\"11:20\":4,\"11:30\":4,\"11:40\":4,\"11:50\":4,\"12:00\":4,\"12:10\":4,\"12:20\":4,\"12:30\":4,\"12:40\":4,\"12:50\":4,\"13:00\":4,\"13:10\":4,\"13:20\":4,\"13:30\":4,\"13:40\":4,\"13:50\":4,\"14:00\":4,\"14:10\":4,\"14:20\":4,\"14:30\":4,\"14:40\":4,\"14:50\":4,\"15:00\":4,\"15:10\":4,\"15:20\":4,\"15:30\":4,\"15:40\":4,\"15:50\":4,\"16:00\":4,\"16:10\":4,\"16:20\":4,\"16:30\":4,\"16:40\":4,\"16:50\":4,\"17:00\":4,\"17:10\":4,\"17:20\":4,\"17:30\":4,\"17:40\":4,\"17:50\":4,\"18:00\":4}', 0, 4, '[1,2,3]', 1, 0),
(44, 'OA65c8ea318fdf84.54266493', 'IEC', 'hall05', 'ex_hall5_4', '2024-02-11', '2024-02-25', '08:00:00', '18:00:00', '2024-02-24', '{\"08:00\":4,\"08:10\":4,\"08:20\":4,\"08:30\":4,\"08:40\":4,\"08:50\":4,\"09:00\":4,\"09:10\":4,\"09:20\":4,\"09:30\":4,\"09:40\":4,\"09:50\":4,\"10:00\":4,\"10:10\":4,\"10:20\":4,\"10:30\":4,\"10:40\":4,\"10:50\":4,\"11:00\":4,\"11:10\":4,\"11:20\":4,\"11:30\":4,\"11:40\":4,\"11:50\":4,\"12:00\":4,\"12:10\":4,\"12:20\":4,\"12:30\":4,\"12:40\":4,\"12:50\":4,\"13:00\":4,\"13:10\":4,\"13:20\":4,\"13:30\":4,\"13:40\":4,\"13:50\":4,\"14:00\":4,\"14:10\":4,\"14:20\":4,\"14:30\":4,\"14:40\":4,\"14:50\":4,\"15:00\":4,\"15:10\":4,\"15:20\":4,\"15:30\":4,\"15:40\":4,\"15:50\":4,\"16:00\":4,\"16:10\":4,\"16:20\":4,\"16:30\":4,\"16:40\":4,\"16:50\":4,\"17:00\":4,\"17:10\":4,\"17:20\":4,\"17:30\":4,\"17:40\":4,\"17:50\":4,\"18:00\":4}', 0, 4, '[1,2,3]', 1, 0),
(44, 'OA65c8ea318fdf84.54266493', 'IEC', 'hall05', 'ex_hall5_4', '2024-02-11', '2024-02-25', '08:00:00', '18:00:00', '2024-02-25', '{\"08:00\":4,\"08:10\":4,\"08:20\":4,\"08:30\":4,\"08:40\":4,\"08:50\":4,\"09:00\":4,\"09:10\":4,\"09:20\":4,\"09:30\":4,\"09:40\":4,\"09:50\":4,\"10:00\":4,\"10:10\":4,\"10:20\":4,\"10:30\":4,\"10:40\":4,\"10:50\":4,\"11:00\":4,\"11:10\":4,\"11:20\":4,\"11:30\":4,\"11:40\":4,\"11:50\":4,\"12:00\":4,\"12:10\":4,\"12:20\":4,\"12:30\":4,\"12:40\":4,\"12:50\":4,\"13:00\":4,\"13:10\":4,\"13:20\":4,\"13:30\":4,\"13:40\":4,\"13:50\":4,\"14:00\":4,\"14:10\":4,\"14:20\":4,\"14:30\":4,\"14:40\":4,\"14:50\":4,\"15:00\":4,\"15:10\":4,\"15:20\":4,\"15:30\":4,\"15:40\":4,\"15:50\":4,\"16:00\":4,\"16:10\":4,\"16:20\":4,\"16:30\":4,\"16:40\":4,\"16:50\":4,\"17:00\":4,\"17:10\":4,\"17:20\":4,\"17:30\":4,\"17:40\":4,\"17:50\":4,\"18:00\":4}', 0, 4, '[1,2,3]', 1, 0),
(45, 'OA65c8ea6a3ecd99.10105562', 'IF', 'hall04', 'fo_hall4_3', '2024-02-13', '2024-02-24', '08:00:00', '18:00:00', '2024-02-13', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3,\"10:10\":3,\"10:20\":3,\"10:30\":3,\"10:40\":3,\"10:50\":3,\"11:00\":3,\"11:10\":3,\"11:20\":3,\"11:30\":3,\"11:40\":3,\"11:50\":3,\"12:00\":3,\"12:10\":3,\"12:20\":3,\"12:30\":3,\"12:40\":3,\"12:50\":3,\"13:00\":3,\"13:10\":3,\"13:20\":3,\"13:30\":3,\"13:40\":3,\"13:50\":3,\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3,\"16:10\":3,\"16:20\":3,\"16:30\":3,\"16:40\":3,\"16:50\":3,\"17:00\":3,\"17:10\":3,\"17:20\":3,\"17:30\":3,\"17:40\":3,\"17:50\":3,\"18:00\":3}', 0, 3, '[1,2,3]', 1, 0),
(45, 'OA65c8ea6a3ecd99.10105562', 'IF', 'hall04', 'fo_hall4_3', '2024-02-13', '2024-02-24', '08:00:00', '18:00:00', '2024-02-14', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3,\"10:10\":3,\"10:20\":3,\"10:30\":3,\"10:40\":3,\"10:50\":3,\"11:00\":3,\"11:10\":3,\"11:20\":3,\"11:30\":3,\"11:40\":3,\"11:50\":3,\"12:00\":3,\"12:10\":3,\"12:20\":3,\"12:30\":3,\"12:40\":3,\"12:50\":3,\"13:00\":3,\"13:10\":3,\"13:20\":3,\"13:30\":3,\"13:40\":3,\"13:50\":3,\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3,\"16:10\":3,\"16:20\":3,\"16:30\":3,\"16:40\":3,\"16:50\":3,\"17:00\":3,\"17:10\":3,\"17:20\":3,\"17:30\":3,\"17:40\":3,\"17:50\":3,\"18:00\":3}', 0, 3, '[1,2,3]', 1, 0),
(45, 'OA65c8ea6a3ecd99.10105562', 'IF', 'hall04', 'fo_hall4_3', '2024-02-13', '2024-02-24', '08:00:00', '18:00:00', '2024-02-15', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3,\"10:10\":3,\"10:20\":3,\"10:30\":3,\"10:40\":3,\"10:50\":3,\"11:00\":3,\"11:10\":3,\"11:20\":3,\"11:30\":3,\"11:40\":3,\"11:50\":3,\"12:00\":3,\"12:10\":3,\"12:20\":3,\"12:30\":3,\"12:40\":3,\"12:50\":3,\"13:00\":3,\"13:10\":3,\"13:20\":3,\"13:30\":3,\"13:40\":3,\"13:50\":3,\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3,\"16:10\":3,\"16:20\":3,\"16:30\":3,\"16:40\":3,\"16:50\":3,\"17:00\":3,\"17:10\":3,\"17:20\":3,\"17:30\":3,\"17:40\":3,\"17:50\":3,\"18:00\":3}', 0, 3, '[1,2,3]', 1, 0),
(45, 'OA65c8ea6a3ecd99.10105562', 'IF', 'hall04', 'fo_hall4_3', '2024-02-13', '2024-02-24', '08:00:00', '18:00:00', '2024-02-16', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3,\"10:10\":3,\"10:20\":3,\"10:30\":3,\"10:40\":3,\"10:50\":3,\"11:00\":3,\"11:10\":3,\"11:20\":3,\"11:30\":3,\"11:40\":3,\"11:50\":3,\"12:00\":3,\"12:10\":3,\"12:20\":3,\"12:30\":3,\"12:40\":3,\"12:50\":3,\"13:00\":3,\"13:10\":3,\"13:20\":3,\"13:30\":3,\"13:40\":3,\"13:50\":3,\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3,\"16:10\":3,\"16:20\":3,\"16:30\":3,\"16:40\":3,\"16:50\":3,\"17:00\":3,\"17:10\":3,\"17:20\":3,\"17:30\":3,\"17:40\":3,\"17:50\":3,\"18:00\":3}', 0, 3, '[1,2,3]', 1, 0),
(45, 'OA65c8ea6a3ecd99.10105562', 'IF', 'hall04', 'fo_hall4_3', '2024-02-13', '2024-02-24', '08:00:00', '18:00:00', '2024-02-17', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3,\"10:10\":3,\"10:20\":3,\"10:30\":3,\"10:40\":3,\"10:50\":3,\"11:00\":3,\"11:10\":3,\"11:20\":3,\"11:30\":3,\"11:40\":3,\"11:50\":3,\"12:00\":3,\"12:10\":3,\"12:20\":3,\"12:30\":3,\"12:40\":3,\"12:50\":3,\"13:00\":3,\"13:10\":3,\"13:20\":3,\"13:30\":3,\"13:40\":3,\"13:50\":3,\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3,\"16:10\":3,\"16:20\":3,\"16:30\":3,\"16:40\":3,\"16:50\":3,\"17:00\":3,\"17:10\":3,\"17:20\":3,\"17:30\":3,\"17:40\":3,\"17:50\":3,\"18:00\":3}', 0, 3, '[1,2,3]', 1, 0),
(45, 'OA65c8ea6a3ecd99.10105562', 'IF', 'hall04', 'fo_hall4_3', '2024-02-13', '2024-02-24', '08:00:00', '18:00:00', '2024-02-18', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3,\"10:10\":3,\"10:20\":3,\"10:30\":3,\"10:40\":3,\"10:50\":3,\"11:00\":3,\"11:10\":3,\"11:20\":3,\"11:30\":3,\"11:40\":3,\"11:50\":3,\"12:00\":3,\"12:10\":3,\"12:20\":3,\"12:30\":3,\"12:40\":3,\"12:50\":3,\"13:00\":3,\"13:10\":3,\"13:20\":3,\"13:30\":3,\"13:40\":3,\"13:50\":3,\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3,\"16:10\":3,\"16:20\":3,\"16:30\":3,\"16:40\":3,\"16:50\":3,\"17:00\":3,\"17:10\":3,\"17:20\":3,\"17:30\":3,\"17:40\":3,\"17:50\":3,\"18:00\":3}', 0, 3, '[1,2,3]', 1, 0),
(45, 'OA65c8ea6a3ecd99.10105562', 'IF', 'hall04', 'fo_hall4_3', '2024-02-13', '2024-02-24', '08:00:00', '18:00:00', '2024-02-19', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3,\"10:10\":3,\"10:20\":3,\"10:30\":3,\"10:40\":3,\"10:50\":3,\"11:00\":3,\"11:10\":3,\"11:20\":3,\"11:30\":3,\"11:40\":3,\"11:50\":3,\"12:00\":3,\"12:10\":3,\"12:20\":3,\"12:30\":3,\"12:40\":3,\"12:50\":3,\"13:00\":3,\"13:10\":3,\"13:20\":3,\"13:30\":3,\"13:40\":3,\"13:50\":3,\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3,\"16:10\":3,\"16:20\":3,\"16:30\":3,\"16:40\":3,\"16:50\":3,\"17:00\":3,\"17:10\":3,\"17:20\":3,\"17:30\":3,\"17:40\":3,\"17:50\":3,\"18:00\":3}', 0, 3, '[1,2,3]', 1, 0),
(45, 'OA65c8ea6a3ecd99.10105562', 'IF', 'hall04', 'fo_hall4_3', '2024-02-13', '2024-02-24', '08:00:00', '18:00:00', '2024-02-20', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3,\"10:10\":3,\"10:20\":3,\"10:30\":3,\"10:40\":3,\"10:50\":3,\"11:00\":3,\"11:10\":3,\"11:20\":3,\"11:30\":3,\"11:40\":3,\"11:50\":3,\"12:00\":3,\"12:10\":3,\"12:20\":3,\"12:30\":3,\"12:40\":3,\"12:50\":3,\"13:00\":3,\"13:10\":3,\"13:20\":3,\"13:30\":3,\"13:40\":3,\"13:50\":3,\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3,\"16:10\":3,\"16:20\":3,\"16:30\":3,\"16:40\":3,\"16:50\":3,\"17:00\":3,\"17:10\":3,\"17:20\":3,\"17:30\":3,\"17:40\":3,\"17:50\":3,\"18:00\":3}', 0, 3, '[1,2,3]', 1, 0),
(45, 'OA65c8ea6a3ecd99.10105562', 'IF', 'hall04', 'fo_hall4_3', '2024-02-13', '2024-02-24', '08:00:00', '18:00:00', '2024-02-21', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3,\"10:10\":3,\"10:20\":3,\"10:30\":3,\"10:40\":3,\"10:50\":3,\"11:00\":3,\"11:10\":3,\"11:20\":3,\"11:30\":3,\"11:40\":3,\"11:50\":3,\"12:00\":3,\"12:10\":3,\"12:20\":3,\"12:30\":3,\"12:40\":3,\"12:50\":3,\"13:00\":3,\"13:10\":3,\"13:20\":3,\"13:30\":3,\"13:40\":3,\"13:50\":3,\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3,\"16:10\":3,\"16:20\":3,\"16:30\":3,\"16:40\":3,\"16:50\":3,\"17:00\":3,\"17:10\":3,\"17:20\":3,\"17:30\":3,\"17:40\":3,\"17:50\":3,\"18:00\":3}', 0, 3, '[1,2,3]', 1, 0),
(45, 'OA65c8ea6a3ecd99.10105562', 'IF', 'hall04', 'fo_hall4_3', '2024-02-13', '2024-02-24', '08:00:00', '18:00:00', '2024-02-22', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3,\"10:10\":3,\"10:20\":3,\"10:30\":3,\"10:40\":3,\"10:50\":3,\"11:00\":3,\"11:10\":3,\"11:20\":3,\"11:30\":3,\"11:40\":3,\"11:50\":3,\"12:00\":3,\"12:10\":3,\"12:20\":3,\"12:30\":3,\"12:40\":3,\"12:50\":3,\"13:00\":3,\"13:10\":3,\"13:20\":3,\"13:30\":3,\"13:40\":3,\"13:50\":3,\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3,\"16:10\":3,\"16:20\":3,\"16:30\":3,\"16:40\":3,\"16:50\":3,\"17:00\":3,\"17:10\":3,\"17:20\":3,\"17:30\":3,\"17:40\":3,\"17:50\":3,\"18:00\":3}', 0, 3, '[1,2,3]', 1, 0),
(45, 'OA65c8ea6a3ecd99.10105562', 'IF', 'hall04', 'fo_hall4_3', '2024-02-13', '2024-02-24', '08:00:00', '18:00:00', '2024-02-23', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3,\"10:10\":3,\"10:20\":3,\"10:30\":3,\"10:40\":3,\"10:50\":3,\"11:00\":3,\"11:10\":3,\"11:20\":3,\"11:30\":3,\"11:40\":3,\"11:50\":3,\"12:00\":3,\"12:10\":3,\"12:20\":3,\"12:30\":3,\"12:40\":3,\"12:50\":3,\"13:00\":3,\"13:10\":3,\"13:20\":3,\"13:30\":3,\"13:40\":3,\"13:50\":3,\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3,\"16:10\":3,\"16:20\":3,\"16:30\":3,\"16:40\":3,\"16:50\":3,\"17:00\":3,\"17:10\":3,\"17:20\":3,\"17:30\":3,\"17:40\":3,\"17:50\":3,\"18:00\":3}', 0, 3, '[1,2,3]', 1, 0),
(45, 'OA65c8ea6a3ecd99.10105562', 'IF', 'hall04', 'fo_hall4_3', '2024-02-13', '2024-02-24', '08:00:00', '18:00:00', '2024-02-24', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3,\"10:10\":3,\"10:20\":3,\"10:30\":3,\"10:40\":3,\"10:50\":3,\"11:00\":3,\"11:10\":3,\"11:20\":3,\"11:30\":3,\"11:40\":3,\"11:50\":3,\"12:00\":3,\"12:10\":3,\"12:20\":3,\"12:30\":3,\"12:40\":3,\"12:50\":3,\"13:00\":3,\"13:10\":3,\"13:20\":3,\"13:30\":3,\"13:40\":3,\"13:50\":3,\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3,\"16:10\":3,\"16:20\":3,\"16:30\":3,\"16:40\":3,\"16:50\":3,\"17:00\":3,\"17:10\":3,\"17:20\":3,\"17:30\":3,\"17:40\":3,\"17:50\":3,\"18:00\":3}', 0, 3, '[1,2,3]', 1, 0),
(46, 'OA65c9abb8375a62.06965850', 'CH', 'hall02', 'ch_hall2_3', '2024-02-13', '2024-02-29', '09:00:00', '13:00:00', '2024-02-13', '{\"09:00\":83,\"09:10\":83,\"09:20\":83,\"09:30\":83,\"09:40\":83,\"09:50\":83,\"10:00\":83,\"10:10\":83,\"10:20\":83,\"10:30\":83,\"10:40\":83,\"10:50\":83,\"11:00\":83,\"11:10\":83,\"11:20\":83,\"11:30\":83,\"11:40\":83,\"11:50\":83,\"12:00\":83,\"12:10\":83,\"12:20\":83,\"12:30\":83,\"12:40\":83,\"12:50\":83,\"13:00\":83}', 0, 83, '[2,3]', 1, 0),
(46, 'OA65c9abb8375a62.06965850', 'CH', 'hall02', 'ch_hall2_3', '2024-02-13', '2024-02-29', '09:00:00', '13:00:00', '2024-02-14', '{\"09:00\":83,\"09:10\":83,\"09:20\":83,\"09:30\":83,\"09:40\":83,\"09:50\":83,\"10:00\":83,\"10:10\":83,\"10:20\":83,\"10:30\":83,\"10:40\":83,\"10:50\":83,\"11:00\":83,\"11:10\":83,\"11:20\":83,\"11:30\":83,\"11:40\":83,\"11:50\":83,\"12:00\":83,\"12:10\":83,\"12:20\":83,\"12:30\":83,\"12:40\":83,\"12:50\":83,\"13:00\":83}', 0, 83, '[2,3]', 1, 0),
(46, 'OA65c9abb8375a62.06965850', 'CH', 'hall02', 'ch_hall2_3', '2024-02-13', '2024-02-29', '09:00:00', '13:00:00', '2024-02-15', '{\"09:00\":83,\"09:10\":83,\"09:20\":83,\"09:30\":83,\"09:40\":83,\"09:50\":83,\"10:00\":83,\"10:10\":83,\"10:20\":83,\"10:30\":83,\"10:40\":83,\"10:50\":83,\"11:00\":83,\"11:10\":83,\"11:20\":83,\"11:30\":83,\"11:40\":83,\"11:50\":83,\"12:00\":83,\"12:10\":83,\"12:20\":83,\"12:30\":83,\"12:40\":83,\"12:50\":83,\"13:00\":83}', 0, 83, '[2,3]', 1, 0),
(46, 'OA65c9abb8375a62.06965850', 'CH', 'hall02', 'ch_hall2_3', '2024-02-13', '2024-02-29', '09:00:00', '13:00:00', '2024-02-16', '{\"09:00\":83,\"09:10\":83,\"09:20\":83,\"09:30\":83,\"09:40\":83,\"09:50\":83,\"10:00\":83,\"10:10\":83,\"10:20\":83,\"10:30\":83,\"10:40\":83,\"10:50\":83,\"11:00\":83,\"11:10\":83,\"11:20\":83,\"11:30\":83,\"11:40\":83,\"11:50\":83,\"12:00\":83,\"12:10\":83,\"12:20\":83,\"12:30\":83,\"12:40\":83,\"12:50\":83,\"13:00\":83}', 0, 83, '[2,3]', 1, 0),
(46, 'OA65c9abb8375a62.06965850', 'CH', 'hall02', 'ch_hall2_3', '2024-02-13', '2024-02-29', '09:00:00', '13:00:00', '2024-02-17', '{\"09:00\":83,\"09:10\":83,\"09:20\":83,\"09:30\":83,\"09:40\":83,\"09:50\":83,\"10:00\":83,\"10:10\":83,\"10:20\":83,\"10:30\":83,\"10:40\":83,\"10:50\":83,\"11:00\":83,\"11:10\":83,\"11:20\":83,\"11:30\":83,\"11:40\":83,\"11:50\":83,\"12:00\":83,\"12:10\":83,\"12:20\":83,\"12:30\":83,\"12:40\":83,\"12:50\":83,\"13:00\":83}', 0, 83, '[2,3]', 1, 0),
(46, 'OA65c9abb8375a62.06965850', 'CH', 'hall02', 'ch_hall2_3', '2024-02-13', '2024-02-29', '09:00:00', '13:00:00', '2024-02-18', '{\"09:00\":83,\"09:10\":83,\"09:20\":83,\"09:30\":83,\"09:40\":83,\"09:50\":83,\"10:00\":83,\"10:10\":83,\"10:20\":83,\"10:30\":83,\"10:40\":83,\"10:50\":83,\"11:00\":83,\"11:10\":83,\"11:20\":83,\"11:30\":83,\"11:40\":83,\"11:50\":83,\"12:00\":83,\"12:10\":83,\"12:20\":83,\"12:30\":83,\"12:40\":83,\"12:50\":83,\"13:00\":83}', 0, 83, '[2,3]', 1, 0),
(46, 'OA65c9abb8375a62.06965850', 'CH', 'hall02', 'ch_hall2_3', '2024-02-13', '2024-02-29', '09:00:00', '13:00:00', '2024-02-19', '{\"09:00\":83,\"09:10\":83,\"09:20\":83,\"09:30\":83,\"09:40\":83,\"09:50\":83,\"10:00\":83,\"10:10\":83,\"10:20\":83,\"10:30\":83,\"10:40\":83,\"10:50\":83,\"11:00\":83,\"11:10\":83,\"11:20\":83,\"11:30\":83,\"11:40\":83,\"11:50\":83,\"12:00\":83,\"12:10\":83,\"12:20\":83,\"12:30\":83,\"12:40\":83,\"12:50\":83,\"13:00\":83}', 0, 83, '[2,3]', 1, 0),
(46, 'OA65c9abb8375a62.06965850', 'CH', 'hall02', 'ch_hall2_3', '2024-02-13', '2024-02-29', '09:00:00', '13:00:00', '2024-02-20', '{\"09:00\":83,\"09:10\":83,\"09:20\":83,\"09:30\":83,\"09:40\":83,\"09:50\":83,\"10:00\":83,\"10:10\":83,\"10:20\":83,\"10:30\":83,\"10:40\":83,\"10:50\":83,\"11:00\":83,\"11:10\":83,\"11:20\":83,\"11:30\":83,\"11:40\":83,\"11:50\":83,\"12:00\":83,\"12:10\":83,\"12:20\":83,\"12:30\":83,\"12:40\":83,\"12:50\":83,\"13:00\":83}', 0, 83, '[2,3]', 1, 0),
(46, 'OA65c9abb8375a62.06965850', 'CH', 'hall02', 'ch_hall2_3', '2024-02-13', '2024-02-29', '09:00:00', '13:00:00', '2024-02-21', '{\"09:00\":83,\"09:10\":83,\"09:20\":83,\"09:30\":83,\"09:40\":83,\"09:50\":83,\"10:00\":83,\"10:10\":83,\"10:20\":83,\"10:30\":83,\"10:40\":83,\"10:50\":83,\"11:00\":83,\"11:10\":83,\"11:20\":83,\"11:30\":83,\"11:40\":83,\"11:50\":83,\"12:00\":83,\"12:10\":83,\"12:20\":83,\"12:30\":83,\"12:40\":83,\"12:50\":83,\"13:00\":83}', 0, 83, '[2,3]', 1, 0),
(46, 'OA65c9abb8375a62.06965850', 'CH', 'hall02', 'ch_hall2_3', '2024-02-13', '2024-02-29', '09:00:00', '13:00:00', '2024-02-22', '{\"09:00\":83,\"09:10\":83,\"09:20\":83,\"09:30\":83,\"09:40\":83,\"09:50\":83,\"10:00\":83,\"10:10\":83,\"10:20\":83,\"10:30\":83,\"10:40\":83,\"10:50\":83,\"11:00\":83,\"11:10\":83,\"11:20\":83,\"11:30\":83,\"11:40\":83,\"11:50\":83,\"12:00\":83,\"12:10\":83,\"12:20\":83,\"12:30\":83,\"12:40\":83,\"12:50\":83,\"13:00\":83}', 0, 83, '[2,3]', 1, 0),
(46, 'OA65c9abb8375a62.06965850', 'CH', 'hall02', 'ch_hall2_3', '2024-02-13', '2024-02-29', '09:00:00', '13:00:00', '2024-02-23', '{\"09:00\":83,\"09:10\":83,\"09:20\":83,\"09:30\":83,\"09:40\":83,\"09:50\":83,\"10:00\":83,\"10:10\":83,\"10:20\":83,\"10:30\":83,\"10:40\":83,\"10:50\":83,\"11:00\":83,\"11:10\":83,\"11:20\":83,\"11:30\":83,\"11:40\":83,\"11:50\":83,\"12:00\":83,\"12:10\":83,\"12:20\":83,\"12:30\":83,\"12:40\":83,\"12:50\":83,\"13:00\":83}', 0, 83, '[2,3]', 1, 0),
(46, 'OA65c9abb8375a62.06965850', 'CH', 'hall02', 'ch_hall2_3', '2024-02-13', '2024-02-29', '09:00:00', '13:00:00', '2024-02-24', '{\"09:00\":83,\"09:10\":83,\"09:20\":83,\"09:30\":83,\"09:40\":83,\"09:50\":83,\"10:00\":83,\"10:10\":83,\"10:20\":83,\"10:30\":83,\"10:40\":83,\"10:50\":83,\"11:00\":83,\"11:10\":83,\"11:20\":83,\"11:30\":83,\"11:40\":83,\"11:50\":83,\"12:00\":83,\"12:10\":83,\"12:20\":83,\"12:30\":83,\"12:40\":83,\"12:50\":83,\"13:00\":83}', 0, 83, '[2,3]', 1, 0),
(46, 'OA65c9abb8375a62.06965850', 'CH', 'hall02', 'ch_hall2_3', '2024-02-13', '2024-02-29', '09:00:00', '13:00:00', '2024-02-25', '{\"09:00\":83,\"09:10\":83,\"09:20\":83,\"09:30\":83,\"09:40\":83,\"09:50\":83,\"10:00\":83,\"10:10\":83,\"10:20\":83,\"10:30\":83,\"10:40\":83,\"10:50\":83,\"11:00\":83,\"11:10\":83,\"11:20\":83,\"11:30\":83,\"11:40\":83,\"11:50\":83,\"12:00\":83,\"12:10\":83,\"12:20\":83,\"12:30\":83,\"12:40\":83,\"12:50\":83,\"13:00\":83}', 0, 83, '[2,3]', 1, 0),
(46, 'OA65c9abb8375a62.06965850', 'CH', 'hall02', 'ch_hall2_3', '2024-02-13', '2024-02-29', '09:00:00', '13:00:00', '2024-02-26', '{\"09:00\":83,\"09:10\":83,\"09:20\":83,\"09:30\":83,\"09:40\":83,\"09:50\":83,\"10:00\":83,\"10:10\":83,\"10:20\":83,\"10:30\":83,\"10:40\":83,\"10:50\":83,\"11:00\":83,\"11:10\":83,\"11:20\":83,\"11:30\":83,\"11:40\":83,\"11:50\":83,\"12:00\":83,\"12:10\":83,\"12:20\":83,\"12:30\":83,\"12:40\":83,\"12:50\":83,\"13:00\":83}', 0, 83, '[2,3]', 1, 0),
(46, 'OA65c9abb8375a62.06965850', 'CH', 'hall02', 'ch_hall2_3', '2024-02-13', '2024-02-29', '09:00:00', '13:00:00', '2024-02-27', '{\"09:00\":83,\"09:10\":83,\"09:20\":83,\"09:30\":83,\"09:40\":83,\"09:50\":83,\"10:00\":83,\"10:10\":83,\"10:20\":83,\"10:30\":83,\"10:40\":83,\"10:50\":83,\"11:00\":83,\"11:10\":83,\"11:20\":83,\"11:30\":83,\"11:40\":83,\"11:50\":83,\"12:00\":83,\"12:10\":83,\"12:20\":83,\"12:30\":83,\"12:40\":83,\"12:50\":83,\"13:00\":83}', 0, 83, '[2,3]', 1, 0),
(46, 'OA65c9abb8375a62.06965850', 'CH', 'hall02', 'ch_hall2_3', '2024-02-13', '2024-02-29', '09:00:00', '13:00:00', '2024-02-28', '{\"09:00\":83,\"09:10\":83,\"09:20\":83,\"09:30\":83,\"09:40\":83,\"09:50\":83,\"10:00\":83,\"10:10\":83,\"10:20\":83,\"10:30\":83,\"10:40\":83,\"10:50\":83,\"11:00\":83,\"11:10\":83,\"11:20\":83,\"11:30\":83,\"11:40\":83,\"11:50\":83,\"12:00\":83,\"12:10\":83,\"12:20\":83,\"12:30\":83,\"12:40\":83,\"12:50\":83,\"13:00\":83}', 0, 83, '[2,3]', 1, 0),
(46, 'OA65c9abb8375a62.06965850', 'CH', 'hall02', 'ch_hall2_3', '2024-02-13', '2024-02-29', '09:00:00', '13:00:00', '2024-02-29', '{\"09:00\":83,\"09:10\":83,\"09:20\":83,\"09:30\":83,\"09:40\":83,\"09:50\":83,\"10:00\":83,\"10:10\":83,\"10:20\":83,\"10:30\":83,\"10:40\":83,\"10:50\":83,\"11:00\":83,\"11:10\":83,\"11:20\":83,\"11:30\":83,\"11:40\":83,\"11:50\":83,\"12:00\":83,\"12:10\":83,\"12:20\":83,\"12:30\":83,\"12:40\":83,\"12:50\":83,\"13:00\":83}', 0, 83, '[2,3]', 1, 0);
INSERT INTO `tbl_open_area_schedule_sub_details` (`open_id`, `id`, `building_id`, `hall_id`, `event_name`, `open_date_start`, `open_date_end`, `open_time_start`, `open_time_end`, `open_date`, `open_time_json`, `number_slots_already_booked`, `reservable_slots`, `car_type_json`, `is_active`, `is_deleted`) VALUES
(46, 'OA65c9abb8375a62.06965850', 'CH', 'hall02', 'ch_hall2_3', '2024-02-13', '2024-02-29', '13:30:00', '17:00:00', '2024-02-13', '{\"13:30\":83,\"13:40\":83,\"13:50\":83,\"14:00\":83,\"14:10\":83,\"14:20\":83,\"14:30\":83,\"14:40\":83,\"14:50\":83,\"15:00\":83,\"15:10\":83,\"15:20\":83,\"15:30\":83,\"15:40\":83,\"15:50\":83,\"16:00\":83,\"16:10\":83,\"16:20\":83,\"16:30\":83,\"16:40\":83,\"16:50\":83,\"17:00\":83}', 0, 83, '[1]', 1, 0),
(46, 'OA65c9abb8375a62.06965850', 'CH', 'hall02', 'ch_hall2_3', '2024-02-13', '2024-02-29', '13:30:00', '17:00:00', '2024-02-14', '{\"13:30\":83,\"13:40\":83,\"13:50\":83,\"14:00\":83,\"14:10\":83,\"14:20\":83,\"14:30\":83,\"14:40\":83,\"14:50\":83,\"15:00\":83,\"15:10\":83,\"15:20\":83,\"15:30\":83,\"15:40\":83,\"15:50\":83,\"16:00\":83,\"16:10\":83,\"16:20\":83,\"16:30\":83,\"16:40\":83,\"16:50\":83,\"17:00\":83}', 0, 83, '[1]', 1, 0),
(46, 'OA65c9abb8375a62.06965850', 'CH', 'hall02', 'ch_hall2_3', '2024-02-13', '2024-02-29', '13:30:00', '17:00:00', '2024-02-15', '{\"13:30\":83,\"13:40\":83,\"13:50\":83,\"14:00\":83,\"14:10\":83,\"14:20\":83,\"14:30\":83,\"14:40\":83,\"14:50\":83,\"15:00\":83,\"15:10\":83,\"15:20\":83,\"15:30\":83,\"15:40\":83,\"15:50\":83,\"16:00\":83,\"16:10\":83,\"16:20\":83,\"16:30\":83,\"16:40\":83,\"16:50\":83,\"17:00\":83}', 0, 83, '[1]', 1, 0),
(46, 'OA65c9abb8375a62.06965850', 'CH', 'hall02', 'ch_hall2_3', '2024-02-13', '2024-02-29', '13:30:00', '17:00:00', '2024-02-16', '{\"13:30\":83,\"13:40\":83,\"13:50\":83,\"14:00\":83,\"14:10\":83,\"14:20\":83,\"14:30\":83,\"14:40\":83,\"14:50\":83,\"15:00\":83,\"15:10\":83,\"15:20\":83,\"15:30\":83,\"15:40\":83,\"15:50\":83,\"16:00\":83,\"16:10\":83,\"16:20\":83,\"16:30\":83,\"16:40\":83,\"16:50\":83,\"17:00\":83}', 0, 83, '[1]', 1, 0),
(46, 'OA65c9abb8375a62.06965850', 'CH', 'hall02', 'ch_hall2_3', '2024-02-13', '2024-02-29', '13:30:00', '17:00:00', '2024-02-17', '{\"13:30\":83,\"13:40\":83,\"13:50\":83,\"14:00\":83,\"14:10\":83,\"14:20\":83,\"14:30\":83,\"14:40\":83,\"14:50\":83,\"15:00\":83,\"15:10\":83,\"15:20\":83,\"15:30\":83,\"15:40\":83,\"15:50\":83,\"16:00\":83,\"16:10\":83,\"16:20\":83,\"16:30\":83,\"16:40\":83,\"16:50\":83,\"17:00\":83}', 0, 83, '[1]', 1, 0),
(46, 'OA65c9abb8375a62.06965850', 'CH', 'hall02', 'ch_hall2_3', '2024-02-13', '2024-02-29', '13:30:00', '17:00:00', '2024-02-18', '{\"13:30\":83,\"13:40\":83,\"13:50\":83,\"14:00\":83,\"14:10\":83,\"14:20\":83,\"14:30\":83,\"14:40\":83,\"14:50\":83,\"15:00\":83,\"15:10\":83,\"15:20\":83,\"15:30\":83,\"15:40\":83,\"15:50\":83,\"16:00\":83,\"16:10\":83,\"16:20\":83,\"16:30\":83,\"16:40\":83,\"16:50\":83,\"17:00\":83}', 0, 83, '[1]', 1, 0),
(46, 'OA65c9abb8375a62.06965850', 'CH', 'hall02', 'ch_hall2_3', '2024-02-13', '2024-02-29', '13:30:00', '17:00:00', '2024-02-19', '{\"13:30\":83,\"13:40\":83,\"13:50\":83,\"14:00\":83,\"14:10\":83,\"14:20\":83,\"14:30\":83,\"14:40\":83,\"14:50\":83,\"15:00\":83,\"15:10\":83,\"15:20\":83,\"15:30\":83,\"15:40\":83,\"15:50\":83,\"16:00\":83,\"16:10\":83,\"16:20\":83,\"16:30\":83,\"16:40\":83,\"16:50\":83,\"17:00\":83}', 0, 83, '[1]', 1, 0),
(46, 'OA65c9abb8375a62.06965850', 'CH', 'hall02', 'ch_hall2_3', '2024-02-13', '2024-02-29', '13:30:00', '17:00:00', '2024-02-20', '{\"13:30\":83,\"13:40\":83,\"13:50\":83,\"14:00\":83,\"14:10\":83,\"14:20\":83,\"14:30\":83,\"14:40\":83,\"14:50\":83,\"15:00\":83,\"15:10\":83,\"15:20\":83,\"15:30\":83,\"15:40\":83,\"15:50\":83,\"16:00\":83,\"16:10\":83,\"16:20\":83,\"16:30\":83,\"16:40\":83,\"16:50\":83,\"17:00\":83}', 0, 83, '[1]', 1, 0),
(46, 'OA65c9abb8375a62.06965850', 'CH', 'hall02', 'ch_hall2_3', '2024-02-13', '2024-02-29', '13:30:00', '17:00:00', '2024-02-21', '{\"13:30\":83,\"13:40\":83,\"13:50\":83,\"14:00\":83,\"14:10\":83,\"14:20\":83,\"14:30\":83,\"14:40\":83,\"14:50\":83,\"15:00\":83,\"15:10\":83,\"15:20\":83,\"15:30\":83,\"15:40\":83,\"15:50\":83,\"16:00\":83,\"16:10\":83,\"16:20\":83,\"16:30\":83,\"16:40\":83,\"16:50\":83,\"17:00\":83}', 0, 83, '[1]', 1, 0),
(46, 'OA65c9abb8375a62.06965850', 'CH', 'hall02', 'ch_hall2_3', '2024-02-13', '2024-02-29', '13:30:00', '17:00:00', '2024-02-22', '{\"13:30\":83,\"13:40\":83,\"13:50\":83,\"14:00\":83,\"14:10\":83,\"14:20\":83,\"14:30\":83,\"14:40\":83,\"14:50\":83,\"15:00\":83,\"15:10\":83,\"15:20\":83,\"15:30\":83,\"15:40\":83,\"15:50\":83,\"16:00\":83,\"16:10\":83,\"16:20\":83,\"16:30\":83,\"16:40\":83,\"16:50\":83,\"17:00\":83}', 0, 83, '[1]', 1, 0),
(46, 'OA65c9abb8375a62.06965850', 'CH', 'hall02', 'ch_hall2_3', '2024-02-13', '2024-02-29', '13:30:00', '17:00:00', '2024-02-23', '{\"13:30\":83,\"13:40\":83,\"13:50\":83,\"14:00\":83,\"14:10\":83,\"14:20\":83,\"14:30\":83,\"14:40\":83,\"14:50\":83,\"15:00\":83,\"15:10\":83,\"15:20\":83,\"15:30\":83,\"15:40\":83,\"15:50\":83,\"16:00\":83,\"16:10\":83,\"16:20\":83,\"16:30\":83,\"16:40\":83,\"16:50\":83,\"17:00\":83}', 0, 83, '[1]', 1, 0),
(46, 'OA65c9abb8375a62.06965850', 'CH', 'hall02', 'ch_hall2_3', '2024-02-13', '2024-02-29', '13:30:00', '17:00:00', '2024-02-24', '{\"13:30\":83,\"13:40\":83,\"13:50\":83,\"14:00\":83,\"14:10\":83,\"14:20\":83,\"14:30\":83,\"14:40\":83,\"14:50\":83,\"15:00\":83,\"15:10\":83,\"15:20\":83,\"15:30\":83,\"15:40\":83,\"15:50\":83,\"16:00\":83,\"16:10\":83,\"16:20\":83,\"16:30\":83,\"16:40\":83,\"16:50\":83,\"17:00\":83}', 0, 83, '[1]', 1, 0),
(46, 'OA65c9abb8375a62.06965850', 'CH', 'hall02', 'ch_hall2_3', '2024-02-13', '2024-02-29', '13:30:00', '17:00:00', '2024-02-25', '{\"13:30\":83,\"13:40\":83,\"13:50\":83,\"14:00\":83,\"14:10\":83,\"14:20\":83,\"14:30\":83,\"14:40\":83,\"14:50\":83,\"15:00\":83,\"15:10\":83,\"15:20\":83,\"15:30\":83,\"15:40\":83,\"15:50\":83,\"16:00\":83,\"16:10\":83,\"16:20\":83,\"16:30\":83,\"16:40\":83,\"16:50\":83,\"17:00\":83}', 0, 83, '[1]', 1, 0),
(46, 'OA65c9abb8375a62.06965850', 'CH', 'hall02', 'ch_hall2_3', '2024-02-13', '2024-02-29', '13:30:00', '17:00:00', '2024-02-26', '{\"13:30\":83,\"13:40\":83,\"13:50\":83,\"14:00\":83,\"14:10\":83,\"14:20\":83,\"14:30\":83,\"14:40\":83,\"14:50\":83,\"15:00\":83,\"15:10\":83,\"15:20\":83,\"15:30\":83,\"15:40\":83,\"15:50\":83,\"16:00\":83,\"16:10\":83,\"16:20\":83,\"16:30\":83,\"16:40\":83,\"16:50\":83,\"17:00\":83}', 0, 83, '[1]', 1, 0),
(46, 'OA65c9abb8375a62.06965850', 'CH', 'hall02', 'ch_hall2_3', '2024-02-13', '2024-02-29', '13:30:00', '17:00:00', '2024-02-27', '{\"13:30\":83,\"13:40\":83,\"13:50\":83,\"14:00\":83,\"14:10\":83,\"14:20\":83,\"14:30\":83,\"14:40\":83,\"14:50\":83,\"15:00\":83,\"15:10\":83,\"15:20\":83,\"15:30\":83,\"15:40\":83,\"15:50\":83,\"16:00\":83,\"16:10\":83,\"16:20\":83,\"16:30\":83,\"16:40\":83,\"16:50\":83,\"17:00\":83}', 0, 83, '[1]', 1, 0),
(46, 'OA65c9abb8375a62.06965850', 'CH', 'hall02', 'ch_hall2_3', '2024-02-13', '2024-02-29', '13:30:00', '17:00:00', '2024-02-28', '{\"13:30\":83,\"13:40\":83,\"13:50\":83,\"14:00\":83,\"14:10\":83,\"14:20\":83,\"14:30\":83,\"14:40\":83,\"14:50\":83,\"15:00\":83,\"15:10\":83,\"15:20\":83,\"15:30\":83,\"15:40\":83,\"15:50\":83,\"16:00\":83,\"16:10\":83,\"16:20\":83,\"16:30\":83,\"16:40\":83,\"16:50\":83,\"17:00\":83}', 0, 83, '[1]', 1, 0),
(46, 'OA65c9abb8375a62.06965850', 'CH', 'hall02', 'ch_hall2_3', '2024-02-13', '2024-02-29', '13:30:00', '17:00:00', '2024-02-29', '{\"13:30\":83,\"13:40\":83,\"13:50\":83,\"14:00\":83,\"14:10\":83,\"14:20\":83,\"14:30\":83,\"14:40\":83,\"14:50\":83,\"15:00\":83,\"15:10\":83,\"15:20\":83,\"15:30\":83,\"15:40\":83,\"15:50\":83,\"16:00\":83,\"16:10\":83,\"16:20\":83,\"16:30\":83,\"16:40\":83,\"16:50\":83,\"17:00\":83}', 0, 83, '[1]', 1, 0),
(47, 'OA65c9d0d24f5731.62424399', 'IEC', 'hall06', 'ex_hall6_3', '2024-02-12', '2024-02-20', '08:00:00', '10:00:00', '2024-02-12', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3}', 0, 3, '[2,3]', 1, 0),
(47, 'OA65c9d0d24f5731.62424399', 'IEC', 'hall06', 'ex_hall6_3', '2024-02-12', '2024-02-20', '08:00:00', '10:00:00', '2024-02-13', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3}', 0, 3, '[2,3]', 1, 0),
(47, 'OA65c9d0d24f5731.62424399', 'IEC', 'hall06', 'ex_hall6_3', '2024-02-12', '2024-02-20', '08:00:00', '10:00:00', '2024-02-14', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3}', 0, 3, '[2,3]', 1, 0),
(47, 'OA65c9d0d24f5731.62424399', 'IEC', 'hall06', 'ex_hall6_3', '2024-02-12', '2024-02-20', '08:00:00', '10:00:00', '2024-02-15', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3}', 0, 3, '[2,3]', 1, 0),
(47, 'OA65c9d0d24f5731.62424399', 'IEC', 'hall06', 'ex_hall6_3', '2024-02-12', '2024-02-20', '08:00:00', '10:00:00', '2024-02-16', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3}', 0, 3, '[2,3]', 1, 0),
(47, 'OA65c9d0d24f5731.62424399', 'IEC', 'hall06', 'ex_hall6_3', '2024-02-12', '2024-02-20', '08:00:00', '10:00:00', '2024-02-17', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3}', 0, 3, '[2,3]', 1, 0),
(47, 'OA65c9d0d24f5731.62424399', 'IEC', 'hall06', 'ex_hall6_3', '2024-02-12', '2024-02-20', '08:00:00', '10:00:00', '2024-02-18', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3}', 0, 3, '[2,3]', 1, 0),
(47, 'OA65c9d0d24f5731.62424399', 'IEC', 'hall06', 'ex_hall6_3', '2024-02-12', '2024-02-20', '08:00:00', '10:00:00', '2024-02-19', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3}', 0, 3, '[2,3]', 1, 0),
(47, 'OA65c9d0d24f5731.62424399', 'IEC', 'hall06', 'ex_hall6_3', '2024-02-12', '2024-02-20', '08:00:00', '10:00:00', '2024-02-20', '{\"08:00\":3,\"08:10\":3,\"08:20\":3,\"08:30\":3,\"08:40\":3,\"08:50\":3,\"09:00\":3,\"09:10\":3,\"09:20\":3,\"09:30\":3,\"09:40\":3,\"09:50\":3,\"10:00\":3}', 0, 3, '[2,3]', 1, 0),
(47, 'OA65c9d0d24f5731.62424399', 'IEC', 'hall06', 'ex_hall6_3', '2024-02-12', '2024-02-20', '14:00:00', '16:00:00', '2024-02-12', '{\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3}', 0, 3, '[1]', 1, 0),
(47, 'OA65c9d0d24f5731.62424399', 'IEC', 'hall06', 'ex_hall6_3', '2024-02-12', '2024-02-20', '14:00:00', '16:00:00', '2024-02-13', '{\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3}', 0, 3, '[1]', 1, 0),
(47, 'OA65c9d0d24f5731.62424399', 'IEC', 'hall06', 'ex_hall6_3', '2024-02-12', '2024-02-20', '14:00:00', '16:00:00', '2024-02-14', '{\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3}', 0, 3, '[1]', 1, 0),
(47, 'OA65c9d0d24f5731.62424399', 'IEC', 'hall06', 'ex_hall6_3', '2024-02-12', '2024-02-20', '14:00:00', '16:00:00', '2024-02-15', '{\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3}', 0, 3, '[1]', 1, 0),
(47, 'OA65c9d0d24f5731.62424399', 'IEC', 'hall06', 'ex_hall6_3', '2024-02-12', '2024-02-20', '14:00:00', '16:00:00', '2024-02-16', '{\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3}', 0, 3, '[1]', 1, 0),
(47, 'OA65c9d0d24f5731.62424399', 'IEC', 'hall06', 'ex_hall6_3', '2024-02-12', '2024-02-20', '14:00:00', '16:00:00', '2024-02-17', '{\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3}', 0, 3, '[1]', 1, 0),
(47, 'OA65c9d0d24f5731.62424399', 'IEC', 'hall06', 'ex_hall6_3', '2024-02-12', '2024-02-20', '14:00:00', '16:00:00', '2024-02-18', '{\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3}', 0, 3, '[1]', 1, 0),
(47, 'OA65c9d0d24f5731.62424399', 'IEC', 'hall06', 'ex_hall6_3', '2024-02-12', '2024-02-20', '14:00:00', '16:00:00', '2024-02-19', '{\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3}', 0, 3, '[1]', 1, 0),
(47, 'OA65c9d0d24f5731.62424399', 'IEC', 'hall06', 'ex_hall6_3', '2024-02-12', '2024-02-20', '14:00:00', '16:00:00', '2024-02-20', '{\"14:00\":3,\"14:10\":3,\"14:20\":3,\"14:30\":3,\"14:40\":3,\"14:50\":3,\"15:00\":3,\"15:10\":3,\"15:20\":3,\"15:30\":3,\"15:40\":3,\"15:50\":3,\"16:00\":3}', 0, 3, '[1]', 1, 0);

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
  MODIFY `open_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
