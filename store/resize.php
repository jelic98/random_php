<?php
include 'functions.php';

if(isset($_FILES['photo'])) {
    $file_name = $_FILES["photo"]["name"];
    $file_tmp = $_FILES["photo"]["tmp_name"];
    $explode = explode('.', $file_name);
    $end = end($explode);
    $file_ext = strtolower($end);
    $image = "".$file_ext;
    $current = "images/".$image;
    $filename = compress_image($_FILES["photo"]["tmp_name"], $current);
    $img = resize($filename, $current);
}

header('Content-Type: image/jpeg');
imagejpeg($img);
imagedestroy($img);
?>