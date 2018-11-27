<?php
	require("autoload.php");

	check_params(["hash"], "POST");
	
	$hash = strip($_POST["hash"]);

	$cmd = "SELECT username FROM users WHERE session_hash='$hash'";
	$username = mysqli_fetch_array(mysqli_query($connect, $cmd))[0];

	if(!isset($username)) {
		response(400, "Invalid session");
		exit;
	}

	$hash = random_string(16);

	$cmd = "UPDATE users SET session_hash='$hash' WHERE username='$username'";
	mysqli_query($connect, $cmd);

	response(200, $hash . " " . $type);
?>
