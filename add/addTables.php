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

// create global variables
//Arrays
$tableNameArray = array();
$tableNiceNameArray = array();
$tableColumnArray = array();

// make statement for query
$queryTables = "show tables";
$sql           = $conn2->prepare($queryTables);

// execute the statement
$sql->execute();

// get results from first query to input into second query
while ($result = $sql->fetch()) {
	$resultp = $result[0]; // preserve the result
	//echo "<br>before fixing: " . $result[0];
	$result[0] = fixShorthand($result[0]);
	$result[0] = ucfirst($result[0]); // make it uppercase
	// add to array
	array_push($tableNameArray, $resultp);
	array_push($tableNiceNameArray, $result[0]);
} 



// functions
function getColumnNames($tableName){
	global $conn2;
	$query = 'describe ' . $tableName;
	$sql = $conn2->prepare($query);
	$sql-> execute();

	$returnArray = array();

	while($result = $sql->fetch()){
		$resultp = $result[0];
		array_push($returnArray, $resultp);
	}

	return $returnArray;

}

function getNiceColumnNames($tableName){
	global $conn2;
	$query = 'describe ' . $tableName;
	$sql = $conn2->prepare($query);
	$sql-> execute();

	$returnNiceArray = array();

	while($result = $sql->fetch()){
		$resultp = $result[0];
		$result[0] = strtoupper($result[0]);
		$result[0] = fixShorthand($result[0]);
		array_push($returnNiceArray, $result[0]);
	}

	return $returnNiceArray;

}





function fixShorthand($input)
{
    $shorthand = array(
        'FNAME',
        'MINIT',
        'LNAME',
        'NAME',
        'HORSEPOWER',
        'DISPLACEMENT',
        'PISTONS',
        'EXPIRES',
        'MAKE',
        'MODEL',
        'COLOR',
        'PRICE',
        'ADDRESS_NUM',
        'ADDRESS_STREET',
        'ADDRESS_CITY',
        'ADDRESS_STATE',
        'PATRONS_SSN',
        'DRIVER_SSN',
        'INSURANCE_COMPANY',
        'LICENSE_NUMBER',
        'WORKS_AT',
        'START_DATE',
        'END_DATE',
        'COMPANY',
        'repairshop',
        'REPAIRED_AT',
        'vehicleowned',
    );
    $solution  = array(
        'First Name',
        'Middle Initial',
        'Last Name',
        'Name',
        'HORSEPOWER',
        'DISPLACEMENT',
        'PISTONS',
        'EXPIRES',
        'MAKE',
        'MODEL',
        'COLOR',
        'PRICE',
        'Address Number',
        'Address Street',
        'Address City',
        'Address State',
        'Patrons SSN',
        'Driver SSN',
        'Insurance Company',
        'License Number',
        'Works At',
        'Start Date',
        'End Date',
        'Company',
        'Repair Shop',
        'Repaired At',
        'Vehicle Ownership'
    );


    $output    = $input; // default to this if nothing is found
    for ($i = 0; $i < count($shorthand); $i++) {
        if ($input == $shorthand[$i]) {
            switch ($i) {
                case $i:
                    $output = $solution[$i];
                    break;
                default:
                    echo '';
            } // end switch
        } // end if($input...)
    } // end for($i=0)...
    if($output != 'VIN'){
    $output = str_replace("Ssn", "SSN", $output);
	}
    return $output; // return the output
} // end function



?>

<!DOCTYPE html>
<html>
    
    <head>
        <style>

            * {
                font-family:  sans-serif;
                text-decoration: none;
                color: inherit;
                background-color: inherit;
            }

            

            .centeredHeader{
                text-align: center;
            }
        </style>    
    </head>

    <body>
    <?php

    	if (@$_SESSION['loggedIn'] == true) { // login confirmation

    		echo '<form method=\'get\' action="form.php">';
    		echo '<br>Which table would you like to add to? <br>';
    		echo "<select name='formtype' id='chooseForm' onchange='myFunction(this.value)'>";
    		for($i=0; $i < count($tableNameArray); $i++){

    		
    		echo '<br> <option name=\'formtype\' value=' . $tableNameArray[$i] . '>' . $tableNiceNameArray[$i];

   			}
   			echo "</select>";
   			echo "<input type='submit'>";
   		}
    		
    	
    ?>
    <p id='demo'></p>

     </body>
     <script>
     function myFunction(answer) {
     	var x = answer;
     	document.getElementById("demo").innerHTML = "You selected " + x;
     	
     }
     	
     </script>

 </html>