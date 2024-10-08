<?php
namespace app\models;
require_once '../interfaces/TechnicInterface.php';

use app\db\Connection;
use interfaces\TechnicInterface;
use PDO;

class Car extends BaseModel implements TechnicInterface {
    private $id;
    private $name;
    private $speed;
    private $production_date;
    protected $tableName = 'cars';

    public function load($data) {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->speed = $data['speed'];
        $this->production_date = $data['production_date'];
        return $this;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getSpeed() {
        return $this->speed;
    }

    public function setSpeed($speed) {
        $this->speed = $speed;
    }

    public function getProductionDate() {
        return $this->production_date;
    }

    public function setProductionDate($production_date) {
        $this->production_date = $production_date;
    }

    public function displayInfo() {
        return "Car: $this->id $this->name $this->speed $this->production_date";
    }

    public function save() {
        $connection = new Connection();
        $connection->tableName = 'cars';
        $connection->query("INSERT INTO cars (name, speed, production_date) VALUES ('" . $this->getName() . "', '" . $this->getSpeed() . "', '" . $this->getProductionDate() . "')");
    }

    public static function findOneById($id) {
        return self::where("id = $id")->first();
    }

    public static function searchByName($search) {
        return self::where("name LIKE '%$search%'")->get();
    }

    public function delete() {
        $connection = new Connection();
        $connection->tableName = 'cars';
        $connection->query("DELETE FROM cars WHERE id = " . $this->getId());
    }
}