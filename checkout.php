<?php

require_once "includes/functions.inc.php";
require_once("includes/dbconnect.inc.php");

//If user is logged out send them to login page
if (loggedIn() == false){
    header("Location: login.php");
    die();
}

$userID = $_SESSION['user_id'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phone_number'];
    $address = $_POST['address'];

    // Save user data to database
    $sql = "UPDATE user SET first_name='$firstName', last_name='$lastName', email='$email', phone_number='$phoneNumber', address='$address' WHERE user_id=$userID";
}

?>

<!doctype html>
<html lang="en">
    <head>
        <script src="js/color-modes.js"></script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <title>Vinylla - Checkout</title>
        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- Main CSS -->
        <link href="css/main.css" rel="stylesheet">
        <!-- Sticky footer navbar -->
        <link href="css/sticky-footer-navbar.css" rel="stylesheet">
        <style>
            .form-group {
                margin-bottom: 20px;
            }
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
                <h2>Checkout</h2>
                <form method="post">
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" id="phone_number" name="phone_number" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" name="address" required></textarea>
                    </div>
                    <!-- Payment section -->
                    <div class="payment-section">
                    <h3>Payment Information</h3>
                    <div class="form-group">
                        <label for="cardholder_name">Cardholder Name</label>
                        <input type="text" class="form-control" id="cardholder_name" name="cardholder_name" placeholder="Enter cardholder name" required>
                    </div>
                    <div class="form-group">
                        <label for="card_number">Card Number</label>
                        <input type="text" class="form-control" id="card_number" name="card_number" placeholder="Enter card number" required>
                    </div>
                    <div class="form-group">
                        <label for="expiry_date">Expiry Date</label>
                        <input type="text" class="form-control" id="expiry_date" name="expiry_date" placeholder="MM / YY" required>
                    </div>
                    <div class="form-group">
                        <label for="cvv">CVV</label>
                        <input type="text" class="form-control" id="cvv" name="cvv" placeholder="Enter CVV" required>
                    </div>
                    <h3>Order Overview</h3>
                    <?php

                        $mysqlWhereStr = "";

                        // Get the CSV from DB and turn it into an array
                        $sql = "SELECT * FROM user WHERE user_id = $userID";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) >= 1){
                            while($row = mysqli_fetch_assoc($result)) {
                                $listingIdArr = str_getcsv($row['cart']);
                            }
                        }

                        // Check if the cart is empty and throw error
                        if ($listingIdArr[0] == ""){
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
                                $total = 0;
                                while($row = mysqli_fetch_assoc($result)) {
                                    echo "<a class=\"listing\" href=\"view-ad.php?listing_id=" . $row['listing_id'] . "\">";
                                    echo "<h4>" . $row['title'] . " - " . $row['artist'] . "</h4>";
                                    echo "<ul>";
                                    echo "<li>Price (Pcm): £" . $row['price'] . "</li>";
                                    echo "<li>Posted: " . $row['datetime_posted'] . "</li>";
                                    echo "</ul>";
                                    echo "</a>";
                                    $total = $total + $row['price'];
                                }
                                $vat = number_format((float)$total * 0.2, 2, '.', '');
                                echo "<span>VAT: £$vat</span><br>";

                                $total = number_format((float)$total, 2, '.', ''); // Round to 2dp
                                
                                echo "<span>Total: £$total</span> <small>(inc VAT)</small>";
                            }
                        }
                        ?>
                    <button type="submit" class="btn btn-primary" style="float: right">Confirm Order</button>
                    </div>
                </form>
            </div>
        </main>
        
        <?php include "footer.php"; ?>
        
        <!-- Bootstrap JS -->
        <script src="js/bootstrap.bundle.min.js"></script>
    </body>


</html>
