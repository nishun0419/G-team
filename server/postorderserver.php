<?php
	// session_start();
	// if(!isset($_SESSION["userid"])){
	// 	header('Location: ../php/login.php');
	// 	exit;
	// }

	$dsn = "mysql:dbname=teamG;host=localhost;charset=utf8";
	$user = "kobe";
	$password = "denshi";
	try{
		$error = false;
		$dbh = new PDO($dsn,$user,$password);
		if($_POST["process"] === "order"){	//申込
			$sql = "select * from Reservations where UpID = ?";
			$stmt  = $dbh -> prepare($sql);
			$stmt -> bindValue(1, htmlspecialchars($_POST["UpID"]), PDO::PARAM_INT);
			$stmt -> execute();
			while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
				$sql = "select * from ResDates where ResID = ?";
				$rstmt = $dbh -> prepare($sql);
				$rstmt -> bindValue(1, $row["ResID"], PDO::PARAM_INT);
				$rstmt -> execute();
				while($rrow = $rstmt -> fetch(PDO::FETCH_ASSOC)){
					if($rrow["Reservation"] === htmlspecialchars($_POST["Reservation"])){//募集日時も分岐に加える（未実装）
						$error = true;
					}
				}
			}
			if($error){ //エラー時の処理
				echo "error";
				exit;
			}
			else{ 		//非エラー時の処理(申込の処理)

				$sql = "select * from Posts where UpID = ?";
				$stmt = $dbh -> prepare($sql);
				$stmt -> bindValue(1, htmlspecialchars($_POST["UpID"]));
				$stmt -> execute();
				$row = $stmt -> fetch(PDO::FETCH_ASSOC);
				$resPrice = $row['Price'];

				$sql="insert into Reservations(UserID,UpID,ResPrice) values(?,?,?)";
				$stmt = $dbh -> prepare($sql);
				$stmt -> bindValue(1, htmlspecialchars($_POST["UserID"]),PDO::PARAM_STR);
				$stmt -> bindValue(2, htmlspecialchars($_POST["UpID"]),PDO::PARAM_INT);
				$stmt -> bindValue(3, $resPrice, PDO::PARAM_INT);
				$stmt -> execute();
				$resid = $dbh -> lastInsertId("ResID");

				$sql="insert into ResDates(ResID,Reservation) values(?,?)";
				$stmt = $dbh -> prepare($sql);
				$stmt -> bindValue(1,$resid, PDO::PARAM_INT);
				$stmt -> bindValue(2,htmlspecialchars($_POST["Reservation"]),PDO::PARAM_STR);
				$stmt -> execute();
				echo "success";
				exit;

			}
		}elseif($_POST["process"] === "order_cancel"){
			$sql = "select * from Reservations where ResID = ? and UserID = ?";
			$stmt = $dbh -> prepare($sql);
			$stmt -> bindValue(1, htmlspecialchars($_POST["ResID"]), PDO::PARAM_STR);
			$stmt -> bindValue(2, htmlspecialchars($_POST["UserID"]), PDO::PARAM_STR);
			$stmt -> execute();
			$row = $stmt -> fetch(PDO::FETCH_ASSOC);
			if($row){
				$sql = "select * from ResDates where ResID = ?";
				$rstmt = $dbh -> prepare($sql);
				$rstmt -> bindValue(1, htmlspecialchars($_POST["ResID"]), PDO::PARAM_STR);
				$rstmt -> execute();
				$rrow = $rstmt -> fetch(PDO::FETCH_ASSOC);
				if($rrow){
					$sql = "delete from Reservations where ResID = ?";
					$stmt = $dbh -> prepare($sql);
					$stmt -> bindValue(1, htmlspecialchars($_POST["ResID"]), PDO::PARAM_STR);
					$stmt -> execute();
					$sql = "delete from ResDates where ResID = ?";
					$stmt = $dbh -> prepare($sql);
					$stmt -> bindValue(1, htmlspecialchars($_POST["ResID"]), PDO::PARAM_STR);
					$stmt -> execute();
					echo "success";
					exit;
				}
				else{
					echo "error";
					exit; //エラーページ遷移
				}
			}
			else{
				echo "error";
				exit; //エラーページ遷移
			}
		}
		
	}catch(PDOException $e){
		$res[] = array("title" => $e);
		echo json_encode($res);

	}
?>