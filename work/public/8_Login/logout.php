<?php
ini_set('display_errors', true);
require('join/functions.php');


// ログアウトとは：セッションの情報を削除する
$_SESSION = array();

if (ini_set('session.use_cookies')) {
  $params = session_get_cookie_params();
  setcookie(session_name() . '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']); // 有効期限を切る
}

session_destroy();
setcookie('email', '', time()-3600);

header('Location: login.php');
exit();
