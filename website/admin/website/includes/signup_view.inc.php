<?php

class signup_view {
    // If there's error, it will print the error
    public function check_signup_errors() {
        if (isset($_SESSION['errors_signup'])) {
            $errors = $_SESSION['errors_signup'];

            foreach ($errors as $error) {
                echo '<div class=signup_form_error><p>' . $error . '</p></div>';
            }

            unset($_SESSION['errors_signup']);
        } else if (isset($_GET["signup"]) && $_GET["signup"] === "success") {
            echo '<div class=signup_form_success><p>Sign Up Success!</p></div>';
        }
    }
}

