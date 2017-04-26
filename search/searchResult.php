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
$sqlSearchFormBy  = $_POST['searchFormBy'];
$niceSearchFormBy = fixShorthand($sqlSearchFormBy);
$form             = $_POST['form'];
$sqlForm          = $_POST['sqlform'];
//echo $sqlSearchFormBy;

echo "<h4> Search $form records By: $niceSearchFormBy</h4>";

echo "<form method='post' action='searchQueryResult.php'>";
echo "<input type='text' name='searchQuery' placeholder='Enter Search Query Here'>";
echo "<input type='hidden' name='form' value='" . $form . "'>";
echo "<input type='hidden' name='sqlform' value='" . $form . "'>";
echo "<input type='hidden' name='sqlSearchFormBy' value='" . $sqlSearchFormBy . "'>";
echo "<input type='hidden' name='searchFormBy' value='" . $niceSearchFormBy . "'>";
echo "<input type='submit'>";
echo "</form>";


// functions
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