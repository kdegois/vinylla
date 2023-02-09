<?php

$server = "droplet.bry.gg"; // Remote Server
$username = "vinylla";
$pass = "vvbo!0JPXY4AjlUo";
$dbName = "vinylla";

$conn = mysqli_connect($server,$username,$pass,$dbName);

if (!$conn){
    die(mysqli_connect_error());
}

?>