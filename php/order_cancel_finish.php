<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="/teamG/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/teamG/css/order_cancel_finish.css">
	<link rel="stylesheet" type="text/css" href="/teamG/css/navbar.css">
	<link rel="stylesheet" type="text/css" href="/teamG/css/footer.css">
	<script type="text/javascript" src="/teamG/js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="/teamG/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/teamG/js/footerFixed.js"></script>
	<title>キャンセル完了画面</title>
</head>
<body>
	<?php
		require('navbar.php');
	?>
<div class="container main">
    <div class="row well well-lg">
		<div class="message col-md-8 col-md-offset-2"/>	
			<div class="text-center">
				キャンセルが完了しました。
			<div class="col-md-8 col-md-offset-2">
				<button type="button" onclick="location.href='/teamG/php/mypage.php'" class="btn btn-primary center-block">
					<span class="glyphicon glyphicon-ok-sign" aria-hidden="true">
						マイページに戻る
					</span>	
				</button>
			</div>
		</div>
	</div>	
</div>
</div>
<?php 
	require('footer.php');
?>
	
</body>
</html>