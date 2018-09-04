<?php
session_start();
include 'connection.php';

if(!empty($_SESSION['id'])) {
    $user_id = $_SESSION['id'];

    $cmd = "SELECT * FROM `table_users` WHERE `id`='$user_id'";
    $rows = mysqli_query($connect, $cmd) or die(mysqli_error($connect));

    if($rows) {
        while($row = mysqli_fetch_array($rows)) {
            $email = $row['email'];
        }
    }

    $ticket = hash("sha512", $email, false);
    $url = "www.caspianmarkets.uk/email_confirmed.php?ticket=".$ticket;

    $subject = "Caspian Markets: Email confirmation";
    $body = "Confirm your email by clicking on this URL: ".$url;

    mail($email, $subject, $body, "From: support@caspianmarkets.co.uk") or die ("Mail could not be sent.");
    mysqli_close($connect);
}

header("location: confirm_email.html");
?>