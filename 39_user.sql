-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:3306
-- 生成日時: 2021 年 1 月 22 日 22:28
-- サーバのバージョン： 5.7.30
-- PHP のバージョン: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- データベース: `gs_kadai_2`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_user_table`
--

CREATE TABLE `gs_user_table` (
  `u_id` varchar(64) NOT NULL,
  `u_name` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `u_pw` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `kanri_flg` int(1) NOT NULL,
  `life_flg` int(1) NOT NULL,
  `indate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `gs_user_table`
--

INSERT INTO `gs_user_table` (`u_id`, `u_name`, `u_pw`, `kanri_flg`, `life_flg`, `indate`) VALUES
('fukuda', '福田', '$2y$10$UuDDdziq9aeEUUjELHKel.8hcn.UcLy5kuMXyg/ME7Rs0z0fx33tO', 1, 0, '2021-01-05 20:58:34'),
('miyazaki', '宮崎', '$2y$10$UuDDdziq9aeEUUjELHKel.8hcn.UcLy5kuMXyg/ME7Rs0z0fx33tO', 1, 0, '2021-01-21 07:07:38'),
('ooita', '大分', '$2y$10$aX0QYjPnF.4vXtcmCHbtUuZOoYt3HsunPC.n4BLlDhPOpm/zMk7Ym', 1, 0, '2021-01-22 08:49:04'),
('saitama', '埼玉', '$2y$10$UuDDdziq9aeEUUjELHKel.8hcn.UcLy5kuMXyg/ME7Rs0z0fx33tO', 0, 0, '2021-01-21 07:07:59'),
('test', 'test', '$2y$10$UuDDdziq9aeEUUjELHKel.8hcn.UcLy5kuMXyg/ME7Rs0z0fx33tO', 0, 0, '2021-01-07 07:14:03');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `gs_user_table`
--
ALTER TABLE `gs_user_table`
  ADD PRIMARY KEY (`u_id`);
