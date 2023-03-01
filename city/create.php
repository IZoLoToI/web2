<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");


include_once '../src/database.php';
include_once '../models/city.php';

$DB = new Database();
$DBGet = $DB->getConnection();

$City = new City($DBGet);



if (
    !empty($_POST['name']) 
) {


    $City->name = $_POST['name'];



    if ($City->create()) {

        http_response_code(201);
        echo json_encode(array("message" => "Город был создан."));
    } else {
        http_response_code(503);

        echo json_encode(["message" => "Невозможно создать город."]);
    }
} else {

    http_response_code(400);
    echo json_encode(["message" => "Невозможно создать город. Данные неполные."]);
}
