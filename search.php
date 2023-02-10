<?php

require_once "includes/functions.inc.php";
require_once("includes/dbconnect.inc.php");

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <title>Vinylla - Search</title>
        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- Sticky footer navbar -->
        <link href="css/sticky-footer-navbar.css" rel="stylesheet">
        <!-- Custom style for search page -->
        <style>
            a.listing {
                display: block;
                color: var(--bs-body-color);
                text-decoration: none;
                padding: 20px;
                margin: 20px 0;
                border-radius: 5px;
                background-color: #ccc;
            }
            a.listing:hover {
                background-color: #ddd;
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
                <h3>Listing Results</h3>
                <?php

                $filters = "";

                // Search based on term
                if(isset($_GET['term'])){
                    $term = $_GET['term'];
                    $filters = " AND title LIKE '%$term%'";
                }

                $sql = "SELECT * FROM listing WHERE listing_id$filters ORDER BY datetime_posted DESC";

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