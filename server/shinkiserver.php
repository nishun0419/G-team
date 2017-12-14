<?php
		session_start();
		$resMes = "sucess";
		if(trim($_POST["id"]) == false){
			$_SESSION['message_Shinki'] = "IDを入力してください";
		}
		elseif(strpos($_POST["id"]," ") !== false || strpos($_POST["id"],"　") !== false){
			$_SESSION['message_Shinki'] = "スペースがないidを入力をしてください";
		}
		elseif(empty($_POST["password"])){
			$_SESSION['message_Shinki'] = "パスワードを入力してください";
		}

		if(isset($_SESSION['message_Shinki'])){
			$resMes = "false";
		}
		else{
			$dsn ="mysql:dbname=sns;host=localhost;charset=utf8";
			$user = "nise";
			$password = "nise";
			try{
				$dbh = new PDO($dsn, $user, $password);

				$sql = "select * from user where userid = ?";
				$stmt = $dbh -> prepare($sql);
				$stmt -> bindValue(1, htmlspecialchars($_POST['id']),PDO::PARAM_STR);
				$stmt -> execute();
				if(!$stmt -> fetch(PDO::FETCH_ASSOC)){
					$sql = "insert into user(userid, password, price) values(?,?,?)";
					$stmt = $dbh -> prepare($sql);
					$stmt -> bindValue(1, htmlspecialchars($_POST['id']), PDO::PARAM_STR);
					$stmt -> bindValue(2, password_hash(htmlspecialchars($_POST['password']),PASSWORD_DEFAULT), PDO::PARAM_STR);
					$stmt -> bindValue(3, 5000, PDO::PARAM_INT);
					$stmt -> execute();
					$_SESSION["userid"] = serialize(htmlspecialchars($_POST["id"]));
					// $_SESSION["password"] = htmlspecialchars($_POST["password"]);
					// unset($_SESSION["message_Shinki"]);
					// header("Location: ../php/mypage.php");
					// exit;
				}
				else{
					$_SESSION['message_Shinki'] = "入力したユーザーIDはすでに使われております。";
					// header("Location: ../php/shinki.php");
					$resMes = "false";
				}

				$dbh = null;
			}catch(PDOException $e){
				$_SESSION['message_Shinki'] = $e;
				$resMes = "error";
				echo $resMes;
			}
		}

		if(!isset($_SESSION["message_Shinki"])){
			$resMes = session_name(). '='. session_id();
		}
		else{
			$resMes = $resMes . "\n" .session_name(). '='. session_id();
		}
		echo $resMes;
