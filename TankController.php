<?php
namespace app\controllers;

use app\models\Tank;

class TankController extends BaseController {

    public function index() {
        $search = isset($_GET['search']) ? $_GET['search'] : null;
        if ($search) {
            $tanks = Tank::searchByName($search);
        } else {
            $tanks = Tank::where()->get();
        }
        return $this->render('../views/tanks/tankListView.php', ['tanks' => $tanks]);
    }

    public function show($id)
    {
        $tank = Tank::findOneById($id);
        if ($tank) {
            return $this->render('../views/tanks/tankView.php', ['tank' => $tank]);
        } else {
            return $this->render('../views/error.php', ['message' => 'Tank not found']);
        }
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $max_speed = $_POST['max_speed'];
            $weight = $_POST['weight'];

            $tank = new Tank();
            $tank->setTitle($title);
            $tank->setMaxSpeed($max_speed);
            $tank->setWeight($weight);
            $tank->save();

            header('Location: /tanks');
            exit;
        } else {
            return $this->render('../views/tanks/tankCreate.php');
        }
    }

    public function delete($id)
    {
        $tank = Tank::findOneById($id);
        if ($tank) {
            $tank->delete();
            header('Location: /tanks');
            exit;
        } else {
            return $this->render('../views/error.php', ['message' => 'Tank not found']);
        }
    }
}