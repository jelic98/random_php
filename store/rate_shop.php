<?php
session_start();
if(!empty($_SESSION['id'])) {
    include 'connection.php';

    $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $explode1 = explode('/', $url);
    $end = end($explode1);

    $shop_id = substr($end, 0, strpos($end, '*'));

    $explode2 = explode('*', $end);
    $shop_rating = end($explode2);

    $cmd = "SELECT * FROM `table_shops` WHERE `id`='$shop_id'";
    $rows = mysqli_query($connect, $cmd) or die(mysqli_error($connect));

    if($rows) {
        while($row = mysqli_fetch_array($rows)) {
            $owner_id = $row['owner_id'];
            $current_rating = $row['rating'];
        }
    }

    if($owner_id != $_SESSION['id']) {
        if($current_rating == 0 || 
           is_null($current_rating)) {
            $new_rating = $shop_rating;
        }else {
            $new_rating = ($current_rating + $shop_rating) / 2;    
        }

        $cmd = "UPDATE `table_shops` SET `rating`='$new_rating' WHERE `id`='$shop_id'";
        mysqli_query($connect, $cmd) or die(mysqli_error($connect));

        header("location: ../shop.php/".$shop_id);
    }else {
        echo "You cannot rate your own shop";
    }
}else {
    header("location: /login.php");
}

mysqli_close($connect);
?>