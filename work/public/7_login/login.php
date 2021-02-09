<?php
session_start(); // バリデーション用
require_once('./User.php'); // クラスメソッド用

// ログイン済なら、
if (UserLogic::checkLogin()) {
  header('Location: mypage.php');
  return;
}
// ログイン失敗時
// var_dump($_SESSION);
$error = $_SESSION; // エラーメッセージ（配列）
$_SESSION = array(); // リロードしたら空配列にする（初期化）。
session_destroy(); // sessionファイルを消す。

include('./_header.php');
?>

<h2>ログイン画面</h2>

<p><a href="index.php">新規登録はこちら</a></p>

<!-- ログイン失敗時:login()  -->
<?php if (isset($error['msg'])) : ?>
  <p class="err"><?= $error['msg']; ?></p>
<?php endif; ?>

<form action="logined.php" method="POST">
  <p>
    <label for="mail">Email：</label>
    <input type="email" name="mail" id="mail">
    <!-- バリデーション -->
    <?php if (isset($error['mail'])) : ?>
  <p class="err"><?= $error['mail']; ?></p>
<?php endif; ?>
</p>

<p>
  <label for="pass">Password：</label>
  <input type="password" name="pass" id="pass">
  <!-- バリデーション -->
  <?php if (isset($error['pass'])) : ?>
<p class="err"><?= $error['pass']; ?></p>
<?php endif; ?>
</p>

<p>
  <input type="submit" value="ログイン">
</p>

</form>

</body>

</html>