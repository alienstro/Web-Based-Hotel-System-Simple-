<?php

require_once 'config_session.inc.php';
require_once 'dbh.inc.php';
require_once 'admin_model.inc.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_id = $_POST['room_id'];

    try {
        $admin_model = new admin_model();
        $query_execute = $admin_model->delete_room($room_id);

        if ($query_execute) {
            $_SESSION['message'] = "Not Deleted";
            header('Location: ../admin_adminPanel_page.php');
            die();
        } else {
            $_SESSION['message'] = "Deleted Successfully";
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
