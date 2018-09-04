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

$cmd = "DELETE FROM `table_shops` WHERE `id`='$id'";
mysqli_query($connect, $cmd) or die(mysqli_error($connect));

$_SESSION['shop_id'] = "";

$cmd = "SELECT * FROM `table_products` WHERE `shop_id`='$id'";
$rows = mysqli_query($connect, $cmd) or die(mysqli_error($connect));

if($rows) {
    while($row = mysqli_fetch_array($rows)) {
        $product_id = $row['id'];

        $inner_cmd = "DELETE FROM `table_products` WHERE `id`='$product_id'";
        mysqli_query($connect, $inner_cmd) or die(mysqli_error($connect));
    }
}

header("location: ../home.php");

mysqli_close($connect);
?>