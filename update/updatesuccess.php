<?php
// Assign conn2 to dbCars
require_once('../connectscripts/dbConnect.php');
// Assign conn to dbDmv_Admin
require_once('../connectscripts/loginConnect.php');
session_start();
// Protect the webpage


if (@$_SESSION['loggedIn'] != true) {
    echo "<h1>ACCESS DENIED </h1>";
} //@$_SESSION[ 'loggedIn' ] != true

// variables
$rowToEdit   = $_POST['rowToEdit'];
$form        = $_POST['form'];
$colSize     = $_POST['colSize'];
$columnNames = array();
$columnNames = getColumnNames($form);
echo "<br>";

$finalQuery = buildFinalQuery();
//$finalQuery = addslashes($finalQuery);
//echo $finalQuery;
//echo var_dump($finalQuery);

// $queryPartOne = buildUpdateQuery();
// $queryPartwo = buildAfterWhereQuery();
// $queryPartOne .= $queryPartwo;
//echo $queryPartOne;
//$query = buildFinalQuery();

$sql = $conn2->prepare($finalQuery);
//var_dump($sql);
$conn2->exec($finalQuery);


// functions

function buildFinalQuery(){
$queryPartOne = buildUpdateQuery();
$queryPartTwo = buildAfterWhereQuery();
$queryPartOne .= $queryPartTwo;

//echo $queryPartOne;

return $queryPartOne;


}


function getColumnNames($tableName)
{
    global $conn2;
    $query = 'describe ' . $tableName;
    $sql   = $conn2->prepare($query);
    $sql->execute();
    $returnArray = array();
    while ($result = $sql->fetch()) {
        $resultp = $result[0];
        array_push($returnArray, $resultp);
    } //$result = $sql->fetch()
    return $returnArray;
}

function buildAfterWhereQuery() // returns a query which fits after the "where" clause in the update function
{
    $query = "";
    global $colSize;
    global $rowToEdit;
    global $columnNames;
    $query = " WHERE";
    // iterate through the columns and get their names;
    for ($i = 0; $i < $colSize; $i++) {
        $address = $rowToEdit;
        $address .= $i;
        $address = str_replace(' ', '', $address);
        
        
        if ($_POST["results" . $address] == '') // if results on are blank skip
            {
        } //$_POST[ 'results' . $address ] == ''
        else {
            if (($i + 1) == $colSize) // if we're on the last string
                {
                $query .= " " . $columnNames[$i] . "='" . $_POST['results' . $address] . "'";
            } //( $i + 1 ) == $colSize
            else {
                $query .= " " . $columnNames[$i] . "='" . $_POST['results' . $address] . "' AND";
            }
        }
        
    } //$i = 0; $i < $colSize; $i++
    $query .= ";";
    //echo $query;
    return $query;
    // iterate through the values and get their values;
}

function buildUpdateQuery()
{
    global $colSize;
    global $rowToEdit;
    global $columnNames;
    global $form;
    //echo "<br>";
    
    $query = 'UPDATE ' . $form . ' SET';
    
    for ($i = 0; $i < $colSize; $i++) // iterate through each column
        {
        $address = $rowToEdit;
        $address .= $i;
        $address = str_replace(' ', '', $address);
        //echo "<br>" . $address;
        //echo "<br>" . $_POST[ 'results' . $address ]; 
        
        if ($_POST['userResult' . $address] == '' || is_null($_POST['results' . $address])) // if results on are blank skip
            {
            if (($i + 1) == $colSize) {
                $query .= " " . $columnNames[$i] . "='" . $_POST['results' . $address] . "'";
            } //($i + 1) == $colSize
            else {
                $query .= " " . $columnNames[$i] . "='" . $_POST['results' . $address] . "',";
            }
        } //$_POST['userResult' . $address] == '' || is_null($_POST['results' . $address])
        
        else {
            if (($i + 1) == $colSize) {
                $query .= " " . $columnNames[$i] . "='" . $_POST['userResult' . $address] . "'";
            } //($i + 1) == $colSize
            
            else {
                $query .= " " . $columnNames[$i] . "='" . $_POST['userResult' . $address] . "',";
            }
        }
        
    } //$i = 0; $i < $colSize; $i++
    //echo $query;
    return $query;
}

?>

  <!DOCTYPE html>

    <head>
      
    </head>


    <body>
      <h1> SUCCESS! </h1>
      <h2> Click <a href='../userLoggedIn.php'> here </a> to go back </h2>
    </body>

  </html>