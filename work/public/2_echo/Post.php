<?php // オブジェクト型：複合型の１つ
declare(strict_types=1);

namespace Dotinstall\MyPHPApp; // 名前空間：ベンダー名←??? /プロジェクト名

// クラス（構造）
// カプセル化：このクラスで何ができて何ができないかを明確にする
// アクセス修飾子
// ・public：どこからでも使用可
// ・protected：クラス内と子クラスでのみ継承
// ・private：クラス内のみ

// private $プロパティ用とした場合
// →ゲッター：プロパティの値を返すだけのメソッド（getName）。

// プロパティの値を変更するメソッドを定義したい場合
// →セッター：プロパティの値を変更するメソッド（setOrderCount）


// Trait：※型ではない
// →子クラスで use LikeTrait;を使うと 重複箇所を省ける
trait LikeTrait
{
  private $likes = 0; // $プロパティ
  // いいねを増やす
  public function like()   // メソッド
  {
    $this->likes++;
  }
}


// クラスは複数の親を持つことができない→インターフェースを使用
interface LikeInterface
{
  public function like();  // likeメソッドを必ず作って！
}


// 親クラス Superクラス BasePost型とする
// 抽象クラス：
abstract class BasePost
{
  protected $text; // クラスでの型つけ   ※修飾子後にstringあるとなぜかエラー。なのでとった。
  // クラスプロパティ（こちらは変数）：インスタンスではなく、クラスが持つデータ。
  protected static $count = 0; // 修飾子のあとにつける
  // オブジェクト定数（こちらは定数）
  public const VERSION = 0.1;

  // 各プロパティにnewの値をセット
  // インスタンスを生成する度に自動的に呼ばれるメソッド
  public function __construct(string $text)
  {
    if (strlen($text) <= 3) { // 3文字以下のtextが入った場合、
      // 例外を投げる：コードの見通しをよくする為に使用
      throw new Exception('Text too short!'); // Exceptionクラス
    }
    // ★$this->プロパティ = $newで渡される値（コンストラクタの引数）
    $this->text = $text;
    self::$count++;
  }
  // 抽象メソッド：子クラスの方で定義を強制
  // ポリモーフィズム(dotinstall)とは何？？？？？今はよくわからない。。。1/30
  // 同じ命令でも異なる動きを持たせること。
  abstract public function show(); // showを必ず作って！
}


// 継承１
class Post extends BasePost implements LikeInterface  // 子クラス Subクラス
{
  use LikeTrait; // trait

  public function show()
  {
    printf('%s (%d)', $this->text, $this->likes);
  }
  public static function showInfo()  // クラスメソッド
  {
    printf('Count: %d', self::$count); // countを表示
    echo '<br>';
    printf('Version: %.1f', self::VERSION); // verisionを表示
    echo '<br>';
  }
}

// 継承２
class SponsoredPost extends BasePost
{
  // 広告主の情報
  private $sponsor;

  public function __construct($text, $sponsor)
  {
    parent::__construct($text); // 親クラスのコンストラクタを使用
    $this->sponsor = $sponsor;
  }
  // override（同名のメソッドを再定義）
  final public function show() // 子クラスでoverrideさせたくない場合はfinalとかく
  {
    printf('%s by %s', $this->text, $this->sponsor);
  }
}

// 継承３
class PremiumPost extends BasePost implements LikeInterface
{
  use LikeTrait; // trait

  private $price;

  public function __construct($text, $price)
  {
    parent::__construct($text);
    $this->price = $price;
  }
  public function show()
  {
    printf('%s (%d) [%d JPY]' . PHP_EOL, $this->text, $this->likes, $this->price);
  }
}
