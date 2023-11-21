<?php

// Model - Takes care of only querying the database and getting, submitting, updating, deleting data

declare(strict_types=1); // Throw error if you pass wrong data type

function get_email(object $pdo, string $email) {
    $query = "SELECT * FROM users WHERE email = :email;";

    $stmt = $pdo->prepare($query); // Prevents SQL injection attack
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch - Getting the first result
    return $result;
}

