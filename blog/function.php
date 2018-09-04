<?php
function show_msg($msg, $btn) {
	echo $msg;
	echo $btn;
}

function strip($var, $connect) {
	return mysqli_real_escape_string($connect, htmlspecialchars(strip_tags($var)));
}

function generate_salt() {
	$salt = "";
	$salt_chars = array_merge(range("A", "Z"), range("a", "z"), range(0, 9));

	for($i = 0; $i < 16; $i++) {
		$salt .= $salt_chars[array_rand($salt_chars)];
	}

	return $salt;
}

function encrypt_pass($pass, $salt) {
	if(empty($salt)) {
		$salt = generate_salt();
	}

	return $salt.hash("sha512", $pass);
}

function check_pass($input, $pass, $salt) {
	if(encrypt_pass($input, $salt) == $pass) {
		return true;
	}else {
		return false;
	}
}
?>