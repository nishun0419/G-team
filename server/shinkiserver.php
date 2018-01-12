<?php
		header("Content-Type:text/html;charset=UTF-8");
		session_start();
		$resMes = "sucess";
		// ざっと入力チェック
		if(trim($_POST['id']) == false){
			$_SESSION['message_Shinki'] = "IDを入力してください";
		}
		elseif(strpos($_POST['id']," ") !== false || strpos($_POST["id"],"　") !== false){
			$_SESSION['message_Shinki'] = "スペースがないidを入力をしてください";
		}
		elseif(preg_match('/[^a-zA-Z0-9]/', $_POST["id"])){
			$_SESSION['message_Shinki'] = "ユーザーIDは半角英数字で入力してください";
		}
		elseif(empty($_POST['family']) || empty($_POST['given']) || empty($_POST['family_kana']) || empty($_POST['given_kana']) ){
			$_SESSION['message_Shinki'] = "名前を入力してください";
		}
		elseif(preg_match('/[^ァ-ヶー]/u', $_POST['family_kana']) || preg_match('/[^ァ-ヶー]/u', $_POST['given_kana']) ){
			$_SESSION['message_Shinki'] = "ふりがなは全角カタカナで入力してください";
		}
		elseif(empty($_POST['password'])){
			$_SESSION['message_Shinki'] = "パスワードを入力してください";
		}
		elseif(preg_match('/[^a-zA-Z0-9]/', $_POST['password'])){
			$_SESSION['message_Shinki'] = "パスワードは半角英数字で入力してください";
		}
		elseif(mb_strlen($_POST['password']) < 8){
			$_SESSION['message_Shinki'] = "パスワードは8桁以上入力してください";
		}
		elseif(empty($_POST['email'])){
			$_SESSION['message_Shinki'] = "メールアドレスを入力してください";
		}
		elseif(empty($_POST['postnum'])){
			$_SESSION['message_Shinki'] = "郵便番号を入力してください";
		}
		elseif(preg_match("/^d{3}-d{4}$/",$_POST['postnum'])){
			$_SESSION['message_Shinki'] = "郵便番号は半角数字と半角ハイフンで入力してください";
		}
		elseif(empty($_POST['address'])){
			$_SESSION['message_Shinki'] = "住所を入力してください";
		}
		elseif(empty($_POST['tel'])){
			$_SESSION['message_Shinki'] = "電話番号を入力してください";
		}
		elseif(preg_match('/[^0-9-]/', $_POST['tel'])){
			$_SESSION['message_Shinki'] = "電話番号は半角数字と半角ハイフンで入力してください";
		}
		elseif(strcmp($_POST['password'],$_POST['re_password']) != 0 ){
			$_SESSION['message_Shinki'] = "パスワードが一致しません";
		}
		elseif(strcmp($_POST['email'],$_POST['re_email']) != 0){
			$_SESSION['message_Shinki'] = "メールアドレスが一致しません";
		}

		if(isset($_SESSION['message_Shinki'])){
			$resMes = "false";
		}
		else{
			// DB接続
			$dsn ="mysql:dbname=teamG;host=localhost;charset=utf8";
			$user = "kobe";
			$password = "denshi";

			try{
				// アカウント作成日カラムに追加する用のdate取得
				$today = getdate();
				$d = $today["mday"];
				$m = $today["mon"];
				$y = $today["year"];

				//　PDOで接続
				$dbh = new PDO($dsn, $user, $password);

				// UserIDダブってないかチェック
				$sql = "select * from Users where UserID = ?";
				$stmt = $dbh -> prepare($sql);
				$stmt -> bindValue(1, htmlspecialchars($_POST['id']),PDO::PARAM_STR);
				$stmt -> execute();
				if(!$stmt -> fetch(PDO::FETCH_ASSOC)){

					// ダブりなければinsert
					$sql = "insert into Users(UserID,FamilyName,FamilyNameKana,GivenName,GivenNameKana,Password,AcountDate,UserPostNum,UserAddress,UserTel,UserMailAddress) values(?,?,?,?,?,?,?,?,?,?,?)";
					$stmt = $dbh -> prepare($sql);
					$stmt -> bindValue(1, htmlspecialchars($_POST['id']), PDO::PARAM_STR);
					$stmt -> bindValue(2, htmlspecialchars($_POST['family']), PDO::PARAM_STR);
					$stmt -> bindValue(3, htmlspecialchars($_POST['family_kana']), PDO::PARAM_STR);
					$stmt -> bindValue(4, htmlspecialchars($_POST['given']), PDO::PARAM_STR);
					$stmt -> bindValue(5, htmlspecialchars($_POST['given_kana']), PDO::PARAM_STR);
					$stmt -> bindValue(6, password_hash(htmlspecialchars($_POST['password']),PASSWORD_DEFAULT), PDO::PARAM_STR);
					$stmt -> bindValue(7, $y.'-'.$m.'-'.$d, PDO::PARAM_STR);
					$stmt -> bindValue(8, htmlspecialchars($_POST['postnum']), PDO::PARAM_STR);
					$stmt -> bindValue(9, htmlspecialchars($_POST['address']), PDO::PARAM_STR);
					//TODO:都道府県プルダウン対応 $stmt -> bindValue(9, htmlspecialchars($_POST['pref'].$_POST['address']), PDO::PARAM_STR);
					$stmt -> bindValue(10, htmlspecialchars($_POST['tel']), PDO::PARAM_STR);
					$stmt -> bindValue(11, htmlspecialchars($_POST['email']), PDO::PARAM_STR);

					$stmt -> execute();

					// セッションにUserNameとUserIDの値を追加
					$_SESSION['UserName'] = serialize(htmlspecialchars($_POST['family'].$_POST['given']));
					$_SESSION['UserID'] = serialize(htmlspecialchars($_POST['id']));
				}
				else{
					// ダブりあった時のエラー
					$_SESSION['message_Shinki'] = "入力したユーザーIDはすでに使われております。";
					$resMes = "false";
				}

				$dbh = null;
			}catch(PDOException $e){
				$_SESSION['message_Shinki'] = $e;
				$resMes = "error";
				echo $resMes;
			}
		}

		if(!isset($_SESSION['message_Shinki'])){
			$resMes = session_name(). '='. session_id();
		}
		else{
			$resMes = $resMes . "\n" .session_name(). '='. session_id();
		}
		echo $resMes;
