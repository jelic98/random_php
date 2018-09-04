<?php
session_start();
$_SESSION = array();
session_destroy();
$_SESSION['admin'] = null;

header("location: admin.php");
?>