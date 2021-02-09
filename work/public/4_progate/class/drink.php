<?php
require_once('menu.php'); // 継承

class Drink extends Menu
{
  // 独自のプロパティ
  private $type; // アイス、ホットなど

  // 独自のインスタンスを作成したい → constructメソッドのオーバーライド
  public function __construct($name, $price, $image, $type)
  {
    parent::__construct($name, $price, $image); // 親クラスのコンストラクタを呼び出し
    $this->type = $type;
  }

  public function getType()
  {
    return $this->type;
  }
  public function setType($type)
  {
    $this->type = $type;
  }
}
