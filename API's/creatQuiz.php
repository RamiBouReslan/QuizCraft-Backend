<?php
include("./connection.php");

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->title)) {
    $createQuiz = $connection->prepare("INSERT INTO quizzes (title, description) VALUES (?, ?)");
    $createQuiz->execute([$data->title, $data->description ?? ""]);
    echo json_encode(["success" => true, "quiz_id" => $connection->lastInsertId()]);
} else {
    echo json_encode(["success" => false, "message" => "Missing fields."]);
}
?>
