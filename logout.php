<?php
require_once "includes/functions.inc.php";

// Check if the logout button is clicked
if (isset($_POST['logout'])) {
    echo '<script>
        var result = confirm("Are you sure you want to log out?");
        if (result) {
            window.location.href = "logout.php?action=confirm"; // Redirect to the logout confirmation action
        } else {
            window.location.href = "index.php"; // Redirect to another page if cancel is selected
        }
    </script>';
    exit();
}

// Check if the logout confirmation action is requested
if (isset($_GET['action']) && $_GET['action'] === 'confirm') {
    logout();
    header("Location: login.php");
    exit();
}

header("Location: index.php"); // Redirect to another page if logout button is not clicked directly
?>
