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
            body {
                background-image: url('img/bg.jpg');
                background-size: cover;
            }
            form.find{
                padding: 20px;
                margin: 15px 0;
                border-radius: 10px;
            }
            h4 {
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
                <h4>Find that vinyl you're after!</h4>
                <!-- searchbox form -->
                <form style="background-color: #f5f5f5;" action="search.php" method="get" class="find needs-validation" novalidate>
                    <input class="form-control me-2" name ="term" type="search" placeholder="Search by Artist, Album, Single, Etc.." aria-label="Search">
                    <br>
                    <button class="w-100 btn btn-primary btn-lg" type="submit">Search for Vinyl</button>
                </form>
            </div>
        </main>
        <script src="js/bootstrap.bundle.min.js"></script>

    </body>
</html>