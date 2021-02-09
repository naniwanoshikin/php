<?php // 基礎文法編

declare(strict_types=1); // 強い型付け（関数の引数に型を指定）。文の最初に書く。
require('../../app/functions.php'); // h($str)
include('./_header.php');

// 関数
function Br($m = '仮引数') // 引数を指定しなかった場合、仮引数が使われる。
{
  echo '<br>';
  echo '-------------------' . $m . '-------------------';
  echo '<br>';
}


// 定数
echo '--------------- 定数------------------';
echo '<br>'; // 改行
echo '再定義できない。慣習的に大文字。';
echo '<br>';
const ID = 'const';
echo ID;
echo '<br>';
define('NAME', 'difine');
echo NAME;



// 変数
$name = 'ニンジャ';
Br('出力');
echo 'echo：文字列のみ。関数ではく言語構造。「print」との違いは、複数の引数を指定できる点と戻り値がない点になります。また、「echo」は戻り値がないため「式」としてみなされません。なので、三項演算子の中では使えません。';
echo '<br>';
echo '例：' . $name . '<br>'; // 連結

echo 'print：文字列のみ。関数ではく言語構造。「print」の戻り値は常に「1」を返す。その為、式としてみなされます。なので、三項演算子の中で使用できます。';
echo '<br>';
print '例：' . $name . '<br>'; // udemyはprint

echo 'var_dump()：関数。要素数や型も見れる';
echo '<br>';
echo '例：';
var_dump($name);
echo '<br>';

echo 'print_r：関数。文字列に限らず変数が持っている情報。var_dumpよりスッキリ表示。';
echo '<br>';
echo '例：';
print_r($name);
echo '<br>';

Br('連結');
$name .= 'わんこ'; // これも連結
echo $name;
echo '<br>';


Br("''と\"\"の違い：''の方が処理速度が早い");
echo "\"\"：$name"; // 変数展開できる。{$name}としても同じ
echo '<br>';
echo '\'\'：$name';
echo '<br>';

Br('\：エスケープシーケンス');
echo "It's \"Sunny\"."; // 'を使うときだったり、""を文字列として埋め込みたい場合
echo '<br>';
echo "It . \t Hello"; // 特殊文字はどうやったら使えるの？？？
// \n 改行
// \r キャレッジリターン



Br('データ型'); // 実引数
// スカラー型
$a = 'stringです'; // string
$b = 10; // integer
$c = -1.3; // double(float)
$e = true; // boolean
// 特殊型：
$d = null; // NULL
// resourceは？？？？？

// キャスト（型を変換）
$a = (float)10;
$b = (string)1.3;
var_dump($a);
echo '<br>';
var_dump($b);


Br('計算');
$x = 3;
$y = 3;
// インクリメント
echo ++$x . ',  '; // 4
echo $y++ . ',  '; // 3
echo 1 + '3'; // 数値っぽい文字列をなるべく数値に変換する
echo '<br>';





Br('スコープ');
$rate = 1.1; // グローバルスコープ（関数の中では使われない）
function sum($a, $b, $c)
{
  // global $rate; // グローバルスコープを使用したい時
  $rate = 1.08; // ローカルスコープ（基本的にはこちらを使用すること）
  return ($a + $b + $c) * $rate; // return で処理終了
}
echo sum(100, 200, 300) + sum(300, 400, 500); // 1944

Br('無名関数（クロージャー）');
// 関数を値としたいとき。末尾にセミコロン。こちらの方が便利？？
$sum = function ($a, $b, $c) {
  $total = $a + $b + $c;
  return $total < 0 ? 0 : $total;
};
echo $sum(100, 200, 300);

Br('可変長引数');
function osum(...$numbers) // いくつでも引数を取れる
{
  $total = 0;
  foreach ($numbers as $number) {
    $total += $number;
  }
  return $total;
}
echo osum(1, 3, 5);
echo ',  ';
echo osum(1, 3, 5, 10);

Br('複数の返り値');
function getStats(...$numbers)
{
  $total = 0;
  foreach ($numbers as $number) {
    $total += $number;
  }
  return [$total, $total / count($numbers)]; // 合計と平均
}
[$sum, $average] = getStats(1, 3, 5); // list($sum, $average)でもよい
echo '合計' . $sum;
echo '<br>';
echo '平均' . $average;



Br('条件分岐');
$signal = 'blue';
switch ($signal) {
  case 'red':
    echo 'Stop!';
    break; // 処理終了
  case 'yellow':
    echo 'Caution!';
    break;
  case 'blue':
  case 'green':
    echo 'Go!';
    break;
  default: // どれにも当てはまらない
    echo 'Wrong signal';
    break;
}

Br('forループ');
for ($i = 0; $i <= 10; $i++) {
  if ($i % 2 === 0) {
    continue; // スキップ
  }
  if ($i === 9) {
    break; // ループを抜ける
  }
  echo $i . '   ';
}

Br('whileループ');
$hp = 100;
while ($hp > 0) {
  echo $hp . '<br>';
  $hp -= 15; // 条件処理をかく！
}
// 1度は処理したい場合
do {
} while ($hp > 0);


Br('引数の型を指定'); // →予期しない値をはじける
// 弱い型付けだと'4'は数値で扱われる→declareを最初に書く
function showInfo(string $name, int $score): void // 返り値がない場合はvoid
{
  echo $name . ': ' . $score;
}
showInfo('taguchi', 40);

Br('string型の指定');
function getAward(?int $score): ?string // ?：nullかstringか、を指定できる
{
  return $score >= 100 ? 'Gold Medal' : null;
}
echo getAward(150);
echo getAward(40);


Br('配列：Array'); // 複合型の１つ
$score0 = array(); // progateはこの書き方
$score1 = [
  90,
  40,
  100,
];
$score1[] = 3333; // 後ろに追加
$score1[1] += 3; // 上書き 1は添字

var_dump($score1);
echo '<br>';
print_r($score1);

Br('配列の要素を展開（配列を要素にすると展開できない？？）');
$scores = [
  // ...$score1, // エラー出る
  // [10, 20], // エラー出る
  'aaaa',
];
echo '合算後の配列$scores= [';
foreach ($scores as $value) {
  print_r($value . ',   ');
  // echo '<pre>';
}
echo ']';
echo '<br>';
echo '配列1番目は' . $scores[1]; // 43


$title = "PHPだよ";
$content = 'コメントだよ。。。。';
$post_at = '2020/10/12';
$tag = ["PH", "tag"];
$status = true;


Br('連想配列');
$blog1 = [
  // key => value
  'id' => ID,
  'title' => $title,
  'content' => $content,
  '投稿日' => $post_at,
  // 'タグ' => $tag,
  'ステータス' => $status,
];
// echo $blog1['title']; // １つ取り出し
foreach ($blog1 as $key => $e) {
  echo '<pre>';
  echo $key . '=>' . h($e); // エスケープ
  echo '<pre>';
}


// 比較演算子
$a == $b; // 等しい
$a != $b; // 等しくない
$a === $b; // 等しくかつ同じ型
$a !== $b; // ？？？？？
// 論理演算子
$a & $b; // かつ
$a && $b; // ？？？？？（progate）
$a || $b; // または
!$a; // aではない
// 真偽値パターン
if (false) {
} // →false, 0, ±0, ±0.0, '0', '', null, []
// 条件演算子（if文と同じ。読みづらい）
$a < 0 ? 0 : $a;
// Null合体演算子
$b = filter_input(INPUT_GET, 'color') ?? 'transparent';
// nullではなく空文字との比較の場合使えない（下記）。
$a = $a !== '' ? $a : '...'; // 例：<input type="text">, <textarea>



Br('ナウドキュメント（ブラウザだと反映されない？？？）'); // 長めのテキストを表現する場合
$aaaaaaa = 'taguchi';
// $text = <<<'EOT' // nowdoc：変数を展開しない
// $text = <<<"EOT" or EOT // heredoc：変数を展開する
// 終端記号（EndOfText）名は何でもいい
$text = <<<EOT
  hello! $aaaaaaa
    this is looooong
  text!
  EOT;

echo $text;


// PHP_EOLはターミナルのみ改行される。ブラウザではされない（dotinstall）;

?>


<!-- 剰余算でテーブルに色を付ける -->
<table>
  <?php for ($i = 1; $i <= 10; $i++) : ?>
    <?php if ($i % 2 === 0) {
      print '<tr style="background-color: #ccc">';
    } else {
      print '<tr>';
    }
    print '<td>' . $i . '行目</td>';
    print '</tr>';
    ?>
  <?php endfor; ?>
</table>