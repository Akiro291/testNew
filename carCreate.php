<!DOCTYPE html>
<html>
<head>
    <title>Добавить машину</title>
</head>
<body>
<h1>Добавить машину</h1>
<form method="POST" action="/cars/create">
    <label for="name">Название:</label><br>
    <input type="text" id="name" name="name" required><br><br>

    <label for="speed">Скорость:</label><br>
    <input type="number" id="speed" name="speed" required><br><br>

    <label for="productionDate">Дата производства:</label><br>
    <input type="date" id="productionDate" name="productionDate" required><br><br>

    <input type="submit" value="Создать">
</form>
</body>
</html>