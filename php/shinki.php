<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
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
			<form class="form-horizontal" role="form" method="POST"　action="/php/shinkicontroller">
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
							<label for="first" class="col-md-4 control-label">姓(漢字)</label>
							<div class="col-md-6">
								<input id="first" type="text" class="form-control" name="first"　required>
							</div>
						</div>
						<div class="form-group">
							<label for="given" class="col-md-4 control-label">名(漢字)</label>
							<div class="col-md-6">
								<input id="given" type="text" class="form-control" name="given"　required>
							</div>
						</div>
						<div class="form-group">
							<label for="first_kana" class="col-md-4 control-label">姓(カタカナ)</label>
							<div class="col-md-6">
								<input id="first_kana" type="text" class="form-control" name="first_kana"　required>
							</div>
						</div>
						<div class="form-group">
							<label for="given_kana" class="col-md-4 control-label">名(カタカナ)</label>
							<div class="col-md-6">
								<input id="given_kana" type="text" class="form-control" name="given_kana"　required>
							</div>
						</div>
						<div class="form-group">
							<label for="password" class="col-md-4 control-label">パスワード</label>
							<div class="col-md-6">
								<input id="password" type="password" class="form-control" name="password"　required>
							</div>
						</div>
						<div class="form-group">
							<label for="re_password" class="col-md-4 control-label">パスワード再確認</label>
							<div class="col-md-6">
								<input id="re_password" type="password" class="form-control" name="re_password"　required>
							</div>
						</div>
						<div class="form-group">
							<label for="postnum" class="col-md-4 control-label">郵便番号</label>
							<div class="col-md-6">
								<input id="postnum" type="text" class="form-control" name="postnum"　required>
							</div>
						</div>
						<div class="form-group">
							<label for="address" class="col-md-4 control-label">住所</label>
							<div class="col-md-6">
								<input id="address" type="text" class="form-control" name="address"　required>
							</div>
						</div>
						<div class="form-group">
							<label for="tel" class="col-md-4 control-label">電話番号</label>
							<div class="col-md-6">
								<input id="tel" type="text" class="form-control" name="tel"　required>
							</div>
						</div>
						<div class="form-group">
							<label for="email" class="col-md-4 control-label">メールアドレス</label>
							<div class="col-md-6">
								<input id="email" type="email" class="form-control" name="email"　required>
							</div>
						</div>
						<div class="form-group">
							<label for="re_email" class="col-md-4 control-label">メールアドレス再確認</label>
							<div class="col-md-6">
								<input id="re_email" type="email" class="form-control" name="re_email"　required>
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