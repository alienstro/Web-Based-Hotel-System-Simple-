<?php

// Controller - Functions and conditions etc...

declare(strict_types=1); // Throw error if you pass wrong data type

function is_input_empty(string $email, string $pwd) { // Checks if input empty
    if (empty($pwd) || empty($email)) {
        return true; 
    } else {
        return false;
    }
}

function is_email_wrong(bool|array $result) { // Checks if email exists
    if (!$result) {
        return true; // Error message
    } else {
        return false;
    }
}

function is_password_wrong(string $pwd, string $hashed_pwd) { // Checks if password is correct to hashed password
    if (!password_verify($pwd, $hashed_pwd)) {
        return true;
    } else {
        return false;
    }
}

function is_user_admin(bool|array $result) { // Checks if user is admin or customer
    if($result["role"] === ("admin")) {
        return true;
    } else {
        return false;
    }
}