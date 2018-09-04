<?php
session_start();

if(!empty($_SESSION['id'])) {
    echo "You are already logged in";
    exit;
}
?>
<html>
    <header>
        <title>Login</title>
        <link href="css/style.css" rel='stylesheet' type='text/css'/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </header>
    <body>
        <div class="wrapper">
            <div class="register">
                <a href="home.php"><img src="images/logo.png" id="logo-center"/></a>
                <div class="form-style">
                    <form action="login_function.php" method="POST">
                        <input type="email" name="email" placeholder="Email" required autofocus>
                        <input type="password" name="password" placeholder="Password" required>
                        <input type="submit" class="button button--winona button--border-thin button--text-thick button--inverted" value="Login">
                        <a href="/reset_password.html">Forgot password?</a>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>