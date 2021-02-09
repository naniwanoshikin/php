<?php
ini_set('display_errors', true);
require('join/functions.php');
require('dbc.php'); // DB接続


// まず削除するメッセージの候補を取得する
if (isset($_SESSION['id'])) {
  $id = $_REQUEST['id']; // URLパラメータ

  $sql = 'SELECT * FROM posts WHERE id=?';
  $messages = connect()->prepare($sql);
  $messages->execute(array( // ロード
    $id,
  ));
  $message = $messages->fetch(); // データ取得

  // DBから取得したidとセッションのidが同じ場合に削除できる
  if($message['member_id'] == $_SESSION['id']) {

    $sql = 'DELETE FROM posts WHERE id=?';
    $del = connect()->prepare($sql);
    $del->execute(array(
      $id,
    ));
  }
  header('Location: index.php');
  exit();
}

