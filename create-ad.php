<?php
require_once "includes/functions.inc.php";

function validateInput($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
  }  

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form data
    $title = validateInput($_POST["title"]);
    $artist = validateInput($_POST["artist"]);
    $year = validateInput($_POST["year"]);
    $price = validateInput($_POST["price"]);
    $condition = validateInput($_POST["condition"]);

    $errors = array();

    if (empty($title)) {
        $errors["title"] = "Title is required.";
    }

    if (empty($artist)) {
        $errors["artist"] = "Artist is required.";
    }

    if (empty($year)) {
        $errors["year"] = "Year is required.";
    } elseif (!is_numeric($year)) {
        $errors["year"] = "Year must be a number.";
    }

    if (empty($price)) {
        $errors["price"] = "Price is required.";
    } elseif (!is_numeric($price)) {
        $errors["price"] = "Price must be a number.";
    }

    if (empty($condition)) {
        $errors["condition"] = "Condition is required.";
    }

    if (empty($errors)) {
        // Insert record into database
        if (createAd($title, $artist, $year, $price, $condition)) {
            $successMessage = "Record added successfully.";
        } else {
            $errorMessage = "There was an error adding the record. Please try again later.";
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
    </head>
    <body>

        <?php include "nav.php"?>

        <!-- Begin page content -->
        <main class="flex-shrink-0">
            <div class="container">
                <h1>Create an Ad</h1>

                <?php
                if (isset($errorMessage)) {
                    echo "<div class='alert alert-danger' role='alert'>$errorMessage</div>";
                } elseif (isset($successMessage)) {
                    echo "<div class='alert alert-success' role='alert'>$successMessage</div>";
                }
                ?>

                <form method="post">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control <?php if (isset($errors["title"])) { echo "is-invalid"; } ?>" id="title" name="title" value="<?php echo htmlspecialchars($_POST["title"] ?? ''); ?>">
                        <?php
                        if (isset($errors["title"])) {
                            echo "<div class='invalid-feedback'>" . $errors["title"] . "</div>";
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="artist">Artist</label>
                        <input type="text" class="form-control <?php if (isset($errors["artist"])) { echo "is-invalid"; } ?>" id="artist" name="artist" value="<?php echo htmlspecialchars($_POST["artist"] ?? ''); ?>">
                        </div>
                    <div class="form-group">
                        <label for="year">Year</label>
                        <input type="text" class="form-control <?php if (isset($errors["year"])) { echo "is-invalid"; } ?>" id="year" name="year" value="<?php echo htmlspecialchars($_POST["year"] ?? ''); ?>">
                        <?php
                        if (isset($errors["year"])) {
                            echo "<div class='invalid-feedback'>" . $errors["year"] . "</div>";
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="text" class="form-control <?php if (isset($errors["price"])) { echo "is-invalid"; } ?>" id="price" name="price" value="<?php echo htmlspecialchars($_POST["price"] ?? ''); ?>">
                        </div>
                        <?php
                        if (isset($errors["price"])) {
                            echo "<div class='invalid-feedback'>" . $errors["price"] . "</div>";
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="condition">Condition</label>
                        <select class="form-control <?php if (isset($errors["condition"])) { echo "is-invalid"; } ?>" id="condition" name="condition">
                            <option value="">Select Condition</option>
                            <option value="Mint" <?php if ($_POST["condition"] === "Mint") { echo "selected"; } ?>>Mint</option>
                            <option value="Near Mint" <?php if ($_POST["condition"] === "Near Mint") { echo "selected"; } ?>>Near Mint</option>
                            <option value="Very Good Plus" <?php if ($_POST["condition"] === "Very Good Plus") { echo "selected"; } ?>>Very Good Plus</option>
                            <option value="Very Good" <?php if ($_POST["condition"] === "Very Good") { echo "selected"; } ?>>Very Good</option>
                            <option value="Good Plus" <?php if ($_POST["condition"] === "Good Plus") { echo "selected"; } ?>>Good Plus</option>
                            <option value="Good" <?php if ($_POST["condition"] === "Good") { echo "selected"; } ?>>Good</option>
                            <option value="Fair" <?php if ($_POST["condition"] === "Fair") { echo "selected"; } ?>>Fair</option>
                            <option value="Poor" <?php if ($_POST["condition"] === "Poor") { echo "selected"; } ?>>Poor</option>
                        </select>
                        <?php
                        if (isset($errors["condition"])) {
                            echo "<div class='invalid-feedback'>" . $errors["condition"] . "</div>";
                        }
                        ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </main>

        <!-- Bootstrap JS -->
        <script src="js/bootstrap.bundle.min.js"></script>
    </body>
</html>
                       
