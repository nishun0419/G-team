<!DOCTYPE html>
<html lang="ja">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="/php/css/index.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	 <link rel="stylesheet" type="text/css" href="css/navbar.css">
	<link href="/php/css/animate.css" rel="stylesheet">
	<script type="text/javascript" src="/php/js/jquery-3.1.1.min.js"></script>
	<script src="/php/js/jquery.lettering.js"></script>
	<script src="/php/js/jquery.textillate.js"></script>
	<script type="text/javascript" src="/php/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/php/js/lib/greensock/TweenMax.min.js"></script>
　　　	<script type="text/javascript" src="/php/js/scrollmagic/uncompressed/ScrollMagic.js"></script>
　　　	<script type="text/javascript" src="/php/js/scrollmagic/uncompressed/plugins/animation.gsap.js"></script>
	<script type="text/javascript" src="/php/js/scrollmagic/uncompressed/plugins/animation.velocity.js"></script>
	<script type="text/javascript" src="/php/js/scrollmagic/uncompressed/plugins/debug.addIndicators.js"></script>
	<script type="text/javascript" src="/php/js/snowfall.jquery.js"></script>
	<title>Titlee</title>
	<script type="text/javascript">
		var controller = new ScrollMagic.Controller({
			globalSceneOptions: {
			triggerHook: 'onLeave'
			}
		});
	</script>
</head>
<body>
	<div id="animation_back">
		<div class="text-center animationtext animationtext1">施設を利用したい</div>
		<div class="text-center animationtext animationtext2">施設を利用してもらいたい</div>
		<img src="/php/image/batsu.png" alt="" class="xImage">
		<div class="text-center animationtext animationtext3">二つの気持ちをマッチング</div>
	</div>
	<?php
		require('php/navbar.php');
		if(isset($_SESSION["userid"])){
			header("Location: /php/serchcontroller");
			exit;
		}
	?>
	<div id="titletop">
		<div class="container">
			<div class="row titleName">
				<!-- <div class="text-center centerTitle"> -->
					<!-- <h1>テキスト</h1> -->
					<img src="/php/image/chinook.png" class="center-block logoCenter">
				<!-- </div> -->
			</div>
			<div class="row">
				<div class="col-md-6 serchbox vertical-center">
					<form class="form-horizontal" role="form" method="get" action="/php/serchcontroller">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<div class="text-center">
									<h3>施設検索</h3>
								</div>
							</div>
							<div class="panel-body">
								<div class="form-group">
									<label for="keyword" class="col-md-4 control-label">キーワード</label>
									<div class="col-md-6">
										<input type="text" class="formtext" name="keyword" id="keyword">
									</div>
								</div>
								<div class="form-group">
									<label for="area" class="col-md-4 control-label">エリア</label>
									<div class="col-md-6">
										<select name="area" id="area" class="formtext">
											<option value="#">選択肢1</option>
											<option value="#">選択肢2</option>
											<option value="#">選択肢3</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-8 col-md-offset-4">
										<input type="hidden" name="process" value="serch">
										<button type="submit" class="btn btn-primary" aria-label="Left Align"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>検索</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="col-md-6 serchbox">
					<form class="form-horizontal" role="form" method="get" action="/php/logincontroller">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<div class="text-center">
									<h3>利用者ログイン</h3>
								</div>
							</div>
							<div class="panel-body">
								<div class="form-group">
									<label for="id" class="col-md-4 control-label">ユーザーID</label>
									<div class="col-md-6">
										<input type="text" name="id" id="id">
									</div>
								</div>
								<div class="form-group">
									<label for="password" class="col-md-4 control-label">パスワード</label>
									<div class="col-md-6">
										<input type="password" name="password" id="password">
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-8 col-md-offset-4">
										<input type="hidden" name="process" value="login">
										<button type="submit" class="btn btn-primary">ログイン</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
<!-- 		<form method="post" action="hack/login.hh">
			<div id="account">
				<h3>利用者ログイン</h3>
				<div id="id">
					<label>ID</label><br>
					<input type="text" class="formtext" name="id" id="idin">
				</div>
				<div id="pass">
					<label>Password</label><br>
					<input type="password" class="formtext" name="pass" id="password">
				</div>
				<div id="logbutton">
					<input type="button" id="login" value="ログイン" class="submit"><br>
				</div>
				<a href="Shinki.html" id="sinki">新規登録はここから</a>
			</div>
		</form>
	</div> -->
			</div>
		</div>
	</div>
	<div id="trigger1"></div>
	<div class="container titlesecond">
		<div class="row">
			<div class="col-md-4">
				<div class="row">
					<div class="col-md-6 col-md-offset-3 imgbox"></div>
				</div>
				<div class="text-center">
					<h3>使い方は簡単</h3>
				</div>
				<div class="text-center">
					電話無しでネットだけで施設の予約が出来ます。
					施設をお持ちの方も簡単に施設の貸し出しが出来ます。
				</div>
			</div>
			<div class="col-md-4">
				<div class="row">
					<div class="col-md-6 col-md-offset-3 imgbox"></div>
				</div>
				<div class="text-center">
					<h3>いつでも、どこでも</h3>
				</div>
				<div class="text-center">
					スマートフォンに対応しており。外出先、急な用事が出来た場合
					でも予約をすることが出来ます。
				</div>
			</div>
			<div class="col-md-4">
				<div class="row">
					<div class="col-md-6 imgbox col-md-offset-3"></div>
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

<!-- <script>

 var secne = new ScrollMagic.Scene({triggerElement:"#trigger1"})
 					.setTween(TweenMax.to(".titlesecond" , 1 ,{opacity: 1}))
 					.addIndicators()
 					.addTo(controller);
</script> -->
<script type="text/javascript" src="/php/js/snowfall.js"></script>
<script type="text/javascript" src="/php/js/texteffect.js"></script>
</body>
</html>