<?php

require_once "includes/functions.inc.php";
require_once("includes/dbconnect.inc.php");

if (isset($_SESSION['user_id'])) {
    $userID = $_SESSION['user_id'];
}
else {
    $userID = 0; // Nobody
}

//Add item to basket

if (isset($_POST['add_item'])) {
    $addListingID = $_POST['add_item'];
    addItemToCart($conn,$addListingID,$userID);
}

?>

<!doctype html>
<html lang="en">
    <head>
        <script src="js/color-modes.js"></script>
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
    <body>

        <?php include "nav.php"?>
        
        <!-- Begin page content -->
        <main class="flex-shrink-0">
            <div class="container">
                <div class="row">
                    <?php

                    if (isset($_GET['listing_id'])){

                        $listingID = $_GET['listing_id'];

                        $sql = "SELECT * FROM listing WHERE listing_id = $listingID";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) == 1) {
                            $row = mysqli_fetch_assoc($result);
                            echo "<h3>" . $row['title'] . " - " . $row['artist'] . "</h3>";
                            echo "<p>" . $row['description'] . "</p>";
                            echo "<span>Price: £" . $row['price'] . "</span>";
                            echo "<br>";
                            echo "<span>Posted: " . $row['datetime_posted'] . "</span>";
                            // Add to cart button (only when logged in)
                            if ($userID != 0){
                                echo "<form action=\"view-ad.php?listing_id=" . $listingID . "\" method=\"post\"><button class=\"btn btn-primary btn-add-to-basket\" type=\"submit\" name=\"add_item\" value=\"" . $row['listing_id'] . "\">Add to basket</button></form>";
                            }
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
        </main>

        <?php include "footer.php"; ?>

        <!-- Bootstrap JS -->
        <script src="js/bootstrap.bundle.min.js"></script>
    </body>
    </html>