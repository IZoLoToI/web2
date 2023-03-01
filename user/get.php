<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


include_once '../src/database.php';
include_once '../models/user.php';

$DB = new Database();
$DBC = $DB->getConnection();

$User = new User($DBC);


$UserGet = $User->get();

$UserGetCount = $UserGet->rowCount();

if ($UserGetCount > 0) {

    $UserArray = array();
    $UserArray["items"] = array();

    while ($row = $UserGet->fetch(PDO::FETCH_ASSOC)) {

        // извлекаем строку
        extract($row);

        $UserItem = array(
            "id" => $id,
            "username" => $username,
            "idCity" => $idCity,
            "name" => $name,
        );

        $UserArray["items"][] = $UserItem;

    }

    http_response_code(200);

    echo json_encode($UserArray);

} else {
    http_response_code(404);

    echo json_encode(["message" => "Пользователи не найдены."]);
}
