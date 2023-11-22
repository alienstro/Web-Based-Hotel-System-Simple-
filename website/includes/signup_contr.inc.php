<?php

declare(strict_types=1);

class signup_contr {
    private $pdo;
    private $role;
    private $email;
    private $pwd;
    private $first_name;
    private $last_name;

    public function __construct($pdo, $role, $email, $pwd, $first_name, $last_name) {
        $this->pdo = $pdo;
        $this->role = $role;
        $this->email = $email;
        $this->pwd = $pwd;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
    }

    // Checks if there's an empty input
    public function is_input_empty() {
        return empty($this->email) || empty($this->pwd) || empty($this->first_name) || empty($this->last_name);
    }

    // Checks if email is valid
    public function is_email_invalid() {
        return !filter_var($this->email, FILTER_VALIDATE_EMAIL);
    }

    // Checks if email has duplicate
    public function is_email_registered() {
        $signup_model = new signup_model($this->pdo, $this->role, $this->email, $this->pwd, $this->first_name, $this->last_name);
        return $signup_model->getEmail($this->email);
    }

    // Checks if password has more than 8 character
    public function is_password_valid() {
        return strlen($this->pwd) < 8;
    }

    // Insert user info to db
    public function create_user() {
        $signup_model = new signup_model($this->pdo, $this->role, $this->email, $this->pwd, $this->first_name, $this->last_name);
        $signup_model->setUser();
    }
}
