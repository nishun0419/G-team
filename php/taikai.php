<DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <link rel="stylesheet" type="text/css" href="/php/css/bootstrap.min.css"> 
    <link rel="stylesheet" type="text/css" href="/php/css/taikai.css"> 
    <script type="text/javascript" src="/php/js/jquery-3.1.1.min.js"></script> 
    <script type="text/javascript" src="/php/js/bootstrap.min.js"></script> 
    <title>申込確認</title> 
</head> 
<body> 
    <?php 
        require('navbar.php'); 
        // echo $_GET["calendar_val"]; 
        if(isset($_SESSION["token"])){ 
            unset($_SESSION["token"]); 
        } 
    ?>
    <div class="container main">
	<div class="text-center">
	<h3 id="taikaiTitle">退会しますか？</h3>
	</div>
	<div class="col-md-6 col-md-offset-3 dropBox">
	<form id="dropout" method="post" action="#">
	<div class="form-group">
		<label for="ID">ID</label>
		<input type="ID" class="form-control" id="inputID" placeholder="IDを入力して下さい。">
	</div>
	<div class="form-group">
		<label for="InputPassword">パスワード</label>
		<input type="password" class="form-control" id="inputPassword" placeholder="パスワードを入力して下さい。">
	</div>
	<div class="col-md-offset-4">
	<button type="submit" class="btn btn-success">退会</button>
	<button type="button" class="btn btn-danger">キャンセル</button>
	</div>
 	</form>
 	</div>
 	</div>

 	
	<script type="text/javascript" src="/php/php/moziseigen.js"></script>
	</body>

</html>