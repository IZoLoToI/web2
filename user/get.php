<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../src/database.php';
include_once '../models/user.php';

$db = new Database();
$dbC = $db->getConnection();

$user = new User($dbC);

$userGet = $user->get();

$userGetCount = $userGet->rowCount();

if ($userGetCount > 0) {

    $userArray = array();
    $userArray["items"] = array();

    while ($row = $userGet->fetch(PDO::FETCH_ASSOC)) {

        extract($row);

        $userItem = array(
            "id" => $id,
            "username" => $username,
            "idCity" => $idCity,
            "name" => $name,
        );

        $userArray["items"][] = $userItem;

    }
    http_response_code(200);

    echo json_encode($UserArray);

} else {
    http_response_code(404);
    echo json_encode(["message" => "Пользователи не найдены."]);
}
