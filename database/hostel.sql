-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2020 at 06:57 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hostel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(300) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updation_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`, `reg_date`, `updation_date`) VALUES
(1, 'admin', 'code.lpu1@gmail.com', 'Test@1234', '2016-04-04 20:31:45', '2020-10-12 18:41:32'),
(2, 'shiva', 'gyawalishiva14@gmail.com', 'admin', '2020-07-21 02:37:20', '2020-07-22 18:15:00'),
(3, 'Kapil', 'kapildevkota123@gmail.com', 'adminDHM', '2020-07-21 02:54:14', '2020-10-13 11:10:53'),
(5, 'khana gaye hai', 'edit@dmail.gom', '$editpassword', '2020-10-12 06:16:25', '2020-10-12 14:24:19');

-- --------------------------------------------------------

--
-- Table structure for table `adminlog`
--

CREATE TABLE `adminlog` (
  `id` int(11) NOT NULL,
  `adminid` int(11) NOT NULL,
  `ip` varbinary(16) NOT NULL,
  `logintime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_code` varchar(255) NOT NULL,
  `course_sn` varchar(255) NOT NULL,
  `course_fn` varchar(255) NOT NULL,
  `posting_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_code`, `course_sn`, `course_fn`, `posting_date`) VALUES
(1, 'B10992', 'B.Tech', 'Bachelor  of Technology', '2016-04-11 19:31:42'),
(2, 'BCOM1453', 'B.Com', 'Bachelor Of commerce ', '2016-04-11 19:32:46'),
(3, 'BSC12', 'BSC', 'Bachelor  of Science', '2016-04-11 19:33:23'),
(4, 'BC36356', 'BCA', 'Bachelor Of Computer Application', '2016-04-11 19:34:18'),
(5, 'MCA565', 'MCA', 'Master of Computer Application', '2016-04-11 19:34:40'),
(6, 'MBA75', 'MBA', 'Master of Business Administration', '2016-04-11 19:34:59'),
(7, 'BE765', 'BE', 'Bachelor of Engineering', '2016-04-11 19:35:19');

-- --------------------------------------------------------

--
-- Table structure for table `hosteluser`
--

CREATE TABLE `hosteluser` (
  `uid` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updation_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hosteluser`
--

INSERT INTO `hosteluser` (`uid`, `username`, `email`, `password`, `reg_date`, `updation_date`) VALUES
(10, 'shiva', 'shiav@gmail.com', '$2y$10$rj5YU9HvuT/GMjOzgop5ZeundxQcciFE2LPm0aWDlrr', '2020-07-01 06:32:28', NULL),
(11, 'shivavai', 'gyawalivai@gmail.com', '$2y$10$UELNiunZ5XuN7FxaYmfiz.pu2t9KOyl0yl9C87zugqu', '2020-07-01 10:05:08', NULL),
(12, 'sabite', 'sabite@', 'sabite', '2020-07-04 15:15:33', NULL),
(13, 'test', 'test@gmail.com', '$2y$10$h4jAv/pCx.ZEc7lLC/MCmO1z5GqolZeeihafl9ytRtE', '2020-07-04 15:49:59', NULL),
(14, 'suman vai', 'sumanvai@gmail.com', 'suman', '2020-07-05 02:16:54', '2020-07-17 08:16:26'),
(16, 'vanja', 'vanja@gmail.com', '1234', '2020-07-11 09:51:02', NULL),
(17, 'vanja', 'vanja@gmail.com1', '1234', '2020-07-11 11:26:12', NULL),
(18, 'name', 'email@email.com', 'password', '2020-07-11 11:45:57', NULL),
(19, 'name is', 'email2@email.com', 'password', '2020-07-11 11:47:03', NULL),
(20, 'name', 'email3@email.com', 'password', '2020-07-11 11:49:59', NULL),
(22, 'name', 'email4@email.com', 'password', '2020-07-12 07:01:39', NULL),
(24, 'name', '2email@email.com', 'password', '2020-07-12 07:29:07', NULL),
(25, 'Suman Kharel', 'sumankharel666@gmail.com', 'suman', '2020-07-12 10:58:17', NULL),
(26, 'Sakshu vanja', 'sakshu@gmail.com', '1234', '2020-07-13 04:22:20', NULL),
(27, 'pradeep vai', 'pradeep@gmail.com', '1234', '2020-07-13 09:00:08', NULL),
(28, 'gunnidhi', 'gokul@gmail.com', '1234', '2020-07-14 15:04:06', NULL),
(30, 'Kapil', 'kpd@gmail.com', '1234', '2020-10-08 15:08:45', NULL),
(32, 'keshab', 'keshav@gmail.com', 'keshav', '2020-10-13 13:04:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hostel_details`
--

CREATE TABLE `hostel_details` (
  `hdid` int(11) NOT NULL,
  `hostel_code` varchar(20) NOT NULL,
  `total_room_number` int(11) NOT NULL,
  `facility` varchar(300) DEFAULT NULL,
  `pricing` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hostel_details`
--

INSERT INTO `hostel_details` (`hdid`, `hostel_code`, `total_room_number`, `facility`, `pricing`) VALUES
(1, 'hf20201', 50, 'Food, transport, wifi,', 4000),
(8, 'hf20202', 20, 'wifi, food, sanitation', 4000);

-- --------------------------------------------------------

--
-- Table structure for table `hostel_owner`
--

CREATE TABLE `hostel_owner` (
  `sid` int(11) NOT NULL,
  `req_id` int(10) NOT NULL,
  `hostel_owner_name` varchar(50) NOT NULL,
  `hostel_name` varchar(200) NOT NULL,
  `hostel_location` varchar(200) NOT NULL,
  `hostel_type` varchar(10) NOT NULL,
  `contact_number` bigint(20) NOT NULL,
  `hostel_email` varchar(100) NOT NULL,
  `hostel_code` varchar(20) NOT NULL,
  `login_pwd` varchar(100) NOT NULL,
  `hostel_registered_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updation_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hostel_owner`
--

INSERT INTO `hostel_owner` (`sid`, `req_id`, `hostel_owner_name`, `hostel_name`, `hostel_location`, `hostel_type`, `contact_number`, `hostel_email`, `hostel_code`, `login_pwd`, `hostel_registered_date`, `updation_date`) VALUES
(1, 1, 'Bipuj solta', 'Like button boys hostel', 'Indrachowk', 'Boys', 9806597535, 'like@gmail.com', 'hf20201', 'hf20201', '2020-06-29 18:15:00', '2020-07-05 05:12:53'),
(2, 2, 'Praman Ghimire', 'Green Durbar Hostel', 'Duwakot bhaktapur', 'Boys', 9800000000, 'paramanghimire25@gmail.com', 'hf20202', 'hf20202', '2020-07-04 13:56:01', NULL),
(3, 3, 'Bipuj solta', 'Like button boys hostel', 'Indrachowk', 'Boys', 9806597535, 'like@gmail.com', 'hf20203', 'hf20203', '2020-07-04 13:56:19', '2020-07-11 09:39:12'),
(5, 4, 'Hari Bhai Aacharya', 'Engineering Boys Hostel', 'Bhaktapur', 'Boys', 9867683096, 'engineeringboyshostel@gmail.com', 'hf20204', 'hf20204', '2020-10-14 08:26:56', NULL),
(7, 6, 'Minakshi Dev', 'Minu Girls Hostel', 'Birgunj', 'Girls', 9806976453, 'minugirls@gmail.com', 'hf20206', 'hf20206', '2020-10-15 16:01:09', NULL),
(9, 9, 'Biwas Kunwar', 'Spikes Boys Hostel', 'Butwal', 'Boys', 9867676320, 'spikeshostel@gmail.com', 'hf20209', 'hf20209', '2020-10-16 04:08:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hostel_request`
--

CREATE TABLE `hostel_request` (
  `hrid` int(11) NOT NULL,
  `hostel_name` varchar(100) NOT NULL,
  `hostel_location` varchar(200) NOT NULL,
  `hostel_type` varchar(10) NOT NULL,
  `hostel_owner_name` varchar(200) NOT NULL,
  `contact_number` bigint(20) NOT NULL,
  `hostel_email` varchar(100) NOT NULL,
  `request_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(10) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hostel_request`
--

INSERT INTO `hostel_request` (`hrid`, `hostel_name`, `hostel_location`, `hostel_type`, `hostel_owner_name`, `contact_number`, `hostel_email`, `request_date`, `status`) VALUES
(1, 'Dhital Girls Hostel', 'Duwakot', 'Girls', 'Prakriti', 986745362, 'hgj@gmail.com', '2020-10-13 06:44:38', 'Approved'),
(2, 'Green Durbar Hostel', 'Duwakot Bhaktapur', 'Boys', 'Praman Ghimire', 9800000000, 'pramanghimire25@gmail.com', '2020-10-14 03:08:31', 'Approved'),
(3, 'Green Durbar Hostel', 'Duwakot Bhaktapur', 'Boys', 'Praman Ghimire', 9800000000, 'pramanghimire25@gmail.com', '2020-10-14 03:08:41', 'Approved'),
(4, 'Engineering Boys Hostel', 'Bhaktapur', 'Boys', 'Hari Bhai Aacharya', 9867683096, 'engineeringboyshostel@gmail.com', '2020-10-14 07:28:05', 'Approved'),
(6, 'Minu Girls Hostel', 'Birgunj', 'Girls', 'Minakshi Dev', 9806976453, 'minugirls@gmail.com', '2020-10-15 15:57:44', 'Approved'),
(8, 'Demo Boys Hostel', 'Lalitpur', 'Boys', 'Dan Bahadur', 9867456320, 'hosteldemo@gmail.com', '2020-10-16 04:04:15', 'Pending'),
(9, 'Spikes Boys Hostel', 'Butwal', 'Boys', 'Biwas Kunwar', 9867676320, 'spikeshostel@gmail.com', '2020-10-16 04:05:14', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `roomno` int(11) NOT NULL,
  `seater` int(11) NOT NULL,
  `feespm` int(11) NOT NULL,
  `foodstatus` int(11) NOT NULL,
  `stayfrom` date NOT NULL,
  `duration` int(11) NOT NULL,
  `course` varchar(500) NOT NULL,
  `regno` int(11) NOT NULL,
  `firstName` varchar(500) NOT NULL,
  `middleName` varchar(500) NOT NULL,
  `lastName` varchar(500) NOT NULL,
  `gender` varchar(250) NOT NULL,
  `contactno` bigint(11) NOT NULL,
  `emailid` varchar(500) NOT NULL,
  `egycontactno` bigint(11) NOT NULL,
  `guardianName` varchar(500) NOT NULL,
  `guardianRelation` varchar(500) NOT NULL,
  `guardianContactno` bigint(11) NOT NULL,
  `corresAddress` varchar(500) NOT NULL,
  `corresCIty` varchar(500) NOT NULL,
  `corresState` varchar(500) NOT NULL,
  `corresPincode` int(11) NOT NULL,
  `pmntAddress` varchar(500) NOT NULL,
  `pmntCity` varchar(500) NOT NULL,
  `pmnatetState` varchar(500) NOT NULL,
  `pmntPincode` int(11) NOT NULL,
  `postingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `roomno`, `seater`, `feespm`, `foodstatus`, `stayfrom`, `duration`, `course`, `regno`, `firstName`, `middleName`, `lastName`, `gender`, `contactno`, `emailid`, `egycontactno`, `guardianName`, `guardianRelation`, `guardianContactno`, `corresAddress`, `corresCIty`, `corresState`, `corresPincode`, `pmntAddress`, `pmntCity`, `pmnatetState`, `pmntPincode`, `postingDate`, `updationDate`) VALUES
(6, 100, 5, 8000, 0, '2016-04-22', 5, 'Bachelor  of Technology', 10806121, 'code', '', 'projects', 'male', 8285703354, 'code.lpu1@gmail.com', 0, 'XYZ', 'Mother', 8285703354, 'H n0 18/1 Bihari Puram Phase-1 Melrose Bye Pass', 'Aligarh', 'EPE', 202001, 'H n0 18/1 Bihari Puram Phase-1 Melrose Bye Pass', 'Aligarh', 'EPE', 202001, '2016-04-16 08:24:09', ''),
(7, 100, 5, 8000, 1, '2016-06-17', 4, 'Bachelor of Engineering', 108061211, 'code', 'test', 'projects', 'male', 8467067344, 'test@gmail.com', 8285703354, 'test', 'test', 9999857868, 'H no- 18/1 Bihari puram phase-1 melrose bye pass', 'Aligarh', 'EPE', 202001, 'H no- 18/1 Bihari puram phase-1 melrose bye pass', 'Aligarh', 'EPE', 202001, '2016-06-23 11:54:35', ''),
(8, 112, 3, 4000, 0, '2016-06-27', 5, 'Bachelor  of Science', 102355, 'Harry', 'projects', 'Singh', 'male', 6786786786, 'Harry@gmail.com', 789632587, 'demo', 'demo', 1234567890, 'New Delhi', 'Delhi', 'Delhi (NCT)', 110001, 'New Delhi', 'Delhi', 'Delhi (NCT)', 110001, '2016-06-26 16:31:08', ''),
(9, 132, 5, 2000, 1, '2016-06-28', 6, 'Bachelor of Engineering', 586952, 'Benjamin', '', 'projects', 'male', 8596185625, 'Benjamin@gmail.com', 8285703354, 'demo', 'demo', 8285703354, 'H no- 18/1 Bihari puram phase-1 melrose bye pass', 'Aligarh', 'EPE', 202001, 'H no- 18/1 Bihari puram phase-1 melrose bye pass', 'Aligarh', 'EPE', 202001, '2016-06-26 16:40:07', ''),
(10, 132, 7, 2000, 0, '2020-06-25', 2, 'Bachelor  of Science', 7676, 'vanja', '', 'twaake', 'male', 9806597535, 'vanja@gmail.com', 0, '000', '000', 0, '000', '000', 'Andhra Pradesh', 0, '000', '000', 'Andhra Pradesh', 0, '2020-06-25 07:50:51', '');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `seater` int(11) NOT NULL,
  `room_no` int(11) NOT NULL,
  `fees` int(11) NOT NULL,
  `posting_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `seater`, `room_no`, `fees`, `posting_date`) VALUES
(1, 100, 100, 8000, '2016-04-11 22:45:43'),
(2, 2, 201, 6000, '2016-04-12 01:30:47'),
(3, 2, 200, 6000, '2016-04-12 01:30:58'),
(4, 3, 112, 4000, '2016-04-12 01:31:07'),
(5, 5, 132, 2000, '2016-04-12 01:31:15');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `State` varchar(150) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `State`) VALUES
(1, 'Andaman and Nicobar Island (UT)'),
(2, 'Andhra Pradesh'),
(3, 'Arunachal Pradesh'),
(4, 'Assam'),
(5, 'Bihar'),
(6, 'Chandigarh (UT)'),
(7, 'Chhattisgarh'),
(8, 'Dadra and Nagar Haveli (UT)'),
(9, 'Daman and Diu (UT)'),
(10, 'Delhi (NCT)'),
(11, 'Goa'),
(12, 'Gujarat'),
(13, 'Haryana'),
(14, 'Himachal Pradesh'),
(15, 'Jammu and Kashmir'),
(16, 'Jharkhand'),
(17, 'Karnataka'),
(18, 'Kerala'),
(19, 'Lakshadweep (UT)'),
(20, 'Madhya Pradesh'),
(21, 'Maharashtra'),
(22, 'Manipur'),
(23, 'Meghalaya'),
(24, 'Mizoram'),
(25, 'Nagaland'),
(26, 'Odisha'),
(27, 'Puducherry (UT)'),
(28, 'Punjab'),
(29, 'Rajastha'),
(30, 'Sikkim'),
(31, 'Tamil Nadu'),
(32, 'Telangana'),
(33, 'Tripura'),
(34, 'Uttarakhand'),
(35, 'EPE'),
(36, 'West Bengal');

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `userIp` varbinary(16) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `loginTime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`id`, `userId`, `userEmail`, `userIp`, `city`, `country`, `loginTime`) VALUES
(1, 10, 'test@gmail.com', '', '', '', '2016-06-22 06:16:42'),
(2, 10, 'test@gmail.com', '', '', '', '2016-06-24 11:20:28'),
(4, 10, 'test@gmail.com', 0x3a3a31, '', '', '2016-06-24 11:22:47'),
(5, 10, 'test@gmail.com', 0x3a3a31, '', '', '2016-06-26 15:37:40'),
(6, 20, 'Benjamin@gmail.com', 0x3a3a31, '', '', '2016-06-26 16:40:57'),
(7, 10, 'test@gmail.com', 0x3139322e3136382e34332e3131, '', '', '2020-06-25 07:53:26'),
(8, 10, 'test@gmail.com', 0x3139322e3136382e34332e31, '', '', '2020-06-25 07:53:27'),
(9, 10, 'test@gmail.com', 0x3a3a31, '', '', '2020-06-25 07:54:21'),
(10, 22, 'kiran@gmail.com', 0x3a3a31, '', '', '2020-06-25 08:19:09');

-- --------------------------------------------------------

--
-- Table structure for table `userregistration`
--

CREATE TABLE `userregistration` (
  `id` int(11) NOT NULL,
  `regNo` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `middleName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `contactNo` bigint(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `regDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(45) NOT NULL,
  `passUdateDate` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userregistration`
--

INSERT INTO `userregistration` (`id`, `regNo`, `firstName`, `middleName`, `lastName`, `gender`, `contactNo`, `email`, `password`, `regDate`, `updationDate`, `passUdateDate`) VALUES
(10, '108061211', 'Hit ', 'that', 'like button', 'male', 9806597535, 'test@gmail.com', 'Test@123', '2016-06-22 04:21:33', '25-06-2020 01:24:59', '22-06-2016 05:16:49'),
(19, '102355', 'Harry', 'projects', 'Singh', 'male', 6786786786, 'Harry@gmail.com', '6786786786', '2016-06-26 16:33:36', '', ''),
(20, '586952', 'Benjamin', '', 'projects', 'male', 8596185625, 'Benjamin@gmail.com', '8596185625', '2016-06-26 16:40:07', '', ''),
(21, '7676', 'vanja', '', 'twaake', 'male', 9806597535, 'vanja@gmail.com', '9806597535', '2020-06-25 07:50:51', '', ''),
(22, '7676', 'kiran', '', 'adk', 'others', 9806597535, 'kiran@gmail.com', 'kiran', '2020-06-25 07:59:30', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `uiid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `user_phone_number` varchar(20) NOT NULL,
  `user_address` varchar(100) NOT NULL,
  `user_DOB` date NOT NULL,
  `user_gender` varchar(10) DEFAULT NULL,
  `user_guardian_name` varchar(50) NOT NULL,
  `user_guardian_contact_number` varchar(20) NOT NULL,
  `education` varchar(20) NOT NULL,
  `about_you` varchar(300) NOT NULL,
  `updation_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`uiid`, `uid`, `user_phone_number`, `user_address`, `user_DOB`, `user_gender`, `user_guardian_name`, `user_guardian_contact_number`, `education`, `about_you`, `updation_date`) VALUES
(7, 14, '9812967055', '', '2055-06-19', 'female', 'Krishna', '9867457622', '+2', 'I am handsome girl.', '2020-07-20 11:31:06'),
(8, 27, '9811552688', 'benimanipur ko top toll', '2058-11-18', NULL, 'keshav solta', '9818618836', '+2 running', 'lekhana ', NULL),
(12, 12, '9811552688', 'benimanipur ko top toll', '2058-11-18', 'male', 'keshav solta', '9818618836', '+2 running', 'lekhana ', NULL),
(13, 28, '98676', 'yert', '0000-00-00', 'Male', 'ter', '9867', 'School level, Scienc', 'something', NULL),
(14, 16, '98676', 'tanahu', '0000-00-00', 'Male', 'vinaju', '9867', '+2, Science', 'some like button footdablit', NULL),
(15, 18, '98676', 'email', '0000-00-00', 'Male', 'keshai', '9867', 'School level, Scienc', 'email@email.com', NULL),
(16, 19, '98676', 'email2', '0000-00-00', 'Male', 'email2', '9867', 'School level, Scienc', 'something foe', NULL),
(18, 24, '1231', 'bhutaha', '2001-07-17', 'Female', 'twaa', '1221', '+2, Management', 'it\'s testing about date of birth.', NULL),
(20, 26, '9869534590', 'Sardi, Chukaha', '2006-07-17', 'Male', 'Syamu dd', '9869534591', 'School level, Scienc', 'kasto kei hunxa ra.', '2020-09-26 14:46:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hosteluser`
--
ALTER TABLE `hosteluser`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `hostel_details`
--
ALTER TABLE `hostel_details`
  ADD PRIMARY KEY (`hdid`),
  ADD UNIQUE KEY `hostel_code_unique_key` (`hostel_code`);

--
-- Indexes for table `hostel_owner`
--
ALTER TABLE `hostel_owner`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `request_fk` (`req_id`);

--
-- Indexes for table `hostel_request`
--
ALTER TABLE `hostel_request`
  ADD PRIMARY KEY (`hrid`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userregistration`
--
ALTER TABLE `userregistration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`uiid`),
  ADD KEY `user_info_foreign` (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `hosteluser`
--
ALTER TABLE `hosteluser`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `hostel_details`
--
ALTER TABLE `hostel_details`
  MODIFY `hdid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `hostel_owner`
--
ALTER TABLE `hostel_owner`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `hostel_request`
--
ALTER TABLE `hostel_request`
  MODIFY `hrid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `userregistration`
--
ALTER TABLE `userregistration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `uiid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hostel_owner`
--
ALTER TABLE `hostel_owner`
  ADD CONSTRAINT `request_fk` FOREIGN KEY (`req_id`) REFERENCES `hostel_request` (`hrid`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `user_info`
--
ALTER TABLE `user_info`
  ADD CONSTRAINT `user_info_foreign` FOREIGN KEY (`uid`) REFERENCES `hosteluser` (`uid`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
