<?php

require_once "includes/functions.inc.php";
require_once "includes/dbconnect.inc.php";

//If user is logged out send them to login page
if (loggedIn() == false){
    header("Location: login.php");
    die();
}

if (isset($_GET["listing_id"])){
    $listingId = $_GET["listing_id"];
}
else {
    die("No listing ID given!");
}


if(isset($_POST["submit"])) {
    $target_dir = "uploads/";
    $path_parts = pathinfo($_FILES["fileToUpload"]["name"]);
    $extension = $path_parts['extension'];
    $target_file = $target_dir . basename(generateRandomString(20) . "." . $extension);


    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $success = "Your image has been uploaded!";

        $sql = "UPDATE listing SET picture_1_uri = '$target_file' WHERE listing_id = $listingId;";
        
        mysqli_query($conn, $sql);
    }
    else {
        $error = "Error uploading image!";
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
        <title>Vinylla - Upload an image</title>
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
                <h4>Now upload an image</h4>
                
                <form action="upload.php?listing_id=<?php echo $listingId ?>" method="post" enctype="multipart/form-data">
                    Select image to upload:
                    <input type="file" name="fileToUpload" id="fileToUpload">
                    <input type="submit" value="Upload Image" name="submit">
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