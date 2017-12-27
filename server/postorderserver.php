<?php
	// session_start();
	// if(!isset($_SESSION["userid"])){
	// 	header('Location: ../php/login.php');
	// 	exit;
	// }

	$dsn = "mysql:dbname=sns;host=localhost;charset=utf8";
	$user = "nise";
	$password = "nise";
	try{
		$error = false;
		$dbh = new PDO($dsn,$user,$password);
		if($_POST["process"] === "order"){	//申込
			$sql = "select * from Reservations where UpID = ?";
			$stmt  = $dbh -> prepare($sql);
			$stmt -> bindValue(1, $_POST["UpID"], PDO::PARAM_INT);
			$stmt -> execute();
			while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
				$sql = "select * from ResDates where ResID = ?";
				$rstmt = $dbh -> prepare($sql);
				$rstmt -> bindValue(1, $row["ResID"], PDO::PARAM_INT);
				$rstmt -> execute();
				while($rrow = $rstmt -> fetch(PDO::FETCH_ASSOC)){
					if($rrow["Reservation"] === $_POST["Reservation"]){//募集日時も分岐に加える（未実装）
						$error = true;
					}
				}
			}
			if($error){ //エラー時の処理
				echo "error";
				exit;
			}
			else{ 		//非エラー時の処理(申込の処理)
				$sql="insert into Reservations(UserID,UpID) values(?,?)";
				$stmt = $dbh -> prepare($sql);
				$stmt -> bindValue(1, $_POST["UserID"],PDO::PARAM_STR);
				$stmt -> bindValue(2, $_POST["UpID"],PDO::PARAM_INT);
				$stmt -> execute();
				$resid = $dbh -> lastInsertId("ResID");

				$sql="insert into ResDates(ResID,Reservation) values(?,?)";
				$stmt = $dbh -> prepare($sql);
				$stmt -> bindValue(1,$resid, PDO::PARAM_INT);
				$stmt -> bindValue(2,$_POST["Reservation"],PDO::PARAM_STR);
				$stmt -> execute();
				echo "success";
				exit;

			}
		}
		
	}catch(PDOException $e){
		$res[] = array("title" => $e);
		echo json_encode($res);

	}
?>