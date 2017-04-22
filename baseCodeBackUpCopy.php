<?php
// Assign conn2 to dbCars
require_once('/connectscripts/dbConnect.php');
// Assign conn to dbDmv_Admin
require_once('/connectscripts/loginConnect.php');

session_start();

// Variables
$title         = $_GET['sel'];
$title         = ucwords($title);

// make statement for query
$queryDatabase = "describe $title";
$queryCells    = "select * from $title";
$sql           = $conn2->prepare($queryDatabase);
$sql2          = $conn2->prepare($queryCells);

// execute the statement
$sql->execute();
$sql2->execute();
$colCount = $sql2->columnCount();

// Protect the webpage
if (@$_SESSION['loggedIn'] != true) {
    echo "<h1> DENIED </h1>";
}

?>
<!DOCTYPE html>
    <html>


      <head>

        <!-- have some style :) -->

        <style>

        body{
        background-color: #333333;
        }

        table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 70%;
        margin: 0 auto;
        }

        td,
        th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
        }

        th{
        color: white;
        }

        tr:nth-child(even) {
        background-color: #CECECE;
        }

        tr:nth-child(odd) td{
        color: #dddddd;
        }

        h2{
        color: white;
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
                    'Repairshop'
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
                    'Repair Shop'
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

            $title = fixShorthand($title); // call the function
        ?>


        <h2 class="centeredHeader">JMV DATABASE SYSTEM - <!-- title -->
            <?php
                echo $title;
            ?> Records
        </h2>

        <table>
                  <tr>

                    <?php // Default database display behavior
                        if (@$_SESSION['loggedIn'] == true) {
                            while ($result = $sql->fetch()) {
                                $result[0] = strtoupper($result[0]);
                                $result[0] = fixShorthand($result[0]);
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
                        echo "\n\t<td><h4>" . $result2[$i] . "<h4></td>";
                    }
                    echo "\n</tr>\n";
                }
                
            ?>
        </table>
      </div>
    </body>
</html>