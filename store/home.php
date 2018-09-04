<?php
session_start();
include 'connection.php';

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

$header = "";

if(!empty($_SESSION['id'])) {
    $header .= '<a class="button button--winona button--border-thin button--text-thick button--inverted" href="/logout.php"><i class="fa fa-sign-out"></i></a>';
    $header .= '<a class="button button--winona button--border-thin button--text-thick button--inverted" href="/account.php"><i class="fa fa-user"></i></a>';
}else {
    $header .= '<a class="button button--winona button--border-thin button--text-thick button--inverted" href="/login.php"><i class="fa fa-sign-in"></i></a>';
    $header .= '<a class="button button--winona button--border-thin button--text-thick button--inverted" href="/register.php"><i class="fa fa-list-alt"></i></a>';
}

$result = "";
$totalShops = 0;

if($rows) {
    while($row = mysqli_fetch_array($rows)) {
        $name = $row['name'];
        $image = $row['image'];
        $id = $row['id'];

        $result .= '<div class="grids-of-4">';
        $result .= '<div class="grid1-of-4">';
        $result .= '<img id="'.$id.'" src="'.$image.'" class="'.$name.'" onclick="shopOnClick(this)"/>';
        $result .= '<h4 class="'.$name.'" onclick="shopOnClick(this)">'.$name.'</h4>'; 
        $result .= '</div>';    
        $result .= '</div>';

        $totalShops++;
    }
}

if($totalShops == 0) {
    $total = '<div class="content-top">';
    $total .= '<h2>There are no shops matching the selection</h2>';
    $total .= '</div>';
}else {
    $total = "";
}

$cart = "";

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

$cmd = "SELECT * FROM `table_products`";
$rows = mysqli_query($connect, $cmd);  

$side_cart = "";

$totalPrice = 0;

if($rows) {
    while($row = mysqli_fetch_array($rows)) {
        $product_id = $row['id'];
        $product_name = $row['name'];
        $product_price = $row['price'];
        $product_image = $row['images'];

        if(strpos($product_image, "*") !== false) {
            $product_image = current(explode("*", $product_image));
        }

        if(strpos($cart, $product_id."*") !== false) {
            $product_quantity_first_cut = substr($cart, strpos($cart, "~".$product_id) + strlen("~".$product_id."*"));

            if(substr_count($product_quantity_first_cut, "~") > 0) {
                $product_quantity = substr($product_quantity_first_cut, 0, strpos($product_quantity_first_cut, "~"));
            }else {
                $product_quantity = $product_quantity_first_cut;
            }

            $totalPrice += $product_price * $product_quantity;

            $side_cart .= '<div class="side_cart">';
            $side_cart .= '<img id="'.$product_id.'" src="/'.$product_image.'" class="'.$product_id.'" onclick="productOnClick(this)"/>';
            $side_cart .= '<h4 class="'.$product_id.'" onclick="productOnClick(this)">'.$product_name.'</h4>';
            $side_cart .= '</div>'; 
        }else {
            $side_cart .= "";
        }
    }
}

mysqli_close($connect);
?>
<html>
    <header>
        <title>Caspian Markets</title>
        <link href="css/style.css" rel='stylesheet' type='text/css'/>
        <link rel="stylesheet" href="css/flags.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <script type='text/javascript' src="js/script.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </header>
    <body>
        <div class="header">
            <div class="header-left">
                <?php echo $flag;?>
            </div>
            <div class="header-right">
                <?php echo $header; ?>
                <a class="button button--winona button--border-thin button--text-thick button--inverted" href="shopping_cart.php"><i class="fa fa-shopping-cart"></i> <?php echo $totalCartItems; ?></a>
                <div class="search">
                    <form action="search.php" method="GET">
                        <div class="form-style">
                            <input id="search" type="search" id="filters-search-input" placeholder="Search..." name="criteria">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="content">
            <?php echo $total; ?>
            <?php echo $result; ?>
        </div>
        <div class="pager-wrapper">
            <div class="pager">
                <p>&lt; 1 2 3 .. 9 &gt;</p>
            </div>
        </div>
        <div class="right-sidebar">
            <p>Shopping cart</p>
            <p>$ <?php echo $totalPrice; ?></p>
            <div class="side_cart_list">
                <?php echo $side_cart; ?>
            </div>
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
    </body>
</html>