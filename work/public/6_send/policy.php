<?php
require('../../app/functions.php'); // h

$scripts = [
  'ウェブサーバーの記録' => [
    '（引用）当社のウェブサーバーは、貴方のコンピュータのIPアドレスを自動的に収集・記録しますが、これらは貴方個人を特定するものではありません。貴方自ら個人情報を開示しない限り、貴方は匿名のまま当社ウェブサイトを閲覧することが可能です。',
  ],
  'Cookie' => [
    'COOKIEの値はサーバーからブラウザ側に保存され、変更・削除ができる',
    '→devToolのApplicationのCookies参照',
    'ブラウザにセットした後でしか使用できない',
    'ブラウザ閉じても有効期限が切れるまでは消えない setcookie(,,期限)',
    '安全性は△（個人情報は含めないこと）',
    'サイズ制限、文字列のみ',
    '（引用）Cookiesとは、ウェブサーバーから貴方のブラウザへ送信・保持される情報です。 Cookiesはその情報を送ったウェブサーバーによってのみ読まれる可能性があります。 Cookiesはプログラムではなく、単独で実行されることはなく、コンピュータウィルスを内包するものでもありません。 当社ウェブサイトのアクセス性・利便性を向上させる目的で、Cookiesを使い、当社ウェブサイトの閲覧状況などの情報を収集する場合があります。このデータは貴方個人を特定・追跡するものではありません。 多くのブラウザは、はじめからCookiesが利用されるように設定されていますが、貴方はCookiesの受け入れに際して警告を表示したり、拒否するようにブラウザの設定を変更することが可能です。',
  ],
  'Session' => [
    'Cookieと違って、サーバー側で値（クライアントの状態）が保持される',
    'cookie使用目的：ブラウザと紐付ける為だけ（PHPSessionIDというNameで保存）',
    'しかし、SessionIDが盗まれる＝セッションハイジャック',
    'session_startでcookieに値をセットした直後から使用できる',
    'sessionを削除したからと言ってcookieは削除されない',
    '通信（HTTP）はユーザを識別できない。識別するためにセッションが必要！',
    'ブラウザを閉じたら消える。一時的に保存したい。',
    'リンク間では表示できる',
    'サイズ制限なし、オブジェクトでもOK',
    '認証情報など',
    '例：会員登録（１セッション＝１ユーザのログインからログアウトまでの行動）',
  ],
  'Get' => [
    '情報（リソース）の取得、検索で使用（ページを表示するだけに使うべき） Read',
    'URLで値が送信される（Query String＝送信後画面検証のNetworkのHTTP通信のRequest参照）',
    '→?message=hello (クエリ文字列）',
    '安全性が低い',
    'べき等',
    'サイズや種類に制限あり',
  ],
  'Post' => [
    '情報の追加・更新・削除（データの処理だとかに使うべき）',
    'URLに埋め込まれないだけであって、ブラウザの機能で値を確認することは一応できる',
    '安全性がやや高い',
    'リクエストのボディにデータが入れられて送られる',
    'Create べき等でない+安全でない  子リソースの作成、リソースへのデータ追加など',
    'サイズや種類に制限なし',
  ],

  'CRSF（Cross Site Rrequest Forgery）' => [
    'WEB利用者が意図しない（別サイトから）、偽造されたリクエストをサーバに送信されてしまう脆弱性。',
    '「<form action="投稿先URL">」と「<input type="hidden" name="ここ">」がわかっていれば攻撃される。',
    '例：twitter：ログイン中、あるツイートのリンクをクリックしたら、意図しないスパムツイートが送信されていた！（スパムツイートを生成するリンク）。',
    '対策：トークンを使った防御。',
    'form送信するときに、sessionを使ってサーバにトークンを保存。ブラウザ側にも保存しておく。アクセスしたブラウザごとにランダムに生成される。',
  ],
  'XSS（cross site Scripting）' => [
    'webページにアクセスすることで、不正なスクリプトが実行される脆弱性。',
    '例：twitter：ログイン中、あるツイートのリンクをクリックしたら、アカウントを乗っ取られてしまった！（不正なスクリプトでCookieを盗まれた）。',
    '対策：エスケープ処理。',
  ],
  '２重送信' => [
    'データを登録する時などに、送信ボタンを連打されたり、何度もリロードされると、多重送信されてしまう。',
    '対策：トークンを使った防御。',
  ],
  'ブルートフォースアタック' => [
    '総当たり攻撃でパスワードを解読する方法。',
    '対策：ログイン失敗の回数ロックをかける。ワンタイムパスワードにする。２要素認証にする。',
  ],
];

include('_header.php');
?>

<section class="contact">
  <h2>Privacy Policy</h2>
  <div style="text-align: left; margin: 30px 20%;">
    <!-- 用語集＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝ -->
    <?php foreach ($scripts as $word => $script) : ?>
      <h3><?= $word; ?> とは</h3>
      <ul>
        <?php if (empty($script)) : ?>
          <li>Nobody!</li>
        <?php else : ?>
          <?php foreach ($script as $name) : ?>
            <li>・<?= h($name); ?></li>
          <?php endforeach; ?>
        <?php endif; ?>
      </ul>
    <?php endforeach; ?>
  </div>

  <a class="backbtn" href="index.php">戻る</a>
  <a class="backbtn" href="https://www.snowrobin.jp/privacypolicy/">引用元</a>
</section>

<?php
include('../../app/_parts/_footer.php');