<?php
session_start(); // login()情報
require_once('./functions.php'); // h()
require_once('./User.php'); // ログインチェック用

// ログインしていなかったら
if (!UserLogic::checkLogin()) {
  $_SESSION['login_err'] = 'ユーザ登録をしてからログインしてください';
  header('Location: index.php');
  return;
}
// DBユーザー情報（ログイン成功時のもの：login()）
$users = $_SESSION['login_user'];

include('./_header.php');
?>

<h2>マイページ</h2>
<!-- DBユーザー情報 -->
<p>ログインユーザー：<?= h($users['name']) ?></p>
<p>メールアドレス：<?= h($users['email']) ?></p>

<h1>こんにちわ：</h1>

<form action="logout.php" method="POST">
  <input type="submit" name="logout" value="ログアウト">
</form>

</body>

</html>