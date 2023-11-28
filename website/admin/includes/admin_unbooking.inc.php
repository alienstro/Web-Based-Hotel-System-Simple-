<?php


require_once 'dbh.inc.php';
require_once 'admin_model.inc.php';
require_once 'config_session.inc.php';

if (isset($_POST['unbook_room_btn'])) {
    $room_id = $_POST['room_id'];
    $quantity = $_POST['quantity'];

    if (isset($_SESSION["user_id"])) {
        $user_id = $_SESSION['user_id'];

        $admin_model = new admin_model();
        $admin_model->increase_room_quantity($room_id, $quantity);

        $admin_model->remove_room_id($room_id, $user_id);



        header('Location: ../admin_room_page.php');

        $pdo = null;
        $stmt = null;
        die();
    } else {
        echo "User ID not set in session.";
    }
}
