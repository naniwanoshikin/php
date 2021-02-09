<?php
session_start();
require('../../app/functions.php');


// setcookie('color', $colorFromGet);
// $_SESSION['color'] = $colorFromGet; // session_startより受け取る

if (!isset($_SESSION['form'])) { // 他からアクセスした場合戻す
  header('Location: index.php');
  exit();
} else {
  $post = $_SESSION['form']; // 保管していたSESSIONを取り出す
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $to = 'seisyun4kita2@gmail.com';
  $from = $post['mail'];
  $subject = 'お問い合わせが届きました';
  $body = <<< EOT
  名前: {$post['name']}
  アドレス: {$post['mail']}
  内容: {$post['content']}
  EOT;

  exit();

  mb_send_mail($to, $from, $body, "from: {$from}");
  unset($_SESSION['form']);
  header('Location: sent.php');
  exit();
}


include('_header.php');
?>

<div class="contact">
  <h1>
    <span class="faa-parent animated-hover">
      <i class="fas fa-envelope fa-sm faa-ring"></i>
    </span>入力内容のご確認
  </h1>
  <h2>連絡先</h2>
  <p>下記内容でよろしいでしょうか？</p>
  <div class="sent">
    <div class="sent2">
      <ul>
        <li>
          <span class="">□ お名前：</span>
          <span class="output math1"><?= h($post['name']); ?></span>
        </li>
        <li>
          <span class="">□ Email：</span>
          <span class="output math1"><?= h($post['mail']); ?></span>
        </li>
        <li>
          <span class="">□ あて先：</span>
          <span class="output math1"><?= h($post['friends']); ?></span>
        </li>
        <li>
          <span class="">□ 年齢：</span>
          <span class="output math1"><?= h($post['age']); ?></span>
        </li>
        <li>
          <span class="">□ 内容：</span>
          <?php if (trim($post['content'])) : ?>
            <p class="output"><?= nl2br(h($post['content'])); ?></p>
          <?php else : ?>
            <p class="output">要望は特になし</p>
          <?php endif; ?>
        </li>
      </ul>
    </div>
  </div>
  <a class="backbtn" href="index.php">戻る</a>
  <form action="">
    <a class="backbtn" href="sent.php">確定</a>
  </form>
</div>


<?php
include('../../app/_parts/_footer.php');
