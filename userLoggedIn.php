<!DOCTYPE html>
<html>

    <head>

    </head>

    <body>
    <?php

session_start();
if (@$_SESSION['loggedIn'] != true) {
    echo "access denied";
?>
       <meta http-equiv="refresh" content="5; url=/ProjectSeven/index.php" />
        <?php
} else {
    echo "<h1>Welcome, " . $_SESSION['name'] . ", to the JMV -- Jay database of Motor Vehicles </h1>
        <ul>
        <style>
        .nodeco {
            text-decoration: none;
            color: inherit;
        }

        </style>
        <h3>What would you like to do?</h3>
            <button><a href=/ProjectSevenV2/view/viewTables.php class='nodeco'>View</a> </button> View all listings<br>
            <button><a href=/ProjectSevenV2/update/chooseUpdateTable.php class='nodeco'>Edit</a> </button> Edit a new listing<br>
            <button><a href=/ProjectSevenV2/add/addTables.php class='nodeco'>Add</a> </button> Add a listing<br>
            <button><a href=/ProjectSevenV2/delete/deleteTables.php class='nodeco'>Delete</a> </button> Delete a listing<br>
            <button><a href=/ProjectSevenV2/search/search.html class='nodeco'>Delete</a> </button> Delete a listing<br>
        </ul>
        ";
?>
       
        <form method='post' action=''>
        <input type='submit' name='logout' value='logout'>
        </form>
        
        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST['logout'])) {
            session_destroy();
?>
               <meta http-equiv="refresh" content="0; url=/ProjectSevenV2/index.php" />
                <?php
            
        }
    }
}
?>
</html>