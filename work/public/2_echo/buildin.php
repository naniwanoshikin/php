<?php // ビルドイン関数編
include('./_header.php');

function Br($m = '改行') // 仮引数。引数を指定しなかった場合、Adが使われる。
{
  echo '<br>';
  echo '-------------------' . $m . '-------------------';
  echo '<br>';
}

if (date('G') < 8) {
  Br('受付時間外です');
} else {
  Br('営業時間中です');
}
date_default_timezone_set('Asia/Tokyo'); // タイムゾーン
print(time() . "\n"); // UNIXタイムスタンプ
echo '<br>';
// 下記、2038年以降に動作しなくなるらしい。。
echo date('Y年 m月 d日 G時 i分 s秒 l W日目'); // 年 月 日 曜日
echo '<br>';
print(date('n/j(D)')); // 今日
echo '<br>';
print(date('n/j(D)', time() + 60 * 60 * 24) . "\n"); // 明日
echo '<br>';
echo date('Y-m-d l', mktime(0, 0, 0, 5, 1, 2020)); // 特定日時
echo '<br>';
echo date('Y-m-d l', strtotime('2020-05-07'));
echo '<br>';
echo date('Y-m-d H:i;s l', strtotime('2020-05-07 +1 day'));
echo '<br>';

// オブジェクト
$today = new DateTime();
print($today->format('G時 i分 s秒 l') . "\n"); // 時間が正しく表示されない？
echo '<br>';

$weekname = ['日', '月', '火', '水', '木', '金', '土'];
$date = date('w'); // 週5日目
print($weekname[$date] . "\n"); // 曜日（日本語）
echo '<br>';
// カレンダー + 剰余算で曜日を日本語で表す
for ($i = 1; $i <= 3; $i++) : // $i日後まで
  print(date('n/j(' . $weekname[($i + 2) % 7] . ')', strtotime('+' . $i . 'day')));
  echo '<br>';
endfor;



Br('全角 numeric');
$age = '２０';
$age = mb_convert_kana($age, 'n', 'UTF-8'); // 全角→半角数字に直す
if (is_numeric($age)) { // 数字なら
  echo $age . '歳';
} else {
  echo '数字ではありません';
}

Br('正規表現');
// 郵便番号（正規表現）
$zip = '１２３−４５６７';
$zip = mb_convert_kana($zip, 'a', 'UTF-8'); // 英数字を半角にする
if (preg_match("/\A\d{3}[-]\d{4}\z/", $zip)) {
  echo '郵便番号：〒' . $zip;
} else {
  echo '正しい書式で書いてください';
}


Br('#2 sprintf()');
echo sprintf('%04d年 %02d月 %02d日 %s', 2020, 3, 30, '金'); // 桁数 d：数字
echo '<br>';

$name = 'Apple';
$score = 32.246;
$info = "[$name][$score]";
echo $info;
echo '<br>';


// sprintf：フォーマット済みの文字列を返す。
// printf：戻り値がなくて標準出力に表示するだけ。
$info = sprintf("[%15s][%10.2f]", $name, $score);
echo str_replace(' ', '&nbsp;', $info); // スペース変換 空白を&nbsp;にする
echo '<br>';

$info = sprintf("[%-15s][%010.2f]", $name, $score);
echo str_replace(' ', '&nbsp;', $info);
echo '<br>';

printf("[%-15s][%010.2f]", $name, $score);
echo '<br>';


Br('#3 文字列を扱う：strlen(), strpos(),str_replace()');
$input = trim(' abc_abc  ');

echo '文字数：' . strlen($input); // 文字数
echo '<br>';

echo strpos('abcabc', 'a', 1); // 文字検索：0スタート #3の質問が理解できなかった
echo '<br>';

$input = str_replace('_', '-', $input); // 置き換え
echo $input;
echo '<br>';

Br('#4 日本語の時はマルチバイト文字列');
$input = ' こんにちは  ';
$input = trim($input);

echo mb_strlen($input) . PHP_EOL; // 5
echo '<br>';
echo mb_strpos($input, 'に') . PHP_EOL; // 2
echo '<br>';
$input = str_replace('にち', 'ばん', $input); // 文字コードがUTF-8なら日本語も扱える
echo $input . PHP_EOL;



Br('#5, 6 固定長データ：sbstr()');
$input = '20200320Item-A  1200';
$input = substr_replace($input, 'Item-B  ', 8, 8); // 置換

$date = substr($input, 0, 8);
$product = substr($input, 8, 8);
$amount = substr($input, 16); // 最後までなら引数省略可
echo $date;
echo '<br>';
echo $product;
echo '<br>';
echo number_format($amount); // 3桁ごとにカンマ



Br('#7 文字列を検索・置換：preg_match()');
$input = 'Call us at 03-3001-1256 or 03-3015-3222';
$pattern = '/\d{2}-\d{4}-\d{4}/';

// 検索
// パターン、検索したい文字列、検索した結果を格納する変数
// preg_match($pattern, $input, $matches); // 1つ目に引っかかった結果を取得
preg_match_all($pattern, $input, $matches); // 全て
print_r($matches);
echo '<br>';
// 置換
$input = preg_replace($pattern, '**-****-****', $input);
echo '置換：' . $input;


Br('#8 文字列と配列を相互に変換：implode()');
$d = [2020, 11, 15];
// echo "$d[0]-$d[1]-$d[2]";
// 文字列にする（配列の要素を - で連結）
echo '配列を文字列にする→ ' . implode('-', $d) . '<br>';

$t = '17:32:45';
echo '逆に配列にする→ ';
print_r(explode(':', $t));



Br('#9 小数点');
// 小数点
$cost = 33.333333333;
print(floor($cost) . '%引きです'); // 切り捨て
echo '<br>';
print(ceil($cost) . '%引きです'); // 切り上げ
echo '<br>';
print(round($cost, 3) . '%引きです'); // 四捨五入
echo '<br>';
// echo mt_rand(1, 6); // 1~6の整数
echo '<br>';
// echo max(3, 9, 5); // 最大値
// echo M_PI; // 円周率
// echo M_SQRT2; // ルート2



Br('#24 ファイルに文字列を書きこもう：fopen()');
echo 'ファイル書き込みモード：write';
// ファイル生成・読み込み
$fp = fopen('names.txt', 'w'); // filePointer = ファイル名, モード
// 書き込む（実行）
fwrite($fp, "taro\n"); // + 改行
// 書き込み終了
fclose($fp);


Br('#25 ファイルに文字列を追記しよう');
echo 'ファイル追記モード：a';
$fp = fopen('names.txt', 'a');

fwrite($fp, "jiro\n");
fwrite($fp, "saburo\n");

fclose($fp);


Br('#26 ファイルからデータを読み込もう：fgets()');
echo 'ファイル読み込みモード：r';
echo '<br>';

$fp = fopen('names.txt', 'r');

// サイズ指定して一気に読み込む
// $contents = fread($fp, filesize('names.txt'));
// fclose($fp);
// echo $contents;

// １つ１つ読み込む
while (($line = fgets($fp)) !== false) { // 読み込むものがなくならない限り、
  echo $line;
}
fclose($fp);


Br('#27 ファイルから読み込み。file_get_contents');
$link1 = './udemy.txt';
// txtファイル書き込み
$success = file_put_contents($link1, "2018-06-01\nテキストに書き込みをしましたよ！");
if ($success) {
  print('書き込み完了');
} else {
  print('書き込み失敗');
}
echo '<br>';

// txtファイル読み込み
$news = file_get_contents($link1);
$news .= "2018-06-03！\n" . $news; // 文字列連結
print($news);
echo '<br>';

// テキストファイル１行ずつ配列の要素として読み込む
print_r(file($link1, FILE_IGNORE_NEW_LINES));

echo '<br>';
readfile($link1); // 読み込み



Br('#28 ディレクトリを操作しよう');
// 事前にファイルを作成しておくこと
$dir = 'build'; // ディレクトリ名
file_put_contents($dir . '/taro.txt', "taro\n"); // txt作成
file_put_contents($dir . '/jiro.txt', "jiro\n");
// ファイル操作
$dp = opendir($dir);
// １行ずつ、読み込むものがなくならない限り、
while (($item = readdir($dp)) !== false) {
  if ($item === '.' || $item === '..') { // 現在と１つ上ののディレクトリをスキップする為
    continue;
  }
  echo $item;
  echo '<br>';
}

Br('#29 glob()');
// 28とは別の方法で操作
foreach (glob($dir . '/*.txt') as $item) {
  echo basename($item); // 上のパス名（$dir/）を削除できる
  echo '<br>';
}



Br(); // udemy
// XML Extensible Markup Language
// 拡張できるマークアップ言語
// RSS webページを更新されたか確認できるようにする
// $xmlTree = simplexml_load_file('https://h2o-space.com/feed/');
// var_dump($xmlTree);

// JSON JavaScript Object Notation JSオブジェクト表機法 重い・・・
// XMLと違い、短く書ける。形式は $id: "",
// $file = file_get_contents('https://h2o-space.com/feed/json/');
// $json = json_decode($file);
// var_dump($json->home_page_url);

?>
<!-- XML -->
<!-- <?php foreach ($xmlTree->channel->item as $item) : ?> -->
<!-- ・<a href="<?php print($item->link); ?>"><?php print($item->title); ?></a> -->
<!-- <?php endforeach; ?> -->
<!-- JSON -->
<!-- <?php foreach ($json->items as $item) : ?> -->
<!-- ・<a href="<?php print($item->url); ?>"><?php print($item->title); ?></a> -->
<!-- <?php endforeach; ?> -->