<?php // ログイン画面

ini_set('display_errors', true);
require('join/functions.php');
require('dbc.php'); // DB接続

// 自動読み込み（クッキー）
if ($_COOKIE['email']) {
  $email = $_COOKIE['email'];
}

if (!empty($_POST)) { // 入力されているならば（ログインボタン押された時）
  $email = $_POST['email']; // 入力欄のCOOKIEの値を上書きできる

  if ($_POST['email'] !== '' && $_POST['password'] !== '') {
    $sql = 'SELECT * FROM members WHERE email=? AND password=?';
    $login = connect()->prepare($sql);
    $login->execute(array(
      $_POST['email'],
      sha1($_POST['password'])
    ));
    $record = $login->fetch(); // データを返す

    if ($record) { // ログイン成功（emailとpass共に一致）
      // パスワードはSESSIONには入れないように
      $_SESSION['id'] = $record['id'];
      // sessionに記録された時間（次回からログインCOOKIE用）
      $_SESSION['time'] = time();
      // COOKIEにアドレスが14日保管される
      if ($_POST['save'] === 'on') {
        setcookie('email', $_POST['email'], time() + 60 * 60 * 24 * 14);
      }
      header('Location: index.php');
      exit();
    } else { // ログイン失敗
      $error['login'] = 'failed';
    }
  } else { // 空入力
    $error['login'] = 'blank';
  }
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <!-- <link rel="stylesheet" type="text/css" href="style.css" /> -->
  <title>ログインする</title>
</head>

<body>
  <div id="wrap">
    <div id="head">
      <h1>ログインする</h1>
    </div>
    <div id="content">
      <div id="lead">
        <p>メールアドレスとパスワードを記入してログインしてください。</p>
        <p>入会手続きがまだの方はこちらからどうぞ。</p>
        <p>&raquo;<a href="join/">入会手続きをする</a></p>
      </div>

      <form action="" method="post">
        <dl>
          <dt>メールアドレス</dt>
          <dd>
            <input type="text" name="email" size="35" maxlength="255" value="<?= h($email); ?>" />
            <?php if ($error['login'] === 'blank') : ?>
              <p class="error">emailとpasswordを入力してください</p>
            <?php endif; ?>
            <?php if ($error['login'] === 'failed') : ?>
              <p class="error">ログイン失敗しました</p>
            <?php endif; ?>
          </dd>
          <dt>パスワード</dt>
          <dd>
            <input type="password" name="password" size="35" maxlength="255" value="<?= h($_POST['password']); ?>" />
          </dd>
          <dt>ログイン情報の記録</dt>
          <dd>
            <!-- COOKIEを使っていく -->
            <input id="save" type="checkbox" name="save" value="on">
            <label for="save">次回からは自動的にログインする</label>
          </dd>
        </dl>
        <div>
          <input type="submit" value="ログインする" />
        </div>
      </form>
    </div>

    <div id="foot">
      <p><img src="images/txt_copyright.png" width="136" height="15" alt="(C) H2O Space. MYCOM" /></p>
    </div>
  </div>
</body>

</html>