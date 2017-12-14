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
	<div id="white_back">
		<div id = price_box>
			￥<span>5000</span>
			<button class="btn btn-primary check">OK</button>
		</div>
	</div>
	<script type="text/javascript">
		var userid = '<?php echo $_POST["userid"] ?>';
		var facilityIdent = '<?php echo $_POST["facilityIdent"] ?>';
	</script>
	<div class="text-center ordermessage">
		申込が完了しました。
	</div>
	<div class="text-center">
		<a href="/php/index.php">トップに戻る</a>
	<script type="text/javascript" src="/php/js/calcPrice.js"></script>
</body>
</html>