<?php
session_start(); // ログイン・ログアウト機能
require_once('./User.php'); // ログイン・ログアウト機能

// 直でアクセスした場合、
if (!$logout = filter_input(INPUT_POST, 'logout')) {
  exit('まずはマイページにアクセスしましょう');
}
// セッションが切れていたら、（デフォルトは有効期限24分）
if (!UserLogic::checkLogin()) {
  exit('セッションが切れましたので再度ログインし直してください');
}
// ログアウト
UserLogic::logout();

include('./_header.php');
?>


<h2>ログアウト完了</h2>
<p>ログアウトしました！</p>
<a href="login.php">ログイン画面へ</a>

</body>

</html>