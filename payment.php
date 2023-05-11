<?php

require_once "includes/functions.inc.php";
require_once("includes/dbconnect.inc.php");

if (loggedIn() == false){
    header("Location: login.php");
    die();
}

$userID = $_SESSION['user_id'];

clearCart($conn,$userID);

?>

<!doctype html>
<html lang="en">
    <head>
        <script src="js/color-modes.js"></script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <title>Vinylla - Make payment</title>
        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- Main CSS -->
        <link href="css/main.css" rel="stylesheet">
        <!-- Sticky footer navbar -->
        <link href="css/sticky-footer-navbar.css" rel="stylesheet">
        <style>
            h3 {
                padding-top: 20px;
            }
        </style>
    </head>
    <body>

        <?php include "nav.php"?>

        <!-- Begin page content -->
        <main class="flex-shrink-0">
            <div class="container">
                <h3>Make your payment</h3>
                <p>There's no payment gateway because this isn't a business. Your basket has been cleared, just for pretend.</p>
            </div>
        </main>
        
        <?php include "footer.php"; ?>
        
        <!-- Bootstrap JS -->
        <script src="js/bootstrap.bundle.min.js"></script>
    </body>


</html>