<?php
require('./functions.php');
require('../dbc.php'); // DBへの2重登録防止用

// header用
define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/8_Login/join/check.php');


// form送信された時のみ（ページ表示時はバリデーションを表示しない）
if (!empty($_POST)) {
	if ($_POST['name'] === '') {
		$error['name'] = 'blank';
	}
	if ($_POST['email'] === '') {
		$error['email'] = 'blank';
	}
	if (strlen($_POST['password']) <= 4) { // blankの前に先に書かないとうまくバリデーション表示されなかった
		$error['password'] = 'length';
	}
	if ($_POST['password'] === '') {
		$error['password'] = 'blank';
	}
	// 拡張子
	$filename = $_FILES['image']['name']; // ファイル名
	if (!empty($filename)) { // アップロードした場合、
		$ext = substr($filename, -4); // 切り取った拡張子
		if ($ext != 'jpeg') {
			$error['image'] = 'type';
		}
	}

	// 	// アカウントの重複チェック
	// 	if (empty($error)) {
	// 		$sql = 'SELECT COUNT(*) AS cnt FROM members WHERE email=?';
	// 		$member = connect()->prepare($sql); // 準備
	// 		$member->execute(array(
	// 			$_POST['email'],
	// 		));
	// 		$record = $member->fetch(); // 取り出し 0 1 で返す
	// 		if ($record['cnt'] > 0) {
	// 			$error['email'] = 'duplicate';
	// 		}
	// 	}

	if (empty($error)) {
		// uploadするファイル名
		$image = date('YmdHis') . $_FILES['image']['name'];
		move_uploaded_file($_FILES['image']['tmp_name'], '../picture/' . $image);

		$_SESSION['join'] = $_POST; // 入力内容をここに保管
		$_SESSION['join']['image'] = $image; // ここでファイルに保管
		header('Location: ' . SITE_URL);
		exit();
	}
}

// 書き直しで入力情報を残す（URL に?writeついていたら）
if ($_REQUEST['action'] == 'rewrite' && isset($_SESSION['join'])) {
	$_POST = $_SESSION['join']; // 復元
}

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
			<p>次のフォームに必要事項をご記入ください。</p>

			<form action="" method="post" enctype="multipart/form-data">
				<dl>
					<dt>ニックネーム<span class="required">必須</span></dt>
					<dd>
						<input type="text" name="name" size="35" maxlength="255" value="<?= h($_POST['name']); ?>" />
						<?php if ($error['name'] === 'blank') : ?>
							<p class="error">名前を入力してください</p>
						<?php endif; ?>
					</dd>

					<dt>メールアドレス<span class="required">必須</span></dt>
					<dd>
						<input type="text" name="email" size="35" maxlength="255" value="<?= h($_POST['email']); ?>" />
						<?php if ($error['email'] === 'blank') : ?>
							<p class="error">emailを入力してください</p>
						<?php endif; ?>
						<?php if ($error['email'] === 'duplicate') : ?>
							<p class="error">指定されたemailは登録されています</p>
						<?php endif; ?>

					<dt>パスワード<span class="required">必須</span></dt>
					<dd>
						<input type="password" name="password" size="10" maxlength="20" value="<?= h($_POST['password']); ?>" />
						<?php if ($error['password'] === 'blank') : ?>
							<p class="error">パスワードを入力してください</p>
						<?php endif; ?>
						<?php if ($error['password'] === 'length') : ?>
							<p class="error">４文字以上で入力してください</p>
						<?php endif; ?>
					</dd>

					<dt>写真など</dt>
					<dd>
						<input type="file" name="image" size="35" value="test" />
						<?php if ($error['image'] === 'type') : ?>
							<p class="error">正しい画像形式を指定してください</p>
						<?php endif; ?>

						<!-- 画像は再読み込みできない -->
						<?php if (!empty($error)) : ?>
							<p class="error">恐れ入りますが、もう一度選択をお願いします</p>
						<?php endif; ?>
					</dd>

				</dl>

				<div><input type="submit" value="入力内容を確認する" /></div>

			</form>
		</div>
</body>

</html>