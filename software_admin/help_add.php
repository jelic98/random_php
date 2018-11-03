<?php
	require("autoload.php");

	check_params(["email", "message"], "GET");

	$email = strip($_GET["email"]);
	$message = strip($_GET["message"]);
	
	$cmd = "INSERT INTO help (email, message) VALUES('$email', '$message')";
	mysqli_query($connect, $cmd);

	echo "Message successfully sent";
?>
