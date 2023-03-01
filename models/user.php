<?php

use JetBrains\PhpStorm\NoReturn;

class User
{



    private ?PDO $conn;
    private string $table_name = "names";
    public int $id;
    public string $username;
    public string $idCity;

    public  string $name;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function get(): bool|PDOStatement
    {

        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id DESC";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    function create(): bool
    {

        $query = "INSERT INTO " . $this->table_name . " SET name=:name, idCity=:idCity, username=:username";

        $stmt = $this->conn->prepare($query);


        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->idCity = htmlspecialchars(strip_tags($this->idCity));
        $this->username = htmlspecialchars(strip_tags($this->username));


        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":idCity", $this->idCity);
        $stmt->bindParam(":username", $this->username);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function update(): bool
{

    $query = "UPDATE " . $this->table_name . " SET name = :name, username = :username, idCity = :idCity WHERE id = :id";

    $stmt = $this->conn->prepare($query);

    $this->name = htmlspecialchars(strip_tags($this->name));
    $this->username = htmlspecialchars(strip_tags($this->username));
    $this->idCity = htmlspecialchars(strip_tags($this->idCity));
    $this->id = htmlspecialchars(strip_tags($this->id));

    $stmt->bindParam(":name", $this->name);
    $stmt->bindParam(":username", $this->username);
    $stmt->bindParam(":idCity", $this->idCity);
    $stmt->bindParam(":id", $this->id);


    if ($stmt->execute()) {
        return true;
    }
    return false;
}

function delete(): bool
{
    $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";

    $stmt = $this->conn->prepare($query);

    $this->id = htmlspecialchars(strip_tags($this->id));


    $stmt->bindParam(":id", $this->id);

    if ($stmt->execute()) {
        return true;
    }
    return false;
}
}


