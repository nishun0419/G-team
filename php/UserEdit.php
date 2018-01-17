<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>ユーザー情報変更</title>
	<link rel="stylesheet" type="text/css" href="/php/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/php/css/navbar.css">
	<link rel="stylesheet" type="text/css" href="/php/css/sinki.css">
    <script type="text/javascript" src="/php/js/jquery-3.1.1.min.js"></script>
    <script src="/php/js/bootstrap.min.js"></script>
    <script src="/php/js/PassWordCheck.js"></script>
<!--     <script src="//code.jquery.com/jquery-2.1.0.min.js" type="text/javascript"></script>
    <script src="/ajaxzip2/prototype.js"></script>
	<script src="ajaxzip2/ajaxzip2.js" charset="UTF-8"></script> -->
</head>
<body>
	<?php
		require('navbar.php');

		if(!isset($_SESSION['UserName'])){
			header("Location: /php/logincontroller");
			exit;
		}
		if(isset($_SESSION['message_Shinki'])) {
			print $_SESSION['message_Shinki'];
			unset($_SESSION['message_Shinki']);
		}
	?>
	<script type="text/javascript">
		var userid = '<?php echo unserialize($_SESSION["UserID"]) ?>';
	</script>
	<div class="container">
		<div class="text-center"><h3>ユーザー情報変更</h3></div>
		<div class="col-md-8 col-md-offset-2">
			<form id="form1" class="form-horizontal" role="form" method="POST" action="/php/shinkicontroller">
				<div class="panel panel-primary">
					<div class="panel-heading">
						ユーザー情報変更
					</div>
					<div class="panel-body">
						<div class="form-group">
							<label for="FamilyName" class="col-md-4 control-label">姓</label>
							<div class="col-md-6">
								<input id="FamilyName" type="text" class="form-control" name="FamilyName" value="" required placeholder="姓" autofocus>
							</div>
						</div>
						<div class="form-group">
							<label for="GivenName" class="col-md-4 control-label">名</label>
							<div class="col-md-6">
								<input id="GivenName" type="text" class="form-control" name="GivenName" value="" required placeholder="名">
							</div>
						</div>
						<div class="form-group">
							<label for="FamilyNameKana" class="col-md-4 control-label">姓(全角カナ)</label>
							<div class="col-md-6">
								<input id="FamilyNameKana" type="text" class="form-control" name="FamilyNameKana" pattern="[\u30A1-\u30F6]*" title="全角カナで入力してください。" required value="" placeholder="性(全角カナ)">
							</div>
						</div>
						<div class="form-group">
							<label for="GivenNameKana" class="col-md-4 control-label">名(全角カナ)</label>
							<div class="col-md-6">
								<input id="GivenNameKana" type="text" class="form-control" name="GivenNameKana" pattern="[\u30A1-\u30F6]*" title="全角カナで入力してください。" required value="" placeholder="名(全角カナ)">
							</div>
						</div>
						<div class="form-group">
							<label for="UserID" class="col-md-4 control-label">ユーザーID</label>
							<div class="col-md-6">
								<input id="UserID" type="text" class="form-control" name="UserID" pattern="^[0-9A-Za-z]+$" title="半角英数字で入力してください。" required value="" placeholder="ユーザーID（半角英数字）で入力">
							</div>
						</div>
						<div class="form-group">
							<label for="Usertel" class="col-md-4 control-label">電話番号</label>
							<div class="col-md-6">
								<input id="Usertel" type="text" class="form-control" name="Usertel" pattern="\d{2,4}-\d{3,4}-\d{3,4}"  title="全角になっていないかハイフン(-)が入っているかもう一度確認してください。" required value="" placeholder="000-0000-0000">
							</div>
						</div>
						<div class="form-group">
							<label for="UserMailAdress" class="col-md-4 control-label">メールアドレス</label>
							<div class="col-md-6">
								<input id="UserMailAdress" type="email" class="form-control" name="UserMailAdress" required value="" placeholder="メールアドレスの入力">
							</div>
						</div>
						<div class="form-group">
							<label for="UserPostNum" class="col-md-4 control-label">郵便番号</label>
							<div class="col-md-6">
								<input id="UserPostNum" type="text" class="form-control" name="UserPostNum" pattern="\d{3}-\d{4}" title="全角になっていないかハイフン(-)が入っているかもう一度確認してください。" required value="" placeholder="000-0000">
							</div>
						</div>
						<div class="form-group">
							<label for="UserAdress" class="col-md-4 control-label">住所</label>
							<div class="col-md-6">
							<div class="select-box">
								<select name="UserAdress" id="UserAdress" required>
									<option value="" selected>都道府県</option>
									<option value="北海道">北海道</option>
									<option value="青森県">青森県</option>
									<option value="岩手県">岩手県</option>
									<option value="宮城県">宮城県</option>
									<option value="秋田県">秋田県</option>
									<option value="山形県">山形県</option>
									<option value="福島県">福島県</option>
									<option value="茨城県">茨城県</option>
									<option value="栃木県">栃木県</option>
									<option value="群馬県">群馬県</option>
									<option value="埼玉県">埼玉県</option>
									<option value="千葉県">千葉県</option>
									<option value="東京都">東京都</option>
									<option value="神奈川県">神奈川県</option>
									<option value="新潟県">新潟県</option>
									<option value="富山県">富山県</option>
									<option value="石川県">石川県</option>
									<option value="福井県">福井県</option>
									<option value="山梨県">山梨県</option>
									<option value="長野県">長野県</option>
									<option value="岐阜県">岐阜県</option>
									<option value="静岡県">静岡県</option>
									<option value="愛知県">愛知県</option>
									<option value="三重県">三重県</option>
									<option value="滋賀県">滋賀県</option>
									<option value="京都府">京都府</option>
									<option value="大阪府">大阪府</option>
									<option value="兵庫県">兵庫県</option>
									<option value="奈良県">奈良県</option>
									<option value="和歌山県">和歌山県</option>
									<option value="鳥取県">鳥取県</option>
									<option value="島根県">島根県</option>
									<option value="岡山県">岡山県</option>
									<option value="広島県">広島県</option>
									<option value="山口県">山口県</option>
									<option value="徳島県">徳島県</option>
									<option value="香川県">香川県</option>
									<option value="愛媛県">愛媛県</option>
									<option value="高知県">高知県</option>
									<option value="福岡県">福岡県</option>
									<option value="佐賀県">佐賀県</option>
									<option value="長崎県">長崎県</option>
									<option value="熊本県">熊本県</option>
									<option value="大分県">大分県</option>
									<option value="宮崎県">宮崎県</option>
									<option value="鹿児島県">鹿児島県</option>
									<option value="沖縄県">沖縄県</option>
								</select>
							</div>
							</div>
						</div>
						<div class="form-group">
							<label for="UserAdress2" class="col-md-4 control-label"></label>
								<div class="col-md-6">
									<input id="UserAdress2" type="text" class="form-control" name="UserAdress2" required placeholder="市町村区～番地">
								</div>
						</div>
						<div class="form-group">
							<label for="UserAdress3" class="col-md-4 control-label"></label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="UserAdress3" placeholder="建物名～号室">
								</div>
						</div>
						<div class="form-group">
							<div class="col-md-8 col-md-offset-4">
								<input type="hidden" name="process" value="createUser">
								<button type="submit" class="btn btn-primary" aria-label="Left Align">
								<span class="glyphicon glyphicon-ok-circle" aria-hidden="true">
								更新 
								</span>
								</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
		</div>
	</div>
	<script type="text/javascript" src="/php/js/getUserEdit.js"></script>
</body>
</html>
