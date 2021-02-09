<?php // Menu詳細ページ
require_once('class/menu.php'); // findByNameメソッド
require_once('data.php'); // $menus, $reviewsインスタンス

// クリックしたメニュー名
$menuName = $_GET['name']; // クエリ情報の値（キー）を配列として受け取る
// そのMenuインスタンス
$menu = Menu::findByName($menus, $menuName);
// 該当するReviwインスタンス
$menuReviews = $menu->getReviews($reviews);

include('_header.php');
?>

  <div class="review-wrapper">
    <!-- メニュー -->
    <div class="review-menu-item">
      <!-- 写真 -->
      <img src="img/<?= $menu->getImage() ?>" class="menu-item-image">
      <!-- 品名 -->
      <h3 class="menu-item-name"><?= $menu->getName() ?></h3>
      <!-- 状態 -->
      <?php if ($menu instanceof Drink) : ?>
        <p class="menu-item-type"><?= $menu->getType() ?></p>
      <?php else : ?>
        <?php for ($i = 0; $i < $menu->getSpiciness(); $i++) : ?>
          <i class="fas fa-wine-glass-alt"></i>
        <?php endfor ?>
      <?php endif ?>
      <!-- 値段 -->
      <p class="price">¥<?= $menu->getTaxIncludedPrice() ?></p>
    </div>
    <!-- Review -->
    <div class="review-list-wrapper">
      <div class="review-list">
        <div class="review-list-title">
          ◉<h4>レビュー一覧</h4>
        </div>
        <?php foreach ($menuReviews as $review) : ?>
          <!-- Reviwインスタンスのユーザ名に該当するUserインスタンス -->
          <?php
          $user = $review->getUser($users)
          ?>
          <div class="review-list-item">
            <div class="review-user">
              <!-- 性別 -->
              <?php if ($user->getGender() == "male") : ?>
                <img src="https://s3-ap-northeast-1.amazonaws.com/progate/shared/images/lesson/php/male.png" class='icon-user'>
              <?php else : ?>
                <img src="https://s3-ap-northeast-1.amazonaws.com/progate/shared/images/lesson/php/female.png" class='icon-user'>
              <?php endif ?>
              <!-- ユーザ名 -->
              <p><?= $user->getId() ?></p>
              <p><?= $user->getName() ?></p>
            </div>
            <p class="review-text"><?= $review->getBody() ?></p>
          </div>
        <?php endforeach ?>
      </div>
    </div>

    <a href="index.php">← メニュー一覧へ</a>
  </div>
</body>

</html>