<?php
session_start();
include 'connection.php';

if(empty($_SESSION['id'])) {
    header("location: /login.php");
    exit;
}

$user_id = $_SESSION['id'];

$cmd = "SELECT * FROM `table_users` WHERE `id`='$user_id'";
$rows = mysqli_query($connect, $cmd) or die(mysqli_error($connect));

if($rows) {
    while($row = mysqli_fetch_array($rows)) {
        $email_confirmed = $row['email_confirmed'];
    }
}

if($email_confirmed == 0) {
    echo "You need to confirm you email address to use this feature";
    exit;
}

$cart = "";

$cmd = "SELECT * FROM `table_users` WHERE `id`='$user_id'";
$rows = mysqli_query($connect, $cmd) or die(mysqli_error($connect));

if($rows) {
    while($row = mysqli_fetch_array($rows)) {
        $cart = $row['cart'];
    }
}

$shops = array();

while(strpos($cart, "~") > 0) {
    $extract = substr($cart, 0, strpos($cart, "~"));
    $id = substr($extract, 0, strpos($extract, "*"));
    $qty = substr($extract, strpos($extract, "*") + 1);
    $cart = str_replace($extract."~", "", $cart);

    $cmd = "SELECT * FROM `table_products` WHERE `id`='$id'";
    $rows = mysqli_query($connect, $cmd) or die(mysqli_error($connect));

    if($rows) {
        while($row = mysqli_fetch_array($rows)) {
            $shop_id = $row['shop_id'];
        }
    }

    $shops[] = $shop_id."~".$id."*".$qty;
}

$orders = array();

for($i = 0; $i < count($shops); $i++) {
    $counter = 0;

    for($j = 0; $j < count($orders); $j++) {
        $current = substr($shops[$i], 0, strpos($shops[$i], "~"));
        $next = substr($orders[$j], 0, strpos($orders[$j], "~"));

        if($current == $next) {
            $counter++;
        } 
    }

    if($counter == 0) {
        $orders[] = $shops[$i];
    }

    for($j = $i + 1; $j < count($shops); $j++) {
        if(substr($shops[$i], 0, strpos($shops[$i], "~")) 
           == substr($shops[$j], 0, strpos($shops[$j], "~"))) {
            $j_th_extract = substr($shops[$j], strpos($shops[$j], "~") + 1);
            $j_th_id = substr($j_th_extract, 0, strpos($j_th_extract, "*"));
            $j_th_qty = substr($j_th_extract, strpos($j_th_extract, "*") + 1);

            $index = count($orders) - 1;

            $orders[] = $orders[$index]."~".$j_th_id."*".$j_th_qty;
        }
    }
}

for($i = 0; $i < count($orders); $i++) {
    for($j = 0; $j < count($orders); $j++) {
        $current = substr($orders[$i], 0, strpos($orders[$i], "~"));
        $next = substr($orders[$j], 0, strpos($orders[$j], "~"));

        if($current == $next) {
            $len_i = strlen($orders[$i]);
            $len_j = strlen($orders[$j]);

            if($len_i > $len_j) {
                $orders[$j] = "";
            }elseif($len_i < $len_j) {
                $orders[$i] = "";
            }
        } 
    }
}

$final = array();

for($i = 0; $i < count($orders); $i++) {
    if(!empty($orders[$i])) {
        $final[] = $orders[$i]."END";
    }
}

for($i = 0; $i < count($final); $i++) {
    $shop_id = substr($final[$i], 0, strpos($final[$i], "~"));

    $cmd = "SELECT * FROM `table_shops` WHERE `id`='$shop_id'";
    $rows = mysqli_query($connect, $cmd) or die(mysqli_error($connect));

    if($rows) {
        while($row = mysqli_fetch_array($rows)) {
            $order = $row['order'];

            if($order == "sms") {
                //sms order handling
            }elseif($order == "email") {
                $email = $row['email'];
                $phone = "";
            }elseif($order == "telegram") {
                //telegram order handling
            }
        }
    }

    $body = "ORDER DETAILS\n\n";

    while(strpos($final[$i], "~") > 0) {
        $id = substr($final[$i], strpos($final[$i], "~") + 1, strpos($final[$i], "*"));
        $qty = substr($final[$i], strpos($final[$i], "*") + 1, strpos($final[$i], "END"));

        $cmd = "SELECT * FROM `table_products` WHERE `id`='$id'";
        $rows = mysqli_query($connect, $cmd) or die(mysqli_error($connect));

        if($rows) {
            while($row = mysqli_fetch_array($rows)) {
                $name = $row['name'];
                $price = $row['price'];
            }
        }

        $total = $qty * $price;

        $body .= "Product name: ".$name."\n";
        $body .= "Product quantity: ".$qty."\n";
        $body .= "Product price: $".$price."\n";
        $body .= "Total price: $".$total."\n\n";

        $final[$i] = str_replace("~".$id."*".$qty, "", $final[$i]);
    }

    $cmd = "SELECT * FROM `table_users` WHERE `id`='$user_id'";
    $rows = mysqli_query($connect, $cmd) or die(mysqli_error($connect));

    if($rows) {
        while($row = mysqli_fetch_array($rows)) {
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
            $phone_numebr = $row['phone_numebr'];
            $address = $row['address'];
            $city = $row['city'];
            $zip_code = $row['zip_code'];
            $country_code = $row['country'];
            $user_email = $row['email'];
        }
    }

    $body .= "CUSTOMER DETAILS\n\n";
    $body .= "First name: ".$first_name."\n";
    $body .= "Last name: ".$last_name."\n";
    $body .= "Phone number: ".$phone_number."\n";
    $body .= "Email: ".$user_email."\n";
    $body .= "Address: ".$address."\n";
    $body .= "City: ".$city."\n";
    $body .= "Zip code: ".$zip_code."\n";
    $body .= "Country code: ".$country."\n\n";

    if(!empty($email)) {
        //mail($email, "Order from Caspian Markets", $body, "From: support@caspianmarkets.uk") or die ("Order could not be sent.");
    }elseif(!empty($phone)) {
        //sms order handling
    }
}

$cmd = "UPDATE `table_users` SET `cart`='' WHERE `id`='$user_id'";
//mysqli_query($connect, $cmd) or die(mysqli_query($connect));

mysqli_close($connect);
//header("location: home.php");
?>