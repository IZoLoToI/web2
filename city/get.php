<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


include_once '../src/database.php';
include_once '../models/city.php';

$DB = new Database();
$DBGet = $DB->getConnection();

$City = new City($DBGet);


$CityGet = $City->get();

$CityGetCount = $CityGet->rowCount();

if ($CityGetCount > 0) {

    $CityArray = array();
    $CityArray["items"] = array();

    while ($row = $CityGet->fetch(PDO::FETCH_ASSOC)) {

        extract($row);

        $CityItem = array(
            "id" => $id,
            "name" => $name,
        );

        $CityArray["items"][] = $CityItem;

    }

    http_response_code(200);

    echo json_encode($CityArray);

} else {
    http_response_code(404);

    echo json_encode(["message" => "Города не найдены."]);
}
