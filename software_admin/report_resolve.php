<?php
	require("autoload.php");

	check_params(["id"], "GET");

	$report = strip($_GET["id"]);

	$cmd = "UPDATE reports SET resolved=1 WHERE id=" . $report;
	mysqli_query($connect, $cmd);

	header("location: report_show.php");
?>
