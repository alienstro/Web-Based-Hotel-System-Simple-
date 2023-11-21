<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Check if user submitting form using post method
    $role = 'customer';
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];

    try {
        require_once "dbh.inc.php"; // Link file to somewhere
        require_once "signup_model.inc.php";
        require_once "signup_contr.inc.php";

        // Error handlers
        $errors = [];

        if (is_input_empty($email, $pwd, $first_name, $last_name)) { // Checks if input empty
            $errors["empty_input"] = "Fill in all fields!";
        }
        else if (is_email_invalid($email)) { // Checks if email is invalid
            $errors["invalid_email"] = "Invalid email!";
        }
        else if (is_email_registered($pdo, $email)) { // Checks if there is duplicates
            $errors["email_registered"] = "Email already used!";
        }
        else if (is_password_valid($pwd)) { // Checks if password more than 8 characters
            $errors["password_valid"] = "Password must be more than 8 characters!";
        }

        require_once 'config_session.inc.php';

        if($errors) {
            $_SESSION["errors_signup"] = $errors; 

            header("Location: ../signUp.php"); // Going back to link if there's errors
            die();
        }

        create_user($pdo, $role, $email, $pwd, $first_name, $last_name); // Sends data to db
 
        header("Location: ../signUp.php?signup=success");
        // header("Location: ../login.php");
        

        $pdo = null; // Remove the connection to db
        $stmt = null; // Close the statement

        die();

    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());  // Terminate php and output a message
    }

} else {
    header("Location: ../signUp.php");
    die();
}

// ob_end_flush(); 