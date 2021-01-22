<?php
//Login処理
session_start();
include("funcs.php");
loginCheck();

// DB接続
$pdo = db_connect();

// ログイン者判別
$u_name = $_SESSION["u_name"];

//データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table");
$status = $stmt->execute();

//３．データ表示
$view = "";
if ($status == false) {
  sql_error($stmt);
} else {
  while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $view .= '<p class = "detail">';
    $view .= '<a href="detail.php?u_id=' . $r["u_id"] . '">';
    $view .= $r["u_id"] . " " . $r["u_name"] . " " . kanri($r['kanri_flg']);
    $view .= '</a>';
    $view .= "　";
    $view .= '<a class="btn" href="delete_user.php?u_id='.$r["u_id"].'">削除</a>';
    $view .= '</a>';
    $view .= '</p>';
  }
}

//管理者の場合
$nav = mg();

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/reset.css">
  <link rel="stylesheet" href="./css/style.css">
  <title>Document</title>
</head>
<body>
<div class="right">
  <a href="index.php" class="right">検索ページ</a>
  <a href="select.php" class="right"><?= $u_name ?>さんのブックマーク一覧</a>
  <?= $nav ?>
  <a href="logout.php" class="right">ログアウト</a>
</div>
<?= $view ?>
</body>
</html>