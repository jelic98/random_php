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

$cmd = "SELECT * FROM `table_shops` WHERE `owner_id`='$user_id'";
$rows = mysqli_query($connect, $cmd) or die(mysqli_error($connect));

$counter = mysqli_num_rows($rows);

if($counter == 0) {
    if(!empty($user_id)) {
        $country_name = "";
        $flag = "";

        if(!empty($_SESSION['country_name'])) {
            $country_name = $_SESSION['country_name'];

            $flag = '<a href="index.php"><img class="'.$country_name.'" id="flag"></a>';
        }else {
            $flag = '<a href="index.php">X</a>';
        }

        $totalCartItems = 0;

        $cmd = "SELECT * FROM `table_users` WHERE `id`='$user_id'";
        $rows = mysqli_query($connect, $cmd) or die(mysqli_error($connect));

        if($rows) {
            while($row = mysqli_fetch_array($rows)) {
                $cart = $row['cart'];
            }
        }

        $totalCartItems = substr_count($cart, "~");
    }else {
        header("location: login.php");
    }
}else {
    echo "You already have a shop"; 
    exit;
}
?>
<html>
    <header>
        <title>Add shop</title>
        <link href="css/style.css" rel='stylesheet' type='text/css'/>
        <link rel="stylesheet" href="css/flags.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <script type='text/javascript' src="js/script.js"></script>
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
            <div class="form-style">
                <h2>Enter shop details</h2>
                <form id="registration_form" action="add_shop_function.php" method="POST" enctype="multipart/form-data">
                    <p>Basic information</p>
                    <input placeholder="Name" name="shop_name" type="text" required autofocus>
                    <input placeholder="Email" name="shop_email" type="email" required>
                    <input placeholder="Phone number" name="shop_phone_number" type="number" required>
                    <select name="order" required>
                        <option>Receive orders by</option>
                        <option>Email</option>
                        <option>SMS</option>
                        <option>Telegram</option>
                    </select>
                    <p>Shop location</p>
                    <input placeholder="Address" name="shop_address" type="text" required>
                    <input placeholder="City" name="shop_city" type="text" required>
                    <input placeholder="Zip code" name="shop_zip_code" type="text" required>
                    <?php selectCountryCodeHTML(); ?>
                    <p>Image</p>
                    <input name="photo" type="file"/>
                    <input type="submit" class="button button--winona button--border-thin button--text-thick button--inverted" value="Add shop" id="register-submit">
                </form>
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


