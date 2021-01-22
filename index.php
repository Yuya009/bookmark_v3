<?php

//Login処理
session_start();
include("funcs.php");
loginCheck();
require_once('funcs.php');

// ログイン者判別
$u_name = $_SESSION["u_name"];
$u_id = $_SESSION["u_id"];

// var_dump($_POST);
// DB接続
$pdo = db_connect();

//データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
$status = $stmt->execute();

//データ表示
$view="";
if ($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  // ↓これは全データ取得
  // while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
  //   $view .= '<div class="book_m"><a href='. $result['url'] .' target="_blank" rel="noopener noreferrer"><img src='. $result['img'] .'></a></div>';
  //データベース検索（bm_idを取得）
  $db_user = $pdo->query("SELECT * FROM gs_bm_table WHERE u_id ='$u_id'");
  while( $result = $db_user->fetch(PDO::FETCH_ASSOC)){
    $view .= '<div class="book_m"><a href='. $result['url'] .' target="_blank" rel="noopener noreferrer"><img src='. $result['img'] .'></a></div>';
    // $bm_id = $result['bm_id'];
    //gs_bm_tableの検索
    // $db_bm = $pdo->query("SELECT * FROM gs_bm_table WHERE url ='$bm_id'");
    // while( $result_bm = $db_bm->fetch(PDO::FETCH_ASSOC)){
    //   $view .= '<div class="book_m"><a href='. $result_bm['url'] .' target="_blank" rel="noopener noreferrer"><img src='. $result_bm['img'] .'></a></div>';
    // }
  }
}

//管理者の場合
$nav = mg();

?>
<script>
  function check(){
    var a=document.search_form.books.value;
    if(a==""){
      return false;
    }else if(!a.match(/\S/g)){
      return false;
    }
  }
</script>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/reset.css">
  <link rel="stylesheet" href="./css/style.css">
  <title>ブックマークアプリ</title>
</head>
<body>
  <div class="right">
    <a href="index.php" class="right">検索ページ</a>
    <a href="select.php" class="right"><?= $u_name ?>さんのブックマーク一覧</a>
    <?= $nav ?>
    <a href="logout.php" class="right">ログアウト</a>
  </div>
  <h1 class="center">Book</h1>
  <form method="get" onsubmit="return check()" action="search.php" class="center" name="search_form">
    <label><input placeholder="本の名前を入力" type="text" name="books" class="search"></label><br>
    <input class="search_btn" type="submit" value="検索する" class="under">
    <input type="hidden" value="<?= $u_id ?>" name="u_id">
  </form>
  <div class="book">
  <a href="select.php" class="right"><?= $u_name ?>さんのブックマーク一覧</a>
  </div>
  <div class="side">
    <?= $view ?>
  </div>
</body>
</html>
