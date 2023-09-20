<?php
include("../connection.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['rating'])) {
    // Retrieve the rating value from the POST request
    $rating = $_POST['rating'];
    $database->query("UPDATE doc_review SET rating = '$rating', seen_status = 1");
    $command = "python ../python/sms_confirmation.py " . escapeshellarg($docname) . "  " . escapeshellarg($scheduledate) . " " . escapeshellarg($scheduletime) . " " . escapeshellarg($phone_number)  . " " . escapeshellarg($apponum);
    $output = shell_exec($command);
    echo json_encode(['message' => 'Rating received successfully']);
} else {
    // Handle invalid or missing POST data
    http_response_code(400); // Bad Request
    echo json_encode(['error' => 'Invalid request']);
}
