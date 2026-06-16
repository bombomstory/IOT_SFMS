<?php
header("Content-Type: application/json; charset=UTF-8");
require 'db.php';

$data = json_decode(file_get_contents("php://input"));

if(isset($data->temperature) && isset($data->ph) && isset($data->ec)) {
    $temp = $data->temperature;
    $ph = $data->ph;
    $ec = $data->ec;
    $relay = isset($data->relay_status) ? $data->relay_status : 'OFF';

    $sql = "INSERT INTO sensor_logs (temperature, ph_value, ec_value, relay_status) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ddds", $temp, $ph, $ec, $relay);

    if($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "บันทึกข้อมูลสำเร็จ"]);
    } else {
        echo json_encode(["status" => "error", "message" => "บันทึกล้มเหลว"]);
    }
    $stmt->close();
} else {
    echo json_encode(["status" => "error", "message" => "ข้อมูลไม่ครบถ้วน"]);
}
$conn->close();
?>