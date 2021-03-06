<!DOCTYPE html>
<html lang="ja">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="/teamG/css/index.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/navbar.css">
	<link rel="stylesheet" type="text/css" href="/teamG/css/footer.css">
	<link href="/teamG/css/animate.css" rel="stylesheet">
	<script type="text/javascript" src="/teamG/js/jquery-3.1.1.min.js"></script>
	<script src="/teamG/js/jquery.lettering.js"></script>
	<script src="/teamG/js/jquery.textillate.js"></script>
	<script type="text/javascript" src="/teamG/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/teamG/js/snowfall.jquery.js"></script>
	<title>Title</title>
</head>
<body>
	<div id="animation_back">
		<div class="text-center animationtext animationtext1">施設を利用したい</div>
		<div class="text-center animationtext animationtext2">施設を利用してもらいたい</div>
		<img src="/teamG/image/batsu.png" alt="" class="xImage">
		<div class="text-center animationtext animationtext3">二つの気持ちをマッチング</div>
	</div>
	<?php
		require('php/navbar.php');
		if(isset($_SESSION["visit"]) || isset($_SESSION["UserName"])){
			$visitFlag = true;
		}
		else{
			$visitFlag = null;
			$_SESSION["visit"] = "visit";
		}
	?>
	<script type="text/javascript">
		var visitflag="<?php echo $visitFlag; ?>"; 
	</script>
	<div id="titletop">
		<img class="img-responsive center-block" src="/teamG/image/chinook-top-image.png">
		<div class="container">
			<div class="row">
				<div class="col-md-4 firstInfo">
					<div class="row">
						<img class="imgbox center-block" src="/teamG/image/firstInfo1.jpg"></img>
					</div>
					<div class="text-center">
						<h3>使い方は簡単</h3>
					</div>
					<div class="text-center">
						電話無しでネットだけで施設の予約が出来ます。
						施設をお持ちの方も簡単に施設の貸し出しが出来ます。
					</div>
				</div>
				<div class="col-md-4 firstInfo">
					<div class="row">
						<img class="imgbox center-block" src="/teamG/image/firstInfo2.jpg"></img>
					</div>
					<div class="text-center">
						<h3>いつでも、どこでも</h3>
					</div>
					<div class="text-center">
						スマートフォンに対応しており。外出先、急な用事が出来た場合
						でも予約をすることが出来ます。
					</div>
				</div>
				<div class="col-md-4 firstInfo">
					<div class="row">
						<img class="imgbox center-block" src="/teamG/image/firstInfo3.jpg"></img>
					</div>
					<div class="text-center">
						<h3>お小遣い稼ぎに</h3>
					</div>
					<div class="text-center">
						勉強会の参加費、施設レンタル費等で、お金が入り、お小遣い
						稼ぎになります。
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container titlesecond">
		<div class="row">
			<div class="serch_box col-md-10 col-md-offset-1">
				<form class="form-inline text-center" role="form" method="get" action="/teamG/serchcontroller">
					<div class="text-center">
						<h3>施設検索</h3>
					</div>
					<div class="form-group">
						<label for="keyword" class="control-label">キーワード</label>
						<div class="">
							<input type="text" class="formtext form-control" name="keyword" id="keyword">
						</div>
					</div>
					<div class="form-group">
						<label for="area" class="control-label">エリア</label>
						<div class="">
							<select name="area" class="form-control">
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
					</div>
					<div class="form-group">
						<div class="">
							<input type="hidden" name="process" value="serch">
							<input type="hidden" name="minwidth" value="">
							<input type="hidden" name="maxwidth" value="">
							<input type="hidden" name="infra" value="">
							<button type="submit" class="btn index_serch" aria-label="Left Align"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>検索</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="container titlethird">
		<div class="row">
			<div class="text-left">
				<h2>Chinookでは全国のあらゆる空き施設を検索できます</h2>
			</div>
			<div class="col-md-4 secondInfo">
				<img class="img-responsive secondInfoImg" src="/teamG/image/hall_l.jpg">
				<div class="text-left">
					<h3>A施設</h3>
				</div>
				<div class="text-left">
					兵庫県神戸市中央区北野町１−１−8
				</div>
			</div>
			<div class="col-md-4 secondInfo">
				<img class="img-responsive secondInfoImg" src="/teamG/image/secondInfo1.jpg">
				<div class="text-left">
					<h3>B施設</h3>
				</div>
				<div class="text-left">
					東京都墨田区押上１-１−２
				</div>
			</div>
			<div class="col-md-4 secondInfo">
				<img class="img-responsive secondInfoImg" src="/teamG/image/secondInfo2.jpg">
				<div class="text-left">
					<h3>C施設</h3>
				</div>
				<div class="text-left">
					大阪府大阪市阿倍野区阿倍野筋１-１−４３
				</div>
			</div>
		</div>
	</div>
	<?php
		require('php/footer.php');
	?> 
	<script type="text/javascript" src="/teamG/js/snowfall.js"></script>
	<script type="text/javascript" src="/teamG/js/texteffect.js"></script>
	<script type="text/javascript" src="/teamG/js/indexScrollAnimation.js"></script>
</body>
</html>