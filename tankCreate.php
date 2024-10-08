<!DOCTYPE html>
<html>
<head>
    <title>Добавить танк</title>
</head>
<body>
<h1>Добавить танк</h1>
<form method="POST" action="/tanks/create">
    <label for="title">Название:</label><br>
    <input type="text" id="title" name="title" required><br><br>

    <label for="max_speed">Максимальная скорость:</label><br>
    <input type="number" id="max_speed" name="max_speed" required><br><br>

    <label for="weight">Вес :</label><br>
    <input type="number" id="weight" name="weight" required><br><br>

    <input type="submit" value="Создать">
</form>
</body>
</html>