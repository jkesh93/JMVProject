<?php

$servername = 'localhost';
$dbport = '3306';
$username = 'jay';
$password = 'jkesh93';
$database_name = 'dmv_admin';

	try{
	$conn = new PDO("mysql:host=$servername;dbname=$database_name", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected to registration database successfully"; 
    }
	catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

?>