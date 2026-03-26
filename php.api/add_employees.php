<?php

include 'condb.php';

// รับค่า JSON จาก client
$data = json_decode(file_get_contents("php://input"), true);

// เช็คว่าข้อมูลครบถ้วนหรือไม่
if (
    empty($data['firstName']) ||
    empty($data['department']) ||
    empty($data['salary'])
) {
    echo json_encode([
        "status" => "error",
        "message" => "กรุณากรอกข้อมูลให้ครบ"
    ]);
    exit;
}

// เช็คว่าข้อมูลเป็น JSON หรือไม่
if (!$data) {
    echo json_encode([
        "status" => "error",
        "message" => "รูปแบบ JSON ไม่ถูกต้อง"
    ]);
    exit;
}

try {
    // เพิ่มข้อมูลพนักงาน
    $sql = "INSERT INTO employees (full_name, department, salary, active)
            VALUES (:full_name, :department, :salary, 1)";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(":full_name", $data['firstName']);
    $stmt->bindParam(":department", $data['department']);
    $stmt->bindParam(":salary", $data['salary']);

    if ($stmt->execute()) {
        echo json_encode([
            "status" => "success",
            "message" => "เพิ่มข้อมูลพนักงานเรียบร้อย"
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "ไม่สามารถเพิ่มข้อมูลได้"
        ]);
    }

} catch (PDOException $e) {
    echo json_encode([
        "status" => "error",
        "message" => "เกิดข้อผิดพลาด: " . $e->getMessage()
    ]);
}

?>