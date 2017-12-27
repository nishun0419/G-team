<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Serch</title>
	<link href="/php/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="/php/css/serch.css">
    <script type="text/javascript" src="/php/js/jquery-3.1.1.min.js"></script>
    <script src="/php/js/bootstrap.min.js"></script>
</head>
<body>
	<?php
		require('navbar.php');
		$process = "serch";
		if(isset($_GET["keyword"]) || $_GET["keyword"] !== ""){
			$param = htmlspecialchars($_GET["keyword"]);
			// for($i = 0; $i < count($_GET["infra"]); $i++){
			// 	$infras[$i] = $_GET["infra"][$i];
			// }
		}
		else{
				$param = null;
		}

		if(isset($_GET["area"]) || $_GET["area"] !== ""){
			$area = htmlspecialchars($_GET["area"]);
		}
		else{
			$area = null;
		}

		if(isset($_GET["infra"]) || $_GET["infra"] !== ""){
			$infras = json_encode($_GET["infra"]);
		}
		else{
			$infras = json_encode([]);
		}
	?>
	<script type="text/javascript">
		var serchparam = '<?php echo $param; ?>';
		var dataprocess = '<?php echo $process; ?>';
		var area = '<?php echo $area; ?>';
		var infras = JSON.parse('<?php echo $infras; ?>');
	</script>
	<div class="container main">
		<div class="row">
			<div class="col-md-4 serchbox">
				<form class="form-horizontal" method="get" action="">
						<div class="col-md-8 sercharea">
							<input type="text" class="form-control" id="paramValue" name="keyword" placeholder="キーワード検索">
							<div>
								<label>エリア</label>
								<select name="area" id="area">
									<option value="" selected>都道府県</option>
									<option value="北海道">北海道</option>
									<option value="青森県">青森県</option>
									<option value="岩手県">岩手県</option>
									<option value="宮城県">宮城県</option>
									<option value="秋田県">秋田県</option>
									<option value="山形県">山形県</option>
									<option value="福島県">福島県</option>
									<option value="茨城県">茨城県</option>
									<option value="栃木県">栃木県</option>
									<option value="群馬県">群馬県</option>
									<option value="埼玉県">埼玉県</option>
									<option value="千葉県">千葉県</option>
									<option value="東京都">東京都</option>
									<option value="神奈川県">神奈川県</option>
									<option value="新潟県">新潟県</option>
									<option value="富山県">富山県</option>
									<option value="石川県">石川県</option>
									<option value="福井県">福井県</option>
									<option value="山梨県">山梨県</option>
									<option value="長野県">長野県</option>
									<option value="岐阜県">岐阜県</option>
									<option value="静岡県">静岡県</option>
									<option value="愛知県">愛知県</option>
									<option value="三重県">三重県</option>
									<option value="滋賀県">滋賀県</option>
									<option value="京都府">京都府</option>
									<option value="大阪府">大阪府</option>
									<option value="兵庫県">兵庫県</option>
									<option value="奈良県">奈良県</option>
									<option value="和歌山県">和歌山県</option>
									<option value="鳥取県">鳥取県</option>
									<option value="島根県">島根県</option>
									<option value="岡山県">岡山県</option>
									<option value="広島県">広島県</option>
									<option value="山口県">山口県</option>
									<option value="徳島県">徳島県</option>
									<option value="香川県">香川県</option>
									<option value="愛媛県">愛媛県</option>
									<option value="高知県">高知県</option>
									<option value="福岡県">福岡県</option>
									<option value="佐賀県">佐賀県</option>
									<option value="長崎県">長崎県</option>
									<option value="熊本県">熊本県</option>
									<option value="大分県">大分県</option>
									<option value="宮崎県">宮崎県</option>
									<option value="鹿児島県">鹿児島県</option>
									<option value="沖縄県">沖縄県</option>
								</select>
							</div>
							<button type="submit" class="btn btn-primary serch">検索</button>
							<div class="row">

								<label>
									<input type="checkbox" name="infra[]" class="infra" value="1">電気あり
								</label>
								<label>
									<input type="checkbox" name="infra[]" class="infra" value="2">水道あり
								</label>
								<label>
									<input type="checkbox" name="infra[]" class="infra" value="3">ガスあり
								</label>
								<label>
									<input type="checkbox" name="infra[]" class="infra" value="4">トイレあり
								</label>
								<label>
									<input type="checkbox" name="infra[]" class="infra" value="5">バリアフリー
								</label>
								<label>
									<input type="checkbox" name="infra[]" class="infra" value="6">ネットあり
								</label>
								<label>
									<input type="checkbox" name="infra[]" class="infra" value="7">駐車場あり
								</label>
								<label>
									<input type="checkbox" name="infra[]" class="infra" value="8">冷暖房あり
								</label>
								<label>
									<input type="checkbox" name="infra[]" class="infra" value="9">飲食OK
								</label>
								<label>
									<input type="checkbox" name="infra[]" class="infra" value="10">火気OK
								</label>
							</div>
						</div>
				</form>
			</div>
			<div class="col-md-8" id="serchResult"></div>
		</div>
	</div>
	<script type="text/javascript" src="/php/js/dispFacility.js"></script>
	<!-- <script type="text/javascript" src="/php/js/firstSerch.js"></script> -->
	<script type="text/javascript" src="/php/js/serchClickEvent.js"></script>
	<script type="text/javascript" src="/php/js/serch.js"></script>
</body>
</html>