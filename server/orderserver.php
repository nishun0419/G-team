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
			$sql = "select * from orders where userid = ?";
			$stmt=$dbh->prepare($sql);
			$stmt -> bindValue(1, $_GET["userid"], PDO::PARAM_STR);
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
								"images" => $frow["images"]
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