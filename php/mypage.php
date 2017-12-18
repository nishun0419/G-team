<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Mypage</title>
	<link href="/php/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="/php/css/navbar.css">
	<link rel="stylesheet" type="text/css" href="/php/css/mypage.css">
    <script type="text/javascript" src="/php/js/jquery-3.1.1.min.js"></script>
    <script src="/php/js/bootstrap.min.js"></script>
</head>
<body>
	<?php
		require('navbar.php');
		// session_start();
		// if(!isset($_SESSION["userid"])){
		// 	header("Location: login.php");
		// 	exit;
		// }
		// else{
		// }
	?>
	<script type="text/javascript">
		var serchparam = null;
		var dataprocess = "mypage";
		var ident = null;
		var userid = '<?php echo unserialize($_SESSION["UserID"]); ?>';
	</script>
	<div class="container">
		<div class="row main">
			<div class="col-md-3">
				メニュー
				<div class="list-group">
					<a class="list-group-item" href="#"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>投稿</a>
					<a class="list-group-item" href="/php/serchcontroller"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>検索</a>
					<a class="list-group-item" href="#"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>予約一覧</a>
					<a class="list-group-item" href="#"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>投稿一覧</a>
				</div>
			</div>
			<div class="col-md-6 hidden-xs">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#orderList" data-toggle="tab">予約リスト</a></li>
					<li><a href="#facilityList" data-toggle="tab">投稿リスト</a></li>
				</ul>

				<div class="tab-content">
					<div class="tab-pane active" id="orderList">
						<p>予約リスト</p>
					</div>
					<div class="tab-pane" id="facilityList">
						<p>投稿リスト</p>
					</div>
				</div>
			</div>
			<div class="col-md-3 box">
				<p>施設の広告?</p>
			</div>
		</div>
	</div>	
	
	 <!-- <script type="text/javascript" src="/php/js/getM.js"></script> -->
	 <script type="text/javascript" src="/php/js/getOrder.js"></script>
	 <script type="text/javascript" src="/php/js/dispMyOrder.js"></script>
	 <script type="text/javascript" src="/php/js/dispMyFacility.js"></script>
	 <script type="text/javascript" src="/php/js/getFacility.js"></script>
	 <script type="text/javascript" src="/php/js/clickEvent.js"></script>
</body>
</html>