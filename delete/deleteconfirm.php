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

// variables
$queryCount = $_POST['queryCount'];


//echo "<br> Query " . $queryCount;

for($i=0; $i<$queryCount; $i++){
	$query = $_SESSION['query' . $i];
	$conn2->exec($query);
}






echo  "<h1> Successfully deleted rows click <a href='../userLoggedIn.php'> here</a> to go back.</h1>";


?>