-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2019 at 10:22 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.1.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ictpms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `user_id` int(200) NOT NULL,
  `name` varchar(255) NOT NULL,
  `department` varchar(200) NOT NULL,
  `role` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`user_id`, `name`, `department`, `role`, `email_address`, `username`, `password`) VALUES
(111, 'admin', '', '', 'admin@admin.com', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `backup`
--

CREATE TABLE `backup` (
  `id` int(11) NOT NULL,
  `Proj_code` varchar(30) DEFAULT NULL,
  `Project_name` varchar(255) DEFAULT NULL,
  `Impl_code` varchar(30) DEFAULT NULL,
  `Impl_status` varchar(255) DEFAULT NULL,
  `Proj_status` varchar(255) DEFAULT NULL,
  `Remarks` varchar(255) DEFAULT NULL,
  `Action_required` varchar(255) DEFAULT NULL,
  `update_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `backup`
--

INSERT INTO `backup` (`id`, `Proj_code`, `Project_name`, `Impl_code`, `Impl_status`, `Proj_status`, `Remarks`, `Action_required`, `update_date`) VALUES
(5, 'fmpst', '3030', '301', 'editing and database', 'Running', 'good', 'nothing', '2019-04-12'),
(6, 'fmpst', '3030', '301', 'editing and database', 'Stalled', 'new work', 'nothing', '2019-04-12'),
(7, 'fmpst', '3030', '301', 'editing and database', 'Stalled', 'new work', 'some changes', '2019-04-12');

-- --------------------------------------------------------

--
-- Table structure for table `backupstatus`
--

CREATE TABLE `backupstatus` (
  `Proj_code` varchar(30) NOT NULL,
  `Impl_code` varchar(30) NOT NULL,
  `Impl_status` varchar(255) NOT NULL,
  `Proj_status` varchar(255) NOT NULL,
  `Remarks` varchar(255) DEFAULT NULL,
  `Action_required` varchar(255) NOT NULL,
  `update_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `general_information`
--

CREATE TABLE `general_information` (
  `Proj_code` varchar(30) NOT NULL,
  `Project_name` varchar(255) NOT NULL,
  `project_mentor` varchar(255) CHARACTER SET utf8 NOT NULL,
  `AppearsIn_BussPlan` varchar(3) NOT NULL,
  `team_leader` varchar(250) NOT NULL,
  `T_member1` varchar(30) NOT NULL,
  `T_member2` varchar(255) NOT NULL,
  `T_member3` varchar(255) NOT NULL,
  `T_member4` varchar(255) NOT NULL,
  `T_mem5` varchar(255) NOT NULL,
  `Scope` text NOT NULL,
  `Purpose` text CHARACTER SET utf8 NOT NULL,
  `github_url` varchar(2043) NOT NULL,
  `Planned_completion` int(11) NOT NULL,
  `Impl_StartDate` date NOT NULL,
  `Impl_EndDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `general_information`
--

INSERT INTO `general_information` (`Proj_code`, `Project_name`, `project_mentor`, `AppearsIn_BussPlan`, `team_leader`, `T_member1`, `T_member2`, `T_member3`, `T_member4`, `T_mem5`, `Scope`, `Purpose`, `github_url`, `Planned_completion`, `Impl_StartDate`, `Impl_EndDate`) VALUES
('1001', 'code raiders', 'ayush gupta', 'NO', 'rishika jain', 'divya', 'prachi', 'virendra', 'babita', 'geeta', 'not that wide scope', 'learning purpose', 'http://localhost/phpmyadmin/sql.php?server=1&db=ictpms&table=general_information&pos=0', 1, '2019-04-24', '2019-04-24'),
('101', 'HUB', 'ayush gupta', 'YES', 'Prachi', 'rishika', 'virendra', 'divya', 'rishika jain', 'bab', 'scope', 'purpose', 'http://localhost/phpmyadmin/sql.php?server=1&db=ictpms&table=general_information&pos=0', 12, '2019-04-23', '2019-04-23'),
('3030', 'fmpst', 'ayush gupta', 'NO', 'divya jain', 'rishika', 'virendra', 'prachi', 'babita', 'geeta', '', '', 'http://localhost/phpmyadmin/sql.php?server=1&db=ictpms&table=general_information&pos=0', 1, '2019-04-26', '2019-04-26'),
('3085', 'web_page', 'ayush gupta', 'NO', 'divya jain', 'rishika', 'virendra', 'prachi', 'babita', 'geeta', 'nothing', 'just for fun', 'http://localhost/phpmyadmin/sql.php?server=1&db=ictpms&table=general_information&pos=0', 20, '2019-04-23', '2019-04-23'),
('313001', 'fmp', 'ayush gupta', 'NO', 'divya jain', 'rishika', 'virendra', 'prachi', 'rishika jain', 'geeta', 'dfs', 'dqewerat', 'http://localhost/phpmyadmin/sql.php?server=1&db=ictpms&table=general_information&pos=0', 1, '2019-04-20', '2019-04-20'),
('911', 'pmmp', 'aaditya sir', 'NO', 'rishika jain', 'divya', 'virendra', 'prachi', 'babita', 'bab', 'scopeeeeeeeeeee', 'purposeeeeeeeeeeeee', 'http://localhvkjrnkrhgkgkj,jgtfenhjfukjh3rmin/sql.php?server=1&db=ictpms&table=general_information&pos=0', 1, '2019-04-16', '2019-04-16');

-- --------------------------------------------------------

--
-- Table structure for table `implementation_status`
--

CREATE TABLE `implementation_status` (
  `Proj_code` varchar(30) NOT NULL,
  `Impl_code` varchar(30) NOT NULL,
  `Impl_status` varchar(255) NOT NULL,
  `Proj_status` varchar(255) NOT NULL,
  `Remarks` varchar(255) DEFAULT NULL,
  `Action_required` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `implementation_status`
--

INSERT INTO `implementation_status` (`Proj_code`, `Impl_code`, `Impl_status`, `Proj_status`, `Remarks`, `Action_required`) VALUES
('101', '101', 'scenario', 'Running', 'Remarks', 'Action'),
('3030', '301', 'editing and database', 'Stalled', 'new work', 'xyz'),
('3085', '101', 'whatever', 'Running', 'no remarks', 'shut up'),
('313001', '300', 'sada', 'Running', 'sad', 'very sad'),
('911', '102', 'project scenario', 'Completed', 'no remarks', 'no action');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` varchar(8) NOT NULL,
  `name` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `department`, `role`, `email_address`, `username`, `password`) VALUES
('101', 'ayush gupta', 'cse', 'mentor', 'ayush.gupta@gmail.com', 'ayush', 'caf1a3dfb505ffed0d024130f58c5cfa'),
('102', 'aaditya maheshwari', 'CSE', 'Mentor', 'superadmin@gmail.com', 'aaditya', '202cb962ac59075b964b07152d234b70'),
('103', 'paras kothari', 'CSE', 'HOD', 'paras@gmail.com', 'paras', '202cb962ac59075b964b07152d234b70');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `backup`
--
ALTER TABLE `backup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `backupstatus`
--
ALTER TABLE `backupstatus`
  ADD PRIMARY KEY (`Proj_code`,`Impl_code`);

--
-- Indexes for table `general_information`
--
ALTER TABLE `general_information`
  ADD PRIMARY KEY (`Proj_code`);

--
-- Indexes for table `implementation_status`
--
ALTER TABLE `implementation_status`
  ADD PRIMARY KEY (`Proj_code`,`Impl_code`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `backup`
--
ALTER TABLE `backup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `implementation_status`
--
ALTER TABLE `implementation_status`
  ADD CONSTRAINT `fk` FOREIGN KEY (`Proj_code`) REFERENCES `general_information` (`Proj_code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
