<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

include 'condb.php';

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        "status" => "error",
        "message" => "Method not allowed"
    ]);
    exit;
}

// Get JSON data from request body
$data = json_decode(file_get_contents("php://input"), true);

// Validate JSON data
if (!$data) {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid JSON data"
    ]);
    exit;
}

// Validate required fields
$required_fields = ['firstName', 'lastName', 'phone', 'username', 'password'];
foreach ($required_fields as $field) {
    if (empty($data[$field])) {
        echo json_encode([
            "status" => "error",
            "message" => "กรุณากรอกข้อมูลให้ครบถ้วน"
        ]);
        exit;
    }
}

// Validate username format
if (!preg_match('/^[a-zA-Z0-9_]{3,20}$/', $data['username'])) {
    echo json_encode([
        "status" => "error",
        "message" => "ชื่อผู้ใช้ต้องเป็นตัวอักษรภาษาอังกฤษ ตัวเลข หรือ _ ความยาว 3-20 ตัวอักษร"
    ]);
    exit;
}

// Validate phone format
if (!preg_match('/^[0-9]{10}$/', $data['phone'])) {
    echo json_encode([
        "status" => "error",
        "message" => "เบอร์โทรศัพท์ต้องเป็นตัวเลข 10 หลัก"
    ]);
    exit;
}

// Validate password strength
if (strlen($data['password']) < 6) {
    echo json_encode([
        "status" => "error",
        "message" => "รหัสผ่านต้องมีอย่างน้อย 6 ตัวอักษร"
    ]);
    exit;
}

try {
    // Check if username already exists
    $checkStmt = $conn->prepare("SELECT customer_id FROM customers WHERE username = :username");
    $checkStmt->bindParam(":username", $data['username']);
    $checkStmt->execute();

    if ($checkStmt->rowCount() > 0) {
        echo json_encode([
            "status" => "error",
            "message" => "ชื่อผู้ใช้นี้มีอยู่แล้ว"
        ]);
        exit;
    }

    // Hash password
    $password_hash = password_hash($data["password"], PASSWORD_BCRYPT);

    // Insert customer data
    $sql = "INSERT INTO customers (firstName, lastName, phone, username, password)
            VALUES (:firstName, :lastName, :phone, :username, :password)";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(":firstName", $data['firstName']);
    $stmt->bindParam(":lastName", $data['lastName']);
    $stmt->bindParam(":phone", $data['phone']);
    $stmt->bindParam(":username", $data['username']);
    $stmt->bindParam(":password", $password_hash);

    if ($stmt->execute()) {
        echo json_encode([
            "status" => "success",
            "message" => "เพิ่มข้อมูลลูกค้าเรียบร้อยแล้ว"
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "ไม่สามารถเพิ่มข้อมูลได้"
        ]);
    }

} catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
    echo json_encode([
        "status" => "error",
        "message" => "เกิดข้อผิดพลาดในระบบ กรุณาลองใหม่อีกครั้ง"
    ]);
}

?>