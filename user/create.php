<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");


include_once '../src/database.php';
include_once '../models/user.php';

$DB = new Database();
$DBC = $DB->getConnection();

$User = new User($DBC);



if (
    !empty($_POST['idCity']) &&
    !empty($_POST['name']) &&
    !empty($_POST['username'])
) {


    $User->name = $_POST['name'];
    $User->idCity = $_POST['idCity'];
    $User->username = $_POST['username'];



    if ($User->create()) {

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
