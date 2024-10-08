<?php
namespace app\controllers;

use app\models\Tank;

class TankDeleteController {

    public function index($id) {
        $tank = Tank::findOneById($id);
        if ($tank) {
            $tank->delete();
            header('Location: /tanks'); // Перенаправить на список танков
            exit;
        } else {
            return $this->render('../views/error.php', ['message' => 'Car not found']);
        }
    }
}