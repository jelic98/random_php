<?php
//USE WITH CAUTION
//this script is used to upadte image names on the website

include 'connection.php';

$cmd = "SELECT * FROM `table_products`";
$rows = mysqli_query($connect, $cmd);

if($rows) {
    while($row = mysqli_fetch_array($rows)) {
        $image = $row['images'];
        $id = $row['id'];

        while(strpos($image, "*") > 0) {
            $image = str_replace("*", "~", $image);
        }

        if((!empty($image)) && strpos($image, "~") == 0) {
            $image .= "~";
        }

        $inner_cmd = "UPDATE `table_products` SET `images`='$image' WHERE `id`='$id'";
        mysqli_query($connect, $inner_cmd) or die(mysqli_error($connect));
    }
}

mysqli_close($connect);
?>