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
$rowsToDelArray = array();
$colCount = $_POST['colCount'];


// values you can work with;

//echo "<br>" . $_POST['rowCount']; // row count
//echo "<br>" . $_POST['colCount'] . "<br>"; // column count

//echo "<br>" . $_POST['results01']; // the value at result[row,column]


pushToArray();
//testString();
returnQueriesToDelete();

//$rowsToDelArray[0];
//returnQueriesToDelete(); // --> Goes to returnQueriesToDelete function 
//						       finds the row to delete based on $rowsToDelArray[$i], PASSES
//								into buildMinorQuery(5,0) -> $j verified to return number;

//buildMinorQuery(5,0); // --> PASSES into buildMinorQuery(5,0);
//buildMinorQuery(1);



// functions
function testBed(){
	global $rowsToDelArray;
	//echo "<br>" . $rowsToDelArray[0] . " is the row to delete"; // you can see that $j = 4;
	$j = $rowsToDelArray[0]; // this equals 4
	//echo "<br> check: " . $_POST['results01'];

	//buildMinorQuery($rowsToDelArray[0],1);
	buildMinorQuery($j,1); // --> first column of the row is: [blank]

}

function buildMinorQuery($row,$col){
	// build a query which only returns the first column of the $row
	//$query = '';
	$row .= $col;
	$address = $row;
	$address = str_replace(' ', '', $address);
	//echo '<br> '. $row;
	//echo '31';
	$query = $_POST['results' . $address];
	return $query;

}

function returnQueriesToDelete(){
	// get the number of rows to delete
	global $rowsToDelArray;
	global $colCount;
	$query = '';
	$countDeletions = getSizeDel();
	//echo '<br> count del = ' . $countDeletions;

	for($i=0; $i<$countDeletions; $i++){
		$query = 'delete from ' . getForm() . " where ";
		$j = $rowsToDelArray[$i];

		//$query .= "<br>";
		
		for($k=0; $k< $colCount; $k++){
		$query .= getColumnName($k) . "=";
			if(($k+1) == $colCount){
			$query .= "'" . buildMinorQuery($j, $k) . "';";
			} else{
			$query .= "'" . buildMinorQuery($j, $k) . "' AND ";
			}
		}
		echo "<br>";
		echo $query;
	}
	
}

function pushToArray(){
	for($i=0; $i<$_POST['rowCount']; $i++){
	//echo "<br> size: " . $_SESSION['size'];
	global $rowsToDelArray;
	if(is_null(@$_POST[$i])){
		$_POST[$i] = 'NULL';
	} else {
	array_push($rowsToDelArray, $_POST[$i]);
	//echo "<br> row to delete: " . @$_POST[$i];
	}
}

}

function getColumnName($col){
	$columnHeaders = array();
	$columnHeaders = $_SESSION['columnHeaders'];
	return $columnHeaders[$col];
}

function getForm(){
	$formName = $_POST['formName'];
	return $formName;
}

function getSizeDel(){
	global $rowsToDelArray;
	return count($rowsToDelArray);
}







?>