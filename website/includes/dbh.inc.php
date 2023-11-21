<?php

$dsn = "mysql:host=localhost;dbname=hoteldatabase";
$dbusername = "root";
$dbpassword = "";

try {

    $pdo = new PDO($dsn, $dbusername, $dbpassword);


    // Throw exception when there's error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "Connection Failed: " . $e->getMessage();
}