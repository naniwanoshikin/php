<?php
$n = mt_rand(1, 3);
if ($n === 1) {
  $message = '<script>alert(1);</script>UX見習いです';
} elseif ($n === 2) {
  $message = 'UXちょっとわかります';
} else {
  $message = 'UX難しいです';
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <title><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?>太郎のポートフォリオサイト</title>
  <link rel="icon" href="favicon.ico">
  <meta name="description" content="太郎のポートフォリオサイトです。">
  <link rel="stylesheet" href="css/styles.css">
</head>

<body>
  <header>
    <div class="container">
      <div class="icon">
        <img src="img/taro.png" width="120" height="120" alt="太郎のアイコンです">
      </div>
      <div class="info">
        <h1><?php echo 'hello' . PHP_EOL;
            echo 'hi tagi' . PHP_EOL;
            ?>山田太郎</h1>
        <p><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></p>
        <ul>
          <li>
            <a href="https://dotinstall.com" target="_blank">
              <img src="img/blog.png" width="20" height="20" alt="ブログサイトへのリンク画像です">
            </a>
          </li>
          <li>
            <a href="https://dotinstall.com" target="_blank">
              <img src="img/photos.png" width="20" height="20" alt="写真サイトへのリンク画像です">
            </a>
          </li>
        </ul>
      </div>
    </div>
  </header>