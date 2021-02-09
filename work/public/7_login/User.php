<?php
require_once('dbc.php');

class UserLogic
{
  /**
   * ユーザ登録
   * @param array $user：ユーザ情報
   * @return bool $result
   */
  public static function createUser($user)
  {
    $result = false;
    $sql = 'INSERT INTO users (name, email, pass) VALUES (?, ?, ?)';
    $arr = [];
    $arr[] = $user['username'];
    $arr[] = $user['mail'];
    // ハッシュ化
    $arr[] = password_hash($user['pass'], PASSWORD_DEFAULT); // ハッシュ値から元データを復元。
    try {
      $stmt = dbc()->prepare($sql);
      $result = $stmt->execute($arr);
      return $result;
    } catch (\Exception $e) {
      echo $e;
      return $result;
    };
  }

  /**
   * ログイン機能
   * @param string $mail 入力値
   * @param string $pass 入力値
   * @return bool $result
   */
  public static function login($mail, $pass)
  {
    $result = false;
    // ユーザ情報（配列）
    $users = self::getUserByMail($mail);

    if (!$users) { // ない場合、
      $_SESSION['msg'] = 'Emailが一致しません';
      return $result;
    }
    // パスワードが一致した場合（入力値, DB値）、ログイン成功
    if (password_verify($pass, $users['pass'])) {
      session_regenerate_id(true); // ハイジャック対策（古いsessionを捨てて新しいidを作り直す）
      $_SESSION['login_user'] = $users; // ユーザー情報を保持（マイページ用）
      $result = true;
      return $result;
    }
    // パスワードが一致しない場合
    $_SESSION['msg'] = 'Passwordが一致しません';
    return $result;
  }

  /**
   * DBのユーザ情報を取得（mailから検索）
   * @param string $mail
   * @return array|bool $user|false
   */
  public static function getUserByMail($mail)
  {
    $sql = 'SELECT * FROM users WHERE email = ?';
    $arr = [];
    $arr[] = $mail;
    try {
      $stmt = dbc()->prepare($sql);
      $stmt->execute($arr);
      $user = $stmt->fetch();
      return $user;
    } catch (\Exception $e) {
      return false;
    };
  }

  /**
   * ログインチェック
   * @param void
   * @return bool $result
   */
  public static function checkLogin()
  {
    $result = false;
    // sessionにlogin_userとidがあれば
    if (isset($_SESSION['login_user']) && $_SESSION['login_user']['id'] > 0) {
      return $result = true;
    }
    return $result;
  }

  /**
   * ログアウト
   */
  public static function logout()
  {
    $_SESSION = array();
    session_destroy();
  }
}
