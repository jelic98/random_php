<?php
	require("autoload.php");

	check_params(["name", "code"], "GET");

	$api_key = get_api_key();
	$name = strip($_GET["name"]);
	$code = strip($_GET["code"]);
	
	$cmd = "INSERT INTO licenses (name, code) VALUES('$name', '$code')";
	mysqli_query($connect, $cmd);

	echo "License successfully added";
?>
