<?php
session_start();
require('connection.php');
require('function.php');

$url = $_SERVER['REQUEST_URI'];

if(!empty($_GET['h'])) {
	$headline = strip($_GET['h'], $connect);
	$image = "images/posts/default.png";
	$author = "Unknown";
	$author_image = "images/users/default.png";
	$category = "Other";
	$tags = "No tags";
	$date = "Unknown";

	$cmd = "SELECT * FROM `posts` WHERE `headline`='$headline';";
	$rows = mysqli_query($connect, $cmd);
	$num = mysqli_num_rows($rows);

	if($num > 0) {
		if($rows) {
			while($row = mysqli_fetch_array($rows)) {
				$body = $row['body'];	

				if(!empty($row['date'])) {
					$date = $row['date'];	
				}

				if(!empty($row['author'])) {
					$author = $row['author'];	
				}

				if(!empty($row['category'])) {
					$category = $row['category'];	
				}

				if(!empty($row['tags'])) {
					$tags = $row['tags'];	
				}

				if(!empty($row['image'])) {
					$image = $row['image'];	
				}
			}
		}

		$inner_cmd = "SELECT * FROM `users` WHERE `username`='$author';";
		$inner_rows = mysqli_query($connect, $inner_cmd);

		if($inner_rows) {
			while($row = mysqli_fetch_array($inner_rows)) {
				if(!empty($row['full_name'])) {
					$author = $row['full_name'];	
				}

				if(!empty($row['image'])) {
					$author_image = $row['image'];	
				}
			}
		}

		echo '<img src="'.$image.'">';
		echo '<h1>'.$headline.'</h1>';
		echo '<p>Date: '.$date.'</p>';
		echo '<img src="'.$author_image.'">';
		echo '<p>Author: '.$author.'</p>';
		echo '<iframe src="'.$body.'"></iframe>';
		echo '<p>Category: </p><a href="index.php?c='.$category.'">'.$category.'</a>';

		if($tags != "No tags") {
			echo '<p>';

			$tags = str_replace(", " , ",", $tags);

			while(strpos($tags, ",") !== false) {
				$tag = substr($tags, 0, strpos($tags, ","));

				echo '<a href="index.php?t='.$tag.'" class="btn-u btn-u-emerald">'.$tag.'</a> ';

				$tags = str_replace($tag."," , "", $tags);
			}

			echo '<a href="index.php?t='.$tags.'" class="btn-u btn-u-emerald">'.$tags.'</a>';
			echo '</p>';
		}

		if(!empty($_SESSION['id'])) {
			echo '<form action="comment.php" method="post" id="comment">';
			echo '<input type="hidden" name="url" value="'.$url.'">';
			echo '<textarea name="comment" form="comment">Enter comment here...</textarea>';
			echo '<input type="submit" value="Comment">';
			echo '</form>';
		}else {
			echo '<p><a href="fblogin.php">Sign in</a> to leave a comment</p>';
		}

		$cmd = "SELECT * FROM `comments` WHERE `url`='$url';";
		$rows = mysqli_query($connect, $cmd);

		while($row = mysqli_fetch_array($rows)) {
			$author = $row['author'];
			$comment = $row['comment'];

			echo '<p>'.$author.'</p>';
			echo '<p>'.$comment.'</p>';
		}

		if(!empty($_SESSION['admin'])) {
			$username = $_SESSION['admin'];

			$cmd = "SELECT * FROM `users` WHERE `username`='$username';";
			$rows = mysqli_query($connect, $cmd);

			if($rows) {
				while($row = mysqli_fetch_array($rows)) {
					$edit_post = $row['edit_post'];
					$delete_post = $row['delete_post'];

					if($edit_post == 1) {
						echo '<a href="admin.php?h='.$headline.'"><i class="fa fa-pencil-square-o"></i></a>';
					}

					if($delete_post == 1) {
						echo '<a href="delete.php?post=true&h='.$headline.'"><i class="fa fa-trash-o"></i></a>';
					}
				}
			}
		}
	}else {
		show_msg('<h1>Post not found</h1>', '<a href="index.php">Go home</a>');
	}

	mysqli_close($connect);
}else {
	header("location: index.php");
}
?>