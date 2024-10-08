<?php
require __DIR__ . '/../vendor/autoload.php';

use app\controllers\CarController;
use app\controllers\MainController;
use app\controllers\TankController;
use app\controllers\CarCreateController;
use app\controllers\CarDeleteController;
use app\controllers\TankCreateController;
use app\controllers\TankDeleteController;
use app\db\Connection;
use app\models\Car;
use app\presenters\TechnicPresenter;

// Картирование маршрутов
$controllerMap = [
    'main' => MainController::class,
    'cars' => CarController::class,
    'tanks' => TankController::class,
    'cars/create' => CarCreateController::class,
    'cars/delete' => CarDeleteController::class,
    'tanks/create' => TankCreateController::class,
    'tanks/delete' => TankDeleteController::class,
];

// Получение части маршрута из URL
$url = str_contains($_SERVER["REQUEST_URI"], '?') ? substr($_SERVER["REQUEST_URI"], 0, strpos($_SERVER["REQUEST_URI"], '?')) : $_SERVER["REQUEST_URI"];

$str = 'hello';
$route = explode('/', $url);
$route = array_filter($route);
$route = array_values($route);

$controllerName = $route[0]; //  Извлечение имени контроллера из первого элемента
$methodName = isset($route[1]) ? $route[1] : 'index'; //  Извлечение имени метода
$id = isset($route[2]) ? $route[2] : null; //  Извлечение ID
//echo'<pre>';var_dump($controllerName);
//die;
if (array_key_exists($controllerName, $controllerMap)) {
    $controllerClass = $controllerMap[$controllerName];
    $controller = new $controllerClass();
    if (method_exists($controller, $methodName)) {
        $response = $controller->{$methodName}($id);
        echo $response;
    } else {
        echo renderError('Метод не найден.');
        http_response_code(404);
    }
} else {
    http_response_code(404);
    echo renderError('Страница не найдена1. Ошибка 404');
}
function renderError($message) {
    // Подключаем представление ошибки и передаем сообщение
    ob_start();
    require_once __DIR__ . '/../views/error.php'; // путь к файлу error.php
    $content = ob_get_clean();
    return str_replace('{{message}}', htmlspecialchars($message), $content);
}


die;
$connection = new Connection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['type']) && $_POST['type'] === 'car') {
        if (!empty($_POST['name']) && !empty($_POST['speed']) && !empty($_POST['production_date'])) {
            $sql = 'INSERT INTO Car (name, speed, production_date) VALUES (:name, :speed, :production_date)';
            $stmt = $connection->prepare($sql);
            $stmt->execute([
                ':name' => $_POST['name'],
                ':speed' => $_POST['speed'],
                ':production_date' => $_POST['production_date'],
            ]);
        }
    }
}

if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    $id = $_GET['id'];
    if ($id) {
        $sql = 'DELETE FROM Car WHERE id = :id';
        $stmt = $connection->prepare($sql);
        $stmt->execute([':id' => $id]);
    }
    header('Location: index.php');
    exit();
}

$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = 'SELECT * FROM Car';
if ($search) {
    $sql .= ' WHERE name LIKE :search';
}
$sql .= ' ORDER BY name';
$stmt = $connection->prepare($sql);
if ($search) {
    $stmt->execute([':search' => "%$search%"]);
} else {
    $stmt->execute();
}
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$technicArray = [];
foreach ($rows as $row) {
    $technicArray[] = new TechnicPresenter(new Car(
        $row['id'],
        $row['name'],
        $row['speed'],
        $row['production_date']
    ));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car List</title>
        <style>
        .technic-item {
            margin-bottom: 10px;
        }
        .show-button {
            padding: 5px 10px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .show-button:hover {
            background-color: #0056b3;
        }
        .technic-form { margin-bottom: 10px; }
        .search-form { margin-bottom: 10px; }
    </style>
</head>
<body>
<?= $response ?>
    <!--<h1>Add New Car</h1>
    <form action="" method="post">
        <input type="hidden" name="type" value="car">
        <label for="name">Car Name:</label>
        <input type="text" id="name" name="name"><br>
        <label for="speed">Speed:</label>
        <input type="text" id="speed" name="speed"><br>
        <label for="production_date">Production Date:</label>
        <input type="date" id="production_date" name="production_date"><br>
        <button type="submit">Add Car</button>
    </form>

    <h2>Search Cars</h2>
    <form class="search-form" action="" method="get">
        <label for="search">Search:</label>
        <input type="text" id="search" name="search" value="<?/*= htmlspecialchars($search); */?>">
        <button type="submit">Search</button>
    </form>

    <h2>Car List</h2>
    <table border="1" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Speed</th>
                <th>Production Date</th>
                <th>Action</th>
                <th>Show</th>
            </tr>
        </thead>
        <tbody>
            <?php /*foreach ($technicArray as $technic): */?>
                <tr>
                    <td><?/*= htmlspecialchars($technic->getTechnic()->getId()); */?></td>
                    <td><?/*= htmlspecialchars($technic->getTechnic()->getName()); */?></td>
                    <td><?/*= htmlspecialchars($technic->getTechnic()->getSpeed()); */?></td>
                    <td><?/*= htmlspecialchars($technic->getTechnic()->getProductionDate()); */?></td>
                    <td>
                        <a href="?action=delete&id=<?/*= urlencode($technic->getTechnic()->getId()); */?>">Delete</a>
                    </td>
                    <td>
                        <a href="/cars/show/<?/*= urlencode($technic->getTechnic()->getId()); */?>">Show</a>
                    </td>
                </tr>
            <?php /*endforeach; */?>
        </tbody>
    </table>-->
</body>
</html>










