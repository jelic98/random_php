<?php
include 'connection.php';

$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$explode1 = explode('/', $url);
$end = end($explode1);

$product_id = substr($end, 0, strpos($end, '*'));
$end = str_replace($product_id."*", "", $end);
$product_review = substr($end, strpos($end, $product_id), strpos($end, '*'));
$name = str_replace($product_review."*", "", $end);

$cmd = "SELECT * from `table_products` WHERE `id`='$product_id'";
$rows = mysqli_query($connect, $cmd) or die(mysqli_error($connect));

$product_image = "";

if($rows) {
    while($row = mysqli_fetch_array($rows)) {
        $current_review = $row['review'];
    }
} 

$new_review = $product_review."*".$name."~"; 

if(!empty($current_review)) {
    $new_review = $current_review.$product_review."*".$name."~";  
} 

$cmd = "UPDATE `table_products` SET `review`='$new_review' WHERE `id`='$product_id'";
mysqli_query($connect, $cmd) or die(mysqli_error($connect));
mysqli_close($connect);

header("location: ../../product.php/".$product_id);
?>