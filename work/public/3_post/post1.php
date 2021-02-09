<?php
require('../../app/functions.php');

session_start();
createToken(); // トークンをsessionに保存

define('FILENAME', './messages.txt');

// ２重投稿されないようにしたい
// →データを処理するファイル（if文内）と結果を表示するファイル（result_post.php）を分ける
// →自身にformを送信

// 送信先urlに行くのはPOSTされた時のみ。
if ($_SERVER['REQUEST_METHOD'] === "POST") {
  validateToken(); // 送られてきたトークンチェック
  // 送信されたデータを受け取ってファイルを登録
  $message = trim(filter_input(INPUT_POST, 'message')); // 送られてきたtext文
  $message = $message !== '' ? $message : '...です';

  // ファイル書き込み
  $fp = fopen(FILENAME, 'a'); // 追記モード
  fwrite($fp, $message . "\n"); // + 改行˝
  fclose($fp);
  // 'localhost:8562'はサーバー変数で取得
  header('Location: http://' . $_SERVER['HTTP_HOST'] . '/3_post/post1_result.php');
  exit; // 以降の行の処理を実行させない
}

// 表示（配列で取得）
$messages = file(FILENAME, FILE_IGNORE_NEW_LINES); // 改行は無視

include('./_header.php');
?>

<div class="hoge">
  <h3>POST session</h3>

  <form action="" method="post">
    <input type="text" name="message" class="">
    <input type="submit" value="POST">
    <!-- CSRF対策：送信時、一緒にトークンを渡す -->
    <!-- hidden: 入力部品なしにデータを投稿できる：リソースでトークンを確認できる -->
    <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
  </form>

  <!-- txtメッセージ ＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝ -->
  <ul class="todo">
    <?php foreach ($messages as $message) : ?>
      <li>
        <input type="checkbox" id="todo" name=""><?= h($message); ?>
      </li>
    <?php endforeach; ?>
  </ul>
</div>

<?php
include('../../app/_parts/_footer.php');
