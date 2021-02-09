<?php // 送られてきた注文確認画面
require_once('data.php'); // $menus

$totalPayment = 0; // 合計（初期値）

include('_header.php');
?>

<div class="order-wrapper">
  <h2>注文内容確認
    <span class="faa-parent animated-hover"><i class="fas fa-envelope fa-sm faa-ring"></i></span>
  </h2>
  <?php foreach ($menus as $menu) : ?>
    <?php
    $orderCount = $_POST[$menu->getName()]; // 注文数 name属性
    $menu->setOrderCount($orderCount); // 入力した注文数を反映する
    $totalPayment += $menu->getTotalPrice(); // 合計
    ?>
    <p class="order-amount"><?= $menu->getName() ?> x <?= $orderCount ?> 個</p>
    <p class="order-price"><?= $menu->getTotalPrice() ?>円</p>
  <?php endforeach ?>
  <h3>合計金額: <?= $totalPayment ?>円</h3>
</div>

<a class="backbtn" href="index.php">戻る</a>
<a class="backbtn" href="sent.php">確定</a>

<?php
include('../../app/_parts/_footer.php');
