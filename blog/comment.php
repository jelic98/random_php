<?php
session_start();
require('connection.php');
require('function.php');

$url = strip($_POST['url'], $connect);

if(!empty($_SESSION['id'])) {
	$author = $_SESSION['id'];	

	if(!empty($_POST['comment']) && !empty($_POST['url'])) {
		$comment = strip($_POST['comment'], $connect);

		$cmd = "INSERT INTO `comments` (`url`, `author`, `comment`) VALUES ('$url', '$author', '$comment');";
		mysqli_query($connect, $cmd);

		show_msg('<h1>Successfully left comment</h1>', '<a href="'.$url.'">Go back</a>');
	}else {
		show_msg('<h1>Fill out comment field</h1>', '<a href="'.$url.'">Go back</a>');
	}
}else {
	show_msg('<h1>You need to sign in</h1>', '<a href="'.$url.'">Go back</a>');
}
?>
