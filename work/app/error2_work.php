<?php
// 読み込む順序がある！
// バリデーション：不正なデータがデータベースに保存されないように、データをチェックする仕組み

// require ←ロジック系
// include ←処理が続行しても問題ないHTMLに
// _once をつけると、再読み込みしない（すでにファイルが読み込まれていたらスキップする）

// 読み込みに失敗したら処理を止める。重複して読み込むことがない場合。
require('../app/functions.php'); // 防犯
// 再読み込みしない 絶対パスで指定することが推奨
require_once('./dbc.php'); // 同じ階層なら./
require_once(__DIR__ . '/../app/config.php'); // __DIR__ = 現在のファイルがあるディレクトリの絶対パス

// 読み込みに失敗しても処理が止まらない。止めるほどクリティカルではない（header, footerに入れる）。
include('../app/_parts/_header.php');
include_once('');

error_reporting(E_ALL & ~E_NOTICE); // noticeエラーを非表示

// エラー内容を表示（true または "on"）。php.iniでdisplay_errors=onなってたらかかんくていいかも？
ini_set('display_errors', true);

phpinfo();
