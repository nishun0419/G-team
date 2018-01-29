<!DOCTYPE html>
<html lang = "ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>予約確認</title>
<link rel="stylesheet" type="text/css" href="/php/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/php/css/order_detail.css">
<script type="text/javascript" src="/php/js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="/php/js/bootstrap.min.js"></script>
</head>
<body>
	<?php
		require('navbar.php');
	?>
	<script>
		var ResID = '<?php echo htmlspecialchars($_GET["ResID"]) ?>';
		var UserID = '<?php echo unserialize($_SESSION["UserID"]) ?>';
	</script>
	<div class="modal fade" id="order_cancel" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span>×</span></button>
				<h4 class="modal-title">予約取り下げ</h4>
			</div>
			<div class="modal-body">
				予約を取り下げます。よろしいですか？
			</div>
			<div class="modal-footer">
				<form method="post" action="/php/ordercontroller">
					<button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
					<input type="hidden" name="process" value="order_cancel">
					<input type="hidden" name="resID" value="<?php echo htmlspecialchars($_GET['ResID']) ?>">
					<input type="hidden" name="userid" value="<?php echo unserialize($_SESSION['UserID']) ?>">
					<button type="submit" class="btn btn-primary">取り下げ</button>
				</form>
			</div>
		</div>
	</div>
	</div>
	<div class="container main">
		<div class="row">
			<div class="text-center">
				<h2>予約確認</h2>
			</div>
			<table class="table table-bordered">
				<tr>
					<td>施設名</td><td><div class="text-center"><span id="fac_name">??</span></div></td>
				</tr>
				<tr>
				<td>住所</td><td><div class="text-center"><span id="fac_address">??</span></div></td>
				</tr>
				<tr>
					<td>料金</td><td><div class="text-center"><span id="fac_price">??</span></div></td>
				</tr>
				<tr>
					<td>予約日</td><td><div class="text-center"><span id="fac_order">??</span></div></td>
				</tr>
				<tr>
					<td>予約者名</td><td><div class="text-center"><span id="user_name"><?php echo unserialize($_SESSION["UserName"]); ?></span></div></td>
				</tr>
			</table>
			<div class="text-center">
				上記内容で予約をしています。
			</div>

		</div>
		<div class="col-md-4 col-md-offset-4 button_group">
			<button type="button" class="button order_cancel_button">予約取り下げ</button>
			<button type="button" class="button go_mypage">マイページに戻る</button>
		</div> 
	</div>
	<script type="text/javascript" src="/php/js/separate.js"></script>
	<script type="text/javascript" src="/php/js/getOrder_detail.js"></script>
	<script type="text/javascript" src="/php/js/order_detail_ClickEvent.js"></script>
</body>
</html>
