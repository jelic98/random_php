<?php
session_start();
include 'connection.php';

if(empty($_SESSION['id'])) {
    header("location: /login.php");
    exit;
}

$owner_id = $_SESSION['id'];

if(isset($_POST['shop_name']) &&
   isset($_POST['shop_city']) &&
   isset($_POST['shop_email']) &&
   isset($_POST['shop_zip_code']) &&
   isset($_POST['shop_phone_number']) &&
   isset($_POST['shop_address'])) {
    $shop_name = $_POST['shop_name'];
    $shop_email = $_POST['shop_email'];
    $shop_city = $_POST['shop_city'];  
    $shop_phone_number = $_POST['shop_phone_number']; 
    $shop_zip_code = $_POST['shop_zip_code']; 
    $shop_address = $_POST['shop_address']; 

    $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $explode = explode('/', $url);
    $shop_id = end($explode);

    if(isset($_POST['country'])) {
        $shop_country = strtolower($_POST['country']); 
    }else {
        $cmd = "SELECT * FROM `table_shops` WHERE `id`='$shop_id' AND `name`='$shop_name'";
        $rows = mysqli_query($connect, $cmd) or die(mysqli_error($connect));

        if($rows) {
            while($row = mysqli_fetch_array($rows)) {
                $shop_country = strtolower($row['country']);
            }
        } 
    }

    if(isset($_POST['order'])) {
        $shop_order = strtolower($_POST['order']); 
    }else {
        $cmd = "SELECT * FROM `table_shops` WHERE `id`='$shop_id' AND `name`='$shop_name'";
        $rows = mysqli_query($connect, $cmd) or die(mysqli_error($connect));

        if($rows) {
            while($row = mysqli_fetch_array($rows)) {
                $shop_order = $row['order'];
            }
        } 
    }

    $cmd = "SELECT * FROM `table_shops` WHERE `id`='$shop_id' AND `name`='$shop_name'";
    $rows = mysqli_query($connect, $cmd) or die(mysqli_error($connect));

    $number_of_rows = mysqli_num_rows($rows);

    if($number_of_rows > 0) {
        echo "Shop with this name already exists";
    }else {
        if(($_FILES['photo']['tmp_name']) && 
           is_uploaded_file($_FILES['photo']['tmp_name'])) {
            $file_name = $_FILES['photo']['name'];
            $file_tmp = $_FILES['photo']['tmp_name'];
            $explode = explode('.', $file_name);
            $end = end($explode);
            $file_ext = strtolower($end);
            $image = $shop_name.$owner_id.".".$file_ext;
            $dir = "images/".$image;
            move_uploaded_file($file_tmp, $dir);   
        }

        if(!empty($dir)) {
            $cmd = "UPDATE `table_shops` SET `name`='$shop_name',`address`='$shop_address',`order`='$shop_order',`email`='$shop_email',`city`='$shop_city',`country`='$shop_country',`image`='$dir',`zip_code`='$shop_zip_code',`phone_number`='$shop_phone_number' WHERE `owner_id`='$owner_id'";  
        }else {
            $cmd = "UPDATE `table_shops` SET `name`='$shop_name',`address`='$shop_address',`order`='$shop_order',`email`='$shop_email',`city`='$shop_city',`country`='$shop_country',`zip_code`='$shop_zip_code',`phone_number`='$shop_phone_number' WHERE `owner_id`='$owner_id'";
        }

        mysqli_query($connect, $cmd) or die(mysqli_error($connect));

        $cmd = "UPDATE `table_users` SET `shop`='$shop_name' WHERE `id`='$owner_id'";
        mysqli_query($connect, $cmd) or die(mysqli_error($connect));

        header("location: home.php"); 
        mysqli_close($connect);
    }
}
?>