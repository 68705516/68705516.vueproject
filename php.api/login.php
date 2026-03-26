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
if (empty($data['username']) || empty($data['password'])) {
    echo json_encode([
        "status" => "error",
        "message" => "กรุณากรอก username และ password"
    ]);
    exit;
}

try {
    // Find user in database
    $sql = "SELECT customer_id, firstName, lastName, phone, username FROM customers WHERE username = :username";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":username", $data['username']);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($data['password'], $user['password'])) {
        // Remove password from response
        unset($user['password']);

        // Generate a simple token (in production, use JWT)
        $token = bin2hex(random_bytes(32));

        echo json_encode([
            "status" => "success",
            "message" => "เข้าสู่ระบบสำเร็จ",
            "user" => $user,
            "token" => $token
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง"
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