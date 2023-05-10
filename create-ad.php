<?php

require_once "includes/functions.inc.php";
require_once "includes/dbconnect.inc.php";

//If user is logged out send them to login page
if (loggedIn() == false){
    header("Location: login.php");
    die();
}


if (isset($_POST["submit"])){

    $userId = $_SESSION['user_id'];
    $price = $_POST["price"];
    $artist = $_POST["artist"];
    $title = $_POST["title"];
    $description = $_POST["description"];

    // Check if price is a valid number
    if (!is_numeric($price)) {
        $error = "Price must be a number";
    }
    // Check if artist and title are not empty
    elseif (empty($artist) || empty($title)) {
        $error = "Please enter the artist and title";
    }
    // If all inputs are valid, insert the data into the database
    else {
        $sql = "INSERT INTO listing (user_id, price, artist, title, description) VALUES ('$userId','$price', '$artist', '$title', '$description');";
        if(mysqli_query($conn, $sql)){
            $success = "Posted successfully!";
        }
        else {
            $error = "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
        }
    }
}


?>

<!doctype html>
<html lang="en">
    <head>
        <script src="js/color-modes.js"></script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <title>Vinylla - Create an Ad</title>
        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- Main CSS -->
        <link href="css/main.css" rel="stylesheet">
        <!-- Sticky footer navbar -->
        <link href="css/sticky-footer-navbar.css" rel="stylesheet">
        <!-- Form-validation -->
        <link href="css/form-validation.css" rel="stylesheet">
    </head>
    <body>

        <?php include "nav.php"?>
        
        <!-- Begin page content -->
        <main class="flex-shrink-0">
            <div class="container">

            <div style="margin: 50px 0px;">
                <?php

                if (isset($success)){
                    echo "<div class=\"success\">" . $success . "</div>";
                }

                elseif(isset($error)){
                    echo "<div class=\"error\">" . $error . "</div>";
                }
                
                ?>
                <h4>Post your listing</h4>
                
                <form action="create-ad.php" method="post">
                    <div class="form-group">
                        <label for="year">Artist</label>
                        <input type="text" class="form-control" id="artist" name="artist">
                    </div>
                    <div class="form-group">
                        <label for="year">Title</label>
                        <input type="text" class="form-control" id="title" name="title">
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <div class="input-group">
                            <span class="input-group-text">£</span>
                            <input type="text" class="form-control" id="price" name="price" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="condition">Vinyl format</label>
                        <select class="form-control" id="condition" name="condition">
                            <option value="45">7'' 45 RPM Single</option>
                            <option value="LP">12'' 33 RPM LP</option>
                            <option value="LP">2" 45 RPM LP</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="condition">Condition</label>
                        <select class="form-control" id="condition" name="condition">
                            <option value="">Select Condition</option>
                            <option value="Mint">Mint</option>
                            <option value="Near Mint">Near Mint</option>
                            <option value="Very Good Plus">Very Good Plus</option>
                            <option value="Very Good">Very Good</option>
                            <option value="Good Plus">Good Plus</option>
                            <option value="Good">Good</option>
                            <option value="Fair">Fair</option>
                            <option value="Poor">Poor</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="year">Listing description</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>
                    <br>
                    <button type="submit" name="submit" class="btn btn-primary" style="float:right;">Submit</button>
                </form>
            </div>
        </main>

        <?php include "footer.php" ?>

        <!-- Bootstrap JS -->
        <script src="js/bootstrap.bundle.min.js"></script>
        <!-- Form Validation JS -->
        <script src="js/form-validation.js"></script>
    </body>
</html>