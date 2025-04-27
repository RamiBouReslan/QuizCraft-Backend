<?php


try {

$host = "localhost";
$dbname = "quizappdb";
$username = "root"; 
$password = "1";     
$port = "3306";     
    
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Success: Database connection established successfully!";
    
} catch (\Throwable $e) {
    echo $e;
}
?>
