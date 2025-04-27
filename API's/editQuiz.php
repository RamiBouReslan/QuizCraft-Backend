<?php
include("./connection.php");

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->quiz_id) && !empty($data->title)) {
    
    $checkQuiz = $connection->prepare("SELECT * FROM quizzes WHERE quiz_id = ?");
    $checkQuiz->execute([$data->quiz_id]);
    $quiz = $checkQuiz->fetch(PDO::FETCH_ASSOC);
    
    if ($quiz) {
        $editQuiz = $connection->prepare("UPDATE quizzes SET title = ?, description = ? WHERE quiz_id = ?");
        $editQuiz->execute([$data->title, $data->description ?? "", $data->quiz_id]);
        echo json_encode(["success" => true, "message" => "Quiz updated successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Quiz not found."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Missing fields."]);
}
?>
