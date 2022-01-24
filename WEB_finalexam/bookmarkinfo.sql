-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- 생성 시간: 21-12-14 08:56
-- 서버 버전: 10.4.21-MariaDB
-- PHP 버전: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `201704144`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `bookmarkinfo`
--

CREATE TABLE `bookmarkinfo` (
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visits` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 테이블의 덤프 데이터 `bookmarkinfo`
--

INSERT INTO `bookmarkinfo` (`name`, `address`, `class`, `icon`, `visits`) VALUES
('GitHub', 'https://github.com/', 'IT', '/image2.jpg', 0),
('Papago', 'https://papago.naver.com', '영어', '/image3.jpg', 0),
('간장', 'https://github.com/', 'IT', '	/image2.jpg', 0),
('공장', 'https://github.com/', 'IT', '/image2.jpg	', 0),
('구름', 'https://ide.goorm.io', 'IT', '/image5.jpg', 0),
('김장', 'https://github.com/', 'IT', '	/image2.jpg	', 0),
('네이버1', 'https://www.naver.com/', '포털', '/index1.jpg', 0),
('인스타', 'https://www.instagram.com', 'SNS', '/image4.jpg', 0);

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `bookmarkinfo`
--
ALTER TABLE `bookmarkinfo`
  ADD PRIMARY KEY (`name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
