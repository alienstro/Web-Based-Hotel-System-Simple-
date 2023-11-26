<?php

require_once 'config_session.inc.php';
require_once 'dbh.inc.php';
require_once 'admin_model.inc.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $is_Available = 'true';
    $type = $_POST['type'];
    $price = $_POST['price'];
    $persons = $_POST['persons'];
    $quantity = $_POST['quantity'];
    $description = $_POST['description'];

    $admin_model = new admin_model();
    $query_execute = $admin_model->set_room($is_Available, $type, $price, $persons, $quantity, $description);

    if ($query_execute) {
        $_SESSION['message'] = "Failed";
        header('Location: ../admin_adminPanel_page.php');
        die();
    } else {
        $_SESSION['message'] = "Added Successfully";
        header('Location: ../admin_adminPanel_page.php');
        die();
    }

    $errors = [];

    $admin_contr = new admin_contr();
    $result = $admin_model->get_room_data();
    if ($admin_contr->is_room_data_available($result)) {
        $errors["no_data"] = "No records Found!";
    }

    $pdo = null;
    $stmt = null;
    die();
}
