<?php
// session用
$color = $_SESSION['color'] ?? 'transparent';

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <title>Get_Session</title>
  <link rel="stylesheet" href="../css/styles.css">
  <link rel="stylesheet" href="css/styles.css">
</head>

<body style="background-color: <?= h($color); ?>;">

<p style="text-align: center">
  <a class="backbtn" href="../index.php">ホーム</a>
</p>
