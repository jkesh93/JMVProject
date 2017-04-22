<?php
// Assign conn2 to dbCars
require_once('../connectscripts/dbConnect.php');
// Assign conn to dbDmv_Admin
require_once('../connectscripts/loginConnect.php');

session_start();

// Protect the webpage
if (@$_SESSION['loggedIn'] != true) {
    echo "<h1> DENIED </h1>";
}


$query = $_SESSION['query'];

$sql = $conn2->prepare($query);
$conn2->exec($query);

echo "<h1> Success! Click <a href='../userLoggedIn.php'>here </a> to go back </h1>";



?>