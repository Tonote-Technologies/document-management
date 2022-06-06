-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 06, 2022 at 04:33 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tonote_document_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `profile_img` varchar(191) NOT NULL,
  `hashed_password` varchar(191) NOT NULL,
  `reset_password` varchar(50) NOT NULL,
  `admin_level` varchar(50) DEFAULT NULL,
  `account_status` varchar(50) DEFAULT NULL,
  `process_request` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `deleted` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `first_name`, `last_name`, `email`, `profile_img`, `hashed_password`, `reset_password`, `admin_level`, `account_status`, `process_request`, `created_at`, `updated_at`, `created_by`, `deleted`) VALUES
(1, 'Admin', 'One', 'doc@gettonote.com', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '', '1', NULL, '', '2022-05-20 20:03:07', '2022-05-20 22:02:23', NULL, ''),
(2, 'Shafi', 'Akinropo', 'sakinropo@gmail.com', '', '$2y$10$Mg.uyNtVJiNx20X8i6z5xePbcQKoXFhsET7i5Fedug6rfzgIzF0Y.', '0', '1', '1', '0', '2022-06-06 03:40:24', '2022-06-06 03:40:24', '1', '');

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `id` int(11) NOT NULL,
  `document_id` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `filename` varchar(191) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `updated_at` varchar(50) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `deleted` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`id`, `document_id`, `title`, `filename`, `status`, `created_at`, `updated_at`, `created_by`, `deleted`) VALUES
(1, 'ToNote_629cd7a54dfcf', 'Contract Agreement', '629cd7a54dfda_updated.pdf', '1', '2022-06-05 17:19:49', '', '1', ''),
(2, 'ToNote_629dd8d7cac72', 'Scholarship', '629dd8d7cac7c_CB SCHOLARSHIP APPLICATION  2022.pdf', '1', '2022-06-06 11:37:11', '', '2', '');

-- --------------------------------------------------------

--
-- Table structure for table `documentImage`
--

CREATE TABLE `documentImage` (
  `id` int(11) NOT NULL,
  `document_id` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `updated_at` varchar(50) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `deleted` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `documentImage`
--

INSERT INTO `documentImage` (`id`, `document_id`, `title`, `status`, `created_at`, `updated_at`, `created_by`, `deleted`) VALUES
(1, '629cdef830f3f', 'Contract Agreement', '2', '2022-06-05 17:51:12', '', '1', ''),
(2, '629d6ac27b65b', 'Affidavit of Sponsorship - Education', '2', '2022-06-06 03:47:38', '', '2', ''),
(3, '629dd92806f4e', 'Scholarship', '2', '2022-06-06 11:38:47', '', '2', ''),
(4, '629de01511020', 'Affidavit of Marriage', '2', '2022-06-06 12:08:12', '', '2', '');

-- --------------------------------------------------------

--
-- Table structure for table `documentImageDetails`
--

CREATE TABLE `documentImageDetails` (
  `id` int(11) NOT NULL,
  `document_id` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `filename` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `updated_at` varchar(50) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `deleted` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `documentImageDetails`
--

INSERT INTO `documentImageDetails` (`id`, `document_id`, `title`, `filename`, `status`, `created_at`, `updated_at`, `created_by`, `deleted`) VALUES
(1, '629cdef830f3f', '', '629cdf00c0e07img.png', '2', '2022-06-05 17:51:12', '', '1', ''),
(2, '629cdef830f3f', '', '629cdf00c7ebbimg.png', '2', '2022-06-05 17:51:12', '', '1', ''),
(3, '629cdef830f3f', '', '629cdf00ccf7aimg.png', '2', '2022-06-05 17:51:12', '', '1', ''),
(4, '629cdef830f3f', '', '629cdf00d1b09img.png', '2', '2022-06-05 17:51:12', '', '1', ''),
(5, '629cdef830f3f', '', '629cdf00d6c5cimg.png', '2', '2022-06-05 17:51:12', '', '1', ''),
(6, '629cdef830f3f', '', '629cdf00dac89img.png', '2', '2022-06-05 17:51:12', '', '1', ''),
(7, '629cdef830f3f', '', '629cdf0102f41img.png', '2', '2022-06-05 17:51:13', '', '1', ''),
(8, '629d6ac27b65b', '', '629d6aca36e4bimg.png', '2', '2022-06-06 03:47:38', '', '2', ''),
(9, '629dd92806f4e', '', '629dd93824392img.png', '2', '2022-06-06 11:38:48', '', '2', ''),
(10, '629de01511020', '', '629de01cd18b1img.png', '2', '2022-06-06 12:08:12', '', '2', '');

-- --------------------------------------------------------

--
-- Table structure for table `documentResource`
--

CREATE TABLE `documentResource` (
  `id` int(11) NOT NULL,
  `document_id` varchar(50) NOT NULL,
  `filename` varchar(50) NOT NULL,
  `tool_id` varchar(50) NOT NULL,
  `tool_type` varchar(50) NOT NULL,
  `tool_name` varchar(100) NOT NULL,
  `tool_class` varchar(50) NOT NULL,
  `tool_pos_top` varchar(50) NOT NULL,
  `tool_pos_left` varchar(50) NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `updated_at` varchar(50) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `deleted` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `documentResource`
--

INSERT INTO `documentResource` (`id`, `document_id`, `filename`, `tool_id`, `tool_type`, `tool_name`, `tool_class`, `tool_pos_top`, `tool_pos_left`, `created_at`, `updated_at`, `created_by`, `deleted`) VALUES
(54, '629dd92806f4e', 'sign1654512116img.png', '26', '2', 'Sign', 'tool-box tool-style main-element', '1028.5', '394', '2022-06-06 11:41:52', '2022-06-06 11:43:54', '', ''),
(57, '629dd92806f4e', 'initial1654512116img.png', '12', '2', 'Initial', 'tool-box tool-style main-element', '1084.5', '581', '2022-06-06 11:46:58', '2022-06-06 11:47:17', '', ''),
(58, '629dd92806f4e', '', '78', '1', 'Textarea', 'tool-box tool-style main-element', '732.5', '531', '2022-06-06 11:48:24', '', '', ''),
(59, '629dd92806f4e', '', '17', '1', 'Date', 'tool-box tool-style main-element', '869.5', '346', '2022-06-06 11:50:29', '', '', ''),
(60, '629dd92806f4e', '', '13', '1', 'Seal', 'tool-box tool-style main-element', '907.5', '617', '2022-06-06 11:50:30', '', '', ''),
(61, '629dd92806f4e', '', '24', '1', 'Stamp', 'tool-box tool-style main-element', '976.5', '498', '2022-06-06 11:50:33', '', '', ''),
(63, '629de01511020', 'sign1654512116img.png', '62', '2', 'Sign', 'tool-box tool-style main-element', '908.5', '386.3359375', '2022-06-06 14:10:19', '2022-06-06 14:10:25', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `id` int(11) NOT NULL,
  `document_id` varchar(50) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `updated_at` varchar(50) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `deleted` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `signature`
--

CREATE TABLE `signature` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `set_default` varchar(100) NOT NULL,
  `created_at` varchar(100) NOT NULL,
  `updated_at` varchar(100) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `deleted` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `signatureDetails`
--

CREATE TABLE `signatureDetails` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `filename` varchar(50) NOT NULL,
  `type` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `signature_id` varchar(50) NOT NULL,
  `created_at` varchar(100) NOT NULL,
  `updated_at` varchar(100) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `deleted` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `signatureDetails`
--

INSERT INTO `signatureDetails` (`id`, `user_id`, `filename`, `type`, `category`, `signature_id`, `created_at`, `updated_at`, `created_by`, `deleted`) VALUES
(1, '1', 'sign1654145135img.png', '1', '1', '1', '2022-06-02 21:39:59', '2022-06-02 21:39:59', '0', ''),
(2, '1', 'initial1654145136img.png', '1', '2', '1', '2022-06-02 21:39:59', '2022-06-02 21:39:59', '0', ''),
(38, '2', 'sign1654512116img.png', '1', '1', '', '2022-06-06 11:41:56', '2022-06-06 11:41:56', '2', ''),
(39, '2', 'initial1654512116img.png', '1', '2', '', '2022-06-06 11:41:56', '2022-06-06 11:41:56', '2', '');

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE `templates` (
  `id` int(11) NOT NULL,
  `document_id` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `deleted` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`id`, `document_id`, `title`, `filename`, `created_at`, `created_by`, `deleted`) VALUES
(1, '10101', 'Affidavit of Sim Card loss', 'Affidavit_of_Loss.pdf', '2022-05-31', '1', ''),
(2, '10102', 'Affidavit of Name Change', 'Affidavit_of_Change_of_Name.pdf', '2022-05-31', '1', ''),
(3, '10103', 'Affidavit of Bachelorhood and Spinsterhood', 'Affidavit_of_Spinisterhood.pdf', '2022-05-31', '1', ''),
(4, '10104', 'Affidavit Declaration of age', '', '2022-05-31', '1', ''),
(5, '10105', 'Affidavit of Ownership', '', '2022-05-31', '1', ''),
(6, '10106', 'Affidavit of Addition of Name', 'Affidavit_of_Addition_of_Name.pdf', '2022-05-31', '1', ''),
(7, '10107', 'Sworn Declaration of Age in Lieu of a Birth Certificate', 'Sworn_Declaration_of_Age_in_Lieu_of_a_Birth_Certificate.pdf', '2022-05-31', '1', ''),
(8, '10108', 'Affidavit of Addition of Name', 'Affidavit_of_Addition_of_Name.pdf', '2022-05-31', '1', ''),
(9, '10109', 'Affidavit of Change of Ownership', 'Affidavit_of_Change_of Ownership.pdf', '2022-05-31', '1', ''),
(10, '10110', 'Affidavit of Citizenship.pdf', 'Affidavit_of_Citizenship.pdf', '2022-05-31', '1', ''),
(11, '10111', 'Affidavit of Confirmation of Relationship-Courtship.pdf', 'Affidavit_of_Confirmation_of_Relationship_Courtship', '2022-05-31', '1', ''),
(12, '10112', 'Affidavit of Death', 'Affidavit_of_Death.pdf', '2022-05-31', '1', ''),
(13, '10113', 'Affidavit of Domicile', 'Affidavit_of_Domicile.pdf', '2022-05-31', '1', ''),
(14, '10114', 'Affidavit of Good Conduct', 'Affidavit_of_Good_Conduct.pdf', '2022-05-31', '1', ''),
(15, '10115', 'Affidavit of Guardianship', 'Affidavit_of_Guardianship.pdf', '2022-05-31', '1', ''),
(16, '10116', 'Affidavit of Identity Theft', 'Affidavit_of_Identity_Theft.pdf', '2022-05-31', '1', ''),
(17, '10117', 'Affidavit of Marriage', 'Affidavit_of_Marriage.pdf', '2022-05-31', '1', ''),
(18, '10118', 'Affidavit of Proof of Ownership', 'Affidavit_of_Proof_of_Ownership.pdf', '2022-05-31', '1', ''),
(19, '10119', 'Affidavit of Residence', 'Affidavit_of_Residence.pdf', '2022-05-31', '1', ''),
(20, '10120', 'Affidavit of Sponsorship - Education', 'Affidavit_of_Sponsorship_Education.pdf', '2022-05-31', '1', ''),
(21, '10121', 'Affidavit of State of Origin', 'Affidavit_of_State_of_Origin.pdf', '2022-05-31', '1', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documentImage`
--
ALTER TABLE `documentImage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documentImageDetails`
--
ALTER TABLE `documentImageDetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documentResource`
--
ALTER TABLE `documentResource`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signature`
--
ALTER TABLE `signature`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signatureDetails`
--
ALTER TABLE `signatureDetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `documentImage`
--
ALTER TABLE `documentImage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `documentImageDetails`
--
ALTER TABLE `documentImageDetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `documentResource`
--
ALTER TABLE `documentResource`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `signature`
--
ALTER TABLE `signature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `signatureDetails`
--
ALTER TABLE `signatureDetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
