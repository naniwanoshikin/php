<?php
session_start(); // CSRF対策 + login()情報
require_once('./functions.php'); // CSRF対策
require('User.php'); // クラスメソッド用

// ログイン済なら
if (UserLogic::checkLogin()) {
  header('Location: mypage.php');
  return;
}
// 直接mypageにアクセスした時、
$login_err = isset($_SESSION['login_err']) ? $_SESSION['login_err'] : null;
unset($_SESSION['login_err']); // １度だけエラーメッセージ表示

include('./_header.php');
?>

<h2>新規登録</h2>

<p><a href="login.php">ログイン画面へ</a></p>

<!-- 直接mypageにアクセスした時のエラー -->
<?php if (isset($login_err)) : ?>
  <p class="err"><?= $login_err; ?></p>
<?php endif; ?>

<form action="registered.php" method="POST">
  <p>
    <label for="username">ユーザー名：</label>
    <input type="text" name="username" id="username">
  </p>
  <p>
    <label for="mail">Email：</label>
    <input type="email" name="mail" id="mail">
  </p>
  <p>
    <label for="pass">Password：</label>
    <input type="password" name="pass" id="pass">
  </p>
  <p>
    <label for="pass_conf">Password 確認：</label>
    <input type="password" name="pass_conf" id="pass_conf">
  </p>
  <!-- CSRF対策：鍵を仕込ませる -->
  <input type="hidden" name="token" value="<?= h(setToken()); ?>">
  <p>
    <input type="submit" value="登録する">
  </p>
</form>

</body>

</html>