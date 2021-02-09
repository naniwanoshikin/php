<?php // 福 入門編
require('../../app/functions.php'); // エスケープ

// nameの値を受け取る
$blog = $_POST;

if ($blog['publish_status'] === 'un_publish') {
  echo '記事がありません';
  return;
}

include('./_header.php');
?>

<div class="">
  <p style="text-align:center">
    <a class="backbtn" href="post2.php">戻る</a>
  </p>
  <h2><?= h($blog['title']); ?></h2>
  <p>投稿日：<?= h($blog['post_at']); ?></p>
  <p>カテゴリ：<?= h($blog['category']); ?></p>
  <hr>
  <p>内容：</p>
  <p><?= nl2br(h($blog['content'])); ?></p>
</div>

<?php
// include('../../app/_parts/_footer.php');
