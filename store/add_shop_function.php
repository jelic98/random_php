<?php
session_start();
include 'connection.php'; 

if(empty($_SESSION['id'])) {
    header("location: /login.php");
    exit;
}

if(isset($_POST['shop_name']) &&
   isset($_POST['shop_city']) &&
   isset($_POST['country']) &&
   isset($_POST['order']) &&
   isset($_POST['shop_email']) &&
   isset($_POST['shop_address']) &&
   isset($_POST['shop_zip_code']) &&
   isset($_POST['shop_phone_number'])) {

    $shop_name = $_POST['shop_name'];
    $shop_email = $_POST['shop_email'];
    $shop_order = $_POST['order'];
    $shop_country = strtolower($_POST['country']);
    $shop_city = $_POST['shop_city'];
    $shop_address = $_POST['shop_address'];
    $shop_zip_code = $_POST['shop_zip_code'];
    $shop_phone_number = $_POST['shop_phone_number'];

    $owner_id = $_SESSION['id'];

    $cmd = "SELECT * FROM `table_shops` WHERE `name`='$shop_name'";
    $rows = mysqli_query($connect, $cmd) or die(mysqli_error($connect));

    $number_of_rows = mysqli_num_rows($rows);

    if($number_of_rows > 0) {
        echo "Shop with this name already exists";
    }else {
        $dir = "images/default.png";

        if(isset($_FILES['photo'])) {
            $dir = "";
            $file_name = $_FILES['photo']['name'];
            $file_tmp = $_FILES['photo']['tmp_name'];
            $explode = explode('.', $file_name);
            $end = end($explode);
            $file_ext = strtolower($end);
            $image = $owner_id.$shop_name.".".$file_ext;
            $dir = "images/".$image;
            move_uploaded_file($file_tmp, $dir);   
        }

        $cmd = "INSERT INTO `table_shops`(`name`, `country`, `city`, `order`, `email`, `address`, `zip_code`, `image`, `owner_id`) VALUES('$shop_name', '$shop_country', '$shop_city', '$shop_order', '$shop_email', '$shop_address', '$shop_zip_code', '$dir', '$owner_id')";

        mysqli_query($connect, $cmd) or die(mysqli_error($connect));

        $cmd = "UPDATE `table_users` SET `shop`='$shop_name' WHERE `id`='$owner_id'";
        mysqli_query($connect, $cmd) or die(mysqli_error($connect));

        header("location: account.php");
    }

    mysqli_close($connect);
}
?>