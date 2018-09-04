<?php
session_start();
include 'connection.php';
include 'functions.php';

$country_name = "";
$flag = "";

if(!empty($_SESSION['country_name'])) {
    $country_name = $_SESSION['country_name'];
    $flag = '<a href="../index.php"><img class="'.$country_name.'" id="flag"></a>';
}else {
    $flag = '<a href="../index.php">X</a>';
}

$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$explode = explode('/', $url);
$shop_name = end($explode);

$cmd = "SELECT * FROM `table_shops` WHERE `name`='$shop_name'";
$rows = mysqli_query($connect, $cmd) or die(mysqli_error($connect));

if($rows) {
    while($row = mysqli_fetch_array($rows)) {
        $image = $row['image'];
        $shop_id = $row['id'];
        $owner_id = $row['owner_id'];
        $address = $row['address']."<br/>".$row['city'].", ".$row['country'];
    }
}

$title = '<title>'.$shop_name.' details</title>';

$shop_info = '<img src="/'.$image.'">';
$shop_info .= '<h1>'.$shop_name.'</h1>';
$shop_info .= '<h3>'.$address.'</h3>';

$cmd = "SELECT * FROM `table_users` WHERE `id`='$owner_id'";
$rows = mysqli_query($connect, $cmd) or die(mysqli_error($connect));

if(!empty($owner_id)) {
    if($rows) {
        while($row = mysqli_fetch_array($rows)) {
            $owner = $row['first_name']." ".$row['last_name']." (owner)";
        }
    }
}else {
    $owner = "Cannot get owner information";
}

$shop_info .= '<h3>'.$owner.'</h3>';

$rows = mysqli_query($connect, "SELECT * FROM `table_products` WHERE `shop_id`='$shop_id'") or die(mysqli_error($connect));

$result = "";
$totalItems = 0;

$unsorted_price = array();
$unsorted_id = array();

if($rows) {
    $i = 0;

    while($row = mysqli_fetch_array($rows)) {
        $unsorted_price[$i] = $row['price'];
        $unsorted_id[$i] = $row['id'];

        $i++;
    }
}

$add_product = "";
$edit_shop = "";

if((!empty($_SESSION['id'])) && 
   ($owner_id == $_SESSION['id'])) {
    $add_product = '<a class="button button--winona button--border-thin button--text-thick button--inverted" id="add_product" href="/add_product.php">Add product</a>';
    $edit_shop .= '<a class="button button--winona button--border-thin button--text-thick button--inverted" id="add_product" href="/edit_shop.php/'.$shop_id.'">Edit shop</a>';
}  

if(!empty($_SESSION['id'])) {
    $user_id = $_SESSION['id'];

    $cmd = "SELECT * FROM `table_users` WHERE `id`='$user_id'";
    $rows = mysqli_query($connect, $cmd) or die(mysqli_error($connect));

    if($rows) {
        while($row = mysqli_fetch_array($rows)) {
            $cart = $row['cart'];
        }
    }

    $totalCartItems = substr_count($cart, "~");
}else {
    $totalCartItems = 0;
}

mysqli_close($connect);
?>
<html>
    <header>
        <?php echo $title; ?>
        <link href="/css/style.css" rel='stylesheet' type='text/css'/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="/css/flags.css" />
        <script type='text/javascript' src="/js/script.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </header>
    <body>
        <div class="wrapper">
            <div class="header">
                <div class="header-left">
                    <a href="/home.php"><img src="/images/logo.png" id="logo"/></a>
                    <?php echo $flag;?>
                </div>
                <div class="header-right">
                    <a class="button button--winona button--border-thin button--text-thick button--inverted" href="/login.php" onclick="loginOrLogout()" id="loginButton">Login</a>
                    <a class="button button--winona button--border-thin button--text-thick button--inverted" href="/register.php" onclick="registerOrAccount()" id="registerButton">Register</a>
                    <a class="button button--winona button--border-thin button--text-thick button--inverted" href="/shopping_cart.php">Cart (<?php echo $totalCartItems; ?>)</a>
                </div>
            </div>
            <div class="content">
                <div class="shop-info">
                    <?php echo $shop_info; ?>
                </div>
                <div class="content-top">
                    <?php echo $add_product; echo $edit_shop; ?>
                </div>
                <?php echo $result; ?>
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