<?php
// Cookie用
// GETで渡ってきた値（色を選択した初回のみ）取得。
// なければブラウザに保存されたCOOKIEの値。
// なければtransparent（背景色の規定値：ソースのエラー解除）
$color = $colorFromGet ?? filter_input(INPUT_COOKIE, 'color') ?? 'transparent';

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <title>Get, Post</title>
  <!-- 引き継ぎ -->
  <link rel="stylesheet" href="../css/styles.css">
  <!-- 独自 -->
  <link rel="stylesheet" href="css/styles.css">
</head>

<!-- GETで使用 背景色 -->
<body style="background-color: <?= h($color); ?>;">

<p style="text-align: center">
  <a class="backbtn" href="../index.php">ホーム</a>
</p>
