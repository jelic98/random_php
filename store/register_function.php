<?php
session_start();
include 'connection.php';

if(isset($_POST['first_name']) &&
   isset($_POST['last_name']) &&
   isset($_POST['email']) &&
   isset($_POST['password']) &&
   isset($_POST['repeat_password']) &&
   isset($_POST['phone_number']) &&
   isset($_POST['city']) &&
   isset($_POST['address']) &&
   isset($_POST['zip_code']) &&
   isset($_POST['country'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repeat_password = $_POST['repeat_password'];
    $country = strtolower($_POST['country']);
    $city = $_POST['city'];
    $address = $_POST['address'];
    $zip_code = $_POST['zip_code'];
    $zip_code = $_POST['phone_number'];

    if($repeat_password != $password) {
        echo "Passwords not matching";
    }else {
        $ecrypted_password = hash("sha512", $password, false);

        $cmd = "SELECT * FROM `table_users` WHERE `email`='$email'";
        $rows = mysqli_query($connect, $cmd) or die(mysqli_error($connect));

        $number_of_rows = mysqli_num_rows($rows);

        if($number_of_rows > 0) {
            echo "User with this email already exists";
        }else {
            $cmd = "INSERT INTO `table_users`(`first_name`, `last_name`, `password`, `email`, `country`, `city`, `address`, `zip_code`, `phone_number`) VALUES('$first_name', '$last_name', '$ecrypted_password', '$email', '$country', '$city', '$address', '$zip_code', '$phone_number')";
            mysqli_query($connect, $cmd) or die(mysqli_error($connect));

            header("location: index.php");
        }   
    }
}

mysqli_close($connect);	
?>