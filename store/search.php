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

    $flag = '<a href="index.php"><img class="'.$country_name.'" id="flag"></a>' or die(mysqli_error($connect)); 
}else {
    $flag = '<a href="index.php">X</a>';
}

$side_cart = "";
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

$search_bar = '<input id="search" type="text" placeholder="Search..." name="criteria">';

if(isset($_GET['criteria'])) {
    if(empty($_GET['criteria'])) {
        header("location: home.php");
        exit;
    }

    $criteria = $_GET['criteria']." ";
    $search = array();
    $i = 0;
    $totalItems = 0;

    $title = '<title>Search for "'.$_GET['criteria'].'"</title>';

    $search_bar = '<input id="search" type="text" placeholder="Search..." value="'.$criteria.'" name="criteria">';

    while(strpos($criteria, " ") > 0) {
        $search[$i] = substr($criteria, 0, strpos($criteria, " "));
        $criteria = str_replace($search[$i]." ", "", $criteria);
        $i++;
    }

    for($i = 0; $i < sizeof($search); $i++) {
        $cmd = "SELECT * FROM `table_products` WHERE `country`='$country_name'";

        if(isset($_GET['cat'])) {
            $cat = $_GET['cat'];
            $cmd .= " AND `category`='$cat'";  
        }

        if(isset($_GET['sub'])) {
            $sub = $_GET['sub'];
            $cmd .= " AND `subcategory`='$sub'";  
        }

        $rows = mysqli_query($connect, $cmd) or die(mysqli_error($connect));

        $result = "";

        if($rows) {
            while($row = mysqli_fetch_array($rows)) {
                if(strpos(strtolower($row['name']), strtolower($search[$i])) !== false) {
                    $id = $row['id'];
                    $name = $row['name'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image = $row['images'];

                    if(strpos($image, "*") !== false) {
                        $image = current(explode("*", $image));
                    }

                    $shop_id = $row['shop_id'];

                    $inner_cmd = "SELECT * FROM `table_shops` WHERE `id`='$shop_id'";
                    $inner_rows = mysqli_query($connect, $inner_cmd) or die(mysqli_error($connect));

                    if($inner_rows) {
                        while($inner_row = mysqli_fetch_array($inner_rows)) {
                            $owner_id = $inner_row['owner_id'];
                        }
                    }

                    $result .= '<div class="grids-of-4">';
                    $result .= '<div class="grid1-of-4">';
                    $result .= '<img id="'.$id.'" src="/'.$image.'" class="'.$id.'" onclick="productOnClick(this)"/>';
                    $result .= '<h4 class="'.$id.'" onclick="productOnClick(this)">'.$name.'</h4>';
                    $result .= '<div class="item_add"><span class="item_price"><h3>$'.$price.'</h3></span></div>';
                    $result .= '<a class="button button--winona button--border-thin button--text-thick button--inverted" href="/add_to_cart.php/'.$id.'*1">Add to cart</a>'; 

                    if((!empty($_SESSION['id'])) && 
                       ($owner_id == $_SESSION['id'])) {
                        $result .= '<a class="button button--winona button--border-thin button--text-thick button--inverted" href="/edit_product.php/'.$id.'">Edit product</a>';
                        $result .= '<a class="button button--winona button--border-thin button--text-thick button--inverted" href="/delete_product.php/'.$id.'">Delete product</a>';
                    }  

                    $result .= '</div>';    
                    $result .= '</div>';

                    $totalItems++;
                }
            }
        }

        $counter = 0;

        do {
            $counter++;

            $result .= '<div class="content-filler">';
            $result .= '</div>';
        }while ($counter < 4 - $totalItems % 4);

        $cmd = "SELECT * FROM `table_shops` WHERE `country`='$country_name'";
        $rows = mysqli_query($connect, $cmd) or die(mysqli_error($connect));

        if($rows) {
            while($row = mysqli_fetch_array($rows)) {
                if(strpos(strtolower($row['name']), strtolower($search[$i])) !== false) {
                    $id = $row['id'];
                    $name = $row['name'];
                    $image = $row['image'];

                    $result .= '<div class="grids-of-4">';
                    $result .= '<div class="grid1-of-4">';
                    $result .= '<img id="'.$id.'" src="'.$image.'" class="'.$name.'" onclick="shopOnClick(this)"/>';
                    $result .= '<h4 class="'.$name.'" onclick="shopOnClick(this)">'.$name.'</h4>'; 
                    $result .= '</div>';    
                    $result .= '</div>';

                    $totalItems++;
                }
            }
        }
    }

    if($totalItems == 0) {
        $total = "<h2>There are no products or shops matching the selection</h2>";
    }else {
        $total = "<h2>Total - ".$totalItems."</h2>";
    }
}

$cmd = "SELECT * FROM `table_products`";
$rows = mysqli_query($connect, $cmd);  

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

        if(strpos($cart, "~".$product_id."*") !== false) {
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

$cmd = "SELECT * FROM `table_filters`";
$rows = mysqli_query($connect, $cmd);  

$filters = "";

if($rows) {
    while($row = mysqli_fetch_array($rows)) {
        $cat = $row['cat'];
        $sub = $row['sub'];

        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $explode = explode('/', $url);
        $href = end($explode);

        $filters .= "<br/>";
        $filters .= '<a href="'.$href.'&cat='.$cat.'" class="cat">'.$cat.'</a>';

        while(strpos($sub, "~") > 0) {
            $current = current(explode("~", $sub)); 
            $current = str_replace("~", "", $current);

            $filters .= '<a href="'.$href.'&sub='.$current.'" class="sub">'.$current.'</a>';

            $sub = str_replace($current."~", "", $sub);
        } 
    }
}

mysqli_close($connect);
?>
<html>
    <header>
        <?php echo $title; ?>
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
                    <a href="home.php"><img src="images/logo.png" id="logo"/></a>
                    <?php echo $flag;?>
                </div>
                <div class="header-right">
                    <?php echo $header; ?>
                    <a class="button button--winona button--border-thin button--text-thick button--inverted" href="shopping_cart.php"><i class="fa fa-shopping-cart"></i> <?php echo $totalCartItems; ?></a>
                </div>
            </div>
            <div class="left-sidebar">
                <div class="side_cart_list">
                    <?php echo $filters; ?>
                </div>
            </div>
            <div class="content">
                <div class="content-top">
                    <?php echo $total; ?>
                </div>
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
                    <p>&lt; 1 2 3 .. 9 &gt;</p>
                </div>
            </div>
            <div class="footer">
                <div class="footer-center">
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
        , 'document.getElementById("toggleLogin").innerHTML = "Logout";'
            , 'document.getElementById("registerButton").innerHTML = "Account";'
                , '</script>';  
}
?>
