<?php
namespace app\models;
require_once '../interfaces/TechnicInterface.php';

use app\db\Connection;
use interfaces\TechnicInterface;
use PDO;

class Tank extends BaseModel implements TechnicInterface {
    private $id;
    private $title;
    private $max_speed;
    private $weight;
    protected $tableName = 'tanks';

    public function load($data) {
        $this->id = $data['id'];
        $this->title = $data['title'];
        $this->max_speed = $data['max_speed'];
        $this->weight = $data['weight'];
        return $this;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getMaxSpeed() {
        return $this->max_speed;
    }

    public function setMaxSpeed($max_speed) {
        $this->max_speed = $max_speed;
    }

    public function getWeight() {
        return $this->weight;
    }

    public function setWeight($weight) {
        $this->weight = $weight;
    }

    public function displayInfo() {
        return "Tank: {$this->title}, Max Speed: {$this->max_speed}, Weight: {$this->weight} (ID: {$this->id})";
    }

    public function save() {
        $connection = new Connection();
        $connection->tableName = 'tanks';
        $stmt = $connection->prepare("INSERT INTO tanks (title, max_speed, weight) VALUES (:title, :max_speed, :weight)");
        $stmt->execute([
            ':title' => $this->getTitle(),
            ':max_speed' => $this->getMaxSpeed(),
            ':weight' => $this->getWeight()
        ]);
    }

    public static function findOneById($id) {
        return self::where("id = $id")->first();
    }

    public static function searchByName($search) {
        return self::where("title LIKE '%$search%'")->get();
    }

    public function delete() {
        $connection = new Connection();
        $connection->tableName = 'tanks';
        $connection->query("DELETE FROM tanks WHERE id = " . $this->getId());
    }
}