<?php
//共通に使う関数を記述

//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}

//Login認証チェック関数
function loginCheck(){
  if( !isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"]!=session_id()){
    echo "LOGIN Error!";
    exit();
  }else{
    session_regenerate_id(true);
    $_SESSION["chk_ssid"] = session_id();
  }
}

//DB接続
function db_connect(){
  try {
    $pdo = new PDO('mysql:dbname=gs_kadai_2;charset=utf8;host=localhost','root','root');
  } catch (PDOException $e) {
    exit('DBConnectError'.$e->getMessage());
  }
  return $pdo;
}

//ゲストログイン
function lid(){
  $lid = "test";
  return $lid;
}

//管理者表示
function mg(){
  $nav = "";
  if($_SESSION['kanri_flg'] == 1){
    $nav .= '<a href="list.php" class="right">会員一覧</a>';
    return $nav;
  }else{
    $nav = "";
    return $nav;
  }
}

//管理者表示
function kanri($kanri){
  if($kanri == 1){
    $kanri_flg = "管理者";
    return $kanri_flg;
  }else{
    $kanri_flg = "一般";
    return $kanri_flg;
  }
}

//パスワードのハッシュ化
function pw_hash($u_pw){
  $pw = password_hash($u_pw, PASSWORD_DEFAULT);
  return $pw;
}