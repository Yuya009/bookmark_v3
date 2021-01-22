<?php
include("funcs.php");
//DB接続
$pdo = db_connect();

// POSTデータ取得
$u_name = $_POST['name'];
$u_id = $_POST['lid'];
$u_pw = pw_hash($_POST['lpw']);
$life_flg = 0;
$kanri_flg = 0;



//データベース検索
$db_user = $pdo->query("SELECT * FROM gs_user_table WHERE u_id ='$u_id'");
$result = $db_user->fetch(PDO::FETCH_ASSOC);
// echo $result['u_id'].'<br>';
// var_dump($db_user);
//登録
if($result['u_id'] == ""){ 
  //sql
  $stmt = $pdo->prepare("INSERT INTO gs_user_table(u_id, u_name, u_pw, kanri_flg, life_flg, indate)VALUES(:u_id, :u_name, :u_pw, :kanri_flg, :life_flg, sysdate())");

  //バインド変数を用意
  $stmt->bindValue(':u_name', h($u_name), PDO::PARAM_STR);
  $stmt->bindValue(':u_id', h($u_id), PDO::PARAM_STR);
  $stmt->bindValue(':u_pw', h($u_pw), PDO::PARAM_STR);
  $stmt->bindValue(':kanri_flg', h($kanri_flg), PDO::PARAM_INT);
  $stmt->bindValue(':life_flg', h($life_flg), PDO::PARAM_INT);

  //実行
  $status = $stmt->execute();

  //データ登録処理後
  if($status==false) {
    $error = $stmt->execute();
    exit("ErrorMessage".$error[2]);
  }else{
    header("Location: login.php");
    exit;
  }
}else{
  // header("Location: login.php");
  // exit;
  $view = 'このIDは使われています。別のIDを登録してください';
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <a>【<?= $result['u_id'] ?>】</a></br>
  <a><?= $view ?></a></br>
  <a href="login.php" class="right">会員登録に戻る</a>
</body>
</html>