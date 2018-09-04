<?php
include 'connection.php';

$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$explode = explode('/', $url);
$ticket = end($explode);



mysqli_close($connect);
?>
<html>
    <header>
        <title>New password</title>
        <link href="css/style.css" rel='stylesheet' type='text/css'/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </header>
    <body>
        <div class="wrapper">
            <div class="register">
                <a href="home.php"><img src="images/logo.png" id="logo-center"/></a>
                <div class="form-style">
                    <form action="new_password.php" method="POST">
                        <input type="password" name="password" placeholder="New password" required>
                        <input type="password" name="repeat" placeholder="Repeat password" required>
                        <input type="submit" class="button button--winona button--border-thin button--text-thick button--inverted" value="Save changes">
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>