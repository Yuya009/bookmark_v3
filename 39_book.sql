-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:3306
-- 生成日時: 2021 年 1 月 22 日 22:29
-- サーバのバージョン： 5.7.30
-- PHP のバージョン: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- データベース: `gs_kadai_2`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_bm_table`
--

CREATE TABLE `gs_bm_table` (
  `id` int(12) NOT NULL,
  `img` text NOT NULL,
  `book` varchar(64) NOT NULL,
  `url` text NOT NULL,
  `price` text NOT NULL,
  `rdate` text NOT NULL,
  `indate` datetime NOT NULL,
  `u_id` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `gs_bm_table`
--

INSERT INTO `gs_bm_table` (`id`, `img`, `book`, `url`, `price`, `rdate`, `indate`, `u_id`) VALUES
(61, 'https://thumbnail.image.rakuten.co.jp/@0_mall/book/cabinet/0657/9784865940657.jpg?_ex=120x120', '気づけばプロ並みPHP 改訂版ーーゼロから作れる人になる！', 'https://books.rakuten.co.jp/rb/14651781/', '2970', '2017年02月18日頃', '2021-01-14 18:23:36', 'test'),
(62, 'https://thumbnail.image.rakuten.co.jp/@0_mall/book/cabinet/1577/9784815601577.jpg?_ex=120x120', '確かな力が身につくJavaScript「超」入門 第2版', 'https://books.rakuten.co.jp/rb/16014712/', '2728', '2019年09月24日頃', '2021-01-14 18:31:13', 'test'),
(63, 'https://thumbnail.image.rakuten.co.jp/@0_mall/book/cabinet/3977/9784774193977.jpg?_ex=120x120', 'プロを目指す人のためのRuby入門', 'https://books.rakuten.co.jp/rb/15209044/', '3278', '2017年12月', '2021-01-14 18:35:55', 'fukuda'),
(64, 'https://thumbnail.image.rakuten.co.jp/@0_mall/book/cabinet/0657/9784865940657.jpg?_ex=120x120', '気づけばプロ並みPHP 改訂版ーーゼロから作れる人になる！', 'https://books.rakuten.co.jp/rb/14651781/', '2970', '2017年02月18日頃', '2021-01-14 18:39:19', 'test'),
(65, 'https://thumbnail.image.rakuten.co.jp/@0_mall/book/cabinet/4111/9784774184111.jpg?_ex=120x120', 'JavaScript本格入門改訂新版', 'https://books.rakuten.co.jp/rb/14433718/', '3278', '2016年11月', '2021-01-14 18:39:25', 'test'),
(66, 'https://thumbnail.image.rakuten.co.jp/@0_mall/book/cabinet/7678/9784295007678.jpg?_ex=120x120', 'スラスラ読めるPHPふりがなプログラミング', 'https://books.rakuten.co.jp/rb/16074686/', '2200', '2019年11月', '2021-01-14 18:39:35', 'test'),
(86, 'https://thumbnail.image.rakuten.co.jp/@0_mall/book/cabinet/1577/9784815601577.jpg?_ex=120x120', '確かな力が身につくJavaScript「超」入門 第2版', 'https://books.rakuten.co.jp/rb/16014712/', '2728', '2019年09月24日頃', '2021-01-21 07:08:19', 'miyazaki'),
(89, 'https://thumbnail.image.rakuten.co.jp/@0_mall/book/cabinet/0657/9784865940657.jpg?_ex=120x120', '気づけばプロ並みPHP 改訂版ーーゼロから作れる人になる！', 'https://books.rakuten.co.jp/rb/14651781/', '2970', '2017年02月18日頃', '2021-01-22 08:55:34', 'test'),
(90, 'https://thumbnail.image.rakuten.co.jp/@0_mall/book/cabinet/1577/9784815601577.jpg?_ex=120x120', '確かな力が身につくJavaScript「超」入門 第2版', 'https://books.rakuten.co.jp/rb/16014712/', '2728', '2019年09月24日頃', '2021-01-22 21:50:47', 'fukuda'),
(91, 'https://thumbnail.image.rakuten.co.jp/@0_mall/book/cabinet/3682/9784297103682.jpg?_ex=120x120', 'JavaScriptコードレシピ集', 'https://books.rakuten.co.jp/rb/15761369/', '3278', '2019年02月', '2021-01-22 21:56:38', 'fukuda');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `gs_bm_table`
--
ALTER TABLE `gs_bm_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gs_bm_table_ibfk_1` (`u_id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `gs_bm_table`
--
ALTER TABLE `gs_bm_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `gs_bm_table`
--
ALTER TABLE `gs_bm_table`
  ADD CONSTRAINT `gs_bm_table_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `gs_user_table` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;
