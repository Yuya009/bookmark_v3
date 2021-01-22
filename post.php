<?php
//Login処理
session_start();
include("funcs.php");
loginCheck();
//$u_id = $_POST['u_id'];
$book = $_POST['book'];
$img = $_POST['img'];
$url = $_POST['url'];
$price = $_POST['price'];
$release = $_POST['release'];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<form method="post" action="insert.php">
  <img src="<?= $img ?>">
  <p>本：<?= $book ?></p>
  <p>URL：<a href="<?=$url?>"><?=$url?></a></p>
  <p>値段：<?= $price ?>円</p>
  <p>発売日：<?= $release ?></p>
  <p><input type="submit" value="お気に入りに追加する"></p>
  <input type="hidden" name="img" value="<?= $img?>">
  <input type="hidden" name="book" value="<?= $book?>">
  <input type="hidden" name="url" value="<?= $url?>">
  <input type="hidden" name="price" value="<?= $price?>">
  <input type="hidden" name="release" value="<?= $release?>">
  <!-- <input type="hidden" value="<//?= $u_id ?>" name="u_id"> -->
</form>
<p> <a href="index.php">本の検索に戻る</a></p>
</body>
</html>