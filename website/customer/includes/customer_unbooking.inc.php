<?php


require_once 'dbh.inc.php';
require_once 'customer_model.inc.php';
require_once 'config_session.inc.php';

if (isset($_POST['unbook_room_btn'])) {
    $room_id = $_POST['room_id'];
    $quantity = $_POST['quantity'];
    $booking_id = $_POST['booking_id'];

    if (isset($_SESSION["user_id"])) {
        $user_id = $_SESSION['user_id'];

        $customer_model = new customer_model();
        $customer_model->increase_room_quantity($room_id, $quantity);

        $customer_model->remove_booking($booking_id);



        header('Location: ../customer_bookings_page.php');

        $pdo = null;
        $stmt = null;
        die();
    } else {
        echo "User ID not set in session.";
    }
}
