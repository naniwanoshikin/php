<?php

namespace MyApp;

class Utils
{
  // エスケープ
  public static function h($str)
  {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
  }
}
