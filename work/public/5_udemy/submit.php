<?php
require('../../app/functions.php'); // h($str)

include('./_header.php');
?>


  <pre>
<!-- request: method属性がわからない場合に使う。postでもgetでも受け取る -->
  お名前：<?php print(h($_REQUEST['name'])); ?>

  性別：<?php print(h($_GET['gender'])); ?>

  予約日：
  <?php foreach ($_GET['reserve'] as $res) : ?>
    <?php print(h($res)); ?>
  <?php endforeach; ?>
</pre>

</main>
</body>

</html>