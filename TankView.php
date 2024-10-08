<!DOCTYPE html>
<html>
<head>
    <title>Информация о танке</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            color: #333;
        }
        .tank-info {
            margin-top: 20px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 10px;
        }
        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<h1>Информация о танке</h1>
<?php if (isset($tank) && $tank !== null): ?>
    <div class="tank-info">
        <p><?php echo htmlspecialchars($tank->displayInfo()); ?></p>
        <a href="/tanks" class="btn">Назад к списку</a>
    </div>
<?php else: ?>
    <p>Информация о танке не найдена.</p>
<?php endif; ?>
</body>
</html>