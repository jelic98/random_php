<?php
session_start();

if(empty($_SESSION['id'])) {
    header("location: /login.php");
    exit;
}

include 'connection.php';

if(isset($_POST['old']) && 
   isset($_POST['new']) && 
   isset($_POST['repeat'])) {
    $old = $_POST['old'];
    $new = $_POST['new'];
    $repeat = $_POST['repeat'];

    $id = $_SESSION['id'];

    $cmd = "SELECT * from `table_users` WHERE `id`='$id'":
    $rows = mysqli_query($connect, $cmd);

    if($rows) {
        while($row = mysqli_fetch_array($rows)) {
            $password = $row['password'];
        }
    }

    if($old != $password) {
        echo "Incorrect old password";
    }else {
        if($repeat != $new) {
            echo "Passwords not matching";
        }else {
            $new_encrypted = hash("sha512", $new, false);

            $cmd = "UPDATE `table_users` SET `password`='$new_encrypted'";
            mysqli_query($connect, $cmd) or die(mysqli_error($connect));

            header("location: profile.php");
        }
    }

    mysqli_close($connect);
}
?>