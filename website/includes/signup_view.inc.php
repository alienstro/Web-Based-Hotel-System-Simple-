<?php

// View - Shows information inside the website

declare(strict_types=1); 

function check_signup_erros() { // Echo out error message if there's one
    if (isset($_SESSION['errors_signup'])) {
        $errors = $_SESSION['errors_signup'];

        foreach ($errors as $error) {
            echo '<div class=signup_form_error><p">' . $error . '</p></div>';
        }

        unset($_SESSION['errors_signup']); // Removes errors_signup for security purposes
    } else if (isset($_GET["signup"]) && $_GET["signup"] === "success") { // Echo out success if no errors
        echo '<div class=signup_form_success><p>Sign Up Success!</p></div>';
    }
}

