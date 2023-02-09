<?php

// This is for general helper functions only

session_start();

// Clean up user imputs with this function
function stripData($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//Global user logout function
function logout(){
    session_start();
    session_unset();
    session_destroy();
    header("Location: login.php");
}

function loggedIn(){
    // Check if user is logged in
    if (isset($_SESSION['user_id']) && isset($_SESSION['email']) && isset($_SESSION['password'])){
        // Validate these details!
        return true;
    }
}

// Generate random string function, used for image filenames.
function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


?>