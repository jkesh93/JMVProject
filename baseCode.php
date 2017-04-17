<?php

// Assign conn2 to dbCars
require_once('/connectscripts/dbConnect.php');
// Assign conn to dbDmv_Admin
require_once('/connectscripts/loginConnect.php');

session_start();

// Variables

$title = $_GET['sel'];
$title = ucwords($title);

// make statement
$queryDatabase = "describe $title";
$queryCells = "select * from $title";

$sql = $conn2->prepare($queryDatabase);
$sql2 = $conn2->prepare($queryCells);

// execute the statement
$sql->execute();
$sql2->execute();
$colCount = $sql2->columnCount();

// Protect the webpage
if (@$_SESSION['loggedIn'] != true) {
echo "<h1> DENIED </h1>";
}

/*// authenticated session
else{
echo "<h1> The Tables</h1>";

while($result = $sql->fetch()){
echo '<h4 class="tables">' . $result[0] . '</h4><br>';
}
} // end else*/

?>
<!DOCTYPE html>
    <html>


      <head>

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
        <h2 class="centeredHeader">JMV DATABASE SYSTEM - <?php echo "$title" ?> Records</h2>

        <table>
            <tr>
              <?php
              if (@$_SESSION['loggedIn'] == true) {

              while ($result = $sql->fetch()) {
                $result[0] = strtoupper($result[0]);

                // fix the shorthand
                $shorthand = array('FNAME','MINIT','LNAME','ADDRESS_NUM','ADDRESS_STREET','ADDRESS_CITY','ADDRESS_STATE','PATRONS_SSN','DRIVER_SSN','INSURANCE_COMPANY','LICENSE_NUMBER','WORKS_AT', 'START_DATE', 'END_DATE', 'COMPANY');

                $solution = array('First Name','Middle Initial','Last Name','Address Number','Address Street','Address City','Address State','Patrons SSN','Driver SSN','Insurance Company','License Number','Works At', 'Start Date', 'End Date', 'Company');

                // while we search from the 0th shorthand issue to the last
                  for($i=0; $i < count($shorthand); $i++){
                    // we will look through the columns as well
                    //for($j=0; $j<$colCount; $j++){
                    // and if there is a column whose title is a shorthand
                      if($result[0] == $shorthand[$i]){
                      // we will replace the column with its appropriate solution
                        switch($i){
                        case $i:
                        $result[0] = $solution[$i];
                        break;
                        default:
                        echo '';      
                        } // end case
                      } // end if (res[0])
                    //} // end for($result[$j]...)
                  } // end for($i=0...)
                  echo '<th>' . $result[0] . '</th>';
              } // end while ($result =...)

              // switch($result[0]){
              //     case "FNAME":
              //         $result[0] = 'First Name';
              //         break;
              //     case "MINIT":
              //         $result[0] = 'Middle Initial';
              //         break;
              //     case "LNAME":
              //         $result[0] = 'Last Name';
              //         break;
              // }
              } // end if($_SESSION['loggedin']...)

              // display a message if there is no data
              if ($sql->rowCount() == 0) {
                echo "no data";
              }

              ?>
            </tr>

            <?php 
          //$rowCount = $sql2->columnCount();

          while ($result2 = $sql2->fetch()) {
          echo "\n<tr>";

          for($i = 0; $i < $colCount; $i++){
          $result2[$i] = ucwords($result2[$i]);
          echo "\n\t<td><h4>" . $result2[$i] . "<h4></td>";
          }

          // echo "\n<tr>";
          // echo "\n\t<td><h4>" . $result2[0] . "<h4></td>";
          // echo "\n\t<td><h4>" . $result2[1] . "<h4></td>";
          // echo "\n\t<td><h4>" . $result2[2] . "<h4></td>";
          // echo "\n\t<td><h4>" . $result2[3] . "<h4></td>";
          echo "\n</tr>\n";
          /*echo '<tr><td>' . $result2[0] . '</td><td>' . $result2[1] . '</td><td>' . $result2[2] . '</td><td>' . $result2[3] . '</td><td>';
          */
          }

          ?>
        </table>
      </div>
    </body>
</html>