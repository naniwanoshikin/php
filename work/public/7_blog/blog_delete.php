<?php
require_once('Blog.php');
$blog = new Blog();
$result = $blog->blogDelete($_GET['id']);
?>

<p><a href="index.php">戻る</a></p>