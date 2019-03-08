<?php
	require("autoload.php");

	check_params(["hash"], "POST");
	
	$hash = strip($_POST["hash"]);

	$cmd = "SELECT * FROM users WHERE session_hash='$hash'";
	$row = mysqli_fetch_array(mysqli_query($connect, $cmd));
	$username = $row["username"];
	$type = $row["type"];

	if(!isset($username)) {
		response(400, "Invalid session");
		exit;
	}

	$hash = random_string(16);

	$cmd = "UPDATE users SET session_hash='$hash' WHERE username='$username'";
	mysqli_query($connect, $cmd);

	response(200, $hash . " " . $type);
?>
