<?php

require_once 'dbh.inc.php';

class login extends Dbh
{
    public function validate($email, $pwd)
    {
        try {

            require_once 'dbh.inc.php';
            require_once 'login_model.inc.php';
            require_once 'login_contr.inc.php';

            $dbh = new Dbh();
            $pdo = $dbh->connect();

            $login_contr = new login_contr($pdo, $email, $pwd);
            $login_model = new login_model($pdo, $email, $pwd);

            // Error handlers
            $errors = [];

            if ($login_contr->is_input_empty($email, $pwd)) { // Checks if input has value
                $errors["empty_input"] = "Fill in all fields!";
            }

            $result = $login_model->get_email($pdo, $email); // GET email from db

            if ($login_contr->is_email_wrong($result)) { // Checks if email exists
                $errors["login_error"] = "Incorrect email!";
            } else if (!$login_contr->is_email_wrong($result) && $login_contr->is_password_wrong($pwd, $result["pwd"])) { // Checks if the email is correct and password incorrect
                $errors["login_error"] = "Incorrect password!";
            }

            require_once 'config_session.inc.php';


            if ($errors) {
                $_SESSION["errors_login"] = $errors;

                header("Location: ../login.php");
                die();
            }



            $newSessionID = session_create_id(); // Creates new session ID
            $sessionID = $newSessionID . "_" . $result["user_id"]; // Append sessionID with userID 
            session_id($sessionID);

            $_SESSION["user_id"] =  $result["user_id"];
            $_SESSION["user_email"] =  htmlspecialchars($result["email"]); // Stories sanitized version to prevent Cross-site scripting.

            $_SESSION["last_regeneration"] = time(); // Resets the time and updates after 30 mins

            if ($login_contr->is_user_admin($result)) {
                header("Location: ../admin/admin_home_page.php");
            } else {
                header("Location: ../customer/customer_home_page.php");
            }

            $pdo = null;
            $stmt = null;
            die();
        } catch (PDOException $e) {
            die("Query Failed: " . $e->getMessage());  // Terminate php and output a message
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = new login();

    $email = $_POST["email"];
    $pwd = $_POST["pwd"];

    $login->validate($email, $pwd);
} else {
    header("Location: ../login.php");
    die();
}

