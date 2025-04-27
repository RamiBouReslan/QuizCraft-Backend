<?php


try {

$host = "localhost";
$dbname = "quizappdb";
$username = "root"; 
$password = "";     
$port = "3306";     
    
    $connection = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    
   

    echo "Success: Database connection established successfully!";
    
} catch (\Throwable $e) {
    echo $e;
}
?>
