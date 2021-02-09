<?php
require_once('Blog.php'); // Blogデータ、category()
$blog = new Blog();
$blogData = $blog->getAll();

include('./_header.php');
?>

  <h3>ブログ一覧</h3>
  <p><a href="form.html">新規作成</a></p>
  <table>
    <tr>
      <th>TITLE</th>
      <th>カテゴリ</th>
      <th>投稿日</th>

      <!-- DB取得データ -->
      <?php foreach ($blogData as $c) : ?>
    <tr>
      <td><?= h($c['title']) ?></td>
      <td><?= h($blog->setCategoryName($c['category'])) ?></td>
      <td><?= h($c['created_at']) ?></td>
      <!-- $id = $_GET['id']リクエスト -->
      <td><a href="detail.php?id=<?= $c['id'] ?>">詳細</a></td>
      <td><a href="update.php?id=<?= $c['id'] ?>">編集</a></td>
      <td><a href="blog_delete.php?id=<?= $c['id'] ?>">削除</a></td>
    </tr>
  <?php endforeach; ?>
  </tr>

  </table>
</body>

</html>