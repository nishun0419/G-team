<?php
$dsn ="mysql:dbname=teamG;host=localhost;charset=utf8";
$user = "kobe";
$password = "denshi";
try{
	$dbh = new PDO($dsn, $user, $password);
	$sql = "select * from Users where UserID = ?";
	$stmt = $dbh -> prepare($sql);
	$stmt -> bindValue(1, htmlspecialchars($_GET['userid']),PDO::PARAM_STR);
	$stmt -> execute();
	$row = $stmt -> fetch(PDO::FETCH_ASSOC);
	$res = array();
	if($row){
		$res[] = array( "FamilyName" => $row["FamilyName"],
						"GivenName" => $row["GivenName"],
						"FamilyNameKana" => $row["FamilyNameKana"],
						"GivenNameKana" => $row["GivenNameKana"],
						"UserPostNum" => $row["UserPostNum"],
						"UserCity" => $row["UserCity"],
						"UserPref" => $row["UserPref"],
						"UserTel" => $row["UserTel"],
						"UserMailAddress" => $row["UserMailAddress"],
						"UserAddress" => $row["UserAddress"] 
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