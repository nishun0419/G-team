<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="/teamG/css/bootstrap.min.css"> 
    <link rel="stylesheet" type="text/css" href="/teamG/css/taikai.css"> 
    <link rel="stylesheet" type="text/css" href="/teamG/css/navbar.css">
    <link rel="stylesheet" type="text/css" href="/teamG/css/footer.css">
    <script type="text/javascript" src="/teamG/js/jquery-3.1.1.min.js"></script> 
    <script type="text/javascript" src="/teamG/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/teamG/js/footerFixed.js"></script>
    <title>退会画面</title> 
</head> 
<body> 
    <?php 
        require('navbar.php'); 
        
           
    ?>
    <div class="container main">
	<div class="text-center">
	<h3 id="taikaiTitle">退会しますか？</h3>
	</div>
	<div class="col-md-6 col-md-offset-3 dropBox">
	<?php
			if(isset($_SESSION['message_Login'])){
				print "<span class='help-block'><strong>". $_SESSION['message_Login']. "</strong></span>";
				unset($_SESSION['message_Login']);
			}
			?>
	<form id="dropout" method="post" action="/teamG/logincontroller">
	<div class="form-group">
		<label for="ID">ID</label>
		<input type="text" class="form-control" id="inputID" name="id" placeholder="IDを入力して下さい。">
	</div>
	<div class="form-group">
		<label for="InputPassword">パスワード</label>
		<input type="password" class="form-control" id="inputPassword" name="password" placeholder="パスワードを入力して下さい。">
	</div>
	<div class="col-md-offset-4">
		<input type="hidden" name="process" value="taikaiCheck">
		<input type="hidden" name="flag" value="<?php echo unserialize($_SESSION['flag']) ?>">
		<input type="hidden" name="userid" value="<?php echo unserialize($_SESSION['UserID']) ?>">
		<input type="hidden" name="username" value="<?php echo unserialize($_SESSION['UserName']) ?>">
	<button type="submit" class="btn btn-success">退会</button>
	<button type="button" class="btn btn-danger" onClick="location.href='/teamG/php/mypage.php'">キャンセル</button>
	</div>
 	</form>
 	</div>
 	</div>

 	
	<!-- <script type="text/javascript" src="/teamG/php/moziseigen.js"></script> -->
	<?php 
		require('footer.php');
	?>
	</body>

</html>