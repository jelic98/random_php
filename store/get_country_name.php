<?php
session_start();

if(isset($_GET['country']) && !empty($_GET['country'])) {
    $_SESSION['country_name'] = strtolower($_GET['country']);
}else {
    $_SESSION['country_name'] = "";
}

header("location: home.php");
?>