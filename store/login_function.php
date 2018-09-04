<?php
session_start();
include 'connection.php';

/*
    add remember me function
*/

if(isset($_POST['email']) &&
   isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $encrypted_password = hash("sha512", $password, false);

    $cmd = "SELECT * FROM `table_users` WHERE `email`='$email' AND `password`= '$encrypted_password'";
    $rows = mysqli_query($connect, $cmd) or die(mysqli_error($connect));

    $number_of_rows = mysqli_num_rows($rows);
    if ($number_of_rows > 0) {
        if($rows) {
            while($row = mysqli_fetch_array($rows)) {
                $_SESSION['id'] = $row['id'];
                $_SESSION['first_name'] = $row['first_name'];
                $_SESSION['last_name'] = $row['last_name'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['admin'] = $row['admin'];
                $_SESSION['country'] = $row['country'];
                $_SESSION['address'] = $row['address'];
                $_SESSION['zip_code'] = $row['zip_code'];
                $_SESSION['cart'] = $row['cart'];

                $id = $_SESSION['id'];

                $cmd = "SELECT * FROM `table_shops` WHERE `owner_id`='$id'";
                $rows = mysqli_query($connect, $cmd) or die(mysqli_error($connect));

                if($rows) {
                    while($row = mysqli_fetch_array($rows)) {
                        $_SESSION['shop_id'] = $row['id'];
                        $_SESSION['shop_name'] = $row['name'];
                    }
                }

                header("location: index.php");
            }
        }
    }else {
        header("location: bad_login.html");
    }

    if(!isset($_POST['remeber'])) {

    }

    mysqli_close($connect);
}
?>