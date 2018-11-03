<?php
	require("autoload.php");

	check_params(["code"], "POST");

	$code = strip($_POST["code"]);

	$cmd = "SELECT activated FROM licenses WHERE code='$code'";
	$activated = mysqli_fetch_array(mysqli_query($connect, $cmd))[0];

	if(!isset($activated)) {
		response(400, "Invalid license code");
		exit;
	}

	if($activated == 1) {
		response(400, "License already activated");
		exit;
	}

	$cmd = "UPDATE licenses SET activated=1 WHERE code='$code'";
	mysqli_query($connect, $cmd);

	response(200, "License successfully activated");
?>
