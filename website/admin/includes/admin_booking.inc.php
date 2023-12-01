<?php


require_once 'dbh.inc.php';
require_once 'admin_model.inc.php';
require_once 'admin_contr.inc.php';
require_once 'config_session.inc.php';

if (isset($_POST['book_room_btn'])) {
    $room_id = $_POST['room_id'];
    $quantity = $_POST['quantity'];

    if (isset($_SESSION["user_id"])) {
        $user_id = $_SESSION['user_id'];

        $admin_model = new admin_model();
        $admin_contr = new admin_contr();

        $results = $admin_model->get_room_id($room_id);

        $result = $results['quantity'];

        // Error Handlers
        $room_error = [];

        if($admin_contr->check_room_availability($result)) {
            $room_error["no_room_available"] = "All rooms of this type are fully booked.";
        }

        if($room_error) {
            $_SESSION["no_room_available"] = $room_error;

            header("Location: ../admin_room_page.php");
            die();
        }

        
        $admin_model->decrease_room_quantity($room_id, $quantity);

        $admin_model->insert_room_id($room_id, $user_id);



        header('Location: ../admin_room_page.php');

        $pdo = null;
        $stmt = null;
        die();
    } else {
        echo "User ID not set in session.";
    }
}
