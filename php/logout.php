<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>ログアウト</title>
</head>
<body>
	<?php
			session_start();
			if(isset($_SESSION["userid"])){
				$Message = "ログアウトしました。";
			}
			else{
				$Message = "セッションがタイムアウトしました。";
			}

			$_SESSION= array();
			@session_destroy();
	?>
	<h1>ログアウト</h1>
	<div>
		<?php echo htmlspecialchars($Message, ENT_QUOTES); ?>
	</div>
	<a href="../login.html">ログイン画面に戻る</a>
</body>
</html>