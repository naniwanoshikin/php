<?php

class User
{
  private $id; // ユーザid
  private $name; // ユーザー名
  private $gender; // 性別

  private static $count = 0; // id用

  public function __construct($name, $gender)
  {
    $this->name = $name;
    $this->gender = $gender;

    self::$count++; // インスタンスが生成されるとidも増える
    $this->id = self::$count;
  }
  public function getId()
  {
    return $this->id;
  }
  public function getName()
  {
    return $this->name;
  }
  public function getGender()
  {
    return $this->gender;
  }
}
