<?php

require_once ("includes/functions.inc.php");
require_once ("includes/dbconnect.inc.php");

// Pass URI to login

if (isset($_GET['uri'])){
    $uri = $_GET['uri'];
}
else {
    $uri = dirname($_SERVER['REQUEST_URI']);
}

// Check if user is already logged in

if (isset($_SESSION['user_id']) && isset($_SESSION['email']) && isset($_SESSION['password'])){
    // Validate these detals!
    header("Location:" . $uri);
}

// Login the user

if (isset($_POST['email']) && isset($_POST['password'])) {

    $email = stripData($_POST['email']);
    $password = stripData($_POST['password']);
    $password = md5($password);

    if (empty($email)) {
        header("Location: login.php?error=1&uri=" . $uri);
        exit();
    }
    
    else if(empty($password)){
        header("Location: login.php?error=2&uri=" . $uri);
        exit();
    }

    else{
        
        // SQL query to DB - This could be more secure
        $sql = "SELECT * FROM user WHERE email='$email' AND password='$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);

            if ($row['email'] == $email && $row['password'] == $password) {
                
                // Open the user session
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['password'] = $row['password'];
                
                // Send user back to where they come from
                header("Location:" . $uri);
                exit();
            
            }
            
            else{
                // Username or password must be wrong!
                header("Location: login.php?error=3&uri=" . $uri);
                exit();
            }

        }
        
        else{
            // Username & password not in the database - but throw same error for security
            header("Location: login.php?error=3&uri=" . $uri);
            exit();
        }

    }

}

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <title>Vinylla - Login</title>
        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- Sticky footer navbar -->
        <link href="css/sticky-footer-navbar.css" rel="stylesheet">
        <!-- Custom styles for signin -->
        <link href="css/signin.css" rel="stylesheet">
    </head>
    <body>
        <?php include "nav.php"?>

        <!-- Bootstrap login form -->
        <main class="flex-shrink-0 form-signin text-center">
            <div class="container">
                <?php

                // Error messages in red bubble

                if (isset($_GET['error'])){
                    $error = $_GET['error'];
                    if ($error == 1) {
                        echo ("<div class=\"error\">Email required!</div>");
                    }
                    if ($error == 2) {
                        echo("<div class=\"error\">Password required!</div>");
                    }
                    if ($error == 3) {
                        echo("<div class=\"error\">Email or password Incorrect!</div>");
                    }
                }

                ?>

                <form action="login.php?uri=<?php echo $uri?>" method="post">

                    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

                    <div class="form-floating">
                    <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Email address</label>
                    </div>

                    <div class="form-floating">
                    <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                    </div>

                    <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" value="remember-me"> Remember me
                    </label>
                    </div>

                    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>

                    <p class="mt-5 mb-3 text-muted">&copy; Vinylla 2023 - UoP</p>
                </form>
            </div>
        </main>
        <script src="js/bootstrap.bundle.min.js"></script>
    </body>
</html>