<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../src/database.php';
include_once '../models/city.php';

$db = new Database();
$dbGet = $db->getConnection();

$city = new City($DBGet);

$cityGet = $city->get();

$cityGetCount = $cityGet->rowCount();

if ($cityGetCount > 0) {

    $cityArray = array();
    $cityArray["items"] = array();

    while ($row = $cityGet->fetch(PDO::FETCH_ASSOC)) {

        extract($row);

        $cityItem = array(
            "id" => $id,
            "name" => $name,
        );
        $cityArray["items"][] = $cityItem;
    }
    http_response_code(200);
    echo json_encode($CityArray);
} else {
    http_response_code(404);
    echo json_encode(["message" => "Города не найдены."]);
}
