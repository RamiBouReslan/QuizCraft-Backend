<?php
include("./connection.php");

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->email) && !empty($data->password)) {
    $login = $connection->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $login->execute([$data->email, $data->password]);
    $user = $login->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        echo json_encode(["success" => true, "user" => $user]);
    } else {
        echo json_encode(["success" => false, "message" => "Invalid credentials."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Missing fields."]);
}
?>