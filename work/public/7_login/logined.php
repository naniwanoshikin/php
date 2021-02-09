<?php
session_start(); // バリデーション用 + login()情報
require_once('./User.php'); // クラスメソッド用

// ユーザ情報
$mail = filter_input(INPUT_POST, 'mail');
$pass = filter_input(INPUT_POST, 'pass');

// ログインしようとした時のエラーメッセージ
$error = [];
if (!$mail) {
  $error['mail'] = 'アドレスを入力してください';
}
if (!$pass) {
  $error['pass'] = 'パスワードを入力してください';
}
if (count($error) > 0) { // エラーがあれば
  $_SESSION = $error; // SESSIONにエラーメッセージを入れる
  header('Location: login.php');
  return;
}
if (!UserLogic::login($mail, $pass)) { // ログイン失敗したら、
  header('Location: login.php');
  return;
}

include('./_header.php');
?>

<h2>ログイン完了</h2>
<p>ログインしました！</p>

<p><a href="./index.php">マイページへ</a></p>

</body>

</html>