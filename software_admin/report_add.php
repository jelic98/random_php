<?php
	require("autoload.php");

	check_api_key();
	check_params(["message"], "POST");

	$api_key = get_api_key();
	$message = strip($_POST["message"]);
	
	$cmd = "SELECT id FROM projects WHERE api_key='$api_key'";
	$project = mysqli_fetch_array(mysqli_query($connect, $cmd))[0];

	if(!isset($project)) {
		echo "Invalid project";
		http_response_code(400);
		exit;
	}

	$cmd = "INSERT INTO reports (project, message) VALUES('$project', '$message')";
	mysqli_query($connect, $cmd);

	http_response_code(200);
?>
