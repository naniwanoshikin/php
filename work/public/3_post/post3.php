<?php // progate
require('../../app/functions.php');

$friends = [
  '未選択' => '選択してください',
  'イットーくん' => 'いとうさん',
  'ボーイ' => '立彦さん',
  'なおや' => '今岡さん',
];

include('./_header.php');
?>

<h2>連絡先</h2>
<form action="post3_result.php" method="post">
  <p>お名前：<input type="text" name="name"></p>

  <p>年齢：
    <label><input type="radio" name="age" value="20-29歳">20代</label>
    <label><input type="radio" name="age" value="30-39歳">30代</label>
    <label><input type="radio" name="age" value="40-49歳">40代</label>
  </p>

  <p>請求先：
    <select name="friends">
      <?php foreach ($friends as $name => $friend) : ?>
        <option value='<?= $name ?>'><?= $friend ?></option>
      <?php endforeach; ?>
    </select>
  </p>

  <p>要望：</p>
  <textarea name="content" cols="40" rows="10"></textarea>

  <p>
    <input type="submit" value="送信">
  </p>
</form>

<form action="">
  <p>
    <input type="submit" value="submit">入力内容を送信
  </p>
  <p>
    <input type="reset" value="reset">入力内容をリセット
  </p>
  <p>
    <input type="button" value="button">何もしない汎用的な押しボタン
  </p>
</form>