<?php

declare(strict_types=1); // Throw error if you pass wrong data type

class signup_model extends Dbh{
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

    public function getEmail() {
        $query = "SELECT email FROM users WHERE email = :email;";

        
        $stmt = $this->connect()->prepare($query);  // Prevents SQL injection attack
        $stmt->bindParam(":email", $this->email);
        $stmt->execute(); // Executes query

        $result = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch - Getting the first result
        return $result; 
    }

    public function setUser() {
        $query = "INSERT INTO users (role, email, pwd, first_name, last_name) VALUES (:role, :email, :pwd, :first_name, :last_name);";
        
        $options = [
            'cost' => 12 // The higher the cost, the harder to brute force
        ];

        $hashed_pwd = password_hash($this->pwd, PASSWORD_BCRYPT, $options);

        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(":role", $this->role); 
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":pwd", $hashed_pwd);
        $stmt->bindParam(":first_name", $this->first_name);
        $stmt->bindParam(":last_name", $this->last_name);
        $stmt->execute();
    }
}