<?php

class Menu
{
  // 子クラスで独自のconstructメソッドを定義（上書き）したい（オーバーライド）。
  // →protected にする
  protected $name;
  protected $price;
  protected $image;
  private $orderCount = 0; // 注文 入力（→セッター→privateのまま）
  // クラスプロパティ
  protected static $count = 0; // メニュー０品（初期値）

  public function __construct($name, $price, $image)
  {
    $this->name = $name;
    $this->price = $price;
    $this->image = $image;
    self::$count++; // メニュー数が増加
  }

  public function hello()
  {
    echo '私は' . $this->name . 'です';
  }
  // ゲッター
  public function getName()
  {
    return $this->name;
  }
  public function getImage()
  {
    return $this->image;
  }
  public function getOrderCount() // 注文数
  {
    return $this->orderCount;
  }
  public function getTaxIncludedPrice() // 税込み
  {
    return floor($this->price * 1.1);
  }
  public function getTotalPrice() // 小計（個数分）
  {
    return $this->getTaxIncludedPrice() * $this->orderCount;
  }
  public static function getCount() // メニュー数
  {
    return self::$count;
  }

  // セッター（値を変更したい場合に用いる）
  /**
   *
   *
   * @param 注文数（入力）
   * @return 注文数
   */
  public function setOrderCount($orderCount)
  {
    $this->orderCount = $orderCount;
  }

  /**
   * 詳細画面にて、そのメニュー名から、そのメニューのインスタンスを取得
   *
   * @param 全メニュー, クリックしたメニュー名
   * @return そのメニューのインスタンス
   */
  public static function findByName($menus, $name)
  {
    foreach ($menus as $menu) {
      if ($menu->getName() == $name) { // インスタンスの$nameの値と、上記$nameが一致したら
        return $menu; // １つだけ返す（２個目以降は実行されない）
      }
    }
  }

  /**
   * 詳細画面にて、該当するインスタンスを取得
   *
   * @param 全Reviewインスタンス
   * @return 該当するReviewインスタンス
   */
  public function getReviews($reviews)
  {
    $reviewsForMenu = array(); // 格納
    foreach ($reviews as $review) { // 各インスタンス
      if ($review->getMenuName() == $this->name) { // 各インスタンスのメニュー名＝クリックしたメニュー名
        $reviewsForMenu[] = $review; // 追加
      }
    }
    return $reviewsForMenu;
  }
}
