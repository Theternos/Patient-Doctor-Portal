<?php

session_start();

if (isset($_SESSION["user"])) {
    if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'd') {
        header("location: ../login.php");
    }
} else {
    header("location: ../login.php");
}


include("../connection.php");
// Check if the checkbox is checked
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["action"]) && $_GET["action"] === "update" && isset($_GET["id"])) {
    // Retrieve the appointment ID from the request (you can use a hidden input field or session variable)
    $appointmentId = $_GET["id"]; // Replace with the appropriate way to retrieve the appointment ID

    // Define the new status value
    $newStatus = 1; // Replace with the desired new status value

    // Prepare the update query
    $query = "UPDATE appointment SET status = $newStatus WHERE appoid = $appointmentId";
    echo $query;
    // Execute the query
    $result = mysqli_query($database, $query);

    if ($result) {
        echo "Appointment status updated successfully.";
    } else {
        echo "Error updating appointment status: " . mysqli_error($database);
    }
}
header("location: ./appointment.php");


// Close the database connection
mysqli_close($database);
