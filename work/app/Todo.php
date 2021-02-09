<?php

namespace MyApp;

class Todo
{
  // プロパティとして保持して他のメソッドで使う
  private $pdo;

  public function __construct($pdo)
  {
    $this->pdo = $pdo;
    Token::create(); // crsf対策
  }

  public function processPost()
  {
    // DBへpost時
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      Token::validate();
      $action = filter_input(INPUT_GET, 'action');
      switch ($action) { // formのクエリ文字列の値
        case 'add':
          $this->add();
          break;
        case 'toggle':
          $this->toggle();
          break;
        case 'delete':
          $this->delete();
          break;
        case 'purge':
          $this->purge();
          break;
        default:
          exit;
      }
      // POST形式から抜け出す（定数はconfig参照）
      header('Location: ' . SITE_URL);
      exit;
    }
  }
  // レコード挿入
  private function add()
  {
    $title = trim(filter_input(INPUT_POST, 'title'));
    if ($title === '') {
      return;
    }
    $stmt = $this->pdo->prepare("INSERT INTO todos (title) VALUES (:title)");
    $stmt->bindValue('title', $title, \PDO::PARAM_STR);
    $stmt->execute();
  }
  // 更新
  private function toggle()
  {
    $id = filter_input(INPUT_POST, 'id');
    if (empty($id)) {
      return;
    }
    $stmt = $this->pdo->prepare("UPDATE todos SET is_done = NOT is_done WHERE id = :id");
    $stmt->bindValue('id', $id, \PDO::PARAM_INT);
    $stmt->execute();
  }
  // 削除
  private function delete()
  {
    $id = filter_input(INPUT_POST, 'id');
    if (empty($id)) {
      return;
    }
    $stmt = $this->pdo->prepare("DELETE FROM todos WHERE id = :id");
    $stmt->bindValue('id', $id, \PDO::PARAM_INT);
    $stmt->execute();
  }
  // purge
  private function purge()
  {
    $this->pdo->query("DELETE FROM todos WHERE is_done = 1");
  }

  // データ取得
  public function getAll()
  {
    $stmt = $this->pdo->query("SELECT * FROM todos ORDER BY id DESC");
    $todos = $stmt->fetchAll();
    return $todos;
  }
}
