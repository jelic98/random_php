<?php
	if(!isset($_GET['q'])) {
		echo '400 Bad Request';
		exit;
	}

	$query = $_GET['q'];
	
	require("files.php");

	if(!array_key_exists($query, $files)) {
		echo '404 Not Found';
		exit;
	}

	$filename = $files[$query];

	header('Content-Type: application/octet-stream');
	header('Content-Transfer-Encoding: Binary'); 
   	header('Content-Disposition: attachment; filename="' . $filename . '"');
        	
	readfile($filename);  
?>
