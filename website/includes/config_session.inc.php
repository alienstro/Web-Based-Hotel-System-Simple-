<?php

ini_set('sesion.use_only_cookies', 1); // Make sessions more secure || Tells PHP to only use cookies for managing sessions.
ini_set('session.use_strict_mode', 1); // Only uses session ID that created by server || Difficult for people to guess your session ID.

session_set_cookie_params([
    'lifetime' => 1800, // After certain amount of time, cookies will get destroyed.
    'domain' => 'localhost', // Creating a cookie will only work inside the domain.
    'path' => '/', // Cookie is available for the entire website.
    'secure' => true, // Only use cookie inside a secure connection.
    'httponly' => true // Restricts any sort of scritp access
]);

session_start();

if (isset($_SESSION["user_id"])) { // Checks if user logged in the website

    if (!isset($_SESSION["last_regeneration"])) {
        regenerate_session_id_loggedin();
    } else { // Update session ID after 30 mins
        $interval = 60 * 30;
        if (time() - $_SESSION["last_regeneration"] >= $interval) {
            regenerate_session_id_loggedin();
        }
    }
} else {
    // Regularly updaing session ID to keep user's session secure.
    if (!isset($_SESSION["last_regeneration"])) { // Check if a session variable exists inside the website. If not, generates new session ID
        regenerate_session_id();
    } else { // Update session ID after 30 mins
        $interval = 60 * 30;
        if (time() - $_SESSION["last_regeneration"] >= $interval) {
            regenerate_session_id();
        }
    }
}


function regenerate_session_id()
{ // Regenerate session ID for user that has NOT logged in

    session_regenerate_id(true); // Regenerates session ID to make more secure.
    $_SESSION["last_regeneration"] = time();
}

function regenerate_session_id_loggedin()
{ // Regenerate session ID for user that has logged in

    session_regenerate_id(true); // Regenerates session ID to make more secure.

    $userID = $_SESSION["user_id"];
    $newSessionID = session_create_id(); // Creates new session ID
    $sessionID = $newSessionID . "_" . $userID; // Append sessionID with userID 
    session_id($sessionID);

    $_SESSION["last_regeneration"] = time(); // Stores time
}
