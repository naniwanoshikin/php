<?php // dotinstall web開発編
// session
session_start(); // 必ず先頭に書く！
ini_set('display_errors', true);

include('./_header2.php'); // なぜか表示がされない？？？？？
?>

<h3>GET Cookie</h3>

<form action="get_result.php" method="get">
  <div>
    お名前：<input type="text" name="name">
  </div>

  <div>食べ物：</div>
  <select name="foods[]" multiple>
    <option value="apple">りんご</option>
    <option value="peach">桃</option>
    <option value="banana">バナナ</option>
  </select>

  <div>遊具：
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
