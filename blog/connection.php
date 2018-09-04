<?php
$connect = mysqli_connect("localhost", "root", "root") or die(mysqli_error($connect)); 
mysqli_select_db($connect, "blog") or die(mysqli_error($connect));   
?>