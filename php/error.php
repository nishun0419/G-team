<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>エラー</title>
	<link rel="stylesheet" type="text/css" href="/php/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/php/css/error.css">
	<link rel="stylesheet" type="text/css" href="/php/css/navbar.css">
	<link rel="stylesheet" type="text/css" href="/php/css/footer.css">
</head>
<body>
	<?php
		require('navbar.php');
	?>
	<div class="container main">
		<div class="text-center">
			<h1>エラー発生</h1>
		</div>
		<div class="text-center">
			正しくない処理を認識しました。<br>
			やり直してください。
		</div>
		<div class="text-center back_button">
			<a href="/php/serchcontroller">戻る</a>
		</div>
	</div>
	<?php
		require('footer.php');
	?> 
</body>
</html>