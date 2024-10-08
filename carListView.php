<!DOCTYPE html>
<html>
<head>
    <style>
        .back-button, .add-button, .delete-button {
            background-color: #4CAF50; /* Зеленый цвет */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

        .delete-button {
            background-color: #f44336; /* Красный цвет для удаления */
        }
    </style>
</head>
<body>
<h1>Список машин</h1>

<form method="GET" action="/cars">  <!-- Форма для поиска -->
    <input type="text" name="search" placeholder="Поиск по названию...">
    <button type="submit">Искать</button>
</form>

<a href="/cars/create" class="add-button">Добавить машину</a>

<table>
    <table border="1" cellspacing="0" cellpadding="5">
        <thead>
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Скорость</th>
            <th>Дата производства</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($cars as $car): ?>
            <tr class="car-item">
                <td><?php echo htmlspecialchars($car->getId()); ?></td>
                <td><?php echo htmlspecialchars($car->getName()); ?></td>
                <td><?php echo htmlspecialchars($car->getSpeed()); ?></td>
                <td><?php echo htmlspecialchars($car->getProductionDate()); ?></td>
                <td>
                    <a href="/cars/show/<?= urlencode($car->getId()); ?>" class="show-button">Показать</a>
                    <a href="/cars/delete/<?= urlencode($car->getId()); ?>" class="delete-button">Удалить</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <a href="/main" class="back-button">Назад</a>
</body>
</html>