-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024-01-07 10:28:12
-- 伺服器版本： 10.4.32-MariaDB
-- PHP 版本： 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `schedule`
--

-- --------------------------------------------------------

--
-- 資料表結構 `dock`
--

CREATE TABLE `dock` (
  `Dock_Id` int(4) NOT NULL,
  `Id` int(4) NOT NULL,
  `Dock_Reason` text NOT NULL,
  `Dock_Price` int(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `events`
--

CREATE TABLE `events` (
  `Event_Id` int(4) NOT NULL,
  `Id` int(4) NOT NULL,
  `Info_Content` text NOT NULL,
  `Info_Remark` varchar(32) NOT NULL,
  `Date` date NOT NULL,
  `Time_Start` time(6) NOT NULL,
  `Time_End` time(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `leaves`
--

CREATE TABLE `leaves` (
  `Id` int(4) NOT NULL,
  `Leave_Id` int(4) NOT NULL,
  `Leave_Remark` text NOT NULL,
  `Leave_Type` int(4) NOT NULL,
  `Leave_Reason` text NOT NULL,
  `Leave_Start` time(6) NOT NULL,
  `Leave_End` time(6) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `salary`
--

CREATE TABLE `salary` (
  `Id` int(4) NOT NULL,
  `Salary` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `salary`
--

INSERT INTO `salary` (`Id`, `Salary`) VALUES
(0, 8000),
(1, 8000),
(2, 4000),
(3, 2000),
(4, 2000),
(5, 2000);

-- --------------------------------------------------------

--
-- 資料表結構 `train`
--

CREATE TABLE `train` (
  `Train_Id` int(4) NOT NULL,
  `Id_1` int(4) NOT NULL,
  `Id_2` int(4) NOT NULL,
  `Train_Content` text NOT NULL,
  `Date` date NOT NULL,
  `Time_Start` time(6) NOT NULL,
  `Time_End` time(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `Id` int(4) NOT NULL,
  `Account` varchar(32) NOT NULL,
  `Password` varchar(24) NOT NULL,
  `Access` varchar(12) NOT NULL,
  `Name` varchar(12) NOT NULL,
  `Gender` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `users`
--

INSERT INTO `users` (`Id`, `Account`, `Password`, `Access`, `Name`, `Gender`) VALUES
(0, 'John@gmail.com', '12345678', '管理員', '約翰', '男'),
(1, 'Amy@gmail.com', '12345678', '管理員', '艾米', '女'),
(2, 'Devid@gmail.com', '12345678', '員工', '大衛', '男'),
(3, 'Kevin@gmail.com', '12345678', '員工', '凱文', '男'),
(4, 'Alven@gmail.com', '12345678', '員工', '艾爾文', '男'),
(5, 'Stella@gmail.com', '12345678', '員工', '史黛拉', '女');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `dock`
--
ALTER TABLE `dock`
  ADD PRIMARY KEY (`Dock_Id`),
  ADD KEY `Id` (`Id`);

--
-- 資料表索引 `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`Event_Id`),
  ADD KEY `Id` (`Id`);

--
-- 資料表索引 `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`Leave_Id`),
  ADD KEY `Id` (`Id`);

--
-- 資料表索引 `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`Id`);

--
-- 資料表索引 `train`
--
ALTER TABLE `train`
  ADD PRIMARY KEY (`Train_Id`),
  ADD KEY `Id_1` (`Id_1`),
  ADD KEY `Id_2` (`Id_2`);

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `dock`
--
ALTER TABLE `dock`
  MODIFY `Dock_Id` int(4) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `events`
--
ALTER TABLE `events`
  MODIFY `Event_Id` int(4) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `leaves`
--
ALTER TABLE `leaves`
  MODIFY `Leave_Id` int(4) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `train`
--
ALTER TABLE `train`
  MODIFY `Train_Id` int(4) NOT NULL AUTO_INCREMENT;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `dock`
--
ALTER TABLE `dock`
  ADD CONSTRAINT `dock_ibfk_1` FOREIGN KEY (`Id`) REFERENCES `users` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制式 `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`Id`) REFERENCES `users` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制式 `leaves`
--
ALTER TABLE `leaves`
  ADD CONSTRAINT `leaves_ibfk_1` FOREIGN KEY (`Id`) REFERENCES `users` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制式 `salary`
--
ALTER TABLE `salary`
  ADD CONSTRAINT `salary_ibfk_1` FOREIGN KEY (`Id`) REFERENCES `users` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制式 `train`
--
ALTER TABLE `train`
  ADD CONSTRAINT `train_ibfk_1` FOREIGN KEY (`Id_1`) REFERENCES `users` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `train_ibfk_2` FOREIGN KEY (`Id_2`) REFERENCES `users` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
