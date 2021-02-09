<?php // dotinstall web開発編
require('../../app/functions.php');

include('./_header.php');
?>

<h3>GET Cookie</h3>

<!-- <form action="クエリ文字列" method="get"> -->
<form action="get_result.php" method="get">
  <div>
    お名前：<input type="text" name="name">
  </div>

  <div>食べ物：</div>
  <!-- multiple：複数の値を指定可 -->
  <select name="foods[]" multiple>
    <option value="apple">りんご</option>
    <option value="peach">桃</option>
    <option value="banana">バナナ</option>
  </select>

  <div>遊具：
    <!-- 複数選択可能リストならば、nameの後に[]をつける -->
    <label><input type="checkbox" name="park[]" value="rale">レール</label>
    <label><input type="checkbox" name="park[]" value="wall">壁</label>
    <label><input type="checkbox" name="park[]" value="bar">鉄棒</label>
  </div>

  <div>背景色：
    <label><input type="radio" name="color" value="skyblue">水色</label>
    <label><input type="radio" name="color" value="pink">ピンク</label>
    <label><input type="radio" name="color" value="limegreen">緑</label>
    →<a href="get_reset.php">[リセット]</a>
  </div>

  <div>内容：</div>
  <textarea name="message" cols="30" rows="5"></textarea>

  <div class="orderbtn">
    <input type="submit" value="GET">
  </div>
</form>

<?php
include('../../app/_parts/_footer.php');
