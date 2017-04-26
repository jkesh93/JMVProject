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
$searchQuery        = $_POST['searchQuery'];
$form               = $_POST['sqlform'];
$niceForm           = $_POST['form'];
$sqlSearchFormBy = $_POST['sqlSearchFormBy'];
$searchFormBy = $_POST['searchFormBy'];

$query1 = "describe $form";
$query2 = "select * from $form where $sqlSearchFormBy LIKE '" . $searchQuery . "'";

$sql   = $conn2->prepare($query1);
$sql2  = $conn2->prepare($query2);
$sql->execute();
$sql2->execute();
$colCount = $sql2->columnCount();

?>

<!DOCTYPE html>
    <html>


      <head>

        <!-- have some style :) -->

        <style>

       * {
            font-family:  sans-serif;
            text-decoration: none;
            color: inherit;
            background-color: inherit;
        }

       table{
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 70%;
            margin: 0 auto;
            background-color: #A1A1A1;
            }

            tr:nth-child(even){
            background-color: #fff;
            }

            td, th{
            border-radius: 2px;
            text-align: left;
            padding: 12px;
            }

            th:nth-child(even){
            background-color: #FFf;
            }

            th:nth-child(odd){
            background-color: #fff;
            }

        .centeredHeader {
        text-align: center;
        }

        </style>
      </head>


    <body>
      <div>
          <?php


            // Create ShortHand Fixer Function
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

                return $output; // return the output
            } // end function

            $title = fixShorthand($form); // call the function
            $title = strtoupper($title);
        ?>


        <h2 class="centeredHeader">JMV DATABASE SYSTEM - <!-- title -->
            <?php
                echo $title;
            ?> RECORDS
        </h2>

        <table>
                  <tr>

                    <?php // Default database display behavior
                        if (@$_SESSION['loggedIn'] == true) {
                            while ($result = $sql->fetch()) {
                                $result[0] = strtoupper($result[0]);
                                $result[0] = fixShorthand($result[0]);
                                $result[0] = strtoupper($result[0]);
                                echo '<th>' . $result[0] . '</th>';
                            } // end if ($_session)
                        } // end if($_SESSION['loggedin']...)

                        // display a message if there is no data
                        if ($sql->rowCount() == 0) {
                            echo "no data";
                        }

                    ?>
                </tr>

            <?php

                while ($result2 = $sql2->fetch()) { // Building data cells for the table
                    echo "\n<tr>";
                    for ($i = 0; $i < $colCount; $i++) {
                        $result2[$i] = ucwords($result2[$i]);
                        echo "\n\t<td>" . $result2[$i] . "</td>";
                    }
                    echo "\n</tr>\n";
                }

            ?>
        </table>
      </div>
    </body>
</html>
