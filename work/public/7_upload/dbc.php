<?php
session_start();
require_once(__DIR__ . '/../../app/env.php'); // env

// uploadのheader用
define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/7_upload/index.php');


// DB接続
function dbc()
{
  $host   = DB_HOST;
  $db     = DB_NAME;
  $user   = DB_USER;
  $pass   = DB_PASS;
  $dsn    = "mysql:host=$host; dbname=$db; charset=utf8mb4";
  try {
    $pdo = new PDO($dsn, $user, $pass, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    // echo '接続成功';
    return $pdo;
  } catch (PDOException $e) {
    echo '接続できません';
    exit($e->getMessage());
  };
}

/**
 * DBにファイルデータを保存
 *
 * @param string $a ファイル名
 * @param string $b 保存先のパス
 * @param string $c 説明
 * @return bool $result
 */
function fileSave($a, $b, $c)
{
  $result = false;
  $sql = 'INSERT INTO upload (name, file_path, content) VALUES (?, ?, ?)';
  try {
    $stmt = dbc()->prepare($sql);
    $stmt->bindValue(1, $a);
    $stmt->bindValue(2, $b);
    $stmt->bindValue(3, $c);
    $result = $stmt->execute();
    return $result;
  } catch (\Exception $e) {
    echo $e->getMessage();
    return $result;
  }
}
/**
 *  ファイルデータを取得
 *
 * @return array $d ファイルデータ
 */
function getAllFile()
{
  $sql = "SELECT * FROM upload";
  $d = dbc()->query($sql);
  return $d;
}

// エスケープ
function h($str)
{
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
