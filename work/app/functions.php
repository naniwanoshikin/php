<?php
// appフォルダ：直接ブラウザからアクセスできない

// 予期しない文字
// $name = 'Taro <script>alert(1);</script>'; // → JSが実行されてアラートが出る
// →htmlに値を埋め込む時は、HTMLタグとして解釈されないように文字実体参照に変換する（特殊文字のエンコード）
/**
 * XSS対策：エスケープ処理
 *
 * @param string $str 対象の文字列
 * @return string 処理された文字列
 */
function h($str)
{
  // （文字列, "", ''も変換, 文字コード）
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}


/**
 * CSRF対策：トークン生成
 *
 * @param void
 * @return ？？？
 */
function createToken()
{
  if (!isset($_SESSION['token'])) { // sessionのトークンが作られていなかったら
    $_SESSION['token'] = bin2hex(random_bytes(32)); // 推測されにくいランダムな16進数（32）の文字列を生成
  }
}

/**
 * CSRF対策：トークンチェック
 *
 * @param void
 * @return ？？？
 */
function validateToken()
{
  $token = filter_input(INPUT_POST, 'token'); // フォーム送信POSTで渡ってきたトークン
  // 空だったり（リンクから直接きた）、SESSIONトークンが上記と一致しなければ中止
  if (empty($_SESSION['token']) || $_SESSION['token'] !== $token) {
    exit('Invalid post request');
  }
}
