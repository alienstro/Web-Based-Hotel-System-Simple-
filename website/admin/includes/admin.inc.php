<?php

require_once 'config_session.inc.php';
require_once 'dbh.inc.php';
require_once 'admin_model.inc.php';
require_once 'admin_contr.inc.php';

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

    $pdo = null;
    $stmt = null;
    die();
}