<?php

include 'condb.php';

try {
    // Get all customers
    $stmt = $conn->query("SELECT customer_id, password FROM customers");
    $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($customers as $customer) {
        // Check if password is already hashed (bcrypt hashes start with $2y$)
        if (!password_get_info($customer['password'])['algo']) {
            // Password is plain text, hash it
            $hashed = password_hash($customer['password'], PASSWORD_BCRYPT);

            // Update the database
            $updateStmt = $conn->prepare("UPDATE customers SET password = :password WHERE customer_id = :id");
            $updateStmt->bindParam(":password", $hashed);
            $updateStmt->bindParam(":id", $customer['customer_id']);
            $updateStmt->execute();

            echo "Updated customer ID: " . $customer['customer_id'] . "\n";
        }
    }

    echo "Password hashing completed.";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>