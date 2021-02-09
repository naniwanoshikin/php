<?php
require('../../app/functions.php');

$name = trim(filter_input(INPUT_GET, 'name'));
$name = $name !== '' ? $name : '...';

// select：複数の値を配列として受け取ることができる
$foods = filter_input(INPUT_GET, 'foods', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
$foods = empty($foods) ? 'None Selected' : implode('と', $foods);

// checkbox
$park = filter_input(INPUT_GET, 'park', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
$park = empty($park) ? 'None Checked' : implode(', ', $park);

// radio
// $color = isset($color) ? $color : 'None selected';
// getで渡ってきた値（初回のみ）
$colorFromGet = filter_input(INPUT_GET, 'color') ?? 'transparent';
// colorという名前でブラウザに$colorの値を保存
setcookie('color', $colorFromGet);

// textarea
$message = trim(filter_input(INPUT_GET, 'message'));
$message = $message !== '' ? $message : 'のーこめんと';

include('./_header.php');
?>

<p style="text-align: center">
  <a class="backbtn" href="get.php">戻る</a>
</p>

<!-- URLの値で変わる -->
<!-- 改行をHTML<br>に変換：newLine2br -->
<p><?= nl2br(h($message)); ?> by <?= h($name); ?></p>
<p>食べ物: <?= h($foods); ?></p>
<p>遊具: <?= h($park); ?></p>
<p>背景色：<?= h($colorFromGet); ?></p>