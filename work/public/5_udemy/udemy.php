<?php
session_start();

// セッションへの記録
$_SESSION['session_message'] = 'せっっっっそそんだお';

// クッキー：Key, 保存したい内容, 2日間保存しておく
setcookie('save_message', 'クックーーーーだよ', time() + 60 * 60 * 24 * 2);

include('./_header.php');
?>

<pre>
  <form action="submit.php" method="get">
    <label for="myname">お名前：</label>
    <input type="text" id="myname" name="name" maxlength="20" value="">

    <p>性別：
    <label for=""><input type="radio" name="gender" value="male" checked>男性</label>
    ／
    <label for=""><input type="radio" name="gender" value="female">女性</label>
    </p>

    <p>同意しますか？：
    <input type="checkbox" id="agree" name="agree" value="on">同意する
    </p>

    <p>ご予約希望日</p>
    <input type="checkbox" name="reserve[]" value="1/1">1月1日
    <input type="checkbox" name="reserve[]" value="1/2">1月2日
    <input type="checkbox" name="reserve[]" value="1/3">1月3日
    <input type="submit" value="送信">
  </form>
</pre>

</main>

</body>

</html>