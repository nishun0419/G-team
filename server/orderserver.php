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
		if($_GET["process"] === "mypage"){
			$sql = "select * from orders where DATE(orderdate) >= ? and userid = ? order by orderdate";
			$stmt=$dbh->prepare($sql);
			$date = date('Y-m-d');

			$stmt -> bindParam(1, $date, PDO::PARAM_STR);
			$stmt -> bindValue(2, $_GET["userid"], PDO::PARAM_STR);
			$stmt -> execute();
			$res = array();
			while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
				$sql = "select * from Posts where UpID = ?";
				$fstmt = $dbh -> prepare($sql);
				$fstmt -> bindValue(1, $row["facilityid"], PDO::PARAM_STR);
				$fstmt -> execute();
				while($frow = $fstmt -> fetch(PDO::FETCH_ASSOC)){
				$res[] = array( "ident" => $frow["UpID"],
								"FacName" => $frow["FacName"],
								"PostNum" => $frow["PostNum"],
								"Address" => $frow["Address"],
								"Image" => $frow["Image1"],
								"orderdate" => $row["orderdate"]
						);
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