<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/signup_view.inc.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;700&display=swap" rel="stylesheet">

</head>

<body>
    <div class="all">
        <div class="logo">
            <h1 class="mount">MOUNT </h1>
            <img src="picture/mounthua.webp" alt="Mount Hua Logo">
            <h1 class="hua_hotel"> HUA HOTEL</h1>
        </div>

        <div class="container_signUp">
            <form action="includes/signup.inc.php" method="post">
                <h1>SIGN UP</h1>

                <div class="label_input">
                    <label for="firstName">LAST NAME</label>
                    <br>
                    <input type="text" name="first_name" id="firstName">
                </div>

                <div class="label_input">
                    <label for="lastName">FIRST NAME</label>
                    <br>
                    <input type="text" name="last_name" id="lastName">
                </div>

                <div class="label_input">
                    <label for="email">EMAIL</label>
                    <br>
                    <input type="email" name="email" id="email">
                </div>

                <div class="label_input">
                    <label for="password">PASSWORD</label>
                    <br>
                    <input type="password" name="pwd" id="password">
                </div>

                <button class="sign_button">SIGN IN</button>

                <p class="sign_text">Already have an account? <a href="login.php">Log In</a></p>
            </form>
        </div>
    </div>

    <?php

    $signupView = new signup_view();
    $signupView->check_signup_errors();

    ?>
</body>

</html>