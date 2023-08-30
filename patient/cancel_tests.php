<?php

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
$sqlmain = "select * from patient where pemail=?";
$stmt = $database->prepare($sqlmain);
$stmt->bind_param("s", $useremail);
$stmt->execute();
$userrow = $stmt->get_result();
$userfetch = $userrow->fetch_assoc();
$userid = $userfetch["pid"];
$username = $userfetch["pname"];


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["selected_tests"])) {
    $selectedTests = $_POST["selected_tests"];
    foreach ($selectedTests as $testID) {
        $result = $database->query("SELECT tid, payment_id, price from test_booking INNER JOIN medical_test ON medical_test.mtid = test_booking.mtid WHERE test_booking.mtid = '$testID' and pid = '$userid' and `status` = 0");
        $inforow = $result->fetch_assoc();
        $payment_id =  $inforow['payment_id'];
        $rps = $inforow['price'];
        $tid = $inforow['tid'];
        $result = $database->query("INSERT INTO refund (pid, tid, rps, payment_id) VALUES ('$userid','$tid', '$rps', '$payment_id')");
        $result = $database->query("DELETE from test_booking WHERE mtid = '$testID' and pid = '$userid' and `status` = 0");
        header("location: ./appointment.php?action=removed-test");
    }
} else {
    echo "No tests selected for cancellation.";
}
