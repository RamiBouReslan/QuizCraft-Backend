<?php
include("./connection.php");

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->quiz_id) && !empty($data->text)) {
    $createQuestion = $connection->prepare("INSERT INTO questions (quiz_id, text, points) VALUES (?, ?, ?)");
    $createQuestion->execute([$data->quiz_id, $data->text, $data->points ?? 1]);
    echo json_encode(["success" => true, "question_id" => $connection->lastInsertId()]);
} else {
    echo json_encode(["success" => false, "message" => "Missing fields."]);
}
?>
