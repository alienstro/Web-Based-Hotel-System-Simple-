<?php

require_once 'config_session.inc.php';
require_once 'dbh.inc.php';
require_once 'admin_model.inc.php';
require_once 'admin_contr.inc.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_id = $_POST['room_id'];

    try {



        $admin_model = new admin_model();
        $admin_contr = new admin_contr();
        

        // Error Handlers
        $admin_errors = [];

        $result = $admin_model->get_all_data_roomIDs_from_userRooms($room_id);
        if ($admin_contr->check_if_room_is_booked($result)) {
            $admin_errors["room_booked"] = "Please ensure that all rooms are unbooked.";
        }

        if ($admin_errors) {
            $_SESSION["errors_admin_add"] = $admin_errors;

            header("Location: ../admin_adminPanel_page.php");
            die();
        }

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
