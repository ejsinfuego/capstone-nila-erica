-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2023 at 04:20 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edoc`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `aemail` varchar(255) NOT NULL,
  `apassword` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `consultation`
--

CREATE TABLE `consultation` (
  `consultation_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `stat` varchar(50) NOT NULL DEFAULT 'pending',
  `type` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `consultation`
--

INSERT INTO `consultation` (`consultation_id`, `patient_id`, `stat`, `type`, `date`, `time`, `note`, `created_at`, `updated_at`) VALUES
(91, 25, 'approved', 'urinalysis', '2023-09-20', '15:19:00', NULL, '2023-09-14 09:49:21', '2023-09-14 09:49:21'),
(95, 22, 'cancelled', 'urinalysis', '2023-09-28', '14:21:00', NULL, '2023-09-14 09:51:08', '2023-09-14 09:51:08'),
(96, 22, 'cancelled', 'urinalysis', '2023-09-17', '04:21:00', NULL, '2023-09-14 09:51:16', '2023-09-14 09:51:16'),
(100, 24, 'cancelled', 'consultation', '2023-09-26', '11:59:00', NULL, '2023-09-15 07:29:36', '2023-09-15 07:29:36'),
(101, 25, 'pending', 'xray', '2023-09-20', '11:07:00', NULL, '2023-09-15 21:38:11', '2023-09-15 21:38:11'),
(102, 22, 'cancelled', 'xray', '2023-09-27', '15:17:00', NULL, '2023-09-16 18:47:49', '2023-09-16 18:47:49'),
(103, 23, 'approved', 'urinalysis', '2023-10-18', '15:32:00', NULL, '2023-10-09 22:54:45', '2023-10-10 22:02:33'),
(104, 23, 'approved', 'xray', '2023-10-25', '13:12:00', NULL, '2023-10-10 18:42:47', '2023-10-10 18:42:47'),
(105, 24, 'pending', 'xray', '2023-10-27', '16:01:00', NULL, '2023-10-10 21:29:01', '2023-10-10 22:32:03'),
(106, 24, 'pending', 'xray', '2023-10-26', '15:30:00', NULL, '2023-10-10 22:00:15', '2023-10-10 22:00:15'),
(107, 22, 'pending', 'xray', '2023-11-29', '13:52:00', NULL, '2023-11-12 10:18:01', '2023-11-23 19:21:59'),
(108, 22, 'pending', 'xray', '2023-11-25', '00:00:00', NULL, '2023-11-22 15:56:03', '2023-11-23 19:40:43'),
(109, 22, 'pending', 'xray', '2023-11-30', '11:44:00', NULL, '2023-11-23 12:14:59', '2023-11-23 12:14:59'),
(110, 22, 'pending', 'urinalysis', '2023-11-28', '00:00:00', 'please', '2023-11-23 12:20:51', '2023-11-23 19:42:59'),
(112, 22, 'pending', 'xray', '2023-11-27', '08:18:00', 'asd', '2023-11-23 19:48:54', '2023-11-23 19:48:54'),
(113, 22, 'pending', 'xray', '2023-11-30', '14:33:00', 'tonight is killing me', '2023-11-23 20:03:41', '2023-11-23 20:11:22'),
(114, 22, 'pending', 'xray', '2023-11-29', '14:00:00', 'shesssh', '2023-11-23 20:04:57', '2023-11-23 20:14:45');

-- --------------------------------------------------------

--
-- Table structure for table `desk_officer`
--

CREATE TABLE `desk_officer` (
  `id` int(11) NOT NULL,
  `f_name` varchar(50) NOT NULL,
  `l_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(16) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `desk_officer`
--

INSERT INTO `desk_officer` (`id`, `f_name`, `l_name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Desk ', 'Officer', 'desk@mail.com', '123', '2023-09-15 08:20:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `docid` int(11) NOT NULL,
  `docemail` varchar(255) DEFAULT NULL,
  `docname` varchar(255) DEFAULT NULL,
  `docpassword` varchar(255) DEFAULT NULL,
  `docnic` varchar(15) DEFAULT NULL,
  `doctel` varchar(15) DEFAULT NULL,
  `specialties` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`docid`, `docemail`, `docname`, `docpassword`, `docnic`, `doctel`, `specialties`) VALUES
(1, 'adam@mail.com', 'Adam Sandler', '123', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `health_monitoring`
--

CREATE TABLE `health_monitoring` (
  `health_monitoring_id` int(11) NOT NULL,
  `patient_pid` int(11) NOT NULL,
  `weight` float NOT NULL,
  `height` float NOT NULL,
  `blood_pressure` varchar(10) NOT NULL,
  `note` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `health_monitoring`
--

INSERT INTO `health_monitoring` (`health_monitoring_id`, `patient_pid`, `weight`, `height`, `blood_pressure`, `note`, `created_at`, `updated_at`, `doctor_id`, `status`) VALUES
(7, 22, 40, 165, '100/72    ', '50/50', '2023-09-14 10:23:50', '2023-11-22 15:26:29', NULL, 'active'),
(8, 25, 55, 165, '145/55', 'Healthy', '2023-09-14 10:33:50', '2023-09-14 10:33:50', NULL, 'active'),
(9, 23, 60, 165, '180/65', 'very healthy', '2023-09-14 10:35:09', '2023-09-16 10:00:53', NULL, 'active'),
(10, 24, 50, 154, '165/55    ', 'not ok', '2023-09-14 10:35:57', '2023-11-16 10:07:45', NULL, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `medicine_inventory`
--

CREATE TABLE `medicine_inventory` (
  `medicine_id` int(11) NOT NULL,
  `med_name` varchar(50) NOT NULL,
  `med_desc` varchar(255) DEFAULT NULL,
  `med_qty` int(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `acquired_by` int(11) DEFAULT NULL,
  `med_dosage` int(5) DEFAULT NULL,
  `med_unit` varchar(5) DEFAULT NULL,
  `recent_acquired` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medicine_inventory`
--

INSERT INTO `medicine_inventory` (`medicine_id`, `med_name`, `med_desc`, `med_qty`, `status`, `acquired_by`, `med_dosage`, `med_unit`, `recent_acquired`, `updated_at`, `created_at`) VALUES
(3, 'Mefenamic', NULL, 1715, 'high', 1, 250, 'mg', NULL, '2023-11-14 08:30:23', NULL),
(4, 'Amoxicillin', NULL, 5801, 'good', 1, 250, 'mg', '2023-11-22 15:29:13', '2023-11-22 15:29:13', NULL),
(6, 'Paracetamol', 'for Colds', 1600, '', 1, 250, 'mg', '2023-11-23 20:31:43', '2023-11-23 20:31:43', '2023-11-14 09:24:20'),
(7, 'Buscopan', 'pain killer', 955, '', 1, 500, 'mg', '2023-11-22 15:36:18', '2023-11-22 15:36:18', '2023-11-22 15:31:11');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `pid` int(11) NOT NULL,
  `pemail` varchar(255) NOT NULL,
  `f_name` varchar(255) DEFAULT NULL,
  `l_name` varchar(50) DEFAULT NULL,
  `m_name` varchar(50) DEFAULT NULL,
  `ppassword` varchar(255) NOT NULL,
  `pprovince` varchar(50) NOT NULL,
  `ptown` varchar(50) NOT NULL,
  `pbrgy` varchar(50) NOT NULL,
  `pstreet` varchar(50) NOT NULL,
  `pdob` date DEFAULT NULL,
  `ptel` varchar(15) DEFAULT NULL,
  `pmother` varchar(50) DEFAULT NULL,
  `pfather` varchar(50) DEFAULT NULL,
  `pmarital_status` varchar(50) DEFAULT NULL,
  `psex` varchar(6) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`pid`, `pemail`, `f_name`, `l_name`, `m_name`, `ppassword`, `pprovince`, `ptown`, `pbrgy`, `pstreet`, `pdob`, `ptel`, `pmother`, `pfather`, `pmarital_status`, `psex`, `created_at`, `updated_at`) VALUES
(22, 'maria@mail.com', 'Maria', 'Mercedes', NULL, '123', 'Camarines Sur', 'Tigaon', 'Huyon-Huyon', '2215', '2023-08-22', '09123456789', 'Maria Mercedes', 'Mario Mercedes', 'Married', 'Female', '2023-08-23 14:01:57', '2023-08-23 14:01:57'),
(23, 'john@mail.com', 'John ', 'Watson', NULL, '123', 'Camarines Sur', 'Tigaon', 'Huyon-huyon', '225', '1996-08-22', '09123456789', 'Mama Mo', 'Papa Ko', 'Married', 'Female', '2023-08-24 17:38:42', '2023-08-24 17:38:42'),
(24, 'map@mail.com', 'Mapang', 'Hee', NULL, '123', 'Camarines Sur', 'Tigaon', 'Tajolongon', '225', '1995-12-25', '09123456789', 'Nanay Ko', 'Tatay Ko', 'Married', 'Male', '2023-08-24 21:14:14', '2023-08-24 21:14:14'),
(25, 'pedro@mail.com', 'Pedro', 'Penduko', NULL, '123', 'Camarines Sur', 'Tigaon', 'San Antonio', '2215', '1992-12-25', '09123456789', 'Mima Ko', 'Ama Ko ', 'Widowed', 'Female', '2023-08-25 08:11:04', '2023-08-25 08:11:04');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacist`
--

CREATE TABLE `pharmacist` (
  `id` int(11) NOT NULL,
  `f_name` varchar(50) NOT NULL,
  `l_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(16) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pharmacist`
--

INSERT INTO `pharmacist` (`id`, `f_name`, `l_name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Farma', 'Ceased', 'farma@mail.com', '123', '2023-09-15 16:14:03', '2023-09-15 16:14:03');

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `prescription_id` int(11) NOT NULL,
  `note` varchar(250) NOT NULL,
  `diagnosis` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`prescription_id`, `note`, `diagnosis`, `status`, `patient_id`, `doctor_id`, `created_at`, `updated_at`) VALUES
(6, 'paracetamol - 3/day', 'tb', '', 24, NULL, '2023-09-16 19:03:58', '0000-00-00 00:00:00'),
(9, 'paracetamol 5x/day', 'Migraine', '', 24, NULL, '2023-09-16 23:03:11', '0000-00-00 00:00:00'),
(10, 'this is sever', 'TB', '', 24, NULL, '2023-09-16 23:05:37', '0000-00-00 00:00:00'),
(11, 'this is sever', 'TB', '', 24, NULL, '2023-09-16 23:15:31', '0000-00-00 00:00:00'),
(12, 'asdsda', 'Migraine', '', 24, NULL, '2023-09-16 23:15:40', '0000-00-00 00:00:00'),
(16, 's;ld;dflgk', 'shesh', '', 24, NULL, '2023-09-20 21:53:44', '0000-00-00 00:00:00'),
(17, 's;ld;dflgk', 'shesh', '', 24, NULL, '2023-09-20 22:04:38', '0000-00-00 00:00:00'),
(18, 'asdads', 'sheshdasdad', '', 24, NULL, '2023-09-20 22:04:49', '0000-00-00 00:00:00'),
(19, 'asdads', 'sheshdasdad', '', 24, NULL, '2023-09-20 22:04:57', '0000-00-00 00:00:00'),
(20, 'asdasds', 'asdasd', '', 24, NULL, '2023-09-20 22:05:29', '0000-00-00 00:00:00'),
(21, 'asdasdsad', 'sheshdasdad', '', 24, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 'adsas', 'asd', '', 24, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 'asd', 'asd', '', 25, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 'Diagnosis', 'Colds', '', 22, NULL, '2023-11-12 10:27:08', '0000-00-00 00:00:00'),
(26, 'Neozep - 3x/day\r\nBiogesic - if feverish', 'Colds', '', 22, NULL, '2023-11-12 10:27:49', '0000-00-00 00:00:00'),
(27, 'pahingalo', 'bad', '', 23, NULL, '2023-11-13 20:49:23', '0000-00-00 00:00:00'),
(28, 'posfkspofk', 'kulog payo', '', 24, NULL, '2023-11-16 16:25:07', '0000-00-00 00:00:00'),
(29, 'shesssh', 'kulog payo', '', 24, NULL, '2023-11-16 16:28:29', '0000-00-00 00:00:00'),
(30, 'paracetamol', 'kulogy payo', '', 22, NULL, '2023-11-16 16:29:30', '0000-00-00 00:00:00'),
(31, 'biogesic - 5x/day', 'tb', '', 22, NULL, '2023-11-22 15:27:45', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `request_medicine`
--

CREATE TABLE `request_medicine` (
  `request_medicine_id` int(11) NOT NULL,
  `medicine_id` int(11) NOT NULL,
  `note` varchar(250) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `status` varchar(250) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `approved_by` varchar(255) DEFAULT NULL,
  `prescription_id` int(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request_medicine`
--

INSERT INTO `request_medicine` (`request_medicine_id`, `medicine_id`, `note`, `quantity`, `status`, `patient_id`, `approved_by`, `prescription_id`, `created_at`, `updated_at`) VALUES
(60, 4, 'asdf', 21, 'claimed', 24, NULL, 19, '2023-10-10 20:28:24', '2023-10-10 20:28:24'),
(68, 4, 'sdfsd', 23, 'claimed', 22, 'Farma Ceased', 25, '2023-11-12 11:16:45', '2023-11-12 11:16:45'),
(69, 4, 'sss', 25, 'approved', 22, 'Farma Ceased', 25, '2023-11-12 22:23:30', '2023-11-22 15:37:11'),
(70, 4, 'penge', 5, 'approved', 22, 'Farma Ceased', 25, '2023-11-14 10:57:27', '2023-11-22 15:37:51'),
(71, 7, 'sample note', 45, 'approved', 22, 'Farma Ceased', 26, '2023-11-22 15:41:15', '2023-11-23 11:09:18'),
(72, 6, 'painful', 50, 'approved', 22, 'Farma Ceased', 0, '2023-11-23 20:30:36', '2023-11-23 20:31:05');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(2) NOT NULL,
  `services` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `webuser`
--

CREATE TABLE `webuser` (
  `email` varchar(45) DEFAULT NULL,
  `usertype` char(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `webuser`
--

INSERT INTO `webuser` (`email`, `usertype`) VALUES
('adam@mail.com', 'd'),
('maria@mail.com', 'p'),
('john@mail.com', 'p'),
('map@mail.com', 'p'),
('pedro@mail.com', 'p'),
('desk@mail.com', 'do'),
('farma@mail.com', 'ph');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`aemail`);

--
-- Indexes for table `consultation`
--
ALTER TABLE `consultation`
  ADD PRIMARY KEY (`consultation_id`),
  ADD KEY `patient_index` (`patient_id`);

--
-- Indexes for table `desk_officer`
--
ALTER TABLE `desk_officer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`docid`),
  ADD KEY `specialties` (`specialties`);

--
-- Indexes for table `health_monitoring`
--
ALTER TABLE `health_monitoring`
  ADD PRIMARY KEY (`health_monitoring_id`),
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `fk_health_monitoring_patient1` (`patient_pid`);

--
-- Indexes for table `medicine_inventory`
--
ALTER TABLE `medicine_inventory`
  ADD PRIMARY KEY (`medicine_id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `pharmacist`
--
ALTER TABLE `pharmacist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`prescription_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `request_medicine`
--
ALTER TABLE `request_medicine`
  ADD PRIMARY KEY (`request_medicine_id`),
  ADD KEY `prescription_index_id` (`prescription_id`),
  ADD KEY `medicine_id` (`medicine_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `webuser`
--
ALTER TABLE `webuser`
  ADD UNIQUE KEY `email_index` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `consultation`
--
ALTER TABLE `consultation`
  MODIFY `consultation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `desk_officer`
--
ALTER TABLE `desk_officer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `docid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `health_monitoring`
--
ALTER TABLE `health_monitoring`
  MODIFY `health_monitoring_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `medicine_inventory`
--
ALTER TABLE `medicine_inventory`
  MODIFY `medicine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `pharmacist`
--
ALTER TABLE `pharmacist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `prescription_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `request_medicine`
--
ALTER TABLE `request_medicine`
  MODIFY `request_medicine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `consultation`
--
ALTER TABLE `consultation`
  ADD CONSTRAINT `patient_index` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`pid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `health_monitoring`
--
ALTER TABLE `health_monitoring`
  ADD CONSTRAINT `fk_health_monitoring_patient1` FOREIGN KEY (`patient_pid`) REFERENCES `patient` (`pid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `prescription`
--
ALTER TABLE `prescription`
  ADD CONSTRAINT `doctor_id` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`docid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `patiend_index_id` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`pid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `request_medicine`
--
ALTER TABLE `request_medicine`
  ADD CONSTRAINT `medicine_id` FOREIGN KEY (`medicine_id`) REFERENCES `medicine_inventory` (`medicine_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `patient_id` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`pid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
