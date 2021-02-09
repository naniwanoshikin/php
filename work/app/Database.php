<?php

namespace MyApp;

class Database
{
  // DB接続に無駄のないように、$instance は必ず１つになるようにする
  private static $instance;

  public static function getInstance()
  {
    try {
      if (!isset(self::$instance)) {
        self::$instance = new \PDO(
          DSN,
          DB_USER,
          DB_PASS,
          [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
            \PDO::ATTR_EMULATE_PREPARES => false,
          ]
        );
      }
      return self::$instance;
    } catch (\PDOException $e) {
      echo $e->getMessage();
      exit;
    };
  }
}
