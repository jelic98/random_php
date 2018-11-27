<?php
	require("autoload.php");

	check_params(["username", "password", "type"], "GET");

	$username = strip($_GET["username"]);
	$password = strip($_GET["password"]);
	$type = strip($_GET["type"]);
	
	$cmd = "INSERT INTO users (username, password, type) VALUES('$username', '$password', '$type')";
	mysqli_query($connect, $cmd);

	echo "User successfully added";
?>
