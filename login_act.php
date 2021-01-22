<?php
session_start();
include("funcs.php");
$lid = $_POST["lid"];
$lpw = $_POST["lpw"];

// DB接続
$pdo = db_connect();

//検索SQL
$sql = "SELECT * FROM gs_user_table WHERE u_id=:lid";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':lid', $lid);
//$stmt->bindValue(':lpw', $lpw);
$res = $stmt->execute();

//SQL実行しにエラーがある場合
if($res==false) {
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}

//抽出データ数を取得
$val = $stmt->fetch(); //1レコードだけ取得する方法

//該当レコードがあればSESSIONに値を代入
if(password_verify($lpw, $val["u_pw"])){
//if($val["u_id"] != ""){
  $_SESSION["chk_ssid"] = session_id();
  $_SESSION["u_name"] = $val['u_name'];
  $_SESSION['u_id'] = $val['u_id'];
  $_SESSION['kanri_flg'] = $val['kanri_flg'];
  //Login処理OKの場合
  header("Location: index.php");
}else{
  //Login処理NGの場合
  header("Location: login.php");
}
//処理終了
exit();
?>