<?php

include("./connection.php");

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->email) && !empty($data->password)) {
    $register = $connection->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
    try {
        $register->execute([$data->email, $data->password]);
        echo json_encode(["success" => true]);
    } catch (PDOException $e) {
        echo json_encode(["success" => false, "message" => "User may already exist."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Missing fields."]);
}
?>

