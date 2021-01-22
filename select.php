<?php
//Login処理
session_start();
include("funcs.php");
loginCheck();

//ログイン者
$u_id = $_SESSION["u_id"];

require_once('funcs.php');
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
  $db_user = $pdo->query("SELECT * FROM gs_bm_table WHERE u_id ='$u_id'");
  while( $result = $db_user->fetch(PDO::FETCH_ASSOC)){
    $view .= '<div style="margin-bottom: 20px; padding: 30px; border: 1px solid #000; overflow:hidden;">';
    $view .= '<div style="float: left;"><img src='. $result['img'] .'></div>';
    $view .= '<div style="float: left; padding: 20px;">';
    $view .= '<div><a href='. $result['url'] .' target="_blank" rel="noopener noreferrer">'. $result["book"] .'</a></div>';
    $view .= '<div>価格：' . $result['price'] . '円</div><div>発売日：' . $result['rdate'] . '</div>';
    $view .= '<form action="delete.php" method="post">';
    $view .= '<input class="search_btn_d" type="submit" value="削除する">';
    $view .= '<input type="hidden" name="id" value="'. $result['id'] .'">';
    $view .= '</form>';
    $view .= '</div>';
    $view .= '</div>';
  }
}
//管理者の場合
$nav = mg();
$u_name = $_SESSION["u_name"];
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>フリーアンケート表示</title>
<link rel="stylesheet" href="./css/reset.css">
<link rel="stylesheet" href="./css/style.css">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div class="right">
    <a href="index.php" class="right">検索ページ</a>
    <a href="select.php" class="right"><?= $u_name ?>さんのブックマーク一覧</a>
    <?= $nav ?>
    <a href="logout.php" class="right">ログアウト</a>
  </div>
<div>
    <div class="container jumbotron"><?= $view ?></div>
</div>
<!-- Main[End] -->

</body>
</html>
