<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

include_once '../src/database.php';
include_once '../models/user.php';

$db = new Database();
$dbC = $db->getConnection();

$user = new User($dbC);

if (
    !empty($_POST['idCity']) &&
    !empty($_POST['name']) &&
    !empty($_POST['username'])
) {

    $user->name = $_POST['name'];
    $user->idCity = $_POST['idCity'];
    $user->username = $_POST['username'];

    if ($user->create()) {

        http_response_code(201);
        echo json_encode(array("message" => "Пользователь был создан."));
    } else {
        http_response_code(503);
        echo json_encode(["message" => "Невозможно создать пользователя."]);
    }
} else {
    http_response_code(400);
    echo json_encode(["message" => "Невозможно создать пользователя. Данные неполные."]);
}
