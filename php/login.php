<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>ログイン</title>
	<link rel="stylesheet" type="text/css" href="/php/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/php/css/navbar.css">
	<script type="text/javascript" src="/php/js/jquery-3.1.1.min.js"></script>
	<script src="/php/js/bootstrap.min.js"></script>
</head>
<body>
	<?php
	require('navbar.php');
	if(isset($_SESSION['userid'])){
		header("Location: /php/logincontroller?process=autoLogin&sessionId=".session_id());
		exit;
	}
	?>
	<div class="container">
		<div class="text-center"><h3>ログイン</h3></div>
		<div class="col-md-8 col-md-offset-2">
			<?php
			if(isset($_SESSION['message_Login'])){
				print "<span class='help-block'><strong>". $_SESSION['message_Login']. "</strong></span>";
				unset($_SESSION['message_Login']);
			}
			?>
			<form class="form-horizontal" role="form" method="POST" action="/php/logincontroller">
				<div class="panel panel-primary">
					<div class="panel-heading">
						ログイン
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
							<input type="hidden" name="process" value="login">
							<div class="col-md-8 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									ログイン
								</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
</body>
</html>