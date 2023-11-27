<?php

class Dbh
{

    private $dsn = "mysql:host=localhost;dbname=hoteldatabase";
    private $dbusername = "root";
    private $dbpassword = "";

    protected function connect()
    {
        try {

            $pdo = new PDO($this->dsn, $this->dbusername, $this->dbpassword);

            // Throw exception when there's error
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $pdo;
        } catch (PDOException $e) {
            echo "Connection Failed: " . $e->getMessage();
        }
    }
}
