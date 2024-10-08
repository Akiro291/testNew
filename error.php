<!DOCTYPE html>
<html>
<head>
    <title>Ошибка</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
        }
        h1 {
            color: #d9534f;
        }
        .error-message {
            margin-top: 20px;
            padding: 10px;
            background-color: #f2dede;
            border: 1px solid #ebccd1;
            border-radius: 4px;
        }
    </style>
</head>
<body>
<h1>Ошибка</h1>
<div class="error-message">
    <?php echo htmlspecialchars($message); ?>
</div>
</body>
</html>