<?php
// Assign conn2 to dbCars
require_once('../connectscripts/dbConnect.php');
// Assign conn to dbDmv_Admin
require_once('../connectscripts/loginConnect.php');

session_start();

// Protect the webpage
if (@$_SESSION['loggedIn'] != true) {
    echo "<h1>ACCESS DENIED </h1>";
}

// Variables
$form = $_POST['formtype'];
$formNice = fixShorthand($form);


// Functions

function getColumnSize($tableName){
	global $conn2;
	$query = 'select * from  ' . $tableName;
	$sql = $conn2->prepare($query);
	$sql-> execute();

	$colCount = $sql->columnCount();
	return $colCount;

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

function determineInputType($input){
	$output = '';
	
	$dates = array(
		'start_date',
		'end_date',
		'expires'
		);

	for($i = 0; $i < count($dates); $i++){
		if($input == $dates[$i]){
			$output = 'date';
			return $output;
		} 
	}	
}

function placeHolderHelper($input){

	$ssnCases = array(
		'ssn',
		'Patrons ssn',
		)

	for($i = 0; $i < count($ssnCases); $i++){
		if($input == $ssnCases[$i]){
			$output = ' (9 digits)';
			return $output;
		} 
	}

	$vinCases = array(
		'vin',
		)

	for($i = 0; $i < count($vinCases); $i++){
		if($input == $vinCases[$i]){
			$output = ' (17 digits)';
			return $output;
		} 
	}
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
        'driver',
        'vehicle'
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
        'Make',
        'Model',
        'Color',
        'Price',
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
        'Vehicle Ownership',
        'Driver',
        'Vehicle'
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

    <h1> Adding to: <?php echo $formNice ?> </h1>

    <?php 

    	$niceColumnNames = getNiceColumnNames($form);
    	$columnNames = getColumnNames($form);

    	for($i = 0; $i < getColumnSize($form); $i++){
    		echo "<br> <input type=" . determineInputType($columnNames[$i]) . " name=" . $columnNames[$i] . " placeholder=" . $columnNames[$i] . ">" . "  " . $niceColumnNames[$i];
    	}

    ?>








    </body>

</html>
