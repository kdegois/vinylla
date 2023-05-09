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
    if (mail($to, $subject, $body, $headers)) {
        $status = 'success';
    } else {
        $status = 'error';
    }
}

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
            h4, h1 {
                color: #fff;
                text-align: center;
            }
            p {
                color: #fff;
                text-align: center;
            }
            label{
                color:#fff
            }

        </style>
    </head>
    <body>

        <?php include "nav.php"?>

        <!-- Begin page content -->
 <main class="flex-shrink-0 form-signin" style="max-width: 600px;">
        <div class="container">
                    <h1>Contact Us</h1>

        <?php if (isset($status)) { ?>
            <div class="alert alert-<?php echo $status; ?>">
                <?php if ($status === 'success') { ?>
                    <p>Your message has been sent. We will get back to you as soon as possible.</p>
                <?php } else { ?>
                    <p>There was an error sending your message. Please try again later.</p>
                <?php } ?>
            </div>
        <?php } ?>
            <form action="" method="post" class="needs-validation" novalidate>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
                <div class="invalid-feedback">
                    Please enter your name.
                </div>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
                <div class="invalid-feedback">
                    Please enter a valid email address.
                </div>
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                <div class="invalid-feedback">
                    Please enter a message.
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Send Message</button>
        </form>
    </main>
        <script src="js/bootstrap.bundle.min.js"></script>

<?php include "footer.php" ?>

    </body>

</html>