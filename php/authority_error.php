<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>エラー</title>
	<link rel="stylesheet" type="text/css" href="/php/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/php/css/error.css">
</head>
<body>
	<?php
		require('navbar.php');
	?>
	<div class="container main">
		<div class="text-center">
			<h1>予約できませんでした</h1>
		</div>
		<div class="text-center">
			施設管理者が施設を予約することはできません。施設利用者としてログインしてやり直してください。
		</div>
		<div class="text-center back_button">
			<a href="/php/server/logout.php">ログアウト</a>
		</div>
	</div>
</body>
</html>