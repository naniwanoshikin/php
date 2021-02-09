<?php
require_once('Blog.php'); // Blogデータ、category()

$blog = new Blog();
$result = $blog->getById($_GET['id']); // Blogから各idデータ取得

include('./_header.php');
?>

<p style="text-align: center">
  <a class="backbtn" href="index.php">戻る</a>
</p>

<h2>ブログ詳細</h2>
<h3>タイトル：<?= $result['title']; ?></h3>
<p>投稿日：<?= $result['created_at']; ?></p>
<p>カテゴリ：<?= $blog->setCategoryName($result['category']); ?></p>
<hr>
<p>本文：<?= nl2br($result['content']); ?></p>

</body>

</html>