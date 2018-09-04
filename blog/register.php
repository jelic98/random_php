<?php
session_start();
require('connection.php');
require('function.php');

$edit = $_POST['edit'];

if($edit == 0) {
	if(!empty($_POST['username']) && !empty($_POST['password'])) {
		$username = strip($_POST['username'], $connect);
		$password = strip($_POST['password'], $connect);
		$full_name = "";
		$image = "images/users/default.png";

		if(!empty($_POST['full_name'])) {
			$full_name = strip($_POST['full_name'], $connect);
		}

		if(!empty($_POST['add_post'])) {
			$add_post = 1;
		}else {
			$add_post = 0;
		}

		if(!empty($_POST['edit_post'])) {
			$edit_post = 1;
		}else {
			$edit_post = 0;
		}

		if(!empty($_POST['delete_post'])) {
			$delete_post = 1;
		}else {
			$delete_post = 0;
		}

		if(!empty($_POST['add_user'])) {
			$add_user = 1;
		}else {
			$add_user = 0;
		}

		if(!empty($_POST['edit_user'])) {
			$edit_user = 1;
		}else {
			$edit_user = 0;
		}

		if(!empty($_POST['delete_user'])) {
			$delete_user = 1;
		}else {
			$delete_user = 0;
		}

		if(!empty($_POST['add_category'])) {
			$add_category = 1;
		}else {
			$add_category = 0;
		}

		if(!empty($_POST['delete_category'])) {
			$delete_category = 1;
		}else {
			$delete_category = 0;
		}

		if(file_exists($_FILES['image']['tmp_name']) 
		   && is_uploaded_file($_FILES['image']['tmp_name'])) {
			$file_name = $_FILES['image']['name'];
			$file_tmp = $_FILES['image']['tmp_name'];
			$explode = explode('.', $file_name);
			$end = end($explode);
			$file_ext = strtolower($end);
			$name = $username.".".$file_ext;
			$image = "images/users/".$name;
			move_uploaded_file($file_tmp, $image);  
		}

		$added_by = "";

		if(!empty($_SESSION['admin'])) {
			$added_by = $_SESSION['admin'];
		}

		$cmd = "SELECT * FROM `users` WHERE `username`='$username';";
		$rows = mysqli_query($connect, $cmd);
		$num = mysqli_num_rows($rows);

		if($num > 0) {
			show_msg('<h1>Admin with given username exists</h1>', '<a href="admin.php">Try again</a>');
		}else {
			$password = encrypt_pass($password, "");
			$salt = substr($password, 0, 16);

			$cmd = "INSERT INTO `users` (`username`, `password`, `salt`, `full_name`, `image`, `add_post`, `edit_post`, `delete_post`, `add_user`, `edit_user`, `delete_user`, `added_by`, `add_category`, `delete_category`) VALUES ('$username', '$password', '$salt', '$full_name', '$image', '$add_post', '$edit_post', '$delete_post', '$add_user', '$edit_user', '$delete_user', '$added_by', '$add_category', '$delete_category');";
			mysqli_query($connect, $cmd);

			show_msg('<h1>Admin successfully added</h1>', '<a href="admin.php">Admin panel</a>');
		}

		mysqli_close($connect);
	}else {
		show_msg('<h1>Fill out username and password fields</h1>', '<a href="admin.php">Try again</a>');
	}
}else {
	$username = strip($_POST['username'], $connect);

	$cmd = "SELECT * FROM `users` WHERE `username`='$username';";
	$rows = mysqli_query($connect, $cmd);

	if($rows) {
		while($row = mysqli_fetch_array($rows)) {
			$image = $row['image'];
			$password = $row['password'];
			$full_name = $row['full_name'];
			$add_post = $row['add_post'];
			$edit_post = $row['edit_post'];
			$delete_post = $row['delete_post'];
			$add_user = $row['add_user'];
			$edit_user = $row['edit_user'];
			$delete_user = $row['delete_user'];
			$add_category = $row['add_category'];
			$delete_category = $row['delete_category'];
		}
	}

	if(!empty($_POST['full_name'])) {
		$full_name = strip($_POST['full_name'], $connect);
	}

	if(!empty($_POST['password'])) {
		$password = strip($_POST['password'], $connect);	
	}

	if(file_exists($_FILES['image']['tmp_name']) 
	   && is_uploaded_file($_FILES['image']['tmp_name'])) {
		$file_name = $_FILES['image']['name'];
		$file_tmp = $_FILES['image']['tmp_name'];
		$explode = explode('.', $file_name);
		$end = end($explode);
		$file_ext = strtolower($end);
		$name = $headline.".".$file_ext;
		$image = "images/posts/".$name;
		move_uploaded_file($file_tmp, $image);  
	}

	if(!empty($_POST['add_post'])) {
		$add_post = 1;
	}else {
		$add_post = 0;
	}

	if(!empty($_POST['edit_post'])) {
		$edit_post = 1;
	}else {
		$edit_post = 0;
	}

	if(!empty($_POST['delete_post'])) {
		$delete_post = 1;
	}else {
		$delete_post = 0;
	}

	if(!empty($_POST['add_user'])) {
		$add_user = 1;
	}else {
		$add_user = 0;
	}

	if(!empty($_POST['edit_user'])) {
		$edit_user = 1;
	}else {
		$edit_user = 0;
	}

	if(!empty($_POST['delete_user'])) {
		$delete_user = 1;
	}else {
		$delete_user = 0;
	}

	if(!empty($_POST['add_category'])) {
		$add_category = 1;
	}else {
		$add_category = 0;
	}

	if(!empty($_POST['delete_category'])) {
		$delete_category = 1;
	}else {
		$delete_category = 0;
	}

	$password = encrypt_pass($password, "");
	$salt = substr($password, 0, 16);

	$cmd = "UPDATE `users` SET `image`='$image', `password`='$password', `salt`='$salt', `full_name`='$full_name', `add_post`='$add_post', `delete_post`='$delete_post', `edit_post`='$edit_post', `add_user`='$add_user', `delete_user`='$delete_user', `edit_user`='$edit_user', `add_category`='$add_category', `delete_category`='$delete_category' WHERE `username`='$username';";
	mysqli_query($connect, $cmd) or die(mysqli_error($connect));

	show_msg('<h1>Admin successfully saved</h1>', '<a href="admin.php">Admin panel</a>');
}
?>