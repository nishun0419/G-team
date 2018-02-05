<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>ユーザー情報変更</title>
	<link rel="stylesheet" type="text/css" href="/teamG/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/teamG/css/navbar.css">
	<link rel="stylesheet" type="text/css" href="/teamG/css/sinki.css">
    <script type="text/javascript" src="/teamG/js/jquery-3.1.1.min.js"></script>
    <script src="/teamG/js/bootstrap.min.js"></script>
<!--     <script src="//code.jquery.com/jquery-2.1.0.min.js" type="text/javascript"></script>
    <script src="/ajaxzip2/prototype.js"></script>
	<script src="ajaxzip2/ajaxzip2.js" charset="UTF-8"></script> -->
</head>
<body>
	<?php
		require('navbar.php');

		if(!isset($_SESSION['UserName']) && isset($_SESSION['message_UEdit'])){
			header("Location: /teamG/logincontroller");
			exit;
		}

	?>
	<div class="container">
		<div class="text-center">
		<h3>ユーザー情報変更</h3></div>
			<?php 
				if(isset($_SESSION['message_UEdit'])) {
					print $_SESSION['message_UEdit'];
					unset($_SESSION['message_UEdit']);
					echo "<br><a href='/teamG/php/UserEdit.php'>ユーザー情報変更に戻る</a>";
				}else{
					echo "ユーザ情報が変更されました。";
					echo "<br><a href='/teamG/php/mypage.php'>マイページに戻る</a>";
				}
			?>
		</div>
	</div>
</body>
</html>
