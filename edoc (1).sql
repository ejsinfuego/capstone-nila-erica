-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2023 at 06:28 AM
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
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `consultation`
--

INSERT INTO `consultation` (`consultation_id`, `patient_id`, `stat`, `type`, `date`, `time`, `created_at`, `updated_at`) VALUES
(16, 24, 'pending', 'xray', '2023-08-30', '03:44:00', '2023-08-24 21:14:46', '2023-08-24 21:14:46'),
(18, 25, 'pending', 'urinalysis', '2023-08-29', '09:30:00', '2023-08-25 08:14:43', '2023-08-25 08:14:43'),
(19, 25, 'pending', 'xray', '2023-09-08', '13:47:00', '2023-08-25 08:17:13', '2023-08-25 08:17:13'),
(20, 25, 'pending', 'xray', '2023-08-29', '01:48:00', '2023-08-25 08:18:53', '2023-08-25 08:18:53'),
(24, 25, 'pending', 'xray', '2023-08-31', '04:02:00', '2023-08-29 09:32:34', '2023-08-29 09:32:34');

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
  `weight` float NOT NULL,
  `height` float NOT NULL,
  `blood_pressure` varchar(10) NOT NULL,
  `note` text NOT NULL,
  `created_at` datetime NOT NULL,
  `udpated_at` datetime NOT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `status` varchar(10) NOT NULL,
  `patient_pid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `medicine_inventory`
--

CREATE TABLE `medicine_inventory` (
  `medicine_id` int(11) NOT NULL,
  `med_name` varchar(50) NOT NULL,
  `med_qty` int(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medicine_inventory`
--

INSERT INTO `medicine_inventory` (`medicine_id`, `med_name`, `med_qty`, `status`) VALUES
(3, 'Mefenamic', 697, 'high'),
(4, 'Amoxicillin', 4898, 'good');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `pid` int(11) NOT NULL,
  `pemail` varchar(255) NOT NULL,
  `pname` varchar(255) DEFAULT NULL,
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

INSERT INTO `patient` (`pid`, `pemail`, `pname`, `ppassword`, `pprovince`, `ptown`, `pbrgy`, `pstreet`, `pdob`, `ptel`, `pmother`, `pfather`, `pmarital_status`, `psex`, `created_at`, `updated_at`) VALUES
(22, 'maria@mail.com', 'Maria Mercedes', '123', 'Camarines Sur', 'Tigaon', 'Huyon-Huyon', '2215', '2023-08-22', '09123456789', 'Maria Mercedes', 'Mario Mercedes', 'Married', 'Female', '2023-08-23 14:01:57', '2023-08-23 14:01:57'),
(23, 'john@mail.com', 'John Watson', '123', 'Camarines Sur', 'Tigaon', 'Huyon-huyon', '225', '1996-08-22', '09123456789', 'Mama Mo', 'Papa Ko', 'Married', 'Female', '2023-08-24 17:38:42', '2023-08-24 17:38:42'),
(24, 'map@mail.com', 'Mapang Hee', '123', 'Camarines Sur', 'Tigaon', 'Tajolongon', '225', '1995-12-25', '09123456789', 'Nanay Ko', 'Tatay Ko', 'Married', 'Male', '2023-08-24 21:14:14', '2023-08-24 21:14:14'),
(25, 'pedro@mail.com', 'Pedro Penduko', '123', 'Camarines Sur', 'Tigaon', 'San Antonio', '2215', '1992-12-25', '09123456789', 'Mima Ko', 'Ama Ko ', 'Widowed', 'Female', '2023-08-25 08:11:04', '2023-08-25 08:11:04');

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `prescription_id` int(11) NOT NULL,
  `note` varchar(250) NOT NULL,
  `status` varchar(50) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `services_id` int(2) NOT NULL,
  `doctor_docid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `prescription_id` int(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request_medicine`
--

INSERT INTO `request_medicine` (`request_medicine_id`, `medicine_id`, `note`, `quantity`, `status`, `patient_id`, `prescription_id`, `created_at`, `updated_at`) VALUES
(21, 4, 'Mayo na po akong maintenance. Ty', 20, 'pending', 24, 2214, '2023-08-24 22:39:53', '2023-08-24 22:39:53'),
(22, 3, 'mahaga po', 100, 'pending', 24, 2214, '2023-08-24 22:40:58', '2023-08-24 22:40:58'),
(23, 4, 'hagad', 2, 'pending', 24, 221, '2023-08-24 23:11:35', '2023-08-24 23:11:35'),
(24, 3, 'ayat man', 3, 'pending', 24, 2214, '2023-08-24 23:13:12', '2023-08-24 23:13:12'),
(25, 3, 'enge', 200, 'pending', 24, 0, '2023-08-24 23:14:42', '2023-08-24 23:14:42'),
(26, 4, 'enge', 20, 'pending', 25, 2215, '2023-08-25 08:19:33', '2023-08-25 08:19:33'),
(27, 4, 'please', 15, 'pending', 25, 2214, '2023-08-25 08:25:21', '2023-08-25 08:25:21'),
(28, 4, 'hagad', 25, 'pending', 25, 2214, '2023-08-25 10:21:25', '2023-08-25 10:21:25'),
(29, 4, 'This is the sample note', 20, 'pending', 25, 2214, '2023-08-29 09:33:10', '2023-08-29 09:33:10');

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
  `usertype` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `webuser`
--

INSERT INTO `webuser` (`email`, `usertype`) VALUES
('adam@mail.com', 'd'),
('maria@mail.com', 'p'),
('john@mail.com', 'p'),
('map@mail.com', 'p'),
('pedro@mail.com', 'p');

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
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`prescription_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `patient_index_id` (`patient_id`),
  ADD KEY `fk_prescription_services1` (`services_id`);

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
  MODIFY `consultation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `docid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `health_monitoring`
--
ALTER TABLE `health_monitoring`
  MODIFY `health_monitoring_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `medicine_inventory`
--
ALTER TABLE `medicine_inventory`
  MODIFY `medicine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `request_medicine`
--
ALTER TABLE `request_medicine`
  MODIFY `request_medicine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

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
  ADD CONSTRAINT `fk_prescription_services1` FOREIGN KEY (`services_id`) REFERENCES `services` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
