<?php

require_once("includes/dbconnect.inc.php");
require_once "includes/functions.inc.php";

// Redirect to login page if user is not logged in
if (!loggedIn()) {
  header("Location: login.php");
  exit();
}

// Get the cart from the session
$cart = $_SESSION['cart'];

// // If cart is empty, display a message and exit
// if (empty($cart)) {
//   echo "
//     <h2>Your cart is empty.</h2>";
//   exit();
// }

// Update cart quantities if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  foreach ($_POST['quantity'] as $id => $quantity) {
    if ($quantity == 0) {
      // Remove item from cart if quantity is zero
      unset($cart[$id]);
    } else {
      // Update quantity of item in cart
      $cart[$id]['quantity'] = $quantity;
    }
  }
  $_SESSION['cart'] = $cart;
}

// Get the total price of all items in the cart
$total_price = 0;
foreach ($cart as $id => $item) {
  $total_price += $item['price'] * $item['quantity'];
}

?>

<!-- TEEEESSST --->
<!-- TEEEESSST --->
<!-- TEEEESSST --->
<!-- TEEEESSST --->
<!-- TEEEESSST --->

<!DOCTYPE html>
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
    <title>Vinylla - Basket</title>
</head>
<body>
  <?php include "nav.php"?>
  <div class="container">

      <h2>Cart</h2>
      
<?php if (empty($cart)) {
    echo "<h2>Your cart is empty.</h2>";
} else { ?>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Item</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total</th>
                <th scope="col">Remove</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cart as $id => $item) { ?>
                <tr>
                    <td><?php echo $item['name']; ?></td>
                    <td><?php echo formatPrice($item['price']); ?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="number" name="quantity[<?php echo $id; ?>]" value="<?php echo $item['quantity']; ?>" min="0">
                            <button type="submit" class="btn btn-sm btn-outline-primary">Update</button>
                        </form>
                    </td>
                    <td><?php echo formatPrice($item['price'] * $item['quantity']); ?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="hidden" name="quantity[<?php echo $id; ?>]" value="0">
                            <button type="submit" class="btn btn-sm btn-outline-danger">Remove</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" class="text-end">Total:</th>
                <td><?php echo "£" . number_format($total, 2); ?></td>
            </tr>
        </tfoot>
    </table>
<?php } ?>

    </div>
    
 
</body>
<?php include "footer.php" ?>
</html>
