<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="/php/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/php/css/order_finish.css">
	<script type="text/javascript" src="/php/js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="/php/js/bootstrap.min.js"></script>
	<title>申込確認</title>
</head>
<body>
	<?php
		require('navbar.php');
		if(isset($_SESSION["token"])){
			header('Location: /php/index.php');
			exit;
		}
		else{
			$_SESSION["token"] = "access_OK";
		}
	?>
	<div class="text-center ordermessage">
		申込が完了しました。
	</div>
	<div class="text-center">
		<a href="/php/php/mypage.php">マイページに戻る</a>
	</div>
</body>
</html>