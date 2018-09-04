<?php
session_start();
include 'connection.php';

$user_id = $_SESSION['id'];

$cmd = "UPDATE `table_users` SET `cart`='' WHERE `id`='$user_id'";
mysqli_query($connect, $cmd) or die(mysqli_query($connect));

header("location: ../shopping_cart.php");

mysqli_close($connect);
?>