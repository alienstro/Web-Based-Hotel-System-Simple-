<?php

// Model - Takes care of only querying the database and getting, submitting, updating, deleting data

declare(strict_types=1); // Throw error if you pass wrong data type

class login_model extends Dbh
{
    private $pdo;
    private $email;
    private $pwd;


    public function __construct($pdo,$email, $pwd)
    {
        $this->pdo = $pdo;
        $this->email = $email;
        $this->pwd = $pwd;
    }


    public function get_email(object $pdo, string $email)
    {
        $query = "SELECT * FROM users WHERE email = :email;";

        $stmt = $this->connect()->prepare($query); // Prevents SQL injection attack
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch - Getting the first result
        return $result;
    }
}
