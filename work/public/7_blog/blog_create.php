<?php
require_once('Blog.php');
$blog = new Blog();
$blogs = $_POST;
$blog->blogValidate($blogs); // バリデーション表示
$blog->blogCreate($blogs);
?>

<p><a href="index.php">戻る</a></p>