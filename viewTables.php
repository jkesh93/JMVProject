<?php

// Assign conn2 to dbCars
require_once('/connectscripts/dbConnect.php');
// Assign conn to dbDmv_Admin
require_once('/connectscripts/loginConnect.php');
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

            * {
                background-color: #CAFFBC;
            }


            table{
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 70%;
                margin: 0 auto;
            }

            td, th{
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }

            tr:nth-child(even){
                background-color: #dddddd;
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
                <tr>

                    <?php

if (@$_SESSION['loggedIn'] == true) {
    echo "<h1> </h1>";
    
    while ($result = $sql->fetch()) {
        $resultp = $result[0];
        $result[0] = strtoupper($result[0]);
        echo '<br><th><a href="/ProjectSevenV2/view/table.php?sel=' . $resultp . ' ">' . $result[0] . '</a> </th>';
    }
    
    // display a message if there is no data
    if ($sql->rowCount() == 0) {
        echo "no data";
    }
}

?>
               </tr>
            </table>
        </div>
    </body>
</html>