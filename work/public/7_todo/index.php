<?php // dotinstall Todoリスト mysql
require_once(__DIR__ . '/../../app/config.php');

// エイリアス
use MyApp\Database;
use MyApp\Utils;
use MyApp\Todo;

$pdo = Database::getInstance();

$todo = new Todo($pdo);
$todo->processPost(); // postで送信されたデータを処理
$todos = $todo->getAll(); // DBデータ取得

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <title>My Todos</title>
  <link rel="stylesheet" href="../css/styles.css">
  <link rel="stylesheet" href="css/styles.css">
</head>

<body>
  <p style="text-align: center">
    <a class="backbtn" href="../index.php">ホーム</a>
  </p>

  <main>
    <header>
      <h1>Todos</h1>
      <form action="?action=purge" method="post">
        <span class="purge">Purge</span>
        <!-- crsf対策 -->
        <input type="hidden" name="token" value="<?= Utils::h($_SESSION['token']); ?>">
      </form>
    </header>

    <form action="?action=add" method="post">
      <input type="text" name="title" placeholder="New todo" autocomplete="off">
      <!-- crsf対策 -->
      <input type="hidden" name="token" value="<?= Utils::h($_SESSION['token']); ?>">
    </form>

    <ul>
      <?php foreach ($todos as $todo) : ?>
        <li>
          <!-- checkbox更新の場合もformタグを使う -->
          <form action="?action=toggle" method="post">
            <input type="checkbox" <?= $todo->is_done ? 'checked' : ''; ?> id="label<?= Utils::h($todo->id) ?>">
            <!-- idも一緒に送信 -->
            <input type="hidden" name="id" value="<?= Utils::h($todo->id); ?>">
            <!-- crsf対策 -->
            <input type="hidden" name="token" value="<?= Utils::h($_SESSION['token']); ?>">
          </form>

          <label class="<?= $todo->is_done ? 'done' : ''; ?>" for="label<?= Utils::h($todo->id) ?>">
            <?= Utils::h($todo->title); ?>
          </label>

          <form action="?action=delete" method="post" class="delete-form">
            <span class="delete">x</span>
            <!-- どのtodoを更新するかも合わせて送る→idも一緒に送信 -->
            <input type="hidden" name="id" value="<?= Utils::h($todo->id); ?>">
            <!-- crsf対策 -->
            <input type="hidden" name="token" value="<?= Utils::h($_SESSION['token']); ?>">
          </form>
        </li>
      <?php endforeach; ?>
    </ul>

  </main>

  <!-- form（is_done更新） -->
  <script src="js/main.js"></script>

</body>

</html>