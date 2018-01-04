<?php
	// $sessionname = session_name();
	$resMes;
	if(isset($_GET["sessionId"])){
		session_id($_GET["sessionId"]);
	}
	session_start();
	if(!isset($_SESSION["UserID"])){
		$resMes = "false";
	}
	else{
		$resMes = "sucess";
	}

	echo $resMes;