<?php

// Check if user is logged in
if (isset($_SESSION['user_id']) && isset($_SESSION['email']) && isset($_SESSION['password'])){
    // Validate these details!
}
else {
    header("Location: login.php?uri=" . basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']));
}

?>