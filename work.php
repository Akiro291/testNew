<?php
$dbh = new PDO('mysql:host=mysql8;dbname=yii2', "root", "root");

echo 'I am the BEST'; 
echo ".<br>";

$sql = 'SELECT * FROM cars';
$stmt = $dbh->query($sql);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo '<pre>';

    foreach ($rows as $row) {
        print_r($row);
        echo "\n";
}

/*
<?php
calss Connection {
    privat $hostname ='';
    privat $dbname ='';
    privat $password ='root';
    privat $username = 'root';

privat $sql
public function
}
*/



?>