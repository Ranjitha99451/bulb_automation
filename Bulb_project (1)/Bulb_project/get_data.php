<?php
include 'config.php';

$sql = "SELECT control_mode, ldr_value, updated_at FROM controls ORDER BY updated_at DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
    echo json_encode(["success" => true, "data" => $data]);
} else {
    echo json_encode(["success" => false, "message" => "No data found"]);
}
$conn->close();
?>
