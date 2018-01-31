<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="/php/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/php/css/order.css">
	<link rel="stylesheet" type="text/css" href="css/navbar.css">
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
			exit;
		}
		if(isset($_SESSION['flag'])){
			if(unserialize($_SESSION['flag']) === 'owner'){
				header("Location: /php/php/authority_error.php");
				exit;
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
	<div class="container main">
		<div class="row">
			<table class="table table-bordered" id="order_Info">
				<tr>
					<td class="info">施設名</td><td class="td_back"><sapn id="fac_name"></sapn></td>
				</tr>
				<tr>
					<td class="info">住所</td><td class="td_back"><span id="address"></span></td>
				</tr>
				<tr>
					<td class="info">予約日</td><td class="td_back"><span id="order_date"></span></td>
				</tr>
				<tr>
					<td class="info">料金</td><td class="td_back"><span id="price"></span></td>
				</tr>
			</table>
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
	<script type="text/javascript" src="/php/js/separate.js"></script>
	<script type="text/javascript" src="/php/js/dispOrder.js"></script>
	<script type="text/javascript" src="/php/js/getFacility.js"></script>
	<script type="text/javascript" src="/php/js/orderClickEvent.js"></script>
</body>
</html>