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

// Variables
$title         = $_GET['formtype'];
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
            background-color: #fff;
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

          	function getColumnCount($tableName){
				global $conn2;
				$query = 'select * from  ' . $tableName;
				$sql = $conn2->prepare($query);
				$sql-> execute();

				$colCount = $sql->columnCount();
				return $colCount;

			}

          	function getColumnValuesArray($tableName, $row){ // Returns a columns array

				$colSize = $getColumnCount($tableName);
				$columnValuesArray = array();
				for ($i = 0; $i < $colSize; $i++){
				;
				}
				return $columnValuesArray;
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

            $title = fixShorthand($title); // call the function
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
                            echo '<th> Delete </th>';
                        } // end if($_SESSION['loggedin']...)

                        // display a message if there is no data
                        if ($sql->rowCount() == 0) {
                            echo "no data";
                        }

                    ?>
                </tr>

            <?php
            $iterator = 0;
            $j = 0;
            	echo "<form method='post' action='deleteThese.php' onsubmit='return checkBoxChecked()'>";
            	$resultsTable = array();

                while ($result2 = $sql2->fetch()) { // Building data cells for the table
                	//global $iterator;
                	
                    echo "\n<tr>";
                    for ($i = 0; $i < $colCount; $i++) {
                    	global $resultsTable;
                    	$resultsTable[$j] = $result2[$i];
                    	if($result2[$i] == ''){
                    		$resultsTable[$j] = 'NULL';
                    	} 
                    	echo "<br> This went into the table:" . $resultsTable[$j];
                    	echo "<br> j is at:" . $j;
                        $result2[$i] = ucwords($result2[$i]);
                        echo "\n\t<td>" . $result2[$i] . "</td>";
                        $j++;
                    }

                    // create an array
                    // put the values into the array
                    // put the array into the 'value' of the input;
                    
                    echo "<td><input type='checkbox' class='checkbox' name='" . $iterator . "' value='" . $iterator . " '></td>";
                    echo "\n</tr>\n";
                    $iterator = $iterator + 1;
                }


                for($i = 0; $i<$j;$i++){
                	echo "<input type='hidden' name='result" . $i . " ' value=' " . $resultsTable[$i] . " '>";
                	echo "<br>" . $i;
                	echo "<br>Loop:" . $resultsTable[$i];
                }

                $_SESSION['size'] = $iterator;
                echo "<input type='submit'>";

                echo "</form>";

            ?>
        </table>
      </div>
    </body>

    <script>
    	var toDelete = '';
    	function getBoxesChecked(valueOfCheckBox){
    		console.log(valueOfCheckBox);
    		toDelete += valueOfCheckBox;

    	}

    	function checkBoxChecked(){
    		var values = document.getElementsByClassName('checkbox');
    		for(var i = 0; i < values.length; i++ ){
    			if(values[i].checked == true){
    				return true;
    				console.log(i + ' is true');
    			}
    		}
    		
    	}
    </script>
</html>