<?php
session_start();
require('../../app/functions.php');

$ages = [ // 年齢
  '20-29歳' => '20代',
  '30-39歳' => '30代',
  '40-49歳' => '40代',
];
$friends = [ // 宛先
  'yo@ito.com' => 'いとうさん',
  'tatsu@boy.com' => '立彦さん',
  'ima@nao.com' => '今岡さん',
];
// 連絡フォーム
// エラーチェック
$error = [
  'name' => '',
  'mail' => '',
  'friends' => '',
  'age' => '',
  'content' => '',
  'policy' => '',
];
// ここにフォームの値が入る
$post = [
  'name' => '',
  'mail' => '',
  'friends' => '',
  'age' => '',
  'content' => '',
];


// issetとemptyの違い
// name属性に配列を指定していない（文字列）なら必ずisset。値が設定されている時。（ラジオボタン）
// name属性に配列を指定している（配列）ならissetの方が良い。（チェックボックス）
// 悩んだエラー
// Notice: Undefined index: name
// $error = []; // エラー
// $error['name'] = ''; // 正解

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // 文字列のフィルタリング
  $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
  if (trim($post['name']) === '') { // 名前が空なら
    $error['name'] = 'blank';
  }
  if ($post['mail'] === '') { // mailが空なら
    $error['mail'] = 'blank';
  } else if (!filter_var($post['mail'], FILTER_VALIDATE_EMAIL)) { // 書式ミスなら
    $error['mail'] = 'email';
  }
  if ($post['friends'] === '') { // 宛先が空なら
    $error['friends'] = 'blank';
  }
  if (!isset($post['age'])) { // 年齢が空配列なら
    $error['age'] = 'blank';
  }
  if (mb_strlen(trim($post['content'])) > 30) { // テキスト:
    $error['content'] = 'blank';
  }
  if (empty($post['policy'])) { // ポリシー:
    $error['policy'] = 'blank';
  }
  if (count($error) === 0) { // エラーの数
    $_SESSION['form'] = $post; // postの内容をformに入れ保管
    header('Location: confirm.php');
    exit();
  }
} else {
  if (isset($_SESSION['form'])) { // GET（session変数が存在したら、）
    $post = $_SESSION['form']; // session変数を渡してあげる
  }
}


include('_header.php');
?>

<section class="contact">
  <h2>連絡先</h2>
  <!-- サーバー作成時はnovalidateしておく-->
  <form action="" method="POST" novalidate>
    <p>各項目を入力してください
      <?php if (count($error) >= 1) : ?>
        （※残り<span class="error"><?= count($error); ?></span>つ）
      <?php endif; ?>
    </p>
    <div class="personal">
      <!-- ＝＝＝＝＝＝＝お名前=＝＝＝＝＝＝＝ -->
      <div class="a-form">
        <p class="tag"><span class="mand">必須</span>お名前</p>
        <input type="text" name="name" class="textline" placeholder="大阪太郎" value="<?= h($post['name']); ?>" required autofocus>
        <?php if ($error['name'] === 'blank') : ?>
          <p class="error">※お名前をご記入ください</p>
        <?php endif; ?>
      </div>
      <!-- ＝＝＝＝＝＝Email=＝＝＝＝＝＝＝ -->
      <div class="a-form">
        <p class="tag"><span class="mand">必須</span>Email</p>
        <input type="text" name="mail" class="textline" placeholder="osaka@taro.com" value="<?= h($post['mail']); ?>" required autofocus>
        <?php if ($error['mail'] === 'blank') : ?>
          <p class="error">※アドレスをご記入ください</p>
        <?php endif; ?>
        <?php if ($error['mail'] === 'email') : ?>
          <p class="error">※正しくご記入ください</p>
        <?php endif; ?>
      </div>
      <!-- ＝＝＝＝＝宛先＝＝＝＝＝＝＝＝ -->
      <div class="a-form">
        <p class="tag"><span class="mand">必須</span>あて先</p>
        <select name="friends" class="textline">
          <option value="" selected>−</option>
          <?php foreach ($friends as $adana => $name) : ?>
            <option value=<?= $adana; ?> <?= $post['friends'] === $adana ? 'selected' : ''; ?>>
              <?= $name; ?></option>
          <?php endforeach; ?>
        </select>
        <?php if ($error['friends'] === 'blank') : ?>
          <p class="error">※あて先を選択ください</p>
        <?php endif; ?>
      </div>
      <!-- ＝＝＝＝＝＝年齢＝＝＝＝＝＝＝＝ -->
      <div class="a-form">
        <p class="tag"><span class="mand">必須</span>年齢</p>
        <?php foreach ($ages as $aged => $age) : ?>
          <label>
            <input type="radio" name="age" value=<?= $aged; ?> <?= $post['age'] === $aged ? 'checked' : ''; ?>>
            <?= $age; ?>
          </label>
        <?php endforeach; ?>
        <?php if ($error['age'] === 'blank') : ?>
          <p class="error">※年齢を選択ください</p>
        <?php endif; ?>
      </div>
      <!-- ＝＝＝＝＝＝内容＝＝＝＝＝＝ -->
      <div class="a-form">
        <p class="tag"><span class="mand any">任意</span>お問い合わせ内容</p>
        <textarea name="content" placeholder="30字以内" cols="" rows="6" class="textline">
          <?= h($post['content']); ?>
        </textarea>
        <?php if ($error['content'] === 'blank') : ?>
          <p class="error">※文字数オーバーです</p>
        <?php endif; ?>
      </div>
      <!-- ＝＝＝＝＝＝ポリシー＝＝＝＝＝＝ -->
      <div class="policy">
        <input type="checkbox" name="policy" id="c1" <?= !empty($post['policy']) ? 'checked' : ''; ?>>
        <label for="c1" class="done">
          「<a href="policy.php">プライバシーポリシー</a>」に同意する
        </label>
        <?php if ($error['policy'] === 'blank') : ?>
          <p class="error">※チェックが入っていません
          </p>
        <?php endif; ?>
      </div>
      <!-- ＝＝＝＝＝＝送信＝＝＝＝＝＝ -->
      <p><input type="submit" value="確認する"></p>
    </div>
  </form>

</section>

<?= var_dump(count($error)); ?>
<?= var_dump($error['policy']) ?>