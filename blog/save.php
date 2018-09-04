<?php
session_start();
require('connection.php');
require('function.php');

$edit = $_POST['edit'];

if($edit == 0) {
	if(!empty($_POST['headline']) 
	   && file_exists($_FILES['body']['tmp_name'])  
	   && is_uploaded_file($_FILES['body']['tmp_name']) 
	   && !empty($_POST['category'])) {
		$headline = strip($_POST['headline'], $connect);
		$preview = "";
		$image = "images/posts/default.png";
		$tags = "";
		$category = $_POST['category'];

		$file_name = $_FILES['body']['name'];
		$file_tmp = $_FILES['body']['tmp_name'];
		$explode = explode('.', $file_name);
		$end = end($explode);
		$file_ext = strtolower($end);
		$name = $headline.".".$file_ext;
		$body = "posts/".$name;
		move_uploaded_file($file_tmp, $body);  

		date_default_timezone_set('UTC');
		$date = date('d.m.Y.', time());

		if(!empty($_POST['preview'])) {
			$preview = strip($_POST['preview'], $connect);
		}

		if(!empty($_POST['tags'])) {
			$tags = strip($_POST['tags'], $connect);
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

		$author = "";

		if(!empty($_SESSION['admin'])) {
			$author = $_SESSION['admin'];
		}

		$cmd = "SELECT * FROM `posts` WHERE `headline`='$headline';";
		$rows = mysqli_query($connect, $cmd);
		$num = mysqli_num_rows($rows);

		if($num > 0) {
			show_msg('<h1>Post with given headline exists</h1>', '<a href="admin.php">Try again</a>');
		}else {
			$cmd = "INSERT INTO `posts` (`headline`, `preview`, `body`, `image`, `date`, `author`, `category`, `tags`) VALUES ('$headline', '$preview', '$body', '$image', '$date', '$author', '$category', '$tags');";
			mysqli_query($connect, $cmd);

			show_msg('<h1>Post successfully saved</h1>', '<a href="admin.php">Admin panel</a>');
		}

		mysqli_close($connect);
	}else {
		show_msg('<h1>Fill out required fields</h1>', '<a href="admin.php">Try again</a>');
	}
}else {
	$headline = strip($_POST['headline'], $connect);

	$cmd = "SELECT * FROM `posts` WHERE `headline`='$headline';";
	$rows = mysqli_query($connect, $cmd);

	if($rows) {
		while($row = mysqli_fetch_array($rows)) {
			$body = $row['body'];
			$image = $row['image'];
			$preview = $row['preview'];
			$tags = $row['tags'];
			$category = $row['category'];
		}
	}

	$file_name = $_FILES['body']['name'];
	$file_tmp = $_FILES['body']['tmp_name'];
	$explode = explode('.', $file_name);
	$end = end($explode);
	$file_ext = strtolower($end);
	$name = $headline.".".$file_ext;
	$body = "posts/".$name;
	move_uploaded_file($file_tmp, $body);  

	date_default_timezone_set('UTC');
	$date = date('d.m.Y.', time());

	if(!empty($_POST['preview'])) {
		$preview = strip($_POST['preview'], $connect);
	}

	if(!empty($_POST['tags'])) {
		$tags = strip($_POST['tags'], $connect);
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

	$author = "";

	if(!empty($_SESSION['admin'])) {
		$author = $_SESSION['admin'];
	}

	$cmd = "UPDATE `posts` SET `preview`='$preview', `body`='$body', `image`='$image', `date`='$date', `author`='$author', `category`='$category', `tags`='$tags' WHERE `headline`='$headline';";
	mysqli_query($connect, $cmd) or die(mysqli_error($connect));

	show_msg('<h1>Post successfully saved</h1>', '<a href="admin.php">Admin panel</a>');
}
?>