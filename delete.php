<?php
//Login処理
session_start();
include("funcs.php");
loginCheck();
require_once('funcs.php');

$id = $_POST['id'];
// DB接続
$pdo = db_connect();

//ブックマークの削除
//データ登録
//SQL文
$stmt = $pdo->prepare("DELETE FROM gs_bm_table WHERE id = :id");

//バインド変数を用意
$stmt->bindValue(':id', h($id), PDO::PARAM_INT);

//実行
$status = $stmt->execute();

//データ登録処理後
if($status==false) {
  $error = $stmt->execute();
  exit("ErrorMessage".$error[2]);
}else{
  header("Location: select.php");
  exit;
}
?>