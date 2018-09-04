<?php
session_start();
require('connection.php');
require('function.php');

if(!empty($_SESSION['admin'])) {
	$username = $_SESSION['admin'];

	if(!empty($_GET['post']) && $_GET['post'] = "true") {
		$delete_post = 0;

		$cmd = "SELECT `delete_post` FROM `users` WHERE `username`='$username';";
		$result = mysqli_query($connect, $cmd);
		$row = mysqli_fetch_assoc($result);

		$delete_post = $row['delete_post'];

		if($delete_post == 1) {
			if(!empty($_GET['h'])) {
				$headline = strip($_GET['h'], $connect);

				$cmd = "DELETE FROM `posts` WHERE `headline`='$headline';";
				mysqli_query($connect, $cmd);

				show_msg('<h1>Post successfully deleted</h1>', '<a href="admin.php">Admin panel</a>');
			}else {
				show_msg('<h1>Post not found</h1>', '<a href="index.php">Go home</a>');
			}
		}else {
			show_msg('<h1>You dont have privilege to delete posts</h1>', '');
		}	
	}

	if(!empty($_GET['user']) && $_GET['user'] = "true") {
		$delete_user = 0;

		$cmd = "SELECT `delete_user` FROM `users` WHERE `username`='$username';";
		$result = mysqli_query($connect, $cmd);
		$row = mysqli_fetch_assoc($result);

		$delete_user = $row['delete_user'];

		if($delete_user == 1) {
			if(!empty($_POST['users'])) {
				$num = 0;

				foreach($_POST['users'] as $user) {
					$cmd = "DELETE FROM `users` WHERE `username`='$user';";
					mysqli_query($connect, $cmd);

					$cmd = "UPDATE `posts` SET `author`='' WHERE `author`='$user';";
					mysqli_query($connect, $cmd);

					$num++;
				}

				if($num == 1) {
					show_msg('<h1>Admin successfully deleted</h1>', '<a href="admin.php">Admin panel</a>');
				}else {
					show_msg('<h1>Admins successfully deleted</h1>', '<a href="admin.php">Admin panel</a>');	
				}
			}
		}
	}
}else {
	header("location: admin.php");
}
?>