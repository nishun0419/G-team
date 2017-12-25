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
		$dbh = new PDO($dsn,$user,$password);
		if($_GET["process"] === "mypage"){ //マイページ表示用
			$sql = "select * from Reservations where UserID = ?";
			$stmt=$dbh->prepare($sql);
			$stmt -> bindValue(1, $_GET["userid"], PDO::PARAM_STR);
			$stmt -> execute();
			$res = array();
			while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){ //予約日取得
				$sql = "select * from ResDates where ResID = ? and DATE(Reservation) >= ?";
				$date = date("Y-m-d");
				$fstmt = $dbh -> prepare($sql);
				$fstmt -> bindValue(1, $row["ResID"], PDO::PARAM_INT);
				$fstmt -> bindValue(2, $date, PDO::PARAM_STR);
				$fstmt -> execute();
				while($rrow = $fstmt -> fetch(PDO::FETCH_ASSOC)){ //施設情報取得
					$sql = "select * from Posts where UpID = ?";
					$rstmt = $dbh -> prepare($sql);
					$rstmt -> bindValue(1, $row["UpID"], PDO::PARAM_INT);
					$rstmt -> execute();
					while($frow = $rstmt -> fetch(PDO::FETCH_ASSOC)){ 
						$res[] = array( "ident" => $frow["UpID"],
										"FacName" => $frow["FacName"],
										"PostNum" => $frow["PostNum"],
										"Address" => $frow["Address"],
										"Image" => $frow["Image1"],
										"orderdate" => $rrow["Reservation"]
						);
					}
				}
			}
		}
		else if($_GET["process"] === "order_check"){
			$sql = "select * from orders where DATE(orderdate) = ? and facilityid = ?";
			$stmt = $dbh -> prepare($sql);

			$stmt -> bindValue(1, $_GET["orderdate"], PDO::PARAM_STR);
			$stmt -> bindValue(2, $_GET["facilityid"], PDO::PARAM_STR);
			$stmt -> execute();
			$row = $stmt -> fetch(PDO::FETCH_ASSOC);
			$res = array();
			if($row){
				$sql = "select * from Users where UserID = ?";
				$stmt = $dbh -> prepare($sql);

				$stmt -> bindValue(1, $row["userid"], PDO::PARAM_STR);
				$stmt -> execute();
				$urow = $stmt -> fetch(PDO::FETCH_ASSOC);
				if($urow){
				$res[] = array("FamilyName" => $urow["FamilyName"],
								"GivenName" => $urow["GivenName"],
								"FamilyNameKana" => $urow["FamilyNameKana"],
								"GivenNameKana" => $urow["GivenNameKana"],
								"UserPostNum" => $urow["UserPostNum"],
								"UserAddress" => $urow["UserAddress"],
								"UserTel" => $urow["UserTel"],
								"orderdate" => $row["orderdate"]
						);
				}
			}
		}
		header("Access-Control-Allow-Origin:*");
		header("Content-Type: application/json");
		echo json_encode($res);
		exit;
	}catch(PDOException $e){
		$res[] = array("title" => $e);
		echo json_encode($res);

	}
?>