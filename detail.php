<?php
session_start();
//１．関数群の読み込み
require_once("funcs.php");
loginCheck();

$u_id = $_GET["u_id"]; //?id~**を受け取る
$pdo = db_connect();
$u_name = $_SESSION["u_name"];
//２．データ検索SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE u_id=:u_id");
$stmt->bindValue(":u_id", $u_id, PDO::PARAM_STR);
$status = $stmt->execute();

//３．データ表示
if ($status == false) {
    sql_error($stmt);
} else {
    $row = $stmt->fetch();
}
//管理者の場合
$nav = mg();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>会員データ編集</title>
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>

    <!-- Head[Start] -->
    <div class="right">
      <a href="index.php" class="right">検索ページ</a>
      <a href="select.php" class="right"><?= $u_name ?>さんのブックマーク一覧</a>
      <?= $nav ?>
      <a href="logout.php" class="right">ログアウト</a>
    </div>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <form method="POST" action="update.php">
      <div class="detail_all">
        <p>ID：<?= $u_id ?></p></br>
        <p>名前：<input class="detail_input" type="text" name="u_name" value="<?= $row["u_name"] ?>"></p><br>
        <p>会員ランク：<br>
          <input class="chk" type="radio" name="kanri_flg" value=1>管理者</br>
          <input class="chk" type="radio" name="kanri_flg" value=0 checked>一般</br>
        </p>
        <input class="submit_detail" type="submit" value="登録する">
        <input type="hidden" name="u_id" value="<?= $u_id ?>">
      </div>
    </form>
    <!-- Main[End] -->
</body>
