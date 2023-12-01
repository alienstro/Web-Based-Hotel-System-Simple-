<?php

require_once 'config_session.inc.php';
require_once 'dbh.inc.php';
require_once 'admin_model.inc.php';
require_once 'admin_contr.inc.php';

if (isset($_POST['update_room_card_btn'])) {

    $room_card_id = $_POST['room_card_id'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $image = $_FILES['image'];

    $image_name = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_size = $_FILES['image']['size'];
    $image_error = $_FILES['image']['error'];
    $image_type = $_FILES['image']['type'];

    $allowed = array('jpg', 'jpeg', 'png', 'avif', 'webp');
    $image_ext = explode('.', $image_name);
    $image_actual_ext = strtolower(end($image_ext));


    $admin_contr = new admin_contr();

    $file_destination = null;

    //Image Error Handlers
    $admin_errors = [];

    if ($admin_contr->no_negative_price($price)) {
        $admin_errors["negative_price"] = "Invalid input. Price must be 1 or more.";
    } else if ($image_error === UPLOAD_ERR_NO_FILE) {
        $admin_model = new admin_model();
        $result = $admin_model->get_room_card_id($room_card_id);

        $old_image_name = $result['image'];

        $image_name_new = $old_image_name; // Keep old file since no new file uploaded
    } else {
        if (!$admin_contr->checks_image_error($image_error)) {
            $admin_errors["image_error"] = "There was an error uploading your image";
        } else if (!$admin_contr->is_ext_allow($image_actual_ext, $allowed)) {
            $admin_errors["ext_error"] = "You cannot upload this image type. Only jpg, jpeg, png";
        } else if (!$admin_contr->check_image_size($image_size)) {
            $admin_errors["size_error"] = "Your image is too big. Only less than 25mb";
        } else {
            $image_name_new = uniqid('', true) . "." . $image_actual_ext; // Ensure no overwriting, No data loss.
            $file_destination = './pictures/' . $image_name_new; // Location where you will upload your files.
            move_uploaded_file($image_tmp_name, $file_destination); // Location of your image file.
        }
    }

    if ($admin_errors) {
        $_SESSION["errors_admin_add"] = $admin_errors;

        header("Location: ../admin_room_card_edit.php?room_card_id=$room_card_id");
        die();
    }

    try {
        $admin_model = new admin_model();
        $admin_model->edit_room_card($room_card_id, $type, $price, $description, $image_name_new);

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
