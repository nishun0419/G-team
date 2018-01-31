<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="/php/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/php/css/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="/php/css/order_check.css">
	<link rel="stylesheet" type="text/css" href="/php/css/navbar.css">
	<script type="text/javascript" src="/php/js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="/php/js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="/php/js/bootstrap.min.js"></script>
	<script src='/php/js/build/pdfmake.min.js'></script>
 	<script src='/php/js/build/vfs_fonts.js'></script>
	<title>予約状況確認</title>
</head>
<body>
	<?php
		require('navbar.php');
	?>
	<script>
		var serchparam = null;
		var dataprocess = "checkOrder";
		var ident = '<?php echo $_GET["id"]; ?>';
		var userid = null;
		var MyUserName = '<?php echo unserialize($_SESSION["UserName"]) ?>';
	</script>
	
	<div class="container main">
		<div class="row">
			<div class="text-center">
				<h1 id="facility_name"></h1>
			</div>
			<div class="col-md-10 col-md-offset-1" id="calendar"></div>
		</div>
	</div>
	<script type="text/javascript" src="/php/js/getFacility.js"></script>
	<!-- <script type="text/javascript" src="/php/js/dispOrderCheck.js"></script> -->
	<script type="text/javascript" src="/php/js/separate.js"></script>
	<script type="text/javascript" src="/php/js/getPdf.js"></script>
	<script type="text/javascript" src="/php/js/dispPdf.js"></script>
	<script type="text/javascript" src="/php/js/dispOrderCheck.js"></script>
</body>
</html>