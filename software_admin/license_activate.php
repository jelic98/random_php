<?php
	require("autoload.php");

	check_params(["code"], "POST");

	$code = strip($_GET["code"]);

	$cmd = "SELECT activated FROM licenses WHERE code='$code'";
	$activated = mysqli_fetch_array(mysqli_query($connect, $cmd))[0];

	if(!isset($activated)) {
		echo "Invalid license code";
		http_response_code(400);
		exit;
	}

	if($activated == 1) {
		echo "License already activated";
		http_response_code(400);
		exit;
	}

	$cmd = "UPDATE licenses SET activated=1 WHERE code=" . $code;
	mysqli_query($connect, $cmd);

	echo "License successfully activated";
	http_response_code(200);
?>
