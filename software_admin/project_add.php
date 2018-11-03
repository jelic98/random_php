<?php
	require("autoload.php");

	check_params(["name", "api_key"], "GET");

	$name = strip($_GET["name"]);
	$api_key = strip($_GET["api_key"]);
	
	$cmd = "INSERT INTO projects (name, api_key) VALUES('$name', '$api_key')";
	mysqli_query($connect, $cmd);

	echo "Project successfully created";
?>
