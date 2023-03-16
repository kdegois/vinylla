<?php

/* require_once "includes/functions.inc.php";

// Destroy session
logout();

?>
*/

session_start(); // start the session

if(isset($_POST['logout'])) {
    // if user clicked on logout button
    if($_POST['logout'] == 'yes') {
        // clear the session data and destroy the session
        session_unset();
        session_destroy();
        header("Location: login.php"); // redirect to login page
        exit();
    } else {
        // if user clicked on cancel button
        header("Location: index.php"); // redirect to home page
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign Out</title>
</head>
<body>
    <h1>Sign Out</h1>
    <p>Are you sure you want to log out?</p>
    <form method="post" action="">
        <input type="hidden" name="logout" value="yes">
        <input type="submit" value="Yes">
        <input type="button" value="Cancel" onclick="window.location.href='index.php'">
    </form>
</body>
</html>

<!-- not sure if commit is working for me, jut checking--> 
