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
		// 施設検索トップ画面
		if($_GET["process"] === "top"){
			$sql = "select * from facilitys";
			$stmt=$dbh->prepare($sql);
			$stmt -> execute();
			$res = array();
			while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
				$res[] = array( "ident" => $row["ident"],
								"facility_name" => $row["facility_name"],
								"zip" => $row["zip"],
								"address" => $row["address"],
								"message" => $row["message"],
								"capacity" => $row["capacity"],
								"images" => $row["images"]
						);
			}
		}
		// 施設検索詳細画面
		else if($_GET["process"] === "detail"){
			$sql = "select * from facilitys where ident = ?";
			$stmt = $dbh -> prepare($sql);
			$stmt -> bindValue(1, $_GET["ident"], PDO::PARAM_STR);
			$stmt -> execute();
			$res = array();
			$row = $stmt -> fetch(PDO::FETCH_ASSOC);
			if($row){
				$sql = "select * from orders where facilityid = ?";
				$stmt = $dbh -> prepare($sql);
				$stmt -> bindValue(1, $row["ident"], PDO::PARAM_STR);
				$stmt -> execute();
				$index = 0;
				$orderdate = null;
				while($frow = $stmt -> fetch(PDO::FETCH_ASSOC)){
					$orderdate[$index] = $frow["orderdate"];
					$index++;
				}

				$res[] = array( "ident" => $row["ident"],
								"facility_name" => $row["facility_name"],
								"zip" => $row["zip"],
								"address" => $row["address"],
								"message" => $row["message"],
								"capacity" => $row["capacity"],
								"images" => $row["images"],
								"price" => $row["price"],
								"orderdate" => $orderdate
						);
			}
		}
		else if($_GET["process"] === "mypage"){
			$sql = "select * from facilitys where userid = ?";
			$stmt = $dbh -> prepare($sql);
			$stmt -> bindValue(1, $_GET["userid"], PDO::PARAM_STR);
			$res = array();
			$stmt -> execute();

			while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
				$res[] = array("facility_name" => $row["facility_name"],
							   "zip" => $row["zip"],
							   "address" => $row["address"],
							   "images" => $row["images"],
							   "ident" =>  $row["ident"]
						);
			}

		}

		else if($_GET["process"] === "checkOrder"){
			$sql = "select * from facilitys where ident = ?";
			$stmt = $dbh -> prepare($sql);
			$stmt -> bindValue(1, $_GET["ident"], PDO::PARAM_STR);
			$res = array();
			$stmt -> execute();
			$row = $stmt -> fetch(PDO::FETCH_ASSOC);
			if($row){
				$sql = "select * from orders where facilityid = ?";
				$stmt = $dbh -> prepare($sql);
				$stmt -> bindValue(1, $row["ident"], PDO::PARAM_STR);
				$stmt -> execute();
				$index = 0;
				$orderdate = null; 
				while($orow = $stmt -> fetch(PDO::FETCH_ASSOC)){
					$orderdate[$index] = $orow["orderdate"];
					$index++;
				}
				$res[] = array("facility_name" => $row["facility_name"],
								"orderdate" => $orderdate
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