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
		if(!isset($_SESSION["UserName"])){
			header("Location: /php/logincontroller?process=order_to_login&url=".urlencode("/php/order.php")."&UpID=".htmlspecialchars($_GET["UpID"])."&Reservation=".htmlspecialchars($_GET["Reservation"]));
		}
		if(isset($_SESSION['flag'])){
			if(unserialize($_SESSION['flag']) === 'owner'){
				header("Location: /php/php/authority_error.php");
			}
		}
	?>
	<script type="text/javascript">
		var serchparam = null;
		var dataprocess = "info_Check";
		var ident = '<?php echo htmlspecialchars($_GET["UpID"]) ?>';
		var calendar_val = '<?php echo htmlspecialchars($_GET["Reservation"]) ?>';
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
					<form method="POST" action="/php/ordercontroller">
						<input type="hidden" id="facilityIdent" name="UpID">
						<input type="hidden" id="userid" name="UserID">
						<input type="hidden" id="date" name="Reservation">
						<input type="hidden" name="process" value="order">
						<button type="button" class="btn cancel"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>キャンセル</button>
						<button type="submit" class="btn btn-primary ok"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>申し込む</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="/php/js/dispOrder.js"></script>
	<script type="text/javascript" src="/php/js/getFacility.js"></script>
	<script type="text/javascript" src="/php/js/orderClickEvent.js"></script>
</body>
</html>