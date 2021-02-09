<?php
require_once('Blog.php');
$blog = new Blog();
$blogs = $_POST;
$blog->blogValidate($blogs);
$blog->blogUpdate($blogs);
?>

<p><a href="index.php">戻る</a></p>