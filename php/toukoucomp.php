<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>投稿処理結果</title>
	<link rel="stylesheet" type="text/css" href="/php/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/php/css/navbar.css">
	<link rel="stylesheet" type="text/css" href="/php/css/taikaicomp.css">
<body>
	<?php
        require('navbar.php');
	?>
    <div class="container main">
    	<div class="row well well-lg">
			<div class="message col-md-8 col-md-offset-2"/>
				<div class="text-center">
					投稿処理が完了致しました。
				</div>
			</div>
			<div class="col-md-8 col-md-offset-2">
				<button type="button" onclick="location.href='/php/php/mypage.php'" class="btn btn-primary center-block">
					<span class="glyphicon glyphicon-home" aria-hidden="true">
						マイページに戻る
					</span>
				</button>
			</div>
		</div>
	</div>
</body>
</html>