<?php
header("Content-Type: application/json; charset=UTF-8");
require 'db.php';

$sql = "SELECT * FROM sensor_logs ORDER BY id DESC LIMIT 15";
$result = $conn->query($sql);

$data = array();
while($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode(array_reverse($data)); // กลับข้อมูลเพื่อวาดกราฟจากซ้ายไปขวา
$conn->close();
?>