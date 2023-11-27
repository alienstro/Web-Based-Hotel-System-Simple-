<?php

declare(strict_types=1);

class login_contr {
    private $pdo;
    private $email;
    private $pwd;

    public function __construct($pdo, $email, $pwd) {
        $this->pdo = $pdo;
        $this->email = $email;
        $this->pwd = $pwd;
    }

    public function is_input_empty($pwd, $email) {
        if (empty($pwd) || empty($email)) {
            return true; 
        } else {
            return false;
        }
    }

    public function is_email_wrong($result) {
        if (!$result) {
            return true;
        } else {
            return false;
        }
    }

    public function is_password_wrong($pwd, $hashed_pwd) {
        if (!password_verify($pwd, $hashed_pwd)) {
            return true;
        } else {
            return false;
        }
    }

    public function is_user_admin($result) {
        if($result["role"] === ("admin")) {
            return true;
        } else {
            return false;
        }
    }
}
?>