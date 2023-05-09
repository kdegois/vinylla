<?php

require_once "includes/functions.inc.php";

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <title>Vinylla</title>
        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- Sticky footer navbar -->
        <link href="css/sticky-footer-navbar.css" rel="stylesheet">
        <!-- Form-validation -->
        <link href="css/form-validation.css" rel="stylesheet">
        <!-- Custom styles for signin -->
        <link href="css/signin.css" rel="stylesheet">
        <style>
            form.find{
                padding: 20px;
                margin: 15px 0;
                border-radius: 10px;
            }
            h4 {
                color: #fff;
                text-align: center;
            }
            p {
                color: #fff;
                text-align: center;
            }


        </style>
    </head>
    <body>

        <?php include "nav.php"?>

        <!-- Begin page content -->
 <main class="flex-shrink-0 form-signin" style="max-width: 600px;">
        <div class="container">
      <form action="process_ad.php" method="POST" enctype="multipart/form-data">
        <h1 class="h3 mb-3 fw-normal">List Your Vinyl</h1>

        <div class="form-floating">
          <input type="text" class="form-control" id="artist" name="artist" placeholder="Artist" required>
          <label for="artist">Artist</label>
        </div>
        <div class="form-floating">
          <input type="text" class="form-control" id="album" name="album" placeholder="Album" required>
          <label for="album">Album</label>
        </div>
        <div class="form-floating">
          <input type="text" class="form-control" id="description" name="description" placeholder="Description">
          <label for="description">Description</label>
        </div>
        <div class="form-floating">
          <input type="number" class="form-control" id="price" name="price" placeholder="Price" required>
          <label for="price">Price</label>
        </div>
        <div class="form-floating">
          <input type="file" class="form-control" id="image" name="image" accept="image/*">
          <label for="image">Image</label>
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Submit</button>
      </form>
            </div>
        </main>

        <!-- Bootstrap JS -->
        <script src="js/bootstrap.bundle.min.js"></script>

<?php include "footer.php" ?>
    </body>
</html>