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

// set global variables
$columnNames = $_SESSION['columnNames'];
$niceColumnNames = $_SESSION['niceColumnNames'];
$form = $_SESSION['formtype'];
$errorMessage = ' ';


validateForm();

// functions

	function validateForm(){
		global $columnNames;
		global $niceColumnNames;
		global $errorMessage;
		global $form;
		$columnValues = array();
		$entriesReady = true;
		for ($i = 0; $i < count($columnNames); $i++){
			if(empty($_POST[$columnNames[$i]])){
				$entriesReady = false;
				alertUser($niceColumnNames[$i]);
			} else{
				$columnValues[$i] = $_POST[$columnNames[$i]];
			}
		}
		if($entriesReady == true){
			echo "<h3 class='alert'> Confirm </h3>";
			$confirmNiceNames = getNiceColumnNamesArray();
			$confirmNames = getColumnNamesArray();
			$confirmValues = getColumnValuesArray();
			$query = buildQuery();
			echo "<form action='success.php' method='post'>";

			for($i= 0; $i<count($confirmNames); $i++){
				echo '<br>' . $confirmNiceNames[$i] . ': ';
				echo $confirmValues[$i];
				echo "<input type='hidden' name='" . $confirmNames[$i] . "' value='" . $confirmValues[$i] ."'>";
			}
			$_SESSION['query'] = $query;
			echo " <br>";
			echo " <input type='submit'>";
			echo "</form>";
		}
		else{
			echo "<h3 class='alert'>Error: Could not submit due to the following errors: </h3> ";
			echo $errorMessage;
			echo "<br> click <a href='form.php?formtype=" . $form . "'> here </a> to go back </a>";
		}
	}
	function alertUser($message){
		global $errorMessage;
		$errorMessage .= "<p class='alert'>" . $message . " is incomplete </p>";
	}

	
	function getColumnNames(){ // prints column names;
		global $columnNames;
		for ($i = 0; $i < count($columnNames); $i++){
		echo '<br> these are the column names: ' . $columnNames[$i];
		}
	}

	function getColumnValues(){ // prints column values
		global $columnNames;
		for ($i = 0; $i < count($columnNames); $i++){
		$columnValues[$i] = $_POST[$columnNames[$i]];
		echo '<br> these are the column values: ' . $columnValues[$i];
		}
	}


	function getColumnNamesArray(){ // Returns a names array
		global $columnNames;
		$columnNamesArray = array();
		for ($i = 0; $i < count($columnNames); $i++){
		$columnNamesArray[$i] = $columnNames[$i];
		}
		return $columnNamesArray;
	}

	function getNiceColumnNamesArray(){ // Returns a nice names array
		global $niceColumnNames;
		$columnNiceNamesArray = array();
		for ($i = 0; $i < count($niceColumnNames); $i++){
		$columnNiceNamesArray[$i] = $niceColumnNames[$i];
		}
		return $columnNiceNamesArray;
	}

	function getColumnValuesArray(){ // Returns a columns array
		global $columnValues;
		global $columnNames;
		$columnValuesArray = array();
		for ($i = 0; $i < count($columnNames); $i++){
		$columnValuesArray[$i] = $_POST[$columnNames[$i]];
		}
		return $columnValuesArray;
	}

	function buildQuery(){
		global $form;
		global $conn2;
		$tableName = $form;

		$fieldsList = getColumnNamesArray();
		$valuesList = getColumnValuesArray();

		$colNameCount = count($fieldsList);
		$colValCount = count($valuesList);

		$keyList = '';
		$valList = '';

		$query = ''; // returns this query;
		for ($i = 0; $i < $colNameCount; $i++){
			if(($i + 1) == $colNameCount){
				$keyList .= $fieldsList[$i] . "";
			} else{
				$keyList .= $fieldsList[$i] . ", ";
			}
		}
		for ($i = 0; $i < $colValCount; $i++){
			if(($i + 1) == $colValCount){
				$valList .= "'" . $valuesList[$i] . "'";
			} else{
				$valList .= "'" . $valuesList[$i] . "', ";
			}
		}
		$query = "insert into " . $tableName . " (" . $keyList . ") values (" . $valList . ")";
		return $query;
	}
?>