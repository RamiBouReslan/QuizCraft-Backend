<?php
include("./connection.php");

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->quiz_id)) {
    $deleteQuiz = $connection->prepare("DELETE FROM quizzes WHERE quiz_id = ?");
    $deleteQuiz->execute([$data->quiz_id]);
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => "Missing fields."]);
}
?><?php
include("./connection.php");

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->quiz_id)) {
    $checkQuiz = $connection->prepare("SELECT * FROM quizzes WHERE quiz_id = ?");
    $checkQuiz->execute([$data->quiz_id]);
    $quiz = $checkQuiz->fetch(PDO::FETCH_ASSOC);
    
    if ($quiz) {
        $deleteQuiz = $connection->prepare("DELETE FROM quizzes WHERE quiz_id = ?");
        $deleteQuiz->execute([$data->quiz_id]);
        echo json_encode(["success" => true, "message" => "Quiz deleted successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Quiz not found."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Missing fields."]);
}
?>
