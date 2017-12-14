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
			$sql = "select * from messagebords where userid=?";
			$stmt=$dbh->prepare($sql);
			$stmt -> bindValue(1, $_GET["id"],PDO::PARAM_STR);
			$stmt -> execute();
			$res = array();
			while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
				$res[] = array("title" => $row["title"],
								"message" => $row["message"],
								"posttime" => $row["posttime"],
								"messageid" => $row["messageid"]
						);
			}
		}else if($_GET["process"] === "detail"){
			$sql = "select * from messagebords where messageid = ?";
			$stmt = $dbh -> prepare($sql);
			$stmt -> bindValue(1, $_GET["messageid"], PDO::PARAM_STR);
			$stmt -> execute();
			$res = array();
			while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
		 		$res[] = array("title" => $row["title"],
		 						"message" => $row["message"],
		 						"posttime" => $row["posttime"]
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