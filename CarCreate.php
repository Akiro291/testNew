<?php
namespace app\controllers;

use app\models\Car;

class CarCreateController extends BaseController {

    public function index() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $speed = $_POST['speed'];
            $productionDate = $_POST['productionDate'];

            $car = new Car();
            $car->setName($name);
            $car->setSpeed($speed);
            $car->setProductionDate($productionDate);
            $car->save();

            header('Location: /cars');
            exit;
        } else {
            return $this->render('../views/cars/create.php');
        }
    }
}