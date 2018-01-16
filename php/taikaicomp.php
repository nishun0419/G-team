<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>退会メッセージ</title>
	<link rel="stylesheet" type="text/css" href="/php/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/php/css/navbar.css">
	<link rel="stylesheet" type="text/css" href="/php/css/taikaicomp.css">
    <script type="text/javascript" src="/php/js/jquery-3.1.1.min.js"></script>
    <script src="/php/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-2.1.0.min.js" type="text/javascript"></script>
</head>
<body>
	<?php
        require('navbar.php');
        // echo $_GET["calendar_val"];
        if(isset($_SESSION["token"])){
            unset($_SESSION["token"]);
        }
    ?>
	<font size="14px" face="ＭＳ 明朝" style="position: absolute; left: 80px; top:200px"/>
	退会処理が完了致しました。<p>またのご利用をお待ちしております。</p>
	</font>
</body>
</html>
