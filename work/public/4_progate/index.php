<?php
require_once('class/menu.php'); // Menuクラス
require_once('data.php'); // $menus, Drinkクラス

include('_header.php');
?>

<p style="text-align: center">
  <a class="backbtn" href="../index.php">戻る</a>
</p>

<div class="menu-wrapper container">
  <h1 class="logo">Café Progate
    <span class="faa-parent animated-hover">
      <i class="fas fa-utensils fa-lg faa-shake"></i>
    </span>
  </h1>
  <h3>メニュー<?= Menu::getCount() ?>品</h3>
  <form action="confirm.php" method="post">
    <div class="menu-items order">
      <?php foreach ($menus as $menu) : ?>
        <div class="menu-item">
          <!-- 写真 -->
          <img src="img/<?= $menu->getImage() ?>" class="menu-item-image">
          <!-- 商品名 -->
          <h3 class="menu-item-name">
            <!-- クエリ文字列 URL送信 -->
            <a href="show.php?name=<?= $menu->getName() ?>">
              <?= $menu->getName() ?>
            </a>
          </h3>
          <!-- そのクラスならば、アイス or ホット -->
          <!-- それ以外は、辛さ度合い -->
          <?php if ($menu instanceof Drink) : ?>
            <p class="menu-item-type"><?= $menu->getType() ?></p>
          <?php else : ?>
            <?php for ($i = 0; $i < $menu->getSpiciness(); $i++) : ?>
              <i class="fas fa-wine-glass-alt"></i>
            <?php endfor ?>
          <?php endif ?>
          <!-- 料金 -->
          <p class="price">¥<?= $menu->getTaxIncludedPrice() ?>（税込）</p>
          <!-- 個数入力 -->
          <input type="text" value="0" name="<?= $menu->getName() ?>"><span>個</span>
        </div>
      <?php endforeach ?>
    </div>
    <!-- <div class="orderbtn"> -->
    <input type="submit" value="注文画面へ">
    <!-- </div> -->
  </form>
</div>
</body>

</html>