<?php
session_start();
require('connection.php');
require('function.php');

if(!empty($_POST['username']) && !empty($_POST['password'])) {
	$username = strip($_POST['username'], $connect);
	$password = strip($_POST['password'], $connect);

	$cmd = "SELECT password, salt FROM `users` WHERE `username`='$username';";
	$result = mysqli_query($connect, $cmd);
	$num = mysqli_num_rows($result);

	if($num == 1) {
		$row = mysqli_fetch_assoc($result);

		$password_db = $row['password'];
		$salt = $row['salt'];

		if(check_pass($password, $password_db, $salt)) {
			$_SESSION['admin'] = $username;
			header("location: admin.php");	
		}else {
			show_msg('<h1>Incorrect password</h1>', '<a href="admin.php">Try again</a>');
		}
	}else {
		show_msg('<h1>Admin does not exist</h1>', '<a href="admin.php">Try again</a>');
	}

	mysqli_close($connect);
}else {
	show_msg('<h1>Fill out all fields</h1>', '<a href="admin.php">Try again</a>');
}
?>
