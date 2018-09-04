<?php
session_start();
include 'connection.php';
include 'functions.php';

if(empty($_SESSION['id'])) {
    header("location: /login.php");
    exit;
}

$header = "";

if(!empty($_SESSION['id'])) {
    $header .= '<a class="button button--winona button--border-thin button--text-thick button--inverted" href="/logout.php"><i class="fa fa-sign-out"></i></a>';
    $header .= '<a class="button button--winona button--border-thin button--text-thick button--inverted" href="/account.php"><i class="fa fa-user"></i></a>';
}else {
    $header .= '<a class="button button--winona button--border-thin button--text-thick button--inverted" href="/login.php"><i class="fa fa-sign-in"></i></a>';
    $header .= '<a class="button button--winona button--border-thin button--text-thick button--inverted" href="/register.php"><i class="fa fa-list-alt"></i></a>';
}

$user_id = $_SESSION['id'];

$country_name = "";
$flag = "";

if(!empty($_SESSION['country_name'])) {
    $country_name = $_SESSION['country_name'];
    $flag = '<a href="/index.php"><img class="'.$country_name.'" id="flag"></a>';
}else {
    $flag = '<a href="/index.php">X</a>'; 
}

$cmd = "SELECT * FROM `table_users` WHERE `id`='$user_id'";
$rows = mysqli_query($connect, $cmd) or die(mysqli_error($connect));

if($rows) {
    while($row = mysqli_fetch_array($rows)) {
        $cart = $row['cart'];
    }
}

$totalCartItems = substr_count($cart, "~");

$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$explode = explode('/', $url);
$shop_id = end($explode);

$cmd = "SELECT * FROM `table_shops` WHERE `id`='$shop_id'";
$rows = mysqli_query($connect, $cmd) or die(mysqli_error($connect));

$result = "";

if($rows) {
    while($row = mysqli_fetch_array($rows)) {
        $shop_id = $row['id'];
        $shop_name = $row['name'];
        $shop_email = $row['email'];
        $shop_country = $row['country'];
        $shop_city = $row['city'];
        $shop_address = $row['address'];
        $shop_zip_code = $row['zip_code'];
        $shop_phone_number = $row['phone_number'];
        $shop_image = "/".$row['image'];
        $owner_id = $row['owner_id'];
    }

    if($user_id != $owner_id) {
        echo "You are not the owner of this shop";
        exit;
    }

    $result .= '<div class="form-style">';
    $result .= '<h2>Edit shop details</h2>';
    $result .= '<form id="registration_form" action="/save_changes_shop.php" method="POST" enctype="multipart/form-data">';
    $result .= '<p>Basic information</p>';
    $result .= '<input placeholder="Name" value="'.$shop_name.'" name="shop_name" type="text" required autofocus>';
    $result .= '<input placeholder="Email" value="'.$shop_email.'" name="shop_email" type="email" required>';
    $result .= '<input placeholder="Phone number" value="'.$shop_phone_number.'" name="shop_phone_number" type="number" required>';
    $result .= '<select name="order" required>';
    $result .= '<option>Email</option>';
    $result .= '<option>SMS</option>';
    $result .= '<option>Telegram</option>';
    $result .= '</select>';
    $result .= '<p>Shop location</p>';
    $result .= '<input placeholder="Address" value="'.$shop_address.'" name="shop_address" type="text" required>';
    $result .= '<input placeholder="City" value="'.$shop_city.'" name="shop_city" type="text" required>';
    $result .= '<input placeholder="Zip code" value="'.$shop_zip_code.'" name="shop_zip_code" type="text" required>';
    $result .= selectCountryCodePHP($result, $shop_country); 
    $result .= '<p>Image</p>';
    $result .= '<img id="shop_image" src="'.$shop_image.'"/>';
    $result .= '<input name="photo" type="file"/>';
    $result .= '<input type="submit" class="button button--winona button--border-thin button--text-thick button--inverted" value="Save changes" id="register-submit">';
    $result .= '</form>';
    $result .= '</div>';
}
?>
<html>
    <header>
        <title>Edit shop</title>
        <link href="/css/style.css" rel='stylesheet' type='text/css'/>
        <link rel="stylesheet" href="/css/flags.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <script type='text/javascript' src="/js/script.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </header>
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
                    <a href="home.php"><img src="/images/logo.png"/></a>
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