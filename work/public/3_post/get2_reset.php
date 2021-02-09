<?php
// session
require('./get2_function.php');

// sessionを削除（但し、ブラウザとサーバーの紐付るcookieは削除されていない）
unset($_SESSION['color']);

header('Location: http://' . $_SERVER['HTTP_HOST'] . '/3_post/get.php');
