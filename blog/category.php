<?php
require('connection.php');
require('function.php');

if(!empty($_GET['add']) && $_GET['add'] == "true") {
	$category = $_POST['category'];

	$cmd = "INSERT INTO `category` (`name`) VALUES ('$category');";
	mysqli_query($connect, $cmd);

	show_msg('<h1>Category successfully added</h1>', '<a href="admin.php">Admin panel</a>');
}else if(!empty($_GET['delete']) && $_GET['delete'] == "true") {
	if(!empty($_POST['categories'])) {
		$num = 0;

		foreach($_POST['categories'] as $category) {
			$cmd = "DELETE FROM `category` WHERE `name`='$category';";
			mysqli_query($connect, $cmd);

			$cmd = "UPDATE `posts` SET `category`='' WHERE `category`='$category';";
			mysqli_query($connect, $cmd);

			$num++;
		}

		if($num == 1) {
			show_msg('<h1>Category successfully removed</h1>', '<a href="admin.php">Admin panel</a>');
		}else {
			show_msg('<h1>Categories successfully removed</h1>', '<a href="admin.php">Admin panel</a>');	
		}
	}
}else {
	show_msg('<h1>Fill out category name field</h1>', '<a href="admin.php">Try again</a>');
}
?>