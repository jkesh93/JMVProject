<?php
// Assign conn2 to dbCars
require_once('../connectscripts/dbConnect.php');
// Assign conn to dbDmv_Admin
require_once('../connectscripts/loginConnect.php');

session_start();
// Protect the webpage

if (@$_SESSION['loggedIn'] != true) {
    echo "<h1> DENIED </h1>";
} //@$_SESSION['loggedIn'] != true

// variables 
$form = $_POST['userSearchedFor']; // form that the user wants to search in

// query actions
$tableTitlesQuery = "describe $form";
$sql              = $conn2->prepare($tableTitlesQuery);
$sql->execute(); // execute the tableTitlesQuery


// build the form
buildForm();


// functions
function buildForm()
{
    global $form;
    $niceForm = fixShorthand($form);
    $niceForm = strtoupper($niceForm);
    global $sql;
    $i = 0;
    
    echo "<form action='searchResult.php' method='post'>";
    echo "<h4> Search $form by: </h4>";
    
    while ($result = $sql->fetch()) {
        $resultp   = $result[0];
        $result[0] = strtoupper($result[0]);
        $result[0] = fixShorthand($result[0]);
        $result[0] = strtoupper($result[0]);
        echo "<br><input type='radio' name='searchFormBy' value='" . $resultp . "''>" . $result[0] . '</input>';
        $i++;
    } // end if($_SESSION['loggedin']...)
    
    echo "<input type='hidden' name='form' value='" . $niceForm . "'>";
    echo "<input type='hidden' name='sqlform' value='" . $form . "'>";
    echo "<br><br><input type='submit'>";
    echo "</form>";
    
}

function fixShorthand($input)
{
    $shorthand = array(
        'FNAME',
        'MINIT',
        'LNAME',
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
        'Repairshop',
        'REPAIRED_AT',
        'Vehicleowned'
    );
    $solution  = array(
        'First Name',
        'Middle Initial',
        'Last Name',
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
    
    $output = $input; // default to this if nothing is found
    $input  = strtoupper($input);
    
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
    
    return $output; // return the output
} // end function




?>