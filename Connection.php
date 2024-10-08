<?php
namespace app\db;

use PDO;

class Connection {
    protected $tableName;

    private $hostname = 'mysql8';
    private $dbname = 'yii2';
    private $username = 'root';
    private $password = 'root';

    private $dbh;
    private $pdo;
    private ?string $where = '';
    private string $orderBy = '';

    public function __construct() {
        try {
            $this->dbh = new PDO('mysql:host=' . $this->hostname .';dbname=' . $this->dbname, $this->username, $this->password);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Ошибка подключения: " . $e->getMessage();
            exit;
        }
    }

    public function query($query) {
        return $this->dbh->query($query);
    }

    public function prepare($query) {
        return $this->dbh->prepare($query);
    }

    public static function where(?string $where = null): static
    {
        $connection = new static;
        $connection->where = $where;
        return $connection;
    }

    public function get()
    {
        $sql = "SELECT * FROM $this->tableName" . (!empty($this->where) ? " WHERE $this->where" : "");
        $stmt = $this->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $result = [];
        foreach ($data as $technicDatum) {
            $result[] = (new static())->load($technicDatum);
        }
        return $result;
    }

    public function first()
    {
        $sql = "SELECT * FROM $this->tableName" . (!empty($this->where) ? " WHERE $this->where" : "") . " LIMIT 1";
        $stmt = $this->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);
        return (new static())->load($data);
    }
}

