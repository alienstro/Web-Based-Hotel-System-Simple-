<?php

require_once 'config_session.inc.php';
require_once 'dbh.inc.php';
require_once 'admin_model.inc.php';
require_once 'admin_contr.inc.php';

if (isset($_POST['save_room_btn'])) {
    $is_Available = 'true';
    $type = $_POST['type'];
    $price = $_POST['price'];
    $persons = $_POST['persons'];
    $quantity = $_POST['quantity'];
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

    // Error Handlers
    $admin_errors = [];


    if ($admin_contr->no_negative_quantity($quantity)) {
        $admin_errors["negative_quantity"] = "Invalid input. Quantity must be 1 or more.";
    } else if ($admin_contr->no_negative_price($price)) {
        $admin_errors["negative_price"] = "Invalid input. Price must be 1 or more.";
    } else if ($admin_contr->no_negative_persons($persons)) {
        $admin_errors["negative_persons"] = "Invalid input. No. of Persons must be 1 or more.";
    } else if ($admin_contr->is_numeric($price, $quantity, $persons)) {
        $admin_errors["is_numeric"] = "Please ensure that the values for Price, Quantity, and Persons are numeric.";
    } else if ($admin_contr->is_input_empty($type, $price, $persons, $quantity, $description)) {
        $admin_errors["no_input"] = "Please fill up all inputs.";
    } else if (!$admin_contr->checks_image_error($image_error)) {
        $admin_errors["image_error"] = "There was an error uploading your image";
    } else if (!$admin_contr->is_ext_allow($image_actual_ext, $allowed)) {
        $admin_errors["ext_error"] = "You cannot upload this image type. Only jpg, jpeg, png, webp, avif";
    } else if (!$admin_contr->check_image_size($image_size)) {
        $admin_errors["size_error"] = "Your image is too big. Only less than 25mb";
    } else {
        $image_name_new = uniqid('', true) . "." . $image_actual_ext; // Ensure no overwriting
        $file_destination = './pictures/' . $image_name_new; // Location where you will upload your files.
        move_uploaded_file($image_tmp_name, $file_destination); // Location of your image file.
    }

    if ($admin_errors) {
        $_SESSION["errors_admin_add"] = $admin_errors;

        header("Location: ../admin_add.php");
        die();
    }


    $admin_model = new admin_model();
    $query_execute = $admin_model->set_room($is_Available, $type, $price, $persons, $quantity, $description, $image_name_new);

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
