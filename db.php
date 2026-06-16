<?php
$host = "db";
$user = "kpswacth_reg";
$pass = "regP@ssw0rd"; // รหัสผ่านของ XAMPP มักจะว่างเปล่า
$dbname = "smart_farm";

// เชื่อมต่อด้วย MySQLi และสร้างตัวแปร $conn
$conn = new mysqli($host, $user, $pass, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ตั้งค่าภาษาไทยให้ฐานข้อมูล
$conn->set_charset("utf8mb4");
?>