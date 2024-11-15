<?php
include 'config.php';

$sql = "SELECT control_mode FROM controls ORDER BY updated_at DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
    echo json_encode(["control_mode" => $data['control_mode']]);
} else {
    echo json_encode(["control_mode" => "off"]);
}

$conn->close();
?>
