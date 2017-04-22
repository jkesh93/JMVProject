<?php
// Assign conn2 to dbCars
require_once('../connectscripts/dbConnect.php');
// Assign conn to dbDmv_Admin
require_once('../connectscripts/loginConnect.php');
session_start();
// Variables
// make statement
$queryDatabase = "show tables";
$sql           = $conn2->prepare($queryDatabase);
// execute the statement
$sql->execute();
// Protect the webpage
if (@$_SESSION['loggedIn'] != true) {
    echo "<h1> DENIED </h1>";
}

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

            .centeredHeader{
                text-align: center;
            }
        </style>    
    </head>

    <body>
        <div>
            <h2 class="centeredHeader">JMV DATABASE SYSTEM</h2>
            <table>

                <?php
                    if (@$_SESSION['loggedIn'] == true) { // login confirmation

                        // build the table
                        echo '<tr> 
                        <th> Table Name </th>
                        <th> Column Count </th>
                        <th> Rows of Data </th>
                        </tr>';

                        // build the rows -- first used current result to build second query, then filled in table with result obtained from second query
                        while ($result = $sql->fetch()) { // get each table name, column count, and rows of data
                            $resultp     = $result[0]; // preserve the result before we convert the table name to uppercase
                            $result[0]   = strtoupper($result[0]); // convert the primary result to uppercase
                            $secondQuery = $conn2->prepare('select * from ' . $resultp); // create new query and prep it
                            $secondQuery->execute(); // execute the new query
                            $colCount = $secondQuery->columnCount(); // get column count
                            $rowCount = $secondQuery->rowCount(); // get row count
                            echo '<tr><td><a href="/ProjectSevenV2/view/table.php?sel=' . $resultp . ' ">' . $result[0] . '</a> 
                            </td>
                             <td> ' . $colCount . ' </td>
                             <td> ' . $rowCount . '</td> 
                             </tr>';
                        } // end while loop

                    } // end login confirmation
                ?>

            </table>
        </div>
    </body>
</html>