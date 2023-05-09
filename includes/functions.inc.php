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
    $sql = "SELECT * FROM cart WHERE user_id = 1";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) >= 1){
        while($row = mysqli_fetch_assoc($result)) {
            $listingIdArr = str_getcsv($row['listing_id_csv']);
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

    $listingIdArr = array_values($listingIdArr); // Clean up arrayßßß

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

    $sql = "UPDATE cart SET listing_id_csv = '$listingIdCSV' WHERE user_id = $userID";
    mysqli_query($conn, $sql);

}


?>