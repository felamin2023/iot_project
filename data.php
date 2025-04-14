<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'iot_project'; // replace with your DB name

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Only get today's data
$sql = "SELECT temperature, humidity, timestamp FROM sensor_data
        WHERE DATE(timestamp) = CURDATE()
        ORDER BY timestamp DESC LIMIT 30";

$result = $conn->query($sql);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

header('Content-Type: application/json');
echo json_encode($data);
?>
