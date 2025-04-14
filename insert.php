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

$temperature = $_POST['temperature'];
$humidity = $_POST['humidity'];

$sql = "INSERT INTO sensor_data (temperature, humidity) VALUES ('$temperature', '$humidity')";

if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
