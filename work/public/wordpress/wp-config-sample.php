<?php
/**
 * WordPress の基本設定
 *
 * このファイルは、インストール時に wp-config.php 作成ウィザードが利用します。
 * ウィザードを介さずにこのファイルを "wp-config.php" という名前でコピーして
 * 直接編集して値を入力してもかまいません。
 *
 * このファイルは、以下の設定を含みます。
 *
 * * MySQL 設定
 * * 秘密鍵
 * * データベーステーブル接頭辞
 * * ABSPATH
 *
 * @link https://ja.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// 注意:
// Windows の "メモ帳" でこのファイルを編集しないでください !
// 問題なく使えるテキストエディタ
// (http://wpdocs.osdn.jp/%E7%94%A8%E8%AA%9E%E9%9B%86#.E3.83.86.E3.82.AD.E3.82.B9.E3.83.88.E3.82.A8.E3.83.87.E3.82.A3.E3.82.BF 参照)
// を使用し、必ず UTF-8 の BOM なし (UTF-8N) で保存してください。

// ** MySQL 設定 - この情報はホスティング先から入手してください。 ** //
/** WordPress のためのデータベース名 */
define( 'DB_NAME', 'dbname' );

/** MySQL データベースのユーザー名 */
define( 'DB_USER', 'dbuser' );

/** MySQL データベースのパスワード */
define( 'DB_PASSWORD', 'dbpass' );

/** MySQL のホスト名 */
define( 'DB_HOST', 'localhost' );

/** データベースのテーブルを作成する際のデータベースの文字セット */
define( 'DB_CHARSET', 'utf8' );

/** データベースの照合順序 (ほとんどの場合変更する必要はありません) */
define( 'DB_COLLATE', '' );

/**#@+
 * 認証用ユニークキー
 *
 * それぞれを異なるユニーク (一意) な文字列に変更してください。
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org の秘密鍵サービス} で自動生成することもできます。
 * 後でいつでも変更して、既存のすべての cookie を無効にできます。これにより、すべてのユーザーを強制的に再ログインさせることになります。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'bx22ScW[KzoW:UTj>dHY9ied|mHd@tyPe-l&R0(*E,qk3Kc?praGJgo~qZ0Ut6bD');
define('SECURE_AUTH_KEY',  'uHd{+Eo-k-uiZ{h~cs2|g/y<lP]4iW A+3<D+l4;!cC7Lh;]n[02=HNH||om(([I');
define('LOGGED_IN_KEY',    '{NWuL}pTU^Y:],AK#rEC-`e([-|k JMBJm_c0~&g.rt=fthMIR:P:b6]nC;H^[E[');
define('NONCE_KEY',        '|48y~w5`sDF5RZIVol({W{6o!<mgY!V]`LH{|3zK+fNz!0x- 0J _1luO%~0/I(p');
define('AUTH_SALT',        'Gt~AK|VI+QO^bg>7r5XCY(ZMG> hTIeaE<QBvF_i]KeyJ&N#/O1sokOcyIMB^f<R');
define('SECURE_AUTH_SALT', '6nk`Q!h&V*6{@-1`[/b(-_|QC8M^=flmnTy-2/k|rN-_-x 3k.c_R^v/BIR<6Bjn');
define('LOGGED_IN_SALT',   'd=@lKG&8qrBd`076Y1bg|-+Fz qP6T-h@}P+]]CNn8=LNs;*4i>M!r80MroDWp^8');
define('NONCE_SALT',       'j9R^8kOinLW3%A#O45*X[UR`-xTz6oby#V7Uzj6;kv/s+dFN:Y;F#qC5rekvhW]7');

/**#@-*/

/**
 * WordPress データベーステーブルの接頭辞
 *
 * それぞれにユニーク (一意) な接頭辞を与えることで一つのデータベースに複数の WordPress を
 * インストールすることができます。半角英数字と下線のみを使用してください。
 */
$table_prefix = 'wp_';

/**
 * 開発者へ: WordPress デバッグモード
 *
 * この値を true にすると、開発中に注意 (notice) を表示します。
 * テーマおよびプラグインの開発者には、その開発環境においてこの WP_DEBUG を使用することを強く推奨します。
 *
 * その他のデバッグに利用できる定数についてはドキュメンテーションをご覧ください。
 *
 * @link https://ja.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* 編集が必要なのはここまでです ! WordPress でのパブリッシングをお楽しみください。 */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
