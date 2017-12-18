<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="/php/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/php/css/order.css">
	<script type="text/javascript" src="/php/js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="/php/js/bootstrap.min.js"></script>
	<title>申込確認</title>
</head>
<body>
	<?php
		require('navbar.php');
		// echo $_GET["calendar_val"];
		if(isset($_SESSION["token"])){
			unset($_SESSION["token"]);
		}
	?>
	<script type="text/javascript">
		var serchparam = null;
		var dataprocess = "order";
		var ident = '<?php echo $_GET["id"] ?>';
		var calendar_val = '<?php echo $_GET["calendar_val"] ?>';
		var userid = '<?php echo unserialize($_SESSION["UserID"]) ?>';
	</script>
	<div class="container">
		<div class="row">
			<div id="order_Info"></div>
		</div>
		<div class="row">
			<div class="text-center ordermessage">
				上記の内容で申し込みますがよろしいですか?
			</div>
			<div class="col-md-10 col-md-offset-1 button_group">
				<div class="col-md-6 col-md-offset-4">
					<form method="POST" action="/php/php/order_finish.php">
						<input type="hidden" id="facilityIdent">
						<input type="hidden" id="userid">
						<button class="btn btn-primary cancel">キャンセル</button>
						<button type="submit" class="btn btn-primary ok">申し込む</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="/php/js/dispOrder.js"></script>
	<script type="text/javascript" src="/php/js/getFacility.js"></script>
</body>
</html>