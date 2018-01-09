<?php
			// ini_set('session.use_trans_sid', '1');
			// ini_set('session.cookie_domain', 'localhost');
			// session_set_cookie_params(0,'/logincontroller');
			$resMes = "success";
			// if(trim($_POST["id"]) == false){
			// 	$_SESSION['message_Login'] = "IDを入力してください";
			// }
			// elseif(strpos($_POST["id"]," ") !== false || strpos($_POST["id"],"　") !== false){
			// 	$_SESSION['message_Login'] = "スペースがないidを入力をしてください";
			// }
			// elseif(empty($_POST["password"])){
			// 	$_SESSION['message_Login'] = "パスワードを入力してください";
			// }

			// if(isset($_SESSION['message_Login'])){
			// 	$resMes = "false";
			// }
		//(!isset($_SESSION["userid"]) && !empty($_POST["id"]) && !empty($_POST["password"]))
			
				$dsn ="mysql:dbname=SNS;host=localhost;charset=utf8";
				$user = "nise";
				$password = "nise";
				try{
					$dbh = new PDO($dsn, $user, $password);

					$sql = "select * from Users where UserID = ?";
					$stmt = $dbh -> prepare($sql);
					$stmt -> bindValue(1, htmlspecialchars($_POST['id']),PDO::PARAM_STR);
					$stmt -> execute();
					$row = $stmt -> fetch(PDO::FETCH_ASSOC);
					if($row){
						
						//delete
							$sql = "delete from Users where UserID = ?";
							$stmt = $dbh -> prepare($sql);
							$stmt -> bindValue(1,htmlspecialchars($_POST['id']),PDO::PARAM_STR);
							$flag = $stmt -> execute();
							if($flag){

							}
							else{
								$resMes = "false";
							}
				
					}
					
					else{
						// header("Location: ../php/login.php");
						// exit;
						$resMes = "false";
					}

					$dbh = null;
				}catch(PDOException $e){
					// header("Location: ../php/login.php");
					$resMes =  "error";
					echo $resMes;
					exit;
				}		
		echo $resMes;
		// echo $_SESSION["message_Login"];
		// header("Location: /php/php/mypage.php");
		exit;