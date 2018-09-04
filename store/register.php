<?php
include 'functions.php';
?>
<html>
    <header>
        <title>Register</title>
        <link href="css/style.css" rel='stylesheet' type='text/css'/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <script type='text/javascript' src="js/script.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </header>
    <body>
        <div class="wrapper">
            <div class="register">
                <a href="home.php"><img src="images/logo.png" id="logo-center"/></a>
                <div class="form-style">
                    <form action="register_function.php" method="POST">
                        <input placeholder="First name" name="first_name" type="text" required autofocus>
                        <input placeholder="Last name" name="last_name" type="text" required>
                        <input placeholder="Phone number" name="phone_number" type="text" required>
                        <input placeholder="Email" name="email" type="email" required>
                        <input placeholder="Address" name="address" type="text" required>
                        <input placeholder="City" name="city" type="text" required>
                        <input placeholder="Zip code" name="zip_code" type="text" required>
                        <?php selectCountryCodeHTML(); ?>
                        <input placeholder="Password" name="password" type="password" id="password" required>
                        <input placeholder="Repeat password" name="repeat_password" type="password" id="repeat" required>
                        <input class="button button--winona button--border-thin button--text-thick button--inverted" type="submit" value="Register" id="register-submit">
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>