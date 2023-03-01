<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");



include_once '../src/database.php';
include_once '../models/user.php';

$DB = new Database();
$DBC = $DB->getConnection();

$User = new User($DBC);



if (
    !empty($_POST['username']) &&
    !empty($_POST['id']) &&
    !empty($_POST['idCity']) &&
    !empty($_POST['name']) 
) {
    $User->id = $_POST['id'];
    $User->name = $_POST['name'];
    $User->username = $_POST['username'];
    $User->idCity = $_POST['idCity'];

    if ($User->update()) {

        http_response_code(201);
        echo json_encode(array("message" => "Пользователь был обновлен."));
    } else {
        http_response_code(503);

        echo json_encode(["message" => "Невозможно обновить пользователя."]);
    }
}