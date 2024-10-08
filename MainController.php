<?php
namespace app\controllers;
use app\controllers\CarController;
use app\controllers\TankController;
use app\controllers\BaseController;

class MainController extends BaseController {

    public function index() {
        return $this->render('../views/main/main.php');
    }
}