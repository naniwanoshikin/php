<?php
// cookieの削除（cookieの有効期限を過去にセット）
setcookie('color', '');

// リダイレクト（基本的にhttpからかく）
header('Location: http://' . $_SERVER['HTTP_HOST'] . '/3_post/get.php');
