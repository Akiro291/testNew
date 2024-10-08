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
<h1>Список танков</h1>

<form method="GET" action="/tanks">
    <input type="text" name="search" placeholder="Поиск по названию...">
    <button type="submit">Искать</button>
</form>

<a href="/tanks/create" class="add-button">Добавить танк</a>

<table>
    <table border="1" cellspacing="0" cellpadding="5">
        <thead>
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Максимальная скорость</th>
            <th>Вес</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($tanks as $tank): ?>
            <tr class="tank-item">
                <td><?php echo htmlspecialchars($tank->getId()); ?></td>
                <td><?php echo htmlspecialchars($tank->getTitle()); ?></td>
                <td><?php echo htmlspecialchars($tank->getMaxSpeed()); ?></td>
                <td><?php echo htmlspecialchars($tank->getWeight()); ?></td>
                <td>
                    <a href="/tanks/show/<?= urlencode($tank->getId()); ?>" class="show-button">Показать</a>
                    <a href="/tanks/delete/<?= urlencode($tank->getId()); ?>" class="delete-button">Удалить</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <a href="/main" class="back-button">Назад</a>
</body>
</html>