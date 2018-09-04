<?php
include 'connection.php';

if(isset($_POST['email'])) {
    $email = $_POST['email'];
    $subject = "Caspian Markets: Reset passowrd";

    //get ticket
    $ticket = ;

    $body = "Change password by clicking on this URL: www.caspianmarkets.uk/new_password.php/"+$ticket;

    mail($email, $subject, $body, "From: support@caspianmarkets.uk") or die ("Mail could not be sent.");

    header("location: new_password.php");
    mysqli_close($connect);
}
?>