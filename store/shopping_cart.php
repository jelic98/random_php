<?php
session_start();
include 'connection.php';

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
}else {
    $flag = '<a href="index.php">X</a>';
}

$user_id = $_SESSION['id'];

if(!empty($user_id)) {
    $cmd = "SELECT * FROM `table_users` WHERE `id`='$user_id'";
    $rows = mysqli_query($connect, $cmd) or die(mysqli_error($connect));

    if($rows) {
        while($row = mysqli_fetch_array($rows)) {
            $cart = $row['cart'];
        }
    }

    $totalCartItems = substr_count($cart, "~");

    $cmd = "SELECT * FROM `table_products`";
    $rows = mysqli_query($connect, $cmd);  

    $result = "";

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
                $product_quantity_first_cut = substr($cart, strpos($cart, $product_id) + strlen($product_id."*"));

                if(substr_count($product_quantity_first_cut, "~") > 0) {
                    $product_quantity = substr($product_quantity_first_cut, 0, strpos($product_quantity_first_cut, "~"));
                }else {
                    $product_quantity = $product_quantity_first_cut;
                }

                $totalPrice += $product_price * $product_quantity;

                $result .= '<div class="list_item">';
                $result .= '<img id="'.$product_id.'" src="/'.$product_image.'" class="'.$product_id.'" onclick="productOnClick(this)"/>';
                $result .= '<h4 class="'.$product_id.'" onclick="productOnClick(this)">'.$product_name.'</h4>';
                $result .= '<p>Qty: <p id="qty'.$product_id.'">'.$product_quantity.'</p></p>';
                $result .= '<div class="item_add"><span class="item_price"><h3>$'.$product_price.'</h3></span></div>';
                $result .= '<a class="button button--winona button--border-thin button--text-thick button--inverted" onclick="removeProduct(this)" id="'.$product_id.'">Remove item</a>';
                $result .= '</div>'; 
            }else {
                $result .= "";
            }
        }
    }

    $title = "<title>Cart (".$totalCartItems.")</title>";

    $price = "";
    $total = "";
    $empty = "";
    $checkout = "";

    if($totalCartItems == 0) {
        $total = "<h2>Your shopping cart is empty</h2>";
    }else {
        $total = "<h3>Total items - ".$totalCartItems."</h3>";
        $price = "<h3>Total price - $".$totalPrice."</h3>";
        $empty = '<a class="button button--winona button--border-thin button--text-thick button--inverted" href="empty_cart.php">Remove all items</a>';
        $checkout = '<a class="button button--winona button--border-thin button--text-thick button--inverted" href="checkout.php">Checkout</a>';
    }

    mysqli_close($connect);
}else {
    header("location: login.php");
}
?>
<html>
    <head>
        <?php echo $title; ?>
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
            <div class="content">
                <div class="content-top">
                    <?php echo $total; echo $price; echo $empty; echo $checkout; ?>
                </div>
                <div class="list">
                    <?php echo $result; ?>
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