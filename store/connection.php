<?php
/*
    connection parameters

    username: root
    password: root

    username: amiresfa_caspian
    password: amiresfa_caspian
*/
$connect = mysqli_connect("127.0.0.1", "root", "root") or die(mysqli_error($connect)); 
mysqli_select_db($connect, "amiresfa_caspianmarkets") or die(mysqli_error($connect));   
?>