<?php
require_once 'db.php';
$sql = "SELECT * FROM sensor_logs ORDER BY id DESC LIMIT 50";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Admin - ระบบจัดการข้อมูล</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-light">
<nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="#"><i class="fas fa-cogs"></i> ระบบหลังบ้าน (Data Logs)</a>
        <a href="index.php" class="btn btn-light btn-sm">กลับหน้าหลัก</a>
    </div>
</nav>

<div class="container bg-white p-4 rounded shadow-sm">
    <h4 class="mb-4">ประวัติการบันทึกข้อมูลจากเซนเซอร์</h4>
    <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle text-center">
            <thead class="table-light">
                <tr>
                    <th>ลำดับ</th>
                    <th>วัน-เวลา</th>
                    <th>อุณหภูมิ (°C)</th>
                    <th>ค่า pH</th>
                    <th>ค่า EC (mS/cm)</th>
                    <th>สถานะปั๊มลม</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo date('d/m/Y H:i:s', strtotime($row['created_at'])); ?></td>
                    <td><?php echo $row['temperature']; ?></td>
                    <td><?php echo $row['ph_value']; ?></td>
                    <td><?php echo $row['ec_value']; ?></td>
                    <td>
                        <?php if($row['relay_status'] == 'ON'): ?>
                            <span class="badge bg-success">ทำงาน (ON)</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">หยุดพัก (OFF)</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
<?php $conn->close(); ?>