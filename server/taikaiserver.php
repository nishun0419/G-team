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
						//delete
							$sql = "update Users set TaikaiFlag = ? where UserID = ?";
							$rstmt = $dbh -> prepare($sql);
							$rstmt -> bindValue(1, '1',PDO::PARAM_STR);
							$rstmt -> bindValue(2, $row['UserID'],PDO::PARAM_STR);
							$rstmt -> execute();
							//PostsのUpCancelを変える
							$sql = "update Posts set UpCancel=? where UserID = ?";
							$stmt = $dbh -> prepare($sql);
							$stmt -> bindValue(1, '0', PDO::PARAM_STR);
							$stmt -> bindValue(2, $row['UserID'], PDO::PARAM_STR);
							$stmt -> execute();
							//	予約情報を削除
							$sql = "select * from Reservations where UserID = ?";
							$resmt = $dbh -> prepare($sql);
							$resmt -> bindValue(1,$row['UserID'], PDO::PARAM_STR);
							$resmt -> execute();
							while($res = $resmt -> fetch(PDO::FETCH_ASSOC)){
								$sql = " delete from ResDates where ResID = ?";
								$stmt = $dbh -> prepare($sql);
								$stmt -> bindValue(1,$res['ResID'],PDO::PARAM_STR);
								$stmt -> execute(); 
							}
							$sql = "delete from Reservations where UserID = ?";
							$stmt = $dbh -> prepare($sql);
							$stmt -> bindValue(1,$row['UserID'],PDO::PARAM_STR);
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
		// header("Location: /teamG/php/mypage.php");
		exit;