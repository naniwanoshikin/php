<?php
ini_set('display_errors', true);
require('./functions.php');
require('../dbc.php'); // DB接続



if (!isset($_SESSION['join'])) {
	header('Location: index.php'); // 登録情報を送信しない限り戻される
	exit();
} else {
	$post = $_SESSION['join'];
}

// if (!empty($_POST)) {
// 	$sql = 'INSERT INTO members SET name=?, email=?, password=?, picture=?, created=NOW()
//   ';
// 	$stmt = connect()->prepare($sql); // 準備

// 	echo $stmt->execute(array(
// 		$_SESSION['join']['name'],
// 		$_SESSION['join']['email'],
// 		sha1($_SESSION['join']['password']), // 暗号化
// 		$_SESSION['join']['image'],
// 	));

// 	unset($_SESSION['join']); // sessionをからにする

// 	header('Location: thanks.php');
// 	exit();
// }

?>

<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>会員登録</title>

	<!-- <link rel="stylesheet" href="../style.css" /> -->
</head>

<body>
	<div id="wrap">
		<div id="head">
			<h1>会員登録</h1>
		</div>

		<div id="content">
			<p>下記の内容でよろしいでしょうか？</p>
			<form action="" method="post">
				<!-- この画面でも登録ボタンをクリックしたかどうかを判断できる -->
				<input type="hidden" name="action" value="submit" />
				<dl>
					<dt>ニックネーム</dt>
					<dd><?= h($post['name']); ?></dd>

					<dt>メールアドレス</dt>
					<dd><?= h($post['email']); ?></dd>

					<dt>パスワード</dt>
					<dd>-非表示-</dd>

					<dt>写真など</dt>
					<!-- なぜか表示されない。。。。 -->
					<dd>
						<?php if ($_SESSION['join']['image'] !== '') : ?>
							<img src="../picture/<?= h($_SESSION['join']['image']); ?>">
						<?php endif; ?>
					</dd>
				</dl>

				<div>
					<a href="index.php?action=rewrite">&laquo;&nbsp;修正する</a> | <input type="submit" value="登録" />
				</div>

			</form>
		</div>

	</div>
</body>

</html>