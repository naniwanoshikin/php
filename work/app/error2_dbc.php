<?php

/**
 * DB接続
 *
 * @param なし
 * @return 接続結果を返す $pdo
 */
function dbc()
{
  $host   = DB_HOST;
  $db     = DB_NAME;
  $user   = DB_USER;
  $pass   = DB_PASS;
  try {
    // PHP Database Objects: →DB種類が変わった（mysql→SQLite）としてもここのコードを変える必要はない。
    $pdo = new PDO(
      "mysql:host=$host; dbname=$db; charset=utf8mb4", // DSN
      $user,
      $pass,
      [ // 設定
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // エラーモード例外処理 catchにかく
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // カラム名がついた結果のみ取得。SQLインジェクション対策。配列をkey, valueで返す。
        // PDO::ATTR_DEFAULT_FETCH_MODE =  PDO::FETCH_OBJ, // オブジェクト形式で取得
        // PDO::ATTR_EMULATE_PREPARES =  false, // データ型設定をOFFにする（defaultはon）（SQLで定義した型に合わせて取得できる） preparestmt使う時にかく
      ]
    );
    echo '接続成功';
    return $pdo; // PDOのインスタンスを返す
  } catch (PDOException $e) {
    echo '接続失敗';
    exit($e->getMessage()); // exit:処理終了
  };
}

/**
 *  DBからデータを取得（値を埋め込まないSQL）
 *
 * @param なし
 * @return array $result 取得データ
 */
function getAll()
{
  // ①SQL準備
  $sql = "DROP TABLE IF EXISTS posts"; // 同じpostsがあれば削除
  $sql = "CREATE TABLE posts(id INT NOT NULL AUTO_INCREMENT)"; // 作成
  $sql = "INSERT INTO posts (message, likes) VALUES
  ('Thanks', 12),
  ('Hello', 2),
  ('Good', 15),";
  $sql = "SELECT * FROM img_table";
  $sql = "DELETE FROM posts WHERE likes < 10";
  // ②SQL実行：DBからデータ取得（userから入力はない→query使用。queryはエスケープはしない）
  $stmt = dbc()->query($sql);
  // ③SQL結果を取得
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // 結果を配列で取得（複数ならAllつける）
  var_dump($result);
  foreach ($result as $post) { // わかりやすく出力
    printf(
      '%s (%d)' . PHP_EOL,
      $post['message'],
      $post['likes'],
    );
  }
  return $result;
}

/**
 * DBにデータを保存（挿入）（値を埋め込むSQL）
 *
 * @param string $a ファイル名
 * @param string $b 保存先のパス
 * @param string $c 投稿の説明
 * @return bool $result
 */
function create($a, $b, $c)
{
  try {
    $result = false;
    // SQL文
    $message = 'Merci';
    $likes = 8;
    $id = 8;
    $sql = 'INSERT INTO posts (message, likes) VALUES (:$message, :$likes)';
    $sql = 'INSERT INTO img_table (name, filepath, description) VALUES (?, ?, ?)';
    $sql = "DELETE FROM posts WHERE likes < ?";
    $sql = "SELECT * FROM table_name WHERE id = :id";
    // SQLインジェクション：値を埋め込むSQLの場合、意図しないSQL実行させる攻撃方法
    $n = '10 OR 1 =1';
    // 対策：プリペアドステートメントを必ず使う（prepare）
    // ? に後から値を入れる。
    // ?: プレースホルダー（入力値をエスケープ）
    // SQL準備
    $stmt = dbc()->prepare($sql);
    $stmt->execute([$n]); // @param int $n（プレースホルダ）

    // execute()で値を渡した場合、値は全て文字列として埋め込まれる
    // →escapeするためにbindValueで明示的に型を指定。execute()は空でいい。
    // 第二引数は文字列として入ってきている→(int)をかく
    $stmt->bindValue('likes', $likes, PDO::PARAM_INT); // PARAM：整数型（値を紐付ける）
    $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT); // 後で入れる（(int)と型を指定する）
    $stmt->bindValue('message', $message, PDO::PARAM_STR);
    // エスケープ
    $stmt->bindValue(1, $a);
    $stmt->bindValue(2, $b);
    $stmt->bindValue(3, $c);
    // bindValueが重複している場合
    // →bindParamにすると変数の値を変えながら同じSQLを実行できる。（何度も使い回しできる）
    // SQL実行（?に入れる）
    $result = $stmt->execute();
    return $result; // → true
  } catch (\Exception $e) {
    echo $e->getMessage();
    return $result;
  }
}

function createUser($user)
{
  $result = false;
  $sql = 'INSERT INTO users (uname, email, pass) VALUES (?, ?, ?)';
  // ユーザデータを受け取って配列に入れる。
  $arr = [];
  $arr[] = $user['username'];
  $arr[] = $user['mail'];
  $arr[] = password_hash($user['pass'], PASSWORD_DEFAULT); // ハッシュ化
  try {
    $stmt = connect()->prepare($sql);
    $result = $stmt->execute($arr); // 実行（配列を?に入れる）
    return $result;
  } catch (\Exception $e) {
    echo $e;
    // error_log($e, 3, '../error.log'); // ログ出力
    return $result;
  };
}


// ブログ作成（引数：$blogs）
function blogCreate($blogs)
{
  $sql = "INSERT INTO table_name (title, content, category, publish_status)
  VALUES (:title, :content, :category, :publish_status)";
  // 接続
  $dbh = dbc();
  // トランザクション
  // なんらかの障害が発生してもデータが書き換えられないよう、整合性を保つためのしくみ。他の処理の影響を受けないようにしたい。
  // トランザクションの途中でエラーが起きた場合、それまでの処理を取り消す必要がある。
  $dbh->beginTransaction(); // 開始
  // データベースに入れる
  try {
    $stmt = $dbh->prepare($sql);
    // プレースホルダ
    $stmt->bindValue(':title', $blogs['title'], PDO::PARAM_STR);
    $stmt->bindValue(':content', $blogs['content'], PDO::PARAM_STR);
    $stmt->bindValue(':category', $blogs['category'], PDO::PARAM_INT);
    $stmt->bindValue(':publish_status', $blogs['publish_status'], PDO::PARAM_INT);
    $dbh->commit(); // 実行が終わったら登録
    echo 'ブログを投稿しました！';
    // SQL実行
    $stmt->execute();
  } catch (PDOException $e) {
    $dbh->rollBack(); // ロールバック：変更はなかったことにできる
    exit($e); // エラー
  } finally {
  };
}
