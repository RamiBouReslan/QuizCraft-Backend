<?php
include("./connection.php");

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->title)) {
  
    $checkQuiz = $connection->prepare("SELECT * FROM quizzes WHERE title = ?");
    $checkQuiz->execute([$data->title]);
    $existingQuiz = $checkQuiz->fetch(PDO::FETCH_ASSOC);

    if ($existingQuiz) {
    
        echo json_encode(["success" => false, "message" => "Quiz with this title already exists."]);
    } else {
     
        $createQuiz = $connection->prepare("INSERT INTO quizzes (title, description) VALUES (?, ?)");
        $createQuiz->execute([$data->title, $data->description ?? ""]);

        echo json_encode([
            "success" => true,
            "quiz_id" => $connection->lastInsertId(),
            "message" => "A quiz with title: '{$data->title}' and description: '{$data->description}' was created."
        ]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Missing fields."]);
}
?>
