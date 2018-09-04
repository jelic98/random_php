<?php
session_start();
include 'connection.php';
include 'functions.php';

if(empty($_SESSION['id'])) {
    header("location: /login.php");
    exit;
}

if(isset($_POST['product_name']) &&
   isset($_POST['product_price']) &&
   isset($_POST['product_description']) &&
   isset($_POST['product_category']) &&
   isset($_POST['product_subcategory']) &&
   isset($_POST['product_quantity'])) {

    $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $explode = explode('/', $url);
    $product_id = end($explode);

    $cmd = "SELECT * FROM `table_products` WHERE `id`='$product_id'";
    $rows = mysqli_query($connect, $cmd);

    if($rows) {
        while($row = mysqli_fetch_array($rows)) {
            $shop_id = $row['shop_id'];
            $images = $row['images'];
        }
    }

    $index = 0;

    $old1 = "";
    $old2 = "";
    $old3 = "";
    $old4 = "";
    $old5 = "";

    while(strpos($images, "~") > 0) {
        $current = substr($images, 0, strpos($images, "~"));

        switch($index) {
            case 0:
                $old1 = $current;

                if(empty($old1)) {
                    $old1 = "images/default.jpg";
                }

                break;
            case 1:
                $old2 = $current;
                break;
            case 2:
                $old3 = $current;
                break;
            case 3:
                $old4 = $current;
                break;
            case 4:
                $old5 = $current;
                break;
        }

        $images = str_replace($current."~", "", $images); 
        $index++;
    }

    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];
    $product_category = $_POST['product_category'];
    $product_subcategory = strtolower($_POST['product_subcategory']);
    $product_quantity = strtolower($_POST['product_quantity']);

    if(isset($_FILES['photo1'])) {
        $file_name = $_FILES["photo1"]["name"];
        $file_tmp = $_FILES["photo1"]["tmp_name"];
        $explode = explode('.', $file_name);
        $end = end($explode);
        $file_ext = strtolower($end);
        $image = "1".$product_name.$shop_id.".".$file_ext;
        $current1 = "images/".$image;
        $filename = compress_image($_FILES["photo1"]["tmp_name"], $current1);
        resize($filename, $current1, 100, 100);

        if(!empty($file_tmp)) {
            move_uploaded_file($file_tmp, $current1);   
        }else {
            $current1 = "";
        }
    }

    if(isset($_FILES['photo2'])) {
        $file_name = $_FILES["photo2"]["name"];
        $file_tmp = $_FILES["photo2"]["tmp_name"];
        $explode = explode('.', $file_name);
        $end = end($explode);
        $file_ext = strtolower($end);
        $image = "2".$product_name.$shop_id.".".$file_ext;
        $current2 = "images/".$image;
        $filename = compress_image($_FILES["photo2"]["tmp_name"], $current2);
        resize($filename, $current2, 100, 100);

        if(!empty($file_tmp)) {
            move_uploaded_file($file_tmp, $current2);   
        }else {
            $current2 = "";
        }
    }

    if(isset($_FILES['photo3'])) {
        $file_name = $_FILES["photo3"]["name"];
        $file_tmp = $_FILES["photo3"]["tmp_name"];
        $explode = explode('.', $file_name);
        $end = end($explode);
        $file_ext = strtolower($end);
        $image = "3".$product_name.$shop_id.".".$file_ext;
        $current3 = "images/".$image;
        $filename = compress_image($_FILES["photo3"]["tmp_name"], $current3);
        resize($filename, $current3, 100, 100);

        if(!empty($file_tmp)) {
            move_uploaded_file($file_tmp, $current3);   
        }else {
            $current3 = "";
        }
    }

    if(isset($_FILES['photo4'])) {
        $file_name = $_FILES["photo4"]["name"];
        $file_tmp = $_FILES["photo4"]["tmp_name"];
        $explode = explode('.', $file_name);
        $end = end($explode);
        $file_ext = strtolower($end);
        $image = "4".$product_name.$shop_id.".".$file_ext;
        $current4 = "images/".$image;
        $filename = compress_image($_FILES["photo4"]["tmp_name"], $current4);
        resize($filename, $current4, 100, 100);

        if(!empty($file_tmp)) {
            move_uploaded_file($file_tmp, $current4);   
        }else {
            $current4 = "";
        }
    }

    if(isset($_FILES['photo5'])) {
        $file_name = $_FILES["photo5"]["name"];
        $file_tmp = $_FILES["photo5"]["tmp_name"];
        $explode = explode('.', $file_name);
        $end = end($explode);
        $file_ext = strtolower($end);
        $image = "5".$product_name.$shop_id.".".$file_ext;
        $current5 = "images/".$image;
        $filename = compress_image($_FILES["photo5"]["tmp_name"], $current5);
        resize($filename, $current5, 100, 100);

        if(!empty($file_tmp)) {
            move_uploaded_file($file_tmp, $current5);   
        }else {
            $current5 = "";
        }
    }

    if(empty($current1)) {
        $current1 = $old1;
    }

    if(empty($current2)) {
        $current2 = $old2;
    }

    if(empty($current3)) {
        $current3 = $old3;
    }

    if(empty($current4)) {
        $current4 = $old4;
    }

    if(empty($current5)) {
        $current5 = $old5;
    }

    $dir = $current1."~".$current2."~".$current3."~".$current4."~".$current5."~";

    while(strpos($dir, "~~")) {
        $dir = str_replace("~~", "~", $dir);
    }

    if(substr($dir, strlen($dir) - 1) <> "~") {
        $dir .= "~";
    }

    $cmd = "UPDATE `table_products` SET `name`='$product_name',`description`='$product_description',`price`='$product_price',`quantity`='$product_quantity',`category`='$product_category',`subcategory`='$product_subcategory',`images`='$dir' WHERE `id`='$product_id'"; 

    mysqli_query($connect, $cmd) or die(mysqli_error($connect));

    $cmd = "SELECT * FROM `table_filters`";
    $rows = mysqli_query($connect, $cmd) or die(mysqli_error($connect));

    $same_cat = "";

    if($rows) {
        while($row = mysqli_fetch_array($rows)) {
            $cat = strtolower($row['cat']);

            if($product_category == $cat) {
                $same_cat = $cat;
            }
        }
    }

    $product_subcategory .= "~";

    if(!empty($same_cat)) {
        $cmd = "SELECT * FROM `table_filters` WHERE `cat`='$same_cat'";
        $rows = mysqli_query($connect, $cmd) or die(mysqli_error($connect));

        if($rows) {
            while($row = mysqli_fetch_array($rows)) {
                $sub = strtolower($row['sub']);

                if(strpos($sub, $product_subcategory."~") === false) {
                    $sub .= $product_subcategory;

                    $cmd = "UPDATE `table_filters` SET `sub`='$sub' WHERE `cat`='$same_cat'";
                    mysqli_query($connect, $cmd) or die(mysqli_error($connect)); 
                }
            }
        }
    }else {
        $cmd = "INSERT INTO `table_filters`(`cat`, `sub`) VALUES('$product_category', '$product_subcategory')";
        mysqli_query($connect, $cmd) or die(mysqli_error($connect));
    }

    header("location: ../home.php");
    mysqli_close($connect);
}
?>