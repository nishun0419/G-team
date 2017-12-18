<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
	<title>ログイン</title>
	<link rel="stylesheet" type="text/css" href="/php/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/php/css/navbar.css">
    <script type="text/javascript" src="/php/js/jquery-3.1.1.min.js"></script>
    <script src="/php/js/bootstrap.min.js"></script>
</head>
<body>
	<?php
		require('navbar.php');
		if(isset($_SESSION['message_Shinki'])) {
			print $_SESSION['message_Shinki'];
			unset($_SESSION['message_Shinki']);
		}	 	
	?>
	<div class="container">
		<div class="text-center"><h3>新規登録</h3></div>
		<div class="col-md-8 col-md-offset-2">
			<?php
			if(isset($_SESSION['message_Login'])){
				print "<span class='help-block'><strong>". $_SESSION['message_Login']. "</strong></span>";
				unset($_SESSION['message_Login']);
			}
			?>
			<form class="form-horizontal" role="form" method="POST" action="/php/shinkicontroller">
				<div class="panel panel-primary">
					<div class="panel-heading">
						新規登録
					</div>
					<div class="panel-body">
						<div class="form-group">
							<label for="id" class="col-md-4 control-label">ユーザーID</label>
							<div class="col-md-6">
								<input id="id" type="text" class="form-control" name="id" required autofocus>
							</div>
						</div>
						<div class="form-group">
							<label for="password" class="col-md-4 control-label">パスワード</label>
							<div class="col-md-6">
								<input id="password" type="password" class="form-control" name="password">
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-8 col-md-offset-4">
								<input type="hidden" name="process" value="createUser">
								<button type="submit" class="btn btn-primary">
								登録
								</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</body>
</html>