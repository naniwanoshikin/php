<?php
require_once('Blog.php');
$blog = new Blog();
$result = $blog->getById($_GET['id']); // データベースから記事を取得

$id = $result['id']; // hidden用にidを指定
$title = $result['title'];
$content = $result['content'];
$category = (int)$result['category']; // 文字列から数値型にする
$status = (int)$result['status'];

include('./_header.php');
?>

<p style="text-align: center">
  <a class="backbtn" href="index.php">戻る</a>
</p>

<h2>ブログ編集</h2>
<form action="blog_update.php" method="POST">
  <input type="hidden" name="id" value="<?= $id ?>">
  <p>ブログタイトル：</p>
  <input type="text" name="title" value="<?= $title ?>">
  <p>ブログ本文</p>
  <textarea name="content" id="content" cols="30" rows="10"><?= $content ?></textarea>

  <p>カテゴリ：</p>
  <select name="category">
    <option value="1" <?php if ($category === 1) echo "selected" ?>>日常</option>
    <option value="2" <?php if ($category === 2) echo "selected" ?>>プログラミング</option>
  </select>
  <br>
  <input type="radio" name="status" value="1" <?php if ($status === 1) echo "checked" ?>>公開
  <input type="radio" name="status" value="2" <?php if ($status === 2) echo "checked" ?>>非公開
  <br>
  <input type="submit" value="送信">
</form>

</body>

</html>