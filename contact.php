<?php

require_once "includes/functions.inc.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // add your email address here
    $to = 'dimarijnr@gmail.com';

    // set the email subject
    $subject = 'New message from Vinylla Contact Us Form';

    // set the email message
    $body = "Name: $name\nEmail: $email\nMessage: $message";

    // set the email headers
    $headers = "From: $name <$email>";

    // send the email
    if (!$name=='' && !$email=='' && !$message==''){

        if (mail($to, $subject, $body, $headers)) {
            $status = 'success';
        } else {
            $status = 'error';
        }
    }
    else{
        $status = 'error';
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
        <title>Vinylla - Login</title>
        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- Main CSS -->
        <link href="css/main.css" rel="stylesheet">
        <!-- Sticky footer navbar -->
        <link href="css/sticky-footer-navbar.css" rel="stylesheet">
        <!-- Signin page CSS -->
        <link href="css/signin.css" rel="stylesheet">
    </head>
    <body>
        <?php include "nav.php"?>

        <!-- Bootstrap login form -->
        <main class="flex-shrink-0 form-signin text-center" style="max-width:600px;">
            <div class="container">
                <?php

                // Error messages in red bubble

                if (isset($_GET['error'])){
                    $error = $_GET['error'];
                    if ($error == 1) {
                        echo ("<div class=\"error\">Name required!</div>");
                    }
                    if ($error == 2) {
                        echo("<div class=\"error\">Email required!</div>");
                    }
                }
                ?>
                <?php 
                    if (isset($status)) { 
                        echo "<div class=\"alert alert-". $status ."\">";
                        if ($status === 'success') { 
                            echo "<p>Your message has been sent. We will get back to you as soon as possible.</p>";
                        } else { 
                            echo "<p>There was an error sending your message. Please try again later.</p>";
                        }
                        echo "</div>";
                    } 
                ?>
                <form action="" method="post" class="needs-validation">

                    <h1 class="h3 mb-3 fw-normal">Contact Us</h1>
                    <div class="form-floating">
                    <input type="text" name="name" class="form-control" id="floatingInput" placeholder="john doe">
                    <label for="floatingInput">Full Name</label>
                    <div class="invalid-feedback">
                    Please enter your name.
                    </div>
                    </div>
                    <div class="form-floating">
                    <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Email address</label>
                    </div>

                    <div class="form-floating">
                    <input type="multiline" name="message" class="form-control" id="floatingInput" placeholder="message">
                    <label for="floatingPassword">Message</label>
                    </div>
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Send Message</button>

                    <p class="mt-5 mb-3 text-muted">&copy; Vinylla 2023 - UoP</p>
                </form>
            </div>
        </main>
        <script src="js/bootstrap.bundle.min.js"></script>
        
    </body>
    </html>
