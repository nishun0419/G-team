<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>エラー</title>
	<link rel="stylesheet" type="text/css" href="/teamG/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/teamG/css/navbar.css">
	<link rel="stylesheet" type="text/css" href="/teamG/css/footer.css">
	<link rel="stylesheet" type="text/css" href="/teamG/css/error.css">
	<script type="text/javascript" src="/teamG/js/jquery-3.1.1.min.js"></script>
	<script src="/teamG/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/teamG/js/footerFixed.js"></script>
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
			<a href="/teamG/server/logout.php">ログアウト</a>
		</div>
	</div>
	<?php
		require('footer.php');
	?> 
</body>
</html>