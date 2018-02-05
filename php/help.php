<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="/teamG/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/teamG/css/help.css">
	<link rel="stylesheet" type="text/css" href="/teamG/css/navbar.css">
	<link rel="stylesheet" type="text/css" href="/teamG/css/footer.css">
	<script type="text/javascript" src="/teamG/js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="/teamG/js/bootstrap.min.js"></script>
	<title>ヘルプ</title>
</head>
<body>
	<?php
		require('navbar.php');
	?>
	<div class="container main">
		<div class="row">
			<div class="text-left">
				<h1>ヘルプ</h1>
			</div>
			<div class="col-md-8 col-md-offset-2">
				<div class="text-center help_index">
					<a class="index" href="#help_1">どこから検索できますか?</a>
				</div>
				<div class="text-center help_index">
					<a class="index" href="#help_2">ユーザー情報を変更したいです</a>
				</div>
				<div class="text-center help_index">
					<a class="index" href="#help_3">退会したいです</a>
				</div>
				<div class="text-center help_index">
					<a class="index" href="#help_4">予約の方法がわかりません</a>
				</div>
				<div class="text-center help_index">
					<a class="index" href="#help_5">予約キャンセルのやり方がわかりません</a>
				</div>
				<div class="text-center help_index">
					<a class="index" href="#help_6">貸し出す施設を登録したいです</a>
				</div>
				<div class="row help_main">
					<div class="text-left help_box" id="help_1">
						<h3>どこから検索できますか?
						</h3>
						<div class="text-left help_text">
							ログイン前ならトップページから、ログイン後ならマイページのメニューの検索から検索することができます
						</div>
					</div>
					<div class="text-left help_box" id="help_2">
						<h3>ユーザー情報を変更したいです
						</h3>
						<div class="text-left help_text">
							マイページのメニューのその他からユーザー情報変更をクリックしてください。
						</div>
					</div>
					<div class="text-left help_box" id="help_3">
						<h3>
							退会したいです
						</h3>
						<div class="text-left help_text">
							マイページのメニューのその他から退会をクリックしていただければ退会ページに飛びます。
						</div>
					</div>
					<div class="text-left help_box" id="help_4">
						<h3>
							予約の方法がわかりません
						</h3>
						<div class="text-left help_text">
							予約したい施設の詳細ページの下部にあるカレンダーから、予約したい日付をクリックしてください。
						</div>
					</div>
					<div class="text-left help_box" id="help_5">
						<h3>
							予約キャンセルのやり方がわかりません
						</h3>
						<div class="text-left help_text">
							マイページのメニューの予約一覧をクリックし、予約リストからキャンセルしたい施設を選択後、確認画面から予約取り下げをクリックしてください。
						</div>
					</div>
					<div class="text-left help_box" id="help_6">
						<h3>
							貸し出す施設を登録したいです
						</h3>
						<div class="text-left help_text">
							施設管理者としてログイン後、マイページのメニューの施設登録をクリックしてください。
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
		require('footer.php');
	?> 
	<script type="text/javascript" src="/teamG/js/helpScroll.js"></script>
</body>
</html>