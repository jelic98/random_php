<?php
	session_start();

	$debug = false;

	if(!strcmp($_SERVER['HTTP_HOST'], "localhost")) {
		$debug = true;
	}

	ini_set("display_errors", $debug ? "on" : "off");

	// DATABASE
	
	if($debug) {
		$db_host = "localhost";
		$db_name = "software_admin";
		$db_username = "root";
		$db_password = "root";
	}else {
		$db_host = ".";
		$db_name = ".";
		$db_username = ".";
		$db_password = ".";
	}

	$connect = mysqli_connect($db_host, $db_username, $db_password);	
	mysqli_select_db($connect, $db_name);

	// FUNCTIONS

	function check_api_key() {
		$api_key = get_api_key();

		if(!isset($api_key) || empty($api_key)) {
			echo "API key is required";
			http_response_code(401);
			exit;	
		}
	
		$cmd = "SELECT id FROM projects WHERE api_key='$api_key'";
		$project = mysqli_fetch_array(mysqli_query($GLOBALS['connect'], $cmd))[0];

		if(!isset($project)) {
			echo "API key is not valid";
			http_response_code(401);
			exit;	
		}
	}

	function get_api_key() {
		return strip($_SERVER["API_KEY"]);
	}

	function check_params($params, $method) {
		$errorFound = false;

		foreach($params as $p) {
			if($method == "GET") {
				if(!isset($_GET[$p])) {
					$errorFound = true;
				}
			}else if($method == "POST") {
				if(!isset($_POST[$p])) {
					$errorFound = true;
				}
			}
		}

		if($errorFound) {
			echo "Following parameters are required " . json_encode($params);
			http_response_code(400);
			exit;
		}
	}

	function strip($var) {
		return mysqli_real_escape_string($GLOBALS['connect'], htmlspecialchars(strip_tags(trim($var))));
    }
?>
