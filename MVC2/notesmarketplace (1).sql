-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2021 at 11:13 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `notesmarketplace`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Category_name` varchar(34) NOT NULL,
  `Description` varchar(500) NOT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`ID`, `Category_name`, `Description`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(1, 'PDF(Digital)', 'Notes in pdf formate', '2021-03-23 15:26:51', NULL, NULL, NULL, b'1'),
(2, 'scanned', 'Scanned notes', '2021-03-23 15:26:51', NULL, NULL, NULL, b'1'),
(3, 'Hard copy', 'hard copy notes', '2021-03-23 15:29:38', NULL, NULL, NULL, b'1'),
(4, 'Hand-Writing', 'Handwriiten notes', '2021-03-23 15:29:38', NULL, NULL, NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Country_Name` varchar(34) NOT NULL,
  `Country_Code` varchar(50) NOT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`ID`, `Country_Name`, `Country_Code`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(1, 'Australia', '61', '2021-03-23 15:36:41', NULL, NULL, NULL, b'1'),
(2, 'China', '86', '2021-03-23 15:36:41', NULL, NULL, NULL, b'1'),
(3, 'Canada', '1', '2021-03-23 15:40:48', NULL, NULL, NULL, b'1'),
(4, 'Germany', '49', '2021-03-23 15:40:48', NULL, NULL, NULL, b'1'),
(5, 'India', '91', '2021-03-23 15:42:38', NULL, NULL, NULL, b'1'),
(6, 'Japan', '81', '2021-03-23 15:43:10', NULL, NULL, NULL, b'1'),
(7, 'Pakistan', '92', '2021-03-23 15:43:10', NULL, NULL, NULL, b'1'),
(8, 'USA', '1', '2021-03-23 15:46:12', NULL, NULL, NULL, b'1'),
(9, 'United Kingdom', '44', '2021-03-23 15:46:12', NULL, NULL, NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `downloads`
--

CREATE TABLE `downloads` (
  `ID` int(10) UNSIGNED NOT NULL,
  `NoteID` int(10) UNSIGNED NOT NULL,
  `SellerID` int(10) UNSIGNED NOT NULL,
  `DownloaderID` int(10) UNSIGNED NOT NULL,
  `IsSellerHasAllowedDownload` bit(1) NOT NULL,
  `AttachmentPath` varchar(500) DEFAULT NULL,
  `IsAttachmentDownloaded` bit(1) NOT NULL,
  `AttachmentDownloadedDate` datetime DEFAULT NULL,
  `IsPaid` int(11) UNSIGNED NOT NULL,
  `PurchasedPrice` decimal(10,0) DEFAULT NULL,
  `NoteTitle` varchar(100) NOT NULL,
  `NoteCategory` varchar(100) NOT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `downloads`
--

INSERT INTO `downloads` (`ID`, `NoteID`, `SellerID`, `DownloaderID`, `IsSellerHasAllowedDownload`, `AttachmentPath`, `IsAttachmentDownloaded`, `AttachmentDownloadedDate`, `IsPaid`, `PurchasedPrice`, `NoteTitle`, `NoteCategory`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`) VALUES
(1, 11, 1, 1, b'1', NULL, b'1', '2021-04-01 16:25:02', 4, '126', 'Data Science', 'PDF', '2021-04-01 16:25:02', NULL, NULL, NULL),
(2, 12, 1, 1, b'1', NULL, b'1', '2021-04-02 16:29:47', 5, '150', 'History', 'social', '2021-04-01 16:29:47', NULL, NULL, NULL),
(3, 13, 3, 3, b'1', NULL, b'1', '2021-04-02 16:54:32', 4, '100', 'DCDR', 'PDF', '2021-04-02 16:54:32', NULL, NULL, NULL),
(4, 15, 3, 1, b'1', NULL, b'1', '2021-04-02 16:54:32', 5, '99', 'Data Science', 'Scanner', '2021-04-01 16:54:32', NULL, NULL, NULL),
(5, 16, 1, 3, b'1', NULL, b'1', '2021-04-01 16:25:02', 5, '200', 'AI', 'IT', '2021-04-01 17:05:10', NULL, NULL, NULL),
(6, 17, 1, 3, b'1', NULL, b'1', '2021-04-01 17:05:10', 4, '210', 'Python', 'hard copy', '2021-04-01 17:05:10', NULL, NULL, NULL),
(7, 18, 3, 1, b'1', NULL, b'1', '2021-04-15 12:59:00', 4, '105', 'web technology', 'pDF', '2021-04-02 17:11:13', NULL, NULL, NULL),
(8, 19, 1, 3, b'1', NULL, b'1', '2021-04-02 17:11:13', 5, '180', 'Java', 'Hand-written', '2021-04-02 17:11:13', NULL, NULL, NULL),
(9, 20, 3, 1, b'1', NULL, b'1', '2021-04-02 17:18:34', 5, '98', 'AI', 'PDF', '2021-04-01 17:18:34', NULL, NULL, NULL),
(10, 21, 3, 1, b'1', NULL, b'1', '2021-04-15 12:58:12', 5, '149', 'CA', 'Social', '2021-04-02 17:18:34', NULL, NULL, NULL),
(11, 22, 1, 3, b'1', NULL, b'1', '2021-04-03 17:26:47', 5, '170', 'AI', 'Computer', '2021-04-02 17:26:47', NULL, NULL, NULL),
(12, 24, 1, 3, b'1', NULL, b'1', '2021-04-02 17:26:47', 4, '139', 'Python', 'Scanned', '2021-04-02 17:26:47', NULL, NULL, NULL),
(13, 26, 3, 1, b'1', NULL, b'1', '2021-04-15 12:58:02', 5, '105', 'Database Management', 'Manage', '2021-04-02 17:36:59', NULL, NULL, NULL),
(15, 26, 3, 1, b'1', NULL, b'1', '2021-04-15 12:58:02', 5, '105', 'Database Management', 'Manage', '2021-04-02 17:36:59', NULL, NULL, NULL),
(17, 27, 1, 3, b'1', NULL, b'1', '2021-04-01 17:11:13', 4, '120', 'AI', 'IT', '2021-03-17 21:54:22', NULL, NULL, NULL),
(18, 28, 1, 3, b'1', NULL, b'1', '2021-04-02 20:06:31', 4, '136', 'Python', 'IT', '2021-03-23 15:40:48', NULL, NULL, NULL),
(19, 29, 3, 1, b'1', NULL, b'1', '2021-04-01 16:25:02', 5, '126', 'maths', 'IT', '2021-03-26 10:52:57', NULL, NULL, NULL),
(20, 32, 1, 3, b'1', NULL, b'1', '2021-04-01 20:08:01', 5, '99', 'english', 'eng', '2021-03-23 15:43:10', NULL, NULL, NULL),
(21, 33, 3, 1, b'1', NULL, b'1', '2021-04-01 16:25:02', 5, '250', 'Basic elecronics', 'IT', '2021-03-17 21:54:22', NULL, NULL, NULL),
(22, 34, 1, 3, b'1', NULL, b'1', '2021-04-02 16:54:32', 4, '180', 'C++', 'CE', '2021-03-23 15:29:38', NULL, NULL, NULL),
(23, 35, 3, 1, b'1', NULL, b'1', '2021-04-01 16:25:02', 4, '150', 'Operating system', 'CE', '2021-03-26 10:52:57', NULL, NULL, NULL),
(24, 36, 1, 3, b'1', NULL, b'1', '2021-04-01 17:05:10', 5, '225', 'Java', 'IT', '2021-04-01 20:12:27', NULL, NULL, NULL),
(25, 37, 1, 3, b'1', NULL, b'1', '2021-04-02 16:29:47', 5, '150', 'Co', 'CE', '2021-03-17 20:44:53', NULL, NULL, NULL),
(26, 38, 3, 1, b'1', NULL, b'1', '2021-04-02 17:11:13', 4, '136', 'MCWC', 'IT', '2021-03-23 15:36:41', NULL, NULL, NULL),
(27, 39, 3, 1, b'1', NULL, b'1', '2021-04-03 17:26:47', 5, '105', 'DDBMS', 'CE', '2021-03-17 21:54:22', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `ID` int(10) UNSIGNED NOT NULL,
  `SellerID` int(11) UNSIGNED NOT NULL,
  `Status` int(11) UNSIGNED NOT NULL,
  `Actioned_By` int(11) UNSIGNED DEFAULT NULL,
  `Admin_Remarks` varchar(500) DEFAULT NULL,
  `PublishedDate` datetime DEFAULT NULL,
  `Note_Title` varchar(100) NOT NULL,
  `Category` int(11) UNSIGNED NOT NULL,
  `Note_Display_Picture` varchar(500) DEFAULT NULL,
  `Note_types` int(10) UNSIGNED DEFAULT NULL,
  `Note_Pages` smallint(6) DEFAULT NULL,
  `Description` varchar(500) DEFAULT NULL,
  `University` varchar(100) NOT NULL,
  `Country` int(10) UNSIGNED NOT NULL,
  `Course` varchar(100) NOT NULL,
  `Course_Code` varchar(50) NOT NULL,
  `Professor_Name` varchar(100) NOT NULL,
  `Is_Paid` int(10) UNSIGNED NOT NULL,
  `Price` decimal(10,0) DEFAULT NULL,
  `NotesPreview` varchar(255) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`ID`, `SellerID`, `Status`, `Actioned_By`, `Admin_Remarks`, `PublishedDate`, `Note_Title`, `Category`, `Note_Display_Picture`, `Note_types`, `Note_Pages`, `Description`, `University`, `Country`, `Course`, `Course_Code`, `Professor_Name`, `Is_Paid`, `Price`, `NotesPreview`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(11, 1, 8, NULL, NULL, '2021-04-02 10:05:19', 'science', 2, '../Members/default/note-default.jpg', 2, 250, 'jwrghurh', 'dmdvjtsgrb', 8, 'IT', '16', 'zenif', 4, '500', '../Members/1/11/Preview_1617347963.jpg', '2021-04-02 12:49:23', 1, '2021-04-02 12:49:23', 1, b'1'),
(12, 1, 6, NULL, NULL, '2021-04-02 10:05:32', 'Data Science', 3, '../Members/1/12/DP_1617348350.jpg', 1, 200, 'data science peper solution', 'gec', 5, 'it', '16', 'janak', 5, '200', '../Members/1/12/Preview_1617348350.jpg', '2021-04-02 12:55:50', 1, '2021-04-02 12:55:50', 1, b'1'),
(13, 1, 8, NULL, NULL, '2021-04-02 10:05:37', 'basic elecronics', 3, '../Members/1/13/DP_1617352461.jpg', 2, 250, 'basic elecronics reference book', 'Sal institute', 5, 'IT', '16', 'saurabh sukla', 5, '100', '../Members/1/13/Preview_1617352461.jpg', '2021-04-02 14:04:21', 1, '2021-04-02 14:04:21', 1, b'1'),
(15, 1, 6, NULL, NULL, '2021-04-01 10:05:47', 'Data Science', 1, '../Members/1/15/DP_1617371273.jpg', 1, 250, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque voluptatum sit, iusto temporibus ipsam. Nesciunt earum ipsam error, aut vitae molestiae sit.', 'University of California', 8, 'Computer Engineering', '240520', 'Mr rechard brown', 4, '200', '../Members/1/15/Preview_1617371273.png', '2021-04-02 19:17:53', 1, '2021-04-02 19:17:53', 1, b'1'),
(16, 1, 9, NULL, NULL, '2021-04-03 10:05:56', 'Computer Operating System - Final Exam Book With Paper Solution', 2, '../Members/1/16/DP_1617371450.jpg', 2, 300, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque voluptatum sit, iusto temporibus ipsam. Nesciunt earum ipsam error, aut vitae molestiae sit.', 'University of California', 8, 'IT', '16', 'saurabh sukla', 4, '300', '../Members/1/16/Preview_1617371451.png', '2021-04-02 19:20:50', 1, '2021-04-02 19:20:50', 1, b'1'),
(17, 1, 8, NULL, NULL, '2021-04-03 10:06:04', 'Computer Science - The complete reference', 3, '../Members/1/17/DP_1617371613.jpg', 1, 350, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque voluptatum sit, iusto temporibus ipsam. Nesciunt earum ipsam error, aut vitae molestiae sit.', 'University of Australia', 1, 'Computer Engineering', '240520', 'Miss Zenif shah', 5, '410', '../Members/1/17/Preview_1617371613.png', '2021-04-02 19:23:33', 1, '2021-04-02 19:23:33', 1, b'1'),
(18, 1, 8, NULL, NULL, '2021-04-03 10:06:09', 'Basic Computer Engineering Tech India Publication Series', 4, '../Members/1/18/DP_1617371794.jpg', 1, 350, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque voluptatum sit, iusto temporibus ipsam. Nesciunt earum ipsam error, aut vitae molestiae sit.', 'University of Chine', 2, 'MBA', '213050', 'Mr arjun brown', 5, '230', '../Members/1/18/Preview_1617371794.png', '2021-04-02 19:26:33', 1, '2021-04-02 19:26:33', 1, b'1'),
(19, 1, 8, NULL, NULL, '2021-04-03 10:06:13', 'Computer Science - The complete reference - Seventh Edition', 1, '../Members/1/19/DP_1617371917.jpg', 1, 450, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque voluptatum sit, iusto temporibus ipsam. Nesciunt earum ipsam error, aut vitae molestiae sit.', 'University of Germany', 4, 'MCA', '215061', 'Miss Khyati shah', 4, '500', '../Members/1/19/Preview_1617371917.png', '2021-04-02 19:28:37', 1, '2021-04-02 19:28:37', 1, b'1'),
(20, 1, 8, NULL, NULL, '2021-04-03 10:06:20', 'Computer Operating System - Final Exam Book With Paper Solution', 2, '../Members/1/20/DP_1617372067.jpg', 2, 300, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque voluptatum sit, iusto temporibus ipsam. Nesciunt earum ipsam error, aut vitae molestiae sit.', 'University of India', 5, 'Computer Engineering', '240520', 'Miss Axita Khunt', 4, '100', '../Members/1/20/Preview_1617372068.png', '2021-04-02 19:31:07', 1, '2021-04-02 19:31:07', 1, b'1'),
(21, 1, 8, NULL, NULL, '2021-04-03 10:06:24', 'Computer Science - The complete reference', 3, '../Members/1/21/DP_1617372309.jpg', 2, 250, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque voluptatum sit, iusto temporibus ipsam. Nesciunt earum ipsam error, aut vitae molestiae sit.', 'University of Japan', 6, 'MBA', '213050', 'Miss kasi shah', 4, '410', '../Members/1/21/Preview_1617372310.png', '2021-04-02 19:35:09', 1, '2021-04-02 19:35:09', 1, b'1'),
(22, 1, 9, NULL, NULL, '2021-04-03 10:06:27', 'Basic Computer Engineering Tech India Publication Series', 4, '../Members/1/22/DP_1617372472.jpg', 1, 450, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque voluptatum sit, iusto temporibus ipsam. Nesciunt earum ipsam error, aut vitae molestiae sit.', 'Sal institute', 7, 'MCA', '215061', 'Miss Aditi bhatiya', 5, '500', '../Members/1/22/Preview_1617372472.png', '2021-04-02 19:37:52', 1, '2021-04-02 19:37:52', 1, b'1'),
(24, 1, 8, NULL, NULL, '2021-04-03 10:06:34', 'Computer Operating System - Final Exam Book With Paper Solution', 3, '../Members/1/24/DP_1617372827.jpg', 1, 350, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque voluptatum sit, iusto temporibus ipsam. Nesciunt earum ipsam error, aut vitae molestiae sit.', 'University of California', 8, 'Computer Engineering', '240520', 'Mr chetan kapdiya', 5, '410', '../Members/1/24/Preview_1617372827.png', '2021-04-02 19:43:47', 1, '2021-04-02 19:43:47', 1, b'1'),
(26, 1, 9, NULL, NULL, '2021-04-03 10:07:15', 'Course Management', 2, '../Members/default/note-default.jpg', 2, 450, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque voluptatum sit, iusto temporibus ipsam. Nesciunt earum ipsam error, aut vitae molestiae sit.', 'University of India', 5, 'MBA', '213050', 'saurabh sukla', 4, '200', '../Members/1/26/Preview_1617424473.png', '2021-04-03 10:04:32', 1, '2021-04-03 10:04:32', 1, b'1'),
(27, 1, 8, NULL, NULL, '2021-04-02 15:39:12', 'History', 1, '../Members/1/27/DP_1617443897.jpg', 1, 250, 'lorem ispum book', 'University of ja', 6, '', '', '', 4, '0', NULL, '2021-04-03 15:28:17', 1, '2021-04-03 15:28:17', 1, b'1'),
(28, 1, 8, NULL, NULL, '2021-04-02 15:39:17', 'History', 1, '../Members/default/note-default.jpg', 1, 250, 'lorem ispum book', 'University of Japan', 6, 'MBA', '213050', 'Mr rechard brown', 4, '100', '../Members/1/28/Preview_1617444062.png', '2021-04-03 15:31:02', 1, '2021-04-03 15:31:02', 1, b'1'),
(29, 1, 9, NULL, NULL, '2021-04-02 15:39:22', 'History', 3, '../Members/1/29/DP_1617444175.jpg', 1, 450, 'history book', 'Sal institute', 5, 'Computer Engineering', '240520', 'Miss kasi shah', 5, '500', '../Members/1/29/Preview_1617444175.png', '2021-04-03 15:32:55', 1, '2021-04-03 15:32:55', 1, b'1'),
(32, 1, 8, NULL, NULL, '2021-04-01 15:25:58', 'History', 2, '../Members/1/29/DP_1617444175.jpg', 2, 250, 'lorem book', 'appolo institute', 5, 'IT', '16', 'Abdul kalam', 5, '250', '../Members/1/29/Preview_1617444175.png', '2021-04-01 15:25:58', 1, '2021-04-02 15:40:50', 1, b'1'),
(33, 1, 8, NULL, NULL, '2021-04-02 15:25:58', 'Maths', 3, '../Members/1/29/DP_1617444175.jpg', 2, 300, 'maths book', 'AIT', 5, 'Computer', '13', 'mr prabhash patel', 4, '200', '../Members/1/29/Preview_1617444175.png', '2021-04-02 15:25:58', 1, '2021-04-02 15:25:58', 1, b'1'),
(34, 1, 9, NULL, NULL, '2021-04-02 16:08:02', 'History', 3, '../Members/1/34/DP_1617445423.jpg', 1, 450, 'lorem book', 'University of Germany', 4, 'IT', '213050', 'Mr rechard brown', 5, '100', '../Members/1/34/Preview_1617445423.png', '2021-04-03 15:53:43', 1, '2021-04-03 15:53:43', 1, b'1'),
(35, 1, 8, NULL, NULL, '2021-04-02 16:08:07', 'Maths', 4, '../Members/1/35/DP_1617445539.jpg', 1, 500, 'Maths book', 'University of India', 5, 'MCA', '240520', 'zenif', 4, '600', '../Members/1/35/Preview_1617445539.png', '2021-04-03 15:55:39', 1, '2021-04-03 15:55:39', 1, b'1'),
(36, 1, 6, NULL, NULL, '2021-04-03 16:08:11', 'Data Science', 3, '../Members/1/36/DP_1617445668.jpg', 2, 350, 'data book', 'Sal institute', 5, 'MCA', '215061', 'Mr chetan kapdiya', 4, '200', '../Members/1/36/Preview_1617445669.png', '2021-04-03 15:57:48', 1, '2021-04-03 15:57:48', 1, b'1'),
(37, 1, 8, NULL, NULL, '2021-04-03 16:08:16', 'History', 2, '../Members/1/37/DP_1617445812.jpg', 1, 350, 'history book', 'University of California', 8, 'MBA', '213050', 'Mr arjun brown', 5, '100', '../Members/1/37/Preview_1617445813.png', '2021-04-03 16:00:12', 1, '2021-04-03 16:00:12', 1, b'1'),
(38, 1, 9, NULL, NULL, '2021-04-02 16:08:21', 'science', 3, '../Members/1/38/DP_1617445953.jpg', 2, 450, 'notes desc', 'University of Australia', 1, 'Computer Engineering', '240520', 'Mr rechard brown', 4, '200', '../Members/1/38/Preview_1617445953.png', '2021-04-03 16:02:33', 1, '2021-04-03 16:02:33', 1, b'1'),
(39, 1, 8, NULL, NULL, '2021-04-03 16:08:26', 'History', 1, '../Members/1/39/DP_1617446127.jpg', 2, 300, 'history book', 'University of Canada', 3, 'MCA', '215061', 'Miss Aditi bhatiya', 4, '500', '../Members/1/39/Preview_1617446127.png', '2021-04-03 16:05:27', 1, '2021-04-03 16:05:27', 1, b'1'),
(41, 22, 9, NULL, NULL, '2021-04-01 12:25:54', 'Computer Science - The complete reference', 1, '../Members/22/41/DP_1618296746.jpg', 2, 300, 'referenece book', 'University of India', 5, 'MBA', '213050', 'Mr rechard brown', 4, '200', '../Members/22/41/Preview_1618296746.png', '2021-04-13 12:22:26', 22, '2021-04-13 12:22:26', 22, b'1'),
(42, 22, 8, NULL, NULL, '2021-04-02 12:36:36', 'Computer Science - The complete reference', 3, '../Members/22/42/DP_1618296881.jpg', 1, 350, 'book is here', 'University of California', 8, 'Computer Engineering', '240520', 'saurabh sukla', 5, '0', '../Members/22/42/Preview_1618296882.png', '2021-04-13 12:24:41', 22, '2021-04-13 12:24:41', 22, b'1'),
(43, 22, 9, NULL, NULL, '2021-04-01 12:36:31', 'MCWC', 4, '../Members/22/43/DP_1618297341.jpg', 2, 500, 'mobile computind wireless', 'VGEC', 5, 'IT', '16', 'Miss kasi shah', 4, '200', '../Members/22/43/Preview_1618297341.png', '2021-04-13 12:32:21', 22, '2021-04-13 12:32:21', 22, b'1'),
(44, 22, 8, NULL, NULL, '2021-04-03 16:30:54', 'Basic Computer Engineering Tech India Publication Series', 3, '../Members/22/44/DP_1618309509.jpg', 1, 600, 'reference book', 'University of Australia', 1, 'MBA', '213050', 'Miss Aditi bhatiya', 5, '0', '../Members/22/44/Preview_1618309510.png', '2021-04-13 15:55:09', 22, '2021-04-13 15:55:09', 22, b'1'),
(45, 22, 9, NULL, NULL, '2021-04-09 16:31:01', 'DDBMS', 2, '../Members/22/45/DP_1618310445.jpg', 2, 500, 'distributed dbms', 'Sal institute', 5, 'IT', '16', 'Miss Anamika', 4, '250', '../Members/22/45/Preview_1618310445.png', '2021-04-13 16:10:45', 22, '2021-04-13 16:10:45', 22, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `notesattachment`
--

CREATE TABLE `notesattachment` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Note_ID` int(10) UNSIGNED NOT NULL,
  `File_Name` varchar(100) NOT NULL,
  `Path` varchar(255) NOT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notesattachment`
--

INSERT INTO `notesattachment` (`ID`, `Note_ID`, `File_Name`, `Path`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(5, 12, '5_1617348350pdf', '../Members/1/12/Attachements/5_1617348350.pdf', '2021-04-02 12:55:50', 1, NULL, NULL, b'1'),
(6, 13, '6_1617352461pdf', '../Members/1/13/Attachements/6_1617352461.pdf', '2021-04-02 14:04:21', 1, NULL, NULL, b'1'),
(7, 15, '7_1617371274pdf', '../Members/1/15/Attachements/7_1617371274.pdf', '2021-04-02 19:17:53', 1, NULL, NULL, b'1'),
(8, 16, '8_1617371451pdf', '../Members/1/16/Attachements/8_1617371451.pdf', '2021-04-02 19:20:51', 1, NULL, NULL, b'1'),
(9, 17, '9_1617371613pdf', '../Members/1/17/Attachements/9_1617371613.pdf', '2021-04-02 19:23:33', 1, NULL, NULL, b'1'),
(10, 18, '10_1617371794pdf', '../Members/1/18/Attachements/10_1617371794.pdf', '2021-04-02 19:26:34', 1, NULL, NULL, b'1'),
(11, 19, '11_1617371918pdf', '../Members/1/19/Attachements/11_1617371918.pdf', '2021-04-02 19:28:37', 1, NULL, NULL, b'1'),
(12, 20, '12_1617372069pdf', '../Members/1/20/Attachements/12_1617372069.pdf', '2021-04-02 19:31:09', 1, NULL, NULL, b'1'),
(13, 21, '13_1617372311pdf', '../Members/1/21/Attachements/13_1617372311.pdf', '2021-04-02 19:35:11', 1, NULL, NULL, b'1'),
(14, 24, '14_1617372828pdf', '../Members/1/24/Attachements/14_1617372827.pdf', '2021-04-02 19:43:47', 1, NULL, NULL, b'1'),
(16, 27, '16_1617443897pdf', '../Members/1/27/Attachements/16_1617443897.pdf', '2021-04-03 15:28:17', 1, NULL, NULL, b'1'),
(17, 28, '17_1617444062pdf', '../Members/1/28/Attachements/17_1617444062.pdf', '2021-04-03 15:31:02', 1, NULL, NULL, b'1'),
(18, 29, '18_1617444175pdf', '../Members/1/29/Attachements/18_1617444175.pdf', '2021-04-03 15:32:55', 1, NULL, NULL, b'1'),
(19, 29, '18_1617443897pdf', '../Members/1/29/Attachements//19_161744063.pdf', '2021-04-02 15:45:07', 1, NULL, NULL, b'1'),
(20, 34, '20_1617445424pdf', '../Members/1/34/Attachements/20_1617445424.pdf', '2021-04-03 15:53:43', 1, NULL, NULL, b'1'),
(21, 35, '21_1617445539pdf', '../Members/1/35/Attachements/21_1617445539.pdf', '2021-04-03 15:55:39', 1, NULL, NULL, b'1'),
(22, 36, '22_1617445669pdf', '../Members/1/36/Attachements/22_1617445669.pdf', '2021-04-03 15:57:49', 1, NULL, NULL, b'1'),
(23, 37, '23_1617445813pdf', '../Members/1/37/Attachements/23_1617445813.pdf', '2021-04-03 16:00:13', 1, NULL, NULL, b'1'),
(24, 38, '24_1617445954pdf', '../Members/1/38/Attachements/24_1617445954.pdf', '2021-04-03 16:02:33', 1, NULL, NULL, b'1'),
(25, 39, '25_1617446127pdf', '../Members/1/39/Attachements/25_1617446127.pdf', '2021-04-03 16:05:27', 1, NULL, NULL, b'1'),
(27, 41, '27_1618296747pdf', '../Members/22/41/Attachements/27_1618296747.pdf', '2021-04-13 12:22:27', 22, NULL, NULL, b'1'),
(28, 42, '28_1618296882pdf', '../Members/22/42/Attachements/28_1618296882.pdf', '2021-04-13 12:24:42', 22, NULL, NULL, b'1'),
(29, 43, '29_1618297341pdf', '../Members/22/43/Attachements/29_1618297341.pdf', '2021-04-13 12:32:21', 22, NULL, NULL, b'1'),
(30, 44, '30_1618309510pdf', '../Members/22/44/Attachements/30_1618309510.pdf', '2021-04-13 15:55:10', 22, NULL, NULL, b'1'),
(31, 45, '31_1618310445pdf', '../Members/22/45/Attachements/31_1618310445.pdf', '2021-04-13 16:10:45', 22, NULL, NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `referencedata`
--

CREATE TABLE `referencedata` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Value` varchar(100) NOT NULL,
  `DataValue` varchar(100) NOT NULL,
  `RefCategory` varchar(100) NOT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `referencedata`
--

INSERT INTO `referencedata` (`ID`, `Value`, `DataValue`, `RefCategory`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(1, 'Male', 'M', 'Gender', '2021-03-26 11:46:35', 3, '2021-03-26 11:46:35', 3, b'1'),
(2, 'Female', 'Fe', 'Gender', '2021-03-26 11:46:35', 3, '2021-03-26 11:46:35', 3, b'1'),
(3, 'Unknown', 'U', 'Gender', '2021-03-26 11:48:00', 3, '2021-03-26 11:48:00', 3, b'0'),
(4, 'Paid', 'P', 'Selling Mode', '2021-03-26 11:48:00', 3, '2021-03-26 11:48:00', 3, b'1'),
(5, 'Free', 'F', 'Selling Modes', '2021-03-26 11:49:37', 3, '2021-03-26 11:49:37', 3, b'1'),
(6, 'Draft', 'Draft', 'Notes Status', '2021-03-26 11:49:37', 3, '2021-03-26 11:49:37', 3, b'1'),
(7, 'Submitted for Review', 'Submitted for Review', 'Notes Status', '2021-03-26 11:51:33', 3, '2021-03-26 11:51:33', 3, b'1'),
(8, 'In Review', 'In Review', 'Notes Stauts', '2021-03-26 11:51:33', 3, '2021-03-26 11:51:33', 3, b'1'),
(9, 'Published', 'Approved', 'Notes Status', '2021-03-26 11:53:28', 3, '2021-03-26 11:53:28', 3, b'1'),
(10, 'Rejected', 'Rejected', 'Notes Status', '2021-03-26 11:54:23', 3, '2021-03-26 11:54:23', 3, b'1'),
(11, 'Removed', 'Removed', 'Notes Status', '2021-03-26 11:54:23', 3, '2021-03-26 11:54:23', 3, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `sellernotesreportedissues`
--

CREATE TABLE `sellernotesreportedissues` (
  `ID` int(10) UNSIGNED NOT NULL,
  `NoteID` int(10) UNSIGNED NOT NULL,
  `Reportedbyid` int(10) UNSIGNED NOT NULL,
  `againstDownloadID` int(10) UNSIGNED NOT NULL,
  `Remarks` varchar(500) NOT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sellernotesreportedissues`
--

INSERT INTO `sellernotesreportedissues` (`ID`, `NoteID`, `Reportedbyid`, `againstDownloadID`, `Remarks`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(1, 21, 1, 3, '9', '2021-04-15 12:56:34', 1, NULL, NULL, b'0'),
(2, 26, 1, 3, '8', '2021-04-15 16:45:42', 1, NULL, NULL, b'0'),
(3, 18, 1, 3, '10', '2021-04-15 17:40:41', 1, NULL, NULL, b'0'),
(4, 20, 1, 3, '10', '2021-04-15 17:42:19', 1, NULL, NULL, b'0'),
(5, 15, 1, 3, '10', '2021-04-15 17:47:15', 1, NULL, NULL, b'0'),
(6, 12, 1, 1, '10', '2021-04-15 17:48:36', 1, NULL, NULL, b'0'),
(7, 11, 1, 1, '9', '2021-04-15 17:49:13', 1, NULL, NULL, b'0'),
(8, 35, 1, 3, '5', '2021-04-15 17:51:00', 1, NULL, NULL, b'0'),
(9, 29, 1, 3, '10', '2021-04-15 19:22:41', 1, NULL, NULL, b'0'),
(10, 38, 1, 3, '8', '2021-04-15 19:26:11', 1, NULL, NULL, b'0');

-- --------------------------------------------------------

--
-- Table structure for table `sellernotesreviews`
--

CREATE TABLE `sellernotesreviews` (
  `ID` int(10) UNSIGNED NOT NULL,
  `NoteID` int(10) UNSIGNED NOT NULL,
  `ReviewedByID` int(10) UNSIGNED NOT NULL,
  `againstdownloadID` int(10) UNSIGNED NOT NULL,
  `ratings` decimal(10,0) NOT NULL,
  `Comments` varchar(500) NOT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `system_configuration`
--

CREATE TABLE `system_configuration` (
  `ID` int(10) UNSIGNED NOT NULL,
  `UserID` int(10) UNSIGNED NOT NULL,
  `Key_info` varchar(100) NOT NULL,
  `Value` varchar(255) NOT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Type_Name` varchar(34) NOT NULL,
  `Description` varchar(500) NOT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`ID`, `Type_Name`, `Description`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(1, 'FREE', 'Free notes', '2021-03-23 11:38:29', NULL, NULL, NULL, b'1'),
(2, 'PAID', 'paid notes', '2021-03-22 15:35:55', NULL, NULL, NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `userroles`
--

CREATE TABLE `userroles` (
  `ID` int(11) UNSIGNED NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(10) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userroles`
--

INSERT INTO `userroles` (`ID`, `Name`, `Description`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(1, 'notes-member', 'members', '2021-03-22 11:30:18', NULL, NULL, NULL, b'0000000000'),
(2, 'note-admin', 'admin', '2021-03-22 11:30:54', NULL, NULL, NULL, b'0000000000'),
(3, 'notes-superdmin', 'superadmin', '2021-03-22 11:31:11', NULL, NULL, NULL, b'0000000000');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(10) UNSIGNED NOT NULL,
  `RoleID` int(10) UNSIGNED NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `EmailID` varchar(100) NOT NULL,
  `Password` varchar(24) NOT NULL,
  `IsEmailVerified` bit(10) NOT NULL DEFAULT b'0',
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) NOT NULL,
  `IsActive` bit(10) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `RoleID`, `FirstName`, `LastName`, `EmailID`, `Password`, `IsEmailVerified`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(1, 1, 'Axita', 'Patel', 'axita31.patel@gmail.com', '31Axita5', b'0000000001', '2021-03-27 11:36:45', NULL, '2021-04-06 10:26:40', 1, b'0000000001'),
(2, 2, 'Axita', 'Khunt', 'axita31.khunt@gmail.com', 'Axita31khunt', b'0000000001', '2021-03-17 20:44:53', NULL, NULL, 2, b'0000000001'),
(3, 1, 'pritesh', 'khunt', 'khuntpritesh5@gmail.com', 'Pritesh26khunt', b'0000000001', '2021-04-03 16:32:38', NULL, NULL, 1, b'0000000001'),
(12, 1, 'Dhruvil', 'Talaviya', 'dhulo012@gmail.com', 'Dhulo12345', b'0000000001', '2021-04-08 19:09:34', NULL, NULL, 1, b'0000000001'),
(22, 1, 'Tom', 'jerry', 'jerryt2697@gmail.com', 'Tom123456', b'0000000001', '2021-04-13 11:08:13', NULL, '2021-04-13 11:15:30', 22, b'0000000001');

-- --------------------------------------------------------

--
-- Table structure for table `users_details`
--

CREATE TABLE `users_details` (
  `ID` int(11) UNSIGNED NOT NULL,
  `UserID` int(10) UNSIGNED NOT NULL,
  `Dob` datetime DEFAULT NULL,
  `Gender` int(10) UNSIGNED DEFAULT NULL,
  `SecondaryEmailAddress` varchar(100) NOT NULL,
  `Phone_No_Country_Code` int(10) UNSIGNED NOT NULL,
  `Phone_No` varchar(20) NOT NULL,
  `Profile_Pic` varchar(500) DEFAULT NULL,
  `Address_1` varchar(100) NOT NULL,
  `Address_2` varchar(100) NOT NULL,
  `City` varchar(50) NOT NULL,
  `State` varchar(50) NOT NULL,
  `Zip_Code` varchar(50) NOT NULL,
  `Country` varchar(50) NOT NULL,
  `University` varchar(100) DEFAULT NULL,
  `College` varchar(100) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_details`
--

INSERT INTO `users_details` (`ID`, `UserID`, `Dob`, `Gender`, `SecondaryEmailAddress`, `Phone_No_Country_Code`, `Phone_No`, `Profile_Pic`, `Address_1`, `Address_2`, `City`, `State`, `Zip_Code`, `Country`, `University`, `College`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`) VALUES
(28, 1, '2000-05-31 00:00:00', 2, '', 5, '07048600717', '../Members/1/DP_1618415650.jpg', '4/ganesh tenament', 'gopal chowk', 'ahmedabad', 'gujrat', '382350', '5', 'Gujrat university', 'GEC-gandhinagar', '2021-04-14 19:00:02', 1, '2021-04-14 21:24:10', 1),
(29, 22, '2000-05-05 00:00:00', 1, '', 5, '09898989797', '../Members/22/DP_1618407558.jpg', '5/xyz', 'mnopq', 'surat', 'gujrat', '235023', '5', 'Gujrat university', 'GLSO', '2021-04-14 19:06:32', 22, '2021-04-14 19:09:18', 22),
(31, 3, '1997-02-25 00:00:00', 1, '', 5, '09898989797', '../Members/3/DP_1618415513.jpg', '5/xyz', 'mnopq', 'surat', 'gujrat', '235023', '5', 'Gujrat university', 'Okaybrook', '2021-04-14 21:20:47', 3, '2021-04-14 21:21:53', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `downloads`
--
ALTER TABLE `downloads`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `downloads_ibfk_1` (`NoteID`),
  ADD KEY `SellerID` (`SellerID`),
  ADD KEY `DownloaderID` (`DownloaderID`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `SellerID` (`SellerID`),
  ADD KEY `Status` (`Status`),
  ADD KEY `Actioned_By` (`Actioned_By`),
  ADD KEY `Category` (`Category`),
  ADD KEY `Note_types` (`Note_types`),
  ADD KEY `Country` (`Country`),
  ADD KEY `Is_Paid` (`Is_Paid`);

--
-- Indexes for table `notesattachment`
--
ALTER TABLE `notesattachment`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Note_ID` (`Note_ID`);

--
-- Indexes for table `referencedata`
--
ALTER TABLE `referencedata`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `sellernotesreportedissues`
--
ALTER TABLE `sellernotesreportedissues`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `againstDownloadID` (`againstDownloadID`),
  ADD KEY `UserID` (`Reportedbyid`),
  ADD KEY `NoteID` (`NoteID`);

--
-- Indexes for table `sellernotesreviews`
--
ALTER TABLE `sellernotesreviews`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `NoteID` (`NoteID`),
  ADD KEY `againstdownloadID` (`againstdownloadID`),
  ADD KEY `UserID` (`ReviewedByID`);

--
-- Indexes for table `system_configuration`
--
ALTER TABLE `system_configuration`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `userroles`
--
ALTER TABLE `userroles`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `EmailID` (`EmailID`),
  ADD KEY `RoleID` (`RoleID`);

--
-- Indexes for table `users_details`
--
ALTER TABLE `users_details`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Phone_No_Country_Code` (`Phone_No_Country_Code`),
  ADD KEY `Gender` (`Gender`),
  ADD KEY `UserID` (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `downloads`
--
ALTER TABLE `downloads`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `notesattachment`
--
ALTER TABLE `notesattachment`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `referencedata`
--
ALTER TABLE `referencedata`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sellernotesreportedissues`
--
ALTER TABLE `sellernotesreportedissues`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sellernotesreviews`
--
ALTER TABLE `sellernotesreviews`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `system_configuration`
--
ALTER TABLE `system_configuration`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `userroles`
--
ALTER TABLE `userroles`
  MODIFY `ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users_details`
--
ALTER TABLE `users_details`
  MODIFY `ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `downloads`
--
ALTER TABLE `downloads`
  ADD CONSTRAINT `downloads_ibfk_1` FOREIGN KEY (`NoteID`) REFERENCES `notes` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `downloads_ibfk_2` FOREIGN KEY (`SellerID`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `downloads_ibfk_3` FOREIGN KEY (`DownloaderID`) REFERENCES `users` (`ID`);

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`SellerID`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `notes_ibfk_2` FOREIGN KEY (`Status`) REFERENCES `referencedata` (`ID`),
  ADD CONSTRAINT `notes_ibfk_3` FOREIGN KEY (`Actioned_By`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `notes_ibfk_4` FOREIGN KEY (`Category`) REFERENCES `category` (`ID`),
  ADD CONSTRAINT `notes_ibfk_5` FOREIGN KEY (`Note_types`) REFERENCES `type` (`ID`),
  ADD CONSTRAINT `notes_ibfk_6` FOREIGN KEY (`Country`) REFERENCES `country` (`ID`),
  ADD CONSTRAINT `notes_ibfk_7` FOREIGN KEY (`Is_Paid`) REFERENCES `referencedata` (`ID`);

--
-- Constraints for table `notesattachment`
--
ALTER TABLE `notesattachment`
  ADD CONSTRAINT `notesattachment_ibfk_1` FOREIGN KEY (`Note_ID`) REFERENCES `notes` (`ID`);

--
-- Constraints for table `sellernotesreportedissues`
--
ALTER TABLE `sellernotesreportedissues`
  ADD CONSTRAINT `sellernotesreportedissues_ibfk_1` FOREIGN KEY (`againstDownloadID`) REFERENCES `downloads` (`ID`),
  ADD CONSTRAINT `sellernotesreportedissues_ibfk_3` FOREIGN KEY (`NoteID`) REFERENCES `notes` (`ID`),
  ADD CONSTRAINT `sellernotesreportedissues_ibfk_4` FOREIGN KEY (`Reportedbyid`) REFERENCES `users` (`ID`);

--
-- Constraints for table `sellernotesreviews`
--
ALTER TABLE `sellernotesreviews`
  ADD CONSTRAINT `sellernotesreviews_ibfk_1` FOREIGN KEY (`NoteID`) REFERENCES `notes` (`ID`),
  ADD CONSTRAINT `sellernotesreviews_ibfk_2` FOREIGN KEY (`againstdownloadID`) REFERENCES `downloads` (`ID`),
  ADD CONSTRAINT `sellernotesreviews_ibfk_3` FOREIGN KEY (`ReviewedByID`) REFERENCES `users` (`ID`);

--
-- Constraints for table `system_configuration`
--
ALTER TABLE `system_configuration`
  ADD CONSTRAINT `system_configuration_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`ID`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`RoleID`) REFERENCES `userroles` (`ID`);

--
-- Constraints for table `users_details`
--
ALTER TABLE `users_details`
  ADD CONSTRAINT `users_details_ibfk_3` FOREIGN KEY (`Phone_No_Country_Code`) REFERENCES `country` (`ID`),
  ADD CONSTRAINT `users_details_ibfk_4` FOREIGN KEY (`Gender`) REFERENCES `referencedata` (`ID`),
  ADD CONSTRAINT `users_details_ibfk_5` FOREIGN KEY (`UserID`) REFERENCES `users` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
