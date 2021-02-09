<?php // オブジェクト編
// 名前空間：クラス名が衝突しないよう、下記ところどころで使用。大規模な開発で用いられる。
use Dotinstall\MyPHPApp; // 必ず先頭に持って来ること！
class Post
{
} // 関係のない同名クラスがあっても識別できる。
include('./_header.php');

// 型の継承がよくわからない。それの恩恵がよくわからない。 #15 #21

require('Post.php');


try { // 通常処理
  $posts = [];
  // インスタンス
  $posts[0] = new MyPHPApp\Post('hello');
  $posts[1] = new MyPHPApp\Post('hello again');
  $posts[2] = new MyPHPApp\SponsoredPost('hello hello', 'dotinstall');
  $posts[3] = new MyPHPApp\PremiumPost('hello there', 300);

  // $posts[0]->likes = -100; // 意図しないプログラム
  // $posts[0]->like(); // 安全なプログラムを書く為にメソッドを介して操作すること！
  // $posts[3]->like();
  // インターフェースの実装
  function processLikable(MyPHPApp\LikeInterface $likable) // → ここの恩恵がよくわからない。#15 型の継承
  {
    $likable->like();
  }
  processLikable($posts[0]);
  processLikable($posts[3]);

  // $posts[0]->show();
  // $posts[1]->show();
  // $posts[2]->show(); // 継承
  // 引数の型付け → ここの恩恵がよくわからない。#15 型の継承
  function processPost(MyPHPApp\BasePost $post) // BasePost型の$postのみ受け付ける
  {
    $post->show();
  }
  foreach ($posts as $post) {
    processPost($post);
    echo '<br>';
  }

  echo 'クラスから直接呼び出し' . '<br>';
  echo MyPHPApp\Post::VERSION . '<br>'; // echo 定数
  MyPHPApp\Post::showInfo();
} catch (\Exception $e) { // 例外処理（eで受け取る）
  echo $e->getMessage(); // エラー内容を出力。
}
