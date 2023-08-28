<?php
// Establish database connection here
session_start();
error_reporting(0);

if (isset($_SESSION["user"])) {
    if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'p') {
        header("location: ../login.php");
    } else {
        $useremail = $_SESSION["user"];
    }
} else {
    header("location: ../login.php");
}


//import database
include("../connection.php");
$sqlmain = "SELECT * FROM patient WHERE pemail=?";
$stmt = $database->prepare($sqlmain);
$stmt->bind_param("s", $useremail);  // Bind the variable $useremail as a string parameter
$stmt->execute();
$result = $stmt->get_result();
$userrow = $result->fetch_assoc();  // Use $result instead of $userrow
$userid = $userrow["pid"];
$username = $userrow["pname"];


if (isset($_GET['mtid'])) {
    $mtid = $_GET['mtid'];

    // Sanitize and validate the mtid (you might need to modify this based on your code)
    $mtid = intval($mtid);

    // Query the database
    $query = "SELECT price FROM medical_test WHERE mtid = $mtid";
    $result = mysqli_query($database, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $testPrice = $row['price'];
        echo $testPrice; // Send the price back to JavaScript
    } else {
        echo '0'; // Return 0 or an appropriate value if the mtid is not found
    }
}
