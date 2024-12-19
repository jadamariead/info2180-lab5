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

if ($results){
     echo '<thead>';
     echo '<tr>';
     echo '<th>Country Name</th>';
     echo '<th>Continent</th>';
     echo '<th>Independence Year</th>';
     echo '<th>Head of State</th>';
     echo '</tr>';
     echo '</thead>';
     echo '<tbody>';
     foreach ($results as $row) {
          echo '<tr>';
          echo '<td>' . htmlspecialchars($row['name']) . '</td>';
          echo '<td>' . htmlspecialchars($row['continent']) . '</td>';
          echo '<td>' . htmlspecialchars($row['independence_year']) . '</td>';
          echo '<td>' . htmlspecialchars($row['head_of_state']) . '</td>';
          echo '</tr>';
     }
     echo '</tbody>';
     echo '</table>';
} else {
     echo "Country not found";
}


?>
<ul>
<?php foreach ($results as $row): ?>
  <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
<?php endforeach; ?>
</ul>
