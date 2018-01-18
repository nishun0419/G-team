<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>退会処理結果</title>
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
					退会処理が完了致しました。<p>またのご利用をお待ちしております。</p>
				</div>
			</div>
			<div class="col-md-8 col-md-offset-2">
				<button type="button" onclick="location.href='/php/index.php'" class="btn btn-primary center-block">
					<span class="glyphicon glyphicon-home" aria-hidden="true">
						トップに戻る
					</span>
				</button>
			</div>
		</div>
	</div>
</body>
</html>
