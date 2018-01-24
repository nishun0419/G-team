<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="/php/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/php/css/withdrawal.css">
	<script type="text/javascript" src="/php/js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="/php/js/bootstrap.min.js"></script>
	<title>登録取り下げ完了画面</title>
</head>
<body>
	<?php
		require('navbar.php');
	?>
<div class="container main">
    <div class="row well well-lg">
		<div class="message col-md-8 col-md-offset-2"/>	
			<div class="text-center">
				登録取り下げが完了しました。
			<div class="col-md-8 col-md-offset-2">
				<button type="button" onclick="location.href='/php/php/mypage.php'" class="btn btn-primary center-block">
					<span class="glyphicon glyphicon-ok-sign" aria-hidden="true">
						マイページに戻る
					</span>	
				</button>
			</div>
		</div>
	</div>	
</div>
	
</body>
</html>