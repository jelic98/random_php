<?php
session_start();
include 'connection.php';
include 'functions.php';

$header = "";

if(!empty($_SESSION['id'])) {
    $header .= '<a class="button button--winona button--border-thin button--text-thick button--inverted" href="/logout.php"><i class="fa fa-sign-out"></i></a>';
    $header .= '<a class="button button--winona button--border-thin button--text-thick button--inverted" href="/account.php"><i class="fa fa-user"></i></a>';
}else {
    $header .= '<a class="button button--winona button--border-thin button--text-thick button--inverted" href="/login.php"><i class="fa fa-sign-in"></i></a>';
    $header .= '<a class="button button--winona button--border-thin button--text-thick button--inverted" href="/register.php"><i class="fa fa-list-alt"></i></a>';
}

$country_name = "";
$flag = "";

if(!empty($_SESSION['country_name'])) {
    $country_name = $_SESSION['country_name'];

    $flag = '<a href="index.php"><img class="'.$country_name.'" id="flag"></a>';
    $rows = mysqli_query($connect, "SELECT * FROM `table_shops` WHERE `country`='$country_name'") or die(mysqli_error($connect)); 
}else {
    $flag = '<a href="index.php">X</a>';
    $rows = mysqli_query($connect, "SELECT * FROM `table_shops`") or die(mysqli_error($connect)); 
}

$user_id = $_SESSION['id'];

if(!empty($user_id)) {
    $cmd = "SELECT * FROM `table_users` WHERE `id`='$user_id'";
    $rows = mysqli_query($connect, $cmd) or die(mysqli_error($connect));

    if($rows) {
        while($row = mysqli_fetch_array($rows)) {
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
            $phone_number = $row['phone_number'];
            $email = $row['email'];
            $address = $row['address'];
            $city = $row['city'];
            $zip_code = $row['zip_code'];
            $country = $row['country'];
            $cart = $row['cart'];
            $shop = $row['shop'];
            $email_confirmed = $row['email_confirmed'];
        }
    }

    $result = "";

    if($email_confirmed == 0) {
        $result .= '<div class="confirmation">'; 
        $result .= '<p>You need to confirm your email address in order to use some features.</p>';
        $result .= '<a href="/resend.php">Confirm email now</a>';
        $result .= '</div>';
    }

    $totalCartItems = substr_count($cart, "~");

    $result .= '<div class="form-style">';
    $result .= '<h2>Account settings</h2>';
    $result .= '<form action="save_changes_account.php" method="POST">';
    $result .= '<p>Basic information</p>';
    $result .= '<input type="text" placeholder="First name" name="first_name" value="'.$first_name.'" required>'; 
    $result .= '<input type="text" placeholder="Last name" name="last_name" value="'.$last_name.'" required>'; 
    $result .= '<input type="number" placeholder="Phone number" name="phone_number" value="'.$phone_number.'" required>'; 
    $result .= '<input type="email" placeholder="Email" name="email" value="'.$email.'" required>'; 
    $result .= '<p>Location</p>';
    $result .= '<input type="text" placeholder="Address" name="address" value="'.$address.'" required>'; 
    $result .= '<input type="text" placeholder="City" name="city" value="'.$city.'" required>'; 
    $result .= '<input type="text" placeholder="Zip code" name="zip_code" value="'.$zip_code.'" required>'; 
    $result .= selectCountryCodePHP($result, $country);
    $result .= '<p>Change password</p>';
    $result .= '<input type="password" placeholder="Old password" id="old" name="old">';
    $result .= '<input type="password" placeholder="New password" id="new" name="new">';
    $result .= '<input type="password" placeholder="Repeat password" id="repeat" name="repeat">';
    $result .= '<p>Shop information</p>';

    if(!empty($shop)) {
        $cmd = "SELECT * FROM `table_shops` WHERE `name`='$shop'";
        $rows = mysqli_query($connect, $cmd) or die(mysqli_error($connect));

        if($rows) {
            while($row = mysqli_fetch_array($rows)) {
                $shop_id = $row['id'];
            }

            $result .= '<a href="edit_shop.php/'.$shop_id.'"><input id="shopButton" type="button" class="button button--winona button--border-thin button--text-thick button--inverted" value="Edit shop"></a>';
        }
    }else {
        $result .= '<a href="add_shop.php"><input id="shopButton" type="button" class="button button--winona button--border-thin button--text-thick button--inverted" value="Add shop"></a>';
    }

    $result .= '<input class="button button--winona button--border-thin button--text-thick button--inverted" type="submit" value="Save changes">';
    $result .= '</form>';
    $result .= '</div>';

    mysqli_close($connect);
}else {
    header("location: login.php");
}
?>
<html>
    <head>
        <title>Account</title>
        <link href="css/style.css" rel='stylesheet' type='text/css'/>
        <link rel="stylesheet" href="css/flags.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <script type='text/javascript' src="js/script.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="wrapper">
            <div class="header">
                <div class="header-left">
                    <?php echo $flag;?>
                </div>
                <div class="header-right">
                    <?php echo $header; ?>
                    <a class="button button--winona button--border-thin button--text-thick button--inverted" href="shopping_cart.php"><i class="fa fa-shopping-cart"></i> <?php echo $totalCartItems; ?></a>
                </div>
            </div>
            <div class="content-white">
                <?php echo $result; ?>
            </div>
            <div class="footer">
                <div class="footer-center">
                    <a href="home.php"><img src="images/logo.png"/></a>
                    <a href="#"><p>+443303500153</p></a>
                    <a href="#"><p>support@caspianmarkets.uk</p></a>
                    <p>Copyright 2016 CASPIAN MARKETS LTD All rights reserved</p>
                    <p>CASPIAN MARKETS LIMITED, a company registered in England and Wales. Company number: 8605389</p>
                </div>
            </div>
        </div>
    </body>
</html>
<?php
if(!empty($_SESSION['id'])) {
    echo '<script type="text/javascript">'
        , 'document.getElementById("loginButton").innerHTML = "Logout";'
            , 'document.getElementById("registerButton").innerHTML = "Account";'
                , '</script>';  
}
?>