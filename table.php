<?php
$dbh = new PDO('mysql:host=mysql8;dbname=yii2', "root", "root");
$sql = 'SELECT * FROM Car';
$stmt = $dbh->query($sql);
$array = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo '<table border="1" cellpadding="16" cellspacing="0">';

echo '<tr>';
echo '<th>name</th>';
echo '<th>speed</th>';
echo '<th>production_date</th>';
echo '<th>ID</th>';
echo '</tr>';

foreach ($array as $value): ?>
    <tr>
        <td><?php echo htmlspecialchars($value['name']); ?></td>
        <td><?php echo htmlspecialchars($value['speed']); ?></td>
        <td><?php echo htmlspecialchars($value['production_date']); ?></td>
        <td><?php echo htmlspecialchars($value['id']); ?></td>
    </tr>
<?php endforeach; ?>
<?php
echo '</table>';
?>