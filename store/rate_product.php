<?php
session_start();
if(!empty($_SESSION['id'])) {
    include 'connection.php';

    $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $explode1 = explode('/', $url);
    $end = end($explode1);

    $product_id = substr($end, 0, strpos($end, '*'));

    $explode2 = explode('*', $end);
    $product_rating = end($explode2);

    $cmd = "SELECT * FROM `table_products` WHERE `id`='$product_id'";
    $rows = mysqli_query($connect, $cmd) or die(mysqli_error($connect));

    if($rows) {
        while($row = mysqli_fetch_array($rows)) {
            $shop_id = $row['shop_id'];
            $current_rating = $row['rating'];
        }
    }

    $cmd = "SELECT * FROM `table_shops` WHERE `id`='$shop_id'";
    $rows = mysqli_query($connect, $cmd) or die(mysqli_error($connect));

    if($rows) {
        while($row = mysqli_fetch_array($rows)) {
            $owner_id = $row['owner_id'];
        }
    }

    if($owner_id != $_SESSION['id']) {
        if($current_rating == 0 || 
           is_null($current_rating)) {
            $new_rating = $product_rating;
        }else {
            $new_rating = ($current_rating + $product_rating) / 2;    
        }

        $cmd = "UPDATE `table_products` SET `rating`='$new_rating' WHERE `id`='$product_id'";
        mysqli_query($connect, $cmd) or die(mysqli_error($connect));

        header("location: ../product.php/".$product_id);
        mysqli_close($connect);
    }else {
        echo "You cannot rate your own product";
    }
}else {
    header("location: /login.php");
}
?>