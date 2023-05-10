<?php

// This is for general helper functions only

session_start();

// Clean up user imputs with this function
function stripData($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//Global user logout function
function logout(){
    session_start();
    session_unset();
    session_destroy();
    header("Location: login.php");
}

function loggedIn(){
    // Check if user is logged in
    if (isset($_SESSION['user_id']) && isset($_SESSION['email']) && isset($_SESSION['password'])){
        // Validate these details!
        return true;
    }
}

// Generate random string function, used for image filenames.
function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

// Remove item from cart
function removeItemFromCart($conn, $listingID, $userID){
    $sql = "SELECT * FROM user WHERE user_id = $userID";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) >= 1){
        while($row = mysqli_fetch_assoc($result)) {
            $listingIdArr = str_getcsv($row['cart']);
        }
    }
    
    // Remove occurrences from array
    $inArr = true;
    while($inArr){
        if (in_array($listingID, $listingIdArr)){
            $key = array_search($listingID, $listingIdArr); // Find
            unset($listingIdArr[$key]); // Remove
            $inArr = true;
        }
        else {
            $inArr = false;
        }
    }

    $listingIdArr = array_values($listingIdArr); // Clean up array

    // Make a new Str
    $first = true;
    $listingIdCSV = "";
    foreach ($listingIdArr as $listingId) {
        if ($first) {
            $listingIdCSV = $listingIdArr[0];
            $first = false;
        }
        else {
            $listingIdCSV .= "," . $listingId;
        }
    }

    $sql = "UPDATE user SET cart = '$listingIdCSV' WHERE user_id = $userID";
    mysqli_query($conn, $sql);

}

// Remove item from wishlist
function removeItemFromWishlist($conn, $listingID, $userID){
    $sql = "SELECT * FROM user WHERE user_id = $userID";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) >= 1){
        while($row = mysqli_fetch_assoc($result)) {
            $listingArr = str_getcsv($row['wishlist']);
        }
    }

    // Remove occurrences from array
    $inArr = true;
    while($inArr){
        if (in_array($listingID, $listingArr)){
            $key = array_search($listingID, $listingArr); // Find
            unset($listingArr[$key]); // Remove
            $inArr = true;
        }
        else {
            $inArr = false;
        }
    }

    $listingArr = array_values($listingArr); // Clean up array

    // Make a new Str
    $first = true;
    $listingCSV = "";
    foreach ($listingArr as $listingId) {
        if ($first) {
            $listingCSV = $listingArr[0];
            $first = false;
        }
        else {
            $listingCSV .= "," . $listingId;
        }
    }

    $sql = "UPDATE user SET wishlist = '$listingCSV' WHERE user_id = $userID";
    mysqli_query($conn, $sql);

}

// Add item to cart
function addItemToCart($conn, $listingID, $userID){
    $sql = "SELECT * FROM user WHERE user_id = $userID";
    $result = mysqli_query($conn, $sql);

    // Get existing str to array
    if (mysqli_num_rows($result) >= 1){
        while($row = mysqli_fetch_assoc($result)) {
            if($row['cart'] != ""){
                $listingIdArr = str_getcsv($row['cart']);
            }
            else {
                $listingIdArr = [];
            }
        }
    }
    
    // Add item to array
    array_push($listingIdArr,$listingID);

    $listingIdArr = array_values($listingIdArr);

    // Make a new Str
    $first = true;
    foreach ($listingIdArr as $listingId) {
        if ($first) {
            $listingIdCSV = $listingIdArr[0];
            $first = false;
        }
        else {
            $listingIdCSV .= "," . $listingId;
        }
    }

    $sql = "UPDATE user SET cart = '$listingIdCSV' WHERE user_id = $userID";
    mysqli_query($conn, $sql);

}

function addItemToWishlist($conn, $listingID, $userID){
    $sql = "SELECT * FROM user WHERE user_id = $userID";
    $result = mysqli_query($conn, $sql);

    // Get existing str to array
    if (mysqli_num_rows($result) >= 1){
        while($row = mysqli_fetch_assoc($result)) {
            if($row['wishlist'] != ""){
                $listArr = str_getcsv($row['wishlist']);
            }
            else {
                $listArr = [];
            }
        }
    }

    // Add item to array
    array_push($listArr,$listingID);

    $listArr = array_values($listArr);

    // Make a new Str
    $first = true;
    foreach ($listArr as $listingId) {
        if ($first) {
            $listIdCSV = $listArr[0];
            $first = false;
        }
        else {
            $listIdCSV .= "," . $listingId;
        }
    }

    $sql = "UPDATE user SET wishlist = '$listIdCSV' WHERE user_id = $userID";
    mysqli_query($conn, $sql);

}

?>