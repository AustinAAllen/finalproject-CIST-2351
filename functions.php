<?php
function pdo_connect_mysql() {
    // Update the details below with your MySQL details
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'my_db';
    try {
    	return new PDO('mysql:host=' . $servername . ';dbname=' . $dbname . ';charset=utf8', $username, $password);
    } catch (PDOException $exception) {
    	exit('Failed to connect to database!');
    }
}
?>


    
