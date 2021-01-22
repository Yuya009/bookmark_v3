<?php
session_start();
include("funcs.php");
loginCheck();

//1. POSTデータ取得
$u_name = $_POST["u_name"];
$u_id = $_POST["u_id"];
$kanri_flg = $_POST["kanri_flg"];

echo $u_name . "\n";
echo $u_id. "\n";
echo $kanri_flg. "\n";

//2. DB接続します
require_once("funcs.php");
$pdo = db_connect();

//３．データ登録SQL作成
$stmt = $pdo->prepare("UPDATE gs_user_table SET u_name=:u_name,kanri_flg=:kanri_flg WHERE u_id=:u_id");
$stmt->bindValue(':u_id',      $u_id,      PDO::PARAM_STR);
$stmt->bindValue(':u_name',    h($u_name), PDO::PARAM_STR);
$stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT);
$status = $stmt->execute(); //実行

//４．データ登録処理後
if ($status == false) {
  sql_error($stmt);
  //print_r($pdo->errorInfo());
} else {
  header("Location: list.php");
  exit;
}
