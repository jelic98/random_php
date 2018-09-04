<?php
if(!empty($_SESSION['id'])) {
    $user_id = $_SESSION['id'];

    $cmd = "SELECT * FROM `table_users` WHERE `id`='$user_id'";
    $rows = mysqli_query($connect, $cmd) or die(mysqli_error($connect));

    if($rows) {
        while($row = mysqli_fetch_array($rows)) {
            $email = $row['email'];
        }
    }

    $email_crypt = hash("sha512", $email, false);

    if(isset($_GET['ticket'])) {
        $ticket = $_GET['ticket'];

        if($ticket != $email_crypt) {
            echo "Confirmation URL is not valid for this email";
            exit;
        }else {
            $cmd = "IPDATE `table_users` SET `email_confirmed`='1' WHERE `id`='$user_id'";
            mysqli_query($connect, $cmd) or die(mysqli_error($connect));
        }
    }else {
        echo "Not enough parameters passed";
        exit;  
    }

    mysqli_close($connect);
}else {
    echo "You have to sign in to confirm email";
    exit;
}
?>
<html>
    <header>
        <title>Email confirmed</title>
        <link href="css/style.css" rel='stylesheet' type='text/css'/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </header>
    <body>
        <div class="wrapper">
            <div class="register">
                <a href="home.php"><img src="images/logo.png" id="logo-center"/></a>
                <h3>You have successfully confirmed your email</h3>
                <a class="button button--winona button--border-thin button--text-thick button--inverted" href="/resend_email.php">Go to homepage</a>
            </div>
        </div>
    </body>
</html>