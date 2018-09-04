<?php
if(!empty($_GET['msg']) && !empty($_GET['btn'])) {
	$msg = $_GET['msg'];
	$btn = $_GET['btn'];

	echo $msg;
	echo $btn;
}else {
	header("location: index.php");
}
?>