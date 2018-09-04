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

$cart = "";
$side_cart = "";

$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$page = 1;

if(strpos($url, "/page-") !== false) {
    $name = substr($url, strpos($url, "shop.php/") + 9);
    $name = substr($name, 0, strlen($name) - strlen(substr($name, strpos($name, "/"))));

    $page = substr($url, strpos($url, $name) + strlen($name) + 6);
    $page = substr($page, 0, strpos($page, "/"));
}else {
    $name = substr($url, strpos($url, "shop.php/") + 9);
}

if(isset($_GET['cat']) || isset($_GET['sub'])) {
    $name = substr($url, strpos($url, "shop.php/") + 9);
    $name = substr($name, 0, strpos($name, "?"));
}

$name = str_replace("%20", " ", $name);

$cmd = "SELECT * FROM `table_shops` WHERE `name`='$name'";
$rows = mysqli_query($connect, $cmd) or die(mysqli_error($connect));

if($rows) {
    while($row = mysqli_fetch_array($rows)) {
        $shop_id = $row['id'];
        $image = $row['image'];
        $owner_id = $row['owner_id'];
        $address = $row['address']."<br/>".$row['city'].", ".$row['country'];
    }
}

$title = '<title>'.$name.'</title>';

$cmd = "SELECT * FROM `table_users` WHERE `id`='$owner_id'";
$rows = mysqli_query($connect, $cmd) or die(mysqli_error($connect));
echo $image;
$logo = '<a href="/index.php"><img src="/'.$image.'" id="logo"></a>';
$shop_info_header = '<h1>'.$name.'</h1>';
$shop_info_footer = '<p>'.$address.'</p>';

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

$cmd = "SELECT * FROM `table_products` WHERE `shop_id`='$shop_id'";
$rows = mysqli_query($connect, $cmd);

$ppp = 8;

$totalProducts = mysqli_num_rows($rows);
$pageTotal = floor($totalProducts / $ppp);

if($totalProducts % $ppp != 0) {
    $pageTotal++;
}

$pager = "";

if(strpos($url, "?dir=") !== false) {
    $dir = substr($url, strpos($url, "?dir="));
    $url = str_replace(substr($url, strpos($url, "?dir=")), "", $url);
}else {
    $dir = "";
}

if(strpos($url, "/page-") !== false) {
    $url = str_replace(substr($url, strpos($url, "/page-".$page)), "", $url);
}

for($i = 1; $i < $pageTotal + 1; $i++) {
    $pager .= '<a href="'.$url.'/page-'.$i.'/'.$dir.'">'.$i.' </a>';
}

if(isset($_GET['cat'])) {
    $cat = $_GET['cat'];
    $cmd = "SELECT * FROM `table_products` WHERE `shop_id`='$shop_id' AND `category`='$cat'";  
}

if(isset($_GET['sub'])) {
    $sub = $_GET['sub'];
    $cmd = "SELECT * FROM `table_products` WHERE `shop_id`='$shop_id' AND `subcategory`='$sub'";  
}

$rows = mysqli_query($connect, $cmd) or die(mysqli_error($connect));   

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

$sorted = bbl_sort($unsorted_price, $unsorted_id);

for($i = 0; $i < count($sorted); $i++) {
    $id = $sorted[$i];

    $cmd = "SELECT * FROM `table_products` WHERE `id`='$id'";
    $rows = mysqli_query($connect, $cmd) or die(mysqli_error($connect));

    if($rows) {
        while($row = mysqli_fetch_array($rows)) {
            $name = $row['name'];
            $description = $row['description'];
            $price = $row['price'];
            $id = $row['id'];
            $images = $row['images'];
            $shop_id = $row['shop_id'];

            if(strpos($images, "~") !== false) {
                $image = substr($images, 0, strpos($images, "~"));
            }

            $inner_cmd = "SELECT * FROM `table_shops` WHERE `id`='$shop_id'";
            $inner_rows = mysqli_query($connect, $inner_cmd) or die(mysqli_error($connect));

            if($inner_rows) {
                while($inner_row = mysqli_fetch_array($inner_rows)) {
                    $owner_id = $inner_row['owner_id'];
                }
            }
        }  

        if(($i + 1 > ($page - 1) * $ppp) && ($i + 1 <= $page * $ppp)) {
            $result .= '<div class="grids-of-4">';
            $result .= '<div class="grid1-of-4">';
            $result .= '<img id="'.$id.'" src="/'.$image.'" class="'.$id.'-'.$name.'" onclick="productOnClick(this)"/>';
            $result .= '<h4 class="'.$id.'-'.$name.'" onclick="productOnClick(this)">'.$name.'</h4>';
            $result .= '<div class="item_add"><span class="item_price"><h3>$'.$price.'</h3></span></div>';
            $result .= '<a class="button button--winona button--border-thin button--text-thick button--inverted" href="/add_to_cart.php/'.$id.'*1">Add to cart</a>'; 

            if((!empty($_SESSION['id'])) && 
               ($owner_id == $_SESSION['id'])) {
                $result .= '<a class="button button--winona button--border-thin button--text-thick button--inverted" href="/edit_product.php/'.$id.'">Edit</a>';
                $result .= '<a class="button button--winona button--border-thin button--text-thick button--inverted" href="/delete_product.php/'.$id.'">Delete</a>';
            }  

            $result .= '</div>';    
            $result .= '</div>';   
        }

        $totalItems++;
    }
}

$sort = "";

if($totalItems == 0) {
    $total = '<div class="content-top">';
    $total .= '<h2>There are no products matching the selection</h2>';
    $total .= '<div class="sort">';
    $total .= '<?php echo $sort; ?>';
    $total .= '</div>';
    $total .= '</div>';
}else {
    $total = "";

    if(strpos($url, "?dir=") !== false) {
        $url = str_replace(substr($url, strpos($url, "?dir=")), "", $url);
    }

    if(strpos($url, "/page-") === false) {
        $url .= "/page-1/";
    }

    $sort .= '<a href="'.$url.'?dir=asc"><i class="fa fa-usd"></i><i class="fa fa-arrow-up"></i></a>';
    $sort .= '<a href="'.$url.'?dir=desc"><i class="fa fa-usd"></i><i class="fa fa-arrow-down"></i></a>';
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

$add_product = "";
$edit_shop = "";

if((!empty($_SESSION['id'])) && 
   ($owner_id == $_SESSION['id'])) {
    $add_product = '<a class="button button--winona button--border-thin button--text-thick button--inverted" id="add_product" href="/add_product.php">Add product</a>';
    $edit_shop .= '<a class="button button--winona button--border-thin button--text-thick button--inverted" id="edit_shop" href="/edit_shop.php/'.$shop_id.'">Edit shop</a>';
} 

$cmd = "SELECT * FROM `table_products`";
$rows = mysqli_query($connect, $cmd);  

$totalPrice = 0;

$counter = 0;

if($rows) {
    while($row = mysqli_fetch_array($rows)) {
        $product_id = $row['id'];
        $product_name = $row['name'];
        $product_price = $row['price'];
        $product_image = $row['images'];
        $product_name = $row['name'];

        if(strpos($product_image, "~") !== false) {
            $product_image = substr($product_image, 0, strpos($product_image, "~"));   
        }

        if(strpos($cart, $product_id."*") !== false) {
            $counter++;

            if($counter > 3) {
                $side_cart .= '<a class="button button--winona button--border-thin button--text-thick button--inverted" href="/shopping_cart.php">+ more</a>';
                break;
            }

            $product_quantity_first_cut = substr($cart, strpos($cart, $product_id) + strlen($product_id."*"));

            if(substr_count($product_quantity_first_cut, "~") > 0) {
                $product_quantity = substr($product_quantity_first_cut, 0, strpos($product_quantity_first_cut, "~"));
            }else {
                $product_quantity = $product_quantity_first_cut;
            }

            $totalPrice += $product_price * $product_quantity;

            $side_cart .= '<div class="side_cart">';
            $side_cart .= '<img id="'.$product_id.'" src="/'.$product_image.'" class="'.$product_id.'-'.$product_name.'" onclick="productOnClick(this)"/>';
            $side_cart .= '<h4 class="'.$product_id.'-'.$product_name.'" onclick="productOnClick(this)">'.$product_name.'</h4>';
            $side_cart .= '</div>'; 
        }else {
            $side_cart .= "";
        }
    }
}

$cmd = "SELECT * FROM `table_filters`";
$rows = mysqli_query($connect, $cmd);  

$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if(strpos($url, "/page-") !== false) {
    $temp = substr($url, strpos($url, "/page-"));
    $url = str_replace($temp, "", $url);
}

$filters = "";

if($rows) {
    while($row = mysqli_fetch_array($rows)) {
        $cat = $row['cat'];
        $sub = $row['sub'];

        $filters .= "<br/>";
        $filters .= '<a href="'.$url.'?cat='.$cat.'" class="cat">'.$cat.'</a>';

        while(strpos($sub, "~") > 0) {
            $current = current(explode("~", $sub)); 
            $current = str_replace("~", "", $current);

            $filters .= '<a href="'.$url.'?sub='.$current.'" class="sub">'.$current.'</a>';

            $sub = str_replace($current."~", "", $sub);
        } 
    }
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
                    <?php echo $logo; ?>
                    <?php echo $shop_info_header; ?>
                </div>
                <div class="header-right">
                    <?php echo $header; ?>
                    <a class="button button--winona button--border-thin button--text-thick button--inverted" href="/shopping_cart.php"><i class="fa fa-shopping-cart"></i> <?php echo $totalCartItems; ?></a>
                    <div class="search">
                        <form action="/search.php" method="GET">
                            <div class="form-style">
                                <input id="search" type="search" id="filters-search-input" placeholder="Search..." name="criteria">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="left-sidebar">
                <div class="side_cart_list">
                    <?php echo $filters; ?>
                </div>
            </div>
            <div class="content">
                <?php echo $total; ?>
                <?php echo $result; ?>
            </div>
            <div class="right-sidebar">
                <p>Shopping cart</p>
                <p>$ <?php echo $totalPrice; ?></p>
                <div class="side_cart_list">
                    <?php echo $side_cart; ?>
                </div>
            </div>
            <div class="pager-wrapper">
                <div class="pager">
                    <?php echo $pager; ?>
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