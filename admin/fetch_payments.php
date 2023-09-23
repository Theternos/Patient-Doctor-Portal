<?php
// Include necessary files and configurations

// Check user authentication
session_start();
if (empty($_SESSION["user"]) || $_SESSION["usertype"] != 'p') {
    header("Location: ../login.php");
    exit; // Ensure script termination after redirection
}

// Import database connection
include("../connection.php");


// Define pagination parameters
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page
$pageSize = 10; // Number of payments per page
$offset = ($page - 1) * $pageSize;

// Fetch payments
$query = "SELECT * FROM payment_history ORDER BY phid DESC LIMIT ?, ?";
$stmt = $database->prepare($query);
$stmt->bind_param("ii", $offset, $pageSize);
$stmt->execute();
$result = $stmt->get_result();

// Loop through the payments and populate the table
while ($row = $result->fetch_assoc()) {
    echo '<tr>';
    echo '<td>' . $row['paid_at'] . '</td>';
    echo '<td>' . $row['title'] . '</td>';
    echo '<td>' . $row['mode'] . '</td>';
    echo '<td>' . $row['total_paid'] . '</td>';
    echo '</tr>';   
}

// Close database connection and handle pagination links (not shown in this code snippet)
$stmt->close();
$database->close();
