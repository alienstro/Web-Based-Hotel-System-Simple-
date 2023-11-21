<?php

// Model - Takes care of only querying the database and getting, submitting, updating, deleting data

declare(strict_types=1); // Throw error if you pass wrong data type

function get_email(object $pdo, string $email) {
    $query = "SELECT email FROM users WHERE email = :email;";

    $stmt = $pdo->prepare($query); // Prevents SQL injection attack
    $stmt->bindParam(":email", $email);
    $stmt->execute(); // Executes query

    $result = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch - Getting the first result
    return $result;

}

function set_user(object $pdo, string $role, string $email, string $pwd, string $first_name, string $last_name) {
    $query = "INSERT INTO users (role, email, pwd, first_name, last_name) VALUES (:role, :email, :pwd, :first_name, :last_name);";
    
    $options = [
        'cost' => 12 // The higher the cost, the harder to brute force
    ];

    $hashed_pwd = password_hash($pwd, PASSWORD_BCRYPT, $options);

    $stmt = $pdo->prepare($query); // Prevents SQL injection attack
    $stmt->bindParam(":role", $role); 
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":pwd", $hashed_pwd);
    $stmt->bindParam(":first_name", $first_name);
    $stmt->bindParam(":last_name", $last_name);
    $stmt->execute();
}