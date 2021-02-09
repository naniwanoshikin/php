<?php

class Review
{
  private $userId; // ユーザid
  private $body; // レビュー内容
  // private $userName; // ユーザー名

  public function __construct($menuName, $userId, $body)
  {
    $this->menuName = $menuName;
    $this->body = $body;
    $this->userId = $userId;
  }

  public function getMenuName()
  {
    return $this->menuName;
  }
  public function getBody()
  {
    return $this->body;
  }
  /**
   * 詳細画面にて、該当するインスタンスを取得
   *
   * @param 全Userインスタンス
   * @return 該当するUserインスタンス
   */
  public function getUser($users)
  {
    foreach ($users as $user) { // 各インスタンス
      if ($user->getId() == $this->userId) { // 各UserインスタンスのユーザId = ReviewインスタンスのuserId
        return $user;
      }
    }
  }
}
