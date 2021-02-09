<?php
session_start();
require('../../app/functions.php'); // h($str)

include('./_header.php');
?>


<pre>

  COOKIE：<?= $_COOKIE['save_message']; ?>


  SESSION：<?= $_SESSION['session_message']; ?>

  </pre>

</main>