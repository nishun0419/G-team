<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>detail</title>
	<link href="/php/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="/php/css/navbar.css">
    <script type="text/javascript" src="/php/js/jquery-3.1.1.min.js"></script>
    <script src="/php/js/bootstrap.min.js"></script>
</head>
<body>
	<?php
		require("navbar.php");
		if(!isset($_SESSION["UserName"])){
		header("Location: login.php");
		exit;
		}
		else{
			$process = "detail";
			$messageid = $_GET["messageid"];
		}
	?>
	<script type="text/javascript">
		var dataprocess = '<?php echo $process; ?>';
		var messageId = '<?php echo $messageid; ?>';
		var userId = null;
	</script>
	<div class="container">
		<div class="row">
			<div id="dispmessage"></div>
		</div>
		<a class="col-md-offset-1" href="mypage.php">戻る</a>
	</div>
	<script type="text/javascript" src="/php/js/dispDetailMessage.js"></script>
	<script type="text/javascript" src="/php/js/getMessage.js"></script>
</body>
</html>