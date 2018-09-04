<?php
session_start();
include 'connection.php';

$id = $_SESSION['id'];

if(isset($_POST['first_name']) &&
   isset($_POST['last_name']) &&
   isset($_POST['email']) &&
   isset($_POST['phone_number']) &&
   isset($_POST['address']) &&
   isset($_POST['city']) &&
   isset($_POST['zip_code']) &&
   isset($_POST['country'])) {

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $zip_code = $_POST['zip_code'];
    $country = strtolower($_POST['country']);

    if(isset($_POST['new'])) {
        if(!isset($_POST['old'])) {
            echo "Enter your current password";
        }

        if(!isset($_POST['repeat'])) {
            echo "Repeat your new password";
        }

        $old = $_POST['old'];
        $new = $_POST['new'];
        $repeat = $_POST['repeat'];

        $cmd = "SELECT * from `table_users` WHERE `id`='$id'";
        $rows = mysqli_query($connect, $cmd);

        if($rows) {
            while($row = mysqli_fetch_array($rows)) {
                $password = $row['password'];
            }
        }

        $old_encrypted = hash("sha512", $old, false);

        if($old_encrypted != $password) {
            echo "Incorrect old password";
        }else {
            if($repeat != $new) {
                echo "Passwords not matching";
            }else {
                $new_encrypted = hash("sha512", $new, false);

                $cmd = "UPDATE `table_users` SET `password`='$new_encrypted' WHERE `id`='$id'";
                mysqli_query($connect, $cmd) or die(mysqli_error($connect));
            }
        }
    }

    $cmd = "UPDATE `table_users` SET `first_name`='$first_name',`last_name`='$last_name', `email`='$email',`country`='$country',`phone_number`='$phone_number',`zip_code`='$zip_code',`address`='$address',`city`='$city' WHERE `id`='$id'";
    mysqli_query($connect, $cmd) or die(mysqli_error($connect));

    header("location: account.php");
    mysqli_close($connect);	
}else {
    echo "Fill out all required form fields";
}
?>