<?php
	require("autoload.php");

	check_params(["email", "message"], "GET");

	$email = strip($_GET["email"]);
	$message = strip($_GET["message"]);
	
	$cmd = "INSERT INTO help (email, message) VALUES('$email', '$message')";
	mysqli_query($connect, $cmd);
	
	$message = str_replace("\\r\\n", "", $message);

	$headers = "From: " . $email . "\r\n";
	$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
	$headers .= "Reply-To: " . $email . "\r\n";

	mail("jdjokovic@raf.rs", "Help", $message, $headers);

	echo "Message successfully sent";
?>
