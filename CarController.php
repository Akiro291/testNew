<?php
namespace app\controllers;

use app\models\Car;

class CarController extends BaseController {

    public function index() {
        $search = isset($_GET['search']) ? $_GET['search'] : null;
        if ($search) {
            $cars = Car::searchByName($search);
        } else {
            $cars = Car::where()->get(); // Все автомобили, если нет поиска
        }
        return $this->render('../views/cars/carListView.php', ['cars' => $cars]);
    }

    public function show($id)
    {
        $car = Car::findOneById($id);
        if ($car) {
            return $this->render('../views/cars/carView.php', ['car' => $car]);
        } else {
            return $this->render('../views/error.php', ['message' => 'Car not found']);
        }
    }

    public function create()
    {
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
            return $this->render('../views/cars/carCreate.php');
        }
    }

    public function delete($id)
    {
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