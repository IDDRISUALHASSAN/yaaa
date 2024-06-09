<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "yaa";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$stmt = $conn->prepare("SELECT url FROM videos ORDER BY RAND()");
$stmt->execute();
$videos = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
echo json_encode($videos);
?>