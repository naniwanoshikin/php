<?php
require_once('../../app/env.php');

class Dbc
{
  protected $table_name;

  // DB接続
  protected function Connect() // dbcという名前だとclass名と被ってしまってエラーになる
  {
    $host   = DB_HOST;
    $dbname = DB_NAME;
    $user   = DB_USER;
    $pass   = DB_PASS;
    $dsn    = "mysql:host=$host; dbname=$dbname;charset=utf8";
    try {
      $dbh = new PDO(
        $dsn,
        $user,
        $pass,
        [
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_EMULATE_PREPARES => false,
        ]
      );
      // echo '接続成功';
    } catch (PDOException $e) {
      echo '接続失敗' . $e->getMessage();
      exit();
    };
    return $dbh;
  }

  // DBからデータを取得
  public function getAll()
  {
    $dbh = $this->Connect(); // this = class内参照
    $sql = "SELECT * FROM $this->table_name";
    $stmt = $dbh->query($sql);
    $result = $stmt->fetchall(PDO::FETCH_ASSOC);
    return $result;
    $dbh = null; // 接続終了
  }

  // 詳細画面を取得（引数：$id、返り値：$result）
  public function getById($id)
  {
    if (empty($id)) {
      exit('idが不正です');
    }
    $dbh = $this->Connect();
    $stmt = $dbh->prepare("SELECT * FROM $this->table_name WHERE id = :id");
    $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$result) {
      exit('ブログがありません');
    }
    return $result;
  }

  // ブログ削除（引数：$id）
  public function blogDelete($id)
  {
    if (empty($id)) {
      exit('idが不正です');
    }
    $dbh = $this->Connect();
    $stmt = $dbh->prepare("DELETE FROM $this->table_name WHERE id = :id");
    $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
    $stmt->execute();
    echo 'ブログを削除しました！';
    // return $result;
  }
}
