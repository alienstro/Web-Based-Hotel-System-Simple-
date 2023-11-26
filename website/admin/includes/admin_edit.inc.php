<?php

require_once 'config_session.inc.php';
require_once 'dbh.inc.php';
require_once 'admin_model.inc.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $room_id = $_POST['room_id'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    $persons = $_POST['persons'];
    $quantity = $_POST['quantity'];
    $description = $_POST['description'];

    try {
        $admin_model = new admin_model();
        $admin_model->edit_room($room_id, $type, $price, $persons, $quantity, $description);

        if ($query_execute) {
            $_SESSION['message'] = "Failed";
            header('Location: ../admin_adminPanel_page.php');
            die();
        } else {
            $_SESSION['message'] = "Updated Successfully";
            header('Location: ../admin_adminPanel_page.php');
            die();
        }

        $pdo = null;
        $stmt = null;
        die();
    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }
}
