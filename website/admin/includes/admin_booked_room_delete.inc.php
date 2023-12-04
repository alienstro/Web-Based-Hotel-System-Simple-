<?php

require_once 'config_session.inc.php';
require_once 'dbh.inc.php';
require_once 'admin_model.inc.php';
require_once 'admin_contr.inc.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_id = $_POST['room_id'];
    $booking_id = $_POST['booking_id'];
    $quantity = $_POST['quantity'];

    try {
        $admin_model = new admin_model();
        $admin_contr = new admin_contr();

        $admin_model->increase_room_quantity($room_id, $quantity);
        $query_execute = $admin_model->remove_booked_room_admin($booking_id);
        


        if ($query_execute) {
            $_SESSION['message'] = "Not Deleted";
            header('Location: ../admin_bookedrooms_page.php');
            die();
        } else {
            $_SESSION['message'] = "Deleted Successfully";
            header('Location: ../admin_bookedrooms_page.php');
            die();
        }


        $pdo = null;
        $stmt = null;
        die();
    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }
}
