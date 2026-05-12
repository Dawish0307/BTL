<?php
require_once '../config/database.php';
header('Content-Type: application/json; charset=utf-8');

$conn = connectDB();
$region = $_GET['region'] ?? 'all';
$featured = $_GET['featured'] ?? 0;

if ($featured) {
    $stmt = $conn->prepare("SELECT * FROM destinations WHERE featured = 1 ORDER BY rating DESC LIMIT 6");
    $stmt->execute();
} elseif ($region !== 'all') {
    $stmt = $conn->prepare("SELECT * FROM destinations WHERE region = ? ORDER BY rating DESC");
    $stmt->bind_param("s", $region);
    $stmt->execute();
} else {
    $stmt = $conn->prepare("SELECT * FROM destinations ORDER BY rating DESC");
    $stmt->execute();
}

$result = $stmt->get_result();
$destinations = [];
while ($row = $result->fetch_assoc()) {
    $destinations[] = $row;
}
echo json_encode(['success' => true, 'data' => $destinations]);
$conn->close();
?>
