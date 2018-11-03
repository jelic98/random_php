<?php
	require("autoload.php");

	check_api_key();
	check_params(["message"], "POST");

	$api_key = get_api_key();
	$message = strip($_POST["message"]);
	
	$cmd = "SELECT id FROM projects WHERE api_key='$api_key'";
	$project = mysqli_fetch_array(mysqli_query($connect, $cmd))[0];

	if(!isset($project)) {
		response(400, "Invalid project");
		exit;
	}

	$cmd = "INSERT INTO reports (project, message) VALUES('$project', '$message')";
	mysqli_query($connect, $cmd);

	response(200, "Succes");
?>
