<?php 
require_once '../db/Connection.php';
require_once '../models/Car.php';
require_once '../models/Tank.php';

use models\Car;
use models\Tank;
use db\Connection;

$connection = new Connection();

$id = isset($_GET['id']) ? $_GET['id'] : null;
$type = isset($_GET['type']) ? $_GET['type'] : null;

$technic = null;

// Убедитесь, что тип правильный
if ($type === 'car' || $type === 'tank') {
    if ($type === 'car') {
        // Обработка запроса для автомобилей
        $sql = 'SELECT * FROM Car WHERE id = :id';
        $stmt = $connection->prepare($sql);
        $stmt->execute([':id' => $id]);
        $technic = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($technic) {
            $technic = new Car(
                $technic['id'],
                $technic['name'],
                $technic['speed'],
                $technic['production_date']
            );
        } else {
            $technic = 'No car found with ID: ' . htmlspecialchars($id);
        }
    } elseif ($type === 'tank') {
        // Обработка запроса для танков
        $sql = 'SELECT * FROM Tank WHERE id = :id';
        $stmt = $connection->prepare($sql);
        $stmt->execute([':id' => $id]);
        $technic = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($technic) {
            $technic = new Tank(
                $technic['id'],
                $technic['title'],
                $technic['max_speed'],
                $technic['weight']
            );
        } else {
            $technic = 'No tank found with ID: ' . htmlspecialchars($id);
        }
    }
} else {
    $technic = 'Invalid type specified.';
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($type === 'car') {
        // Обновление данных автомобиля
        $sql = 'UPDATE Car SET name = :name, speed = :speed, production_date = :production_date WHERE id = :id';
        $stmt = $connection->prepare($sql);
        $stmt->execute([
            ':name' => $_POST['name'],
            ':speed' => $_POST['speed'],
            ':production_date' => $_POST['production_date'],
            ':id' => $id
        ]);
    } elseif ($type === 'tank') {
        // Обновление данных танка
        $sql = 'UPDATE Tank SET title = :title, max_speed = :max_speed, weight = :weight WHERE id = :id';
        $stmt = $connection->prepare($sql);
        $stmt->execute([
            ':title' => $_POST['title'],
            ':max_speed' => $_POST['max_speed'],
            ':weight' => $_POST['weight'],
            ':id' => $id
        ]);
    }

    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($type === 'car' ? 'Edit Car' : 'Edit Tank'); ?></title>
</head>
<body>
    <h1><?= htmlspecialchars($type === 'car' ? 'Edit Car' : 'Edit Tank'); ?></h1> 
    <?php if ($technic instanceof Car || $technic instanceof Tank): ?>
        <!-- Форма редактирования данных -->
        <form action="" method="post">
            <?php if ($type === 'car'): ?>
                <label for="name">Car Name:</label>
                <input type="text" id="name" name="name" value="<?= htmlspecialchars($technic->getName()); ?>" required><br>
                <label for="speed">Speed:</label>
                <input type="text" id="speed" name="speed" value="<?= htmlspecialchars($technic->getSpeed()); ?>" required><br>
                <label for="production_date">Production Date:</label>
                <input type="date" id="production_date" name="production_date" value="<?= htmlspecialchars($technic->getProductionDate()); ?>" required><br>
            <?php elseif ($type === 'tank'): ?>
                <label for="title">Tank Title:</label>
                <input type="text" id="title" name="title" value="<?= htmlspecialchars($technic->getTitle()); ?>" required><br>
                <label for="max_speed">Max Speed:</label>
                <input type="text" id="max_speed" name="max_speed" value="<?= htmlspecialchars($technic->getMaxSpeed()); ?>" required><br>
                <label for="weight">Weight:</label>
                <input type="text" id="weight" name="weight" value="<?= htmlspecialchars($technic->getWeight()); ?>" required><br>
            <?php endif; ?>
            <button type="submit">Save Changes</button> 
        </form>
    <?php else: ?>
        <p><?= htmlspecialchars($technic); ?></p>
    <?php endif; ?>
    <br>
    <a href="index.php">Back</a> 
</body>
</html>
