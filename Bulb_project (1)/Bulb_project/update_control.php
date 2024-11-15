<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' || isset($_GET['control_mode'])) {
    $control_mode = $_POST['control_mode'] ?? $_GET['control_mode'];

    if (in_array($control_mode, ['on', 'off', 'auto'])) {
    $stmt = $conn->prepare("INSERT INTO controls (control_mode) VALUES (?)");
    $stmt->bind_param("s", $control_mode);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(["success" => true, "message" => "Control mode updated successfully"]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to update control mode"]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid control mode"]);
}
}
$conn->close();
?>