<?php
require_once(__DIR__ . '/../app/config.php'); // 名前空間
use MyApp\Utils; // h()

$today = date('Y-m-d H:i;s l');

include('../app/_parts/_header.php');
?>
<p class="date"><?= Utils::h($today); ?></p>
<!-- ナビ ＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝ -->
<?php include('./nav.php'); ?>
<!-- title ＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝ -->
<h1>MyPHP</h1>
<!-- 写真 ＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝ -->
<form>
  <button class="about">
    <img class="about-img" src="img/face<?= rand(1, 3); ?>.jpeg">
  </button>
</form>








<?php
include('../app/_parts/_footer.php');
