<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
#$stmt = $conn->query("SELECT * FROM countries");

#$results = $stmt->fetchAll(PDO::FETCH_ASSOC);


if (isset($_GET['country'])) {
     $country = $_GET['country'];

     $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
     $stmt->execute(['country' => "%$country%"]);
} else {
     $stmt = $conn->query("SELECT * FROM countries");
}

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);


header('Content-Type: application/json');
echo json_encode($results);


?>
<ul>
<?php foreach ($results as $row): ?>
  <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
<?php endforeach; ?>
</ul>
