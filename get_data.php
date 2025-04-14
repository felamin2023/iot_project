<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "iot_project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the most recent data
$sql = "SELECT temperature, humidity FROM sensor_data ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo json_encode($result->fetch_assoc());
} else {
    echo json_encode(["temperature" => null, "humidity" => null]);
}

$conn->close();
?>
