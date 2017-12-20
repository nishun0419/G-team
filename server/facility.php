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
		if($_GET["process"] === "top"){
			$sql = "select * from Posts";
			$stmt=$dbh->prepare($sql);
			$stmt -> execute();
			$res = array();
			while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
				$res[] = array( "UpID" => $row["UpID"],
								"FacName" => $row["FacName"],
								"PostNum" => $row["PostNum"],
								"Address" => $row["Address"],
								"Exposition" => $row["Exposition"],
								"PeopleNum" => $row["PeopleNum"],
								"image" => $row["Image1"]
						);
			}
		}
		else if($_GET["process"] === "detail"){
			$sql = "select * from Posts where UpID = ?";
			$stmt = $dbh -> prepare($sql);
			$stmt -> bindValue(1, $_GET["ident"], PDO::PARAM_STR);
			$stmt -> execute();
			$res = array();
			$row = $stmt -> fetch(PDO::FETCH_ASSOC);
			if($row){
				$sql = "select * from orders where facilityid = ?";
				$stmt = $dbh -> prepare($sql);
				$stmt -> bindValue(1, $row["UpID"], PDO::PARAM_STR);
				$stmt -> execute();
				$index = 0;
				$orderdate = null;
				//画像を配列に格納
				$images[0] = $row["Image1"];
				$images[1] = $row["Image2"];
				$images[2] = $row["Image3"];
				//予約されている日付を格納
				while($frow = $stmt -> fetch(PDO::FETCH_ASSOC)){
					$orderdate[$index] = $frow["orderdate"];
					$index++;
				}

				$res[] = array( "UpID" => $row["UpID"],
								"FacName" => $row["FacName"],
								"PostNum" => $row["PostNum"],
								"Address" => $row["Address"],
								"Exposition" => $row["Exposition"],
								"PeopleNum" => $row["PeopleNum"],
								"images" => $images,
								"Price" => $row["Price"],
								"StartDate" => $row["StartDate"],
								"StopDate" => $row["StopDate"],
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