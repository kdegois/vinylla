<?php

require_once "includes/functions.inc.php";
require_once("includes/dbconnect.inc.php");



if (isset($_post['add_to_basket'])) {
    if (isset($_SESSION['cart'])) {

    }else{
        $session_array = array(
            'id' => $_GET['id'],
            "name" => $_post['title'],
            "price" => $_post['price']
        );

        $_SESSION['cart'][] = $session_array;
    }
}
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <title>Vinylla - View Ad</title>
        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- Main CSS -->
        <link href="css/main.css" rel="stylesheet">
        <!-- Sticky footer navbar -->
        <link href="css/sticky-footer-navbar.css" rel="stylesheet">
        <!-- Form-validation -->
        <link href="css/form-validation.css" rel="stylesheet">
        <!-- View Ad CSS -->
        <link href="css/view-ad.css" rel="stylesheet">
    </head>
    <body class="min-vh-100">

        <?php include "nav.php"?>
        
        <!-- Begin page content -->
        <!-- <main > -->
            <div class="flex-fill">
            <div class="container">

                <?php

                if (isset($_GET['listing_id'])){

                    $listingID = $_GET['listing_id'];

                    $sql = "SELECT * FROM listing WHERE listing_id = $listingID";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) == 1) {
                        $row = mysqli_fetch_assoc($result);

                        echo "<form method = 'post' action = 'index.php? id=<?= $row['id'] ?>'>";
                        echo "<h3>" . $row['title'] . " - " . $row['artist'] . "</h3>";
                        echo "<p>" . $row['description'] . "</p>";
                        echo "<ul>";
                        echo "<li>Price: £" . $row['price'] . "</li>";
                        echo "<li>Posted: " . $row['datetime_posted'] . "</li>";
                        echo "</ul>";
                        echo "<input type = 'submit' name = 'add_to_basket' class = 'btn btn-warning' value = 'add to basket';>";
                        echo "</form>";
                    }

                    else {
                        echo "<h3>Listing not found</h3>";
                        echo "<p>The listing has either been removed or never existed!</p>";
                    }
                    
                }

                else {

                    echo "<h3>Listing not found</h3>";
                    echo "<p>The URL is malformed.</p>";

                }
                
                ?>
            </div>
            </div>

        <!-- </main> -->

        <!-- Bootstrap JS -->
        <script src="js/bootstrap.bundle.min.js"></script>
        <footer>
                <div class="footercontaine">
        <div class="footer-links">
            <div>
                <p>&copy; 2023 Vinylla. All rights reserved.</p>
            </div>
            <div>
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="#">Terms of Use</a></li>
                    <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
                    <li class="list-inline-item"><a href="#">Contact Us</a></li>
                </ul>
            </div>
        </div>
    </div>

    <?php
    var_dump($_SESSION['cart']);
?>
        </footer>
    </body>
    </html>