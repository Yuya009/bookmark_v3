<?php
//Login処理
session_start();
include("funcs.php");
loginCheck();
//ログイン者
$u_id = $_SESSION["u_id"];

$books = $_GET['books'];

function getRakutenResult($keyword) {

// ベースとなるリクエストURL
$baseurl = 'https://app.rakuten.co.jp/services/api/BooksBook/Search/20170404';
// リクエストのパラメータ作成
$params = array();
$params['format'] = 'json';
$params['title'] = urlencode_rfc3986($keyword);
$params['booksGenereId'] = '001';
$params['applicationId'] = '----- アプリID -----'; // アプリID
//$params['keyword'] = urlencode_rfc3986($keyword); // 任意のキーワード。※文字コードは UTF-8
//$params['sort'] = urlencode_rfc3986('+itemPrice'); // ソートの方法。※文字コードは UTF-8
// $params['minPrice'] = $min_price; // 最低価格

$canonical_string='';

foreach($params as $k => $v) {
    $canonical_string .= '&' . $k . '=' . $v;
}
// 先頭の'&'を除去
$canonical_string = substr($canonical_string, 1);

// リクエストURLを作成
$url = $baseurl . '?' . $canonical_string;
// $jsonに返ってきたJSONデータを入れる
$json=file_get_contents($url);
// JSONをデコード
$arr = json_decode($json,true);
//$arr = json_decode($json,false);
// echo('<pre>');
// var_dump($arr);
// echo('</pre>');

$items = array();

// これは警告が出る書き方
// foreach($arr as $first_key => $first_val) {
//   foreach($first_val as $second_key => $second_val) {
//     foreach($second_val as $third_kye => $third_val) {
//       $items[] = array(
//         'name' => $third_val['title'],
//         'url' => $third_val['itemUrl'],
//         'img' => $third_val['mediumImageUrl'],
//         'price' => $third_val['itemPrice'],
//         'release' => $third_val['salesDate']
//       );
//     }
//   }
//  }
// return $items;

foreach($arr["Items"] as $first_key => $first_val) {
  foreach($first_val as $second_key => $second_val) {
    $items[] = array(
      'name' => $second_val['title'],
      'url' => $second_val['itemUrl'],
      'img' => $second_val['mediumImageUrl'],
      'price' => $second_val['itemPrice'],
      'release' => $second_val['salesDate']
      );
    }
  }
  return $items;
}
// RFC3986 形式で URL エンコードする関数
function urlencode_rfc3986($str) {
    return str_replace('%7E', '~', rawurlencode($str));
}
//管理者の場合
$nav = mg();
$u_name = $_SESSION["u_name"];
?>

<!DOCTYPE html>
<html lang='ja'>
<head>
<title>楽天商品検索API テスト</title>
<meta charset='utf-8'>
<link rel="stylesheet" href="./css/reset.css">
  <link rel="stylesheet" href="./css/style.css">
</head>
<body>
  <div class="right">
    <a href="index.php" class="right">検索ページ</a>
    <a href="select.php" class="right"><?= $u_name ?>さんのブックマーク一覧</a>
    <?= $nav ?>
    <a href="logout.php" class="right">ログアウト</a>
  </div>
  <h2><?= $books ?>の検索結果</h2>
  <?php
  $rakuten_relust = getRakutenResult($books);
  foreach ($rakuten_relust as $item) :
  ?>
<div style='margin-bottom: 20px; padding: 30px; border: 1px solid #000; overflow:hidden;'>
  <div style='float: left;'><img src='<?= $item['img']; ?>'></div>
  <div style='float: left; padding: 20px;'>
    <div><?= $item['name']; ?></div>
    <div><a href='<?= $item['url']; ?>' target="_blank"><?= $item['url']; ?></a></div>
    <div><?= $item['price']; ?>円</div><div>発売日：<?= $item['release']; ?></div>
    <form method="post" action="post.php">
      <input  class="btn" type="submit" value="お気に入りに追加する">
      <input type="hidden" name="img" value="<?= $item['img']?>">
      <input type="hidden" name="book" value="<?= $item['name']?>">
      <input type="hidden" name="url" value="<?= $item['url']?>">
      <input type="hidden" name="price" value="<?= $item['price']?>">
      <input type="hidden" name="release" value="<?= $item['release']?>">
      <input type="hidden" value="<?= $u_id ?>" name="u_id">
    </form>
  </div>
</div>
<?php
endforeach;
?>
</body>
</html>