<?php
require_once('Dbc.php');

// ブログ作成・更新
class Blog extends Dbc
{
  protected $table_name = 'blog';

  // カテゴリ名を表示（引数：数字、返り値：文字列）
  public function setCategoryName($c)
  {
    if ($c === 1) {
      return '日常';
    } elseif ($c === 2) {
      return 'プログラミング';
    } else {
      return 'その他';
    }
  }
  // 作成・更新のバリデーション
  public function blogValidate($blogs)
  {
    if (empty($blogs['title'])) {
      exit('タイトルを入力して下さい');
    }
    if (mb_strlen($blogs['title']) > 191) {
      exit('タイトルは191文字以下にして下さい');
    }
    if (empty($blogs['content'])) {
      exit('本文を入力して下さい');
    }
    if (empty($blogs['category'])) {
      exit('カテゴリは必須です');
    }
    if (empty($blogs['status'])) {
      exit('公開ステータスは必須です');
    }
  }
  // ブログ作成（引数：$blogs）
  public function blogCreate($blogs)
  {
    $sql = "INSERT INTO $this->table_name(title, content, category, status)
    VALUES (:title, :content, :category, :status)";
    $dbh = $this->Connect();
    $dbh->beginTransaction(); // トランザクション
    // データベースに入れる
    try {
      $stmt = $dbh->prepare($sql);
      $stmt->bindValue(':title', $blogs['title'], PDO::PARAM_STR);
      $stmt->bindValue(':content', $blogs['content'], PDO::PARAM_STR);
      $stmt->bindValue(':category', $blogs['category'], PDO::PARAM_INT);
      $stmt->bindValue(':status', $blogs['status'], PDO::PARAM_INT);
      $dbh->commit(); // 登録
      echo 'ブログを投稿しました！';
      $stmt->execute();
    } catch (PDOException $e) {
      $dbh->rollBack(); // 変更はなかったことにできる
      exit($e);
    };
  }

  // ブログ編集（引数：$blogs）
  public function blogUpdate($blogs)
  {
    $sql = "UPDATE $this->table_name SET title = :title, content = :content, category = :category, status = :status WHERE id= :id";
    $dbh = $this->Connect();
    $dbh->beginTransaction(); // トランザクション
    try {
      $stmt = $dbh->prepare($sql);
      $stmt->bindValue(':id', $blogs['id'], PDO::PARAM_INT); // id追加
      $stmt->bindValue(':title', $blogs['title'], PDO::PARAM_STR);
      $stmt->bindValue(':content', $blogs['content'], PDO::PARAM_STR);
      $stmt->bindValue(':category', $blogs['category'], PDO::PARAM_INT);
      $stmt->bindValue(':status', $blogs['status'], PDO::PARAM_INT);
      $dbh->commit();
      echo 'ブログを更新しました！';
      $stmt->execute();
    } catch (PDOException $e) {
      $dbh->rollBack();
      exit($e);
    };
  }
}

// エスケープ
function h($str)
{
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
