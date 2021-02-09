<?php // マイページ。ログインしてなかったらログイン画面になる。
ini_set('display_errors', true);
require('join/functions.php');
require('dbc.php'); // DB接続

// ログイン後、経過1時間以内（何もしないならログアウトされる）
if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
  $_SESSION['time'] = time(); // 時刻を現在に上書き

  $sql = 'SELECT * FROM members WHERE id=?';
  $members = connect()->prepare($sql);
  $members->execute(array(
    $_SESSION['id'],
  ));
  $member = $members->fetch();
} else { // 時間経てば
  header('Location: login.php');
  exit();
}

if (!empty($_POST)) {
  // メッセージ投稿
  if ($_POST['message']) {
    $sql = 'INSERT INTO posts SET member_id =?, message=?, reply_message_id=?, created=NOW()';
    $message = connect()->prepare($sql);
    $message->execute(array(
      $member['id'], // 投稿者id
      $_POST['message'], // 投稿文
      $_POST['reply_post_id'], // どのmessageに返信したか
    ));
    // 更新してDBデータが重複して保管されないようにする為
    header('Location: index.php');
    exit();
  }
}

$page = $_REQUEST['page'];
// 1以上
$page = max($page, 1);
// maxpage 以下
$sql1 = 'SELECT COUNT(*) AS cnt FROM posts';
$counts = connect()->query($sql1); // ?ないからquery
$cnt = $counts->fetch();
$maxpage = ceil($cnt['cnt'] / 5); // 切り上げ
$page = min($page, $maxpage);

$start = ($page - 1) * 5; // 表示数

// 投稿を表示する
// リレーションして取得（ページネーション）
$sql = 'SELECT m.name, m.picture, p.* FROM members m, posts p
WHERE m.id= p.member_id ORDER BY p.created DESC LIMIT ?, 5';
$posts = connect()->prepare($sql); // ?あるからprepare


$posts->bindParam(1, $start, PDO::PARAM_INT);
$posts->execute();


// Reをクリックした時
if (isset($_REQUEST['res'])) {
  // 返信の処理
  $sql = 'SELECT m.name, m.picture, p.* FROM members m, posts p
  WHERE m.id= p.member_id AND p.id=?';
  $response = connect()->prepare($sql);
  $response->execute(array(
    $_REQUEST['res'], // URLパラメータ
  ));
  $table = $response->fetch();
  $message = '@' . $table['name'] . ' ' . $table['message'];
}

?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ひとこと掲示板</title>
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <div id="wrap">
    <div id="head">
      <h1>ひとこと掲示板</h1>
    </div>
    <div id="content">
      <div style="text-align: right"><a href="logout.php">ログアウト</a></div>

      <form action="" method="post">
        <dl>
          <dt><?= h($member['name']); ?>さん、メッセージをどうぞ</dt>
          <dd>
            <textarea name="message" cols="50" rows="5"><?= h($message); ?></textarea>
            <!-- どの返信かをフォームに渡す value="返信後のid" -->
            <input type="hidden" name="reply_post_id" value="<?= h($_REQUEST['res']); ?>" />
          </dd>
        </dl>
        <div>
          <p>
            <input type="submit" value="投稿する" />
          </p>
        </div>
      </form>

      <!-- 投稿内容 -->
      <?php foreach ($posts as $post) : ?>
        <div class="msg">
          <img src="picture/<?= h($post['picture']); ?>" width="48" height="48" alt="<?= h($post['name']); ?>" />
          <p><?= h($post['message']); ?>
            <span class="name">（<?= h($post['name']); ?>）</span>
            [<a href="index.php?res=<?= h($post['id']); ?>">Re</a>]
          </p>
          <p class="day">
            <a href="view.php?id=<?= h($post['id']); ?>"><?= h($post['created']); ?></a>
            <?php if ($post['reply_message_id'] > 0) : ?>
              <a href="view.php?id=<?= h($post['reply_message_id']); ?>">返信元のメッセージ</a>
            <?php endif; ?>
            <!-- ログインしてる人のidのみ -->
            <?php if ($_SESSION['id'] == $post['member_id']) : ?>
              [<a href="delete.php?id=<?= h($post['id']); ?>" style="color: #F33;">削除</a>]
            <?php endif; ?>
          </p>
        </div>
      <?php endforeach; ?>
      <ul class="paging">
        <!-- ページネーション -->
        <?php if ($page > 1) : ?>
          <li><a href="index.php?page=<?= h($page - 1); ?>">前のページへ</a></li>
        <?php else : ?>
          <li>前のページへ</li>
        <?php endif; ?>
        <?php if ($page < $maxpage) : ?>
          <li><a href="index.php?page=<?= h($page + 1); ?>">次のページへ</a></li>
        <?php else : ?>
          <li>次のページへ</li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</body>

</html>