<?php

require_once "includes/functions.inc.php";
require_once("includes/dbconnect.inc.php");

?>

<!doctype html>
<html lang="en">
    <head>
        <script src="js/color-modes.js"></script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <title>Vinylla - Cart</title>
        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- Main CSS -->
        <link href="css/main.css" rel="stylesheet">
        <!-- Sticky footer navbar -->
        <link href="css/sticky-footer-navbar.css" rel="stylesheet">
        <!-- Custom style for search page -->
        <style>
            a.listing {
                background: rgba(0,0,0,0.2);;
                display: block;
                color: var(--bs-body-color);
                text-decoration: none;
                padding: 20px;
                margin: 20px 0;
                border-radius: 5px;
            }
            a.listing:hover {
                background: rgba(0,0,0,0.3);;
            }
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

                <?php
                
                    $sql = "SELECT * FROM cart WHERE user_id = 1";

                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) >= 1){
                        while($row = mysqli_fetch_assoc($result)) {
                            $listingIdArray = $row['item_id_1'];
                        }

                    }

                    echo $listingIdArray;

                    $sql = "SELECT * FROM listing WHERE listing_id = 1 OR listing_id=7";

                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) >= 1){
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<a class=\"listing\" href=\"view-ad.php?listing_id=" . $row['listing_id'] . "\">";
                            echo "<h4>" . $row['title'] . " - " . $row['artist'] . "</h4>";
                            echo "<ul>";
                            echo "<li>Price (Pcm): £" . $row['price'] . "</li>";
                            echo "<li>Posted: " . $row['datetime_posted'] . "</li>";
                            echo "</ul>";
                            echo "</a>";
                        }
                    }
                    else{
                        echo "<h3>No results found</h3>";
                        echo "<p>Your search has returned no results, please try again.</p>";
                    }
                ?>

            </div>
        </main>

        <!-- Bootstrap JS -->
        <script src="js/bootstrap.bundle.min.js"></script>
    </body>


</html>