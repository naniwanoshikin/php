<?php
require_once('./dbc.php'); // DBデータ取得
$upData = getAllFile(); // DB取得オブジェクト

$error = $_SESSION; // 受け取ったエラー配列
$_SESSION = []; // 初回にエラー出さないようにした。
// var_dump($error);

include('./_header.php');
?>

<!-- ファイル含めて複数を送る場合 -->
<!-- 画像はenctype -->
<form enctype="multipart/form-data" action="./upload.php" method="POST">
  <!-- ファイル -->
  <div class="file-up">
    <!-- 最大サイズ指定 10000000 = 10MB  エラーが出る場合、php.iniのmax_sizeを調べる-->
    <input type="hidden" name="MAX_FILE_SIZE" value="6000000" />
    <!-- アップできるのは画像のみ -->
    <input type="file" name="img" accept="image/*" />

    <!-- エラーメッセージ（ファイルサイズ、拡張子、未選択） -->
    <?php if (isset($error['size'])) : ?>
      <p class="error-msg"><?= $error['size']; ?></p>
    <?php endif; ?>
    <?php if (isset($error['ext'])) : ?>
      <p class="error-msg"><?= $error['ext']; ?></p>
    <?php endif; ?>
    <?php if (isset($error['up'])) : ?>
      <p class="error-msg"><?= $error['up']; ?></p>
    <?php endif; ?>
  </div>

  <div>
    <label for="caption">キャプション</label>
    <textarea name="caption" id="caption" placeholder="（140文字以下）" value="<?= $caption['caption'] ?>"></textarea>
    <!-- エラーメッセージ -->
    <?php if (isset($error['content'])) : ?>
      <p class="error-msg"><?= $error['content']; ?></p>
    <?php endif; ?>
    <?php if (isset($error['strlen'])) : ?>
      <p class="error-msg"><?= $error['strlen']; ?></p>
    <?php endif; ?>

  </div>
  <div class="submit">
    <input type="submit" value="投稿" class="btn" />
  </div>
</form>

<div class="upfile">
  <!-- DBデータ表示（カラム） -->
  <?php foreach ($upData as $e) : ?>
    <img width=200 src="<?= $e['file_path'] ?>" alt="">
    <p><?= h($e['content']); ?></p>
  <?php endforeach; ?>
</div>

</body>

</html>