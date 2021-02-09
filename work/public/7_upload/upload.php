<?php
require_once('./dbc.php'); // DB接続、session


// 画像データ配列の取得
$file = $_FILES['img'];
// var_dump($file);
// 下記５要素
$filename = basename($file['name']); // ディレクトリトラバーザル対策
$tmp_path = $file['tmp_name']; // 一時フォルダに保存されているファイルパス（←？？？）
// $type = $file['type']; // ファイルのMIMEタイプ
$file_err = $file['error']; // エラーコード。0が正常。ファイルサイズを超えた場合「2」になる。
$filesize = $file['size']; // ファイルサイズ


// 保存先（相対パスにするとエラーなくせた）
$upload_dir = './img/';
// 名前変更（先頭に日付を入れる）
$save_filename = date('YmdHis') . $filename;
// 保存パス（./img/2021/02/05）
$save_path = $upload_dir . $save_filename;

// 内容 サニタイズ（セキュリティ）
$caption = filter_input(INPUT_POST, 'caption', FILTER_SANITIZE_SPECIAL_CHARS);


// エラーメッセージ
$error = [];
if ($filesize > 6000000 || $file_err == 2) {
  $error['size'] =  'ファイルサイズは〜MB以内にしてください';
}
$file_ext = pathinfo($filename, PATHINFO_EXTENSION); // 投稿ファイルの拡張子
$allow_ext = ['jpg', 'jpeg', 'png']; // 許容する拡張子
if (!in_array(strtolower($file_ext), $allow_ext)) { // 小文字に直した拡張子が該当しなければ
  $error['ext'] = '画像ファイルを添付してください';
}
if (empty(trim($caption))) {
  $error['content'] = '内容を入力してください';
}
if (strlen($caption) > 140) {
  $error['strlen'] =  '内容は140文字以内で入力してください';
}

// バリデーション
if (count($error) === 0) {
  // アップロードされていたら
  if (is_uploaded_file($tmp_path)) {
    // 画像を移動・保存（移動前のパス、移動先のパス）
    if (move_uploaded_file($tmp_path, $save_path)) {
      echo $filename . 'を' . $upload_dir . 'へアップしました。';
      echo '<br>';
      // DB保存対象（ファイル名、ファイルパス、キャプション）
      $result = fileSave($filename, $save_path, $caption);
      if ($result) {
        echo 'DBに保存できました！！';
        // header('Location:' . SITE_URL);
        // exit;
      } else {
        echo 'DBに保存が失敗しました！！';
      }
    } else {
      echo 'ファイルが保存できませんでした。';
      echo '<br>';
    }
  } else {
    $error['up'] = 'ファイルが選択されていません';
    // echo 'ファイルが選択されていません';
    // echo '<br>';
  }
} else {
  // エラーあれば
  $_SESSION = $error; // SESSION使用
  header('Location:' . SITE_URL);
  exit;

  foreach ($error as $err) {
    echo $err;
    echo '<br>';
  }
}

?>

<p><a href="./index.php">戻る</a></p>