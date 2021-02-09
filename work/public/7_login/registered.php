<?php
session_start(); // CSRF対策
require_once('./functions.php'); // CSRF対策
require_once('./User.php'); // ユーザ情報登録

validateToken(); // CSRF対策
unset($_SESSION['token']); // このページに、直接アクセス＋２重送信防止（リロード（２回入る）するとsessionは消える）

// エラーメッセージ
$error = [];
if (!$username = filter_input(INPUT_POST, 'username')) {
  $error[] = 'ユーザー名を入力してください';
}
if (!$mail = filter_input(INPUT_POST, 'mail')) {
  $error[] = 'アドレスを入力してください';
}
$pass = filter_input(INPUT_POST, 'pass');
if (!preg_match("/\A[a-z\d]{8,100}+\z/i", $pass)) {
  $error[] = 'パスワードは英数字で8~100字にしてください';
}
$pass_conf = filter_input(INPUT_POST, 'pass_conf');
if (!$pass_conf) {
  $error[] = 'パスワード確認を入力してください';
}
if ($pass_conf && $pass !== $pass_conf) {
  $error[] = '確認用パスワードと異なっています';
}
if (count($error) ===  0) { // エラーなければ、
  if (!UserLogic::createUser($_POST)) {
    $error[] = '登録に失敗しました';
  }
}

include('./_header.php');
?>

<p style="text-align: center">
  <a class="backbtn" href="./index.php">戻る</a>
</p>

<h2>登録完了</h2>

<?php if (count($error) != 0) : ?>
  <?php foreach ($error as $e) : ?>
    <p class="err"><?= $e ?></p>
  <?php endforeach ?>
<?php else : ?>
  <p>ユーザー登録が完了しました</p>
<?php endif ?>


</body>

</html>