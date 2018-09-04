<?php
session_start();
include 'connection.php';

$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$explode1 = explode('/', $url);
$end = end($explode1);

$product_id = substr($end, 0, strpos($end, '*'));

$explode2 = explode('*', $end);
$product_quantity = end($explode2);

$user_id = $_SESSION['id'];

$cmd = "SELECT * FROM `table_users` WHERE `id`='$user_id'";
$rows = mysqli_query($connect, $cmd) or die(mysqli_error($connect));

if($rows) {
    while($row = mysqli_fetch_array($rows)) {
        $cart = $row['cart'];
    }
}

$cart = str_replace($product_id."*".$product_quantity."~", "", $cart);

$cmd = "UPDATE `table_users` SET `cart`='$cart' WHERE `id`='$user_id'";
mysqli_query($connect, $cmd) or die(mysqli_query($connect));

header("location: ../shopping_cart.php");
mysqli_close($connect);
?>