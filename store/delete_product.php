<?php
session_start();

if(empty($_SESSION['id'])) {
    header("location: /login.php");
    exit;
}

include 'connection.php';

$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$explode = explode('/', $url);
$id = end($explode);

$cmd = "DELETE FROM `table_products` WHERE `id`='$id'";
mysqli_query($connect, $cmd) or die(mysqli_error($connect));

header("location: ../home.php");

mysqli_close($connect);
?>