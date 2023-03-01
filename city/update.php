<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");



include_once '../src/database.php';
include_once '../models/city.php';

$DB = new Database();
$DBC = $DB->getConnection();

$City = new City($DBC);



if (
    !empty($_POST['id']) &&
    !empty($_POST['name']) 
) {

    $City->id  = $_POST['id'];
    $City->name = $_POST['name'];
  
    if ($City->update()) {

        http_response_code(201);
        echo json_encode(array("message" => "Город был обновлен."));
    } else {
        http_response_code(503);

        echo json_encode(["message" => "Невозможно обновить город."]);
    }
}else{
    http_response_code(400);

    echo json_encode(["message" => "Невозможно обновить город. Данные неполные."]);
}