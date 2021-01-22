<?php
session_start();

//SESSIONの初期化
$_SESSION = array();

//Cookieに保存してある"SessionIDの保存期間を過去にして破棄
if(isset($_COOKIE[session_name()])) { //session_name()は、セッションID名を返す関数
  setcookie(session_name(), '', time()-42000, '/');
}

//サーバ側でのセッションIDの破棄
session_destroy();

//処理後、login.phpへリダイレクト
header("Location: login.php");
exit();