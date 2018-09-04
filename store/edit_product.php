<?php
session_start();
include 'connection.php';

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

$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$explode = explode('/', $url);
$id = end($explode);

$user_id = $_SESSION['id'];

$cmd = "SELECT * FROM `table_products` WHERE `id`='$id'";
$rows = mysqli_query($connect, $cmd) or die(mysqli_error($connect));

if($rows) {
    while($row = mysqli_fetch_array($rows)) {
        $shop_id = $row['shop_id'];
    }
}

$cmd = "SELECT * FROM `table_shops` WHERE `id`='$shop_id'";
$rows = mysqli_query($connect, $cmd) or die(mysqli_error($connect));

if($rows) {
    while($row = mysqli_fetch_array($rows)) {
        $owner_id = $row['owner_id'];
    }
}

if($user_id != $owner_id) {
    echo "You are not the owner of this shop";
    exit;
}

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

$cmd = "SELECT * FROM `table_products` WHERE `id`='$id'";
$rows = mysqli_query($connect, $cmd) or die(mysqli_error($connect));

$result = "";

if($rows) {
    while($row = mysqli_fetch_array($rows)) {
        $name = $row['name'];
        $price = $row['price'];
        $description = $row['description'];
        $category = $row['category'];
        $subcategory = $row['subcategory'];
        $quantity = $row['quantity'];
        $images = $row['images'];
    }

    $result .= '<div class="form-style">';
    $result .= '<h2>Enter product details</h2>';
    $result .= '<form action="../save_changes_product.php/'.$id.'" method="POST" enctype="multipart/form-data">';
    $result .= '<p>Basic information</p>';
    $result .= '<input placeholder="Name" value="'.$name.'" name="product_name" type="text" required autofocus>';
    $result .= '<input placeholder="Description" value="'.$description.'" name="product_description" type="text" required>';
    $result .= '<input placeholder="Price" value="'.$price.'" name="product_price" type="number" required>';
    $result .= '<input placeholder="Quantity" value="'.$quantity.'" name="product_quantity" type="number" required>';
    $result .= '<input placeholder="Category" value="'.$category.'" name="product_category" type="text" required>';
    $result .= '<input placeholder="Subcategory" value="'.$subcategory.'" name="product_subcategory" type="text" required>';

    $index = 1;

    while(strpos($images, "~") > 0) {
        $current = substr($images, 0, strpos($images, "~"));
        $images = str_replace($current."~", "", $images);

        if($index == 1) {
            $result .= '<p>Primary image</p>';
            $result .= '<img id="product_image" src="/'.$current.'"/>';
            $result .= '<input name="photo1" type="file">';
            $result .= '<p>Optional images</p>';
        }else {
            $result .= '<img id="product_image" src="/'.$current.'"/>';
            $result .= '<input name="photo'.$index.'" type="file">';
        }

        $index++;
    }

    $result .= '<input type="submit" class="button button--winona button--border-thin button--text-thick button--inverted" value="Save changes" id="register-submit">';
    $result .= '</form>';
    $result .= '</div>';
}

mysqli_close($connect);
?>
<html>
    <header>
        <title>Edit product</title>
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