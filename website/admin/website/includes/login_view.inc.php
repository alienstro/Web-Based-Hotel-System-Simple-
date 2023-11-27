<?php

// View - Shows information inside the website

declare(strict_types=1);

class login_view
{
    public function check_login_erros()
    { // Echo out error message if there's one
        if (isset($_SESSION['errors_login'])) {
            $errors = $_SESSION['errors_login'];

            foreach ($errors as $error) {
                echo '<div class=login_form_error><p">' . $error . '</p></div>';
            }

            unset($_SESSION['errors_login']); // Removes errors_signup for security purposes
        }
    }
}
