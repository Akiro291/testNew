<?php
namespace app\controllers;

use app\models\Tank;

class TankCreateController extends BaseController {

    public function index() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $max_speed = $_POST['max_speed'];
            $weight = $_POST['weight'];

            $tank = new Tank();
            $tank->setTitle($title);
            $tank->setMaxSpeed($max_speed);
            $tank->setWeight($weight);
            $tank->save();

            header('Location: /tanks'); // Перенаправить на список танков
            exit;
        } else {
            return $this->render('../views/tanks/create.php');
        }
    }
}