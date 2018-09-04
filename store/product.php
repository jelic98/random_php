<?php
session_start();
include 'functions.php';
include 'connection.php';

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
$location = end($explode);

$id = substr($location, 0, strpos($location, "-"));

$cmd = "SELECT * FROM `table_products` WHERE `id`='$id'";
$rows = mysqli_query($connect, $cmd) or die(mysqli_error($connect));

if($rows) {
    while($row = mysqli_fetch_array($rows)) {
        $name = $row['name'];
        $images = $row['images'];
        $price = $row['price'];
        $shop_id = $row['shop_id'];
        $description = $row['description'];
        $category = $row['category'];
        $subcategory = $row['subcategory'];
        $product_rating = $row['rating'];

        $inner_cmd = "SELECT * FROM `table_shops` WHERE `id`='$shop_id'";
        $inner_rows = mysqli_query($connect, $inner_cmd) or die(mysqli_error($connect));

        if($inner_rows) {
            while($inner_row = mysqli_fetch_array($inner_rows)) {
                $owner_id = $inner_row['owner_id'];
                $shop_image = $inner_row['image'];
                $shop_name = $inner_row['name'];
                $address = $inner_row['address']."<br/>".$inner_row['city'].", ".$inner_row['country'];
            }
        }
    }
}

$description = "<b>Product description:</b> ".$description;

$shop_info_footer = '<p>'.$address.'</p>';

if(is_null($product_rating)) {
    $product_rating = 3;
}else {
    $product_rating = round($product_rating);   
}

$rating = '<p>Rate this product</p>';
$rating .= '<fieldset class="rating">';

for($i = 5; $i > 0; $i--) {
    $checked = '';

    if($i == $product_rating) {
        $checked = ' checked';
    }

    $rating .= '<input type="radio" class="'.$id.'" id="star'.$i.'" name="rating" value="'.$i.'"'.$checked.'>';
    $rating .= '<label onclick="rateProduct(this)" class="full" for="star'.$i.'"></label>';
}

$rating .= '</fieldset>';

$buttons = '<div class="buttons-wrapper">';
$buttons .= '<a class="button button--winona button--border-thin button--text-thick button--inverted" onclick="addProductToCart(this)" id="'.$id.'">Add to cart</a>';

if(!empty($_SESSION['id']) && $owner_id == $_SESSION['id']) {
    $buttons .= '<a class="button button--winona button--border-thin button--text-thick button--inverted" href="/edit_product.php/'.$id.'">Edit product</a>';
    $buttons .= '<a class="button button--winona button--border-thin button--text-thick button--inverted" href="/delete_product.php/'.$id.'">Delete product</a>';
}

$buttons .= '</div>';

$image_container = '<div class="image-container">';
$index = 1;

while(strpos($images, "~") > 0) {
    $current = substr($images, 0, strpos($images, "~"));

    if($index == 1) {
        $image_container .= '<img onclick="zoomImage(this)" id="image-primary" src="/'.$current.'"/>';
        $image_container .= '</div>';
    }else {
        if(!empty($current)) {
            $image_container .= '<img class="image-secondary" onclick="selectImage(this)" src="/'.$current.'"/>';
        }
    }

    $images = str_replace($current."~", "", $images); 
    $index++;
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

$title = '<title>'.$name.'</title>';

$logo = '<a href="/shop.php/'.$shop_name.'"><img src="/'.$shop_image.'" id="logo"/></a>';
$logo .= '<h1>'.$shop_name.'</h1>';

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

$shop_info_footer .= '<p>'.$owner.'</p>';

$add_product = "";
$edit_shop = "";

if((!empty($_SESSION['id'])) && 
   ($owner_id == $_SESSION['id'])) {
    $add_product = '<a class="button button--winona button--border-thin button--text-thick button--inverted" id="add_product" href="/add_product.php">Add product</a>';
    $edit_shop .= '<a class="button button--winona button--border-thin button--text-thick button--inverted" id="edit_shop" href="/edit_shop.php/'.$shop_id.'">Edit shop</a>';
} 

mysqli_close($connect);
?>
<html>
    <header>
        <?php echo $title; ?>
        <link href="/css/style.css" rel='stylesheet' type='text/css'/>
        <link rel="stylesheet" href="/css/flags.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <script type="text/javascript" src="/js/script.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </header>
    <body>
        <div class="wrapper">
            <div class="header">
                <div class="header-left">
                    <?php echo $logo; ?>
                </div>
                <div class="header-right">
                    <?php echo $header; ?>
                    <a class="button button--winona button--border-thin button--text-thick button--inverted" href="/shopping_cart.php"><i class="fa fa-shopping-cart"></i> <?php echo $totalCartItems; ?></a>
                </div>
            </div>
            <div class="content">
                <div class="middle">
                    <div class="image">
                        <a class="one-line"><?php echo $category; ?>&gt;</a>
                        <a class="one-line"><?php echo $subcategory; ?>&gt;</a>
                        <a class="one-line"><?php echo $name; ?></a>
                        <?php echo $image_container; ?>
                    </div>
                    <div class="info">
                        <div class="description">
                            <p><?php echo $description; ?></p>
                        </div>
                    </div>
                    <div class="buy-wrapper">
                        <div class="buy">
                            <div id="price">
                                <p>Price</p>
                                <h2>$ <?php echo $price; ?></h2>
                            </div>
                            <div class="qty">
                                <p>Quantity</p>
                                <input type="number" id="product_quantity" value="1">
                            </div>
                            <?php echo $buttons; ?>
                        </div>
                    </div>
                </div>
                <div class="reviews">
                    <div class="rate">
                        <?php echo $rating; ?>
                    </div>
                </div>
            </div>
            <div class="footer">
                <div class="footer-center">
                    <h3>Shop details</h3>
                    <?php echo $shop_info_footer; ?>
                    <?php echo $edit_shop; echo $add_product; ?>
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