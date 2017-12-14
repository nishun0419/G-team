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
		$sql = "select * from facilitys where ident = ?";
		$stmt = $dbh -> preapre($sql);
		$stmt -> bindValue(1, $_POST["facilityIdent"], PDO::PARAM_STR);
		$res = array();
		$stmt -> execute();
		while($facilityrow = $stmt -> fetch(PDO::FETCH_ASSOC)){
			$sql = "select * from user where userid = ?";
			$stmt = $dbh -> prepare($sql);
			$stmt -> bindValue(1, $_POST["userid"], PDO::PARAM_STR)
			$stmt -> execute();
			while($userrow = $stmt -> fetch(PDO::FETCH_ASSOC)){
				$res[] = array("userPrice" => $userrow["price"],
								"facilityPrice" => $facilityrow["price"]
						);
				$sql = "update user price = ? where userid = ?";
				$stmt = $dbh -> prepare($sql);
				$hasprice = (int)$userrow["price"] - (int)$facilityrow["price"];
				$stmt -> bindValue(1, $hasprice, PDO::PARAM_INT);
				$stmt -> bindValue(2, $userrow["userid"], PDO::PARAM_STR);
				$stmt -> execute();
			}
		}
		header("Access-Control-Allow-Origin:*");
		header("Content-Type: application/json");
		echo json_encode($res);
	}catch(PDOException $e){
		$res[] = array("title" => $e);
		echo json_encode($res);
	}