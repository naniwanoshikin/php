<?php
// session
require('./get2_function.php');

$name = trim(filter_input(INPUT_GET, 'name'));
$name = $name !== '' ? $name : '...';

$foods = filter_input(INPUT_GET, 'foods', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
$foods = empty($foods) ? 'None Selected' : implode('と', $foods);

$park = filter_input(INPUT_GET, 'park', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
$park = empty($park) ? 'None Checked' : implode(', ', $park);

$colorFromGet = filter_input(INPUT_GET, 'color') ?? 'transparent';

$message = trim(filter_input(INPUT_GET, 'message'));
$message = $message !== '' ? $message : 'のーこめんと';

// sessionに値を保存
$_SESSION['color'] = $colorFromGet; // sessionへデータを連想配列で保存

include('./_header2.php');
?>

<p style="text-align: center">
  <a class="backbtn" href="get.php">戻る</a>
</p>

<p><?= nl2br(h($message)); ?> by <?= h($name); ?></p>
<p>食べ物: <?= h($foods); ?></p>
<p>遊具: <?= h($park); ?></p>
<p>背景色：<?= h($colorFromGet); ?></p>