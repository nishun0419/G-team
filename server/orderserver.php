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
			$sql = "select * from orders where DATE(orderdate) > ? and userid = ? order by orderdate";
			$stmt=$dbh->prepare($sql);
			$date = date('Y-m-d');

			$stmt -> bindValue(2, $_GET["userid"], PDO::PARAM_STR);
			$stmt -> bindParam(1, $date, PDO::PARAM_STR);
			$stmt -> execute();
			$res = array();
			while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
				$sql = "select * from facilitys where ident = ?";
				$fstmt = $dbh -> prepare($sql);
				$fstmt -> bindValue(1, $row["facilityid"], PDO::PARAM_STR);
				$fstmt -> execute();
				while($frow = $fstmt -> fetch(PDO::FETCH_ASSOC)){
				$res[] = array( "ident" => $frow["ident"],
								"facility_name" => $frow["facility_name"],
								"zip" => $frow["zip"],
								"address" => $frow["address"],
								"images" => $frow["images"],
								"orderdate" => $row["orderdate"]
						);
				}
			}
		}
		else if($_GET["process"] === "order_check"){
			$sql = "select * from orders where DATE(orderdate) = ?";
			$stmt = $dbh -> prepare($sql);

			$stmt -> bindValue(1, $_GET["orderdate"], PDO::PARAM_STR);
			$stmt -> execute();
			$row = $stmt -> fetch(PDO::FETCH_ASSOC);
			$res = array();
			if($row){
				$res[] = array("userid" => $row["userid"],
								"facilityid" => $row["facilityid"],
								"orderdate" => $row["orderdate"]
						);
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