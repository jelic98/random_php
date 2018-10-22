<?php
	session_start();

	$debug = false;

	if(!strcmp($_SERVER['HTTP_HOST'], "localhost")) {
		$debug = true;
	}

	ini_set("display_errors", $debug ? "on" : "off");

	if($debug) {
		$db_host = "localhost";
		$db_name = "error_reporter";
		$db_username = "root";
		$db_password = "root";
	}else {
		$db_host = ".";
		$db_name = ".";
		$db_username = ".";
		$db_password = ".";
	}

	require("connect.php");
	require("functions.php");
?>
