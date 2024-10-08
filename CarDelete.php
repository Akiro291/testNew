<?php
namespace app\controllers;

use app\models\Car;

class CarDeleteController extends BaseController {

    public function index($id) {
        $car = Car::findOneById($id);
        if ($car) {
            $car->delete();
            header('Location: /cars');
            exit;
        } else {
            return $this->render('../views/error.php', ['message' => 'Car not found']);
        }
    }
}