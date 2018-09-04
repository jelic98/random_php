<?php
session_start();
include 'connection.php';

$user_id = $_SESSION['id'];
$country_name = $_SESSION['country_name'];

$country_criteria = ""; 

if(!empty($country_name)) {
    $country_criteria = " WHERE `country`='$country_name'"; 
    $image_location = "images/flags/";
    $image_format = ".jpg"; 
}

if(!empty($user_id)) {
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

$maximum_price = 0;

$cmd = "SELECT * FROM `table_products`";
$rows = mysqli_query($connect, $cmd) or die(mysqli_error($connect));

if($rows) {
    while($row = mysqli_fetch_array($rows)) {
        if(intval($row['price']) > $maximum_price) {
            $maximum_price = intval($row['price']);
        }
    }
}

if(isset($_GET['category'])) {
    $category = $_GET['category'];
}else {
    $category = 0;
}

if(isset($_GET['subcategory'])) {
    $subcategory = $_GET['subcategory'];
}else {
    $subcategory = 0;
}

if(isset($_GET['min']) &&
   isset($_GET['max'])) {
    $min = intval($_GET['min']);
    $max = intval($_GET['max']);
}else {
    $min = 0;
    $max = $maximum_price;
}

if($max == 0) {
    $max = $maximum_price;
}

$totalItems = 0;
$result = "";

$cmd = "SELECT * FROM `table_products`".$country_criteria;
$rows = mysqli_query($connect, $cmd) or die(mysqli_error($connect));

if($rows) {
    while($row = mysqli_fetch_array($rows)) {
        $price = intval($row['price']);
        $product_category = $row['category'];
        $product_subcategory = $row['subcategory'];

        if(($price >= $min) && 
           ($price < $max) &&
           ($product_category == $category) && 
           ($product_subcategory == $subcategory)) {
            $totalItems++;

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

            $result .= '<div class="grids_of_4">';
            $result .= '<div class="grid1_of_4">';
            $result .= '<div class="'.$id.'" onclick="productOnClick(this)">';
            $result .= '<img id="'.$id.'" src="'.$image.'" class="img-responsive" height="100" width="100" alt=""/>';
            $result .= '<h4 class="'.$id.'" onclick="productOnClick(this)">'.$name.'</h4>';
            $result .= '<p>'.$description.'</p>';
            $result .= '<div class="grid_1 simpleCart_shelfItem">';
            $result .= '<div class="item_add"><span class="item_price"><h6>$'.$price.'</h6></span></div>';
            $result .= '<div class="item_add"><span class="item_price"><a href="add_to_cart.php/'.$id.'*1">Add to cart</a></span></div>';

            if((!empty($_SESSION['id'])) && 
               ($owner_id == $_SESSION['id'])) {
                $result .= '<div class="item_add"><span class="item_price"><a href="../edit_product.php/'.$id.'">Edit product</a></span></div>';
                $result .= '<div class="item_add"><span class="item_price"><a href="../delete_product.php/'.$id.'">Delete product</a></span></div>';
            }

            $result .= '</div>';
            $result .= '</div>';
            $result .= '<div class="clearfix"></div>';
            $result .= '</div>';
        }
    }
}

mysqli_close($connect);
?>
<html>
    <head>
        <title>Caspian Markets</title>
        <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
        <!-- jQuery (necessary JavaScript plugins) -->
        <script type='text/javascript' src="js/jquery-1.11.1.min.js"></script>
        <!-- Custom Theme files -->
        <link href="css/style.css" rel='stylesheet' type='text/css' />
        <!-- Custom Theme files -->
        <!--//theme-style-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="Gretong Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
                                       Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
        <link href='//fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>
        <link href='//fonts.googleapis.com/css?family=Playfair+Display:400,700,900' rel='stylesheet' type='text/css'>
        <!-- start menu -->
        <link href="css/megamenu.css" rel="stylesheet" type="text/css" media="all" />
        <script type="text/javascript" src="js/megamenu.js"></script>
        <script>$(document).ready(function(){$(".megamenu").megamenu();});</script>
        <script src="js/menu_jquery.js"></script>
        <script src="js/simpleCart.min.js"> </script>
    </head>
    <body>
        <!-- header -->
        <div class="header_bg">
            <div class="container">
                <div class="header">
                    <div class="head-t">
                        <div class="logo">
                            <a href="home.php"><img src="images/logo.png" class="img-responsive"/></a>
                            <img src="" height="33" width="55" id="country_flag">
                        </div>
                        <!-- start header_right -->
                        <div class="header_right">

                            <div class="rgt-bottom">
                                <div class="log">
                                    <div class="login">
                                        <div id="loginContainer"><a href="/login.php" onclick="loginOrLogout()" id="loginButton"><span id="toggleLogin">Login</span></a>
                                            <div id="loginBox">                
                                                <form id="loginForm" action="login.php" method="POST">
                                                    <fieldset id="body">
                                                        <fieldset>
                                                            <label for="email">Email Address</label>
                                                            <input type="text" name="email" id="email">
                                                        </fieldset>
                                                        <fieldset>
                                                            <label for="password">Password</label>
                                                            <input type="password" name="password" id="password">
                                                        </fieldset>
                                                        <input type="submit" id="login" value="Sign in">
                                                        <label for="checkbox"><input type="checkbox" id="checkbox"><i>Remember me</i></label>
                                                    </fieldset>
                                                    <span><a href="forgot.html">Forgot your password?</a></span>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="reg">
                                    <a href="/register.php" onclick="registerOrAccount()" id="registerButton">REGISTER</a>
                                </div>

                                <div class="cart box_1">
                                    <a href="shopping_cart.php">
                                        <h3><?php echo $totalCartItems; ?><img src="images/bag.png" alt=""></h3>
                                    </a>	
                                    <div class="clearfix"> </div>
                                </div>
                                <div class="create_btn">
                                    <a href="shopping_cart.php">CHECKOUT</a>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <div class="search">
                                <form action="search.php" method="GET">
                                    <input type="text" name="criteria" placeholder="search...">
                                    <input type="submit" value="">
                                </form>
                            </div>
                            <div class="clearfix"> </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content -->
        <div class="container">

            <div class="women_main">
                <div class="ads">
                    <a href="#"><img src="images/acepizza.jpg" height="200" width="282"/></a>
                    <a href="#"><img src="images/acepizza.jpg" height="200" width="282"/></a>
                    <a href="#"><img src="images/acepizza.jpg" height="200" width="282"/></a>
                </div>
                <!-- start sidebar -->
                <div class="col-md-3 s-d">
                    <div class="w_sidebar">
                        <section class="sky-form">
                            <h3>Filters</h3>
                            <div class="col col-4">
                                <form action="search_filters.php" method="GET">
                                    <h4>Price</h4>
                                    <input type="number" id="min" name="min" placeholder="from">
                                    <input type="number" id="max" name="max" placeholder="to">
                                    <h4>Category</h4>
                                    <input type="radio" name="category" value="1"><p>Category 1</p>
                                    <input type="radio" name="category" value="2"><p>Category 2</p>
                                    <input type="radio" name="category" value="3"><p>Category 3</p>
                                    <input type="radio" name="category" value="4"><p>Category 4</p>
                                    <input type="radio" name="category" value="5"><p>Category 5</p>
                                    <h4>Subcategory</h4>
                                    <input type="radio" name="subcategory" value="1"><p>Subcategory 1</p>
                                    <input type="radio" name="subcategory" value="2"><p>Subcategory 2</p>
                                    <input type="radio" name="subcategory" value="3"><p>Subcategory 3</p>
                                    <input type="radio" name="subcategory" value="4"><p>Subcategory 4</p>
                                    <input type="radio" name="subcategory" value="5"><p>Subcategory 5</p>
                                    <input type="submit" value="Submit">
                                </form>
                            </div>					
                        </section>
                    </div>
                </div>
                <!-- start content -->
                <div class="col-md-9 w_content">
                    <div class="women">
                        <a href="#"><h4>Total items - <span><?php echo $totalItems; ?></span></h4></a>
                        <ul class="w_nav">
                            <li>Sort : </li>
                            <li><a class="active" href="#">popular</a></li> |
                            <li><a href="#">new </a></li> |
                            <li><a href="#">discount</a></li> |
                            <li><a href="#">price: Low High </a></li> 
                            <div class="clear"></div>	
                        </ul>
                        <div class="clearfix"></div>	
                    </div>
                    <!-- grids_of_4 -->
                    <div class="grids_of_4">
                        <?php echo $result; ?>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <!-- end content -->
            </div>
        </div>
        <div class="foot-top">
            <div class="container">
                <div class="col-md-6 s-c">
                    <li>
                        <div class="fooll">
                            <h5>follow us on</h5>
                        </div>
                    </li>
                    <li>
                        <div class="social-ic">
                            <ul>
                                <li><a href="#"><i class="facebok"> </i></a></li>
                                <li><a href="#"><i class="twiter"> </i></a></li>
                                <li><a href="#"><i class="goog"> </i></a></li>
                                <li><a href="#"><i class="be"> </i></a></li>
                                <li><a href="#"><i class="pp"> </i></a></li>
                                <div class="clearfix"></div>	
                            </ul>
                        </div>
                    </li>
                    <div class="clearfix"> </div>
                </div>
                <div class="col-md-6 s-c">
                    <div class="stay">
                        <div class="stay-left">
                            <form>
                                <input type="text" placeholder="Enter your email to join our newsletter" required="">
                            </form>
                        </div>
                        <div class="btn-1">
                            <form>
                                <input type="submit" value="join">
                            </form>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
        <div class="footer">
            <div class="container">
                <div class="col-md-3 cust">
                    <h4>CUSTOMER CARE</h4>
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">How To Buy</a></li>
                    <li><a href="#">Delivery</a></li>
                </div>
                <div class="col-md-2 abt">
                    <h4>ABOUT US</h4>
                    <li><a href="#">Our Stories</a></li>
                    <li><a href="#">Press</a></li>
                    <li><a href="#">Career</a></li>
                    <li><a href="contact.html">Contact</a></li>
                </div>
                <div class="col-md-2 myac">
                    <h4>MY ACCOUNT</h4>
                    <li><a href="#">Cart</a></li>
                    <li><a href="#">Order History</a></li>
                    <li><a href="/account.php">Account Settings</a></li>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            function registerOrAccount() {
                if(document.getElementById("registerButton").innerHTML == "Account") {
                    document.getElementById("registerButton").href = "account.php";
                }
            }

            function loginOrLogout() {
                if(document.getElementById("toggleLogin").innerHTML == "Logout") {
                    document.getElementById("loginButton").href= "logout.php";
                }
            }

            function productOnClick(clickedElement) {
                var productId = clickedElement.getAttribute("class");
                window.location.href = "product.php/" + productId; 
            }
        </script>
    </body>
</html>
<?php
if(!empty($_SESSION['country_name'])) {
    echo '<script type="text/javascript">'
        , 'document.getElementById("country_flag").setAttribute("src", "'.$image_location.$country_name.$image_format.'");'
            , '</script>'; 
}

echo '<script type="text/javascript">'
    , 'document.getElementById("min").setAttribute("value", "'.$min.'");'
        , 'document.getElementById("max").setAttribute("value", "'.$max.'");'
            , '</script>';  

if(!empty($_SESSION['id'])) {
    echo '<script type="text/javascript">'
        , 'document.getElementById("toggleLogin").innerHTML = "Logout";'
            , 'document.getElementById("registerButton").innerHTML = "Account";'
                , '</script>';  
}
?>
