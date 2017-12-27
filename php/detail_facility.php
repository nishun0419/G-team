<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>施設詳細</title>
	<link rel="stylesheet" type="text/css" href="/php/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/php/css/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="/php/css/detail_facility.css">
	<script type="text/javascript" src="/php/js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="/php/js/jquery-ui.min.js"></script>

	<script type="text/javascript" src="/php/js/bootstrap.min.js"></script>
</head>
<body>
	<?php
		require('navbar.php');
		$id = $_GET["id"];
	?>
	<script type="text/javascript">
		var serchparam = null;
		var dataprocess = "detail";
		var ident = '<?php echo $id; ?>';
		var userid = null;
	</script>

	<!-- モーダル・ダイアログ -->
	<div class="modal fade" id="orderModal" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span>×</span></button>
					<h4 class="modal-title">予約日</h4>
				</div>
				<div class="modal-body">
					<div class="text-center calendarVal"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
					<form method="POST" action="/php/ordercontroller">
						<input type="hidden" name="upID" id="upID">
						<input type="hidden" name="reservation" id="reservation">
						<input type="hidden" name="process" value="preOrder">
						<button type="submit" class="btn btn-primary">ボタン</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div id="detail_Info"></div>
		</div>
	</div>
	<script type="text/javascript" src="/php/js/Map.js"></script>
	<script type="text/javascript" src="/php/js/dispCalendar.js"></script>
	<script type="text/javascript" src="/php/js/dispDetailFacility.js"></script>
	<script type="text/javascript" src="/php/js/getFacility.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZg9ufeYKKY11pds-r8Y-qkfDQLIN-2fw"></script>
</body>
</html>