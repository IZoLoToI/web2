<?php


require '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable("../");
$dotenv->load();

class Database
{
    private string $host ;
    private string $db_name;
    private string $username;
    private string $password;
    public function __construct($host = $_ENV['MYSQL_HOST'],$db_name = $_ENV['DATABASE_NAME'],$username = $_ENV['MYSQL_USER'],$password = $_ENV['MYSQL_PASSWORD'])
    {
        $this->host = $host;
        $this->db_name =  $db_name;
        $this->username = $username;
        $this->password = $password;
    }

    public ?PDO $conn = null;

    public function getConnection(): ?PDO
    {

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
            
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }

}




