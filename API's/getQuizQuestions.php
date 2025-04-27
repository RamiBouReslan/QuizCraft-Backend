<?php
include("./connection.php");

$quiz_id = $_GET['quiz_id'] ?? 0;

$getQuestions = $connection->prepare("SELECT * FROM questions WHERE quiz_id = ?");
$getQuestions->execute([$quiz_id]);
$questions = $getQuestions->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($questions);
?>