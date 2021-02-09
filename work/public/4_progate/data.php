<?php
require_once('class/drink.php'); // Drinkクラス
require_once('class/food.php'); // Foodクラス
require_once('class/review.php'); // Reviewクラス
require_once('class/user.php'); // Userクラス

// ゲッター（アクセス権あり）
// 独自のインスタンス（メニュー名、料金、写真、独自のプロパティ）
$menus = array(
  new Drink('トースト', 300, 'lunch1.jpeg', '甘い'),
  new Drink('モーニング', 400, 'lunch2.jpeg', 'ちょっと甘い'),
  new Food('キウイシャワー', 200, 'lunch3.jpeg', '3'),
  new Food('豆腐パスタ', 800, 'lunch4.jpeg', '1'),
);
// セッター
// $juice->setType('アイス');
// $coffee->setType('ホット');



// User（名前、性別）
$users = array(
  new User('suzuki', 'male'),
  new User('tanaka', 'female'),
  new User('suzuki', 'female'),
  new User('sato', 'male'),
);

// Review（そのメニュー名、ユーザ名、コメント）
$reviews = array(
  new Review($menus[0]->getName(), $users[0]->getId(), '果肉たっぷりのオレンジジュースです！'),
  new Review($menus[1]->getName(), $users[0]->getId(), '具がゴロゴロしていてとてもおいしいです'),
  new Review($menus[2]->getName(), $users[1]->getId(), '香りがいいです'),
  new Review($menus[3]->getName(), $users[1]->getId(), 'ソースが絶品です。また食べたい。'),
  new Review($menus[0]->getName(), $users[2]->getId(), '普通のジュース'),
  new Review($menus[1]->getName(), $users[2]->getId(), '値段の割においしいカレーだと思いました'),
  new Review($menus[2]->getName(), $users[3]->getId(), '苦味がちょうどよくて、おすすめです'),
  new Review($menus[3]->getName(), $users[3]->getId(), '具材にこだわりを感じました。'),
);
