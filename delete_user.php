<?php
//Login処理
session_start();
include("funcs.php");
loginCheck();
require_once('funcs.php');

// DB接続
$pdo = db_connect();
//削除するID
$u_id = $_GET['u_id'];
//会員の削除
$stmt = $pdo->prepare("DELETE FROM gs_user_table WHERE u_id = :u_id"); //削除
$stmt->bindValue(':u_id', h($u_id), PDO::PARAM_STR);  //バインド変数
$status = $stmt->execute(); //実行

//データ登録処理後
if($status==false) {
  $error = $stmt->execute();
  exit("ErrorMessage".$error[2]);
}else{
    header("Location: list.php");
    exit;
}

