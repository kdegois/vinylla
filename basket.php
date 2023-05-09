<?php

require_once "includes/functions.inc.php";
require_once("includes/dbconnect.inc.php");

//If user is logged out send them to login page
if (loggedIn() == false){
    header("Location: login.php");
    die();
}

//Delete listing

if (isset($_POST['delete_item'])) {
    $removeListingID = $_POST['delete_item'];
    removeItemFromCart($conn, $removeListingID,1);
}

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

                    $mysqlWhereStr = "";
                    
                    // Get the CSV from DB and turn it into an array
                    $sql = "SELECT * FROM cart WHERE user_id = 1";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) >= 1){
                        while($row = mysqli_fetch_assoc($result)) {
                            $listingIdArr = str_getcsv($row['listing_id_csv']);
                        }
                    }

                    // Check if the cart is empty and throw error
                    if ($listingIdArr[0] == null){
                        echo "<h3>Your cart is empty</h3>";
                        echo "<p>No items in your cart!</p>";
                    }
                    else {

                        // Create the mysql WHERE
                        $first = true;
                        foreach ($listingIdArr as $listingId) {
                            if ($first) {
                                $msqlWhereStr = "listing_id = " . $listingIdArr[0];
                                $first = false;
                            }
                            else {
                                $msqlWhereStr .= " OR listing_id = " . $listingId;
                            }
                        }

                        $sql = "SELECT * FROM listing WHERE " . $msqlWhereStr;
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
                                echo "<form action=\"basket.php\" method=\"post\"><button class=\"btn btn-primary\" type=\"submit\" name=\"delete_item\" value=\"" . $row['listing_id'] . "\">Remove</button></form>";
                            }
                            //echo "<button name=\"checkout\" class=\"btn btn-primary\">Checkout</button>";
                        }

                    }
                ?>

            </div>
        </main>
        
        <?php include "footer.php"; ?>
        
        <!-- Bootstrap JS -->
        <script src="js/bootstrap.bundle.min.js"></script>
    </body>


</html>