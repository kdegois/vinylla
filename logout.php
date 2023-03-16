<?php

/* require_once "includes/functions.inc.php";

// Destroy session
logout();

?>
*/

session_start(); 

if(isset($_POST['logout'])) {
    
    if($_POST['logout'] == 'yes') {
        
        session_unset();
        session_destroy();
        header("Location: login.php"); 
        exit();
    } else {
        
        header("Location: index.php"); 
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
