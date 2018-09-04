<?php
session_start();
include 'connection.php';

$user_id = $_SESSION['id'];

$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$explode1 = explode('/', $url);
$end = end($explode1);

$product_id = substr($end, 0, strpos($end, '*'));

$explode2 = explode('*', $end);
$product_quantity = end($explode2);

$cmd = "SELECT * FROM `table_products` WHERE `id`='$product_id'";
$rows = mysqli_query($connect, $cmd) or die(mysqli_error($connect));

if($rows) {
    while($row = mysqli_fetch_array($rows)) {
        $qty = $row['quantity'];
    }
}

if($product_quantity <= $qty) {
    $cmd = "SELECT * FROM `table_users` WHERE `id`='$user_id'";
    $rows = mysqli_query($connect, $cmd) or die(mysqli_error($connect));

    if($rows) {
        while($row = mysqli_fetch_array($rows)) {
            $cart = $row['cart'];
        }

        if(strpos($cart, "~".$product_id) === false) {
            $cart .= $product_id."*".$product_quantity."~";

            $cmd = "UPDATE `table_users` SET `cart`='$cart' WHERE `id`='$user_id'";
            mysqli_query($connect, $cmd) or die(mysqli_query($connect));

            header("location: ../shopping_cart.php");
        }else {
            echo 'You have already added this product to you cart';
        }
    }   
}else {
    echo "Quantity of this product is ".$qty;
}

mysqli_close($connect);
?>