<div class="c-form">
  <p class="menu-input">
    <input type="text" value="<?= h($_POST[$menu->getName()]); ?>" name="<?= $menu->getName() ?>">
    <span>個</span>
  </p>
  <?php if (trim($_POST[$menu->getName()]) === '') : ?>
    <p class="error">※ご記入ください</p>
  <?php elseif (!is_numeric($_POST[$menu->getName()])) : ?>
    <p class="error">※半角数字でお願いします</p>
  <?php endif ?>
</div>
