<?php 

$servername = 'localhost';
$dbport = '3306';
$username = 'jay';
$password = 'jkesh93';
$database_name = 'cars';

	try{
	$conn2 = new PDO("mysql:host=$servername;dbname=$database_name", $username, $password);
    // set the PDO error mode to exception
    $conn2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<br>Connected to DMV Cars Databases successfully"; 
    }
	catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

?>
