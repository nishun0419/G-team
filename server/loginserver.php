<?php
			// ini_set('session.use_trans_sid', '1');
			// ini_set('session.cookie_domain', 'localhost');
			// session_set_cookie_params(0,'/logincontroller');
			session_start();
			$resMes = "success";
			if(trim($_POST["id"]) == false){
				$_SESSION['message_Login'] = "IDを入力してください";
			}
			elseif(strpos($_POST["id"]," ") !== false || strpos($_POST["id"],"　") !== false){
				$_SESSION['message_Login'] = "スペースがないidを入力をしてください";
			}
			elseif(empty($_POST["password"])){
				$_SESSION['message_Login'] = "パスワードを入力してください";
			}

			if(isset($_SESSION['message_Login'])){
				$resMes = "false";
			}
		else//(!isset($_SESSION["userid"]) && !empty($_POST["id"]) && !empty($_POST["password"]))
			{
				$dsn ="mysql:dbname=teamG;host=localhost;charset=utf8";
				$user = "kobe";
				$password = "denshi";
				try{
					$dbh = new PDO($dsn, $user, $password);

					$sql = "select * from Users where UserID = ?";
					$stmt = $dbh -> prepare($sql);
					$stmt -> bindValue(1, htmlspecialchars($_POST['id']),PDO::PARAM_STR);
					$stmt -> execute();
					$row = $stmt -> fetch(PDO::FETCH_ASSOC);
					if($row){
						if(password_verify(htmlspecialchars($_POST['password']),$row['Password'])){
							$_SESSION['UserName'] = serialize($row['FamilyName'].$row['GivenName']);
							$_SESSION['UserID'] = serialize($row['UserID']);
							if($_POST["flag"] === "owner"){
								$_SESSION['flag'] = serialize("owner");
							}
							else{
								$_SESSION['flag'] = serialize("customer");
							}
							// $_SESSION['password'] = serialize($row['password']);
						}
						else{
							$_SESSION['message_Login'] = "パスワードが違います";
							// header("Location: ../php/login.php");
							// exit;
							$resMes = "false";
						}
					}
					else{
						$_SESSION['message_Login'] = "ユーザーIDが違います";
						// header("Location: ../php/login.php");
						// exit;
						$resMes = "false";
					}

					$dbh = null;
				}catch(PDOException $e){
					$_SESSION["message_Login"] = $e;
					// header("Location: ../php/login.php");
					$resMes =  "error";
					echo $resMes;
					exit;
				}		
		}
		if(!isset($_SESSION["message_Login"])){
			$resMes = session_name(). '='. session_id();
		}
		else{
				if(isset($_POST["process"])){
					$_SESSION['UserName'] = serialize($_POST['username']);
					$_SESSION['UserID'] = serialize($_POST['userid']);
					$_SESSION['flag'] = serialize($_POST['flag']);
				}
		$resMes = $resMes . "\n" .session_name(). '='. session_id();
		}
		echo $resMes;
		// echo $_SESSION["message_Login"];
		// header("Location: /php/php/mypage.php");
		// exit;

