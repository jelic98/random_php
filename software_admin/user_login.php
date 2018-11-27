<?php
	require("autoload.php");

	check_params(["username", "password"], "POST");

	$username = strip($_POST["username"]);
	$password = strip($_POST["password"]);

	$cmd = "SELECT * FROM users WHERE username='$username'";
	$row = mysqli_fetch_array(mysqli_query($connect, $cmd));
	$db_password = $row["password"];
	$type = $row["type"];

	if(!isset($db_password) || strcmp($password, $db_password) != 0) {
		response(400, "Invalid credentials");
		exit;
	}

	$hash = random_string(16);

	$cmd = "UPDATE users SET hash='$hash' WHERE username='$username'";
	mysqli_query($connect, $cmd);

	response(200, $hash . " " . $type);
?>
