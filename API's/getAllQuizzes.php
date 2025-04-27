<?php
include("./connection.php");

$getQuizzes = $connection->query("SELECT * FROM quizzes");
$quizzes = $getQuizzes->fetchAll(PDO::FETCH_ASSOC);

if (count($quizzes) > 0) {
    echo json_encode($quizzes);
} else {
    echo json_encode(["message" => "No quizzes found."]);
}
?>