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


$iteratorCount = $_SESSION['size'];
//$arrayTest = array();
//$arrayTest = $_SESSION['results'];




for($i=0 ; $i < $iteratorCount ; $i++){
echo "<br>" . @$_POST[$i];
}

// for($i=0 ; $i < $iteratorCount ; $i++){
// 	array_push($arrayTest, $_POST['checkBox' . $i]);

// }



// for($i=0 ; $i < $iteratorCount ; $i++){
// 	echo "<p> You want to delete: " . $arrayToTest[$i];

// }



?>