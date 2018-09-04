<?php	
require('connection.php');
require('function.php');

$from = 0;
$limit = 8;
$page = 1;
$filter = "";

if(!empty($_GET['c'])) {
	if($_GET['c'] == "Other") {
		$filter = " WHERE `category`=''";
	}else {
		$filter = " WHERE `category`='".strip($_GET['c'], $connect)."'";	
	}

	if(!empty($_GET['t'])) {
		$filter .= " AND `tags` LIKE '%".strip($_GET['t'], $connect)."%'";
	}
}else {
	if(!empty($_GET['t'])) {
		$filter = " WHERE `tags` LIKE '%".strip($_GET['t'], $connect)."%'";
	}
}

$cmd = "SELECT * FROM `posts`".$filter.";";

$rows = mysqli_query($connect, $cmd);
$total = mysqli_num_rows($rows);

$max_page = intval($total / $limit);

if($total % $limit != 0) {
	$max_page++;
}

if(!empty($_GET['p'])) {
	$page = strip($_GET['p'], $connect);

	if($page > 1) {
		if($page * $limit >= $total) {
			$page = $max_page;
			$from = ($page - 1) * $limit;
		}else {
			$from = $page * ($limit - 1);
		}
	}else {
		$page = 1;
	}
}

$cmd = "SELECT * FROM `posts`".$filter." LIMIT $limit OFFSET $from;";
$rows = mysqli_query($connect, $cmd) or die(mysqli_error($connect));
$num = mysqli_num_rows($rows);

if($num > 0) {
	if($rows) {
		while($row = mysqli_fetch_array($rows)) {
			$headline = $row['headline'];
			$preview = $row['preview'];
			$image = $row['image'];
			$date = $row['date'];

			echo '<a href="post.php?h='.$headline.'">'.$headline.'</a>';
			echo '<br/>';
		}
	}

	if($page > 1) {
		echo '<a href="index.php?p='.($page - 1).'">Previous</a>';

		if($page > 2) {
			echo '<a href="index.php?p=1">1...</a>';
		}

		echo '<a href="index.php?p='.($page - 1).'">'.($page - 1).'</a>';
	}

	echo '<a href="index.php?p='.$page.'">'.$page.'</a>';

	if($page < $max_page) {
		echo '<a href="index.php?p='.($page + 1).'">'.($page + 1).'</a>';

		if($page < $max_page - 1) {
			echo '<a href="index.php?p='.$max_page.'">...'.$max_page.'</a>';
		}

		echo '<a href="index.php?p='.($page + 1).'">Next</a>';	
	}
}else {
	show_msg('<h1>Posts not found</h1>', '<a href="index.php">Go home</a>');
}

mysqli_close($connect);
?>
