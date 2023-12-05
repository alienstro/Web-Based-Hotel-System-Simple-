<?php


require_once 'dbh.inc.php';
require_once 'customer_model.inc.php';
require_once 'customer_contr.inc.php';
require_once 'config_session.inc.php';

if (isset($_POST['book_room_btn'])) {
    $room_id = $_POST['room_id'];
    $quantity = $_POST['quantity'];

    if (isset($_SESSION["user_id"])) {
        $user_id = $_SESSION['user_id'];

        $customer_model = new customer_model();
        $customer_contr = new customer_contr();

        $results = $customer_model->get_room_id($room_id);

        $result = $results['quantity'];

        // Error Handlers
        $room_error = [];

        if($customer_contr->check_room_availability($result)) {
            $room_error["no_room_available"] = "All rooms of this type are fully booked.";
        }

        if($room_error) {
            $_SESSION["no_room_available"] = $room_error;

            header("Location: ../customer_room_page.php");
            die();
        }

        
        $customer_model->decrease_room_quantity($room_id, $quantity);

        $customer_model->insert_room_id($room_id, $user_id);



        header('Location: ../customer_room_page.php');

        $pdo = null;
        $stmt = null;
        die();
    } else {
        header("Location: ../login.php");
    }
}
