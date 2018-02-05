<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Mypage</title>
	<link href="/teamG/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="/teamG/css/navbar.css">
	<link rel="stylesheet" type="text/css" href="/teamG/css/footer.css">
	<link rel="stylesheet" type="text/css" href="/teamG/css/mypage.css">
    <script type="text/javascript" src="/teamG/js/jquery-3.1.1.min.js"></script>
    <script src="/teamG/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/teamG/js/footerFixed.js"></script>
</head>
<body>
	<?php
		require('navbar.php');
		// session_start();
		if(!isset($_SESSION["UserName"])){
			header("Location: /teamG/logincontroller");
			exit;
		}
		else{
		}
	?>
	<script type="text/javascript">
		var serchparam = null;
		var dataprocess = "mypage";
		var ident = null;
		var userid = '<?php echo unserialize($_SESSION["UserID"]); ?>';
	</script>
	<div class="container">
		<div class="row main">
			<div class="col-md-3 hidden-xs">
				メニュー
				<div class="list-group">
					<?php
						if(unserialize($_SESSION['flag']) === 'owner'){
							print '<a class="list-group-item" href="/teamG/php/my_facility_list.php"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>登録施設一覧<span class="badge" id="fac_list_count"></span></a>';
							print'<a class="list-group-item" href="/teamG/php/toukou.php"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>施設登録</a>';
						}
						else{
							print '<a class="list-group-item" href="/teamG/php/my_order_list.php"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>予約一覧<span class="badge" id="order_list_count"></span></a>';
						}

					?>
					<a class="list-group-item" href="/teamG/serchcontroller"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>検索</a>
					<!-- <a class="list-group-item" href="/teamG/php/my_order_list.php"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>予約一覧</a>
					<a class="list-group-item" href="/teamG/logincontroller?process=taikaiForm"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>退会</a> -->
					<a class="list-group-item" href="/teamG/php/my_other.php"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>その他</a>
				</div>
			</div>
			<div class="col-md-6">
				<div id="facilityList facilityList_other"></div>
				<div id="orderList">
					<a href="/teamG/php/mypage.php" class="back_mymenu visible-xs-inline-block">
						メニューに戻る
					</a>
					<p>予約リスト</p>
				</div>
			</div>
			<div class="col-md-3 box">
				<p>施設の広告?</p>
			</div>
		</div>
	</div>	

	<?php
		require('footer.php');
	?> 
	
	 <!-- <script type="text/javascript" src="/teamG/js/getM.js"></script> -->
	 <script type="text/javascript" src="/teamG/js/separate.js"></script>
	 <script type="text/javascript" src="/teamG/js/dispMyFacility.js"></script>
	 <script type="text/javascript" src="/teamG/js/getFacility.js"></script>
	 <script type="text/javascript" src="/teamG/js/getOrder.js"></script>
	 <script type="text/javascript" src="/teamG/js/dispMyOrder.js"></script>
	 <script type="text/javascript" src="/teamG/js/clickEvent.js"></script>
</body>
</html>