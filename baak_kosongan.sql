-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 21, 2015 at 07:37 PM
-- Server version: 5.5.46-0ubuntu0.14.04.2
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `baak`
--

-- --------------------------------------------------------

--
-- Table structure for table `m_agenda`
--

CREATE TABLE IF NOT EXISTS `m_agenda` (
  `agenda_id` int(11) NOT NULL AUTO_INCREMENT,
  `judul_ind` varchar(255) NOT NULL,
  `judul_ing` varchar(255) NOT NULL,
  `agenda_ind` longblob NOT NULL,
  `agenda_ing` longblob NOT NULL,
  `agenda_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `agenda_users` int(11) NOT NULL,
  `flag` int(1) NOT NULL,
  PRIMARY KEY (`agenda_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `m_artikel`
--

CREATE TABLE IF NOT EXISTS `m_artikel` (
  `artikel_id` int(11) NOT NULL AUTO_INCREMENT,
  `judul_ind` varchar(255) NOT NULL,
  `judul_ing` varchar(255) NOT NULL,
  `artikel_ind` longblob NOT NULL,
  `artikel_ing` longblob NOT NULL,
  `artikel_user` int(255) NOT NULL,
  `artikel_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `m_sidebar_id` int(11) DEFAULT '0',
  PRIMARY KEY (`artikel_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Table structure for table `m_pengumuman`
--

CREATE TABLE IF NOT EXISTS `m_pengumuman` (
  `pengumuman_id` int(11) NOT NULL AUTO_INCREMENT,
  `judul_ind` varchar(255) NOT NULL,
  `judul_ing` varchar(255) NOT NULL,
  `pengumuman_ind` longblob NOT NULL,
  `pengumuman_ing` longblob NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `flag` int(11) NOT NULL,
  `pengumuman_users` int(11) NOT NULL,
  PRIMARY KEY (`pengumuman_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `m_quicklink`
--

CREATE TABLE IF NOT EXISTS `m_quicklink` (
  `quicklink_id` int(11) NOT NULL AUTO_INCREMENT,
  `quicklink_nama` varchar(255) NOT NULL,
  `quicklink_url` varchar(255) NOT NULL,
  `quicklink_image` varchar(255) NOT NULL,
  PRIMARY KEY (`quicklink_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `m_role`
--

CREATE TABLE IF NOT EXISTS `m_role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_nama` varchar(255) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `m_role`
--

INSERT INTO `m_role` (`role_id`, `role_nama`) VALUES
(1, 'administrator'),
(2, 'contributor');

-- --------------------------------------------------------

--
-- Table structure for table `m_setting`
--

CREATE TABLE IF NOT EXISTS `m_setting` (
  `setting_id` int(11) NOT NULL,
  `setting_nama_unit` varchar(255) NOT NULL,
  `setting_detail_unit` varchar(255) NOT NULL,
  `setting_email_unit` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_setting`
--

INSERT INTO `m_setting` (`setting_id`, `setting_nama_unit`, `setting_detail_unit`, `setting_email_unit`) VALUES
(1, 'BAKP ITS', 'BIRO AKADEMIK KEMAHASISWAAN DAN PERENCANAAN', 'baakcare@its.ac.id');

-- --------------------------------------------------------

--
-- Table structure for table `m_sidebar`
--

CREATE TABLE IF NOT EXISTS `m_sidebar` (
  `sidebar_id` int(11) NOT NULL AUTO_INCREMENT,
  `sidebar_ind` varchar(255) NOT NULL,
  `sidebar_ing` varchar(255) NOT NULL,
  `sidebar_parent` int(11) NOT NULL,
  `sidebar_users` int(11) NOT NULL,
  `sidebar_urutan` int(11) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `flag` int(1) NOT NULL,
  PRIMARY KEY (`sidebar_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `m_upload`
--

CREATE TABLE IF NOT EXISTS `m_upload` (
  `upload_id` int(11) NOT NULL AUTO_INCREMENT,
  `upload_nama` varchar(255) NOT NULL,
  `upload_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `upload_users` int(11) NOT NULL,
  `upload_ext` varchar(255) NOT NULL,
  PRIMARY KEY (`upload_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `m_users`
--

CREATE TABLE IF NOT EXISTS `m_users` (
  `users_id` int(11) NOT NULL AUTO_INCREMENT,
  `users_nama` varchar(255) NOT NULL,
  `users_password` varchar(255) NOT NULL,
  `users_active` int(1) NOT NULL,
  `users_roles` int(11) NOT NULL,
  PRIMARY KEY (`users_id`),
  KEY `users_roles` (`users_roles`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `m_users`
--

INSERT INTO `m_users` (`users_id`, `users_nama`, `users_password`, `users_active`, `users_roles`) VALUES
(1, 'admin', 'c0f65251f68f727068a03f7e468d7d60', 1, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `m_users`
--
ALTER TABLE `m_users`
  ADD CONSTRAINT `m_users_ibfk_1` FOREIGN KEY (`users_roles`) REFERENCES `m_role` (`role_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
