<?php
include("./connection.php");

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->question_id)) {
    try {
        
        $checkQuestion = $connection->prepare("SELECT * FROM questions WHERE question_id = ?");
        $checkQuestion->execute([$data->question_id]);
        $question = $checkQuestion->fetch(PDO::FETCH_ASSOC);
        
        if ($question) {
            $deleteQuestion = $connection->prepare("DELETE FROM questions WHERE question_id = ?");
            $deleteQuestion->execute([$data->question_id]);
            echo json_encode(["success" => true, "message" => "Question deleted successfully."]);
        } else {
            echo json_encode(["success" => false, "message" => "Question not found."]);
        }
    } catch (PDOException $e) {
        echo json_encode(["success" => false, "message" => "An error occurred: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Missing fields."]);
}
?>
