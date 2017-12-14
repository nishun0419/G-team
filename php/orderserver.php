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
			$sql = "select * from orders";
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
		header("Access-Control-Allow-Origin:*");
		header("Content-Type: application/json");
		echo json_encode($res);
		exit;
	}catch(PDOException $e){
		$res[] = array("title" => $e);
		echo json_encode($res);

	}
?>