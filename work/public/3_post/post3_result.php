<?php
require('../../app/functions.php');

$name = trim(filter_input(INPUT_POST, 'name'));
$name = $name !== '' ? $name : '名前がわかりません';
$content = trim(filter_input(INPUT_POST, 'content'));
$content = $content !== '' ? $content : '要望なし';
$age = filter_input(INPUT_POST, 'age') ?? '年齢がわかりません';

include('./_header.php');
?>

<p style="text-align:center">
    <a class="backbtn" href="post3.php">戻る</a>
  </p>

<div class="">
  <h2>
    <span class="faa-parent animated-hover"><i class="fas fa-envelope fa-sm faa-ring"></i></span>注文内容
  </h2>
  <div class="sent">
    <div class="sent2">
      <h3>連絡先</h3>
      <ul>
        <li>
          <span class="">□ お名前：</span>
          <span class=""><?= $name; ?></span>
        </li>
        <li>
          <span class="">□ 年齢：</span>
          <span class=""><?= $age; ?></span>
        </li>
        <li>
          <span class="">□ 請求先：</span>
          <span class=""><?= $_POST['friends']; ?></span>
        </li>
        <li>
          <span class="">□ 内容：</span>
          <p class=""><?= nl2br($content); ?></p>
        </li>
      </ul>
    </div>
  </div>
</div>
