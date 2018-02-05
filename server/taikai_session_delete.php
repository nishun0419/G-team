<?php
	session_start();
	$_SESSION= array();
	@session_destroy();
	header("Location: /teamG/logincontroller?process=complete");
	exit;