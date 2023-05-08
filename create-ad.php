<?php

require_once "includes/functions.inc.php";
require_once "includes/dbconnect.inc.php";

if (loggedIn() == false){
    header("Location: login.php");
}


if (isset($_POST["submit"])){

    $userId = $_POST["user_id"];
    $price = $_POST["price"];
    $artist = $_POST["artist"];
    $title = $_POST["title"];
    $description = $_POST["description"];

    $sql = "INSERT INTO listing (user_id, price, artist, title, description) VALUES ('$userId','$price', '$artist', '$title', '$description');";

    if(mysqli_query($conn, $sql)){
        $success = "Posted successfully!";
    }
    else {
        $error = "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
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

        <div class="container">
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
                    <h4>Post an Ad</h4>
                    
                    <form action="create-ad.php" method="post">
                        <div class="form-group">
                            <label for="title">User ID</label>
                            <input type="text" class="form-control" id="userId" name="user_id">
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="text" class="form-control" id="price" name="price" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="year">Artist</label>
                            <input type="text" class="form-control" id="artist" name="artist">
                        </div>
                        <div class="form-group">
                            <label for="year">Title</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="form-group">
                            <label for="year">Description</label>
                            <input type="text" class="form-control" id="description" name="description">
                        </div>

                        <!--<div class="form-group">
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
                        </div>-->
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </main>
        </div>

        <!-- Bootstrap JS -->
        <script src="js/bootstrap.bundle.min.js"></script>
        <!-- Form Validation JS -->
        <script src="js/form-validation.js"></script>
    </body>
</html>