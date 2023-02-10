<?php

require_once "includes/functions.inc.php";
require_once "includes/dbconnect.inc.php";


if (isset($_POST["submit"])){

    $email = $_POST["email"];
    $firstName = $_POST["first_name"];
    $lastName = $_POST["last_name"];
    $password = md5($_POST["password"]);
    $passwordRepeat = $_POST["password_repeat"];

    $sql = "INSERT INTO user (email, password, first_name, last_name) VALUES ('$email','$password', '$firstName', '$lastName');";

    if(mysqli_query($conn, $sql)){
        $success = "Account created added successfully!";
    }
    else {
        $error = "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
    }
}

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <title>Vinylla - Sign up</title>
        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- Sticky footer navbar -->
        <link href="css/sticky-footer-navbar.css" rel="stylesheet">
        <!-- Form-validation -->
        <link href="css/form-validation.css" rel="stylesheet">
    </head>
    <body class="bg-light">

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
                    <h4>Create an account</h4>
                    <form action="signup.php" method="post" class="needs-validation" novalidate>
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="firstName" class="form-label">First name</label>
                                <input type="text" class="form-control" name="first_name" id="firstName" placeholder="" value="" required>
                                <div class="invalid-feedback">
                                Valid first name is required.
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="lastName" class="form-label">Last name</label>
                                <input type="text" class="form-control" name="last_name" id="lastName" placeholder="" value="" required>
                                <div class="invalid-feedback">
                                Valid last name is required.
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="email" required>
                                <div class="invalid-feedback">
                                Please enter a valid email address.
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="" value="" required>
                                <div class="invalid-feedback">
                                Please enter a valid password
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="passwordRepeat" class="form-label">Repeat Password</label>
                                <input type="password" class="form-control" name="password_repeat" id="passwordRepeat" placeholder="" value="" required>
                                <div class="invalid-feedback">
                                Please re-enter your password
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <button class="w-100 btn btn-primary btn-lg" type="submit" name="submit">Create account</button>
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