<?php // 福くん 入門編
require('../../app/functions.php');


include('./_header.php');
?>

<h2>ブログ</h2>
<form action="post2_result.php" method="POST">

  <p>タイトル：<input type="text" name="title"></p>

  <p>投稿日：<input type="date" name="post_at"></p>

  <p>カテゴリ：
    <select name="category">
      <option value="日常">日常</option>
      <option value="プログラミング">プログラミング</option>
    </select>
  </p>

  <p>公開状態：
    <label><input type="radio" name="publish_status" value="publish" checked>公開</label>
    <label><input type="radio" name="publish_status" value="un_publish">非公開</label>
  </p>

  <p>本文：</p>
  <textarea name="content" cols="30" rows="10"></textarea>

  <p>
    <input type="submit" value="POST">
  </p>
</form>

<?php
// include('../../app/_parts/_footer.php');
