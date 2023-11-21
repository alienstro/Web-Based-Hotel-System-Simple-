<?php

// Controller - Functions and conditions etc...

declare(strict_types=1); 

function is_input_empty(string $email, string $pwd, string $first_name, string $last_name) { // Checks if input is empty || string - Less error in case of wrong data type sent
    if (empty($email) || empty($pwd) || empty($first_name) || empty($last_name)) {
        return true;
    } else {
        return false;
    }
}

function is_email_invalid(string $email) { // Checks if the email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // Validate if it's valid email
        return true;
    } else {
        return false;
    }
}

function is_email_registered(object $pdo, string $email) { // Checks if email already registered
    if (get_email($pdo, $email)) { // Check if there's duplicate
        return true;
    } else { // Not taken
        return false;
    }
}

function is_password_valid(string $pwd) { // Checks if password is more than 8 characters
    if(strlen($pwd) < 8) {
        return true;
    } else {
        return false;
    }
}

function create_user(object $pdo, string $role, string $email, string $pwd, string $first_name, string $last_name) { // Sends data to db
    set_user($pdo, $role, $email, $pwd, $first_name, $last_name);
}
