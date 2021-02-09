<?php
ini_set('display_errors', true);
require('join/functions.php');
require('dbc.php');

if (empty($_REQUEST['id'])) { // URLパラメータが空だったら
  header('Location: index.php');
  exit();
}
// メッセージを１件取得
$sql = 'SELECT m.name, m.picture, p.* FROM members m, posts p
  WHERE m.id= p.member_id AND p.id=?';
$posts = connect()->prepare($sql);
$posts->execute(array(
  $_REQUEST['id'], //
));
?>


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ひとこと掲示板</title>
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <div id="wrap">
    <div id="head">
      <h1>ひとこと掲示板</h1>
    </div>
    <div id="content">
      <p>&laquo;<a href="index.php">一覧にもどる</a></p>

      <?php if ($post =  $posts->fetch()) : ?>
        <div class="msg">
          <img src="picture/<?= h($post['picture']); ?>" />
          <p><?= h($post['message']); ?>
            <span class="name">（<?= h($post['name']); ?>）</span>
          </p>
          <p class="day"><?= h($post['created']); ?></p>
        </div>
      <?php else : ?>
        <p>その投稿は削除されたか、URLが間違えています</p>
      <?php endif;  ?>
    </div>
  </div>
</body>

</html>