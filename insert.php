<?php
//Login処理
session_start();
include("funcs.php");
loginCheck();

// ユーザーIDのPOSTデータ
//$u_id = $_POST['u_id'];
$u_id = $_SESSION["u_id"];

// 本のPOSTデータ
$book = $_POST['book'];
$img = $_POST['img'];
$url = $_POST['url'];
$price = $_POST['price'];
$release = $_POST['release'];

//DB接続
$pdo = db_connect();

//データ登録
  //gs_bm_tableに本のデータ登録
  $stmt = $pdo->prepare("INSERT INTO gs_bm_table(id, img, book, url, price, rdate, indate, u_id)VALUES(NULL, :img, :book, :url, :price, :release, sysdate(), :u_id)");
  //バインド変数を用意（gs_bm_table)
  $stmt->bindValue(':book', h($book), PDO::PARAM_STR);
  $stmt->bindValue(':img', h($img), PDO::PARAM_STR);
  $stmt->bindValue(':url', h($url), PDO::PARAM_STR);
  $stmt->bindValue(':price', h($price), PDO::PARAM_STR);
  $stmt->bindValue(':release', h($release), PDO::PARAM_STR);
  $stmt->bindValue(':u_id', h($u_id), PDO::PARAM_STR);
  //実行
  $status = $stmt->execute();
  //データ登録処理後
  if($status==false) {
    $error = $stmt->execute();
    exit("ErrorMessage".$error[2]);
  }else{
    header("Location: index.php");
    //header("Location: index.php", true, 307);
    exit;
  }

// 重複確認 本のIDの取得
// $bm_url = $pdo->query("SELECT * FROM gs_bm_table WHERE url ='$url'");
// while( $result_bm = $bm_url->fetch(PDO::FETCH_ASSOC)){
//   $bm_url = $result_bm['url'];
//   $bm_id = $result_bm['id'];
// }

// if ($url == $bm_url){//
//   //データベース検索（bm_idを取得）
//   // $db_user = $pdo->query("SELECT * FROM gs_bm_table WHERE url ='$url'");
//   // while( $result = $db_user->fetch(PDO::FETCH_ASSOC)){
//   //   $bm_id = $result['id'];
//  //gs_bm_tableからIDの取得
//   //$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
//   //$status = $stmt->execute();

//   //user_bm_table（中間テーブル）にユーザーIDと書籍のURLの登録
//   $stmt_m = $pdo->prepare("INSERT INTO user_bm_table(id, u_id, bm_id)VALUES(NULL, :u_id, :bm_id)");
//   //バインド変数を用意（user_bm_table)
//   $stmt_m->bindValue(':u_id', h($u_id), PDO::PARAM_STR);
//   $stmt_m->bindValue(':bm_id', h($bm_id), PDO::PARAM_STR);
//   //実行
//   $status_m = $stmt_m->execute();

//   //データ登録処理後
//   if($status_m==false) {
//     $error = $stmt->execute();
//     exit("ErrorMessage".$error[2]);
//   }else{
//     header("Location: index.php");
//     //header("Location: index.php", true, 307);
//     exit;
//   }
// }else{
  
// }

//データ表示
// if ($status==false) {
//     //execute（SQL実行時にエラーがある場合）
//   $error = $stmt->errorInfo();
//   exit("ErrorQuery:".$error[2]);
// }else{

// }




?>
<!-- 
<!DOCTYPE html>
<html lang="">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  登録しました
</body>
</html> -->